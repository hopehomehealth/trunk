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
              <td width="15%" align="right"><font color="red">*</font>  QQ客服：</td>
              <td><textarea name="qq_list" cols="60" rows="5" class="span6"><?=stripslashes($mysite['qq_list'])?></textarea></td>
              <td>输入QQ号#名称，每行一个，如下所示；<br/>8000111#客服一<br/>8000222#客服二</td>
            </tr>
			<tr>
              <td align="right">旺旺客服：</td>
              <td><textarea name="wangwang_list" cols="60" rows="5" class="span6"><?=stripslashes($mysite['wangwang_list'])?></textarea></td>
              <td>输入旺旺号#名称，每行一个，如下所示；<br/>yourname1#客服一<br/>yourname2#客服二</td>
            </tr> 
			<tr>
              <td align="right"><font color="red">*</font> 客服邮箱：</td>
              <td><textarea name="alert_email" cols="60" rows="5"  class="span6" required><?=stripslashes($mysite['alert_email'])?></textarea></td>
              <td>输入电子邮件地址，每行一个</td>
            </tr>
          
            <tr>
              <td>&nbsp;</td>
              <td><button type="submit" class="btn btn-danger">确定</button></td>
              <td>&nbsp;</td>
            </tr> 
          </table>
	</form>