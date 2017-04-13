<!DOCTYPE html>
<html lang="en">
<head>
    <? seo(); ?>
    <? include('meta.php'); ?>
    <? include "head.php" ?>
    <? include('static.php'); ?>
    <? load_mobile('http://' . $g_config['mobile_domain'] . '/menpiao/detail-' . $c_goods_id . '.html'); ?>
    <title>����֧��</title>
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/common.css">
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/menpiaozaixianzhifu.css">
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/menpiaodingdanxiangqing.css">
</head>
<body style="position: relative;">

<!-- main���� start -->
<div id="onlinePay_mainBox">
    <div id="onlinePay_main">
        <div class="onlinePay_main_title">
            <img src="/themes/s01/images/fillInOrder_process2.jpg">
        </div>
        <div class="onlinePay_main1">
            <div class="onlinePay_main1_simInfo">
                <div class="onlinePay_main1_left"><?= $db->to_gbk($goodsName) ?></div>
                <div class="onlinePay_main1_right">Ӧ����� <b><?= $payPrice ?></b><span>Ԫ</span></div>
            </div>
            <div class="onlinePay_main1_allInfo">
                <p>������ţ�<b><?= $orderCode ?></b></p>
                <p>��Ʒ������<b><?= $db->to_gbk($lvGoodsName) ?></b></p>
                <p>�������ͣ�<b>��ʱ����</b></p>
                <p>��������<span><?= date("H:i:s", time() + ($payTime / 1000)) ?></span>֮ǰ��ɸ�����ڶ������Զ�ȡ��Ŷ��</p>
            </div>

            <div class="unfoldInfo subtriangle uptriangle">��������</div>
        </div>
        <div class="onlinePay_main2">
            <h3>���֧��</h3>

            <? if (notnull($zhifu)) {
                foreach ($zhifu as $key => $value) {
                    if ($value['bankcode'] == 'alipayweb') {
                        ?>
                        <div class="onlinePay_main2_left">
                            <input type="radio" name="topayinfoid" id="alipayweb" value="<?= $value['id'] ?>">
                            <label for=""></label>
                        </div>
                    <? } else if ($value['bankcode'] == 'wxqrcode') { ?>
                        <div class="onlinePay_main2_center">
                            <input type="radio" name="topayinfoid" id="wxqrcode" value="<?= $value['id'] ?>">
                            <label for=""></label>
                        </div>
                    <? } else if ($value['bankcode'] == 'unionall_web_wtz') { ?>
                        <div class="onlinePay_main2_right">
                            <input type="radio" name="topayinfoid" id="unionall" value="<?= $value['id'] ?>">
                            <label for=""></label>
                        </div>
                    <? }
                }
            } ?>
            <input type="hidden" name="orderno" value="<?= $datas['orderCode'] ?>">
            <input type="hidden" name="totalprice" value="<?= $datas['payPrice'] ?>">
            <input type="hidden" name="lvGoodsName" value="<?= $lvGoodsName ?>">
        </div>
        <div class="onlinePay_main3">
            <button class="onlinePay_cancle">ȡ������</button>
            <button class="onlinePay_payNow">��������</button>
        </div>
    </div>
</div>
<!-- main���� end -->
<div id="mengban" class="hide"></div>

<div class="nowPay">
    <p>��������ʱ�������֧�������򶩵����Զ�ȡ����</p>
    <div class="timeRun">�����ʱ<b class="hour"></b>ʱ<b class="min"></b>��<b class="sec"></b>��</div>

    <button class="onlineBtn3">֧�����</button>
    <button class="onlineBtn4">����ѡ��֧����ʽ</button>
</div>
<div id="weChatPay">
    <div class="weChatPay1">
        <h3>΢��֧��</h3>
        <button id="weChatPay_close"></button>
    </div>
    <div class="weChatPay2">
        <img src="" id="imgimg">
            <button id="weChatPay_sure">ȷ ��</button>
    </div>
</div>

<div id="weChatPay_loading">
    <div class="loading_box">
        <div class="loader"></div>
    </div>
    <p>֧��������,���Ժ󡤡���������</p>
</div>
<!-- ȡ���������� -->
<div class="cancelBox hide">


    <div class="cancelBox_cont">
        <div class="cancelBox_cont_tips">&nbsp;&nbsp;�Ƿ�ȡ������?</div>
        <a href="/menpiao/dingdan_detail-<?=$_SESSION['orderCode']?>.html?flag=qx"><button class="cancelBox_sure">ȷ��</button></a>
        <button class="cancelBox_cancel">ȡ��</button>
    </div>
