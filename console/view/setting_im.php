<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<?include('setting.nav.php');?>

	<form target="frm" id="site_setting_im_form" name="site_setting_im_form" method="post" action="do.php?cmd=site_setting_im"> 
		  <input type="hidden" name="ref_url" value="<?=base64_encode('setting_im.php')?>">
	      <table width="100%">  
			<tr>
              <td width="15%" align="right"><font color="red">*</font>  QQ�ͷ���</td>
              <td><textarea name="qq_list" cols="60" rows="5" class="span6"><?=stripslashes($mysite['qq_list'])?></textarea></td>
              <td>����QQ��#���ƣ�ÿ��һ����������ʾ��<br/>8000111#�ͷ�һ<br/>8000222#�ͷ���</td>
            </tr>
			<tr>
              <td align="right">�����ͷ���</td>
              <td><textarea name="wangwang_list" cols="60" rows="5" class="span6"><?=stripslashes($mysite['wangwang_list'])?></textarea></td>
              <td>����������#���ƣ�ÿ��һ����������ʾ��<br/>yourname1#�ͷ�һ<br/>yourname2#�ͷ���</td>
            </tr> 
			<tr>
              <td align="right"><font color="red">*</font> �ͷ����䣺</td>
              <td><textarea name="alert_email" cols="60" rows="5"  class="span6" required><?=stripslashes($mysite['alert_email'])?></textarea></td>
              <td>��������ʼ���ַ��ÿ��һ��</td>
            </tr>
          
            <tr>
              <td>&nbsp;</td>
              <td><button type="submit" class="btn btn-danger">ȷ��</button></td>
              <td>&nbsp;</td>
            </tr> 
          </table>
	</form>