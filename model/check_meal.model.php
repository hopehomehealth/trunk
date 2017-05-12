<?
include('../config.php');
header("Content-type:text/html;charset=gbk");
$post = array();
$post['packageId'] = $_POST['packageId'];
$post['departDate'] = $_POST['departDate'];
$post['adultNum'] = $_POST['adultNum'];
$post['childNum'] = $_POST['childNum'];
$url =   $host . "/travel/interface/zby/v3.2/checkDataBeforePay";
$data = $db->api_post($url, $post);
$arr = json_decode($data, true);
$datas = $arr['data'];
if($datas['code'] !== '0000'){
    echo $db->to_gbk($datas['msg']);
} else {
    echo "1";
}