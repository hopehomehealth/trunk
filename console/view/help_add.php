<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<script type="text/javascript">
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="help_content"]', {
				cssPath : 'js/kindeditor/plugins/code/prettify.css',
				uploadJson : 'util/ke_upload_json.php',
				fileManagerJson : 'util/ke_file_manager_json.php',
				allowFileManager : true,
				urlType : 'domain',
				afterCreate : function() {
					var self = this;
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[name=form_help_add]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=form_help_add]')[0].submit();
					});
				}
			});
			prettyPrint();
		});
</script> 
 

<ul class="nav nav-tabs" id="myTab"> 
    <li class="active" style="padding-left:20px"><a href="#tabs-1">����������Ϣ</a></li>
	<a href="javascript:void(0)" onclick="history.back()" class="pull-right btn btn-small">����</a>
</ul>

   
		<form target="frm" action="do.php?cmd=help_add" method="post" id="form_help_add" name="form_help_add" enctype="multipart/form-data">
		  <input type="hidden" name="cat_id" value="<?=req('cat_id')?>">
		  <table cellpadding="3" cellspacing="0" width="100%">
			<tr>
			  <td align="right" width="60"><font color="red">*</font> <b>���⣺</b></td>
			  <td><input name="title" type="text" id="title" class="span6" required/></td>
			</tr> 
			<tr>
			  <td align="right"><b>ժҪ��</b></td>
			  <td><textarea name="summary" cols="70" rows="3" id="summary" class="span6"></textarea>
			  </td>
			</tr> 
			<tr>
			  <td align="right"><font color="red">*</font> <b>���ݣ�</b></td>
			  <td><textarea id="help_content" name="help_content" style="width:100%;height:400px;visibility:hidden;"  ></textarea></td>
			</tr>
			<tr>
			  <td align="right" width="80"><font color="red">*</font> <b>��ţ�</b></td>
			  <td><input name="order_id" type="number" id="order_id" class="span2" required/></td>
			</tr> 
			<tr>
			  <td></td>
			  <td><button type="submit" class="btn btn-danger"/>ȷ��</button></td>
			</tr>
		  </table>
		</form>
 