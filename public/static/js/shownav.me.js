var show_nav_control = document.getElementById('show-control-nav');
var show_nav = document.getElementById('shownav');
show_nav_control.onmouseover=function(){
	shownav.style.display="block";
}
show_nav_control.onmouseout=function(){
	shownav.style.display="none";
}
shownav.onmouseover=function(){
	shownav.style.display="block";
}
shownav.onmouseout=function(){
	shownav.style.display="none";
}
$(function(){
	$("#shop-more-nav li").finish().mouseenter(function(){
		$(this).find(".more-showtabs-nav-text").css('display','block');
	}).mouseleave(function(){
		$(this).find(".more-showtabs-nav-text").css('display','none');
	});
	$("#cont-more-condi-shop").click(function(){
		$("#show-more-condi-shop").slideToggle(1000);
	});
});
