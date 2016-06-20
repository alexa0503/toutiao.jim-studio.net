/**
* jquery.imgpreload 1.6.2 <https://github.com/farinspace/jquery.imgpreload>
* Copyright 2009-2014 Dimas Begunoff <http://farinspace.com>
* License MIT <http://opensource.org/licenses/MIT>
*/
if ('undefined' != typeof jQuery)
{
(function($j){
'use strict';
// extend jquery (because i love jQuery)
$j.imgpreload = function (imgs,settings)
{
settings = $j.extend({},$j.fn.imgpreload.defaults,(settings instanceof Function)?{all:settings}:settings);
// use of typeof required
// https://developer.mozilla.org/En/Core_JavaScript_1.5_Reference/Operators/Special_Operators/Instanceof_Operator#Description
if ('string' == typeof imgs) { imgs = [imgs]; }
var loaded = [];
$j.each(imgs,function(i,elem)
{
var img = new Image();
var url = elem;
var img_obj = img;
if ('string' != typeof elem)
{
url = $j(elem).attr('src') || $j(elem).css('background-image').replace(/^url\((?:"|')?(.*)(?:'|")?\)$j/mg, "$j1");
img_obj = elem;
}
$j(img).bind('load error', function(e)
{
loaded.push(img_obj);
$j.data(img_obj, 'loaded', ('error'==e.type)?false:true);
// http://msdn.microsoft.com/en-us/library/ie/tkcsy6fe(v=vs.94).aspx
if (settings.each instanceof Function) { settings.each.call(img_obj, loaded.slice(0)); }
// http://jsperf.com/length-in-a-variable
if (loaded.length>=imgs.length && settings.all instanceof Function) { settings.all.call(loaded); }
$j(this).unbind('load error');
});
img.src = url;
});
};
$j.fn.imgpreload = function(settings)
{
$j.imgpreload(this,settings);
return this;
};
$j.fn.imgpreload.defaults =
{
each: null, // callback invoked when each image is loaded
all: null // callback invoked when all images have loaded
};
})(jQuery);
}