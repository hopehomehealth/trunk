<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
	<title>����ת��֧���������Ժ�...</title>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312"> 
</head>

<body onload="document.alipay.submit();">  
<div style="position: absolute;top:-1000px;left:-1000px;">
        <form id="alipay" name="alipay" action="alipayapi.php" method="post">
            <div id="body" style="clear:left">
                <dl class="content">
                    <dt>����֧�����ʻ���</dt>
                    <dd>
                        <span class="null-star">*</span>
                        <input size="30" name="WIDseller_email" value="<?=$_GET['alipay_account']?>"/>
                        <span>����</span>
                    </dd>
                    <dt>�̻������ţ�</dt>
                    <dd>
                        <span class="null-star">*</span>
                        <input size="30" name="WIDout_trade_no" value="<?=$_GET['order_code']?>"/>
                        <span>�̻���վ����ϵͳ��Ψһ�����ţ�����</span>
                    </dd>
                    <dt>�������ƣ�</dt>
                    <dd>
                        <span class="null-star">*</span>
                        <input size="30" name="WIDsubject" value="���ζ���"/>
                        <span>����</span>
                    </dd>
                    <dt>�����</dt>
                    <dd>
                        <span class="null-star">*</span>
                        <input size="30" name="WIDtotal_fee" value="<?=$_GET['order_fee']?>"/>
                        <span>����</span>
                    </dd>
                    <dt>����������</dt>
                    <dd>
                        <span class="null-star">*</span>
                        <input size="30" name="WIDbody" value="<?=$_GET['order_desp']?>"/>
                        <span></span>
                    </dd>
                    <dt>��Ʒչʾ��ַ��</dt>
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