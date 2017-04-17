<?
if(!defined('IN_CLOOTA')) {
    exit('Access Denied');
}

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/themes/s01/images/tianxie.css">
<title>周边游订单</title>
</head>
<?include('static.php');?>
<?include 'head.php';?>

<?
//var_dump($_REQUEST);
//echo $goods_type."<hr>";
//echo $goods_id."<hr>";
//echo $adult_num."<hr>";
//echo $kid_num."<hr>";
//echo $departdate."<hr>";
//echo $goods_name."<hr>";
//echo $pay_price."<hr>";

//RewriteRule ^zhoubianyou/zbyform_submit-(.*)-(.*)-(.*)-(.*)-(.*)-(.*)-(.*).html$    index\.php?cmd=zbyform_submit&goods_type=$1&goods_id=$2&goods_name=$3&adult_num=$4&kid_num=$5&departdate=$6&payPrice=$7 [L]
?>
<body>
<!-- main start -->
<!--<form name="write_form" id="write_form" method="post" action="/member/?cmd=--><?//=base64_encode('zhifu.php');?><!--">-->
<!-- <form name="write_form" id="write_form" method="post" action="zbyonline_pay.html"> -->
<div id="zbyOrder_mainBox">
    <div id="zbyOrder_main">
        <div class="zbyOrder_main_title">
            <img src="/themes/s01/images/zby_fillInOrder.jpg">
        </div>
<!--        <form name="write_form" id="write_form" method="post" action="/zhoubianyou/zbyonline_pay.html">-->
        <form name="write_form" id="write_form" method="post" action="/zhoubianyou/zbyform_submit-<?=$goods_type;?>-<?=$goods_id;?>-<?=$goods_name;?>-<?=$adult_num;?>-<?=$kid_num;?>-<?=$departdate;?>-<?=$pay_price;?>.html?flag=check">
            <div class="zbyOrder_main1">
                <div class="zbyOrder_main1_title">
                    <?echo $goods_name;?>
                </div>
                <div class="zbyOrder_main1Cont">
                    <div class="zbyOrder_main1ContLeft">当地游</div>
                    <div class="zbyOrder_main1ContRight">
                        <table>
                            <thead>
                            <tr>
                                <td>产品信息</td>
                                <td>游玩时间</td>
                                <td>人数</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>成人</td>
                                <td>
                                    <?echo $departdate1;?>
                                </td>
                                <td>
											<span class="caculate">
												<span class="subtract">-</span>
												<span class="counts"><?php echo $adult_num;?></span>
												<span class="add">+</span>
											</span>
                                </td>
                            </tr>
                            <tr>
                                <td>儿童</td>
                                <td>
                                    <?echo $departdate1;?>
                                </td>
                                <td>
											<span class="caculate">
												<span class="subtract">-</span>
												<span class="counts"><?php echo $kid_num;?></span>
												<span class="add">+</span>
											</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="zbyOrder_main2">
                <div class="zbyOrder_main2_title">联系人信息</div>

                <div class="zbyOrder_main2_buy">
                    <div class="zbyOrder_main2_buyLeft">购买人</div>
                    <div class="zbyOrder_main2_buyRight">
                        <ul>
                            <li>
                                <label><b>＊</b>姓名：</label>
                                <input type="text" name="linker" id="linker" value="">
                                <span class="buyer_nameTips">购买人姓名不能为空！</span>
                            </li>
                            <li>
                                <label><b>＊</b>手机号码：</label>
                                <input type="text" name="mobile" id="mobile" value="">
                                <span>此手机为接受短信所用，作为订购于取票凭证，请准确填写。</span>
                                <span class="buyer_phoneTips">购买人手机号不能为空！</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="zbyOrder_main2_youwan">
                    <div class="zbyOrder_main2_youwanLeft">游玩人1</div>
                    <div class="zbyOrder_main2_youwanRight">
                        <ul>
                            <li>
                                <label><b>＊</b>姓名：</label>
                                <input type="text" name="userName" autocomplete="off" id="youwan_userName">
                                <span class="youwan_nameTips">游玩人姓名不能为空！</span>
                            </li>
                            <li>
                                <label><b>＊</b>手机号码：</label>
                                <input type="text" name="userPhone" autocomplete="off" id="youwan_userPhone">
                                <span class="youwan_phoneTips">游玩人手机号不能为空！</span>
                            </li>
                            <li>
                                <label><b>＊</b>证件类型：</label>
                                <select style="width: 138px;" name="userIdcard">
                                    <option>身份证</option>
                                    <option>户口本</option>
                                </select>
                                <input type="text" name="userIdcard" autocomplete="off"  id="youwan_userIdcard">
                                <span class="youwan_idTips">游玩人证件号不能为空！</span>
                            </li>
                        </ul>
                    </div>
                </div>
