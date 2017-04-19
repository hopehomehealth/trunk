<!DOCTYPE html>
<html>
<head>
    <?include('meta.php');?>
    <?seo();?>
    <?//load_mobile('http://'.$g_config['mobile_domain'].'/product/detail-'.$c_goods_id.'.html');?>

    <?include('static.php');?>
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/detail.css">
    <script type="text/javascript" src="/member/plugin?cmd=browse&goods_id=<?=$c_goods_id?>"></script>

</head>

<body class="bodybox">
<?include('head.php');?>
<div class="container">
    <ul class="breadcrumbs">
        <li class="item"><a href="<?=$g_domain?>">首页</a><span>&gt</span></li>
        <?
        if($c_goods_type=='1'){
            ?>
            <li class="item"><a href="/gentuan/all/">跟团游</a><span>&gt</span></li>
        <?}?>
        <?
        if($c_goods_type=='2'){
            ?>
            <li class="item"><a href="/ziyouxing/all/">自由行</a><span>&gt</span></li>
        <?}?>
        <?
        if($c_goods_type=='3'){
            ?>
            <li class="item"><a href="/qianzheng/">签证</a><span>&gt</span></li>
        <?}?>
        <?
        if($c_goods_type=='6'){
            ?>
            <li class="item"><a href="/youlun/">邮轮</a><span>&gt</span></li>
        <?}?>
        <?
        if($c_goods_type=='1' || $c_goods_type=='2'){
            if(notnull($this_parent_catalog)){
                $max_level = sizeof($this_parent_catalog) -1;
                for($i=$max_level; $i>=0; $i--){ //倒序
                    ?>
                    <li class="item"><a href="<?=$g_domain?><?=$g_product_type_url[$c_goods_type]?>/<?=$this_parent_catalog[$i]['cat_key']?>/"><?=$this_parent_catalog[$i]['cat_name']?></a><span>&gt</span></li>
                    <?
                    $foot_cat_name = $this_parent_catalog[$i]['cat_name'];
                    $foot_cat_key = $this_parent_catalog[$i]['cat_key'];
                }
            }
        }
        ?>

        <li class="item current"><?=$c_goods['goods_name']?></li>

        <?
        /// 编辑的快捷方式
        $is_edit = false;
        if($_COOKIE['CLOOTA_B2B2C_ADMIN_UUID']!=''){
            $is_edit = true;
            $edit_dir = 'console';
        }
        if($_COOKIE['CLOOTA_B2B2C_SHOP_UUID']!=''){
            if($_COOKIE['CLOOTA_B2B2C_SHOP_UUID'] == $c_goods['shop_id']){
                $is_edit = true;
                $edit_dir = 'seller';
            }
        }
        ?>
        <?if($is_edit == true){?>
            <a href="/<?=$edit_dir?>/?cmd=<?=base64_encode('goods_add.php')?>&cat_id=<?=$c_goods['cat_id']?>" target="_blank" style="color:#ffffff;font-size:12px;float:right;background-color:#ff3300;padding:5px;"> 新增 </a>
            <a href="/<?=$edit_dir?>/?cmd=<?=base64_encode('goods_edit.php')?>&goods_id=<?=$c_goods['goods_id']?>" target="_blank" style="color:#ffffff;font-size:12px;float:right;background-color:#ff3300;padding:5px;margin-right:5px;"> 编辑 </a>
        <?}?>

    </ul>
    <!-- 主体内容区 -->
    <div class="lv-detail wrap">
        <!-- slider and date -->
        <div class="detail-left">
            <!-- slider -->

            <div class="detail-slider">
                <ul class="bigpic gallery">
                    <li class="gallery-item active"> <a href="javascript:void(0)"> <img src="<?=$c_goods_image?>" alt=""> </a> </li>
                    <?
                    if(notnull($c_goods_image_list)){
                        foreach ($c_goods_image_list as $val){
                            $other_image = "/upfiles/$g_siteid/".$val['filepath'];
                            ?>
                            <li class="gallery-item "> <a href="javascript:void(0)"> <img src="<?=$other_image?>" alt=""> </a> </li>
                            <?
                        }
                    }
                    ?>
                </ul>
                <div class="smpic">
                    <ul class="gallery-nav" data-pages="1" style="width: 330px">
                        <li class="active">
                            <a class="selected" data-slide="0" data-page="1" data-mimetype="image/jpg" href="javascript:void(0)">
                                <img src="<?=$c_goods_image?>"  alt=""> <span></span> </a>

                            <?
                            if(notnull($c_goods_image_list)){
                                $p = 1;
                                foreach ($c_goods_image_list as $val){
                                    $other_image = "/upfiles/$g_siteid/".$val['filepath'];
                                    ?>
                                    <a class="" data-slide="<?=$p?>" data-page="1" data-mimetype="image/jpg" href="javascript:void(0)"> <img src="<?=$other_image?>" alt=""> <span></span> </a>
                                    <?
                                    $p++;
                                }
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- 价格日历 -->
            <div id="cal-loading~" class="cal-loading" style="height:auto;padding-bottom:10px;<?if($c_goods['goods_type']=='3'){?>display:none<?}?>">
                <link type="text/css" rel="stylesheet" href="/themes/s01/images/calendar.css">
                <div id="v_calendar" style="height:auto">
                    <div id="date_price"></div>
                    <script type="text/javascript">
                        function change_calendar(yyyy, mm){
                            var v_url="";
                            v_url = "/member/ajax.calendar.php?rnd="+Math.random();
                            v_url += "&goods_id=<?=$c_goods['goods_id']?>";
                            v_url += "&yyyy="+yyyy;
                            v_url += "&mm="+mm;
                            var html_calendar=$.ajax({url:v_url,async:false});
                            $("#date_price").html(html_calendar.responseText);
                        }
                        change_calendar(<?=date("'Y','m'")?>);
                    </script>
                </div>
            </div>
        </div>
        <!-- right info -->
        <div class="detail-info">
            <div class="detail-title">
                <a href="/product/detail-<?=$c_goods['goods_id']?>.html" title="<?=$c_goods['goods_name']?>" ><?=$c_goods['goods_name']?></a>
                <?if($c_goods['is_sale']=='0'){?>
                    <i style="color:red">【已下架】</i>
                <?}?>
                <?
                if($c_goods['sale_type']>0){
                    if(date('Y-m-d H:i:s')>=$c_goods['sale_end']){
                        ?>
                        <i style="color:red">【已过期】</i>
                        <?
                    }
                }
                ?>

                <?if($c_goods['is_sale']=='1'){?>
                    <?if($c_goods['is_hot']=='1'){?><i class="tag-btn">热卖</i><?}?>
                <?}?>
                <i class="tag-btn"><?=$g_product_type[$c_goods_type]?></i>
            </div>
            <div class="d-con">
                <div class="d_row gray-c">原 价：<del>&yen;<?=$c_goods['market_price']?></del><a href="javascript:void(0);" class="rel d_sm">起价说明<span class="box-tips" style="display:none "><i class="icon"></i><strong>起价说明</strong><br>本起价是按双人出行共用一间房核算的单人价格，产品价格根据您所选择的出发日期、出行人数、入住酒店房型、航班或交通以及所选附加服务的不同而有所差别。</span>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="yellow-a">【编号：<?=$c_goods['goods_code']?>】</span>
                </div>
                <div class="d_row gray-c d_price">优惠价
                    <span class="yellow-a"><i>&yen;</i> <em><?=$c_goods['min_price']?></em><sub> 起</sub></span>
                    <a href="javascript:void(0);" class="rel">支付说明<span class="box-tips" style="display:none; width:162px;">
					<i class="icon"></i>享受<?=$g_sitename?>直减价格</span></a>
                </div>
                <div class="d_row gray-c route-line" >
                    <label>建议提前</label>
                    <div> <span class="route-day"><?=$c_goods['before_days']?></span><span class="gray-b">天预订</span> </div>
                </div>

                <div class="d_row gray-c" >
                    <?if($c_goods['src_prov']!=''){?>
                        出发地：<span class="gray-b">  <?=$c_goods['src_prov']?> <?=$c_goods['src_city']?> </span><br/>
                    <?}?>

                    <?if($c_goods['dist_prov']!=''){?>
                        目的地： <span class="gray-b"><?=$c_goods['dist_prov']?> <?=$c_goods['dist_city']?> </span><br/>
                    <?}?>


                    服务商： <span class="gray-b"><a href="<?=$c_shop_url?>" target="_blank"><?=$c_shop_name?></a> </span>
                </div>

                <a href="/member/?cmd=<?=base64_encode('checkout.php')?>&goods_type=<?=$c_goods['goods_type']?>&goods_id=<?=$c_goods['goods_id']?>" class="btn btn-lg" target="_blank" <?if($c_goods['goods_type']!='3'){?>style="display:none"<?}?>>立即预订</a>

                <dl class="d-code" >
                    <dd>
                        <img src="<?=$g_sys_home?>/qr/?v=<?=$g_full_url?>" style="width:94px;height:94px" title="微信扫描二维码">
                    </dd>
                </dl>
            </div>
        </div>
        <div class="detail-recommend" <?if($c_goods['goods_type']=='3'){?>style="display:none"<?}?>>
            <div class="imgbox"> <img alt="" src="/images/consult.jpg">
                <div class="img-after"></div>
            </div>
            <div class="u-name">旅游顾问 <br> 产品推荐 </div>
            <div class="recommend-info" >
                <?
                $summary = stripslashes($c_goods['summary']);
                $summary = str_replace('font-family', '~font-family', $summary);
                echo $summary;
                ?>
            </div>
        </div>
        <div class="bdsharebuttonbox" style="margin-top:10px"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a></div>
        <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"24"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
        <div class="clear"></div>
    </div>
    <!-- search -->
    <div class="detail-search toscroll" id="searchzone" <?if($c_goods['goods_type']=='3'){?>style="display:none"<?}?>>
        <i class="lv-icon form-i"></i>
        <form name="order" action="#" class="detail-form" method="get">
            <label for="">出发日期:</label>
            <div class="input-group">
                <!-- <select name="departdate" id="departdate" onChange="count_price()" style="font-size:12px;width:100%">
                    <option value="">请选择出发日期</option>
                    <?
                    foreach ($adult_price as $key => $value) {
                        $this_week = date('w',strtotime($key));
                        if($value!='' && date('Ymd')<=date('Ymd',strtotime($key))){
                            ?>
                            <option value="<?=$key?>"><?=date('m-d',strtotime($key))?>(<?=get_week_str($this_week)?>) <?=$value?>元/成人 <?if($kid_price[$key]>0){?><?=$kid_price[$key]?>元/儿童<?}?> <?if($diff_price[$key]>0){?>(单房差<?=$diff_price[$key]?>元/人)<?}?></option>
                            <?
                        }
                    }
                    ?>
                </select> -->
                <input type="text" name="出发日期" id="startDate" value="2017-4-18   星期二">
            </div>

            <!-- <label for="">购买份数:</label>
            <select>
                <option>1份</option>
                <option>2份</option>
                <option>3份</option>
            </select>
            <label for="">其中包含:</label>
            <span style="display: inline-block;padding:0 5px;background-color: #fff;">成人：2/儿童：1</span>
            
            <a href="javascript:void(0);" class="qijia" style="">起价说明</a>
            <div class="qijia_tips">
                本起价是指未包含附加服务（如单人房差、保险费等）的基本价格。您最终确认的价格将会随所选出行日、人数及服务项目而改变.
            </div> -->
            <label for="">成人</label>
            <select name="adult_num" id="adult_num" style="width:60px" onChange="count_price()">
                <?for($i=1;$i<=50;$i++){?>
                    <option value="<?=$i?>"><?=$i?></option>
                <?}?>
            </select>
            
            <a href="javascript:void(0);" class="qijia1" style="">起价说明</a>
            <div class="qijia1_tips">
                本起价是指未包含附加服务（如单人房差、保险费等）的基本价格。您最终确认的价格将会随所选出行日、人数及服务项目而改变.
            </div>

            <label for="">儿童</label>
            <select name="kid_num" id="kid_num" style="width:60px" onChange="count_price()">
                <option value="0">0</option>
                <?for($i=1;$i<=50;$i++){?>
                    <option value="<?=$i?>"><?=$i?></option>
                <?}?>
            </select>
            <iframe id="frm" name="frm" src="" frameborder="0" scrolling="no" width="0" height="0"></iframe>

            <script type="text/javascript">
                function order_window(){
                    if($('#departdate').val()=='') {
                        alert('亲，您没有选择出发日期！');
                        return false;
                    }

                    if($('#adult_num').val()=='0') {
                        alert('亲，您没有选择人数！');
                        return false;
                    }


                    var url="";
                    url = "/zhoubianyou/zbyform_submit";
                    url += "-<?=$c_goods['goods_type']?>";
                    url += "-<?=$c_goods['goods_id']?>";
                    url += "-<?=$c_goods['goods_name']?>";
                    url += "-"+$('#adult_num').val();
                    url += "-"+$('#kid_num').val();
                    url += "-"+$('#departdate').val();
                    url += "-"+$('#payPrice').val();
                    url += ".html";
                    window.top.location.href = url;
                }
            </script>



            <a href="javascript:void(0);" class="form-tips rel">
                儿童价说明<span class="box-tips child_tips" style="display:none"><i class="icon"></i>2-12岁儿童：<br/>
		1.若含机票，全价收取<br/>
		2.酒店按房间数收费<br/>
		3.景点以实际套餐为准</span>
            </a>

            <script type="text/javascript">
                function getNum(text){
                    var value = text.replace(/[^0-9]/ig,"");
                    value = value.substring(1);
                    return value;
                }
                function count_price(){
                    var v_url="";
                    v_url = "/member/ajax.price_sum.php?rnd="+Math.random();
                    v_url += "&goods_id=<?=$c_goods['goods_id']?>";
                    v_url += "&adult_num="+$('#adult_num').val();
                    v_url += "&kid_num="+$('#kid_num').val();
                    v_url += "&departdate="+$('#departdate').val();

                    if($('#departdate').val()!=''){
                        var html_list=$.ajax({url:v_url+"&ac=list",async:false});
                        $("#sum_result").html(html_list.responseText);

                        var html_count=$.ajax({url:v_url+"&ac=count",async:false});
                        $("#count_result").html(html_count.responseText);
                        var str1 = $("#count_result").html();
                        //alert(str1);
                        var str2 = getNum(str1);
                        //alert(str2);
                        $("#payPrice").val(str2);
                    } else {
                        $("#sum_result").html('');
                        $("#count_result").html('');
                    }
                }
            </script>

            <div class="form-btn">
			<span >套餐价：<span id="count_result" class="form-price yellow-b">--</span>　
			<span id="orderPriceYes" style="display:none"> <sub class="yellow-b">&yen;</sub><span class="form-price yellow-b" id="orderPrice">0</span></span> </span> <input id="payPrice" type="hidden" name="payPrice" value="">
                <span id="order_span">
				<a href="javascript:void(0);" onclick="return order_window()" class="btn btn-lg" id="order_button">开始预订</a>
			</span>
            </div>
        </form>

    </div>

    <?if($c_goods['is_sale']=='0'){?>
        <script type="text/javascript">
            $("#searchzone").css('display','none');
        </script>
    <?}?>
    <?
    if($c_goods['sale_type']>0){
        if(date('Y-m-d H:i:s')>=$c_goods['sale_end']){
            ?>
            <script type="text/javascript">
                $("#searchzone").css('display','none');
            </script>
            <?
        }
    }
    ?>

    <!-- 详情页按份分与按人分 -->
    <div class="detail_byPart">
        <ul class="byPart_title">
            <li class="product_name">套餐名称</li>
            <li class="hotel_contain">包含酒店</li>
            <li class="ticket_contain">包含门票</li>
            <li class="fangcha">房差</li>
            <li class="product_mounts">库存</li>
            <li class="product_price">价格</li>
            <li class="product_select">选择</li>
        </ul>
        <div class="byPart_cont">
            <ul>
                <li class="product_name1">一期客房（大床房）</li>
                <li class="hotel_contain1">速八酒店<br>扬州彭大酒店</li>
                <li class="ticket_contain1">欢乐谷夜场<br>西湖风景区</li>
                <li class="fangcha1">
                    <select>
                        <option>1</option>
                        <option>3</option>
                    </select>
                </li>
                <li class="product_mounts1">充足</li>
                <li class="product_price1"><b>&yen;299</b>/份</li>
                <li class="product_select1 select_selected">
                    <span></span>
                </li>
            </ul>
            <div class="hide_content">
                周末温泉门票2张，1小盒新鲜草莓，颈枕1个。普罗旺斯餐厅代金券20元（消费满166元以上），卡丁车俱乐部四项（卡丁车1圈、射箭10支、射击10发、双人自行车1圈），幸福农场菜园租赁8折，幸福农场菜园采摘8.5折，参加蓝调部落周年庆活动（消费多少送双倍）<i></i>
            </div>
            <div class="product_name_tips">
                豪华总统套房（含双人早餐）<i></i>
            </div>
            <div class="ticket_contain_tips">
                包含：东方明珠门票两张，迪士尼小镇、宝藏湾风暴来临；杰克船长之惊天特技大冒险（现场娱乐演出，舞台表演，室内娱乐）<i></i>
            </div>
            <div class="change_rule_tips">
                如需取消、修改订单，请在2017-04-24 12:00前申请退款，过期扣除套餐全部费用。若您的旅程尚未确定，建议购买取消险。<i></i>
            </div>
            <div class="change_rule">退改规则</div>
        </div>

        <div class="byPart_cont">
            <ul>
                <li class="product_name1">一期客房（大床房）</li>
                <li class="hotel_contain1">速八酒店<br>扬州彭大酒店</li>
                <li class="ticket_contain1">欢乐谷夜场<br>西湖风景区</li>
                <li class="fangcha1">
                    <select>
                        <option>1</option>
                        <option>3</option>
                    </select>
                </li>
                <li class="product_mounts1">充足</li>
                <li class="product_price1"><b>&yen;299</b>/份</li>
                <li class="product_select1">
                    <span></span>
                </li>
            </ul>
            <div class="hide_content">
                周末温泉门票2张，1小盒新鲜草莓，颈枕1个。普罗旺斯餐厅代金券20元（消费满166元以上），卡丁车俱乐部四项（卡丁车1圈、射箭10支、射击10发、双人自行车1圈），幸福农场菜园租赁8折，幸福农场菜园采摘8.5折，参加蓝调部落周年庆活动（消费多少送双倍）<i></i>
            </div>
            <div class="product_name_tips">
                豪华总统套房（含双人早餐）<i></i>
            </div>
            <div class="ticket_contain_tips">
                包含：东方明珠门票两张，迪士尼小镇、宝藏湾风暴来临；杰克船长之惊天特技大冒险（现场娱乐演出，舞台表演，室内娱乐）<i></i>
            </div>
            <div class="change_rule_tips">
                如需取消、修改订单，请在2017-04-24 12:00前申请退款，过期扣除套餐全部费用。若您的旅程尚未确定，建议购买取消险。<i></i>
            </div>
            <div class="change_rule">退改规则</div>
        </div>
        
        <div class="feiyongshuoming">
            <h3>费用说明</h3>
            <ul>
                <li>【住】扬州杨鹏大酒店客房1间1晚（自选房型）</li>
                <li>【吃】入住次日清晨酒店自助早餐2份（身高≥1.2米的儿童早餐按成人标准58元/份收费）</li>
                <li>【游】景点门票4选1【瘦西湖风景区/瘦西湖温泉/何园/个园/大明寺景区】（敬请下单时自行选择确定具体景点名称、游玩时间及游玩人数）</li>
                <li>&nbsp;&nbsp;即日起至2017.12.31日，凡此期间入住客人均可享受5楼湖苑餐厅零点餐饮9折优惠（海鲜、特价菜、酒水除外）</li>
            </ul>
            <dl>
                <dt>温馨提示:</dt>
                <dd>1.套餐内容及出行人数可按需调整</dd>
                <dd>2.套餐总价会根据内容和出行日期变化</dd>
                <dd>3.礼包赠送与否及所赠内容由您入住日期和房型决定</dd>
            </dl>
        </div>
    </div>

   <!--  <div class="detail_byPerson">
        
    </div> -->


    <!-- tabnav -->
    <ul class="detail-tabnav unsticky">
        <li class="selected" href="#special"><a href="#special">详细描述</a></li>
        <li href="#itinerary" <?if($c_goods['goods_type']=='3'){?>style="display:none"<?}?>><a href="#itinerary">行程安排</a></li>
        <li href="#cost"><a href="#cost">费用说明</a></li>
        <li href="#infomation"><a href="#infomation">预订须知</a></li>
        <li href="#commentzone"><a href="#commentzone">游客点评</a></li>
        <li class="last"><a class="btn" href="#searchzone">立即预订</a></li>
    </ul>
    <div class="container">
        <div class="detail-main">
            <!-- 猜你喜欢 -->
            <div class="detail-aside wrap">
                <div class="aside-title">猜你喜欢</div>
                <ul class="detail-asidelike">
                    <?
                    $guess_list = get_guess_list(6);
                    if(notnull($guess_list)){
                        foreach ($guess_list as $val){
                            //                var_dump($val['goods_type']);
                            if ($val['goods_type'] == '4'){
                                $href = "/menpiao/ticket_detail-".$val['goods_id']."-".$val['lv_scenic_id'].".html";
                                $goods_image = $val['goods_image'];
                            }else {
                                $href = "/product/detail-".$val['goods_id'].".html";
                                $goods_image = "/upfiles/$g_siteid/".$val['goods_image'];

                            }
                            ?>
                            <li> <a id="pro-like-img" target="_blank" href="<?echo $href;?>"><img src="<?=$goods_image?>" alt="<?=$val['goods_name']?>" class="imgbox"></a>
                                <div class="tname"><a id="pro-like-title" target="_blank" href="<?echo $href;?>"><?=$val['goods_name']?></a></div>
                                <div class="yellow-a"><sub>&yen;</sub> <span class="font14"><?=$val['min_price']?></span> 起/人</div>
                            </li>
                            <?
                        }
                    }
                    ?>
                </ul>
            </div>
            <!-- 详细内容 -->
            <div class="wrap detail-content">
                <div id="special" class="toscroll">
                    <!-- 特别优惠 -->
                    <div class="detail-article" style="display:none" >
                        <div class="detail-h3"><i class="lv-icon ico-h31">&nbsp;</i>特别优惠</div>
                    </div>
                    <!-- 产品亮点 -->
                    <!-- 产品亮点 -->
                    <div class="detail-article">
                        <div class="detail-h3"><i class="lv-icon ico-h32">&nbsp;</i>详细描述</div>
                        <p>
                            <?
                            $content = stripslashes($c_goods['content']);
                            $content = str_replace('font-family', '~font-family', $content);
                            echo $content;
                            ?>
                        </p>
                    </div>
                    <!-- 接待标准 -->
                    <div class="detail-article" style="display:none" >
                        <div class="detail-h3"><i class="lv-icon ico-h33">&nbsp;</i>接待标准</div>
                    </div>
                    <!-- 交通信息 -->
                    <div class="detail-article" style="display:none" >
                        <div class="detail-h3"><i class="lv-icon ico-h34">&nbsp;</i>交通信息</div>
                    </div>
                    <!-- 重要提示 -->
                    <div class="detail-article no-border" >  </div>
                </div>
                <!-- 行程推荐 -->
                <div id="itinerary" class="toscroll" <?if($c_goods['goods_type']=='3'){?>style="display:none"<?}?>>
                    <div class="detail-article d-pad no-border" >
                        <div class="detail-h3"> <span class="fl">行程安排</span>
                            <div class="d-print"> <a href="javascript:;" class="mr20" style="display: none"><em class="lv-icon ico-share"></em>分享</a> <a href="javascript:;" class="mr20" style="display: none"><em class="lv-icon ico-email"></em>Email 行程</a> <a target="_blank" href="javascript:window.print()"><em class="lv-icon ico-print"></em> 打印行程</a>

                            </div>
                        </div>
                        <div class="detail-map" style="display: none"> <a class="go-bigmap" href="javascript:;"><i class="lv-icon ico-map">&nbsp;</i> 大地图找酒店</a> </div>
                    </div>
                    <div class="detail-article d-pad no-border" >
                        <ul class="detail-daylist">
                            <?
                            if(notnull($all_titles)){
                                foreach ($all_titles as $key => $v) {
                                    ?>
                                    <li id="pro-days" class="selected" data-id="day<?=$key?>">第<?=$key?>天</li>
                                    <?
                                }
                            }
                            ?>
                        </ul>
                        <div class="detail-route">
                            <?
                            if(notnull($all_titles)){
                                foreach ($all_titles as $key => $v) {
                                    ?>
                                    <div id="day1">
                                        <div class="detail-h5"><i class="lv-icon ico-day">D<?=$key?></i><?=$v?></div>
                                        <div> <?=nl2br($all_contents[$key])?> </div>

                                        <ul class="detail-column">
                                            <?for($g=1; $g<=4; $g++){
                                                $img = $all_images[$key][$g];
                                                if($img!=''){
                                                    ?>
                                                    <li><a class="showBig" rel="group1" href="#"> <img src="<?=$img?>" class="imgbox"></a></li>
                                                    <?
                                                }
                                            }
                                            ?>
                                        </ul>
                                        <div style="clear:both"></div>
                                        <?if($all_tools[$key]['house']!=''){?>
                                            <div class="detail-h5" style="float:left;margin-right:50px;"><em class="fa fa-building-o"></em> 住宿：<?=$all_tools[$key]['house']?></div>
                                        <?}?>
                                        <?if($all_tools[$key]['food']!=''){?>
                                            <div class="detail-h5" style="float:left;margin-right:50px;"><em class="fa fa-coffee"></em> 用餐：<?=$all_tools[$key]['food']?></div>
                                        <?}?>
                                        <?if($all_tools[$key]['traffic']!=''){?>
                                            <div class="detail-h5" style="float:left;margin-right:50px;"><em class="fa fa-bus"></em> 交通：<?=$all_tools[$key]['traffic']?></div>
                                        <?}?>
                                        <div style="clear:both"><br/></div>
                                    </div>
                                    <?
                                }
                            }
                            ?>

                        </div>
                    </div>

                </div>
                <!-- 费用说明 -->
                <div id="cost" class="toscroll">
                    <div class="detail-h2"> <i class="lv-icon ico-h22">&nbsp;</i>
                        <div class="fl">费用说明</div>
                        <ul class="detail-menu tab-menu">
                            <li id="pro-tab1" onclick="price_note(1)">费用包含</li>
                            <li id="pro-tab2" onclick="price_note(2)">费用不包含</li>
                        </ul>
                    </div>
                    <div class="detail-article no-border tab-content">
                        <div>
                            <ol class="d-ol" id="fee_note_show">

                            </ol>
                        </div>
                        <div style="display:none;" id="price_note_html">
                            <?=nl2br(stripslashes($c_goods['price_note']))?>
                        </div>
                        <div style="display:none;" id="unprice_note_html">
                            <?=nl2br(stripslashes($c_goods['unprice_note']))?>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    function price_note(v){
                        if(v==1){
                            $("#pro-tab1").addClass("selected");
                            $("#pro-tab2").removeClass("selected");
                            $("#fee_note_show").html($("#price_note_html").html());
                        }
                        if(v==2){
                            $("#pro-tab2").addClass("selected");
                            $("#pro-tab1").removeClass("selected");
                            $("#fee_note_show").html($("#unprice_note_html").html());
                        }
                    }
                    price_note(1);
                </script>

                <div id="infomation" class="toscroll">
                    <div class="detail-h2" > <i class="lv-icon ico-h23">&nbsp;</i>
                        <div class="fl">预订须知</div>
                        <ul class="detail-menu tab-menu">
                        </ul>
                    </div>
                    <div class="detail-article no-border tab-content">
                        <div>
                            <ol class="d-ol">
                                <?=nl2br(stripslashes($c_goods['order_note']))?>
                            </ol>
                        </div>

                    </div>
                </div>
                <!-- 旅游攻略 -->

                <!-- 游客点评 -->
                <div id="commentzone" class="toscroll">
                    <div class="detail-h2"><i class="lv-icon ico-h25">&nbsp;</i>用户点评</div>
                    <div class="detail-comment">
                        <?
                        if(notnull($comment_list)){
                            ?>
                            <div class="info">
                                <div class="count">
                                    <div class="green-a"><strong class="num"><?=$avg_comment_score?></strong>&nbsp;分</div>
                                    <div><i title="5星" class="icon ico-stars<?=round($avg_comment_score)?>">&nbsp;</i></div>
                                    <div class="line-height"><?if($stat_comment_total>0){?>来自<?=$stat_comment_total?>位用户<?}else{?>暂无点评<?}?></div>
                                </div>
                                <ul class="progress">
                                    <li>
                                        <label for="">好评<span class="gray-c">（<?=$comment_a_rate?>%）</span></label>
                                        <div class="bar-group">
                                            <div class="bar-green" style="width:0%"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="">中评<span class="gray-c">（<?=$comment_b_rate?>%）</span></label>
                                        <div class="bar-group">
                                            <div class="bar-green" style="width:0%"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="">差评<span class="gray-c">（<?=$comment_c_rate?>%）</span></label>
                                        <div class="bar-group">
                                            <div class="bar-green" style="width:0%"></div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="go-order">进入"<a href="<?=$g_domain?>member/?cmd=<?=base64_encode('order.php')?>">我的订单</a>"点评已成功出行的旅游产品吧~</div>
                            </div>

                            <div><br/></div>
                        <?}?>

                        <?
                        if(notnull($comment_list)){
                            ?>
                            <div>
                                <?
                                foreach ($comment_list as $val){
                                    if($val['nickname']!='')		$nick = $val['nickname'];
                                    elseif($val['username']!='')	$nick = $val['username'];
                                    elseif($val['account']!='')		$nick = $val['account'];

                                    $nick = substr($nick,0,5).'***'
                                    ?>
                                    <dl class="comment-row">
                                        <dt>
                                        <div class="uhead"></div>
                                        <div><?=$nick?></div>
                                        </dt>
                                        <dd> <i class="icon ico-smile"></i>
                                            <div class="line-height"> <?=$val['content']?> </div>
                                            <div class="font12 gray-c mt10"><?=$g_comment_level[$val['comment_level']]?> </div>
                                            <div class="font12 gray-c mt10"><?=date('Y-m-d', strtotime($val['addtime']))?></div>
                                            <div class="userful"><a href="javascript:;"><i class="lv-icon ico-zan"></i><span
                                                            class="zan selected">+1</span></a></div>
                                        </dd>
                                    </dl>
                                <?}?>
                            </div>
                        <?}else{?>
                            <div class="tab-content">
                                <div id="comment">
                                    <div class="nothing">
                                        <p>还没有游客点评呢~</p>
                                        <p>发表评价可获得积分，前5位评价的游客可获得更多惊喜哦！</p>
                                    </div>
                                </div>
                            </div>
                        <?}?>
                    </div>
                </div>
            </div>
            <!-- 点评内容 end -->

            <!-- 底部猜你喜欢 -->
            <div class="wrap detail-like mt20">
                <div class="detail-h3">猜你喜欢</div>
                <div class="like-list">
                    <ul>
                        <?
                        $guess_list = get_guess_list(6);
                        if(notnull($guess_list)){
                            foreach ($guess_list as $val){
                                $goods_image = "/upfiles/$g_siteid/".$val['goods_image'];

                                ?>
                                <li>
                                    <div class="imgbox"><a id="like-img" href="/product/detail-<?=$val['goods_id']?>.html" target="_blank"><img alt="" src="<?=$goods_image?>" alt="<?=$val['goods_name']?>"></a></div>
                                    <div class="tname"><a id="like-title" href="/product/detail-<?=$val['goods_id']?>.html" target="_blank"><?=show_substr($val['goods_name'],60)?></a></div>
                                    <div class="cYellow">&yen; <span class="font20"><?=$val['min_price']?></span> <span class="cYellow">起/人</span></div>
                                </li>
                                <?
                            }
                        }
                        ?>
                    </ul>
                    <!-- <a href="" class="more">更多&gt;&gt;</a>-->
                </div>

                <!--<a href="" class="more">更多&gt;&gt;</a>-->
            </div>
        </div>
    </div>



</div>

</div>
<!--js-->
<script>
    seajs.use(["freeproduct", 'comment', 'yoslide'], function (product, comment, yoslide) {
        $(function () {
            product.init({
                remoteGetData: function () {
                    var data = {}, newdata = {};
                    data.productId = productID;
                    newdata.data = JSON.stringify(data);
                    return newdata;
                },
                holiday: ["2015-04-05", "2015-05-01", "2015-06-20", "2015-09-27", "2015-10-01"],
                cal4proBuildLink: function (id, date, isToday, isLowest, isFestval) {
                    return "javascript:;"
                }
            });
            //110882
            comment.getData(productID, 1, 5, function (data) {comment.init(data);});
        });

        //左侧轮播
        yoslide.slide();

    });

    //起价提示qijia
    $('.qijia').hover(function(){
        $(this).css({
            "text-decoration":"underline"
        });
        $('.qijia_tips').show();
        $('.qijia_tips').css({
            "position":"absolute",
            "left":700,
            //"top":top
        });
     },function(){
        $('.qijia_tips').hide();
     });
    $('.qijia1').hover(function(){
        $(this).css({
            "text-decoration":"underline"
        });
        $('.qijia1_tips').show();
        $('.qijia1_tips').css({
            "position":"absolute",
            "left":450,
            //"top":top
        });
     },function(){
        $('.qijia1_tips').hide();
     });
    //点击套餐吗，名称展开具体信息
    for (var i = 0; i < $('.product_name1').length; i++) {
       $('.product_name1').eq(i).attr("hide_flag","1");
       $('.product_name1').eq(i).attr("index",i);
       
       $('.product_name1').eq(i).click(function(){
            //console.log($(this).attr("index"));
            if($(this).attr("hide_flag")=='1'){
                $(this).css("backgroundImage","url(/themes/s01/images/sanjiao1.jpg)");
                $('.hide_content').eq($(this).attr("index")).show();
                $(this).attr("hide_flag","0");
            }else{
                $(this).css("backgroundImage","url(/themes/s01/images/sanjiao2.jpg)");
                $('.hide_content').eq($(this).attr("index")).hide();
                $(this).attr("hide_flag","1");
            }
       });

       $('.product_name1').eq(i).hover(function(){
            $(this).css({
                "color":"#fa9520"
            });
            var offsetLeft = $(this).offset().left;
            var offsetTop = $(this).offset().top;
            var elementHeight = 30;
            var left = offsetLeft;
            var top = offsetTop + elementHeight;
            $('.product_name_tips').eq($(this).attr('index')).show();
            $('.product_name_tips').eq($(this).attr('index')).css({
                "position":"absolute",
                "left":left,
                "top":top
            });
         },function(){
            $(this).css({
                "color":""
            });
            $('.product_name_tips').eq($(this).attr('index')).hide();
         });
    }
    //退改规则hover
    for (var i = 0; i < $('.change_rule').length; i++) {
         $('.change_rule').eq(i).attr("index",i);
         $('.change_rule').eq(i).hover(function(){
            $(this).css({
                "color":"#0054a7",
                "textDecoration":"underline"
            });
            var offsetLeft = $(this).offset().left;
            var offsetTop = $(this).offset().top;
            var elementHeight = 32;
            var left = offsetLeft;
            var top = offsetTop + elementHeight;
            $('.change_rule_tips').eq($(this).attr('index')).show();
            $('.change_rule_tips').eq($(this).attr('index')).css({
                "position":"absolute",
                "left":left,
                "top":top
            });
         },function(){
            $(this).css({
                "color":"",
                "textDecoration":""
            });
            $('.change_rule_tips').eq($(this).attr('index')).hide();
         });
    };
    //包含门票hover 
    for (var i = 0; i < $('.ticket_contain1').length; i++) {
         $('.ticket_contain1').eq(i).attr("index",i);
         $('.ticket_contain1').eq(i).hover(function(){
            $(this).css({
                "color":"#fa9520"
            });
            var offsetLeft = $(this).offset().left;
            var offsetTop = $(this).offset().top;
            var elementHeight = 54;
            var left = offsetLeft;
            var top = offsetTop + elementHeight;
            $('.ticket_contain_tips').eq($(this).attr('index')).show();
            $('.ticket_contain_tips').eq($(this).attr('index')).css({
                "position":"absolute",
                "left":(left+70),
                "top":top
            });
         },function(){
            $(this).css({
                "color":""
            });
            $('.ticket_contain_tips').eq($(this).attr('index')).hide();
         });
    };
    //套餐选择按钮
    for (var i = 0; i < $('.product_select1').length; i++) {
        $('.product_select1').eq(i).click(function(){
            $('.product_select1').removeClass('select_selected');
            $(this).addClass("select_selected");
        });
    }
    //儿童价格提示
    $('.form-tips').hover(function(){
        $('.child_tips').show();
    },function(){
        $('.child_tips').hide();
    });
</script>
<div class="clear"></div>
<?include('foot.php');?>
</body>
</html>
