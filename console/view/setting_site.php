<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<?include('setting.nav.php');?>
 
<form target="frm" id="site_setting_form" name="site_setting_form" method="post" action="do.php?cmd=site_setting" enctype="multipart/form-data">
	      <table width="100%" >
            <tr>
              <td width="100" align="right"><font color="red">*</font> 站点名称：</td>
              <td ><input type="text" name="site_name" id="site_name" value="<?=$mysite['site_name']?>" class="span6" required/></td> 
            </tr>  
			<tr>
              <td align="right"><font color="red">*</font> 分站简称：</td>
              <td><input type="text" name="city_name" id="city_name" value="<?=$mysite['city_name']?>" class="span6" placeholder="如：上海" required/></td> 
            </tr> 
			<tr>
				<td align="right"><font color="red">*</font> 站点LOGO：</td>
				<td>
				<?
				if($mysite['logo']!=''){
					$logo = "/upfiles/$g_siteid/".$mysite['logo'];
				?>
				<img src="<?=$logo?>" height="60" style="border:1px solid #ccc;padding:3px;"><br/><br/>
				<?}?>
				<input name="logo" type="file" id="logo" size="10" /></td>
			</tr> 
			<?
			$style_file = $g_dir.'/themes/'.$g_login['tpl_name'].'/style.config.php';
			if(is_file($style_file)){
				include($style_file);
			?>
			<tr>
              <td align="right"><font color="red">*</font> PC站点风格：</td>
              <td>
				<select name="style_name" class="input-small" >
					<option value=""></option>
				    <?foreach ($styles as $k => $v) {?>
					<option value="<?=$k?>" <?if($mysite['style_name']==$k){?>selected<?}?>><?=$v?></option>
					<?}?> 
				</select>
			  </td> 
            </tr>
			<?}?>
			<?
			$style_file = $g_dir.'/themes/'.$g_login['mobile_tpl_name'].'/style.config.php';
			if(is_file($style_file)){
				include($style_file);
			?>
			<tr>
              <td align="right"><font color="red">*</font> 微信站点风格：</td>
              <td>
				<select name="mobile_style_name" class="input-small" >
					<option value=""></option>
				    <?foreach ($styles as $k => $v) {?>
					<option value="<?=$k?>" <?if($mysite['mobile_style_name']==$k){?>selected<?}?>><?=$v?></option>
					<?}?> 
				</select>
			  </td> 
            </tr>
			<?}?>
			<tr>
              <td align="right">站点公告：</td>
              <td><textarea name="site_notice" cols="60" rows="5" class="span6"><?=stripslashes($mysite['site_notice'])?></textarea></td> 
            </tr>
			<tr>
              <td align="right">SEO标题：</td>
              <td><input type="text" name="page_title" size="60" value="<?=$mysite['page_title']?>" class="span6"/></td> 
            </tr>
			<tr>
              <td align="right">SEO描述：</td>
              <td><textarea name="page_description" cols="60" rows="5" class="span6"><?=$mysite['page_description']?></textarea></td> 
            </tr>  
			<tr>
              <td align="right">SEO关键词：</td>
              <td><input type="text" name="page_keywords" size="60" value="<?=$mysite['page_keywords']?>" class="span6"/></td> 
            </tr>  
            <tr>
              <td align="right">PC/JS代码：</td>
              <td><textarea name="common_code" cols="60" rows="5" class="span6" placeholder="如百度统计JS代码、在线客服统计代码等等..."><?=stripslashes($mysite['common_code'])?></textarea></td> 
            </tr>
			<tr>
              <td align="right">无线/JS代码：</td>
              <td><textarea name="mobile_common_code" cols="60" rows="5" class="span6"><?=stripslashes($mysite['mobile_common_code'])?></textarea></td> 
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input type="submit" value="确定" class="btn btn-danger" /></td> 
            </tr> 
          </table>
</form>