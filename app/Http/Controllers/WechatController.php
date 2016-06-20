<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Helper;
use Carbon\Carbon;

class WechatController extends Controller
{
    public function auth(Request $request)
    {
        $callback_url = $request->getUriForPath('/wechat/callback');
        $url = 'http://ihzy.cc/common/GetWechatOpneInfo?backUrl='.$callback_url;
        return redirect($url);
    }
    public function callback(Request $request)
    {
        $openid = $request->get('openId');
        $wechat_user = \App\WechatUser::where('open_id',$openid);
        if($wechat_user->count() > 0){
            $wechat = $wechat_user->first();
        }
        else{
            $wechat = new \App\WechatUser();
            $wechat->open_id = $openid;
            $wechat->create_time = Carbon::now();
            $wechat->create_ip = $request->getClientIp();
        }
        $wechat->gender = 0;
        $wechat->head_img = $request->get('headimgurl');
        $wechat->nick_name = json_encode($request->get('nickname'));
        $wechat->country = '';
        $wechat->province = '';
        $wechat->city = '';
        //$wechat->options = $options;
        $wechat->save();
        $request->session()->set('wechat.openid', $openid);
        return redirect($request->session()->get('wechat.redirect_uri'));
    }
}
