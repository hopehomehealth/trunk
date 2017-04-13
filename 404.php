<?
@header("http/1.1 404 not found");  
@header("status: 404 not found");
?>
<!doctype html>
<html>
<head>
<meta charset="gb2312"> 
<title>404 NOT FOUND</title>
</head>
<body>
<div style="margin-top:100px;text-align:center;">
<h3><?=$_SERVER['REQUEST_URI']?></h3>
<a href="/"><img src="/static/image/404.png" border="0"></a>
</div> 

<script type="text/javascript">
function index(){
	window.top.location.replace('/');
}
setTimeout('index()', 5000);
</script>
</body>
</html>