<!--                <div class="zbyOrder_main2_youwan">-->
<!--                    <div class="zbyOrder_main2_youwanLeft">游玩人1</div>-->
<!--                    <div class="zbyOrder_main2_youwanRight">-->
<!--                        <ul>-->
<!--                            <li>-->
<!--                                <label><b>＊</b>姓名：</label>-->
<!--                                <input type="text" name="userName" autocomplete="off">-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <label><b>＊</b>手机号码：</label>-->
<!--                                <input type="text" name="userPhone" autocomplete="off">-->
<!--                                <span></span>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <label><b>＊</b>证件类型：</label>-->
<!--                                <select style="width: 138px;" name="userIdcard">-->
<!--                                    <option>身份证</option>-->
<!--                                    <option>户口本</option>-->
<!--                                </select>-->
<!--                                <input type="text" name="userIdcard" autocomplete="off">-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
            </div>

            <input type="hidden" name="goodsId" value="<?echo $goods_id;?>">
            <input type="hidden" name="userId" value="<?echo $user_id;?>">
            <input type="hidden" name="kidNum" class="Num" value="<?php echo $kid_num;?>">
            <input type="hidden" name="adultNum" class="Num" value="<?php echo $adult_num;?>">
            <input type="hidden" name="payPrice" value="<?echo $pay_price;?>">
            <input type="hidden" name="departdate" value="<?echo $departdate1;?>">
        </form>

        <form action="<?=$g_self_domain?>/zhoubianyou/zbyonline_pay-<?=$orderCode;?>.html" method="post" id="onlineForm">
            <input type="hidden" name="payPrice" id="payPrice" value="<?=$payPrice?>">
            <input type="hidden" name="goodsName" id="goodsName" value="<?=$goodsName?>">
            <input type="hidden" name="payTime" id="payTime" value="<?=$payTime?>">
        </form>
        <?
        if (notnull($check_form_data)){
            $js = "<script>document.getElementById('onlineForm').submit();</script>";
            echo $js;
        }
        ?>
            <div class="zbyOrder_main3">
                <div class="zbyOrder_main31">
                    <div class="zbyOrder_main31_left">应付总价：￥<?echo $pay_price;?></div>
<!--                    <div ><input value="同意以下条款，去付款" type="submit" class="zbyOrder_main31_right"></div>-->
<!--                    <div ><button onclickclass="onlinePay_payNow" onclick = "check_form()" >同意以下条款，去付款</button></div>-->
                    <button class="zbyOrder_main31_right" onclick = "check_form()">同意以下条款，去付款</button>

                </div>
                <div class="zbyOrder_main32">
                    <label>我已同意以下条款</label>
                    <input type="checkbox" name="我已同意以下条款">
                    <label>同意团队境内旅游合同</label>
                    <input type="checkbox" name="同意团队境内旅游合同">
                </div>
                <div class="zbyOrder_main33">
                    温馨提示：请您仔细阅读预订须知及旅游合同条款，订单提交后，视为您同意以下各项条款内容
                </div>
            </div>
        <!-- </form> -->
        <div class="zbyOrder_main4">
            <div class="zbyOrder_main4_title">预订须知</div>
<!--            <div class="zbyOrder_main4_cont">-->
<!--                <span>费用包含</span>-->
<!--                <dl>-->
<!--                    <dt>套餐1:经典双人套餐</dt>-->
<!--                    <dd>【玩】：宋城景区+千古情演出贵宾席门票2张</dd>-->
<!--                    <dd>【住】：宋城千古情主题酒店大/双床房</dd>-->
<!--                    <dd>【吃】：中式自助早2份</dd>-->
<!--                </dl>-->
<!--                <dl>-->
<!--                    <dt>套餐1:经典双人套餐</dt>-->
<!--                    <dd>【玩】：宋城景区+千古情演出贵宾席门票2张</dd>-->
<!--                    <dd>【住】：宋城千古情主题酒店大/双床房</dd>-->
<!--                    <dd>【吃】：中式自助早2份</dd>-->
<!--                </dl>-->
<!--                <dl>-->
<!--                    <dt>套餐1:经典双人套餐</dt>-->
<!--                    <dd>【玩】：宋城景区+千古情演出贵宾席门票2张</dd>-->
<!--                    <dd>【住】：宋城千古情主题酒店大/双床房</dd>-->
<!--                    <dd>【吃】：中式自助早2份</dd>-->
<!--                </dl>-->
<!--                <dl>-->
<!--                    <dt>套餐1:经典双人套餐</dt>-->
<!--                    <dd>【玩】：宋城景区+千古情演出贵宾席门票2张</dd>-->
<!--                    <dd>【住】：宋城千古情主题酒店大/双床房</dd>-->
<!--                </dl>-->
<!--                <dl>-->
<!--                    <dt>套餐1:经典双人套餐</dt>-->
<!--                    <dd>【玩】：宋城景区+千古情演出贵宾席门票2张</dd>-->
<!--                    <dd>【吃】：中式自助早2份</dd>-->
<!--                </dl>-->
<!--                <dl>-->
<!--                    <dt>套餐1:经典双人套餐</dt>-->
<!--                    <dd>【玩】：宋城景区+千古情演出贵宾席门票2张</dd>-->
<!--                    <dd>【住】：宋城千古情主题酒店大/双床房</dd>-->
<!--                </dl>-->
<!--            </div>-->
            <?
