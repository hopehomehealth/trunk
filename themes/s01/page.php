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
	<!-- ���м���� s-->
	<ul class="breadcrumbs">
		<li class="item"><a href="<?=$g_domain?>" target="_blank" title="">��ҳ</a><span>&gt</span></li>
		<li class="item current"><?=$page['title']?></li>
	</ul>
	<!-- ���м���� e/--> 
	<!-- ����� s-->
	<div class="wrap sidebar">
		<ul> 
			<?
			$page_list = page_list();
			if(notnull($page_list)){ 
				foreach ($page_list as $val){   
			?> 
			<li <?if($val['key']==$page['key']){?>class="active"<?}?>><a href="<?=$g_domain?>page/<?=$val['key']?>.html"><?=$val['title']?></a><span class="block"></span></li>
			<? 
				}
			}
			?> 
		</ul>
	</div>
	<!-- ����� e/-->
	<div class="wrap content">
		<h2><?=$page['title']?></h2>
		<ul class="inner">
			<li class="line">
				  <?=stripslashes($page['content'])?>
			</li>
		</ul>
	</div>
	<div class="clear"><!-- �������  --></div>
</div>
<div class="clear"></div>
<?include('foot.php');?>
</body>
</html>
