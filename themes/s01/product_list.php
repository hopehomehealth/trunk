<!DOCTYPE html>
<html>
<head>
    <title>�ܱ��Ρ�Bus365�ܱ��Ρ�</title>
    <? include('meta.php'); ?>
    <? seo(); ?>
    <? load_mobile('http://' . $g_config['mobile_domain'] . '/' . $c_catalog_key . '/'); ?>

    <? include('static.php'); ?>
    <script type="text/javascript" src="/themes/s01/js/jquery.js "></script>
    <script type="text/javascript" src="/themes/s01/js/common.js"></script>
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/common.css">
    <link rel="stylesheet" type="text/css" href="/themes/s01/imagesst.css">
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/list.css">

    <style type="text/css">
        #partner_box {
            width: 100%;
            height: 200px;
            background-color: white;
        }

        #partner {
            width: 1190px;
            height: 200px;
            margin: 0 auto;
            padding: 15px 0;
        }

        .partner_top {
            width: 1190px;
            line-height: 37px;
            height: 37px;
        }

        .partner_title {
            float: left;
            color: #1fcc9e;
            font-size: 24px;
            width: 120px;
            padding-left: 40px;
            background: url("/themes/s01/images/partner_logo.jpg") no-repeat left center;
        }

        .partner_border {
            float: left;
            width: 1030px;
            height: 1px;
            background-color: #dedede;
            margin-top: 18px;
        }

        /*//��ҳ*/
        .spotList_main2_title {
            width: 900px;
            height: 36px;
        }

        .spotList_main2_title_right {
            float: right;
            width: 160px;
            height: 35px;
            line-height: 35px;
            font-size: 14px;
        }

        .spotList_main2_title_right .yema {
            float: left;
            margin-right: 20px;
        }

        .spotList_main2_title_right .yema b {
            font-style: normal;
            color: #fd803e;
        }

        .spotList_main2_title_right span {
            float: left;
            width: 19px;
            height: 19px;
            border: solid 1px #eaeaea;
            margin-top: 6px;
            margin-right: 5px;
            background-color: white;
        }

        .leftBtn_hover {
            background: url("/themes/s01/images/lefttriangle1.png") no-repeat center center;
        }

        .rightBtn_hover {
            background: url("/themes/s01/images/righttriangle1.png") no-repeat center center;
        }

        .leftBtn {
            background: url("/themes/s01/images/lefttriangle2.png") no-repeat center center;
        }

        .rightBtn {
            background: url("/themes/s01/images/righttriangle2.png") no-repeat center center;
        }
    </style>


</head>

<body class="bodybox" onselectstart="return false">
<? include('head.php'); ?>
<!-- �������� start -->
<div id="searchMainBox">
    <div id="searchMain" style="position: relative;">
        <div class="searchMain1">
            <div class="searchMain1_l">
                <span>�ܱ���</span>
                <ul style="">
                    <li style="background-color:#1fcc9e;color:white;">�ܱ���</li>
                    <li>������Ʊ</li>
                </ul>
            </div>
            <div class="searchMain1_c">
                <? if (!empty($Word)) { ?>
                    <input type="text" name="������Ŀ�ĵ�/��Ʒ����" value="<?= $keyWord ?>">
                <? } else { ?>
                    <input type="text" name="������Ŀ�ĵ�/��Ʒ����" placeholder="������Ŀ�ĵ�/��Ʒ����">
                <? } ?>
            </div>
            <div class="searchMain1_r"></div>
        </div>
        <div id="search_auto"></div>
    </div>
