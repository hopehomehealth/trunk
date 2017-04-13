<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?>

<script type="text/javascript">
$(document).ready(function(){
	$('#myTab a').click(function (e) { 
		e.preventDefault();
		$(this).tab('show'); 
	})
}); 
</script>

<ul class="nav nav-tabs" id="myTab"> 
  <?if($g_admin['is_admin']=='1'){?>
  <li class="active" style="padding-left:20px"><a href="#tabs-1">我的账户</a></li>
  <?}?>
  <li><a href="#tabs-2">更改密码</a></li> 
</ul>

<div class="tab-content"> 
	<?if($g_admin['is_admin']=='1'){?>
	<div class="tab-pane in active" id="tabs-1">  
		<table width="100%">
		<tr>
			<td valign="top">
			<form target="frm" method="post" action="do.php?cmd=account_add"> 
				<table>
					<tr>
						<td align="right"><font color="red">*</font> 用户名：</td>
						<td><input name="account" type="text" id="account" size="15" required  autocomplete="off"/></td>
					</tr>
					<tr>
						<td align="right"><font color="red">*</font> 密码：</td>
						<td><input name="password" type="password" id="password" size="15" required  autocomplete="off"/></td>
					</tr>
					<tr>
						<td align="right"><font color="red">*</font> 密码确认：</td>
						<td><input name="repassword" type="password" id="repassword" size="15" required  autocomplete="off"/></td>
					</tr>
					<tr>
						<td align="right"><font color="red">*</font> 姓名：</td>
						<td><input name="username" type="text" id="username" size="10" required/></td>
					</tr>
					<tr>
						<td align="right"><font color="red">*</font> 邮件：</td>
						<td><input name="email" type="text" id="email" size="25" required/></td>
					</tr>
					<tr>
						<td align="right"><font color="red">*</font> 手机：</td>
						<td><input name="mobile" type="text" id="mobile" size="11" required/></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" value="确定" class="btn btn-danger" /> </td>
					</tr>
				</table> 
			</form>
			</td>
			<td valign="top">
			<script type="text/javascript">
			function doform_member(account_id, item){
				var f =  document.getElementById('f'+account_id);
				f.action = "do.php?cmd=account_edit&account_id="+account_id+"&item="+item;
				f.submit();
			} 
			</script> 
			<? 
			  if(notnull($rows)){
			?>
			<table class="table table-hover"> 
			  <thead>
			  <tr> 
			    <th>#ID</th>
				<th>用户名</th>  
				<th>姓名</th> 
				<th>手机</th>  
				<th>邮件</th>
				<th width="50"></th> 
			  </tr> 
			  </thead>
			  <?  
				foreach ($rows as $val){    	
			  ?>
			  <form target="frm" id="f<?=$val['account_id']?>" action="" method="post" >
			  <tr> 
			    <td><?=$val['account_id']?></td>

				<td><?=$val['account']?></td>
 
				<td><input  name="username" type="text" id="username"  value="<?=$val['username']?>" size="8" onchange="doform_member('<?=$val['account_id']?>', 'username')" class="span1"  autocomplete="off"/></td>

				<td><input  name="mobile" type="number" id="mobile"  value="<?=$val['mobile']?>" size="8" onchange="doform_member('<?=$val['account_id']?>', 'mobile')" class="span2"/></td>

				<td><input  name="email" type="email" id="email"  value="<?=$val['email']?>" size="8" onchange="doform_member('<?=$val['account_id']?>', 'email')" class="span3"/></td>
				
				<td align="center">
				<?if($val['is_admin']!='1'){?>
				<a href="do.php?cmd=account_del&account_id=<?=$val['account_id']?>" onclick="return confirm('确认删除吗？')" class="btn btn-small">删除</a> 
				<?}?>
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
			</td>
		</tr>
		</table>
			
		</div> 
		<?}?>

		<div id="tabs-2" class="tab-pane">  
			<form target="frm" method="post" action="do.php?cmd=account_passwd"> 
				<table>
					<tr>
						<td align="right"><font color="red">*</font> 输入原密码：</td>
						<td><input name="srcpassword" type="password" id="srcpassword" size="15" required autocomplete="off"/></td>
					</tr>
					<tr>
						<td align="right"><font color="red">*</font> 输入新密码：</td>
						<td><input name="newpassword" type="password" id="newpassword" size="15" required autocomplete="off"/></td>
					</tr>
					<tr>
						<td align="right"><font color="red">*</font> 确认新密码：</td>
						<td><input name="repassword" type="password" id="repassword" size="15" required autocomplete="off"/></td>
					</tr>
					<tr>
						<td></td>
						<td>
						<input type="hidden" name="account_id" value="<?=$_COOKIE['CLOOTA_B2B2C_ADMIN_UUID']?>">
						<input type="submit" value="确定" class="btn btn-danger" /> </td>
					</tr>
				</table>
			</form>
		</div>  
</div>