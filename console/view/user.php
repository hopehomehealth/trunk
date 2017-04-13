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
  <li class="active" style="padding-left:20px"><a href="#tabs-1">会员管理</a></li>
  <li><a href="#tabs-2">新增会员</a></li> 

  <a href="javascript:void(0)" onclick="location.reload();" class="pull-right btn btn-small" style="z-index:1000">刷新</a>
</ul>

<div class="tab-content"> 
	<div class="tab-pane in active" id="tabs-1">  
		<form name="q_from" method="GET" action="" class="form-inline"> 
			<input name="cmd" type="hidden" value="<?=base64_encode('user.php')?>"/> 
			<input name="kw" type="text" id="kw" size="50" value="<?=req('kw')?>" required class="span4" placeholder="用户名、真实姓名、会员卡号、手机号、身份证号..."/> 
			&nbsp;
			<input type="image" src="static/image/find.gif" class="input_img"/>  
		</form>  
		<? 
		if(notnull($query_rows)){
		?>
		<table width="100%" class="table table-hover">
		   
		  <tbody class="mytbody">
		  <tr> 
			  <td>会员ID</td>
			  <td>用户名</td> 
			  <td>姓名</td>
			  <td>头像</td> 
			  <td>昵称</td> 
			  <td>性别</td>
			  <td>生日</td>
			  <td>手机号</td> 
			  <td>QQ号</td> 
			  <td>注册来源</td>
			  <td>会员等级</td>
			  <td>注册日期</td>
			  <td>状态</td>
			  <td>操作</td> 
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
			  <td><a href="http://wpa.qq.com/msgrd?v=3&uin=<?=$val['qq']?>&site=qq&menu=yes" target="frm" title="点击QQ对话"><?=$val['qq']?></a></td> 
			  <td>
			  <?if($val['reg_type']=='SELF'){?>网站<?}?>
			  <?if($val['reg_type']=='WEIXIN'){?>微信<?}?>
			  </td>   
			  <td><?=$user_level['level_name']?></td>
			  <td><?=date('Y-m-d',strtotime($val['addtime']))?></td>
			  <td>
				<?if($val['state']=='1'){?><img src="static/image/ok.gif" title="启用"/><?}?>
				<?if($val['state']=='0'){?><img src="static/image/no.gif" title="停用"/><?}?>
			  </td>
			  <td align="center">   
				<span onclick="dialog_edit('./?cmd=<?=base64_encode('user_edit.php')?>&modal=true&user_id=<?=$val['user_id']?>')" style="cursor:pointer"><img src="static/image/edit.gif"/></span> 
				&nbsp;
				<a href="do.php?cmd=user_del&user_id=<?=$val['user_id']?>" onclick="return confirm('确认删除吗？')" ><img src="static/image/delete.gif"/></a>  
			  </td>
			</tr>
		  </form> 
		  <?
		  } 
		  ?> 
		</table>
		<div style="text-align:right;padding-right:10px;">  
			<br/>
			共计<b><?=$total_number?></b>条 &nbsp;
			<a href="./?cmd=<?=base64_encode('user.php')?>&kw=<?=req('kw')?>&p=1">首页</a>
			<a href="./?cmd=<?=base64_encode('user.php')?>&kw=<?=req('kw')?>&p=<?=$prev_number?>">上一页</a> 
			第<?=$now_page?> / <b><?=$total_page?></b>页 
			<a href="./?cmd=<?=base64_encode('user.php')?>&kw=<?=req('kw')?>&p=<?=$next_number?>">下一页</a>
			<a href="./?cmd=<?=base64_encode('user.php')?>&kw=<?=req('kw')?>&p=<?=$total_page?>">尾页</a>
		</div>
		<?
		} else {
				
		?> 
		<div class="alert">没有查询到相关信息！</div>
		<?}?>
    </div>  
	<div id="tabs-2" class="tab-pane">  
		<form target="frm" method="POST" action="do.php?cmd=user_add" >
			<table width="100%">
				<tr>
					<td align="right" width="100"> <font color="red">*</font> 用户名：</td>
					<td><input name="account" type="text" id="account" class="span4" required pattern=".{5,100}" placeholder="手机号/邮箱..."/></td>
				</tr>
				<tr>
					<td align="right"><font color="red">*</font> 密码：</td>
					<td><input name="password" type="password" id="password" class="span4" required pattern=".{5,18}" placeholder="5-18位字符串..."/></td>
				</tr>
				<tr>
					<td align="right"><font color="red">*</font> 真实姓名：</td>
					<td><input name="username" type="text" id="username" class="span4" required /></td>
				</tr>
				<tr>
					<td align="right">会员卡号：</td>
					<td><input name="vip_no" type="text" id="vip_no" class="span4" /></td>
				</tr>
				<tr>
					<td align="right"><font color="red">*</font> 性别：</td>
					<td>
						<select name="sex" class="span4"  required>
							<option value="男">男</option>
							<option value="女">女</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">生日：</td>
					<td><input name="birthday" type="date" id="birthday" class="span4" /></td>
				</tr>
				<tr>
					<td align="right">身份证：</td>
					<td><input name="idcard" type="text" id="idcard" class="span4" pattern=".{15,18}"/></td>
				</tr>
				<tr>
					<td align="right"><font color="red">*</font> 手机号：</td>
					<td><input name="mobile" type="number" id="mobile" class="span4" required  pattern=".{11,11}"/></td>
				</tr>
				<tr>
					<td align="right">QQ号：</td>
					<td><input name="qq" type="number" id="qq" class="span4" pattern=".{5,15}"/></td>
				</tr> 
				<tr>
					<td align="right">电子邮件：</td>
					<td><input name="email" type="email" id="email" class="span4"/></td>
				</tr>
				<tr>
					<td align="right">状态：</td>
					<td><label class="checkbox inline"><input name="state" type="checkbox" id="state" value="1" checked/> 启用</label></td>
				</tr>
				<tr>
					<td></td>
					<td><br/><input type="submit" value="确定" class="btn btn-info"></td>
				</tr>
			</table> 
		</form>   
    </div>  
</div>
 