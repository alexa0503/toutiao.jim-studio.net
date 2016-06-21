@extends('layouts.app')
@section('style')
<style>
	@-ms-viewport { width:device-width; }
	@media only screen and (min-device-width:800px) { html { overflow:hidden; } }
	html { height:100%; }
	body { height:100%; overflow:hidden; margin:0; padding:0; }
</style>
@endsection
@section('headerScripts')
<script src="{{asset('assets/js/jquery-1.9.1-mod.js')}}"></script>
<script src="{{asset('assets/js/jquery.imgpreload-mod.js')}}"></script>
<script src="{{asset('assets/js/touch.js')}}"></script>
<script src="{{asset('assets/pano.js')}}"></script>
<script src="{{asset('assets/js/common-mod.js')}}"></script>
@endsection
@section('content')
<div class="pageOuter">
	<div class="page0 page">
    	<div class="h832">
        	<div class="innerDiv">
				<div class="page0Bg bgImg"></div>
            	<div class="page0Img1 bgImg" style="display:none;"></div>
                <div class="page0Img2 bgImg" style="display:none;"></div>
                <img src="{{asset('assets/images/loadingImg.png')}}" class="abs loadingImg" style="display:none;">
                <div class="loadTxt abs" style="display:none;">LOADING <span>0</span>%</div>

                <div class="page0Img4 bgImg" style="display:none;"></div>
                <a href="javascript:void(0);" class="abs indexBtn1" onClick="indexStartGame();" style="display:none;"><img src="{{asset('assets/images/space.gif')}}" width="250" height="52"></a>
                <a href="javascript:void(0);" class="abs indexBtn2" onClick="showRule();" style="display:none;"><img src="{{asset('assets/images/space.gif')}}" width="250" height="52"></a>
                <a href="javascript:void(0);" class="abs indexBtn3" onClick="showMyAward({{$prize_id}},'{{$prize_code}}');" style="display:none;"><img src="{{asset('assets/images/space.gif')}}" width="250" height="52"></a>

                <div class="page0Img3 bgImg" style="display:none;"></div>
            </div>
        </div>
    </div>

    <div class="pageRule page" style="display:none;">
    	<div class="h832">
        	<div class="innerDiv">
				<div class="page0RuleBg bgImg"></div>
            	<div class="abs ruleBlock">
                	<img src="{{asset('assets/images/ruleImg.png')}}">
                </div>
                <a href="javascript:void(0);" class="abs indexBtn4" onClick="closeRule();"><img src="{{asset('assets/images/space.gif')}}" width="103" height="103"></a>
            </div>
        </div>
    </div>

    <div class="pageAward1 page" style="display:none;">
    	<div class="h832">
        	<div class="innerDiv">
				<div class="page0Award page0Award1 bgImg"></div>
                <img src="{{asset('assets/images/page0AwardQc.png')}}" class="bgImg">
                <a href="javascript:void(0);" class="abs indexBtn6" onClick="showShareNote();"><img src="{{asset('assets/images/space.gif')}}" width="252" height="52"></a>
                <a href="javascript:void(0);" class="abs indexBtn5" onClick="closeAward();"><img src="{{asset('assets/images/space.gif')}}" width="103" height="103"></a>
            </div>
        </div>
    </div>

    <div class="pageAward2 page" style="display:none;">
    	<div class="h832">
        	<div class="innerDiv">
				<div class="page0Award page0Award2 bgImg"></div>
                <img src="{{asset('assets/images/page0AwardQc.png')}}" class="bgImg">
                <div class="abs a3Numb">兑换码: <span id="prize_code_2"></span></div>
                <a href="javascript:void(0);" class="abs indexBtn6b" onClick="showShareNote();"><img src="{{asset('assets/images/space.gif')}}" width="252" height="52"></a>
                <a href="javascript:void(0);" class="abs indexBtn5" onClick="closeAward();"><img src="{{asset('assets/images/space.gif')}}" width="103" height="103"></a>
            </div>
        </div>
    </div>

    <div class="pageAward3 page" style="display:none;">
    	<div class="h832">
        	<div class="innerDiv">
				<div class="page0Award page0Award3 bgImg"></div>
                <img src="{{asset('assets/images/page0AwardQc.png')}}" class="bgImg">
                <div class="abs a3Numb">兑换码: <span id="prize_code_3"></span></div>
                <a href="javascript:void(0);" class="abs indexBtn6b" onClick="showShareNote();"><img src="{{asset('assets/images/space.gif')}}" width="252" height="52"></a>
                <a href="javascript:void(0);" class="abs indexBtn5" onClick="closeAward();"><img src="{{asset('assets/images/space.gif')}}" width="103" height="103"></a>
            </div>
        </div>
    </div>

    <div class="pageAward0 page" style="display:none;">
    	<div class="h832">
        	<div class="innerDiv">
				<div class="page0Award page0Award0 bgImg" onClick="closeAward();"></div>
            </div>
        </div>
    </div>

    <div class="page0Img5 bgImg" style="display:none;"></div>

    <div class="page1 page" style="display:none;">
    	<div class="h832">
        	<div class="innerDiv">
				<div class="page1Img1" id="page1Img1" style="display:none;"></div>
                <div class="page1Img2" id="page1Img2" style="display:none;"></div>
                <div id="pano" class="bgImg" style="width:640px;height:1039px; position:absolute; left:50%; margin-left:-320px; display:none;">
                    <noscript><table style="width:100%;height:100%;"><tr style="vertical-align:middle;"><td><div style="text-align:center;">ERROR:<br/><br/>Javascript not activated<br/><br/></div></td></tr></table></noscript>
                    <script>
                        embedpano({swf: "{{asset('assets/krpano.swf')}}", xml: "{{asset('assets/tour.xml')}}", target: "pano", html5: "prefer", initvars: {design: "flat"}, passQueryParameters: !0});
                    </script>
                </div>

                <div class="page1Img3 bgImg"></div>
                <div class="page1Img0 bgImg"></div>

                <div class="page1Img4 bgImg" style="display:none;"></div>
                <div class="page1Img5 bgImg" style="display:none;"></div>
                <div class="page1Img5b bgImg" style="display:none;"></div>

                <div class="page1Img6 bgImg" style="display:none;"></div>
                <div class="page1Img7 bgImg" style="display:none;"></div>
            </div>
        </div>
    </div>

    <div class="page2 page" style="display:none;">
    	<div class="h832">
        	<div class="innerDiv">
				<div class="page2Img1 bgImg" style="overflow:visible;">
                	<img src="{{asset('assets/images/page2Img1.jpg')}}" class="abs page2Img1Img">
                </div>
                <img src="{{asset('assets/images/page2Img2.png')}}" class="abs page2Img2" onClick="goGame('{{url("game")}}');" style="display:none;">
            </div>
        </div>
    </div>
</div>

<img src="{{asset('assets/images/logo.png')}}" class="abs logo">
<a href="javascript:void(0);" class="abs musicBtn"><img src="{{asset('assets/images/musicBtn.png')}}"></a>

<img src="{{asset('assets/images/shareBg.png')}}" class="shareBg" style="display:none;" onClick="closeShare();">
@endsection
@section('scripts')
<script src="{{asset('assets/js/jquery-1.9.1.min.js')}}"></script>
<script>
$j(document).ready(function(){
    loadingImg();
});
$(document).ready(function() {
	wxShare();
});
</script>
@endsection
