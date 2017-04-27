<?
if(!defined('IN_CLOOTA')) {
    exit('Access Denied');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="/themes/s01/images/zhifu.css">
<title>����֧��</title>
</head>
<body>
<!--  head  start -->
<?include('static.php');?>
<?include('meta.php');?>
<?include 'head.php'?>
<!-- head  end -->

<!--<form method="post" action="zbypay_jump.html" >-->

    <!-- main���� start -->
    <div id="onlinePay_mainBox">
        <div id="onlinePay_main">
            <form method="post" action="" >
            <div class="onlinePay_main_title">
                <img src="/themes/s01/images/zby_zaixianzhifu.jpg">
            </div>
            <div class="onlinePay_main1">
                <div class="onlinePay_main1_simInfo">
                    <div class="onlinePay_main1_left"><?echo $goodsName?></div>
                    <div class="onlinePay_main1_right">Ӧ����� <b><?echo $payPrice?></b><span>Ԫ</span></div>
                </div>
                <div class="onlinePay_main1_allInfo">
                    <p>������ţ�<b><?echo $orderCode;?></b></p>
                    <p>�������ͣ�<b>����֧��</b></p>
                    <p>��������<span><?= date("H:i:s", time() + ($payTime / 1000)) ?></span>����ɸ�����ڶ������Զ�ȡ��Ŷ��</p>
                </div>

                <div class="unfoldInfo subtriangle uptriangle">��������</div>
            </div>
            <div class="onlinePay_main2">
                <h3>���֧��</h3>

                <?
                if (notnull($pay_way_data)){
                    foreach($pay_way_data as $key => $value){
                        if ($value['bankcode'] == 'alipayweb'){
                            ?>
                            <div class="onlinePay_main2_left">
                                <input type="radio" name="topayinfoid" id="alipayweb" value="<?echo $value['id'];?>">
                                <label for=""></label>
                            </div>
                        <? }else if($value['bankcode'] == 'wxqrcode') { ?>
                            <div class="onlinePay_main2_right">
                                <input type="radio" name="topayinfoid" id="wxqrcode" value="<? echo $value['id']; ?>">
                                <label for=""></label>
                            </div>
                        <? }else if($value['bankcode'] == 'unionall_web_wtz'){ ?>
                            <div class="onlinePay_main2_center">
                                <input type="radio" name="topayinfoid" id="unionall" value="<?echo $value['id'];?>">
                                <label for=""></label>
                            </div>
                            <?
                        }
                    }
                }

                ?>
                <input type="hidden" name="orderno" value="<?echo $orderCode;?>">
                <input type="hidden" name="totalprice" value="<?echo $payPrice;?>">
            </div>
            </form>
            <div class="onlinePay_main3">
                <button  class="onlinePay_cancle">ȡ������</button>
                <button  class="onlinePay_payNow">��������</button>
            </div>
        </div>
    </div>
    <!-- main���� end -->

<!-- </form>-->

<div class="nowPay">
    <p>��������ʱ�������֧�������򶩵����Զ�ȡ����</p>
    <div class="timeRun">�����ʱ<b class="min">15</b>��<b class="sec">00</b>��</div>

    <button class="onlineBtn3">֧�����</button>
    <button class="onlineBtn4">����ѡ��֧����ʽ</button>
</div>
<div id="weChatPay">
    <div class="weChatPay1">
        <h3>΢��֧��</h3>
        <button id="weChatPay_close"></button>
    </div>
    <div class="weChatPay2">
        <img id="imgimg" src="">
        <button id="weChatPay_sure">ȷ ��</button>
    </div>
</div>

<div id="weChatPay_loading">
    <div class="loading_box">
        <div class="loader"></div>
    </div>
    <p>֧��������,���Ժ󡤡���������</p>
</div>

<form action="" method="post" id="jumpForm" name="jumpForm">
    <input type="hidden" name="payPrice" id="payPrice" value="<?=$payPrice?>">
</form>

<!--  foot  start -->
<?include 'foot.php'?>
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
                var t = 900;//����ʱ��������
                timer = setInterval(function () {
                    showTime(t);
                    t--;
                    if (t == -1) {
                        clearInterval(timer);
                    }
                }, 1000)
                $("#jumpForm").attr("action", "zbypay_jump-" + val + "-" + <?=$orderCode;?> + ".html");
                $('#jumpForm').submit();
            }
            if ($("#wxqrcode").attr("checked")) {
                var val = $("#wxqrcode").val();
                $.ajax({
                    type: 'post',
                    url: "zbypay_jump-" + val + "-" + <?=$orderCode;?> + ".html",
                    data: {"val" : val},
                    success: function (data)
                    {
                        var data1 = data.split('<!')[0];
                        $('#imgimg').attr("src",data1);
                    }
                });
                $('#weChatPay').show();
            }
            if ($("#unionall").attr("checked")) {
                var val = $("#unionall").val();
                $('.nowPay').show();
                $('#weChatPay').hide();
                var t = 900;//����ʱ��������
                timer = setInterval(function () {
                    showTime(t);
                    t--;
                    if (t == -1) {
                        clearInterval(timer);
                    }
                }, 1000)
//                window.open("zbypay_jump-" + val + "-" + <?//=$orderCode;?>// + "-"+ <?//=$payPrice;?>// +".html");
                $("#jumpForm").attr("action", "zbypay_jump-" + val + "-" + <?=$orderCode;?> + ".html");
                $('#jumpForm').submit();
            }
        });
        //ȡ������
        $('.onlinePay_cancle').click(function () {
            window.location.href = "/zhoubianyou/zbyorder_detail-" + <?=$orderCode;?> +".html?flag=cn" ;
        });
        //΢��֧��
        $('#weChatPay_close').click(function () {
            $('#weChatPay').hide();
        });
        //֧�����
        $('.onlineBtn3').click(function () {
            window.location.href = ("/zhoubianyou/zbyorder_detail-" + <?=$orderCode;?> +".html");
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
            var t = 900;//����ʱ��������
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
        var m = parseInt(times / 60 % 60);
        var s = parseInt(times % 60);
        var time = '';

        if (m == 0 && s == 0) {
            window.location.href = '';
        } else if (s < 10) {
            $('.min').html(m);
            $('.sec').html('0' + s);
        } else {
            $('.min').html(m);
            $('.sec').html(s);
        }
    }

//    function select_pay(){
//        document.getElementById("select_pay").submit();
//    }

</script>
</html>