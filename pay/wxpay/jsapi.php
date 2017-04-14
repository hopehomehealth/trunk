<?php 
ini_set('date.timezone','Asia/Shanghai');
error_reporting(E_ALL);

require_once dirname(__FILE__)."/cfg.php";
require_once dirname(__FILE__)."/lib/WxPay.Api.php";
require_once dirname(__FILE__)."/WxPay.JsApiPay.php";
require_once dirname(__FILE__)."/log.php";

//echo WxPayConfig::APPID;
//echo WxPayConfig::MCHID ;
//echo WxPayConfig::KEY ;
//echo WxPayConfig::APPSECRET ; 

// 业务参数
$c_order_code = req('order_code');
$c_order_fee  = req('order_fee') * 100; 

//初始化日志
$logHandler= new CLogFileHandler("logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

//打印输出数组信息
function printf_info($data)
{
    foreach($data as $key=>$value){
        echo "<font color='#00ff55;'>$key</font> : $value <br/>";
    }
}



// 获取用户openid
$tools = new JsApiPay();
$openId = $tools->GetOpenid();

// 统一下单
$input = new WxPayUnifiedOrder();
$input->SetBody("订单号：".$c_order_code);
$input->SetAttach($c_order_code);
$input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
$input->SetTotal_fee($c_order_fee);
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag("");
$input->SetNotify_url("http://".$_SERVER['HTTP_HOST']."/pay/wxpay/notify.php");
$input->SetTrade_type("JSAPI");
$input->SetOpenid($openId);
$order = WxPayApi::unifiedOrder($input);
//echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
//printf_info($order);
$jsApiParameters = $tools->GetJsApiParameters($order);

// 获取共享收货地址js函数参数
$editAddress = $tools->GetEditAddressParameters();

// 在支持成功回调通知中处理成功之后的事宜，见 notify.php
/**
 * 注意：
 * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
 * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
 * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
 */
?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <title>微信支付</title>
	<link href="/ajax/bootstrap-2.3.2/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 

    <script type="text/javascript"> 
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo $jsApiParameters; ?>,
			function(res){
				WeixinJSBridge.log(res.err_msg);
				//alert(res.err_msg);

				if(res.err_msg == 'get_brand_wcpay_request:ok'){
					//alert('支付成功，正在进入订单列表！')
					//document.getElementById('wxpay_note').innerHTML = '正在跳转回订单列表...';
					window.top.location.href='/member/?cmd=<?=base64_encode("order.php")?>';
				} else {
					alert('支付失败，请重试！');
					window.top.location.href='/member/?cmd=<?=base64_encode("order.php")?>';
				}
				//alert(res.err_code+res.err_desc+res.err_msg);
			}
		);
	}

	function callpay()
	{
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    jsApiCall();
		}
	}
	</script>
	<script type="text/javascript">
	/*
	//获取共享地址
	function editAddress()
	{
		WeixinJSBridge.invoke(
			'editAddress',
			<?php echo $editAddress; ?>,
			function(res){
				var value1 = res.proviceFirstStageName;
				var value2 = res.addressCitySecondStageName;
				var value3 = res.addressCountiesThirdStageName;
				var value4 = res.addressDetailInfo;
				var tel = res.telNumber;
				
				//alert(value1 + value2 + value3 + value4 + ":" + tel);
			}
		);
	}
	
	window.onload = function(){
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', editAddress, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', editAddress); 
		        document.attachEvent('onWeixinJSBridgeReady', editAddress);
		    }
		}else{
			editAddress();
		}
	};
	*/
	
	</script>
</head>
<body>
	<div align="center">
		<p>&nbsp;</p> 
		
		<p><a href="/"><img src="/images/logo.png" style="width:47%"></a></p> 
		<p>&nbsp;</p>
		<p style="font-size:16px">订单号：<?=req('order_code')?>，支付金额为：<strong>&yen;<?=req('order_fee')?></strong>元</p> 
		
		<input type="button" value="立即付款" onclick="callpay()" class="btn btn-warning btn-large">
		 
		<p>&nbsp;</p> 
		<p>&nbsp;</p> 
		<p>&nbsp;</p> 
		<p><a href="/" style="font-size:12px">返回首页</a> &nbsp; <a href="/member/?cmd=<?=base64_encode('order.php')?>" style="font-size:12px">返回订单列表</a></p> 
		<p>&nbsp;</p> 
		<p>&nbsp;</p> 
		<p><img src="/member/static/pc/wxpay.jpg"></p>  
	</div> 
 
</body>
</html>