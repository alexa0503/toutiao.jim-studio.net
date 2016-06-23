@extends('layouts.app')
@section('content')
<div class="pageOuter">
	<div class="page page1">
    	<div class="h832">
        	<div class="innerDiv">
            	<div class="bgImg page1Img1"></div>
                <input type="file" class="fileBtn" id="uploadBtn" />
            </div>
        </div>
    </div>

    <div class="page page2" style="display:none;">
    	<div class="h832">
        	<div class="innerDiv">
            	<div class="preImg" id="preImg">
                    <div class="innerDiv">
                        <img src="" class="abs upBtnImg upLoadImg" style="display:none;" id="upBtnImg">
                        <img src="" class="abs upLoadImg" style="display:none;" id="preview"/>
                        <img src="" class="abs upLoadImg" style="display:none;" id="localImag"/>
                    </div>
                </div>
                <div class="bgImg page2Img1"></div>
                <div id="touchBlock"></div>
                <a href="javascript:void(0);" class="abs btn1" onClick="backPage1();"><img src="{{asset('assets/images/btn1.png')}}"></a>
                <a href="javascript:void(0);" class="abs btn2" onClick="goPage3();"><img src="{{asset('assets/images/btn2.png')}}"></a>
            </div>
        </div>
    </div>

    <div class="page page3" style="display:none;">
    	<div class="h832">
        	<div class="innerDiv">
                <div class="bgImg page3Img1"></div>
                <input type="text" class="titleTxt" maxlength="10">
                <a href="javascript:void(0);" class="abs btn1" onClick="backPage2();"><img src="{{asset('assets/images/btn1.png')}}"></a>
                <a href="javascript:void(0);" class="abs btn2" onClick="goPage4('{{url("create")}}');"><img src="{{asset('assets/images/btn3.png')}}"></a>
            </div>
        </div>
    </div>

    <div class="page page4" style="display:none;">
    	<div class="h832">
        	<div class="innerDiv">
                <div class="bgImg page4Img1"></div>
                <div class="ajaxLoading"></div>
            </div>
        </div>
    </div>

    <div class="page page5" style="display:none;">
    	<div class="h832">
        	<div class="innerDiv">
                <div class="bgImg page5Img1"></div>
            </div>
        </div>
    </div>
</div>

<canvas id="guoduCanvas" style="display:none;"></canvas>
<img src="" id="endImg" style="display:none;">

@endsection
@section('scripts')
<script>
var wHeight;
$(function(){
	wHeight=$(window).height();
	if(wHeight>=832){
		$('body').on('touchmove', function (e) {
			e.preventDefault();
		});
	}
	if(wHeight<832){
		wHeight=832;
	}
	$('.pageOuter,.page').height(wHeight);
	$('.h832').css('padding-top',(wHeight-832)/2+'px');
	btnSelImg();

	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
	wxShare();
});
</script>
@endsection
