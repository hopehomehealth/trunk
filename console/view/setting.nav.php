<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>
 
<ul class="nav nav-tabs">   
	<li <?if(nav_active('setting_site.php')){?>class="active"<?}?> style="padding-left:20px;">
		<a href="?cmd=<?=base64_encode('setting_site.php')?>">վ������</a>
	</li>   
	<li <?if(nav_active('setting_domain.php')){?>class="active"<?}?>>
		<a href="?cmd=<?=base64_encode('setting_domain.php')?>">������</a>
	</li>   
	<li <?if(nav_active('setting_im.php')){?>class="active"<?}?>>
		<a href="?cmd=<?=base64_encode('setting_im.php')?>">���߿ͷ�����</a>
	</li>  
	<li <?if(nav_active('setting_profile.php')){?>class="active"<?}?>>
		<a href="?cmd=<?=base64_encode('setting_profile.php')?>">ƽ̨��������</a>
	</li>  
	<li <?if(nav_active('setting_pay.php')){?>class="active"<?}?>>
		<a href="?cmd=<?=base64_encode('setting_pay.php')?>">֧������</a>
	</li>  
	<li <?if(nav_active('setting_other.php')){?>class="active"<?}?>>
		<a href="?cmd=<?=base64_encode('setting_other.php')?>">��������</a>
	</li>  
</ul>  

 