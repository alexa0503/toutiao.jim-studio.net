//找到url中匹配的字符串
function findInUrl(str) {
    url = location.href;
    return url.indexOf(str) == -1 ? false : true;
}
//获取url参数
function queryString(key) {
    return (document.location.search.match(new RegExp("(?:^\\?|&)" + key + "=(.*?)(?=&|$j)")) || ['', null])[1];
}

//产生指定范围的随机数
function randomNumb(minNumb, maxNumb) {
    var rn = Math.round(Math.random() * (maxNumb - minNumb) + minNumb);
    return rn;
}

var wHeight;
$j(document).ready(function() {
    wHeight = $j(window).height();
    if (wHeight < 832) {
        wHeight = 832;
    }
    $j('.pageOuter').height(wHeight);
    $j('.page').height(wHeight);

    $j('.h832').css('padding-top', (wHeight - 832) / 2 + 'px');
});

function loadingImg() {
    var images = [];
    images.push("assets/images/bg.jpg");
    images.push("assets/images/page0Img1.png");
    images.push("assets/images/page0Img2.png");

    /*图片预加载*/
    var imgNum = 0;
    $j.imgpreload(images, {
        each: function() {
            var status = $j(this).data('loaded') ? 'success' : 'error';
            if (status == "success") {}
        },
        all: function() {
            goPage0();
        }
    });
}

function goPage0() {
    $j('.page0Bg').show();
    $j('.page0Img1').addClass('page0Img1Act').show();
    $j('.page0Img2').addClass('page0Img2Act').show();
    $j('.loadingImg').show();
    $j('.loadTxt').show();
    loadingPage1();
}

function loadingPage1() {
    var images = [];
    images.push("assets/images/page0Img3.png");
    images.push("assets/images/page0Img4.png");
    images.push("assets/images/page0Img5.png");
    images.push("assets/images/5th_ave_1.jpg");
    images.push("assets/images/5th_ave_2.jpg");
    images.push("assets/images/5th_ave_3.jpg");
    images.push("assets/images/5th_ave_4.jpg");
    images.push("assets/images/5th_ave_5.jpg");
    images.push("assets/images/5th_ave_6.jpg");
    images.push("assets/images/preview.jpg");

    images.push("assets/images/page0RuleBg.png");

    images.push("assets/images/page1Img3.png");
    images.push("assets/images/page1Img4.png");
    images.push("assets/images/page1Img5.png");
    images.push("assets/images/page1Img5b.png");
    images.push("assets/images/page1Img6.png");
    images.push("assets/images/page1Img7.png");
    images.push("assets/images/page2Img1.jpg");

    /*图片预加载*/
    var imgNum = 0;
    $j.imgpreload(images, {
        each: function() {
            var status = $j(this).data('loaded') ? 'success' : 'error';
            if (status == "success") {
                var v = (parseFloat(++imgNum) / images.length).toFixed(2);
                $j(".loadTxt span").html(Math.round(v * 100));
            }
        },
        all: function() {
            goPage1();
        }
    });
}

function goPage1() {
    //$j('.page0Img1').removeClass('page0Img1Act').fadeOut(500);
    //$j('.page0Img2').removeClass('page0Img2Act').fadeOut(500);
    $j('.loadingImg').hide();
    $j('.loadTxt').hide();
    $j('.page0Img4').fadeIn(500);
    $j('.indexBtn1,.indexBtn2,.indexBtn3').show();
    /*setTimeout(function(){
    	$j('.page0Img4').addClass('page0Img4Act').show();
    	$j('.page0').fadeOut(500);
    	setTimeout(function(){
    		$j('body').css('background','#FFF');
    		$j('.page1').show();
    		hidePanoLayerEle(['compass1']);
    		$j('#pano').fadeIn(1000);
    		$j('.page1Img0').fadeOut(1500);
    		setTimeout(function(){
    			$j('.page0Img4').hide();
    			$j('.page1Img0').hide();
    			$j('#page1Img2').fadeOut(1000);
    			$j('.page1Img3').fadeOut(500);
    			},3000);
    		},1000);
    	},4000);*/
}

