<?
if (!defined('IN_CLOOTA')) {
    exit('Access Denied');
}
?>

<ul class="nav nav-tabs">
    <li <? if (nav_active('order_detail.php')){ ?>class="active"<? } ?> style="padding-left:20px;">
        <a href="?cmd=<?= base64_encode('order_detail.php') ?>">�˿������</a>
    </li>
    <a href="javascript:void(0)" onclick="history.back()" class="pull-right btn btn-small">����</a>
</ul>


<table width="100%" class="table">
    <thead>
    <tr>
        <td width="105" style="text-align:right"><strong>�����ţ�</strong></td>
        <td><?= $order_code ?></td>
    </tr>
    </thead>


    <tr>
        <td style="text-align:right"><strong>��Ʒ����</strong></td>
        <td><a href="<?=$g_self_domain?>/menpiao/ticket_detail-<?=$details['lv_product_id']?>-<?=$detail['lv_scenic_id']?>.html"
               target="_blank"><?= $details['goods_name'] ?></a></td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>��Ʒ����</strong></td>
        <td><?= $details['shangpin'] ?></td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>��ϵ�ˣ�</strong></td>
        <td><?= $details['linker'] ?></td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>�û�ID��</strong></td>
        <td><?= $details['user_id'] ?></td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>�û����ͣ�</strong></td>
        <td><?if($details['user_type'] == 0){ ?>bus365�û�<?}else{?>��ҵ�û�<?}?></td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>��ϵ��ʽ��</strong></td>
        <td><?= $details['mobile'] ?></td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>������</strong></td>
        <td>
            &yen;<?= $details['order_fee'] ?>
        </td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>�µ�ʱ�䣺</strong></td>
        <td><?= $details['addtime'] ?></td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>�˿��ʱ�䣺</strong></td>
        <td><?= $details['create_time'] ?></td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>¿���趩���ţ�</strong></td>
        <td><?= $details['lv_order_id'] ?></td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>�������˿��</strong></td>
        <td>
            <?= $details['thrid_refund_amount'] ?>
        </td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>�����������ѣ�</strong></td>
        <td>
            <?= $details['third_refund_charge'] ?>
        </td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>ʵ���˿��</strong></td>
        <td>
            <?= $details['refund_fee'] ?>
        </td>
    </tr>
</table>   