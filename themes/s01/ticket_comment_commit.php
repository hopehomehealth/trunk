<!DOCTYPE html>
<html lang="en">
<head>
    <?include('meta.php');?>
    <?load_mobile('http://'.$g_config['mobile_domain'].'/'.$c_catalog_key.'/');?>
    <?include('static.php');?>
    <title>评论</title>
<script type="text/javascript" src="/themes/s01/js/menpiaoliebiao.js"></script>
<link rel="stylesheet" type="text/css" href="/themes/s01/images/common.css">
<link rel="stylesheet" type="text/css" href="/themes/s01/images/menpiaoliebiao.css">
<link rel="stylesheet" type="text/css" href="/themes/s01/images/list.css">
<link rel="stylesheet" type="text/css" href="/themes/s01/images/zhoubianyoudianping.css">
<script type="text/javascript" src="/themes/s01/js/jquery.js "></script>
<script type="text/javascript" src="/themes/s01/js/common.js"></script>
</head>
<body>
	<!--  nav导航  end -->
<?include('head.php');?>




	<div id="myOrder_mainBox">
		<div id="myOrder_main">
            <div class="currentPos">当前位置：<a href="<?=$g_bus365_domain?>">中国公路客票网</a> &gt; <a href="<?=$g_bus365_domain?>/index/order/orders/">我的订单</a> &gt; 待点评</div>
			
			<div class="myOrder_mainContent">
				<div class="myOrder_mainLeft">
					<div class="myOrder_mainLeftTitle">我的BUS365</div>
					<dl>
						<dt style="background-position:20px 0;">订单中心</dt>
                        <a href="<?=$g_bus365_domain?>/index/order/orders/"><dd class="myOrder_hover1">我的订单 <span>&gt;</span></dd></a>
					</dl>
					<dl>
						<dt style="background-position:20px -45px;">会员中心</dt>
                        <a href="<?=$g_bus365_domain?>/user/touserinfo/0"><dd>会员信息<span>&gt;</span></dd></a>
                        <a href="<?=$g_bus365_domain?>/user/touserprivate/0"><dd>会员安全<span>&gt;</span></dd></a>
                        <a href="<?=$g_bus365_domain?>/passenger/getPiList/0?page=1&size=5"><dd>常用乘车联系人管理<span>&gt;</span></dd></a>
                        <a href="<?=$g_bus365_domain?>/coupon0"><dd>我的优惠券<span>&gt;</span></dd></a>
					</dl>
				</div>
				
				<div class="orderDetail_noEvaluate_main">
					<div class="orderDetail_noEvaluate_main1">
						<span>订单号：<?=$orderCode;?></span>
					</div>
<!--                    	<form method="post" id="commit_form" action="--><?//=$nowUrl?><!----><?//=$flagcm?><!--">-->
                    <form method="post" id="commit_form" action="<?=$g_self_domain;?>/menpiao/ticket_comment_commit-<?=$orderCode;?>.html?flag=cm">
                        <input type="hidden" id="pingjia" name="commentLevel" value="">
					<div class="orderDetail_noEvaluate_main2">
						<ul>
							<li>好评<span class="haoping"></span></li>
							<li>中评<span class="zhongping"></span></li>
							<li>差评<span class="chaping"></span></li>
						</ul>
					</div>

					<div class="evaluateCont">
						<textarea id="area" name="content" value="" maxlength="300" required="required" placeholder='说说哪里满意，我们会更好的为您服务哦~  300字以内'></textarea><p><span id="text-count">300</span>/300</p>
					</div>
                    </form>
					<button onclick="commit_comment()">提交评价</button>

				</div>
			</div>
		</div>
	</div>

<script type="text/javascript">  
    /*字数限制*/  
    $("#area").on("input propertychange", function() {  
        var $this = $(this),  
            _val = $this.val(),  
            count = "";  
        if (_val.length > 300) {  
            $this.val(_val.substring(0, 300));  
        }  
        count = 300 - $this.val().length;  
        $("#text-count").text(count);  
    });  
</script>  


	<!--  foot  start -->
<?include('foot.php');?>
	<!--  foot  end -->
</body>
<script type="text/javascript">
var pingjia = document.getElementById('pingjia');
$(document).ready(function(){
	//点评
	//好评
	$('.haoping').click(function(){
		$("#pingjia").val('1');
		if($('.haoping').css("backgroundPosition")=="0px -32px"){
			$('.haoping').css("backgroundPosition","0px 0px");
			$('.zhongping').css("backgroundPosition","-32px 0px");
			$('.chaping').css("backgroundPosition","-64px 0px");
		}else{
			$('.haoping').css("backgroundPosition","0px -32px");
			$('.zhongping').css("backgroundPosition","-32px 0px");
			$('.chaping').css("backgroundPosition","-64px 0px");
		}
	});
	//中评
	$('.zhongping').click(function(){
		$("#pingjia").val('2');
		if($('.zhongping').css("backgroundPosition")=="-32px 0px"){
			$('.haoping').css("backgroundPosition","0px 0px");
			$('.zhongping').css("backgroundPosition","-32px -32px");
			$('.chaping').css("backgroundPosition","-64px 0px");
		}else{
			$('.haoping').css("backgroundPosition","0px 0px");
			$('.zhongping').css("backgroundPosition","-32px 0px");
			$('.chaping').css("backgroundPosition","-64px 0px");
		}
	});
	//差评
	$('.chaping').click(function(){
		$("#pingjia").val('3');
		if($('.chaping').css("backgroundPosition")=="-64px 0px"){
			$('.haoping').css("backgroundPosition","0px 0px");
			$('.zhongping').css("backgroundPosition","-32px 0px");
			$('.chaping').css("backgroundPosition","-64px -32px");
		}else{
			$('.haoping').css("backgroundPosition","0px 0px");
			$('.zhongping').css("backgroundPosition","-32px 0px");
			$('.chaping').css("backgroundPosition","-64px 0px");
		}
	});


});
function commit_comment(){
    document.getElementById("commit_form").submit();
}
</script>

</html>	