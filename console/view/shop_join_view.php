<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?> 

<ul class="nav nav-tabs" id="myTab"> 
    <li class="active" style="padding-left:20px"><a href="#tabs-1">�̼�������Ϣ</a></li>
	<a href="javascript:void(0)" onclick="history.back()" class="pull-right btn btn-small">����</a>
</ul>
 
		<table width="100%" >
			<tr>
				<td style="width:180px">��˾���� <span style="color:red">*</span></td>
				<td><input type="text" name="company_name" class="span6" value="<?=$detail['company_name']?>" disabled ></td>
			</tr> 
			<tr>
				<td>���˴��� <span style="color:red">*</span></td>
				<td><input type="text" name="leader_name" class="span6" value="<?=$detail['leader_name']?>" disabled></td>
			</tr>
			<tr>
				<td>�������֤�� <span style="color:red">*</span></td>
				<td><input type="text" name="leader_card" class="span6" value="<?=$detail['leader_card']?>" disabled></td>
			</tr>
			<tr>
				<td>�������֤ɨ��� <span style="color:red">*</span></td>
				<td>
				<img src="http://<?=$g_site_domain?>/upfiles/<?=$g_siteid?>/<?=$detail['leader_card_file']?>" width="100"/>
				</td>
			</tr> 
			<tr>
				<td>��ϵ�� <span style="color:red">*</span></td>
				<td>
					<input type="text" name="linker" class="span4" value="<?=$detail['linker']?>" disabled>
					<select name="sex" class="span2" disabled>
						<option value="����">����
						<option value="Ůʿ">Ůʿ
					</select>
				</td>
			</tr>  
			<tr>
				<td >�ֻ��� <font color="red">*</font></td>
				<td><input id="mobile" name="mobile" type="text" size="35" class=" span6" pattern="^1[3-9]\d{9}$" value="<?=$detail['mobile']?>"   disabled></td>
			</tr>
			<tr>
				<td >�̶��绰</td>
				<td><input id="tel" name="tel" type="text" size="35" class=" span6" pattern="\d{3,4}-\d{7,8}|\d{3,4}-\d{7,8}-\d{2,5}" value="<?=$detail['tel']?>" disabled></td>
			</tr>
			<tr>
				<td >QQ��</td>
				<td><input id="qq" name="qq" type="number" size="35" class=" span6" value="<?=$detail['qq']?>" disabled></td>
			</tr> 
			<tr>
				<td >�����ʼ� <font color="red">*</font></td>
				<td><input id="email" name="email" type="email" size="35" class="span6 " value="<?=$detail['email']?>" disabled></td>
			</tr>
			<tr>
				<td>Ӫҵִ�� <span style="color:red">*</span></td>
				<td>
				<img src="http://<?=$g_site_domain?>/upfiles/<?=$g_siteid?>/<?=$detail['license_file']?>" width="100"/>
				</td>
			</tr>
			<tr>
				<td>��֯��������֤ <span style="color:red">*</span></td>
				<td>
				<img src="http://<?=$g_site_domain?>/upfiles/<?=$g_siteid?>/<?=$detail['cert_file']?>" width="100"/>
				</td>
			</tr>
			<tr>
				<td>˰��Ǽ�֤ <span style="color:red">*</span></td>
				<td>
				<img src="http://<?=$g_site_domain?>/upfiles/<?=$g_siteid?>/<?=$detail['tax_file']?>" width="100"/>
				</td>
			</tr> 
			<tr>
				<td>�������֤��� <span style="color:red">*</span></td>
				<td><input type="text" name="trip_code" class="span6" value="<?=$detail['trip_code']?>" disabled ></td>
			</tr>
			<tr>
				<td>������ҵ��Ӫ���֤ <span style="color:red">*</span></td>
				<td> 
				<img src="http://<?=$g_site_domain?>/upfiles/<?=$g_siteid?>/<?=$detail['trip_file']?>" width="100"/>
				</td>
			</tr>
			<tr>
				<td >&nbsp;</td>
				<td><input type="button" onclick="history.back()" value="�� ��" class="btn btn-info  "/></td>
			</tr>
		</table>
 