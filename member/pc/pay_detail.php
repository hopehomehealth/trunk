<?
if(!defined('IN_CLOOTA')) {
    exit('Access Denied');
}
?>
<link rel="stylesheet" type="text/css" href="/themes/s01/images/pay_detail.css">

	<!--  head  start -->
<?include 'head.php';?>

<?
$post['orderCode'] = req('orderCode');
//$post['orderCode'] = '9908000389';
//var_dump($post['orderCode']);
$post['token'] = '{"clienttoken":"7A4D2543F258FD7062F842ADD950496ADEADB75BEE76FFBD2B153AD5F2BFEE823863DA9C55A8BF58DEB73C9CCABC30326EC113721043ABA98B3EE1771A41993AA089FAEC25AFEE98F057BAFED0D7B2F1","clienttype":"1","devicetoken":"1","ordertoken":"1","wxcityid":"1"}';
$pay_detail = post_curl($host."/travel/interface/zby/getZbyOrderDetail",$post);
//var_dump($pay_detail);
$pay_detail = json_decode($pay_detail,true);
$pay_detail = array_iconv($pay_detail);
$pay_data = $pay_detail['data'];
//var_dump($pay_detail);
//var_dump($pay_data);
if ($pay_detail['status'] != '0000'){
    exit('����ʧ��');
}
?>
	<!--  nav����  end -->

	<!-- �������� start -->
	<div id="orderDetail_mainBox">
		<div id="orderDetail_main">
			<div class="orderDetail_main1">�ҵ�Bus365 &gt; �ҵĶ��� &gt; <a href="">��������</a></div>
			<div class="orderDetail_main2">
				<div class="orderDetail_main2_title">��������</div>

				<div class="visitorInfo">
					<div class="visitorInfo_title">��ϵ����Ϣ</div>
					<div class="visitorInfo1">
						<ul>
							<li>����  <span><?$linker = $pay_data['linker'];echo $linker;?></span></li>
							<li>�ֻ�  <span><?$linkerMobile = $pay_data['linkerMobile'];echo $linkerMobile;?></span></li>
						</ul>
					</div>
					<div class="visitorInfo_title">��������Ϣ</div>
					<div class="visitorInfo2">
						<table>
							<thead>
								<tr>
									<th>����</th>
									<th>�ֻ�</th>
									<th>֤������</th>
								</tr>
							</thead>
							<tbody>
                            <?
                               foreach($pay_data['playPeopleList'] as $key => $value){
                            ?>

								<tr>
									<td><?echo $value['userName'];?></td>
									<td><?echo $value['userPhone'];?></td>
									<td><?echo $value['userIdCard'];?></td>
								</tr>
                            <?}?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="orderInfo">
					<div class="orderInfo_title">������Ϣ</div>
					<div class="orderInfo1">
						<ul>
							<li>�����ţ�<?echo $pay_data['orderCode'];?></li>
							<li>����״̬��<?echo $pay_data['orderStatusName'];?></li>
							<li>�µ�ʱ�䣺<?echo $pay_data['orderDate'];?></li>
							<li>֧����ʽ��<?echo $pay_data['paymentType'];?></li>
						</ul>
						<div class="refundErrorText hide">
							�˿�ԭ��Ԥ����ǰ���븶���ڡ�
						</div>
					</div>
					<div class="orderInfo2">
						<table>
							<thead>
								<tr>
									<th>��Ʒ����</th>
									<th>����</th>
									<th>��������</th>
									<th>���ۼ�</th>
									<th>С��</th>
								</tr>
							</thead>
							<tbody>
