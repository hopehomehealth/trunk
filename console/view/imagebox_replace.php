<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 

$f = req('f');
$type = req('type');
$tpl = req('tpl');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="static/image/style.css" rel="stylesheet" type="text/css"/>  
<link href="static/js/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 

</head>
<body>
<script type="text/javascript">
function load_src_image(w, h){
	document.getElementById('iw').innerHTML = w;
	document.getElementById('ih').innerHTML = h;
}
</script>
<form target="frm" action="do.php?cmd=image_replace" method="post" name="myform" enctype="multipart/form-data" style="margin:20px;">
	<input type="hidden" name="f" value="<?=$f?>"> 
	<input type="hidden" name="type" value="<?=$type?>">
	<input type="hidden" name="tpl" value="<?=$tpl?>">
	<table align="center" class="table">
		<thead>
		<tr> 
			<td></td> 
			<td><h3>图片替换</h3></td>
		</tr>
		</thead>
		<tr> 
			<td style="width:120px" align="right">原始图片：</td> 
			<td>
			<?=$f?><br/>
			<img src="<?=req('src')?>" onload="load_src_image(this.width, this.height)"/><br/>
			宽度<span id="iw"></span>像素 / 高度<span id="ih"></span>像素
			</td>
		</tr>
		<tr> 
			<td align="right">替换图片：</td> 
			<td><input name="myimage" type="file" id="myimage" size="50" class="input_file"/></td>
		</tr>
		<tr> 
			<td></td> 
			<td><input type="submit" value="替换" class="btn btn-danger" /></td>
		</tr>

		<tr> 
			<td></td> 
			<td><div class="alert">提示：替换图片的格式、大小必须保持一致，目前系统支持3种图片格式：GIF/JPG/PNG</div></td>
		</tr>
	</table> 

	
</form>
</body>
</html>