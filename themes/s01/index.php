<!DOCTYPE html>
<html>
<head>
    <title>����,�ܱ���,������Ʊ��Bus365���Ρ�</title>
    <? include('meta.php'); ?>
    <? seo(); ?>
    <? load_mobile('http://' . $g_config['mobile_domain'] . '/'); ?>

    <? include('static.php'); ?>
    <script type="text/javascript" src="/themes/s01/js/jquery.js "></script>
    <script type="text/javascript" src="/themes/s01/js/common.js"></script>
    <link type="text/css" rel="stylesheet" href="/themes/s01/images/home.css">
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


    </style>
</head>
<body class="bodybox" style="background-color: white;" onselectstart="return false">
<? include('head.php'); ?>
<!-- �������� start -->
<div id="searchMainBox">
    <div id="searchMain" style="position: relative;">
        <div class="searchMain1">
            <div class="searchMain1_l">
                <span>������Ʊ</span>
                <ul style="">
                    <li style="background-color:#1fcc9e;color:white;">������Ʊ</li>
                    <li>�ܱ���</li>
                </ul>
            </div>
            <div class="searchMain1_c">
                <input type="text" name="k" placeholder="������Ŀ�ĵ�/��Ʒ����">
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
<div id="hd-mainnav">
    <div class="ota-container">
        <div class="nav-main-classify"><a class="classify-link" href="javascript:void(0)">
                <!-- <i class="icon-head hdico-classify"> --></i>ȫ�����β�Ʒ����</a>
            <ul class="classify-list">
                <? include('index.hotspot.php'); ?>
            </ul>
        </div>

        <!-- ���β�Ʒ���� /-->

        <!-- <ul class="nav-list">
				
				������  
				<?
        $menu01 = get_menu('0', 10);
        if (notnull($menu01)) {
            $m = 1;
            foreach ($menu01 as $val) {
                $menu_url = str_replace('{domain}', $g_domain, $val['url']);

                $menu02 = get_menu($val['menu_id'], 20);
                ?>
				<li class="n<?= $m ?>"><a href="<?= $menu_url ?>" target="<?= $val['target'] ?>" style="<?= $val['css'] ?>" class="nav-link"><?= $val['title'] ?><? if (notnull($menu02)) {
                    ?><i class="icon-head arrows"></i> <?
                } ?></a>
					<? if (notnull($menu02)) {
                    ?>
					<div class="nav-sublist">
						<div class="ota-container">
							<div class="nav-subitem ">
							<?
                    foreach ($menu02 as $cval) {
                        $child_menu_url = str_replace('{domain}', $g_domain, $cval['url']);
                        ?>
							<a href="<?= $child_menu_url ?>" target="<?= $cval['target'] ?>" style="<?= $cval['css'] ?>"><?= $cval['title'] ?></a>
							<?
                    }
                    ?>
							</div>
						</div>
					</div>
					<?
                } ?>
				</li>
				<?
                $m++;
            }
        }
        ?>
			</ul> -->
        <!-- ������ -->

    </div>
</div>
<!-- ���� /-->

