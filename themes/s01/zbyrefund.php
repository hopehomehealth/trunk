<?
if (!defined('IN_CLOOTA')) {
    exit('Access Denied');
}
$refund_message = req('message');
$goodsName = req('goodsName');
$orderCode = req('orderCode');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="gbk">
    <title>周边游退款</title>
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/common.css">
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/zhoubianyoushenqingtuikuan.css">
</head>
<body>
<!--  head  start -->
<?include 'head.php';?>
<!--  nav导航  end -->

<!-- 申请退款 start -->
<div id="applyRefund_mainBox">
    <div id="applyRefund_main">
        <div class="applyRefund_main_cont">
            <p><?=$refund_message;?></p>
            <div class="applyRefund_main_info">
                <div class="applyRefund_main_info_title">订单信息：</div>
                <ul>
                    <li>订单号：<?=$orderCode;?></li>
                    <li>产品名：<?=$goodsName;?></li>
                </ul>
            </div>
        </div>
        <button class="cancelOrder" onclick="order_view()">查看订单</button>
        <button class="payNow" onclick="return_index()">返回首页</button>
    </div>
</div>
<!-- 申请退款 end -->


<!--  foot  start -->
<?include 'foot.php';?>
<!--  foot  end -->
</body>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript">
  function order_view(){
      var url = "<?=$g_self_domain;?>/zhoubianyou/zbyorder_detail-<?=$orderCode;?>.html";
      window.location.href = url;
  }
  function return_index(){
      var url = "<?=$g_self_domain;?>/zhoubian/";
      window.location.href = url;
  }
</script>
</html>