<?
if (!defined('IN_CLOOTA')) {
    exit('Access Denied');
}
?>

<ul class="nav nav-tabs">
    <li class="active" style="padding-left:20px;">
        <a href="#">�˿����</a>
    </li>
    <a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">ˢ��</a>
</ul>

<form name="q_from" method="GET" action="" class="form-inline">

    <input name="cmd" type="hidden" value="<?= base64_encode('order_refund.php') ?>"/>

    <input name="kw" type="text" class="span4" value="<?= req('kw') ?>" placeholder="���붩���š���ϵ�ˡ��ֻ��š�"/>

    <select name="flag" style="width:150px">
        <option value=""> �˿�״̬</option>
        <option value="0" <? if ('0' == req('flag')) {
            echo 'selected';
        } ?>>�����˿�
        </option>
        <option value="1" <? if ('1' == req('flag')) {
            echo 'selected';
        } ?>>�˿���
        </option>
        <option value="2" <? if ('2' == req('flag')) {
            echo 'selected';
        } ?>>���˿�
        </option>
        <option value="3" <? if ('3' == req('flag')) {
            echo 'selected';
        } ?>>���벵��
        </option>
        <option value="4" <? if ('4' == req('flag')) {
            echo 'selected';
        } ?>>�˿�ʧ��
        </option>
    </select>

    <input type="image" src="static/image/find.gif" class="input_img" title="����"/>
    <span onclick="dialog_edit('./?cmd=<?= base64_encode('order_refund_add.php')?>&modal=true')" style="float:right;ursor:pointer" class="btn btn-info btn-small">����˿��¼</span>
</form>

