<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<?include('setting.nav.php');?>

<form target="frm" id="site_setting_form" name="site_setting_form" method="post" action="do.php?cmd=site_profile">
	<table width="100%" border="0">  
			<tr>
              <td width="15%" align="right">���������ƣ�</td>
              <td><input type="text" name="company" class="span6" value="<?=$profile['company']?>" required/></td>
              <td>&nbsp;</td>
            </tr> 
			<tr>
              <td align="right">�������֤�ţ�</td>
              <td><input type="text" name="ota_code" class="span6" value="<?=$profile['ota_code']?>" required/></td>
              <td>&nbsp;</td>
            </tr> 
			<tr>
              <td align="right">�������У�</td>
              <td><input type="text" name="start_region" class="span6" value="<?=$profile['start_region']?>" required/></td>
              <td>&nbsp;</td>
            </tr>  
			<tr>
              <td align="right">�������б��룺</td>
              <td><input type="text" name="start_region_code" class="span6" value="<?=$profile['start_region_code']?>" required/></td>
              <td>&nbsp;</td>
            </tr>  
			<tr>
              <td align="right">�������ߣ�</td>
              <td><input type="text" name="hot_line" class="span6" value="<?=$profile['hot_line']?>" required/></td>
              <td>&nbsp;</td>
            </tr> 
			<tr>
              <td align="right">��ѯ�绰��</td>
              <td><input type="text" name="tel" class="span6" value="<?=$profile['tel']?>"/></td>
              <td>&nbsp;</td>
            </tr>
			<tr>
              <td align="right">���ͷ�QQ��</td>
              <td><input type="text" name="qq" class="span6" value="<?=$profile['qq']?>"/></td>
              <td>&nbsp;</td>
            </tr>
			<tr>
              <td align="right">�ͷ����䣺</td>
              <td><input type="text" name="email" class="span6" value="<?=$profile['email']?>"/></td>
              <td>&nbsp;</td>
            </tr>
			<tr>
              <td align="right">���̵绰��</td>
              <td><input type="text" name="union_tel" class="span6" value="<?=$profile['union_tel']?>"/></td>
              <td>&nbsp;</td>
            </tr>
			<tr>
              <td align="right">�������䣺</td>
              <td><input type="text" name="union_email" class="span6" value="<?=$profile['union_email']?>"/></td>
              <td>&nbsp;</td>
            </tr>
			<tr>
              <td align="right">ICP�����ţ�</td>
              <td><input type="text" name="icp_code" class="span6" value="<?=$profile['icp_code']?>"/></td>
              <td>&nbsp;</td>
            </tr>   
            <tr>
              <td>&nbsp;</td>
              <td><input type="submit" value="ȷ��" class="btn btn-danger" /></td>
              <td>&nbsp;</td>
            </tr> 
	</table>
</form>