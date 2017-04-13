<?
$db->check_cookie($loginUrl, $host);
$orderCode = req('orderCode');
//echo $orderCode;
$message = urldecode(req('message'));
//echo $message;
?>