<?
include('config.php');
header("Content-type: text/html; charset=gbk");

$post = array();
$post['adultNum'] = $_POST['adultNum'];
$post['roomMax'] = $_POST['roomMax'];
$post['goodsType'] = $_POST['goodsType'];
$post['isPackage'] = $_POST['isPackage'];
$diffPrice = $_POST['diffPrice'];
$url = "wwwd.bus365.cn" . "/travel/interface/zby/v3.2/getDiffRoomNum_v3.2";
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

echo "<span>·¿²î</span>
                    <select id='diffPrice' onchange='get_price()'>
                    ";
foreach ($fangcha as $key => $val) {
    echo "<option value='$val'>$val</option>";
}
echo "</select><span class=\"jiage\"> &yen;$diffPrice/ ·Ý</span>";