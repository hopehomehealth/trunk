<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<div class="bar_title">
	<strong>自定义分类</strong>
	<a href="javascript:location.reload()" class="pull-right btn btn-small">刷新</a>
</div>  

<script type="text/javascript">  
function doform(cat_id, item){ 
		var f =  document.getElementById('f'+cat_id); 
		f.action = "do.php?cmd=shop_goods_cat_edit&cat_id="+cat_id+"&item="+item; 
		f.submit();
} 
</script> 

 
		<form target="frm" method="post" action="do.php?cmd=shop_goods_cat_add" class="form-inline">
			<table>
			  <tr>
				<td>
				<font color="red">*</font>上级分类  
				<select name="parent_id" style="width:150px">
				<option value=""></option>
				<?  
				  $cat01 = son_cat('0');
				  if(notnull($cat01)){
					  foreach ($cat01 as $val01){   
						  echo get_cat_select($val01, 0);  
					  }
				  }
				?>
				</select>

				&nbsp;
				<font color="red">*</font>类别名称
				<input name="cat_name" type="text" id="cat_name" size="10" style="width:150px;" placeholder="名称,如：九寨沟…" required/>
				&nbsp; 
				<font color="red">*</font>序号
				<input name="order_id" type="number" id="order_id" size="5" value="<?=$max_order_id?>"  style="width:40px;"  placeholder="数字…" required/> 
				&nbsp;
				<input type="submit" value="新增" class="btn btn-danger"  />
				</td>
			  </tr>
			</table>
			<div class="alert" style="margin-top:10px">提示：做了的分类信息将展示在店铺主页；最多2级分类，一次性可增加多个分类，分类名称之间用 <b style="font-size:18px">^</b> 符号分割，如：泰山^黄山^华山</div>
		</form>
 
		<?
		$cat01 = son_cat('0');
		if(notnull($cat01)){
		?>
		<table class="table table-hover"> 
		  <thead>
		  <tr>   
			<td><strong>类别名称</strong></td>  
			<td><strong>序号</strong></td>  
			<td><strong>热推</strong></td> 
			<td width="100"><strong>操作</strong></td> 
		  </tr> 
		  </thead>
		  <?   
		  if(notnull($cat01)){
			  foreach ($cat01 as $val01){   
				  echo get_cat_html($val01, -1); 
				  
				  $cat02 = son_cat($val01['cat_id']);
				  if(notnull($cat02)){
					  foreach ($cat02 as $val02){   
						  echo get_cat_html($val02, 0); 
					  }
				  }
			  }
		  }
		  ?>
		</table>
		<?}else{?>
		<div class="alert"><strong>提示：</strong>没有找到相关的分类信息！</div>
		<?}?>


		<?
		function get_cat_html($val, $level){
			global $db, $g_siteid, $g_site_domain, $g_profile, $g_shop_url;
			$sql = "select count(*) from `t_goods_thread` where site_id='$g_siteid' and cat_id='".$val['cat_id']."' ";
			$goods_total = $db->get_value($sql); 

			$sql = "select count(*) from `t_article_thread` where goods_cat_id='".$val['cat_id']."' ";
			$news_total = $db->get_value($sql); 

			if(trim($val['cat_key'])==''){
				$sql = "update t_goods_catalog set cat_key='".pinyin($val['cat_name'])."' where cat_id='".$val['cat_id']."'";
				$db->query($sql);
			}

		?>
		<form target="frm" id="f<?=$val['cat_id']?>" action="" method="post" > 
		  <tr>
			<td>
			<?if($level>-1){?>
			<img src="static/image/child.gif" style="padding-left:<?=4+$level*40?>px"/>
			<?}?>
			
			<input name="cat_name" type="text" id="cat_name" value="<?=$val['cat_name']?>" size="12" style="<?if($val['is_hot']=='1'){?>color:red;<?}?>width:100px" onchange="doform('<?=$val['cat_id']?>', 'cat_name')" required/>  </td> 

			<td><input name="order_id" type="number" id="order_id" value="<?=$val['order_id']?>" size="5" style="width:40px" onchange="doform('<?=$val['cat_id']?>', 'order_id')" required/></td> 

			<td >
				<select name="is_hot" onchange="doform('<?=$val['cat_id']?>', 'is_hot')" style="width:80px" >  
				  <option value="0" <? if($val['is_hot']==0) {echo 'selected';} ?> >非推荐</option> 
				  <option value="1" <? if($val['is_hot']==1) {echo 'selected';} ?> >推荐^</option> 
				</select>	
			</td> 

			<td>   
			<a href="<?=$g_shop_url?>/product/list-<?=$val['cat_id']?>.html" target="_blank" title="点击预览"><img src="static/image/view.gif"/></a> 
			&nbsp;
			<a href="do.php?cmd=shop_goods_cat_del&cat_id=<?=$val['cat_id']?>" onclick="return confirm('确认删除吗？')"><img src="static/image/delete.gif"/></a> 

			</td>
		  </tr> 
		  </form>
		<?
		}
		?> 