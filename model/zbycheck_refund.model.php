<?
$host = 'http://192.168.3.63';
$orderCode =$_POST['orderCode'];
$token = substr($_COOKIE['5fe845d7c136951446ff6a80b8144467'],1,-1);
//退款产品信息检验
$post1 = array('orderCode' => $orderCode, 'token' => $token);
$refund_product = juhecurl( $host . "/travel/interface/zby/zbyRefundInfo", $post1, 1);
$refund_product = json_decode($refund_product, true);
$refund_product_data = $refund_product['data'];
$refundReasonList = $refund_product_data['refundReasonList'];
$isChange = $refund_product_data['isChange'];
$failReason = $refund_product_data['failReason'];
echo $isChange;
//var_dump($refund_product);





function juhecurl($url, $params = false, $ispost = 0)
{
    $httpInfo = array();
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22');
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    if ($ispost) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_URL, $url);
    } else {
        if ($params) {
            curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
        } else {
            curl_setopt($ch, CURLOPT_URL, $url);
        }
    }
    $response = curl_exec($ch);
    if ($response === FALSE) {
        return false;
    }
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
    curl_close($ch);
    return $response;
}



/**
 * UTF-8编码 GBK编码相互转换/（支持数组）
 *
 * @param array $str   字符串，支持数组传递
 * @param string $in_charset 原字符串编码
 * @param string $out_charset 输出的字符串编码
 * @return array
 */
function array_iconv($str, $in_charset="utf-8", $out_charset="gbk")
{
    if(is_array($str))
    {
        foreach($str as $k => $v)
        {
            $str[$k] = array_iconv($v);
        }
        return $str;
    }
    else
    {
        if(is_string($str))
        {
            // return iconv('UTF-8', 'GBK//IGNORE', $str);
            return mb_convert_encoding($str, $out_charset, $in_charset);
        }
        else
        {
            return $str;
        }
    }
}
