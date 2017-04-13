<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<ul class="nav nav-tabs" id="myTab"> 
  <li class="active" style="padding-left:20px"><a href="#tabs-1">商家结算报表</a></li> 

  <a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">刷新</a>
</ul>
 
		<form name="q_from" method="GET" action="" class="form-inline">  
			<input name="cmd" type="hidden" value="<?=base64_encode('order_report.php')?>"/>   
			<select name="is_settle" style="width:150px">  
				<option value=""> == 结算状态 == </option> 
				<option value="0" <?if('0'==req('is_settle')){echo 'selected';}?>>未结算</option>  
				<option value="1" <?if('1'==req('is_settle')){echo 'selected';}?>>已结算</option> 
			</select> 
			<select name="report_ym" style="width:150px"> 
				<option value=""> == 结算月份 == </option>  
				<?   
				if(notnull($ym_rows)){
					foreach ($ym_rows as $val){  
				?>
				<option value="<?=$val['ym']?>" <?if($val['ym']==req('report_ym')){echo 'selected';}?>><?=$val['ym_text']?></option> 
				<?
					}
				}
				?> 
			</select> 

			<input type="image" src="static/image/find.gif" class="input_img"/>  

			<a href="./?cmd=<?=base64_encode('order_report_xls.php')?>&modal=true&report_ym=<?=req('report_ym')?>" class="btn btn-info pull-right" style="color:white" target="_blank">导出</a>
		</form> 
		
		<?if(notnull($query_rows)){?>
		<table width="100%" class="table "> 
			<tr bgcolor="#efefef">
				<td><b>商家名称</b></td>　
				<td><b>订单号</b></td>
				<td><b>下单日期</b></td> 
				<td><b>客户</b></td> 
				<td><b>产品名称</b></td>  
				<td><b>出发日期</b></td>
				<td><b>人数</b></td>
				<td><b>金额</b></td> 
				<td><b>返佣</b></td>
				<td><b>结算金额</b></td>
				<td><b>结算状态</b></td>
			</tr>   
			<?
			foreach ($query_rows as $val){
				// 店铺 
				$shop = get_shop_detail_by_id($val['shop_id']); 

				// 客户 
				$user = get_user_detail_by_id($val['user_id']);  
				 
				// 产品  
				$goods = unserialize($val['goods_snapshot']);
				
				// 实际成交金额
				$total_real_price = $val['real_price']; 
			?>
			<tr> 
				<td >
					<?if($shop['shop_name']!=''){?>
						<?=$shop['shop_name']?>    
					<?}else{?>
						自营
					<?}?>
				</td>

				<td >
					 <?=$val['order_code']?>  
				</td>

				<td > 
					<b><?=date('Y-m-d', strtotime($val['addtime']))?></b>  
				</td>

				<td ><b><?=$user['account']?></b></td>

				<td >
					 <?=$goods['goods_name']?>  
				</td>
  
				<td >
					 <?=$val['departdate']?>  
				</td>

				<td >
					 <?=$val['adult_num']+$val['kid_num']?>  
				</td> 
 
				<td align="center" >
					<strong>&yen;<?=$val['real_price']?></strong>
				</td>
				<td> 
					<?if($val['is_settle']=='1'){?>
						<span style="color:red">&yen;<?=$shop['fee_rate'] * $total_real_price / 100;?></span> 
					<?}else{?>  
						&yen;<?=$val['settle_money']?>
					<?}?> 
				</td>
				<td>
					<?if($val['is_settle']=='1'){?>
						&yen;<?=$total_real_price - $val['settle_money']?>
					<?}?>
				</td>
				<td>
					<?if($val['is_settle']!='1'){?>
					<a href="do.php?cmd=order_settle&order_code=<?=$val['order_code']?>&settle_money=<?=$shop['fee_rate'] * $total_real_price / 100;?>" class="btn btn-info btn-small" style="color:white" onclick="return confirm('确认结算吗？')">结算</a>
					<?}else{?>
					已结算
					<?}?>
				</td>
			  </tr>   
			 <?	  
			 } 
			 ?>
			 <tr bgcolor="#efefef"> 
				<td colspan="11" style="font-size:14px;padding:3px;text-align:center;"> 
				总成交订单量：<strong><?=$order_stat['cnt_order_number']?></strong>
				&nbsp;
				总成交订单额：<strong>&yen;<?=$order_stat['sum_real_price']?></strong>
				</td>
			 </tr>
		</table>  
		<div style="text-align:right;padding-right:10px;">  
			<br/>
			共计<b><?=$total_number?></b>条 &nbsp;
			<a href="./?cmd=<?=base64_encode('order_report.php')?>&state=<?=req('state')?>&kw=<?=req('kw')?>&p=1">首页</a>
			<a href="./?cmd=<?=base64_encode('order_report.php')?>&state=<?=req('state')?>&kw=<?=req('kw')?>&p=<?=$prev_number?>">上一页</a> 
			第<?=$now_page?> / <?=$total_page?>页 
			<a href="./?cmd=<?=base64_encode('order_report.php')?>&state=<?=req('state')?>&kw=<?=req('kw')?>&p=<?=$next_number?>">下一页</a>
			<a href="./?cmd=<?=base64_encode('order_report.php')?>&state=<?=req('state')?>&kw=<?=req('kw')?>&p=<?=$total_page?>">尾页</a>
		</div>
		<?} else {?>
		<div class="alert"> 
		  <strong>没有查询到相关订单信息！</strong> 
		</div>
		<?}?>
 