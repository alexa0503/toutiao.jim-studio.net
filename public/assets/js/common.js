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

/*图片上传*/
//全局变量
var isSelectedImg = false; //是否选择图片
var originalImgWidth; //原图宽度
var originalImgHeight; //原图高度

var dataImg;

//移动
var reqAnimationFrame = (function() {
    return window[Hammer.prefixed(window, 'requestAnimationFrame')] || function(callback) {
        window.setTimeout(callback, 1000 / 60);
    };
})();

var el;
var ei;

var START_X = 0; //Math.round((window.innerWidth - el.offsetWidth) / 2);
var START_Y = 0; //Math.round((window.innerHeight - el.offsetHeight) / 2);

var endx = 0;
var endy = 0;
var posX = 0;
var posY = 0;

var ticking = false;
var transform;
var timer;

var mc;

var iX = 0;
var iY = 0;
var iS = 1;
var iA = 0;

function changeMc() {
    el = document.querySelector("#touchBlock");
    ei = document.querySelector('#preview');
    mc = new Hammer.Manager(el);

    mc.add(new Hammer.Pan({
        threshold: 0,
        pointers: 0
    }));
    mc.add(new Hammer.Rotate({
        threshold: 0
    })).recognizeWith(mc.get('pan'));
    mc.add(new Hammer.Pinch({
        threshold: 0
    })).recognizeWith([mc.get('pan'), mc.get('rotate')]);
    mc.on("panstart panmove panend", onPan);
    mc.on("rotatestart rotatemove", onRotate);
    mc.on("pinchstart pinchmove", onPinch);
    resetElement();
}

function resetElement() {
    el.className = 'animate';
    transform = {
        translate: {
            x: START_X,
            y: START_Y
        },
        scale: 1,
        angle: 0,
        rx: 0,
        ry: 0,
        rz: 0
    };
    requestElementUpdate();
}

function updateElementTransform() {
    var value = [
        'translate3d(' + transform.translate.x + 'px, ' + transform.translate.y + 'px, 0)',
        'scale(' + transform.scale + ', ' + transform.scale + ')',
        'rotate3d(' + transform.rx + ',' + transform.ry + ',' + transform.rz + ',' + transform.angle + 'deg)'
    ];

    iX = transform.translate.x;
    iY = transform.translate.y;
    iS = transform.scale;
    iA = transform.angle;

    value = value.join(" ");
    ei.style.webkitTransform = value;
    ei.style.mozTransform = value;
    ei.style.transform = value;
    ticking = false;
}


function requestElementUpdate() {
    if (!ticking) {
        reqAnimationFrame(updateElementTransform);
        ticking = true;
    }
}

function onPan(ev) {
    el.className = '';
    switch (ev.type) {
        case 'panmove':
            posX = ev.deltaX + endx;
            posY = ev.deltaY + endy;
            break;
        case 'panend':
            endx = posX;
            endy = posY;
            break;
    }
    transform.translate = {
        x: posX,
        y: posY
    };
    requestElementUpdate();
}

var initScale = 1;

function onPinch(ev) {
    if (ev.type == 'pinchstart') {
        initScale = transform.scale || 1;
    }
    el.className = '';
    transform.scale = initScale * ev.scale;
    requestElementUpdate();
}

var initAngle = 0;

function onRotate(ev) {
    if (ev.type == 'rotatestart') {
        initAngle = transform.angle || 0;
    }
    el.className = '';
    transform.rz = 1;
    transform.angle = initAngle + ev.rotation;
    requestElementUpdate();
}

// @param {string} img 图片的base64
// @param {int} dir exif获取的方向信息
// @param {function} next 回调方法，返回校正方向后的base64
function getImgData(img, dir, next) {
    var image = new Image();
    image.onload = function() {
        var degree = 0,
            drawWidth, drawHeight, width, height;
        drawWidth = this.naturalWidth;
        drawHeight = this.naturalHeight;
        //以下改变一下图片大小
        var maxSide = Math.max(drawWidth, drawHeight);
        if (maxSide > 1024) {
            var minSide = Math.min(drawWidth, drawHeight);
            minSide = minSide / maxSide * 1024;
            maxSide = 1024;
            if (drawWidth > drawHeight) {
                drawWidth = maxSide;
                drawHeight = minSide;
            } else {
                drawWidth = minSide;
                drawHeight = maxSide;
            }
        }
        var canvas = document.getElementById('guoduCanvas');
        canvas.width = width = drawWidth;
        canvas.height = height = drawHeight;
        var context = canvas.getContext('2d');
        //判断图片方向，重置canvas大小，确定旋转角度，iphone默认的是home键在右方的横屏拍摄方式
        switch (dir) {
            case 1:
                break;
                //iphone横屏拍摄，此时home键在左侧
            case 3:
                degree = 180;
                drawWidth = -width;
                drawHeight = -height;
                break;
                //iphone竖屏拍摄，此时home键在下方(正常拿手机的方向)
            case 6:
                canvas.width = height;
                canvas.height = width;
                degree = 90;
                drawWidth = width;
                drawHeight = -height;
                break;
                //iphone竖屏拍摄，此时home键在上方
            case 8:
                canvas.width = height;
                canvas.height = width;
                degree = 270;
                drawWidth = -width;
                drawHeight = height;
                break;
        }

        //使用canvas旋转校正
        context.rotate(degree * Math.PI / 180);
        context.drawImage(this, 0, 0, drawWidth, drawHeight);
        //返回校正图片
        var itdu = canvas.toDataURL("image/png");
        next(itdu);
    }
    image.src = img;
}

