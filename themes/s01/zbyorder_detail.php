<?
if (!defined('IN_CLOOTA')) {
    exit('Access Denied');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/pay_detail.css">
    <title>�ܱ��ζ�������</title>
    <?include('static.php');?>
</head>
<body>
<!--  head  start -->


<? include 'head.php'; ?>

<!--  nav����  end -->

<!-- �������� start -->
<div id="orderDetail_mainBox">
    <div id="orderDetail_main">
        <div class="orderDetail_main1">�ҵ�Bus365 &gt; �ҵĶ��� &gt; <a href="">��������</a></div>
        <div class="orderDetail_main2">
            <div class="orderDetail_main2_title">��������</div>

            <div class="visitorInfo">
                <div class="visitorInfo_title">��ϵ����Ϣ</div>
                <div class="visitorInfo1">
                    <ul>
                        <li>���� <span><? $linker = $order_detail_data['linker'];
                                echo $linker; ?></span></li>
                        <li>�ֻ� <span><? $linkerMobile = $order_detail_data['linkerMobile'];
                                echo $linkerMobile; ?></span></li>
                    </ul>
                </div>
                <div class="visitorInfo_title">��������Ϣ</div>
                <div class="visitorInfo2">
                    <table>
                        <thead>
                        <tr>
                            <th>����</th>
                            <th>�ֻ�</th>
                            <th>֤������</th>
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
                        <? } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="orderInfo">
                <div class="orderInfo_title">������Ϣ</div>
                <div class="orderInfo1">
                    <ul>
                        <li>�����ţ�<? echo $order_detail_data['orderCode']; ?></li>
                        <li>����״̬��<? echo $order_detail_data['orderStatusName']; ?></li>
                        <li>�µ�ʱ�䣺<? echo $order_detail_data['orderDate']; ?></li>
                        <li>֧����ʽ��<? echo $order_detail_data['paymentType']; ?></li>
                    </ul>
                    <div class="refundErrorText hide">
                        �˿�ԭ��Ԥ����ǰ���븶���ڡ�
                    </div>
                </div>
                <div class="orderInfo2">
                    <table>
                        <thead>
                        <tr>
                            <th>��Ʒ����</th>
                            <?if($order_detail_data['isPackage'] == 'false'){ ?>
                                <th>����</th>
                            <? }else if($order_detail_data['isPackage'] == 'true') { ?>
                                <th>����</th>
                            <? } ?>
                            <th>��������</th>
                            <th>���ۼ�</th>
                            <th>С��</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?if($order_detail_data['isPackage'] == 'false'){ ?>
                            <tr>
                                <td class="productName"><b><? echo $order_detail_data['goodsName']; ?></b></td>
                                <td class="productOther">���ˡ�<? echo $order_detail_data['adultNum']; ?></td>
                                <td class="productDate"><? echo $order_detail_data['playDate']; ?></td>
                                <td class="productPrice2"><? echo $order_detail_data['adultPrice']; ?></td>
                                <td class="productXiaoji"><? echo $order_detail_data['adultTotalFee']; ?></td>
                            </tr>
                            <tr>
                                <td class="productName"><b><? echo $order_detail_data['goodsName']; ?></b></td>
                                <td class="productOther">��ͯ��<? echo $order_detail_data['kidNum']; ?></td>
                                <td class="productDate"><? echo $order_detail_data['playDate']; ?></td>
                                <td class="productPrice2"><? echo $order_detail_data['kidPrice']; ?></td>
                                <td class="productXiaoji"><? echo $order_detail_data['kidTotalFee']; ?></td>
                            </tr>
                        <? }else if($order_detail_data['isPackage'] == 'true') { ?>
                            <td class="productName"><b><? echo $order_detail_data['goodsName']; ?></b></td>
                            <td class="productOther"><? echo $order_detail_data['num']; ?></td>
                            <td class="productDate"><? echo $order_detail_data['playDate']; ?></td>
                            <td class="productPrice2"><? echo $order_detail_data['adultPrice']; ?></td>
                            <td class="productXiaoji"><? echo $order_detail_data['num'] * $order_detail_data['adultPrice']; ?></td>
                        <? } ?>

                        </tbody>
                    </table>

                    <p><span>�����ܽ���<b><? echo $order_detail_data['payPrice']; ?></b></span></p>
                </div>


                <div class="orderBtnBox">
                    <? if ($st == 0) { ?>
                        <!-- Ĭ�ϰ�ť����ȡ�����˿��С��˿�ɹ����˿�ʧ�ܣ�-->
                        <div class="orderBtn_default">
                            <button onclick="order_again()">�ٴ�Ԥ��</button>
                        </div>
                    <? } elseif($st == 1){ ?>
                        <!-- //��֧�� ���� ��ȷ�� ����  ��ǰʱ��û�е���������-->
                        <!-- ��֧��δȷ��/��֧����ȷ�� ��ť -->
                        <div class="orderBtn_chupiaozhong">
                            <button style="margin-left:360px;" onclick="order_again()">�ٴ�Ԥ��</button>
                            <button class="applyRefundBtn">�����˿�</button>
                        </div>
                    <? } elseif($st == 2){ ?>
                        <!-- //�����-->
                        <!-- ��֧��-��ȷ��-���� ��ť -->
                        <div class="orderBtn_hasUse">
                            <button style="margin-left:360px;" onclick="order_again()">�ٴ�Ԥ��</button>
                            <button onclick="comment_commit()">ȥ����</button>
                        </div>
                    <? } elseif($st == 3){ ?>
                        <!-- //��ȷ��-->
                        <!-- ��֧��-��ȷ��-ȷ�ϻ��� ��ť -->
                        <div class="orderBtn_chupiaozhong">
                            <button style="margin-left:360px;" onclick="order_again()">�ٴ�Ԥ��</button>
                            <button class="querenhuituanbt">ȷ�ϻ���</button>
                        </div>
                    <? } elseif($st == 4){ ?>
                    <!--  //������-->
                    <!-- ��֧����ť -->
                    <a class="orderBtn_noPay">
                        <button style="margin-left:360px;" class="zby_cancel">ȡ������</button>
                        <button onclick="pay_online()">ȥ֧��</button>
                </div>
                <? } ?>
            </div>
        </div>
    </div>
