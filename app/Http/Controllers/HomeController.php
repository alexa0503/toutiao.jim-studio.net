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
        $count = \App\Info::where('id', $this->wechat_user['id'])->count();//
        $collection = \App\Info::with('user')
            //->where('id', '!=', $this->wechat_user['id'])
            ->orderBy('created_at', 'DESC')
            ->take(18)
            ->get();
        $infos = $collection->map(function ($item) {
            return [$item->id, $item->user->head_img];
        });
        $count2 = count($infos);
        if ($count2 < 18) {
            for ($i = 1; $i < 19 - $count2; ++$i) {
                if ($i < 10) {
                    $infos[] = [1, asset('assets/images/face0'.$i.'.png')];
                } else {
                    $infos[] = [1, asset('assets/images/face'.$i.'.png')];
                }
            }
        }
        //var_dump($head_img);

        return view('index', ['count' => $count, 'infos' => $infos]);
    }
    public function join()
    {
        $count = \App\Info::where('id', $this->wechat_user['id'])->count();
        if ($count > 0) {
            return redirect(url('info', ['id' => $this->wechat_user['id']]));
        }

        return view('join');
    }
    public function info($id)
    {
        $info = \App\Info::find($id);
        if (null == $info) {
            return redirect('/');
        }
        $session = \Request::session();
        if (null != $session->get('scan.like_num') && $info->is_scan == 0) {
            $info->like_num += $session->get('scan.like_num');
            $info->is_scan = 1;
            $info->save();
        }

        return view('info', ['info' => $info]);
    }
    public function posts($id)
    {
        $info = \App\Info::find($id);
        $collection = \App\Post::all();
        $random = $collection->random(6);
        $posts = $random->all();

        return view('posts', ['posts' => $posts, 'info' => $info]);
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
        if (false == file_exists(public_path('uploads/'.date('Ymd')))) {
            @mkdir(public_path('uploads/'.date('Ymd')), 0777);
        }
        $image_path = 'uploads/'.date('Ymd').'/'.uniqid().'.png';
        file_put_contents(public_path($image_path), $data_image);

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

        return ['ret' => 0, 'msg' => '', 'title' => $info->title, 'url' => url('posts', ['id' => $this->wechat_user['id']])];
    }
    //点赞
    public function like($id)
    {
        $result = ['ret' => 0, 'msg' => ''];
        $user_id = \Request::session()->get('wechat.id');
        $count = \App\LikeLog::where('info_id', $id)->where('voter_id', $user_id)->count();
        if ($user_id == $id) {
            $result = ['ret' => 1001, 'msg' => '不能给自己点赞喔'];
        } elseif ($count == 0) {
            $result['like_num'] = \DB::transaction(function () use ($id, $user_id) {
                $info = \App\Info::find($id);
                $info->like_num += 1;
                $info->save();
                $log = new \App\LikeLog();
                $log->info_id = $id;
                $log->voter_id = $user_id;
                $log->created_at = Carbon::now();
                $log->ip_address = \Request::getClientIp();
                $log->save();

                return $info->like_num;
            });
        } else {
            $result = ['ret' => 1002, 'msg' => '您已经点过赞了'];
        }

        return $result;
    }
    //扫码页面
    public function scan()
    {
        if (\Request::method() == 'GET') {
            return view('scan');
        } else {
            $result = ['ret' => 0, 'msg' => '', 'url' => url('info', ['id' => \Request::session()->get('wechat.id')])];
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
