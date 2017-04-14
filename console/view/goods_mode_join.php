<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?> 
<ul class="nav nav-tabs">   
	<li <?if(nav_active('goods_mode.php') ){?>class="active"<?}?> style="padding-left:20px;">
		<a href="?cmd=<?=base64_encode('goods_mode.php')?>">主题</a>
	</li>   
 
	<li <?if(nav_active('goods_mode_join.php')){?>class="active"<?}?>>
		<a href="?cmd=<?=base64_encode('goods_mode_join.php')?>">开始组合...</a>
	</li>   

	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">刷新</a>
</ul> 

<script type="text/javascript">
function checkAll(name)
{
    var el = document.getElementsByTagName('input');
    var len = el.length;
    for(var i=0; i<len; i++)
    {
        if((el[i].type=="checkbox") && (el[i].name==name))
        {
            el[i].checked = true;
        }
    }
}
function clearAll(name)
{
    var el = document.getElementsByTagName('input');
    var len = el.length;
    for(var i=0; i<len; i++)
    {
        if((el[i].type=="checkbox") && (el[i].name==name))
        {
            el[i].checked = false;
        }
    }
}
</script> 
  
<h3>&raquo; 第一步：选择相关产品</h3>
<form name="q_from" method="get" action="" class="form-inline">  
	<input name="tabs_index" type="hidden" value="1"/> 
	<input name="cmd" type="hidden" value="<?=base64_encode('goods_mode_join.php')?>"/> 
	<input name="kw" type="text" id="kw" size="50" value="<?=req('kw')?>" required/> 
	<input type="image" src="static/image/find.gif" class="input_img"/> 	 
</form>  

<? 
if(notnull($query_rows)){
?>
<form target="frm" id="join_form" method="post" action="do.php?cmd=goods_mode_join" class="form-inline"> 
<table class="table"> 
  <tr>
      <td width="20">
	  <input type="checkbox" id="checkedAll" name="checkedAll" value="<?=$val['goods_id']?>" class="input_checkbox" onclick="if(this.checked==true) { checkAll('goods_box[]'); } else { clearAll('goods_box[]'); }">
	  </td> 
      <td><b>产品ID</b></td> 
	  <td><b>产品类型</b></td> 
	  <td><b>产品编码</b></td> 
	  <td><b>产品名称</b></td>
	  <td><b>价格</b></td>
  </tr> 
  <?  
	foreach ($query_rows as $val){    
		$goods_image = "/upfiles/$g_siteid/".$val['goods_image'];
		
  ?>  
    <tr>
	  <td><input type="checkbox" name="goods_box[]" value="<?=$val['goods_id']?>" class="input_checkbox"></td> 
	  <td><?=$val['goods_id']?></td>   
	  <td><?=$g_product_type[$val['goods_type']]?></td>  
	  <td><b><?=$val['goods_code']?></b></td> 
	  <td><span <?if($val['is_hot']==1){?>style="color:red"<?}?>><?=$val['goods_name']?></span></td> 
	  <td>&yen;<?=$val['real_price']?></td> 
    </tr> 
  <?
  } 
  ?> 
</table>

<table width="100%">
  <tr>
	<td align="right"> 
    <br/>
	共计<b><?=$total_number?></b>条 &nbsp;
	<a href="./?cmd=<?=base64_encode('goods_mode_join.php')?>&kw=<?=req('kw')?>&p=1">首页</a>
    <a href="./?cmd=<?=base64_encode('goods_mode_join.php')?>&kw=<?=req('kw')?>&p=<?=$prev_number?>">上一页</a> 
	第<?=$now_page?> / <b><?=$total_page?></b>页 
	<a href="./?cmd=<?=base64_encode('goods_mode_join.php')?>&kw=<?=req('kw')?>&p=<?=$next_number?>">下一页</a>
	<a href="./?cmd=<?=base64_encode('goods_mode_join.php')?>&kw=<?=req('kw')?>&p=<?=$total_page?>">尾页</a>
	</td>
  </tr>
  <tr>
	<td align="left">
		<h3>&raquo; 第二步：加入您要加入的类别</h3> 
		<table>
		  <tr>
			<td>
			<select name="mode_id" id="mode_id" required> 
			    <option value=""></option>
				<? 
				if(notnull($goods_mode)){
					foreach ($goods_mode as $val){    	
				?>
				<option value="<?=$val['mode_id']?>"><?=$val['mode_name']?></option>
				<?				
					}
				}
				?>
			</select> &nbsp; <input type="submit" value="加入该组合..." class="btn btn-danger" />  </td>
		  </tr>
		</table> 
	</td>
  </tr>
</table>
</form>
<?
} else {
?>
<div class="alert">对不起，没有找到相关产品信息！</div>
<?}?>