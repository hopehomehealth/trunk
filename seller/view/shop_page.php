<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<div class="bar_title">
	<strong>��������</strong>
	<a href="javascript:location.reload()" class="pull-right btn btn-small">ˢ��</a>
</div> 

 
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
						K('form[name=page_update_form]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=page_update_form]')[0].submit();
					});
				}
			});
			prettyPrint();
		});
</script>

 
<form target="frm" action="do.php?cmd=shop_page_update" method="post" id="page_update_form" name="page_update_form">

  <input type="hidden" name="page_id" value="<?=$detail['page_id']?>">
  <input name="key" id="key" type="hidden" required size="60" value="<?=$detail['key']?>"/>
  <table width="100%">
    <tr>
      <td align="right" width="60"><font color="red">*</font> �� �⣺</td>
      <td><input name="title" id="title" type="text" required class="span6" value="<?=$detail['title']?>"/></td>
    </tr>   
    <tr> 
      <td align="right"><font color="red">*</font> �� �ݣ�</td>
	  <td>
		<textarea id="news_content" name="news_content" style="width:100%;height:450px;visibility:hidden;"><?=stripslashes($detail['content'])?></textarea>
	  </td>
    </tr>
    <tr> 
	  <td></td>
      <td>  
		<br/>
		<input type="submit" value="ȷ ��" class="btn btn-danger" />
      </td>
    </tr>
  </table>

</form>
 