<!DOCTYPE html>
<html lang="en">
<head>
    <?include('meta.php');?>
    <?include('static.php');?>
    <title>门票订单详情</title>
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/common.css">
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/menpiaodingdanxiangqing.css">
</head>

<!--  head  start -->
<?include('head.php');?>
<!--  nav导航  end -->

<!-- 订单详情 start -->
<div id="orderDetail_mainBox">
    <div id="orderDetail_main">
        <div class="orderDetail_main1">我的Bus365 &gt; 我的订单 &gt; <a href="">订单详情</a></div>
        <div class="orderDetail_main2">
            <div class="orderDetail_main2_title">订单详情</div>

            <div class="visitorInfo">
                <div class="visitorInfo_title">游客信息</div>
                <div class="visitorInfo1">
                    <ul>
                        <li>联系人姓名  <span><?=$orderInfoExceptTicket['linker']?></span></li>
                        <li>联系人手机  <span><?=$orderInfoExceptTicket['mobile']?></span></li>

                    </ul>
                </div>
                <div class="visitorInfo2">
                    <table>
                        <thead>
                        <tr>
                            <th>姓名</th>
                            <th>手机号</th>
                            <th>证件类型</th>
                            <th>证件号码</th>
                        </tr>
                        </thead>
                        <tbody>
                        <? foreach($touristList as $tourist){ ?>
                            <tr>
                                <td><?=$tourist['userName']?></td>
                                <td><?=$tourist['userPhone']?></td>
                                <td><?=$tourist['credentialsTypeName'];?></td>
                                <td><?=$tourist['userIdCard']?></td>
                            </tr>
                        <?}?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="orderInfo">
                <div class="orderInfo_title">订单信息</div>
                <div class="orderInfo1">
                    <ul>
                        <li>订单号：<?echo $orderInfoExceptTicket['orderCode'];?></li>
                        <li>订单状态：<?echo $orderInfoExceptTicket['orderStatusName'];?>
                            <?if ($orderInfoExceptTicket['orderStatus'] == '8'){echo $orderInfoExceptTicket['refundFailReason'];}?>
                        </li>
                        <li>下单时间：<?echo $orderInfoExceptTicket['createTime'];?></li>
                        <li>支付方式：<?=$paymentType?></li>
                    </ul>
                    <div class="refundErrorText hide">
                        退款原因：预定提前期与付款期。
                    </div>
                </div>
                <div class="orderInfo2">
                    <table>
                        <thead>
                        <tr>
                            <th>产品名称</th>
                            <th>游玩日期</th>
                            <th>现售价</th>
                            <th>小计</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?
                        foreach($orderTicketItem as $key => $value){
                            ?>
                            <tr>
                                <td class="productName"><b><?echo $orderInfoExceptTicket['productName'].'-'.$value['goodsName'];?></b> ×<?echo $value['num'];?></td>
                                <td class="productDate"><?echo $orderInfoExceptTicket['playDate'];?></td>
                                <td class="productPrice2"><?echo $value['unitPrice']?></td>
                                <td class="productXiaoji"><?echo $value['totlePrice']?></td>
                            </tr>
                        <? } ?>
                        </tbody>
                    </table>

                    <p><span>订单总金额：&yen;<b><?echo $totalFee;?></b></span></p>
                </div>

                <div class="orderBtnBox">
                    <!-- 默认按钮 -->
                    <? if($st == 0){ ?>
                        <div class="orderBtn_default">
                            <a href="<?= $g_self_domain ?>/menpiao/ticket_order-<?= urlencode($db->to_gbk($list['lvGoodsName'])) ?>-<?= urlencode($db->to_gbk($ticketTypeName)) ?>-<?= $list['isEmail'] ?>-<?= $list['isCredentials'] ?>-<?= $obj['scenicInfo']['goodsId'] ?>-<?= $obj['scenicInfo']['lvProductId'] ?>-<?= $list['lvGoodsId'] ?>.html"><button>再次预定</button></a>
                        </div>
                    <?}elseif($st == 1){?>
                        <!-- 出票成功按钮 -->
                        <div class="orderBtn_success">
                            <a href="<?= $g_self_domain ?>/menpiao/ticket_order-<?= urlencode($db->to_gbk($list['lvGoodsName'])) ?>-<?= urlencode($db->to_gbk($ticketTypeName)) ?>-<?= $list['isEmail'] ?>-<?= $list['isCredentials'] ?>-<?= $obj['scenicInfo']['goodsId'] ?>-<?= $obj['scenicInfo']['lvProductId'] ?>-<?= $list['lvGoodsId'] ?>.html"><button>再次预定</button></a>
                            <button class="applyRefundBtn">申请退款</button>
                            <button class="msgRetry">重发短信凭证</button>
                        </div>
                    <?}elseif($st == 2){?>
                        <!-- 待支付按钮 -->

                        <div class="orderBtn_noPay">

                            <button style="margin-left:360px;" class="orderCancel">取消订单</button>

                            <button onclick="refund_qx()">去支付</button>
                        </div>
                        <form action="<?=$g_self_domain?>/menpiao/ticket_online_pay-3.html" method="post" id='qx'>
                            <input type="hidden" name="goodsName" id="goodsName" value="<?=$orderInfoExceptTicket['productName']?>">
                            <input type="hidden" name="payPrice" id="payPrice" value="<?=$totalFee?>">
                            <input type="hidden" name="orderCode" id="orderCode" value="<?=$orderInfoExceptTicket['orderCode']?>">
                            <input type="hidden" name="lvGoodsName" id="lvGoodsName" value="<?=$db->to_gbk($list['lvGoodsName'])?>">
                            <input type="hidden" name="payTime" id="payTime" value="<?=$pay_detail['payWaitTime']?>">
                        </form>
                    <?}elseif($st == 3){?>
                        <!-- 已付款出票中 按钮 -->
                        <div class="orderBtn_chupiaozhong">
                            <a href="<?= $g_self_domain ?>/menpiao/ticket_order-<?= urlencode($db->to_gbk($list['lvGoodsName'])) ?>-<?= urlencode($db->to_gbk($ticketTypeName)) ?>-<?= $list['isEmail'] ?>-<?= $list['isCredentials'] ?>-<?= $obj['scenicInfo']['goodsId'] ?>-<?= $obj['scenicInfo']['lvProductId'] ?>-<?= $list['lvGoodsId'] ?>.html"><button style="margin-left:360px;">再次预定</button></a>
                            <button class="applyRefundBtn">申请退款</button>
                        </div>
                        <!-- 已付款未使用 按钮 -->
                        <!-- <div class="orderBtn_noUse hide">
                            <button>再次预定</button>
                            <button>去评价</button>
                            <button class="applyRefundBtn">申请退款</button>
                        </div> -->
                        <!-- 已付款已使用 按钮 -->
                    <?}elseif($st == 4){?>
                        <div class="orderBtn_hasUse">
                            <a href="<?= $g_self_domain ?>/menpiao/ticket_order-<?= urlencode($db->to_gbk($list['lvGoodsName'])) ?>-<?= urlencode($db->to_gbk($ticketTypeName)) ?>-<?= $list['isEmail'] ?>-<?= $list['isCredentials'] ?>-<?= $obj['scenicInfo']['goodsId'] ?>-<?= $obj['scenicInfo']['lvProductId'] ?>-<?= $list['lvGoodsId'] ?>.html"><button style="margin-left:360px;">再次预定</button></a>
                            <button onclick="comment_commit()">去评价</button>
                            <!--                            <a href="/menpiao/ticket_comment_commit.html><button>去评价</button></a>-->
                        </div>
                    <?}?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 订单详情 end -->

