<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<ul class="nav nav-tabs">   
	<?
	$m=1;
	foreach ($g_product_type as $k => $v) {
	?>
	<li <?if(nav_active('goods_list.php') && req('goods_type')==$k){?>class="active"<?}?> <?if($m==1){?>style="padding-left:20px;"<?}?>>
		<a href="?cmd=<?=base64_encode('goods_list.php')?>&goods_type=<?=$k?>"><?=$v?></a>
	</li>
	<?
		$m++;
	}
	?>
	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">刷新</a>
</ul>  
  

		<table width="100%">
		<tr>
			<td style="padding-top:7px">
				<form name="q_from" method="GET" action="" class="form-inline">  
					<input name="cmd" type="hidden" value="<?=base64_encode('goods_list.php')?>" /> 
					<input name="goods_type" type="hidden" value="<?=req('goods_type')?>" /> 
					    
					<select name="is_sale" style="width:100px">
					<option value="">-- 状态 --</option> 
					<option value="-1" <? if(req('is_sale')=='-1') echo 'selected';?>>待审</option> 
					<option value="1" <? if(req('is_sale')=='1') echo 'selected';?>>在售</option> 
					<option value="0" <? if(req('is_sale')=='0') echo 'selected';?>>停售</option> 
					</select>
					 
					<input name="kw" type="text" id="kw" size="25" value="<?=req('kw')?>" placeholder="关键词…"/> 
					&nbsp;
					<input type="image" src="static/image/find.gif" class="input_img" title="搜索"/> 


					<span class="pull-right"> 
						<a href="?cmd=<?=base64_encode('goods_add.php')?>&goods_type=<?=req('goods_type')?>" class="btn btn-info" style="color:white"><em class="fa fa-plus"></em> 发布新产品</a> 
					</span>
				</form> 
			
			
			</td>
		</tr>
		</table>

		<script type="text/javascript">
				function doform_goods(goods_id, item){
					var f =  document.getElementById('f'+goods_id);
					f.action = "do.php?cmd=goods_edit_fast&goods_id="+goods_id+"&item="+item;
					f.submit();
				} 
		</script>

		<? 
		  if(notnull($query_rows)){
		?>
		<table width="100%"class="table table-hover"> 
		  <tr>  
			  <td>产品ID</td> 
			  <td style="width:260px">产品名称</td> 
			  <td>&nbsp; 起价</td> 
			 
			  <td>排序号</td> 
			  <td>上下架</td>
			  <td>推荐</td>
			 
			  <td>点击量</td>
			  <td>操作</td>
		  </tr> 
		  <?  
			foreach ($query_rows as $val){ 
				$goods_image = "/upfiles/$g_siteid/".$val['goods_image'];
				$stat_count  = get_goods_stat($val['goods_id']);
				$shop_detail = get_shop_detail_by_id($val['shop_id']);
				
		  ?> 
		  <form target="frm" id="f<?=$val['goods_id']?>" method="post" action="" > 
			<tr <?if($val['is_sale']=='0'){?>class="error" title="已下架"<?}?>> 

			  <td>
				<b title="产品ID"><?=$val['goods_id']?></b> 
			  </td> 
  
			  <td><input name="goods_name" type="text" id="goods_name" title="<?=$val['goods_name']?>" style="width:250px;" value="<?=$val['goods_name']?>" size="30" onchange="doform_goods('<?=$val['goods_id']?>', 'goods_name')" /> 
			  </td> 

			  <td style="font-size:16px">&yen;<?=$val['min_price']?>起</td>
  
			  <td><input name="order_id" type="number" id="order_id" style="width:50px;" value="<?=$val['order_id']?>" size="1" onchange="doform_goods('<?=$val['goods_id']?>', 'order_id')" />
			  </td>
			   
			  <td> 
			  <?
			  if($g_shopid!=''){
				  if($val['is_sale']=='0') echo '下架，待审核';
				  if($val['is_sale']=='1') echo '在售中';
			  }else{
			  ?>
			  <?if($val['is_sale']=='1'){?>
			  <a href="do.php?cmd=goods_sale_state&goods_id=<?=$val['goods_id']?>&is_sale=0&cat_id=<?=req('cat_id')?>&sale_type=<?=req('sale_type')?>&kw=<?=req('kw')?>&p=<?=$prev_number?>">下架</a>
			  <?}?>
			  <?if($val['is_sale']=='0'){?>
			  <a href="do.php?cmd=goods_sale_state&goods_id=<?=$val['goods_id']?>&is_sale=1&cat_id=<?=req('cat_id')?>&sale_type=<?=req('sale_type')?>&kw=<?=req('kw')?>&p=<?=$prev_number?>" style="color:green">上架</a>
			  <?}?> 
			  <?}?>
			  </td>
			   
			  <td >
				<select name="is_hot" onchange="doform_goods('<?=$val['goods_id']?>', 'is_hot')" style="width:80px;" >  
					<option value="0" <? if($val['is_hot']==0) {echo 'selected';} ?> >非推荐</option> 
					<option value="1" <? if($val['is_hot']==1) {echo 'selected';} ?> >推荐^</option> 
				</select>	
			  </td> 
			 

			  <td><?=$stat_count?></td>
			  
			  <td>  
				<a href="?cmd=<?=base64_encode('goods_edit.php')?>&ac=copy&goods_id=<?=$val['goods_id']?>" style="cursor:pointer">复制</a> &nbsp; 
				<a href="preview.php?ac=goods&goods_id=<?=$val['goods_id']?>" target="_blank"><img src="static/image/view.gif" title="预览"/></a> 
				&nbsp;
				<a href="?cmd=<?=base64_encode('goods_edit.php')?>&goods_id=<?=$val['goods_id']?>" style="cursor:pointer"><img src="static/image/edit.gif" title="编辑"/></a> 
				&nbsp;
				<a href="do.php?cmd=goods_del&goods_id=<?=$val['goods_id']?>&cat_id=<?=req('cat_id')?>&sale_type=<?=req('sale_type')?>&kw=<?=req('kw')?>&p=<?=req('p')?>" onclick="return confirm('确认删除吗？')"><img src="static/image/delete.gif" title="删除"/></a> 
			  </td>
			</tr>
		  </form> 
		  <?
		  } 
		  ?> 
		</table>
		<div style="text-align:right;padding-right:10px;">  
			<br/>
			共计<b><?=$total_number?></b>条 &nbsp;
			<a href="<?=get_page_args()?>p=1">首页</a>
			<a href="<?=get_page_args()?>p=<?=$prev_number?>">上一页</a> 
			第<?=$now_page?> / <b><?=$total_page?></b>页 
			<a href="<?=get_page_args()?>p=<?=$next_number?>">下一页</a>
			<a href="<?=get_page_args()?>p=<?=$total_page?>">尾页</a>
			&nbsp;
			转到
			<input type="number" class="span1 text-center" value="<?=req('p')?>" onchange="location.replace('<?=get_page_args()?>p='+this.value)">页
		</div>

		<?}else{?>
			<div class="alert"><strong>提示：</strong>没有找到相关的产品信息！</div>
		<?}?>
 