<?
header("Content-type:text/html;charset=utf-8");

// ֧������
$post['token'] = substr($_COOKIE['5fe845d7c136951446ff6a80b8144467'], 1, -1);
$post['orderno'] = $_SESSION['orderCode'];
$post['totalprice'] = $_SESSION['payPrice'];
$post['topayinfoid'] = req('topayinfoid');//  ֧������ID
$post['successpage'] = $g_self_domain . '/menpiao/ticket_pay_status.html';// �ص���ַ

// ����֧���ӿ�
$url = $host . '/travel/interface/pay/createpayparam';
$result = $db->api_post($url, $post);
$results = json_decode($result, true);
$info = $db->to_utf8("֧��ʧ��!");

// �жϷ��ز���
if ($results['status'] != '0000') {
    echo "<script>alert('$info');window.location.href = '/menpiao/';</script>";
    exit;
}

// ������ص�ҳ��
if ($post['topayinfoid'] == '65') {
    echo $results['data'];
    $js = "<script>document.getElementById('form_payment').submit();</script>";
    echo $js;
} else if ($post['topayinfoid'] == '71') {
    $url = 'http://' . $host . '/travel/interface/pay/scanQRCode?code_url=' . $results['data'];
    echo $url;
} else if ($post['topayinfoid'] == '189') {
    echo $results['data'];
    $js = "<script>document.getElementById('form_payment').submit();</script>";
    echo $js;
}

?>