<!-- 黑色蒙层 -->
<div id="mengban" class="hide"></div>

<!-- 申请退款点击后弹窗 -->
<div class="applyRefund hide">
    <div class="applyRefund_title">
        <div class="applyRefund_title_left">已支付订单</div>
        <span class="applyRefund_title_right"></span>
    </div>

    <div class="applyRefund_cont">
        <div class="applyRefund_cont_tips">&nbsp;&nbsp;是否申请退款?</div>
        <button class="applyRefund_sure">确认</button>
        <!--			<a href="--><?//=$nowUrl?><!----><?//=$flagch?><!--"><button class="applyRefund_sure">确认</button></a>-->
        <button class="applyRefund_cancel">取消</button>
    </div>
</div>
<!-- 取消订单弹窗 -->
<div class="cancelBox hide">
    <div class="cancelBox_title">
        <div class="cancelBox_title_left">取消订单</div>
        <span class="cancelBox_title_right"></span>
    </div>

    <div class="cancelBox_cont">
        <div class="cancelBox_cont_tips">&nbsp;&nbsp;是否取消订单?</div>
        <a href="<?=$nowUrl?><?=$flag?>"><button class="cancelBox_sure">确认</button></a>
        <button class="cancelBox_cancel">取消</button>
    </div>
</div>
<!-- 取消订单成功或失败弹窗 -->
<? if($_GET['flag']=='qx'){ ?>
    <div class="cancelBox1">
        <div class="cancelBox1_title">
            <div class="cancelBox1_title_left">bus365提示您</div>
            <a href="<?=$aurl?>"><span class="cancelBox1_title_right"></span></a>
        </div>
        <div class="cancelBox1_cont">
            <div class="cancelBox1_cont_tips">&nbsp;&nbsp;<?=utf8_to_gbk($res['data']['message'])?></div>
        </div>
    </div>
<?}?>
<!-- 重发短信凭证弹窗 -->
<div class="msgRetryBox hide">
    <div class="msgRetryBox_title">
        <div class="msgRetryBox_title_left">重发短信</div>
        <span class="msgRetryBox_title_right"></span>
    </div>

    <div class="msgRetryBox_cont">
        <div class="msgRetryBox_cont_tips">&nbsp;&nbsp;是否重发短信凭证?</div>
        <a href="<?=$nowUrl?><?=$flagc?>"><button class="msgRetryBox_sure">确认</button></a>
        <button class="msgRetryBox_cancel">取消</button>
    </div>
