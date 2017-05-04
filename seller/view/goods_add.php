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
 
	/*if(myform.goods_cat_id.value==''){
		alert('对不起，请选择分类！');
		return false;
	}*/
	if(myform.goods_name.value==''){
		alert('对不起，请输入产品名称！');
		return false;
	} 
	if(myform.goods_image.value==''){
		alert('对不起，请上传产品主图！');
		return false;
	} 
	if(myform.line_days.value==''){
		alert('对不起，请输入行程天数！');
		return false;
	}   
}
</script>   

<script type="text/javascript">
$(document).ready(function(){
	$('#myTab a').click(function (e) { 
		e.preventDefault();
		$(this).tab('show'); 
		autoFrame();
	})
}); 
</script>

<form id="goods_form" name="goods_form" action="do.php?cmd=goods_add" method="post" enctype="multipart/form-data" target="frm" onsubmit="return form_check()"> 
<input type="hidden" name="goods_cat_id" value="<?=req('cat_id')?>"> 
<input type="hidden" name="goods_type" value="<?=$c_goods_type?>">
<input type="hidden" name="shop_id" value="<?=$g_shopid?>">

<ul class="nav nav-tabs" id="myTab"> 
  <!-- <li class="active" style="padding-left:20px"><a href="#tabs-1">选择分类</a></li> -->
  <li class="active" style="padding-left:20px"><a href="#tabs-2">基本信息</a></li>
  <li><a href="#tabs-3">产品图片</a></li>
  <li><a href="#tabs-4">产品描述</a></li>
  <li><a href="#tabs-5">团期/价格</a></li>
  <li><a href="#tabs-6">其它设置</a></li> 
  <input type="button" value=" 返回 " class="btn pull-right" onclick="history.back()" style="margin-left:5px"/>
  <input type="submit" value=" 立即发布 " class="btn pull-right btn-warning"/>
</ul>

