<?
$db->check_cookie($loginUrl, $host);
$orderCode = req('orderCode');
$flag = req('flag');
$post['content'] = gbk_to_utf8(req('content'));
$post['commentLevel'] = req('commentLevel');
$post['orderCode'] = req('orderCode');
$post['token'] = substr($_COOKIE['5fe845d7c136951446ff6a80b8144467'],1,-1);


//var_dump($_REQUEST);
if($flag == 'cm'){
    $ticket_comment = $db->api_post( $host . "/travel/interface/goodsComment/submitComment", $post);
    $ticket_comment = json_decode($ticket_comment, true);

    $ticket_comment = array_iconv($ticket_comment);
    $msg = $ticket_comment['msg'];
//    var_dump($ticket_comment);
    if ($ticket_comment['status'] != '0000') {
        $js = "<script>alert('$msg');history.go(-1);</script>";
        echo $js;
        exit();
    }
    $ticket_comment_data = $ticket_comment['data'];

    $message = urlencode($ticket_comment_data['message']);
    $js = "<script>window.location.href='/zhoubianyou/zbycomment_success-".$orderCode.".html?message=".$message."' </script>";
    echo $js;

}



?>