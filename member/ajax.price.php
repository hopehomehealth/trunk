<?
include('config.php');
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

echo "<span><a title='因旅游过程中的住宿安排是两个床位的标准间，团费中是根据1名成人占1张床计算的。如出游人数（成人）为单数时，需要补足另外一个人床位的费用。如在实际旅游过程中能够安排3人间或同性拼房，所付房差费用回团后将根据实际发生情况减免退回。
'>房差</a></span>
                    <select id='diffPrice' onchange='get_price()'>
                    ";
foreach ($fangcha as $key => $val) {
    echo "<option value='$val'>$val</option>";
}
echo "</select><span class=\"jiage\"> &yen;<span class='roomPrice'>$diffPrice</span>/ 份</span>";