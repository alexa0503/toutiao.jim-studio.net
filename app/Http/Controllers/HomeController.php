<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
//use Carbon;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
        $this->middleware('wechat.auth');
    }

    public function index()
    {
        return view('index');
    }
    public function lottery()
    {
        $result = ['ret' => 0, 'prize' => [], 'msg' => ''];
        $lottery = new Helper\Lottery();
        $lottery->run();
        $prize_code = $lottery->getCode();
        $prize_id = $lottery->getPrizeId();
        $result['prize']['id'] = $prize_id;

        return json_encode($result);
    }
}
