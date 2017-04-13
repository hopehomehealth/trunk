<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>



<script type="text/javascript">
	$(document).ready(function(){ 
		$(".group").colorbox({rel:'group'});
					  
		$("#click").click(function(){ 
			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
	});
</script>

<script type="text/javascript">
$(document).ready(function(){
	$('#myTab a').click(function (e) { 
		e.preventDefault();
		$(this).tab('show'); 
	})
}); 
</script>

<ul class="nav nav-tabs" id="myTab"> 
  <li class="active" style="padding-left:20px"><a href="#tabs-1">我的模板</a></li>
  <li><a href="#tabs-2">PC端模板</a></li> 
  <li><a href="#tabs-3">无线端模板</a></li> 
</ul>

<div class="tab-content"> 
	<div class="tab-pane in active" id="tabs-1">    
		<?    
		if($this_site_tpl != ''){  
		?> 
				<table style="width:220px;float:left;font-size:12px;margin-right:10px;margin-bottom:10px;" >  
					<tr>
						<td><a href="http://<?=$g_site_domain?>/themes/<?=$this_site_tpl?>/ico.jpg" class="group">
						<div style="width:220px;height:360px;overflow:hidden"><img src="http://<?=$g_site_domain?>/themes/<?=$this_site_tpl?>/ico.jpg" width="100%" onerror="this.src='images/nopic.jpg'" /></div></a>
						<img src="static/image/bg-shadow.gif" width="100%"/></td>
					</tr> 
					<tr><td align="center">PC端模板：<?=$this_site_tpl?></td></tr>
				</table>
		<?  
		}
	   
		if($this_mobile_tpl != ''){  
		?> 
				<table style="width:220px;float:left;font-size:12px;margin-right:10px;margin-bottom:10px;" >  
					<tr>
						<td><a href="http://<?=$g_site_domain?>/themes/<?=$this_mobile_tpl?>/ico.jpg" class="group">
						<div style="width:220px;height:360px;overflow:hidden"><img src="http://<?=$g_site_domain?>/themes/<?=$this_mobile_tpl?>/ico.jpg" width="100%" onerror="this.src='images/nopic.jpg'" /></div></a>
						<img src="static/image/bg-shadow.gif" width="100%"/></td>
					</tr> 
					<tr><td align="center">无线端模板：<?=$this_mobile_tpl?></td></tr>
				</table>
		<?  
		}
		?> 
		<div class="clr"></div>
	</div>

	<div id="tabs-2" class="tab-pane">  
		<form target="frm" method="post" action="do.php?cmd=theme_setting&type=site" onsubmit="return confirm('确认更要换模板吗？')">
		<? 
		/// 商城模板
		$sql = "select * from `t_tpl` where tpl_name LIKE 's%'  ORDER BY order_id ASC";   
		$tpls = $db->get_all($sql); 

		if(notnull($tpls)){ 
			$dir = $g_root.'themes/';
			foreach ($tpls as $cval){  
				$readme = $cval['readme'];
				$file = $cval['tpl_name'];

				$tpl_image = "http://".$g_site_domain."/themes/".$file."/ico.jpg";
		?>  
				<table style="width:250px;float:left;font-size:12px;margin-right:10px;margin-bottom:10px;" title="<?if(is_file($dir.$file.'/LOCK')){?>已锁定，正在开发，暂不可用！<?}?>"> 
					<tr>
						<td height="30" style="padding-left:20px;"> 
						<?if(is_file($dir.$file.'/LOCK')){?><img src="static/image/no.gif"/><?}?>
						<input type="radio" name="tpl_name" value="<?=$file?>" class="input_radio" <?if($this_site_tpl == $file){?>checked<?}?> <?if(is_file($dir.$file.'/LOCK')){?>disabled style="display:none"<?}?>>  
						<b <?if($this_site_tpl == $file){?>style="font-size:14px;color:red;"<?}?>><?=$file?></b>
						</td> 
					</tr>
					<tr>
						<td><a href="<?=$tpl_image?>" class="group">
						<div style="width:250px;height:400px;overflow:hidden"><img   src="<?=$tpl_image?>" width="250" onerror="this.src='/static/image/nopic.jpg'" /></div></a>
						<img src="static/image/bg-shadow.gif" width="100%"/></td>
					</tr>
					<tr>
						<td align="center" height="50">
						<?
						if($readme!=''){	
							$readme_array = explode('|',$readme);
							if(sizeof($readme_array)>1){
								$readme = trim($readme_array[1]); 
							} 
							echo $readme;
						} else {
							echo '暂无模板描述信息';	
						}
						?>
						</td>
					</tr>
				</table> 
		<? 
			}
		}
		?> 
			<div class="clr"></div>
			<input type="submit" value="选择并启用" class="btn btn-danger " />
		</form> 
		<div class="clr"></div>
	</div> 

	 

	<div id="tabs-3" class="tab-pane">  
		<form target="frm" method="post" action="do.php?cmd=theme_setting&type=mobile" onsubmit="return confirm('确认更要换模板吗？')">
		<? 
		/// 商城模板
		$sql = "select * from `t_tpl` where tpl_name LIKE 'm%' ORDER BY order_id ASC";   
		$tpls = $db->get_all($sql); 

		if(notnull($tpls)){ 
			$dir = $g_root.'themes/';
			foreach ($tpls as $cval){  
				$readme = $cval['readme'];
				$file = $cval['tpl_name'];

				$tpl_image = "http://".$g_site_domain."/themes/".$file."/ico.jpg";
		?>  
				<table style="width:250px;float:left;font-size:12px;margin-right:10px;margin-bottom:10px;" title="<?if(is_file($dir.$file.'/LOCK')){?>已锁定，正在开发，暂不可用！<?}?>"> 
					<tr>
						<td height="30" style="padding-left:20px;"> 
						<?if(is_file($dir.$file.'/LOCK')){?><img src="static/image/no.gif"/><?}?>
						<input type="radio" name="tpl_name" value="<?=$file?>" class="input_radio" <?if($this_mobile_tpl == $file){?>checked<?}?> <?if(is_file($dir.$file.'/LOCK')){?>disabled style="display:none"<?}?>>  
						<b <?if($this_mobile_tpl == $file){?>style="font-size:14px;color:red;"<?}?>><?=$file?></b>
						</td> 
					</tr>
					<tr>
						<td><a href="<?=$tpl_image?>" class="group">
						<div style="width:250px;height:400px;overflow:hidden"><img   src="<?=$tpl_image?>" width="250" onerror="this.src='images/nopic.jpg'" /></div></a>
						<img src="static/image/bg-shadow.gif" width="100%"/></td>
					</tr>
					<tr>
						<td align="center" height="50">
						<?
						if($readme!=''){	
							$readme_array = explode('|',$readme);
							if(sizeof($readme_array)>1){
								$readme = trim($readme_array[1]); 
							} 
							echo $readme;
						} else {
							echo '暂无模板描述信息';	
						}
						?>
						</td>
					</tr>
				</table> 
		<? 
			}
		}
		?> 
			<div class="clr"></div>
			<input type="submit" value="选择并启用" class="btn btn-danger " />
		</form> 
		<div class="clr"></div>
	</div> 
  
</div> 