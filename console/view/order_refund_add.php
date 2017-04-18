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
<form name="q_form" method="POST" action="do.php?cmd=order_refund_add" class="form-inline">
    <ul class="nav nav-tabs">
        <li <? if (nav_active('order_refund.php')){ ?>class="active"<? } ?> style="padding-left:20px;">
            <a href="?cmd=<?= base64_encode('order_refund_add.php') ?>">添加退款记录</a>
        </li>
    </ul>

    <input type="hidden" name="user_id" value="<?= req('user_id') ?>">
    <table width="100%" class="table">
        <thead>
        <tr>
            <td width="100" style="text-align:right"><strong>退款原因：</strong></td>
            <td>
                <select name="reason">
                    <option value="1">行程变更</option>
                    <option value="2">产品定错（时间、数量等）</option>
                    <option value="3">重复订单</option>
                    <option value="4">在其他网站购买</option>
                    <option value="5">价格不够优惠</option>
                    <option value="6">其他</option>
                </select>
            </td>
        </tr>
        </thead>
        <tr>
            <td style="text-align:right"><strong>订单号：</strong></td>
            <td><input type="text" name="orderno"></td>
        </tr>
        <tr>
            <td></td>
            <td><br/><input type="submit" value="确定" class="btn btn-info"></td>
        </tr>
    </table>
</form>
</body>
</html>