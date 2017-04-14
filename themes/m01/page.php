<?  
$page_key = req('key');

$sql = "SELECT * FROM `t_page` WHERE `site_id`='$g_siteid' AND `key`='$page_key' LIMIT 0,1 ";  
$page = $db->get_one($sql); 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="gbk" />
<title><?=$page['title']?> - <?=$g_sitename?></title> 

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" type="text/css" href="/images/common_<?=$g_mobile_style?>.css" />
<link rel="stylesheet" type="text/css" href="http://apps.bdimg.com/libs/fontawesome/4.4.0/css/font-awesome.min.css" />
</head>
<body>
<header class="header"><a class="fl" href="<?=$g_domain?>"><i class="b_1"></i><i class="b_2"></i></a><a href="javascript:;"><?=$g_sitename?></a><a href="/" class="tool" style="font-size:24px"><span class="fa fa-home "></span></a></header>

<div class="container_fixed" id="page_1">
  <div class="home_banner plr10 clearfix"> 
        <div> 
		<?=stripslashes($page['content'])?>
		</div>  
  </div> 
</div> 
<script>function backtop(){ document.body.scrollTop = 0;}clearInterval(au);</script>
<div class="foot"> 
  <?include('foot.php');?>
</div>
</body>
</html>