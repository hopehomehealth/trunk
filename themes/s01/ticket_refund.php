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
<!--  nav����  end -->

<!-- �����˿� start -->
<div id="applyRefund_mainBox">
    <div id="applyRefund_main">
        <div class="applyRefund_main_cont">
            <p><?echo $require_refund_data['refundCustomerInfo'];?></p>
            <div class="applyRefund_main_info">
                <div class="applyRefund_main_info_title">������Ϣ��</div>
                <ul>
                    <li>�����ţ�<?echo $require_refund_data['orderCode'];?></li>
                    <li>��Ʒ����<?echo $require_refund_data['productName'];?></li>
                </ul>
            </div>
        </div>
        <button class="cancelOrder">ȡ������</button>
        <button class="payNow">��������</button>
    </div>
</div>
<!-- �����˿� end -->


<!--  foot  start -->
<?include 'foot.php'?>
<!--  foot  end -->
</body>
<script type="text/javascript" src="/themes/s01/js/jquery.js"></script>
<script type="text/javascript" src="/themes/s01/js/common.js"></script>
<script type="text/javascript">

</script>
</html>