</div>
<!-- �������� end -->
<script type="text/javascript">
    var currentLis = 0;
    $('.searchMain1_c input').on('keyup', function (event) {
        var e = event || window.event;
        if (e.keyCode == 38 || e.keyCode == 40 || e.keyCode == 13) {

        } else {
            currentLis = 0;
            if ($(".searchMain1_l span").html() == '������Ʊ') {
                $.post('<?=$g_self_domain?>/search/', {'value': $(this).val()}, function (data) {
                    // if(data=='0') $('#search_auto').html('').css('display','none');
                    // else $('#search_auto').html(data).css('display','block');
                    if (data == '0') {
                        $('#search_auto').html('').css('display', 'none');
                    } else {
                        $('#search_auto').html(data).css('display', 'block');
                        $('#search_auto ul li').click(function () {
                            $('.searchMain1_c input').val($(this).html());
                            $('.search_form').remove();
                            $('body').append('<form  action="<?=$g_self_domain?>/menpiao/" method="" class="search_form"><input type="hidden" name="keyWord" class="search_cont1" value="' + $(".searchMain1_l span").html() + '"><input type="hidden" name="keyWord" class="search_cont2" value="' + $('.searchMain1_c input').val() + '"></form>');
                            //$('.search_form').attr('action','');
                            $('.search_form').submit();
                            $('#search_auto').html('').css('display', 'none');
                        });
                    }
                });
            } else if ($(".searchMain1_l span").html() == '�ܱ���') {
                $.post('<?=$g_self_domain?>/searcha/', {'value': $(this).val()}, function (data) {
                    // if(data=='0') $('#search_auto').html('').css('display','none');
                    // else $('#search_auto').html(data).css('display','block');
                    if (data == '0') {
                        $('#search_auto').html('').css('display', 'none');
                    } else {
                        $('#search_auto').html(data).css('display', 'block');
                        $('#search_auto ul li').click(function () {
                            $('.searchMain1_c input').val($(this).html());
                            $('.search_form').remove();
                            $('body').append('<form  action="<?=$g_self_domain?>/zhoubian/  " method="" class="search_form"><input type="hidden" name="keyWord" class="search_cont1" value="' + $(".searchMain1_l span").html() + '"><input type="hidden" name="keyWord" class="search_cont2" value="' + $('.searchMain1_c input').val() + '"></form>');
                            //$('.search_form').attr('action','http://traveld.bus365.cn/zhoubian/');
                            $('.search_form').submit();
                            $('#search_auto').html('').css('display', 'none');
                        });
                    }
                });
            }
        }

    });

    $('.searchMain1_c input').on('keydown', function (event) {
        //event.preventDefault();
        var e = event || window.event;
        var lis = $('#search_auto ul li').length;
        //alert(lis);
        if (e.keyCode == 38) {//up
            if (lis > 1 || lis == 1 && currentLis > 1) {
                currentLis--;
                //$('#search_auto ul li').eq(currentLis-1).addClass('searchLi_hover').siblings('li').removeClass('searchLi_hover');
                $('.searchMain1_c input').val($('#search_auto ul li').eq(currentLis - 1).html());
            } else if (currentLis == 1) {
                return;
            }
        }
        else if (e.keyCode == 40) {//down
            if (lis > 1 || lis == 1 && currentLis < lis) {
                currentLis++;
                //$('#search_auto ul li').eq(currentLis-1).addClass('searchLi_hover').siblings('li').removeClass('searchLi_hover');
                $('.searchMain1_c input').val($('#search_auto ul li').eq(currentLis - 1).html());
            }
        }
        else if (e.keyCode == 13) {//enter
            if ($(".searchMain1_l span").html() != '' && $('.searchMain1_c input').val() != '') {
                //alert(2);
                if ($(".searchMain1_l span").html() == '������Ʊ') {
                    $('.search_form').remove();
                    $('body').append('<form  action="<?=$g_self_domain?>/menpiao/" method="" class="search_form"><input type="hidden" name="keyWord" class="search_cont1" value="' + $(".searchMain1_l span").html() + '"><input type="hidden" name="keyWord" class="search_cont2" value="' + $('.searchMain1_c input').val() + '"></form>');
                    //$('.search_form').attr('action','');
                    $('.search_form').submit();
                } else if ($(".searchMain1_l span").html() == '�ܱ���') {
                    $('.search_form').remove();
                    $('body').append('<form  action="<?=$g_self_domain?>/zhoubian/  " method="" class="search_form"><input type="hidden" name="keyWord" class="search_cont1" value="' + $(".searchMain1_l span").html() + '"><input type="hidden" name="keyWord" class="search_cont2" value="' + $('.searchMain1_c input').val() + '"></form>');
                    //$('.search_form').attr('action','http://traveld.bus365.cn/zhoubian/');
                    $('.search_form').submit();
                }

            }
            ;
        }
        $('#search_auto ul li').eq(currentLis - 1).addClass('searchLi_hover').siblings('li').removeClass('searchLi_hover');
    });


    $('.searchMain1_c input').blur(function () {
        //if($('#search_auto').html()==''){
        setTimeout(function () {
            //$('.searchMain1_c input').val($('#search_auto ul li').eq(0).html());
            $('#search_auto').html('').css('display', 'none');
        }, 200)
        //}
    });
