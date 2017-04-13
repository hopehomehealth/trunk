<?
header('Content-Type: text/xml');
echo '<?xml version="1.0" encoding="utf-8"?>';

include("config.php"); 

$sql = "SELECT * FROM `t_page` WHERE `site_id`='$g_siteid' ";  
$aboutus = $db->get_all($sql); 
  
$sql = "SELECT * FROM `t_goods_catalog` WHERE `site_id`='$g_siteid' ";  
$catalog = $db->get_all($sql);  

$sql = "SELECT *, DATE_FORMAT(`addtime`,'%Y-%m-%d') AS ymd FROM `t_goods_thread` WHERE `site_id`='$g_siteid' AND `is_sale`=1 ORDER BY `goods_id` DESC";  
$product = $db->get_all($sql);

$sql = "SELECT *, DATE_FORMAT(`addtime`,'%Y-%m-%d') AS ymd FROM `t_article_thread` WHERE `site_id`='$g_siteid' ORDER BY `thread_id` DESC";  
$news = $db->get_all($sql);


$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
if (strpos($ua, 'googlebot') !== false){ 
	$xmlns = 'xmlns="http://www.google.com/schemas/sitemap/0.84"';
} else {
	$xmlns = '';
}
?> 
<urlset <?=$xmlns?>> 
	<url>
		<loc><?=$g_domain?></loc>
		<priority>0.5</priority>
		<lastmod><?=date('Y-m-d')?></lastmod>
		<changefreq>daily</changefreq>
	</url>  
<?   
if(notnull($aboutus)){
	foreach ($aboutus as $val){  
?>
	<url>
       <loc><?=$g_domain?>page/<?=$val["key"]?>.html</loc>
       <priority>0.5</priority>
	   <lastmod><?=date('Y-m-d')?></lastmod>
	   <changefreq>weekly</changefreq>
     </url>
<? 
	}
}
?>

<?   
if(notnull($catalog)){
	foreach ($catalog as $val){  
?>
	<url>
       <loc><?=$g_domain?><?=$val["cat_key"]?>/</loc>
       <priority>0.5</priority>
	   <lastmod><?=date('Y-m-d')?></lastmod>
	   <changefreq>weekly</changefreq>
     </url>
<? 
	}
}
?>

<?   
if(notnull($product)){
	foreach ($product as $val){  
?>
	<url>
       <loc><?=$g_domain?>product/detail-<?=$val["goods_id"]?>.html</loc>
       <priority>0.5</priority>
	   <lastmod><?=$val["ymd"]?></lastmod>
	   <changefreq>weekly</changefreq>
     </url>
<? 
	}
}
?>

<?   
if(notnull($news)){
	foreach ($news as $val){   
		$news_url = get_news_url($val['thread_id']);
?>
	<url>
       <loc><?=$news_url?></loc>
       <priority>0.5</priority>
	   <lastmod><?=$val["ymd"]?></lastmod>
	   <changefreq>weekly</changefreq>
     </url>
<? 
	}
}
?>
</urlset>