<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>
 
<div class="bar_title">
	<strong>客服设置</strong> 
</div> 

 
		<form target="frm" method="post" action="do.php?cmd=shop_im" enctype="multipart/form-data" >
			<table width="100%">  
			  <tr>
				<td width="100" align="right">在线QQ列表：</td>
				<td><textarea name="im_qq" rows="5" cols="20" class="span6" placeholder="一行一个QQ号"><?=$g_shop['im_qq']?></textarea></td>
			  </tr>
			  <tr>
				<td align="right">在线旺旺列表：</td>
				<td><textarea name="im_ww" rows="5" cols="20" class="span6" placeholder="一行一个旺旺号"><?=$g_shop['im_ww']?></textarea></td>
			  </tr>
			  <tr>
				<td></td>
				<td><input type="submit" value="确定" class="btn btn-danger" /></td>
			  </tr>   
			</table>
		</form>
 