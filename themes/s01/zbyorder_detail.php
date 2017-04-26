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
                        <td class="productPrice2"><? echo $order_detail_data['kidPrice']; ?></td>
                        <td class="productXiaoji"><? echo $order_detail_data['kidTotalFee']; ?></td>
                        <? } ?>
                        </tbody>
                    </table>

                    <p><span>�����ܽ���<b><? echo $order_detail_data['orderFee']; ?></b></span></p>
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
                            <button>�����˿�</button>
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
                            <button>ȷ�ϻ���</button>
                        </div>
                    <? } elseif($st == 4){ ?>
                    <!--  //������-->
                    <!-- ��֧����ť -->
                    <a class="orderBtn_noPay">
                        <button style="margin-left:360px;" class="zby_cancel">ȡ������</button>
                        <button>ȥ֧��</button>
                </div>
                <? } ?>
            </div>
        </div>
    </div>
</div>
</div>
<!-- �������� end -->


<!-- ��ɫ�ɲ� -->
<div id="mengban hide"></div>



<!-- �˿�˵����Ϣ -->
<div class="refundInfo hide">
    <div class="refundInfo_top">
        <h3>�˿�˵��</h3>
        <span class="refundInfo_close"></span>
    </div>
    <div class="refundInfoCont">
        (1)������ߣ�a. 1.2�ף����������µĶ�ͯ��Ʊ����ÿ����Ʊ�����޴�һ����ߵ���1.2�׵Ķ�ͯ��b. 70���꣨�������ϵ����ˣ�ƾ�������֤����԰����ѡ�c.
        �ֹ��Ҳ����䷢�ڶ������м�֤���Ĳм�����Ʊ��ä�ˡ����ϡ����������Ĳм�������ˣ��蹺Ʊ����ͬ��԰����ѡ�<br>(2) a. 1.2�ף�����~1.5�ף������Ķ�ͯ��160Ԫ/�ˡ�������������b.
        60���꣨����~69���꣨���������ˣ�ƾ��Ч���֤����԰����60Ԫ/�ˡ�������������c.
        2016��3��16��--2016��11��15�գ����й����ο����յ��죨�����֤����Ϊ׼����ƾ�������֤���������֤����ʻ֤�����ڱ�������Ϻ�����ͷ�����Ч֤���������й����ճ�ȫ����Ʊ�������Żݼ�130Ԫ/�š�<br>(2)
        a. 1.2�ף�����~1.5�ף������Ķ�ͯ��160Ԫ/�ˡ�������������b. 60���꣨����~69���꣨���������ˣ�ƾ��Ч���֤����԰����60Ԫ/�ˡ�������������c.
        2016��3��16��--2016��11��15�գ����й����ο����յ��죨�����֤����Ϊ׼����ƾ�������֤���������֤����ʻ֤�����ڱ�������Ϻ�����ͷ�����Ч֤���������й����ճ�ȫ����Ʊ�������Żݼ�130Ԫ/�š�<br>(2)
        a. 1.2�ף�����~1.5�ף������Ķ�ͯ��160Ԫ/�ˡ�������������b. 60���꣨����~69���꣨���������ˣ�ƾ��Ч���֤����԰����60Ԫ/�ˡ�������������c.
        2016��3��16��--2016��11��15�գ����й����ο����յ��죨�����֤����Ϊ׼����ƾ�������֤���������֤����ʻ֤�����ڱ�������Ϻ�����ͷ�����Ч֤���������й����ճ�ȫ����Ʊ�������Żݼ�130Ԫ/�š�<br>(2)
        a. 1.2�ף�����~1.5�ף������Ķ�ͯ��160Ԫ/�ˡ�������������b. 60���꣨����~69���꣨���������ˣ�ƾ��Ч���֤����԰����60Ԫ/�ˡ�������������c.
        2016��3��16��--2016��11��15�գ����й����ο����յ��죨�����֤����Ϊ׼����ƾ�������֤���������֤����ʻ֤�����ڱ�������Ϻ�����ͷ�����Ч֤���������й����ճ�ȫ����Ʊ�������Żݼ�130Ԫ/�š�<br>(2)
        a. 1.2�ף�����~1.5�ף������Ķ�ͯ��160Ԫ/�ˡ�������������b. 60���꣨����~69���꣨���������ˣ�ƾ��Ч���֤����԰����60Ԫ/�ˡ�������������c.
        2016��3��16��--2016��11��15�գ����й����ο����յ��죨�����֤����Ϊ׼����ƾ�������֤���������֤����ʻ֤�����ڱ�������Ϻ�����ͷ�����Ч֤���������й����ճ�ȫ����Ʊ�������Żݼ�130Ԫ/�š�
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
        <button class="applyRefund_sure">ȷ��</button>
        <!--			<a href="--><?//=$nowUrl?><!----><?//=$flagch?><!--"><button class="applyRefund_sure">ȷ��</button></a>-->
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
        <button class="querenhuituan_sure">ȷ��</button>
        <!--			<a href="--><?//=$nowUrl?><!----><?//=$flagch?><!--"><button class="applyRefund_sure">ȷ��</button></a>-->
        <button class="querenhuituan_cancel">ȡ��</button>
    </div>
</div>

<!-- ȷ�ϻ��ųɹ���ʧ�ܵ��� -->
<?if(!empty($cancle_orderx)){ ?>
    <div class="querenhuituan1">
        <div class="querenhuituan1_title">
            <div class="querenhuituan1_title_left">bus365��ʾ��</div>
            <a href="<?echo $g_self_domain;?>/zhoubianyou/zbyorder_detail-<?=$orderCode;?>.html"><span class="querenhuituan1_title_right"></span></a>
        </div>
        <div class="querenhuituan1_cont">
            <div class="querenhuituan1_cont_tips">&nbsp;&nbsp;<?echo $cancle_order_data['message'];?></div>
        </div>
    </div>
<?}?>

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
    function comment_commit(){
        var url = "/zhoubianyou/zbycomment_commit-<?=$orderCode;?>.html";
        window.location.href = url;
    }
    function order_again(){
        var url = "";
        window.location.href = url;
    }

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

    //�����˿ť����
    for(var i=0;i<$('.applyRefundBtn').length;i++){
        $('.applyRefundBtn').eq(i).click(function(){
            $("#mengban").show();
            $('.applyRefund').show();
        });
    }
    //ȷ�ϻ��ŵ���
    $('.querenhuituanbt').click(function(){
        $("#mengban").show();
        $('.querenhuituan').show();
    });
    // �ر��Ƿ�ȷ�ϻ��ŶԻ���
    $('.querenhuituan_title_right').click(function(){
        $("#mengban").hide();
        $(".querenhuituan").hide();
    });
    $('.querenhuituan_cancel').click(function(){
        $("#mengban").hide();
        $(".querenhuituan").hide();
    });
    //�˿�����ӿ�
    function refund_commit(){
        var url = "/zhoubianyou/zbyorder_detail-<?=$orderCode;?>.html?flag=rf";
        window.location.href = url;
    }
    //ȷ�ϻ�������ӿ�
    function confirm_return(){
        var url = "/zhoubianyou/zbyorder_detail-<?=$orderCode;?>.html?flag=cf";
        window.location.href = url;
    }
</script>
</html>