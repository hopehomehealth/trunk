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
	<?if($goods['goods_image']==""){?>
	if(myform.goods_image.value==''){
		alert('�Բ������ϴ���Ʒ��ͼ��');
		return false;
	} 
	<?}?>
	if(myform.line_days.value==''){
		alert('�Բ����������г�������');
		return false;
	}   
}

</script>

<?
if(req('ac')=='copy'){
	$cmd_string = 'goods_add';

} else {
	$cmd_string = 'goods_update'; 
}
?>
<form target="frm" name="goods_form" id="goods_form" action="do.php?cmd=<?=$cmd_string?>" method="post" enctype="multipart/form-data" >
<input type="hidden" value="<?=$goods['goods_id']?>" name="goods_id" />
<input type="hidden" name="goods_type" value="<?=$goods['goods_type']?>">

<script type="text/javascript">
$(document).ready(function(){
	$('#myTab a').click(function (e) { 
		e.preventDefault();
		$(this).tab('show'); 
		autoFrame();
	})
}); 
</script>

<ul class="nav nav-tabs" id="myTab">  
  <li style="padding-left:20px"><a href="#tabs-1">ѡ�����</a></li>
  <li class="active" ><a href="#tabs-2">������Ϣ</a></li>
  <li><a href="#tabs-3">��ƷͼƬ</a></li>
  <li><a href="#tabs-4">��Ʒ����</a></li>
  <li><a href="#tabs-5">����/�۸�</a></li> 

  <input type="button" value=" ���� " class="btn pull-right" onclick="history.back()" style="margin-left:5px"/>
  <a href="javascript:void(0)" onclick="window.open('preview.php?ac=goods&goods_id=<?=$goods['goods_id']?>')" target="_blank" class="btn btn-info pull-right " style="color:white;margin-left:5px"/>Ԥ��</a>
  <input type="submit" value="��������" class="btn btn-warning pull-right"/>
</ul>