<div class="home-slider">

    <ul class="slider-pic gallery">
        <?
        $ppts = index_ppt(0);
        if (notnull($ppts)) {
            $p = 1;
            foreach ($ppts as $val) {
                ?>
                <li class="gallery-item <? if ($p == 1) {
                    ?>active<?
                } ?>">
                    <div class="slider-box">
                        <div class="bigpic"><a href="<?= $val['ppt_url'] ?>" target="_blank"><img
                                    src="/upfiles/<?= $g_siteid . '/' . $val['ppt_image'] ?>" class="imgbox"
                                    alt="<?= $val['ppt_title'] ?>"></a></div>
                        <div class="subpic">
                            <?
                            $ad_list = get_ad('i_c', '0', 3);
                            if (notnull($ad_list)) {
                                ?>
                                <? foreach ($ad_list as $cval) {
                                    ?>
                                    <a href="<?= $cval['ad_url'] ?>" target="_blank"><img
                                            src="/upfiles/<?= $g_siteid . '/' . $cval['ad_image'] ?>" class="imgbox"
                                            alt="<?= $cval['ad_title'] ?>" title="<?= $val['ad_title'] ?>"></a>
                                    <?
                                } ?>
                                <?
                            } else {
                                ?>
                                <? include(load_user_diy('diy.x12.html')); ?>
                                <?
                            } ?>
                        </div>
                    </div>
                </li>
                <?
                $p++;
            }
        } else {
            ?>
            <li class="gallery-item active">
                <div class="slider-box">
                    <div class="bigpic"><a href="#" target="_blank"><img
                                src="/images/070e1c726a468c0f8a90ff7a01eeb3bb.jpg" class="imgbox"
                                title="����ͼƬ��ȣ�848px �߶ȣ�370px"></a></div>
                    <div class="subpic"><a href="#" target="_blank"><img
                                src="/images/9c6c783218f18e9e0abaf1f7032e0f5f.jpg" class="imgbox" alt=""></a> <a
                            href="#" target="_blank"><img src="/images/6809e8461e0bea66c5388f4cc07ee161.jpg"
                                                          class="imgbox" alt=""></a> <a href="#" target="_blank"><img
                                src="/images/057caf4c4a537b9af380692845d7a78a.jpg" class="imgbox" alt=""></a></div>
                </div>
            </li>
            <li class="gallery-item ">
                <div class="slider-box">
                    <div class="bigpic"><a href="#" target="_blank"><img
                                src="/images/c96065038efc803af0e95e5f030b00e5.jpg" class="imgbox"
                                title="����ͼƬ��ȣ�848px �߶ȣ�370px"></a></div>
                    <div class="subpic"><a href="#" target="_blank"><img
                                src="/images/35b11f4541ad7731c43fd1d80baac4e9.jpg" class="imgbox" alt=""></a> <a
                            href="#" target="_blank"><img src="/images/f5a076f9c5b74f0c6b1c49b922c30edd.jpg"
                                                          class="imgbox" alt=""></a> <a href="#" target="_blank"><img
                                src="/images/dfd7a90711478e10c81fac54d3f63b85.jpg" class="imgbox" alt=""></a></div>
                </div>
            </li>
        <? } ?>
    </ul>
    <div class="slider-num gallery-nav">
        <?
        if (notnull($ppts)) {
            $p = 1;
            foreach ($ppts as $val) {
                ?>
                <a href="javascript:;" <? if ($p == 1){
                ?>class=selected<?
                } ?> data-slide="<?= $p - 1 ?>"><?= $p ?></a>
                <?
                $p++;
            }
        } else {
            ?>
            <a href="javascript:;" class=selected data-slide="0">1</a>
            <a href="javascript:;" data-slide="1">2</a>
        <? } ?>
    </div>

    <div class="slider-aside box-border" id="mg_two_menus">
        <div class="aside-quality">
            <ul>
                <? include(load_user_diy('diy.x04.html')); ?>
            </ul>
        </div>
        <ul class="aside-tab">
            <li class="selected" id="news_tab1" onclick="news_tab(1)">��ѡ����</li>
            <li id="news_tab2" onclick="news_tab(2)">���¶�̬</li>
        </ul>
        <div id="pz_killk_s">
            <div class="aside-quality" id="pz_tag1">
                <ul>
                    <? include(load_user_diy('diy.x03.html')); ?>
                </ul>
            </div>
            <div class="hide" id="pz_tag2">
                <ul>
                    <style type="text/css">
                        .news_content a {
                            color: #1fcc9e;
                            font-size: 14px;
                        }
                    </style>
                    <div id="" class="news_content">
                        <?
                        $notice_list = last_notice(5);
                        if (notnull($notice_list)) {
                            foreach ($notice_list as $val) {

                                ?>
                                <p><strong><a href="/news/detail-<?= $val['thread_id'] ?>.html"
                                              target="_blank"><?= $val['title'] ?></a></strong> <?= date('Y/m/d', strtotime($val['addtime'])) ?>
                                </p>
                                <br/>
                                <?
                            }
                        }
                        ?>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function news_tab(id) {
        if (id == 1) {
            document.getElementById('news_tab1').className = "selected";
            document.getElementById('news_tab2').className = "";
            document.getElementById('pz_tag1').className = "aside-quality";
            document.getElementById('pz_tag2').className = "hide";
        }
        if (id == 2) {
            document.getElementById('news_tab2').className = "selected";
            document.getElementById('news_tab1').className = "";
            document.getElementById('pz_tag2').className = "aside-quality";
            document.getElementById('pz_tag1').className = "hide";
        }
    }
</script>

