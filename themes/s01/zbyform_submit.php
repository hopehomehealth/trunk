<?
if(!defined('IN_CLOOTA')) {
    exit('Access Denied');
}

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/themes/s01/images/tianxie.css">
<title>�ܱ��ζ���</title>
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
                    <div class="zbyOrder_main1ContLeft">������</div>
                    <div class="zbyOrder_main1ContRight">
                        <table>
                            <thead>
                            <tr>
                                <td>��Ʒ��Ϣ</td>
                                <td>����ʱ��</td>
                                <td>����</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>����</td>
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
                                <td>��ͯ</td>
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
                <div class="zbyOrder_main2_title">��ϵ����Ϣ</div>

                <div class="zbyOrder_main2_buy">
                    <div class="zbyOrder_main2_buyLeft">������</div>
                    <div class="zbyOrder_main2_buyRight">
                        <ul>
                            <li>
                                <label><b>��</b>������</label>
                                <input type="text" name="linker" id="linker" value="">
                                <span class="buyer_nameTips">��������������Ϊ�գ�</span>
                            </li>
                            <li>
                                <label><b>��</b>�ֻ����룺</label>
                                <input type="text" name="mobile" id="mobile" value="">
                                <span>���ֻ�Ϊ���ܶ������ã���Ϊ������ȡƱƾ֤����׼ȷ��д��</span>
                                <span class="buyer_phoneTips">�������ֻ��Ų���Ϊ�գ�</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="zbyOrder_main2_youwan">
                    <div class="zbyOrder_main2_youwanLeft">������1</div>
                    <div class="zbyOrder_main2_youwanRight">
                        <ul>
                            <li>
                                <label><b>��</b>������</label>
                                <input type="text" name="userName" autocomplete="off" id="youwan_userName">
                                <span class="youwan_nameTips">��������������Ϊ�գ�</span>
                            </li>
                            <li>
                                <label><b>��</b>�ֻ����룺</label>
                                <input type="text" name="userPhone" autocomplete="off" id="youwan_userPhone">
                                <span class="youwan_phoneTips">�������ֻ��Ų���Ϊ�գ�</span>
                            </li>
                            <li>
                                <label><b>��</b>֤�����ͣ�</label>
                                <select style="width: 138px;" name="userIdcard">
                                    <option>���֤</option>
                                    <option>���ڱ�</option>
                                </select>
                                <input type="text" name="userIdcard" autocomplete="off"  id="youwan_userIdcard">
                                <span class="youwan_idTips">������֤���Ų���Ϊ�գ�</span>
                            </li>
                        </ul>
                    </div>
                </div>
<!--                <div class="zbyOrder_main2_youwan">-->
<!--                    <div class="zbyOrder_main2_youwanLeft">������1</div>-->
<!--                    <div class="zbyOrder_main2_youwanRight">-->
<!--                        <ul>-->
<!--                            <li>-->
<!--                                <label><b>��</b>������</label>-->
<!--                                <input type="text" name="userName" autocomplete="off">-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <label><b>��</b>�ֻ����룺</label>-->
<!--                                <input type="text" name="userPhone" autocomplete="off">-->
<!--                                <span></span>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <label><b>��</b>֤�����ͣ�</label>-->
<!--                                <select style="width: 138px;" name="userIdcard">-->
<!--                                    <option>���֤</option>-->
<!--                                    <option>���ڱ�</option>-->
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
                    <div class="zbyOrder_main31_left">Ӧ���ܼۣ���<?echo $pay_price;?></div>
<!--                    <div ><input value="ͬ���������ȥ����" type="submit" class="zbyOrder_main31_right"></div>-->
<!--                    <div ><button onclickclass="onlinePay_payNow" onclick = "check_form()" >ͬ���������ȥ����</button></div>-->
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
        <!-- </form> -->
        <div class="zbyOrder_main4">
            <div class="zbyOrder_main4_title">Ԥ����֪</div>
