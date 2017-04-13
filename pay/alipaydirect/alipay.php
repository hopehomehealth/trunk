<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
	<title>正在转入支付宝，请稍候...</title>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312"> 
</head>

<body onload="document.alipay.submit();">  
<div style="position: absolute;top:-1000px;left:-1000px;">
        <form id="alipay" name="alipay" action="alipayapi.php" method="post">
            <div id="body" style="clear:left">
                <dl class="content">
                    <dt>卖家支付宝帐户：</dt>
                    <dd>
                        <span class="null-star">*</span>
                        <input size="30" name="WIDseller_email" value="<?=$_GET['alipay_account']?>"/>
                        <span>必填</span>
                    </dd>
                    <dt>商户订单号：</dt>
                    <dd>
                        <span class="null-star">*</span>
                        <input size="30" name="WIDout_trade_no" value="<?=$_GET['order_code']?>"/>
                        <span>商户网站订单系统中唯一订单号，必填</span>
                    </dd>
                    <dt>订单名称：</dt>
                    <dd>
                        <span class="null-star">*</span>
                        <input size="30" name="WIDsubject" value="旅游订金"/>
                        <span>必填</span>
                    </dd>
                    <dt>付款金额：</dt>
                    <dd>
                        <span class="null-star">*</span>
                        <input size="30" name="WIDtotal_fee" value="<?=$_GET['order_fee']?>"/>
                        <span>必填</span>
                    </dd>
                    <dt>订单描述：</dt>
                    <dd>
                        <span class="null-star">*</span>
                        <input size="30" name="WIDbody" value="<?=$_GET['order_desp']?>"/>
                        <span></span>
                    </dd>
                    <dt>产品展示地址：</dt>
                    <dd>
                        <span class="null-star">*</span>
                        <input size="30" name="WIDshow_url" value="<?=urldecode($_GET['goods_url'])?>"/> 
                    </dd> 
                </dl>
            </div>
		</form>  
</div>
</body>
</html>