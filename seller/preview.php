<?  
include('config.php');

$ac = req('ac');

if($ac=='goods'){
	$sql = "select cat_key, goods_id from t_goods_thread where `goods_id`='".req('goods_id')."'";
	$goods = $db->get_one($sql); 
?>
<script type="text/javascript">
location.replace('/product/detail-<?=$goods['goods_id']?>.html');
</script>
<?
	exit;
}

if($ac=='goods'){
	$sql = "select cat_key, goods_id from t_goods_thread where `goods_id`='".req('goods_id')."'";
	$goods = $db->get_one($sql); 
?>
<script type="text/javascript">
location.replace('/product/detail-<?=$goods['goods_id']?>.html');
</script>
<?
	exit;
}

if($ac=='site'){
	$sql = "select site_domain, mobile_domain from t_site_config where `site_id`='".$g_siteid."'";
	$domains		= $db->get_one($sql); 

	$site_domain	= $domains['site_domain']; 
	$mobile_domain	= $domains['mobile_domain'];

	if(req('type') == 'mobile'){
?>
<script type="text/javascript">
location.replace('http://<?=$mobile_domain?>/');
</script>
<? 
	} else {
?>
<script type="text/javascript">
location.replace('http://<?=$site_domain?>/');
</script>
<? 
	} 
	exit;
}
?>