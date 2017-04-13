<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?> 

<ul class="nav nav-tabs" id="myTab"> 
    <li class="active" style="padding-left:20px"><a href="#tabs-1">商家申请信息</a></li>
	<a href="javascript:void(0)" onclick="history.back()" class="pull-right btn btn-small">返回</a>
</ul>
 
		<table width="100%" >
			<tr>
				<td style="width:180px">公司名称 <span style="color:red">*</span></td>
				<td><input type="text" name="company_name" class="span6" value="<?=$detail['company_name']?>" disabled ></td>
			</tr> 
			<tr>
				<td>法人代表 <span style="color:red">*</span></td>
				<td><input type="text" name="leader_name" class="span6" value="<?=$detail['leader_name']?>" disabled></td>
			</tr>
			<tr>
				<td>法人身份证号 <span style="color:red">*</span></td>
				<td><input type="text" name="leader_card" class="span6" value="<?=$detail['leader_card']?>" disabled></td>
			</tr>
			<tr>
				<td>法人身份证扫描件 <span style="color:red">*</span></td>
				<td>
				<img src="http://<?=$g_site_domain?>/upfiles/<?=$g_siteid?>/<?=$detail['leader_card_file']?>" width="100"/>
				</td>
			</tr> 
			<tr>
				<td>联系人 <span style="color:red">*</span></td>
				<td>
					<input type="text" name="linker" class="span4" value="<?=$detail['linker']?>" disabled>
					<select name="sex" class="span2" disabled>
						<option value="先生">先生
						<option value="女士">女士
					</select>
				</td>
			</tr>  
			<tr>
				<td >手机号 <font color="red">*</font></td>
				<td><input id="mobile" name="mobile" type="text" size="35" class=" span6" pattern="^1[3-9]\d{9}$" value="<?=$detail['mobile']?>"   disabled></td>
			</tr>
			<tr>
				<td >固定电话</td>
				<td><input id="tel" name="tel" type="text" size="35" class=" span6" pattern="\d{3,4}-\d{7,8}|\d{3,4}-\d{7,8}-\d{2,5}" value="<?=$detail['tel']?>" disabled></td>
			</tr>
			<tr>
				<td >QQ号</td>
				<td><input id="qq" name="qq" type="number" size="35" class=" span6" value="<?=$detail['qq']?>" disabled></td>
			</tr> 
			<tr>
				<td >电子邮件 <font color="red">*</font></td>
				<td><input id="email" name="email" type="email" size="35" class="span6 " value="<?=$detail['email']?>" disabled></td>
			</tr>
			<tr>
				<td>营业执照 <span style="color:red">*</span></td>
				<td>
				<img src="http://<?=$g_site_domain?>/upfiles/<?=$g_siteid?>/<?=$detail['license_file']?>" width="100"/>
				</td>
			</tr>
			<tr>
				<td>组织机构代码证 <span style="color:red">*</span></td>
				<td>
				<img src="http://<?=$g_site_domain?>/upfiles/<?=$g_siteid?>/<?=$detail['cert_file']?>" width="100"/>
				</td>
			</tr>
			<tr>
				<td>税务登记证 <span style="color:red">*</span></td>
				<td>
				<img src="http://<?=$g_site_domain?>/upfiles/<?=$g_siteid?>/<?=$detail['tax_file']?>" width="100"/>
				</td>
			</tr> 
			<tr>
				<td>旅游许可证编号 <span style="color:red">*</span></td>
				<td><input type="text" name="trip_code" class="span6" value="<?=$detail['trip_code']?>" disabled ></td>
			</tr>
			<tr>
				<td>旅行社业务经营许可证 <span style="color:red">*</span></td>
				<td> 
				<img src="http://<?=$g_site_domain?>/upfiles/<?=$g_siteid?>/<?=$detail['trip_file']?>" width="100"/>
				</td>
			</tr>
			<tr>
				<td >&nbsp;</td>
				<td><input type="button" onclick="history.back()" value="返 回" class="btn btn-info  "/></td>
			</tr>
		</table>
 