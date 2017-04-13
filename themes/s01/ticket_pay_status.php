<!DOCTYPE html>
<html lang="en">
<head>
    <? seo(); ?>
    <? include('meta.php'); ?>
    <? include "head.php" ?>
    <? include('static.php'); ?>
    <? load_mobile('http://' . $g_config['mobile_domain'] . '/menpiao/detail-' . $c_goods_id . '.html'); ?>
    <title>订单成功</title>
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/common.css">
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/menpiaodingdanchenggong.css">
</head>
<!-- main内容 start -->
<div id="orderSuccess_mainBox">
    <div id="orderSuccess_main">
        <img src="/themes/s01/images/success_logo.jpg">
        <p class="orderSuccess_main_p1">恭喜您，订单成功！我们会尽快给您发送确认短信。</p>
        <p class="orderSuccess_main_p2">入园方式：<?= $db->to_gbk($ways) ?></p>
        <p class="orderSuccess_main_p3">
            订单号确认：<span style="color: #20cb9e;"><?= $orderno ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
            票型名称：<span style="color: #333;"><?= $db->to_gbk($lvGoodsName) ?></span>
        </p>
        <a href="<?=$g_self_domain?>/menpiao/dingdan_detail-<?= $orderno ?>.html">
            <button>查看订单详情</button>
        </a>
    </div>
    <div class="orderSuccess_youLike">
        <!-- 猜你喜欢 -->
        <div class="youLike_title">猜你喜欢</div>
        <div class="youLike_content">
            <ul>
                <?
                $guess_list = get_guess_list(10);
                if (notnull($guess_list)) {
                    foreach ($guess_list as $val) {
                        $goods_image = "/upfiles/$g_siteid/" . $val['goods_image'];

                        ?>
<!--                        <li><a id="pro-like-img" target="_blank"-->
<!--                               href="/menpiao/ticket_detail---><?//= $val['lv_product_id'] ?><!-----><?//= $val['lv_scenic_id'] ?><!--.html"><img-->
<!--                                    src="--><?//= $goods_image ?><!--" alt="--><?//= $val['goods_name'] ?><!--" class=""></a>-->
<!--                            <div class="youLike_contentName"><a id="pro-like-title" target="_blank"-->
<!--                                                                href="/menpiao/ticket_detail---><?//= $val['lv_product_id'] ?><!-----><?//= $val['lv_scenic_id'] ?><!--.html">--><?//= $val['goods_name'] ?><!--</a>-->
<!--                            </div>-->
<!--                            <div class="youLike_contentPrice"><sub>&yen;</sub> <span-->
<!--                                    class="">--><?//= $val['min_price'] ?><!--</span> 起/人-->
<!--                            </div>-->
<!--                        </li>-->
                        <li><a href="/menpiao/ticket_detail-<?= $val['lv_product_id'] ?>-<?= $val['lv_scenic_id'] ?>.html" target="_blank">
                                <img src="<?= $goods_image ?>" alt="<?= $val['goods_name'] ?>">
                                <div class="youLike_contentName"><?= $val['goods_name'] ?></div>
                                <div class="youLike_contentPrice">&yen;<?= $val['min_price'] ?> <span>起/人</span></div>
                            </a></li>
                        <?
                    }
                }
                ?>

            </ul>
        </div>
    </div>
</div>
<!-- main内容 end -->
<!--  foot  start -->
<? include 'foot.php' ?>
<!--  foot  end -->
</body>
<script type="text/javascript" src="/themes/s01/js/jquery.js"></script>
<script type="text/javascript" src="/themes/s01/js/common.js"></script>
</html>