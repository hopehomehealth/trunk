<?  
include('auth.php');

$sql = "select site_domain, mobile_domain from t_site_config where `site_id`='".$g_siteid."'";
$domains		= $db->get_one($sql); 

$site_domain	= $domains['site_domain'];
$mobile_domain	= $domains['mobile_domain'];

$cas = substr(md5('CLOOTA_B2B2C_DIY'.date('mdH')),0,20);
?>

<ul class="nav nav-tabs">   
	<li class="active" style="padding-left:20px;">
		<a href="#">ǰ̨ģ���Զ���༭</a>
	</li>   
</ul>  
<p>&nbsp;</p>

<a href="http://<?=$site_domain?>/?diy=yes&cas=<?=$cas?>" target="_blank" class="btn btn-large btn-info">���ӻ�DIYվ��(���Զ�)</a>
<p>&nbsp;</p>
<?if($mobile_domain!=''){?>
<a href="http://<?=$mobile_domain?>/?diy=yes&cas=<?=$cas?>" target="_blank" class="btn btn-large btn-success">���ӻ�DIYվ��(�ֻ���)</a>
<?}?>