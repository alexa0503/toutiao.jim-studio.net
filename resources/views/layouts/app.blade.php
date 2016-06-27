<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{env("PAGE_TITLE")}}</title>
    <link rel="stylesheet" href="{{asset('assets/css/common.css')}}">
    <script>
        var wxData = {};
        var wxShareUrl = '{{url("wx/share")}}';
    </script>
    <script src="{{asset('assets/js/jquery-1.9.1.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.imgpreload.js')}}"></script>
    <script src="{{asset('assets/js/exif.js')}}"></script>
    <script src="{{asset('assets/js/hammer.js')}}"></script>
    <script src="{{asset('assets/js/jquery.transit.min.js')}}"></script>
    <script src="{{asset('assets/js/canvas-video-player.js')}}"></script>
    <script src="{{asset('assets/js/common.js')}}"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="{{asset('assets/js/wx.js')}}"></script>
    <!--移动端版本兼容 -->
    <script type="text/javascript">
        var phoneWidth = parseInt(window.screen.width);
        var phoneScale = phoneWidth / 640;
        var ua = navigator.userAgent;
        if (/Android (\d+\.\d+)/.test(ua)) {
            var version = parseFloat(RegExp.$1);
            if (version > 2.3) {
                document.write('<meta name="viewport" content="width=640, minimum-scale = ' + phoneScale + ', maximum-scale = ' + phoneScale + ', target-densitydpi=device-dpi , user-scalable=no">');
            } else {
                document.write('<meta name="viewport" content="width=640, target-densitydpi=device-dpi , user-scalable=no">');
            }
        } else {
            document.write('<meta name="viewport" content="width=640, minimum-scale=0.1, maximum-scale=1.0 , user-scalable=no" />');
        }
    </script>
    <!--移动端版本兼容 end -->
</head>
<body>
<div style="display:none;">
	<script src="http://s4.cnzz.com/z_stat.php?id=1259710222&web_id=1259710222" language="JavaScript"></script>
</div>

@yield('content')
@yield('scripts')
</body>
</html>
