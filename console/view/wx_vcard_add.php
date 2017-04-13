<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>
 
<ul class="nav nav-tabs" id="myTab"> 
   
	<li <?if(nav_active('wx_vcard.php')){?>class="active"<?}?> style="padding-left:20px;">
		<a href="?cmd=<?=base64_encode('wx_vcard.php')?>">旅游顾问</a>
	</li> 

	<li <?if(nav_active('wx_vcard_add.php')){?>class="active"<?}?>>
		<a href="?cmd=<?=base64_encode('wx_vcard_add.php')?>">新增顾问</a>
	</li>    
</ul>
  
  
		<form target="frm" method="post" action="do.php?cmd=vcard_add" enctype="multipart/form-data"> 
			<table width="100%"> 
				<tr>
					<td width="80" align="right"><font color="red">*</font> 姓 名：</td>
					<td><input name="username" type="text" id="username" size="10" required/></td>
				</tr>
				<tr>
					<td align="right"><font color="red">*</font> 头 像：</td>
					<td> 
					<input name="avatar" type="file" size="10" required/> 宽度100像素 / 高度100像素
					</td>
				</tr>  
				<tr>
					<td align="right">常用邮件：</td>
					<td><input name="email" type="email" size="25" /></td>
				</tr>
				<tr>
					<td align="right">QQ号：</td>
					<td><input name="qq" type="number" size="25" /></td>
				</tr>
				<tr>
					<td align="right"><font color="red">*</font> 手机号：</td>
					<td><input name="mobile" type="number" size="11" required/></td>
				</tr>
				<tr>
					<td align="right"><font color="red">*</font> 门店：</td>
					<td><input name="store" type="text" required/></td>
				</tr>
				<tr>
					<td align="right"><font color="red">*</font> 地址：</td>
					<td><input name="address" type="text" required/></td>
				</tr>
				<tr>
					<td align="right"><font color="red">*</font> 简介：</td>
					<td><textarea name="note" rows="3" class="span6" required></textarea></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="确定" class="btn btn-danger" /> </td>
				</tr>
			</table> 
		</form>  