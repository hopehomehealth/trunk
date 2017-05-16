<?
include('do.common.php');
$arr['orderno'] = $_POST['orderno'];//订单号
$arr['security'] = md5("098f6bcd4621d373cade4e832627b4f6");//签名
$url = $host . "/travel/interface/applyReject";//接口地址
$fail_reason = htmlspecialchars(addslashes($_POST['reason']));// 获取管理员输入的驳回理由
if($fail_reason == ''){
    echo "<script>alert('理由不能为空！');history.go(-1)</script>";
    exit();
}
$order_code = $arr['orderno'];
// curl传参
$rst = $db->api_post($url, $arr);
// 对象转数组
$output = json_decode($rst, true);
if ($fail_reason !== '') {
    if ($output['status'] == "0000") {
        // 写入驳回理由
        $sql = "UPDATE `t_refund_fee_apply` SET `fail_reason`='$fail_reason',`flag`='3' WHERE `order_code`='$order_code'";
        if ($db->query($sql)) {
            echo "<script>alert('驳回成功！')</script>";
            $url = "./?cmd=" . base64_encode("order_refund.php");
            gourl($url);
        } else {
            echo "<script>alert('数据库异常！');history.go(-1)</script>";
        }
    } else {
        echo "<script>alert('驳回失败！');history.go(-1)</script>";
    }
} else {
    echo "<script>alert('理由不能为空！');history.go(-1)</script>";
}
?>