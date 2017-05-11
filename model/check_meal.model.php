<?
include('../config.php');
header("Content-type:text/html;charset=gbk");
$post = array();
$post['packageId'] = $_POST['packageId'];
$post['lvProductId'] = $_POST['lvProductId'];
$post['departDate'] = $_POST['departDate'];
$post['adultNum'] = $_POST['adultNum'];
$post['childNum'] = $_POST['childNum'];
$url =  $host . "/travel/interface/zby/v3.2/checkDataBeforePay";
$data = $db->api_post($url, $post);
$arr = json_decode($data, true);
$datas = $arr['data'];
if($datas['timeMsg'] == '1' && $datas['dayMsg'] == '1' && $datas['skuMsg'] == '1' ){
    echo "1";
} else {
    echo "0";
}
//echo var_dump($datas['skuMsg']);