<?php 
$wx = unserialize($g_config['wx_config']);

$appid = $wx['appid']; 
$callback_url = urlencode('http://'.$_SERVER['HTTP_HOST'].'/member/weixin/wx_callback.php');

// snsapi_base 
// snsapi_userinfo
 
$wx_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$callback_url.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';

clearcookies('CLOOTA_B2B2C_USER_UUID');
clearcookies('CLOOTA_B2B2C_WEIXIN_ID'); 
?>
<script type="text/javascript"> 
location.href='<?=$wx_url?>';
</script>