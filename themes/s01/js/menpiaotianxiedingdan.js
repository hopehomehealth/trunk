$(document).ready(function () {
	// 门票数量加减
	var counts = $('.counts').html();
	if(counts == 1){
		$('.add').css("color","#fe8800");
		$('.subtract').css("color","");
	}else{
		$('.subtract').css("color","#fe8800");
	}

    // var singlePrice = $('#zongjia').val();
    // $('.danjia').html("&yen;"+singlePrice);
    // $('.danjia1').html(counts+"x &yen;"+singlePrice);
    // $('.totalPrice').html(counts*singlePrice);
    // $('.add').click(function(){
    //     counts++;
    //     $('.counts').html(counts);
    //     $('.danjia1').html(counts+"x &yen;"+singlePrice);
    //     $('.totalPrice').html(counts*singlePrice);
    // });
    // $('.subtract').click(function(){
    //     if(counts == 1){
    //
    //     }else{
    //         counts--;
    //         $('.counts').html(counts);
    //         $('.totalPrice').html(counts*singlePrice);
    //         $('.danjia1').html(counts+"x &yen;"+singlePrice);
    //         $('.totalPrice').html(counts*singlePrice);
    //     }
    // });

    //
	// //日期插件
	// var d = new Date();
    // //d.setDate(21);
    // var _year = d.getFullYear();
    // var _month = d.getMonth()+1;
    // var _date = d.getDate();
    // var _week = d.getDay();
    // var _month1 = _month;
    // $('.date').val(_year+'-'+_month+'-'+_date);
    // var startDate = _year+'-'+_month+'-'+_date;
    // var endDate = '';
    // if((_month+1)>12){
     //    _year++;
     //    _month = 01;
     //    endDate = _year+'-'+_month+'-'+_date;
    // }else{
     //    endDate = _year+'-'+(_month+1)+'-'+_date;
    // }
    //
	// $('#datepicker').datepicker({
     //        'format': 'yyyy-mm-dd',
     //        'autoclose': true,
     //        'todayHighlight':true,
     //        //'language':'en',
     //        'startDate':startDate||0,
     //        //'endDate':endDate||0,
     //        'startView':'',
     //        //'calendarWeeks':true,
     //        //'todayBtn':'linked',
     //        //'clearBtn':true,
     //        'date-range':'',
     // });

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


});


