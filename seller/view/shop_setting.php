<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<div class="bar_title">
	<strong>�̼�����</strong>
	<a href="javascript:location.reload()" class="pull-right btn btn-small">ˢ��</a>
</div> 

 
		<form  method="post" action="do.php?cmd=shop_setting" enctype="multipart/form-data" >
			<table width="100%"> 
			  <tr>
				<td width="100" align="right"><font color="red">*</font> ��˾���ƣ�</td>
				<td><input name="shop_name" type="text" id="shop_name" class="span6" required value="<?=$g_shop['shop_name']?>"/></td>
			  </tr>
			  <tr>
				<td align="right" height="30"> ��Ӷ������</td>
				<td><?=$g_shop['fee_rate']?>%</td>
			  </tr>
			  <tr>
				<td align="right" height="30"> �Ƿ���˲�Ʒ��</td>
				<td><?if($g_shop['is_verify_goods']=='1'){?>��<?}else{?>��<?}?></td>
			  </tr>
			  <tr>
				<td align="right"> ����ǰ׺��</td>
				<td><input name="shop_domain" type="text" id="shop_domain" class="span6" disabled value="<?=$g_shop['shop_domain']?>"/></td>
			  </tr> 
			  <tr>
				<td align="right"> �������֤��</td>
				<td><input name="cert_code" type="text" id="cert_code" class="span6" disabled value="<?=$g_shop['cert_code']?>"/></td>
			  </tr> 
			  <tr>
				<td align="right"> ��Ӫ��Χ��</td>
				<td><input name="cert_scope" type="text" id="cert_scope" class="span6" disabled value="<?=$g_shop['cert_scope']?>"/></td>
			  </tr> 
			  <tr>
				<td align="right">��˾LOGO��</td>
				<td>
				<?
				if($g_shop['shop_ico']!=''){
					$shop_ico = "/upfiles/$g_siteid/".$g_shop['shop_ico'];
				?>
				<img src="<?=$shop_ico?>" width="100" ><br/>
				<?}?>
				<input name="shop_ico" type="file" id="shop_ico" size="10" /></td>
			  </tr> 
			  <tr>
				<td align="right"><font color="red">*</font> ���ߵ绰��</td>
				<td><input name="hotline" type="text" id="hotline" class="span6" required value="<?=$g_shop['hotline']?>"/></td>
			  </tr>
			  <tr>
				<td align="right"><font color="red">*</font> ��˾��ַ��</td>
				<td><input name="address" type="text" id="address" class="span6" required value="<?=$g_shop['address']?>"/></td>
			  </tr>
			  <tr>
				<td align="right"><font color="red">*</font> ��ϵ�ˣ�</td>
				<td><input name="linker" type="text" id="linker" class="span6" required value="<?=$g_shop['linker']?>"/></td>
			  </tr>
			  <tr>
				<td align="right"><font color="red">*</font>  �������䣺</td>
				<td><input name="email" type="text" id="email" class="span6" value="<?=$g_shop['email']?>" placeholder="����֪ͨ������ʹ��..."/></td>
			  </tr>
			  <tr>
				<td align="right"><font color="red">*</font> �ֻ����룺</td>
				<td><input name="mobile" type="text" id="mobile" class="span6" required value="<?=$g_shop['mobile']?>"/></td>
			  </tr>
			  <tr>
				<td align="right"> QQ���룺</td>
				<td><input name="qq" type="text" id="qq" class="span6" value="<?=$g_shop['qq']?>"/></td>
			  </tr>
			  <tr>
				<td align="right"> ������룺</td>
				<td><input name="fax" type="text" id="fax" class="span6" value="<?=$g_shop['fax']?>"/></td>
			  </tr>
			  <tr>
				<td align="right"> �̶��绰��</td>
				<td><input name="tel" type="text" id="tel" class="span6" value="<?=$g_shop['tel']?>"/></td>
			  </tr>
			  <tr>
				<td align="right">��Ҫ������</td>
				<td><textarea name="shop_note" rows="5" cols="20" class="span9"><?=$g_shop['shop_note']?></textarea></td>
			  </tr>
			  <tr>
				<td></td>
				<td><input type="submit" value="ȷ��" class="btn btn-danger" /></td>
			  </tr>   
			</table>
		</form>
 