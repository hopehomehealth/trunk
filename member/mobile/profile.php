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
				<div class="mod-gender"> <span class="label">性别</span> <span class="item <?if($profile['sex']=='男'){?>on<?}?>" data-gender="1" id="sex_1"><i class="male"></i>男生</span> <span class="item <?if($profile['sex']=='女'){?>on<?}?>" data-gender="0" id="sex_2"><i class="female"></i>女性</span> </div>
				<div class="streak"></div>
				<div class="m-frm-div">
					<h2>联系方式<span>以下方式请至少添一项</span></h2>
					<ul class="bd">
						<li>
							<input name="username" type="text" value="<?=$profile['username']?>"  placeholder="姓名">
						</li>
						<li>
							<input name="nickname" type="text" value="<?=$profile['nickname']?>" placeholder="签名">
						</li>
						<li>
							<input name="mobile" type="number" value="<?=$profile['mobile']?>" placeholder="手机号">
						</li> 
						<li>
							<input name="email" type="email" value="<?=$profile['email']?>" placeholder="常用邮件">
						</li>
						<li>
							<input name="birthday" type="date" value="<?=$profile['birthday']?>" placeholder="生日">
						</li>
						<li>
							<input name="qq" type="number" placeholder="QQ号">
						</li>
					</ul>
				</div>
				<div class="streak"></div>
				<div class="m-frm-body">
					<h2>个人简介</h2>
					<div class="bd">
						<textarea class="_j_note" rows="5" placeholder="分享一下你的精彩人生..."></textarea>
						<p class="_j_error hide">超过<span class="char err">20</span>字</p>
					</div>
				</div>
				<div style="height: 200px;"></div>
			</div>
		</section>
		<div class="m-frm-foot">
			<div class="btn-group"> <input class="btn-add" type="submit" style="width:100%;border:0px;" value="确定"/> </div>
		</div>
	</section> 
</form>   

<script type="text/javascript">
$("#sex_1").click(function(){
    $("#sex_1").addClass("on");
	$("#sex_2").removeClass("on"); 
	$("#sex").val('男');
});
$("#sex_2").click(function(){
    $("#sex_2").addClass("on");
	$("#sex_1").removeClass("on");
	$("#sex").val('女');
});
</script>
 