<!--                            --><?//
//                               foreach ($pay_data as $key => $value){
//                            ?>
								<tr>
									<td class="productName"><b><?echo $pay_data['goodsName'];?></b></td>
									<td class="productOther">���ˡ�<?echo $pay_data['adultNum'];?></td>
									<td class="productDate"><?echo $pay_data['playDate'];?></td>
									<td class="productPrice2"><?echo $pay_data['adultPrice'];?></td>
									<td class="productXiaoji"><?echo $pay_data['adultTotalFee'];?></td>
								</tr>
                                   <tr>
                                       <td class="productName"><b><?echo $pay_data['goodsName'];?></b></td>
                                       <td class="productOther">��ͯ��<?echo $pay_data['kidNum'];?></td>
                                       <td class="productDate"><?echo $pay_data['playDate'];?></td>
                                       <td class="productPrice2"><?echo $pay_data['kidPrice'];?></td>
                                       <td class="productXiaoji"><?echo $pay_data['kidTotalFee'];?></td>
                                   </tr>
<!--                            --><?// } ?>
							</tbody>
						</table>

						<p><span>�����ܽ�<b><?echo $pay_data['orderFee'];?></b></span></p>
					</div>


					<div class="orderBtnBox">
                        <?if ($pay_status['orderStatus'] == 5 || $pay_status['orderStatus'] == 6 || $pay_status['orderStatus'] == 7 || $pay_status['orderStatus'] == 8){ ?>
                            //
                            <!-- Ĭ�ϰ�ť����ȡ�����˿��С��˿�ɹ����˿�ʧ�ܣ�-->
                            <div class="orderBtn_default">
                                <button>�ٴ�Ԥ��</button>
                            </div>
                        <? } ?>
<!--                        //��֧�� ���� ��ȷ�� ����  ��ǰʱ��û�е���������-->
                        <? if ($pay_data['orderStatus'] == 2 || $pay_data['orderStatus'] == 3 ){ ?>
                            <!-- ��֧��δȷ��/��֧����ȷ�� ��ť -->
                            <div class="orderBtn_chupiaozhong hide">
                                <button style="margin-left:360px;">�ٴ�Ԥ��</button>
                                <button>�����˿�</button>
                            </div>
                        <? } ?>
<!--                        //�����-->
                        <? if ($pay_data['orderStatus'] == 4){ ?>
						<!-- ��֧��-��ȷ��-���� ��ť -->
						<div class="orderBtn_hasUse hide">
							<button style="margin-left:360px;">�ٴ�Ԥ��</button>
							<button>ȥ����</button>
						</div>
                        <? } ?>
                        <? if ($pay_data['orderStatus'] == 3){ ?>
<!--                        //��ȷ��-->
						<!-- ��֧��-��ȷ��-ȷ�ϻ��� ��ť -->
						<div class="orderBtn_chupiaozhong hide">
							<button style="margin-left:360px;">�ٴ�Ԥ��</button>
							<button>ȷ�ϻ���</button>
						</div>
                        <? } ?>
