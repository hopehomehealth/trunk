<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<div class="bar_title">
	<strong>订单详情</strong>
	<a href="<?=url('order.php')?>" class="pull-right btn btn-small" target="_top">返回</a>
</div> 

   
		 
<table width="100%" class="table table-bordered" >  
		<?     
		// 订单状态
		$state = $detail['state']; 

		// 店铺详情
		$shop = get_shop_detail_by_id($detail['shop_id']); 
 
		// SKU
		$goods_sku = get_goods_sku_by_id($detail['sku_id']);
				 
		// 产品详情
		$goods = unserialize($detail['goods_snapshot']); 
		?>  
		<thead>
		<tr>
			<td width="100" style="text-align:right"><strong>订单号：</strong></td>
			<td><?=$detail['order_code']?></td>
		</tr>
		</thead>
		<tr>
			<td style="text-align:right"><strong>订单状态：</strong></td>
			<td>
				<span class="label label-warning"><?=$g_order_state[$state]?></span> 
			</td>
		</tr>

		<tr>
			<td style="text-align:right"><strong>下单时间：</strong></td>
			<td><?=$detail['addtime']?></td>
		</tr> 

		<tr>
			<td style="text-align:right"><strong>服务商：</strong></td>
			<td> 
				<?
				if($shop['shop_name']!=''){ 
				?> 
				<strong><?=$shop['shop_name']?></strong>
				<?}else{?>
				<strong>自营</strong>
				<?}?>
			</td>
		</tr> 

		<tr>
			<td style="text-align:right"><strong>名称/编码：</strong></td>
			<td>
				<?=$detail['goods_name']?><br/><?=$detail['goods_code']?></a> 
			</td>
		</tr>
		
		<?if($goods['goods_type']!='3'){?>
		<tr>
			<td style="text-align:right"><strong>出发日期：</strong></td>
			<td><?=$detail['departdate']?></td>
		</tr>
		<?}?>

		<tr>
			<td style="text-align:right"><strong>人 数：</strong></td>
			<td>  
				<?if($detail['adult_num']>0){?>
				<?=$detail['adult_num']?>人 
				<?}?>

				<?if($detail['kid_num']>0){?>
				<?=$detail['kid_num']?>儿童 
				<?}?> 	   
			</td>
		</tr>
 
		<tr>
			<td style="text-align:right"><strong>金 额：</strong></td>
			<td> 
				&yen;<?=$detail['real_price']?>	  
			</td>
		</tr>  

		<tr>
			<td style="text-align:right"><strong>支付方式：</strong></td>
			<td>
				<?=$g_gateway[$detail['pay_type']]?>
				<?if($detail['state']=='1'){?>
				<?if($detail['pay_type']!='default'){?>
				&nbsp;
				<a href="pay.gateway?order_code=<?=$detail['order_code']?>&price=<?=$detail['real_price']?>&user=<?=$g_userid?>&pay_type=<?=$detail['pay_type']?>" target="_blank" class="btn btn-small btn-info">立即支付</a>
				<?}?>
				<?}?>
			</td>
		</tr> 
		<tr> 
			<td style="text-align:right"><strong>联系方式：</strong></td>
			<td> 
				<?=$detail['linker']?> <?=$detail['mobile']?> <?=$detail['address']?> 
			</td>
		</tr>  
		<tr>
			<td style="text-align:right"><strong>订单留言：</strong></td>
			<td>
				<?if($detail['order_note']!=''){?>
				<?=$detail['order_note']?>
				<?}else{?>
				未填写
				<?}?>
			</td>
		</tr>
		
		<?if(in_array($state, array(1,3,4))){?>
		<tr>
			<td style="text-align:right" height="50"></td> 
			<td>  
				<?if($state=='1'){?>
				<a href="do?ac=order_close&order_code=<?=$detail['order_code']?>" onclick="return confrim('确认关闭交易吗？')" class="btn " target="_top">取消订单</a>
				&nbsp;
				<?}?>
				 
				<?if($state=='3'){?>
					<a href="do?ac=order_success&order_code=<?=$detail['order_code']?>" class="btn btn-info " onclick="return confrim('确认回团吗？')" target="_top">确认回团</a>
				<?}?>

				<?if($state=='4'){?>
					<?if($comment_count>0){?>
						<a href="<?=url('comment.php')?>" target="_top">查看评价</a>
					<?}else{?>
						<a href="<?=url('comment.php')?>&ac=comment&goods_id=<?=$detail['goods_id']?>&goods_name=<?=$detail['goods_name']?>" class="btn btn-warning" target="_top">立即评价</a>
					<?}?>
					&nbsp;
				<?}?>	
			</td>  
		</tr>  
		<?}?>
		
		<tr <?if($goods['goods_type']=='3'){?>style="display:none"<?}?>>
			<td style="text-align:right"><strong>出游名单：</strong></td>
			<td>   