</div>
<!-- 重发短信成功或失败弹窗 -->
<? if($_GET['flag']=='cf'){ ?>
    <div class="msgRetryBox1">
        <div class="msgRetryBox1_title">
            <div class="msgRetryBox1_title_left">bus365提示您</div>
            <a href="<?=$burl?>"><span class="msgRetryBox1_title_right"></span></a>
        </div>
        <div class="msgRetryBox1_cont">
            <div class="msgRetryBox1_cont_tips">&nbsp;&nbsp;<?=utf8_to_gbk($msg['data']['solution'])?></div>
        </div>
    </div>
<?}?>
<!--    //退款成功失败提示-->
<?if(!empty($require_refund)){ ?>
    <!--        17:50:50-->
    <!--        北京-邢广凯 2017/3/22 17:50:50-->
    <!-- 退款成功弹窗 -->
    <div class="tuikuanSuccessBox" style="width: 400px;height: 150px;position: absolute;left: 50%;top: 50%;margin-left: -200px;margin-top: -75px;border:solid 2px #ddd;background-color: white;">
        <p style="width: 400px;padding-top:50px;text-align: center;font-size: 20px;color: #333;"><?if ($require_refund['status'] != '0000'){echo $require_refund_data['failReason'];}else {echo $require_refund_data['refundCustomerInfo'];}?></p>
        <a href="<?echo $g_self_domain;?>/menpiao/dingdan_detail-<?echo $orderCode;?>.html?rstatus=<?echo $require_refund['status'];?>"><button style="display: block;width: 60px;height: 30px;line-height: 30px;text-align: center;color: white;font-size: 18px;background-color: #f60;margin:30px 20px 0 300px;border:none;border-radius: 2px;">确定</button></a>
    </div>

<?}?>
<!--确认提交退款申请与否-->
<?//if(!empty($require_refund)){ ?>
<!--    <!--        17:50:50-->
<!--    <!--        北京-邢广凯 2017/3/22 17:50:50-->
<!--    <!-- 退款成功弹窗 -->
<!--    <div class="zaicituikuanBox" style="width: 400px;height: 150px;position: absolute;left: 50%;top: 50%;margin-left: -200px;margin-top: -75px;border:solid 2px #ddd;background-color: white;">-->
<!--        <p style="width: 400px;padding-top:50px;text-align: center;font-size: 20px;color: #333;">--><?//echo $require_refund_data['refundCustomerInfo'];?><!--</p>-->
<!--        <a href="--><?//echo $g_self_domain;?><!--/menpiao/dingdan_detail---><?//echo $orderCode;?><!--.html"><button style="display: block;width: 60px;height: 30px;line-height: 30px;text-align: center;color: white;font-size: 18px;background-color: #f60;margin:30px 20px 0 300px;border:none;border-radius: 2px;">确定</button></a>-->
<!--    </div>-->
<!---->
<?//}?>
<!-- 退款说明信息 -->
<!--    <form class="refundInfoCont">-->
<div class="refundInfo hide">
    <div class="refundInfo_top">
        <h3>退款申请</h3>
        <span class="refundInfo_close"></span>
    </div>
    <!--            --><?//echo $nowUrl;echo $flagr;?>
    <!--            <form  method="post"  id="refundForm" action="--><?//=$nowUrl?><!----><?//=$flagr?><!--">-->
    <form  method="post"  id="refundForm" action="<?echo $g_self_domain;?>/menpiao/dingdan_detail-<?echo $orderCode;?>.html?flag=rf">
        <input type="hidden" name="orderCode" value="<?echo $orderCode;?>">
        <div class="refundInfoCont1">
            <span>退款原因：</span>
            <select name="refundReasonCode">
                <? foreach ($refund_reason_data as $key => $value) { ?>
                    <option  value="<? echo $value['code']; ?>"><? echo $value['name']; ?></option>
                <? } ?>
            </select>
        </div>
        <div class="refundInfoCont2">
            <h4>退款明细</h4>
            <div class="orderInfo_table">
                <div class="orderInfo_table_title">
                    <ul>
                        <li class="orderInfo_table_tr1">订单名称</li>
                        <li class="orderInfo_table_tr2">订单金额</li>
                        <li class="orderInfo_table_tr3">扣款金额</li>
                        <li class="orderInfo_table_tr4">退款金额</li>
                    </ul>
                </div>
                <div class="orderInfo_table_cont">
                    <ul>
                        <li class="orderInfo_table_tr1"><? echo $refund_product_data['productName']; ?></li>
                        <li class="orderInfo_table_tr2"
                            style="color: #ff6600;">&yen;<? echo $refund_product_data['totalFee'] ?></li>
                        <li class="orderInfo_table_tr3">
                            <p style="color: #ff6600;">&yen;<? echo $refund_product_data['deductFee']; ?></p>
                            <p>&yen;<? echo $refund_product_data['deductFee']; ?>
                                | <? echo $refund_product_data['goodsName']; ?></p>
                            <p style="color: #bababa;">
                                扣款说明：<? echo $refund_product_data['refundExplain']; ?></p>
                        </li>
                        <li class="orderInfo_table_tr4"
                            style="color: #ff6600;">&yen;<? echo $refund_product_data['refundFee']; ?>  </li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
    <div class="refundInfoCont3">
        <button class="tijiao" onclick="refund_commit()">提交</button>
        <!--                    <a href="--><?//=$nowUrl?><!----><?//=$flagr?><!--"><button class="tijiao">提交</button></a>-->
        <button class="quxiao">取消</button>
    </div>
