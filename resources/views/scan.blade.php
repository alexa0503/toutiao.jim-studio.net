@extends('layouts.app')
@section('content')
<div class="pageOuter">
	<div class="page pageShop">
    	<div class="h832">
        	<div class="innerDiv">
            	<div class="bgImg pageShopImg1"></div>
                <input type="text" class="shopTxt" maxlength="30">
                <a href="javascript:void(0);" class="abs btn1"><img src="{{asset('assets/images/btn5.png')}}"></a>
                <a href="javascript:void(0);" class="abs btn2" onClick="shopSubmit('{{url("scan")}}');"><img src="{{asset('assets/images/btn6.png')}}"></a>
            </div>
        </div>
    </div>
</div>
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
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
	wxShare();
});
</script>
@endsection
