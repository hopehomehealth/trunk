<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?> 
 
<div class="bar_title">
	<strong>提交订单</strong>
</div>

<form method="post" action="do.php?ac=order">
<input type="hidden" name="goods_id" value="<?=$goods_id?>">
<input type="hidden" name="departdate" value="<?=$departdate?>">
<table width="100%">
	<tr>
		<td width="90" height="40" align="right">产品名称：</td>
		<td><?=$goods['goods_name']?></td>
	</tr>
	<?if($goods_type!='3'){?>
	<tr>
		<td align="right">日 期：</td>
		<td height="40"> 
		<?=$departdate?> 
		</td>
	</tr>
	<?}?> 
	<tr>
		<td align="right"><font color="red">*</font> 数 量：</td>
		<td>
		<input type="number" name="adult_num" min="1" value="<?=$adult_num?>" class="span3" required> 
		</td>
	</tr>
	<?if($kid_num>0){?>
	<tr>
		<td align="right">儿童数量：</td>
		<td> 
		 <input type="number" name="kid_num" min="1" value="<?=$kid_num?>" class="span3">
		</td>
	</tr>
	<?}?>
	<tr>
		<td align="right"><font color="red">*</font> 联系人：</td>
		<td><input type="text" name="linker" class="span3" maxlength="10" required value="<?=$last_order['linker']?>"></td>
	</tr>
	<tr>
		<td align="right"><font color="red">*</font> 手机号：</td>
		<td><input type="number" name="mobile" class="span3" maxlength="11" required value="<?=$last_order['mobile']?>"></td>
	</tr>
	<tr>
		<td align="right">通讯地址：</td>
		<td><input type="text" name="address" class="span6" placeholder="用于邮寄发票、小礼物等等" value="<?=$last_order['address']?>"></td>
	</tr>

	<tr>
		<td align="right"><font color="red">*</font> 支付方式：</td>
		<td>  
			<?
			$default_note = $pay_config['default']['note'];
			?> 
			  <label class="radio">
				  <input type="radio" name="pay_type" checked="checked" value="default" required/>
				  <?if($default_note!=''){?>
					  <?=$default_note?>
				  <?}else{?>
					  线下支付（现金、转账）
				  <?}?>
			  </label> 
			<?
			$pay_state = $pay_config['tenpay']['state'];
			if($pay_state == 'Y'){
			?> 
				<label class="radio">
				<input type="radio" name="pay_type" value="tenpay" required/> 财付通 
				</label> 
			<?}?>

			<?
			$pay_state = $pay_config['alipay']['state'];
			if($pay_state == 'Y'){
			?> 
				<label class="radio">
				   <input type="radio" name="pay_type" value="alipay" required/> 支付宝 
				</label> 
			<?}?> 
		</td>
	</tr>
	<tr>
		<td align="right">订单留言：</td>
		<td><textarea name="order_note" rows="3" class="span6" maxlength="100" placeholder="说明一下您的特殊需求..."></textarea></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="提交订单" class="btn btn-warning"></td>
	</tr>
</table>
</form>