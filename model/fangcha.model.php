<?
header("Content-type: text/html; charset=gbk");
$post = array();
$post['adultNum'] = $_POST['adultNum'];
$post['roomMax'] = $_POST['roomMax'];
$post['goodsType'] = $_POST['goodsType'];
$post['isPackage'] = $_POST['isPackage'];
$diffPrice = $_POST['diffPrice'];
$url = $host . "/travel/interface/zby/v3.2/getDiffRoomNum_v3.2";
$data = $db->api_post($url, $post);
$arr = json_decode($data, true);
$fangcha = $arr['data'];
echo "<select id='diffPriceNum' onchange='get_price()'> ";
foreach ($fangcha as $key => $val) {
    echo "<option value='$val'>$val</option>";
}
echo "</select>";


?>