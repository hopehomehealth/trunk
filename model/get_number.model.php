<?
include_once 'config/cfg.php';
header("Content-type:text/html;charset=gbk");
function to_gbk($str){
    return mb_convert_encoding($str, 'gbk', 'utf-8');
}
$post = array();
$post['goodsId'] = $_POST['goodsId'];
$post['departDate'] = $_POST['departDate'];
$post['departDate'] = "2016-08-03";
$post['packageId'] = $_POST['packageId'];
$post['isPackage'] = $_POST['isPackage'];
$post['min'] = $_POST['min'];
$post['max'] = $_POST['max'];

$url = "wwwd.bus365.cn" . "/travel/interface/zbyV3.2/getNumberSelectionV_3.2";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$data = curl_exec($ch);
curl_close($ch);
$arr = json_decode($data, true);
$datass = $arr['data'];
$adultmin = $datass['0'];
$adultmax = $datass['1'];

if($post['isPackage'] == 'true'){
    echo "<span class='fenshu'>
            <label for=\"\">�������:</label>
            <select onChange=\"count_price()\">";
            for ($i = $adultmin; $i <= $adultmax; $i++) {
                echo "<option value=\"$i\">$i</option>";
            }
            echo"</select>
            <label for=\"\">���а���:</label>
            ���ˣ�2 / ��ͯ��1

            <a href=\"javascript:void(0);\" class=\"qijia\" style=\"\">���˵��</a>
            <div class=\"qijia_tips\">
                        �������ָδ�������ӷ����絥�˷�����շѵȣ��Ļ����۸�������ȷ�ϵļ۸񽫻�����ѡ�����ա�������������Ŀ���ı�.
            </div>
            </span>";
} else {
    echo "<span class='renshu'>
            <label for=\"\">����</label>
            <select name=\"adult_num\" id=\"adult_num\" style=\"width:60px\" onChange=\"count_price()\">
            <option value=\"0\">0</option>";
                 for ($i = $adultmin; $i <= $adultmax; $i++) {
    echo "<option value=\"$i\">$i</option>";
 }
echo "</select>
<a href=\"javascript:void(0);\" class=\"qijia1\" style=\"\">���˵��</a>
<div class=\"qijia1_tips\">
    �������ָδ�������ӷ����絥�˷�����շѵȣ��Ļ����۸�������ȷ�ϵļ۸񽫻�����ѡ�����ա�������������Ŀ���ı�.
</div>
<label for=\"\">��ͯ</label>
<select name=\"kid_num\" id=\"kid_num\" style=\"width:60px\" onChange=\"count_price()\">
    <option value=\"0\">0</option>";
    for ($i = $adultmin; $i <= $adultmax; $i++) {
       echo "<option value=\"$i\">$i</option>";
    }
    echo "</select>
<iframe id=\"frm\" name=\"frm\" src=\"\" frameborder=\"0\" scrolling=\"no\" width=\"0\" height=\"0\"></iframe>
<a href=\"javascript:void(0);\" class=\"form-tips rel\">
    ��ͯ��˵��<span class=\"box-tips child_tips\" style=\"display:none\"><i class=\"icon\"></i>2-12���ͯ��<br/>
		1.������Ʊ��ȫ����ȡ<br/>
		2.�Ƶ갴�������շ�<br/>
		3.������ʵ���ײ�Ϊ׼</span>
</a>
</span>";
}


?>
