<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<ul class="nav nav-tabs">   
	<li <?if(nav_active('site_hotspot.php')){?>class="active"<?}?> style="padding-left:20px;">
		<a href="?cmd=<?=base64_encode('site_hotspot.php')?>">浮动导航</a>
	</li>     

	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">刷新</a>
</ul> 
 	 	

<script type="text/javascript">
	function dialog_upfile(id, col){ 
		$(function() { 
			$( "#mydialog" ).dialog({  
				modal: true,
				buttons: {
					' 关闭 ': function() {
					  $( this ).dialog( "close" );
					}
				},
				minWidth: 500 
			}); 
		}); 
		
		document.getElementById('pic_col_name').value = col;
		document.getElementById('pic_hotspot_id').value = id;
		 
		if(col=='ad2'){
			document.getElementById('pic_ad_link').style.display = 'block';
		} else {
			document.getElementById('pic_ad_link').style.display = 'none';
		}
		if(col=='ad1') document.getElementById('file_size_note').innerHTML='265×133px';
		if(col=='ad2') document.getElementById('file_size_note').innerHTML='328×462px';
		if(col=='ico') document.getElementById('file_size_note').innerHTML='26×26px';
	} 
</script>

<script type="text/javascript" src="static/js/ludo-jquery-treetable/jquery.treetable.js"></script> 
<link rel="stylesheet" href="static/js/ludo-jquery-treetable/css/jquery.treetable.css" />
<link rel="stylesheet" href="static/js/ludo-jquery-treetable/css/jquery.treetable.theme.default.css" />

<div id="mydialog" title="更新图片" style="display:none" >
			<form target="frm" method="post" action="do.php?cmd=hotspot_update_image" enctype="multipart/form-data" >
					<br/>
					<div>
						图片： 
						<input type="file" name="pic" >  
						<span id="file_size_note"></span>
					</div> 
					<br/>
					<div id="pic_ad_link" style="display:none">
						网址： 
						<input type="text" name="link" placeholder="http://">  
					</div>
					<div style="padding-left:50px">  
						<input name="pic_col_name" type="hidden" id="pic_col_name"/> 
						<input name="pic_hotspot_id" type="hidden" id="pic_hotspot_id"/> 
						<input type="submit" value=" 更新 " class="btn btn-danger" /> 
					</div> 
			</form>
</div> 
   
		<form target="frm" method="post" action="do.php?cmd=hotspot_add" class="form-inline">
			 
				上级导航：
				<select name="parent_id">
				  <option value="0">顶层导航</option>
				  <? 
				  // level 1 //
				  $hotspot1 = get_hotspot('0');
				  if(notnull($hotspot1)){
					foreach ($hotspot1 as $val1){   
					  get_opt($val1, 1);
					  // level 2 //
					  $hotspot2 = get_hotspot($val1['hotspot_id']);
					  if(notnull($hotspot2)){
						foreach ($hotspot2 as $val2){   
						  get_opt($val2, 2); 
						}
					  }
					}
				  }
				  ?>  
				</select> 
				&nbsp;
				导航
				<input name="title" type="text" id="title" size="15" class="span2" required/>
				&nbsp;
				链接
				<input name="url" type="text" id="url" size="20" class="span2" required/>
				&nbsp;
				序号
				<input name="order_id" type="number" id="order_id" size="3" class="span1" value="<?=$max_order_id?>" required/>
				 
				<input type="submit" value="确定" class="btn btn-danger" />
			 
		</form>

		<script type="text/javascript">
		function doform(hotspot_id, item){
			var f =  document.getElementById('f'+hotspot_id);
			f.action = "do.php?cmd=hotspot_edit&hotspot_id="+hotspot_id+"&item="+item;
			f.submit();
		} 
		</script>

		 
		<table width="100%" id="tree_table" class="table table-hover">
		  <tbody class="mytbody">
		  <tr>  
			<td><strong>导航</strong></td>
			<td><strong>链接URL</strong></td>
			<td><strong>序号</strong></td> 
			<td><strong>小图标</strong></td>
			<td><strong>广告1</strong></td>
			<td><strong>广告2</strong></td>
			<td><strong>推荐</strong></td> 
			<td width="30"><strong>操作</strong></td> 
		  </tr>
		  </tbody>
		 
		  <? 
				  // level 1 //
				  $hotspot1 = get_hotspot('0');
				  if(notnull($hotspot1)){
					$hs = 1;
					foreach ($hotspot1 as $val1){   
					  get_html($val1, -1, $hs);
					  // level 2 //
					  $hotspot2 = get_hotspot($val1['hotspot_id']);
					  if(notnull($hotspot2)){
						foreach ($hotspot2 as $val2){   
						  get_html($val2, 0);
						  // level 3 //
						  $hotspot3 = get_hotspot($val2['hotspot_id']);
						  if(notnull($hotspot3)){
							foreach ($hotspot3 as $val3){   
							  get_html($val3, 1);  
							}
						  } 
						}
					  }
					  $hs++;
					}
				  }
				  ?>  
		</table> 
 
