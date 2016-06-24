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
            <img src="{{asset('assets/images/playBtn.png')}}" class="playBtn" style="position:absolute; left:50%; top:50%; margin:-30px 0 0 -30px;">
            <img src="{{asset($info->image_path)}}" class="abs vImg1" style="display:none;">
            <img src="{{asset($info->image_path)}}" class="abs vImg2" style="display:none;">
            <div class="abs vTxt">我们来看下一条新闻</div>
            <div class="abs dTxt">
            	<div class="innerDiv">

                </div>
            </div>
        </div>
    </div>
    <div style="width:592px; padding:5px 0 0 0; text-align:right;">
    	<a href="javascript:void(0);" onClick="controlDm();"><img src="{{asset('assets/images/dmOn.png')}}" class="dmOn"><img src="{{asset('assets/images/dmOff.png')}}" class="dmOff" style="display:none;"></a>
    </div>

    <p class="pBlock p1" style="padding-top:40px;">
    	近日“{{json_decode($info->user->nick_name)}}”的一句话引发争议，“爱就一个字！”，究竟爱是不是要大胆秀出来，引起网络上的大讨论。各大媒体也加入其中，对整个过程进行了报道。结果获得绝大部分网友的支持。
    </p>

    <p class="pBlock p2">
    	借此也在世界超级草根演唱会现身，轰动现场。不少外国粉丝为了能目睹“{{json_decode($info->user->nick_name)}}”一面，中暑晕倒不少，所幸没有发生踩踏事件，为现场安保点个赞！
    </p>

    <div class="guang1">
    	<div class="innerDiv">
        	<div class="guang1Img">
            	<img src="{{asset($info->image_path)}}" width="450" style="-webkit-transform:perspective(450px) rotateY(45deg);">
            </div>
        	<img src="{{asset('assets/images/shareImg1.png')}}" class="abs guangCover">
        </div>
    </div>

    <div class="guang2">
    	<div class="innerDiv">
        	<div class="guang2Img">
            	<img src="{{asset($info->image_path)}}" width="212">
            </div>
        	<img src="{{asset('assets/images/shareImg2.png')}}" class="abs guangCover">
        </div>
    </div>

    <div class="guang3">
    	<div class="innerDiv">
        	<div class="guang3Img">
            	<img src="{{asset($info->image_path)}}" width="185" style="-webkit-transform:rotate(-2deg);">
            </div>
        	<img src="{{asset('assets/images/shareImg3.png')}}" class="abs guangCover">
        </div>
    </div>

    <div class="guang4">
    	<div class="innerDiv">
        	<div class="guang4Img">
            	<img src="{{asset($info->image_path)}}" width="180" style="-webkit-transform:rotate(-6deg);-webkit-filter:grayscale(1);">
            </div>
        	<img src="{{asset('assets/images/shareImg4.png')}}" class="abs guangCover">
        </div>
    </div>

    <div class="bottomBtns">
		@if ($info->id == Request::session()->get('wechat.id'))
		<img src="{{asset('assets/images/shareBtn1.png')}}">
		@else
		<a href="javascript:void(0);" onClick="voteThis('{{url("like",["id"=>$info->id])}}');"><img src="{{asset('assets/images/shareBtn1.png')}}"></a>
		<a href="{{url('/')}}"><img src="{{asset('assets/images/shareBtn2.png')}}"></a>
		@endif


    </div>
</div>
@endsection
@section('scripts')
<script>
var userName = '{{json_decode($info->user->nick_name)}}';
var userImg = '{{asset($info->image_path)}}';
var userTitle = '{{$info->title}}';
var isIphone = navigator.userAgent.toLowerCase().indexOf('iphone') >= 0;
var isAndroid = navigator.userAgent.toLowerCase().indexOf('android') >= 0;

var zimu=["我们来看下一条新闻","近日哄侃体育馆迎来了一年一度的演唱会","请看报道",'近日"'+userName+'"举办了首个个人演唱会',"现场气氛十分火爆，一度引起交通堵塞","歌迷来自世界各地，是音乐使他们联在了一起 ","现场一起高唱了《"+userTitle+"》"];
var danmu=["哈哈哈","23333","好棒！","头条","真有意思！","哈哈哈哈！","我也要上头条","好看","有意思！","好听","罗莱头条我要上！"];

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

var isPlaying=false;

$('.videoBlock').on('click',function(){
	if(canvasVideo){
		$('.playBtn').hide();
		startDanmu();
		canvasVideo.play();
		isPlaying=true;
	}else{
		//$('#video').width(592).height(402).get(0).play();
	}
})

var canDrawImg=false;
var cImg=new Image();
cImg.onload=function(){
canDrawImg=true;
}
cImg.src="{{asset($info->image_path)}}";

$(function(){
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
	var data = {};
	data.link = '{{url("posts",["id"=>$info->id])}}';
	data.title = '{{$info->title}}';
	wxShare(data);
});

var zimuTime=0;
function updateZimu(){
	if(zimuTime<=3){
		$('.vTxt').html(zimu[0]);
		}
	else if(zimuTime<=5){
		$('.vTxt').html(zimu[1]);
		}
	else if(zimuTime<=6){
		$('.vTxt').html(zimu[2]);
		}
	else if(zimuTime<=8){
		$('.vTxt').html(zimu[3]);
		}
	else if(zimuTime<=12){
		$('.vTxt').html(zimu[4]);
		}
	else if(zimuTime<=13){
		$('.vTxt').html('');
		}
	else if(zimuTime<=14){
		$('.vTxt').html(zimu[5]);
		}
	else if(zimuTime<=17){
		$('.vTxt').html(zimu[6]);
		}
	else{
		$('.vTxt').html(zimu[7]);
		}
	}

var danmuLen=danmu.length-1;
var danmuStep=0;
var danmuStyle=1;
var danmuTime;
var danmuIsOn=false;
function startDanmu(){
	if(!danmuIsOn){
		danmuIsOn=true;
		$('.dTxt .innerDiv').html('');
		$('.dTxt .innerDiv').append('<span class="dLine1">'+danmu[danmuStep]+'</span>');
		danmuStep++;
		$('.dTxt .innerDiv').append('<span class="dLine2">'+danmu[danmuStep]+'</span>');
		danmuStep++;
		$('.dTxt .innerDiv').append('<span class="dLine3">'+danmu[danmuStep]+'</span>');
		danmuStep++;
		danmuTime=setInterval(function(){danmuGo();},800);
		}
	}
function danmuGo(){
	danmuStep++;
	if(danmuStep>=danmuLen){
		danmuStep=0;
		}
	danmuStyle=danmuStep%6+1;
	$('.dTxt .innerDiv').append('<span class="dLine'+danmuStyle+'">'+danmu[danmuStep]+'</span>');
	setTimeout(function(){
		$('.dTxt .innerDiv span').eq(0).remove();
		},3000);
	}

function controlDm(){
	if(danmuIsOn){
		danmuIsOn=false;
		clearInterval(danmuTime);
		$('.dTxt').hide();
		$('.dmOn').hide();
		$('.dmOff').show();
		}
		else{
			clearInterval(danmuTime);
			danmuStep=0;
			danmuStyle=1;
			$('.dTxt').show();
			$('.dmOff').hide();
			$('.dmOn').show();
			if(isPlaying){
				startDanmu();
				}
			}
	}
</script>
@endsection
