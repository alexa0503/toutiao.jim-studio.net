@extends('layouts.app')
@section('content')<style>
body{ background:#eee9c6;}
</style>

<div class="wrapper">
	<img src="{{asset('assets/images/listTitle1.png')}}">

    <div class="rule">
    	<img src="{{asset('assets/images/ruleImg.png')}}" style="float:left; padding:0 20px 10px 0;">活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则活动规则
    </div>

    <img src="{{asset('assets/images/listTitle2.png')}}">

    <div class="faceBlock">
    	<div class="innerDiv">
        	<div class="faceOuter">
			@foreach ($infos as $info)
			<a href="{{url('info',['id'=>$info[0]])}}"><img src="{{$info[1]}}"></a>
			@endforeach
			<img src="{{asset('assets/images/face01.png')}}">
			<img src="{{asset('assets/images/face02.png')}}">
			<img src="{{asset('assets/images/face03.png')}}">
			<img src="{{asset('assets/images/face04.png')}}">
			<img src="{{asset('assets/images/face05.png')}}">
			<img src="{{asset('assets/images/face06.png')}}">
			<img src="{{asset('assets/images/face07.png')}}">
			<img src="{{asset('assets/images/face08.png')}}">
			<img src="{{asset('assets/images/face09.png')}}">
			<img src="{{asset('assets/images/face10.png')}}">
			<img src="{{asset('assets/images/face11.png')}}">
			<img src="{{asset('assets/images/face12.png')}}">
			<img src="{{asset('assets/images/face13.png')}}">
			<img src="{{asset('assets/images/face14.png')}}">
			<img src="{{asset('assets/images/face15.png')}}">
			<img src="{{asset('assets/images/face16.png')}}">
			<img src="{{asset('assets/images/face17.png')}}">
			<img src="{{asset('assets/images/face18.png')}}">
            </div>
            <img src="{{asset('assets/images/listFaceImg1.png')}}" class="abs listFaceImg1">
            <img src="{{asset('assets/images/listFaceImg2.png')}}" class="abs listFaceImg2">
            <img src="{{asset('assets/images/listFaceImg3.png')}}" class="abs listFaceImg3">
        </div>
    </div>

    <div class="ruleBtns">
		@if ($count > 0)
		<a href="{{url('join')}}"><img src="{{asset('assets/images/btnIndex2.png')}}"></a>
		@else
		<a href="{{url('join')}}"><img src="{{asset('assets/images/btnIndex1.png')}}"></a>
		@endif
    </div>
</div>

@endsection
@section('scripts')
<script>
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
