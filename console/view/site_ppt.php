<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<?include('site.nav.php');?>  

<script type="text/javascript">
function doform_ppt(ppt_id, item){
	var f =  document.getElementById('f'+ppt_id);
	f.action = "do.php?cmd=ppt_edit_fast&ppt_id="+ppt_id+"&item="+item;
	f.submit();
} 
</script>

<form target="frm" name="add_form" action="do.php?cmd=ppt_add" method="post" enctype="multipart/form-data" class="form-inline">
  <table>
   
    <tr>
      <td align="right"><font color="red">*</font> ���ͣ�</td>
      <td height="30">
	  <label><input type="radio" name="ppt_type" value="0" checked>PC��</label>  
	  <label><input type="radio" name="ppt_type" value="1">���߶�</label>
	  </td>
    </tr>

    <tr>
      <td align="right"><font color="red">*</font> ���⣺</td>
      <td><input name="ppt_title" type="text"  id="ppt_title" size="50" required/></td>
    </tr>
 
	<tr>
      <td align="right"><font color="red">*</font> ���ӣ�</td>
      <td><input name="ppt_url" type="url"  id="ppt_url" size="50" value="http://" required/></td>
    </tr> 
	
	<tr>
      <td align="right"><font color="red">*</font> ͼƬ��</td>
      <td><input name="ppt_image" type="file" id="ppt_image" size="60" class="input_file" required/></td>
    </tr> 
	
	<tr>
      <td align="right"><font color="red">*</font> ��ţ�</td>
      <td><input name="order_id" type="number" id="order_id" size="5" value="<?=$max_order_id?>" required/></td>
    </tr> 
	 
    <tr>
	  <td></td>
      <td><input type="submit" value="ȷ��" class="btn btn-danger"></td>
    </tr>
  </table>
</form>
<? 
if(sizeof($ppt_rows)>0){
?>
<table  class="table">
  <thead>
  <tr> 
	  <td>����</td>
      <td>ͼƬ</td>  
	  <td>����</td>
      <td>����</td>
	  <td>���</td> 
      <td width="80">����</td>
  </tr>
  </thead>
  <?  
	foreach ($ppt_rows as $val){ 
		$ppt_image = "/upfiles/$g_siteid/".$val['ppt_image'];
  ?> 
  <form target="frm" id="f<?=$val['ppt_id']?>" method="post" action="" enctype="multipart/form-data"> 
    <tr>     
	  <td>
		<select name="ppt_type" onchange="doform_ppt('<?=$val['ppt_id']?>', 'ppt_type')" class="input-small">  
			<option value="0" <? if($val['ppt_type']==0) {echo 'selected';} ?> >PC��</option> 
			<option value="1" <? if($val['ppt_type']==1) {echo 'selected';} ?> >���߶�</option> 
		</select>	
	  </td>

	  <td>
	  <a href="<?=$ppt_image?>" target="_blank"><img src="<?=$ppt_image?>" height="60" onerror="this.style.display='none'"/></a> 
	 
	  <div style="margin-top:10px">
		<input type="file" name="ppt_image"> <input type="button" value="����" class="btn btn-small" onclick="doform_ppt('<?=$val['ppt_id']?>', 'ppt_image')">
	  </div>
	  </td> 

	  <td>
	  <input name="ppt_title" type="text" id="ppt_title" value="<?=$val['ppt_title']?>" size="20" onchange="doform_ppt('<?=$val['ppt_id']?>', 'ppt_title')" />  
	  </td> 

	  <td><input name="ppt_url" type="text" id="ppt_url" value="<?=$val['ppt_url']?>" size="20" onchange="doform_ppt('<?=$val['ppt_id']?>', 'ppt_url')" /> 
	  </td>

	  <td><input name="order_id" type="number" id="order_id" value="<?=$val['order_id']?>" class="input-mini" onchange="doform_ppt('<?=$val['ppt_id']?>', 'order_id')" /> 
	  </td>
	   
      <td>  
		<a href="do.php?cmd=ppt_del&ppt_id=<?=$val['ppt_id']?>" onclick="return confirm('ȷ��ɾ����')"><img src="static/image/delete.gif"/></a> 
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