<div class="tab-content">
    <div class="tab-pane in active" id="tabs-1">

        <?
        if (notnull($query_row)) {
            ?>
            <table width="100%" class="table table-hover">
                <thead>
                <tr>
                    <!--                <td  style="text-align:center"><strong>�û�ID</strong></td>-->
                    <!--                    <td style="text-align:center"><strong>�û�����</strong></td>-->
                    <td style="text-align:center"><strong>ҵ������</strong></td>
                    <td style="text-align:center"><strong>�������</strong></td>
                    <td style="text-align:center"><strong>�������������</strong></td>
                    <td style="text-align:center"><strong>����ʱ��</strong></td>
                    <td style="text-align:center"><strong>������Դ</strong></td>
                    <td style="text-align:center"><strong>�˿�ԭ��</strong></td>
                    <td style="text-align:center"><strong>�������</strong></td>
<!--                    <td style="text-align:center"><strong>�ۿ���</strong></td>-->
<!--                    <td style="text-align:center"><strong>�˿���</strong></td>-->
                    <td style="text-align:center"><strong>�˿�״̬</strong></td>
                    <td style="text-align:center"><strong>�������˿���</strong></td>
<!--                    <td style="text-align:center"><strong>������������</strong></td>-->
                    <td style="text-align:center"><strong>�������˿�״̬</strong></td>
                    <td style="text-align:center"><strong>����</strong></td>
                    <td style="text-align:center"><strong>����</strong></td>
                </tr>
                </thead>
                <?
                foreach ($query_row as $key => $val) { ?>
                    <form target="frm" id="refund" method="post" action="">
                        <tr>
                            <!--                <td >--><?//=$val['user_id']
                            ?><!--</td>-->
                            <!--                            <td style="text-align:center">-->
                            <?// if ($val['user_type'] == '0') {
                            //                                    ?><!--bus365�û�--><?//
                            //                                } else if ($val['user_type'] == '1') { ?><!--��ҵ�û�--><?//
                            //                                } ?><!--</td>-->
                            <td style="text-align:center"><? if ($val['goods_type'] == '1') { ?>�ܱ���<? } else if ($val['goods_type'] == '4') { ?>��Ʊ<? } ?></td>
                            <td style="text-align:center"><?= $val['order_code'] ?></td>
                            <td style="text-align:center"><?= $val['lv_order_id'] ?></td>
                            <td style="text-align:center"><?= $val['create_time'] ?></td>
                            <td style="text-align:center"><? if ($val['data_sources'] == '1') { ?>bus365<? } else if ($val['data_sources'] == '2') { ?>¿����<? } ?></td>
                            <td style="text-align:center"><? if ($val['reason'] == '') {
                                    echo $val['other_reason'];
                                } else if ($val['reason'] == '1') {
                                    echo "�г̱��";
                                } else if ($val['reason'] == '2') {
                                    echo "��Ʒ����ʱ�䡢�����ȣ�";
                                } else if ($val['reason'] == '3') {
                                    echo "�ظ�����";
                                } else if ($val['reason'] == '4') {
                                    echo "��������վ����";
                                } else if ($val['reason'] == '5') {
                                    echo "�۸񲻹��Ż�";
                                } else if ($val['reason'] == '6') {
                                    echo "����";
                                } ?></td>
                            <td style="text-align:center"><?= $val['order_fee'] ?>Ԫ</td>
<!--                            <td style="text-align:center">--><?//= $val['deduct_fee'] ?><!--Ԫ</td>-->
<!--                            <td style="text-align:center">--><?//= $val['refund_fee'] ?><!--Ԫ</td>-->
                            <td style="text-align:center">
                                <? if ($val['flag'] == '0') { ?>�����˿�<? } else if ($val['flag'] == '1') { ?>�˿���<? } else if ($val['flag'] == '2') { ?>���˿�<? } else if ($val['flag'] == '3') { ?>���벵��<? } else if ($val['flag'] == '4') { ?>�˿�ʧ��<? } ?>
                            </td>
                            <td style="text-align:center"><?= $val['thrid_refund_amount'] ?></td>
<!--                            <td style="text-align:center">--><?//= $val['third_refund_charge'] ?><!--</td>-->
                            <td style="text-align:center"><? if ($val['third_refund_status'] == '1') { ?>�����<? } else if ($val['third_refund_status'] == '2') { ?>���˿�<? } else if ($val['third_refund_status'] == '3') { ?>���벵��<? } ?></td>
                            <td style="text-align:center"><a
                                    href="<?= url('order_refund_detail.php') ?>&order_code=<?= $val['order_code'] ?>"
                                    target="_top" class="btn btn-small btn-info">����</a></td>
                            <td style="text-align:center">
                                <? if ($val['goods_type'] == '4') { ?>
                                    <? if ($val['data_sources'] == '1') { ?>
                                        <? if ($val['flag'] !== '2') { ?>
                                            <span
                                                onclick="dialog_edit('./?cmd=<?= base64_encode('check_refund_status.php') ?>&orderno=<?= $val['order_code'] ?>&modal=true')"
                                                class="btn btn-info btn-small" style="cursor:pointer">�˿�</span>
                                        <? } ?>
                                    <? } else { ?>
                                        <? if ($val['third_refund_status'] == '2' && $val['flag'] !== '2') { ?>
                                            <span
                                                onclick="dialog_edit('./?cmd=<?= base64_encode('check_refund_status.php') ?>&orderno=<?= $val['order_code'] ?>&modal=true')"
                                                class="btn btn-info btn-small" style="cursor:pointer">�˿�</span>
                                        <? } ?>
                                    <? } ?>
                                <? } else if ($val['goods_type'] == '1') { ?>
                                    <? if ($val['flag'] == '0') { ?>
                                        <span
                                            onclick="dialog_edit('./?cmd=<?= base64_encode('check_refund_status.php') ?>&orderno=<?= $val['order_code'] ?>&modal=true')"
                                            class="btn btn-info btn-small" style="cursor:pointer">�˿�</span>
                                        <span
                                            onclick="dialog_edit('./?cmd=<?= base64_encode('check_apply_status.php') ?>&orderno=<?= $val['order_code'] ?>&modal=true')"
                                            class="btn btn-info btn-small" style="cursor:pointer">����</span>
                                    <? } ?>
                                <? } ?>
                            </td>
                        </tr>
                    </form>
                    <?
                }
                ?>
            </table>

            <div style="padding-right:10px;">
                <!--			<span class="pull-left">-->
                <!--			�ۼ��ܶ<strong style="font-size:18px">&yen;--><? //=number_format($total_fee, 2, '.', '')
                ?><!--</strong>-->
                <!--			</span>-->
			<span class="pull-right">
			����<b><?= $total_number ?></b>�� &nbsp;
			<a href="./?cmd=<?= base64_encode('order_refund.php') ?>&kw=<?= req('kw') ?>&p=1">��ҳ</a>
			<a href="./?cmd=<?= base64_encode('order_refund.php') ?>&kw=<?= req('kw') ?>&p=<?= $prev_number ?>">��һҳ</a>
			��<?= $now_page ?> / <?= $total_page ?>ҳ
			<a href="./?cmd=<?= base64_encode('order_refund.php') ?>&kw=<?= req('kw') ?>&p=<?= $next_number ?>">��һҳ</a>
			<a href="./?cmd=<?= base64_encode('order_refund.php') ?>&kw=<?= req('kw') ?>&p=<?= $total_page ?>">βҳ</a>
			</span>
            </div>
            <?
        } else {
            ?>
            <div class="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                û�в�ѯ������˿��¼��
            </div>
        <? } ?>
    </div>
</div>


