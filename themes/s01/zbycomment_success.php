<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="GBK">
    <title>���۳ɹ�</title>
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/common.css">
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/zhoubianyoudianping.css">
    <link rel="shortcut icon" type="image/png" href="http://www.bus365.com/public/images/bus365.png">
</head>
<body>
<!--  head  start -->
<?include 'head.php';?>
<!-- head  end -->

<div id="myOrder_mainBox">
    <div id="myOrder_main">
        <div class="currentPos">��ǰλ�ã�<a href="">�й���·��Ʊ��</a> &gt; <a href = "http://wwwd.bus365.cn/index/order/orders/">�ҵĶ���</a> &gt; �����ɹ�</div>

        <div class="myOrder_mainContent">
            <div class="myOrder_mainLeft">
                <div class="myOrder_mainLeftTitle">�ҵ�BUS365</div>
                <dl>
                    <dt style="background-position:20px 0;">��������</dt>
                    <a href="<?=$g_bus365_domain?>/index/order/orders/"><dd class="myOrder_hover1">�ҵĶ��� <span>&gt;</span></dd></a>
                </dl>
                <dl>
                    <dt style="background-position:20px -45px;">��Ա����</dt>
                    <a href="<?=$g_bus365_domain?>/user/touserinfo/0"><dd>��Ա��Ϣ<span>&gt;</span></dd></a>
                    <a href="<?=$g_bus365_domain?>/user/touserprivate/0"><dd>��Ա��ȫ<span>&gt;</span></dd></a>
                    <a href="<?=$g_bus365_domain?>/passenger/getPiList/0?page=1&size=5"><dd>���ó˳���ϵ�˹���<span>&gt;</span></dd></a>
                    <a href="<?=$g_bus365_domain?>/coupon0"><dd>�ҵ��Ż�ȯ<span>&gt;</span></dd></a>
                </dl>
            </div>

            <div class="orderDetail_noEvaluate_main">
                <div class="pjSuccess_logo">
                    <?echo $message;?>
                </div>
                <p class="pj_tips">���ǻ�ǳ���������������飬��ʱ�ı����ǵĹ�����</p>
            </div>
        </div>
    </div>
</div>


<!--  foot  start -->
<?include 'foot.php';?>
<!--  foot  end -->
</body>
</html>