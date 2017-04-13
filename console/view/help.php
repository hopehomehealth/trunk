<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<script type="text/javascript">
$(document).ready(function(){
	$('#myTab a').click(function (e) { 
		e.preventDefault();
		$(this).tab('show'); 
	})
}); 
</script>

<ul class="nav nav-tabs" id="myTab"> 
  <li class="active" style="padding-left:20px"><a href="#tabs-1">�����б�</a></li>
  <li><a href="#tabs-2">��������</a></li> 

  <a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">ˢ��</a>
</ul>

<div class="tab-content"> 
	<div class="tab-pane in active" id="tabs-1">  
		<form name="q_from" method="GET" action="" class="form-inline">  

			<input name="cmd" type="hidden" value="<?=base64_encode('help.php')?>"/>

			<select name="cat_id" id="cat_id" class="span2">
				<option value=""></option>
				<?  
				$sql = "SELECT * FROM t_help_catalog WHERE site_id='$g_siteid' ORDER BY order_id ASC ";  
				$parent_help_cat = $db->get_all($sql);  
				if(notnull($parent_help_cat)){
					foreach ($parent_help_cat as $val){   
				?>
					<option value="<?=$val['cat_id']?>"><?=$val['cat_name']?></option>
					 
				<? 
					}
				}
				?>
			</select>

			<input name="kw" type="text" id="kw" class="span4" value="<?=req('kw')?>" placeholder="�ؼ��ʡ�" /> 
				 
			<button type="submit" class="btn btn-info"/> <i class="icon-search icon-white"></i> �� ��</button>
				 
		</form> 

		<script type="text/javascript">
		function doform(help_id, item){
			var f =  document.getElementById('f'+help_id);
			f.action = "do.php?cmd=help_edit_fast&help_id="+help_id+"&item="+item;
			f.submit();
		} 
		</script>

		<? 
		if(notnull($query_rows)){
		?>
		<table class="table table-hover"> 
		  <thead>
		  <tr> 
			<td width="150"><strong>�������</strong></td>
			<td><strong>��������</strong></td>  
			<td width="120"><strong>�Ƽ�</strong></td> 
			<td width="80"><strong>���</strong></td> 
			<td width="80" align="center"><strong>�� ��</strong></td>
		  </tr> 
		  </thead>
		  <?  
			foreach ($query_rows as $val){    	
		  ?>
		  <form target="frm" id="f<?=$val['help_id']?>" method="post" action="" >
		  <tr> 
			<td><?=$val['cat_name']?></td> 

			<td><a href="http://<?=$g_site_domain?>/help/<?=$val['help_id']?>.html" target="_blank"><?=$val['title']?></a></td> 

			<td>
			  <label><input name="is_hot" type="radio" id="is_hot" value="1" <?if($val['is_hot']=='1'){?>checked<?}?> onchange="doform('<?=$val['help_id']?>', 'is_hot')"/> �Ƽ�</label>
			 
			  <label><input name="is_hot" type="radio" id="is_hot" value="0" <?if($val['is_hot']=='0'){?>checked<?}?> onchange="doform('<?=$val['help_id']?>', 'is_hot')"/> ȡ��</label>
			</td>

			<td><?=$val['order_id']?></td> 

			<td align="center">
				<a href="http://<?=$g_site_domain?>/help/<?=$val['help_id']?>.html" target="_blank"><img src="static/image/view.gif"/></a>
				&nbsp;&nbsp;
				<span onclick="dialog_edit('./?cmd=<?=base64_encode('help_edit.php')?>&modal=true&help_id=<?=$val['help_id']?>')" style="cursor:pointer"><img src="static/image/edit.gif"/></span> 
				&nbsp;&nbsp;
				<a href="do.php?cmd=help_del&help_id=<?=$val['help_id']?>" onclick="return confirm('ȷ��ɾ����')"><img src="static/image/delete.gif"/></a>
			</td>
		  </tr>
		  </form>
		  <?	 
			}
		  ?>
		</table>

		<div style="text-align:right;padding-right:10px;">  
			<br/>
			����<b><?=$total_number?></b>�� &nbsp;
			<a href="./?cmd=<?=base64_encode('help.php')?>&cat_id=<?=req('cat_id')?>&kw=<?=req('kw')?>&p=1">��ҳ</a>
			<a href="./?cmd=<?=base64_encode('help.php')?>&cat_id=<?=req('cat_id')?>&kw=<?=req('kw')?>&p=<?=$prev_number?>">��һҳ</a> 
			��<?=$now_page?> / <?=$total_page?>ҳ 
			<a href="./?cmd=<?=base64_encode('help.php')?>&cat_id=<?=req('cat_id')?>&kw=<?=req('kw')?>&p=<?=$next_number?>">��һҳ</a>
			<a href="./?cmd=<?=base64_encode('help.php')?>&cat_id=<?=req('cat_id')?>&kw=<?=req('kw')?>&p=<?=$total_page?>">βҳ</a>
		</div>
		<?	 
		}
		?>
	</div>
	<div id="tabs-2" class="tab-pane"> 
		<form target="frm" method="post" action="do.php?cmd=help_cat_add" class="form-inline">
			<table>
			  <tr>
				<td>  
				<font color="red">*</font> �����
				<input name="cat_name" type="text" id="cat_name" size="10" class="span3" required placeholder="�磺֧����ʽ"/>
		 
				&nbsp;
				���
				<input name="order_id" type="number" id="order_id" size="3" value="<?=$max_order_id?>" class="input-mini" required/>
				 
				&nbsp;
				<button type="submit" class="btn btn-danger"/> <i class="icon-plus icon-white"></i> ����</button>
				</td>
			  </tr>
			</table>
		</form>
		<script type="text/javascript">
		function doform_cat(cat_id, item){
			var f =  document.getElementById('c'+cat_id);
			f.action = "do.php?cmd=help_cat_edit&cat_id="+cat_id+"&item="+item;
			f.submit();
		} 
		</script>
		<table class="table table-hover ">
		  <thead>
		  <tr>   
			<td><strong>���</strong></td> 
			<td><strong>���</strong></td> 
			<td></td> 
			<td align="center"> <strong>����</strong></td> 
		  </tr> 
		  </thead>

		  <? 
		  if(notnull($list01)){
			  foreach ($list01 as $val){    
				  get_item($val, 1); 
			  }
		  }
		  ?>
		</table>

		<?
		function get_item($val, $level){
			global $g_site_domain, $list01; 
		?>
		<form target="frm" id="c<?=$val['cat_id']?>" action="" method="post" >
		  <tr> 
			<td>   
			<input name="cat_name" type="text" id="cat_name"  value="<?=$val['cat_name']?>" size="20" onchange="doform_cat('<?=$val['cat_id']?>', 'cat_name')" class="span4"/>
			</td>  

			<td><input name="order_id" type="number" id="order_id"  value="<?=$val['order_id']?>" size="5" onchange="doform_cat('<?=$val['cat_id']?>', 'order_id')" class="input-mini"/></td>

			<td style="text-align:center">
				<i class="fa fa-plus"></i> <a href="?cmd=<?=base64_encode('help_add.php')?>&cat_id=<?=$val['cat_id']?>" >�������� (<b style="color:red"><?=get_help_number($val['cat_id'])?></b>)</a>  
			</td>

			<td> 
				<a href="do.php?cmd=help_cat_del&cat_id=<?=$val['cat_id']?>" onclick="return confirm('ȷ��ɾ����')"><img src="static/image/delete.gif"/></a>  
			</td>
		  </tr>
		</form>
		<?}?>
	</div>
</div>