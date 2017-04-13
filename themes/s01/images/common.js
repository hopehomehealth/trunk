$(document).ready(function () {
//顶部右侧日期
var d = new Date();
var _year = d.getFullYear();
var _month = d.getMonth()+1;
var _date = d.getDate();
var _week = weekDay(d.getDay());
function weekDay(week){
	switch(week){
		case 0: return '星期日';break;
		case 1: return '星期一';break;
		case 2: return '星期二';break;
		case 3: return '星期三';break;
		case 4: return '星期四';break;
		case 5: return '星期五';break;
		case 6: return '星期六';break;
	}
};
$('#topTime').html(_year+"年"+_month+"月"+_date+"日&nbsp;&nbsp;"+_week+"&nbsp;&nbsp;");

for (var i = 0; i < $('input').length; i++) {
	$('input').eq(i).attr("autocomplete","off");
}

//顶部搜索框全部产品切换
$('.searchMain1_l').hover(function(){
	$('.searchMain1_l ul').show();
	$('.searchMain1_l ul li').click(function(){
		$('.searchMain1_l span').html($(this).html());
		$(this).css({
			"backgroundColor":"#1fcc9e",
			"color":"white"
		}).siblings('li').css({
			"backgroundColor":"",
			"color":""
		});
		$('.searchMain1_l ul').hide();
	});
},function(){
	$('.searchMain1_l ul').hide();
});

//导航-旅游列表
$('.trip_list_btn').hover(function() {
	$('.trip_list').show();
	//$('.trip_list').css({'display':'block'});
}, function() {
	$('.trip_list').hide();
	//$('.trip_list').css({'display':'none'});
});
//我的bus365显示隐藏
$('.mybus365').hover(function() {
	$('.before_login').show();
}, function() {
	$('.before_login').hide();
});


//底部友情链接展开
var friendLink_flag = 1;
$('.unfold').click(function(){
	if(friendLink_flag){
		$('.unfold').css("background","url('/themes/s01/images/uptriangle.png') no-repeat right center");
		$('.unfold').html('收起');
		$('.friendLinks').css({
			"height":"auto"
		});
		friendLink_flag = 0;
	}else{
		$('.unfold').css("background","url('/themes/s01/images/subtriangle.png') no-repeat right center");
		$('.unfold').html('展开');
		$('.friendLinks').css({
			"height":"25px"
		});
		friendLink_flag = 1;
	}
});


$('.date_blue').click(function(){
	//alert($(this).find('.date_yen').eq(0).html());
	if($(this).find('.date_yen').eq(0).html()!=""){
		//alert(2);
	}
});



});
