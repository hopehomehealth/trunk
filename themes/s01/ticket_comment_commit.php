<!DOCTYPE html>
<html lang="en">
<head>
    <?include('meta.php');?>
    <?load_mobile('http://'.$g_config['mobile_domain'].'/'.$c_catalog_key.'/');?>
    <?include('static.php');?>
    <title>����</title>
<script type="text/javascript" src="/themes/s01/js/menpiaoliebiao.js"></script>
<link rel="stylesheet" type="text/css" href="/themes/s01/images/common.css">
<link rel="stylesheet" type="text/css" href="/themes/s01/images/menpiaoliebiao.css">
<link rel="stylesheet" type="text/css" href="/themes/s01/images/list.css">
<link rel="stylesheet" type="text/css" href="/themes/s01/images/zhoubianyoudianping.css">
<script type="text/javascript" src="/themes/s01/js/jquery.js "></script>
<script type="text/javascript" src="/themes/s01/js/common.js"></script>
</head>
<body>
	<!--  nav����  end -->
<?include('head.php');?>




	<div id="myOrder_mainBox">
		<div id="myOrder_main">
            <div class="currentPos">��ǰλ�ã�<a href="<?=$g_bus365_domain?>">�й���·��Ʊ��</a> &gt; <a href="<?=$g_bus365_domain?>/index/order/orders/">�ҵĶ���</a> &gt; ������</div>
			
			<div class="myOrder_mainContent">
				<div class="myOrder_mainLeft">
					<div class="myOrder_mainLeftTitle">�ҵ�BUS365</div>
					<dl>
						<dt style="background-position:20px 0;">��������</dt>
                        <a href="<?=$g_bus365_domain?>/index/order/orders/"><dd class="myOrder_hover1">�ҵĶ��� <span>&gt;</span></dd></a>
					</dl>
					<dl>
						<dt style="background-position:20px -45px;">��Ա����</dt>
                        <a href="<?=$g_bus365_domain?>/user/touserinfo/0"><dd>��Ա��Ϣ<span>&gt;</span></dd></a>
                        <a href="<?=$g_bus365_domain?>/user/touserprivate/0"><dd>��Ա��ȫ<span>&gt;</span></dd></a>
                        <a href="<?=$g_bus365_domain?>/passenger/getPiList/0?page=1&size=5"><dd>���ó˳���ϵ�˹���<span>&gt;</span></dd></a>
                        <a href="<?=$g_bus365_domain?>/coupon0"><dd>�ҵ��Ż�ȯ<span>&gt;</span></dd></a>
					</dl>
				</div>
				
				<div class="orderDetail_noEvaluate_main">
					<div class="orderDetail_noEvaluate_main1">
						<span>�����ţ�<?=$orderCode;?></span>
					</div>
<!--                    	<form method="post" id="commit_form" action="--><?//=$nowUrl?><!----><?//=$flagcm?><!--">-->
                    <form method="post" id="commit_form" action="<?=$g_self_domain;?>/menpiao/ticket_comment_commit-<?=$orderCode;?>.html?flag=cm">
                        <input type="hidden" id="pingjia" name="commentLevel" value="">
					<div class="orderDetail_noEvaluate_main2">
						<ul>
							<li>����<span class="haoping"></span></li>
							<li>����<span class="zhongping"></span></li>
							<li>����<span class="chaping"></span></li>
						</ul>
					</div>

					<div class="evaluateCont">
						<textarea id="area" name="content" value="" maxlength="300" required="required" placeholder='˵˵�������⣬���ǻ���õ�Ϊ������Ŷ~  300������'></textarea><p><span id="text-count">300</span>/300</p>
					</div>
                    </form>
					<button onclick="commit_comment()">�ύ����</button>

				</div>
			</div>
		</div>
	</div>

<script type="text/javascript">  
    /*��������*/  
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
	//����
	//����
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
	//����
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
	//����
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