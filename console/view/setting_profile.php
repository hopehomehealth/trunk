<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<?include('setting.nav.php');?>

<form target="frm" id="site_setting_form" name="site_setting_form" method="post" action="do.php?cmd=site_profile">
	<table width="100%" border="0">  
			<tr>
              <td width="15%" align="right">旅行社名称：</td>
              <td><input type="text" name="company" class="span6" value="<?=$profile['company']?>" required/></td>
              <td>&nbsp;</td>
            </tr> 
			<tr>
              <td align="right">旅游许可证号：</td>
              <td><input type="text" name="ota_code" class="span6" value="<?=$profile['ota_code']?>" required/></td>
              <td>&nbsp;</td>
            </tr> 
			<tr>
              <td align="right">出发城市：</td>
              <td><input type="text" name="start_region" class="span6" value="<?=$profile['start_region']?>" required/></td>
              <td>&nbsp;</td>
            </tr>  
			<tr>
              <td align="right">出发城市编码：</td>
              <td><input type="text" name="start_region_code" class="span6" value="<?=$profile['start_region_code']?>" required/></td>
              <td>&nbsp;</td>
            </tr>  
			<tr>
              <td align="right">服务热线：</td>
              <td><input type="text" name="hot_line" class="span6" value="<?=$profile['hot_line']?>" required/></td>
              <td>&nbsp;</td>
            </tr> 
			<tr>
              <td align="right">咨询电话：</td>
              <td><input type="text" name="tel" class="span6" value="<?=$profile['tel']?>"/></td>
              <td>&nbsp;</td>
            </tr>
			<tr>
              <td align="right">主客服QQ：</td>
              <td><input type="text" name="qq" class="span6" value="<?=$profile['qq']?>"/></td>
              <td>&nbsp;</td>
            </tr>
			<tr>
              <td align="right">客服邮箱：</td>
              <td><input type="text" name="email" class="span6" value="<?=$profile['email']?>"/></td>
              <td>&nbsp;</td>
            </tr>
			<tr>
              <td align="right">招商电话：</td>
              <td><input type="text" name="union_tel" class="span6" value="<?=$profile['union_tel']?>"/></td>
              <td>&nbsp;</td>
            </tr>
			<tr>
              <td align="right">招商邮箱：</td>
              <td><input type="text" name="union_email" class="span6" value="<?=$profile['union_email']?>"/></td>
              <td>&nbsp;</td>
            </tr>
			<tr>
              <td align="right">ICP备案号：</td>
              <td><input type="text" name="icp_code" class="span6" value="<?=$profile['icp_code']?>"/></td>
              <td>&nbsp;</td>
            </tr>   
            <tr>
              <td>&nbsp;</td>
              <td><input type="submit" value="确定" class="btn btn-danger" /></td>
              <td>&nbsp;</td>
            </tr> 
	</table>
</form>