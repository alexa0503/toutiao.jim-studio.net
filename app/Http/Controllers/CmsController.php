<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;
//use App\Http\Controllers\Controller;

class CmsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = \App\WechatUser::count();
        return view('cms/dashboard',['count' => $count]);
    }

    /**
     * 微信授权用户
     * @return mixed
     */
    public function wechat($id = null)
    {
        if( $id == null ){
            $wechat_users = DB::table('wechat_users')->paginate(20);
        }
        else{
            $wechat_users = DB::table('wechat_users')->where('id', $id)->paginate(20);
        }

        return view('cms/wechat_user',['wechat_users' => $wechat_users]);
    }
    public function infos(Request $request)
    {
        if( null != $request->input('nickname')){
            $infos = \App\Info::whereHas('user', function ($query) use($request) {
                $nick_name = json_encode($request->input('nickname'));
                $nick_name = preg_replace(['/^"/','/"$/'], ['',''], $nick_name);
                $query->where('nick_name', 'like', '%'.$nick_name.'%');
            })->paginate(100);
        }
        else{
            if( $request->get('order') == 'num' ){
                $infos = \App\Info::orderBy('like_num','DESC')->paginate(20);
            }
            elseif( $request->get('order') == 'time' ){
                $infos = \App\Info::orderBy('created_at','DESC')->paginate(20);
            }
            else{
                $infos = \App\Info::paginate(20);
            }
        }

        return view('cms/infos', ['infos'=>$infos]);
    }
    public function updateInfo(Request $request, $id)
    {
        $info = \App\Info::find($id);
        $info->like_num = $request->input('like_num');
        $info->save();
        $data = ['like_num'=>$info->like_num];
        return ['ret'=>0, 'msg'=>'', 'data'=>$data];
    }
    public function disableInfo(Request $request, $id)
    {
        $info = \App\Info::find($id);
        $info->is_activity = $info->is_activity == 0 ? 1 : 0;
        $info->save();
        $data = ['is_activity'=>$info->is_activity];
        return ['ret'=>0, 'msg'=>'', 'data'=>$data];
    }
    /**
     * 账户管理
     */
    public function users()
    {
        $users = DB::table('users')->paginate(20);
        return view('cms/users', ['users' => $users]);
    }
    /**
     * @return mixed
     * session 查看
     */
    public function sessions($id = null)
    {
        if( null == $id)
            $sessions = DB::table('sessions')->paginate(20);
        else
            $sessions = DB::table('sessions')->where('id', '=', $id)->paginate(20);
        return view('cms/sessions', ['sessions' => $sessions]);
    }
    /**
     * 导出
     */
    public function export()
    {
        $filename = 'info_'.date('ymd');
        $collection = \App\Info::all();
        $data = $collection->map(function($item){
            return [
                json_decode($item->user->nick_name),
                $item->title,
                url('uploads/'.$item->image_path),
                $item->like_num,
                $item->is_scan == 1 ? '是' : '否',
                $item->created_at,
                $item->ip_address,
            ];
        });
        Excel::create($filename, function($excel) use($data) {
            $excel->setTitle('照片');
            // Chain the setters
            $excel->setCreator('Alexa');
            // Call them separately
            $excel->setDescription('照片');
            $excel->sheet('Sheet', function($sheet) use($data) {
                $sheet->row(1, array('微信昵称','标题','图片URL','点赞数','是否扫码','创建时间','创建IP'));
                $sheet->fromArray($data, null, 'A2', false, false);
            });
        })->download('xlsx');
    }
    /**
     *账户管理
     */
    public function account()
    {
        return view('cms/account');
    }
    public function accountPost(Requests\AccountFormRequest $request)
    {
        //var_dump($request->user()->id);
        $user = \App\User::find($request->user()->id);
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return redirect('cms/logout');
        //var_dump($request->input('password'));
    }
    public function userLogs()
    {
        $logs = \App\UserLog::limit(30)->offset(0)->orderBy('create_time', 'DESC')->get();
        return view('cms/userLogs',['logs' => $logs]);
    }
}
