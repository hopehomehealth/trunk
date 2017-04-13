<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 

$sql = "SELECT SUM(`score_number`) FROM `t_user_score` WHERE `site_id`='$g_siteid' AND `user_id`='$g_userid' ";	
$total_score_number = $db->get_value($sql); 

if($goods_id==''){
	$adult_num		= req('adult_num');
	$kid_num		= req('kid_num');
	$departdate		= date('Y-m-d', strtotime(req('departdate')));
	$goods_id		= req('goods_id');  
	$addtime		= date('Y-m-d H:i:s');
	  

	$sql = "SELECT * FROM `t_score_goods_thread` WHERE `goods_id`='$goods_id' AND site_id='$g_siteid'";
	$goods = $db->get_one($sql); 
 
	$goods_id		= $goods['goods_id'];
	$goods_name		= $goods['goods_name']; 
	$is_sale		= $goods['is_sale']; 
 
	if($is_sale == '0'){ 
		js("alert('该产品已下架，不能订购！');");
		exit();
	}
} else {
	js("alert('系统来源不正确');"); 
	exit();
}
?> 
 
<div class="bar_title">
	<strong>积分兑换</strong>
</div>
<script type="text/javascript">
function submit_form(){
	<?if($total_score_number < $goods['score_number']){?>
	alert('对不起，积分不足，无法兑换！');
	return false;
	<?}else{?>
	return true;
	<?}?>
}
</script>
<form id="order_form" method="post" action="do.php?ac=score_order" onsubmit="submit_form()">
<input type="hidden" name="goods_id" value="<?=$goods_id?>">
<input type="hidden" name="order_number" value="1">
<table width="100%">
	<tr>
		<td width="90" align="right">产品名称：</td>
		<td><?=$goods['goods_name']?></td>
	</tr>
	<tr>
		<td align="right">花费积分：</td>
		<td height="40"> 
			<?=$goods['score_number']?> 
			
			<span style="color:red">您目前剩余<strong><?=$total_score_number?></strong>可用积分</span>
		</td>
	</tr>  
	<tr>
		<td align="right"><font color="red">*</font> 联系人：</td>
		<td><input type="text" name="linker" class="span3" maxlength="10" required value="<?=$last_order['linker']?>"></td>
	</tr>
	<tr>
		<td align="right"><font color="red">*</font> 手机号：</td>
		<td><input type="number" name="mobile" class="span3" maxlength="11" required value="<?=$last_order['mobile']?>"></td>
	</tr>
	<tr>
		<td align="right"><font color="red">*</font> 通讯地址：</td>
		<td><input type="text" name="address" class="span6" placeholder="邮寄地址，务必正确" value="<?=$last_order['address']?>" required></td>
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