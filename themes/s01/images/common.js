$(document).ready(function () {
//�����Ҳ�����
var d = new Date();
var _year = d.getFullYear();
var _month = d.getMonth()+1;
var _date = d.getDate();
var _week = weekDay(d.getDay());
function weekDay(week){
	switch(week){
		case 0: return '������';break;
		case 1: return '����һ';break;
		case 2: return '���ڶ�';break;
		case 3: return '������';break;
		case 4: return '������';break;
		case 5: return '������';break;
		case 6: return '������';break;
	}
};
$('#topTime').html(_year+"��"+_month+"��"+_date+"��&nbsp;&nbsp;"+_week+"&nbsp;&nbsp;");

for (var i = 0; i < $('input').length; i++) {
	$('input').eq(i).attr("autocomplete","off");
}

//����������ȫ����Ʒ�л�
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

//����-�����б�
$('.trip_list_btn').hover(function() {
	$('.trip_list').show();
	//$('.trip_list').css({'display':'block'});
}, function() {
	$('.trip_list').hide();
	//$('.trip_list').css({'display':'none'});
});
//�ҵ�bus365��ʾ����
$('.mybus365').hover(function() {
	$('.before_login').show();
}, function() {
	$('.before_login').hide();
});


//�ײ���������չ��
var friendLink_flag = 1;
$('.unfold').click(function(){
	if(friendLink_flag){
		$('.unfold').css("background","url('/themes/s01/images/uptriangle.png') no-repeat right center");
		$('.unfold').html('����');
		$('.friendLinks').css({
			"height":"auto"
		});
		friendLink_flag = 0;
	}else{
		$('.unfold').css("background","url('/themes/s01/images/subtriangle.png') no-repeat right center");
		$('.unfold').html('չ��');
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
