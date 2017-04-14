<?
if (!defined('IN_CLOOTA')) {
    exit('Access Denied');
}
?>

<ul class="nav nav-tabs">
    <li <? if (nav_active('order_detail.php')){ ?>class="active"<? } ?> style="padding-left:20px;">
        <a href="?cmd=<?= base64_encode('order_detail.php') ?>">退款订单详情</a>
    </li>
    <a href="javascript:void(0)" onclick="history.back()" class="pull-right btn btn-small">返回</a>
</ul>


<table width="100%" class="table">
    <thead>
    <tr>
        <td width="105" style="text-align:right"><strong>订单号：</strong></td>
        <td><?= $order_code ?></td>
    </tr>
    </thead>


    <tr>
        <td style="text-align:right"><strong>产品名：</strong></td>
        <td><a href="<?=$g_self_domain?>/menpiao/ticket_detail-<?=$details['lv_product_id']?>-<?=$detail['lv_scenic_id']?>.html"
               target="_blank"><?= $details['goods_name'] ?></a></td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>商品名：</strong></td>
        <td><?= $details['shangpin'] ?></td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>联系人：</strong></td>
        <td><?= $details['linker'] ?></td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>用户ID：</strong></td>
        <td><?= $details['user_id'] ?></td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>用户类型：</strong></td>
        <td><?if($details['user_type'] == 0){ ?>bus365用户<?}else{?>企业用户<?}?></td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>联系方式：</strong></td>
        <td><?= $details['mobile'] ?></td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>订单金额：</strong></td>
        <td>
            &yen;<?= $details['order_fee'] ?>
        </td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>下单时间：</strong></td>
        <td><?= $details['addtime'] ?></td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>退款发起时间：</strong></td>
        <td><?= $details['create_time'] ?></td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>驴妈妈订单号：</strong></td>
        <td><?= $details['lv_order_id'] ?></td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>第三方退款金额：</strong></td>
        <td>
            <?= $details['thrid_refund_amount'] ?>
        </td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>第三方手续费：</strong></td>
        <td>
            <?= $details['third_refund_charge'] ?>
        </td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>实际退款金额：</strong></td>
        <td>
            <?= $details['refund_fee'] ?>
        </td>
    </tr>
</table>   