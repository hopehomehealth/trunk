<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?>


<div class="bar_title"> <strong>�������</strong> </div>

<?
if($state == '-1' || $state==''){
?>
<?
if($state == '-1'){
?>
<div class="alert">
	<strong>�ף�</strong>�����������<strong style="color:red">δͨ��</strong>�����ɣ� 
	<strong style="color:red"><?=$join['unpass_note']?></strong> 
	�������ύ���ϣ�
</div>
<?}?>

<form id="myform" method="post" action="do?ac=union_join" enctype="multipart/form-data">
	<table width="100%" >
		<tr>
			<td style="width:180px">��˾���� <span style="color:red">*</span></td>
			<td><input type="text" name="company_name" class="span6" value="<?=$detail['company_name']?>" placeholder="��˾ȫ�ƣ��磺�Ϻ�;ţ�������������޹�˾..." required></td>
		</tr> 
		<tr>
			<td>���˴��� <span style="color:red">*</span></td>
			<td><input type="text" name="leader_name" class="span6" value="<?=$detail['leader_name']?>" placeholder="�磺����..." required></td>
		</tr>
		<tr>
			<td>�������֤�� <span style="color:red">*</span></td>
			<td><input type="text" name="leader_card" class="span6" value="<?=$detail['leader_card']?>" placeholder="15��18λ���֤����..."required></td>
		</tr>
		<tr>
			<td>�������֤ɨ��� <span style="color:red">*</span></td>
			<td><input type="file" name="leader_card_file" required></td>
		</tr> 
		<tr>
			<td>��ϵ�� <span style="color:red">*</span></td>
			<td>
				<input type="text" name="linker" class="span4" value="<?=$detail['linker']?>" placeholder="�磺����..." required>
				<select name="sex" class="span2" required>
					<option value="����" <?if($detail['sex']=='����') echo 'selected';?>>����
					<option value="Ůʿ" <?if($detail['sex']=='Ůʿ') echo 'selected';?>>Ůʿ
				</select>
			</td>
		</tr>  
		<tr>
			<td >�ֻ��� <font color="red">*</font></td>
			<td><input id="mobile" name="mobile" type="text" size="35" class=" span6" pattern="^1[3-9]\d{9}$" value="<?=$detail['mobile']?>" maxlength="11" placeholder="�ֻ���..." required></td>
		</tr>
		<tr>
			<td >�̶��绰</td>
			<td><input id="tel" name="tel" type="text" size="35" class=" span6" pattern="\d{3,4}-\d{7,8}|\d{3,4}-\d{7,8}-\d{2,5}" value="<?=$detail['tel']?>" placeholder="�̶��绰..." maxlength="20"></td>
		</tr>
		<tr>
			<td >QQ��</td>
			<td><input id="qq" name="qq" type="number" size="35" class=" span6" placeholder="QQ��..."  value="<?=$detail['qq']?>"></td>
		</tr> 
		<tr>
			<td >�����ʼ� <font color="red">*</font></td>
			<td><input id="email" name="email" type="email" size="35" placeholder="�����ʼ�..." class="span6 " value="<?=$detail['email']?>" required></td>
		</tr>
		<tr>
			<td>Ӫҵִ�� <span style="color:red">*</span></td>
			<td><input type="file" name="license_file" required></td>
		</tr>
		<tr>
			<td>��֯��������֤ <span style="color:red">*</span></td>
			<td><input type="file" name="cert_file" required></td>
		</tr>
		<tr>
			<td>˰��Ǽ�֤ <span style="color:red">*</span></td>
			<td><input type="file" name="tax_file" required></td>
		</tr> 
		<tr>
			<td>�������֤��� <span style="color:red">*</span></td>
			<td><input type="text" name="trip_code" class="span6" placeholder="������ҵ��Ӫ���֤��ţ��磺L-SH-CJ00107..." value="<?=$detail['trip_code']?>" required></td>
		</tr>
		<tr>
			<td>������ҵ��Ӫ���֤ <span style="color:red">*</span></td>
			<td><input type="file" name="trip_file" required></td>
		</tr>
		<tr>
			<td >&nbsp;</td>
			<td><br/><input type="submit" value="�ύ����" class="btn btn-info  "/></td>
		</tr>
	</table>
</form>
<?}?> 

<?
if($state == '0'){
?>
<div class="alert alert-info">
	<h5><strong>�ף�</strong>���������Ѿ��ύ����������У����Ժ��ѯ���������</h5>
</div>
<?}?>

<?
if($state == '1'){
?>
<div class="alert alert-success">
	<h5><strong>�ף�</strong>���������Ѿ����ͨ�������¼<a href="/seller/" target="_blank">�̼ҹ�������</a>��</h5>
</div>
<?}?>