<!--            <div class="zbyOrder_main4_cont">-->
<!--                <span>���ð���</span>-->
<!--                <dl>-->
<!--                    <dt>�ײ�1:����˫���ײ�</dt>-->
<!--                    <dd>���桿���γǾ���+ǧ�����ݳ����ϯ��Ʊ2��</dd>-->
<!--                    <dd>��ס�����γ�ǧ��������Ƶ��/˫����</dd>-->
<!--                    <dd>���ԡ�����ʽ������2��</dd>-->
<!--                </dl>-->
<!--                <dl>-->
<!--                    <dt>�ײ�1:����˫���ײ�</dt>-->
<!--                    <dd>���桿���γǾ���+ǧ�����ݳ����ϯ��Ʊ2��</dd>-->
<!--                    <dd>��ס�����γ�ǧ��������Ƶ��/˫����</dd>-->
<!--                    <dd>���ԡ�����ʽ������2��</dd>-->
<!--                </dl>-->
<!--                <dl>-->
<!--                    <dt>�ײ�1:����˫���ײ�</dt>-->
<!--                    <dd>���桿���γǾ���+ǧ�����ݳ����ϯ��Ʊ2��</dd>-->
<!--                    <dd>��ס�����γ�ǧ��������Ƶ��/˫����</dd>-->
<!--                    <dd>���ԡ�����ʽ������2��</dd>-->
<!--                </dl>-->
<!--                <dl>-->
<!--                    <dt>�ײ�1:����˫���ײ�</dt>-->
<!--                    <dd>���桿���γǾ���+ǧ�����ݳ����ϯ��Ʊ2��</dd>-->
<!--                    <dd>��ס�����γ�ǧ��������Ƶ��/˫����</dd>-->
<!--                </dl>-->
<!--                <dl>-->
<!--                    <dt>�ײ�1:����˫���ײ�</dt>-->
<!--                    <dd>���桿���γǾ���+ǧ�����ݳ����ϯ��Ʊ2��</dd>-->
<!--                    <dd>���ԡ�����ʽ������2��</dd>-->
<!--                </dl>-->
<!--                <dl>-->
<!--                    <dt>�ײ�1:����˫���ײ�</dt>-->
<!--                    <dd>���桿���γǾ���+ǧ�����ݳ����ϯ��Ʊ2��</dd>-->
<!--                    <dd>��ס�����γ�ǧ��������Ƶ��/˫����</dd>-->
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

//���Ϸ�����֤
var reg1 = /^([\u4e00-\u9fa5]){2,6}$/;//ƥ������
var reg2 = /^13[0-9]{9}$|14[0-9]{9}|15[0-9]{9}$|18[0-9]{9}$/;//ƥ���ֻ���
var reg3 = /(^\d{15}$)|(^\d{17}(\d|X)$)/;//ƥ�����֤
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
        $('.buyer_phoneTips').show().html('�������ֻ��Ų���Ϊ��');
    }else if(reg2.test($('#mobile').val())){
        $('.buyer_phoneTips').show();
        $('.buyer_phoneTips').html('');
        buyerPhone_flag=1;
    }else if(!reg2.test($('#mobile').val())){
        $('.buyer_phoneTips').show();
        $('.buyer_phoneTips').html('��������ȷ���ֻ��ţ�');
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
        $('.youwan_phoneTips').show().html('�������ֻ��Ų���Ϊ��');
    }else if(reg2.test($('#youwan_userPhone').val())){
        $('.youwan_phoneTips').show();
        $('.youwan_phoneTips').html('');
        youwanPhone_flag=1;
    }else if(!reg2.test($('#youwan_userPhone').val())){
        $('.youwan_phoneTips').show();
        $('.youwan_phoneTips').html('��������ȷ���ֻ��ţ�');
        youwanPhone_flag=0;
    }
});
$('#youwan_userIdcard').blur(function(){
    if($('#youwan_userIdcard').val()==''){
        $('.youwan_idTips').show().html('������֤���Ų���Ϊ��');
    }else if(reg3.test($('#youwan_userIdcard').val())){
        $('.youwan_idTips').show();
        $('.youwan_idTips').html('');
        youwanIdNum_flag=1;
    }else if(!reg3.test($('#youwan_userIdcard').val())){
        $('.youwan_idTips').show();
        $('.youwan_idTips').html('��������ȷ��֤���ţ�');
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