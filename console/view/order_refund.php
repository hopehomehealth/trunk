<?
if (!defined('IN_CLOOTA')) {
    exit('Access Denied');
}
?>

<ul class="nav nav-tabs">
    <li class="active" style="padding-left:20px;">
        <a href="#">退款管理</a>
    </li>
    <a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">刷新</a>
</ul>

<form name="q_from" method="GET" action="" class="form-inline">

    <input name="cmd" type="hidden" value="<?= base64_encode('order_refund.php') ?>"/>

    <input name="kw" type="text" class="span4" value="<?= req('kw') ?>" placeholder="输入订单号、联系人、手机号…"/>

    <select name="flag" style="width:150px">
        <option value=""> 退款状态</option>
        <option value="0" <? if ('0' == req('flag')) {
            echo 'selected';
        } ?>>申请退款
        </option>
        <option value="1" <? if ('1' == req('flag')) {
            echo 'selected';
        } ?>>退款中
        </option>
        <option value="2" <? if ('2' == req('flag')) {
            echo 'selected';
        } ?>>已退款
        </option>
        <option value="3" <? if ('3' == req('flag')) {
            echo 'selected';
        } ?>>申请驳回
        </option>
        <option value="4" <? if ('4' == req('flag')) {
            echo 'selected';
        } ?>>退款失败
        </option>
    </select>

    <input type="image" src="static/image/find.gif" class="input_img" title="搜索"/>
    <span onclick="dialog_edit('./?cmd=<?= base64_encode('order_refund_add.php')?>&modal=true')" style="float:right;ursor:pointer" class="btn btn-info btn-small">添加退款记录</span>
</form>

