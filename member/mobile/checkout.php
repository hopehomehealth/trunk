<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}  
?> 

<section class="m-frm-top">
    <div class="num"><span>Ԥ��</span>��д������Ϣ</div>
    <i class="line"></i>  
    <a href="javascript:void()" onclick="history.back()" class="m-frm-top-btn" style="width:60px"> ���� </a> 
</section>
 
<section class="container">  
<form method="post" action="do.php?ac=order">
	<input type="hidden" name="goods_id" value="<?=$goods_id?>">
	<input type="hidden" name="departdate" value="<?=$departdate?>">
	<table width="100%" class="m-frm-div">
		<tr>
			<td width="70" align="right">��Ʒ���ƣ�</td>
			<td><?=$goods['goods_name']?></td>
		</tr>
		<?if($goods_type!='3'){?>
		<tr>
			<td align="right">�������ڣ�</td>
			<td> 
			<?=$departdate?> 
			</td>
		</tr>
		<?}?>
		<tr>
			<td align="right"><font color="red">*</font> �� ����</td>
			<td>
			<input type="number" min="1" name="adult_num" value="<?=$adult_num?>" class="span1" required> 
			</td>
		</tr>
		<?if($kid_num>0){?>
		<tr>
			<td align="right">��ͯ������</td>
			<td> 
			 <input type="number" min="1" name="kid_num" value="<?=$kid_num?>" class="span1">
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
					  <input type="radio" name="pay_type" checked="checked" value="default" style="width:16px;height:16px" required/>
					  <?if($default_note!=''){?>
						  <?=$default_note?>
					  <?}else{?>
						  ����֧�����ֽ�ת�ˣ�
					  <?}?>
					</label> 
					<div style="clear:both"></div>
				<?
				$pay_state = $pay_config['wxpay']['state'];
				if($pay_state == 'Y'){
				?> 
					<label class="radio">
					   <input type="radio" name="pay_type" value="wxpay"  style="width:16px;height:16px" required/> ΢�� 
					</label> 
					<div style="clear:both"></div>
				<?}?>

				<?
				$pay_state = $pay_config['alipaywap']['state'];
				if($pay_state == 'Y'){
				?> 
					<label class="radio">
					   <input type="radio" name="pay_type" value="alipaywap" style="width:16px;height:16px" required/> ֧���� 
					</label> 
					<div style="clear:both"></div>
				<?}?> 
			</td>
		</tr>
		<tr>
			<td align="right">�������ԣ�</td>
			<td><textarea name="order_note" rows="3" class="span6" maxlength="100" placeholder="˵��һ��������������..."></textarea></td>
		</tr> 
	</table>
	<div class="m-frm-foot">
		<div class="btn-group"> <input class="btn-add" type="submit" style="width:100%;border:0px;text-align:center" value="�ύ����"/> </div>
	</div> 
</form>
</section>