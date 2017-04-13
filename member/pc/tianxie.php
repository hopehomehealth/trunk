<?
if(!defined('IN_CLOOTA')) {
    exit('Access Denied');
}
?>
<link rel="stylesheet" type="text/css" href="/themes/s01/images/tianxie.css">

<?include 'head.php';?>

<?
$goods_type = req('goods_type');
$goods_id = req('goods_id');
$adult_num = req('adult_num');
$kid_num = req('kid_num');
$departdate = req('departdate');
$departdate = substr($departdate,0,4).'-'.substr($departdate,4,2).'-'.substr($departdate,6,2);
$goods_name = req('goods_name');
$pay_price = req('payPrice');
$user_id = req('user_id');
//var_dump($_REQUEST);
echo $goods_type."<hr>";
echo $goods_id."<hr>";
echo $adult_num."<hr>";
echo $kid_num."<hr>";
echo $departdate."<hr>";
echo $goods_name."<hr>";
echo $pay_price."<hr>";
?>
<!-- main start -->
<!--<form name="write_form" id="write_form" method="post" action="zhougbianyou/zbyform_submit-(.*)-(.*)-(.*)-(.*)-(.*)-(.*).html">-->
<div id="zbyOrder_mainBox">
    <div id="zbyOrder_main">
        <div class="zbyOrder_main_title">
            <img src="/themes/s01/images/zby_fillInOrder.jpg">
        </div>

         <form name="order_form" id="write_form" method="post" action="/member/?cmd=<?=base64_encode('zhifu.php')?>">
<!--        <form name="write_form" id="write_form" method="post" action="--><?//=url('zhifu.php');?><!--">-->
            <input type="hidden" name="id" value="1">
            <input type="hidden" name="name" value="3234">
            <input type="hidden" name="age" value="22">

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
                                    <?echo $departdate;?>
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
                                    <?echo $departdate;?>
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
                            </li>
                            <li>
                                <label><b>＊</b>手机号码：</label>
                                <input type="text" name="mobile" id="mobile" value="">
                                <span>此手机为接受短信所用，作为订购于取票凭证，请准确填写。</span>
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
                                <input type="text" name="userName" autocomplete="off">
                            </li>
                            <li>
                                <label><b>＊</b>手机号码：</label>
                                <input type="text" name="userPhone" autocomplete="off">
                                <span></span>
                            </li>
                            <li>
                                <label><b>＊</b>证件类型：</label>
                                <select style="width: 138px;" name="userIdcard">
                                    <option>身份证</option>
                                    <option>户口本</option>
                                </select>
                                <input type="text" name="userIdcard" autocomplete="off">
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


            <div class="zbyOrder_main3">
                <div class="zbyOrder_main31">
                    <div class="zbyOrder_main31_left">应付总价：￥<?echo $pay_price;?></div>
<!--                    <div ><input value="同意以下条款，去付款" type="submit" class="zbyOrder_main31_right"></div>-->
                    <div ><button onclickclass="onlinePay_payNow" onclick = "check_form()" >同意以下条款，去付款</button></div>
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
        </form>
        <div class="zbyOrder_main4">
            <div class="zbyOrder_main4_title">预订须知</div>
            <div class="zbyOrder_main4_cont">
                <span>费用包含</span>
                <dl>
                    <dt>套餐1:经典双人套餐</dt>
                    <dd>【玩】：宋城景区+千古情演出贵宾席门票2张</dd>
                    <dd>【住】：宋城千古情主题酒店大/双床房</dd>
                    <dd>【吃】：中式自助早2份</dd>
                </dl>
                <dl>
                    <dt>套餐1:经典双人套餐</dt>
                    <dd>【玩】：宋城景区+千古情演出贵宾席门票2张</dd>
                    <dd>【住】：宋城千古情主题酒店大/双床房</dd>
                    <dd>【吃】：中式自助早2份</dd>
                </dl>
                <dl>
                    <dt>套餐1:经典双人套餐</dt>
                    <dd>【玩】：宋城景区+千古情演出贵宾席门票2张</dd>
                    <dd>【住】：宋城千古情主题酒店大/双床房</dd>
                    <dd>【吃】：中式自助早2份</dd>
                </dl>
                <dl>
                    <dt>套餐1:经典双人套餐</dt>
                    <dd>【玩】：宋城景区+千古情演出贵宾席门票2张</dd>
                    <dd>【住】：宋城千古情主题酒店大/双床房</dd>
                </dl>
                <dl>
                    <dt>套餐1:经典双人套餐</dt>
                    <dd>【玩】：宋城景区+千古情演出贵宾席门票2张</dd>
                    <dd>【吃】：中式自助早2份</dd>
                </dl>
                <dl>
                    <dt>套餐1:经典双人套餐</dt>
                    <dd>【玩】：宋城景区+千古情演出贵宾席门票2张</dd>
                    <dd>【住】：宋城千古情主题酒店大/双床房</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
<!--</form>-->
<!-- main end -->

	<!--  foot  start -->
    <?include 'foot.php';?>
<!--	<!--  foot  end -->-->
<!--</body>-->
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


function check_form(){

alert('2131231');
//    var url="";
//  url = "/member/?cmd=<?//=base64_encode('zhifu.php')?>//&goodsId=<?//echo $goods_id;?>//&userId=<?//echo $user_id;?>//&kidNum=<?php //echo $kid_num;?>//&adultNum=<?php //echo $adult_num;?>//&payPrice=<?//echo $pay_price;?>//&departdate=<?//echo $departdate;?>//";
//    url += "&linker="+$('#linker').val();
//    url += "&mobile="+$('#mobile').val();
////    url = "/member/?cmd='zhifu.php'";
//    window.top.location.href = url;
    document.getElementById("write_form").submit();
}


function validate(){

    alert('2131231');
//    var url="";
//  url = "/member/?cmd=<?//=base64_encode('zhifu.php')?>//&goodsId=<?//echo $goods_id;?>//&userId=<?//echo $user_id;?>//&kidNum=<?php //echo $kid_num;?>//&adultNum=<?php //echo $adult_num;?>//&payPrice=<?//echo $pay_price;?>//&departdate=<?//echo $departdate;?>//";
//    url += "&linker="+$('#linker').val();
//    url += "&mobile="+$('#mobile').val();
////    url = "/member/?cmd='zhifu.php'";
//    window.top.location.href = url;
    document.getElementById("write_form").submit();
}


</script>
<!--</html>-->