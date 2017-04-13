<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?>

<script type="text/javascript" src="static/js/ludo-jquery-treetable/jquery.treetable.js"></script> 
<link rel="stylesheet" href="static/js/ludo-jquery-treetable/css/jquery.treetable.css" />
<link rel="stylesheet" href="static/js/ludo-jquery-treetable/css/jquery.treetable.theme.default.css" />
  

<script type="text/javascript">
KindEditor.ready(function(K) {
	var editor1 = K.create('textarea[name="summary"]', {
		cssPath : 'js/kindeditor/plugins/code/prettify.css',
		uploadJson : 'util/ke_upload_json.php',
		fileManagerJson : 'util/ke_file_manager_json.php',
		allowFileManager : true,
		items : [
						'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
						'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
						'insertunorderedlist', '|', 'emoticons', 'image', 'link'],
		urlType : 'domain',
		afterCreate : function() {
			var self = this;
			K.ctrl(document, 13, function() {
				self.sync();
				K('form[name=goods_form]')[0].submit();
			});
			K.ctrl(self.edit.doc, 13, function() {
				self.sync();
				K('form[name=goods_form]')[0].submit();
			});
		}
	});
	prettyPrint();
});
KindEditor.ready(function(K) {
	var editor1 = K.create('textarea[name="goods_content"]', {
		cssPath : 'js/kindeditor/plugins/code/prettify.css',
		uploadJson : 'util/ke_upload_json.php',
		fileManagerJson : 'util/ke_file_manager_json.php',
		allowFileManager : true,
		urlType : 'domain',
		afterCreate : function() {
			var self = this;
			K.ctrl(document, 13, function() {
				self.sync();
				K('form[name=goods_form]')[0].submit();
			});
			K.ctrl(self.edit.doc, 13, function() {
				self.sync();
				K('form[name=goods_form]')[0].submit();
			});
		}
	});
	prettyPrint();
}); 
</script>


<script type="text/javascript"> 
function form_check(){
	var myform = document.getElementById('goods_form');
 
	if(myform.goods_cat_id.value==''){
		alert('�Բ�����ѡ����࣡');
		return false;
	}
	if(myform.goods_name.value==''){
		alert('�Բ����������Ʒ���ƣ�');
		return false;
	} 
	if(myform.goods_image.value==''){
		alert('�Բ������ϴ���Ʒ��ͼ��');
		return false;
	} 
	if(myform.line_days.value==''){
		alert('�Բ����������г�������');
		return false;
	}   
}
</script>   

<script type="text/javascript">
$(document).ready(function(){
	$('#myTab a').click(function (e) { 
		e.preventDefault();
		$(this).tab('show'); 
	})
}); 
</script>

<form id="goods_form" name="goods_form" action="do.php?cmd=goods_add" method="post" enctype="multipart/form-data" target="frm" onsubmit="return form_check()"> 
<input type="hidden" name="goods_cat_id" value="<?=req('cat_id')?>"> 
<input type="hidden" name="goods_type" value="<?=$c_goods_type?>">

<ul class="nav nav-tabs" id="myTab"> 
  <li class="active" style="padding-left:20px"><a href="#tabs-1">ѡ�����</a></li>
  <li><a href="#tabs-2">������Ϣ</a></li>
  <li><a href="#tabs-3">��ƷͼƬ</a></li>
  <li><a href="#tabs-4">��Ʒ����</a></li>
  <li><a href="#tabs-5">����/�۸�</a></li> 
  <input type="button" value=" ���� " class="btn pull-right" onclick="history.back()" style="margin-left:5px"/>
  <input type="submit" value=" ����<?=$g_product_type[$c_goods_type]?> " class="btn pull-right btn-warning"/>
</ul>

