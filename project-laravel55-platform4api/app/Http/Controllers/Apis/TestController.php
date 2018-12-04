<?php
/**
 * Created by PhpStorm.
 * User: ^2_3^王尔贝
 * Date: 2018/12/4
 * Time: 14:29
 */
namespace App\Http\Controllers\Apis;

use App\Http\Resources\User as UserResource;
use App\User;
use Illuminate\Support\Facades\Input;

class TestController extends ApiController
{
    /**
     * 接口调试
     * NOTE：如方法禁止访问，则启用 VerifyCsrfToken.php $except 属性；
     * @return mixed
     */
    public function test()
    {
        //return $this->message('API接口测试通过');

        //// 资源返回
        // 所有数据
        return UserResource::collection( User::all() );
        // 分页数据
        return UserResource::collection(
            User::paginate(
                Input::get('limit')?:1
            )
        );
    }

}