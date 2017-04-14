<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=gb2312"> 
<title><?=$page['title']?> - <?=$g_sitename?></title> 
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" type="text/css" href="/images/index.css">
</head>
<body>
<div class="home_h clearfix">
  <div class="m_logo"><a href="<?=$g_domain?>"><img src="/images/m_logo.png" height="30" width="97"></a></div>
  <div class="m_go"><a href="tel:<?=$g_profile['hot_line']?>">游客咨询：<?=$g_profile['hot_line']?></a><i></i></div>
</div>
<div class="container_fixed" id="page_1">
  <div class="home_banner plr10 clearfix"> 
		<h1>抱歉！页面无法访问……<br/><br/></h1>
		
		可能因为：<br/>
		网址有错误>请检查地址是否完整或存在多余字符<br/>
		网址已失效>可能页面已删除，活动已下线等<br/> 
  </div> 
</div> 
<script>function backtop(){ document.body.scrollTop = 0;}clearInterval(au);</script>
<div class="foot"> 
  <?include('foot.php');?>
</div>
</body>
</html>
 