<div class="tab-content"> 
	<div class="tab-pane in active" id="tabs-1">   
			<div class="alert"><strong>��ʾ��</strong>��չ������ķ��࣬ѡ��������Ҫ�������ӷ��ࡣ</div>
			<?
			$cat01 = son_cat('0');
			if(notnull($cat01)){
			?>
			<table class="table table-hover" id="mytab">  
			  <?   
			  if(notnull($cat01)){
				  foreach ($cat01 as $val01){   
					  echo get_cat_html($val01, -1); 
					  
					  $cat02 = son_cat($val01['cat_id']);
					  if(notnull($cat02)){
						  foreach ($cat02 as $val02){   
							  echo get_cat_html($val02, 0);
							
							  $cat03 = son_cat($val02['cat_id']);
							  if(notnull($cat03)){
								  foreach ($cat03 as $val03){   
									  echo get_cat_html($val03, 1); 
								  }
							  }
						  }
					  }
				  }
			  }
			  ?>
			</table> 
			<?}?> 
			<?
			function get_cat_html($val, $level){ 
				global $goods;
			?>
			  <tbody>  
			  <tr data-tt-id="<?=$val['cat_id']?>" <?if($val['parent_id']>0){?>data-tt-parent-id="<?=$val['parent_id']?>"<?}?> >  
				<td onclick="autoFrame();"><?=$val['cat_name']?></td>    
				<td style="width:60px">
				<?if(has_son_cat($val['cat_id'])==false){?>
				<label><input type="radio" name="goods_cat_id" value="<?=$val['cat_id']?>"> ѡ��</label>
				<?}?>
				</td>
			  </tr>
			  </tbody> 
			<?
			}
			?> 
			<script type="text/javascript"> 
			$("#mytab").treetable({ expandable: true }); 
			</script>
	</div> 
	<div class="tab-pane" id="tabs-2">   
		<table width="100%">  
		    <tr>
			  <td width="90" align="right">�̼ң�</td>
			  <td><select name="shop_id" id="shop_id" class="span6">
				  <option value=""></option>
				  <?  
				  if(notnull($shop_list)){ 
					  foreach ($shop_list as $val){    	
				  ?>
				  <option value="<?=$val['shop_id']?>">
				  <?=$val['shop_name']?>
				  </option>
				  <?
					  }	
				  }
				  ?>
				</select>
			  </td>
			</tr> 
			<tr>
			  <td align="right"><font color="red">*</font> ��Ʒ���ƣ�</td>
			  <td><input name="goods_name" type="text" class="span6" id="goods_name" size="50"/></td>
			</tr>
			<tr>
			  <td align="right"><font color="red">*</font> ��Ʒ���룺</td>
			  <td><input name="goods_code" type="text" class="span6" id="goods_code" size="50" value="<?=strtoupper(uniqid())?>"/></td>
			</tr>
			<tr>
			  <td align="right"> ��Ʒ������</td>
			  <td><input name="goods_doc" type="text" class="span6" id="goods_doc" size="80" placeholder="�ڲ����ƣ���������ʾ"/></td>
			</tr>
			<tr>
			  <td align="right"><font color="red">*</font> �������ͣ�</td>
			  <td height="30">
				<label class="radio inline">
				<input name="sale_type" type="radio" id="sale_type" value="0" checked onclick="document.getElementById('sale_date').style.display='none'"/>
				����
				</label>
				<label class="radio inline">
				<input name="sale_type" type="radio" id="sale_type" value="1" onclick="document.getElementById('sale_date').style.display='block'" />
				�Ź�
				</label>
				<label class="radio inline">
				<input name="sale_type" type="radio" id="sale_type" value="2" onclick="document.getElementById('sale_date').style.display='block'" />
				��ɱ 
				</label>
				<table id="sale_date" style="display:none">
					<tr>
						<td>������ʼ���ڣ�</td>
						<td><input id="sale_start" name="sale_start" class="Wdate" type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" style="background:none;"> �Ź�/��ɱ����</td>
					</tr>
					<tr>
						<td>���۽������ڣ�</td>
						<td><input id="sale_end" name="sale_end" class="Wdate" type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" style="background:none"> �Ź�/��ɱ����</td>
					</tr>
				</table>
				</td>
			</tr> 
			
			<?if(in_array($c_goods_type, array(1,2))){?>
			<tr>
			  <td align="right"><font color="red">*</font>�������ͣ�</td>
			  <td>
				<?foreach ($g_product_zone as $k => $v) {?> 
				<label class="radio inline">
				<input name="goods_zone" type="radio" value="<?=$k?>">
				<?=$v?></label>
				<?}?>  
			  </td>
			</tr>  
			<tr>
			  <td align="right"><font color="red">*</font> �������У�</td>
			  <td><select id="src_prov" name="src_prov" class="span2" >
				</select>
				<select id="src_city" name="src_city" class="span2">
				</select>
				<script language="javascript">  
					new PCAS("src_prov","src_city","","");
				</script> 
			  </td>
			</tr>
			<tr>
			  <td align="right"><font color="red">*</font> Ŀ�ĳ��У�</td>
			  <td> 
				<select id="dist_prov" name="dist_prov" class="span2" >
				</select>
				<select id="dist_city" name="dist_city" class="span2">
				</select>
				<script language="javascript">  
					new PCAS("dist_prov","dist_city","","");
				</script>
			  </td>
			</tr>
			<tr>
			  <td align="right"><font color="red">*</font> ��ͨ��</td>
			  <td><select name="goto_transport" class="span2">
				  <option value=""> ȥ�� >> </option>
				  <?foreach ($g_product_road as $k => $v) {?>
				  <option value="<?=$k?>"><?=$v?></option>
				  <?}?> 
				</select>
		 
				<select name="back_transport" class="span2">
				  <option value=""> ���� << </option>
				  <?foreach ($g_product_road as $k => $v) {?>
				  <option value="<?=$k?>"><?=$v?></option>
				  <?}?> 
				</select>
			  </td>
			</tr>  
			<tr>
			  <td align="right">�����ǩ��</td>
			  <td>
				<?foreach ($g_product_tag as $k => $v) {?> 
				<label class="inline checkbox">
				<input type="checkbox" name="line_tag[]"  value="<?=$k?>"/>
				<?=$v?></label>
				<?}?>  
			  </td>
			</tr> 
			<?}?>

			<?if(in_array($c_goods_type, array(3))){?>
			<tr>
			  <td align="right"><font color="red">*</font>�������ң�</td>
			  <td>  
			    <?foreach ($visa_zone_list as $val) {?> 
				<label class="radio inline">
				<input name="visa_zone_id" type="radio" value="<?=$val['zone_id']?>">
				<?=$val['zone_name']?></label>
				<?}?> 
			  </td>
			</tr> 
			<tr>
			  <td align="right"><font color="red">*</font>ǩ֤���ͣ�</td>
			  <td>  
			    <?foreach ($g_visa_type as $k => $v) {?> 
				<label class="radio inline">
				<input name="visa_type" type="radio" value="<?=$k?>">
				<?=$v?></label>
				<?}?> 
			  </td>
			</tr> 
			<tr>
			  <td align="right"><font color="red">*</font>ǩ֤������</td>
			  <td>  
			    <table width="100%">
			    <tr>
					<td>��ǩ�أ�</td>
					<td><input type="text" name="visa[SQD]" placeholder="�Ϻ�"></td>
					<td>�뾳������</td>
					<td><input type="text" name="visa[RJCS]" placeholder="һ��"></td>
			    </tr>
			    <tr>
					<td>��Ч�ڣ�</td>
					<td><input type="text" name="visa[YXQ]" placeholder="3����"></td>
					<td>�Ƿ����ԣ�</td>
					<td><input type="text" name="visa[SFMS]" placeholder="��"></td>
			    </tr>
			    <tr>
					<td>�Ƿ���¼ָ�ƣ�</td>
					<td><input type="text" name="visa[SFXLZW]" placeholder="��"></td>
					<td>�Ƿ���ǩ��</td>
					<td><input type="text" name="visa[SFXQ]" placeholder="��"></td>
			    </tr>
			    <tr>
					<td>�Ƿ��赣����</td>
					<td><input type="text" name="visa[SFXDBJ]" placeholder="��"></td>
					<td>�ͣ��ʱ�䣺</td>
					<td><input type="text" name="visa[ZCTLSJ]" placeholder="��"></td>
			    </tr>
				<tr>
					<td>�������ڣ�</td>
					<td colspan="3"><input type="text" name="visa[BLZQ]" placeholder="��ǩ���8��������">�����������ʱ��Ϊ׼�������������</td> 
			    </tr> 
				<tr> 
					<td>����Χ��</td>
					<td colspan="3">
					<textarea name="visa[SLFW]" rows="2" class="span9" placeholder="�Ϻ��С�����ʡ���㽭ʡ������ʡ���绤��ǩ���ز������������ڣ������ṩ������������ס����Ч��ס֤���߾�ס֤ԭ����"></textarea>
					</td>
			    </tr> 
			    </table> 
			  </td>
			</tr> 
			<?}?>

			<?if(in_array($c_goods_type, array(6))){?>
			<tr>
			  <td width="120" align="right"><font color="red">*</font> �������ƣ�</td>
			  <td><input name="ship_name" type="text" class="span6" id="ship_name" size="50" required/></td>
			</tr>  

			<tr>
			  <td align="right"><font color="red">*</font>  ���ֺ��ߣ�</td>
			  <td>
				<?
				foreach ($g_ship_line as $k => $v) {
				?>
				<label class="checkbox inline"><input type="checkbox" name="ship_line[]" id="ship_line" value="<?=$k?>"><?=$v?></label> 
				<?}?>  
			  </td>
			</tr>
			<tr>
			  <td align="right"><font color="red">*</font>  �����ۿڣ�</td>
			  <td>
				<?
				foreach ($g_ship_port as $k => $v) {
				?>
				<label class="radio inline"><input type="radio" name="ship_port" value="<?=$k?>" required><?=$v?></label>
				<?}?>  
			  </td>
			</tr>
			<tr>
			  <td align="right"><font color="red">*</font>  ����Ʒ�ƣ�</td>
			  <td>
				<?
				foreach ($g_ship_brand as $k => $v) {
				?>
				<label class="radio inline"><input type="radio" name="ship_brand" value="<?=$k?>" required><?=$v?></label> 
				<?}?>  
			  </td>
			</tr> 
			<tr>
			  <td align="right"><font color="red">*</font> �ϴ��ص㣺</td>
			  <td><select id="src_prov" name="src_prov" class="span2" required>
				</select>
				<select id="src_city" name="src_city" class="span2">
				</select>
				<script language="javascript">  
					new PCAS("src_prov","src_city","","");
					</script>
			  </td>
			<tr>
			  <td align="right"><font color="red">*</font> �´��ص㣺</td>
			  <td>
				<select id="dist_prov" name="dist_prov" class="span2" required>
				</select>
				<select id="dist_city" name="dist_city" class="span2">
				</select>
				<script language="javascript">  
					new PCAS("dist_prov","dist_city","","");
				</script>
			  </td>
			</tr> 
			<?}?>
			 
			<tr>
			  <td align="right">�ο�����ǰ��</td>
			  <td><input type="number" class="span1 text-center" name="before_days" value="1"/>
				��Ԥ�� </td>
			</tr>
			<tr>
			  <td align="right"><font color="red">*</font> ���¼ܣ�</td>
			  <td><input type="radio" name="is_sale" value="1" checked>
				�����ϼ�
				<input type="radio" name="is_sale" value="0" >
				����ֿ� </td>
			</tr> 
		</table> 
	</div> 
	<div class="tab-pane" id="tabs-3">   
		<table width="100%">  
			<tr>
			  <td width="100" align="right" height="80"><font color="red">*</font> ��Ʒ��ͼ��</td>
			  <td><input name="goods_image" type="file" id="goods_image" size="60" class="btn"/></td>
			</tr> 
			<tr>
			  <td align="right"><font color="red">*</font> ��Ʒͼ�᣺</td>
			  <td>
				  <table class="table ">
					  <tr>
						<td width="70">ͼƬ1��</td>
						<td><input name="goods_image1" type="file" id="goods_image1" size="60" class="btn"/></td>
					  </tr>
					  <tr>
						<td>ͼƬ2��</td>
						<td><input name="goods_image2" type="file" id="goods_image2" size="60" class="btn"/></td>
					  </tr>
					  <tr>
						<td>ͼƬ3��</td>
						<td><input name="goods_image3" type="file" id="goods_image3" size="60" class="btn"/></td>
					  </tr>
					  <tr>
						<td>ͼƬ4��</td>
						<td><input name="goods_image4" type="file" id="goods_image4" size="60" class="btn"/></td>
					  </tr>
					  <tr>
						<td>ͼƬ5��</td>
						<td><input name="goods_image5" type="file" id="goods_image5" size="60" class="btn"/></td>
					  </tr>
				  </table> 
				  <br/>
			  </td>
			</tr>  
		</table>
	</div> 
	<div class="tab-pane" id="tabs-4">   
		<table width="100%">
			<tr>
			  <td align="right">��Ʒ��ɫ��</td>
			  <td><br/><textarea name="summary" cols="70" rows="3" id="summary" style="width:97%;height:100px;visibility:hidden;"></textarea><br/>
			  </td>
			</tr> 
			<tr>
			  <td align="right" valign="top"><font color="red">*</font> ��Ʒ������</td>
			  <td><textarea id="goods_content" name="goods_content" style="width:97%;height:400px;visibility:hidden;"></textarea><br/></td>
			</tr> 

			<?if(in_array($c_goods_type, array(1,2,6))){?>
			<tr>
			  <td align="right"><font color="red">*</font> �г�������</td>
			  <td><input type="text" class="span1 text-center" id="line_days" name="line_days" value="2" onchange="load_days()"/>
				��
				<input type="text" class="span1 text-center" name="line_nights" value="1"/>
				�� </td>
			</tr>
			<tr>
			  <td align="right" valign="top">
			    <br/>
				<font color="red">*</font> �г������� 
			  </td>
			  <td style="padding-top:20px">  
						<div id="days_tpl" style="display:none"><?=$desc_tpl['tpl03']?></div>
						<div id="days_content"></div>

						<script type="text/javascript"> 
						function get_day_html(the_day){
							var day_html = '';
							day_html += '<table width="100%" class="table table-hover table-bordered">';
							day_html += '<tr>';
							day_html += '	<td align="right" width="10%">�� <b style="font-size:18px;color:red">'+the_day+'</b> �죺</td>';
							day_html += '	<td><input type="text" name="day_title['+the_day+']"></td>';
							day_html += '</tr>'; 
							day_html += '<tr>';
							day_html += '	<td align="right" width="10%"></td>';
							day_html += '	<td>��ͨ<input type="text" name="day_tool['+the_day+'][traffic]"> ס��<input type="text" name="day_tool['+the_day+'][house]"> ����<input type="text" name="day_tool['+the_day+'][food]"></td>';
							day_html += '</tr>';
							day_html += '<tr>';
							day_html += '	<td align="right">�г̣�</td>';
							day_html += '	<td><textarea id="day_content_'+the_day+'" name="day_content['+the_day+']" style="width:90%;height:150px;" ></textarea></td>';
							day_html += '</tr>';
							day_html += '<tr>';
							day_html += '	<td align="right">��Ƭ��</td>';
							day_html += '	<td>';
							day_html += '	<i>���㡢�Ƶꡢ��ʳ����Ƭ</i><br/>';
							day_html += '	<input type="file" name="day_file['+the_day+'][1]">';
							day_html += '	<input type="file" name="day_file['+the_day+'][2]"><br/>';
							day_html += '	<input type="file" name="day_file['+the_day+'][3]">';
							day_html += '	<input type="file" name="day_file['+the_day+'][4]"><br/>';
							day_html += '	</td>';
							day_html += '</tr> ';
							day_html += '</table>';

							return day_html;
						}
						
						function load_days(){
							var all_days = $('#line_days').val();
							var new_day_html = '';
							$('#days_content').html('');
							for(var d=1; d<=all_days; d++){
								new_day_html = get_day_html(d);
								$('#days_content').append(new_day_html);
								$('#day_content_'+d).val($('#days_tpl').html());
							}
						} 
						if($('#days_content').html()==''){load_days()}
						</script>   
			  </td>
			</tr>
			<tr>
			  <td align="right" valign="top"><br/>
				<font color="red">*</font> ����˵����</td>
			  <td>
				<i>���ð�����</i><br/>
				<textarea name="price_note" style="height:100px;width:97%" id="price_note"  ><?=$desc_tpl['tpl01']?></textarea><br/><br/>

				<i>���ò�����</i><br/>
				<textarea name="unprice_note" style="height:100px;width:97%" id="unprice_note" ><?=$desc_tpl['tpl04']?></textarea> 
				</td>
			</tr> 
			<?}?>

			<tr>
			  <td align="right" valign="top"><br/><br/>
				<font color="red">*</font> Ԥ����֪��</td>
			  <td><br/><br/><textarea name="order_note" style="width:97%;height:200px;" id="order_note"  ><?=$desc_tpl['tpl02']?></textarea></td>
			</tr>   
		  </table>
		  </div>
		  <div id="tabs-5" class="tab-pane">
		  <table width="100%">
		    <tr>
			  <td align="right" width="90">ԭ �ۣ�</td>
			  <td><input type="number" name="market_price" maxlength="6" /> Ԫ</td>
			</tr> 
			<?if(in_array($c_goods_type, array(3))){?>
			<tr>
			  <td align="right"> 
				<font color="red">*</font> �� �ۣ�</td>
			  <td><input type="number" step="0.01" name="real_price" maxlength="6" /> Ԫ </td>
			</tr>
			<tr>
			  <td align="right"> 
				<font color="red">*</font> �������</td>
			  <td><input type="number" name="stock" maxlength="6" /></td>
			</tr>
			<?}?>

			<?if(in_array($c_goods_type, array(3))==false){?> 
			<tr>
			  <td align="right"><font color="red">*</font> �� �ڣ�</td>
			  <td style="padding-left:20px"><table width="100%">
				  <tr>
					<td><label class="inline checkbox">
					  <input type="checkbox" class="J_week_all_select"/>
					  ���췢</label>
					  <label class="inline checkbox">
					  <input type="checkbox" class="J_week_select" value="1"/>
					  ��һ</label>
					  <label class="inline checkbox">
					  <input type="checkbox" class="J_week_select" value="2"/>
					  �ܶ�</label>
					  <label class="inline checkbox">
					  <input type="checkbox" class="J_week_select" value="3"/>
					  ����</label>
					  <label class="inline checkbox">
					  <input type="checkbox" class="J_week_select" value="4"/>
					  ����</label>
					  <label class="inline checkbox">
					  <input type="checkbox" class="J_week_select" value="5"/>
					  ����</label>
					  <label class="inline checkbox">
					  <input type="checkbox" class="J_week_select" value="6"/>
					  ����</label>
					  <label class="inline checkbox">
					  <input type="checkbox" class="J_week_select" value="0"/>
					  ����</label>
					</td>
					<td rowspan="2">&nbsp; <a href="javascript:void(0)" onclick="change_batch_price();" class="btn btn-warning btn-small" style="color:white">������� <i class="icon-chevron-down icon-white"></i></a></td>
				  </tr>
				  <tr>
					<td> 
					  ���ˣ�
					  <input type="text" class="span1" id="ref_adult_price"  name="ref_adult_price" maxlength="6" placeholder="�۸�"/>
					  <input type="text" class="span1" id="ref_adult_stock"  name="ref_adult_stock" maxlength="6" placeholder="���"/>
					  &nbsp;
					  ��ͯ��
					  <input type="text" class="span1" id="ref_kid_price" name="ref_kid_price" maxlength="6" placeholder="�۸�"/>
					  <input type="text" class="span1" id="ref_kid_stock" name="ref_kid_stock" maxlength="6" placeholder="���"/>
					  &nbsp;
					  �����
					  <input type="text" class="span1" id="ref_diff_price" name="ref_diff_price" maxlength="6"/>
					</td>
				  </tr>
				</table></td>
			</tr>
			
			<script type="text/javascript">
				$(".J_week_all_select").click(function(){
					 $("input[class='J_week_select']").attr("checked", $(this).prop("checked"));
				});
				function change_batch_price(){
					var arrChk = $("input[class='J_week_select']"); 
					for (var i=0; i<arrChk.length; i++)
					{ 
						var this_w = arrChk[i].value; 

						if(arrChk[i].checked==true){ 
							$(".adult_w_"+this_w).val( $("#ref_adult_price").val() );
							$(".kid_w_"+this_w).val( $("#ref_kid_price").val() ); 
							$(".adult_s_"+this_w).val( $("#ref_adult_stock").val() );
							$(".kid_s_"+this_w).val( $("#ref_kid_stock").val() ); 
							$(".diff_w_"+this_w).val( $("#ref_diff_price").val() ); 
							$(".base_w_"+this_w).val( $("#ref_base_price").val() );
						}  
					} 

				}
				</script>
			<tr>
			  <td colspan="2">
					<style type="text/css"> 
						.calendar th, .calendar td {
							width:30px;
							text-align:center;
							border:1px solid #efefef;
							padding:5px; 
							font-size:14px;
							font-family:Tahoma;
							color:#666;  
						}            
						.calendar th {
							background-color:#999;
							color:#fff; 
						}
						.today{ 
							background-color:#999;       
							color:#fff;
						}
					</style>
				<?  
				require dirname(__FILE__).'/goods_calendar.php'; 
				?>
				<table width="100%">
				  <tr>
					<td width="110"><?=date('Y')?>
					  ��
					  <h2>
						<?=date('m')?>
						��</h2></td>
					<td><?
						$params = array(
							'year' => date('Y'),
							'month' => date('m'),
						);   
						$cal = new Calendar($params);
						$cal->display();
						?>
					</td>
				  </tr>
				  <?
					$next01 = getNextMonthDays(date('Y-m-d'));
					?>
				  <tr>
					<td><?=date('Y', strtotime($next01[0]))?>
					  ��
					  <h2>
						<?=date('m', strtotime($next01[0]))?>
						��</h2></td>
					<td><? 
						$params = array(
							'year' => date('Y', strtotime($next01[0])),
							'month' => date('m', strtotime($next01[0])),
						);  
						$cal = new Calendar($params);
						$cal->display();
						?>
					</td>
				  </tr>
				  <?
					$next02 = getNextMonthDays($next01[0]);
					?>
				  <tr>
					<td><?=date('Y', strtotime($next02[0]))?>
					  ��
					  <h2>
						<?=date('m', strtotime($next02[0]))?>
						��</h2></td>
					<td><? 
						$params = array(
							'year' => date('Y', strtotime($next02[0])),
							'month' => date('m', strtotime($next02[0])),
						); 

						$cal = new Calendar($params);
						$cal->display();
						?>
					</td>
				  </tr>
				  <?
					$next03 = getNextMonthDays($next02[0]);
					?>
				  <tr>
					<td><?=date('Y', strtotime($next03[0]))?>
					  ��
					  <h2>
						<?=date('m', strtotime($next03[0]))?>
						��</h2></td>
					<td><? 
						$params = array(
							'year' => date('Y', strtotime($next03[0])),
							'month' => date('m', strtotime($next03[0])),
						); 

						$cal = new Calendar($params);
						$cal->display(); 
						?>
					</td>
				  </tr>
				</table>
				</td> 
			</tr> 
			<?}?>
	  </table>
  </div> 
</div> 
</form>

<script type="text/javascript">
		function change_fileds(v){
			if(v==2) v=1;
			if(v==6) v=1;

			for(f=1; f<=6; f++){
				if(f==v){
					$('#field_'+f).css('display','');
				} else {
					$('#field_'+f).css('display','none');
				}
			}

			if(v==3){
				$('#sku_price_layer').css('display','none');
				$('#real_price_layer').css('display','');
				$('#route_layer').css('display','none');
			} else {
				$('#sku_price_layer').css('display','');
				$('#real_price_layer').css('display','none');
				$('#route_layer').css('display','');
			}
		}
</script>