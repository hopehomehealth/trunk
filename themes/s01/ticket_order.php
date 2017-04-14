<!DOCTYPE html>
<html>
<head>
    <? seo(); ?>
    <? include('meta.php'); ?>
    <? include "head.php" ?>
    <? include('static.php'); ?>
    <? load_mobile('http://' . $g_config['mobile_domain'] . '/menpiao/detail-' . $c_goods_id . '.html'); ?>
    <title>门票订单</title>
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/common.css">
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/menpiaotianxiedingdan.css">
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/bootstrap-datepicker.css">
    <script type="text/javascript" src="/member/plugin?cmd=browse&goods_id=<?= $c_goods_id ?>"></script>
</head>
<body>
<!-- main内容 start -->
<div id="fillInOrder_mainBox">
    <div class="fillInOrder_main_title">
        <img src="/themes/s01/images/fillInOrder_process1.jpg">
    </div>
    <!--    <div class="fillInOrder_main_loginTips">-->
    <!--        您当前未登录，如您是BUS365会员，登录后可使用账户中优惠券，奖金以及存款。-->
    <!--    </div>-->
    <form name="form1" action="/menpiao/ticket_online_pay-1.html" method="post" class="ticket_order_form1">

        <div id="fillInOrder_main">
            <div class="fillInOrder_main1">
                <div class="fillInOrder_main1_title">
                    <?= $lvGoodsName ?><span>在线支付</span>
                </div>
                <div class="spotInfo">
                    <span class="spotInfo_title"><?= $ticketTypeName ?></span>
                    <span class="subtriangle zhankai">&nbsp;&nbsp;</span>
                    <span class="returnAllTime">随时退</span>
                </div>
                <div class="fillInOrder_dateBox" style="position: relative;">
                    <label>日&nbsp;&nbsp;&nbsp;期</label>
                    <!--                 价格日历 -->
                    <input type="text" name="date" id="datepicker"
                           style="width: 200px;height: 36px;display: inline-block;border:solid 1px #ddd;"
                           placeholder="请选择游玩日期" readonly>
                    <div id="cal-loading~" class="cal-loading"
                         style="height:auto;width: 560px;position:absolute;left:370px;top:25px;padding-bottom:10px;<? if ($c_goods['goods_type'] == '3') { ?>display:none<? } ?>">
                        <link type="text/css" rel="stylesheet" href="/themes/s01/images/calendar.css">
                        <div id="v_calendar" style="height:auto;display:none;width: 560px;border:solid 1px #ddd;">
                            <div id="date_price"></div>
                        </div>
                    </div>
                </div>
                <div class="fillInOrder_count">
                    <label>数&nbsp;&nbsp;&nbsp;量</label>
                    <span class="subtract">-</span>
                    <span class="counts">1</span>
                    <span class="add">+</span>
                </div>
            </div>
            <div class="fillInOrder_main2">
                <div class="fillInOrder_main2_title">
                    用户信息 <span>您需要填写1个游玩人的信息</span>
                </div>
                <div class="tripPeople">
                    <div class="tripPeople_left">
                        <label>游玩人</label><span>取票人</span>
                    </div>
                </div>
                <div class="fillInOrder_main2_infoForm">
                    <div class="infoForm_name">
                        <label class="required">姓名：</label>
                        <input type="text" name="name" autocomplete="off" placeholder="请输入姓名" id="zh_ipt">
                        <span class="zh_tips">请输入合法的姓名！</span>
                    </div>
                    <div class="infoForm_phoneNum">
                        <label class="required">手机号码：</label>
                        <input type="text" name="phone" autocomplete="off" placeholder="请输入手机号" id="phone_num_ipt">
                        <!--                        <span>订单信息会发送至您的手机，请保持手机畅通。</span>-->
                        <span class="phoneNum_tips">请输入合法的手机号码！</span>
                    </div>
                    <? if ($isEmail == 'TRAV_NUM_ONE') { ?>
                        <div class="infoForm_phoneNum">
                            <label class="required">邮箱：</label>
                            <input type="text" name="email" autocomplete="off" placeholder="请输入邮箱" id="email_ipt">
                            <span class="email_tips">请输入合法的邮箱！</span>
                        </div>
                    <? } ?>
                    <!--                --><? //if ($isCredentials == 'TRAV_NUM_ONE'){?>
                    <div class="infoForm_phoneNum">
                        <label class="required">身份证号：</label>
                        <input type="text" name="idcard" autocomplete="off" placeholder="请输入身份证号" id="idNum_ipt">
                        <span class="idNum_tips">请输入有效身份证号码！</span>
                    </div>
                    <!--                --><? //}?>
                    <div class="infoForm_check">
                        <label class="required">验证码：</label>
                        <input type="text" name="code" autocomplete="off" placeholder="请输入验证码" id="yzm_ipt">
                        <img src="/libs/code.php" id="code"
                             onclick="javascript:this.src='/libs/code.php?rnd='+Math.random()"/>
                        <span class="yzm_tips">请输入验证码！</span>
                        <!--                    <a href="/libs/code.php?rnd='+Math.random()">看不清，换一个</a>-->
                    </div>
                    <div>
                        <input type="hidden" name="lvGoodsName" value="<?= $lvGoodsName ?>">
                        <input type="hidden" name="ticketType" value="<?= $ticketType ?>">
                        <input type="hidden" name="goodsId" value="<?= $goodsId ?>">
                        <input type="hidden" name="lvProductId" value="<?= $lvProductId ?>">
                        <input type="hidden" name="lvGoodsId" value="<?= $lvGoodsId ?>">
                        <input type="hidden" name="danjias" id="danjias" value="">
                        <input type="hidden" name="shuliangs" id="shuliangs" value="">
                    </div>
                </div>
            </div>
            <div class="fillInOrder_main3">
                <div class="fillInOrder_main3_title">
                    费用明细 <span></span>
                </div>

                <div class="spotPrice">
                    <div class="spotPrice_top">
                        <dl>
                            <dt>门票价格</dt>
                            <dd class="danjia">&yen;0</dd>
                        </dl>
                    </div>
                    <div class="spotPrice_under">
                        <dl>
                            <dt><?= $lvGoodsName ?></dt>
                            <dd class="danjia1">1 x &yen;0</dd>
                        </dl>
                    </div>
                </div>
                <dl>
                    <dt>应付金额</dt>
                    <dd class="totalPrice" style="font-size: 26px;font-weight: bold;">&yen;0</dd>
                </dl>

            </div>
        </div>
    </form>
    <div class="fillInOrder_main4">
        <button>提交订单</button>
        <div class="fillInOrder_main4_agree">
            <input type="checkbox" name="" checked="checked">
            <span>已阅读并同意</span>
            <a href="<?=$g_self_domain?>/menpiao/xy.html" target="_blank">旅游网预订条款</a>
        </div>
    </div>