</script>


<div class="container">
    <!--����Ŀ�ĵ�-->
    <!-- <ul class="breadcrumbs">
	  <li class="item"><a href="<?= $g_domain ?>">��ҳ</a> </li>
	  <?
    if ($c_goods_type == '1') {
        ?>
	  <li class="item"><span>&gt</span><a href="/gentuan/all/">������</a></li>
	  <? } ?>
	  <?
    if ($c_goods_type == '2') {
        ?>
	  <li class="item"><span>&gt</span><a href="/ziyouxing/all/">������</a></li>
	  <? } ?>
	  <?
    if ($c_goods_type == '3') {
        ?>
	  <li class="item"><span>&gt</span><a href="/qianzheng/">ǩ֤</a></li>
	  <? } ?>
	  <?
    if ($c_goods_type == '6') {
        ?>
	  <li class="item"><span>&gt</span><a href="/youlun/">����</a></li>
	  <? } ?>
	  <?
    if ($c_goods_type == '1' || $c_goods_type == '2') {
        if (notnull($c_breadcrumb)) {
            $n = 0;
            foreach ($c_breadcrumb as &$v) {
                if (notnull($v)) {
                    ?>
		  <li class="item"><span>&gt;</span><a href="<?= $g_domain ?><?= $g_product_type_url[$c_goods_type] ?>/<?= $v['cat_key'] ?>/" class="check_more">
		  <?= $v['cat_name'] ?>
		  </a></li>
	  <? $n++;
                }
            }
        }
    }
    ?>
	  <? if ($n == 0) { ?>
		  <? if (req('action') == 'subject') { ?>
		  <li class="item current"><span>&gt;</span><?= $this_page_title ?></li>
		  <? } else { ?>
		  <li class="item current"><span>&gt;</span>ȫ����Ʒ</li>
		  <? } ?>
	  <? } ?>
