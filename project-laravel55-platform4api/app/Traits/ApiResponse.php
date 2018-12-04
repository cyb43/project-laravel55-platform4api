<?php
/**
 * Created by PhpStorm.
 * User: ^2_3^王尔贝
 * Date: 2018/12/4
 * Time: 13:32
 */

namespace App\Traits;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response as FoundationResponse;
use Response;

/**
 * [Trait]_API返回信息;
 * Trait ApiResponse
 * @package App\Traits
 * @author ^2_3^王尔贝
 */
trait ApiResponse
{
    /**
     * 状态码(默认200)
     * @var int
     * @author ^2_3^王尔贝
     */
    protected $statusCode = FoundationResponse::HTTP_OK;


    /**
     * 获取状态码
     * @return int
     * @author ^2_3^王尔贝
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * 设置状态码
     * @param $statusCode
     * @return $this
     * @author ^2_3^王尔贝
     */
    public function setStatusCode( $statusCode )
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * JSON返回响应
     * @param $data 返回数据；
     * @param array $header 响应头部信息；
     * @return mixed
     * @author ^2_3^王尔贝
     */
    public function respond( $data, $header = [] )
    {
        return Response::json($data, $this->getStatusCode(), $header);
    }

    /**
     * 含有分页的资源返回方法
     * @param AnonymousResourceCollection $collection
     * @param string $status
     * @param null $code
     * @return $this
     * @author ^2_3^王尔贝
     */
    public function respondForPaginate( AnonymousResourceCollection $collection, $status = 'success', $code = null)
    {
        if ($code) {
            $this->setStatusCode($code);
        }

        $a_status = [
            'status' => $status,
            'code' => $this->statusCode
        ];

        return $collection->additional($a_status);
    }

    /**
     * 状态信息响应
     * @param $status 状态信息；
     * @param array $data 响应数据；
     * @param null $code 状态码；
     * @return mixed
     * @author ^2_3^王尔贝
     */
    public function status( $status, array $data, $code = null )
    {
//// 状态码设置
        if ($code){
            $this->setStatusCode($code);
        }

//// 状态信息
        $a_status = [
            'status' => $status,
            'code' => $this->statusCode
        ];

        $a_data = array_merge($a_status, $data);
        return $this->respond($a_data);
    }

    /**
     * 信息状态响应
     * @param $message 响应信息；
     * @param string $status 响应状态说明；
     * @return mixed
     * @author ^2_3^王尔贝
     */
    public function message($message, $status = "success")
    {
        return $this->status($status, [
            'message' => $message
        ]);
    }

    /**
     * 创建成功响应(201)
     * @param string $message 创建成功信息；
     * @return mixed
     * @author ^2_3^王尔贝
     */
    public function created( $message = "created" )
    {
        return $this->setStatusCode( FoundationResponse::HTTP_CREATED )->message($message);
    }

    /**
     * 成功响应
     * @param $data 响应数据;
     * @param string $status 状态说明；
     * @return mixed
     * @author ^2_3^王尔贝
     */
    public function success( $data, $status = "success" )
    {
        return $this->status( $status, compact('data') );
    }

    /**
     * 失败响应
     * @param $message 失败信息；
     * @param int $code 失败状态码(默认400)；
     * @param string $status 失败状态说明；
     * @return mixed
     * @author ^2_3^王尔贝
     */
    public function failed( $message, $code = FoundationResponse::HTTP_BAD_REQUEST, $status = 'error' )
    {
        return $this->setStatusCode($code)->message($message, $status);
    }

    /**
     * 失败直接返回
     * @param $message 失败信息;
     * @return string
     * @author ^2_3^王尔贝
     */
    public function failedReturn( $message )
    {
        if(empty($_SERVER['HTTP_ORIGIN'])){
            header('Access-Control-Allow-Origin:*');
        }else{
            header('Access-Control-Allow-Origin:'.$_SERVER['HTTP_ORIGIN']);
        }

        header('Access-Control-Allow-Methods: PUT,POST,GET,OPTIONS');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: Content-Type, Accept,FooBar,X-Custom-Header');
        header('Access-Control-Max-Age: 1728000');
        header('Content-Type:application/json');

        $failed['status'] = $message;
        $failed['code'] = 400;
        return json_encode($failed);
    }

    /**
     * 服务器内部错误(500)
     * @param string $message 错误信息；
     * @return mixed
     * @author ^2_3^王尔贝
     */
    public function internalError( $message = "Internal Error!" )
    {
        return $this->failed( $message, FoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * 找不到错误响应(404)
     * @param string $message
     * @return mixed
     * @author ^2_3^王尔贝
     */
    public function notFond( $message = 'Not Fond!' )
    {
        return $this->failed($message,Foundationresponse::HTTP_NOT_FOUND);
    }

}
