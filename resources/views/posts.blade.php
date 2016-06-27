@extends('layouts.app')
@section('content')
<style>
body{ background:#FFF;}
</style>

<div class="wrapper" style="padding-bottom:74px;">
	<div class="newLine">
    	<div class="innerDiv">
        	<a href="{{url('info',['id'=>$info->id])}}">
                <div class="leftFace">
                    <img src="{{asset($info->image_path)}}">
                </div>
                <div class="rightTxt">
                    <p class="rTitle">{{$info->title}}</p>
                    <p class="rTxt" style="color:#ac0005;">“{{json_decode($info->user->nick_name)}}”竟然上头条了！</p>
                </div>
                <div class="clear"></div>
                <img src="{{asset('assets/images/firstIcon.png')}}" class="abs firstIcon">
                <div class="abs comment"><img src="{{asset('assets/images/listIcon2.png')}}"> {{$info->like_num}}</div>
            </a>
        </div>
    </div>
	<?php $i = 0; ?>
	@foreach ($posts as $post)
	<?php ++$i; ?>
	@if ($i == 3)
	<div class="listTitle">
    	八卦TOP10
    </div>
	@endif
	<div class="newLine">
    	<div class="innerDiv">
        	<a href="{{url('info',['id'=>$info->id])}}">
                <div class="leftFace">
                    <img src="{{asset($post->image_path)}}">
                </div>
                <div class="rightTxt">
                    <p class="rTitle">{{$post->title}}</p>
                    <p class="rTxt">{{$post->description}}</p>
                </div>
                <div class="clear"></div>
                <div class="abs comment"><img src="{{asset('assets/images/listIcon2.png')}}"> {{$post->like_num}}</div>
            </a>
        </div>
    </div>
	@endforeach



</div>

<div class="bottomBar"></div>
@endsection
@section('scripts')
<script>
$(function(){
	_czc.push(["_trackEvent","头条","新闻列表"]);
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
	wxData.link = '{{url("posts",["id"=>$info->id])}}';
	wxData.desc = '{{$info->title}}';
	var data = {};
	data.link = '{{url("posts",["id"=>$info->id])}}';
	data.title = '{{$info->title}}';
	wxShare(data);
});
</script>
@endsection
