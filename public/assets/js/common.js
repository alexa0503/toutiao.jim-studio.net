//找到url中匹配的字符串
function findInUrl(str) {
    url = location.href;
    return url.indexOf(str) == -1 ? false : true;
}
//获取url参数
function queryString(key) {
    return (document.location.search.match(new RegExp("(?:^\\?|&)" + key + "=(.*?)(?=&|$)")) || ['', null])[1];
}

//产生指定范围的随机数
function randomNumb(minNumb, maxNumb) {
    var rn = Math.round(Math.random() * (maxNumb - minNumb) + minNumb);
    return rn;
}

var wHeight;
$(document).ready(function() {
    wHeight = $(window).height();
    if (wHeight < 832) {
        wHeight = 832;
    }
    $('.pageOuter').height(wHeight);
    $('.page').height(wHeight);

    $('.h832').css('padding-top', (wHeight - 832) / 2 + 'px');
});

function loadingImg() {
    var images = [];
    images.push("assets/images/bg.jpg");
    images.push("assets/images/page0Img1.png");
    images.push("assets/images/page0Img2.png");

    /*图片预加载*/
    var imgNum = 0;
    $.imgpreload(images, {
        each: function() {
            var status = $(this).data('loaded') ? 'success' : 'error';
            if (status == "success") {}
        },
        all: function() {
            goPage0();
        }
    });
}

function goPage0() {
    $('.page0Bg').show();
    $('.page0Img1').addClass('page0Img1Act').show();
    $('.page0Img2').addClass('page0Img2Act').show();
    $('.loadingImg').show();
    $('.loadTxt').show();
    loadingPage1();
}

function loadingPage1() {
    var images = [];
    images.push("assets/images/page0Img3.png");
    images.push("assets/images/page0Img4.png");
    //images.push("assets/images/moveImg1.jpg");
    //images.push("assets/images/moveImg2.png");

    /*图片预加载*/
    var imgNum = 0;
    $.imgpreload(images, {
        each: function() {
            var status = $(this).data('loaded') ? 'success' : 'error';
            if (status == "success") {
                var v = (parseFloat(++imgNum) / images.length).toFixed(2);
                $(".loadTxt span").html(Math.round(v * 100));
            }
        },
        all: function() {
            goPage1();
        }
    });
}

function goPage1() {
    $('.page0Img1').removeClass('page0Img1Act').fadeOut(500);
    $('.page0Img2').removeClass('page0Img2Act').fadeOut(500);
    $('.loadingImg').hide();
    $('.loadTxt').hide();
    $('.page0Img3').addClass('page0Img3Act').show();
    setTimeout(function() {
        $('.page0Img4').addClass('page0Img4Act').show();
        $('.page0').fadeOut(500);
        setTimeout(function() {
            $('body').css('background', '#FFF');
            $('.page1').show();
            $('.page1Img0').fadeOut(1500);
            setTimeout(function() {
                $('.page0Img4').hide();
                $('.page1Img0').hide();
                $('#page1Img2').fadeOut(1000);
                setTimeout(function() {
                    $('.page1Img3').fadeOut(500);
                    //startMove();
                }, 2000);
            }, 3000);
        }, 1000);
    }, 4000);
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
    $('#page1Img1').css('-webkit-transform', value);
}


