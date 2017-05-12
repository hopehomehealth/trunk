<?
include('../config.php');
header("Content-type:text/html;charset=gbk");
$post = array();
$post['packageId'] = $_POST['packageId'];
$post['lvProductId'] = $_POST['lvProductId'];
$post['departDate'] = $_POST['departDate'];
$post['adultNum'] = $_POST['adultNum'];
$post['childNum'] = $_POST['childNum'];
$url =   $host . "/travel/interface/zby/v3.2/checkDataBeforePay";
$data = $db->api_post($url, $post);
$arr = json_decode($data, true);
$datas = $arr['data'];
if($datas['skuMsg'] !== '1'){
    echo $db->to_gbk($datas['skuMsg']);
} else if ($datas['dayMsg'] !== '1'){
    echo $db->to_gbk($datas['dayMsg']);
} else if ($datas['timeMsg'] !== '1'){
    echo $db->to_gbk($datas['timeMsg']);
} else {
    echo "1";
}