<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="gbk">
	<title></title>
	<link rel="stylesheet" type="text/css" href="/themes/s01/images/yudingError.css">
</head>
<?include ('head.php');?>
<body>
	<!-- Ԥ������ʧ�� start-->
	<div id="zby_orderError_mainBox">
		<div id="zby_orderError_main">
			<div class="zby_orderError_main_title">
				<img src="/themes/s01/images/reserve_error.png">
			</div>

			<div class="zby_orderError_main1">
				<div class="zby_orderError_main1_cont">
					<span>����֧��ʧ��...</span>
					<p style="color: #666;line-height: 18px;">��ǰδ�յ����л������ƽ̨��֧��ȷ�ϣ�Ϊ�����ظ�֧������ȷ���������п���ƽ̨�˻��Ƿ��Ѿ��ۿ�<br>���ѿۿ�����ϵ�й���·��Ʊ���ͷ� <a>40099-84365/40008-84365</a></p>
					<p>����ȷ�Ϻţ�<a><?= $orderCode?></a></p>
					<p>��Ʒ���ƣ�<?= $goodsName?></p>
					<p>�������ڣ�<?= $departdate?></p>

					<div class="error_btns">
						<button class="error_cancel">ȡ������</button>
						<button class="error_jixu">����֧��</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Ԥ�������ɹ� end-->

<!--ȥ֧����-->
<form action="<?=$g_self_domain?>/zhoubianyou/zbyonline_pay-1.html" method="post" id="onlineForm">
    <input type="hidden" name="payPrice" value="<?=$payPrice?>">
    <input type="hidden" name="goodsName" id="goodsName" value="<?=$goodsName?>">
    <input type="hidden" name="payTime"  value="<?=$leftPayTime?>">
    <input type="hidden" name="lvGoodsName"  value="<?=$lvGoodsName?>">
    <input type="hidden" name="orderCode"  value="<?=$orderCode?>">
</form>
<?include ('foot.php');?>
</body>
<script type="text/javascript" src="/themes/s01/js/jquery.js"></script>
<script type="text/javascript" src="/themes/s01/js/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){
});
//ȡ������
$('.error_cancel').click(function () {
    window.location.href = "/zhoubianyou/zbyorder_detail-" + <?=$orderCode;?> +".html?flag=cn" ;
});
//����֧��
$('.error_jixu').click(function () {
    $('#onlineForm').submit();
});


</script>
</html>