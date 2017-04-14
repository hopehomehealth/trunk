<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="gbk">
    <title></title>
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/common.css">
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/ticket_refund_success.css">
</head>
<body>
<!--  head  start -->
<?include 'static.php';?>
<?include 'head.php';?>
<!-- head  end -->
<!--  nav导航  end -->

<!-- 申请退款 start -->
<div id="applyRefund_mainBox">
    <div id="applyRefund_main">
        <div class="applyRefund_main_cont">
            <p><?echo $require_refund_data['refundCustomerInfo'];?></p>
            <div class="applyRefund_main_info">
                <div class="applyRefund_main_info_title">订单信息：</div>
                <ul>
                    <li>订单号：<?echo $require_refund_data['orderCode'];?></li>
                    <li>产品名：<?echo $require_refund_data['productName'];?></li>
                </ul>
            </div>
        </div>
        <button class="cancelOrder">取消订单</button>
        <button class="payNow">立即付款</button>
    </div>
</div>
<!-- 申请退款 end -->


<!--  foot  start -->
<?include 'foot.php'?>
<!--  foot  end -->
</body>
<script type="text/javascript" src="/themes/s01/js/jquery.js"></script>
<script type="text/javascript" src="/themes/s01/js/common.js"></script>
<script type="text/javascript">

</script>
</html>






