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
		$('.unfold').css("background","url('images/uptriangle.png') no-repeat right center");
		$('.unfold').html('����');
		$('.friendLinks').css({
			"height":"auto"
		});
		friendLink_flag = 0;
	}else{
		$('.unfold').css("background","url('images/subtriangle.png') no-repeat right center");
		$('.unfold').html('չ��');
		$('.friendLinks').css({
			"height":"25px"
		});
		friendLink_flag = 1;
	}
});


$('.searchMain1_r').click(function(){
	//alert(1);
	if($(".searchMain1_l span").html()!='' && $('.searchMain1_c input').val()!=''){
		//alert(2);
		if($(".searchMain1_l span").html()=='������Ʊ'){
			$('.search_form').remove();
			$('body').append('<form  action="http://traveld.bus365.com/menpiao/" method="" class="search_form"><input type="hidden" name="keyWord" class="search_cont1" value="'+$(".searchMain1_l span").html()+'"><input type="hidden" name="keyWord" class="search_cont2" value="'+$('.searchMain1_c input').val()+'"></form>');
			//$('.search_form').attr('action','');
			$('.search_form').submit();
		}else if($(".searchMain1_l span").html()=='�ܱ���'){
			$('.search_form').remove();
			$('body').append('<form  action="http://traveld.bus365.com/zhoubian/  " method="" class="search_form"><input type="hidden" name="keyWord" class="search_cont1" value="'+$(".searchMain1_l span").html()+'"><input type="hidden" name="keyWord" class="search_cont2" value="'+$('.searchMain1_c input').val()+'"></form>');
			//$('.search_form').attr('action','http://traveld.bus365.cn/zhoubian/');
			$('.search_form').submit();
		}
		
	};

});
// $('.searchMain1_c input').on('keydown',function(event) {
// 	//event.preventDefault();
// 	var e = event || window.event;
// 	var lis = $('#search_auto ul li').length;
// 	//alert(lis);
// 	if(e.keyCode==38){//up
			
// 	}
// 	else if(e.keyCode==40){//down
		
// 	}
// 	else if(e.keyCode==13){//enter
// 		if($(".searchMain1_l span").html()!='' && $('.searchMain1_c input').val()!=''){
// 			//alert(2);
// 			if($(".searchMain1_l span").html()=='������Ʊ'){
// 				$('.search_form').remove();
// 				$('body').append('<form  action="http://traveld.bus365.cn/menpiao/" method="" class="search_form"><input type="hidden" name="keyWord" class="search_cont1" value="'+$(".searchMain1_l span").html()+'"><input type="hidden" name="keyWord" class="search_cont2" value="'+$('.searchMain1_c input').val()+'"></form>');
// 				//$('.search_form').attr('action','');
// 				$('.search_form').submit();
// 			}else if($(".searchMain1_l span").html()=='�ܱ���'){
// 				$('.search_form').remove();
// 				$('body').append('<form  action="http://traveld.bus365.cn/zhoubian/  " method="" class="search_form"><input type="hidden" name="keyWord" class="search_cont1" value="'+$(".searchMain1_l span").html()+'"><input type="hidden" name="keyWord" class="search_cont2" value="'+$('.searchMain1_c input').val()+'"></form>');
// 				//$('.search_form').attr('action','http://traveld.bus365.cn/zhoubian/');
// 				$('.search_form').submit();
// 			}
			
// 		};
// 	}
// });

/*$(document).ready(function(){

	$('.searchMain1_c input').keyup(function(){	
		if($(".searchMain1_l span").html()=='������Ʊ'){
			$.post('<?=$g_self_domain?>/search/',{'value':$(this).val()},function(data){
				// if(data=='0') $('#search_auto').html('').css('display','none');
				// else $('#search_auto').html(data).css('display','block');
				if(data=='0'){
					$('#search_auto').html('').css('display','none');
				}else{
					$('#search_auto').html(data).css('display','block');
					$('#search_auto ul li').click(function(){
						$('.searchMain1_c input').val($(this).html());
						$('#search_auto').html('').css('display','none');
					});
				}
			});
		}else if($(".searchMain1_l span").html()=='�ܱ���'){
			$.post('<?=$g_self_domain?>/searcha/',{'value':$(this).val()},function(data){
				// if(data=='0') $('#search_auto').html('').css('display','none');
				// else $('#search_auto').html(data).css('display','block');
				if(data=='0'){
					$('#search_auto').html('').css('display','none');
				}else{
					$('#search_auto').html(data).css('display','block');
					$('#search_auto ul li').click(function(){
						$('.searchMain1_c input').val($(this).html());
						$('#search_auto').html('').css('display','none');
					});
				}
			});
		}

	});









	$('.searchMain1_c input').blur(function(){
		//if($('#search_auto').html()==''){
			setTimeout(function(){
				//$('.searchMain1_c input').val($('#search_auto ul li').eq(0).html());
				$('#search_auto').html('').css('display','none');
			},200)
		//}
	});

});*/












});