</div>
</div>
<!-- �������� end -->


<!-- ��ɫ�ɲ� -->
<div id="mengban" class="hide"></div>


<!-- �˿�˵����Ϣ -->

<div class="refundInfo hide">
    <div class="refundInfo_top">
        <h3 style="font-weight:bold;">�˿�����</h3>
        <span class="refundInfo_close"></span>
    </div>
    <div class="refundInfoCont">
        <form  method="post"  id="rfCommitForm" action="<?echo $g_self_domain;?>/zhoubianyou/zbyorder_detail-<?echo $orderCode;?>.html?flag=rf">
            <input type="hidden" name="orderCode" value="<?echo $orderCode;?>">
            <div class="refundInfoCont1">
                <span>�˿�ԭ��</span>
                <select name="refundReasonCode">
                    <? foreach ($refundReasonList as $key => $value) { ?>
                        <option  value="<? echo $value['code']; ?>"><? echo $value['name']; ?></option>
                    <? } ?>
                </select>
            </div>
            <div class="refundInfoCont2">
                <h4 style="font-weight:bold;font-size:14px;">�˿���ϸ</h4>
                <div class="orderInfo_table">
                    <div class="orderInfo_table_title">
                        <ul>
                            <li class="orderInfo_table_tr1">��Ʒ��</li>
                            <li class="orderInfo_table_tr2">�ײ�����</li>
                            <li class="orderInfo_table_tr2">�ͷ�˵��</li>
                        </ul>
                    </div>
                    <div class="orderInfo_table_cont">
                        <ul>
                            <li class="orderInfo_table_tr1"><? echo $refund_product_data['goodsName']; ?></li>
                            <li class="orderInfo_table_tr2"
                                style="color: #ff6600;"><? echo $refund_product_data['packageName'] ?></li>
                            <li class="orderInfo_table_tr2"
                                style="color: #ff6600;"><? echo $refund_product_data['refundCustomerInfo'] ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>
        <div class="refundInfoCont3">
            <button class="tijiao" onclick="refund_commit()">�ύ</button>
            <!--                    <a href="--><?//=$nowUrl?><!----><?//=$flagr?><!--"><button class="tijiao">�ύ</button></a>-->
            <button class="quxiao">ȡ��</button>
        </div>
    </div>
