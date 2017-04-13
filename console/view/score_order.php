<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>


<ul class="nav nav-tabs">   
	<li <?if(nav_active('score_order.php')){?>class="active"<?}?> style="padding-left:20px;">
		<a href="?cmd=<?=base64_encode('score_order.php')?>">积分订单管理</a>
	</li>  
	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">刷新</a>
</ul>  

 
		<form name="q_from" method="GET" action="" class="form-inline">  
			<input name="cmd" type="hidden" value="<?=base64_encode('order.php')?>"/> 

			<input name="kw" type="text" id="kw" class="span4" value="<?=req('kw')?>" placeholder="输入订单号、产品关键词…"/>  
			<select name="state" class="span2">
				<option value="">订单状态</option>
				<option value="1" <?if(req('state')=='1'){?>selected<?}?>>待完成</option> 
				<option value="4" <?if(req('state')=='2'){?>selected<?}?>>已完成</option>
				<option value="5" <?if(req('state')=='3'){?>selected<?}?>>已取消</option>
			</select>

			<input type="image" src="static/image/find.gif" class="input_img"/>  
		</form> 
		
		<?if(notnull($query_rows)){?>
		<table width="100%" class="table table-condensed" style="font-size:12px">  
			<tr> 
				<td><strong>客户</strong></td> 
				<td><strong>订单号</strong></td>
				<td><strong>下单时间</strong></td> 
				<td><strong>名称/编码</strong></td>  
				<td><strong>兑换数量</strong></td> 
				<td><strong>花费积分</strong></td>
				<td><strong>联系人</strong></td>
				<td><strong>手机号</strong></td>
				<td><strong>地址</strong></td>
				<td><strong>订单留言</strong></td>
				<td><strong>状态</strong></td> 
				<td style="text-align:center"><strong>操作</strong></td> 
			</tr>  
		<?  
		foreach ($query_rows as $val){   
			// 订单状态
			$state = $val['state']; 

			// 客户详情
			$user = get_user_detail_by_id($val['user_id']);  
					 
			// 产品详情
			$goods = unserialize($val['goods_snapshot']); 
		?> 
			
			<tr>
				<td><?=$user['account']?></td>

				<td><?=$val['order_id']?></td>

				<td><?=$val['addtime']?></td> 
 
				<td> <?=$val['goods_name']?> </td> 

				<td> <?=$val['order_number']?> </td>

				<td> <?=$val['score_number']?> </td>  

				<td> <?=$val['linker']?> </td>

				<td> <?=$val['mobile']?> </td>

				<td> <?=$val['address']?> </td>

				<td> <?=$val['order_note']?> </td>
				
				<td>
					<span class="label label-warning"><?=$g_score_order_state[$state]?></span> 
				</td>  
				
				<td style="text-align:center">  
				<?if($state==1){?>
				<a href="do.php?cmd=score_order_success&order_id=<?=$val['order_id']?>"  onclick="return confirm('确认取消订单吗？')"  class="btn btn-mini btn-info">完成</a> 
				&nbsp;

				<a href="do.php?cmd=score_order_cancel&order_id=<?=$val['order_id']?>"  onclick="return confirm('确认取消订单吗？')"  class="btn btn-mini btn-danger">取消</a> 
				&nbsp;
				<?}?>

				<?if($state==3){?>
				<a href="do.php?cmd=score_order_delete&order_id=<?=$val['order_id']?>" onclick="return confirm('确认删除订单吗？')" class="btn btn-mini">删除</a> 
				<?}?>
			  </td>
			</tr> 
			<?}?>
		</table>  

		<div style="text-align:right;padding-right:10px;">  
				<br/>
				共计<b><?=$total_number?></b>条 &nbsp;
				<a href="<?=get_page_args()?>&p=1" target="_top">首页</a>
				<a href="<?=get_page_args()?>&p=<?=$prev_number?>" target="_top">上一页</a> 
				第<?=$now_page?> / <?=$total_page?>页 
				<a href="<?=get_page_args()?>&p=<?=$next_number?>" target="_top">下一页</a>
				<a href="<?=get_page_args()?>&p=<?=$total_page?>" target="_top">尾页</a>
		</div>

		<?} else {?>

		<div class="alert"> 
			<strong>没有查询到相关订单信息！</strong> 
		</div>

		<?}?>
 