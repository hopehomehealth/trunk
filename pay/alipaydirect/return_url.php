<?php
/* * 
 * ���ܣ�֧����ҳ����תͬ��֪ͨҳ��
 * �汾��3.3
 * ���ڣ�2012-07-23
 * ˵����
 * ���´���ֻ��Ϊ�˷����̻����Զ��ṩ���������룬�̻����Ը����Լ���վ����Ҫ�����ռ����ĵ���д,����һ��Ҫʹ�øô��롣
 * �ô������ѧϰ���о�֧�����ӿ�ʹ�ã�ֻ���ṩһ���ο���

 *************************ҳ�湦��˵��*************************
 * ��ҳ����ڱ������Բ���
 * �ɷ���HTML������ҳ��Ĵ��롢�̻�ҵ���߼��������
 * ��ҳ�����ʹ��PHP�������ߵ��ԣ�Ҳ����ʹ��д�ı�����logResult���ú����ѱ�Ĭ�Ϲرգ���alipay_notify_class.php�еĺ���verifyReturn
 */

require_once("alipay.config.php");
require_once("lib/alipay_notify.class.php");
?>
<!DOCTYPE HTML>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php
//����ó�֪ͨ��֤���
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {//��֤�ɹ�
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//������������̻���ҵ���߼��������
	
	//�������������ҵ���߼�����д�������´�������ο�������
    //��ȡ֧������֪ͨ���ز������ɲο������ĵ���ҳ����תͬ��֪ͨ�����б�

	//�̻�������
	$out_trade_no = $_GET['out_trade_no'];

	//֧�������׺�
	$trade_no = $_GET['trade_no'];

	//����״̬
	$trade_status = $_GET['trade_status'];

	//���׽��
	$total_fee = $_GET['total_fee'];

    if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
		//�жϸñʶ����Ƿ����̻���վ���Ѿ���������
			//���û���������������ݶ����ţ�out_trade_no�����̻���վ�Ķ���ϵͳ�в鵽�ñʶ�������ϸ����ִ���̻���ҵ�����
			//�����������������ִ���̻���ҵ�����

		pay_callback('alipay', $out_trade_no, $trade_no, $total_fee ); 

		echo "<script>location.replace('http://".$_SERVER['HTTP_HOST']."?callback=pay');</script>";
    }
    else {
	
	  echo "<script>alert('����״̬��".$_GET['trade_status']."');location.replace('http://".$_SERVER['HTTP_HOST']."?callback=pay');</script>";

      echo "trade_status=".$_GET['trade_status'];
    }
		
	echo "��֤�ɹ�<br />";

	//�������������ҵ���߼�����д�������ϴ�������ο�������
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //��֤ʧ��
    //��Ҫ���ԣ��뿴alipay_notify.phpҳ���verifyReturn����
    echo "��֤ʧ��";
}
?>
        <title>֧������ʱ���˽��׽ӿ�</title>
	</head>
    <body>
    </body>
</html>