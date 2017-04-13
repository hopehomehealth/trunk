<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?>
<style type="text/css">
td input{
	border:1px solid #efefef;
	padding:3px 5px 3px 5px;
}
</style>
<section class="m-frm-top">
    <div class="num"><span><?=$detail['adult_num']+$detail['kid_num']?>人</span>填写报名名单</div>
    <i class="line"></i> 
    <a href="javascript:history.back()" class="m-frm-top-btn" style="width:60px"> 返 回</a>
</section>

<form id="myform" method="post" action="do?ac=tourist_add" style="margin-top:10px"> 
<section class="container"> 
	<section class="m-frm-list ">   
		<li>    
			<table width="100%" class="table table-bordered " > 
			<?
			$n = 1;
			if(notnull($tourist)){
				foreach ($tourist as $val){ 
			?>
			<tr> 
				<tr><td>第<?=$n?>人</td><td><input type="text" name="name[]" style="width:90%"  value="<?=$val['user_name']?>" required placeholder="真实姓名"></td></tr>
				<tr><td>身份证</td><td><input type="text" name="idcard[]" style="width:90%"  value="<?=$val['user_idcard']?>" required placeholder="15或18位身份证号" required></td></tr>
				<tr><td>年龄</td><td><input type="number" name="age[]" value="<?=$val['user_age']?>" max="100" style="width:90%" placeholder="年龄"></td></tr>
			</tr>
			<tr><td colspan="2" style="border-bottom:1px solid #efefef"></td></tr>
			<?
				$n++;
				}
			}
			?>
			<?for($i=1;$i<=$detail['adult_num']+$detail['kid_num']-sizeof($tourist);$i++){?> 
			<tr> 
				<tr><td>第<?=$n?>人</td><td><input type="text" name="name[]" style="width:90%"  value="<?=$val['user_name']?>" required placeholder="姓名" placeholder="真实姓名"></td></tr>
				<tr><td>身份证</td><td><input type="text" name="idcard[]" style="width:90%"  value="<?=$val['user_idcard']?>" required placeholder="15或18位身份证号"></td></tr>
				<tr><td>年龄</td><td><input type="number" name="age[]" value="<?=$val['user_age']?>" max="100" style="width:90%" placeholder="年龄"></td></tr>
			</tr>
			<tr><td colspan="2" style="border-bottom:1px solid #efefef"></td></tr>
			<?
				$n++;
			}
			?>
			</table> 
			<input type="hidden" name="order_code" value="<?=req('order_code')?>">
			<input type="hidden" name="order_id" value="<?=req('order_id')?>">  
		</li> 
	</section>
	<div class="m-frm-foot">
		<div class="btn-group"> <input class="btn-add" type="submit" style="width:100%;border:0px;" value="确定"/> </div>
	</div>
</section>
</form>