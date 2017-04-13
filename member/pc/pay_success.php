<?
if(!defined('IN_CLOOTA')) {
    exit('Access Denied');
}
?>

<link rel="stylesheet" type="text/css" href="/themes/s01/images/pay_success.css">

<!--  head  start -->
<?include 'head.php';?>

<!-- head  end -->

<!--  nav导航  start -->

<!--  nav导航  end -->

<!-- 预定订单成功 start-->
<?
$post['token'] = '{"clienttoken":"7A4D2543F258FD7062F842ADD950496ADEADB75BEE76FFBD2B153AD5F2BFEE823863DA9C55A8BF58DEB73C9CCABC30326EC113721043ABA98B3EE1771A41993AA089FAEC25AFEE98F057BAFED0D7B2F1","clienttype":"1","devicetoken":"1","ordertoken":"1","wxcityid":"1"}';
$post['orderCode'] = req('orderCode');
$pay_detail = post_curl($host."/travel/interface/zby/getZbyOrderDetail",$post);
$pay_detail = json_decode($pay_detail,true);
$pay_detail = array_iconv($pay_detail);
//var_dump($pay_detail);
//if ($pay_detail['status'] != '0000'){
//    exit('支付失败');
//}
$pay_data = $pay_detail['data'];
$playDate = $pay_data['playDate'];
$orderCode = $pay_data['orderCode'];
$goodsName = $pay_data['goodsName'];


?>
<!--<form method="post" action="do.php?ac=do_success" >-->
<form name="order_form" method="post" action="/member/?cmd=<?=base64_encode('pay_detail.php')?>&orderCode=<?=$orderCode;?>">
<!--    <input type="hidden" name="orderCode" value="--><?//echo $orderCode;?><!--">-->
<div id="zby_orderSuccess_mainBox">
    <div id="zby_orderSuccess_main">
        <div class="zby_orderSuccess_main_title">
            <img src="/themes/s01/images/zby_yudingSuccess.jpg">
        </div>

        <div class="zby_orderSuccess_main1">
            <div class="zby_orderSuccess_main1_cont">
                <span>恭喜您，订单预定成功！我们将尽快给您发送确认短信。</span>
                <p>入园方式：请您凭北京旅游网NEW发送的数字码短信，至景区售票处换区门票入园。</p>
                <p>订单确认号：<a><?echo $orderCode;?></a></p>
                <p>票型名称：<?echo $goodsName;?></p>
                <p>入园日期：<?echo $playDate;?></p>
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
                    <li><a href="">
                            <img src="/themes/s01/images/zby_cnxh.jpg">
                            <p>丽江+大理+洱海双飞6日自由行</p>
                            <p>
                                <span class="cnxh_infoLeft">好评率：<b>100%</b></span>
                                <span class="cnxh_infoRight"><b>&yen;666</b>起/人</span>
                            </p>
                        </a></li>
                    <li><a href="">
                            <img src="/themes/s01/images/zby_cnxh.jpg">
                            <p>丽江+大理+洱海双飞6日自由行</p>
                            <p>
                                <span class="cnxh_infoLeft">好评率：<b>100%</b></span>
                                <span class="cnxh_infoRight"><b>&yen;666</b>起/人</span>
                            </p>
                        </a></li>
                    <li><a href="">
                            <img src="/themes/s01/images/zby_cnxh.jpg">
                            <p>丽江+大理+洱海双飞6日自由行</p>
                            <p>
                                <span class="cnxh_infoLeft">好评率：<b>100%</b></span>
                                <span class="cnxh_infoRight"><b>&yen;666</b>起/人</span>
                            </p>
                        </a></li>
                    <li><a href="">
                            <img src="/themes/s01/images/zby_cnxh.jpg">
                            <p>丽江+大理+洱海双飞6日自由行</p>
                            <p>
                                <span class="cnxh_infoLeft">好评率：<b>100%</b></span>
                                <span class="cnxh_infoRight"><b>&yen;666</b>起/人</span>
                            </p>
                        </a></li>
                    <li><a href="">
                            <img src="/themes/s01/images/zby_cnxh.jpg">
                            <p>丽江+大理+洱海双飞6日自由行</p>
                            <p>
                                <span class="cnxh_infoLeft">好评率：<b>100%</b></span>
                                <span class="cnxh_infoRight"><b>&yen;666</b>起/人</span>
                            </p>
                        </a></li>
                    <li><a href="">
                            <img src="/themes/s01/images/zby_cnxh.jpg">
                            <p>丽江+大理+洱海双飞6日自由行</p>
                            <p>
                                <span class="cnxh_infoLeft">好评率：<b>100%</b></span>
                                <span class="cnxh_infoRight"><b>&yen;666</b>起/人</span>
                            </p>
                        </a></li>
                    <li><a href="">
                            <img src="/themes/s01/images/zby_cnxh.jpg">
                            <p>丽江+大理+洱海双飞6日自由行</p>
                            <p>
                                <span class="cnxh_infoLeft">好评率：<b>100%</b></span>
                                <span class="cnxh_infoRight"><b>&yen;666</b>起/人</span>
                            </p>
                        </a></li>
                    <li><a href="">
                            <img src="/themes/s01/images/zby_cnxh.jpg">
                            <p>丽江+大理+洱海双飞6日自由行</p>
                            <p>
                                <span class="cnxh_infoLeft">好评率：<b>100%</b></span>
                                <span class="cnxh_infoRight"><b>&yen;666</b>起/人</span>
                            </p>
                        </a></li>
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