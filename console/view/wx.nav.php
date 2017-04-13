<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?> 

<ul class="nav nav-tabs" id="myTab"> 
   
	<li <?if(nav_active('wx_setting.php')){?>class="active"<?}?> style="padding-left:20px;">
		<a href="?cmd=<?=base64_encode('wx_setting.php')?>">微信接入</a>
	</li> 

	<li <?if(nav_active('wx_vcard.php')){?>class="active"<?}?>>
		<a href="?cmd=<?=base64_encode('wx_vcard.php')?>">微信名片</a>
	</li>   

	<li <?if(nav_active('wx_home_nav.php')){?>class="active"<?}?>>
		<a href="?cmd=<?=base64_encode('wx_home_nav.php')?>">微首页导航</a>
	</li>  

	<li <?if(nav_active('wx_home_dist.php')){?>class="active"<?}?>>
		<a href="?cmd=<?=base64_encode('wx_home_dist.php')?>">微首页目的地</a>
	</li>  
</ul>