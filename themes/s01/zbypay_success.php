<?
if(!defined('IN_CLOOTA')) {
    exit('Access Denied');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="/themes/s01/images/pay_success.css">
    <title>订单成功</title>
</head>
<body>
<!--  head  start -->
<?include('static.php');?>
<?include 'head.php';?>

<!-- head  end -->

<!--  nav导航  start -->

<!--  nav导航  end -->

<!-- 预定订单成功 start-->
<form name="order_form" method="post" action="/zhoubianyou/zbyorder_detail-<?=$pay_success_data['orderCode'];?>.html">
    <div id="zby_orderSuccess_mainBox">
        <div id="zby_orderSuccess_main">
            <div class="zby_orderSuccess_main_title">
                <img src="/themes/s01/images/zby_yudingSuccess.jpg">
            </div>

            <div class="zby_orderSuccess_main1">
                <div class="zby_orderSuccess_main1_cont">
                    <span>该订单正在审核中，请耐心等待。</span>
                    <p><b>订单确认号：</b><a><?echo $pay_success_data['orderCode'];?></a></p>
                    <p><b>产品名称：</b><?echo $pay_success_data['goodsName'];?></p>
                    <p><b>游玩日期：</b><?echo $pay_success_data['playDate'];?></p>
                    <input value="查看订单详情" type="submit" >
                    <!--                <a href="/member/?cmd=--><?//=base64_encode('pay_detail.php')?><!--"><button>查看订单详情</button></a>-->
                </div>
            </div>
            <div class="zby_orderSuccess_main2">
                <div class="zby_orderSuccess_main2_title">猜你喜欢</div>

                <div class="zby_orderSuccess_main2_cont">
                    <ul>
                        <li><a href="">
                                <img src="/themes/s01/images/zby_cnxh.jpg">
                                <p>丽江+大理+洱海双飞6日自由行</p>
                                <p>
                                    <span class="cnxh_infoLeft">好评率：<b>100%</b></span>
                                    <span class="cnxh_infoRight"><b>&yen;666</b>起/人</span>
                                </p>
                            </a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- 预定订单成功 end-->

<!--  foot  start -->
<?include 'foot.php';?>
<!--  foot  end -->
</body>
<script type="text/javascript">
    $(function() {

    }
</script>

</html>