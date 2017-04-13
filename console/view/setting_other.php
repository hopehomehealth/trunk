<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<?include('setting.nav.php');?>

<form target="frm" id="site_setting_other_form" name="site_setting_other_form" method="post" action="do.php?cmd=site_setting_other"> 
	<table width="100%" border="0" >
		    <thead>  
			<tr>
              <td width="120" height="40" style="text-align:right">备案关站：</td>
              <td>
				<label><input type="checkbox" name="is_icp_date" value="1" <?if($misc['is_icp_date']=='1'){?>checked<?}?>> 启用 （白天关闭网站，夜间开启网站）</label>
			  </td>
              <td></td>
            </tr> 
			</thead> 
			<tr>
              <td style="text-align:right">积分兑换比例：</td>
              <td>  
				1积分兑换 <input type="number" step="0.01" name="score_rebate" value="<?=$misc['socre_rebate']?>" style="width:100px"> 人民币/元
			  </td>
              <td></td>
            </tr>
			<!--
			<tr>
              <td style="text-align:right">三级分销模式：</td>
              <td>
				<label><input type="checkbox" name="is_three_agent" value="1" <?if($misc['is_three_agent']=='1'){?>checked<?}?>> 启用</label>
			  </td>
              <td></td>
            </tr> 
			<tr>
              <td style="text-align:right">三级分销比例：</td>
              <td>  
				1级代理商：<input type="number" name="agent_rebate_1" value="<?=$misc['agent_rebate_1']?>" style="width:80px">% <br>
				2级代理商：<input type="number" name="agent_rebate_2" value="<?=$misc['agent_rebate_2']?>" style="width:80px">% <br>
				3级代理商：<input type="number" name="agent_rebate_3" value="<?=$misc['agent_rebate_3']?>" style="width:80px">% 
			  </td>
              <td></td>
            </tr>
			-->
			<tr>
              <td style="text-align:right">热门搜索词：</td>
              <td>  
			  <textarea name="search_keywrods" cols="60" rows="4" class="span4" placeholder="一行一个关键词"><?=stripslashes($misc['search_keywrods'])?></textarea>   
			  </td>
              <td></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td height="50"><input type="submit" value="确定" class="btn btn-danger" /></td>
              <td>&nbsp;</td>
            </tr> 
	</table>
</form>