function indexStartGame() {
    $j('.indexBtn1,.indexBtn2,.indexBtn3').hide();
    $j('.page0Img1').removeClass('page0Img1Act').fadeOut(500);
    $j('.page0Img2').removeClass('page0Img2Act').fadeOut(500);
    $j('.page0Img4').fadeOut(500);
    $j('.page0Img3').addClass('page0Img3Act').show();
    setTimeout(function() {
        $j('.page0Img5').addClass('page0Img5Act').show();
        $j('.page0Img3').removeClass('page0Img3Act');
        $j('.page0').delay(500).fadeOut(500);

        setTimeout(function() {
            $j('.page1').fadeIn(500);
            hidePanoLayerEle(['compass1']);
            $j('#pano').fadeIn(1000);
            $j('.page1Img0').fadeOut(1500);
            setTimeout(function() {
                $j('.page0Img4').hide();
                $j('.page1Img0').hide();
                $j('#page1Img2').fadeOut(1000);
                $j('.page1Img3').fadeOut(500);
            }, 3000);
        }, 1500);
    }, 3500);
}

function showRule() {
    $j('.indexBtn1,.indexBtn2,.indexBtn3').hide();
    $j('.pageRule').fadeIn(500);
}

function closeRule() {
    $j('.indexBtn1,.indexBtn2,.indexBtn3').show();
    $j('.pageRule').fadeOut(500);
}

function showMyAward(prize_id,prize_code) {
    if( prize_id > 0 ){
        $j('.indexBtn1,.indexBtn2,.indexBtn3').hide();
        if( prize_id == 1){
            $j('.pageAward1').fadeIn(500);//1等奖
        }
        else if( prize_id == 2){
            $j('#prize_code_2').text(prize_code);
            $j('.pageAward2').fadeIn(500);//2等奖
        }
        else{
            $j('#prize_code_3').text(prize_code);
            $j('.pageAward3').fadeIn(500);//3等奖
        }
    }
    else{
         $j('.indexBtn1,.indexBtn2,.indexBtn3').show();
	        $j('.pageAward0').fadeIn(500);
    }

}

function closeAward() {
    $j('.indexBtn1,.indexBtn2,.indexBtn3').show();
    $j('.pageAward1').fadeOut(500);
	$j('.pageAward2').fadeOut(500);
	$j('.pageAward3').fadeOut(500);
    $j('.pageAward0').fadeOut(500);
}

function showShareNote() {
$j('.shareBg').fadeIn(500);
}

function closeShare(){
	$j('.shareBg').fadeOut(500);
	}

function getBottle() {
    $j('#pano').fadeOut(500);
    $j('.page1Img4').fadeIn(500);
    $j('.page1Img5').addClass('page1Img5Act').show();
    $j('.page1Img5b').delay(500).fadeIn(500).click(function() {
        goLuopan();
    });
}

function goLuopan() {
    $j('.page1Img4').fadeOut(500);
    $j('.page1Img5').hide();
    $j('.page1Img5b').hide();
    $j('.page1Img6').fadeIn(500);
    $j('.page1Img7').delay(2500).fadeIn(500);
    setTimeout(function() {
        backPano2();
    }, 5000);
}

var krpano;

function hidePanoEle(e) {
    krpano = document.getElementById("krpanoSWFObject");
    if (krpano) {
        for (var i = e, n = i.length, a = 0; n > a; a++) {
            krpano.set("hotspot[" + i[a] + "].visible", !1);
        }
    }
}

function showPanoEle(e) {
    krpano = document.getElementById("krpanoSWFObject");
    if (krpano) {
        for (var i = e, n = i.length, a = 0; n > a; a++) {
            krpano.set("hotspot[" + i[a] + "].visible", !0);
        }
    }
}

function hidePanoLayerEle(e) {
    krpano = document.getElementById("krpanoSWFObject");
    if (krpano) {
        for (var i = e, n = i.length, a = 0; n > a; a++) {
            krpano.set("layer[" + i[a] + "].visible", !1);
        }
    }
}

