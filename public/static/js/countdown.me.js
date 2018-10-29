var totalsecond=$("#final-re-order").html();
var timedj=setInterval("timeRunDj()",1000);
function timeRunDj(){
	totalsecond--;
	if(totalsecond>0){
		document.getElementById("final-re-order").innerHTML=totalsecond;
	}
	
	if(totalsecond<=1){
		document.getElementById("create-order").innerHTML="订单生成成功，正在跳转...";
	}
	if(totalsecond<=0){
		clearInterval(timedj);
		window.location.href = "/index/user/index";
	}
}