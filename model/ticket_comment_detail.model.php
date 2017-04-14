<?
$db->check_cookie($loginUrl, $host);
$orderCode = req('orderCode');
$post['token'] = substr($_COOKIE['5fe845d7c136951446ff6a80b8144467'],1,-1);
$post['orderCode'] = req('orderCode');

$comment_detail = post_curl($host . "/travel/interface/goodsComment/getGoodsComment", $post);

$comment_detail = json_decode($comment_detail, true);
$comment_detail = array_iconv($comment_detail);
if ($comment_detail['status'] != '0000'){
    exit($comment_detail['msg']);
}

$comment_detail_data = $comment_detail['data'];
//var_dump($comment_detail_data);


?>
