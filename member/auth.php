<?
if($_COOKIE['CLOOTA_B2B2C_USER_UUID'] == ''){ 
?>
<script type="text/javascript">
window.top.location.replace('/member/login?ref=<?=urlencode($_SERVER['REQUEST_URI'])?>');
</script>
<?
	exit();
}	
?> 