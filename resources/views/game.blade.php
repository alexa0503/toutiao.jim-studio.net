@extends('layouts.app')
@section('style')
<style>
body{ background:#000;}
</style>
@endsection
@section('content')

<div class="pageOuter">

    <div class="pageGame1 page">
    	<div class="h832">
            <div class="innerDiv">
                <div class="pageGame11 bgImg"></div>
                <div class="game1Img3 bgImg"></div>
                <div class="game1Black bgImg"></div>
                <div class="game1Img1 bgImg" style="display:none;"></div>
                <div class="game1Img31 bgImg" style="display:none;"></div>
                <div class="game1Img32 bgImg" style="display:none;"></div>
                <div class="game1Img33 bgImg" style="display:none;"></div>
                <div class="game1Img34 bgImg" style="display:none;"></div>
                <div class="game1Img35 bgImg" style="display:none;"></div>
                <div class="game1Img36 bgImg" style="display:none;"></div>
                <img src="{{asset('assets/images/game1Img2.png')}}" class="abs game1Img2" style="display:none;">
                <img src="{{asset('assets/images/game1Img4.png')}}" class="abs game1Img4" style="display:none;">
                <div class="game1Img5 bgImg" style="display:none;"></div>
            </div>
        </div>
    </div>

    <div class="page0 page">
    	<div class="h832">
        	<div class="innerDiv">
                <img src="{{asset('assets/images/loadingImg.png')}}" class="abs loadingImg">
                <div class="loadTxt abs">LOADING <span>0</span>%</div>
            </div>
        </div>
    </div>

    <div class="pageGame2 page" style="display:none;">
    	<div class="h832">
            <div class="innerDiv">
            	<div class="game2A0">
                    <div class="game2Img1 bgImg"></div>
                    <img src="{{asset('assets/images/game2Img2.png')}}" class="abs game2Img2">
                    <a href="javascript:void(0);" class="abs game2Btn1" onClick="game2Act1();"><img src="{{asset('assets/images/space.gif')}}" width="66" height="44"></a>
                </div>
                <div class="game2A1" style="display:none;">
                    <div class="game2Img3 bgImg"></div>
                    <img src="{{asset('assets/images/game2Img4.png')}}" class="abs game2Img4">
                    <div class="game2Img5 bgImg"></div>
                    <div class="game2Img6 bgImg"></div>
                    <div class="game2Img7 bgImg" style="display:none;"></div>
                    <img src="{{asset('assets/images/game2Img8.png')}}" class="abs game2Img8" style="display:none;">
                </div>
                <div class="game2A2" style="display:none;">
                    <div class="game3Img1 bgImg"></div>
                    <div class="game3Img2 bgImg"></div>
                    <div class="game3Img3 bgImg" style="display:none;"></div>
                    <img src="{{asset('assets/images/game1Img4b.png')}}" class="abs game3Img3a" style="display:none;">
                </div>
            </div>
        </div>
    </div>

    <div class="pageGame3 page" style="display:none;">
    	<div class="h832">
            <div class="innerDiv">
            	<div class="game3Img4 bgImg"></div>
                <div class="abs pb p1b" rel="p1">
                	<img src="{{asset('assets/images/p4.png')}}" class="pg">
                </div>
                <div class="abs pb p2b" rel="p2">
                	<img src="{{asset('assets/images/p8.png')}}" class="pg">
                </div>
                <div class="abs pb p3b" rel="p3">
                	<img src="{{asset('assets/images/p2.png')}}" class="pg">
                </div>
                <div class="abs pb p4b" rel="p4">
                	<img src="{{asset('assets/images/p5.png')}}" class="pg">
                </div>
                <div class="abs pb p5b" rel="p5">
                	<img src="{{asset('assets/images/p1.png')}}" class="pg">
                </div>
                <div class="abs pb p6b" rel="p6">
                	<img src="{{asset('assets/images/p7.png')}}" class="pg">
                </div>
                <div class="abs pb p7b" rel="p7">
                	<img src="{{asset('assets/images/p6.png')}}" class="pg">
                </div>
                <div class="abs pb p8b" rel="p8">
                	<img src="{{asset('assets/images/p3.png')}}" class="pg">
                </div>
                <img src="{{asset('assets/images/game3Img5.png')}}" class="abs game3Img5">
                <div class="game3Img6 bgImg" style="display:none;"></div>
            </div>
        </div>
    </div>

    <div class="pageGame4 page" style="display:none;">
    	<div class="h832">
            <div class="innerDiv">
            	<div class="game3A1">
                	<div class="game4Img1 bgImg"></div>
                	<img src="{{asset('assets/images/game4Img2.png')}}" class="abs game4Img2">
                </div>
                <div class="game3A2" style="display:none;">
                	<div class="game4Img3 bgImg"></div>
                	<div class="game4Img4 bgImg"></div>
                </div>
                <div class="game3A3" style="display:none;">
                	<div class="game5Img1 bgImg"></div>
					<div class="game5Img3 bgImg"></div>
                    <img src="{{asset('assets/images/game1Img4b.png')}}" class="abs game5Img2b">
					<div class="game5Img2 bgImg"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="pageGame5 page" style="display:none;">
    	<div class="h832">
            <div class="innerDiv">
            	<div class="game6Img1 bgImg"></div>
                <img src="{{asset('assets/images/game6Img1b.png')}}" class="abs game6Img1b">

                <div class="game4A1">
                    <div class="game6Img2 bgImg" style="display:none;"></div>
                    <img src="{{asset('assets/images/game6Img3.png')}}" class="abs game6Img3" style="display:none;">
                    <img src="{{asset('assets/images/game6Img6.png')}}" class="abs game6Img6" style="display:none;">
                    <img src="{{asset('assets/images/game6Img4.png')}}" class="abs game6Img4" style="display:none;">
                    <img src="{{asset('assets/images/game6Img5.png')}}" class="abs game6Img5" style="display:none;">
                    <div class="abs we" style="display:none;"></div>
                    <div class="abs game6Img5b" style="display:none;" id="game6Img5b"></div>
                </div>

                <div class="game4A2" style="display:none;">
                    <div class="game7Img1 bgImg"></div>
                    <div class="game7Img3 bgImg"></div>
                    <img src="{{asset('assets/images/game1Img4b.png')}}" class="abs game7Img4" style="display:none;">
                    <div class="game7Img2 bgImg"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="pageGame6 page" style="display:none;">
    	<div class="h832">
            <div class="innerDiv">
            	<div class="game6A1">
                    <div class="game8Img1 bgImg"></div>
                    <div class="game8Img2 bgImg" style="display:none;"></div>
                </div>

                <div class="game6A2" style="display:none;">
                    <div class="game8Img3 bgImg"></div>
                    <img src="{{asset('assets/images/game8Img31.png')}}" class="abs game8Init game8Img31" rel="game8Img31">
                    <img src="{{asset('assets/images/game8Img32.png')}}" class="abs game8Init game8Img32" rel="game8Img32">
                    <img src="{{asset('assets/images/game8Img33.png')}}" class="abs game8Init game8Img33" rel="game8Img33">
                    <div class="abs game8Box"></div>
                </div>

                <div class="game6A3" style="display:none;">
                	<div class="game8Img4 bgImg"></div>
                    <div class="game8Img5 bgImg"></div>
                    <div class="game8Img6 bgImg"></div>
                    <a href="javascript:void(0);" onClick="goRes('{{asset("lottery")}}');" class="abs endBottle"><img src="{{asset('assets/images/space.gif')}}" width="100" height="305"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="pageGame7 page" style="display:none;">
    	<div class="h832">
            <div class="innerDiv">
            	<div class="getAward1" style="display:none;">
                    <div class="awardYes1 bgImg"></div>
                    <img src="{{asset('assets/images/qcYes.png')}}" class="bgImg">
                    <a href="javascript:void(0);" onClick="showShareNote();" class="abs endBtn1"><img src="{{asset('assets/images/space.gif')}}" width="250" height="51"></a>
                </div>

                <div class="getAward2" style="display:none;">
                    <div class="awardYes2 bgImg"></div>
                    <img src="{{asset('assets/images/qcYes.png')}}" class="bgImg">
                    <div class="abs a2Numb">兑换码: <span id="prize_code_2"></span></div>
                    <a href="javascript:void(0);" onClick="showShareNote();" class="abs endBtn1"><img src="{{asset('assets/images/space.gif')}}" width="250" height="51"></a>
                </div>

                <div class="getAward3" style="display:none;">
                    <div class="awardYes3 bgImg"></div>
                    <img src="{{asset('assets/images/qcYes.png')}}" class="bgImg">
                    <div class="abs a3Numb">兑换码: <span id="prize_code_3"></span></div>
                    <a href="javascript:void(0);" onClick="showShareNote();" class="abs endBtn1"><img src="{{asset('assets/images/space.gif')}}" width="250" height="51"></a>
                </div>

                <div class="getAward0" style="display:none;">
                    <div class="awardNo bgImg"></div>
                    <img src="{{asset('assets/images/qcNo.png')}}" class="bgImg">
                    <a href="javascript:void(0);" onClick="showShareNote();" class="abs endBtn2"><img src="{{asset('assets/images/space.gif')}}" width="250" height="51"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="pageGame8 page" style="display:none;">
    	<div class="h832">
            <div class="innerDiv">
            	<div class="gameOver bgImg"></div>
				<a href="javascript:void(0);" onClick="palyAgain();" class="abs endBtn3"><img src="{{asset('assets/images/space.gif')}}" width="250" height="51"></a>
            </div>
        </div>
    </div>
</div>

<img src="{{asset('assets/images/logo.png')}}" class="abs logo">
<a href="javascript:void(0);" class="abs musicBtn"><img src="{{asset('assets/images/musicBtn.png')}}"></a>

<div class="abs colddownTime" style="display:none;">03:00</div>

<img src="{{asset('assets/images/shareBg.png')}}" class="shareBg" style="display:none;" onClick="closeShare();">
@endsection
@section('scripts')
<script src="{{asset('assets/js/jquery-1.9.1.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.ui.touch-punch.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.imgpreload.js')}}"></script>
<script src="{{asset('assets/js/touch.js')}}"></script>
<script src="{{asset('assets/js/shake.js')}}"></script>
<script src="{{asset('assets/js/common.js')}}"></script>
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    loadingGame();
    wxShare();
	//testDarg();
});
</script>
@endsection
