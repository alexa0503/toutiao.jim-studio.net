<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Helper;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
        $this->middleware('wechat.auth');
    }

    public function index()
    {
        $wechat_user = \App\WechatUser::where('open_id', \Request::session()->get('wechat.openid'))->first();
        $lottery = \App\Lottery::where('user_id', $wechat_user->id)->first();

        if( $lottery != null){
            $prize_id = $lottery->prize_id;
        }
        else{
            $prize_id = 0;
        }
        return view('index', ['prize_id'=>$prize_id]);
    }
    public function game()
    {
        return view('game');
    }
    public function lottery()
    {
        $result = ['ret' => 0, 'prize' => [], 'msg' => ''];
        $lottery = new Helper\Lottery();
        $lottery->run();
        $prize_code = $lottery->getCode();
        $prize_id = $lottery->getPrizeId();
        $result['prize']['id'] = $prize_id;
        $result['prize']['code'] = $prize_code;

        return json_encode($result);
    }
}
