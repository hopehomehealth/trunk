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
					<h2>��������<span>����ȷ��д���±�</span></h2>
					<ul class="bd">
						<li>
							<input name="oldpassword" type="password" value=""  placeholder="����ԭ����...">
						</li>
						<li>
							<input name="newpassword" type="password" value="" placeholder="����������...">
						</li>
						<li>
							<input name="renewpassword" type="password" value="" placeholder="ȷ��������...">
						</li>
					</ul>
				</div> 
				<div style="height: 200px;"></div>
			</div>
		</section>
		<div class="m-frm-foot">
			<div class="btn-group"> <input class="btn-add" type="submit" style="width:100%;border:0px;" value="ȷ��"/> </div>
		</div>
	</section>
</form>   
  