<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<div class="bar_title">
	<strong>��������</strong>
	<a href="<?=url('order.php')?>" class="pull-right btn btn-small" target="_top">����</a>
</div> 

   
		 
<table width="100%" class="table table-bordered" >  
		<?     
		// ����״̬
		$state = $detail['state']; 

		// ��������
		$shop = get_shop_detail_by_id($detail['shop_id']); 
 
		// SKU
		$goods_sku = get_goods_sku_by_id($detail['sku_id']);
				 
		// ��Ʒ����
		$goods = unserialize($detail['goods_snapshot']); 
		?>  
		<thead>
		<tr>
			<td width="100" style="text-align:right"><strong>�����ţ�</strong></td>
			<td><?=$detail['order_code']?></td>
		</tr>
		</thead>
		<tr>
			<td style="text-align:right"><strong>����״̬��</strong></td>
			<td>
				<span class="label label-warning"><?=$g_order_state[$state]?></span> 
			</td>
		</tr>

		<tr>
			<td style="text-align:right"><strong>�µ�ʱ�䣺</strong></td>
			<td><?=$detail['addtime']?></td>
		</tr> 

		<tr>
			<td style="text-align:right"><strong>�����̣�</strong></td>
			<td> 
				<?
				if($shop['shop_name']!=''){ 
				?> 
				<strong><?=$shop['shop_name']?></strong>
				<?}else{?>
				<strong>��Ӫ</strong>
				<?}?>
			</td>
		</tr> 

		<tr>
			<td style="text-align:right"><strong>����/���룺</strong></td>
			<td>
				<?=$detail['goods_name']?><br/><?=$detail['goods_code']?></a> 
			</td>
		</tr>
		
		<?if($goods['goods_type']!='3'){?>
		<tr>
			<td style="text-align:right"><strong>�������ڣ�</strong></td>
			<td><?=$detail['departdate']?></td>
		</tr>
		<?}?>

		<tr>
			<td style="text-align:right"><strong>�� ����</strong></td>
			<td>  
				<?if($detail['adult_num']>0){?>
				<?=$detail['adult_num']?>�� 
				<?}?>

				<?if($detail['kid_num']>0){?>
				<?=$detail['kid_num']?>��ͯ 
				<?}?> 	   
			</td>
		</tr>
 
		<tr>
			<td style="text-align:right"><strong>�� �</strong></td>
			<td> 
				&yen;<?=$detail['real_price']?>	  
			</td>
		</tr>  

		<tr>
			<td style="text-align:right"><strong>֧����ʽ��</strong></td>
			<td>
				<?=$g_gateway[$detail['pay_type']]?>
				<?if($detail['state']=='1'){?>
				<?if($detail['pay_type']!='default'){?>
				&nbsp;
				<a href="pay.gateway?order_code=<?=$detail['order_code']?>&price=<?=$detail['real_price']?>&user=<?=$g_userid?>&pay_type=<?=$detail['pay_type']?>" target="_blank" class="btn btn-small btn-info">����֧��</a>
				<?}?>
				<?}?>
			</td>
		</tr> 
		<tr> 
			<td style="text-align:right"><strong>��ϵ��ʽ��</strong></td>
			<td> 
				<?=$detail['linker']?> <?=$detail['mobile']?> <?=$detail['address']?> 
			</td>
		</tr>  
		<tr>
			<td style="text-align:right"><strong>�������ԣ�</strong></td>
			<td>
				<?if($detail['order_note']!=''){?>
				<?=$detail['order_note']?>
				<?}else{?>
				δ��д
				<?}?>
			</td>
		</tr>
		
		<?if(in_array($state, array(1,3,4))){?>
		<tr>
			<td style="text-align:right" height="50"></td> 
			<td>  
				<?if($state=='1'){?>
				<a href="do?ac=order_close&order_code=<?=$detail['order_code']?>" onclick="return confrim('ȷ�Ϲرս�����')" class="btn " target="_top">ȡ������</a>
				&nbsp;
				<?}?>
				 
				<?if($state=='3'){?>
					<a href="do?ac=order_success&order_code=<?=$detail['order_code']?>" class="btn btn-info " onclick="return confrim('ȷ�ϻ�����')" target="_top">ȷ�ϻ���</a>
				<?}?>

				<?if($state=='4'){?>
					<?if($comment_count>0){?>
						<a href="<?=url('comment.php')?>" target="_top">�鿴����</a>
					<?}else{?>
						<a href="<?=url('comment.php')?>&ac=comment&goods_id=<?=$detail['goods_id']?>&goods_name=<?=$detail['goods_name']?>" class="btn btn-warning" target="_top">��������</a>
					<?}?>
					&nbsp;
				<?}?>	
			</td>  
		</tr>  
		<?}?>
		
		<tr <?if($goods['goods_type']=='3'){?>style="display:none"<?}?>>
			<td style="text-align:right"><strong>����������</strong></td>
			<td>   
<script language="javascript"> 
//���ڱ������һ��
function addNewRow(){
   var tabObj=document.getElementById("myTab");//��ȡ������ݵı��
   var rowsNum = tabObj.rows.length;  //��ȡ��ǰ����
   var colsNum=tabObj.rows[rowsNum-1].cells.length;//��ȡ�е�����
   var myNewRow = tabObj.insertRow(rowsNum);//��������
   var newTdObj1=myNewRow.insertCell(0);
   newTdObj1.innerHTML="<input type='checkbox' name='chkArr' id='chkArr'"+rowsNum+" style='width:20px' />";
   var newTdObj2=myNewRow.insertCell(1);
   newTdObj2.innerHTML="<input type='text' name='name[]' id='nodecode'"+rowsNum+" style='width:150px' required />";
   var newTdObj3=myNewRow.insertCell(2);
   newTdObj3.innerHTML="<input type='text' name='idcard[]' id='nodename'"+rowsNum+" style='width:250px' required />";
   var newTdObj4=myNewRow.insertCell(3);
   newTdObj4.innerHTML="<input type='number' name='age[]' id='nodeper'"+rowsNum+" style='width:80px' />";
}

//���ڱ��ɾ��һ��
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

<input type="button" name="yy" onclick="removeRow();" value="ɾ��" class="btn btn-small pull-right"/>
<input type="button" name="xx" onclick="addNewRow();" value="����һ��" class="btn btn-small btn-warning pull-right" style="margin-right:10px"/>
<div style="clear:both"></div>
<form id="myform" method="post" action="do?ac=tourist_add" style="margin-top:10px"> 
<table class="table table-bordered" id="myTab" >
	<tr>
		<td width="50" align="center" >ID</td>
        <td align="center" >���� *</td>
        <td align="center" >���֤ *</td>
        <td align="center" >����</td>
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
<input type="submit" value="����" class="btn btn-info pull-right">
</form>
 
<script type="text/javascript">
for(var i=1; i<=<?=$detail['adult_num']+$detail['kid_num']-sizeof($tourist)?>; i++){
	addNewRow();
}
</script>
 
			</td>
		</tr>
</table>   