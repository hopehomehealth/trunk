<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?>
  
<form id="myform" method="post" action="do?ac=profile"> 
	<section class="container">
		<section class="container">
			<div class="m-frm-publish">
				<input type="hidden" name="sex" id="sex">
				<div class="mod-gender"> <span class="label">�Ա�</span> <span class="item <?if($profile['sex']=='��'){?>on<?}?>" data-gender="1" id="sex_1"><i class="male"></i>����</span> <span class="item <?if($profile['sex']=='Ů'){?>on<?}?>" data-gender="0" id="sex_2"><i class="female"></i>Ů��</span> </div>
				<div class="streak"></div>
				<div class="m-frm-div">
					<h2>��ϵ��ʽ<span>���·�ʽ��������һ��</span></h2>
					<ul class="bd">
						<li>
							<input name="username" type="text" value="<?=$profile['username']?>"  placeholder="����">
						</li>
						<li>
							<input name="nickname" type="text" value="<?=$profile['nickname']?>" placeholder="ǩ��">
						</li>
						<li>
							<input name="mobile" type="number" value="<?=$profile['mobile']?>" placeholder="�ֻ���">
						</li> 
						<li>
							<input name="email" type="email" value="<?=$profile['email']?>" placeholder="�����ʼ�">
						</li>
						<li>
							<input name="birthday" type="date" value="<?=$profile['birthday']?>" placeholder="����">
						</li>
						<li>
							<input name="qq" type="number" placeholder="QQ��">
						</li>
					</ul>
				</div>
				<div class="streak"></div>
				<div class="m-frm-body">
					<h2>���˼��</h2>
					<div class="bd">
						<textarea class="_j_note" rows="5" placeholder="����һ����ľ�������..."></textarea>
						<p class="_j_error hide">����<span class="char err">20</span>��</p>
					</div>
				</div>
				<div style="height: 200px;"></div>
			</div>
		</section>
		<div class="m-frm-foot">
			<div class="btn-group"> <input class="btn-add" type="submit" style="width:100%;border:0px;" value="ȷ��"/> </div>
		</div>
	</section> 
</form>   

<script type="text/javascript">
$("#sex_1").click(function(){
    $("#sex_1").addClass("on");
	$("#sex_2").removeClass("on"); 
	$("#sex").val('��');
});
$("#sex_2").click(function(){
    $("#sex_2").addClass("on");
	$("#sex_1").removeClass("on");
	$("#sex").val('Ů');
});
</script>
 