<?
//ÉêÇëÍË¿î
function require_refund()
{
    global $host;
    $post['token'] = '{"clienttoken":"7A4D2543F258FD7062F842ADD950496ADEADB75BEE76FFBD2B153AD5F2BFEE823863DA9C55A8BF58DEB73C9CCABC30326EC113721043ABA98B3EE1771A41993AA089FAEC25AFEE98F057BAFED0D7B2F1","clienttype":"1","devicetoken":"1","ordertoken":"1","wxcityid":"1"}';
//    $post['orderCode'] = '9908000760 ';
//    $post['refundReasonCode'] = '1';
    $post['refundReasonCode'] = req('refundReasonCode');
    $post['orderCode'] = req('orderCode');


    $require_refund = post_curl($host."/travel/interface/menpiao/refundTicket", $post);
    $require_refund = json_decode($require_refund, true);
    $require_refund = array_iconv($require_refund, 'UTF-8', 'GBK');
    if ($require_refund['status'] != '0000'){
        $js = "<script>alert('ÍË¿îÊ§°Ü');history.go(-1);</script>";
        echo $js;
    }
    return $require_refund;
}

$require_refund = require_refund();
//echo "<pre>";
//var_dump($require_refund);

$require_refund_data = $require_refund['data'];

?>