function btnSelImg() {
    document.getElementById("uploadBtn").onchange = function(e) {
        var file = e.target.files[0];
        var orientation;
        //EXIF js 可以读取图片的元信息 https://github.com/exif-js/exif-js
        EXIF.getData(file, function() {
            orientation = EXIF.getTag(this, 'Orientation');
        });
        var reader = new FileReader();
        reader.onload = function(e) {
            getImgData(this.result, orientation, function(data) {
                //这里可以使用校正后的图片data了

                $('#preview').attr('src', data);
                $('#preview').show();

                isSelectedImg = true;
                $('.upLoadImg').css('webkitTransform', '');
                START_X = 0;
                START_Y = 0;
                endx = 0;
                endy = 0;
                posX = 0;
                posY = 0;
                ticking = false;
                iX = 0;
                iY = 0;
                iS = 1;
                iA = 0;

                changeMc();
                goPage2();
                return true;
            });
        }
        reader.readAsDataURL(file);
    }
}

function goPage2() {
    $('.page1').fadeOut(500);
    $('.page2').fadeIn(500);
}

function backPage1() {
    $('.page2').fadeOut(500);
    $('.page1').fadeIn(500);
}

function goPage3() {
    mixPhoto();
    $('.page2').fadeOut(500);
    $('.page3').fadeIn(500);
}

var canSubmit1 = true;

function goPage4(url) {
    var iTitle = $.trim($('.titleTxt').val());
    if (iTitle == '') {
        alert('请写下您爱的宣言');
        return false;
    }
    //ajax提交
    canSubmit1 = false;
    //图片 id=endImg
    $.ajax(url, {
        data: {
            title: iTitle,
            image: $('#endImg').attr('src')
        },
        method: 'post',
        success: function(json) {
            goPage5();
            if (json.ret == 0) {
                wxData.link = json.url;
                wxData.desc = json.desc;
                wxShare();
            } else {
                backPage3();
                canSubmit1 = true;
            }
        },
        error: function(xhr) {
            alert('上传失败');
            backPage3();
            canSubmit1 = true;
        },
        beforeSend: function() {
            $('.page3').fadeOut(500);
            $('.page4').fadeIn(500);
        }
    });

}

function backPage2() {
    $('.page3').fadeOut(500);
    $('.page2').fadeIn(500);
}

function goPage5() {
    $('.page4').fadeOut(500);
    $('.page5').fadeIn(500);
}

function backPage3() {
    $('.page4').fadeOut(500);
    $('.page3').fadeIn(500);
}

var drawCanvas;
var ctx;
var tImg;
var iww, iwh;

function mixPhoto() {
    drawCanvas = document.getElementById('guoduCanvas');
    var ww = 640;
    var wh = 375;
    $('#guoduCanvas').attr('width', ww);
    $('#guoduCanvas').attr('height', wh);
    ctx = drawCanvas.getContext('2d');
    ctx.fillStyle = "#FFF";
    ctx.fillRect(0, 0, ww, wh);
    //draw first start
    tImg = new Image();
    tImg.onload = function() {
        ctx.save();

        iww = tImg.width;
        iwh = tImg.height;

        iWidth = 640;
        iHeight = iwh * 640 / iww;

        ctx.translate(iX + iWidth / 2, iY + iHeight / 2);
        ctx.rotate(iA * Math.PI / 180);
        ctx.scale(iS, iS);
        ctx.drawImage(tImg, -iWidth / 2, -iHeight / 2, iWidth, iHeight);
        ctx.restore(); //draw first end
        $('#endImg').attr('src', drawCanvas.toDataURL("image/png"));
    }
    tImg.src = $('#preview').attr('src');
}

function voteThis(url) {
    var vNumb = parseInt($('.zanBlock span').html());
    $.ajax(url, {
        method: 'post',
        success: function(json) {
            if(json.ret == 0){
                $('.zanBlock span').html(json.like_num);
            }
            else{
                alert(json.msg);
            }
        },
        error: function(xhr){
            alert('点赞失败，请稍后重试')
        }
    })
    vNumb++;

}

var canSubmit2 = true;

function shopSubmit(url) {
    var shopPrice = $.trim($('.shopTxt').val());
    if (shopPrice == '') {
        alert('请输入消费金额');
        return false;
    }
    //提交
    canSubmit2 = false;
    $.ajax(url, {
        data: {
            price: shopPrice
        },
        method: 'post',
        success: function(json) {
            if(json.ret == 0){
                location.href=json.url;
            }
            else{
                alert(json.msg);
            }
        },
        error: function(xhr){
            canSubmit2=true;
        }
    })

    //提交失败
    //canSubmit2=true;
}