<div class="tab-content"> 
    <div class="tab-pane" id="tabs-1">  
			<div class="alert">��ʾ���������϶࣬�ɰ�CTRL+F�������Ʒ�ؼ��ʣ����ٶ�λ���÷��ࡣ</div>
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
				<label <?if($goods['cat_id']==$val['cat_id']){?>style="color:red;"<?}?>><input type="radio" name="goods_cat_id" value="<?=$val['cat_id']?>" <?if($goods['cat_id']==$val['cat_id']){?>checked<?}?>> ѡ��</label>
				<?}?>
				</td>
			  </tr>
			  </tbody> 
			<?
			}
			?> 
			<script type="text/javascript"> 
			$("#mytab").treetable({ expandable: false }); 
			</script>
	</div>
	<div class="tab-pane in active" id="tabs-2">   
      <table width="100%">  
	    <tr>
          <td width="90" align="right">�̼ң�</td>
          <td><select name="shop_id" id="shop_id" class="span6">
              <option value=""></option>
              <?  
			  if(notnull($shop_list)){ 
			      foreach ($shop_list as $val){    	
			  ?>
              <option value="<?=$val['shop_id']?>" <?if($goods['shop_id']==$val['shop_id']){echo "selected";}?>>
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
          <td><input name="goods_name" type="text" class="span6" id="goods_name" size="60" value="<?=$goods['goods_name']?>"/>
          </td>
        </tr>
        <tr>
          <td align="right">��Ʒ���룺</td>
          <td><input name="goods_code" type="text" class="span3" id="goods_code" size="60" value="<?=$goods['goods_code']?>"/>
          </td>
        </tr>
		<tr>
		  <td align="right"><font color="red">*</font> ��Ʒ������</td>
		  <td><input name="goods_doc" type="text" class="span3" id="goods_doc" size="80" value="<?=$goods['goods_doc']?>"/></td>
		</tr>
		
		<?if(in_array($c_goods_type, array(1,2))){?>
		<tr>
		  <td align="right"><font color="red">*</font> �������ͣ�</td>
		  <td>
			<?foreach ($g_product_zone as $k => $v) {?> 
			<label class="radio inline">
			<input name="goods_zone" type="radio" value="<?=$k?>" <?if($k == $goods['goods_zone']) echo 'checked';?>>
			<?=$v?></label>
			<?}?>  
		  </td>
		</tr>
		<tr>
          <td align="right" valign="top"><font color="red">*</font> �������ͣ�</td>
          <td>
		    <label class="radio inline">
		    <input name="sale_type" type="radio" id="sale_type" value="0" <?if($goods['sale_type']=='0') echo 'checked';?> onclick="document.getElementById('sale_date').style.display='none'"/>
            ����</label>

			<label class="radio inline">
            <input name="sale_type" type="radio" id="sale_type" value="1" <?if($goods['sale_type']=='1') echo 'checked';?> onclick="document.getElementById('sale_date').style.display='block'"/>
            �Ź�</label>

			<label class="radio inline">
            <input name="sale_type" type="radio" id="sale_type" value="2" <?if($goods['sale_type']=='2') echo 'checked';?> onclick="document.getElementById('sale_date').style.display='block'"/>
            ��ɱ</label> 
			<table id="sale_date" <?if($goods['sale_type']=='0'){?>style="display:none"<?}?>>
				<tr>
				  <td align="right"> ������ʼ���ڣ�</td>
				  <td><input id="sale_start" name="sale_start" class="Wdate" type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" value="<?=$goods['sale_start']?>" style="background:none">
					�Ź�/��ɱ���� </td>
				</tr>
				<tr>
				  <td align="right"> ���۽������ڣ�</td>
				  <td><input id="sale_end" name="sale_end" class="Wdate" type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" value="<?=$goods['sale_end']?>" style="background:none">
					�Ź�/��ɱ���� </td>
				</tr> 
		    </table>
          </td>
        </tr> 
        <tr>
          <td align="right"><font color="red">*</font> �������У�</td>
          <td><select id="src_prov" name="src_prov" class="span2" >
            </select>
            <select id="src_city" name="src_city" class="span2">
            </select>
            <script language="javascript">  
			new PCAS("src_prov","src_city","<?=$goods['src_prov']?>","<?=$goods['src_city']?>");
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
			new PCAS("dist_prov","dist_city","<?=$goods['dist_prov']?>","<?=$goods['dist_city']?>");
			</script>
          </td>
        </tr>
        <tr>
          <td align="right"><font color="red">*</font> ��ͨ��</td>
          <td><select name="goto_transport" class="span2">
              <option value=""> ȥ�� >> </option>
			  <?foreach ($g_product_road as $k => $v) {?>
			  <option value="<?=$k?>" <?if($k == $goods['goto_transport']) echo 'selected';?>><?=$v?></option>
			  <?}?> 
            </select> 
            <select name="back_transport" class="span2">
              <option value=""> ���� << </option>
			  <?foreach ($g_product_road as $k => $v) {?>
			  <option value="<?=$k?>" <?if($k == $goods['back_transport']) echo 'selected';?>><?=$v?></option>
			  <?}?> 
            </select>
          </td>
        </tr>  
        <tr>
          <td align="right">�����ǩ��</td>
          <td>
			<?
			$goods['line_tag'];
			foreach ($g_product_tag as $k => $v) {
			?> 
			<label class="inline checkbox">
			<input type="checkbox" name="line_tag[]" value="<?=$k?>" <?if(strpos($goods['line_tag'],"\"$k\"")!==false) echo 'checked';?> />
			<?=$v?></label>
			<?}?>
          </td>
        </tr>   
		<?}?>

		<?if(in_array($c_goods_type, array(6))){?>
        <tr>
			  <td width="120" align="right"><font color="red">*</font> �������ƣ�</td>
			  <td><input name="ship_name" type="text" class="span6" id="ship_name" size="50" value="<?=$goods['ship_name']?>" required /></td>
        </tr>   
        <tr>
			  <td align="right"><font color="red">*</font>  ���ֺ��ߣ�</td>
			  <td>
				<?
				foreach ($g_ship_line as $k => $v) {
				?>
				<label class="checkbox inline"><input type="checkbox" name="ship_line[]" id="ship_line" value="<?=$k?>" <?if(strpos($goods['ship_line'], '"'.$k.'"')!==false) echo 'checked';?>><?=$v?></label> 
				<?}?>  
			  </td>
        </tr>
        <tr>
			  <td align="right"><font color="red">*</font>  �����ۿڣ�</td>
			  <td>
				<?
				foreach ($g_ship_port as $k => $v) {
				?>
				<label class="radio inline"><input type="radio" name="ship_port" value="<?=$k?>" <?if($goods['ship_port']==$k) echo 'checked';?> required><?=$v?></label>
				<?}?>  
			  </td>
        </tr>
        <tr>
			  <td align="right"><font color="red">*</font>  ����Ʒ�ƣ�</td>
			  <td>
				<?
				foreach ($g_ship_brand as $k => $v) {
				?>
				<label class="radio inline"><input type="radio" name="ship_brand" value="<?=$k?>" <?if($goods['ship_brand']==$k) echo 'checked';?> required><?=$v?></label> 
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
					new PCAS("src_prov","src_city","<?=$goods['src_prov']?>","<?=$goods['src_city']?>");
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
					new PCAS("dist_prov","dist_city","<?=$goods['dist_prov']?>","<?=$goods['dist_city']?>");
				</script>
			  </td>
        </tr> 
        <?}?>

        <?if(in_array($c_goods_type, array(3))){?>
        <tr>
				  <td align="right"><font color="red">*</font>�������ң�</td>
				  <td>  
					<?foreach ($visa_zone_list as $val) {?> 
					<label class="radio inline">
					<input name="visa_zone_id" type="radio" value="<?=$val['zone_id']?>" <?if($goods['visa_zone_id']==$val['zone_id']) echo 'checked';?>>
					<?=$val['zone_name']?></label>
					<?}?> 
			  </td>
        </tr> 
        <tr>
				  <td align="right" height="40"><font color="red">*</font>ǩ֤���ͣ�</td>
				  <td>  
					<?foreach ($g_visa_type as $k => $v) {?> 
					<label class="radio inline">
					<input name="visa_type" type="radio" value="<?=$k?>" <?if($goods['visa_type']==$k) echo 'checked';?>>
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
							<td><input type="text" name="visa[SQD]" placeholder="�Ϻ�" value="<?=$visa['SQD']?>"></td>
							<td>�뾳������</td>
							<td><input type="text" name="visa[RJCS]" placeholder="һ��" value="<?=$visa['RJCS']?>"></td>
						</tr>
						<tr>
							<td>��Ч�ڣ�</td>
							<td><input type="text" name="visa[YXQ]" placeholder="3����" value="<?=$visa['YXQ']?>"></td>
							<td>�Ƿ����ԣ�</td>
							<td><input type="text" name="visa[SFMS]" placeholder="��" value="<?=$visa['SFMS']?>"></td>
						</tr>
						<tr>
							<td>�Ƿ���¼ָ�ƣ�</td>
							<td><input type="text" name="visa[SFXLZW]" placeholder="��" value="<?=$visa['SFXLZW']?>"></td>
							<td>�Ƿ���ǩ��</td>
							<td><input type="text" name="visa[SFXQ]" placeholder="��" value="<?=$visa['SFXQ']?>"></td>
						</tr>
						<tr>
							<td>�Ƿ��赣����</td>
							<td><input type="text" name="visa[SFXDBJ]" placeholder="��" value="<?=$visa['SFXDBJ']?>"></td>
							<td>�ͣ��ʱ�䣺</td>
							<td><input type="text" name="visa[ZCTLSJ]" placeholder="��" value="<?=$visa['ZCTLSJ']?>"></td>
						</tr>
						<tr>
							<td>�������ڣ�</td>
							<td colspan="3"><input type="text" name="visa[BLZQ]" placeholder="��ǩ���8��������" value="<?=$visa['BLZQ']?>">�����������ʱ��Ϊ׼�������������</td> 
						</tr> 
						<tr> 
							<td>����Χ��</td>
							<td colspan="3">
							<textarea name="visa[SLFW]" rows="2" class="span9" placeholder="�Ϻ��С�����ʡ���㽭ʡ������ʡ���绤��ǩ���ز������������ڣ������ṩ������������ס����Ч��ס֤���߾�ס֤ԭ����"><?=$visa['SLFW']?></textarea>
							</td>
						</tr> 
					</table> 
				  </td>
        </tr> 
        <?}?>
        <tr>
			  <td align="right"><font color="red">*</font> �ο�����ǰ��</td>
			  <td><input type="text" class="span1 text-center" name="before_days" value="<?=$goods['before_days']?>"/>
				��Ԥ�� </td>
        </tr>
        <tr>
			  <td align="right"><font color="red">*</font> ���¼ܣ�</td>
			  <td><input type="radio" name="is_sale" value="1" <?if($goods['is_sale']=='1'){?>checked<?}?>>
					�����ϼ�
					<input type="radio" name="is_sale" value="0"  <?if($goods['is_sale']=='0'){?>checked<?}?>>
					����ֿ� </td>
        </tr> 
	  </table>
	</div>
	<div class="tab-pane" id="tabs-3">   
	  <div class="alert">
		�������ͼƬ����ѡ���µ�ͼƬ�����淢�����ɡ�
	  </div>
      <table width="100%" class="table table-bordered">  
          <tr>
			  <td style="width:90px;text-align:right"><font color="red">*</font> ��Ʒ��ͼ��</td>
			  <td style="width:170px;"> 
			  <?
			  if($goods['goods_image']!=""){
							  $goods_image = "/upfiles/$g_siteid/".$goods['goods_image'];
			  ?>
			  <img src="<?=$goods_image?>" style="width:152px;" class="thumbnail"/><br/>
			  <?
			  }
			  ?>
			  </td>
			  <td><input name="goods_image" type="file" id="goods_image" class="btn"/></td>	   
          </tr>  
          <?
          // ��ѯ����ͼƬ
          $sql = "SELECT * FROM `t_goods_image` WHERE site_id='$g_siteid' AND goods_id='$goods_id' ORDER BY image_id ASC";
          $images = $db->get_all($sql); 
          for($i=0; $i<5; $i++){
          ?> 
          <tr>
			  <td style="text-align:right">ͼƬ<?=$i+1?>��</td>
			  <td>
					<?if($images[$i]['image_id']!=''){?>
					<div id="goods_images_<?=$images[$i]['image_id']?>"> 
					<a href="do.php?cmd=goods_image_del&image_id=<?=$images[$i]['image_id']?>" target="frm" style="position:absolute;font-size:18px;color:red;margin-left:130px;" title="ɾ��" onclick="return confirm('ȷ��ɾ����')">��</a>
						<img src="http://<?=$g_site_domain?>/upfiles/<?=$g_siteid?>/<?=$images[$i]['filepath']?>"  style="width:152px"/> 
						
					</div>
					<?}else{?>
					δ�ϴ�
					<?}?>
			  </td>
			  <td>
					<input name="exist_goods_image<?=$i+1?>" type="hidden" value="<?=$images[$i]['filepath']?>"/>
					<input name="exist_image_id<?=$i+1?>" type="hidden" value="<?=$images[$i]['image_id']?>"/>
					<input name="goods_image<?=$i+1?>" type="file" id="goods_image<?=$i+1?>" size="60" class="btn"/>
			  </td> 
          </tr>
          <?}?> 
	  </table>
	</div>
	<div class="tab-pane" id="tabs-4">   
      <table width="100%">   
	    <tr>
		  <td align="right">��Ʒ��ɫ��</td>
		  <td><br/><textarea name="summary" cols="70" rows="3" id="summary" style="width:97%;height:100px;visibility:hidden;"><?=stripslashes($goods['summary'])?></textarea><br/>
		  </td>
		</tr>
		<tr>
          <td align="right"><font color="red">*</font> ��Ʒ������</td>
          <td><textarea id="goods_content" name="goods_content" style="width:97%;height:400px;visibility:hidden;"><?=stripslashes($goods['content'])?></textarea> <br/></td>
        </tr>
		<?if(in_array($c_goods_type, array(1,2,6))){?>
		<tr>
          <td align="right"><font color="red">*</font> �г�������</td>
          <td><input type="text" class="span1 text-center" id="line_days"  name="line_days" value="<?=$goods['line_days']?>"/>
            ��
            <input type="text" class="span1 text-center" name="line_nights" value="<?=$goods['line_nights']?>"/>
            �� </td>
        </tr>
		<tr>
		  <td align="right" valign="top">
		    <br/>
		    <font color="red">*</font> �г������� 
		  </td>
		  <td style="padding-top:20px">      
					<? 
					$all_days = unserialize(stripslashes($goods['content_day']));
 
					for($i=1; $i<=$goods['line_days']; $i++){
						$all_titles = $all_days['title'][$i];
						$all_contents = $all_days['content'][$i];
						$all_tools = $all_days['tool'][$i];
						$all_images = $all_days['image'][$i];
		
					?> 
					<table width="97%" class="table table-bordered">
					<tr>
						<td align="right" width="10%">�� <b style="font-size:28px;color:red"><?=$i?></b> �죺</td>
						<td><input type="text" name="day_title[<?=$i?>]" value="<?=$all_titles?>" class="span6"></td>
					</tr>
					<tr>
						<td align="right" width="10%"></td>
						<td>
							��ͨ�� <input type="text" name="day_tool[<?=$i?>][traffic]" value="<?=$all_tools['traffic']?>"> 
							ס�ޣ� <input type="text" name="day_tool[<?=$i?>][house]" value="<?=$all_tools['house']?>"> 
							������ <input type="text" name="day_tool[<?=$i?>][food]" value="<?=$all_tools['food']?>">
						</td>
					</tr>
					<tr>
						<td align="right">�г̣�</td>
						<td><textarea id="day_content_<?=$i?>" name="day_content[<?=$i?>]" style="width:90%;height:150px;"  ><?=$all_contents?></textarea></td>
					</tr>
					<tr>
						<td align="right">��Ƭ��</td>
						<td>
						<i>���㡢�Ƶꡢ��ʳ����Ƭ</i><br/> 

						<input type="hidden" name="day_file_src[<?=$i?>][1]" value="<?=$all_images[1]?>">
						<input type="hidden" name="day_file_src[<?=$i?>][2]" value="<?=$all_images[2]?>">
						<input type="hidden" name="day_file_src[<?=$i?>][3]" value="<?=$all_images[3]?>">
						<input type="hidden" name="day_file_src[<?=$i?>][4]" value="<?=$all_images[4]?>">

						<table style="background-color:#efefef">
						  <tr>
							<td><img src="<?=$all_images[1]?>" style="width:60px;height40px" onerror="this.style.display='none'">
							<br/>ͼ1��<input type="file" name="day_file[<?=$i?>][1]"> 
							</td>
							<td><img src="<?=$all_images[2]?>" style="width:60px;height40px" onerror="this.style.display='none'">
							<br/>ͼ2��<input type="file" name="day_file[<?=$i?>][2]"> 
							</td>
						  </tr>
						  <tr>
							<td><img src="<?=$all_images[3]?>" style="width:60px;height40px" onerror="this.style.display='none'">
							<br/>ͼ3��<input type="file" name="day_file[<?=$i?>][3]"> 
							</td>
							<td><img src="<?=$all_images[4]?>" style="width:60px;height40px" onerror="this.style.display='none'">
							<br/>ͼ4��<input type="file" name="day_file[<?=$i?>][4]"> 
							</td>
						  </tr>
						</table> 
						</td>
					</tr> 
					</table>
					<?
					}
					?>  
		  </td>
		</tr>
		<tr>
          <td align="right" valign="top"><br/>
            <font color="red">*</font> ����˵����</td>
          <td>  
			<i>���ð�����</i><br/>
			<textarea name="price_note" style="height:100px;width:97%" id="price_note"  ><?=$goods['price_note']?></textarea><br/><br/>

			<i>���ò�����</i><br/>
			<textarea name="unprice_note" style="height:100px;width:97%" id="unprice_note" ><?=$goods['unprice_note']?></textarea>
			
		  </td>
        </tr> 
		<?}?>
        <tr>
          <td align="right" valign="top"><br/>
            <font color="red">*</font> Ԥ����֪��</td>
          <td><textarea name="order_note" style="width:97%;height:200px;" id="order_note" ><?=stripslashes($goods['order_note'])?></textarea></td>
        </tr>  
      </table> 
	</div> 
	<div id="tabs-5" class="tab-pane">
		<table width="100%">
			<tr>
			  <td width="90" align="right">ԭ �ۣ�</td>
			  <td><input type="number" name="market_price" maxlength="6" value="<?=$goods['market_price']?>"/> Ԫ</td>
			</tr> 
			<?if(in_array($c_goods_type, array(3))){?>
			<tr>
			  <td align="right"> 
				<font color="red">*</font> �� �ۣ�</td>
			  <td><input type="number" step="0.01" name="real_price" maxlength="6" value="<?=$goods['real_price']?>"/> Ԫ </td>
			</tr>
			<tr>
			  <td align="right"> 
				<font color="red">*</font> �������</td>
			  <td><input type="number" name="stock" maxlength="6" value="<?=$goods['stock']?>"/></td>
			</tr>
			<?}?>
			<?if(in_array($c_goods_type, array(3))==false){?> 
			<tr>
			  <td align="right" style="width:90px"><font color="red">*</font> �� �ڣ�</td>
			  <td><table width="100%">
				  <tr>
					<td><label class="inline checkbox">
					  <input type="checkbox" class="J_week_all_select"/>
					  ���췢��</label>
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
					  <?
					  $ref = unserialize($goods['ref_price']);
					  ?> 

					  <font color="red">*</font> ���ˣ�
					  <input type="text" class="span1" id="ref_adult_price"  name="ref_adult_price" maxlength="6" placeholder="�۸�" value="<?=$ref['ref_adult_price']?>" title="���˼۸�"/>
					  <input type="text" class="span1" id="ref_adult_stock"  name="ref_adult_stock" maxlength="6" placeholder="���" value="<?=$ref['ref_adult_stock']?>" title="���˿��"/>
					  &nbsp; &nbsp;

					  ��ͯ��
					  <input type="text" class="span1" id="ref_kid_price" name="ref_kid_price" maxlength="6" placeholder="�۸�" value="<?=$ref['ref_kid_price']?>" title="��ͯ�۸�"/>
					  <input type="text" class="span1" id="ref_kid_stock" name="ref_kid_stock" maxlength="6" placeholder="���" value="<?=$ref['ref_kid_stock']?>" title="��ͯ���"/>
					  &nbsp; &nbsp;

					  �����
					  <input type="text" class="span1" id="ref_diff_price" name="ref_diff_price" maxlength="6" value="<?=$ref['ref_diff_price']?>"/>
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

				var k = 0;
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
						k++;
					} 
				} 

				if(k==0) 
					alert('��ѡ�����ڣ�');
				if($("#ref_adult_price").val()=='') 
					alert('����д�����ˣ��۸�');

			}
			</script>
			<tr>
			  <td colspan="2"><style type="text/css">
				 
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

				$sql = "SELECT *, DATE_FORMAT(`departdate`,'%Y%m%d') AS ymd FROM `t_goods_sku` WHERE `site_id`='$g_siteid' AND `goods_id`='$goods_id' AND `departdate`>='".date('Y-m-d')."'";
				$last_sku = $db->get_all($sql);
				if(notnull($last_sku)){
					foreach ($last_sku as $sval){ 
						$adult_price_array[$sval['ymd']] = $sval['adult_price'];
						$adult_stock_array[$sval['ymd']] = $sval['adult_stock'];
						$kid_price_array[$sval['ymd']]   = $sval['kid_price'];
						$kid_stock_array[$sval['ymd']]   = $sval['kid_stock'];
						$diff_price_array[$sval['ymd']]  = $sval['diff_price']; 
					}
				} 
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
					$cal->adult_price_array = $adult_price_array;
					$cal->adult_stock_array = $adult_stock_array;
					$cal->kid_price_array	= $kid_price_array;
					$cal->kid_stock_array	= $kid_stock_array;
					$cal->diff_price_array	= $diff_price_array; 
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
					$cal->adult_price_array = $adult_price_array;
					$cal->adult_stock_array = $adult_stock_array;
					$cal->kid_price_array	= $kid_price_array;
					$cal->kid_stock_array	= $kid_stock_array;
					$cal->diff_price_array	= $diff_price_array; 
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
					$cal->adult_price_array = $adult_price_array;
					$cal->adult_stock_array = $adult_stock_array;
					$cal->kid_price_array	= $kid_price_array;
					$cal->kid_stock_array	= $kid_stock_array;
					$cal->diff_price_array	= $diff_price_array; 
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
					$cal->adult_price_array = $adult_price_array;
					$cal->adult_stock_array = $adult_stock_array;
					$cal->kid_price_array	= $kid_price_array;
					$cal->kid_stock_array	= $kid_stock_array;
					$cal->diff_price_array	= $diff_price_array; 
					$cal->display(); 
					?>
					</td>
				  </tr>
				</table></td>
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

		change_fileds(<?=$goods['goods_type']?>);
</script>