function showPanoLayerEle(e) {
    krpano = document.getElementById("krpanoSWFObject");
    if (krpano) {
        for (var i = e, n = i.length, a = 0; n > a; a++) {
            krpano.set("layer[" + i[a] + "].visible", !0);
        }
    }
}

function backPano2() {
    hidePanoEle(['circle1']);
    showPanoEle(['circle2']);
    $j('.page1Img6').fadeOut(500);
    $j('.page1Img7').hide();
    $j('.page1Img8').hide();
    showPanoLayerEle(['compass1']);
    $j('#pano').fadeIn(500);
    $j('.logo').fadeOut(500);
    $j('.musicBtn').fadeOut(500);
}

function getHole() {
    $j('#pano').fadeOut(500);
    $j('.logo').fadeIn(500);
    $j('.musicBtn').fadeIn(500);
    $j('.page1').fadeOut(500);
    $j('.page2').fadeIn(500);
    $j('.page2Img1Img').addClass('page2Img1Act');
    setTimeout(function() {
        $j('.page2Img2').show();
    }, 4500);
}

function goGame(url) {
    window.location.href = url;
}

function startMove() {
    if (window.DeviceOrientationEvent) {
        window.addEventListener("deviceorientation", orientationHandler, false);
    } else {
        alert('您的设备不支持旋转');
    };
}

var firstHeading = 'firstHeading';
var firstFB = 'firstFB';
var nowFB;
var nowHeading;

function orientationHandler(event) {
    if (firstHeading == 'firstHeading') {
        firstHeading = event.gamma;
    }
    if (firstFB == 'firstFB') {
        firstFB = event.beta;
    }
    var tl = parseInt(event.gamma - firstHeading) * 30;
    var tt = parseInt(event.beta - firstFB) * 20;
    if (tl < -1500) {
        tl = -1500;
    }
    if (tl > 1884) {
        tl = 1884;
    }
    if (tt < -10) {
        tt = -10;
    }
    if (tt > (1700 - wHeight)) {
        tt = (1700 - wHeight);
    }
    var value = ['translate(' + tl + 'px, ' + tt + 'px)'];
    //alert(event.beta+' - '+event.webkitCompassHeading);
    $j('#page1Img1').css('-webkit-transform', value);
}


function loadingGame() {
    var images = [];
    images.push("assets/images/game1Img1.png");
    images.push("assets/images/game1Img3.png");
    images.push("assets/images/game2Img1.png");
    images.push("assets/images/game2Img3.png");
    images.push("assets/images/game2Img5.png");
    images.push("assets/images/game2Img6.png");
    images.push("assets/images/game2Img7.png");
    images.push("assets/images/game3Img1.png");
    images.push("assets/images/game3Img2.png");
    images.push("assets/images/game3Img3.png");
    images.push("assets/images/game3Img4.png");
    images.push("assets/images/game4Img1.png");
    images.push("assets/images/game4Img3.png");
    images.push("assets/images/game4Img4.png");
    images.push("assets/images/game5Img1.png");
    images.push("assets/images/game5Img2.png");
    images.push("assets/images/game5Img3.png");
    images.push("assets/images/game6Img1.png");
    images.push("assets/images/game6Img2.png");

    /*图片预加载*/
    var imgNum = 0;
    $j.imgpreload(images, {
        each: function() {
            var status = $j(this).data('loaded') ? 'success' : 'error';
            if (status == "success") {
                var v = (parseFloat(++imgNum) / images.length).toFixed(2);
                $j(".loadTxt span").html(Math.round(v * 100));
            }
        },
        all: function() {
            goGame1();
        }
    });
}

function goGame1() {
    $j('.page0').fadeOut();
    $j('.pageGame1').fadeIn(500);
    setTimeout(function() {
        $j('.pageGame11').fadeOut(1000);
        $j('.game1Img1').fadeIn(1000);
        setTimeout(function() {
            $j('.game1Img2').show();
            getShake();
        }, 1000);
    }, 2000);
}

