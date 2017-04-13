<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}  
?> 

<section class="m-frm-top">
    <div class="num"><span>预订</span>填写订单信息</div>
    <i class="line"></i>  
    <a href="javascript:void()" onclick="history.back()" class="m-frm-top-btn" style="width:60px"> 返回 </a> 
</section>
 
<section class="container">  
<form method="post" action="do.php?ac=order">
	<input type="hidden" name="goods_id" value="<?=$goods_id?>">
	<input type="hidden" name="departdate" value="<?=$departdate?>">
	<table width="100%" class="m-frm-div">
		<tr>
			<td width="70" align="right">产品名称：</td>
			<td><?=$goods['goods_name']?></td>
		</tr>
		<?if($goods_type!='3'){?>
		<tr>
			<td align="right">出发日期：</td>
			<td> 
			<?=$departdate?> 
			</td>
		</tr>
		<?}?>
		<tr>
			<td align="right"><font color="red">*</font> 数 量：</td>
			<td>
			<input type="number" min="1" name="adult_num" value="<?=$adult_num?>" class="span1" required> 
			</td>
		</tr>
		<?if($kid_num>0){?>
		<tr>
			<td align="right">儿童数量：</td>
			<td> 
			 <input type="number" min="1" name="kid_num" value="<?=$kid_num?>" class="span1">
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
					  <input type="radio" name="pay_type" checked="checked" value="default" style="width:16px;height:16px" required/>
					  <?if($default_note!=''){?>
						  <?=$default_note?>
					  <?}else{?>
						  线下支付（现金、转账）
					  <?}?>
					</label> 
					<div style="clear:both"></div>
				<?
				$pay_state = $pay_config['wxpay']['state'];
				if($pay_state == 'Y'){
				?> 
					<label class="radio">
					   <input type="radio" name="pay_type" value="wxpay"  style="width:16px;height:16px" required/> 微信 
					</label> 
					<div style="clear:both"></div>
				<?}?>

				<?
				$pay_state = $pay_config['alipaywap']['state'];
				if($pay_state == 'Y'){
				?> 
					<label class="radio">
					   <input type="radio" name="pay_type" value="alipaywap" style="width:16px;height:16px" required/> 支付宝 
					</label> 
					<div style="clear:both"></div>
				<?}?> 
			</td>
		</tr>
		<tr>
			<td align="right">订单留言：</td>
			<td><textarea name="order_note" rows="3" class="span6" maxlength="100" placeholder="说明一下您的特殊需求..."></textarea></td>
		</tr> 
	</table>
	<div class="m-frm-foot">
		<div class="btn-group"> <input class="btn-add" type="submit" style="width:100%;border:0px;text-align:center" value="提交订单"/> </div>
	</div> 
</form>
</section>