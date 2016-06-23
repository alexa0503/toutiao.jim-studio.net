<?php
//路由控制
Route::get('/', 'HomeController@index');
Route::get('scan', 'HomeController@scan');
Route::post('create', 'HomeController@create');
Route::get('like/{id}', 'HomeController@like');
Route::get('info/{id}', 'HomeController@info');
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
      'desc' => env('WECHAT_SHARE_DESC'),
      'link' => env('APP_URL'),
      'imgUrl' => asset(env('WECHAT_SHARE_IMG')),
    ];

    return json_encode(array_merge($share, $config));
});
Route::get('logout', function () {
    Request::session()->set('wechat.openid', null);

    return redirect('/');
});
Route::get('login', function () {
    Request::session()->set('wechat.openid', 'o2-sBj0oOQJCIq6yR7I9HtrqxZcY');

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

//抽奖部分管理
Route::get('/cms/lotteries', 'CmsLotteryController@lotteries');
Route::get('/cms/prizes', 'CmsLotteryController@prizes');
Route::post('/cms/prize/update/{id}', 'CmsLotteryController@prizeUpdate');//
Route::get('/cms/lottery/configs', 'CmsLotteryController@lotteryConfigs');
Route::post('cms/lottery/config/update/{id}', 'CmsLotteryController@lotteryConfigUpdate');
Route::post('cms/lottery/config/add', 'CmsLotteryController@lotteryConfigAdd');
Route::get('cms/prize/configs', 'CmsLotteryController@prizeConfigs');
Route::get('cms/prize/config/update/{id}', 'CmsLotteryController@prizeConfig');
Route::post('cms/prize/config/update/{id}', 'CmsLotteryController@prizeConfigUpdate');
Route::get('cms/prize/config/add', 'CmsLotteryController@prizeConfigAdd');
Route::post('cms/prize/config/add', 'CmsLotteryController@prizeConfigStore');
Route::get('cms/prize/codes', 'CmsLotteryController@prizeCodes');
//wechat auth
Route::any('/wechat/auth', 'WechatController@auth');
Route::any('/wechat/callback', 'WechatController@callback');

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
