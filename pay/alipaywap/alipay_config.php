<?php
require '../../config.php';

require '../callback.php';

//读取该站点的财付通支付配置
$sql = "SELECT `pay_config` FROM `t_site_pay` WHERE `site_id`='".$g_siteid."'"; 
$this_pay_config = $db->get_value($sql); 

$pay_config = unserialize($this_pay_config);

// 是否启用
$pay_state = $pay_config['alipaywap']['state'];

if($pay_state!='Y'){
	die('<h1>对不起，支付功能未开启</h1>');
}

/**
	*功能：设置帐户有关信息及返回路径（基础配置页面）
	*版本：2.0
	*日期：2011-11-04
	*说明：
	*以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
	*该代码仅供学习和研究支付宝接口使用，只是提供一个参考。
*/

//↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓

	$partner		= $pay_config['alipaywap']['mid'];			//合作身份者ID，以2088开头的16位纯数字
	$key   			= $pay_config['alipaywap']['sec'];			//安全检验码，以数字和字母组成的32位字符
	$seller_email	= $pay_config['alipaywap']['account'];			//签约支付宝账号或卖家支付宝帐户

	$subject		= "test";			//产品名称
	$out_trade_no	= req('order_code');			//请与贵网站订单系统中的唯一订单号匹配
	$total_fee		= req("order_fee");			//订单总金额
	$out_user		= req("user_id");			//商户系统中用户唯一标识、例如UID、NickName

	//以下是三个返回URL
	$notify_url		= "http://".$_SERVER['HTTP_HOST']."/pay/alipaywap/notify_url.php";			//服务端获取通知地址，用户交易完成异步返回地址
	$call_back_url	= "http://".$_SERVER['HTTP_HOST']."/pay/alipaywap/callback_url.php";			//用户交易完成同步返回地址
	$merchant_url	= "";			//用户付款中途退出返回地址

	if($out_trade_no=='' || $total_fee==''){
		echo "<script>location.replace('http://".$_SERVER['HTTP_HOST']."/member/?cmd=".base64_encode('order.php')."');</script>";
		exit();
	}

//↓↓↓↓↓↓↓↓↓↓以下参数为支付宝默认参数，禁止修改其参数值↓↓↓↓↓↓↓↓↓↓

	$Service_Create				= "alipay.wap.trade.create.direct";
	$Service_authAndExecute		= "alipay.wap.auth.authAndExecute";
	$format						= "xml";
	$sec_id						= "MD5";
	$_input_charset				= "utf-8";
	$v							= "2.0";

?>