function loadingGame() {
    var images = [];
    images.push("assets/images/game1Img1.png");
    images.push("assets/images/game1Img2.png");
    images.push("assets/images/game1Img3.png");
    images.push("assets/images/game1Img5.png");
    images.push("assets/images/game1Img31.png");
    images.push("assets/images/game1Img32.png");
    images.push("assets/images/game1Img33.png");
    images.push("assets/images/game1Img34.png");
    images.push("assets/images/game1Img35.png");
    images.push("assets/images/game1Img36.png");
    images.push("assets/images/game2Img1.png");
    images.push("assets/images/game2Img3.png");
    images.push("assets/images/game2Img5.png");
    images.push("assets/images/game2Img6.png");
    images.push("assets/images/game2Img7.png");
    images.push("assets/images/game3Img1.png");
    images.push("assets/images/game3Img2.png");
    images.push("assets/images/game3Img3.png");
    images.push("assets/images/game3Img4.png");
    images.push("assets/images/game3Img6.png");
    images.push("assets/images/game4Img1.png");
    images.push("assets/images/game4Img3.png");
    images.push("assets/images/game4Img4.png");
    images.push("assets/images/game5Img1.png");
    images.push("assets/images/game5Img2.png");
    images.push("assets/images/game5Img3.png");
    images.push("assets/images/game6Img1.png");
    images.push("assets/images/game6Img2.png");
    images.push("assets/images/game7Img1.png");
    images.push("assets/images/game7Img2.png");
    images.push("assets/images/game7Img3.png");
    images.push("assets/images/game8Img1.png");
    images.push("assets/images/game8Img2.png");
    images.push("assets/images/game8Img3.png");
    images.push("assets/images/game8Img4.png");
    images.push("assets/images/game8Img5.png");
    images.push("assets/images/game8Img6.png");
    images.push("assets/images/gameOver.png");

    /*图片预加载*/
    var imgNum = 0;
    $.imgpreload(images, {
        each: function() {
            var status = $(this).data('loaded') ? 'success' : 'error';
            if (status == "success") {
                var v = (parseFloat(++imgNum) / images.length).toFixed(2);
                $(".loadTxt span").html(Math.round(v * 100));
            }
        },
        all: function() {
            goGame1();
        }
    });
}

function goGame1() {
    $('.page0').fadeOut(500);
    //$('.pageGame1').fadeIn(500);
    setTimeout(function() {
        $('.pageGame11').fadeOut(1000);
        $('.game1Img1').fadeIn(1000);
        setTimeout(function() {
            $('.game1Img2').show();
            $('.colddownTime').fadeIn(500);
            startColddown();
            getShake();
        }, 500);
    }, 1000);
}

function getShake() {
    var myShakeEvent = new Shake({
        threshold: 5
    });
    myShakeEvent.start();
    window.addEventListener('shake', shakeEventDidOccur, false);
}

function shakeEventDidOccur() {
    $('.game1Img2').hide();
    $('.game1Img1').fadeOut(500);

    $('.game1Black').fadeOut(1000);
    $('.game1Img31').delay(1000).fadeIn(500);
    $('.game1Img32').delay(1500).fadeIn(500);
    $('.game1Img33').delay(2000).fadeIn(500);
    $('.game1Img34').delay(2500).fadeIn(500);
    $('.game1Img35').delay(3000).fadeIn(500);
    $('.game1Img36').delay(3500).fadeIn(500);
    setTimeout(function() {
        $('.game1Img4').show();
        $('.game1Img5').fadeIn(1000);
        $('.pageGame1').touchwipe({
            min_move_x: 40, //横向灵敏度
            min_move_y: 40, //纵向灵敏度
            wipeUp: function() {
                $('.pageGame1').addClass('zoomOut');

                setTimeout(function() {
                    $('.pageGame1').hide();
                    $('.pageGame2').fadeIn(500);
                }, 600);
            }, //向上滑动事件
            preventDefaultEvents: true //阻止默认事件
        });
    }, 4500);
}

