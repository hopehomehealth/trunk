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
			  <td><h4>���ų�����Ϣ</h4> �������ʣ����µ���ѯ��<b style="color:red"><?=$g_profile['hot_line']?></b>  </td>
			</tr>
			<tr>
			  <td><font color="red">*</font>�������У�</td>
			  <td><input type="text" id="start_city" name="start_city" value=""  />
				<span id="start_city_notice"> </span></td>
			</tr>
			<tr>
			  <td><font color="red">*</font>Ŀ�ĵأ�</td>
			  <td><div>
				  <textarea id="destination" name="destination" autocomplete="off" ></textarea>
				  <span id="destination_notice"> </span></div></td>
			</tr>
			<tr>
			  <td><font color="red">*</font>��������ڣ�</td>
			  <td><input type="text" placeholder="�����������" id="begin_start_date" name="begin_start_date"  value="<?=date('Y-m-d')?>"/>
				~
				<input type="text" placeholder="�����������" id="last_start_date" name="last_start_date" value="<?=date('Y-m-d')?>"/>
				<span id="date_notice"> </span></td>
			</tr>
			<tr>
			  <td><font color="red">*</font>���г�������</td>
			  <td><input type="text" id="duration_min" name="duration_min" class="span2"/>
				��~
				<input type="text" id="duration_max" name="duration_max" class="span2"/>
				��<span id="duration_notice"> </span></td>
			</tr>
			<tr>
			  <td><font color="red">*</font>�����������</td>
			  <td><input type="text" id="tourist_num_min" name="tourist_num_min" class="span2"/>
				��~
				<input type="text" id="tourist_num_max" name="tourist_num_max" class="span2"/>
				��<span id="tourist_num_notice">���Ŷ���������8��ʱ�۸���Խϸߣ���������Ԥ��ɢ�Ͳ�Ʒ��绰��ѯ��</span></td>
			</tr>
			<tr>
			  <td><font color="red">*</font>�����Ԥ�㣺</td>
			  <td><input type="text" id="spend_min" name="spend_min" class="span2"/>
				Ԫ/��~
				<input type="text" id="spend_max" name="spend_max" class="span2"/>
				Ԫ/��<span id="spend_notice"> </span></td>
			</tr>
			<tr>
			  <td>ס��Ҫ��</td>
			  <td><input type="radio" checked="checked" name="house_type" onclick="$('#hotelname').attr('disabled','disabled');" id="zsNum1" value="1" />
				������
				<input type="radio" name="house_type" onclick="$('#hotelname').attr('disabled','disabled');" id="zsNum2" value="2" />
				���Ǽ�
				<input type="radio" name="house_type" onclick="$('#hotelname').attr('disabled','disabled');" id="zsNum3" value="3" />
				���Ǽ�
				<input type="radio" name="house_type" onclick="$('#hotelname').attr('disabled','disabled');" id="zsNum4" value="4" />
				���Ǽ�
				<input type="radio" name="house_type" onclick="$('#hotelname').attr('disabled','disabled');" id="zsNum5" value="5" />
				���ð���
				<input type="radio" name="house_type" onclick="$('#hotelname').val('');$('#hotelname').removeAttr('disabled');" id="zsNum6" value="6" />
				����ָ���Ƶ�
				<input id="hotelname" type="text" value="������Ƶ�����" disabled="disabled" name="hotelname" />
			  </td>
			</tr>
			<tr>
			  <td>���鰲�ţ�</td>
			  <td><input id="meet1" type="radio" checked="checked" name="meeting_type" value="0" />
				����Ҫ
				<input id="meet2" type="radio" name="meeting_type" value="1" />
				��Ҫ</td>
			</tr>
			<tr>
			  <td>����Ҫ��</td>
			  <td><textarea id="other_require" name="other_require" class="span6" style="height:100px"></textarea>
			  </td>
			</tr>
			<tr>
			  <td>&nbsp;</td>
			  <td><h4>��ϵ��Ϣ</h4></td>
			</tr>
			<tr>
			  <td><font color="red">*</font>��ϵ�ˣ�</td>
			  <td><input id="linker" name="linker" value="" type="text" />
				<span id="contact_notice"> </span></td>
			</tr>
			<tr>
			  <td><font color="red">*</font>�ֻ����룺</td>
			  <td><input type="text" id="mobile" name="mobile" /> </td>
			</tr>
			<tr>
			  <td>�̶��绰��</td>
			  <td><input type="text" id="phone_code" name="phone_code" placeholder="����" class="span2"/>
				-
				<input type="text" id="phone_num" name="phone_num" placeholder="�绰����" />
			  </td>
			</tr>
			<tr>
			  <td><font color="red">*</font>���䣺</td>
			  <td><input type="text" id="email" name="email" placeholder="�������������г̰���" />
				<span id="email_notice"> </span></td>
			</tr>
			<tr>
			  <td>�������ʣ�</td>
			  <td><input type="radio" checked="checked" name="company_type" value="1" />
				��˾��֯
				<input type="radio" name="company_type" value="2" />
				������֯</td>
			</tr>
			<tr>
			  <td>��˾���ƣ�</td>
			  <td><input type="text" id="company_name" name="company_name" placeholder="���˿ɲ���д" />
			  </td>
			</tr>
			<tr>
			  <td> </td>
			  <td>
			  <input type="text" id="rand_code" name="rand_code" placeholder="��֤��..." class="span2" style="height:30px;font-weight:bold;text-transform:uppercase"/>

			  <img src="/member/libs/vcode/code.php" onclick="javascript:this.src='/member/libs/vcode/code.php?tm='+Math.random();"  style="border:1px solid #ccc;padding:3px;height:32px;margin-top:-10px;"/>
			  </td>
			</tr>
			<tr>
			  <td><input type="hidden" name="hash" value="<?=md5('CUSTOMIZED'.date('YmdH'))?>"/></td>
			  <td><input name="submit" type="submit" value="�ύ����" class="btn btn-large btn-warning"/>
			  </td>
			</tr>
		  </table>
	</form> 
</div> 
