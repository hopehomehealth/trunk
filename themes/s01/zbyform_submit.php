<?
if(!defined('IN_CLOOTA')) {
    exit('Access Denied');
}

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/themes/s01/images/tianxie.css">
<script type="text/javascript" src="/themes/s01/js/menpiaoliebiao.js"></script>
<link rel="stylesheet" type="text/css" href="/themes/s01/images/common.css">
<link rel="stylesheet" type="text/css" href="/themes/s01/images/menpiaoliebiao.css">
<link rel="stylesheet" type="text/css" href="/themes/s01/images/list.css">
<script type="text/javascript" src="/themes/s01/js/jquery.js "></script>
<script type="text/javascript" src="/themes/s01/js/common.js"></script>
<title>周边游订单</title>
</head>
<?include('static.php');?>
<?include 'head.php';?>

<body>
<div id="zbyOrder_mainBox">
    <div id="zbyOrder_main">
        <div class="zbyOrder_main_title">
            <img src="/themes/s01/images/zby_fillInOrder.jpg">
        </div>
        <form name="write_form" id="write_form" method="post" action="/zhoubianyou/zbyform_submit-<?=$goods_type;?>-<?=$goods_id;?>-<?=$goods_name;?>-<?=$adult_num;?>-<?=$kid_num;?>-<?=$departdate;?>-<?=$pay_price;?>.html?flag=check">
        <? if($is_package == 'false'){ ?>
            <div class="zbyOrder_main1">

                <div class="zbyOrder_main1_title">
                    <?//echo $goods_name;?>商品名称-按人卖
                </div>
                <div class="zbyOrder_main1Cont">
                    <div class="zbyOrder_main1ContLeft">周边游</div>
                    <div class="zbyOrder_main1ContRight">
                        <table>
                            <thead>
                            <tr>
                                <td>产品信息</td>
                                <td>单价</td>
                                <td>人数</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>成人</td>
                                <td>
                                    120<?//echo $departdate1;?>
                                </td>
                                <td>
									2<?//php echo $adult_num;?>
                                </td>
                            </tr>
                            <tr>
                                <td>儿童</td>
                                <td>
                                    100<?//echo $departdate1;?>
                                </td>
                                <td>
									2<?//php echo $kid_num;?>
                                </td>
                            </tr>
                            </tbody>
                            <thead>
                            <tr>
                                <td>房差：50</td>
                                <td>游玩时间：2017-4-22</td>
                                <td>总价：￥440</td>
                            </tr>
                            </thead>
                        </table>
                        
                    </div>
                </div>
            </div>
            <?}else{?>
            <div class="zbyOrder_main1">
                <div class="zbyOrder_main1_title">
                    <?//echo $goods_name;?>商品名称-按份卖
                </div>
                <div class="zbyOrder_main1Cont">
                    <div class="zbyOrder_main1ContLeft">XX套餐</div>
                    <div class="zbyOrder_main1ContRight">
                        <table>
                            <thead>
                            <tr>
                                <td>产品信息</td>
                                <td>退改信息</td>
                                <td>出游日期</td>
                                <td>份数</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td  onclick="changeTR()" style="cursor:pointer;" onselectstart="return false">一期客房一间(含双人套餐)&nbsp;&nbsp;<span id="change" class="subtriangle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                                <td>
                                    不可退改<?//echo $departdate1;?>
                                </td>
                                <td>2017-04-22
                                <td>
                                    2<?//php echo $adult_num;?>
                                </td>
                            </tr>
                            </tbody>
                            <!-- <tr id="sample"  style="display:none"  >  
                                  <td align="left">  
                                      描述:..... 
                                  </td>  
                              </tr> -->  
                        </table>
                        <div class="spotTicket_infoHide" id="sample"  style="display:none;width:1402px;">描述:..... </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                function changeTR()  
                {  
                    var tr1 = document.getElementById("sample");  
                  
                    if (tr1.style.display == 'none')  
                    {  
                        tr1.style.display = 'block';
                        document.getElementById("change").className = "subtriangle uptriangle";  
                    }  
                    else  
                    {  
                        tr1.style.display = 'none';
                        document.getElementById("change").className = "subtriangle";  
                    }  
                }  
            </script>
            <? } ?>
            <div class="zbyOrder_main2">
                <div class="zbyOrder_main2_title">联系人信息</div>

                <div class="zbyOrder_main2_buy">
                    <div class="zbyOrder_main2_buyLeft">联系人</div>
                    <div class="zbyOrder_main2_buyRight">
                        <ul>
                            <li>
                                <label><b>＊</b>姓名：</label>
                                <input type="text" name="bookerName" id="linker" value="">
                                <span class="buyer_nameTips">购买人姓名不能为空！</span>
                            </li>
                            <li>
                                <label><b>＊</b>手机号码：</label>
                                <input type="text" name="bookerMobile" id="mobile" value="">
                                <span>此手机为接受短信所用，作为订购于取票凭证，请准确填写。</span>
                                <span class="buyer_phoneTips">购买人手机号不能为空！</span>
                            </li>
                            <li>
                                <label><b>＊</b>邮箱：</label>
                                <input type="text" name="bookerEmail" id="email" value="">
                                <span class="buyer_emailTips"></span>
                            </li>
                            <li>
                                <label><b>＊</b>用户类型：</label>
                                <select style="width: 138px;" name="userType">
                                    <option value="0">bus365用户</option>
                                    <option value="1">企业用户</option>
                                </select>
                            </li>
                        </ul>
                    </div>
                </div>
                <? for($i=0;$i<$num;$i++){ ?>
                <div class="zbyOrder_main2_youwan">
                    <div class="zbyOrder_main2_youwanLeft">游玩人1</div>
                    <div class="zbyOrder_main2_youwanRight">
                        <ul>
                            <li>
                                <label><b>＊</b>姓名：</label>
                                <input type="text" name="name_<?=$i?>" autocomplete="off" id="youwan_userName_<?=$i?>">
                                <span class="youwan_nameTips_<?=$i?>"></span>
                            </li>
                            <li>
                                <label><b>＊</b>手机号码：</label>
                                <input type="text" name="mobile_<?=$i?>" autocomplete="off" id="youwan_userPhone_<?=$i?>">
                                <span class="youwan_phoneTips_<?=$i?>"></span>
                            </li>
                            <li>
                                <label><b>＊</b>邮箱：</label>
                                <input type="text" name="email_<?=$i?>" id="youwan_email_<?=$i?>" value="">
                                <span class="youwan_emailTips_<?=$i?>"></span>
                            </li>
                            <li>
                                <label><b>＊</b>英文名</label>
                                <input type="text" name="enName_<?=$i?>" autocomplete="off" id="youwan_enName_<?=$i?>">
                                <span class="youwan_enNameTips_<?=$i?>"></span>
                            </li>
                            <li>
                                    <label><b>＊</b>人群：</label>
                                    <select name="personType_<?=$i?>">
                                        <option value="adult">成人</option>
                                        <option value="child">儿童</option>
                                    </select>
                                    <label><b>＊</b>性别：</label>
                                    <select name="gender_<?=$i?>">
                                        <option value="male">男</option>
                                        <option value="chifemaleld">女</option>
                                    </select>

                            </li>
                            <li>
                                <label><b>＊</b>证件类型：</label>
                                <select style="width: 138px;">
                                    <option>身份证</option>
                                </select>
                                <input type="text" name="credentials_<?=$i?>" autocomplete="off"  id="youwan_userIdcard_<?=$i?>">
                                <span class="youwan_idTips_<?=$i?>"></span>
                            </li>
                            <li>
                                <label><b>＊</b>生日</label>
                                <input type="date" name="birthday_<?=$i?>" autocomplete="off" id="youwan_userName"  min="1900-09-16" max="<?echo date("Y-m-d",time());?>"></span>
                            </li>
                        </ul>
                    </div>
                    <script type="text/javascript">
                    $('#youwan_userName_<?=$i?>').blur(function(){
                        if($('#youwan_userName_<?=$i?>').val()==''){
                            $('.youwan_nameTips_<?=$i?>').show().html('游玩人姓名不能为空').css('color','red');
                            youwanName_flag_<?=$i?>=0;
                        }else{
                            $('.youwan_nameTips_<?=$i?>').hide();
                            youwanName_flag_<?=$i?>=1;
                        }
                    });
                    $('#youwan_userPhone_<?=$i?>').blur(function(){
                        if($('#youwan_userPhone_<?=$i?>').val()==''){
                            $('.youwan_phoneTips_<?=$i?>').show().html('游玩人手机号不能为空').css('color','red');
                        }else if(reg2.test($('#youwan_userPhone_<?=$i?>').val())){
                            $('.youwan_phoneTips_<?=$i?>').show();
                            $('.youwan_phoneTips_<?=$i?>').html('');
                            youwanPhone_flag_<?=$i?>=1;
                        }else if(!reg2.test($('#youwan_userPhone_<?=$i?>').val())){
                            $('.youwan_phoneTips_<?=$i?>').show();
                            $('.youwan_phoneTips_<?=$i?>').html('请输入正确的手机号！').css('color','red');
                            youwanPhone_flag_<?=$i?>=0;
                        }
                    });
                    $('#youwan_enName_<?=$i?>').blur(function(){
                        if($('#youwan_enName_<?=$i?>').val()==''){
                            $('.youwan_enNameTips_<?=$i?>').show().html('游玩人英文名不能为空').css('color','red');
                        }else if(reg5.test($('#youwan_enName_<?=$i?>').val())){
                            $('.youwan_enNameTips_<?=$i?>').show();
                            $('.youwan_enNameTips_<?=$i?>').html('');
                            youwanenName_flag_<?=$i?>=1;
                        }else if(!reg5.test($('#youwan_enName_<?=$i?>').val())){
                            $('.youwan_enNameTips_<?=$i?>').show();
                            $('.youwan_enNameTips_<?=$i?>').html('请输入正确的英文名！').css('color','red');
                            youwanenName_flag_<?=$i?>=0;
                        }
                    });
                    //邮箱
                    $('#youwan_email_<?=$i?>').blur(function(){
                        if($('#youwan_email_<?=$i?>').val()==''){
                            $('.youwan_emailTips_<?=$i?>').show().html('游玩人邮箱不能为空').css('color','red');
                        }else if(reg4.test($('#youwan_email_<?=$i?>').val())){
                            $('.youwan_emailTips_<?=$i?>').show();
                            $('.youwan_emailTips_<?=$i?>').html('');
                            youwanEmail_flag_<?=$i?>=1;
                        }else if(!reg4.test($('#youwan_email_<?=$i?>').val())){
                            $('.youwan_emailTips_<?=$i?>').show();
                            $('.youwan_emailTips_<?=$i?>').html('请输入正确的邮箱！').css('color','red');
                            youwanEmail_flag_<?=$i?>=0;
                        }
                    });
                    $('#youwan_userIdcard_<?=$i?>').blur(function(){
                        if($('#youwan_userIdcard_<?=$i?>').val()==''){
                            $('.an_idTipsyouw_<?=$i?>').show().html('游玩人证件号不能为空').css('color','red');
                        }else if(reg3.test($('#youwan_userIdcard_<?=$i?>').val())){
                            $('.youwan_idTips_<?=$i?>').show();
                            $('.youwan_idTips_<?=$i?>').html('');
                            youwanIdNum_flag_<?=$i?>=1;
                        }else if(!reg3.test($('#youwan_userIdcard_<?=$i?>').val())){
                            $('.youwan_idTips_<?=$i?>').show();
                            $('.youwan_idTips_<?=$i?>').html('请输入正确的证件号！').css('color','red');
                            youwanIdNum_flag_<?=$i?>=0;
                        }
                    });
                    </script>
                </div>
                <?}?>
                <div class="zbyOrder_main2_youwan">
                    <div class="zbyOrder_main2_youwanLeft">紧急联系人</div>
                    <div class="zbyOrder_main2_youwanRight">
                        <ul>
                           <li>
                               <label><b>＊</b>姓名：</label>
                                <input type="text" name="emergencyName" autocomplete="off">
                            </li>
                            <li>
                                <label><b>＊</b>手机号码：</label>
                                <input type="text" name="emergencyMobile" autocomplete="off">
                                <span></span>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        <input type="hidden" name="goodsId" value="">
        <input type="hidden" name="lvProductId" value="">
        <input type="hidden" name="packageId" value="">
        <input type="hidden" name="departdate" value="">
        <input type="hidden" name="payPrice" value="">
        <input type="hidden" name="packageNum" value="">
        <input type="hidden" name="adultNum" value="">
        <input type="hidden" name="childNum" value="">
        <input type="hidden" name="roomCount" value="">
        </form>

        <?
        if (notnull($check_form_data)){
            $js = "<script>document.getElementById('onlineForm').submit();</script>";
            echo $js;
        }
        ?>
            <div class="zbyOrder_main3">
                <div class="zbyOrder_main31">
                    <div class="zbyOrder_main31_left">应付总价：￥440<?//echo $pay_price;?></div>

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
            </div>
        </div>
    </div>
