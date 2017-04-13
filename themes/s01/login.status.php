<?
if($_COOKIE['CLOOTA_B2B2C_USER_UUID']!=''){ 
?>
document.write('<span><a class="toplink" href="/member/">欢迎：<strong><?=$g_user['account']?></strong> 进入会员中心</a> | <a href="/member/logout">安全退出</a></span>');
<?
}elseif($_COOKIE['CLOOTA_B2B2C_SHOP_UUID']!=''){ 
?>
document.write('<span><a class="toplink" href="/seller/">欢迎：<strong><?=$g_shop['shop_name']?></strong> 进入供应商中心</a> | <a href="/seller/logout">安全退出</a></span>');
<?}else{?>
document.write('<li><a class="toplink" href="/member/login">登录</a></li>');
document.write('<li class="last"><a class="toplink" href="/member/register">注册</a></li>');
<?}?>