//            $html = file_get_contents($product_detail_data['orderNoteLink']);
//            $html = file_get_contents('http://wwwd.bus365.cn/travel/interface/zby/getZbyOrderNote?goodsId=8000000&charset=gbk');

//            echo $html;
            ?>

        </div>
    </div>
</div>
<!-- </form> -->
<!-- main end -->

	<!--  foot  start -->
    <?include 'foot.php';?>
<!--	<!--  foot  end -->-->
</body>
<script type="text/javascript" src="/themes/s01/js/jquery.js"></script>
<script type="text/javascript" src="/themes/s01/js/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){

	var adds = $('.add');
	for (var i = 0; i < adds.length; i++) {
		adds[i].index = i;
		adds[i].onclick = function(){
			var count1 = $('.counts').eq(this.index).html();
			count1++;
			$('.counts').eq(this.index).html(count1);

		};
	}
	var subtracts = $('.subtract');
	for (var i = 0; i < subtracts.length; i++) {
		subtracts[i].index = i;
		subtracts[i].onclick = function(){
			var count1 = $('.counts').eq(this.index).html();
			if(count1!=1){
				count1--;
				$('.counts').eq(this.index).html(count1);
			}
		};
	}


});

//表单合发性验证
var reg1 = /^([\u4e00-\u9fa5]){2,6}$/;//匹配中文
var reg2 = /^13[0-9]{9}$|14[0-9]{9}|15[0-9]{9}$|18[0-9]{9}$/;//匹配手机号
var reg3 = /(^\d{15}$)|(^\d{17}(\d|X)$)/;//匹配身份证
var buyerName_flag=0,
    buyerPhone_flag=0,
    // phoneNum_flag=0,
    // idNum_flag=0,
    // email_flag=0,
    // tiaokuan_flag=1
    youwanName_flag=0,
    youwanPhone_flag=0,
    youwanIdNum_flag=0
    ;


$('#linker').blur(function(){
    if($('#linker').val()==''){
        $('.buyer_nameTips').show();
        buyerName_flag=0;
    }else{
        $('.buyer_nameTips').hide();
        buyerName_flag=1;
    }
});
$('#mobile').blur(function(){
    if($('#mobile').val()==''){
        $('.buyer_phoneTips').show().html('购买人手机号不能为空');
    }else if(reg2.test($('#mobile').val())){
        $('.buyer_phoneTips').show();
        $('.buyer_phoneTips').html('');
        buyerPhone_flag=1;
    }else if(!reg2.test($('#mobile').val())){
        $('.buyer_phoneTips').show();
        $('.buyer_phoneTips').html('请输入正确的手机号！');
        buyerPhone_flag=0;
    }
});

$('#youwan_userName').blur(function(){
    if($('#youwan_userName').val()==''){
        $('.youwan_nameTips').show();
        youwanName_flag=0;
    }else{
        $('.youwan_nameTips').hide();
        youwanName_flag=1;
    }
});
$('#youwan_userPhone').blur(function(){
    if($('#youwan_userPhone').val()==''){
        $('.youwan_phoneTips').show().html('游玩人手机号不能为空');
    }else if(reg2.test($('#youwan_userPhone').val())){
        $('.youwan_phoneTips').show();
        $('.youwan_phoneTips').html('');
        youwanPhone_flag=1;
    }else if(!reg2.test($('#youwan_userPhone').val())){
        $('.youwan_phoneTips').show();
        $('.youwan_phoneTips').html('请输入正确的手机号！');
        youwanPhone_flag=0;
    }
});
$('#youwan_userIdcard').blur(function(){
    if($('#youwan_userIdcard').val()==''){
        $('.youwan_idTips').show().html('游玩人证件号不能为空');
    }else if(reg3.test($('#youwan_userIdcard').val())){
        $('.youwan_idTips').show();
        $('.youwan_idTips').html('');
        youwanIdNum_flag=1;
    }else if(!reg3.test($('#youwan_userIdcard').val())){
        $('.youwan_idTips').show();
        $('.youwan_idTips').html('请输入正确的证件号！');
        youwanIdNum_flag=0;
    }
});

function check_form(){
    if($('.zbyOrder_main32 input').eq(0).attr('checked')&&$('.zbyOrder_main32 input').eq(1).attr('checked')){
    // alert(buyerName_flag+'----'+buyerPhone_flag+'----'+youwanName_flag+'----'+youwanPhone_flag+'----'+youwanIdNum_flag);
        document.getElementById("write_form").submit();
    }
    
//    var url="";
//  url = "/member/?cmd=<?//=base64_encode('zhifu.php')?>//&goodsId=<?//echo $goods_id;?>//&userId=<?//echo $user_id;?>//&kidNum=<?php //echo $kid_num;?>//&adultNum=<?php //echo $adult_num;?>//&payPrice=<?//echo $pay_price;?>//&departdate=<?//echo $departdate;?>//";
//    url += "&linker="+$('#linker').val();
//    url += "&mobile="+$('#mobile').val();
////    url = "/member/?cmd='zhifu.php'";
//    window.top.location.href = url;
    //document.getElementById("write_form").submit();
}


</script>
</html>