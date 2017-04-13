<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>
 
<?include('wx_home.nav.php');?>
   

		<script type="text/javascript">
		function doform(nav_id, item){
			var f =  document.getElementById('f'+nav_id);
			f.action = "do.php?cmd=wx_home_nav_edit&nav_id="+nav_id+"&item="+item;
			f.submit();
		} 
		</script>

		<? 
		if(notnull($nav_list)){
		?>
		<table class="table"> 
		  <tr>  
			<td><strong>菜单</strong></td>
			<td><strong>链接URL</strong></td>
			<td><strong>图标</strong> </td>
			<td><strong>序号</strong></td> 
			<td><strong>是否启用</strong></td>  
		  </tr> 
		  <?  
		  foreach ($nav_list as $val){    	
		  ?>
		  <form target="frm" id="f<?=$val['nav_id']?>" action="" method="post" >
		  <tr>
		 
			<td><input name="nav_title" type="text" id="nav_title" class="input" value="<?=$val['nav_title']?>" size="25" onchange="doform('<?=$val['nav_id']?>', 'nav_title')"/></td>

			<td><input name="nav_url" type="text" id="nav_url" class="input" value="<?=$val['nav_url']?>" size="30" onchange="doform('<?=$val['nav_id']?>', 'nav_url')" data-provide="typeahead" data-items="4" data-source='<?=$typeahead?>'/></td>

			<td><img src="/themes/<?=$g_m_tpl?>/images/<?=$val['nav_ico']?>" style="width:50px"></td>

			<td><input name="order_id" type="number" id="order_id" class="input-mini" value="<?=$val['order_id']?>" onchange="doform('<?=$val['nav_id']?>', 'order_id')"/></td>

			<td>
			<select id="state" name="state" class="input-small" onchange="doform('<?=$val['nav_id']?>', 'state')">
				<option value="1" <?if($val['state']=='1'){?>selected<?}?>>启用</option>
				<option value="0" <?if($val['state']=='0'){?>selected<?}?>>禁用</option>
			</select>
			</td> 
		  </tr>
		  </form>
		  <?				
			} 
		  ?>
		</table>
		<?	 
		}
		?>
	 