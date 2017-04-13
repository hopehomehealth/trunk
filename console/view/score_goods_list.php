<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<ul class="nav nav-tabs">   
	<li <?if(nav_active('score_goods_list.php')){?>class="active"<?}?> style="padding-left:20px;">
		<a href="?cmd=<?=base64_encode('score_goods_list.php')?>">积分商品管理</a>
	</li>  
	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">刷新</a>
</ul>  
  

	<table width="100%">
		<tr>
			<td style="padding-top:7px">
				<form name="q_from" method="get" action="" class="form-inline">  
					<input name="cmd" type="hidden" value="<?=base64_encode('score_goods_list.php')?>" /> 
					  
					<select name="sale_type" style="width:100px"> 
					<option value="">-- 分类 --</option> 
					<?
					if(notnull($cat_list)){
					  foreach ($cat_list as $val){   
					?> 
					<option value="<?=$val['cat_id']?>" <? if(req('cat_id')==$val['cat_id']) echo 'selected';?>><?=$val['cat_name']?></option> 
					<?
					  }
					}
					?> 
					</select>

					<select name="is_sale" style="width:100px">
					<option value="">-- 状态 --</option> 
					<option value="1" <? if(req('is_sale')=='1') echo 'selected';?>>在售</option> 
					<option value="0" <? if(req('is_sale')=='0') echo 'selected';?>>停售</option> 
					</select>
					 
					<input name="kw" type="text" id="kw" class="span4" value="<?=req('kw')?>" placeholder="关键词…"/> 
					&nbsp;
					<input type="image" src="static/image/find.gif" class="input_img" title="搜索"/> 
 
				</form> 
			
			
			</td>
		</tr>
	</table>

	<script type="text/javascript">
	function doform(goods_id, item){
		var f =  document.getElementById('f'+goods_id);
		f.action = "do.php?cmd=score_goods_fast_edit&goods_id="+goods_id+"&item="+item;
		f.submit();
	} 
	</script>

	<? 
	if(notnull($query_rows)){
	?>
	<table width="100%"class="table table-hover"> 
		  <tr>   
			  <td style="width:300px">产品名称</td> 
			  <td>市场价</td>  
			  <td>兑换积分</td>
			  <td>排序号</td> 
			  <td>上下架</td>
			  <td>推荐</td> 
			  <td>操作</td>
		  </tr> 
		  <?  
		  foreach ($query_rows as $val){ 
				$goods_image = "/upfiles/$g_siteid/".$val['goods_image'];  
		  ?> 
		  <form target="frm" id="f<?=$val['goods_id']?>" method="post" action="" > 
			<tr <?if($val['is_sale']=='0'){?>class="error" title="已下架"<?}?>> 
 
			  <td><input name="goods_name" type="text" id="goods_name" title="<?=$val['goods_name']?>" style="width:250px;" value="<?=$val['goods_name']?>" size="30" onchange="doform('<?=$val['goods_id']?>', 'goods_name')" /> 
			  </td> 

			  <td><input name="market_price" type="text" id="market_price" title="<?=$val['market_price']?>" style="width:100px;" value="<?=$val['market_price']?>" size="30" onchange="doform('<?=$val['goods_id']?>', 'market_price')" /> 
			  </td> 

			  <td><input name="score_number" type="text" id="score_number" title="<?=$val['score_number']?>" value="<?=$val['score_number']?>" style="width:100px;" onchange="doform('<?=$val['goods_id']?>', 'score_number')" /> 
			  </td>  
  
			  <td><input name="order_id" type="number" id="order_id" style="width:50px;" value="<?=$val['order_id']?>" size="1" onchange="doform('<?=$val['goods_id']?>', 'order_id')" />
			  </td>
			   
			  <td> 
				<select id="is_sale" name="is_sale" style="width:80px;">
					<option value="1" <?if($val['is_sale']=='1'){?>selected<?}?> onchange="doform('<?=$val['goods_id']?>', 'is_sale')">上架</option>
					<option value="0" <?if($val['is_sale']=='0'){?>selected<?}?> onchange="doform('<?=$val['goods_id']?>', 'is_sale')">下架</option>
				</select> 
			  </td>
			   
			  <td >
				<select name="is_hot" onchange="doform('<?=$val['goods_id']?>', 'is_hot')" style="width:80px;" >  
					<option value="0" <? if($val['is_hot']==0) {echo 'selected';} ?> >非推荐</option> 
					<option value="1" <? if($val['is_hot']==1) {echo 'selected';} ?> >推荐^</option> 
				</select>	
			  </td>  
			  
			  <td>  
				<a href="?cmd=<?=base64_encode('score_goods_edit.php')?>&ac=copy&goods_id=<?=$val['goods_id']?>" style="cursor:pointer">复制</a> &nbsp; 
				<a href="/jifen/detail-<?=$val['goods_id']?>.html" target="_blank"><img src="static/image/view.gif" title="预览"/></a> 
				&nbsp;
				<a href="?cmd=<?=base64_encode('score_goods_edit.php')?>&goods_id=<?=$val['goods_id']?>" style="cursor:pointer"><img src="static/image/edit.gif" title="编辑"/></a> 
				&nbsp;
				<a href="do.php?cmd=score_goods_del&goods_id=<?=$val['goods_id']?>&cat_id=<?=req('cat_id')?>&sale_type=<?=req('sale_type')?>&kw=<?=req('kw')?>&p=<?=req('p')?>" onclick="return confirm('确认删除吗？')"><img src="static/image/delete.gif" title="删除"/></a> 
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
			<a href="<?=get_page_args()?>&p=1">首页</a>
			<a href="<?=get_page_args()?>&p=<?=$prev_number?>">上一页</a> 
			第<?=$now_page?> / <b><?=$total_page?></b>页 
			<a href="<?=get_page_args()?>&p=<?=$next_number?>">下一页</a>
			<a href="<?=get_page_args()?>&p=<?=$total_page?>">尾页</a>
			&nbsp;
			转到
			<input type="number" class="span1 text-center" value="<?=req('p')?>" onchange="location.replace('<?=get_page_args()?>&p='+this.value)">页
		</div>

	<?}else{?>
		<div class="alert"><strong>提示：</strong>没有找到相关的信息！</div>
	<?}?>
 