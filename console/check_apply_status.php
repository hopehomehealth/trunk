<?
include('do.common.php');
$arr['orderno'] = $_POST['orderno'];//������
$arr['security'] = md5("098f6bcd4621d373cade4e832627b4f6");//ǩ��
$url = $host . "/travel/interface/applyReject";//�ӿڵ�ַ
$fail_reason = htmlspecialchars(addslashes($_POST['reason']));// ��ȡ����Ա����Ĳ�������
if($fail_reason == ''){
    echo "<script>alert('���ɲ���Ϊ�գ�');history.go(-1)</script>";
    exit();
}
$order_code = $arr['orderno'];
// curl����
$rst = $db->api_post($url, $arr);
// ����ת����
$output = json_decode($rst, true);
if ($fail_reason !== '') {
    if ($output['status'] == "0000") {
        // д�벵������
        $sql = "UPDATE `t_refund_fee_apply` SET `fail_reason`='$fail_reason',`flag`='3' WHERE `order_code`='$order_code'";
        if ($db->query($sql)) {
            echo "<script>alert('���سɹ���')</script>";
            $url = "./?cmd=" . base64_encode("order_refund.php");
            gourl($url);
        } else {
            echo "<script>alert('���ݿ��쳣��');history.go(-1)</script>";
        }
    } else {
        echo "<script>alert('����ʧ�ܣ�');history.go(-1)</script>";
    }
} else {
    echo "<script>alert('���ɲ���Ϊ�գ�');history.go(-1)</script>";
}
?>