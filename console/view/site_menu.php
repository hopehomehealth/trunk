<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?> 

<?include('site.nav.php');?> 
 
<form target="frm" method="post" action="do.php?cmd=menu_add" class="form-inline">
			 
				�ϼ��˵���
				<select name="parent_id" title="��ѡ����Ϊһ���˵�" class="span2">
				  <option value=""></option>
				  <? 
				  if(notnull($parents)){
						foreach ($parents as $val){   
				  ?>
				  <option value="<?=$val['menu_id']?>"><?=$val['title']?></option>
				  <?
						}
				  }
				  ?>  
				</select> 
				&nbsp;
				�˵�
				<input name="title" type="text" id="title" size="15" class="span2" required/>
				&nbsp;
				����
				<input name="url" type="text" id="url" size="20" autocomplete="off" style="width:165px" required
				data-provide="typeahead" data-items="4" data-source='<?=$typeahead?>' />
				&nbsp; 
				���
				<input name="order_id" type="number" id="order_id" size="3" class="span1" value="<?=$max_order_id?>" required/>
				 
				<input type="submit" value="ȷ��" class="btn btn-danger" />
			 
</form>

		<script type="text/javascript">
		function doform_menu(menu_id, item){
			var f =  document.getElementById('f'+menu_id);
			f.action = "do.php?cmd=menu_edit&menu_id="+menu_id+"&item="+item;
			f.submit();
		} 
		</script>

		<? 
		  if(notnull($menus)){
		?>
		<table class="table"> 
		  <tr> 
			<td><strong>�ϼ��˵�</strong></td>
			<td><strong>�˵�</strong></td>
			<td><strong>����URL</strong></td>
			<td><strong>CSS</strong> <a href="http://www.w3school.com.cn/css/" target="_blank" style="color:blue">ѧϰ�˽�</a></td>
			<td><strong>���</strong></td> 
			<td><strong>�򿪷�ʽ</strong></td> 
			<td width="30"><strong>����</strong></td> 
		  </tr> 
		  <?  
			foreach ($menus as $val){    	
		  ?>
		  <form target="frm" id="f<?=$val['menu_id']?>" action="" method="post" >
		  <tr>
			<td >
			<select name="parent_id" onchange="if(confirm('ȷ�ϸ�����')){doform_menu('<?=$val['menu_id']?>', 'parent_id');}" class="input-small">
				  <option value=""></option>
				  <? 
				  if(notnull($parents)){
						foreach ($parents as $cval){   
				  ?>
				  <option value="<?=$cval['menu_id']?>" <? if($cval['menu_id']==$val['parent_id']) {echo 'selected';} ?>><?=$cval['title']?></option>
				  <?
						}
				  }
				  ?>   
			</select>	
			</td> 
			<td><input name="title" type="text" id="title" class="input-small" value="<?=$val['title']?>" size="25" onchange="doform_menu('<?=$val['menu_id']?>', 'title')"/></td>

			<td><input name="url" type="text" id="url" class="input" value="<?=$val['url']?>" size="30" onchange="doform_menu('<?=$val['menu_id']?>', 'url')" data-provide="typeahead" data-items="4" data-source='<?=$typeahead?>'/></td>

			<td><input name="css" type="text" id="css" class="input-small" value="<?=$val['css']?>" size="30" onchange="doform_menu('<?=$val['menu_id']?>', 'css')"/></td>

			<td><input name="order_id" type="number" id="order_id" class="input-mini" value="<?=$val['order_id']?>" onchange="doform_menu('<?=$val['menu_id']?>', 'order_id')"/></td>

			<td>
			<select id="target" name="target" class="input-small" onchange="doform_menu('<?=$val['menu_id']?>', 'target')">
				<option value="_self" <?if($val['target']=='_self'){?>selected<?}?>>������</option>
				<option value="_blank" <?if($val['target']=='_blank'){?>selected<?}?>>�´���</option>
			</select>
			</td>

			<td align="center"><a href="do.php?cmd=menu_del&menu_id=<?=$val['menu_id']?>" onclick="return confirm('ȷ��ɾ����')"><img src="static/image/delete.gif"/></a> </td>
		  </tr>
		  </form>
		  <?				
			} 
		  ?>
		</table>
		<?	 
		}
		?>
	 