</div>
<!-- </form> -->
<!-- main end -->

	<!--  foot  start -->
    <?include 'foot.php';?>
</body>
<script type="text/javascript" src="/themes/s01/js/jquery.js"></script>
<script type="text/javascript" src="/themes/s01/js/common.js"></script>
<script type="text/javascript">
/*$(document).ready(function(){

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


});*/

//表单合发性验证
var reg1 = /^([\u4e00-\u9fa5]){2,6}$/;//匹配中文
var reg2 = /^13[0-9]{9}$|14[0-9]{9}|15[0-9]{9}$|18[0-9]{9}$/;//匹配手机号
var reg3 = /(^\d{15}$)|(^\d{17}(\d|X)$)/;//匹配身份证
var reg4 = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;//匹配邮箱
var reg5 = /^[A-Za-z]+$/;//英文名
var buyerName_flag=0,
    buyerPhone_flag=0,
    buyerEmail_flag=0,
    // phoneNum_flag=0,
    // idNum_flag=0,
    // email_flag=0,
    // tiaokuan_flag=1
    youwanName_flag=0,
    youwanPhone_flag=0,
    youwanenName_flag=0,
    youwanIdNum_flag=0,
    buyerEmail_flag=0
    ;
//邮箱
$('#email').blur(function(){
    if($('#email').val()==''){
        $('.buyer_emailTips').show().html('联系人邮箱不能为空').css('color','red');
    }else if(reg4.test($('#email').val())){
        $('.buyer_emailTips').show();
        $('.buyer_emailTips').html('');
        buyerEmail_flag=1;
    }else if(!reg4.test($('#email').val())){
        $('.buyer_emailTips').show();
        $('.buyer_emailTips').html('请输入正确的邮箱！').css('color','red');
        buyerEmail_flag=0;
    }
});

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
        $('.buyer_phoneTips').show().html('联系人手机号不能为空').css('color','red');
    }else if(reg2.test($('#mobile').val())){
        $('.buyer_phoneTips').show();
        $('.buyer_phoneTips').html('');
        buyerPhone_flag=1;
    }else if(!reg2.test($('#mobile').val())){
        $('.buyer_phoneTips').show();
        $('.buyer_phoneTips').html('请输入正确的手机号！').css('color','red');
        buyerPhone_flag=0;
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