<div class="container mt20">
    <!-- ������� -->
    <div class="home-main fl">

        <?
        $floor_top = floor_list(0, 0); //һ��¥���б�
        if (notnull($floor_top)) {
            $top = 1;
            foreach ($floor_top as $topval) {

                $floor_child = floor_list($topval['floor_id'], 0); //����¥���б�
//                var_dump($floor_child) ;

                $floor_ad_one = floor_ad_one($topval['floor_id']);
                ?>
                <!-- floor top list -->
                <div class="home-module">
                    <div class="home-h2" id="jx_menu">
                        <label><?= $topval['floor_title'] ?><i class="home-icon home-xing">&nbsp;</i></label>
                        <ul class="home-tabnav">
                            <?
                            if (notnull($floor_child)) {
                                $t = 1;
                                foreach ($floor_child as $cval) {

                                    ?>
                                    <li <? if ($t == 1){
                                        ?>class="selected"<?
                                    } ?> data-tab="mid<?= $cval['floor_id'] ?>-type1"><a href="javascript:void(0)"
                                                                                         title="<?= $cval['floor_title'] ?>"><?= $cval['floor_title'] ?></a>
                                    </li>
                                    <?
                                    $t++;
                                }
                            }
                            ?>
                        </ul>
                        <div class="remore"><i class="home-icon">&nbsp;</i></div>
                    </div>
                    <div class="home-content first">
                        <div class="home-section first" id="jx_list">
                            <?
                            if (notnull($floor_child)) {
                                $c = 1;
                                foreach ($floor_child as $key => $cval) {
                                    $floor_id = $cval['floor_id'];
//                                    var_dump($floor_id);
                                    $floor_goods = floor_goods_list($floor_id, 6); //¥���µĲ�Ʒ�б�����6��
//                                    var_dump($floor_goods);
                                    ?>
                                    <div class="tab-content mid<?= $cval['floor_id'] ?>-type1 <? if ($c == 1) {
                                        ?>selected<?
                                    } ?>" <? if ($c > 1){
                                         ?>style="display:none"<?
                                    } ?>>
                                        <div class="hs-best"><a href="<?= $floor_ad_one['ad_url'] ?>" target="_blank"
                                                                title="">
                                                <div class="imgbox"><img
                                                        src="/upfiles/801/201703/2017033106142128161.png"
                                                        alt=""></div>
                                                <div class="hs-txt">
                                                    <div class="sname"></div>
                                                    <div class="sprice yellow-a"><sub></sub><span
                                                            class="snum"></span>
                                                    </div>
                                                </div>
                                            </a></div>
                                        <?
                                        if ($topval['floor_id'] == '16') {
                                            ?>
                                            <div class="hs-best"><a href="<?= $g_self_domain; ?>/menpiao/" target=""
                                                                    title="">
                                                    <div class="imgbox"><img
                                                            src="/upfiles/801/2017033110041987229.png" alt="">
                                                    </div>
                                                    <div class="hs-txt">
                                                        <div class="sname"></div>
                                                        <div class="sprice yellow-a"><sub></sub><span
                                                                class="snum"></span></div>
                                                    </div>
                                                </a></div>
                                        <? } ?>
                                        <?
                                        if ($topval['floor_id'] == '3') {
                                            ?>
                                            <div class="hs-best"><a href="<?= $g_self_domain; ?>/zhoubian/" target=""
                                                                    title="">
                                                    <div class="imgbox"><img
                                                            src="/themes/s01/images/2016040602533176598.png" alt="">
                                                    </div>
                                                    <div class="hs-txt">
                                                        <div class="sname"></div>
                                                        <div class="sprice yellow-a"><sub></sub><span
                                                                class="snum"></span></div>
                                                    </div>
                                                </a></div>
                                        <? } ?>
                                        <ul>
                                            <?
                                            if (notnull($floor_goods)) {
                                                foreach ($floor_goods as $val) {

//                                                        $goods_image = "/upfiles/$g_siteid/" . $val['goods_image'];
                                                        $goods_image = $val['goods_image'];
//                                                        echo $goods_image;echo 'dsfsdfs';
                                                        $goods_url = get_goods_url($val['cat_key'], $val['goods_id']);
                                                    if($val['goods_type'] == '4'){
                                                        $href = $g_self_domain . "/menpiao/ticket_detail-" . $val['goods_id'] ."-". $val['lv_scenic_id'] . ".html";}else if($val['goods_type'] == '1'){
                                                        $href = $g_self_domain . "/product/detail-" . $val['goods_id'] ."-". $val['lv_scenic_id'] . ".html";
                                                    }
                                                        ?>
                                                        <li><a href="<?= $href ?>" target="_blank"
                                                               title="<?= $val['goods_name'] ?>">
                                                                <div class="imgbox"><img src="<?= $val['image'] ?>"
                                                                                         alt="<?= $val['goods_name'] ?>">
                                                                </div>
                                                                <div class="li-txt">
                                                                    <div
                                                                        class="gray-b"><?= $val['goods_name'] ?></div>
                                                                    <div
                                                                        class="gray-a"><?= show_substr(removehtml($val['summary']), 30) ?> </div>
                                                                    <div class="yellow-a">&yen;<span
                                                                            class="snum"><?= $val['price'] ?></span>��
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <?
                                                    }
                                                }
                                            ?>
                                            <!--д�����ܱ��β�ƷͼƬ�Լ�����-->
                                            <?
                                            if($topval['floor_id'] == '3'){
//                                            if($topval['floor_id'] == '98'){echo '42342';
                                            if ($cval['floor_id'] == '5') { ?>
                                                <!--1-->
                                                <li><a href="https://items.fliggy.com/item.htm?spm=181.7621407.a1z9b.428.6tKjpB&id=528929624315&scm=20140635.1_1_6.0.0b83e08a14906890478406199e&t_trace_id=0b83e08a14906890478406199e
" target="_blank" title="�˴��볤��">
                                                        <div class="imgbox"><img
                                                                    src="/themes/s01/images/badalingchangcheng.png"
                                                                    alt="�˴��볤��"></div>
                                                        <div class="li-txt">
                                                            <div class="gray-b">�˴��볤��</div>
                                                            <div class="gray-a">����һ���� �˴��볤��һ���� ����������</div>
                                                            <div class="yellow-a">��<span class="snum">69</span>��</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <!--2-->
                                                <li>
                                                    <a href="https://items.fliggy.com/item.htm?spm=181.7621407.a1z9b.431.6tKjpB&id=44649618108&scm=20140635.1_1_7.0.0b83e08a14906890478406199e&t_trace_id=0b83e08a14906890478406199e"
                                                       target="_blank" title="�ú�԰">
                                                        <div class="imgbox"><img src="/themes/s01/images/yiheyuan.png"
                                                                                 alt="�ú�԰"></div>
                                                        <div class="li-txt">
                                                            <div class="gray-b">�ú�԰</div>
                                                            <div class="gray-a">����һ���ΰ˴��볤��һ�����ú�԰ ������</div>
                                                            <div class="yellow-a">��<span class="snum">159</span>��</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <!--3-->
                                                <li><a href="https://items.fliggy.com/item.htm?
spm=181.7621407.a1z9b.463.6tKjpB&id=531026050731&scm=20140635.1_1_13.0.0b83e08a14906890478406199e&t_trace_id=0b83e08a14906890478406199e
" target="_blank" title="Ľ��������">
                                                        <div class="imgbox"><img
                                                                    src="/themes/s01/images/mutianyuchangcheng.png"
                                                                    alt="Ľ��������"></div>
                                                        <div class="li-txt">
                                                            <div class="gray-b">Ľ��������</div>
                                                            <div class="gray-a">����Ľ��������һ���δ����޹��������</div>
                                                            <div class="yellow-a">��<span class="snum">159</span>��</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <!--4-->
                                                <li><a href="https://items.fliggy.com/item.htm?
spm=181.7621407.a1z9b.463.6tKjpB&id=531026050731&scm=20140635.1_1_13.0.0b83e08a14906890478406199e&t_trace_id=0b83e08a14906890478406199e
" target="_blank" title="�ű�ˮ��">
                                                        <div class="imgbox"><img
                                                                    src="/themes/s01/images/gubeishuizhen.png" alt="�ű�ˮ��">
                                                        </div>
                                                        <div class="li-txt">
                                                            <div class="gray-b">�ű�ˮ��</div>
                                                            <div class="gray-a">���ű�ˮ��һ���Ρ�������Ȫ������α���1������</div>
                                                            <div class="yellow-a">��<span class="snum">318</span>��</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <!--5-->
                                                <li><a href="https://items.fliggy.com/item.htm?
spm=181.7621407.a1z9b.703.6tKjpB&id=526504368607&scm=20140635.1_1_21.0.0b83de2d14906895967614517e&t_trace_id=0b83de2d14906895967614517e
" target="_blank" title="������ɯ">
                                                        <div class="imgbox"><img
                                                                    src="/themes/s01/images/beijingdusha.png" alt="������ɯ">
                                                        </div>
                                                        <div class="li-txt">
                                                            <div class="gray-b">������ɯ</div>
                                                            <div class="gray-a">����һ����ר�� �ʹ�+��ɯ���������+�찲��+ǰ��+������+����</div>
                                                            <div class="yellow-a">��<span class="snum">99</span>��</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <!--6-->

                                                <li><a href="https://items.fliggy.com/item.htm?
spm=181.7621407.a1z9b.778.6tKjpB&id=45414606647&scm=20140635.1_1_36.0.0b83de2d14906895967614517e&t_trace_id=0b83de2d14906895967614517e"
                                                       target="_blank" title="�ʹ�">
                                                        <div class="imgbox"><img src="/themes/s01/images/gugong1.png"
                                                                                 alt="�ʹ�"></div>
                                                        <div class="li-txt">
                                                            <div class="gray-b">�ʹ�</div>
                                                            <div class="gray-a">
                                                                �������α��������δ�������� ����2�������ų��ǹʹ�
                                                            </div>
                                                            <div class="yellow-a">��<span class="snum">499</span>��</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <?
                                            } elseif ($cval['floor_id'] == '14') { ?>
                                                <!--7-->
                                                <li><a href="https://items.fliggy.com/item.htm?
spm=181.7621407.a1z9b.3.T51dTF&id=45110960475&scm=20140635.1_1_1.0.0bfb814814906904437531817e&t_trace_id=0bfb814814906904437531817e"
                                                       target="_blank" title="�ƺ�¥">
                                                        <div class="imgbox"><img src="/themes/s01/images/huanghelou.png"
                                                                                 alt="�ƺ�¥"></div>
                                                        <div class="li-txt">
                                                            <div class="gray-b">�ƺ�¥</div>
                                                            <div class="gray-a">
                                                                �人һ���δ����������ź�����糡�ƺ�¥��Ʊ����
                                                            </div>
                                                            <div class="yellow-a">��<span class="snum">138</span>��</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <!--8-->
                                                <li><a href="https://items.fliggy.com/item.htm?
spm=181.7621407.a1z9b.18.T51dTF&id=545785619630&scm=20140635.1_1_4.0.0bfb814814906904437531817e&t_trace_id=0bfb814814906904437531817e"
                                                       target="_blank" title="ľ������ɽ">
                                                        <div class="imgbox"><img
                                                                    src="/themes/s01/images/mulanyunwushan.png" alt="ľ������ɽ">
                                                        </div>
                                                        <div class="li-txt">
                                                            <div class="gray-b">ľ������ɽ</div>
                                                            <div class="gray-a">
                                                                ľ������ɽ���н���һ���� �ɶ�����ɽ��Ʊ ľ������ɽ��Ʊ�ͻ�
                                                            </div>
                                                            <div class="yellow-a">��<span class="snum">60</span>��</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <!--9-->
                                                <li><a href="https://items.fliggy.com/item.htm?
spm=181.7621407.a1z9b.38.T51dTF&id=528630775345&scm=20140635.1_1_8.0.0bfb814814906904437531817e&t_trace_id=0bfb814814906904437531817e"
                                                       target="_blank" title="����կ">
                                                        <div class="imgbox"><img
                                                                    src="/themes/s01/images/qingliangzhai.png" alt="����կ">
                                                        </div>
                                                        <div class="li-txt">
                                                            <div class="gray-b">����կ</div>
                                                            <div class="gray-a">
                                                                ������һ����8ѡ1��ľ����ز�ԭ���﹵����կ����ɽһ����
                                                            </div>
                                                            <div class="yellow-a">��<span class="snum">50</span>��</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <!--10-->
                                                <li><a href="https://items.fliggy.com/item.htm?
spm=181.7621407.a1z9b.3.vgPEi6&id=44274589956&scm=20140635.1_1_1.0.0b83e04514906911042287688e&t_trace_id=0b83e04514906911042287688e"
                                                       target="_blank" title="���ް�">
                                                        <div class="imgbox"><img src="/themes/s01/images/gezhouba.png"
                                                                                 alt="���ް�"></div>
                                                        <div class="li-txt">
                                                            <div class="gray-b">���ް�</div>
                                                            <div class="gray-a">
                                                                �˲����� ����һϿһ���ν��˺������ִ�Ʊ�����ްӴ�բ
                                                            </div>
                                                            <div class="yellow-a">��<span class="snum">78</span>��</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <!--11-->
                                                <li><a href="https://items.fliggy.com/item.htm?
spm=181.7621407.a1z9b.13.vgPEi6&id=37110334661&scm=20140635.1_1_3.0.0b83e04514906911042287688e&t_trace_id=0b83e04514906911042287688e"
                                                       target="_blank" title="�彭����1">
                                                        <div class="imgbox"><img
                                                                    src="/themes/s01/images/qingjianghualang1.png"
                                                                    alt="�彭����1"></div>
                                                        <div class="li-txt">
                                                            <div class="gray-b">�彭����1</div>
                                                            <div class="gray-a">
                                                                �˲����� ���˾���ֱͨ���彭���ȸ���һ���κ���Ʊ��Ʊ��������
                                                            </div>
                                                            <div class="yellow-a">��<span class="snum">50</span>��</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <!--12-->
                                                <li><a href="https://items.fliggy.com/item.htm?
spm=181.7621407.a1z9b.233.vgPEi6&id=543053186112&scm=20140635.1_1_7.0.0b83e04514906912787433603e&t_trace_id=0b83e04514906912787433603e
" target="_blank" title="�彭����">
                                                        <div class="imgbox"><img
                                                                    src="/themes/s01/images/qingjianghualang.png"
                                                                    alt="�彭����"></div>
                                                        <div class="li-txt">
                                                            <div class="gray-b">�彭����</div>
                                                            <div class="gray-a">
                                                                �����彭���������Ƶ�+�˲��彭���ȳ���Ʊ��A�ߣ�����Ʊ��
                                                            </div>
                                                            <div class="yellow-a">��<span class="snum">373</span>��</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <?
                                            } elseif ($cval['floor_id'] == '4') { ?>
                                                <!--13-->
                                                <li><a href="https://items.fliggy.com/item.htm?
spm=181.7621407.a1z9b.33.43DsrB&id=532044128001&scm=20140635.1_1_7.0.0b802c5c14906914954677263e&t_trace_id=0b802c5c14906914954677263e"
                                                       target="_blank" title="α���ʹ������">
                                                        <div class="imgbox"><img
                                                                    src="/themes/s01/images/weimanhuanggongbowuguan.png"
                                                                    alt="α���ʹ������"></div>
                                                        <div class="li-txt">
                                                            <div class="gray-b">α���ʹ������</div>
                                                            <div class="gray-a">
                                                                ���ֳ����ܱ���α���ʹ�����ݾ�ַһ1���δ���������Ͷ����ز�
                                                            </div>
                                                            <div class="yellow-a">��<span class="snum">220</span>��</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <!--14-->
                                                <li><a href="https://items.fliggy.com/item.htm?
spm=181.7621407.a1z9b.8.4NjVZK&id=536294058384&scm=20140635.1_1_2.0.0b802c5c14906918695035085e&t_trace_id=0b802c5c14906918695035085e"
                                                       target="_blank" title="����쾰��">
                                                        <div class="imgbox"><img
                                                                    src="/themes/s01/images/wangtianejingqu.png"
                                                                    alt="����쾰��"></div>
                                                        <div class="li-txt">
                                                            <div class="gray-b">����쾰��</div>
                                                            <div class="gray-a">
                                                                ���ֳ���ɽʮ���������쾰���ɽ��������ȥ�����������һ����
                                                            </div>
                                                            <div class="yellow-a">��<span class="snum">249</span>��</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <!--15-->
                                                <li><a href="https://items.fliggy.com/item.htm?
spm=181.7621407.a1z9b.13.4NjVZK&id=544567873671&scm=20140635.1_1_3.0.0b802c5c14906918695035085e&t_trace_id=0b802c5c14906918695035085e"
                                                       target="_blank" title="����ɽ���">
                                                        <div class="imgbox"><img
                                                                    src="/themes/s01/images/changbaishantianchi.png"
                                                                    alt="����ɽ���"></div>
                                                        <div class="li-txt">
                                                            <div class="gray-b">����ɽ���</div>
                                                            <div class="gray-a">
                                                                ����ɽ����һ�ո����� ���㵼�ν��� ȫ���޹���
                                                            </div>
                                                            <div class="yellow-a">��<span class="snum">379</span>��</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <!--16-->
                                                <li><a href="https://items.fliggy.com/item.htm?
spm=181.7621407.a1z9b.18.4NjVZK&id=541652740680&scm=20140635.1_1_4.0.0b802c5c14906918695035085e&t_trace_id=0b802c5c14906918695035085e"
                                                       target="_blank" title="����ɽ�ٲ�">
                                                        <div class="imgbox"><img
                                                                    src="/themes/s01/images/changbaishanpubu.png"
                                                                    alt="����ɽ�ٲ�"></div>
                                                        <div class="li-txt">
                                                            <div class="gray-b">����ɽ�ٲ�</div>
                                                            <div class="gray-a">
                                                                ���ֳ���ɽ���¾���һ���� ����ɽ�ٲ���Ԩ̶����ɽ���
                                                            </div>
                                                            <div class="yellow-a">��<span class="snum">220</span>��</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <!--17-->
                                                <li><a href="https://items.fliggy.com/item.htm?
spm=181.7621407.a1z9b.28.4NjVZK&id=525257146306&scm=20140635.1_1_6.0.0b802c5c14906918695035085e&t_trace_id=0b802c5c14906918695035085e"
                                                       target="_blank" title="����ɽ����˺�">
                                                        <div class="imgbox"><img
                                                                    src="/themes/s01/images/changbaishanlaolikehu.png"
                                                                    alt="����ɽ����˺�"></div>
                                                        <div class="li-txt">
                                                            <div class="gray-b">����ɽ����˺�</div>
                                                            <div class="gray-a">
                                                                ����ɽ����˺���Ʊ��1�ո�����
                                                            </div>
                                                            <div class="yellow-a">��<span class="snum">65</span>��</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <!--18-->
                                                <li><a href="https://items.fliggy.com/item.htm?
spm=181.7621407.a1z9b.63.4NjVZK&id=37222329442&scm=20140635.1_1_13.0.0b802c5c14906918695035085e&t_trace_id=0b802c5c14906918695035085e"
                                                       target="_blank" title="�������嵺">
                                                        <div class="imgbox"><img
                                                                    src="/themes/s01/images/beifangbalidao.png"
                                                                    alt="�������嵺">
                                                        </div>
                                                        <div class="li-txt">
                                                            <div class="gray-b">�������嵺</div>
                                                            <div class="gray-a">
                                                                ���ֳ������������嵺һ����-������-�������� �����ļ� ��Ȫ
                                                            </div>
                                                            <div class="yellow-a">��<span class="snum">136</span>��</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <?
                                            }
                                            } ?>




                                        </ul>
                                        <div class="clear"></div>
                                    </div>
                                    <?
                                    $c++;
                                }



                            }
                            ?>
                        </div>
                    </div>
                    <? if ($top == 1) {
                        ?>
                        <?
                        $ad_list = get_ad('i_l_m', '0', 5);
                        if (notnull($ad_list)) {
                            ?>
                            <ul class="home-adbox">
                                <? foreach ($ad_list as $cval){
                                ?>
                                <li><a href="<?= $cval['ad_url'] ?>" target="_blank"
                                       title="<?= $val['ad_title'] ?>"><img
                                            src="/upfiles/<?= $g_siteid . '/' . $cval['ad_image'] ?>"
                                            alt="<?= $val['ad_title'] ?>" class="imgbox"></a>
                                    <?
                                    } ?>
                            </ul>
                            <?
                        } ?>
                        <?
                    } ?>
                </div>
                <!-- floor top list /-->
                <?
                $top++;
            }
        }
        ?>

        <script id="flight-tmpl" type="text/x-handlebars-template">
            {{#each this}}
            <dd>
                <a href="{{url}}" target="_blank" title="{{title}}">
                    <div class="fname">{{title}}</div>
                    <div>
                        <span class="fr yellow-b">{{discount}}</span>
                        <span class="gray-c">{{time}}</span>
                        <span class="fnum yellow-a"><sub>{{currency}}</sub>{{price}}</span>
                    </div>
                </a>
            </dd>
            {{/each}}
        </script>

    </div>
    <div class="home-aside fr">

        <!-- ���� START -->
        <?
        $fast_buy_goods = query_promotion_goods('2', 1);
        $fast_buy_goods_one = $fast_buy_goods[0];
        if ($fast_buy_goods_one['goods_id'] != '') {
            ?>
            <div class="aside-h2 mt20"><i class="home-icon home-qgo">&nbsp;</i><?= $fast_buy_goods_one['min_price'] ?>
                Ԫ����
            </div>
            <div class="box-border aside-qgo">
                <div class="imgbox"><a href="/product/detail-<?= $fast_buy_goods_one['goods_id'] ?>-<?= $fast_buy_goods_one['lv_product_id']?>.html"
                                       target="_blank" title="<?= $fast_buy_goods_one['goods_name'] ?>"><img
                            src="/upfiles/<?= $g_siteid ?>/<?= $fast_buy_goods_one['goods_image'] ?>"
                            alt="<?= $fast_buy_goods_one['goods_name'] ?>"></a><i class="home-icon qgo-arr"></i></div>
                <div class="qgo-info"><a href="/product/detail-<?= $fast_buy_goods_one['goods_id'] ?>-<?= $fast_buy_goods_one['lv_product_id']?>.html"
                                         class="qname"
                                         title="<?= $fast_buy_goods_one['goods_name'] ?>"><?= $fast_buy_goods_one['goods_name'] ?></a>
                    <div class="gray-c"><?= show_substr(removehtml($fast_buy_goods_one['summary']), 100) ?></div>
                    <div class="gray-c">
                        <div class="fr">���� <?= $fast_buy_goods_one['sale_number'] ?>��</div>
                        ԭ�ۣ�&yen;<?= $fast_buy_goods_one['market_price'] ?></div>
                </div>
                <div class="qgo-box"><a class="qgo-btn"
                                        href="/product/detail-<?= $fast_buy_goods_one['goods_id'] ?>-<?= $fast_buy_goods_one['lv_product_id']?>.html">��������</a><sub>&yen;</sub>
                    <span class="num"><?= $fast_buy_goods_one['min_price'] ?></span> ��<i
                        class="home-icon home-zhe"><?= floor($fast_buy_goods_one['min_price'] / $fast_buy_goods_one['market_price'] * 10) ?>
                        ��</i></div>
            </div>
        <? } ?>
        <!-- ���� END -->

        <div class="home-module hotel-wrapper">
            <div class="aside-h2 th"><span class="fl">��Ʒ�Ƽ�</span>
                <div class="sub-h2 fr">
                    <a href="<?= $g_self_domain; ?>/menpiao/zhuti/?&hot=desc
" title="����" target="_blank">&gt;&gt;����<i class="icon arr-sdown"></i></a>
                </div>
            </div>

            <ul class="tab-content aside-rowli box-border htl1 ">
                <?
                $hot_goods = get_hot_goods_list('0', 5);
                if (notnull($hot_goods)) {
                    foreach ($hot_goods as $val) {
                        if(!empty($val['goods_id']) && !empty($val['lv_scenic_id'])) {
//                        var_dump($hot_goods);
                            $goods_image = "/upfiles/$g_siteid/" . $val['goods_image'];

                            if ($val['goods_type'] == '4') {
                                $href = "/menpiao/ticket_detail-" . $val['goods_id'] . "-" . $val['lv_scenic_id'] . ".html";
                                $goods_image = $val['goods_image'];
                            } else if ($val['goods_type'] == '1') {
                                $href = "/product/detail-" . $val['goods_id'] . "-" . $val['lv_scenic_id'] . ".html";
                                $goods_image = $val['goods_image'];
                            }

                            ?>
                            <li class="">
                                <a href="<? echo $href; ?>" title="<?= $val['goods_name'] ?>" data-gid="30000817"
                                   target="_blank">
                                    <div class="imgbox"><img src="<?= $goods_image ?>" alt="" class=""></div>
                                    <div class="name"><?= $val['goods_name'] ?></div>
                                    <i title="4��" class="icon ico-stars4">&nbsp;</i>
                                    <div class="yellow-a mt10"><sub>&yen;</sub>
                                        <span class="num"><?= $val['min_price'] ?> </span> ��
                                        <div class="zhe-group"><span>ʡ</span> <span
                                                    class="zhe-info">&yen;<?= $val['market_price'] - $val['min_price'] ?></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <?
                        }
                    }
                }
                ?>
            </ul>
        </div>


        <!-- �������� -->

        <!-- ����� -->
        <div class="aside-h2 mt20" id="activity_h2_mt20">�ר��</div>
        <ul class="aside-adsul" id="activity_aside_adsul">
            <?
            $ad_list = get_ad('i_r_f1', '0', 5);
            if (notnull($ad_list)) {
                ?>
                <? foreach ($ad_list as $cval) {
                    ?>
                    <li><a href="<?= $cval['ad_url'] ?>" target="_blank" title="<?= $val['ad_title'] ?>"><img
                                src="/upfiles/<?= $g_siteid . '/' . $cval['ad_image'] ?>" alt="<?= $val['ad_title'] ?>"></a>
                    </li>
                <? } ?>
            <? } ?>
            <? //include(load_user_diy('diy.x10.html'));?>
        </ul>
        <!-- ����ר�� -->
        <div class="aside-h2 mt20" id="cooperation_head_h2mt20">����ר��</div>
        <div id="cooperation_h2_mt20">
            <?
            $ad_list = get_ad('i_r_f2', '0', 5);
            if (notnull($ad_list)) {
                ?>
                <? foreach ($ad_list as $cval) {
                    ?>
                    <div class="aside-ads"><a href="<?= $cval['ad_url'] ?>" target="_blank"
                                              title="<?= $val['ad_title'] ?>"> <img
                                src="/upfiles/<?= $g_siteid . '/' . $cval['ad_image'] ?>" alt="<?= $val['ad_title'] ?>">
                        </a></div>
                <? } ?>
            <? } ?>
            <? //include(load_user_diy('diy.x11.html'));?>
        </div>
        <!-- ����С���� -->
    </div>
    <!-- �Ҳ����� /-->

    <script>
        var HotelTopDataArray = {
            "\u5e7f\u5dde": [{
                "gid": "30000817",
                "img": "http:\/\/himg2.#\/artifactory\/hotelresource\/hotelpicture\/17\/30000817\/300200_2505057354",
                "title": "\u5e7f\u5dde\u73c0\u4e3d\u9152\u5e97",
                "desc": "\u6d77\u73e0\u6c5f\u5357\u5927\u9053\u4e2d\u8def348\u53f7(\u8fd1\u4fe1\u548c\u5e7f\u573a, \u5730\u94c12\/ 8\u53f7\u7ebf\u660c\u5c97\u7ad9\u65c1)",
                "currency": "\u00a5",
                "price": 368,
                "lowprice": 368,
                "tourary": "\u7279\u60e0\u5ba2\u623f",
                "url": "http:\/\/hotel.#\/detail\/30000817.html",
                "star": "4",
                "backPrice": 0,
                "sellNum": 0
            }, {
                "gid": "30168893",
                "img": "http:\/\/himg2.#\/artifactory\/hotelresource\/hotelpicture\/93\/30168893\/300200_193527624",
                "title": "\u5e7f\u5dde\u767d\u4e91\u6e56\u7554\u9152\u5e97",
                "desc": "\u767d\u4e91\u533a\u540c\u548c\u8def783\u53f7(\u8fd1\u5357\u6e56\u6e38\u4e50\u56ed)",
                "currency": "$",
                "price": null,
                "lowprice": null,
                "tourary": "",
                "url": "http:\/\/hotel.#\/detail\/30168893.html",
                "star": 1,
                "backPrice": null,
                "sellNum": 0
            }, {
                "gid": "30001746",
                "img": "http:\/\/himg2.#\/artifactory\/hotelresource\/hotelpicture\/46\/30001746\/300200_2492069617",
                "title": "\u5e7f\u5dde\u756a\u79ba\u5bbe\u9986",
                "desc": "\u756a\u79ba\u533a\u5e02\u6865\u8857\u5927\u5317\u8def130\u53f7(\u756a\u79ba\u5e02\u6865,\u8fd1\u957f\u9686\u5ea6\u5047\u533a,\u4e9a\u8fd0\u57ce,\u8fd1\u53cb\u8c0a\u4e2d\u5fc3)",
                "currency": "\u00a5",
                "price": 488,
                "lowprice": 488,
                "tourary": "\u6807\u51c6\u5927\u5e8a\u623f",
                "url": "http:\/\/hotel.#\/detail\/30001746.html",
                "star": "4",
                "backPrice": 29,
                "sellNum": 0
            }, {
                "gid": "30002277",
                "img": "http:\/\/himg2.#\/artifactory\/hotelresource\/hotelpicture\/77\/30002277\/300200_2458873525",
                "title": "\u5e7f\u5dde\u4e1c\u65b9\u5bbe\u9986",
                "desc": "\u8d8a\u79c0\u533a\u6d41\u82b1\u8def120\u53f7(\u8fd1\u706b\u8f66\u7ad9,\u8d8a\u79c0\u516c\u56ed,\u6d41\u82b1\u516c\u56ed,\u5730\u94c12\u53f7\u7ebf\u8d8a\u79c0\u516c\u56ed\u7ad9D1\u51fa\u53e3)",
                "currency": "\u00a5",
                "price": 638,
                "lowprice": 638,
                "tourary": "\u8c6a\u534e\u623f",
                "url": "http:\/\/hotel.#\/detail\/30002277.html",
                "star": "5",
                "backPrice": 51,
                "sellNum": 0
            }, {
                "gid": "30073152",
                "img": "http:\/\/himg2.#\/artifactory\/hotelresource\/hotelpicture\/52\/30073152\/300200_5132786881",
                "title": "\u5e7f\u5dde\u661f\u6cb3\u6e7e\u9152\u5e97",
                "desc": "\u5e7f\u5dde\u5e02\u756a\u79ba\u533a\u756a\u79ba\u5927\u9053\u53171\u53f7(\u8fd1\u957f\u9686\u666f\u533a,\u8fd1\u5e7f\u5dde\u5357\u7ad9\u53ca\u7436\u6d32\u4f1a\u5c55\u4e2d\u5fc3)",
                "currency": "\u00a5",
                "price": 1028,
                "lowprice": 1028,
                "tourary": "\u8c6a\u534e\u623f\uff08\u6c5f\u666f\uff09",
                "url": "http:\/\/hotel.#\/detail\/30073152.html",
                "star": "5",
                "backPrice": 82,
                "sellNum": 0
            }],
            "\u6df1\u5733": [{
                "gid": "30172150",
                "img": "http:\/\/himg2.#\/artifactory\/hotelresource\/hotelpicture\/50\/30172150\/300200_2228326809",
                "title": "\u6df1\u5733\u5927\u6885\u6c99\u4eac\u57fa\u6d77\u6e7e\u5927\u9152\u5e97",
                "desc": "\u76d0\u7530\u533a\u76d0\u6885\u8def90\u53f7(\u5185\u73af\u8def\u4e0e\u613f\u671b\u6e56\u4ea4\u754c)",
                "currency": "$",
                "price": null,
                "lowprice": null,
                "tourary": "",
                "url": "http:\/\/hotel.#\/detail\/30172150.html",
                "star": 1,
                "backPrice": null,
                "sellNum": 0
            }, {
                "gid": "30251031",
                "img": "http:\/\/himg2.#\/artifactory\/hotelresource\/hotelpicture\/31\/30251031\/300200_9333687",
                "title": "\u6df1\u5733\u56de\u9152\u5e97",
                "desc": "\u798f\u7530\u533a\u7ea2\u8354\u8def3015\u53f7(\u7ea2\u8354\u8def\u4e0e\u534e\u5bcc\u8def\u4ea4\u6c47\u5904)",
                "currency": "\u00a5",
                "price": 1088,
                "lowprice": 1088,
                "tourary": "\u56de\u60a6\u8c6a\u534e\u5ba2\u623f",
                "url": "http:\/\/hotel.#\/detail\/30251031.html",
                "star": 1,
                "backPrice": 65,
                "sellNum": 0
            }, {
                "gid": "30172883",
                "img": "http:\/\/himg2.#\/artifactory\/hotelresource\/hotelpicture\/83\/30172883\/300200_2338806001",
                "title": "\u6df1\u5733\u6052\u4e30\u6d77\u60a6\u56fd\u9645\u9152\u5e97",
                "desc": "\u5b9d\u5b89\u533a\u5b9d\u57ce\u516b\u5341\u533a\u65b0\u57ce\u5e7f\u573a(\u5b9d\u5b89\u4e2d\u5fc3\u533a,\u8fd1\u673a\u573a,\u897f\u4e61\u9547\u653f\u5e9c)",
                "currency": "\u00a5",
                "price": 550,
                "lowprice": 550,
                "tourary": "\u9650\u91cf\u7279\u60e0\u623f\uff08\u65e0\u7a97\uff09",
                "url": "http:\/\/hotel.#\/detail\/30172883.html",
                "star": "5",
                "backPrice": 32,
                "sellNum": 0
            }, {
                "gid": "30173554",
                "img": "http:\/\/himg2.#\/artifactory\/hotelresource\/hotelpicture\/54\/30173554\/300200_2416118961",
                "title": "\u6df1\u5733\u4e1c\u90e8\u534e\u4fa8\u57ce\u7011\u5e03\u9152\u5e97",
                "desc": "\u76d0\u7530\u533a\u5927\u6885\u6c99\u4e1c\u90e8\u534e\u4fa8\u57ce\u5927\u4fa0\u8c37(\u5c71\u811a\u4e0b)",
                "currency": "$",
                "price": null,
                "lowprice": null,
                "tourary": "",
                "url": "http:\/\/hotel.#\/detail\/30173554.html",
                "star": 1,
                "backPrice": null,
                "sellNum": 0
            }, {
                "gid": "30000831",
                "img": "http:\/\/himg2.#\/artifactory\/hotelresource\/hotelpicture\/31\/30000831\/300200_868142048",
                "title": "\u6df1\u5733\u9633\u5149\u9152\u5e97",
                "desc": "\u7f57\u6e56\u533a\u5609\u5bbe\u8def2001\u53f7(\u56fd\u8d38\u5927\u53a6\u65c1 \u8fd1\u4e1c\u95e8\u5546\u5708 \u91d1\u5149\u534e\u9644\u8fd1)",
                "currency": "\u00a5",
                "price": 598,
                "lowprice": 598,
                "tourary": "\u6807\u51c6\u623f\uff08\u65e0\u7a97\uff09",
                "url": "http:\/\/hotel.#\/detail\/30000831.html",
                "star": "5",
                "backPrice": 35,
                "sellNum": 0
            }],
            "more": "http:\/\/hotel.#\/index.html"
        };

        seajs.use(['jquery', 'right', 'handlebars'], function (jq, right, hlb) {

            //right.linkHotelClickAction();

            right.init();

        })
    </script>
    <div class="clear"></div>
</div>
<!-- ������� start -->
<div id="partner_box">
    <div id="partner">
        <div class="partner_top">
            <span class="partner_title">�������</span>
            <span class="partner_border"></span>
        </div>
        <img src="/themes/s01/images/partner.png" style="margin:20px auto 0;display:block;width: 1190px;">
    </div>
</div>
<!-- ������� end -->
<script>
    seajs.use([''], function () {
        $('.side-gotop').click(function () {
            $('body,html').stop().animate({scrollTop: 0}, 750);
            return false;
        });
    });

    function afterMemberLogin() {
        seajs.use(['rightSide'], function (rightSide) {
            rightSide.update();
            location.reload();
        })
    }
</script>
<div class="clear"></div>

<? include('foot.php'); ?>
</body>
</html>
