<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<ul class="nav nav-tabs">   
	<li <?if(nav_active('goods_floor.php') && req('goods_type')=='0'){?>class="active"<?}?> style="padding-left:20px;">
		<a href="?cmd=<?=base64_encode('goods_floor.php')?>&goods_type=0">首页</a>
	</li>   
	<?  
	foreach ($g_product_type as $k => $v) {  
	?>
	<li <?if(nav_active('goods_floor.php') && req('goods_type')==$k){?>class="active"<?}?>>
		<a href="?cmd=<?=base64_encode('goods_floor.php')?>&goods_type=<?=$k?>"><?=$v?></a>
	</li>  
	<? 
	}
	?> 

	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">刷新</a>
</ul> 
 	 	 
		<form target="frm" id="goods_floor_add_form" method="post" action="do.php?cmd=goods_floor_add"> 
				<input type="hidden" name="goods_type" value="<?=$c_goods_type?>">
				<table> 
					<tr>
						<td>上级楼层：</td>
						<td>
						<select id="parent_id" name="parent_id" required>  
							<option value="0"></option>
						<?   
						if(notnull($floor_top)){
							foreach ($floor_top as $val){    	
						?>
							<option value="<?=$val['floor_id']?>"><?=$val['floor_title']?></option>  
						<?				
							}
						}
						?>
						</select>
						</td>
					</tr>
					<tr>
						<td>楼层名称：</td>
						<td>  
						<input name="floor_title" type="text" id="floor_title" size="40" required/>
						</td>
					</tr> 
					<tr>
						<td>排列序号：</td>
						<td>
						<input name="order_id" type="number" id="order_id" size="40" required value="<?=$max_order_id?>"/>
						</td>
					</tr>  
					<tr> 
						<td></td>
						<td>
							<input type="submit" class="btn btn-danger" value="确定" />  
						</td> 
					</tr>
			</table> 
		</form>
		

		<script type="text/javascript">
		function doform_floor(floor_id, item){
			var f =  document.getElementById('f'+floor_id);
			f.action = "do.php?cmd=goods_floor_edit&floor_id="+floor_id+"&item="+item;
			f.submit();
		} 
		</script>
		<? 
		  if(notnull($rows)){
		?>
		<table class="table table-hover"> 
		  <tr>  
			<td><strong>上级楼层</strong></td>
			<td><strong>楼层名称</strong></td>
			<td><strong>楼层色彩</strong></td> 
			<td><strong>楼层URL</strong></td> 
			<td><strong>排序</strong></td>  
			<td width="120"><strong>操作</strong></td>
		  </tr> 
		  <?  
			foreach ($rows as $val){  
				$sql = "select count(*) from t_goods_floor_topic where site_id='$g_siteid' and floor_id='".$val['floor_id']."' ";
				$topic_total = $db->get_value($sql); 
		  ?>
		  <form target="frm" id="f<?=$val['floor_id']?>" action="" method="post" >  
			<td>
				<select id="parent_id" name="parent_id" onchange="doform_floor('<?=$val['floor_id']?>', 'parent_id')" class="input-small"> 
					<option value="0"></option>
				<?   
				if(notnull($floor_top)){
					foreach ($floor_top as $cval){
						if($cval['floor_id']!=$val['floor_id']){
				?>
					<option value="<?=$cval['floor_id']?>" <?if($cval['floor_id']==$val['parent_id']){?>selected<?}?>><?=$cval['floor_title']?></option>  
				<?		
						}
					}
				}
				?>
				</select>
			</td>

			<td><input  name="floor_title" type="text" id="floor_title"  value="<?=$val['floor_title']?>" class="input-small" onchange="doform_floor('<?=$val['floor_id']?>', 'floor_title')"/></td>

			<td><input  name="floor_color" type="text" id="floor_color"  value="<?=$val['floor_color']?>" class="input-small" onchange="doform_floor('<?=$val['floor_id']?>', 'floor_color')" placeholder="#000000"/></td>

			<td><input  name="floor_url" type="url" id="floor_url"  value="<?=$val['floor_url']?>" class="input-small" onchange="doform_floor('<?=$val['floor_id']?>', 'floor_url')" placeholder="http://"/></td>

			<td><input  name="order_id" type="number" id="order_id"  value="<?=$val['order_id']?>" class="input-small" onchange="doform_floor('<?=$val['floor_id']?>', 'order_id')"/></td>
 
			<td  align="center">
				<select id="state" name="state" onchange="doform_floor('<?=$val['floor_id']?>', 'state')" class="input-small" >  
					<option value="0" <? if($val['state']==0) {echo 'selected';} ?> >禁用</option> 
					<option value="1" <? if($val['state']==1) {echo 'selected';} ?> >启用</option> 
				</select>	
				<br/>
				 
				<a href="?cmd=<?=base64_encode('goods_floor_topic.php')?>&floor_id=<?=$val['floor_id']?>&floor_title=<?=$val['floor_title']?>" title="首页的楼层主题广告，仅限特定模板">楼层主题广告(<?=$topic_total?>)</a>  
				<br/>
				<a href="?cmd=<?=base64_encode('goods_floor_goods.php')?>&floor_id=<?=$val['floor_id']?>&floor_title=<?=$val['floor_title']?>" title="首页的楼层主题广告，仅限特定模板">楼层推荐产品(<?=$topic_total?>)</a>  
				<br/><br/>
				<a href="do.php?cmd=goods_floor_del&floor_id=<?=$val['floor_id']?>" onclick="return confirm('确认删除吗？')"><img src="static/image/delete.gif"/> 删除楼层</a> 
			</td>
		  </tr>
		  </form>
		  <?	 
		  }
		  ?>
		</table> 
		<?	 
		}
		?> 