<?
function get_html($val, $level, $hs=''){
	global $g_siteid;
?>
	<form target="frm" id="f<?=$val['hotspot_id']?>" action="" method="post" >
		  <tr data-tt-id="<?=$val['hotspot_id']?>" <?if($val['parent_id']>0){?>data-tt-parent-id="<?=$val['parent_id']?>"<?}?>> 
			<td> 

			<input  name="title" type="text" id="title" class="input-small" value="<?=$val['title']?>" size="25" onchange="doform('<?=$val['hotspot_id']?>', 'title')"/></td>

			<td><input  name="url" type="text" id="url" class="input-medium" value="<?=$val['url']?>" size="30" onchange="doform('<?=$val['hotspot_id']?>', 'url')"/></td>

			<td><input  name="order_id" type="number" id="order_id" class="input-small" value="<?=$val['order_id']?>" size="3" onchange="doform('<?=$val['hotspot_id']?>', 'order_id')"/></td>

              <!-- <td>
            <?if($level==-1){?>
            <img src="/upfiles/<?=$g_siteid?>/<?=$val['ico']?>" onclick="dialog_upfile('<?=$val['hotspot_id']?>//////', 'ico')" title="点击更新" onerror="this.src='/images/hs<?=$hs?>.png'">
            <?}?>
            </td>

            <td>
            <?if($level==-1){?>
            <img src="/upfiles/<?=$g_siteid?>/<?=$val['ad1']?>" style="width:80px" onclick="dialog_upfile('<?=$val['hotspot_id']?>//', 'ad1')" title="点击更新" onerror="this.src='/images/hotspot_ad1.jpg'">
            <?}?>
            </td>

            <td>
            <?if($level==-1){?>
            <img src="/upfiles/<?=$g_siteid?>/<?=$val['ad2']?>" style="width:40px" onclick="dialog_upfile('<?=$val['hotspot_id']?>//', 'ad2')" title="点击更新" onerror="this.src='/images/hotspot_ad2.jpg'">
            <?}?>
            </td> -->

              <td>
                  <?if($level==-1){?>
                      <img src="/themes/s01/images/hs<?=$hs?>.png" onclick="dialog_upfile('<?=$val['hotspot_id']?>', 'ico')" title="点击更新">
                  <?}?>
              </td>

              <td>
                  <?if($level==-1){?>
                      <img src="/themes/s01/images/hotspot_ad1.jpg" style="width:80px" onclick="dialog_upfile('<?=$val['hotspot_id']?>', 'ad1')" title="点击更新">
                  <?}?>
              </td>

              <td>
                  <?if($level==-1){?>
                      <img src="/themes/s01/images/hotspot_ad2.jpg" style="width:40px" onclick="dialog_upfile('<?=$val['hotspot_id']?>', 'ad2')" title="点击更新">
                  <?}?>
              </td>

			<td>
			<?if($level>-1){?>
			<input name="is_hot" type="checkbox" id="is_hot" value="1" <?if($val['is_hot']=='1'){echo 'checked';}?> onchange="doform('<?=$val['hotspot_id']?>', 'is_hot')"/>
			<?}?>
			</td>

			<td align="center"><a href="do.php?cmd=hotspot_del&hotspot_id=<?=$val['hotspot_id']?>" target="frm" onclick="return confirm('确认删除吗？')"><img src="static/image/delete.gif"/></a> </td>
		  </tr>
	</form>
<?}?>
 

<script type="text/javascript">
$("#tree_table").treetable({ expandable: true }); 
</script>