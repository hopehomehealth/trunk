<?
if($_GET['style']!=''){
	setcookie('USER_SITE_STYLE', $_GET['style']);
}
if($_GET['clear']=='true'){
	setcookie('USER_SITE_STYLE', false, -1);
}
?>
<script type="text/javascript">
window.top.location.replace('/');
</script>