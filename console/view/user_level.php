<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<script type="text/javascript"> 
	function doform(level_id, item){
		var f =  document.getElementById('f'+level_id);
		f.action = "do.php?cmd=user_level_fast_edit&level_id="+level_id+"&item="+item;
		f.submit();
	} 
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
  <li class="active" style="padding-left:20px"><a href="#tabs-1">��Ա�ȼ�</a></li> 
  <li><a href="#tabs-2">�����ȼ�</a></li>
  <a href="javascript:void(0)" onclick="location.reload();" class="pull-right btn btn-small" style="z-index:1000">ˢ��</a>
</ul>

<div class="tab-content"> 
	<div class="tab-pane in active" id="tabs-1">  
		<? 
		if(notnull($query_rows)){
		?>
		<table width="100%" class="table table-hover">
		   
		  <tbody class="mytbody">
		  <tr>
			  <td>��Ա�ȼ�</td>
			  <td>�ȼ�����</td> 
			  <td>�ۿ۱���</td>
			  <td>˵��</td>
			  <td>���������ܶ�(Ԫ)</td> 
			  <td width="50">����</td>
		  </tr>
		  </tbody>
		  <?  
			foreach ($query_rows as $val){    	
		  ?> 
		  <form target="frm" id="f<?=$val['level_id']?>" method="post" action="" > 
			<tr> 
			  <td><?=$val['level_type']?></td> 
			  <td><input name="level_name" type="text" id="level_name" style="width:150px" value="<?=$val['level_name']?>" size="5" onchange="doform('<?=$val['level_id']?>', 'level_name')"/>
			  </td> 
			  <td><input name="level_rebate" type="number" step="0.01" max="1" id="level_rebate" style="width:80px" value="<?=$val['level_rebate']?>" size="8" onchange="doform('<?=$val['level_id']?>', 'level_rebate')"/>  
			  </td>
			  <td> 
			  <textarea name="level_note" id="level_note" rows="2"  style="width:300px"  onchange="doform('<?=$val['level_id']?>', 'level_note')"><?=$val['level_note']?></textarea>
			  </td>
			  <td><input name="level_require" type="number" step="1" id="level_require" style="width:80px" value="<?=$val['level_require']?>"   onchange="doform('<?=$val['level_id']?>', 'level_require')"/>  
			  </td>
			  <td align="center">    
				<a href="do.php?cmd=user_level_del&level_id=<?=$val['level_id']?>&level_type=<?=$val['level_type']?>" target="frm" onclick="return confirm('ȷ��ɾ����')"><img src="static/image/delete.gif"/></a> 
			  </td>
			</tr>
		  </form> 
		  <?
		  } 
		  ?> 
		</table> 
		<?
		} else {
				
		?> 
		<div class="alert">û�в�ѯ�������Ϣ��</div>
		<?}?>
		<div id="" class="alert">
			<p style="font-size:14px">�ȼ���Ч�����ӳ�����</p> 

			1. ���������ϵȼ�����Ч��Ϊ1�꣬������֮������㣻�տ��ȼ�Ϊ������Ч��<br/>
			2. �ڵȼ���Ч���ڣ���ﵽ��һ�ȼ���׼������������<br/>
			3. �ȼ����ں����������������������ܻ�Ա�ȼ���Ч��˳��һ��<br/>
			�ȼ���Ч���ڣ�<br/>
			������Ա�����Ѷ�����2�������ѽ���&yen;1000<br/>
			�𿨻�Ա�����Ѷ�����4�������ѽ���&yen;2000<br/>
			���𿨻�Ա�����Ѷ�����6�������ѽ���&yen;3000<br/>
			��δ������������������ȼ�˳���µ�һ���ȼ���
		</div>
    </div>  
	<div id="tabs-2" class="tab-pane">  
		<form target="frm" method="POST" action="do.php?cmd=user_level_add" >
			<table width="100%">
				<tr>
					<td align="right" width="100"><font color="red">*</font> �ȼ����ƣ�</td>
					<td><input name="level_name" type="text" id="level_name" class="span4" required placeholder="�磺�����Ա"/></td>
				</tr>
				<tr>
					<td align="right" ><font color="red">*</font> �ۿ۱�����</td>
					<td><input name="level_rebate" type="number" max="1" step="0.01" id="level_rebate" class="span4" required  placeholder="��85�ۣ���д��0.85"/></td>
				</tr>
				<tr>
					<td align="right" ><font color="red">*</font> ��������</td>
					<td>�����ܶ�� <input name="level_require" type="number" step="1" id="level_require" class="input-small" required  placeholder="��85�ۣ���д��0.85"/> Ԫ���Զ��������õȼ�</td>
				</tr>
				<tr>
					<td align="right" >�ȼ�˵����</td>
					<td>
					<textarea name="level_note" id="level_note" rows="3" style="width:600px"></textarea>
					</td>
				</tr> 
				<tr>
					<td></td>
					<td><input type="submit" value="ȷ��" class="btn btn-info"></td>
				</tr>
			</table> 
		</form>   
		
    </div>  
</div>
 