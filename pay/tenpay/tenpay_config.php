<?php
require '../../config.php';

$pay_log_dir = dirname(dirname(dirname(__FILE__)))."/logs/pay/";

//读取该站点的财付通支付配置
$sql = "SELECT `pay_config` FROM `t_site_pay` WHERE `site_id`='".$g_siteid."'"; 
$this_pay_config = $db->get_value($sql); 

$pay_config = unserialize($this_pay_config);

// 是否启用
$pay_state = $pay_config['tenpay']['state'];

if($pay_state!='Y'){
	die('<h1>对不起，支付功能未开启</h1>');
}

//商户ID号
$pay_mid = $pay_config['tenpay']['mid'];

//交易密钥
$pay_sec = $pay_config['tenpay']['sec'];

//交易类型
$pay_guarantee = $pay_config['tenpay']['guarantee'];
if($pay_guarantee=='N'){
	$my_trade_mode = '1'; //N即时到账
}
if($pay_guarantee=='Y'){
	$my_trade_mode = '2'; //Y担保交易 
}

//网银直连
$pay_direct = $pay_config['tenpay']['direct'];
if($pay_direct=='Y'){
	$pay_bank_type = req('bank_type');
} else {
	$pay_bank_type = '0';
}

$spname="财付通双接口";
$partner = $pay_mid; 
$key = $pay_sec; 


$return_url = "http://".$_SERVER['HTTP_HOST']."/pay/tenpay/payReturnUrl.php";
$notify_url = "http://".$_SERVER['HTTP_HOST']."/pay/tenpay/payNotifyUrl.php";
?>