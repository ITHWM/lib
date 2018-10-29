var plphone_control = document.getElementById('plphone-control');
var plphone_show = document.getElementById('plphone-show');
plphone_control.onmouseover=function(){
	plphone_show.style.display="block";
}
plphone_control.onmouseout=function(){
	plphone_show.style.display="none";
}


$(function(){
	//创建一个循环变量
	var m=1;
	var count_max = $("#imglist img").length-1;
	//定时切换
	var timer=setInterval(scrollimg,3000);
	function scrollimg(){
		if(m>count_max){
			m=0;
		}
		//控制图片换起来
		control_image(m);
		//控制控制点换起来
		control_icon(m);
		m++;
	}
	//控制图片
	function control_image(n){
		$("#imglist img").eq(n).addClass(" big-imgs-current").siblings("img").removeClass(" big-imgs-current");
	}
	//控制控制点
	function control_icon(n){
		$(".goods-smaill-imglist-show a").eq(n).addClass("curr-img-border").siblings("a").removeClass("curr-img-border");
	}
	$(".goods-big-imgs").finish().mouseenter(function(){
		clearInterval(timer);
	}).mouseleave(function(){
		timer=setInterval(scrollimg,3000);
	});
	$(".goods-smaill-imglist-show a").finish().mouseenter(function(){
		control_image($(this).index());
		control_icon($(this).index());
		m=$(this).index()+1;
		clearInterval(timer);
	}).mouseleave(function(){
		timer=setInterval(scrollimg,3000);
	});
	$(".imglist-control-goleft").click(function(){
		m-=2;
		if(m<0){
			m=count_max;
		}
		control_image(m);
		control_icon(m);
		m++;
	});
	$(".imglist-control-goright").click(function(){
		if(m>count_max){
			m=0;
		}
		control_image(m);
		control_icon(m);
		m++;
	});
	$(".imglist-control-goleft").finish().mouseenter(function(){
		clearInterval(timer);
	}).mouseleave(function(){
		timer=setInterval(scrollimg,3000);
	});
	$(".imglist-control-goright").finish().mouseenter(function(){
		clearInterval(timer);
	}).mouseleave(function(){
		timer=setInterval(scrollimg,3000);
	});
});