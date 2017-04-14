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
						K('form[name=form_news_add]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=form_news_add]')[0].submit();
					});
				}
			});
			prettyPrint();
		});
</script>
 
<ul class="nav nav-tabs" id="myTab"> 
    <li class="active" style="padding-left:20px"><a href="#tabs-1">发布文章</a></li>
	<a href="javascript:void(0)" onclick="history.back()" class="pull-right btn btn-small">返回</a>
</ul>
 

		<form target="frm" action="do.php?cmd=news_add" method="post" id="form_news_add" name="form_news_add" enctype="multipart/form-data">

		  <input type="hidden" name="goods_cat_id" value="<?=req('goods_cat_id')?>">

		  <table cellpadding="3" cellspacing="0" width="100%">
			<tr>
			  <td align="right" width="80"><font color="red">*</font> <b>文章标题：</b></td>
			  <td><input name="title" type="text" class="span6" id="title" required/></td>
			</tr>
			<tr>
			  <td align="right"><strong>文章图片：</strong></td>
			  <td><input name="image" type="file" id="image" class="input_file"/></td>
			</tr>
			<tr>
			  <td align="right"><strong>摘 要：</strong></td>
			  <td><textarea name="summary" cols="70" rows="3" id="summary" class="span6"></textarea>
			  </td>
			</tr>
			<tr>
			  <td align="right"><font color="red">*</font> <b>所属类别：</b></td>
			  <td>
			  <select name="cat_id" id="cat_id" class="span6" required>
				  <option value=""></option>
				  <?  
				  if(notnull($parent_news_cat)){
					  foreach ($parent_news_cat as $val){   
				  ?>
				  <option value="<?=$val['cat_id']?>" <?if(req('cat_id')==$val['cat_id']){echo 'selected';}?> >
				  <?=$val['cat_name']?>
				  </option>
				  <?
					  $sql = "SELECT * FROM t_article_catalog WHERE parent_id='".$val['cat_id']."' AND site_id='$g_siteid' ORDER BY order_id ASC ";  
					  $child_news_cat = $db->get_all($sql); 
					  if(notnull($child_news_cat)){
						  foreach ($child_news_cat as $cval){ 
				  ?>
				  <option value="<?=$cval['cat_id']?>" <?if(req('cat_id')==$cval['cat_id']){echo 'selected';}?>>
				  &nbsp; &gt; <?=$cval['cat_name']?>
				  </option>	
				  <?
							  }
						  }
					  }
				  }
				  ?>
				</select>
			  </td>
			</tr>
			<tr>
			  <td align="right"><font color="red">*</font> <b>文章内容：</b></td>
			  <td ><textarea id="news_content" name="news_content" style="width:100%;height:500px;visibility:hidden;" ></textarea></td>
			</tr>
			<tr>
			  <td></td>
			  <td>
			  <input type="submit" value="确定" class="btn btn-danger" />
			  &nbsp;
			  <input type="button" value="取消" class="btn " onclick="history.back()"/>
			  </td>
			</tr>
		  </table>
		</form>
 