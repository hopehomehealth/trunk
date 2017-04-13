<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?> 

<ul class="nav nav-tabs">   
	<li <?if(nav_active('goods_cat.php')){?>class="active"<?}?> style="padding-left:20px;">
		<a href="?cmd=<?=base64_encode('goods_cat.php')?>">产品分类</a>
	</li>  
	<?if(req('open')!='true'){?>
	<a href="?cmd=<?=base64_encode('goods_cat.php')?>&open=true" class="pull-right btn btn-small" style="margin-left:5px">全部展开</a>
	<?}else{?>
	<a href="?cmd=<?=base64_encode('goods_cat.php')?>&open=false" class="pull-right btn btn-small" style="margin-left:5px">全部收缩</a>
	<?}?>

	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">刷新</a>
</ul>  

<script type="text/javascript">  
function doform(cat_id, item){ 
	var f =  document.getElementById('f'+cat_id); 
	f.action = "do.php?cmd=goods_cat_edit&cat_id="+cat_id+"&item="+item; 
	f.submit();
}  
</script> 

<script type="text/javascript">
$(function (){
	$("#id_cat_name").live("keyup keydown change blur",function (){
		$("#id_cat_key").val($(this).toPinyin().replace(/\ +/g,"").toLocaleLowerCase());
	});
});
</script>

<script type="text/javascript" src="static/js/ludo-jquery-treetable/jquery.treetable.js"></script> 
<link rel="stylesheet" href="static/js/ludo-jquery-treetable/css/jquery.treetable.css" />
<link rel="stylesheet" href="static/js/ludo-jquery-treetable/css/jquery.treetable.theme.default.css" />

