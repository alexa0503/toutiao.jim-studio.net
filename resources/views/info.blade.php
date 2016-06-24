@extends('layouts.app')
@section('content')
<style>
body{ background:#FFF;}
</style>

<div class="wrapper">
	<h1>{{$info->title}}</h1>
    <h2>{{$info->created_at}} 罗莱生活</h2>
    <div class="abs zanBlock">
		@if ($info->id == Request::session()->get('wechat.id'))
		<img src="{{asset('assets/images/shareBtn3.png')}}"> <span>{{$info->like_num}}</span>
		@else
		<a href="javascript:void(0);" onClick="voteThis('{{url("like",["id"=>$info->id])}}');"><img src="{{asset('assets/images/shareBtn3.png')}}"> <span>{{$info->like_num}}</span></a>
		@endif

    </div>
    <div class="videoBlock">
    	<div class="innerDiv">
        	<video class="video js-video" webkit-playsinline muted>
                <source src="{{asset('assets/images/video.mp4')}}" type="video/mp4">
            </video>
            <canvas class="canvas js-canvas" id="canvas" width="592" height="402"></canvas>
            <div class="video-timeline js-timeline">
                <div class="video-timeline-passed js-timeline-passed">
                </div>
            </div>
            <img src="{{asset('assets/images/img1.png')}}" class="abs vImg1" style="display:none;">
            <img src="{{asset('assets/images/img1.png')}}" class="abs vImg2" style="display:none;">
            <div class="abs vTxt">字幕字幕</div>
            <div class="abs dTxt">
            	<div class="innerDiv">
                	<span class="dLine1">弹幕弹幕</span>
                </div>
            </div>
        </div>
    </div>

    <p class="pBlock p1">
    	近日“{{json_decode($info->user->nick_name)}}”的一句话引发争议，“爱就一个字！”，究竟爱是不是要大胆秀出来，引起网络上的大讨论。各大媒体也加入其中，对整个过程进行了报道。结果获得绝大部分网友的支持。
    </p>

    <p class="pBlock p2">
    	借此也在世界超级草根演唱会现身，轰动现场。不少外国粉丝为了能目睹“{{json_decode($info->user->nick_name)}}”一面，中暑晕倒不少，所幸没有发生踩踏事件，为现场安保点个赞！
    </p>

    <div class="guang1">
    	<div class="innerDiv">
        	<div class="guang1Img">
            	<img src="{{asset('assets/images/img1.png')}}" width="450" style="-webkit-transform:perspective(450px) rotateY(45deg);">
            </div>
        	<img src="{{asset('assets/images/shareImg1.png')}}" class="abs guangCover">
        </div>
    </div>

    <div class="guang2">
    	<div class="innerDiv">
        	<div class="guang2Img">
            	<img src="{{asset('assets/images/img1.png')}}" width="212">
            </div>
        	<img src="{{asset('assets/images/shareImg2.png')}}" class="abs guangCover">
        </div>
    </div>

    <div class="guang3">
    	<div class="innerDiv">
        	<div class="guang3Img">
            	<img src="{{asset('assets/images/img1.png')}}" width="185" style="-webkit-transform:rotate(-2deg);">
            </div>
        	<img src="{{asset('assets/images/shareImg3.png')}}" class="abs guangCover">
        </div>
    </div>

    <div class="guang4">
    	<div class="innerDiv">
        	<div class="guang4Img">
            	<img src="{{asset('assets/images/img1.png')}}" width="180" style="-webkit-transform:rotate(-6deg);-webkit-filter:grayscale(1);">
            </div>
        	<img src="{{asset('assets/images/shareImg4.png')}}" class="abs guangCover">
        </div>
    </div>

    <div class="bottomBtns">
		@if ($info->id == Request::session()->get('wechat.id'))
		<img src="{{asset('assets/images/shareBtn1.png')}}">
		@else
		<a href="javascript:void(0);" onClick="voteThis('{{url("like",["id"=>$info->id])}}');"><img src="{{asset('assets/images/shareBtn1.png')}}"></a>
		@endif

        <a href="{{url('/')}}"><img src="{{asset('assets/images/shareBtn2.png')}}"></a>
    </div>
</div>
@endsection
@section('scripts')
<script>
var userName = '{{json_decode($info->user->nick_name)}}';
var userImg = '{{url($info->image_path)}}';
var userTitle = '{{$info->title}}';
var isIphone = navigator.userAgent.toLowerCase().indexOf('iphone') >= 0;
var isAndroid = navigator.userAgent.toLowerCase().indexOf('android') >= 0;
var ld=vd=0;

//isIphone=true;

if (isIphone) {
	var canvasVideo = new CanvasVideoPlayer({
		videoSelector: '.js-video',
		canvasSelector: '.js-canvas',
		hideVideo: true,
		audio: true,
	});
}else if(isAndroid){
	//安卓用序列帧
	}
else {
	vd = 1;
	$('canvas').hide();
	$('.video').remove();
	$('.videoBlock .innerDiv').append('<video src="{{asset('assets/images/video.mp4')}}" id="video" width="592" height="402" style="background:#000; position:absolute; left:0; top:0; z-index:5;" webkit-playsinline></video>')

	$('#video').get(0).load();
	// $('#video').get(0).play();
	/*$('#video').get(0).addEventListener('canplaythrough',function(){
	})*/

	$('#video').hide();

	$('#video').get(0).addEventListener('timeupdate',function(){
		aV=document.getElementById('canvas');
		aVctx=aV.getContext('2d');
		cV=document.getElementById('video');
		aVctx.drawImage(cV,0,0,592,402);

		$('canvas').show();
		var ct=$('#video').get(0).currentTime;

		if(ct>=5.195&&ct<=8.19){//5.16 8.13
			$('.vImg1').show();
			}
		else if(ct>=15.09&&ct<=17.22){//15.07 17.16
			$('.vImg2').show();
			}
		else{
			$('.vImg1').hide();
			$('.vImg2').hide();
			}
	})

	$('#video').on('ended',function(){
		showEnd();
		$('#video').remove();
	})

}
function showEnd(){
	//播放完毕
}
$('.videoBlock').on('click',function(){
	if(canvasVideo){
		canvasVideo.play();
	}else{
		//$('#video').width(592).height(402).get(0).play();
	}
})

var canDrawImg=false;
var cImg=new Image();
cImg.onload=function(){
canDrawImg=true;
}
cImg.src="{{asset('assets/images/img1.png')}}";

$(function(){
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
	wxShare();
});
</script>
@endsection
