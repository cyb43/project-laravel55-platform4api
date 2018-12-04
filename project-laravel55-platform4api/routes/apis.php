<?php
/**
 * Created by PhpStorm.
 * User: ^2_3^王尔贝
 * Date: 2018/12/4
 * Time: 14:28
 */

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| APIS Routes apis路由 ^2_3^(Apis模块)
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
////添加Apis模块路由apis.php
//RouteServiceProvider.php
map() > $this->mapApisRoutes();
protected function mapApisRoutes()
{
    Route::prefix('apis')
        ->middleware('api')
        ->namespace("{$this->namespace}\Apis")
        ->group(base_path('routes/apis.php'));
}
 */

////
////
//// 登录模块_使用密码授权令牌方式;
/// 传递访问令牌
// 当调用 Passport 保护下的路由时，接入的 API 应用需要将访问令牌作为 Bearer 令牌放在请求头 Authorization 中。
// 使用 Guzzle HTTP 库时
//$response = $client->request('GET', '/api/user', [
// 'headers' => [
// 'Accept' => 'application/json',
// 'Authorization' => 'Bearer '.$accessToken,
// ],
//]);
////
////

//// 登录模块_使用密码授权令牌方式;

// http://project-laravel55-platform4api.test/apis/test
// NOTE：如方法禁止访问，则启用 VerifyCsrfToken.php $except 属性；
Route::post('/test', 'TestController@test');

//// 接口登录，获取令牌(密码授权令牌)
// http://project-laravel55-platform4api.test/apis/login
Route::post('/login', 'AuthenticateController@login');
//
//// 接口退出，令牌失效
// http://project-laravel55-platform4api.test/apis/logout
// 'headers' => [
// 'Accept' => 'application/json',
// 'Authorization' => 'Bearer '.$accessToken,
// ],
Route::post('/logout', 'AuthenticateController@logout');
//
//// 令牌访问测试
// http://project-laravel55-platform4api.test/apis/hello
// 'headers' => [
// 'Accept' => 'application/json',
// 'Authorization' => 'Bearer '.$accessToken,
// ],
Route::post('/hello', 'AuthenticateController@hello');
