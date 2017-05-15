<?
if(!defined('IN_CLOOTA')) {
    exit('Access Denied');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="/themes/s01/images/pay_success.css">
<link rel="shortcut icon" type="image/png" href="http://www.bus365.com/public/images/bus365.png">
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
                    <span>恭喜您，订单支付成功！我们将尽快给您发送确认短信。</span>
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
                        <?
                        $guess_list = get_guess_list(10);
                        //                var_dump($guess_list);
                        if (notnull($guess_list)) {
                        foreach ($guess_list as $val) {
                        if(notnull($val['goods_id'])) {
                        $goods_image = $val['goods_image'];
                        //                            $goodsImage = $g_domain . "upfiles/$g_siteid/" . $val['goods_image'];
                        if ($val['goods_type'] == '4') {
                            $href = "/menpiao/ticket_detail-" . $val['goods_id'] . "-" . $val['lv_scenic_id'] . ".html";
                        } else {
                            $href = "/product/detail-" . $val['goods_id'] . "-" . $val['lv_scenic_id'] . ".html";
                        }
                        ?>
                        <li><a href="">
                                <a href="<?= $href?>" target="_blank"><img src="<?= $val['goods_image']?>"></a>
                                <p><a href="<?= $href?>" target="_blank"><?= zwjiequ($val['goods_name'],30)?></a></p>
                                <p>
                                    <span class="cnxh_infoLeft">好评率：<b>100%</b></span>
                                    <span class="cnxh_infoRight"><b>&yen;<?= $val['min_price']?></b>起/人</span>
                                </p>
                            </a></li>
                            <?
                        }
                        }
                        }
                        ?>
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