</div>
<!-- ȡ�������ɹ���ʧ�ܵ��� -->
<? if($_GET['flag']=='qx'){ ?>
    <div class="cancelBox1">
        <div class="cancelBox1_title">
            <div class="cancelBox1_title_left"><?=$res['message']?></div>
            <a href="<?=$aurl?>"><span class="cancelBox1_title_right"></span></a>
        </div>
        <div class="cancelBox1_cont">
            <div class="cancelBox1_cont_tips">&nbsp;&nbsp;<?=$res['solution']?>�����ɹ���</div>
        </div>
    </div>
<?}?>

<!--  foot  start -->
<? include('foot.php'); ?>
<!--  foot  end -->
</body>
<script type="text/javascript" src="/themes/s01/js/jquery.js"></script>
<script type="text/javascript" src="/themes/s01/js/common.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        //��������
        var onlinePay_flag1 = 1;
        $('.unfoldInfo').click(function () {
            if (onlinePay_flag1) {
                $('.unfoldInfo').removeClass("uptriangle");
                $('.onlinePay_main1_allInfo').hide();
                onlinePay_flag1 = 0;
            } else {
                $('.unfoldInfo').addClass("uptriangle");
                $('.onlinePay_main1_allInfo').show();
                onlinePay_flag1 = 1;
            }

        });
        var timer;
        // ֧������
        $('.onlinePay_payNow').click(function () {
            clearInterval(timer);
            if ($("#alipayweb").attr("checked")) {
                var val = $("#alipayweb").val();
                $('.nowPay').show();
                $('#weChatPay').hide();
                var t = <?= $payTime/1000 ?>;//����ʱ��������
                timer = setInterval(function () {
                    showTime(t);
                    t--;
                    if (t == -1) {
                        clearInterval(timer);
                    }
                }, 1000)
                window.open("ticket_pay_jump-" + val + ".html");
            }
            if ($("#wxqrcode").attr("checked")) {
                var val = $("#wxqrcode").val();
                $.ajax({
                    type: 'post',
                    url: "/menpiao/ticket_pay_jump-"+ val +".html",
                    data: {"val" : val},
                    success: function (data)
                    {
                        var da = data.split('<!')[0];
                        $('#imgimg').attr("src",da);
                    }
                });
                $('#weChatPay').show();
            }
            if ($("#unionall").attr("checked")) {
                var val = $("#unionall").val();
                $('.nowPay').show();
                $('#weChatPay').hide();
                var t = <?= $payTime/1000 ?>;//����ʱ��������
                timer = setInterval(function () {
                    showTime(t);
                    t--;
                    if (t == -1) {
                        clearInterval(timer);
                    }
                }, 1000)
                window.open("ticket_pay_jump-" + val + ".html");
            }
        });
       /* //ȡ������
        $('.onlinePay_cancle').click(function () {
            window.location.href = "/menpiao/dingdan_detail-" + <?=$_SESSION['orderCode']?> +".html?flag=qx" ;
        });*/
        //΢��֧��
        $('#weChatPay_close').click(function () {
            $('#weChatPay').hide();
        });
        //֧�����
        $('.onlineBtn3').click(function () {
            window.location.href = ("/menpiao/dingdan_detail-" + <?=$_SESSION['orderCode']?> +".html");
        });
        //����ѡ��֧����ʽ
        $('.onlineBtn4').click(function () {
            clearInterval(timer);
            $('.nowPay').hide();
        });
        //΢��֧��ȷ����ť
        $('#weChatPay_sure').click(function () {
            clearInterval(timer);
            $('.nowPay').show();
            $('#weChatPay').hide();
            var t = <?= $payTime/1000 ?>;//����ʱ��������
            timer = setInterval(function () {
                showTime(t);
                t--;
                if (t == -1) {
                    clearInterval(timer);
                }
            }, 1000)
        });
    });

    //����ʱ����
    function showTime(times) {
        var h = parseInt(times / 60 / 60 % 60);
        var m = parseInt(times / 60 % 60);
        var s = parseInt(times % 60);
        var time = '';

        if (h == 0 && m == 0 && s == 0) {
            window.location.href = "/menpiao/dingdan_detail-" + <?=$_SESSION['orderCode']?> +".html";
        } else if (s < 10) {
            $('.hour').html(h);
            $('.min').html(m);
            $('.sec').html('0' + s);
        } else {
            $('.hour').html(h);
            $('.min').html(m);
            $('.sec').html(s);
        }
    }

    //ȡ������ȷ�ϵ���
    $('.onlinePay_cancle').click(function(){
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
</script>
</html>