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
		<td><h3>SEO��������</h3></td>
	  </tr>  
	  <tr>
		<td>&nbsp;</td>
		<td > 
			<div class="alert" style="margin-right:100px"> 
				<strong>��ʾ��</strong> ����Ƶ���޸�SEO������Ϣ������Ӱ��������������ȷʵ��Ҫ�޸ģ�������һ���¡�
			</div>
		</td> 
      </tr>
	  <tr>
		<td align="right"><strong><span style="color:red">*</span> ���⣺</strong></td>
		<td >һ�㲻����80���ַ���ʹ���»��߷ָ�����ؼ���<br/><input name="page_title" type="text" id="page_title" value="<?=$row['page_title']?>" class="span9" placeholder="�磺����ʳƷ����_����ʳƷ����_����ʳƷ����"/> </td>
	  </tr> 
	  <tr>
		<td align="right"><strong>�ؼ��ʣ�</strong></td>
		<td >һ�㲻����100���ַ���Сд���ŷָ��ؼ��ʣ����������ؼ���һ��<br/><input name="page_keywords" type="text" id="page_keywords" value="<?=$row['page_keywords']?>" class="span9" placeholder="�磺����ʳƷ����,����ʳƷ����,����ʳƷ����"/> </td>
	  </tr> 
	  <tr>
		<td align="right"><strong>������</strong></td>
		<td>һ�㲻����200���ַ���ͨ���׶�����������ؼ��ʺͳ�β�ʡ���ϵ��ʽ��Ϣ<br/><textarea name="page_description" class="span9" rows="3"><?=$row['page_description']?></textarea></td>
	  </tr>  
	  <tr>
		<td align="left">&nbsp;</td>
		<td><button type="submit" class="btn btn-danger "> �������� </button></td>
	  </tr>  
	 
	</table>
</form> 
	 
</body>
</html>