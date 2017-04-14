<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="static/js/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<link href="static/image/style.css" rel="stylesheet" type="text/css" />
<!-- kindeditor start// -->
<script charset="utf-8" src="static/js/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="static/js/kindeditor/lang/zh_CN.js"></script>
<script charset="utf-8" src="static/js/kindeditor/plugins/code/prettify.js"></script>
<!-- kindeditor end// -->

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
						K('form[name=myform]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=myform]')[0].submit();
					});
				}
			});
			prettyPrint();
		});
</script>
</head>

<body style="padding-top:20px">
<form target="frm" action="do.php?cmd=help_update" method="post" name="myform" enctype="multipart/form-data">
  <input type="hidden" name="help_id" value="<?=$news['help_id']?>">
  <table cellpadding="3" cellspacing="0" width="100%">
    <tr>
      <td align="right"><font color="red">*</font> 标题：</td>
      <td><input name="title" type="text" class="span6" id="title" size="60" value="<?=$news['title']?>" required/></td>
    </tr>
    <tr>
      <td align="right"><font color="red">*</font> 所属类别：</td>
      <td>
	    <select name="cat_id" id="cat_id" required>
		  <option value=""></option>
          <?  
		  $help_cat1 = get_cat();
		  if(notnull($help_cat1)){
			  foreach ($help_cat1 as $val){    	
		  ?>
			  <option value="<?=$val['cat_id']?>" <?if($news['cat_id']==$val['cat_id']) echo 'selected';?>>
			  <?=$val['cat_name']?>
			  </option> 
          <?
			  }
		  }
		  ?>
        </select>
      </td>
    </tr>
	 
	<tr>
      <td align="right">摘要：</td>
      <td><textarea name="summary" cols="70" rows="3" id="summary" class="span6" ><?=$news['summary']?></textarea>
      </td>
    </tr>
    <tr> 
	  <td align="right"><font color="red">*</font> 内容：</td>
      <td > 
		<textarea id="help_content" name="help_content" style="width:98%;height:350px;visibility:hidden;"><?=stripslashes($news['content'])?></textarea>
	  </td>
    </tr>
	<tr>
      <td align="right" width="80"><font color="red">*</font> <b>序号：</b></td>
      <td><input name="order_id" type="number" id="order_id" class="span2" required <?=$news['order_id']?>/></td>
    </tr>
    <tr> 
	  <td></td>
      <td>  
      <button type="submit" class="btn btn-danger "/>确定</button>
      </td>
    </tr>
  </table>

</form>
</body>
</html>