<?
$db->check_cookie($loginUrl, $host);
$orderCode = req('orderCode');
$flag = req('flag');
$post['content'] = gbk_to_utf8(req('content'));
$post['commentLevel'] = req('commentLevel');
$post['orderCode'] = req('orderCode');
$post['token'] = substr($_COOKIE['5fe845d7c136951446ff6a80b8144467'],1,-1);

//$post['token'] = '{"clienttoken":"7A4D2543F258FD7062F842ADD950496ADEADB75BEE76FFBD2B153AD5F2BFEE823863DA9C55A8BF58DEB73C9CCABC30326EC113721043ABA98B3EE1771A41993AA089FAEC25AFEE98F057BAFED0D7B2F1","clienttype":"1","devicetoken":"1","ordertoken":"1","wxcityid":"1"}';


//var_dump($_REQUEST);
if($flag == 'cm'){
    $ticket_comment = $db->api_post( $host . "/travel/interface/goodsComment/submitComment", $post);
       $ticket_comment = json_decode($ticket_comment, true);

        $ticket_comment = array_iconv($ticket_comment);
    if ($ticket_comment['status'] != '0000') {
        $js = "<script>alert(".$ticket_comment['msg'].");history.go(-1);</script>";
        echo $js;
    }
    $ticket_comment_data = $ticket_comment['data'];
    $message = urlencode($ticket_comment_data['message']);
    $js = "<script>window.location.href='/menpiao/ticket_comment_success-".$orderCode.".html?message=".$message."' </script>";
   echo $js;


}



?>