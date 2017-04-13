$(document).ready(function () {
//门票列表页目的地、主题更多
var list_moreflag = 1;
var list1_mores = $('.list1_more');
for(var i = 0; i <list1_mores.length; i++){
	list1_mores[i].index = i;
	list1_mores[i].onclick = function(){
		//console.log(this.index);
		if(list_moreflag){
			list1_mores[this.index].innerHTML = "收起";
			$('.list1 ul').eq(this.index).css({
				"height":"auto"
			});
			list_moreflag = 0;
		}else{
			list1_mores[this.index].innerHTML = "更多";
			$('.list1 ul').eq(this.index).css({
				"height":"55px"
			});
			list_moreflag = 1;
		}
	};
}
//景点门票查看全部
var toAll_flag = 1;
var toAlls = $('.toAll');
for(var i = 0; i <toAlls.length; i++){
	toAlls[i].index = i;
	toAlls[i].onclick = function(){
		//console.log(this.index);
		if(toAll_flag){
			$('.lists_hide').eq(this.index).css({
				"display":"block"
			});
			$('.toAll').eq(this.index).removeClass('subtriangle').addClass('uptriangle');
			toAll_flag = 0;
		}else{
			$('.lists_hide').eq(this.index).css({
				"display":"none"
			});
			$('.toAll').eq(this.index).removeClass('uptriangle').addClass('subtriangle');
			toAll_flag = 1;
		}
	};
}

//景点门票的提示信息展开收起
var spotTicket_info = $('.spotTicket_info');
var spotTicket_pickUp = $('.spotTicket_pickUp');
//console.log(spotTicket_info.length);
for (var i = 0; i < spotTicket_info.length; i++) {
	$('.spotTicket_info').eq(i).attr("flag","1");
	spotTicket_info[i].index = i;
	spotTicket_info[i].onclick = function(){
		if($(this).attr("flag")==1){
			$('.spotTicket_infoHide').eq(this.index).show();
			$('.spotTicket').eq(this.index).find('.subtriangle').addClass('uptriangle');
			$(this).attr("flag","0");
		}else if($(this).attr("flag")==0){
			$('.spotTicket_infoHide').eq(this.index).hide();
			$('.spotTicket').eq(this.index).find('.subtriangle').removeClass('uptriangle');
			$(this).attr("flag","1");
		}
	};
	spotTicket_pickUp[i].index = i;
	spotTicket_pickUp[i].onclick = function(){
		$('.spotTicket_infoHide').eq(this.index).hide();
		$('.spotTicket').eq(this.index).find('.subtriangle').removeClass('uptriangle');
		$('.spotTicket_info').eq(this.index).attr("flag","1");
	};
}
	
});