<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?> 

<ul class="nav nav-tabs" id="myTab">  

	<li <?if(nav_active('wx_home_nav.php')){?>class="active"<?}?> style="padding-left:20px;">
		<a href="?cmd=<?=base64_encode('wx_home_nav.php')?>">΢����ҳ����</a>
	</li>  

	<li <?if(nav_active('wx_home_dist.php')){?>class="active"<?}?>>
		<a href="?cmd=<?=base64_encode('wx_home_dist.php')?>">΢����ҳĿ�ĵ�</a>
	</li>  
</ul>