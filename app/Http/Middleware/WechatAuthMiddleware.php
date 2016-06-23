<?php

namespace App\Http\Middleware;

use Closure;

class WechatAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $session = $request->session();
        $session->set('wechat.redirect_uri', $request->getUri());
        if (env('APP_ENV') == 'local' || $request->getClientIp() == '127.0.0.1') {
            $wechat_user = \App\WechatUser::find(1);
            $session->set('wechat.id', $wechat_user->id);
            $session->set('wechat.openid', $wechat_user->open_id);
            $session->set('wechat.nickname', json_decode($wechat_user->nick_name));
            $session->set('wechat.headimg', $wechat_user->head_img);
        }
        if (null == $session->get('wechat.openid')) {
            return redirect('/wechat/auth');
        }

        return $next($request);
    }
}
