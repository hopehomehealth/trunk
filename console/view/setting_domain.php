<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<?include('setting.nav.php');?>

	<form target="frm" id="site_domain_form" method="post" action="do.php?cmd=site_domain">
	      <table width="100%" border="0">
            <tr>
              <td width="10%" align="right"><font color="red">*</font> 顶级域名</td>
              <td><input type="text" name="site_domain" id="site_domain" value="<?=$mysite['site_domain']?>" required/> PC端主域名，如：www.cloota.com</td> 
            </tr>  
			<tr>
              <td width="15%" align="right">手机域名</td>
              <td><input type="text" name="mobile_domain" id="mobile_domain" value="<?=$mysite['mobile_domain']?>" /> 移动设备访问，如：m.cloota.com (扫描右边二维码预览)
			  
			  <div style="position:absolute;margin-left:700px;margin-top:-80px"><img src="/qr/?v=http://<?=$mysite['mobile_domain']?>"></div>
			  </td> 
            </tr> 
            <tr>
              <td>&nbsp;</td>
              <td style="padding-bottom:20px"><input type="submit" value="确定" class="btn btn-danger" /></td> 
            </tr> 
			<tr> 
              <td colspan="2" style="padding:50px;"> 
			  <div id="" class="alert">
				<b style="font-size:14px">重要提示：</b><br/>
				域名绑定后，请立即到您的域名控制面板，解析A记录到您的服务器IP地址。务必包含 @ www * 3条记录
				<br/>
			    解析生效一般最长不超过48小时，生效前，站点不能访问。 
			  </div> 
			  </td> 
            </tr> 
          </table> 
	</form>