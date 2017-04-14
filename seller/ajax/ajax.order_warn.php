<?  
include(dirname(dirname(__FILE__)).'/auth.php');
include(dirname(dirname(__FILE__)).'/config.php'); 

$sql = "SELECT COUNT(*) FROM `t_user_order` WHERE `site_id`='$g_siteid' AND `is_read`='0'  AND `shop_id`='$g_shopid'";  
$cnt = $db->get_value($sql);  
?>

<?
if($cnt>0){
?>
<script type="text/javascript">
document.getElementById('order_warn_image').style.display = 'block';
</script>
<embed src="static/image/warn.mp3" loop="false"/> 
<?} else {?>
<script type="text/javascript">
document.getElementById('order_warn_image').style.display = 'none';
</script>
<?}?>