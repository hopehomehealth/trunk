<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>


<div class="bar_title">
	<strong>主页模板</strong>
	<a href="javascript:location.reload()" class="pull-right btn btn-small">刷新</a>
</div>   

 
<form target="frm" action="do.php?cmd=shop_theme_setting" method="post" >
		<? 
		if(notnull($query_rows)){ 
			foreach ($query_rows as $val){    
				$image = "/static/image/mall-tpl-ico-".$val['style_name'].'.jpg';
		  ?>
		  <div style="float:left;width:180px;text-align:center;margin-right:20px;">
		    <img src="<?=$image?>" width="100%" onerror="this.src='/static/image/nopic.jpg'">
			<label><input type="radio" name="theme_id" value="<?=$val['theme_id']?>" required <?if($val['theme_id']==$g_shop['theme_id']){?>checked<?}?>> <span <?if($val['theme_id']==$g_shop['theme_id']){?>style="color:red"<?}?>><?=$val['style_name']?> 
			</span> </label>
		  </div>
		  <?	 
			} 
		}
		?>
		<div style="clear:both"><br/><br/></div>
		<span>&nbsp; &nbsp; <input type="submit" value=" 选择并保存 " class="btn btn-danger " /></span>
</form>
	 
 