<script type="text/javascript" src="static/js/pinyin.js"></script>

 
		 
		<form target="frm" method="post" action="do.php?cmd=goods_cat_add" class="form-inline">
			<table>
			  <tr>
				<td> 

				<font color="red">*</font>上级分类  
				<select name="parent_id" style="width:180px">
				<option value="0"></option>
				<?  
				  $cat01 = son_cat('0');
				  if(notnull($cat01)){
					  foreach ($cat01 as $val01){   
						  echo get_cat_select($val01, 0); 
						  
						  $cat02 = son_cat($val01['cat_id']);
						  if(notnull($cat02)){
							  foreach ($cat02 as $val02){   
								  echo get_cat_select($val02, 1); 
							  }
						  }
					  }
				  }
				?>
				</select>

				&nbsp;
				<font color="red">*</font>类别名称
				<input name="cat_name" type="text" id="id_cat_name" style="width:200px;" placeholder="如：泰山" required />
				
				&nbsp;
				<font color="red">*</font>关键词
				<input name="cat_key" type="text" id="id_cat_key" style="width:150px;" pattern="[a-z]{1,50}" placeholder="拼音，如:taishan" required/>
				  
				&nbsp;
				<font color="red">*</font>序号
				<input name="order_id" type="number" id="order_id" value="<?=$max_order_id?>"  style="width:70px;"  placeholder="数字…" required/>
			 
				&nbsp;
				<input type="submit" value="确定" class="btn btn-danger"  />
				</td>
			  </tr>
			</table>
			<div class="alert alert-info" style="margin-top:10px">提示：最多3级分类；分类关键词有字母组成，不能重复；可一次性增加多个分类，分类名称之间用 <b style="font-size:18px">^</b> 符号分割，如：周边游^国内游^海外游</div>
		</form>


		<?
		$cat01 = son_cat('0');
		if(notnull($cat01)){
		?>
		<table class="table table-hover" id="tree_table"> 
		  <tr>   
			<td><strong>类别名称</strong></td>
			<td><strong>关键词</strong></td> 
			<td><strong>序号</strong></td>  
			<td><strong>热推</strong></td> 
			<td></td> 
			<td>SEO配置</td>
			<td width="100"><strong>操作</strong></td> 
		  </tr> 
		  <?   
		  if(notnull($cat01)){
			  foreach ($cat01 as $val01){   
				  echo get_cat_html($val01, -1); 
				  
				  $cat02 = son_cat($val01['cat_id']);
				  if(notnull($cat02)){
					  foreach ($cat02 as $val02){   
						  echo get_cat_html($val02, 0);
						
						  $cat03 = son_cat($val02['cat_id']);
						  if(notnull($cat03)){
							  foreach ($cat03 as $val03){   
								  echo get_cat_html($val03, 1); 

								  $cat04 = son_cat($val03['cat_id']);
								  if(notnull($cat04)){
									  foreach ($cat04 as $val04){   
										  echo get_cat_html($val04, 1); 
									  }
								  }
							  }
						  }
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
			global $db, $g_siteid, $g_site_domain, $g_profile; 

			if(trim($val['cat_key'])==''){
				$sql = "UPDATE `t_goods_catalog` SET `cat_key`='".pinyin($val['cat_name'])."' WHERE `cat_id`='".$val['cat_id']."'";
				$db->query($sql); 

			}
			if(trim($val['cat_key'])!=''){  
				$sql = "SELECT `cat_id` FROM t_goods_catalog WHERE `cat_id`<>'".$val['cat_id']."' AND `cat_key`='".$val['cat_key']."'";
				$exist_cat_key = $db->get_value($sql);
				
				if($exist_cat_key!=''){
					$sql = "UPDATE `t_goods_catalog` SET `cat_key`='".$val['cat_key']."2' WHERE `cat_id`='".$val['cat_id']."'";
					$db->query($sql);
				}
			}

		?>
		<form target="frm" id="f<?=$val['cat_id']?>" action="" method="post" >
		  <tbody>  
		  <tr data-tt-id="<?=$val['cat_id']?>" <?if($val['parent_id']>0){?>data-tt-parent-id="<?=$val['parent_id']?>"<?}?>>
			<td>
			<?if($level>-1){?>
			<img src="static/image/child.gif" style="padding-left:<?=4+$level*40?>px"/>
			<?}?>
			
			<input name="cat_name" type="text" id="cat_name" value="<?=$val['cat_name']?>" size="12" style="<?if($val['is_hot']=='1'){?>color:red;<?}?>width:120px" onchange="doform('<?=$val['cat_id']?>', 'cat_name')" required/>  </td>

			<td><input name="cat_key" type="text" id="cat_key" value="<?=$val['cat_key']?>" size="10" style="width:200px" onchange="doform('<?=$val['cat_id']?>', 'cat_key')" required/></td>

			<td><input name="order_id" type="number" id="order_id" value="<?=$val['order_id']?>" size="5" style="width:70px" onchange="doform('<?=$val['cat_id']?>', 'order_id')" required/></td> 

			<td >
				<select name="is_hot" onchange="doform('<?=$val['cat_id']?>', 'is_hot')" style="width:80px" >  
				  <option value="0" <? if($val['is_hot']==0) {echo 'selected';} ?> >非推荐</option> 
				  <option value="1" <? if($val['is_hot']==1) {echo 'selected';} ?> >推荐^</option> 
				</select>	
			</td> 

			<td>
				<?if(has_son_cat($val['cat_id'])==false){?> 
				<a href="?cmd=<?=base64_encode('news_add.php')?>&goods_cat_id=<?=$val['cat_id']?>">发布文章</a>  
				<?}?>
			</td>

			<td>
				<button onclick="dialog_edit('<?=url('seo_editor.php')?>&modal=true&primary_name=cat_id&primary_value=<?=$val['cat_id']?>&table_name=t_goods_catalog')" style="cursor:pointer" <?if($val['page_title']!=''){?>class="btn btn-warning btn-mini" title="已配置"<?}else{?>class="btn btn-mini" title="未配置"<?}?>>SEO配置</button>
			</td>

			<td>
				<a href="http://<?=$g_site_domain?>/gentuan/<?=$val['cat_key']?>/" target="_blank" title="点击预览"><img src="static/image/view.gif" title="ID：<?=$val['cat_id']?>"/></a> 
				&nbsp; 
				<a href="?cmd=<?=base64_encode('goods_cat_edit.php')?>&cat_id=<?=$val['cat_id']?>"><img src="static/image/edit.gif"/></a> 
				&nbsp; 
				<a href="do.php?cmd=goods_cat_del&cat_id=<?=$val['cat_id']?>" onclick="return confirm('确认删除吗？')"><img src="static/image/delete.gif"/></a>  
			</td>
		  </tr>
		  </tbody>
		  </form>
		<?
		}
		?>
		 
		<script type="text/javascript">
		<?if(req('open')!='true'){?>
		$("#tree_table").treetable({ expandable: true }); 
		<?}?>
		</script>