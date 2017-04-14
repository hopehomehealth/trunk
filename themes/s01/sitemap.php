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
		<li class="item"><a href="<?=$g_domain?>" target="_blank" title="">��ҳ</a><span>&gt</span></li>
		<li class="item current"><a href="<?=$g_domain?>sitemap.html">��վ��ͼ</a></li>
	</ul>
	<style type="text/css">
		.sitemap{ 
			line-height:2.5;
		}
		.sitemap li{
			float:left;
			width:12%;
		}
		.sitemap li a{
			font-size:14px; 
			color:#000;
		}
	</style> 
	<div class="wrap  "> 
		<div style="padding:40px">
			<div style="float:left;width:10%;">&nbsp;</div>
			<div style="float:left;width:90%;">
				<ul class="sitemap">
					<li><a href="<?=$g_domain?>product/" target="_blank"><h2>��Ʒ����</h2></a></li>
					<li><a href="<?=$g_domain?>news/" target="_blank"><h2>��Ѷ����</h2></a></li>
					<li><a href="<?=$g_domain?>help/" target="_blank"><h2>��������</h2></a></li>
					<div style="clear:both"></div>
				<ul>
			</div>
			<div style="clear:both"><br/></div>
 
			<div style="float:left;width:10%;line-height:2.5;">������</div>
			<div style="float:left;width:90%;">
				<ul class="sitemap">
					<li><a href="<?=$g_domain?>zhoubian/" target="_blank">�ܱ���</a></li>
					<li><a href="<?=$g_domain?>guonei/" target="_blank">������</a></li>
					<li><a href="<?=$g_domain?>chujing/" target="_blank">������</a></li>
					<div style="clear:both"></div>
				<ul>
			</div>
			<div style="clear:both"></div>
 
			<div style="float:left;width:10%;line-height:2.5;">������</div>
			<div style="float:left;width:90%;">
				<ul class="sitemap">
					<li><a href="<?=$g_domain?>gentuan/" target="_blank">������</a></li>
					<li><a href="<?=$g_domain?>ziyouxing/" target="_blank">������</a></li>
					<li><a href="<?=$g_domain?>qianzheng/" target="_blank">ǩ֤</a></li>
					<li><a href="<?=$g_domain?>youlun/" target="_blank">����</a></li>
					<div style="clear:both"></div>
				<ul>
			</div>
			<div style="clear:both"></div>

			<div style="float:left;width:10%;line-height:2.5;">��ģʽ</div>
			<div style="float:left;width:90%;">
				<ul class="sitemap">
					<li><a href="<?=$g_domain?>groupbuy/" target="_blank">�Ź�</a></li>
					<li><a href="<?=$g_domain?>hot/" target="_blank">����</a></li>
					<div style="clear:both"></div>
				<ul>
			</div> 
			<div style="clear:both;"><br/><hr size="1" color="#efefef"><br/></div>

			<div style="float:left;width:10%;line-height:2.5;">����</div>
			<div style="float:left;width:90%;">
				<ul class="sitemap">
				<?   
				if(notnull($catalog)){
					foreach ($catalog as $val){  
				?>
				<li><a href="<?=$g_domain?><?=$val["cat_key"]?>/" target="_blank"><b><?=strtoupper(substr($val["cat_key"],0,1))?></b> <?=$val["cat_name"]?></a></li> 
				<? 
					}
				}
				?>
				<div style="clear:both"></div>
				<ul>
			</div>
			<div style="clear:both"><br/><hr size="1" color="#efefef"><br/></div>
 
			<div style="float:left;width:10%;line-height:2.5;">����</div>
			<div style="float:left;width:90%;">
				<ul class="sitemap">
					<?   
					if(notnull($aboutus)){
						foreach ($aboutus as $val){  
					?>
					<li><a href="<?=$g_domain?>page/<?=$val["key"]?>.html" target="_blank"><?=$val["title"]?></a></li> 
					<? 
						}
					}
					?>
					<li><a href="<?=$g_domain?>gentuanyou/" target="_blank">������</a></li>
					<li><a href="<?=$g_domain?>ziyouxing/" target="_blank">������</a></li>
					<li><a href="<?=$g_domain?>zijiayou/" target="_blank">�Լ���</a></li>
					<li><a href="<?=$g_domain?>gongsiyou/" target="_blank">��˾��</a></li>
					<div style="clear:both"></div>
				<ul>
			</div>  
			<div style="clear:both"></div>
		</div>
	</div> 
	<div class="clear"></div>
</div>
<div class="clear"></div>
<?include('foot.php');?>
</body>
</html>
