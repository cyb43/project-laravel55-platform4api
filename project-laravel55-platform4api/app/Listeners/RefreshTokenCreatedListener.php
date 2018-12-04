<?php
namespace App\Listeners;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\Events\RefreshTokenCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
/**
 * 刷新令牌事件(RefreshTokenCreated)监听器
 * Class RefreshTokenCreatedListener
 * @package App\Listeners
 * @author ^2_3^王尔贝
 */
class RefreshTokenCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 处理事件
     * Handle the event.
     *
     * @param  RefreshTokenCreated  $event
     * @return void
     */
    public function handle(RefreshTokenCreated $event)
    {
        $s_refreshTokenId = $event->refreshTokenId;
        $s_accessTokenId = $event->accessTokenId;

//        $s_info = "RefreshTokenCreated \$s_refreshTokenId='{$s_refreshTokenId}', \$s_accessTokenId='{$s_accessTokenId}'";
//        Log::info( $s_info );
    }
}