</div>



<!-- ȡ���������� -->
<div class="cancelBox hide">
    <div class="cancelBox_title">
        <div class="cancelBox_title_left">ȡ������</div>
        <span class="cancelBox_title_right"></span>
    </div>

    <div class="cancelBox_cont">
        <div class="cancelBox_cont_tips">&nbsp;&nbsp;�Ƿ�ȡ������?</div>
        <a href="<?echo $g_self_domain;?>/zhoubianyou/zbyorder_detail-<?=$orderCode;?>.html?flag=cn"><button class="cancelBox_sure">ȷ��</button></a>
        <button class="cancelBox_cancel">ȡ��</button>
    </div>
</div>
<!-- ȡ�������ɹ���ʧ�ܵ��� -->
<?if(!empty($cancle_order)){ ?>
    <div class="cancelBox1">
        <div class="cancelBox1_title">
            <div class="cancelBox1_title_left">bus365��ʾ��</div>
            <a href="<?echo $g_self_domain;?>/zhoubianyou/zbyorder_detail-<?=$orderCode;?>.html"><span class="cancelBox1_title_right"></span></a>
        </div>
        <div class="cancelBox1_cont">
            <div class="cancelBox1_cont_tips">&nbsp;&nbsp;<?echo $cancle_order_data['message'];?></div>
        </div>
    </div>
<?}?>

<!-- �����˿����󵯴� -->
<div class="applyRefund hide">
    <div class="applyRefund_title">
        <div class="applyRefund_title_left">��֧������</div>
        <span class="applyRefund_title_right"></span>
    </div>

    <div class="applyRefund_cont">
        <div class="applyRefund_cont_tips">&nbsp;&nbsp;�Ƿ������˿�?</div>
        <button class="applyRefund_sure"">ȷ��</button>
        <button class="applyRefund_cancel">ȡ��</button>
    </div>
</div>

<!-- ȷ�ϻ��ŵ���󵯴� -->
<div class="querenhuituan hide">
    <div class="querenhuituan_title">
        <div class="querenhuituan_title_left">��֧������</div>
        <span class="querenhuituan_title_right"></span>
    </div>

    <div class="querenhuituan_cont">
        <div class="querenhuituan_cont_tips">&nbsp;&nbsp;�Ƿ�ȷ�ϻ���?</div>
        <button class="querenhuituan_sure" onclick="confirm_return()">ȷ��</button>
        <!--			<a href="--><?//=$nowUrl?><!----><?//=$flagch?><!--"><button class="applyRefund_sure">ȷ��</button></a>-->
        <button class="querenhuituan_cancel">ȡ��</button>
    </div>
</div>

<!-- ȷ�ϻ��ųɹ���ʧ�ܵ��� -->
<?if(!empty($confirm_return_data)){ ?>
    <div class="querenhuituan1">
        <div class="querenhuituan1_title">
            <div class="querenhuituan1_title_left">bus365��ʾ��</div>
            <a href="<?echo $g_self_domain;?>/zhoubianyou/zbyorder_detail-<?=$orderCode;?>.html"><span class="querenhuituan1_title_right"></span></a>
        </div>
        <div class="querenhuituan1_cont">
            <div class="querenhuituan1_cont_tips">&nbsp;&nbsp;<?echo $confirm_return_data['message'];?></div>
        </div>
    </div>
<?}?>


<!--    //�ܷ��˿���ʾ-->

