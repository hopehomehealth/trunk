<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<script type="text/javascript"> 
	function doform_customer(user_id, item){
		var f =  document.getElementById('f'+user_id);
		f.action = "do.php?cmd=user_fast_edit&user_id="+user_id+"&item="+item;
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
  <li class="active" style="padding-left:20px"><a href="#tabs-1">��Ա����</a></li>
  <li><a href="#tabs-2">������Ա</a></li> 

  <a href="javascript:void(0)" onclick="location.reload();" class="pull-right btn btn-small" style="z-index:1000">ˢ��</a>
</ul>

<div class="tab-content"> 
	<div class="tab-pane in active" id="tabs-1">  
		<form name="q_from" method="GET" action="" class="form-inline"> 
			<input name="cmd" type="hidden" value="<?=base64_encode('user.php')?>"/> 
			<input name="kw" type="text" id="kw" size="50" value="<?=req('kw')?>" required class="span4" placeholder="�û�������ʵ��������Ա���š��ֻ��š����֤��..."/> 
			&nbsp;
			<input type="image" src="static/image/find.gif" class="input_img"/>  
		</form>  
		<? 
		if(notnull($query_rows)){
		?>
		<table width="100%" class="table table-hover">
		   
		  <tbody class="mytbody">
		  <tr> 
			  <td>��ԱID</td>
			  <td>�û���</td> 
			  <td>����</td>
			  <td>ͷ��</td> 
			  <td>�ǳ�</td> 
			  <td>�Ա�</td>
			  <td>����</td>
			  <td>�ֻ���</td> 
			  <td>QQ��</td> 
			  <td>ע����Դ</td>
			  <td>��Ա�ȼ�</td>
			  <td>ע������</td>
			  <td>״̬</td>
			  <td>����</td> 
		  </tr>
		  </tbody>
		  <?  
			foreach ($query_rows as $val){    
			  $user_level = get_user_level_by_type($val['user_level']);
		  ?> 
		  <form target="frm" id="f<?=$val['user_id']?>" method="post" action="" > 
			<tr>
			  <td><?=$val['user_id']?></td>
			  <td><?=$val['account']?></td>
			  <td><?=$val['username']?></td>
			  <td><?if($val['avatar']!=''){?><img src="<?=$val['avatar']?>" style="height:36px;width:36px" class="img-circle"><?}?></td>
			  <td><?=$val['nickname']?></td>
			  <td><?=$val['sex']?></td> 
			  <td><?if($val['birthday']!='0000-00-00'){?><?=$val['birthday']?><?}?></td>
			  <td><?=$val['mobile']?></td>
			  <td><a href="http://wpa.qq.com/msgrd?v=3&uin=<?=$val['qq']?>&site=qq&menu=yes" target="frm" title="���QQ�Ի�"><?=$val['qq']?></a></td> 
			  <td>
			  <?if($val['reg_type']=='SELF'){?>��վ<?}?>
			  <?if($val['reg_type']=='WEIXIN'){?>΢��<?}?>
			  </td>   
			  <td><?=$user_level['level_name']?></td>
			  <td><?=date('Y-m-d',strtotime($val['addtime']))?></td>
			  <td>
				<?if($val['state']=='1'){?><img src="static/image/ok.gif" title="����"/><?}?>
				<?if($val['state']=='0'){?><img src="static/image/no.gif" title="ͣ��"/><?}?>
			  </td>
			  <td align="center">   
				<span onclick="dialog_edit('./?cmd=<?=base64_encode('user_edit.php')?>&modal=true&user_id=<?=$val['user_id']?>')" style="cursor:pointer"><img src="static/image/edit.gif"/></span> 
				&nbsp;
				<a href="do.php?cmd=user_del&user_id=<?=$val['user_id']?>" onclick="return confirm('ȷ��ɾ����')" ><img src="static/image/delete.gif"/></a>  
			  </td>
			</tr>
		  </form> 
		  <?
		  } 
		  ?> 
		</table>
		<div style="text-align:right;padding-right:10px;">  
			<br/>
			����<b><?=$total_number?></b>�� &nbsp;
			<a href="./?cmd=<?=base64_encode('user.php')?>&kw=<?=req('kw')?>&p=1">��ҳ</a>
			<a href="./?cmd=<?=base64_encode('user.php')?>&kw=<?=req('kw')?>&p=<?=$prev_number?>">��һҳ</a> 
			��<?=$now_page?> / <b><?=$total_page?></b>ҳ 
			<a href="./?cmd=<?=base64_encode('user.php')?>&kw=<?=req('kw')?>&p=<?=$next_number?>">��һҳ</a>
			<a href="./?cmd=<?=base64_encode('user.php')?>&kw=<?=req('kw')?>&p=<?=$total_page?>">βҳ</a>
		</div>
		<?
		} else {
				
		?> 
		<div class="alert">û�в�ѯ�������Ϣ��</div>
		<?}?>
    </div>  
	<div id="tabs-2" class="tab-pane">  
		<form target="frm" method="POST" action="do.php?cmd=user_add" >
			<table width="100%">
				<tr>
					<td align="right" width="100"> <font color="red">*</font> �û�����</td>
					<td><input name="account" type="text" id="account" class="span4" required pattern=".{5,100}" placeholder="�ֻ���/����..."/></td>
				</tr>
				<tr>
					<td align="right"><font color="red">*</font> ���룺</td>
					<td><input name="password" type="password" id="password" class="span4" required pattern=".{5,18}" placeholder="5-18λ�ַ���..."/></td>
				</tr>
				<tr>
					<td align="right"><font color="red">*</font> ��ʵ������</td>
					<td><input name="username" type="text" id="username" class="span4" required /></td>
				</tr>
				<tr>
					<td align="right">��Ա���ţ�</td>
					<td><input name="vip_no" type="text" id="vip_no" class="span4" /></td>
				</tr>
				<tr>
					<td align="right"><font color="red">*</font> �Ա�</td>
					<td>
						<select name="sex" class="span4"  required>
							<option value="��">��</option>
							<option value="Ů">Ů</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">���գ�</td>
					<td><input name="birthday" type="date" id="birthday" class="span4" /></td>
				</tr>
				<tr>
					<td align="right">���֤��</td>
					<td><input name="idcard" type="text" id="idcard" class="span4" pattern=".{15,18}"/></td>
				</tr>
				<tr>
					<td align="right"><font color="red">*</font> �ֻ��ţ�</td>
					<td><input name="mobile" type="number" id="mobile" class="span4" required  pattern=".{11,11}"/></td>
				</tr>
				<tr>
					<td align="right">QQ�ţ�</td>
					<td><input name="qq" type="number" id="qq" class="span4" pattern=".{5,15}"/></td>
				</tr> 
				<tr>
					<td align="right">�����ʼ���</td>
					<td><input name="email" type="email" id="email" class="span4"/></td>
				</tr>
				<tr>
					<td align="right">״̬��</td>
					<td><label class="checkbox inline"><input name="state" type="checkbox" id="state" value="1" checked/> ����</label></td>
				</tr>
				<tr>
					<td></td>
					<td><br/><input type="submit" value="ȷ��" class="btn btn-info"></td>
				</tr>
			</table> 
		</form>   
    </div>  
</div>
 