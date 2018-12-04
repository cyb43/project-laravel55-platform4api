<?php
namespace App\Listeners;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\Events\AccessTokenCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
/**
 * 发放令牌事件(AccessTokenCreated)监听器
 *
 * Class AccessTokenCreatedListener
 * @package App\Listeners
 * @author ^2_3^王尔贝
 */
class AccessTokenCreatedListener
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
     * Handle the event.
     *
     * @param  AccessTokenCreated  $event
     * @return void
     */
    public function handle(AccessTokenCreated $event)
    {
        $s_tokenId = $event->tokenId;
        $i_userId = $event->userId;
        $i_clientId = $event->clientId;

//        $s_info = "AccessTokenCreated \$s_tokenId='{$s_tokenId}',\$i_userId='{$i_userId}',\$i_clientId='{$i_clientId}'";
//        Log::info( $s_info );

        //// 查询构造器(删除过期令牌)
        $a_where = array(
            ['id', '!=', $s_tokenId],
            ['user_id', '=', $i_userId],
            ['client_id', '=', $i_clientId]
        );
        // 过期令牌
        $l_tokens = DB::table('oauth_access_tokens')->where($a_where)->get();
        foreach ( $l_tokens as $o_token ){
            // 删除过期刷新令牌
            DB::table('oauth_refresh_tokens')->where('access_token_id', $o_token->id)->delete();
        }
        // 删除过期令牌
        DB::table('oauth_access_tokens')->where($a_where)->delete();
    }
}