<?
if($_COOKIE['CLOOTA_B2B2C_USER_UUID']!=''){ 
?>
document.write('<span><a class="toplink" href="/member/">��ӭ��<strong><?=$g_user['account']?></strong> �����Ա����</a> | <a href="/member/logout">��ȫ�˳�</a></span>');
<?
}elseif($_COOKIE['CLOOTA_B2B2C_SHOP_UUID']!=''){ 
?>
document.write('<span><a class="toplink" href="/seller/">��ӭ��<strong><?=$g_shop['shop_name']?></strong> ���빩Ӧ������</a> | <a href="/seller/logout">��ȫ�˳�</a></span>');
<?}else{?>
document.write('<li><a class="toplink" href="/member/login">��¼</a></li>');
document.write('<li class="last"><a class="toplink" href="/member/register">ע��</a></li>');
<?}?>