var gotop = document.getElementById('gotop');
var topshowinfo = document.getElementById('topshowinfo');
gotop.onmouseover=function(){
	topshowinfo.style.display="block";
}
gotop.onmouseout=function(){
	topshowinfo.style.display="none";
}

var gologin = document.getElementById('gologin');
var showgologin = document.getElementById('showgologin');
gologin.onmouseover=function(){
	showgologin.style.display="block";
}
gologin.onmouseout=function(){
	showgologin.style.display="none";
}

var gomycart = document.getElementById('gomycart');
var showgomycart = document.getElementById('showgomycart');
gomycart.onmouseover=function(){
	showgomycart.style.display="block";
}
gomycart.onmouseout=function(){
	showgomycart.style.display="none";
}

var goperson = document.getElementById('goperson');
var showgoperson = document.getElementById('showgoperson');
goperson.onmouseover=function(){
	showgoperson.style.display="block";
}
goperson.onmouseout=function(){
	showgoperson.style.display="none";
}

var gohome = document.getElementById('gohome');
var showgohome = document.getElementById('showgohome');
gohome.onmouseover=function(){
	showgohome.style.display="block";
}
gohome.onmouseout=function(){
	showgohome.style.display="none";
}

$(function(){
    $('.logout').click(function(){
        $logoutoption=$(this);
        layer.msg('您确定退出该账户嘛？', {
          time: 0 //不自动关闭
          ,btn: ['确定', '取消']
          ,yes:function(index){
            layer.close(index);
            var $id=$logoutoption.attr('data-id');
            var $url=$logoutoption.attr('data-url');
            $.ajax({
                url  : $url,
                type : 'get',
                data : {'id':$id},
                dataType : 'json',
                success:function(data,status){
                    layer.msg(data.info,{icon: data.status,time:1500},
                        function(){
                            window.location.href = data.url;
                    });
                },
            });
          }
        });
    });
});