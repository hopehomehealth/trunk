<?
if (!defined('IN_CLOOTA')) {
    exit('Access Denied');
}
?>

<ul class="nav nav-tabs">
    <li <? if (nav_active('order_detail.php')){ ?>class="active"<? } ?> style="padding-left:20px;">
        <a href="">订单详情</a>
    </li>
    <a href="javascript:void(0)" onclick="history.back()" class="pull-right btn btn-small">返回</a>
</ul>


<table width="100%" class="table">
    <?
    // 订单状态
    $state = $detail['state'];
    $flag =  $detail['verify_flag'];
    if ($state == '2' && $flag == '2'){
        $state = '6';
    }

    // 联系人详情
    $traffic = unserialize($detail['traffic_snapshot']);

    // 店铺详情
    $shop = get_shop_detail_by_id($detail['shop_id']);

    // 客户详情
    $user = get_user_detail_by_id($detail['user_id']);

    // SKU
    $goods_sku = get_goods_sku_by_id($detail['sku_id']);

    // 产品详情
    $goods = unserialize($detail['goods_snapshot']);

    //产品类型
    $type = $detail['goods_type'];
    ?>
    <thead>
    <tr>
        <td width="100" style="text-align:right"><strong>订单号：</strong></td>
        <td><?= $detail['order_code'] ?></td>
    </tr>
    </thead>

    <tr>
        <td style="text-align:right"><strong>下单时间：</strong></td>
        <td><?= $detail['addtime'] ?></td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>客 户：</strong></td>
        <td><?= $user['account'] ?></td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>商 家：</strong></td>
        <td>
            <?
            if ($shop['shop_name'] != '') {
                ?>
                <strong><?= $shop['shop_name'] ?></strong>
            <? } else {
                ?>
                <strong>自营</strong>
            <? } ?>
        </td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>名称/编码：</strong></td>
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
        <td style="text-align:right"><strong>出发日期：</strong></td>
        <td><?= $detail['departdate'] ?></td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>人 数：</strong></td>
        <td>
            <? if ($detail['adult_num'] > 0) { ?>
                <?= $detail['adult_num'] ?>人
            <? } ?>

            <? if ($detail['kid_num'] > 0) { ?>
                <?= $detail['kid_num'] ?>儿童
            <? } ?>
        </td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>金 额：</strong></td>
        <td>
            &yen;<?= $detail['real_price'] ?>
        </td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>改 价：</strong></td>
        <td>
            <? if ($detail['state'] <= 2) { ?>
                <form target="frm" id="subtract<?= $detail['order_id'] ?>" method="post"
                      action="do.php?cmd=order_subtract_price&order_code=<?= $detail['order_code'] ?>&order_id=<?= $detail['order_id'] ?>"
                      style="margin:0px;padding:0px;">
                    减<input type="number" name="subtract_price_<?= $detail['order_id'] ?>"
                            value="<?= $detail['subtract_price'] ?>" style="width:60px;text-align:center;"
                            onchange="if(confirm('确认减价吗？'))document.getElementById('subtract<?= $detail['order_id'] ?>').submit()">元
                </form>
            <? } else { ?>
                <? if ($detail['subtract_price'] > 0) { ?>
                    <span class="label label-info">
						减 <b><?= $detail['subtract_price'] ?></b> 元
					</span>
                <? } ?>
                <? if ($detail['subtract_price'] < 0) { ?>
                    <span class="label label-info">
						加 <b><?= -$detail['subtract_price'] ?></b> 元
					</span>
                <? } ?>
            <? } ?>
        </td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>支付方式：</strong></td>
        <td>
            <?= $g_gateway[$detail['pay_type']] ?>
        </td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>状 态：</strong></td>
        <td>
            <span class="label label-warning"><?= $g_order_state[$state] ?></span>
        </td>
    </tr>

    <tr>
        <td style="text-align:right"><strong>联系人：</strong></td>
        <td>
            <?= $detail['linker'] ?>
            <?= $detail['mobile'] ?>
            <?= $detail['address'] ?>
        </td>
    </tr>
    <tr>
        <td style="text-align:right"><strong>订单留言：</strong></td>
        <td>
            <? if ($detail['order_note'] != '') { ?>
                <?= $detail['order_note'] ?>
            <? } else { ?>
                未填写
            <? } ?>
        </td>
    </tr>
    <? if ($type != '4') { ?>
        <tr>
            <td style="text-align:right"></td>
            <td>
                <? if ($state == '1') { ?>
                    <a href="do.php?cmd=order_close&order_code=<?= $detail['order_code'] ?>"
                       onclick="return confrim('确认取消订单吗？')" class="btn " target="_top"
                       style="float:left;margin-right:10px">取消订单</a>
                <? } ?>

                <?
                if ($state == 1) {
                    ?>
                    <form target="frm" method="post"
                          action="do.php?cmd=order_payed&order_code=<?= $detail['order_code'] ?>"
                          style="float:left;margin-right:10px">
                        <input type="submit" value="确认收款" class="btn btn-info" onclick="return confirm('确认收款吗？')">
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
                            <input type="submit" value="订单确认" class="btn btn-info" onclick="return confirm('订单已经确认吗？')">
                        </form>

                        <!--审核未通过-->
                    <? }
                    if ($verifyFlag == '0') { ?>
                        <form target="frm" method="post"
                              action="do.php?cmd=order_st&order_code=<?= $detail['order_code'] ?>&order_status=9"
                              style="float:left;margin-right:10px">
                            <input type="submit" value="审核未通过" class="btn btn-info"
                                   onclick="return confirm('订单确定未审核通过吗？')">
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
                            <input type="submit" value="完成交易" class="btn"
                                   onclick="return confirm('确认完成交易吗？请确认是否已回团！！！')">
                        </form>
                        <?
                    } ?>
                    <?
                }
                ?>

                <? if ($state == '5') { ?>
                    <a href="do.php?cmd=order_delete&order_code=<?= $detail['order_code'] ?>"
                       onclick="return confrim('确认删除订单吗？')" class="btn " target="_top"
                       style="float:left;margin-right:10px">删除订单</a>
                <? } ?>
            </td>
        </tr>

        <tr>
            <td style="text-align:right"><strong>出游名单：</strong></td>
            <td>
                <? if (notnull($tourist)) { ?>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td width="30"><strong>游客姓名</strong></td>
                            <td width="30"><strong>游客手机号</strong></td>
                            <td width="120"><strong>游客身份证</strong></td>
                            <td width="60"><strong>游客年龄</strong></td>
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
                                        <?= $val['user_age'] ?>岁
                                    </td>
                                </tr>
                            </form>
                            <?
                        }
                        ?>
                    </table>
                <? } else { ?>
                    <div>尚未填写游客信息</div>
                <? } ?>
            </td>
        </tr>
    <? } ?>
</table>