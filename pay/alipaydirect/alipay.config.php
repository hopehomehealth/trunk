<?php
require '../../config.php';

require ("../callback.php");

//��ȡ��վ��ĲƸ�֧ͨ������
$sql = "SELECT `pay_config` FROM `t_site_pay` WHERE `site_id`='".$g_siteid."'"; 
$this_pay_config = $db->get_value($sql); 

$pay_config = unserialize($this_pay_config);

// �Ƿ�����
$pay_state = $pay_config['alipay']['state'];

if($pay_state!='Y'){
	die('<h1>�Բ���֧������δ����</h1>');
}

/* *
 * �����ļ�
 * �汾��3.3
 * ���ڣ�2012-07-19
 * ˵����
 * ���´���ֻ��Ϊ�˷����̻����Զ��ṩ���������룬�̻����Ը����Լ���վ����Ҫ�����ռ����ĵ���д,����һ��Ҫʹ�øô��롣
 * �ô������ѧϰ���о�֧�����ӿ�ʹ�ã�ֻ���ṩһ���ο���
	
 * ��ʾ����λ�ȡ��ȫУ����ͺ��������id
 * 1.������ǩԼ֧�����˺ŵ�¼֧������վ(www.alipay.com)
 * 2.������̼ҷ���(https://b.alipay.com/order/myorder.htm)
 * 3.�������ѯ���������(pid)��������ѯ��ȫУ����(key)��
	
 * ��ȫУ����鿴ʱ������֧�������ҳ��ʻ�ɫ��������ô�죿
 * ���������
 * 1�������������ã������������������������
 * 2���������������ԣ����µ�¼��ѯ��
 */
 
//�����������������������������������Ļ�����Ϣ������������������������������
//���������id����2088��ͷ��16λ������ 
$alipay_config['partner']		= $pay_config['alipay']['mid'];//'2088702546191403';

//��ȫ�����룬�����ֺ���ĸ��ɵ�32λ�ַ�
$alipay_config['key']			= $pay_config['alipay']['sec'];//'d5c9w1u01n8l0dayc5ftbg6fnkn2grwj';

//�����������������������������������Ļ�����Ϣ������������������������������


//ǩ����ʽ �����޸�
$alipay_config['sign_type']    = strtoupper('MD5');

//�ַ������ʽ Ŀǰ֧�� gbk �� utf-8
$alipay_config['input_charset']= strtolower('gbk');

//ca֤��·����ַ������curl��sslУ��
//�뱣֤cacert.pem�ļ��ڵ�ǰ�ļ���Ŀ¼��
$alipay_config['cacert']    = getcwd().'\\cacert.pem';

//����ģʽ,�����Լ��ķ������Ƿ�֧��ssl���ʣ���֧����ѡ��https������֧����ѡ��http
$alipay_config['transport']    = 'http';
?>