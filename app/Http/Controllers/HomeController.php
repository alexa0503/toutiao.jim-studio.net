<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class HomeController extends Controller
{
    private $wechat_user;
    public function __construct()
    {
        $this->middleware('web');
        $this->middleware('wechat.auth');
        $this->wechat_user = \Request::session()->get('wechat');
    }

    //首页
    public function index()
    {
        $count = \App\Info::where('id', $this->wechat_user['id'])->count();
        if ($count > 0) {
            return redirect(url('info', ['id' => $this->wechat_user['id']]));
        }

        return view('index');
    }
    public function info($id)
    {
        $info = \App\Info::find($id);
        if (null == $info) {
            return redirect('/');
        }

        return view('info', ['info' => $info]);
    }
    //生成图片信息
    public function create()
    {
        $count = \App\Info::where('id', $this->wechat_user['id'])->count();
        if ($count > 0) {
            return ['ret' => 1001, 'msg' => '您已经生成过头条了'];
        }
        $data = \Request::input('image');
        $data = str_replace('data:image/png;base64,', '', $data);
        $data = str_replace(' ', '+', $data);
        $data_image = base64_decode($data);

        $image_path = date('Ymd').uniqid().'.png';
        file_put_contents(public_path('uploads/'.$image_path), $data_image);

        $like_num = \Request::session()->get('scan.like_num') ?: 0;
        $info = new \App\Info();
        $info->id = $this->wechat_user['id'];
        $info->title = \Request::input('title');
        //$info->description = \Request::input('description');
        $info->like_num = $like_num;
        $info->image_path = $image_path;
        $info->is_scan = \Request::session()->get('scan.like_num') ? 1 : 0;
        $info->created_at = Carbon::now();
        $info->ip_address = \Request::getClientIp();
        $info->save();
        \Request::session()->set('scan.like_num', null);

        return ['ret' => 0, 'msg' => '', 'url' => url('info', ['id' => $info->id])];
    }
    //点赞
    public function like($id)
    {
        $result = ['ret' => 0, 'msg' => ''];

        return $result;
    }
    //扫码页面
    public function scan()
    {
        if (\Request::method() == 'GET') {
            return view('scan');
        } else {
            $result = ['ret' => 0, 'msg' => ''];
            $price = (int) \Request::input('price');
            $scan_like_num = 10;
            if ($price > 500 && $price <= 1000) {
                $scan_like_num = 20;
            } elseif ($price > 1000 && $price <= 2000) {
                $scan_like_num = 30;
            } elseif ($price > 2000) {
                $scan_like_num = 30;
            }
            \Request::session()->set('scan.like_num', $scan_like_num);

            return $result;
        }
    }
}
