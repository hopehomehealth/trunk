<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<script type="text/javascript">
$(document).ready(function(){
	$('#myTab a').click(function (e) { 
		e.preventDefault();
		$(this).tab('show'); 
	})
}); 
</script>

<style type="text/css">
.lazy{
	max-width:148px;
	max-height:148px;
}
</style> 

<ul class="nav nav-tabs" id="myTab"> 
  <li class="active" style="padding-left:20px"><a href="#tabs-1">PC��ģ��ͼƬ</a></li>
  <li><a href="#tabs-2">���߶�ģ��ͼƬ</a></li>
  <li><a href="#tabs-3">���ϴ���ͼƬ</a></li>
</ul>

<div class="tab-content"> 
	<div class="tab-pane in active" id="tabs-1">  
		<?
		$dir = $g_root.'themes/'.$g_tpl.'/images' ;

		$dir_handle = opendir($dir);

		if($dir_handle)
		{
			while(($file=readdir($dir_handle))!==false)
			{
				if($file==='.' || $file==='..')
				{
						continue;
				}

				$tmp = realpath($dir.'/'.$file);

				if(!is_dir($tmp))
				{
					$filetype = substr(strtolower($file),-3);
					if($filetype=='gif' || $filetype=='png' || $filetype=='jpg' || $filetype=='jpeg' || $filetype=='ico'){
						$filemd5 = md5($file);

						$this_image = "themes/$g_tpl/images/$file"; // Ĭ��ģ��ͼƬ
						$this_user_image = "diy/$g_siteid/$g_tpl/images/$file"; // �û��滻��ͼƬ

						if(file_exists($g_root.$this_user_image)){
							$preview_image = "/diy/$g_siteid/$g_tpl/images/$file";
						} else {
							$preview_image = "/themes/$g_tpl/images/$file";
						}
						$src_image = "/themes/$g_tpl/images/$file";
		?> 
			<table id="img<?=md5($file)?>" class="imagebox" style="float:left;width:242px;">

			<tr><td align="center" valign="center" style="height:150px;overflow:hidden"><a href="<?=$preview_image?>" title="����鿴��ͼ" ><img  src="<?=$preview_image?>" /></a></td></tr>

			<tr><td align="center" height="20"> <span onclick="dialog_edit('./?cmd=<?=base64_encode('imagebox_replace.php')?>&modal=true&type=tpl&tpl=<?=$g_tpl?>&f=<?=$file?>&src=<?=$src_image?>')" style="cursor:pointer">�滻</span> <?if(file_exists($g_root.$this_user_image)){?><a href="do.php?cmd=image_reback&tpl=<?=$g_tpl?>&f=<?=$file?>" title="��ԭΪԭʼͼƬ">��ԭ</a><?}?>
			<input type="text" name="" value="/images/<?=$file?>" style="width:140px;font-size:8px;" title="���Ƶ�ַ" onclick="this.select();">
			</td></tr>

			</table>
		<?
					}
				}
			}
			closedir($dir_handle);
		}
		 
		?>      
		<div style="clear:both"></div>
		<B>��ʾ</B>��IE�������ʱ�᲻��ʾ�滻����ͼƬ����F5ˢ�¼��ɡ�
	</div> 

	<div id="tabs-2" class="tab-pane">   
		<?
		$g_tpl = $g_login['mobile_tpl_name'];

		$dir = $g_root.'themes/'.$g_tpl.'/images' ;

		$dir_handle = opendir($dir);

		if($dir_handle)
		{
			while(($file=readdir($dir_handle))!==false)
			{
				if($file==='.' || $file==='..')
				{
						continue;
				}

				$tmp = realpath($dir.'/'.$file);

				if(!is_dir($tmp))
				{
					$filetype = substr(strtolower($file),-3);
					if($filetype=='gif' || $filetype=='png' || $filetype=='jpg' || $filetype=='jpeg' || $filetype=='ico'){
						$filemd5 = md5($file);

						$this_image = "themes/$g_tpl/images/$file"; // Ĭ��ģ��ͼƬ
						$this_user_image = "diy/$g_siteid/$g_tpl/images/$file"; // �û��滻��ͼƬ

						if(file_exists($g_root.$this_user_image)){
							$preview_image = "/diy/$g_siteid/$g_tpl/images/$file";
						} else {
							$preview_image = "/themes/$g_tpl/images/$file";
						}
						$src_image = "/themes/$g_tpl/images/$file";
		?> 
			<table id="img<?=md5($file)?>" class="imagebox">

			<tr><td align="center" valign="center" style="height:150px;overflow:hidden"><a href="<?=$preview_image?>" title="����鿴��ͼ" ><img  src="<?=$preview_image?>" src="static/image/blank.gif"   /></a></td></tr>

			<tr><td align="center" height="20"> <span onclick="dialog_edit('./?cmd=<?=base64_encode('imagebox_replace.php')?>&modal=true&type=tpl&tpl=<?=$g_tpl?>&f=<?=$file?>&src=<?=$src_image?>')" style="cursor:pointer">�滻</span> <?if(file_exists($g_root.$this_user_image)){?><a href="do.php?cmd=image_reback&tpl=<?=$g_tpl?>&f=<?=$file?>" title="��ԭΪԭʼͼƬ">��ԭ</a><?}?>
			<input type="text" name="" value="/images/<?=$file?>" style="width:140px;font-size:8px;" title="���Ƶ�ַ" onclick="this.select();">
			</td></tr>

			</table>
		<?
					}
				}
			}
			closedir($dir_handle);
		}
		 
		?>      
		<div style="clear:both"></div>
		<B>��ʾ</B>��IE�������ʱ�᲻��ʾ�滻����ͼƬ����F5ˢ�¼��ɡ�
	</div> 

	<div id="tabs-3" class="tab-pane">
		<form target="frm" name="goods_form" action="do.php?cmd=image_upload" method="post" enctype="multipart/form-data">
		  <table width="100%">
			<tr> 
			  <td><input name="myimage" type="file" id="myimage" size="40" required/> <input type="submit" value="ȷ��" class="btn btn-danger" /></td>  
			  <td>֧��3��ͼƬ��ʽ��GIF/JPG/PNG</td>
			</tr>
		  </table> 
		</form>
		<div style="clear:both"><br/></div>

		<?
		$dir = $g_root.'upfiles/'.$g_siteid.'/myspace';

		if(file_exists($dir)==false) mkdir($dir); 

		$dir_handle = opendir($dir);

		if($dir_handle)
		{
			while(($file=readdir($dir_handle))!==false)
			{
				if($file==='.' || $file==='..')
				{
						continue;
				}

				$tmp = realpath($dir.'/'.$file);

				if(!is_dir($tmp))
				{
					$filetype = substr(strtolower($file),-3);
					if($filetype=='gif' || $filetype=='png' || $filetype=='jpg'){
						$filemd5 = md5($file);
 
						$preview_image = "/upfiles/$g_siteid/myspace/$file"; 
		?> 
			<table style="float:left;width:150px;padding:0px;margin-right:10px;margin-bottom:30px;overflow:hidden;border:1px solid #efefef;" > 

			<tr><td align="center" valign="center" style="height:150px;"><a href="<?=$preview_image?>" title="����鿴��ͼ" ><img   src="<?=$preview_image?>" width="100%" src="static/image/blank.gif"  /></a></td></tr>

			<tr><td align="center" height="20"><a href="javascript:void(0)" onclick="copyToClipBoard('<?=$preview_image?>')">����</a> <span onclick="dialog_edit('imagebox_replace.php?type=my&f=<?=$file?>')" style="cursor:pointer">�滻</span> <a href="do.php?cmd=imagebox_del&f=<?=$file?>">ɾ��</a><br/>
			<input type="text" name="" value="/upfiles/<?=$g_siteid.'/'.$file?>" style="width:140px;font-size:8px;" title="���Ƶ�ַ" onclick="this.select();">
			</td></tr>
			</table>
		<?
					}
				}
			}
			closedir($dir_handle);
		}
		 
		?>    
		<div style="clear:both"></div>

		<B>��ʾ</B>��IE�������ʱ�᲻��ʾ�滻����ͼƬ����F5ˢ�¼��ɡ�
	</div>
 
</div>
 