</div>

<!-- main内容 end -->


<!--  foot  start -->
<? include "foot.php" ?>
<!--  foot  end -->
</body>
<script type="text/javascript" src="/themes/s01/js/jquery.js"></script>
<script type="text/javascript" src="/themes/s01/js/common.js"></script>
<script type="text/javascript" src="/themes/s01/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="/themes/s01/js/menpiaotianxiedingdan.js"></script>
<input type="hidden" id="zongjia">
<script type="text/javascript">
    var counts = $('.counts').html();
    var singlePrice = 0;
    $("#shuliangs").val(counts);

    function change_calendar(yyyy, mm) {
        if(mm<(new Date().getMonth() + 1)){
            return;
        }else{
            var v_url = "";
            v_url = "/member/ajax.calendars.php?rnd=" + Math.random();
            v_url += "&goods_id=" + <?=$goodsId?>;
            v_url += "&lvProductId=" + <?=$lvProductId?>;
            v_url += "&lvGoodsId=" + <?=$lvGoodsId?>;
            v_url += "&yyyy=" + yyyy;
            v_url += "&mm=" + mm;
            var html_calendar = $.ajax({url: v_url, async: false});
            $("#date_price").html(html_calendar.responseText);
            $('.date_blue').click(function () {
                if ($(this).find('.date_yen').eq(0).html() != "") {
                    $('#datepicker').val(yyyy + '-' + mm + '-' + $(this).html().split("<br>")[0]);
                    var $price1 = $(this).find('.date_yen').eq(0).html().split('</span>')[1].slice(1).split('/人')[0];
                    $('#zongjia').val($price1);
                    singlePrice = $('#zongjia').val();
                    $('.danjia').html("&yen;" + $price1);
                    $('.danjia1').html($('.counts').html() + "x &yen;" + $price1);
                    $('.totalPrice').html($('.counts').html() * $price1);
                    $('#v_calendar').hide();
                    $("#danjias").val(singlePrice);
                }
            });
        }
    }
    change_calendar(<?=date("'Y','m'")?>);
    $('#datepicker').focus(function () {
        $('#v_calendar').show();
        $(document).click(function(event){
            var clickObj = event.srcElement || event.target;
            if($(clickObj).attr("id") == "cal-loading~"||$(clickObj).attr("id")=="datepicker"||$(clickObj).attr("id")=="v_calendar"||$(clickObj).attr("alt")=='前一月'||$(clickObj).attr("alt")=='后一月'){
                
            }else{
                $('#v_calendar').hide();
            }
        });
    });
    
    $('.add').click(function () {
        counts++;
        $('.counts').html(counts);
        $('.danjia1').html(counts + "x &yen;" + singlePrice);
        $('.totalPrice').html(counts * singlePrice);
        $("#shuliangs").val(counts);
        $("#danjias").val(singlePrice);
    });
    $('.subtract').click(function () {
        if (counts == 1) {

        } else {
            counts--;
            $('.counts').html(counts);
            $('.totalPrice').html(counts * singlePrice);
            $('.danjia1').html(counts + "x &yen;" + singlePrice);
            $('.totalPrice').html(counts * singlePrice);
            $("#shuliangs").val(counts);
            $("#danjias").val(singlePrice);
        }
    });


    //表单合法性验证
    var reg1 = /^([\u4e00-\u9fa5]){2,6}$/;//匹配中文
    var reg2 = /^1[34578]\d{9}$/;//匹配手机号
    var reg3 = /(^\d{15}$)|(^\d{17}(\d|X)$)/;//匹配身份证
    var reg4 = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;//匹配邮箱

    var date_flag = 0, zh_flag = 0, phoneNum_flag = 0, idNum_flag = 0, email_flag = 0, tiaokuan_flag = 1, yzm_flag = 0;

    $('#zh_ipt').blur(function () {
        if ($('#zh_ipt').val() == '') {
            $('.zh_tips').show();
            $('.zh_tips').html('姓名不能为空！');
            zh_flag = 0;
        } else if (reg1.test($('#zh_ipt').val())) {
            $('.zh_tips').show();
            $('.zh_tips').html('');
            zh_flag = 1;
        } else if (!reg1.test($('#zh_ipt').val())) {
            $('.zh_tips').show();
            $('.zh_tips').html('请输入合法的姓名！');
            zh_flag = 0;
        }

    });
    $('#phone_num_ipt').blur(function () {
        if ($('#phone_num_ipt').val() == '') {
            $('.phoneNum_tips').show();
            $('.phoneNum_tips').html('手机号不能为空！');
            phoneNum_flag = 0;
        } else if (reg2.test($('#phone_num_ipt').val())) {
            $('.phoneNum_tips').show();
            $('.phoneNum_tips').html('');
            phoneNum_flag = 1;
        } else if (!reg2.test($('#phone_num_ipt').val())) {
            $('.phoneNum_tips').show();
            $('.phoneNum_tips').html('请输入正确的手机号！');
            phoneNum_flag = 0;
        }

    });
    $('#email_ipt').blur(function () {
        if ($('#email_ipt').val() == '') {
            $('.email_tips').show();
            $('.email_tips').html('邮箱不能为空！');
            email_flag = 0;
        } else if (reg4.test($('#email_ipt').val())) {
            $('.email_tips').show();
            $('.email_tips').html('');
            email_flag = 1;
        } else if (!reg4.test($('#email_ipt').val())) {
            $('.email_tips').show();
            $('.email_tips').html('请输入正确的邮箱！');
            email_flag = 0;
        }

    });
    $('#idNum_ipt').blur(function () {
        if ($('#idNum_ipt').val() == '') {
            $('.idNum_tips').show();
            $('.idNum_tips').html('身份证不能为空！');
            idNum_flag = 0;
        } else if (reg3.test($('#idNum_ipt').val())) {
            $('.idNum_tips').show();
            $('.idNum_tips').html('');
            idNum_flag = 1;
        } else if (!reg3.test($('#idNum_ipt').val())) {
            $('.idNum_tips').show();
            $('.idNum_tips').html('请输入正确的身份证号码！');
            idNum_flag = 0;
        }

    });

    $('.fillInOrder_main4_agree input').change(function () {
        if ($('.fillInOrder_main4_agree input').attr('checked')) {
            tiaokuan_flag = 1;
        } else {
            tiaokuan_flag = 0;
        }
    });

    //设置局部刷新
    function code() {
        var code = document.getElementByIdx_x_x('code');
        code.onclick = function () {
            this.src = '/libs/code.php?rnd=' + Math.random();
        };
    }
    ;
    //验证验证码
    $('#yzm_ipt').blur(function () {
        var yzm = $("#yzm_ipt").val();
        $.ajax({
            type: "post",
            url: "/libs/codes.php",
            data: {
                "yzm": yzm
            },
            success: function (data) {
                if (yzm == '') {
                    $('.yzm_tips').show();
                    $('.yzm_tips').html('验证码不能为空！');
                    yzm_flag = 0;
                } else if (yzm == data) {
                    $('.yzm_tips').show();
                    $('.yzm_tips').html('');
                    yzm_flag = 1;
                } else if (yzm != data) {
                    $('.yzm_tips').show();
                    $('.yzm_tips').html('请输入正确的验证码！');
                    yzm_flag = 0;
                }
            }
        })
    });


    $('.fillInOrder_main4 button').click(function () {
        if ($('#datepicker').val() != '') {
            date_flag = 1;
        } else {
            date_flag = 0;
        }
        if (date_flag == 1 && zh_flag == 1 && phoneNum_flag == 1 && idNum_flag == 1 && tiaokuan_flag == 1 && yzm_flag == 1) {
            $('.ticket_order_form1').submit();
        } else {
            if (zh_flag == 0) {
                $('.zh_tips').show();
                $('.zh_tips').html('请输入合法的姓名！');
            }
            if (phoneNum_flag == 0) {
                $('.phoneNum_tips').show();
                $('.phoneNum_tips').html('请输入正确的手机号！');
            }
            if (idNum_flag == 0) {
                $('.idNum_tips').show();
                $('.idNum_tips').html('请输入正确的身份证号码！');
            }
            if (yzm_flag == 0) {
                $('.yzm_tips').show();
                $('.yzm_tips').html('请输入正确的验证码！');
            }
            if ($('#datepicker').val() == '') {
                alert('日期不能为空！');
            }
        }
    });
</script>


</html>