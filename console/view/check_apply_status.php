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
<form method="post" action="check_apply_status.php">
    <ul class="nav nav-tabs">
        <li <? if (nav_active('order_refund.php')){ ?>class="active"<? } ?> style="padding-left:20px;">
            <a href="?cmd=<?= base64_encode('order_refund.php') ?>">订单详情</a>
        </li>
    </ul>

    <input type="hidden" name="user_id" value="<?= req('user_id') ?>">
    <table width="100%" class="table">
        <thead>
        <tr>
            <td width="100" style="text-align:right"><strong>姓 名：</strong></td>
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
<!--        <tr>-->
<!--            <td style="text-align:right"><strong>扣款金额：</strong></td>-->
<!--            <td>--><?//= $query_row['deduct_fee'] ?><!--</td>-->
<!--        </tr>-->
        <tr>
            <td style="text-align:right"><strong>驳回理由：</strong></td>
            <td><textarea  placeholder="请填写驳回理由..." style="resize:none;width:300px;height: 100px;margin: 0 auto;;border:solid 1px #ddd;padding:5px 10px;font-size: 12px;"  name="reason"></textarea></td> 
            <td><input type="hidden" name="orderno" value="<?= $arr['orderno'] ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td><br/><input type="submit" value="确定" class="btn btn-info"></td>
        </tr>
    </table>
</form>
</body>
</html>
<!--<div id="reasonBox" style="position: absolute;width:500px;height: 250px;left: 50%;top: 50%;margin-left: -200px;margin-top:-125px;border:solid 2px #ddd;border-radius: 5px;background-color: white;">-->
<!--    <form action="check_apply_status.php?orderno=--><?//=$_GET['orderno']?><!--" method="post">-->
<!--        <textarea  placeholder="请填写驳回理由..." style="resize:none;width:300px;height: 100px;margin: 0 auto;;border:solid 1px #ddd;padding:5px 10px;font-size: 16px;"  name="reason"></textarea>-->
<!--        <input type="submit" value="提交" style="width:60px;height:29px;background-color:#1fcc9e;color: white;display: block;margin: 0 auto;font-size: 18px;font-style:italic " />-->
<!--    </form>-->
<!--</div>-->