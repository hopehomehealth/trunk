<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="/themes/s01/images/yudingError.css">
</head>
<?include ('head.php');?>

<body>
	<!-- 预定订单失败 start-->
	<div id="zby_orderError_mainBox">
		<div id="zby_orderError_main">
			<div class="zby_orderError_main_title">
				<img src="/themes/s01/images/reserve_error.png">
			</div>

			<div class="zby_orderError_main1">
				<div class="zby_orderError_main1_cont">
					<span>订单支付失败...</span>
					<p style="color: #666;line-height: 18px;">当前未收到银行或第三方平台的支付确认，为避免重复支付，请确认您的银行卡或平台账户是否已经扣款<br>如已扣款请联系中国公路客票网客服 <a>40099-84365/40008-84365</a></p>
					<p>订单确认号：<a>Z73961527</a></p>
					<p>产品名称：北京景山公园优待票[学生、老人专用]</p>
					<p>游玩日期：2017-03-06</p>

					<div class="error_btns">
						<button class="error_cancel">取消订单</button>
						<button class="error_jixu">继续支付</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 预定订单成功 end-->

<?include ('foot.php');?>
</body>
<script type="text/javascript" src="/themes/s01/js/jquery.js"></script>
<script type="text/javascript" src="/themes/s01/js/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){



});
</script>
</html>