function getShake() {
    var myShakeEvent = new Shake({
        threshold: 5
    });
    myShakeEvent.start();
    window.addEventListener('shake', shakeEventDidOccur, false);
}

var step = 1;

function shakeEventDidOccur() {
    $j('.game1Img2').hide();
    $j('.game1Img1').fadeOut(500);
    if (step == 1) {
        $j('.game1Img3').css('opacity', '0.3').show();
        step++;
    } else if (step <= 3) {
        $j('.game1Img3').css('opacity', step / 3);
        step++;
    } else {
        $j('.game1Img4').show();
        $j('.game1Img5').fadeIn(1000);
        $j('.pageGame1').touchwipe({
            min_move_x: 40, //横向灵敏度
            min_move_y: 40, //纵向灵敏度
            wipeUp: function() {
                $j('.pageGame1').fadeOut(500);
                $j('.pageGame2').fadeIn(500);
            }, //向上滑动事件
            preventDefaultEvents: true //阻止默认事件
        });
    }
}

function game2Act1() {
    $j('.game2A0').fadeOut(500);
    $j('.game2A1').fadeIn(500);
    $j('.game2Img6').touchwipe({
        min_move_x: 40, //横向灵敏度
        min_move_y: 40, //纵向灵敏度
        wipeRight: function() {
            $j('.game2Img5').addClass('game2Img5Act');
            $j('.game2Img6').hide();
            $j('.game2Img4').hide();
            $j('.game2Img7').fadeIn(500);
            $j('.game2Img8').fadeIn(500);
            $j('.game2Img7').click(function() {
                $j('.game2A1').fadeOut(500);
                $j('.game2A2').fadeIn(500);
                setTimeout(function() {
                    $j('.game3Img3').fadeIn(500);
                    $j('.game3Img3a').fadeIn(500);
                    $j('.game3Img3').touchwipe({
                        min_move_x: 40, //横向灵敏度
                        min_move_y: 40, //纵向灵敏度
                        wipeUp: function() {
                            $j('.pageGame2').fadeOut(500);
                            $j('.pageGame3').fadeIn(500);
                            game3Start();
                        }, //向上滑动事件
                        preventDefaultEvents: true //阻止默认事件
                    });
                }, 1000);
            });
        }, //向右侧滑动事件
        preventDefaultEvents: true //阻止默认事件
    });
}

var dragImg;
var dragPb;
var dropImg;
var dropPb;

function game3Start() {
    $j(".pg").draggable({
        drag: function(event, ui) {
            $j('.game3Img5').fadeOut(500);
            $j(".pg").css('z-index', '0');
            $j(this).css('z-index', '5');
            dragImg = $j(this).attr('src');
            dragPb = $j(this).parents('.pb').attr('rel');
        },
        revert: true
    });
    $j(".pb").droppable({
        drop: function(event, ui) {
            dropPb = $j(this).attr('rel');
            dropImg = $j(this).find('img').attr('src');
            $j(this).find('img').attr('src', dragImg);
            $j('.' + dragPb + 'b').find('img').attr('src', dropImg);
            checkDrag();
        }
    });
}

function checkDrag() {
    if (($j('.p1b img').attr('src').indexOf('1') > -1) && ($j('.p2b img').attr('src').indexOf('2') > -1) && ($j('.p3b img').attr('src').indexOf('3') > -1) && ($j('.p4b img').attr('src').indexOf('4') > -1) && ($j('.p5b img').attr('src').indexOf('5') > -1) && ($j('.p6b img').attr('src').indexOf('6') > -1)) {
        $j('.pageGame3').fadeOut(500);
        $j('.pageGame4').fadeIn(500);
        $j('.game4Img1').click(function() {
            $j('.game3A1').fadeOut(500);
            $j('.game3A2').fadeIn(500);
            setTimeout(function() {
                $j('.game3A2').fadeOut(500);
                $j('.game3A3').fadeIn(500);
                $j('.game5Img2').touchwipe({
                    min_move_x: 40, //横向灵敏度
                    min_move_y: 40, //纵向灵敏度
                    wipeUp: function() {
                        $j('.pageGame4').fadeOut(500);
                        $j('.pageGame5').fadeIn(500);
                        game4Start();
                    }, //向上滑动事件
                    preventDefaultEvents: true //阻止默认事件
                });
            }, 2000);
        });
    }
}

