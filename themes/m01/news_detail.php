<?  
$page_key = req('key');

$sql = "SELECT * FROM `t_page` WHERE `site_id`='$g_siteid' AND `key`='$page_key' LIMIT 0,1 ";  
$page = $db->get_one($sql); 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="gbk" />
<title><?=$c_article['title']?>_<?=$c_cat['cat_name']?>_<?=$g_sitename?></title> 
<meta name="description" content="<?=$c_article['title']?> <?=$c_summary?> <?=$g_sitename?> " />  

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" type="text/css" href="/images/common_<?=$g_mobile_style?>.css" />
<link rel="stylesheet" type="text/css" href="http://apps.bdimg.com/libs/fontawesome/4.4.0/css/font-awesome.min.css" />
</head>
<body>
<header class="header"><a class="fl" href="<?=$g_domain?>"><i class="b_1"></i><i class="b_2"></i></a><a href="/news/gonglue/">旅游攻略</a><a href="/" class="tool" style="font-size:24px"><span class="fa fa-home "></span></a></header>

<div class="container_fixed" id="page_1">
  <div class="home_banner plr10 clearfix"> 
		<?if($c_article['image']!=''){?>
        <div style="padding:20px;text-align:center;"><img alt="<?=$c_article['title']?>" width="100%"  src="/upfiles/<?=$g_siteid?>/<?=$c_article['image']?>" /> 
        </div>
        <?}?>

		<h1 style="text-align:center;font-size:18px;padding-top:10px;"><?=$c_article['title']?></h1>

		<p style="text-align:center"><a href="/news/gonglue/">旅游攻略</a>
		发布日期：<?=date('Y-m-d', strtotime($c_article['addtime']))?> &nbsp; &nbsp; 阅读：<?=$c_article['clicks']?>次</p>
		
        <div style="margin-top:20px;line-height:2.0;font-size:14px;"> 
		<?
		$htm = stripslashes($c_article['content']);
		$htm = str_replace('font-family', '~font-family', $htm);
		$htm = str_replace('font-size', '~font-family', $htm);
		echo $htm;
		?>
		</div>  
  </div> 
</div> 
<script>function backtop(){ document.body.scrollTop = 0;}clearInterval(au);</script>
 
</body>
</html>