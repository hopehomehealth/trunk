<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<ul class="nav nav-tabs">   
	<li <?if(nav_active('news_list.php')){?>class="active"<?}?> style="padding-left:20px;">
		<a href="?cmd=<?=base64_encode('news_list.php')?>">文章管理</a>
	</li>   
	<li <?if(nav_active('news_cat.php')){?>class="active"<?}?>>
		<a href="?cmd=<?=base64_encode('news_cat.php')?>">文章分类</a>
	</li>   
	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">刷新</a>
</ul> 
  

		<form target="frm" method="post" action="do.php?cmd=news_cat_add" class="form-inline">
		  
				<font color="red">*</font> 类别名
				<input name="cat_name" type="text" id="cat_name" size="10"  class="span2" placeholder="如：黄山"  required/>
				&nbsp;
				关键词
				<input name="cat_key" type="text" id="cat_key" size="6" placeholder="请输入拼音..." class="span2" required/>
				&nbsp;
				序号
				<input name="order_id" type="number" id="order_id" size="3" value="<?=$max_order_id?>" title="前台按数字排序" class="span1"/>
				<font color="red">*</font> 类型
				<select name="cat_type" style="width:100px">
					<option value="0">文章列表</option>
					<option value="1">图片列表</option>
					<option value="2">图文混排</option>
				</select>
				&nbsp;
				<input type="submit" value="确定" class="btn btn-danger" /> 
				 
		</form>
		<script type="text/javascript">
		function doform_news_cat(cat_id, item){
			var f =  document.getElementById('f'+cat_id);
			f.action = "do.php?cmd=news_cat_edit&cat_id="+cat_id+"&item="+item;
			f.submit();
		} 
		</script>
		<table width="100%" class="table table-hover"> 
		  <tr>   
			<td><strong>类别名称</strong></td> 
			<td><strong>类别关键词</strong></td>  
			<td><strong>序号</strong></td> 
			<td></td> 
			<td><strong>SEO配置</strong></td>
			<td align="center"> <strong>操作</strong></td> 
		  </tr> 
		  <? 
		  if(notnull($list01)){
			foreach ($list01 as $val){    
				get_item($val, 1);
				
				$list02 = get_cat($val['cat_id']);
				if(notnull($list02)){
					foreach ($list02 as $cval){    
						get_item($cval, 2);		
					}
				}
			}
		  }
		  ?>
		</table>

		<?
		function get_item($val, $level){
			global $g_site_domain, $list01;

			$cat_url = "/news/".$val['cat_key']."/";
		?>
		<form target="frm" id="f<?=$val['cat_id']?>" action="" method="post" >
		  <tr> 
			<td valign="top">    
				<input name="cat_name" type="text" id="cat_name" value="<?=$val['cat_name']?>" onchange="doform_news_cat('<?=$val['cat_id']?>', 'cat_name')"/> 	 
			</td> 

			<td valign="top">     
				<input name="cat_key" type="text" id="cat_key" value="<?=$val['cat_key']?>" onchange="doform_news_cat('<?=$val['cat_id']?>', 'cat_key')" <?if($val['cat_key']=='notice' || $val['cat_key']=='gonglue'){?>disabled<?}?>/> 	 
			</td> 

			<td valign="top"><input name="order_id" type="number" id="order_id" class="input-small" value="<?=$val['order_id']?>" size="5" onchange="doform_news_cat('<?=$val['cat_id']?>', 'order_id')"/></td>
			
			<td align="center" valign="top" class="text-center">  
				<i class="fa fa-search"></i> <a href="?cmd=<?=base64_encode('news_list.php')?>&cat_id=<?=$val['cat_id']?>" >查询文章 (<b style="color:red"><?=get_article_number($val['cat_id'])?></b>)</a>  
			</td>

			<td>
				<button onclick="dialog_edit('<?=url('seo_editor.php')?>&modal=true&primary_name=cat_id&primary_value=<?=$val['cat_id']?>&table_name=t_article_catalog')" style="cursor:pointer" <?if($val['page_title']!=''){?>class="btn btn-warning btn-mini" title="已配置"<?}else{?>class="btn btn-mini" title="未配置"<?}?>>SEO配置</button>
			</td>

			<td align="center" valign="top" class="text-center">   
				<a href="<?=$cat_url?>" target="_blank"><img src="static/image/view.gif"/></a> &nbsp;

				<a href="do.php?cmd=news_cat_del&cat_id=<?=$val['cat_id']?>" onclick="return confirm('确认删除吗？')"><img src="static/image/delete.gif"/></a> 
			</td>
		  </tr>
		  </form>
		  <?}?>
 