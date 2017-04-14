<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="gbk">
    <title>评论详情</title>
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/common.css">
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/zhoubianyoudianping.css">
</head>
<body>
<!--  head  start -->
<?include 'head.php';?>
<!--  nav导航  end -->
<div id="myOrder_mainBox">
    <div id="myOrder_main">
        <div class="currentPos">当前位置：<a href="">中国公路客票网</a> &gt; <a href="<?=$g_bus365_domain?>/index/order/orders/">我的订单</a> &gt; 待点评</div>

        <div class="myOrder_mainContent">
            <div class="myOrder_mainLeft">
                <div class="myOrder_mainLeftTitle">我的BUS365</div>
                <dl>
                    <dt>订单中心</dt>
                    <a href="<?=$g_bus365_domain?>/index/order/orders/"><dd class="myOrder_hover1">我的订单 <span>&gt;</span></dd></a>
                </dl>
                <dl>
                    <dt>会员中心</dt>
                    <a href="<?=$g_bus365_domain?>/user/touserinfo/0"><dd>会员信息<span>&gt;</span></dd></a>
                    <a href="<?=$g_bus365_domain?>/user/touserprivate/0"><dd>会员安全<span>&gt;</span></dd></a>
                    <a href="<?=$g_bus365_domain?>/passenger/getPiList/0?page=1&size=5"><dd>常用乘车联系人管理<span>&gt;</span></dd></a>
                    <a href="<?=$g_bus365_domain?>/coupon0"><dd>我的优惠券<span>&gt;</span></dd></a>
                </dl>
            </div>

            <div class="orderDetail_noEvaluate_main">
                <div class="orderDetail_noEvaluate_main1">
                    <span>订单号：<?echo $orderCode;?></span>
                </div>
                <div class="orderDetail_noEvaluate_main2">
                    <ul>
                        <li>好评<span class="haoping"></span></li>
                        <li>中评<span class="zhongping"></span></li>
                        <li>差评<span class="chaping"></span></li>
                        <input type="hidden" id="commentLevel" value="<?echo $comment_detail_data[0]['commentLevel'];?>">
                    </ul>
                </div>
                <div class="dianpingneirong">
                    <?
                      foreach($comment_detail_data as $key => $value ){
                          echo $value['content']."<br>";
                      }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<!--  foot  start -->
<?include 'foot.php';?>
<!--  foot  end -->
</body>
<script type="text/javascript">
       var commentLevel = $("#commentLevel").val();
  window.onload=function(){
        //好评
        if (commentLevel == '1') {
            $('.haoping').css("backgroundPosition","0px 0px");
            $('.zhongping').css("backgroundPosition","-32px 0px");
            $('.chaping').css("backgroundPosition","-64px 0px");
        }
        //中评
        if (commentLevel == '2') {
            $('.haoping').css("backgroundPosition","0px 0px");
            $('.zhongping').css("backgroundPosition","-32px -32px");
            $('.chaping').css("backgroundPosition","-64px 0px");
        }
        //差评
        if (commentLevel == '3') {
            $('.haoping').css("backgroundPosition","0px 0px");
            $('.zhongping').css("backgroundPosition","-32px 0px");
            $('.chaping').css("backgroundPosition","-64px -32px");
        }
    }
</script>

</html>