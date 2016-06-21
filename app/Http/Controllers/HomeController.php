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
        return view('index');
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
