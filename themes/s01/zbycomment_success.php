<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="GBK">
    <title>评论成功</title>
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
        <div class="currentPos">当前位置：<a href="">中国公路客票网</a> &gt; <a href = "http://wwwd.bus365.cn/index/order/orders/">我的订单</a> &gt; 点评成功</div>

        <div class="myOrder_mainContent">
            <div class="myOrder_mainLeft">
                <div class="myOrder_mainLeftTitle">我的BUS365</div>
                <dl>
                    <dt style="background-position:20px 0;">订单中心</dt>
                    <a href="<?=$g_bus365_domain?>/index/order/orders/"><dd class="myOrder_hover1">我的订单 <span>&gt;</span></dd></a>
                </dl>
                <dl>
                    <dt style="background-position:20px -45px;">会员中心</dt>
                    <a href="<?=$g_bus365_domain?>/user/touserinfo/0"><dd>会员信息<span>&gt;</span></dd></a>
                    <a href="<?=$g_bus365_domain?>/user/touserprivate/0"><dd>会员安全<span>&gt;</span></dd></a>
                    <a href="<?=$g_bus365_domain?>/passenger/getPiList/0?page=1&size=5"><dd>常用乘车联系人管理<span>&gt;</span></dd></a>
                    <a href="<?=$g_bus365_domain?>/coupon0"><dd>我的优惠券<span>&gt;</span></dd></a>
                </dl>
            </div>

            <div class="orderDetail_noEvaluate_main">
                <div class="pjSuccess_logo">
                    <?echo $message;?>
                </div>
                <p class="pj_tips">我们会非常重视您的意见建议，及时改变我们的工作！</p>
            </div>
        </div>
    </div>
</div>


<!--  foot  start -->
<?include 'foot.php';?>
<!--  foot  end -->
</body>
</html>