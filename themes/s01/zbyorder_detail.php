<?
if (!defined('IN_CLOOTA')) {
    exit('Access Denied');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/pay_detail.css">
    <link rel="shortcut icon" type="image/png" href="http://www.bus365.com/public/images/bus365.png">
    <title>周边游订单详情</title>
    <?include('static.php');?>
</head>
<body>
<!--  head  start -->


<? include 'head.php'; ?>

<!--  nav导航  end -->

<!-- 订单详情 start -->
<div id="orderDetail_mainBox">
    <div id="orderDetail_main">
        <div class="orderDetail_main1">我的Bus365 &gt; <a href="<?=$g_bus365_domain?>/index/order/orders/">我的订单 </a>&gt; <a href="">订单详情</a></div>
        <div class="orderDetail_main2">
            <div class="orderDetail_main2_title">订单详情</div>

            <div class="visitorInfo">
                <div class="visitorInfo_title">联系人信息</div>
                <div class="visitorInfo1">
                    <ul>
                        <li>姓名 <span><? $linker = $order_detail_data['linker'];
                                echo $linker; ?></span></li>
                        <li>手机 <span><? $linkerMobile = $order_detail_data['linkerMobile'];
                                echo $linkerMobile; ?></span></li>
                    </ul>
                </div>
                <? if(notnull($order_detail_data['playPeopleList'])){ ?>
                <div class="visitorInfo_title">出游人信息</div>
                <div class="visitorInfo2">
                    <table>
                        <thead>
                        <tr>
                            <th>姓名</th>
                            <th>手机</th>
                            <th>证件号码</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?
                        foreach ($order_detail_data['playPeopleList'] as $key => $value) {
                            ?>

                            <tr>
                                <td><? echo $value['userName']; ?></td>
                                <td><? echo $value['userPhone']; ?></td>
                                <td><? echo $value['userIdCard']; ?></td>
                            </tr>
                        <? }?>
                        </tbody>
                    </table>
                </div>
                <? } ?>
            </div>
            <div class="orderInfo">
                <div class="orderInfo_title">订单信息</div>
                <div class="orderInfo1">
                    <ul>
                        <li>订单号：<? echo $order_detail_data['orderCode']; ?></li>
                        <li class="sli">订单状态：<? echo $order_detail_data['orderStatusName']; if($order_detail_data['orderStatus'] == '2' && $order_detail_data['verifyFlag'] != '2') echo '(出单中)'; if($order_detail_data['orderStatus'] == '2' && $order_detail_data['verifyFlag'] == '2') echo "<span style='color:red;'>(出单失败)(退款将在3-5个工作日会返回到您的支付账户上)</span>"; if($order_detail_data['state'] == '8') echo "<span style='color:red;'>(请联系bus65官方电话：400-0884365)</span>"; ?></li>
                        <li>下单时间：<? echo $order_detail_data['orderDate']; ?></li>
                        <li>支付方式：<? echo $order_detail_data['paymentType']; ?></li>
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
                            <?if($order_detail_data['isPackage'] == 'false'){ ?>
                                <th>人数</th>
                            <? }else if($order_detail_data['isPackage'] == 'true') { ?>
                                <th>份数</th>
                            <? } ?>
                            <th>游玩日期</th>
                            <th>现售价</th>
                            <?if($order_detail_data['isPackage'] == 'false'){ ?>
                            <th>房差</th>
                            <? } ?>
                            <th>小计</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?if($order_detail_data['isPackage'] == 'false'){ ?>
                            <tr class="morewords">
                                <td class="productName"  style="WORD-WRAP: break-word" width="500"><b><? echo $order_detail_data['goodsName']; ?></b></td>
                                <td class="productOther"><? if (!empty($order_detail_data['kidNum'])) echo '成人×'.$order_detail_data['adultNum'] . '&nbsp;&nbsp;&nbsp;&nbsp;' . '儿童×' . $order_detail_data['kidNum'] ; else echo '成人×'.$order_detail_data['adultNum'];?></td>
                                <td class="productDate"><? echo $order_detail_data['playDate']; ?></td>
                                <td class="productPrice2"><? if (!empty($order_detail_data['kidNum'])) echo '成人&yen;'.$order_detail_data['adultPrice'] . '&nbsp;&nbsp;&nbsp;&nbsp;' . '儿童&yen;' . $order_detail_data['kidPrice'] ; else echo '成人&yen;'.$order_detail_data['adultPrice'];?></td>
                                <td class="productPrice2">&yen;<? echo $order_detail_data['diffPrice']; ?></td>
                                <td class="productXiaoji">&yen;<? echo $order_detail_data['adultPrice'] * $order_detail_data['adultNum'] + $order_detail_data['kidPrice'] *  $order_detail_data['kidNum']+ $order_detail_data['diffPrice']; ?></td>
                            </tr>
                        <? }else if($order_detail_data['isPackage'] == 'true') { ?>
                            <td class="productName" style="WORD-WRAP: break-word" width="500"><b><?echo $order_detail_data['goodsName'];?></b></td>
                            <td class="productOther"><? echo $order_detail_data['num']; ?></td>
                            <td class="productDate"><? echo $order_detail_data['playDate']; ?></td>
                            <td class="productPrice2">&yen;<? echo $order_detail_data['unitPrice']; ?></td>
                            <td class="productXiaoji">&yen;<? echo $order_detail_data['num'] * $order_detail_data['unitPrice']; ?></td>
                        <? } ?>


                        </tbody>
                    </table>
<!--                    --><?//if($order_detail_data['isPackage'] == 'false'){ ?>
<!--                    <p><span>订单总金额：<b>&yen;--><?// echo $order_detail_data['payPrice']; ?><!--</b></span></p>-->
<!--                    --><?// }else if($order_detail_data['isPackage'] == 'true') { ?>
                    <p><span>订单总金额：<b>&yen;<? echo $order_detail_data['payPrice']; ?></b></span></p>
<!--                    --><?// } ?>
                </div>



                <div class="orderBtnBox">
                    <?
                    $count = count($orderOperationList);
//                    echo $count;
                    if(notnull($orderOperationList)){
                    foreach ($orderOperationList as $key => $value){
                        ?>
                        <!-- 默认按钮（已取消、退款中。退款成功。退款失败）-->


                        <div class="orderBtn_default_<?= $count?>">
                            <? if($value == 'bookAgain'){ ?>
                            <div class = "buttonClass">
                            <button  onclick="order_again()">再次预定</button>
                            </div>
                            <? }else if($value == 'refund'){ ?>
                            <div class = "buttonClass">
                            <button class="applyRefundBtn">申请退款</button>
                            </div>
                            <? } else if($value == 'evaluation'){ ?>
                            <div class = "buttonClass">
                            <button onclick="comment_commit()">去评价</button>
                            </div>
                            <? } else if($value == 'confirm') { ?>
                            <div class = "buttonClass">
                            <button class="querenhuituanbt">确认回团</button>
                            </div>
                            <? }else if($value == 'cancle') { ?>
                            <div class = "buttonClass">
                            <button class="zby_cancel">取消订单</button>
                            </div>
                            <? }else if($value == 'pay') { ?>
                            <div class = "buttonClass">
                            <button onclick="pay_online()">去支付</button>
                            </div>
                            <? } ?>
                        </div>
                    <?}}?>

                        <!-- //已支付 或者 已确认 并且  当前时间没有到出行日期-->
                        <!-- 已支付未确认/已支付已确认 按钮 -->
<!--                        <div class="orderBtn_chupiaozhong">-->
<!--                            <button style="margin-left:360px;" onclick="order_again()">再次预定</button>-->
<!--                            <button class="applyRefundBtn">申请退款</button>-->
<!--                        </div>-->
<!--                        <!-- //已完成-->
<!--                        <!-- 已支付-已确认-评价 按钮 -->
<!--                        <div class="orderBtn_hasUse">-->
<!--                            <button style="margin-left:360px;" onclick="order_again()">再次预定</button>-->
<!--                            <button onclick="comment_commit()">去评价</button>-->
<!--                        </div>-->
<!--                        <!-- //已确认-->
<!--                        <!-- 已支付-已确认-确认回团 按钮 -->
<!--                        <div class="orderBtn_chupiaozhong">-->
<!--                            <button style="margin-left:360px;" onclick="order_again()">再次预定</button>-->
<!--                            <button class="querenhuituanbt">确认回团</button>-->
<!--                        </div>-->
<!--                    <!--  //待付款-->
<!--                    <!-- 待支付按钮 -->
<!--                    <a class="orderBtn_noPay">-->
<!--                        <button style="margin-left:360px;" class="zby_cancel">取消订单</button>-->
<!--                        <button onclick="pay_online()">去支付</button>-->
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- 订单详情 end -->


<!-- 黑色蒙层 -->
<div id="mengban" class="hide"></div>


<!-- 退款说明信息 -->

<div class="refundInfo hide">
    <div class="refundInfo_top">
        <h3 style="font-weight:bold;">退款申请</h3>
        <span class="refundInfo_close"></span>
    </div>
    <div class="refundInfoCont">
        <form  method="post"  id="rfCommitForm" action="<?echo $g_self_domain;?>/zhoubianyou/zbyorder_detail-<?echo $orderCode;?>.html?flag=rf">
            <input type="hidden" name="orderCode" value="<?echo $orderCode;?>">
            <div class="refundInfoCont1">
                <span>退款原因：</span>
                <select name="refundReasonCode">
                    <? foreach ($refundReasonList as $key => $value) { ?>
                        <option  value="<? echo $value['code']; ?>"><? echo $value['name']; ?></option>
                    <? } ?>
                </select>
            </div>
            <div class="refundInfoCont2">
                <h4 style="font-weight:bold;font-size:14px;">退款明细</h4>
                <div class="orderInfo_table">
                    <div class="orderInfo_table_title">
                        <ul>
                            <li class="orderInfo_table_tr1">订单号</li>
                            <li class="orderInfo_table_tr2">产品名</li>
                            <li class="orderInfo_table_tr3">套餐名称</li>
                        </ul>
                    </div>
                    <div class="orderInfo_table_cont">
                        <ul>
                            <li class="orderInfo_table_tr1"><? echo $refund_product_data['orderCode']; ?></li>
                            <li class="orderInfo_table_tr2"
                                style="color: #000;"><? echo $refund_product_data['goodsName'] ?></li>
                            <li class="orderInfo_table_tr3"
                                style="color: #000;"><? echo $refund_product_data['packageName'] ?></li>
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



<!-- 取消订单弹窗 -->
<div class="cancelBox hide">
    <div class="cancelBox_title">
        <div class="cancelBox_title_left">取消订单</div>
        <span class="cancelBox_title_right"></span>
    </div>

    <div class="cancelBox_cont">
        <div class="cancelBox_cont_tips">&nbsp;&nbsp;是否取消订单?</div>
        <a href="<?echo $g_self_domain;?>/zhoubianyou/zbyorder_detail-<?=$orderCode;?>.html?flag=cn"><button class="cancelBox_sure">确认</button></a>
        <button class="cancelBox_cancel">取消</button>
    </div>
</div>
<!-- 取消订单成功或失败弹窗 -->
<?if(!empty($cancle_order_data)){
    $js1 = "<script>$('#mengban').show();</script>";
    echo $js1;
    ?>
    <div class="cancelBox1">
        <div class="cancelBox1_title">
            <div class="cancelBox1_title_left">bus365提示您</div>
            <a href="<?echo $g_self_domain;?>/zhoubianyou/zbyorder_detail-<?=$orderCode;?>.html"><span class="cancelBox1_title_right"></span></a>
        </div>
        <div class="cancelBox1_cont">
            <div class="cancelBox1_cont_tips">&nbsp;&nbsp;<?echo $cancle_order_data['message'];?></div>
        </div>
    </div>
<?}?>

<!-- 申请退款点击后弹窗 -->
<div class="applyRefund hide">
    <div class="applyRefund_title">
        <div class="applyRefund_title_left"></div>
        <span class="applyRefund_title_right"></span>
    </div>

    <div class="applyRefund_cont">
        <div class="applyRefund_cont_tips">&nbsp;&nbsp;是否申请退款?</div>
        <button class="applyRefund_sure"">确认</button>
        <button class="applyRefund_cancel">取消</button>
    </div>
</div>

<!-- 确认会团点击后弹窗 -->
<div class="querenhuituan hide">
    <div class="querenhuituan_title">
        <div class="querenhuituan_title_left"></div>
        <span class="querenhuituan_title_right"></span>
    </div>

    <div class="querenhuituan_cont">
        <div class="querenhuituan_cont_tips">&nbsp;&nbsp;是否确认回团?</div>
        <button class="querenhuituan_sure" onclick="confirm_return()">确认</button>
        <!--			<a href="--><?//=$nowUrl?><!----><?//=$flagch?><!--"><button class="applyRefund_sure">确认</button></a>-->
        <button class="querenhuituan_cancel">取消</button>
    </div>
</div>

<!-- 确认会团成功或失败弹窗 -->
<?if(!empty($confirm_return_data)){
    $js2 = "<script>$('#mengban').show();</script>";
    echo $js2;
    ?>
    <div class="querenhuituan1">
        <div class="querenhuituan1_title">
            <div class="querenhuituan1_title_left">bus365提示您</div>
            <a href="<?echo $g_self_domain;?>/zhoubianyou/zbyorder_detail-<?=$orderCode;?>.html"><span class="querenhuituan1_title_right"></span></a>
        </div>
        <div class="querenhuituan1_cont">
            <div class="querenhuituan1_cont_tips">&nbsp;&nbsp;<?echo $confirm_return_data['message'];?></div>
        </div>
    </div>
<?}?>


<!--    //能否退款提示-->

<div class="nengtuifou" style="display:none">
    <div class="nengtuifou_title">
        <div class="nengtuifou_title_left">bus365提示您</div>
        <a href="<?echo $g_self_domain;?>/zhoubianyou/zbyorder_detail-<?=$orderCode;?>.html"><span class="nengtuifou_title_right"></span></a>
    </div>
    <div class="nengtuifou_cont">
        <div class="nengtuifou_cont_tips">&nbsp;&nbsp;<?echo $failReason;?></div>
    </div>
</div>
<!--去支付表单-->
<form action="<?=$g_self_domain?>/zhoubianyou/zbyonline_pay-1.html" method="post" id="onlineForm">
    <input type="hidden" name="payPrice" value="<?=$order_detail_data['payPrice']?>">
    <input type="hidden" name="goodsName" id="goodsName" value="<?=$order_detail_data['goodsName']?>">
    <input type="hidden" name="payTime"  value="<?=$order_detail_data['leftPayTime']?>">
    <input type="hidden" name="lvGoodsName"  value="<?=$order_detail_data['lvGoodsName']?>">
    <input type="hidden" name="orderCode"  value="<?=$order_detail_data['orderCode']?>">
</form>
<!--  foot  start -->
<? include 'foot.php';?>
<!--  foot  end -->
</body>
<script type="text/javascript" src="/thmes/s01/js/jquery.js"></script>
<script type="text/javascript" src="/themes/s01/js/common.js"></script>
<script type="text/javascript">
    // 关闭退款说明信息
    $('.refundInfo_close').click(function () {
        $("#mengban").hide();
        $(".refundInfo").hide();
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

    //申请退款按钮弹框
    for(var i=0;i<$('.applyRefundBtn').length;i++){
        $('.applyRefundBtn').eq(i).click(function(){
//            alert('sdfsfs');
            $("#mengban").show();
            $('.applyRefund').show();
        });
    }


    $('.applyRefund_sure').click(function(){
        var orderCode = "<?= $orderCode ?>";
        $.ajax({
            type: "POST",
            url: "/model/zbyajax_check.model.php",
            data: {
                "orderCode": orderCode,
                "flag" : 'chk'
            },
            async: false,
            success: function (data) {
                data = $.trim(data);
//                alert(data.length);
//                alert(data);
                if(data == 'false'){
                    $('.nengtuifou').show();
                    $('.applyRefund').hide();
                    $("#mengban").show();
                } else{
                    $('.applyRefund').hide();
                    $('.refundInfo').show();
                }
            }
        });



    });
    $('.applyRefund_cancel').click(function(){
        $('.applyRefund').hide();
        $("#mengban").hide();
    });
    $('.quxiao').click(function(){
        $('.refundInfo').hide();
        $("#mengban").hide();
    });
    // 关闭是否确认会团对话框
    $('.querenhuituan_title_right').click(function(){
        $("#mengban").hide();
        $(".querenhuituan").hide();
    });

    //取消订单确认弹窗
    $('.zby_cancel').click(function(){
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

    //确认会团弹框
    $('.querenhuituanbt').click(function(){
        $("#mengban").show();
        $('.querenhuituan').show();
    });

    $('.querenhuituan_cancel').click(function(){
        $("#mengban").hide();
        $(".querenhuituan").hide();
    });
    //退款请求接口
    function refund_commit(){
        document.getElementById("rfCommitForm").submit();
    }
    //确认会团请求接口
    function confirm_return(){
        var url = "/zhoubianyou/zbyorder_detail-<?=$orderCode;?>.html?flag=cf";
        window.location.href = url;
    }
   //去评价
    function comment_commit(){
        var url = "/zhoubianyou/zbycomment_commit-<?=$orderCode;?>.html";
        window.location.href = url;
    }
    //再次预订
    function order_again(){
        var url = "<?=$g_self_domain;?>/product/detail-<?=$order_detail_data['goodsId']?>-<?=$order_detail_data['productId']?>.html";
        window.location.href = url;
    }
    //去支付
    function pay_online(){
        $('#onlineForm').submit();
    }
</script>
</html>