<div class="nengtuifou" style="display:none">
    <div class="nengtuifou_title">
        <div class="nengtuifou_title_left">bus365��ʾ��</div>
        <a href="<?echo $g_self_domain;?>/zhoubianyou/zbyorder_detail-<?=$orderCode;?>.html"><span class="nengtuifou_title_right"></span></a>
    </div>
    <div class="nengtuifou_cont">
        <div class="nengtuifou_cont_tips">&nbsp;&nbsp;<?echo $failReason;?></div>
    </div>
</div>
<!--ȥ֧����-->
<form action="<?=$g_self_domain?>/zhoubianyou/zbyonline_pay-<?=$orderCode;?>.html" method="post" id="onlineForm">
    <input type="hidden" name="payPrice" value="<?=$order_detail_data['payPrice']?>">
    <input type="hidden" name="goodsName" id="goodsName" value="<?=$order_detail_data['goodsName']?>">
    <input type="hidden" name="payTime"  value="<?=$order_detail_data['leftPayTime']?>">
    <input type="hidden" name="lvGoodsName"  value="<?=$order_detail_data['lvGoodsName']?>">
    <input type="hidden" name="orderCode"  value="<?=$order_detail_data['orderCode']?>">
</form>
<!--  foot  start -->
<? include 'foot.php'; ?>
<!--  foot  end -->
</body>
<script type="text/javascript" src="/thmes/s01/js/jquery.js"></script>
<script type="text/javascript" src="/themes/s01/js/common.js"></script>
<script type="text/javascript">
    // �ر��˿�˵����Ϣ
    $('.refundInfo_close').click(function () {
        $("#mengban").hide();
        $(".refundInfo").hide();
    });
    // �ر��Ƿ��˿�Ի���
    $('.applyRefund_title_right').click(function(){
        $("#mengban").hide();
        $(".applyRefund").hide();
    });
    $('.applyRefund_cancel').click(function(){
        $("#mengban").hide();
        $(".applyRefund").hide();
    });

    //�����˿ť����
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
                alert(data);
                if('false' == 'false'){
                    $('.nengtuifou').show();
                    $('.applyRefund').hide();
                    $("#mengban").hide();
                } else{
                    $('.refundInfo').show();
                    $('.applyRefund').hide();
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
    // �ر��Ƿ�ȷ�ϻ��ŶԻ���
    $('.querenhuituan_title_right').click(function(){
        $("#mengban").hide();
        $(".querenhuituan").hide();
    });

    //ȡ������ȷ�ϵ���
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

    //ȡ�������ɹ���ʧ�ܵ���
    $('.cancelBox_sure').click(function(){
        $('.cancelBox1').show();
        $(".cancelBox").hide();
    });
    $('.cancelBox1_title_right').click(function(){
        $("#mengban").hide();
        $(".cancelBox1").hide();
    });

    //ȷ�ϻ��ŵ���
    $('.querenhuituanbt').click(function(){
        $("#mengban").show();
        $('.querenhuituan').show();
    });

    $('.querenhuituan_cancel').click(function(){
        $("#mengban").hide();
        $(".querenhuituan").hide();
    });
    //�˿�����ӿ�
    function refund_commit(){
        document.getElementById("rfCommitForm").submit();
    }
    //ȷ�ϻ�������ӿ�
    function confirm_return(){
        var url = "/zhoubianyou/zbyorder_detail-<?=$orderCode;?>.html?flag=cf";
        window.location.href = url;
    }
   //ȥ����
    function comment_commit(){
        var url = "/zhoubianyou/zbycomment_commit-<?=$orderCode;?>.html";
        window.location.href = url;
    }
    //�ٴ�Ԥ��
    function order_again(){
        var url = "<?=$g_self_domain;?>/product/detail-<?=$order_detail_data['goodsId']?>-<?=$order_detail_data['productId']?>.html";
        window.location.href = url;
    }
    //ȥ֧��
    function order_again(){
        $('onlineForm').submit();
    }
</script>
</html>