<script language="javascript"> 
//窗口表格增加一行
function addNewRow(){
   var tabObj=document.getElementById("myTab");//获取添加数据的表格
   var rowsNum = tabObj.rows.length;  //获取当前行数
   var colsNum=tabObj.rows[rowsNum-1].cells.length;//获取行的列数
   var myNewRow = tabObj.insertRow(rowsNum);//插入新行
   var newTdObj1=myNewRow.insertCell(0);
   newTdObj1.innerHTML="<input type='checkbox' name='chkArr' id='chkArr'"+rowsNum+" style='width:20px' />";
   var newTdObj2=myNewRow.insertCell(1);
   newTdObj2.innerHTML="<input type='text' name='name[]' id='nodecode'"+rowsNum+" style='width:150px' required />";
   var newTdObj3=myNewRow.insertCell(2);
   newTdObj3.innerHTML="<input type='text' name='idcard[]' id='nodename'"+rowsNum+" style='width:250px' required />";
   var newTdObj4=myNewRow.insertCell(3);
   newTdObj4.innerHTML="<input type='number' name='age[]' id='nodeper'"+rowsNum+" style='width:80px' />";
}

//窗口表格删除一行
function removeRow(){
   var chkObj=document.getElementsByName("chkArr");
   var tabObj=document.getElementById("myTab");
   for(var k=0;k<chkObj.length;k++){
    if(chkObj[k].checked){
     tabObj.deleteRow(k+1);
     k=-1;
    }
   }
}
</script>

<input type="button" name="yy" onclick="removeRow();" value="删除" class="btn btn-small pull-right"/>
<input type="button" name="xx" onclick="addNewRow();" value="增加一行" class="btn btn-small btn-warning pull-right" style="margin-right:10px"/>
<div style="clear:both"></div>
<form id="myform" method="post" action="do?ac=tourist_add" style="margin-top:10px"> 
<table class="table table-bordered" id="myTab" >
	<tr>
		<td width="50" align="center" >ID</td>
        <td align="center" >姓名 *</td>
        <td align="center" >身份证 *</td>
        <td align="center" >年龄</td>
	</tr>
	<?
	if(notnull($tourist)){
		foreach ($tourist as $val){ 
	?>
	<tr>
		<td><input type="checkbox" name="chkArr" id="chkArr" style="width:20px"></td>
		<td><input type="text" name="name[]" id="nodecode" style="width:150px"  value="<?=$val['user_name']?>" required></td>
		<td><input type="text" name="idcard[]" id="nodename" style="width:250px"  value="<?=$val['user_idcard']?>" required></td>
		<td><input type="number" name="age[]" id="nodeper"  value="<?=$val['user_age']?>" style="width:80px"></td>
	</tr>
	<?
		}
	}
	?>
</table>
<input type="hidden" name="order_code" value="<?=req('order_code')?>">
<input type="hidden" name="order_id" value="<?=req('order_id')?>"> 
<input type="submit" value="保存" class="btn btn-info pull-right">
</form>
 
<script type="text/javascript">
for(var i=1; i<=<?=$detail['adult_num']+$detail['kid_num']-sizeof($tourist)?>; i++){
	addNewRow();
}
</script>
 
			</td>
		</tr>
</table>   