<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}

if($g_root=='') die('��ֹ����');
if($g_siteid=='') die('��ֹ����');
?>


<ul class="nav nav-tabs" id="myTab"> 
  <li class="active" style="padding-left:20px"><a href="#tabs-1">��ջ���</a></li> 
</ul>
 
		<? 
		$dir = $g_root.'cache/'.$g_siteid.'/' ;

		if(is_dir($dir)==true){

			$dir_handle = opendir($dir);

			$i=0;

			if($dir_handle)
			{
				while(($file=readdir($dir_handle))!==false)
				{
					if($file==='.' || $file==='..')
					{
							continue;
					}

					$tmp = realpath($dir.'/'.$file);

					if(is_file($tmp))
					{
						$i++;
						unlink($tmp); 
					}
				}
				closedir($dir_handle);
			} 
			?>
			<p>��� <b><?=$i?></b> �������ļ�</p>
		<?
		}
		?>  
		
		<?
		//include('util/reset_goods_cat_level.php');
		?>

		<?
		include('util/theme_spider.php');
		?>

		<p>�������ָ����ִ�У�</p>
 