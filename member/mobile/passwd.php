<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?>
  
<form id="myform" method="post" action="do?ac=passwd"> 
<section class="container">
		<section class="container">
			<div class="m-frm-publish"> 
				<div class="m-frm-div">
					<h2>更改密码<span>请正确填写以下表单</span></h2>
					<ul class="bd">
						<li>
							<input name="oldpassword" type="password" value=""  placeholder="输入原密码...">
						</li>
						<li>
							<input name="newpassword" type="password" value="" placeholder="输入新密码...">
						</li>
						<li>
							<input name="renewpassword" type="password" value="" placeholder="确认新密码...">
						</li>
					</ul>
				</div> 
				<div style="height: 200px;"></div>
			</div>
		</section>
		<div class="m-frm-foot">
			<div class="btn-group"> <input class="btn-add" type="submit" style="width:100%;border:0px;" value="确定"/> </div>
		</div>
	</section>
</form>   
  