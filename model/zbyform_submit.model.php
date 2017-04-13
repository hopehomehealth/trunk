<?
$db->check_cookie($loginUrl, $host);
//获取上一页值
$goods_type = req('goods_type');
$goods_id = req('goods_id');
$adult_num = req('adult_num');
$kid_num = req('kid_num');
$departdate = req('departdate');
//$departdate1 = substr($departdate,0,4).'-'.substr($departdate,4,2).'-'.substr($departdate,6,2);
$departdate1 = date('Y-m-d',strtotime($departdate));
$linker = req('linker');
$linker = iconv('GBK', 'UTF-8', $linker); //将字符串的编码从GB2312转到UTF-8
$goods_name = req('goods_name');
$pay_price = req('payPrice');
$mobile = req('mobile');
$user_id = req('user_id');
$token = substr($_COOKIE['5fe845d7c136951446ff6a80b8144467'], 1, -1);

$flag = req('flag');
$touristList = '[{"userIdcard":"211481198401154411","userName":"wangge","userPhone":"18841184568"},{"userIdcard":"211481198401154411","userName":"laozhao","userPhone":"18242984568"}]';

$post = array('token' => $token, 'goodsId' => $goods_id, 'departdate' => $departdate1, 'adultNum' => $adult_num, 'kidNum' => $kid_num, 'payPrice' => $pay_price, 'linker' => $linker, 'mobile' => $mobile, 'userId' => '', 'touristList' => $touristList);


//校验订单


if($flag == 'check'){
    $check_form = juhecurl($host . "/travel/interface/order/saveZbyOrder", $post, 1);
    $check_form = json_decode($check_form, true);

    $check_form = array_iconv($check_form, 'UTF-8', 'GBK');
//    var_dump($check_form);die;
    $check_form_data = $check_form['data'];
    $errormsg = $check_form['msg'];
    if ($check_form['status'] != '0000'){
        echo "<script>alert('$errormsg');</script>";
        exit();
    }

    $goodsName = urlencode($check_form_data['goodsName']);
    $payPrice = $check_form_data['payPrice'];
    $orderCode = $check_form_data['orderCode'];
    $payTime = $check_form_data['payTime'];
    $js = "<script>window.location.href='/zhoubianyou/zbyonline_pay-".$goodsName."-".$payPrice."-".$orderCode.".html?time=$payTime'; </script>";
    echo $js;
}

function get_product_detail()
{
    global $host;
    $post['token'] = substr($_COOKIE['5fe845d7c136951446ff6a80b8144467'],1,-1);
//    $post['token'] = '{"clienttoken":"7A4D2543F258FD7062F842ADD950496ADEADB75BEE76FFBD2B153AD5F2BFEE823863DA9C55A8BF58DEB73C9CCABC30326EC113721043ABA98B3EE1771A41993AA089FAEC25AFEE98F057BAFED0D7B2F1","clienttype":"1","devicetoken":"1","ordertoken":"1","wxcityid":"1"}';
//    $post['goodsId'] = '8000000';

    $product_detail = juhecurl($host . "/travel/interface/zby/getGoodsDtail", $post, 1);
    $product_detail = json_decode($product_detail, true);
    $product_detail = array_iconv($product_detail);
    return $product_detail;
}
$product_detail = get_product_detail();
$product_detail_data = $product_detail['data'];



?>