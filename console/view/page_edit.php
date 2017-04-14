<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="static/image/style.css" rel="stylesheet" type="text/css" />
<!-- kindeditor start// -->
<script charset="utf-8" src="static/js/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="static/js/kindeditor/lang/zh_CN.js"></script>
<script charset="utf-8" src="static/js/kindeditor/plugins/code/prettify.js"></script>
<!-- kindeditor end// --> 

<link href="static/js/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
 
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

</head>
<body style="padding-top:20px">
<form action="do.php?cmd=page_update" method="post" id="page_update_form" name="page_update_form">

  <input type="hidden" name="page_id" value="<?=$detail['page_id']?>">

  <table width="100%">
    <tr>
      <td align="right" width="13%"><font color="red">*</font> 页面标题：</td>
      <td><input name="title" id="title" type="text" class="span6" size="60" value="<?=$detail['title']?>" required/></td>
    </tr>
	<tr>
      <td align="right"><font color="red">*</font> 页面关键词：</td>
      <td><input name="key" id="key" type="text" class="span6" size="60" value="<?=$detail['key']?>" required/></td>
    </tr> 
	<tr>
		  <td align="right">SEO/Title：</td>
		  <td><input type="text" name="page_title" class="span6" value="<?=$detail['page_title']?>" /></td> 
    </tr>  
    <tr>
		  <td align="right">SEO/Description：</td>
		  <td><textarea name="page_description" class="span6" rows="5" ><?=$detail['page_description']?></textarea></td> 
    </tr>  
    <tr>
		  <td align="right">SEO/Keywords：</td>
		  <td><input type="text" name="page_keywords" class="span6" value="<?=$detail['page_keywords']?>"/></td> 
    </tr>  
	<tr>
      <td align="right" ><font color="red">*</font> 排列序号：</td>
      <td><input name="order_id" id="order_id" type="number" class="span2" value="<?=$detail['order_id']?>" required/></td>
    </tr>
    <tr> 
      <td align="right"><font color="red">*</font> 内 容：</td>
	  <td>
		<textarea id="news_content" name="news_content" style="width:98%;height:350px;visibility:hidden;"><?=stripslashes($detail['content'])?></textarea>
	  </td>
    </tr>
    <tr> 
	  <td></td>
      <td>  
	  <br/>
      <input type="submit" value="确定" class="btn btn-danger" />
      </td>
    </tr>
  </table>

</form>
</body>
</html>