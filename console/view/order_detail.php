<?
if (!defined('IN_CLOOTA')) {
    exit('Access Denied');
}
?>

<ul class="nav nav-tabs">
    <li <? if (nav_active('order_detail.php')){ ?>class="active"<? } ?> style="padding-left:20px;">
        <a href="">��������</a>
    </li>
    <a href="javascript:void(0)" onclick="history.back()" class="pull-right btn btn-small">����</a>
</ul>


<table width="100%" class="table">
    <?
    // ����״̬
    $state = $detail['state'];
    $flag =  $detail['verify_flag'];
    if ($state == '2' && $flag == '2'){
        $state = '6';
    }

    // ��ϵ������
    $traffic = unserialize($detail['traffic_snapshot']);

    // ��������
    $shop = get_shop_detail_by_id($detail['shop_id']);

    // �ͻ�����
    $user = get_user_detail_by_id($detail['user_id']);

    // SKU
    $goods_sku = get_goods_sku_by_id($detail['sku_id']);

    // ��Ʒ����
    $goods = unserialize($detail['goods_snapshot']);

    //��Ʒ����
    $type = $detail['goods_type'];
    ?>
    <thead>
    <tr>
        <td width="100" style="text-align:right"><strong>�����ţ�</strong></td>
        <td><?= $detail['order_code'] ?></td>
    </tr>
    </thead>

    <tr>
        <td style="text-align:right"><strong>�µ�ʱ�䣺</strong></td>
        <td><?= $detail['addtime'] ?></td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>�� ����</strong></td>
        <td><?= $user['account'] ?></td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>�� �ң�</strong></td>
        <td>
            <?
            if ($shop['shop_name'] != '') {
                ?>
                <strong><?= $shop['shop_name'] ?></strong>
            <? } else {
                ?>
                <strong>��Ӫ</strong>
            <? } ?>
        </td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>����/���룺</strong></td>
        <td>
            <? if ($type == '4') { ?>
                <a href="<?= $g_self_domain ?>/menpiao/ticket_detail-<?= $detail['lv_product_id'] ?>-<?= $detail['lv_scenic_id'] ?>.html"
                   target="_blank"><?= $detail['goods_name'] ?><br/><?= $detail['goods_code'] ?></a>
            <? } else if ($type == '1') { ?>
                <a href="<?= $g_self_domain ?>/product/detail-<?= $detail['goods_id'] ?>-<?= $detail['lv_product_id'] ?>.html"
                   target="_blank"><?= $detail['goods_name'] ?><br/><?= $detail['goods_code'] ?></a>
            <? } ?>
        </td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>�������ڣ�</strong></td>
        <td><?= $detail['departdate'] ?></td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>�� ����</strong></td>
        <td>
            <? if ($detail['adult_num'] > 0) { ?>
                <?= $detail['adult_num'] ?>��
            <? } ?>

            <? if ($detail['kid_num'] > 0) { ?>
                <?= $detail['kid_num'] ?>��ͯ
            <? } ?>
        </td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>�� �</strong></td>
        <td>
            &yen;<?= $detail['real_price'] ?>
        </td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>�� �ۣ�</strong></td>
        <td>
            <? if ($detail['state'] <= 2) { ?>
                <form target="frm" id="subtract<?= $detail['order_id'] ?>" method="post"
                      action="do.php?cmd=order_subtract_price&order_code=<?= $detail['order_code'] ?>&order_id=<?= $detail['order_id'] ?>"
                      style="margin:0px;padding:0px;">
                    ��<input type="number" name="subtract_price_<?= $detail['order_id'] ?>"
                            value="<?= $detail['subtract_price'] ?>" style="width:60px;text-align:center;"
                            onchange="if(confirm('ȷ�ϼ�����'))document.getElementById('subtract<?= $detail['order_id'] ?>').submit()">Ԫ
                </form>
            <? } else { ?>
                <? if ($detail['subtract_price'] > 0) { ?>
                    <span class="label label-info">
						�� <b><?= $detail['subtract_price'] ?></b> Ԫ
					</span>
                <? } ?>
                <? if ($detail['subtract_price'] < 0) { ?>
                    <span class="label label-info">
						�� <b><?= -$detail['subtract_price'] ?></b> Ԫ
					</span>
                <? } ?>
            <? } ?>
        </td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>֧����ʽ��</strong></td>
        <td>
            <?= $g_gateway[$detail['pay_type']] ?>
        </td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>״ ̬��</strong></td>
        <td>
            <span class="label label-warning"><?= $g_order_state[$state] ?></span>
        </td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>��ϵ�ˣ�</strong></td>
        <td>
            <?= $detail['linker'] ?>
            <?= $detail['mobile'] ?>
            <?= $detail['address'] ?>
        </td>
    </tr>
    <tr>
        <td style="text-align:right"><strong>�������ԣ�</strong></td>
        <td>
            <? if ($detail['order_note'] != '') { ?>
                <?= $detail['order_note'] ?>
            <? } else { ?>
                δ��д
            <? } ?>
        </td>
    </tr>
    <? if ($type != '4') { ?>
        <tr>
            <td style="text-align:right"></td>
            <td>
                <? if ($state == '1') { ?>
                    <a href="do.php?cmd=order_close&order_code=<?= $detail['order_code'] ?>"
                       onclick="return confrim('ȷ��ȡ��������')" class="btn " target="_top"
                       style="float:left;margin-right:10px">ȡ������</a>
                <? } ?>

                <?
                if ($state == 1) {
                    ?>
                    <form target="frm" method="post"
                          action="do.php?cmd=order_payed&order_code=<?= $detail['order_code'] ?>"
                          style="float:left;margin-right:10px">
                        <input type="submit" value="ȷ���տ�" class="btn btn-info" onclick="return confirm('ȷ���տ���')">
                    </form>
                    <?
                }
                ?>

                <?
                if ($state == 2 && $dataSources == '1') {
                    if ($verifyFlag == '0') {
                        ?>
                        <form target="frm" method="post"
                              action="do.php?cmd=order_st&order_code=<?= $detail['order_code'] ?>&order_status=3"
                              style="float:left;margin-right:10px">
                            <input type="submit" value="����ȷ��" class="btn btn-info" onclick="return confirm('�����Ѿ�ȷ����')">
                        </form>

                        <!--���δͨ��-->
                    <? }
                    if ($verifyFlag == '0') { ?>
                        <form target="frm" method="post"
                              action="do.php?cmd=order_st&order_code=<?= $detail['order_code'] ?>&order_status=9"
                              style="float:left;margin-right:10px">
                            <input type="submit" value="���δͨ��" class="btn btn-info"
                                   onclick="return confirm('����ȷ��δ���ͨ����')">
                        </form>
                        <?
                    }
                }
                ?>

                <?
                if ($state == 3) {
                    ?>
                    <? if (date('Ymd') >= date('Ymd', strtotime($detail['departdate']))) {
                        ?>
                        <form target="frm" method="post"
                              action="do.php?cmd=order_st&order_code=<?= $detail['order_code'] ?>&order_status=4"
                              style="float:left;margin-right:10px">
                            <input type="submit" value="��ɽ���" class="btn"
                                   onclick="return confirm('ȷ����ɽ�������ȷ���Ƿ��ѻ��ţ�����')">
                        </form>
                        <?
                    } ?>
                    <?
                }
                ?>

                <? if ($state == '5') { ?>
                    <a href="do.php?cmd=order_delete&order_code=<?= $detail['order_code'] ?>"
                       onclick="return confrim('ȷ��ɾ��������')" class="btn " target="_top"
                       style="float:left;margin-right:10px">ɾ������</a>
                <? } ?>
            </td>
        </tr>

        <tr>
            <td style="text-align:right"><strong>����������</strong></td>
            <td>
                <? if (notnull($tourist)) { ?>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td width="30"><strong>�ο�����</strong></td>
                            <td width="30"><strong>�ο��ֻ���</strong></td>
                            <td width="120"><strong>�ο����֤</strong></td>
                            <td width="60"><strong>�ο�����</strong></td>
                        </tr>
                        </thead>
                        <?
                        foreach ($tourist as $val) {
                            ?>
                            <form target="frm" id="f<?= $val['tourist_id'] ?>" method="post" action="">
                                <tr>
                                    <td>
                                        <?= $val['user_name'] ?>
                                    </td>

                                    <td>
                                        <?= $val['user_phone'] ?>
                                    </td>

                                    <td>
                                        <?= $val['user_credentials'] ?>
                                    </td>

                                    <td>
                                        <?= $val['user_age'] ?>��
                                    </td>
                                </tr>
                            </form>
                            <?
                        }
                        ?>
                    </table>
                <? } else { ?>
                    <div>��δ��д�ο���Ϣ</div>
                <? } ?>
            </td>
        </tr>
    <? } ?>
</table>