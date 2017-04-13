<!DOCTYPE html>
<html>
<head>
<?include('meta.php');?>

<?seo()?>

<?include('static.php');?>
<link rel="stylesheet" type="text/css" href="/images/page.css">
</head>
<body class="bodybox">
<?include('head.php');?> 
<div class="container other">  
	<ul class="breadcrumbs">
		<li class="item"><a href="<?=$g_domain?>" target="_blank" title="">首页</a><span>&gt</span></li>
		<li class="item current">帮助中心</li>
	</ul> 
	<div class="wrap sidebar" id="mutualSidebar">
		<ul> 
			<?
			$help_cat_list = help_cat_list(10); 
			if(notnull($help_cat_list)){
				foreach ($help_cat_list as $pval){   
			?>
			<li class="active"><a href="#none"><?=$pval['cat_name']?></a><span class="block"></span>
				<dl class="sub-aside" style="display: block;">
				<?
				$help_list = help_list($pval['cat_id'], 10);
				if(notnull($help_list)){
					foreach ($help_list as $val){   
				?>
				<dd><a href="<?=$g_domain?>help/<?=$val['help_id']?>.html"><?=$val['title']?></a></dd>
				<?
					}
				}
				?> 
				</dl>
			</li>
			<?
				}
			}
			?> 
		</ul>
	</div>
  
	<div class="wrap content">
		<?
		if($c_help['help_id']==''){
		?>
			<h2 class="news-title">帮助中心</h2> 
			<?
			$help_hot_list = help_list(-1, 20, 1); 
			if(notnull($help_hot_list)){
				foreach ($help_hot_list as $val){   
					$summary = show_substr(removehtml($val['content']),300);
			?>
			<li>  
				<p><a href="<?=$g_domain?>help/<?=$val['help_id']?>.html" style="font-size:18px"><?=$val['title']?></a></p> 
				<p><?=$summary?></p>
				<p>&nbsp;</p>
			</li>
			<?
				}
			}
			?> 
		<?}else{?>
			<h2 class="news-title"><?=$c_help['title']?></h2> 
			<div class="inner news-cont"> 
				<?
				$htm = stripslashes($c_help['content']);
				$htm = str_replace('font-family','~font-family',$htm);
				echo $htm;
				?> 
			</div>
		<?}?>
	</div>
	<div class="clear"></div>
</div>
<div class="clear"></div>
<?include('foot.php');?>
</body>
</html>