<!--	</ul> -->
    <div class="allProduct_title"
         style="width: 1160px;padding-left: 30px;font-size: 21px;color: #666;padding-bottom: 20px;background:url(/themes/s01/images/all_product_title.jpg) no-repeat left 2px;"><? if (!empty($keyWord) || $orderby == 'true') echo 'ȫ����Ʒ'; else echo '�Ƽ���Ʒ'; ?></div>
    <? if (!empty($keyWord) || $orderby == 'true') {
        echo '';
    } else {
        $ad_list = get_ad(req('goods_zone'), '0', 8);
        if (notnull($ad_list)) {
            ?>
            <ul class="tour-mainlist">
                <?
                $n = 1;
                foreach ($ad_list as $val) {
                    ?>
                    <li <? if ($n % 2 == 0 && $n <= 4){
                        ?>class="half"<?
                    } ?> <? if ($n % 2 != 0 && $n >= 4){
                        ?>class="half"<?
                    } ?>>
                        <a target="_blank" href="<?= $val['ad_url'] ?>">
                            <img src="/upfiles/<?= $g_siteid . '/' . $val['ad_image'] ?>">
                            <span class="li-txt">
					<em><?= $val['ad_title'] ?></em>
				</span>
                        </a>
                    </li>
                    <?
                    $n++;
                }
                ?>
            </ul>
        <? }
    } ?>


    <? if ($c_catalog['cat_name'] != '') { ?>
        <div class="mg-citypath">
            <div class="fl"><a href="<?= $g_full_url ?>"><?= $c_catalog['cat_name'] ?><span>&nbsp;&nbsp;</span> </a>
            </div>

            <!--
            <div class="more-city">
                <span class="change-city">����<i class="icon arr-down-gray">&nbsp;</i></span>
                <dl class="city-open">
                    <dt>����</dt>
                    <dd> <a href='javascript:void(0);' title='����'
                               class='selected'>����</a> <a href='javascript:void(0);' title='����'
                               class=''>����</a> <a href='javascript:void(0);' title='��'
                               class=''>��</a> <a href='javascript:void(0);' title='����'
                               class=''>����</a> </dd>
                    <dt>����</dt>
                    <dd><a title="����" href="javascript:void(0);">����</a><a  title="����" href="javascript:void(0);">����</a><a  title="�������" href="javascript:void(0);">�������</a><a  title="�����" href="javascript:void(0);">�����</a></dd>
                    <dt>����</dt>
                    <dd><a title="����" href="javascript:void(0);">����</a><a  title="����" href="javascript:void(0);">����</a><a  title="������" href="javascript:void(0);">������</a></dd>
                </dl>
            </div>
            -->
        </div>
    <? } ?>


    <!-- ���� -->
    <div class="main fl" style="position: relative">


        <!--��ҳ-->

        <? if (!empty($keyWord) || $orderby == 'true') { ?>
            <div class="spotList_main2_title" style="width:auto;position: absolute;right: 0;top: 0;z-index: 99;">
                <div class="spotList_main2_title_right" style="width: auto;min-width: 140px;">
                    <div class="yema">ҳ�룺<b><? echo $pageNo; ?></b>/<?= $totalPage ?></div>
                    <a href="<?= $nowUrl ?>&pageNo=<?= $prePage; ?>"><? if ($pageNo > 1){ ?><span
                            class="leftBtn_hover"><? }else{ ?><span class="leftBtn"><? } ?></span></a>
                    <a href="<?= $nowUrl ?>&pageNo=<?= $nextPage ?>"><? if ($pageNo == $totalPage){ ?><span
                            class="rightBtn_hover"><? }else{ ?><span class="rightBtn"><? } ?></span></a>
                </div>
            </div>
        <? } ?>

        <? if (in_array($c_goods_type, array(1, 2, 4, 5)) && 1 == 2) { ?>
            <ul class="filter-nav">
                <?
                foreach ($g_product_type as $k => $v) {
                    if (in_array($k, array(1, 2, 4, 5))) {
                        ?>
                        <li><a href="javascript:filter('type', '<?= $k ?>')" data-id="recommend"
                               <? if ($c_goods_type == $k){
                               ?>class="selected"<?
                            } ?>><?= $v ?></a></li>
                        <?
                    }
                }
                ?>
            </ul>
        <? } ?>

        <?
        // if($c_goods_type=='3'){
        // 	include('block_filter_visa.php');
        // }
        // elseif($c_goods_type=='6'){
        // 	include('block_filter_ship.php');
        // } else {
        // 	include('block_filter_line.php');
        // }
        ?>


        <? if (!empty($keyWord) || $orderby == 'true') {
            $order_type = req('sc');
            if ($order_type == '' || $order_type == 'asc') $order_type = 'desc';
            else $order_type = 'asc';
            ?>
            <div class="mg-sort">
                <div class="jingdian_title"
                     style="float: left;padding-left: 37px;background:url(/themes/s01/images/jingdian_title.jpg) no-repeat left center;padding-right: 15px;">
                    ����
                </div>
                <ul class="sort-group fl mr10">
                    <li><a id="list-f-312-1" <? if (req('hot') == 'yes'){ ?>class="select"<? } ?>
                           href="javascript:filter('hot', '<? if (req('hot') == 'yes') { ?><? } else { ?>yes<? } ?>')">�Ƽ�</a>
                    </li>
<!--                    <li><a id="list-f-312-2" --><?// if (req('col') == 'sale'){ ?><!--class="select"--><?// } ?><!-- title="����������Ӹߵ�������"-->
<!--                           href="/zhoubian/?--><?//= $page_args ?><!--&ord=true&col=sale&sc=--><?//= $order_type ?><!--">����<i-->
<!--                                class="icon --><?// if (req('sc') == 'desc') { ?><!--sort-up--><?// } else { ?><!--sort-down--><?// } ?><!--">-->
<!--                                &nbsp;</i></a></li>-->
                    <li><a id="list-f-312-4" <? if (req('col') == 'price'){ ?>class="select"<? } ?> title="������۸�ӵ͵�������"
                           href="/zhoubian/?<?= $page_args ?>&ord=true&col=price&sc=<?= $order_type ?>">�۸�<i
                                class="icon <? if (req('sc') == 'desc') { ?>sort-up<? } else { ?>sort-down<? } ?>">
                                &nbsp;</i></a></li>
                </ul>
            </div>
        <? } ?>


        <?
        if (notnull($zbyHotGoodsList)) {
//            var_dump($zbyHotGoodsList);
            foreach ($zbyHotGoodsList as $val) {
//                echo "<pre>";
//                var_dump($val);
                $goodsImage = $val['goodsImage'];
                $sku_list = get_sku_list($val['goodsId'], 5);
                $goods_url = $val['pcALiDetailLink'];
                $goodsId = $val['goodsId'];
                $productId = $val['productId'];
                $ziyingurl = "/product/detail-" . $goodsId . "-" . $productId . ".html"
                ?>
                <div class="lv-list">
                    <!-- ��Ʒ��Ϣ -->
                    <div class="info">
                        <a class="imgbox" title="" href="<? if ($val['aLiData'] != '������Ӫ') {
                            echo $ziyingurl;
                        } else {
                            echo $goods_url;
                        } ?>" target="_blank"> <img alt="<?= $val['goodsName'] ?>" src="<?= $goodsImage ?>"
                                    onerror="javascript:this.src='/themes/s01/images/lv_list_default.png' "> </a>
                        <dl class="text">
                            <dt style="width:480px;height:52px;"><a href="<? if ($val['aLiData'] != '������Ӫ') {
                                    echo $ziyingurl;
                                } else {
                                    echo $goods_url;
                                } ?>" target="_blank" alt="<?= $val['goodsName']?>" title="<?= $val['goodsName']?>" <? if ($val['is_hot'] == 1){
                                                       ?>style="color:red;font-weight:bold;"<?
                                } ?>><?=  zwjiequ($val['goodsName'],108) ?></a></dt>

                            <?
                            //                    if(in_array($val['goods_type'],array(1,2,6))){
                            ?>

                            <?
                            $val['itemInfo'] = gbk_to_utf8($val['itemInfo']);
                            $val['itemInfo'] = json_decode($val['itemInfo'], true);
                            $val['itemInfo'] = array_iconv($val['itemInfo']);
                            $valnum = count($val['itemInfo']);
                            ?>

                                <?
                                if (notnull($val['itemInfo']) && $val['aLiData'] == '������Ӫ') {
                                    foreach ($val['itemInfo'] as $key => $value) {
                                        if($value['text'] != '��������') {
                                             if($value['text'] == '��ͨ��Ϣ') $tupian =  '/themes/s01/images/jiaotong.png';
                                             else if($value['text'] == '����Ч��') $tupian = '/themes/s01/images/xiaolv.png';
                                             else if($value['text'] == '��Ʒ����') $tupian = '/themes/s01/images/liangdian.png';
                                             else if($value['text'] == 'ס������') $tupian = '/themes/s01/images/xiangqing.jpg';
                                             ?>
                                            <dd style="background: url(<?= $tupian;?>) no-repeat 37px 10px;padding-top: 10px;line-height: 15px;"><?= $value['text'] ?>��<span class="mr30"
                                                        title="<? echo $value['desc']; ?>"><? echo zwjiequ(trim($value['desc']), 54); ?></span>
                                                <br>
                                                <!--                                        --><?//=$value['text']
                                                ?><!--:<span class="mr30">--><?//=$value['desc']
                                                ?><!--</span><br>--></dd>
                                            <?
                                        }
                                    }
                                } ?>



                            <dd style="padding-top: 5px;line-height: 13px;background: url(/themes/s01/images/dingwei.png) no-repeat 37px 3px;">
                                <? if ($val['aLiData'] != '������Ӫ') {
                                    ?>
                                    �������У�<span class="mr30"><? if($val['srcProv'] == $val['srcCity']) echo $val['srcCity']; else echo $val['srcProv'].$val['srcCity'] ?></span>
                                <?
                                } ?>
                            </dd>

                            <dd style="padding-top: 10px;line-height: 13px;background: url(/themes/s01/images/dingwei.png) no-repeat 37px 9px;">
