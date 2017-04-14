<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?>


<div class="bar_title"> <strong>申请加盟</strong> </div>

<?
if($state == '-1' || $state==''){
?>
<?
if($state == '-1'){
?>
<div class="alert">
	<strong>亲！</strong>您的申请审核<strong style="color:red">未通过</strong>，理由： 
	<strong style="color:red"><?=$join['unpass_note']?></strong> 
	请重新提交资料！
</div>
<?}?>

<form id="myform" method="post" action="do?ac=union_join" enctype="multipart/form-data">
	<table width="100%" >
		<tr>
			<td style="width:180px">公司名称 <span style="color:red">*</span></td>
			<td><input type="text" name="company_name" class="span6" value="<?=$detail['company_name']?>" placeholder="公司全称，如：上海途牛国际旅行社有限公司..." required></td>
		</tr> 
		<tr>
			<td>法人代表 <span style="color:red">*</span></td>
			<td><input type="text" name="leader_name" class="span6" value="<?=$detail['leader_name']?>" placeholder="如：张三..." required></td>
		</tr>
		<tr>
			<td>法人身份证号 <span style="color:red">*</span></td>
			<td><input type="text" name="leader_card" class="span6" value="<?=$detail['leader_card']?>" placeholder="15或18位身份证号码..."required></td>
		</tr>
		<tr>
			<td>法人身份证扫描件 <span style="color:red">*</span></td>
			<td><input type="file" name="leader_card_file" required></td>
		</tr> 
		<tr>
			<td>联系人 <span style="color:red">*</span></td>
			<td>
				<input type="text" name="linker" class="span4" value="<?=$detail['linker']?>" placeholder="如：李四..." required>
				<select name="sex" class="span2" required>
					<option value="先生" <?if($detail['sex']=='先生') echo 'selected';?>>先生
					<option value="女士" <?if($detail['sex']=='女士') echo 'selected';?>>女士
				</select>
			</td>
		</tr>  
		<tr>
			<td >手机号 <font color="red">*</font></td>
			<td><input id="mobile" name="mobile" type="text" size="35" class=" span6" pattern="^1[3-9]\d{9}$" value="<?=$detail['mobile']?>" maxlength="11" placeholder="手机号..." required></td>
		</tr>
		<tr>
			<td >固定电话</td>
			<td><input id="tel" name="tel" type="text" size="35" class=" span6" pattern="\d{3,4}-\d{7,8}|\d{3,4}-\d{7,8}-\d{2,5}" value="<?=$detail['tel']?>" placeholder="固定电话..." maxlength="20"></td>
		</tr>
		<tr>
			<td >QQ号</td>
			<td><input id="qq" name="qq" type="number" size="35" class=" span6" placeholder="QQ号..."  value="<?=$detail['qq']?>"></td>
		</tr> 
		<tr>
			<td >电子邮件 <font color="red">*</font></td>
			<td><input id="email" name="email" type="email" size="35" placeholder="电子邮件..." class="span6 " value="<?=$detail['email']?>" required></td>
		</tr>
		<tr>
			<td>营业执照 <span style="color:red">*</span></td>
			<td><input type="file" name="license_file" required></td>
		</tr>
		<tr>
			<td>组织机构代码证 <span style="color:red">*</span></td>
			<td><input type="file" name="cert_file" required></td>
		</tr>
		<tr>
			<td>税务登记证 <span style="color:red">*</span></td>
			<td><input type="file" name="tax_file" required></td>
		</tr> 
		<tr>
			<td>旅游许可证编号 <span style="color:red">*</span></td>
			<td><input type="text" name="trip_code" class="span6" placeholder="旅行社业务经营许可证编号，如：L-SH-CJ00107..." value="<?=$detail['trip_code']?>" required></td>
		</tr>
		<tr>
			<td>旅行社业务经营许可证 <span style="color:red">*</span></td>
			<td><input type="file" name="trip_file" required></td>
		</tr>
		<tr>
			<td >&nbsp;</td>
			<td><br/><input type="submit" value="提交申请" class="btn btn-info  "/></td>
		</tr>
	</table>
</form>
<?}?> 

<?
if($state == '0'){
?>
<div class="alert alert-info">
	<h5><strong>亲！</strong>您的申请已经提交，正在审核中，请稍后查询反馈结果！</h5>
</div>
<?}?>

<?
if($state == '1'){
?>
<div class="alert alert-success">
	<h5><strong>亲！</strong>您的申请已经审核通过，请登录<a href="/seller/" target="_blank">商家管理中心</a>！</h5>
</div>
<?}?>