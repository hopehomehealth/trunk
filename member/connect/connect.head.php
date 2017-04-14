<?   
$sql = "SELECT * FROM `t_site_connect` WHERE `site_id`='".$g_siteid."' ";  
$myopen = $db->get_one($sql); 

if($myopen['connect_id']!=''){
?>
    <?if($myopen['qq_auth']!='' || $myopen['qq_appid']!=''){?> 
		<?=htmlspecialchars_decode($myopen['qq_auth'])?>

		<script type="text/javascript" src="http://qzonestyle.gtimg.cn/qzone/openapi/qc_loader.js" data-appid="<?=$myopen['qq_appid']?>" data-redirecturi="<?=$g_domain?>connect/qq/callback.php" charset="utf-8"></script> 
	<?}?>
	<?if($myopen['sina_auth']!='' || $myopen['sina_appid']!=''){?> 
		<?=htmlspecialchars_decode($myopen['sina_auth'])?>

		<script src=" http://tjs.sjs.sinajs.cn/open/api/js/wb.js?appkey=<?=$myopen['sina_appid']?>" type="text/javascript" charset="utf-8"></script>  
	<?}?>
	<?if($myopen['taobao_auth']!='' || $myopen['taobao_appid']!=''){?>
		<?=htmlspecialchars_decode($myopen['taobao_auth'])?>

		<script src="http://l.tbcdn.cn/apps/top/x/sdk.js?appkey=<?=$myopen['taobao_appid']?>"></script> 
	<?}?>
<?}?>