<!--                        //������-->
                        <? if ($pay_data['orderStatus'] == 1){ ?>
                            <!-- ��֧����ť -->
                            <div class="orderBtn_noPay hide">
                                <button style="margin-left:360px;">ȡ������</button>
                                <button>ȥ֧��</button>
                            </div>
						<? } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- �������� end -->


	<!-- ��ɫ�ɲ� -->
	<div id="mengban hide"></div>


	<!-- �˿�˵����Ϣ -->
	<div class="refundInfo hide">
		<div class="refundInfo_top">
			<h3>�˿�˵��</h3>
			<span class="refundInfo_close"></span>
		</div>
		<div class="refundInfoCont">
			(1)������ߣ�a. 1.2�ף����������µĶ�ͯ��Ʊ����ÿ����Ʊ�����޴�һ����ߵ���1.2�׵Ķ�ͯ��b. 70���꣨�������ϵ����ˣ�ƾ�������֤����԰����ѡ�c. �ֹ��Ҳ����䷢�ڶ������м�֤���Ĳм�����Ʊ��ä�ˡ����ϡ����������Ĳм�������ˣ��蹺Ʊ����ͬ��԰����ѡ�<br>(2) a. 1.2�ף�����~1.5�ף������Ķ�ͯ��160Ԫ/�ˡ�������������b. 60���꣨����~69���꣨���������ˣ�ƾ��Ч���֤����԰����60Ԫ/�ˡ�������������c. 2016��3��16��--2016��11��15�գ����й����ο����յ��죨�����֤����Ϊ׼����ƾ�������֤���������֤����ʻ֤�����ڱ�������Ϻ�����ͷ�����Ч֤���������й����ճ�ȫ����Ʊ�������Żݼ�130Ԫ/�š�<br>(2) a. 1.2�ף�����~1.5�ף������Ķ�ͯ��160Ԫ/�ˡ�������������b. 60���꣨����~69���꣨���������ˣ�ƾ��Ч���֤����԰����60Ԫ/�ˡ�������������c. 2016��3��16��--2016��11��15�գ����й����ο����յ��죨�����֤����Ϊ׼����ƾ�������֤���������֤����ʻ֤�����ڱ�������Ϻ�����ͷ�����Ч֤���������й����ճ�ȫ����Ʊ�������Żݼ�130Ԫ/�š�<br>(2) a. 1.2�ף�����~1.5�ף������Ķ�ͯ��160Ԫ/�ˡ�������������b. 60���꣨����~69���꣨���������ˣ�ƾ��Ч���֤����԰����60Ԫ/�ˡ�������������c. 2016��3��16��--2016��11��15�գ����й����ο����յ��죨�����֤����Ϊ׼����ƾ�������֤���������֤����ʻ֤�����ڱ�������Ϻ�����ͷ�����Ч֤���������й����ճ�ȫ����Ʊ�������Żݼ�130Ԫ/�š�<br>(2) a. 1.2�ף�����~1.5�ף������Ķ�ͯ��160Ԫ/�ˡ�������������b. 60���꣨����~69���꣨���������ˣ�ƾ��Ч���֤����԰����60Ԫ/�ˡ�������������c. 2016��3��16��--2016��11��15�գ����й����ο����յ��죨�����֤����Ϊ׼����ƾ�������֤���������֤����ʻ֤�����ڱ�������Ϻ�����ͷ�����Ч֤���������й����ճ�ȫ����Ʊ�������Żݼ�130Ԫ/�š�<br>(2) a. 1.2�ף�����~1.5�ף������Ķ�ͯ��160Ԫ/�ˡ�������������b. 60���꣨����~69���꣨���������ˣ�ƾ��Ч���֤����԰����60Ԫ/�ˡ�������������c. 2016��3��16��--2016��11��15�գ����й����ο����յ��죨�����֤����Ϊ׼����ƾ�������֤���������֤����ʻ֤�����ڱ�������Ϻ�����ͷ�����Ч֤���������й����ճ�ȫ����Ʊ�������Żݼ�130Ԫ/�š�
		</div>
	</div>

	<!-- �����˿����󵯴� -->
	<div class="applyRefund hide">
		<div class="applyRefund_title">
			<div class="applyRefund_title_left">��֧������</div>
			<span class="applyRefund_title_right"></span>
		</div>

		<div class="applyRefund_cont">
			<div class="applyRefund_cont_tips">&nbsp;&nbsp;�Ƿ������˿�?</div>
			<button class="applyRefund_sure">ȷ��</button>
			<button class="applyRefund_cancel">ȡ��</button>
		</div>
	</div>

	<!--  foot  start -->
	<?include 'foot.php';?>
	<!--  foot  end -->
<script type="text/javascript" src="/thmes/s01/js/jquery.js"></script>
<script type="text/javascript" src="/themes/s01/js/common.js"></script>
<script type="text/javascript">
// �ر��˿�˵����Ϣ
	$('.refundInfo_close').click(function(){
		$("#mengban").hide();
		$(".refundInfo").hide();
	});
// �ر��Ƿ��˿�Ի���
	$('.applyRefund_title_right').click(function(){
		$(".applyRefund").hide();
	});
</script>
