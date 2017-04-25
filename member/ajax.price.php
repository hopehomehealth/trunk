<?
include('config.php');
header("Content-type: text/html; charset=gbk");

$post = array();
$post['adultNum'] = $_POST['adultNum'];
$post['roomMax'] = $_POST['roomMax'];
$post['goodsType'] = $_POST['goodsType'];
$post['isPackage'] = $_POST['isPackage'];
$url = "wwwd.bus365.cn" . "/travel/interface/zbyV3.2/getDiffRoomNumV_3.2";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$data = curl_exec($ch);
curl_close($ch);
$arr = json_decode($data, true);
$fangcha = $arr['data'];

echo "<span>¹ºÂò·¿²î¼Û</span>
                    <select>";
foreach ($fangcha as $key => $val) {
    echo "<option value='$val'>$val</option>";
}
echo "</select>
                    <span class=\"jiage\">+ &yen;80</span>";