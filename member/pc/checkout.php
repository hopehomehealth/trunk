<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?> 
 
<div class="bar_title">
	<strong>�ύ����</strong>
</div>

<form method="post" action="do.php?ac=order">
<input type="hidden" name="goods_id" value="<?=$goods_id?>">
<input type="hidden" name="departdate" value="<?=$departdate?>">
<table width="100%">
	<tr>
		<td width="90" height="40" align="right">��Ʒ���ƣ�</td>
		<td><?=$goods['goods_name']?></td>
	</tr>
	<?if($goods_type!='3'){?>
	<tr>
		<td align="right">�� �ڣ�</td>
		<td height="40"> 
		<?=$departdate?> 
		</td>
	</tr>
	<?}?> 
	<tr>
		<td align="right"><font color="red">*</font> �� ����</td>
		<td>
		<input type="number" name="adult_num" min="1" value="<?=$adult_num?>" class="span3" required> 
		</td>
	</tr>
	<?if($kid_num>0){?>
	<tr>
		<td align="right">��ͯ������</td>
		<td> 
		 <input type="number" name="kid_num" min="1" value="<?=$kid_num?>" class="span3">
		</td>
	</tr>
	<?}?>
	<tr>
		<td align="right"><font color="red">*</font> ��ϵ�ˣ�</td>
		<td><input type="text" name="linker" class="span3" maxlength="10" required value="<?=$last_order['linker']?>"></td>
	</tr>
	<tr>
		<td align="right"><font color="red">*</font> �ֻ��ţ�</td>
		<td><input type="number" name="mobile" class="span3" maxlength="11" required value="<?=$last_order['mobile']?>"></td>
	</tr>
	<tr>
		<td align="right">ͨѶ��ַ��</td>
		<td><input type="text" name="address" class="span6" placeholder="�����ʼķ�Ʊ��С����ȵ�" value="<?=$last_order['address']?>"></td>
	</tr>

	<tr>
		<td align="right"><font color="red">*</font> ֧����ʽ��</td>
		<td>  
			<?
			$default_note = $pay_config['default']['note'];
			?> 
			  <label class="radio">
				  <input type="radio" name="pay_type" checked="checked" value="default" required/>
				  <?if($default_note!=''){?>
					  <?=$default_note?>
				  <?}else{?>
					  ����֧�����ֽ�ת�ˣ�
				  <?}?>
			  </label> 
			<?
			$pay_state = $pay_config['tenpay']['state'];
			if($pay_state == 'Y'){
			?> 
				<label class="radio">
				<input type="radio" name="pay_type" value="tenpay" required/> �Ƹ�ͨ 
				</label> 
			<?}?>

			<?
			$pay_state = $pay_config['alipay']['state'];
			if($pay_state == 'Y'){
			?> 
				<label class="radio">
				   <input type="radio" name="pay_type" value="alipay" required/> ֧���� 
				</label> 
			<?}?> 
		</td>
	</tr>
	<tr>
		<td align="right">�������ԣ�</td>
		<td><textarea name="order_note" rows="3" class="span6" maxlength="100" placeholder="˵��һ��������������..."></textarea></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="�ύ����" class="btn btn-warning"></td>
	</tr>
</table>
</form>