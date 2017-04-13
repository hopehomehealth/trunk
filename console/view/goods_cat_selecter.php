<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
<link href="static/image/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/ajax/jquery-1.8.3.min.js" charset="utf-8" ></script>
 
<link href="static/js/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="static/js/ludo-jquery-treetable/jquery.treetable.js"></script> 
<link rel="stylesheet" href="static/js/ludo-jquery-treetable/css/jquery.treetable.css" />
<link rel="stylesheet" href="static/js/ludo-jquery-treetable/css/jquery.treetable.theme.default.css" />
</head>

<body style="padding:20px">  
		<form id="f<?=$val['cat_id']?>" action="do.php?cmd=goods_cat_rel" method="post" >
		<input type="hidden" name="goods_id" value="<?=$goods_id?>">
		<?
		$cat01 = son_cat('0');
		if(notnull($cat01)){
		?>
		<table class="table table-hover" id="mytab"> 
		  <thead>
		  <tr>   
			<td><strong>#ID</strong></td> 
			<td><strong>类别名称</strong></td> 
			<td><strong>排列序号</strong></td>  
			<td><strong>是否推荐</strong></td> 
			<td width="100"><strong><input type="submit" value="保存选中" class=" btn btn-info pull-right"></strong></td> 
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
						
						  $cat03 = son_cat($val02['cat_id']);
						  if(notnull($cat03)){
							  foreach ($cat03 as $val03){   
								  echo get_cat_html($val03, 1); 
							  }
						  }
					  }
				  }
			  }
		  }
		  ?>
		</table>
		<?}else{?>
		<div class="alert"><strong>提示：</strong>没有找到相关信息！</div>
		<?}?>

		<script type="text/javascript"> 
		$("#mytab").treetable({ expandable: true }); 
		</script>

		<?
		function get_cat_html($val, $level){ 
			global $goods;
		?>
		  <tbody>  
		  <tr data-tt-id="<?=$val['cat_id']?>" <?if($val['parent_id']>0){?>data-tt-parent-id="<?=$val['parent_id']?>"<?}?> >
			<td><?=$val['cat_id']?></td> 

			<td><?=$val['cat_name']?></td>  

			<td><?=$val['order_id']?></td> 

			<td><? if($val['is_hot']==1) {echo '推荐';} ?>	</td> 

			<td>
				<?if(has_son_cat($val['cat_id'])==false){?>
				<label><input type="checkbox" name="cat_id[]" <?if($goods['catalogs']!='' && in_array($val['cat_id'], explode(' ', $goods['catalogs']))){?>checked<?}?> value="<?=$val['cat_id']?>"> 选择</label>
				<?}?>
			</td>
		  </tr>
		  </tbody>
		
		<?
		}
		?> 
		<script type="text/javascript">
		function sel(id, name){
			parent.document.getElementById('cat_name_txt').value = name;
			parent.document.getElementById('cat_id').value = id;
			parent.$('#cat_selecter').modal('hide');
		}
		</script> 
		</form>
</body>
</html>