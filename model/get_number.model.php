<?
include_once '../config.php';
header("Content-type:text/html;charset=gbk");
function to_gbk($str){
    return mb_convert_encoding($str, 'gbk', 'utf-8');
}
$post = array();
//$post['lvProductId'] = $_POST['productId'];
//$post['departDate'] = $_POST['departDate'];
//$post['packageId'] = $_POST['packageId'];
$post['isPackage'] = $_POST['isPackage'];
//$post['min'] = $_POST['min'];
//$post['max'] = $_POST['max'];
//���ˣ�������ѡ����
$adultmin = $_POST['adultmin'];
$adultmax = $_POST['adultmax'];
//��ͯѡ����
$childmin = $_POST['childmin'];
$childmax = $_POST['childmax'];
$adultNum = $_POST['adultNum'];
if($adultNum == ''){
    $adultNum = '0';
}
$kidNum = $_POST['kidNum'];
if($kidNum == ''){
    $kidNum = '0';
}
if (!isset($_SESSION)){
    session_start();    
}
$childPriceInfo = $_SESSION['childPriceInfo'];
////��ȡ��������ѡ����
//$url = $host . "/travel/interface/zby/v3.2/getNumberSelection_v3.2";
//$data = $db->api_post($url, $post);
//$arr = json_decode($data, true);
//$datass = $arr['data'];
//$adultmin = $datass['0'];
//$adultmax = $datass['1'];
////��ȡ��ͯ����ѡ����
//$url = $host . "/travel/interface/zby/v3.2/getNumberSelectionChild";
//$data = $db->api_post($url, $post);
//$arr = json_decode($data, true);
//$arrs = $arr['data'];
//$childmin = $arrs['0'];
//$childmax = $arrs['1'];

if($post['isPackage'] == 'true'){
    echo "<span class='fenshu' style='padding-left: 25px;'>
            <label for=\"\">�������:</label>
            <select id='fenshu' onchange='count_price()'>
            ";
            for ($i = $adultmin; $i <= $adultmax; $i++) {
                echo "<option value=\"$i\">$i</option>";
            }
            echo"</select>
            <label for=\"\">���а���:</label>
            ���ˣ�$adultNum  ��ͯ��$kidNum

            <a href=\"javascript:void(0);\" class=\"qijia\" style=\"font-size: 12px;\">���˵��</a>
            <div class=\"qijia_tips\">
                        �������ָδ�������ӷ����絥�˷�����շѵȣ��Ļ����۸�������ȷ�ϵļ۸񽫻�����ѡ�����ա�������������Ŀ���ı�.
            </div>
            </span>";
} else {
    echo "<span class='renshu' style=\" padding-left: 25px;\">
            <label for=\"\">����</label>
            <select name=\"adult_num\" id=\"adult_num\" style=\"width:60px\" onChange=\"count_price()\">
            ";
                 for ($i = $adultmin; $i <= $adultmax; $i++) {
    echo "<option value=\"$i\">$i</option>";
 }
echo "</select>
<a href=\"javascript:void(0);\" class=\"qijia1\" style=\"text-decoration: underline;font-size: 12px;\">���˵��</a>
<div class=\"qijia1_tips\">
    <i></i>
    <div>
        �������ָδ�������ӷ����絥�˷�����շѵȣ��Ļ����۸�������ȷ�ϵļ۸񽫻�����ѡ�����ա�������������Ŀ���ı�.
    </div>
</div>
<label for=\"\" style=\" padding-left: 25px;\">��ͯ</label>
<select name=\"kid_num\" id=\"kid_num\" style=\"width:60px\" onChange=\"count_price()\">
    ";
    for ($i = $childmin; $i <= $childmax; $i++) {
       echo "<option value=\"$i\">$i</option>";
    }
    echo "</select>
<iframe id=\"frm\" name=\"frm\" src=\"\" frameborder=\"0\" scrolling=\"no\" width=\"0\" height=\"0\"></iframe>
";
    if(!empty($childPriceInfo)){
        echo "<a href=\"javascript:void(0);\" class=\"form-tips rel\">
    ��ͯ��˵��<span class=\"box-tips child_tips\" style=\"display:none\"><i class=\"icon\"></i>$childPriceInfo</span>
</a>";
    }
    echo "</span>";
}

?>