<div class="tab-content">
    <div class="tab-pane in active" id="tabs-1">

        <?
        if (notnull($query_row)) {
            ?>
            <table width="100%" class="table table-hover">
                <thead>
                <tr>
                    <!--                <td  style="text-align:center"><strong>用户ID</strong></td>-->
                    <!--                    <td style="text-align:center"><strong>用户类型</strong></td>-->
                    <td style="text-align:center"><strong>业务类型</strong></td>
                    <td style="text-align:center"><strong>订单编号</strong></td>
                    <td style="text-align:center"><strong>第三方订单编号</strong></td>
                    <td style="text-align:center"><strong>申请时间</strong></td>
                    <td style="text-align:center"><strong>数据来源</strong></td>
                    <td style="text-align:center"><strong>退款原因</strong></td>
                    <td style="text-align:center"><strong>订单金额</strong></td>
<!--                    <td style="text-align:center"><strong>扣款金额</strong></td>-->
<!--                    <td style="text-align:center"><strong>退款金额</strong></td>-->
                    <td style="text-align:center"><strong>退款状态</strong></td>
                    <td style="text-align:center"><strong>第三方退款金额</strong></td>
<!--                    <td style="text-align:center"><strong>第三方手续费</strong></td>-->
                    <td style="text-align:center"><strong>第三方退款状态</strong></td>
                    <td style="text-align:center"><strong>详情</strong></td>
                    <td style="text-align:center"><strong>操作</strong></td>
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
                            //                                    ?><!--bus365用户--><?//
                            //                                } else if ($val['user_type'] == '1') { ?><!--企业用户--><?//
                            //                                } ?><!--</td>-->
                            <td style="text-align:center"><? if ($val['goods_type'] == '1') { ?>周边游<? } else if ($val['goods_type'] == '4') { ?>门票<? } ?></td>
                            <td style="text-align:center"><?= $val['order_code'] ?></td>
                            <td style="text-align:center"><?= $val['lv_order_id'] ?></td>
                            <td style="text-align:center"><?= $val['create_time'] ?></td>
                            <td style="text-align:center"><? if ($val['data_sources'] == '1') { ?>bus365<? } else if ($val['data_sources'] == '2') { ?>驴妈妈<? } ?></td>
                            <td style="text-align:center"><? if ($val['reason'] == '') {
                                    echo $val['other_reason'];
                                } else if ($val['reason'] == '1') {
                                    echo "行程变更";
                                } else if ($val['reason'] == '2') {
                                    echo "产品定错（时间、数量等）";
                                } else if ($val['reason'] == '3') {
                                    echo "重复订单";
                                } else if ($val['reason'] == '4') {
                                    echo "在其他网站购买";
                                } else if ($val['reason'] == '5') {
                                    echo "价格不够优惠";
                                } else if ($val['reason'] == '6') {
                                    echo "其他";
                                } ?></td>
                            <td style="text-align:center"><?= $val['order_fee'] ?>元</td>
<!--                            <td style="text-align:center">--><?//= $val['deduct_fee'] ?><!--元</td>-->
<!--                            <td style="text-align:center">--><?//= $val['refund_fee'] ?><!--元</td>-->
                            <td style="text-align:center">
                                <? if ($val['flag'] == '0') { ?>申请退款<? } else if ($val['flag'] == '1') { ?>退款中<? } else if ($val['flag'] == '2') { ?>已退款<? } else if ($val['flag'] == '3') { ?>申请驳回<? } else if ($val['flag'] == '4') { ?>退款失败<? } ?>
                            </td>
                            <td style="text-align:center"><?= $val['thrid_refund_amount'] ?></td>
<!--                            <td style="text-align:center">--><?//= $val['third_refund_charge'] ?><!--</td>-->
                            <td style="text-align:center"><? if ($val['third_refund_status'] == '1') { ?>审核中<? } else if ($val['third_refund_status'] == '2') { ?>已退款<? } else if ($val['third_refund_status'] == '3') { ?>申请驳回<? } ?></td>
                            <td style="text-align:center"><a
                                    href="<?= url('order_refund_detail.php') ?>&order_code=<?= $val['order_code'] ?>"
                                    target="_top" class="btn btn-small btn-info">详情</a></td>
                            <td style="text-align:center">
                                <? if ($val['goods_type'] == '4') { ?>
                                    <? if ($val['data_sources'] == '1') { ?>
                                        <? if ($val['flag'] !== '2') { ?>
                                            <span
                                                onclick="dialog_edit('./?cmd=<?= base64_encode('check_refund_status.php') ?>&orderno=<?= $val['order_code'] ?>&modal=true')"
                                                class="btn btn-info btn-small" style="cursor:pointer">退款</span>
                                        <? } ?>
                                    <? } else { ?>
                                        <? if ($val['third_refund_status'] == '2' && $val['flag'] !== '2') { ?>
                                            <span
                                                onclick="dialog_edit('./?cmd=<?= base64_encode('check_refund_status.php') ?>&orderno=<?= $val['order_code'] ?>&modal=true')"
                                                class="btn btn-info btn-small" style="cursor:pointer">退款</span>
                                        <? } ?>
                                    <? } ?>
                                <? } else if ($val['goods_type'] == '1') { ?>
                                    <? if ($val['flag'] == '0') { ?>
                                        <span
                                            onclick="dialog_edit('./?cmd=<?= base64_encode('check_refund_status.php') ?>&orderno=<?= $val['order_code'] ?>&modal=true')"
                                            class="btn btn-info btn-small" style="cursor:pointer">退款</span>
                                        <span
                                            onclick="dialog_edit('./?cmd=<?= base64_encode('check_apply_status.php') ?>&orderno=<?= $val['order_code'] ?>&modal=true')"
                                            class="btn btn-info btn-small" style="cursor:pointer">驳回</span>
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
                <!--			累计总额：<strong style="font-size:18px">&yen;--><? //=number_format($total_fee, 2, '.', '')
                ?><!--</strong>-->
                <!--			</span>-->
			<span class="pull-right">
			共计<b><?= $total_number ?></b>条 &nbsp;
			<a href="./?cmd=<?= base64_encode('order_refund.php') ?>&kw=<?= req('kw') ?>&p=1">首页</a>
			<a href="./?cmd=<?= base64_encode('order_refund.php') ?>&kw=<?= req('kw') ?>&p=<?= $prev_number ?>">上一页</a>
			第<?= $now_page ?> / <?= $total_page ?>页
			<a href="./?cmd=<?= base64_encode('order_refund.php') ?>&kw=<?= req('kw') ?>&p=<?= $next_number ?>">下一页</a>
			<a href="./?cmd=<?= base64_encode('order_refund.php') ?>&kw=<?= req('kw') ?>&p=<?= $total_page ?>">尾页</a>
			</span>
            </div>
            <?
        } else {
            ?>
            <div class="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                没有查询到相关退款记录！
            </div>
        <? } ?>
    </div>
</div>


