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
</head>

<body>  
<form id="seo_form" method="post" action="do.php?cmd=seo_update" style="margin:0px"> 
	<input type="hidden" name="primary_name" value="<?=$primary_name?>">
	<input type="hidden" name="primary_value" value="<?=$primary_value?>">
	<input type="hidden" name="table_name" value="<?=$table_name?>">
	<table width="100%" border="0" style="font-size:12px"> 
	  <tr>
		<td width="80" align="right"> </td>
		<td><h3>SEO参数配置</h3></td>
	  </tr>  
	  <tr>
		<td>&nbsp;</td>
		<td > 
			<div class="alert" style="margin-right:100px"> 
				<strong>提示：</strong> 请勿频繁修改SEO参数信息，否则影响搜索排名，如确实需要修改，建议间隔一个月。
			</div>
		</td> 
      </tr>
	  <tr>
		<td align="right"><strong><span style="color:red">*</span> 标题：</strong></td>
		<td >一般不超过80个字符，使用下划线分隔标题关键词<br/><input name="page_title" type="text" id="page_title" value="<?=$row['page_title']?>" class="span9" placeholder="如：休闲食品招商_休闲食品代理_休闲食品批发"/> </td>
	  </tr> 
	  <tr>
		<td align="right"><strong>关键词：</strong></td>
		<td >一般不超过100个字符，小写逗号分隔关键词，建议与标题关键词一致<br/><input name="page_keywords" type="text" id="page_keywords" value="<?=$row['page_keywords']?>" class="span9" placeholder="如：休闲食品招商,休闲食品代理,休闲食品批发"/> </td>
	  </tr> 
	  <tr>
		<td align="right"><strong>描述：</strong></td>
		<td>一般不超过200个字符，通俗易懂，建议包含关键词和长尾词、联系方式信息<br/><textarea name="page_description" class="span9" rows="3"><?=$row['page_description']?></textarea></td>
	  </tr>  
	  <tr>
		<td align="left">&nbsp;</td>
		<td><button type="submit" class="btn btn-danger "> 保存配置 </button></td>
	  </tr>  
	 
	</table>
</form> 
	 
</body>
</html>