<?  
include('config.php');

$ac = req('ac');

if($ac=='goods'){ 
?>
<script type="text/javascript">
location.replace('http://<?=$g_site_domain?>/product/detail-<?=req('goods_id')?>.html');
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
<div id="" class="">
	<img src="/qr/?v=http://<?=$mobile_domain?>/">
</div>
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