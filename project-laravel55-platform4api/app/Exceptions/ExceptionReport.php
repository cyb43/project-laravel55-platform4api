<?php
/**
 * Created by PhpStorm.
 * User: ^2_3^王尔贝
 * Date: 2018/12/4
 * Time: 15:47
 */

namespace App\Exceptions;
use App\Traits\ApiResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Exception;

/**
 * 接口自定义异常
 * Class ExceptionReport
 * @package App\Exceptions
 * @author ^2_3^王尔贝
 */
class ExceptionReport
{
    // 接口返回Trait
    use ApiResponse;

    // 触发异常
    public $exception;

    // 触发请求
    public $request;

    // 异常实例
    public $report;

    /**
     * 需要触发的异常类数组
     * @var array
     */
    public $doReport = [
        AuthenticationException::class => ['未授权', 401],
        ModelNotFoundException::class => ['该模型未找到', 404]
    ];

    public function __construct(Request $request, Exception $exception)
    {
        $this->request = $request;
        $this->exception = $exception;
    }

    /**
     * 判断是否需要返回异常
     * @return bool
     */
    public function shouldReturn()
    {
        // 不是Json返回／Ajax请求，不触发处理
        if( ! ( $this->request->wantsJson() || $this->request->ajax() ) ) {
            return false;
        }

        foreach ( array_keys( $this->doReport ) as $report) {
            //// 检查是否为指定异常类型
            if( $this->exception instanceof $report) {
                $this->report = $report;
                return true;
            }
        }

        return false;
    }

    /**
     * 创建本类实例
     * @param Exception $exception
     * @return static
     */
    public static function make(Exception $exception)
    {
        return new static(request(), $exception);
    }

    /**
     * 触发异常响应
     * @return mixed
     */
    public function report()
    {
        $a_message = $this->doReport[$this->report];
        return $this->failed($a_message[0], $a_message[1]);
    }

}


