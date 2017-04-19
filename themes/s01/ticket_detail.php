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
    <title>��Ʊ����</title>
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
                <div class="spotAddress"><b>�����ַ��</b><a
                        title="<?= $db->to_gbk($obj['scenicInfo']['scenicDetailAddress']) ?>"><span
                            class="ditu"><?= $db->to_gbk(jiequ(25, $obj['scenicInfo']['scenicDetailAddress'])) ?></span></a><a
                        class="baiduMap">��ͼ</a></div>
                <div class="startTime"><b>����ʱ�䣺</b><? if ($obj['scenicOpenTimeList']['0']['timeInfo'] == '') { ?>�Ծ���Ϊ׼
                    <? } else { ?><a
                        title="<?= $db->to_gbk($obj['scenicOpenTimeList']['0']['timeInfo']) ?>"><?= $db->to_gbk(jiequ(25, $obj['scenicOpenTimeList']['0']['timeInfo'])) ?></a><? } ?>
                </div>
                <div class="serveensure">
                    <? if ($obj['scenicInfo']['lvServiceGuarantee']['0'] != '') { ?><b>�����ϣ�</b>
                        <span> <?= $db->to_gbk($obj['scenicInfo']['lvServiceGuarantee']['0']) ?> </span> <? } ?></div>
                <div class="manyi"><b>�ο�����ȣ�</b> <?
                    $randvalue = randomFloat(0.9,1) * 100;
                    $randvalue = sprintf("%0.2f", $randvalue).'%';
                    if($obj['favorableRate'] == '0.0%' || $obj['favorableRate'] == '0%') echo $randvalue;else echo $obj['favorableRate'];
                    ?> </div>
            </div>
        </div>
        <div class="spotListDetail_main2">
            <div class="spotListDetail_main2_top">
                <span>������Ʊ</span>
            </div>
            <div class="spotListDetail_main2_title">
                <ul>
                    <li class="ticketType"></li>
                    <li class="product">��Ʒ</li>
                    <li class="reserveTime">��ǰԤ��ʱ��</li>
                    <li class="menshiPrice">���м�</li>
                    <li class="ourPrice">BUS365�۸�</li>
                    <li class="payType">֧����ʽ</li>
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
                                        ��<?= $db->to_gbk($values['limitTime']) ?>��
                                        <span class="subtriangle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    </li>
                                    <li class="reserveTime"><?= $db->to_gbk($values['bookTime']) ?></li>
                                    <li class="menshiPrice"><? if ($values['marketPrice'] != '') { ?><?= $values['marketPrice'] ?><? } else { ?>��<? } ?></li>
                                    <li class="ourPrice">&yen; <?= $values['minPrice'] ?><span>��</span></li>
                                    <li class="payType">����֧��</li>
                                    <li class="reserve"><a
                                            href="<?= $g_self_domain ?>/menpiao/ticket_order-<?= urlencode($db->to_gbk($obj['scenicInfo']['goodsName'])) ?>-<?= urlencode($db->to_gbk($ticketTypeName)) ?>-<?= $values['isEmail'] ?>-<?= $ticketType ?>-<?= $obj['scenicInfo']['goodsId'] ?>-<?= $obj['scenicInfo']['lvProductId'] ?>-<?= $values['lvGoodsId'] ?>.html">Ԥ��</a>
                                    </li>
                                </ul>
                                <div class="spotTicket_infoHide">
                                    <dl>
                                        <dt>���ð���</dt>
                                        <dd><?= $db->to_gbk($values['costInclude']) ?></dd>
                                    </dl>
                                    <dl>
                                        <dt>Ԥ��ʱ��</dt>
                                        <dd><?= $db->to_gbk($values['advanceBookingTime']) ?></dd>
                                    </dl>
                                    <dl>
                                        <dt>��԰��֪</dt>
                                        <dd>1.��԰ʱ�䣺<?= $db->to_gbk($values['limitTime']) ?>
                                            ��Ԫ��������ҹ�����ţ�(�µ���3Сʱ�󷽿���԰)<br>2.��԰�ص㣺<?= $db->to_gbk($values['visitAddress']) ?>
                                            ����԰ʱ�����Я���µ�Ԥ��ʱ��д�����������֤
                                            ��<br>3.ȡƱʱ�䣺<?= $db->to_gbk($values['getTicketTime']) ?>
                                            ��Ԫ��������ҹ�����ţ�<br>4.ȡƱ�ص㣺<?= $db->to_gbk($values['getTicketPlace']) ?>
                                            <br>5.��԰��ʽ��<?= $db->to_gbk($values['ways']) ?><br>6.��Ч���ޣ�&nbsp;(��Ч���ڿ���԰1��)
                                            ָ�������յ�������Ч
                                            <input type="hidden" name="ways"
                                                   value="<?= $db->to_gbk($values['ways']) ?>">
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>��Ҫ��ʾ</dt>
                                        <dd><?= $db->to_gbk($values['importantNotice']) ?></dd>
                                    </dl>
                                    <dl>
                                        <dt>�˸�˵��</dt>
                                        <dd><?= $db->to_gbk($values['refundRuleNotice']) ?></dd>
                                    </dl>
                                    <span class="spotTicket_pickUp">����</span>
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
                    <li class="main3TabSelected">Ԥ����֪</li>
                    <li>�������</li>
                    <li>��ָͨ��</li>
                </ul>

                <button class="reserveNow">����Ԥ��</button>
            </div>
            <div class="spotListDetail_main3Cont">
                <div class="spotListDetail_main3Left">
                    <div class="spotListDetail_main3Left1">
                        <div class="ydxz_title"><i></i><b>Ԥ����֪</b></div>
                        <dl>
                            <dt>�������</dt>
                            <dd>
                                <ul>
                                    <?= $db->to_gbk($obj['scenicInfo']['freePolicy']) ?>
                                </ul>
                            </dd>
                        </dl>
                        <dl>
                            <dt>�Ż�����</dt>
                            <dd>
                                <ul>
                                    <?= $db->to_gbk($obj['scenicInfo']['explanation']) ?>
                                </ul>
                            </dd>
                        </dl>
                        <dl>
                            <dt>��Ҫ˵��</dt>
                            <dd>
                                <ul>
                                    <?= $db->to_gbk($list['importentPoint']) ?>
                                </ul>
                            </dd>
                        </dl>
                    </div>
                    <div class="spotListDetail_main3Left2">
                        <div class="jdjs_title"><i></i><b>�������</b></div>
                        <dl class="jdjs_dl1">
                            <dt>&nbsp;&nbsp;&nbsp;&nbsp;����Ҫ֪���ġ�<?= $db->to_gbk($obj['scenicInfo']['scenicName']) ?>��
                            </dt>
                            <dd>
                                <ul>
                                    <?= $db->to_gbk($obj['scenicInfo']['feature']) ?>
                                </ul>
                            </dd>
                        </dl>
                        <dl class="jdjs_dl1">
                            <dt>&nbsp;&nbsp;&nbsp;&nbsp;<?= $db->to_gbk($obj['scenicInfo']['scenicName']) ?>���</dt>
                            <dd>
                                <?= $db->to_gbk($obj['scenicInfo']['scenicInfo']) ?>
                            </dd>
                        </dl>
                        <? foreach ($jingdian as $key => $item) { ?>
                            <dl class="jdjs_dl2">
                                <dt>��&nbsp;&nbsp;<?= $db->to_gbk($item['scenicSpotName']) ?></dt>
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
                        <div class="jtzn_title"><i></i><b>��ָͨ��</b></div>

                        <div class="jtzn_map">
                            <div style="width:700px;height:390px;border:#ccc solid 1px;" id="dituContent"></div>
                        </div>
                        <!--                        <div class="jtzn_info">-->
                        <!--                            <div class="jtzn_infoLeft">-->
                        <!--                                <ul>-->
                        <!--                                    <li class="li_hover1">�����ͨ</li>-->
                        <!--                                    <li>������</li>-->
                        <!--                                    <li>�Լݳ�</li>-->
                        <!--                                </ul>-->
                        <!--                            </div>-->
                        <!--                            <div class="jtzn_infoRight">-->
                        <!--                                <div class="jt_info1">-->
                        <!--                                    <p>����7���ߣ��ڣ����ֹ�վ���³����³���B��C�ھ��ɳ�վ��</p>-->
                        <!--                                </div>-->
                        <!--                                <div class="jt_info2">-->
                        <!--                                    <p>1�����찲�ų�������������52·���ڣ������Ŷ�վ���³������˹���41·���ڣ���ٺ����&lt;�������ֹ�&gt;վ���³���<br>2�����찲�ų�������������674��680·�����յ�վ���������ȳ���վ���³����³����򱱲��������Ӽ������ֹȡ�<br>3����������740��840��29��743��753��683��801·���ڣ�������վ�������ϼ�԰վ���򣨱�����վ�������³����³�����Լ20���ӵִﻶ�ֹȡ�-->
                        <!--                                    </p>-->
                        <!--                                </div>-->
                        <!--                                <div class="jt_info3">-->
                        <!--                                    <p>�������ֹ�λ�ڱ������Ļ��ķ��Ŷ��Ͻǣ����찲��ֱ�߾���10.2���������������������(CBD)����10���ӣ�������������·��ڳ���5���ӡ�</p>-->
                        <!--                                </div>-->
                        <!--                                <p class="jt_info_tips">* ���Ͻ�ͨ��Ϣ��С¿�Ƽ��������ο������г��룬����ʵ�����Ϊ׼��</p>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                    </div>
                    <div class="spotListDetail_main3Left4">
                        <div class="orderSuccess_youLike">
                            <div class="youLike_title">Ϊ���Ƽ�<?= $db->to_gbk($obj['scenicInfo']['scenicName']) ?>�������� <a
                                    href="<?= $g_self_domain ?>/menpiao/">������Ʊ&gt;</a></div>

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
                                                    <span>��</span></div>
                                            </a>
                                        </li>
                                    <? } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="detail-main">
                    <!-- ����ϲ�� -->
                    <div class="detail-aside wrap">
                        <div class="aside-title">����ϲ��</div>
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
                                                class="cYellow">��/��</span>
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
//    window.onload = getMap($.trim($(".detailInfo_title").html()));//���ɵ�ͼ
    getMap($.trim($(".ditu").html()));//���ɵ�ͼ
    //            getMap('�ú�԰');//���ɵ�ͼ


    /* ���ݿ���վ��ַ�ڵ�ͼ��λ */
    function getMap(address) {
        if (!address || address == "���������Ϣ" || address == "") {
            return;
        }
        // �ٶȵ�ͼAPI����
        var map;
        if (typeof BMap !== "undefined" && typeof BMap.Map !== "undefined") {

            map = new BMap.Map("dituContent"); //������ͼ
            var point = new BMap.Point(116.331398, 39.897445);
            map.centerAndZoom(point, 12);
            map.addControl(new BMap.ScaleControl());         // ��ӱ����߿ؼ�
            map.addControl(new BMap.NavigationControl()); // ���ƽ�����ſؼ�
            map.addControl(new BMap.OverviewMapControl()); //������Ե�ͼ�ؼ�
            // ������ַ������ʵ��
            var myGeo = new BMap.Geocoder();
            // ����ַ���������ʾ�ڵ�ͼ��,��������ͼ��Ұ
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
