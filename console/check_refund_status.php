<?
include('do.common.php');
$arr = array();
$arr['orderno'] = $_POST['orderno'];//������
$orderno = $arr['orderno'];
$arr['payno'] = $_POST['payno'];//֧����ˮ��
$arr['refundmoney'] = $_POST['refundmoney'];//Ӧ�˽��
$arr['gatewayid'] = $_POST['gatewayid'];//����ID
$arr['totalPrice'] = $_POST['totalPrice'];//�ܽ��
$arr['refund_fee'] = $_POST['refund_fee'];//�˿���
if($arr['refundmoney'] == ''){
    echo "<script>alert('Ӧ�˽���Ϊ�գ�');history.go(-1);</script>";
    exit();
}
//if($arr['refundmoney'] > $arr['refund_fee']){
//    echo "<script>alert('Ӧ�˽��ܴ����˿��');history.go(-1);</script>";
//    exit();
//}
$arr['security'] = md5("098f6bcd4621d373cade4e832627b4f6");//ǩ��
$url = $host . "/travel/interface/refund";//�ӿڵ�ַ
//�ӿڴ���
$rst = $db->api_post($url, $arr);
//����ת����
$output = json_decode($rst, true);
$info = $db->to_gbk($output['msg']);
// �Խӿڷ��ص����ݽ����ж�
if ($output['status'] != "0000") {
    $sql = "UPDATE `t_refund_fee_apply` SET `flag` = '4' WHERE `order_code` = '$orderno'";
    $db->query($sql);
    echo "<script>alert('�˿�ʧ�ܣ�')</script>";
    $url = "./?cmd=".base64_encode("order_refund.php");
    gourl($url);
} else {
    $sql = "UPDATE `t_refund_fee_apply` SET `flag` = '2' WHERE `order_code` = '$orderno'";
    $db->query($sql);
    echo "<script>alert('�˿�ɹ���')</script>";
    $url = "./?cmd=".base64_encode("order_refund.php");
    gourl($url);
}