</div>
</div>
<!--    </form>-->
<!--  foot  start -->
<?include('foot.php');?>
<!--  foot  end -->


<script type="text/javascript" src="/themes/s01/js/jquery.js"></script>
<script type="text/javascript" src="/themes/s01/js/common.js"></script>
<script type="text/javascript">
    function refund_commit(){
//        window.top.location.href = url;
        document.getElementById('refundForm').submit();
    }
    function refund_qx(){
//        window.top.location.href = url;
        document.getElementById('qx').submit();
    }
    // 关闭退款说明信息
    $('.refundInfo_close').click(function(){
        $(".refundInfo").hide();
        $("#mengban").hide();
    });
    // 关闭是否退款对话框
    $('.applyRefund_title_right').click(function(){
        $("#mengban").hide();
        $(".applyRefund").hide();
    });
    $('.applyRefund_cancel').click(function(){
        $("#mengban").hide();
        $(".applyRefund").hide();
    });

    for(var i=0;i<$('.applyRefundBtn').length;i++){
        $('.applyRefundBtn').eq(i).click(function(){
//			//$('.refundInfo').show();
//            var val = $("#wxqrcode").val();
//            $.ajax({
//                type: 'post',
//                url: "<?//=$host?>///travel/interface/menpiao/ticketRefundInfo",
//                data: {"val" : <?//=$post;?>//},
//                success: function (result)
//                {
//                    var product_data = result['data'];
//                    var totalFee = product_data['totalFee'];
//                }
//            });

            $("#mengban").show();
            $('.applyRefund').show();
        });
    }
    $('.applyRefund_sure').click(function(){
        $('.refundInfo').show();
        $('.applyRefund').hide();
    });
    $('.applyRefund_cancel').click(function(){
        $('.applyRefund').hide();
        $("#mengban").hide();
    });
    $('.quxiao').click(function(){
        $('.refundInfo').hide();
        $("#mengban").hide();
    });

    //发送短信确认弹窗
    $('.msgRetry').click(function(){
        $("#mengban").show();
        $('.msgRetryBox').show();
    });
    $('.msgRetryBox_title_right').click(function(){
        $("#mengban").hide();
        $(".msgRetryBox").hide();
    });
    $('.msgRetryBox_cancel').click(function(){
        $("#mengban").hide();
        $(".msgRetryBox").hide();
    });
    //发送短信成功或失败弹窗
    $('.msgRetryBox_sure').click(function(){
        $('.msgRetryBox1').show();
        $(".msgRetryBox").hide();
    });
    $('.msgRetryBox1_title_right').click(function(){
        $("#mengban").hide();
        $(".msgRetryBox1").hide();
    });

    //取消订单确认弹窗
    $('.orderCancel').click(function(){
        $("#mengban").show();
        $('.cancelBox').show();
    });
    $('.cancelBox_title_right').click(function(){
        $("#mengban").hide();
        $(".cancelBox").hide();
    });
    $('.cancelBox_cancel').click(function(){
        $("#mengban").hide();
        $(".cancelBox").hide();
    });
    //取消订单成功或失败弹窗
    $('.cancelBox_sure').click(function(){
        $('.cancelBox1').show();
        $(".cancelBox").hide();
    });
    $('.cancelBox1_title_right').click(function(){
        $("#mengban").hide();
        $(".cancelBox1").hide();
    });
    function comment_commit(){
        var url = "/menpiao/ticket_comment_commit-<?=$orderInfoExceptTicket['orderCode'];?>.html";
        window.location.href = url;
    }

    //退款js
    $('.tuikuanSuccessBox button').click(function(){
        $('.tuikuanSuccessBox').hide();
    });
</script>
</body>
</html>