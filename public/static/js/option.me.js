$(function(){
	$('.addthis').click(function(){
        var $url=$(this).attr('data-url');
        var $title=$(this).attr('data-title');
	    layer.open({
			type: 2,
			title: '添加'+$title,
			scrollbar: false,
			area: ['580px', '500px'],
			fixed: false, //不固定
			maxmin: true,
			content: $url
	    });
	});
	$('.editthis').click(function(){
		var $id=$(this).attr('data-id');
        var $url=$(this).attr('data-url');
        var $title=$(this).attr('data-title');
	    layer.open({
			type: 2,
			title: '修改'+$title,
			scrollbar: false,
			area: ['580px', '500px'],
			fixed: false, //不固定
			maxmin: true,
			content: $url+'?id='+$id
	    });
	});
	$('.lookthis').click(function(){
		  var $id=$(this).attr('data-id');
      var $url=$(this).attr('data-url');
      var $title=$(this).attr('data-title');
	    layer.open({
  			type: 2,
  			title: '查看'+$title,
  			scrollbar: false,
  			area: ['780px', '500px'],
  			fixed: false, //不固定
  			maxmin: true,
  			content: $url+'?id='+$id
	    });
	});
	$('.commentthis').click(function(){
        var $url=$(this).attr('data-url');
        var $id=$(this).attr('data-id');
        $.ajax({
              url  : $url,
              type : 'post',
              data : {'gid':$id},
              dataType : 'json',
              success:function(data,status){
                  if(data.status==1){
                    layer.open({
        							type: 2,
        							title: '写评论',
        							scrollbar: false,
        							area: ['580px', '350px'],
        							fixed: false, //不固定
        							maxmin: true,
        							content: data.url +'?gid=' + $id
        					    });
                    }else{
                      layer.msg(data.info, {
                        icon: data.status,time:1500
                      },function(){
                          window.location.href = data.url;
                      });
                    }
              },
              error : function (xhr,textStatus) {
                alert(xhr);
              }
          });
	    
	});
	$('.submit-comment-sub-form').on('click',function(){
      $addoption=$(this);
      layer.msg('您确定发表评论嘛？', {
        time: 0 //不自动关闭
        ,btn: ['确定', '取消']
        ,yes:function(index){
          layer.close(index);
          var $url=$addoption.attr('data-url');
          $.ajax({
              url  : $url,
              type : 'post',
              data : $("#comment-sub-form").serialize(),
              dataType : 'json',
              success:function(data,status){
                  if(data.status==1){
                      layer.msg(data.info, {
                        icon: data.status,time:1500
                      },function(){
                          window.location.reload();
                      });
                    }else{
                      layer.msg(data.info, {
                        icon: data.status,time:1500
                      });
                    }
              },
              error : function (xhr,textStatus) {
                alert(xhr);
              }
          });
        }
      });
    });
});