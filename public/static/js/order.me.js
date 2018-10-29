$(function(){
	$("#checkinfo-address-ul li a").click(function(){
	$(this).parent().addClass(" order-select-item").siblings("li").removeClass(" order-select-item");
});
$("#checkinfo-psmethod-ul li a").click(function(){
	$(this).parent().addClass(" order-select-item").siblings("li").removeClass(" order-select-item");
});
$("#checkinfo-paymethod-ul li a").click(function(){
	$(this).parent().addClass(" order-select-item").siblings("li").removeClass(" order-select-item");
});
});	