<?
$db->check_cookie($loginUrl, $host);
function pay_success()
{
    global $host;
    $post['token'] = substr($_COOKIE['5fe845d7c136951446ff6a80b8144467'],1,-1);
//    $post['token'] = '{"clienttoken":"7A4D2543F258FD7062F842ADD950496ADEADB75BEE76FFBD2B153AD5F2BFEE823863DA9C55A8BF58DEB73C9CCABC30326EC113721043ABA98B3EE1771A41993AA089FAEC25AFEE98F057BAFED0D7B2F1","clienttype":"1","devicetoken":"1","ordertoken":"1","wxcityid":"1"}';
    $post['orderCode'] = req('orderCode');
    $pay_success = juhecurl($host . "/travel/interface/zby/getZbyOrderDetail", $post, 1);
    $pay_success = json_decode($pay_success, true);
    $pay_success = array_iconv($pay_success);
//var_dump($pay_success);
//if ($pay_success['status'] != '0000'){
//    exit('Ö§¸¶Ê§°Ü');
//}
    return $pay_success;
}
$pay_success = pay_success();
$pay_success_data = $pay_success['data'];



?>