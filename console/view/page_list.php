<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

 
<script type="text/javascript">
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="news_content"]', {
				cssPath : 'js/kindeditor/plugins/code/prettify.css',
				uploadJson : 'util/ke_upload_json.php',
				fileManagerJson : 'util/ke_file_manager_json.php',
				allowFileManager : true,
				urlType : 'domain',
				afterCreate : function() {
					var self = this;
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[name=page_add_form]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=page_add_form]')[0].submit();
					});
				}
			});
			prettyPrint();
		});
</script>

<script type="text/javascript">
$(document).ready(function(){
	$('#myTab a').click(function (e) { 
		e.preventDefault();
		$(this).tab('show'); 
	})
}); 
</script>

<ul class="nav nav-tabs" id="myTab"> 
  <li class="active" style="padding-left:20px"><a href="#tabs-1">ҳ���ѯ</a></li>
  <li><a href="#tabs-2">�½�ҳ��</a></li> 

  <a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">ˢ��</a>
</ul>

<div class="tab-content"> 
	<div class="tab-pane in active" id="tabs-1">    
		<? 
		if(notnull($query_rows)){
		?>
		<table width="100%"  class="table table-hover"> 
		  <tr> 
			<td ><strong>�� ��</strong></td>  
			<td ><strong>Ӣ�Ĺؼ���</strong></td>
			<td ><strong>�������</strong></td>
			<td width="120" ><strong>SEO����</strong></td>
			<td width="120" align="center"><strong>�� ��</strong></td>
		  </tr> 
		  <?  
			foreach ($query_rows as $val){    	
		  ?>
		  <tr> 
			<td><a title="���Ԥ��" href="http://<?=$g_site_domain?>/page/<?=$val['key']?>.html" target="_blank"><?=$val['title']?></a></td> 

			<td><?=$val['key']?></td>

			<td><?=$val['order_id']?></td>

			<td>
				<button onclick="dialog_edit('<?=url('seo_editor.php')?>&modal=true&primary_name=page_id&primary_value=<?=$val['page_id']?>&table_name=t_page')" style="cursor:pointer" <?if($val['page_title']!=''){?>class="btn btn-warning btn-mini" title="������"<?}else{?>class="btn btn-mini" title="δ����"<?}?>>SEO����</button>
			</td>
		 
			<td align="center">
				<a title="���Ԥ��" href="http://<?=$g_site_domain?>/page/<?=$val['key']?>.html" target="_blank"><img src="static/image/view.gif"/></a>
				&nbsp;
				<span onclick="dialog_edit('./?cmd=<?=base64_encode('page_edit.php')?>&modal=true&page_id=<?=$val['page_id']?>')" style="cursor:pointer"><img src="static/image/edit.gif"/></span> 
				&nbsp;
				<a href="do.php?cmd=page_del&page_id=<?=$val['page_id']?>" onclick="return confirm('ȷ��ɾ����')"><img src="static/image/delete.gif"/></a>
			</td>
		  </tr>
		  <?	 
			}
		  ?>
		</table> 
		<?	 
		}
		?>
	</div>

	<div id="tabs-2" class="tab-pane"> 
		<form target="frm" action="do.php?cmd=page_add" method="post" id="page_add_form" name="page_add_form">
		  <table width="100%">
			<tr> 
			  <td width="10%" align="right"><font color="red">*</font> ҳ����⣺ </td>
			  <td> <input name="title" type="text" class="span6" id="title" size="50" required placeholder="�磺��������"/> </td>
			</tr> 
			<tr> 
			  <td align="right"><font color="red">*</font> ҳ��ؼ��ʣ� </td>
			  <td> <input name="key" type="text" class="span6" id="key" size="50" required placeholder="��ĸ������ɣ��磺aboutus"/> </td>
			</tr>
			<tr>
			  <td align="right">SEO/title��</td>
			  <td><input type="text" name="page_title" class="span6" /></td> 
			</tr>  
			<tr>
			  <td align="right">SEO/Description��</td>
			  <td><textarea name="page_description" class="span6" rows="5" ></textarea></td> 
			</tr>  
			<tr>
			  <td align="right">SEO/Keywords��</td>
			  <td><input type="text" name="page_keywords" class="span6"/></td> 
			</tr>  
			<tr>
			  <td align="right" ><font color="red">*</font> ������ţ�</td>
			  <td><input name="order_id" id="order_id" type="number" class="span2" required/></td>
			</tr>
			<tr>
			  <td align="right"><font color="red">*</font> �� �ݣ�</td>
			  <td><textarea id="news_content" name="news_content" style="width:100%;height:500px;visibility:hidden;"></textarea></td>
			</tr>
			<tr>
			  <td></td>
			  <td><br/><input type="submit" value="ȷ��" class="btn btn-danger" /></td>
			</tr>
		  </table>
		</form>
	</div>
</div>