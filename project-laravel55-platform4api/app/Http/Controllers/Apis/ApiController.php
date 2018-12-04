<?php
/**
 * Created by PhpStorm.
 * User: ^2_3^王尔贝
 * Date: 2018/12/4
 * Time: 14:14
 */

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;

/**
 * 控制器基类
 * Class ApiController
 * @package App\Http\Controllers
 * @author ^2_3^王尔贝
 */
class ApiController extends Controller
{
    // ApiResponse 返回Trait
    use ApiResponse;

}