<div class="tab-content"> 
	<!-- <div class="tab-pane in active" id="tabs-1">   
			<div class="alert"><strong>提示：</strong>请展开下面的分类，选择您所需要发布的子分类。</div>
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
				<label><input type="radio" name="goods_cat_id" value="<?=$val['cat_id']?>"> 选择</label>
				<?}?>
				</td>
			  </tr>
			  </tbody> 
			<?
			}
			?> 
			<script type="text/javascript"> 
			$("#mytab").treetable({ expandable： true }); 
			</script>
	</div>  -->
	<div class="tab-pane in active" id="tabs-2">
	
		<table width="100%">   
			<tr>
			  <td width="100" align="right"><font color="red">*</font> 产品名称：</td>
			  <td><input name="goods_name" type="text" class="span6" id="goods_name" size="50"/></td>
			</tr>
			<tr>
			  <td align="right"><font color="red">*</font> 产品编码：</td>
			  <td><input name="goods_code" type="text" class="span6" id="goods_code" size="50" value="<?=strtoupper(uniqid())?>"/></td>
			</tr>
			<tr>
			  <td align="right"> 产品别名：</td>
			  <td><input name="goods_doc" type="text" class="span6" id="goods_doc" size="80" placeholder="内部名称，不对外显示"/></td>
			</tr>
			<tr>
			  <td align="right"><font color="red">*</font> 销售类型：</td>
			  <td height="30">
				<label class="radio inline">
				<input name="sale_type" type="radio" id="sale_type" value="0" checked onclick="document.getElementById('sale_date').style.display='none'"/>
				常规
				</label>
				<label class="radio inline">
				<input name="sale_type" type="radio" id="sale_type" value="1" onclick="document.getElementById('sale_date').style.display='block'" />
				团购
				</label>
				<label class="radio inline">
				<input name="sale_type" type="radio" id="sale_type" value="2" onclick="document.getElementById('sale_date').style.display='block'" />
				秒杀 
				</label>
				<table id="sale_date" style="display:none">
					<tr>
						<td>销售起始日期：</td>
						<td><input id="sale_start" name="sale_start" class="Wdate" type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" style="background:none;"> 团购/秒杀必填</td>
					</tr>
					<tr>
						<td>销售结束日期：</td>
						<td><input id="sale_end" name="sale_end" class="Wdate" type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" style="background:none"> 团购/秒杀必填</td>
					</tr>
				</table>
				</td>
			</tr> 
			
			<?if(in_array($c_goods_type, array(1,2))){?>
			<tr>
			  <td align="right"><font color="red">*</font>区域类型：</td>
			  <td>
				<?foreach ($g_product_zone as $k => $v) {?> 
				<label class="radio inline">
				<input name="goods_zone" type="radio" value="<?=$k?>">
				<?=$v?></label>
				<?}?>  
			  </td>
			</tr>  
			<tr>
			  <td align="right"><font color="red">*</font> 出发城市：</td>
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
			  <td align="right"><font color="red">*</font> 目的城市：</td>
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
			  <td align="right"><font color="red">*</font> 交通：</td>
			  <td><select name="goto_transport" class="span2">
				  <option value=""> 去程 >> </option>
				  <?foreach ($g_product_road as $k => $v) {?>
				  <option value="<?=$k?>"><?=$v?></option>
				  <?}?> 
				</select>
		 
				<select name="back_transport" class="span2">
				  <option value=""> 返程 << </option>
				  <?foreach ($g_product_road as $k => $v) {?>
				  <option value="<?=$k?>"><?=$v?></option>
				  <?}?> 
				</select>
			  </td>
			</tr>  
			<tr>
			  <td align="right">主题标签：</td>
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
			  <td align="right"><font color="red">*</font>所属国家：</td>
			  <td>  
			    <?foreach ($visa_zone_list as $val) {?> 
				<label class="radio inline">
				<input name="visa_zone_id" type="radio" value="<?=$val['zone_id']?>">
				<?=$val['zone_name']?></label>
				<?}?> 
			  </td>
			</tr> 
			<tr>
			  <td align="right"><font color="red">*</font>签证类型：</td>
			  <td>  
			    <?foreach ($g_visa_type as $k => $v) {?> 
				<label class="radio inline">
				<input name="visa_type" type="radio" value="<?=$k?>">
				<?=$v?></label>
				<?}?> 
			  </td>
			</tr> 
			<tr>
			  <td align="right"><font color="red">*</font>签证参数：</td>
			  <td>  
			    <table width="100%">
			    <tr>
					<td>送签地：</td>
					<td><input type="text" name="visa[SQD]" placeholder="上海"></td>
					<td>入境次数：</td>
					<td><input type="text" name="visa[RJCS]" placeholder="一次"></td>
			    </tr>
			    <tr>
					<td>有效期：</td>
					<td><input type="text" name="visa[YXQ]" placeholder="3个月"></td>
					<td>是否面试：</td>
					<td><input type="text" name="visa[SFMS]" placeholder="否"></td>
			    </tr>
			    <tr>
					<td>是否需录指纹：</td>
					<td><input type="text" name="visa[SFXLZW]" placeholder="否"></td>
					<td>是否销签：</td>
					<td><input type="text" name="visa[SFXQ]" placeholder="否"></td>
			    </tr>
			    <tr>
					<td>是否需担保金：</td>
					<td><input type="text" name="visa[SFXDBJ]" placeholder="否"></td>
					<td>最长停留时间：</td>
					<td><input type="text" name="visa[ZCTLSJ]" placeholder="否"></td>
			    </tr>
				<tr>
					<td>办理周期：</td>
					<td colspan="3"><input type="text" name="visa[BLZQ]" placeholder="送签后的8个工作日">（以领馆受理时长为准，建议提早办理）</td> 
			    </tr> 
				<tr> 
					<td>受理范围：</td>
					<td colspan="3">
					<textarea name="visa[SLFW]" rows="2" class="span9" placeholder="上海市、江苏省、浙江省、安徽省、如护照签发地不在上述地区内，必须提供在上述地区居住的有效暂住证或者居住证原件。"></textarea>
					</td>
			    </tr> 
			    </table> 
			  </td>
			</tr> 
			<?}?>

			<?if(in_array($c_goods_type, array(6))){?>
			<tr>
			  <td width="120" align="right"><font color="red">*</font> 邮轮名称：</td>
			  <td><input name="ship_name" type="text" class="span6" id="ship_name" size="50" required/></td>
			</tr>  

			<tr>
			  <td align="right"><font color="red">*</font>  邮轮航线：</td>
			  <td>
				<?
				foreach ($g_ship_line as $k => $v) {
				?>
				<label class="checkbox inline"><input type="checkbox" name="ship_line[]" id="ship_line" value="<?=$k?>"><?=$v?></label> 
				<?}?>  
			  </td>
			</tr>
			<tr>
			  <td align="right"><font color="red">*</font>  出发港口：</td>
			  <td>
				<?
				foreach ($g_ship_port as $k => $v) {
				?>
				<label class="radio inline"><input type="radio" name="ship_port" value="<?=$k?>" required><?=$v?></label>
				<?}?>  
			  </td>
			</tr>
			<tr>
			  <td align="right"><font color="red">*</font>  邮轮品牌：</td>
			  <td>
				<?
				foreach ($g_ship_brand as $k => $v) {
				?>
				<label class="radio inline"><input type="radio" name="ship_brand" value="<?=$k?>" required><?=$v?></label> 
				<?}?>  
			  </td>
			</tr> 
			<tr>
			  <td align="right"><font color="red">*</font> 上船地点：</td>
			  <td><select id="src_prov" name="src_prov" class="span2" required>
				</select>
				<select id="src_city" name="src_city" class="span2">
				</select>
				<script language="javascript">  
					new PCAS("src_prov","src_city","","");
					</script>
			  </td>
			<tr>
			  <td align="right"><font color="red">*</font> 下船地点：</td>
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
				  <td align="right">游客需提前：</td>
				  <td><input type="number" class="span1 text-center" name="before_days" value="1"/>
					天预订 </td>
			</tr>
			<tr>
				  <td align="right">游客需在：</td>
				  <td><input type="time" name="ahead_time" value="23:59"/>
					之前预订 </td>
			</tr>
			<tr>
			  <td align="right" height="70"><font color="red">*</font> 自定义分类：</td>
			  <td>
				<select name="shop_cat_id" id="shop_cat_id" class="span4"> 
				  <option value=""></option>
				  <?  
				  $shop_cat1 = get_shop_cat_list(0);
				  if(notnull($shop_cat1)){ 
					  foreach ($shop_cat1 as $val1){
						  $shop_cat2 = get_shop_cat_list($val1['cat_id']);
				  ?>
					  <option value="<?=$val1['cat_id']?>" <?if(notnull($shop_cat2)){?>disabled<?}?>>
					  <?=$val1['cat_name']?>
					  </option>
					  <?   
					  if(notnull($shop_cat2)){ 
						  foreach ($shop_cat2 as $val2){ 
					  ?>
					  <option value="<?=$val2['cat_id']?>">
					  &nbsp; &nbsp; > <?=$val2['cat_name']?>
					  </option>
					  <?
						  }	
					  }
					  ?>
				  <?
					  }	
				  }
				  ?>
				</select>
				商家自定义的类别
			  </td>
			</tr> 
			<?if($g_shop['is_verify_goods']!='1'){?>
			<tr>
			  <td align="right"><font color="red">*</font> 上下架：</td>
			  <td><input type="radio" name="is_sale" value="1" checked>
				立即上架
				<input type="radio" name="is_sale" value="0" >
				放入仓库 </td>
			</tr> 
			<?}else{?>
			<input type="hidden" name="is_sale" value="-1" >
			<?}?>
		</table> 
	</div> 
	<div class="tab-pane" id="tabs-3">   
		<table width="100%">  
			<tr>
			  <td width="100" align="right" height="80"><font color="red">*</font> 产品主图：</td>
			  <td><input name="goods_image" type="file" id="goods_image" size="60" class="btn"/></td>
			</tr> 
			<tr>
			  <td align="right"><font color="red">*</font> 产品图册：</td>
			  <td>
				  <table class="table ">
					  <tr>
						<td width="70">图片1：</td>
						<td><input name="goods_image1" type="file" id="goods_image1" size="60" class="btn"/></td>
					  </tr>
					  <tr>
						<td>图片2：</td>
						<td><input name="goods_image2" type="file" id="goods_image2" size="60" class="btn"/></td>
					  </tr>
					  <tr>
						<td>图片3：</td>
						<td><input name="goods_image3" type="file" id="goods_image3" size="60" class="btn"/></td>
					  </tr>
					  <tr>
						<td>图片4：</td>
						<td><input name="goods_image4" type="file" id="goods_image4" size="60" class="btn"/></td>
					  </tr>
					  <tr>
						<td>图片5：</td>
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
		  <td align="right">产品特色：</td>
		  <td><br/><textarea name="summary" cols="70" rows="3" id="summary" style="width:97%;height:100px;visibility:hidden;"><?=stripslashes($goods['summary'])?></textarea><br/>
		  </td>
		</tr>
		<tr>
          <td align="right"><font color="red">*</font> 产品描述：</td>
          <td><textarea id="goods_content" name="goods_content" style="width:97%;height:400px;visibility:hidden;"><?=stripslashes($goods['content'])?></textarea> <br/></td>
        </tr>

			<?if(in_array($c_goods_type, array(1,2,6))){?>
			<tr>
			  <td align="right"><font color="red">*</font> 行程天数：</td>
			  <td><input type="text" class="span1 text-center" id="line_days" name="line_days" value="2" onchange="load_days()"/>
				天
				<input type="text" class="span1 text-center" name="line_nights" value="1"/>
				晚 </td>
			</tr>
			<tr>
			  <td align="right" valign="top">
			    <br/>
				<font color="red">*</font> 行程描述： 
			  </td>
			  <td style="padding-top:20px">  
						<div id="days_tpl" style="display:none"><?=$desc_tpl['tpl03']?></div>
						<div id="days_content"></div>

						<script type="text/javascript"> 
						function get_day_html(the_day){
							var day_html = '';
							day_html += '<table width="100%" class="table table-hover table-bordered">';
							day_html += '<tr>';
							day_html += '	<td align="right" width="10%">第 <b style="font-size:18px;color:red">'+the_day+'</b> 天：</td>';
							day_html += '	<td><input type="text" name="day_title['+the_day+']"></td>';
							day_html += '</tr>'; 
							day_html += '<tr>';
							day_html += '	<td align="right" width="10%"></td>';
							day_html += '	<td>交通<input type="text" name="day_tool['+the_day+'][traffic]"> 住宿<input type="text" name="day_tool['+the_day+'][house]"> 餐饮<input type="text" name="day_tool['+the_day+'][food]"></td>';
							day_html += '</tr>';
							day_html += '<tr>';
							day_html += '	<td align="right">行程：</td>';
							day_html += '	<td><textarea id="day_content_'+the_day+'" name="day_content['+the_day+']" style="width:90%;height:150px;" ></textarea></td>';
							day_html += '</tr>';
							day_html += '<tr>';
							day_html += '	<td align="right">照片：</td>';
							day_html += '	<td>';
							day_html += '	<i>景点、酒店、美食的照片</i><br/>';
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
							autoFrame();
						} 
						if($('#days_content').html()==''){load_days()}
						</script>   
			  </td>
			</tr>
			<tr>
			  <td align="right" valign="top"><br/>
				<font color="red">*</font> 费用说明：</td>
			  <td>
				<i>费用包含：</i><br/>
				<textarea name="price_note" style="height:100px;width:97%" id="price_note"  ><?=$desc_tpl['tpl01']?></textarea><br/><br/>

				<i>费用不含：</i><br/>
				<textarea name="unprice_note" style="height:100px;width:97%" id="unprice_note" ><?=$desc_tpl['tpl04']?></textarea> 
				</td>
			</tr> 
			<?}?>

			<tr>
			  <td align="right" valign="top"><br/><br/>
				<font color="red">*</font> 预订须知：</td>
			  <td><br/><br/><textarea name="order_note" style="width:97%;height:200px;" id="order_note"  ><?=$desc_tpl['tpl02']?></textarea></td>
			</tr>   
		  </table>
		  </div>
		  <div id="tabs-5" class="tab-pane">
		  <table width="100%">
		    <tr>
			  <td align="right" width="90">原 价：</td>
			  <td><input type="number" name="market_price" maxlength="6" /> 元</td>
			</tr> 
			<?if(in_array($c_goods_type, array(3))){?>
			<tr>
			  <td align="right"> 
				<font color="red">*</font> 现 价：</td>
			  <td><input type="number" step="0.01" name="real_price" maxlength="6" /> 元 </td>
			</tr>
			<tr>
			  <td align="right"> 
				<font color="red">*</font> 库存量：</td>
			  <td><input type="number" name="stock" maxlength="6" /></td>
			</tr>
			<?}?>

			<?if(in_array($c_goods_type, array(3))==false){?> 
			<tr>
			  <td align="right"><font color="red">*</font> 团 期：</td>
			  <td style="padding-left:20px"><table width="100%">
				  <tr>
					<td><label class="inline checkbox">
					  <input type="checkbox" class="J_week_all_select"/>
					  天天发</label>
					  <label class="inline checkbox">
					  <input type="checkbox" class="J_week_select" value="1"/>
					  周一</label>
					  <label class="inline checkbox">
					  <input type="checkbox" class="J_week_select" value="2"/>
					  周二</label>
					  <label class="inline checkbox">
					  <input type="checkbox" class="J_week_select" value="3"/>
					  周三</label>
					  <label class="inline checkbox">
					  <input type="checkbox" class="J_week_select" value="4"/>
					  周四</label>
					  <label class="inline checkbox">
					  <input type="checkbox" class="J_week_select" value="5"/>
					  周五</label>
					  <label class="inline checkbox">
					  <input type="checkbox" class="J_week_select" value="6"/>
					  周六</label>
					  <label class="inline checkbox">
					  <input type="checkbox" class="J_week_select" value="0"/>
					  周日</label>
					</td>
					<td rowspan="2">&nbsp; <a href="javascript:void(0)" onclick="change_batch_price();" class="btn btn-warning btn-small" style="color:white">批量添加 <i class="icon-chevron-down icon-white"></i></a></td>
				  </tr>
				  <tr>
					<td> 
					  成人：
					  <input type="text" class="span1" id="ref_adult_price"  name="ref_adult_price" maxlength="6" placeholder="价格"/>
					  <input type="text" class="span1" id="ref_adult_stock"  name="ref_adult_stock" maxlength="6" placeholder="库存"/>
					  &nbsp;
					  儿童：
					  <input type="text" class="span1" id="ref_kid_price" name="ref_kid_price" maxlength="6" placeholder="价格"/>
					  <input type="text" class="span1" id="ref_kid_stock" name="ref_kid_stock" maxlength="6" placeholder="库存"/>
					  &nbsp;
					  单房差：
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
					  年
					  <h2>
						<?=date('m')?>
						月</h2></td>
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
					  年
					  <h2>
						<?=date('m', strtotime($next01[0]))?>
						月</h2></td>
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
					  年
					  <h2>
						<?=date('m', strtotime($next02[0]))?>
						月</h2></td>
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
					  年
					  <h2>
						<?=date('m', strtotime($next03[0]))?>
						月</h2></td>
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
  <div class="tab-pane" id="tabs-6">

		<table width="100%">
			<tr>
			  <td width="100" align="right"><font color="red">*</font> 房间最大入住数：</td>
			  <td><input type="number" class="span1 text-center" name="room_max" value="1"/></td>
			</tr>
			<tr>
			  <td width="100" align="right"><font color="red">*</font> 最大订购数量：</td>
			  <td><input type="number" class="span1 text-center" name="max" value="1"/></td>
			</tr>
			<tr>
			  <td width="100" align="right"><font color="red">*</font> 最大订购数量：</td>
			  <td><input type="number" class="span1 text-center" name="min" value="1"/></td>
			</tr>
			<tr>
			  <td width="20%" align="right"><font color="red">*</font>姓名是否必填：</td>
			  <td>
				<label class="radio inline">
				<input name="traveller_name" type="radio" value="TRAV_NUM_ALL">
				全部需要</label>
				<label class="radio inline">
				<input name="traveller_name" type="radio" value="TRAV_NUM_ONE">
				只要一个</label>
				<label class="radio inline">
				<input name="traveller_name" type="radio" value="TRAV_NUM_NO" checked="checked">
				不需要</label>
			  </td>
			</tr>
			<tr>
			  <td width="20%" align="right"><font color="red">*</font>英文名是否必填：</td>
			  <td>
				<label class="radio inline">
				<input name="traveller_en_name" type="radio" value="TRAV_NUM_ALL">
				全部需要</label>
				<label class="radio inline">
				<input name="traveller_en_name" type="radio" value="TRAV_NUM_ONE">
				只要一个</label>
				<label class="radio inline">
				<input name="traveller_en_name" type="radio" value="TRAV_NUM_NO" checked="checked">
				不需要</label>
			  </td>
			</tr>
			<tr>
			  <td width="20%" align="right"><font color="red">*</font>手机号是否必填： </td>
			  <td>
				<label class="radio inline">
				<input name="traveller_mobile" type="radio" value="TRAV_NUM_ALL">
				全部需要</label>
				<label class="radio inline">
				<input name="traveller_mobile" type="radio" value="TRAV_NUM_ONE">
				只要一个</label>
				<label class="radio inline">
				<input name="traveller_mobile" type="radio" value="TRAV_NUM_NO" checked="checked">
				不需要</label>
			  </td>
			</tr>
			<tr>
			  <td width="20%" align="right"><font color="red">*</font>email是否必填： </td>
			  <td>
				<label class="radio inline">
				<input name="traveller_email" type="radio" value="TRAV_NUM_ALL">
				全部需要</label>
				<label class="radio inline">
				<input name="traveller_email" type="radio" value="TRAV_NUM_ONE">
				只要一个</label>
				<label class="radio inline">
				<input name="traveller_email" type="radio" value="TRAV_NUM_NO" checked="checked">
				不需要</label>
			  </td>
			</tr>
			<tr>
			  <td width="20%" align="right"><font color="red">*</font>证件是否必填： </td>
			  <td>
				<label class="radio inline">
				<input name="traveller_credentials" type="radio" value="TRAV_NUM_ALL">
				全部需要</label>
				<label class="radio inline">
				<input name="traveller_credentials" type="radio" value="TRAV_NUM_ONE">
				只要一个</label>
				<label class="radio inline">
				<input name="traveller_credentials" type="radio" value="TRAV_NUM_NO" checked="checked">
				不需要</label>
			  </td>
			</tr> 
			<tr>
			  <td width="20%" align="right"><font color="red">*</font>性别是否必填： </td>
			  <td>
				<label class="radio inline">
				<input name="traveller_gender" type="radio" value="TRAV_NUM_ALL">
				全部需要</label>
				<label class="radio inline">
				<input name="traveller_gender" type="radio" value="TRAV_NUM_ONE">
				只要一个</label>
				<label class="radio inline">
				<input name="traveller_gender" type="radio" value="TRAV_NUM_NO" checked="checked">
				不需要</label>
			  </td>
			</tr>
			<tr>
			  <td width="20%" align="right"><font color="red">*</font>人群是否必填： </td>
			  <td>
				<label class="radio inline">
				<input name="traveller_person_type" type="radio" value="TRAV_NUM_ALL">
				全部需要</label>
				<label class="radio inline">
				<input name="traveller_person_type" type="radio" value="TRAV_NUM_ONE">
				只要一个</label>
				<label class="radio inline">
				<input name="traveller_person_type" type="radio" value="TRAV_NUM_NO" checked="checked">
				不需要</label>
			  </td>
			</tr>
			<tr>
			  <td width="20%" align="right"><font color="red">*</font>生日是否必填： </td>
			  <td>
				<label class="radio inline">
				<input name="traveller_birthday" type="radio" value="TRAV_NUM_ALL">
				全部需要</label>
				<label class="radio inline">
				<input name="traveller_birthday" type="radio" value="TRAV_NUM_ONE">
				只要一个</label>
				<label class="radio inline">
				<input name="traveller_birthday" type="radio" value="TRAV_NUM_NO" checked="checked">
				不需要</label>
			  </td>
			</tr>
			<tr>
			  <td width="20%" align="right"><font color="red">*</font>是否需要紧急联系人： </td>
			  <td>
				<label class="radio inline">
				<input name="emergency" type="radio" value="true">
				需要</label>
				<label class="radio inline">
				<input name="emergency" type="radio" value="false" checked="checked">
				不需要</label>
			  </td>
			</tr>
			<tr>
			  <td width="20%" align="right"><font color="red">*</font> 购买人email是否必填：</td>
			  <td height="30">
				<label class="radio inline">
				<input name="booker_email" type="radio" id="sale_type" value="true" />
				是
				</label>
				<label class="radio inline">
				<input name="booker_email" type="radio" id="sale_type" value="false" checked="checked" />
				否
				</label>
				</td>
			</tr>
			<tr>
			  <td width="20%" align="right"><font color="red">*</font>证件类型： </td>
			  <td>
				<label class="radio inline">
				<input name="traveller_credentials_type" type="radio" value="ID_CARD" checked="checked">
				身份证</label>
				<label class="radio inline">
				<input name="traveller_credentials_type" type="radio" value="HUZHAO">
				护照</label>
				<label class="radio inline">
				<input name="traveller_credentials_type" type="radio" value="HUKOUBO">
				户口簿</label>
				<label class="radio inline">
				<input name="traveller_credentials_type" type="radio" value="GANGAO">
				港澳通行证</label>
				<label class="radio inline">
				<input name="traveller_credentials_type" type="radio" value="TAIBAO">
				台湾通行证</label>
				<label class="radio inline">
				<input name="traveller_credentials_type" type="radio" value="HUIXIANG">
				回乡证</label>
				<label class="radio inline">
				<input name="traveller_credentials_type" type="radio" value="SHIBING">
				士兵证</label>
				<label class="radio inline">
				<input name="traveller_credentials_type" type="radio" value="JUNGUAN">
				军官证</label>
				<label class="radio inline">
				<input name="traveller_credentials_type" type="radio" value="CHUSHENGZHENGMING">
				出生证明</label>
				<label class="radio inline">
				<input name="traveller_credentials_type" type="radio" value="TAIBAOZHENG">
				台胞证</label>
				<label class="radio inline">
				<input name="traveller_credentials_type" type="radio" value="OTHER">
				其他</label>
				<label class="radio inline">
				<input name="traveller_credentials_type" type="radio" value="ERTONG">
				儿童无证件</label>
				<label class="radio inline">
				<input name="traveller_credentials_type" type="radio" value="CUSTOMER_SERVICE_ADVICE">
				客服联系我</label>
			  </td>
			</tr>      
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