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
