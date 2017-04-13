<?
if(!defined('IN_CLOOTA')) {
    exit('Access Denied');
}
?>

<?
var_dump($_REQUEST);

//    $post['goodsId'] = '8000000';
//    $post['userId'] = req('userId');
//    $post['userId'] = '93';
//    $post['departdate'] = '2017-03-18';
//    $post['adultNum'] = '1';
//    $post['kidNum'] = '1';
//    $post['payPrice'] = '11';
//    $post['linker'] = 'laowang';
//    $post['mobile'] = '18518988355';


$post['token'] = '{"clienttoken":"7A4D2543F258FD7062F842ADD950496ADEADB75BEE76FFBD2B153AD5F2BFEE823863DA9C55A8BF58DEB73C9CCABC30326EC113721043ABA98B3EE1771A41993AA089FAEC25AFEE98F057BAFED0D7B2F1","clienttype":"1","devicetoken":"1","ordertoken":"1","wxcityid":"1"}';
$post['goodsId'] = req('goodsId');
$post['departdate'] = req('departdate');
$departdate = req('departdate');
$post['adultNum'] = req('adultNum');
$post['kidNum'] = req('kidNum');
$post['payPrice'] = req('payPrice');
$post['linker'] = req('linker');
$post['linker'] = iconv('GBK', 'UTF-8', $post['linker']); //将字符串的编码从GB2312转到UTF-8
$post['mobile'] = req('mobile');



//$post['userName'] = req('userName');
//$post['userPhone'] = req('userPhone');
//$post['userIdcard'] = req('userIdcard');
$post['touristList']='[{"userIdcard":"211481198401154411","userName":"wangge","userPhone":"18841184568"},{"userIdcard":"211481198401154411","userName":"laozhao","userPhone":"18242984568"}]';

//校验订单
//    var_dump($post);
$post = array_iconv($post,'gbk','utf-8');
$data = post_curl($host."/travel/interface/order/saveZbyOrder",$post);
$data = json_decode($data,true);
//    if ($data['status'] != '0000'){
//        exit('下订单失败');
//    }

//    var_dump($data);
$data = array_iconv($data,'UTF-8','GBK');
var_dump($data);
$payPrice = '';
$orderCode = '';
$goodsName = '';
foreach($data as $key => $value){
//        if (empty($value)) continue;
    if (is_array($value)) {
        $payPrice = $value['payPrice'];
        $orderCode = $value['orderCode'];
        $goodsName = $value['goodsName'];
    }else{
        if ($key == 'msg') $msg = $value;
        else  $status = $value;
    }
}


$trans['token'] = '{"clienttoken":"7A4D2543F258FD7062F842ADD950496ADEADB75BEE76FFBD2B153AD5F2BFEE823863DA9C55A8BF58DEB73C9CCABC30326EC113721043ABA98B3EE1771A41993AA089FAEC25AFEE98F057BAFED0D7B2F1","clienttype":"1","devicetoken":"1","ordertoken":"1","wxcityid":"1"}';
$brr = post_curl($host."/travel/interface/pay/getPayWays",$trans);
$brr = json_decode($brr,true);
$brr = array_iconv($brr,'UTF-8','GBK');
//    if ($brr['status'] != '0000'){
//        exit('获取参数失败');
//    }
//    var_dump($brr);
$zhifu = $brr['data'];
var_dump($zhifu);

?>
<link rel="stylesheet" type="text/css" href="/themes/s01/images/zhifu.css">
<!--</head>-->
	<!--  head  start -->
<? include 'head.php'?>
	<!-- head  end -->

   <form method="post" action="" >
<!--        <form name="order_form" method="post" action="/member/?cmd=--><?//=base64_encode('zhifu.php')?><!--">-->
	<!-- main内容 start -->
	<div id="onlinePay_mainBox">
		<div id="onlinePay_main">
			<div class="onlinePay_main_title">
				<img src="/themes/s01/images/zby_zaixianzhifu.jpg">
			</div>
			<div class="onlinePay_main1">
				<div class="onlinePay_main1_simInfo">
					<div class="onlinePay_main1_left"><?echo $goodsName?></div>
					<div class="onlinePay_main1_right">应付金额 <b><?echo $payPrice?></b><span>元</span></div>
				</div>
				<div class="onlinePay_main1_allInfo">
					<p>订单编号：<b><?echo $orderCode;?></b></p>
					<p>交易类型：<b>在线支付</b></p>
					<p>建议您在<span>80分18秒</span>内完成付款，过期订单会自动取消哦。</p>
				</div>

				<div class="unfoldInfo subtriangle uptriangle">收起详情</div>
			</div>
			<div class="onlinePay_main2">
				<h3>快捷支付</h3>

                <?
                if (notnull($zhifu)){
                    foreach($zhifu as $key => $value){
                        if ($value['bankcode'] == 'alipayweb'){
                ?>
                    <div class="onlinePay_main2_left">
                        <input type="radio" name="topayinfoid" id="topayinfoid" value="<?echo $value['id'];?>">
                        <label for=""></label>
                    </div>
                        <? }else if($value['bankcode'] == 'wxqrcode'){ ?>
                    <div class="onlinePay_main2_center">
                        <input type="radio" name="topayinfoid" value="<?echo $value['id'];?>">
                        <label for=""></label>
                    </div>
                        <? }else if($value['bankcode'] == 'unionall_web_wtz') { ?>
                            <div class="onlinePay_main2_right">
                                <input type="radio" name="topayinfoid" value="<? echo $value['id']; ?>">
                                <label for=""></label>
                            </div>
                            <?
                        }
                    }
                }

                ?>

			</div>
			<div class="onlinePay_main3">
                <button onclick = "cancle_pay()" class="onlinePay_cancle">取消订单</button>
                <button onclick = "select_pay()" class="onlinePay_payNow">立即付款</button>
			</div>
		</div>
	</div>
       <!-- main内容 end -->
<!--  微信支付弹窗  -->
       <div id="weChatPay">
           <div class="weChatPay1">
               <h3>微信支付</h3>
               <button id="weChatPay_close"></button>
           </div>
           <div class="weChatPay2">
               <img src="images/wechat.jpg">
               <button id="weChatPay_sure">确 定</button>
           </div>
       </div>
   </form>

	<!--  foot  start -->
	<?include 'foot.php'?>
	<!--  foot  end -->

<script type="text/javascript">
$(document).ready(function () {
	var onlinePay_flag1 = 1;
	$('.unfoldInfo').click(function(){
		if(onlinePay_flag1){
			$('.unfoldInfo').removeClass("uptriangle");
			$('.onlinePay_main1_allInfo').hide();
			onlinePay_flag1 = 0;
		}else{
			$('.unfoldInfo').addClass("uptriangle");
			$('.onlinePay_main1_allInfo').show();
			onlinePay_flag1 = 1;
		}
		
	});

//	$('.onlinePay_payNow').click(function(){
//	    $('#weChatPay').show();
//    });
});
function select_pay(){
    var url="";
//    url = "/member/?cmd=<?//=base64_encode('tianxie.php')?>//";
    url = "do.php?ac=do_pay&orderno=<?echo $orderCode;?>&totalprice=<?echo $payPrice;?>&topayinfoid="+$('#topayinfoid').val();;

    window.top.location.href = url;
}

</script>
<!--</html>-->