$(function(){
	
	$(".ind_nav li").click(function(){
		$(this).addClass("on").siblings().removeClass("on");
	});
	
	$("#klq").click(function(){
		$('.ind_klq').show();
		$('.ind_ylq').hide();
		$('.ind_ygq').hide();
	});
	$("#ylq").click(function(){
		$('.ind_klq').hide();
		$('.ind_ylq').show();
		$('.ind_ygq').hide();
	});
	$("#ygq").click(function(){
		$('.ind_klq').hide();
		$('.ind_ylq').hide();
		$('.ind_ygq').show();
	});
	
	$(".ind_klq a").click(function(){
		$('.tc_bg').show();
	});
	$(".tc_close").click(function(){
		$('.tc_bg').hide();
	});
	
	$(".date_nav li").click(function(){
		$(this).addClass("on").siblings().removeClass("on");
	});
	
	
	$("#date_1").click(function(){
		$('#pro_1').show();
		$('#pro_2').hide();
		$('#pro_3').hide();
		$('#pro_4').hide();
		$('#pro_5').hide();
	});
	$("#date_2").click(function(){
		$('#pro_1').hide();
		$('#pro_2').show();
		$('#pro_3').hide();
		$('#pro_4').hide();
		$('#pro_5').hide();
	});
	$("#date_3").click(function(){
		$('#pro_1').hide();
		$('#pro_2').hide();
		$('#pro_3').show();
		$('#pro_4').hide();
		$('#pro_5').hide();
	});
	$("#date_4").click(function(){
		$('#pro_1').hide();
		$('#pro_2').hide();
		$('#pro_3').hide();
		$('#pro_4').show();
		$('#pro_5').hide();
	});
	$("#date_5").click(function(){
		$('#pro_1').hide();
		$('#pro_2').hide();
		$('#pro_3').hide();
		$('#pro_4').hide();
		$('#pro_5').show();
	});
	
});	


