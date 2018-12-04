<?php
/**
 * Created by PhpStorm.
 * User: ^2_3^王尔贝
 * Date: 2018/12/4
 * Time: 15:19
 */

namespace App\Http\Controllers\Apis;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Client;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Route;

/**
 * API密码授权
 * Class AuthenticateController
 * @package App\Http\Controllers\Apis
 * @author ^2_3^王尔贝
 */
class AuthenticateController extends ApiController
{

    // 使用web端的用户验证
    use AuthenticatesUsers;

    /**
     * 构造函数(使用api看守器[密码授权令牌])
     * AuthenticateController constructor.
     */
    public function __construct()
    {
        $this->middleware("auth:api")->except(['login', 'logout']);
    }

    /**
     * 获取验证字段(重写AuthenticatesUsers方法)
     */
    public function username()
    {
        return 'email';
    }

    /**
     * 登录失败响应
     * @param Request $request
     * @return mixed
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $msg = $request['errors'];
        $code = $request['code'];
        return $this->setStatusCode($code)->failed($msg);
    }

    /**
     * 密码授权令牌
     * @param Request $request
     * @return mixed
     */
    protected function authenticateClient( Request $request )
    {
        // 验证凭据
        $username = $this->username();
        $credentials = $this->credentials($request);

        // 密码授权令牌客户端(直接查询)
        $password_client = Client::query()->where('password_client', 1)
            ->latest()
            ->first();

        // 向请求对象添加授权请求数据
        $request->request->add([
            'grant_type' => 'password', //密码授权令牌;
            'client_id' => $password_client->id,
            'client_secret' => $password_client->secret,
            'username' => $credentials[ $username ],
            'password' => $credentials['password'],
            'scope' => ''
        ]);


        //// 密码授权令牌
        // 授权请求
        $proxy = Request::create(
            'oauth/token',
            'POST'
        );
        $response = Route::dispatch($proxy);

        return $response;
    }

    /**
     * 认证
     * @param Request $request
     * @return mixed
     */
    protected function authenticated(Request $request)
    {
        return $this->authenticateClient($request);
    }

    /**
     * 登录成功响应
     * @param Request $request
     * @return mixed
     */
    protected function sendLoginResponse(Request $request)
    {
        // 清空登录尝试
        $this->clearLoginAttempts($request);

        return $this->authenticated($request); //认证；
    }

    /**
     * 登录
     * @param Request $request
     * @return mixed
     */
    public function login(Request $request)
    {
        //// 验证器验证数据
        $username = $this->username();
        $validator = Validator::make( $request->all(), [
            $username => 'required|exists:users',   //users，表名；
            'password' => 'required|between:5,32',
        ]);
        if( $validator->fails() ) {
            // 向请求对象添加错误信息
            $request->request->add([
                'errors' => $validator->errors()->toArray(),
                'code' => 401,
            ]);
            return $this->sendFailedLoginResponse( $request ); //登录失败响应；
        }

        //// 登录获取密码授权令牌
        // 凭证字段(身份验证字段)；
        $credentials = $this->credentials( $request );
        // 登录尝试
        if( $this->guard('api')->attempt( $credentials, $request->has('remember') ) ) {
            return $this->sendLoginResponse( $request );
        }

        return $this->setStatusCode('401')->failed('登录失败');
    }

    /**
     * 退出
     * @param Request $request
     * @return mixed
     */
    public function logout(Request $request)
    {
        if( Auth::guard('api')->check() ) {
            // 令牌失效
            Auth::guard('api')->user()->token()->revoke();
        }

        return $this->message('退出登录成功');
    }

    /**
     * 令牌访问测试
     * @param Request $request
     * @return mixed
     */
    public function hello(Request $request)
    {
        return $this->message('访问令牌使用方法：在请求headers头部添加Accept、Authorization值');
    }

    /**
     * [?]第三方登录
     * @param $driver
     * @return mixed
     */
    public function redirectToProvider($driver) {

        if (!in_array($driver,['qq','wechat'])){
            throw new NotFoundHttpException();
        }

        return Socialite::driver($driver)->redirect();
    }

    /**
     * [?]第三方登录回调
     * @param $driver
     * @return mixed
     */
    public function handleProviderCallback($driver) {

        $user = Socialite::driver($driver)->user();
        $openId = $user->id;

        // 第三方认证
        $db_user = User::where('xxx',$openId)->first();
        if (empty($db_user)){
            $db_user = User::forceCreate([
                'phone' => '',
                'xxUnionId' => $openId,
                'nickname' => $user->nickname,
                'head' => $user->avatar,
            ]);
        }

        // 直接创建token(个人访问令牌)
        $token = $db_user->createToken($openId)->accessToken;

        return $this->success(compact('token'));

    }

}