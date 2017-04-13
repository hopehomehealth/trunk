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
    exit('订单失败');
}
?>
	<!--  nav导航  end -->

	<!-- 订单详情 start -->
	<div id="orderDetail_mainBox">
		<div id="orderDetail_main">
			<div class="orderDetail_main1">我的Bus365 &gt; 我的订单 &gt; <a href="">订单详情</a></div>
			<div class="orderDetail_main2">
				<div class="orderDetail_main2_title">订单详情</div>

				<div class="visitorInfo">
					<div class="visitorInfo_title">联系人信息</div>
					<div class="visitorInfo1">
						<ul>
							<li>姓名  <span><?$linker = $pay_data['linker'];echo $linker;?></span></li>
							<li>手机  <span><?$linkerMobile = $pay_data['linkerMobile'];echo $linkerMobile;?></span></li>
						</ul>
					</div>
					<div class="visitorInfo_title">出游人信息</div>
					<div class="visitorInfo2">
						<table>
							<thead>
								<tr>
									<th>姓名</th>
									<th>手机</th>
									<th>证件号码</th>
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
					<div class="orderInfo_title">订单信息</div>
					<div class="orderInfo1">
						<ul>
							<li>订单号：<?echo $pay_data['orderCode'];?></li>
							<li>订单状态：<?echo $pay_data['orderStatusName'];?></li>
							<li>下单时间：<?echo $pay_data['orderDate'];?></li>
							<li>支付方式：<?echo $pay_data['paymentType'];?></li>
						</ul>
						<div class="refundErrorText hide">
							退款原因：预定提前期与付款期。
						</div>
					</div>
					<div class="orderInfo2">
						<table>
							<thead>
								<tr>
									<th>产品名称</th>
									<th>人数</th>
									<th>游玩日期</th>
									<th>现售价</th>
									<th>小计</th>
								</tr>
							</thead>
							<tbody>
<!--                            --><?//
//                               foreach ($pay_data as $key => $value){
//                            ?>
								<tr>
									<td class="productName"><b><?echo $pay_data['goodsName'];?></b></td>
									<td class="productOther">成人×<?echo $pay_data['adultNum'];?></td>
									<td class="productDate"><?echo $pay_data['playDate'];?></td>
									<td class="productPrice2"><?echo $pay_data['adultPrice'];?></td>
									<td class="productXiaoji"><?echo $pay_data['adultTotalFee'];?></td>
								</tr>
                                   <tr>
                                       <td class="productName"><b><?echo $pay_data['goodsName'];?></b></td>
                                       <td class="productOther">儿童×<?echo $pay_data['kidNum'];?></td>
                                       <td class="productDate"><?echo $pay_data['playDate'];?></td>
                                       <td class="productPrice2"><?echo $pay_data['kidPrice'];?></td>
                                       <td class="productXiaoji"><?echo $pay_data['kidTotalFee'];?></td>
                                   </tr>
<!--                            --><?// } ?>
							</tbody>
						</table>

						<p><span>订单总金额：<b><?echo $pay_data['orderFee'];?></b></span></p>
					</div>


					<div class="orderBtnBox">
                        <?if ($pay_status['orderStatus'] == 5 || $pay_status['orderStatus'] == 6 || $pay_status['orderStatus'] == 7 || $pay_status['orderStatus'] == 8){ ?>
                            //
                            <!-- 默认按钮（已取消、退款中。退款成功。退款失败）-->
                            <div class="orderBtn_default">
                                <button>再次预定</button>
                            </div>
                        <? } ?>
<!--                        //已支付 或者 已确认 并且  当前时间没有到出行日期-->
                        <? if ($pay_data['orderStatus'] == 2 || $pay_data['orderStatus'] == 3 ){ ?>
                            <!-- 已支付未确认/已支付已确认 按钮 -->
                            <div class="orderBtn_chupiaozhong hide">
                                <button style="margin-left:360px;">再次预定</button>
                                <button>申请退款</button>
                            </div>
                        <? } ?>
<!--                        //已完成-->
                        <? if ($pay_data['orderStatus'] == 4){ ?>
						<!-- 已支付-已确认-评价 按钮 -->
						<div class="orderBtn_hasUse hide">
							<button style="margin-left:360px;">再次预定</button>
							<button>去评价</button>
						</div>
                        <? } ?>
                        <? if ($pay_data['orderStatus'] == 3){ ?>
<!--                        //已确认-->
						<!-- 已支付-已确认-确认回团 按钮 -->
						<div class="orderBtn_chupiaozhong hide">
							<button style="margin-left:360px;">再次预定</button>
							<button>确认回团</button>
						</div>
                        <? } ?>
