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
                                <td>��ͯ</td>
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
                <div class="zbyOrder_main2_title">��ϵ����Ϣ</div>

                <div class="zbyOrder_main2_buy">
                    <div class="zbyOrder_main2_buyLeft">������</div>
                    <div class="zbyOrder_main2_buyRight">
                        <ul>
                            <li>
                                <label><b>��</b>������</label>
                                <input type="text" name="linker" id="linker" value="">
                            </li>
                            <li>
                                <label><b>��</b>�ֻ����룺</label>
                                <input type="text" name="mobile" id="mobile" value="">
                                <span>���ֻ�Ϊ���ܶ������ã���Ϊ������ȡƱƾ֤����׼ȷ��д��</span>
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
                                <input type="text" name="userName" autocomplete="off">
                            </li>
                            <li>
                                <label><b>��</b>�ֻ����룺</label>
                                <input type="text" name="userPhone" autocomplete="off">
                                <span></span>
                            </li>
                            <li>
                                <label><b>��</b>֤�����ͣ�</label>
                                <select style="width: 138px;" name="userIdcard">
                                    <option>���֤</option>
                                    <option>���ڱ�</option>
                                </select>
                                <input type="text" name="userIdcard" autocomplete="off">
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


            <div class="zbyOrder_main3">
                <div class="zbyOrder_main31">
                    <div class="zbyOrder_main31_left">Ӧ���ܼۣ���<?echo $pay_price;?></div>
<!--                    <div ><input value="ͬ���������ȥ����" type="submit" class="zbyOrder_main31_right"></div>-->
                    <div ><button onclickclass="onlinePay_payNow" onclick = "check_form()" >ͬ���������ȥ����</button></div>
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
        </form>
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
                <dl>
                    <dt>�ײ�1:����˫���ײ�</dt>
                    <dd>���桿���γǾ���+ǧ�����ݳ����ϯ��Ʊ2��</dd>
                    <dd>��ס�����γ�ǧ��������Ƶ��/˫����</dd>
                    <dd>���ԡ�����ʽ������2��</dd>
                </dl>
                <dl>
                    <dt>�ײ�1:����˫���ײ�</dt>
                    <dd>���桿���γǾ���+ǧ�����ݳ����ϯ��Ʊ2��</dd>
                    <dd>��ס�����γ�ǧ��������Ƶ��/˫����</dd>
                    <dd>���ԡ�����ʽ������2��</dd>
                </dl>
                <dl>
                    <dt>�ײ�1:����˫���ײ�</dt>
                    <dd>���桿���γǾ���+ǧ�����ݳ����ϯ��Ʊ2��</dd>
                    <dd>��ס�����γ�ǧ��������Ƶ��/˫����</dd>
                </dl>
                <dl>
                    <dt>�ײ�1:����˫���ײ�</dt>
                    <dd>���桿���γǾ���+ǧ�����ݳ����ϯ��Ʊ2��</dd>
                    <dd>���ԡ�����ʽ������2��</dd>
                </dl>
                <dl>
                    <dt>�ײ�1:����˫���ײ�</dt>
                    <dd>���桿���γǾ���+ǧ�����ݳ����ϯ��Ʊ2��</dd>
                    <dd>��ס�����γ�ǧ��������Ƶ��/˫����</dd>
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