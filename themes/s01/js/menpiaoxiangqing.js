$(document).ready(function () {


  // 门票景点轮播图展示

  	//小图片个数
  	var img_counts = $('.smallPicBox ul li').length;
  	var current_index = 0;
  	var current_index1 = 0;
  	//点击小图片
	$('.smallPicBox ul li').click(function(){
		$(this).addClass("smallPic_hover").siblings("li").removeClass("smallPic_hover");
		$('.bigPic').attr("src",$(this).find('img').attr('src'));
		current_index = $(this).index();
		current_index1 = $(this).index();
		if(current_index<($('.smallPicBox ul li').length-4)){
			//$('.smallPicBox ul li').eq(current_index).addClass("smallPic_hover").siblings("li").removeClass("smallPic_hover");
			$('.smallPicBox ul').css({
				"top":"-"+70*current_index+"px"
			});
		}else{
			//$('.smallPicBox ul li').eq(current_index).addClass("smallPic_hover").siblings("li").removeClass("smallPic_hover");
			$('.smallPicBox ul').css({
				"top":"-"+70*($('.smallPicBox ul li').length-4)+"px"
			});
		}
		if(current_index!=0){
			$('#lunbo_pre').css({
				"backgroundPosition":"0px 0px"
			});
		}else{
			$('#lunbo_pre').css({
				"backgroundPosition":"0px -33px"
			});
		}
		if(current_index == $('.smallPicBox ul li').length-1){
			$('#lunbo_next').css({
				"backgroundPosition":"-35px -33px"
			});
		}else{
			$('#lunbo_next').css({
				"backgroundPosition":"-35px 0px"
			});
		}
	});
	// 点击下一个
	$('#lunbo_next').click(function(){
		if(current_index<($('.smallPicBox ul li').length-4)){
			current_index++;
			current_index1++;
			$('.smallPicBox ul li').eq(current_index).addClass("smallPic_hover").siblings("li").removeClass("smallPic_hover");
			$('.bigPic').attr("src",$('.smallPicBox ul li').eq(current_index).find('img').attr('src'));
			$('.smallPicBox ul').css({
				"top":"-"+70*current_index+"px"
			});
		}else if(current_index<$('.smallPicBox ul li').length || current_index==$('.smallPicBox ul li').length){
			current_index++;
			current_index1++;
			$('.smallPicBox ul li').eq(current_index1).addClass("smallPic_hover").siblings("li").removeClass("smallPic_hover");
			$('.bigPic').attr("src",$('.smallPicBox ul li').eq(current_index).find('img').attr('src'));
		}
		if(current_index!=0){
			$('#lunbo_pre').css({
				"backgroundPosition":"0px 0px"
			});
		}else{
			$('#lunbo_pre').css({
				"backgroundPosition":"0px -33px"
			});
		}
		if(current_index == $('.smallPicBox ul li').length-1){
			$('#lunbo_next').css({
				"backgroundPosition":"-35px -33px"
			});
		}else{
			$('#lunbo_next').css({
				"backgroundPosition":"-35px 0px"
			});
		}
	});
	// 点击上一个
	$('#lunbo_pre').click(function(){
		if(current_index>0 && current_index<($('.smallPicBox ul li').length-4) || current_index == ($('.smallPicBox ul li').length-4)){
			current_index--;
			current_index1--;
			$('.smallPicBox ul li').eq(current_index).addClass("smallPic_hover").siblings("li").removeClass("smallPic_hover");
			$('.bigPic').attr("src",$('.smallPicBox ul li').eq(current_index).find('img').attr('src'));
			$('.smallPicBox ul').css({
				"top":"-"+70*current_index+"px"
			});
		}else if(current_index>($('.smallPicBox ul li').length-4)){
			current_index--;
			current_index1--;
			$('.smallPicBox ul li').eq(current_index1).addClass("smallPic_hover").siblings("li").removeClass("smallPic_hover");
			$('.bigPic').attr("src",$('.smallPicBox ul li').eq(current_index).find('img').attr('src'));
		}
		if(current_index!=0){
			$('#lunbo_pre').css({
				"backgroundPosition":"0px 0px"
			});
		}else{
			$('#lunbo_pre').css({
				"backgroundPosition":"0px -33px"
			});
		}
		if(current_index == $('.smallPicBox ul li').length-1){
			$('#lunbo_next').css({
				"backgroundPosition":"-35px -33px"
			});
		}else{
			$('#lunbo_next').css({
				"backgroundPosition":"-35px 0px"
			});
		}
	});



	for (var i = 0; i < $('.jtzn_infoLeft ul li').length; i++){
		$('.jtzn_infoLeft ul li').eq(i).click(function(){
			$('.jtzn_infoLeft ul li').eq($(this).index()).addClass("li_hover1").siblings('li').removeClass('li_hover1');
			$('.jt_info'+($(this).index()+1)).show().siblings("div").hide();
		});
	}
	//console.log();
	$('.spotListDetail_main3Tab ul li').eq(0).click(function(){
		$(this).addClass('main3TabSelected').siblings().removeClass('main3TabSelected');
		$(document).scrollTop($('.spotListDetail_main3Left1').offset().top-42)
	});
	$('.spotListDetail_main3Tab ul li').eq(1).click(function(){
		$(this).addClass('main3TabSelected').siblings().removeClass('main3TabSelected');
		$(document).scrollTop($('.spotListDetail_main3Left2').offset().top-42)
	});
	$('.spotListDetail_main3Tab ul li').eq(2).click(function(){
		$(this).addClass('main3TabSelected').siblings().removeClass('main3TabSelected');
		$(document).scrollTop($('.spotListDetail_main3Left3').offset().top-42)
	});
    $('.baiduMap').click(function(){
        $(document).scrollTop($('.spotListDetail_main3Left3').offset().top-42)
    });


	//景点门票的提示信息展开收起
	var spotListDetail_main2_table1Right = $('.spotListDetail_main2_table ul');
	var spotTicket_pickUp = $('.spotTicket_pickUp');
	//console.log(spotListDetail_main2_table1Right.length);
	for (var i = 0; i < spotListDetail_main2_table1Right.length; i++) {
		$('.spotListDetail_main2_table ul').eq(i).attr("flag","1");
		spotListDetail_main2_table1Right[i].index = i;
		spotListDetail_main2_table1Right[i].onclick = function(){
			if($(this).attr("flag")==1){
				$('.spotTicket_infoHide').eq(this.index).show();
				$('.spotListDetail_main2_table ul').eq(this.index).find('.subtriangle').addClass('uptriangle');
				$(this).attr("flag","0");
			}else if($(this).attr("flag")==0){
				$('.spotTicket_infoHide').eq(this.index).hide();
				$('.spotListDetail_main2_table ul').eq(this.index).find('.subtriangle').removeClass('uptriangle');
				$(this).attr("flag","1");
			}
			
		};
		spotTicket_pickUp[i].index = i;
		spotTicket_pickUp[i].onclick = function(){
			$('.spotTicket_infoHide').eq(this.index).hide();
			$('.spotListDetail_main2_table ul').eq(this.index).find('.subtriangle').removeClass('uptriangle');
			$('.spotListDetail_main2_table ul').eq(this.index).attr("flag","1");
		};
	}

	var top1 = $('.spotListDetail_main3Tab').offset().top;
    $(document).scroll(function(event) {
        var value1 = $(document).scrollTop()-top1;
        if(value1 > 0 || value1 == 0){
            $('.spotListDetail_main3Tab').css({
                "position":"fixed",
                "top":"0",
                "zIndex":"999"
            });
            //alert(1);
        }else{
            $('.spotListDetail_main3Tab').css({
                "position":""
            });
        }
    });

    $('.reserveNow').click(function(){
        $(document).scrollTop($('.spotListDetail_main2').offset().top);
    });




    // lunbo
	 var _SlideshowTransitions = [
                                   {$Duration:1200,y:-0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:12},$Easing:{$Top:$JssorEasing$.$EaseInCubic,$Opacity:$JssorEasing$.$EaseLinear},$Opacity:2},
								   {$Duration:1000,y:4,$Zoom:11,$Easing:{$Top:$JssorEasing$.$EaseInCubic,$Zoom:$JssorEasing$.$EaseInCubic,$Opacity:$JssorEasing$.$EaseOutQuad},$Opacity:2},
								   {$Duration:1200,y:1,$Rows:2,$Zoom:1,$ChessMode:{$Row:15},$Easing:{$Top:$JssorEasing$.$EaseInCubic,$Zoom:$JssorEasing$.$EaseInCubic,$Opacity:$JssorEasing$.$EaseLinear},$Assembly:2049,$Opacity:2},
								   {$Duration:1500,x:-1,y:0.5,$Delay:60,$Cols:8,$Rows:4,$Formation:$JssorSlideshowFormations$.$FormationSquare,$Easing:{$Left:$JssorEasing$.$EaseSwing,$Top:$JssorEasing$.$EaseInWave},$Assembly:260,$Round:{$Top:1.5}},
								   {$Duration:600,x:-1,y:-1,$Delay:50,$Cols:8,$Rows:4,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationZigZag,$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$JssorEasing$.$EaseInCubic,$Top:$JssorEasing$.$EaseInCubic,$Opacity:$JssorEasing$.$EaseOutQuad},$Assembly:1028,$Opacity:2},
								   {$Duration:1000,x:-0.5,y:0.5,$Zoom:1,$Rotate:1,$SlideOut:true,$Easing:{$Left:$JssorEasing$.$EaseInCubic,$Top:$JssorEasing$.$EaseInCubic,$Zoom:$JssorEasing$.$EaseInCubic,$Opacity:$JssorEasing$.$EaseLinear,$Rotate:$JssorEasing$.$EaseInCubic},$Opacity:2,$Round:{$Rotate:0.5}},
								   {$Duration:1800,x:1,y:0.2,$Delay:30,$Cols:10,$Rows:5,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$Reverse:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Easing:{$Left:$JssorEasing$.$EaseInOutSine,$Top:$JssorEasing$.$EaseOutWave,$Clip:$JssorEasing$.$EaseInOutQuad},$Assembly:2050,$Round:{$Top:1.3}},
								   {$Duration:1800,x:1,$Delay:30,$Cols:10,$Rows:5,$Clip:15,$During:{$Left:[0.3,0.7]},$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Easing:{$Left:$JssorEasing$.$EaseInOutExpo,$Clip:$JssorEasing$.$EaseInOutQuad},$Assembly:260,$Outside:true,$Round:{$Top:0.8}},
								   {$Duration:1800,x:1,$Delay:30,$Cols:10,$Rows:5,$Clip:15,$During:{$Left:[0.3,0.7]},$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Easing:{$Left:$JssorEasing$.$EaseInOutExpo,$Clip:$JssorEasing$.$EaseInOutQuad},$Assembly:260,$Outside:true,$Round:{$Top:0.8}},
								   {$Duration:1500,x:0.3,y:-0.3,$Delay:20,$Cols:8,$Rows:4,$Clip:15,$During:{$Left:[0.1,0.9],$Top:[0.1,0.9]},$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Easing:{$Left:$JssorEasing$.$EaseInJump,$Top:$JssorEasing$.$EaseInJump,$Clip:$JssorEasing$.$EaseOutQuad},$Assembly:260,$Outside:true,$Round:{$Left:0.8,$Top:2.5}},
								   {$Duration:1200,x:2,y:1,$Cols:2,$Zoom:11,$Rotate:1,$ChessMode:{$Column:15},$Easing:{$Left:$JssorEasing$.$EaseInCubic,$Top:$JssorEasing$.$EaseInCubic,$Zoom:$JssorEasing$.$EaseInCubic,$Opacity:$JssorEasing$.$EaseOutQuad,$Rotate:$JssorEasing$.$EaseInCubic},$Assembly:2049,$Opacity:2,$Round:{$Rotate:0.7}},
								   {$Duration:1000,$Rows:6,$Clip:4,$Move:true},
								   {$Duration:800,$Delay:150,$Cols:10,$Clip:1,$Move:true,$Formation:$JssorSlideshowFormations$.$FormationCircle,$Easing:$JssorEasing$.$EaseInBounce,$Assembly:264},
								   {$Duration:600,x:-1,y:1,$Delay:30,$Cols:8,$Rows:4,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Easing:{$Left:$JssorEasing$.$EaseInQuart,$Top:$JssorEasing$.$EaseInQuart,$Opacity:$JssorEasing$.$EaseLinear},$Opacity:2}
								   
                                ];
	   var options = { 
	       $AutoPlay: true,
		   $SlideshowOptions: {
              $Class: $JssorSlideshowRunner$,
              $Transitions: _SlideshowTransitions,
              $TransitionsOrder: 1,
              $ShowLink: true
            },
			$ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
            },
            $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
            }
	    };
       var jssor_slider1 = new $JssorSlider$('slider1_container', options);


// 百度地图API
       function initMap(){
	        createMap();//创建地图
	        setMapEvent();//设置地图事件
	        addMapControl();//向地图添加控件
	    }
	    
	    //创建地图函数：
	    function createMap(){
	        var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
	        var point = new BMap.Point(116.501432,39.873859);//定义一个中心点坐标
	        map.centerAndZoom(point,16);//设定地图的中心点和坐标并将地图显示在地图容器中
	        window.map = map;//将map变量存储在全局
	    }
	    
	    //地图事件设置函数：
	    function setMapEvent(){
	        map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
	        map.enableScrollWheelZoom();//启用地图滚轮放大缩小
	        map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
	        map.enableKeyboard();//启用键盘上下左右键移动地图
	    }
	    
	    //地图控件添加函数：
	    function addMapControl(){
	        //向地图中添加缩放控件
		var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
		map.addControl(ctrl_nav);
	        //向地图中添加缩略图控件
		var ctrl_ove = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:0});
		map.addControl(ctrl_ove);
	        //向地图中添加比例尺控件
		var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
		map.addControl(ctrl_sca);
	    }
	    
	    
	    //initMap();//创建和初始化地图


});