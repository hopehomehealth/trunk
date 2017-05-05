<?
if (!defined('IN_CLOOTA')) {
    exit('Access Denied');
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href="static/image/style.css" rel="stylesheet" type="text/css"/>
    <link href="static/js/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

</head>

<body>
<form method="post" action="check_refund_status.php">
    <ul class="nav nav-tabs">
        <li <? if (nav_active('order_refund.php')){ ?>class="active"<? } ?> style="padding-left:20px;">
            <a href="?cmd=<?= base64_encode('order_refund.php') ?>">订单详情</a>
        </li>
    </ul>

    <input type="hidden" name="user_id" value="<?= req('user_id') ?>">
    <table width="100%" class="table">
        <thead>
        <tr>
            <td width="120" style="text-align:right"><strong>姓 名：</strong></td>
            <td><?= $user_name ?></td>
        </tr>
        </thead>

        <tr>
            <td style="text-align:right"><strong>手机号：</strong></td>
            <td><?= $user_phone ?></td>
        </tr>

        <tr>
            <td style="text-align:right"><strong>身份证号：</strong></td>
            <td><?= $user_credentials ?></td>
        </tr>

        <tr>
            <td style="text-align:right"><strong>订单号：</strong></td>
            <td><?= $orderno ?></td>
        </tr>

        <tr>
            <td style="text-align:right"><strong>订单金额：</strong></td>
            <td><?= $query_row['order_fee'] ?></td>
        </tr>
        <tr>
            <td style="text-align:right"><strong>第三方退款金额：</strong></td>
            <td><?= $query_row['thrid_refund_amount'] ?></td>
        </tr>
        <tr>
            <td style="text-align:right"><strong>扣款金额：</strong></td>
            <td><input type="text" name="cutpay" id="cutpay" class="span1"/>元</td>
        </tr>
        <tr>
            <td style="text-align:right"><strong>应退金额：</strong></td>
            <td><input type="text" name="refundmoney" id="refund" class="span1"/>元</td>
            <input type="hidden" name="orderno" value="<?= $arr['orderno'] ?>">
            <input type="hidden" name="payno" value="<?= $arr['payno'] ?>">
            <input type="hidden" name="gatewayid" value="<?= $arr['gatewayid'] ?>">
            <input type="hidden" name="totalPrice" value="<?= $arr['totalPrice'] ?>">
            <input type="hidden" name="refund_fee" value="<?= $query_row['order_fee'] ?>">
        </tr>
        <tr>
            <td></td>
            <td><br/><input type="submit" value="确定" class="btn btn-info"></td>
        </tr>
    </table>
</form>
</body>
</html>