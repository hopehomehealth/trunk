<!DOCTYPE HTML>
<html>
<head>
<meta charset="GBK" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta http-equiv="content-type" content="text/html; charset=GBK" />
<title><?=$page['title']?>_<?=$g_shopname?>_<?=$g_sitename?></title>
<link rel="canonical" href="<?=$g_full_url?>"/> 
<link rel="stylesheet" href="<?=$g_tpl_path?>images/style.css" />
<link rel="stylesheet" href="<?=$g_tpl_path?>images/list.css" />
<link rel="stylesheet" href="<?=$g_tpl_path?>images/head.css">
</head>
<body>
<?include('head.php');?>

<div class="wrap"> 
	<div class="b_crumbs">
		<div class="e_crumbs_ct"> 
			<a href="<?=$g_shop_url?>">首页</a> 

			<span class="jt">></span> 
			<a href="<?=$g_shop_url?><?=$page['key']?>.html">
			<h1><?=$page['title']?></h1>
			</a>  		
		</div>
	</div> 
	
	<div class="box clrfix">
		<div class="main_l210_r750">
			<?include('nav.php');?>
			
			<!--leftbar-->
			<div class="main_r750">
				<div style="background-color:white;padding:20px;font-size:14px;overflow:hidden;">
				<p><h1 style="font-size:28px"><?=$page['title']?><hr size="1"></h1></p>
				<?
				$content = stripslashes($page['content']);
				$content = str_replace('font-family', '~font-family', $content); 
				$content = str_replace('font-size', '~font-size', $content); 
				$content = str_replace('<img', '<img onload="if(this.width>200){this.width=\'710\'}"', $content); 
				echo $content;
				?> 
				</div>
			</div> 
		</div>
	</div>

	<?include('foot.php');?>
</div>

</body>
</html>
