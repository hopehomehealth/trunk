<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<?include('wx_home.nav.php');?>  

<script type="text/javascript">
function doform(dist_id, item){
	var f =  document.getElementById('f'+dist_id);
	f.action = "do.php?cmd=wx_home_dist_edit_fast&dist_id="+dist_id+"&item="+item;
	f.submit();
} 
</script>

<form target="frm" name="add_form" action="do.php?cmd=wx_home_dist_add" method="post" enctype="multipart/form-data" class="form-inline">
  <table> 

    <tr>
      <td align="right"><font color="red">*</font> ���⣺</td>
      <td><input name="dist_title" type="text"  id="dist_title" size="50" required/></td>
    </tr>
 
	<tr>
      <td align="right"><font color="red">*</font> ���ӣ�</td>
      <td><input name="dist_url" type="text"  id="dist_url" size="50" value="http://" required/></td>
    </tr> 
	
	<tr>
      <td align="right"><font color="red">*</font> ͼƬ��</td>
      <td><input name="dist_image" type="file" id="dist_image" size="60" class="input_file" required/></td>
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
if(sizeof($dist_rows)>0){
?>
<table  class="table">
  <thead>
  <tr>  
      <td>ͼƬ</td>  
	  <td>����</td>
      <td>����</td>
	  <td>���</td> 
	  <td><strong>�Ƿ�����</strong></td> 
      <td width="80">����</td>
  </tr>
  </thead>
  <?  
	foreach ($dist_rows as $val){ 
		$dist_image = "/upfiles/$g_siteid/".$val['dist_image'];
  ?> 
  <form target="frm" id="f<?=$val['dist_id']?>" method="post" action=""  enctype="multipart/form-data"> 
    <tr>     
	  <td>
	  <a href="<?=$dist_image?>" target="_blank"><img src="<?=$dist_image?>" style="width:100px;height:80px;" onerror="this.style.display='none'"/></a> 
	 
	  <div style="margin-top:10px">
		<input type="file" name="dist_image"> <input type="button" value="����" class="btn btn-small" onclick="doform('<?=$val['dist_id']?>', 'dist_image')">
	  </div>
	  </td> 

	  <td>
	  <input name="dist_title" type="text" id="dist_title" value="<?=$val['dist_title']?>" size="20" onchange="doform('<?=$val['dist_id']?>', 'dist_title')" />  
	  </td> 

	  <td><input name="dist_url" type="text" id="dist_url" value="<?=$val['dist_url']?>" size="20" onchange="doform('<?=$val['dist_id']?>', 'dist_url')" /> 
	  </td>

	  <td><input name="order_id" type="number" id="order_id" value="<?=$val['order_id']?>" class="input-mini" onchange="doform('<?=$val['dist_id']?>', 'order_id')" /> 
	  </td>

	  <td>
		  <select id="state" name="state" class="input-small" onchange="doform('<?=$val['dist_id']?>', 'state')">
			<option value="1" <?if($val['state']=='1'){?>selected<?}?>>����</option>
			<option value="0" <?if($val['state']=='0'){?>selected<?}?>>����</option>
		  </select>
	  </td>
	   
      <td>  
		  <a href="do.php?cmd=wx_home_dist_del&dist_id=<?=$val['dist_id']?>" onclick="return confirm('ȷ��ɾ����')"><img src="static/image/delete.gif"/></a> 
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
