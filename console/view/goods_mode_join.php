<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?> 
<ul class="nav nav-tabs">   
	<li <?if(nav_active('goods_mode.php') ){?>class="active"<?}?> style="padding-left:20px;">
		<a href="?cmd=<?=base64_encode('goods_mode.php')?>">����</a>
	</li>   
 
	<li <?if(nav_active('goods_mode_join.php')){?>class="active"<?}?>>
		<a href="?cmd=<?=base64_encode('goods_mode_join.php')?>">��ʼ���...</a>
	</li>   

	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">ˢ��</a>
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
  
<h3>&raquo; ��һ����ѡ����ز�Ʒ</h3>
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
      <td><b>��ƷID</b></td> 
	  <td><b>��Ʒ����</b></td> 
	  <td><b>��Ʒ����</b></td> 
	  <td><b>��Ʒ����</b></td>
	  <td><b>�۸�</b></td>
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
	����<b><?=$total_number?></b>�� &nbsp;
	<a href="./?cmd=<?=base64_encode('goods_mode_join.php')?>&kw=<?=req('kw')?>&p=1">��ҳ</a>
    <a href="./?cmd=<?=base64_encode('goods_mode_join.php')?>&kw=<?=req('kw')?>&p=<?=$prev_number?>">��һҳ</a> 
	��<?=$now_page?> / <b><?=$total_page?></b>ҳ 
	<a href="./?cmd=<?=base64_encode('goods_mode_join.php')?>&kw=<?=req('kw')?>&p=<?=$next_number?>">��һҳ</a>
	<a href="./?cmd=<?=base64_encode('goods_mode_join.php')?>&kw=<?=req('kw')?>&p=<?=$total_page?>">βҳ</a>
	</td>
  </tr>
  <tr>
	<td align="left">
		<h3>&raquo; �ڶ�����������Ҫ��������</h3> 
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
			</select> &nbsp; <input type="submit" value="��������..." class="btn btn-danger" />  </td>
		  </tr>
		</table> 
	</td>
  </tr>
</table>
</form>
<?
} else {
?>
<div class="alert">�Բ���û���ҵ���ز�Ʒ��Ϣ��</div>
<?}?>