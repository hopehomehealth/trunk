<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>
 
<ul class="nav nav-tabs">   
	<li <?if(nav_active('setting_site.php')){?>class="active"<?}?> style="padding-left:20px;">
		<a href="?cmd=<?=base64_encode('setting_site.php')?>">站点设置</a>
	</li>   
	<li <?if(nav_active('setting_domain.php')){?>class="active"<?}?>>
		<a href="?cmd=<?=base64_encode('setting_domain.php')?>">域名绑定</a>
	</li>   
	<li <?if(nav_active('setting_im.php')){?>class="active"<?}?>>
		<a href="?cmd=<?=base64_encode('setting_im.php')?>">在线客服设置</a>
	</li>  
	<li <?if(nav_active('setting_profile.php')){?>class="active"<?}?>>
		<a href="?cmd=<?=base64_encode('setting_profile.php')?>">平台资料设置</a>
	</li>  
	<li <?if(nav_active('setting_pay.php')){?>class="active"<?}?>>
		<a href="?cmd=<?=base64_encode('setting_pay.php')?>">支付配置</a>
	</li>  
	<li <?if(nav_active('setting_other.php')){?>class="active"<?}?>>
		<a href="?cmd=<?=base64_encode('setting_other.php')?>">其他设置</a>
	</li>  
</ul>  

 