function game2Act1() {
    $('.game2A0').fadeOut(500);
    $('.game2A1').fadeIn(500);
    $('.game2Img6').touchwipe({
        min_move_x: 40, //横向灵敏度
        min_move_y: 40, //纵向灵敏度
        wipeRight: function() {
            $('.game2Img5').addClass('game2Img5Act');
            $('.game2Img6').hide();
            $('.game2Img4').hide();
            $('.game2Img7').fadeIn(500);
            $('.game2Img8').fadeIn(500);
            $('.game2Img7').click(function() {
                $('.game2A1').fadeOut(500);
                $('.game2A2').fadeIn(500);
                setTimeout(function() {
                    $('.game3Img3').fadeIn(500);
                    $('.game3Img3a').fadeIn(500);
                    $('.game3Img3').touchwipe({
                        min_move_x: 40, //横向灵敏度
                        min_move_y: 40, //纵向灵敏度
                        wipeUp: function() {
                            $('.pageGame2').addClass('zoomOut');

                            setTimeout(function() {
                                $('.pageGame2').hide();
                                $('.pageGame3').fadeIn(500);
                                game3Start();
                            }, 600);
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
var canCheck = true;

function game3Start() {
    $(".pg").draggable({
        drag: function(event, ui) {
            if (canCheck) {
                $('.game3Img5').fadeOut(500);
                $(".pg").css('z-index', '0');
                $(this).css('z-index', '5');
                dragImg = $(this).attr('src');
                dragPb = $(this).parents('.pb').attr('rel');
            }
        },
        revert: true
    });
    $(".pb").droppable({
        drop: function(event, ui) {
            if (canCheck) {
                dropPb = $(this).attr('rel');
                dropImg = $(this).find('img').attr('src');
                $(this).find('img').attr('src', dragImg);
                $('.' + dragPb + 'b').find('img').attr('src', dropImg);
                checkDrag();
            }
        }
    });
}

function checkDrag() {
    if (($('.p1b img').attr('src').indexOf('1') > -1) && ($('.p2b img').attr('src').indexOf('2') > -1) && ($('.p3b img').attr('src').indexOf('3') > -1) && ($('.p4b img').attr('src').indexOf('4') > -1) && ($('.p5b img').attr('src').indexOf('5') > -1) && ($('.p6b img').attr('src').indexOf('6') > -1) && ($('.p7b img').attr('src').indexOf('7') > -1) && ($('.p8b img').attr('src').indexOf('8') > -1)) {
        canCheck = false;
        $('.game3Img6').delay(1000).fadeIn(1000);
        setTimeout(function() {
            checkOk();
        }, 3000);
    }
}

function checkOk() {
    $('.pageGame3').fadeOut(500);
    $('.pageGame4').fadeIn(500);
    $('.game4Img1').click(function() {
        $('.game3A1').fadeOut(500);
        $('.game3A2').fadeIn(500);
        setTimeout(function() {
            $('.game3A2').fadeOut(500);
            $('.game3A3').fadeIn(500);
            $('.game5Img2').touchwipe({
                min_move_x: 40, //横向灵敏度
                min_move_y: 40, //纵向灵敏度
                wipeUp: function() {
                    $('.pageGame4').addClass('zoomOut');

                    setTimeout(function() {
                        $('.pageGame4').hide();
                        $('.pageGame5').fadeIn(500);
                        game4Start();
                    }, 600);
                }, //向上滑动事件
                preventDefaultEvents: true //阻止默认事件
            });
        }, 2000);
    });
}

function game4Start() {
    $('.game6Img1b').addClass('game6Img1bAct');
    setTimeout(function() {
        $('.game6Img2').addClass('game6Img2Act').show();
        $('.game6Img1').fadeOut(2000);
        setTimeout(function() {
            $('.game6Img4').fadeIn(500);
            $('.game6Img5').fadeIn(500);
            $('.game6Img5b').fadeIn(500);
            $('.game6Img3').show();
            $('.game6Img6').show();
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
    $('.game6Img4').css({
        'left': wL[wS],
        'top': '-120px'
    });
    $('.game6Img4').stop().animate({
        top: 1039
    }, 1000, 'swing', function() {
        wS++;
    });
    setTimeout(function() {
        var g6i5Left = parseInt($('.game6Img5').css('left'));
        //alert((g6i5Left-30)+' - '+parseInt(wL[wS])+' - '+(g6i5Left+85)+' - '+(parseInt(wL[wS])+50));
        if (((g6i5Left + 26) <= parseInt(wL[wS])) && ((g6i5Left + 122) >= (parseInt(wL[wS]) + 50))) {
            getW++;
            $('.we').css('background-position', getW * (-56) + 'px');
            if (getW == 5) {
                clearInterval(wInterval);
                $('.game4A1').delay(1000).fadeOut(500);
                $('.game4A2').delay(1000).fadeIn(500);
                $('.game7Img4').delay(1500).show();
                $('.game7Img2').touchwipe({
                    min_move_x: 40, //横向灵敏度
                    min_move_y: 40, //纵向灵敏度
                    wipeUp: function() {
                        $('.pageGame5').addClass('zoomOut');

                        setTimeout(function() {
                            $('.pageGame5').hide();
                            $('.pageGame6').fadeIn(500);
                            $('.game8Img2').addClass('game8Img2Act').show(0);
                            goGame6A2();
                        }, 600);
                    }, //向上滑动事件
                    preventDefaultEvents: true //阻止默认事件
                });
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
    $('.game6Img3').hide();
    $('.game6Img6').hide();
    $('.we').show();
}

function up() {
    onoff = false;
}

function draw(event) {
    if (onoff == true) {
        event.stopPropagation(); //禁止手势缩放
        event.preventDefault(); //在页面滑动时禁止事件

        tempX = parseInt($('.game6Img5').css('left'));

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
        $('.game6Img5').css({
            'left': tempX + diffx + 'px'
        })

        oldx = newx;
    };
};

var canCheck2 = true;
var dragBoxImg;
var dragBoxStep = 0;

function goGame6A2() {
    $('.game6A1').delay(3000).fadeOut(500);
    $('.game6A2').delay(3000).fadeIn(500);
    $(".game8Init").draggable({
        drag: function(event, ui) {
            if (canCheck2) {
                $(".game8Init").css('z-index', '0');
                $(this).css('z-index', '5');
                dragBoxImg = $(this).attr('rel');
            }
        },
        revert: true
    });
    $(".game8Box").droppable({
        drop: function(event, ui) {
            if (canCheck2) {
                $('.' + dragBoxImg).hide();
                dragBoxStep++;
                checkDrag2();
            }
        }
    });
}

var koNumb;

function checkDrag2() {
    if (dragBoxStep == 3) {
        canCheck2 = false;
        clearInterval(cdTime);
        var useTime = parseInt(180 - cdn);
        if (useTime <= 60) {
            //文案 击败95-99%
            koNumb = randomNumb(95, 99);
        } else if (useTime <= 80) {
            //文案 击败90-94%
            koNumb = randomNumb(90, 94);
        } else if (useTime <= 100) {
            //文案 击败85-89%
            koNumb = randomNumb(85, 89);
        } else if (useTime <= 120) {
            //文案 击败80-84%
            koNumb = randomNumb(80, 84);
        } else if (useTime <= 140) {
            //文案 击败75-79%
            koNumb = randomNumb(75, 79);
        } else if (useTime <= 160) {
            //文案 击败70-74%
            koNumb = randomNumb(70, 74);
        } else if (useTime <= 180) {
            //文案 击败65-69%
            koNumb = randomNumb(65, 69);
        }
        //wxData.title = '';
        wxData.desc = '恭喜你击败全国' + koNumb + '%人，率先找到传说中的降暑良策';
        wxShare();

        $('.game6A2').delay(500).fadeOut(500);
        $('.game6A3').delay(500).fadeIn(500);
        $('.game8Img5').delay(1000).addClass('game8Img5Act');
    }
}

var canGetRes = true;

function goRes(url) {
    if (canGetRes) {
        canGetRes = false;
        //ajax抽奖
        $.ajax(url, {
            type: 'post',
            dataType: 'json',
            success: function(json) {
                if (json.ret == 0 && json.prize && json.prize.id > 0) {
                    var awardNumb = json.prize.id; //1-3 1-3等奖
                    if (json.prize.id > 1) {
                        $('#prize_code_' + json.prize.id).text(json.prize.code)
                    }

                    $('.getAward' + awardNumb).show();
                    $('.pageGame6').fadeOut(500);
                    $('.pageGame7').fadeIn(500);
                } else {
                    //未中奖
                    $('.getAward0').show();
                    $('.pageGame6').fadeOut(500);
                    $('.pageGame7').fadeIn(500);
                    canGetRes = true;
                    //alert(json.msg)
                }
            },
            error: function() {
                canGetRes = true;
                alert('网络异常，请稍候重试~')
            }
        })
    }
}

function showShareNote() {
$('.shareBg').fadeIn(500);
}

function closeShare(){
	$('.shareBg').fadeOut(500);
	}

var cdt = 180; //3分钟
var cdn = 180; //开始180秒
var cdTime;

function colddown() {
    cdn = cdn - 1;
    if (cdn < 0) {
        clearInterval(cdTime);
        $('.pageGame8').show();
        return false;
    } else {
        var mm = parseInt(cdn / 60);
        if (mm < 10) {
            mm = '0' + mm.toString();
        }
        var ss = cdn % 60;
        if (ss < 10) {
            ss = '0' + ss.toString();
        }
        $('.colddownTime').html(mm + ':' + ss);
    }
}

function startColddown() {
    colddown();
    cdTime = setInterval(function() {
        colddown();
    }, 1000);
}

function palyAgain() {
    window.location.reload();
}

/*function testDarg(){
	$('.page').hide();
	$('.pageGame5').hide();
	$('.pageGame6').fadeIn(500);
	$('.game8Img2').addClass('game8Img2Act').show(0);

	goGame6A2();
	}*/
