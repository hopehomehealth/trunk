<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>
 
<ul class="nav nav-tabs" id="myTab"> 
   
	<li <?if(nav_active('wx_vcard.php')){?>class="active"<?}?> style="padding-left:20px;">
		<a href="?cmd=<?=base64_encode('wx_vcard.php')?>">���ι���</a>
	</li> 

	<li <?if(nav_active('wx_vcard_add.php')){?>class="active"<?}?>>
		<a href="?cmd=<?=base64_encode('wx_vcard_add.php')?>">��������</a>
	</li>    
</ul>
   
				 
		<form name="q_from" method="GET" action="" class="form-inline">   
			<input name="cmd" type="hidden" value="<?=base64_encode('wx_vcard.php')?>"/> 
			<input name="kw" type="text" id="kw" class="span4" value="<?=req('kw')?>" placeholder="�������ֻ��š�" required/>   
			<input type="image" src="static/image/find.gif" class="input_img" title="����"/>  
 
		</form> 
 
		<table width="100%"> 
			<tr>
				<td valign="top"> 
				<? 
				  if(notnull($rows)){
				?>
				<table class="table table-hover">
				  <tbody>
				  <tr>  
					<th>��������</th> 
					<th></th>
					<th>�ֻ���</th>
					<th>�����ʼ�</th>  
					<th>QQ��</th>  
					<th>���ʼ��</th>  
					<th width="50">����</th> 
				  </tr>  
				  </tbody>
				  <?  
					foreach ($rows as $val){ 
						$profiles = unserialize($val['profiles']);
				  ?> 
				  <tr> 
					<td><?=$profiles['username']?></td>

					<td><img src="/upfiles/<?=$g_siteid?>/<?=$val['avatar']?>" style="width:80px; " class="img-polaroid"></td>
	  
					<td><?=$profiles['mobile']?></td>

					<td><?=$profiles['email']?></td>

					<td><?=$profiles['qq']?></td>

					<td><?=$profiles['note']?></td>
					
					<td align="center">
						<span onclick="dialog_edit('./?cmd=<?=base64_encode('wx_vcard_edit.php')?>&modal=true&vcard_id=<?=$val['vcard_id']?>')" style="cursor:pointer"><img src="static/image/edit.gif"/></span> &nbsp;
						<a href="do.php?cmd=vcard_del&vcard_id=<?=$val['vcard_id']?>" onclick="return confirm('ȷ��ɾ����')"><img src="static/image/delete.gif"/></a> 
					</td>
				  </tr> 
				  <?	 
					}
				  ?>
				</table>  
				<?	 
				  }
				?>
				</td>
			</tr>
		</table> 
	 