function game4Start() {
    $j('.game6Img1b').addClass('game6Img1bAct');
    setTimeout(function() {
        $j('.game6Img2').addClass('game6Img2Act').show();
        $j('.game6Img1').fadeOut(2000);
        setTimeout(function() {
            $j('.game6Img4').fadeIn(500);
            $j('.game6Img5').fadeIn(500);
            $j('.game6Img5b').fadeIn(500);
            $j('.game6Img3').show();
            $j('.game6Img6').show();
            game3Init();
        }, 2000);
    }, 4000);
}

var wTime;
var wInterval;

//按下标记
var onoff = false;
var oldx = 0;
var isFirst = 0; //初次点击

var outDiv = document.getElementById('game6Img5b');
var x = 0; //画布X位置
var tempX = 0; //画布临时位置

function game3Init() {
    //添加手指移动事件
    outDiv.addEventListener("mousemove", draw, false);
    //添加手指按下事件
    outDiv.addEventListener("mousedown", down, false);
    //添加手指弹起事件
    outDiv.addEventListener("mouseup", up, false);

    //添加手指移动事件
    outDiv.addEventListener("touchmove", draw, false);
    //添加手指按下事件
    outDiv.addEventListener("touchstart", down, false);
    //添加手指弹起事件
    outDiv.addEventListener("touchend", up, false);

    wInterval = setInterval(function() {
        waterGo()
    }, 1500);
}

var wL = ['300px', '150px', '500px'];
var wS = 0;
var getW = 0;

function waterGo() {
    if (wS == 3) {
        wS = 0;
    }
    $j('.game6Img4').css({
        'left': wL[wS],
        'top': '-120px'
    });
    $j('.game6Img4').stop().animate({
        top: 1039
    }, 1000, 'swing', function() {
        wS++;
    });
    setTimeout(function() {
        var g6i5Left = parseInt($j('.game6Img5').css('left'));
        //alert((g6i5Left-30)+' - '+parseInt(wL[wS])+' - '+(g6i5Left+85)+' - '+(parseInt(wL[wS])+50));
        if (((g6i5Left + 26) <= parseInt(wL[wS])) && ((g6i5Left + 122) >= (parseInt(wL[wS]) + 50))) {
            getW++;
            if (getW == 3) {
                clearInterval(wInterval);
                alert('游戏结束');
            }
        }
    }, 600);
}

function down(event) {
    onoff = true;
    if (/(iPhone|iPad|iPod|iOS)/i.test(navigator.userAgent)) {
        oldx = event.targetTouches[0].pageX;
    } else if (/(Android)/i.test(navigator.userAgent)) {
        var touch = event.touches[0];
        oldx = touch.pageX;
    } else {
        oldx = event.pageX;
    }
    $j('.game6Img3').hide();
    $j('.game6Img6').hide();
}

function up() {
    onoff = false;
}

function draw(event) {
    if (onoff == true) {
        event.stopPropagation(); //禁止手势缩放
        event.preventDefault(); //在页面滑动时禁止事件

        tempX = parseInt($j('.game6Img5').css('left'));

        var newx;
        if (/(iPhone|iPad|iPod|iOS)/i.test(navigator.userAgent)) {
            newx = event.targetTouches[0].pageX;
        } else if (/(Android)/i.test(navigator.userAgent)) {
            var touch = event.touches[0];
            newx = touch.pageX;
        } else {
            newx = event.pageX;
        }
        var diffx = newx - oldx;
        $j('.game6Img5').css({
            'left': tempX + diffx + 'px'
        })

        oldx = newx;
    };
};

/*function testDarg(){
	$j('.page').hide();
	$j('.pageGame5').show();
	game4Start();
	}*/
