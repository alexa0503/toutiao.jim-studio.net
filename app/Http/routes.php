<?php
//路由控制
Route::get('/', 'HomeController@index');
Route::any('scan', 'HomeController@scan');
Route::get('join', 'HomeController@join');
Route::post('create', 'HomeController@create');
Route::post('like/{id}', 'HomeController@like');
Route::get('info/{id}', 'HomeController@info');
Route::get('posts/{id}', 'HomeController@posts');
Route::get('wx/share', function () {
    $url = urldecode(Request::get('url'));
    $options = [
      'app_id' => env('WECHAT_APPID'),
      'secret' => env('WECHAT_SECRET'),
      'token' => env('WECHAT_TOKEN'),
    ];
    $wx = new EasyWeChat\Foundation\Application($options);
    $js = $wx->js;
    $js->setUrl($url);
    $config = json_decode($js->config(array('onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ'), false), true);
    $share = [
      'title' => env('WECHAT_SHARE_TITLE'),
      'desc' => '“'.Request::session()->get('wechat.nickname').'”'.env('WECHAT_SHARE_DESC'),
      'link' => url('/'),
      'imgUrl' => asset(env('WECHAT_SHARE_IMG')),
    ];

    return json_encode(array_merge($share, $config));
});
Route::get('logout', function () {
    Request::session()->set('wechat', null);

    return redirect('/');
});
Route::get('login', function () {
    $session = Request::session();
    $wechat_user = \App\WechatUser::find(1);
    $session->set('wechat.id', $wechat_user->id);
    $session->set('wechat.openid', $wechat_user->open_id);
    $session->set('wechat.nickname', json_decode($wechat_user->nick_name));
    $session->set('wechat.headimg', $wechat_user->head_img);

    return redirect('/');
});
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//Route::auth();
//登录登出
Route::get('cms/login', 'Auth\AuthController@getLogin');
Route::post('cms/login', 'Auth\AuthController@postLogin');
Route::get('cms/logout', 'Auth\AuthController@logout');
//屏蔽注册路由
Route::any('/register', function () {

});
//Route::get('/register', 'Auth\AuthController@getRegister');
//Route::post('/register', 'Auth\AuthController@postRegister');

//Route::get('/home', 'HomeController@index');

Route::get('/cms', 'CmsController@index');
Route::get('/cms/users', 'CmsController@users');
Route::get('/cms/account', 'CmsController@account');
Route::post('/cms/account', 'CmsController@accountPost');
Route::get('/cms/wechat', 'CmsController@wechat');
Route::get('/cms/user/logs', 'CmsController@userLogs');
Route::get('/cms/wechat/export', 'CmsController@wechatExport');
Route::get('/cms/photos', 'CmsController@photos');
Route::get('/cms/photos/export', 'CmsController@photosExport');
Route::get('/cms/sessions', 'CmsController@sessions');
Route::get('/cms/session/{id}', 'CmsController@sessions');
Route::get('/cms/infos', 'CmsController@infos');

//新闻
Route::resource('cms/post', 'PostController');
//wechat auth
Route::any('wechat/auth', 'WechatController@auth');
Route::any('wechat/callback', 'WechatController@callback');
Route::any('wechat/token', 'WechatController@token');

//初始化后台帐号
Route::get('cms/account/init', function () {
    if (0 == \App\User::count()) {
        $user = new \App\User();
        $user->name = 'admin';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('admin123');
        $user->save();
    }

    return redirect('/cms');
});
