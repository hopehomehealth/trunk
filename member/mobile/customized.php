<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?> 
<script language="javascript">
$(document).ready(function() {
	$("#myform").validationEngine();
});
</script> 
 

<div style="font-size:14px;line-height:1.9;">
	<form action="/member/do?ac=customized" method="post" >
		<table >
			<tr>
			  <td>&nbsp;</td>
			  <td><h4>包团出游信息</h4> 如有疑问，请致电咨询：<b style="color:red"><?=$g_profile['hot_line']?></b>  </td>
			</tr>
			<tr>
			  <td><font color="red">*</font>出发城市：</td>
			  <td><input type="text" id="start_city" name="start_city" value=""  />
				<span id="start_city_notice"> </span></td>
			</tr>
			<tr>
			  <td><font color="red">*</font>目的地：</td>
			  <td><div>
				  <textarea id="destination" name="destination" autocomplete="off" ></textarea>
				  <span id="destination_notice"> </span></div></td>
			</tr>
			<tr>
			  <td><font color="red">*</font>拟出发日期：</td>
			  <td><input type="text" placeholder="最早出发日期" id="begin_start_date" name="begin_start_date"  value="<?=date('Y-m-d')?>"/>
				~
				<input type="text" placeholder="最晚出发日期" id="last_start_date" name="last_start_date" value="<?=date('Y-m-d')?>"/>
				<span id="date_notice"> </span></td>
			</tr>
			<tr>
			  <td><font color="red">*</font>拟行程天数：</td>
			  <td><input type="text" id="duration_min" name="duration_min" class="span2"/>
				天~
				<input type="text" id="duration_max" name="duration_max" class="span2"/>
				天<span id="duration_notice"> </span></td>
			</tr>
			<tr>
			  <td><font color="red">*</font>拟出游人数：</td>
			  <td><input type="text" id="tourist_num_min" name="tourist_num_min" class="span2"/>
				人~
				<input type="text" id="tourist_num_max" name="tourist_num_max" class="span2"/>
				人<span id="tourist_num_notice">当团队人数不足8人时价格相对较高，建议您可预订散客产品或电话咨询。</span></td>
			</tr>
			<tr>
			  <td><font color="red">*</font>拟出游预算：</td>
			  <td><input type="text" id="spend_min" name="spend_min" class="span2"/>
				元/人~
				<input type="text" id="spend_max" name="spend_max" class="span2"/>
				元/人<span id="spend_notice"> </span></td>
			</tr>
			<tr>
			  <td>住宿要求：</td>
			  <td><input type="radio" checked="checked" name="house_type" onclick="$('#hotelname').attr('disabled','disabled');" id="zsNum1" value="1" />
				经济型
				<input type="radio" name="house_type" onclick="$('#hotelname').attr('disabled','disabled');" id="zsNum2" value="2" />
				三星级
				<input type="radio" name="house_type" onclick="$('#hotelname').attr('disabled','disabled');" id="zsNum3" value="3" />
				四星级
				<input type="radio" name="house_type" onclick="$('#hotelname').attr('disabled','disabled');" id="zsNum4" value="4" />
				五星级
				<input type="radio" name="house_type" onclick="$('#hotelname').attr('disabled','disabled');" id="zsNum5" value="5" />
				不用安排
				<input type="radio" name="house_type" onclick="$('#hotelname').val('');$('#hotelname').removeAttr('disabled');" id="zsNum6" value="6" />
				安排指定酒店
				<input id="hotelname" type="text" value="请输入酒店名称" disabled="disabled" name="hotelname" />
			  </td>
			</tr>
			<tr>
			  <td>会议安排：</td>
			  <td><input id="meet1" type="radio" checked="checked" name="meeting_type" value="0" />
				不需要
				<input id="meet2" type="radio" name="meeting_type" value="1" />
				需要</td>
			</tr>
			<tr>
			  <td>其他要求：</td>
			  <td><textarea id="other_require" name="other_require" class="span6" style="height:100px"></textarea>
			  </td>
			</tr>
			<tr>
			  <td>&nbsp;</td>
			  <td><h4>联系信息</h4></td>
			</tr>
			<tr>
			  <td><font color="red">*</font>联系人：</td>
			  <td><input id="linker" name="linker" value="" type="text" />
				<span id="contact_notice"> </span></td>
			</tr>
			<tr>
			  <td><font color="red">*</font>手机号码：</td>
			  <td><input type="text" id="mobile" name="mobile" /> </td>
			</tr>
			<tr>
			  <td>固定电话：</td>
			  <td><input type="text" id="phone_code" name="phone_code" placeholder="区号" class="span2"/>
				-
				<input type="text" id="phone_num" name="phone_num" placeholder="电话号码" />
			  </td>
			</tr>
			<tr>
			  <td><font color="red">*</font>邮箱：</td>
			  <td><input type="text" id="email" name="email" placeholder="可以向您发送行程安排" />
				<span id="email_notice"> </span></td>
			</tr>
			<tr>
			  <td>出游性质：</td>
			  <td><input type="radio" checked="checked" name="company_type" value="1" />
				公司组织
				<input type="radio" name="company_type" value="2" />
				个人组织</td>
			</tr>
			<tr>
			  <td>公司名称：</td>
			  <td><input type="text" id="company_name" name="company_name" placeholder="个人可不填写" />
			  </td>
			</tr>
			<tr>
			  <td> </td>
			  <td>
			  <input type="text" id="rand_code" name="rand_code" placeholder="验证码..." class="span2" style="height:30px;font-weight:bold;text-transform:uppercase"/>

			  <img src="/member/libs/vcode/code.php" onclick="javascript:this.src='/member/libs/vcode/code.php?tm='+Math.random();"  style="border:1px solid #ccc;padding:3px;height:32px;margin-top:-10px;"/>
			  </td>
			</tr>
			<tr>
			  <td><input type="hidden" name="hash" value="<?=md5('CUSTOMIZED'.date('YmdH'))?>"/></td>
			  <td><input name="submit" type="submit" value="提交需求" class="btn btn-large btn-warning"/>
			  </td>
			</tr>
		  </table>
	</form> 
</div> 