<!--                        //待付款-->
                        <? if ($pay_data['orderStatus'] == 1){ ?>
                            <!-- 待支付按钮 -->
                            <div class="orderBtn_noPay hide">
                                <button style="margin-left:360px;">取消订单</button>
                                <button>去支付</button>
                            </div>
						<? } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 订单详情 end -->


	<!-- 黑色蒙层 -->
	<div id="mengban hide"></div>


	<!-- 退款说明信息 -->
	<div class="refundInfo hide">
		<div class="refundInfo_top">
			<h3>退款说明</h3>
			<span class="refundInfo_close"></span>
		</div>
		<div class="refundInfoCont">
			(1)免费政策：a. 1.2米（不含）以下的儿童免票。（每名购票成人限带一名身高低于1.2米的儿童）b. 70周岁（含）以上的老人（凭本人身份证件入园）免费。c. 持国家残联颁发第二代《残疾证》的残疾人免票，盲人、智障、生活不能自理的残疾人需家人（需购票）陪同入园。免费。<br>(2) a. 1.2米（含）~1.5米（含）的儿童享160元/人。（至景区办理）b. 60周岁（含）~69周岁（含）的老人（凭有效身份证件入园）享60元/人。（至景区办理）c. 2016年3月16日--2016年11月15日，凡中国籍游客生日当天（以身份证日期为准）（凭本人身份证件）【身份证、驾驶证、户口本（需配合含本人头像的有效证件）】门市购买日场全价门票）享半价优惠即130元/张。<br>(2) a. 1.2米（含）~1.5米（含）的儿童享160元/人。（至景区办理）b. 60周岁（含）~69周岁（含）的老人（凭有效身份证件入园）享60元/人。（至景区办理）c. 2016年3月16日--2016年11月15日，凡中国籍游客生日当天（以身份证日期为准）（凭本人身份证件）【身份证、驾驶证、户口本（需配合含本人头像的有效证件）】门市购买日场全价门票）享半价优惠即130元/张。<br>(2) a. 1.2米（含）~1.5米（含）的儿童享160元/人。（至景区办理）b. 60周岁（含）~69周岁（含）的老人（凭有效身份证件入园）享60元/人。（至景区办理）c. 2016年3月16日--2016年11月15日，凡中国籍游客生日当天（以身份证日期为准）（凭本人身份证件）【身份证、驾驶证、户口本（需配合含本人头像的有效证件）】门市购买日场全价门票）享半价优惠即130元/张。<br>(2) a. 1.2米（含）~1.5米（含）的儿童享160元/人。（至景区办理）b. 60周岁（含）~69周岁（含）的老人（凭有效身份证件入园）享60元/人。（至景区办理）c. 2016年3月16日--2016年11月15日，凡中国籍游客生日当天（以身份证日期为准）（凭本人身份证件）【身份证、驾驶证、户口本（需配合含本人头像的有效证件）】门市购买日场全价门票）享半价优惠即130元/张。<br>(2) a. 1.2米（含）~1.5米（含）的儿童享160元/人。（至景区办理）b. 60周岁（含）~69周岁（含）的老人（凭有效身份证件入园）享60元/人。（至景区办理）c. 2016年3月16日--2016年11月15日，凡中国籍游客生日当天（以身份证日期为准）（凭本人身份证件）【身份证、驾驶证、户口本（需配合含本人头像的有效证件）】门市购买日场全价门票）享半价优惠即130元/张。
		</div>
	</div>

	<!-- 申请退款点击后弹窗 -->
	<div class="applyRefund hide">
		<div class="applyRefund_title">
			<div class="applyRefund_title_left">待支付订单</div>
			<span class="applyRefund_title_right"></span>
		</div>

		<div class="applyRefund_cont">
			<div class="applyRefund_cont_tips">&nbsp;&nbsp;是否申请退款?</div>
			<button class="applyRefund_sure">确认</button>
			<button class="applyRefund_cancel">取消</button>
		</div>
	</div>

	<!--  foot  start -->
	<?include 'foot.php';?>
	<!--  foot  end -->
<script type="text/javascript" src="/thmes/s01/js/jquery.js"></script>
<script type="text/javascript" src="/themes/s01/js/common.js"></script>
<script type="text/javascript">
// 关闭退款说明信息
	$('.refundInfo_close').click(function(){
		$("#mengban").hide();
		$(".refundInfo").hide();
	});
// 关闭是否退款对话框
	$('.applyRefund_title_right').click(function(){
		$(".applyRefund").hide();
	});
</script>
