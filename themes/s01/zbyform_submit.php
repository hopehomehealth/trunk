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
<title>�ܱ��ζ���</title>
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
                    <?//echo $goods_name;?>��Ʒ����-������
                </div>
                <div class="zbyOrder_main1Cont">
                    <div class="zbyOrder_main1ContLeft">�ܱ���</div>
                    <div class="zbyOrder_main1ContRight">
                        <table>
                            <thead>
                            <tr>
                                <td>��Ʒ��Ϣ</td>
                                <td>����</td>
                                <td>����</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>����</td>
                                <td>
                                    120<?//echo $departdate1;?>
                                </td>
                                <td>
									2<?//php echo $adult_num;?>
                                </td>
                            </tr>
                            <tr>
                                <td>��ͯ</td>
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
                                <td>���50</td>
                                <td>����ʱ�䣺2017-4-22</td>
                                <td>�ܼۣ���440</td>
                            </tr>
                            </thead>
                        </table>
                        
                    </div>
                </div>
            </div>
            <?}else{?>
            <div class="zbyOrder_main1">
                <div class="zbyOrder_main1_title">
                    <?//echo $goods_name;?>��Ʒ����-������
                </div>
                <div class="zbyOrder_main1Cont">
                    <div class="zbyOrder_main1ContLeft">XX�ײ�</div>
                    <div class="zbyOrder_main1ContRight">
                        <table>
                            <thead>
                            <tr>
                                <td>��Ʒ��Ϣ</td>
                                <td>�˸���Ϣ</td>
                                <td>��������</td>
                                <td>����</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td  onclick="changeTR()" style="cursor:pointer;" onselectstart="return false">һ�ڿͷ�һ��(��˫���ײ�)&nbsp;&nbsp;<span id="change" class="subtriangle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                                <td>
                                    �����˸�<?//echo $departdate1;?>
                                </td>
                                <td>2017-04-22
                                <td>
                                    2<?//php echo $adult_num;?>
                                </td>
                            </tr>
                            </tbody>
                            <!-- <tr id="sample"  style="display:none"  >  
                                  <td align="left">  
                                      ����:..... 
                                  </td>  
                              </tr> -->  
                        </table>
                        <div class="spotTicket_infoHide" id="sample"  style="display:none;width:1402px;">����:..... </div>
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
                <div class="zbyOrder_main2_title">��ϵ����Ϣ</div>

                <div class="zbyOrder_main2_buy">
                    <div class="zbyOrder_main2_buyLeft">��ϵ��</div>
                    <div class="zbyOrder_main2_buyRight">
                        <ul>
                            <li>
                                <label><b>��</b>������</label>
                                <input type="text" name="bookerName" id="linker" value="">
                                <span class="buyer_nameTips">��������������Ϊ�գ�</span>
                            </li>
                            <li>
                                <label><b>��</b>�ֻ����룺</label>
                                <input type="text" name="bookerMobile" id="mobile" value="">
                                <span>���ֻ�Ϊ���ܶ������ã���Ϊ������ȡƱƾ֤����׼ȷ��д��</span>
                                <span class="buyer_phoneTips">�������ֻ��Ų���Ϊ�գ�</span>
                            </li>
                            <li>
                                <label><b>��</b>���䣺</label>
                                <input type="text" name="bookerEmail" id="email" value="">
                                <span class="buyer_emailTips"></span>
                            </li>
                            <li>
                                <label><b>��</b>�û����ͣ�</label>
                                <select style="width: 138px;" name="userType">
                                    <option value="0">bus365�û�</option>
                                    <option value="1">��ҵ�û�</option>
                                </select>
                            </li>
                        </ul>
                    </div>
                </div>
                <? for($i=0;$i<$num;$i++){ ?>
                <div class="zbyOrder_main2_youwan">
                    <div class="zbyOrder_main2_youwanLeft">������1</div>
                    <div class="zbyOrder_main2_youwanRight">
                        <ul>
                            <li>
                                <label><b>��</b>������</label>
                                <input type="text" name="name_<?=$i?>" autocomplete="off" id="youwan_userName_<?=$i?>">
                                <span class="youwan_nameTips_<?=$i?>"></span>
                            </li>
                            <li>
                                <label><b>��</b>�ֻ����룺</label>
                                <input type="text" name="mobile_<?=$i?>" autocomplete="off" id="youwan_userPhone_<?=$i?>">
                                <span class="youwan_phoneTips_<?=$i?>"></span>
                            </li>
                            <li>
                                <label><b>��</b>���䣺</label>
                                <input type="text" name="email_<?=$i?>" id="youwan_email_<?=$i?>" value="">
                                <span class="youwan_emailTips_<?=$i?>"></span>
                            </li>
                            <li>
                                <label><b>��</b>Ӣ����</label>
                                <input type="text" name="enName_<?=$i?>" autocomplete="off" id="youwan_enName_<?=$i?>">
                                <span class="youwan_enNameTips_<?=$i?>"></span>
                            </li>
                            <li>
                                    <label><b>��</b>��Ⱥ��</label>
                                    <select name="personType_<?=$i?>">
                                        <option value="adult">����</option>
                                        <option value="child">��ͯ</option>
                                    </select>
                                    <label><b>��</b>�Ա�</label>
                                    <select name="gender_<?=$i?>">
                                        <option value="male">��</option>
                                        <option value="chifemaleld">Ů</option>
                                    </select>

                            </li>
                            <li>
                                <label><b>��</b>֤�����ͣ�</label>
                                <select style="width: 138px;">
                                    <option>���֤</option>
                                </select>
                                <input type="text" name="credentials_<?=$i?>" autocomplete="off"  id="youwan_userIdcard_<?=$i?>">
                                <span class="youwan_idTips_<?=$i?>"></span>
                            </li>
                            <li>
                                <label><b>��</b>����</label>
                                <input type="date" name="birthday_<?=$i?>" autocomplete="off" id="youwan_userName"  min="1900-09-16" max="<?echo date("Y-m-d",time());?>"></span>
                            </li>
                        </ul>
                    </div>
                    <script type="text/javascript">
                    $('#youwan_userName_<?=$i?>').blur(function(){
                        if($('#youwan_userName_<?=$i?>').val()==''){
                            $('.youwan_nameTips_<?=$i?>').show().html('��������������Ϊ��').css('color','red');
                            youwanName_flag_<?=$i?>=0;
                        }else{
                            $('.youwan_nameTips_<?=$i?>').hide();
                            youwanName_flag_<?=$i?>=1;
                        }
                    });
                    $('#youwan_userPhone_<?=$i?>').blur(function(){
                        if($('#youwan_userPhone_<?=$i?>').val()==''){
                            $('.youwan_phoneTips_<?=$i?>').show().html('�������ֻ��Ų���Ϊ��').css('color','red');
                        }else if(reg2.test($('#youwan_userPhone_<?=$i?>').val())){
                            $('.youwan_phoneTips_<?=$i?>').show();
                            $('.youwan_phoneTips_<?=$i?>').html('');
                            youwanPhone_flag_<?=$i?>=1;
                        }else if(!reg2.test($('#youwan_userPhone_<?=$i?>').val())){
                            $('.youwan_phoneTips_<?=$i?>').show();
                            $('.youwan_phoneTips_<?=$i?>').html('��������ȷ���ֻ��ţ�').css('color','red');
                            youwanPhone_flag_<?=$i?>=0;
                        }
                    });
                    $('#youwan_enName_<?=$i?>').blur(function(){
                        if($('#youwan_enName_<?=$i?>').val()==''){
                            $('.youwan_enNameTips_<?=$i?>').show().html('������Ӣ��������Ϊ��').css('color','red');
                        }else if(reg5.test($('#youwan_enName_<?=$i?>').val())){
                            $('.youwan_enNameTips_<?=$i?>').show();
                            $('.youwan_enNameTips_<?=$i?>').html('');
                            youwanenName_flag_<?=$i?>=1;
                        }else if(!reg5.test($('#youwan_enName_<?=$i?>').val())){
                            $('.youwan_enNameTips_<?=$i?>').show();
                            $('.youwan_enNameTips_<?=$i?>').html('��������ȷ��Ӣ������').css('color','red');
                            youwanenName_flag_<?=$i?>=0;
                        }
                    });
                    //����
                    $('#youwan_email_<?=$i?>').blur(function(){
                        if($('#youwan_email_<?=$i?>').val()==''){
                            $('.youwan_emailTips_<?=$i?>').show().html('���������䲻��Ϊ��').css('color','red');
                        }else if(reg4.test($('#youwan_email_<?=$i?>').val())){
                            $('.youwan_emailTips_<?=$i?>').show();
                            $('.youwan_emailTips_<?=$i?>').html('');
                            youwanEmail_flag_<?=$i?>=1;
                        }else if(!reg4.test($('#youwan_email_<?=$i?>').val())){
                            $('.youwan_emailTips_<?=$i?>').show();
                            $('.youwan_emailTips_<?=$i?>').html('��������ȷ�����䣡').css('color','red');
                            youwanEmail_flag_<?=$i?>=0;
                        }
                    });
                    $('#youwan_userIdcard_<?=$i?>').blur(function(){
                        if($('#youwan_userIdcard_<?=$i?>').val()==''){
                            $('.an_idTipsyouw_<?=$i?>').show().html('������֤���Ų���Ϊ��').css('color','red');
                        }else if(reg3.test($('#youwan_userIdcard_<?=$i?>').val())){
                            $('.youwan_idTips_<?=$i?>').show();
                            $('.youwan_idTips_<?=$i?>').html('');
                            youwanIdNum_flag_<?=$i?>=1;
                        }else if(!reg3.test($('#youwan_userIdcard_<?=$i?>').val())){
                            $('.youwan_idTips_<?=$i?>').show();
                            $('.youwan_idTips_<?=$i?>').html('��������ȷ��֤���ţ�').css('color','red');
                            youwanIdNum_flag_<?=$i?>=0;
                        }
                    });
                    </script>
                </div>
                <?}?>
                <div class="zbyOrder_main2_youwan">
                    <div class="zbyOrder_main2_youwanLeft">������ϵ��</div>
                    <div class="zbyOrder_main2_youwanRight">
                        <ul>
                           <li>
                               <label><b>��</b>������</label>
                                <input type="text" name="emergencyName" autocomplete="off">
                            </li>
                            <li>
                                <label><b>��</b>�ֻ����룺</label>
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
                    <div class="zbyOrder_main31_left">Ӧ���ܼۣ���440<?//echo $pay_price;?></div>

                    <button class="zbyOrder_main31_right" onclick = "check_form()">ͬ���������ȥ����</button>

                </div>
                <div class="zbyOrder_main32">
                    <label>����ͬ����������</label>
                    <input type="checkbox" name="����ͬ����������">
                    <label>ͬ���ŶӾ������κ�ͬ</label>
                    <input type="checkbox" name="ͬ���ŶӾ������κ�ͬ">
                </div>
                <div class="zbyOrder_main33">
                    ��ܰ��ʾ��������ϸ�Ķ�Ԥ����֪�����κ�ͬ��������ύ����Ϊ��ͬ�����¸�����������
                </div>
            </div>
        <div class="zbyOrder_main4">
            <div class="zbyOrder_main4_title">Ԥ����֪</div>
                <div class="zbyOrder_main4_cont">
                <span>���ð���</span>
                <dl>
                <dt>�ײ�1:����˫���ײ�</dt>
                <dd>���桿���γǾ���+ǧ�����ݳ����ϯ��Ʊ2��</dd>
                <dd>��ס�����γ�ǧ��������Ƶ��/˫����</dd>
                <dd>���ԡ�����ʽ������2��</dd>
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

//���Ϸ�����֤
var reg1 = /^([\u4e00-\u9fa5]){2,6}$/;//ƥ������
var reg2 = /^13[0-9]{9}$|14[0-9]{9}|15[0-9]{9}$|18[0-9]{9}$/;//ƥ���ֻ���
var reg3 = /(^\d{15}$)|(^\d{17}(\d|X)$)/;//ƥ�����֤
var reg4 = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;//ƥ������
var reg5 = /^[A-Za-z]+$/;//Ӣ����
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
//����
$('#email').blur(function(){
    if($('#email').val()==''){
        $('.buyer_emailTips').show().html('��ϵ�����䲻��Ϊ��').css('color','red');
    }else if(reg4.test($('#email').val())){
        $('.buyer_emailTips').show();
        $('.buyer_emailTips').html('');
        buyerEmail_flag=1;
    }else if(!reg4.test($('#email').val())){
        $('.buyer_emailTips').show();
        $('.buyer_emailTips').html('��������ȷ�����䣡').css('color','red');
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
        $('.buyer_phoneTips').show().html('��ϵ���ֻ��Ų���Ϊ��').css('color','red');
    }else if(reg2.test($('#mobile').val())){
        $('.buyer_phoneTips').show();
        $('.buyer_phoneTips').html('');
        buyerPhone_flag=1;
    }else if(!reg2.test($('#mobile').val())){
        $('.buyer_phoneTips').show();
        $('.buyer_phoneTips').html('��������ȷ���ֻ��ţ�').css('color','red');
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