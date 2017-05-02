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
		$('.unfold').css("background","url('images/uptriangle.png') no-repeat right center");
		$('.unfold').html('收起');
		$('.friendLinks').css({
			"height":"auto"
		});
		friendLink_flag = 0;
	}else{
		$('.unfold').css("background","url('images/subtriangle.png') no-repeat right center");
		$('.unfold').html('展开');
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
		if($(".searchMain1_l span").html()=='景点门票'){
			$('.search_form').remove();
			$('body').append('<form  action="http://traveld.bus365.com/menpiao/" method="" class="search_form"><input type="hidden" name="keyWord" class="search_cont1" value="'+$(".searchMain1_l span").html()+'"><input type="hidden" name="keyWord" class="search_cont2" value="'+$('.searchMain1_c input').val()+'"></form>');
			//$('.search_form').attr('action','');
			$('.search_form').submit();
		}else if($(".searchMain1_l span").html()=='周边游'){
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
// 			if($(".searchMain1_l span").html()=='景点门票'){
// 				$('.search_form').remove();
// 				$('body').append('<form  action="http://traveld.bus365.cn/menpiao/" method="" class="search_form"><input type="hidden" name="keyWord" class="search_cont1" value="'+$(".searchMain1_l span").html()+'"><input type="hidden" name="keyWord" class="search_cont2" value="'+$('.searchMain1_c input').val()+'"></form>');
// 				//$('.search_form').attr('action','');
// 				$('.search_form').submit();
// 			}else if($(".searchMain1_l span").html()=='周边游'){
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
		if($(".searchMain1_l span").html()=='景点门票'){
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
		}else if($(".searchMain1_l span").html()=='周边游'){
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
