<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<?include('setting.nav.php');?>

	<form target="frm" id="site_domain_form" method="post" action="do.php?cmd=site_domain">
	      <table width="100%" border="0">
            <tr>
              <td width="10%" align="right"><font color="red">*</font> ��������</td>
              <td><input type="text" name="site_domain" id="site_domain" value="<?=$mysite['site_domain']?>" required/> PC�����������磺www.cloota.com</td> 
            </tr>  
			<tr>
              <td width="15%" align="right">�ֻ�����</td>
              <td><input type="text" name="mobile_domain" id="mobile_domain" value="<?=$mysite['mobile_domain']?>" /> �ƶ��豸���ʣ��磺m.cloota.com (ɨ���ұ߶�ά��Ԥ��)
			  
			  <div style="position:absolute;margin-left:700px;margin-top:-80px"><img src="/qr/?v=http://<?=$mysite['mobile_domain']?>"></div>
			  </td> 
            </tr> 
            <tr>
              <td>&nbsp;</td>
              <td style="padding-bottom:20px"><input type="submit" value="ȷ��" class="btn btn-danger" /></td> 
            </tr> 
			<tr> 
              <td colspan="2" style="padding:50px;"> 
			  <div id="" class="alert">
				<b style="font-size:14px">��Ҫ��ʾ��</b><br/>
				�����󶨺�����������������������壬����A��¼�����ķ�����IP��ַ����ذ��� @ www * 3����¼
				<br/>
			    ������Чһ���������48Сʱ����Чǰ��վ�㲻�ܷ��ʡ� 
			  </div> 
			  </td> 
            </tr> 
          </table> 
	</form>