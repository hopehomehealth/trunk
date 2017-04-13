<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<ul class="nav nav-tabs" id="myTab">  
	<li <?if(nav_active('wx_setting.php')){?>class="active"<?}?> style="padding-left:20px;">
		<a href="?cmd=<?=base64_encode('wx_setting.php')?>">微信接入</a>
	</li>  
</ul>  

<form target="frm" method="post" action="do.php?cmd=site_setting_weixin"> 
	<table width="100%">
		    <thead>
            <tr> 
              <td width="130" style="text-align:right"> </td>
              <td ><label class="checkbox inline"><input type="checkbox" name="state" value="1" <?if($wx['state']=='1'){?>checked<?}?>>启用</label></td> 
            </tr> 
			</thead>
			<tr>
              <td style="text-align:right">AppID(应用ID)</td>
              <td><input type="text" name="appid" class="span4" value="<?=$wx['appid']?>"/></td> 
            </tr> 
			<tr>
              <td style="text-align:right">AppSecret(应用密钥)</td>
              <td><input type="password" name="appsecret" class="span4" value="<?=$wx['appsecret']?>"/></td> 
            </tr>  
            <tr>
              <td>&nbsp;</td>
              <td height="50"><input type="submit" value="确定" class="btn btn-danger" /></td> 
            </tr> 
	</table>
</form>