<!--                                --><?// if ($val['aLiData'] != '������Ӫ') {
                                    ?>
                                    ������У�<span class="mr30" title="<?= $val['distProv'].$val['distCity']?>"><?= zwjiequ($val['distProv'].$val['distCity'],60); ?></span>
<!--                                    --><?//
//                                } ?>
                            </dd>

                            <dd style="padding-top: 10px;line-height: 13px;background: url(/themes/s01/images/xingcheng.jpg) no-repeat 37px 10px;">
                                <? if ($val['aLiData'] != '������Ӫ') {
                                    ?>
                                    �г�������<span><?= $val['lineDays'] ?>��<?= $val['lineNights'] ?>��
                                <?
                                } ?>
                            </span></dd>
                            <!--��������-->
<!--                            --><?//
//                            if($val['aLiData'] != '������Ӫ' && notnull($val['skuList'])){
//                                ?>
<!--                                <dd style="padding-top: 10px;line-height: 13px;"><span class="ff-toh">��������:-->
<!--                                        --><?//foreach ($val['skuList'] as $cval){
//                                            ?>
<!--                                            --><?//= $cval?>
<!--                                            --><?//
//                                        }
//                                        ?>
<!--                                </dd>-->
<!--                                --><?//
//                            }
//                            ?>
                            <!--������ͨ-->
                            <dd style="padding-top: 10px;line-height: 15px;background: url(/themes/s01/images/jiaotong.png) no-repeat 37px 10px;">
                                <? if ($val['aLiData'] != '������Ӫ' && notnull($val['goTraffic']) && notnull($val['backTraffic'])) {
                                    ?>
                                    ������ͨ��<span><?= $val['goTraffic']?>(����)��<?= $val['backTraffic']?>(����)
                                    <?
                                } ?>
                           </span> </dd>

                            <?/*}else{*/
                            ?><!--
                    <dd style="margin-top:20px"><?/*=show_substr(removehtml($val['summary']),180)*/
                            ?></dd>
                    --><?/*}*/
                            ?>
                        </dl>
                        <div class="lv-lineright">
                            <div class="price yellow-a"><sub>&yen;</sub> <span
                                    class="num"><?= $val['minPrice'] ?></span> <sub>��/��</sub></div>
                            <a href="<? if ($val['aLiData'] == '������Ӫ') {
                                echo $goods_url;
                            } else {
                                echo $ziyingurl;
                            } ?>" target="_blank" class="btn  btn-sm">�鿴����</a>
