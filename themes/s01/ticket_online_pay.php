<!DOCTYPE html>
<html lang="en">
<head>
    <? seo(); ?>
    <? include('meta.php'); ?>
    <? include "head.php" ?>
    <? include('static.php'); ?>
    <? load_mobile('http://' . $g_config['mobile_domain'] . '/menpiao/detail-' . $c_goods_id . '.html'); ?>
    <title>在线支付</title>
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/common.css">
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/menpiaozaixianzhifu.css">
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/menpiaodingdanxiangqing.css">
</head>
<body style="position: relative;">

<!-- main内容 start -->
<div id="onlinePay_mainBox">
    <div id="onlinePay_main">
        <div class="onlinePay_main_title">
            <img src="/themes/s01/images/fillInOrder_process2.jpg">
        </div>
        <div class="onlinePay_main1">
            <div class="onlinePay_main1_simInfo">
                <div class="onlinePay_main1_left"><?= $db->to_gbk($goodsName) ?></div>
                <div class="onlinePay_main1_right">应付金额 <b><?= $payPrice ?></b><span>元</span></div>
            </div>
            <div class="onlinePay_main1_allInfo">
                <p>订单编号：<b><?= $orderCode ?></b></p>
                <p>商品描述：<b><?= $db->to_gbk($lvGoodsName) ?></b></p>
                <p>交易类型：<b>即时到账</b></p>
                <p>建议您在<span><?= date("H:i:s", time() + ($payTime / 1000)) ?></span>之前完成付款，过期订单会自动取消哦。</p>
            </div>

            <div class="unfoldInfo subtriangle uptriangle">收起详情</div>
        </div>
        <div class="onlinePay_main2">
            <h3>快捷支付</h3>

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
            <button class="onlinePay_cancle">取消订单</button>
            <button class="onlinePay_payNow">立即付款</button>
        </div>
    </div>
</div>
<!-- main内容 end -->
<div id="mengban" class="hide"></div>

<div class="nowPay">
    <p>请在以下时间内完成支付，否则订单将自动取消。</p>
    <div class="timeRun">付款倒计时<b class="hour"></b>时<b class="min"></b>分<b class="sec"></b>秒</div>

    <button class="onlineBtn3">支付完成</button>
    <button class="onlineBtn4">重新选择支付方式</button>
</div>
<div id="weChatPay">
    <div class="weChatPay1">
        <h3>微信支付</h3>
        <button id="weChatPay_close"></button>
    </div>
    <div class="weChatPay2">
        <img src="" id="imgimg">
            <button id="weChatPay_sure">确 定</button>
    </div>
</div>

<div id="weChatPay_loading">
    <div class="loading_box">
        <div class="loader"></div>
    </div>
    <p>支付处理中,请稍后······</p>
</div>
<!-- 取消订单弹窗 -->
<div class="cancelBox hide">


    <div class="cancelBox_cont">
        <div class="cancelBox_cont_tips">&nbsp;&nbsp;是否取消订单?</div>
        <a href="/menpiao/dingdan_detail-<?=$_SESSION['orderCode']?>.html?flag=qx"><button class="cancelBox_sure">确认</button></a>
        <button class="cancelBox_cancel">取消</button>
    </div>
</div>
<!-- 取消订单成功或失败弹窗 -->
<? if($_GET['flag']=='qx'){ ?>
    <div class="cancelBox1">
        <div class="cancelBox1_title">
            <div class="cancelBox1_title_left"><?=$res['message']?></div>
            <a href="<?=$aurl?>"><span class="cancelBox1_title_right"></span></a>
        </div>
        <div class="cancelBox1_cont">
            <div class="cancelBox1_cont_tips">&nbsp;&nbsp;<?=$res['solution']?>操作成功！</div>
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
        //收起详情
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
        // 支付弹窗
        $('.onlinePay_payNow').click(function () {
            clearInterval(timer);
            if ($("#alipayweb").attr("checked")) {
                var val = $("#alipayweb").val();
                $('.nowPay').show();
                $('#weChatPay').hide();
                var t = <?= $payTime/1000 ?>;//倒计时的总秒数
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
                var t = <?= $payTime/1000 ?>;//倒计时的总秒数
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
       /* //取消订单
        $('.onlinePay_cancle').click(function () {
            window.location.href = "/menpiao/dingdan_detail-" + <?=$_SESSION['orderCode']?> +".html?flag=qx" ;
        });*/
        //微信支付
        $('#weChatPay_close').click(function () {
            $('#weChatPay').hide();
        });
        //支付完成
        $('.onlineBtn3').click(function () {
            window.location.href = ("/menpiao/dingdan_detail-" + <?=$_SESSION['orderCode']?> +".html");
        });
        //重新选择支付方式
        $('.onlineBtn4').click(function () {
            clearInterval(timer);
            $('.nowPay').hide();
        });
        //微信支付确定按钮
        $('#weChatPay_sure').click(function () {
            clearInterval(timer);
            $('.nowPay').show();
            $('#weChatPay').hide();
            var t = <?= $payTime/1000 ?>;//倒计时的总秒数
            timer = setInterval(function () {
                showTime(t);
                t--;
                if (t == -1) {
                    clearInterval(timer);
                }
            }, 1000)
        });
    });

    //倒计时函数
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

    //取消订单确认弹窗
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
    //取消订单成功或失败弹窗
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