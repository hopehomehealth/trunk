<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

 

	<form target="frm" id="site_connect_form" name="site_connect_form" method="post" action="do.php?cmd=site_connect">
	      <table width="100%" border="0">
		    <tr>
		      <td width="10%" rowspan="3" >�� ��</td>
              <td width="20%" >  APP ID</td>
              <td ><input type="text" name="taobao_appid" id="taobao_appid" value="<?=$myconnect['taobao_appid']?>" /> <a href="http://open.taobao.com/index.htm" target="_blank">����</a></td>
              <td>&nbsp;</td>
            </tr> 
			<tr>
			  <td >APP KEY</td>
              <td><input type="text" name="taobao_appkey" id="taobao_appkey"  size="60" value="<?=$myconnect['taobao_appkey']?>"/> �ɲ���</td>
              <td>&nbsp;</td>
            </tr>  
			<tr>
			  <td >��֤��ǩ xAuth�ļ�����</td>
              <td><input type="text" name="taobao_auth" id="taobao_auth"  size="60" value="<?=stripslashes($myconnect['taobao_auth'])?>"/> �ɲ���</td>
              <td>&nbsp;</td>
            </tr> 
            <tr>
              <td width="7%" rowspan="4" >��ѶQQ</td>
              <td >&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td width="18%" >  APP ID</td>
              <td><input type="text" name="qq_appid" id="qq_appid" value="<?=$myconnect['qq_appid']?>" /> <a href="http://connect.qq.com/intro/login" target="_blank">����</a></td>
              <td>&nbsp;</td>
            </tr> 
			<tr>
			  <td > APP KEY</td>
              <td><input type="text" name="qq_appkey" id="qq_appkey" size="60" value="<?=$myconnect['qq_appkey']?>"/> ѡ��</td>
              <td>&nbsp;</td>
            </tr>  
			<tr>
			  <td > ��֤��ǩ</td>
              <td><input type="text" name="qq_auth" id="qq_auth" size="60" value="<?=stripslashes($myconnect['qq_auth'])?>"/> ����</td>
              <td>&nbsp;</td>
            </tr> 
			<tr>
			  <td width="7%" rowspan="4" >����΢��</td>
			  <td >&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
		    </tr>
			<tr>
			  <td width="18%" >  APP ID</td>
              <td><input type="text" name="sina_appid" id="sina_appid" value="<?=$myconnect['sina_appid']?>" /> <a href="http://open.weibo.com/connect" target="_blank">����</a></td>
              <td>&nbsp;</td>
            </tr> 
			<tr>
			  <td > APP KEY</td>
              <td><input type="text" name="sina_appkey" id="sina_appkey"  size="60" value="<?=$myconnect['sina_appkey']?>"/> ѡ��</td>
              <td>&nbsp;</td>
            </tr>   
			<tr>
			  <td >��֤��ǩ</td>
              <td><input type="text" name="sina_auth" id="sina_auth" size="60" value="<?=stripslashes($myconnect['sina_auth'])?>"/> ����</td>
              <td>&nbsp;</td>
            </tr>  
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><input type="submit" value="ȷ��" class="btn btn-danger" /></td>
              <td>&nbsp;</td>
            </tr> 
          </table>
	</form>

	