<!--                            <div class="count"> </a></div>-->
                            <?if($val['aLiData'] == '������Ӫ'){ ?><p style="text-align: center;color: #999;line-height: 28px;font-size: 12px;font-weight: bold;">�������ɷ����ṩ</p><? } ?>
                        </div>
                    </div>
                </div>
                <?
            }
        } else {
            ?>
            <div class="box-warning bw-bold mb15" style="margin-top:20px">
                <i class="icon waring-sm"></i>�ܱ�Ǹ��û���ҵ�<? if ($keywords != '') { ?>�� <b
                    class="yellow-a">��<?= $keywords ?>��</b> <? } ?>��صĲ�Ʒ��Ҫ������������Ʒ�����߻����ؼ���������
            </div>
        <? } ?>


        <? if (notnull($zbyHotGoodsList)) { ?>
            <!--��ҳ-->

        <? } ?>

        <? if (!empty($keyWord) || $orderby == 'true') { ?>
            <div class="spotList_main2_title">
                <div class="spotList_main2_title_right">
                    <div class="yema">ҳ�룺<b><? echo $pageNo; ?></b>/<?= $totalPage ?></div>
                    <a href="<?= $nowUrl ?>&pageNo=<?= $prePage; ?>"><? if ($pageNo > 1){ ?><span
                            class="leftBtn_hover"><? }else{ ?><span class="leftBtn"><? } ?></span></a>
                    <a href="<?= $nowUrl ?>&pageNo=<?= $nextPage ?>"><? if ($pageNo == $totalPage){ ?><span
                            class="rightBtn_hover"><? }else{ ?><span class="rightBtn"><? } ?></span></a>
                </div>
            </div>
        <? } ?>
    </div>


    <div class="aside fr">

        <!-- ���� -->
        <div class="mb15">
            <?
            $ad_list = get_ad('p_r', '0', 3);
            if (notnull($ad_list)) {
                ?>
                <? foreach ($ad_list as $cval) {
                    ?>
                    <a href="<?= $cval['ad_url'] ?>" target="_blank" title="<?= $val['ad_title'] ?>"> <img
                            src="/upfiles/<?= $g_siteid . '/' . $cval['ad_image'] ?>" alt="<?= $val['ad_title'] ?>">
                    </a><br/>
                <? } ?>
            <? } ?>
            <? //include(load_user_diy('diy.x05.html'));?>
        </div>

        <div class="aside-box aside-hot">
            <div class="aside-title">����ϲ��</div>
            <ul>
                <?
                $guess_list = get_guess_list(10);
                //                var_dump($guess_list);
                if (notnull($guess_list)) {
                    $n = 1;
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
                            <li><i class="lv-icon ico-snum"><?= $n ?></i> <a href="<? echo $href; ?>" target="_blank"
                                                                             title="<?= $val['goods_name'] ?>">
                                    <?= $val['goods_name'] ?> </a>
                                <div class="yellow-a"><sub>&yen;</sub> <strong><?= $val['min_price'] ?></strong> ��
                                    <span style="float:right"><?= date('m/d H:i', strtotime($val['browse_time'])) ?>
                                        �����</span>
                                </div>
                            </li>
                            <?
                            $n++;
                        }
                    }
                }
                ?>
            </ul>
        </div>

        <?
        $goods_article = list_goods_article(5);
        if (notnull($goods_article)) {
            ?>
            <div class="aside-box aside-hot">
                <div class="aside-title"><?= $c_catalog['cat_name'] ?>���ι���</div>
                <ul class="order-news">
                    <?
                    foreach ($goods_article as $val) {
                        $news_url = get_news_url($val['thread_id']);
                        ?>
                        <li>
                            <a href="<?= $news_url ?>" targe="_blank"><?= $val['title'] ?></a>

                            <div class="mt10"><?= date('Y/m/d', strtotime($val['addtime'])) ?> <span
                                    class="gray-b">���<?= $val['clicks'] ?>��</span></div>
                        </li>
                    <? } ?>
                </ul>
            </div>
        <? } ?>
    </div>
    <div class="clear"></div>
</div>
<div class="clear"></div>
<? include('foot.php'); ?>
</body>
</html>
<?
function jiequ($num, $data)
{
    if (mb_strlen($data, 'gbk') > $num) {
        return mb_substr($data, 0, $num, 'gbk') . '...';
    } else {
        return $data;
    }

}

?>