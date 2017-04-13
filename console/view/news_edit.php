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
<form action="do.php?cmd=news_update" method="post" name="myform"  enctype="multipart/form-data">
  <input type="hidden" name="thread_id" value="<?=$news['thread_id']?>">
  <table width="100%">
    <tr>
      <td align="right" width="10%"><font color="red">*</font> <strong>文章标题：</strong></td>
      <td><input name="title" type="text" id="title" class="span6" value="<?=$news['title']?>" required/></td>
    </tr>
    <tr>
      <td align="right"><font color="red">*</font> <strong>所属类别：</strong></td>
      <td><select name="cat_id" id="cat_id" class="span6" required >
          <?  
			foreach ($news_cat as $val){    	
		  ?>
          <option value="<?=$val['cat_id']?>" <?if($news['cat_id']==$val['cat_id']) echo 'selected';?>>
          <?if($val['parent_id']!='0'){echo '&nbsp;&nbsp;';}?><?=$val['cat_name']?>
          </option>
          <?
			}
		  ?>
        </select>
      </td>
    </tr>
	<tr>
      <td align="right"><strong>文章图片：</strong></td>
      <td>
	    <?
		if($news['image']!=""){
				  $news_image = "/upfiles/$g_siteid/".$news['image'];
		?>
		<img src="<?=$news_image?>" width="40" height="40" class="thumbnail"/><br/>
		<?
		}
		?>
	  <input name="image" type="file" id="image" class="input_file"/></td>
    </tr>
	<tr>
      <td align="right"><strong>摘 要：</strong></td>
      <td><textarea name="summary" rows="3" id="summary" class="span6"><?=$news['summary']?></textarea>
      </td>
    </tr>
    <tr> 
      <td align="right"><strong>文章内容：</strong></td>
      <td>
	  <textarea id="news_content" name="news_content" style="width:98%;height:350px;visibility:hidden;" ><?=stripslashes($news['content'])?>
	  </textarea>
	  </td>
    </tr>
    <tr> 
      <td align="right"></td>
      <td>
        <input type="submit" value="确定" class="btn btn-danger " /> 
      </td>
    </tr>
  </table>

</form>
</body>
</html>