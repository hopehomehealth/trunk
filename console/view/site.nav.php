<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>
 
<ul class="nav nav-tabs">   
	<li <?if(nav_active('site_menu.php')){?>class="active"<?}?> style="padding-left:20px;">
		<a href="?cmd=<?=base64_encode('site_menu.php')?>">�����˵�</a>
	</li>   
	<li <?if(nav_active('site_ppt.php')){?>class="active"<?}?>>
		<a href="?cmd=<?=base64_encode('site_ppt.php')?>">�ֲ�ͼ</a>
	</li>     

	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">ˢ��</a>
</ul> 
 	 	
