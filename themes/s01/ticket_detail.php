<?
function randomFloat($min = 0, $max = 1) { return $min + mt_rand() / mt_getrandmax() * ($max - $min); }
?>
<!DOCTYPE html>
<html>
<head>
    <? seo(); ?>
    <? include('meta.php'); ?>
    <? include "head.php" ?>
    <? include('static.php'); ?>
    <? load_mobile('http://' . $g_config['mobile_domain'] . '/menpiao/detail-' . $c_goods_id . '.html'); ?>
    <title>门票详情</title>
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/detail.css">
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/common.css">
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/menpiaoxiangqing.css">
    <script type="text/javascript" src="/member/plugin?cmd=browse&goods_id=<?= $c_goods_id ?>"></script>
</head>
<body onselectstart="return false">
<!-- main start -->
<div id="spotListDetail_mainBox">
    <div id="spotListDetail_main">
        <div class="spotListDetail_main1">
            <div class="spotListDetail_main1_lunbo">
                <img src="<?= $obj['imageList']['0'] ?>" class="bigPic"
                     onerror="javascript:this.src='/themes/s01/images/lv_list_defaults.jpg'">
                <div class="smallPicBox">
                    <ul>
                        <? foreach ($obj['imageList'] as $value) { ?>
                            <li <? if ($key == "0") { ?>class="smallPic_hover"<? } ?>><img src="<?= $value ?>"></li>
                        <? } ?>
                    </ul>
                </div>
                <a class="spotAlbum"><span id="lunbo_pre"></span><span id="lunbo_next"></span></a>
            </div>
            <div class="spotListDetail_main1_info">
                <div class="detailInfo_title"><?= $db->to_gbk($obj['scenicInfo']['goodsName']) ?></div>
                <a title="<?= $db->to_gbk($obj['scenicInfo']['productIntroduce']) ?>">
                    <div
                        class="detailInfo_tips"><?= $db->to_gbk(jiequ(105, $obj['scenicInfo']['productIntroduce'])) ?></div>
                </a>
                <div class="spotAddress"><b>景点地址：</b><a
                        title="<?= $db->to_gbk($obj['scenicInfo']['scenicDetailAddress']) ?>"><span
                            class="ditu"><?= $db->to_gbk(jiequ(25, $obj['scenicInfo']['scenicDetailAddress'])) ?></span></a><a
                        class="baiduMap">地图</a></div>
                <div class="startTime"><b>开放时间：</b><? if ($obj['scenicOpenTimeList']['0']['timeInfo'] == '') { ?>以景点为准
                    <? } else { ?><a
                        title="<?= $db->to_gbk($obj['scenicOpenTimeList']['0']['timeInfo']) ?>"><?= $db->to_gbk(jiequ(25, $obj['scenicOpenTimeList']['0']['timeInfo'])) ?></a><? } ?>
                </div>
                <div class="serveensure">
                    <? if ($obj['scenicInfo']['lvServiceGuarantee']['0'] != '') { ?><b>服务保障：</b>
                        <span> <?= $db->to_gbk($obj['scenicInfo']['lvServiceGuarantee']['0']) ?> </span> <? } ?></div>
                <div class="manyi"><b>游客满意度：</b> <?
                    $randvalue = randomFloat(0.9,1) * 100;
                    $randvalue = sprintf("%0.2f", $randvalue).'%';
                    if($obj['favorableRate'] == '0.0%' || $obj['favorableRate'] == '0%') echo $randvalue;else echo $obj['favorableRate'];
                    ?> </div>
            </div>
        </div>
        <div class="spotListDetail_main2">
            <div class="spotListDetail_main2_top">
                <span>景点门票</span>
            </div>
            <div class="spotListDetail_main2_title">
                <ul>
                    <li class="ticketType"></li>
                    <li class="product">产品</li>
                    <li class="reserveTime">提前预定时间</li>
                    <li class="menshiPrice">门市价</li>
                    <li class="ourPrice">BUS365价格</li>
                    <li class="payType">支付方式</li>
                    <li class="reserve"></li>
                </ul>
            </div>
            <div class="spotListDetail_main2_table">
                <div class="spotListDetail_main2_table1">
                    <? foreach ($obj['ticketMapList'] as $key => $type) { ?>
                        <div class="ticketType"><?= $db->to_gbk($type['ticketTypeName']) ?></div>
                        <div class="spotListDetail_main2_table1Right">
                            <? foreach ($type['ticketList'] as $k => $values) { ?>
                                <ul>
                                    <li class="product">
                                        <span class="ticketType1"><?= $db->to_gbk($type['ticketTypeName']) ?></span>
                                        --<?= $db->to_gbk($values['lvGoodsName']) ?>
                                        （<?= $db->to_gbk($values['limitTime']) ?>）
                                        <span class="subtriangle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    </li>
                                    <li class="reserveTime"><?= $db->to_gbk($values['bookTime']) ?></li>
                                    <li class="menshiPrice"><? if ($values['marketPrice'] != '') { ?><?= $values['marketPrice'] ?><? } else { ?>无<? } ?></li>
                                    <li class="ourPrice">&yen; <?= $values['minPrice'] ?><span>起</span></li>
                                    <li class="payType">在线支付</li>
                                    <li class="reserve"><a
                                            href="<?= $g_self_domain ?>/menpiao/ticket_order-<?= urlencode($db->to_gbk($obj['scenicInfo']['goodsName'])) ?>-<?= urlencode($db->to_gbk($ticketTypeName)) ?>-<?= $values['isEmail'] ?>-<?= $ticketType ?>-<?= $obj['scenicInfo']['goodsId'] ?>-<?= $obj['scenicInfo']['lvProductId'] ?>-<?= $values['lvGoodsId'] ?>.html">预定</a>
                                    </li>
                                </ul>
                                <div class="spotTicket_infoHide">
                                    <dl>
                                        <dt>费用包含</dt>
                                        <dd><?= $db->to_gbk($values['costInclude']) ?></dd>
                                    </dl>
                                    <dl>
                                        <dt>预定时间</dt>
                                        <dd><?= $db->to_gbk($values['advanceBookingTime']) ?></dd>
                                    </dl>
                                    <dl>
                                        <dt>入园须知</dt>
                                        <dd>1.入园时间：<?= $db->to_gbk($values['limitTime']) ?>
                                            （元旦、春节夜场开放）(下单后3小时后方可入园)<br>2.入园地点：<?= $db->to_gbk($values['visitAddress']) ?>
                                            （入园时请务必携带下单预订时填写的游玩人身份证
                                            ）<br>3.取票时间：<?= $db->to_gbk($values['getTicketTime']) ?>
                                            （元旦、春节夜场开放）<br>4.取票地点：<?= $db->to_gbk($values['getTicketPlace']) ?>
                                            <br>5.入园方式：<?= $db->to_gbk($values['ways']) ?><br>6.有效期限：&nbsp;(有效期内可入园1次)
                                            指定游玩日当天内有效
                                            <input type="hidden" name="ways"
                                                   value="<?= $db->to_gbk($values['ways']) ?>">
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>重要提示</dt>
                                        <dd><?= $db->to_gbk($values['importantNotice']) ?></dd>
                                    </dl>
                                    <dl>
                                        <dt>退改说明</dt>
                                        <dd><?= $db->to_gbk($values['refundRuleNotice']) ?></dd>
                                    </dl>
                                    <span class="spotTicket_pickUp">收起</span>
                                </div>
                            <? } ?>
                        </div>
                    <? } ?>
                </div>
            </div>
        </div>
        <div class="spotListDetail_main3">
            <div class="spotListDetail_main3Tab">
                <ul>
                    <li class="main3TabSelected">预订须知</li>
                    <li>景点介绍</li>
                    <li>交通指南</li>
                </ul>

                <button class="reserveNow">立即预定</button>
            </div>
            <div class="spotListDetail_main3Cont">
                <div class="spotListDetail_main3Left">
                    <div class="spotListDetail_main3Left1">
                        <div class="ydxz_title"><i></i><b>预订须知</b></div>
                        <dl>
                            <dt>免费政策</dt>
                            <dd>
                                <ul>
                                    <?= $db->to_gbk($obj['scenicInfo']['freePolicy']) ?>
                                </ul>
                            </dd>
                        </dl>
                        <dl>
                            <dt>优惠政策</dt>
                            <dd>
                                <ul>
                                    <?= $db->to_gbk($obj['scenicInfo']['explanation']) ?>
                                </ul>
                            </dd>
                        </dl>
                        <dl>
                            <dt>重要说明</dt>
                            <dd>
                                <ul>
                                    <?= $db->to_gbk($list['importentPoint']) ?>
                                </ul>
                            </dd>
                        </dl>
                    </div>
                    <div class="spotListDetail_main3Left2">
                        <div class="jdjs_title"><i></i><b>景点介绍</b></div>
                        <dl class="jdjs_dl1">
                            <dt>&nbsp;&nbsp;&nbsp;&nbsp;您需要知道的“<?= $db->to_gbk($obj['scenicInfo']['scenicName']) ?>”
                            </dt>
                            <dd>
                                <ul>
                                    <?= $db->to_gbk($obj['scenicInfo']['feature']) ?>
                                </ul>
                            </dd>
                        </dl>
                        <dl class="jdjs_dl1">
                            <dt>&nbsp;&nbsp;&nbsp;&nbsp;<?= $db->to_gbk($obj['scenicInfo']['scenicName']) ?>简介</dt>
                            <dd>
                                <?= $db->to_gbk($obj['scenicInfo']['scenicInfo']) ?>
                            </dd>
                        </dl>
                        <? foreach ($jingdian as $key => $item) { ?>
                            <dl class="jdjs_dl2">
                                <dt>●&nbsp;&nbsp;<?= $db->to_gbk($item['scenicSpotName']) ?></dt>
                                <dd>
                                    <?= $db->to_gbk($item['scenicSpotInfo']) ?>
                                </dd>
                                <?foreach ($item['imgUrl'] as $k => $val){?>
                                    <image src="<?= $db->to_gbk($val) ?>" style="width: 720px;height: 480px;"></image>
                                <?}?>
                            </dl>
                        <? } ?>
                    </div>
                    <div class="spotListDetail_main3Left3">
                        <div class="jtzn_title"><i></i><b>交通指南</b></div>

                        <div class="jtzn_map">
                            <div style="width:700px;height:390px;border:#ccc solid 1px;" id="dituContent"></div>
                        </div>
                        <!--                        <div class="jtzn_info">-->
                        <!--                            <div class="jtzn_infoLeft">-->
                        <!--                                <ul>-->
                        <!--                                    <li class="li_hover1">轨道交通</li>-->
                        <!--                                    <li>公交车</li>-->
                        <!--                                    <li>自驾车</li>-->
                        <!--                                </ul>-->
                        <!--                            </div>-->
                        <!--                            <div class="jtzn_infoRight">-->
                        <!--                                <div class="jt_info1">-->
                        <!--                                    <p>乘坐7号线，在（欢乐谷站）下车，下车后B、C口均可出站。</p>-->
                        <!--                                </div>-->
                        <!--                                <div class="jt_info2">-->
                        <!--                                    <p>1、从天安门出发，乘坐公交52路，在（劲松桥东站）下车，换乘公交41路，在（厚俸桥南&lt;北京欢乐谷&gt;站）下车。<br>2、从天安门出发，乘坐公交674、680路，在终点站（北京华侨城南站）下车，下车后向北步行数分钟即到欢乐谷。<br>3、乘坐公交740、840、29、743、753、683、801路，在（弘燕桥站）或（紫南家园站）或（北工大东站）均可下车，下车后步行约20分钟抵达欢乐谷。-->
                        <!--                                    </p>-->
                        <!--                                </div>-->
                        <!--                                <div class="jt_info3">-->
                        <!--                                    <p>北京欢乐谷位于北京东四环四方桥东南角，距天安门直线距离10.2公里，至北京市中心商务区(CBD)车行10分钟，至京津塘高速路入口车行5分钟。</p>-->
                        <!--                                </div>-->
                        <!--                                <p class="jt_info_tips">* 以上交通信息是小驴推荐，仅供参考。如有出入，请以实际情况为准。</p>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                    </div>
                    <div class="spotListDetail_main3Left4">
                        <div class="orderSuccess_youLike">
                            <div class="youLike_title">为您推荐<?= $db->to_gbk($obj['scenicInfo']['scenicName']) ?>人气景点 <a
                                    href="<?= $g_self_domain ?>/menpiao/">更多门票&gt;</a></div>

                            <div class="youLike_content">
                                <ul>
                                    <? foreach ($recommends as $key => $val) { ?>
                                        <li>
                                            <a href="/menpiao/ticket_detail-<?= $val['lvProductId'] ?>-<?= $val['scenicId'] ?>.html">
                                                <img src="<?= $val['imgUrl'] ?>">
                                                <div
                                                    class="youLike_contentName"><?= $db->to_gbk(mb_substr($val['goodsName'], 0, 40)) ?></div>
                                                <div
                                                    class="youLike_contentPrice">&yen;<?= $val['minPrice'] ?>
                                                    <span>起</span></div>
                                            </a>
                                        </li>
                                    <? } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="detail-main">
                    <!-- 猜你喜欢 -->
                    <div class="detail-aside wrap">
                        <div class="aside-title">猜你喜欢</div>
                        <ul class="detail-asidelike">
                            <?
                            $guess_list = get_guess_list(6);
                            if (notnull($guess_list)) {
                                foreach ($guess_list as $val) {
                                    //                var_dump($val['goods_type']);
                                    if ($val['goods_type'] == '4') {
                                        $href = "/menpiao/ticket_detail-" . $val['goods_id'] . "-" . $val['lv_scenic_id'] . ".html";
                                        $goods_image = $val['goods_image'];
                                    } else {
                                        $href = "/product/detail-" . $val['goods_id'] . ".html";
                                        $goods_image = "/upfiles/$g_siteid/" . $val['goods_image'];

                                    }

                                    ?>
                                    <li>
                                        <div class="imgbox"><a id="like-img" target="_blank"
                                                               href="<? echo $href; ?>"><img
                                                    src="<?= $goods_image ?>" alt="<?= $val['goods_name'] ?>"></a>
                                        </div>
                                        <div class="tname"><a id="like-title" target="_blank"
                                                              href="<? echo $href; ?>"><?= $val['goods_name'] ?></a>
                                        </div>
                                        <div class="cYellow">&yen; <span
                                                class="font20"><?= $val['min_price'] ?></span> <span
                                                class="cYellow">起/人</span>
                                        </div>
                                    </li>
                                    <?
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- main end -->
<!--  foot  start -->
<? include 'foot.php' ?>
<!--  foot  end -->
</body>
<script type="text/javascript" src="/themes/s01/js/jquery.js"></script>
<script type="text/javascript" src="/themes/s01/js/common.js"></script>
<script type="text/javascript" src="/themes/s01/js/jssor.slider-22.0.15.min.js"></script>
<!--<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>-->
<script type="text/javascript" src="/themes/s01/js/menpiaoxiangqing.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
<script type="text/javascript">
    //    $(document).ready(){
    //        alert($(".detailInfo_title").html());
//    window.onload = getMap($.trim($(".detailInfo_title").html()));//生成地图
    getMap($.trim($(".ditu").html()));//生成地图
    //            getMap('颐和园');//生成地图


    /* 根据客运站地址在地图定位 */
    function getMap(address) {
        if (!address || address == "暂无相关信息" || address == "") {
            return;
        }
        // 百度地图API功能
        var map;
        if (typeof BMap !== "undefined" && typeof BMap.Map !== "undefined") {

            map = new BMap.Map("dituContent"); //创建地图
            var point = new BMap.Point(116.331398, 39.897445);
            map.centerAndZoom(point, 12);
            map.addControl(new BMap.ScaleControl());         // 添加比例尺控件
            map.addControl(new BMap.NavigationControl()); // 添加平移缩放控件
            map.addControl(new BMap.OverviewMapControl()); //添加缩略地图控件
            // 创建地址解析器实例
            var myGeo = new BMap.Geocoder();
            // 将地址解析结果显示在地图上,并调整地图视野
            myGeo.getPoint(address, function (point) {
                if (point) {
                    map.centerAndZoom(point, 16);
                    map.addOverlay(new BMap.Marker(point));
                }
            }, "");
        }
        //$.ui.loadContent("station_map", false, false, false);
    }
</script>
<?
$isMap = req('isMap');
if ($isMap == '1' && !empty($jingdian)) {
    ?>
    <script>
        window.onload=function(){
            $(document).scrollTop($('.spotListDetail_main3Left3').offset().top-42);
        }
    </script>

<?
}
?>

</html>
