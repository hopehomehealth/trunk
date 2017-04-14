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
		alert('对不起，请选择分类！');
		return false;
	}  
	if(myform.goods_name.value==''){
		alert('对不起，请输入产品名称！');
		return false;
	} 
	<?if($goods['goods_image']==""){?>
	if(myform.goods_image.value==''){
		alert('对不起，请上传产品主图！');
		return false;
	} 
	<?}?>
	if(myform.line_days.value==''){
		alert('对不起，请输入行程天数！');
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
  <li style="padding-left:20px"><a href="#tabs-1">选择分类</a></li>
  <li class="active" ><a href="#tabs-2">基本信息</a></li>
  <li><a href="#tabs-3">产品图片</a></li>
  <li><a href="#tabs-4">产品描述</a></li>
  <li><a href="#tabs-5">团期/价格</a></li> 

  <input type="button" value=" 返回 " class="btn pull-right" onclick="history.back()" style="margin-left:5px"/>
  <a href="javascript:void(0)" onclick="window.open('preview.php?ac=goods&goods_id=<?=$goods['goods_id']?>')" target="_blank" class="btn btn-info pull-right " style="color:white;margin-left:5px"/>预览</a>
  <input type="submit" value="立即发布" class="btn btn-warning pull-right"/>
</ul>

<div class="tab-content"> 
    <div class="tab-pane" id="tabs-1">  
			<div class="alert">提示：如果分类较多，可按CTRL+F，输入产品关键词，快速定位到该分类。</div>
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
				<label <?if($goods['cat_id']==$val['cat_id']){?>style="color:red;"<?}?>><input type="radio" name="goods_cat_id" value="<?=$val['cat_id']?>" <?if($goods['cat_id']==$val['cat_id']){?>checked<?}?>> 选择</label>
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
          <td width="90" align="right">商家：</td>
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
          <td align="right"><font color="red">*</font> 产品名称：</td>
          <td><input name="goods_name" type="text" class="span6" id="goods_name" size="60" value="<?=$goods['goods_name']?>"/>
          </td>
        </tr>
        <tr>
          <td align="right">产品编码：</td>
          <td><input name="goods_code" type="text" class="span3" id="goods_code" size="60" value="<?=$goods['goods_code']?>"/>
          </td>
        </tr>
		<tr>
		  <td align="right"><font color="red">*</font> 产品别名：</td>
		  <td><input name="goods_doc" type="text" class="span3" id="goods_doc" size="80" value="<?=$goods['goods_doc']?>"/></td>
		</tr>
		
		<?if(in_array($c_goods_type, array(1,2))){?>
		<tr>
		  <td align="right"><font color="red">*</font> 区域类型：</td>
		  <td>
			<?foreach ($g_product_zone as $k => $v) {?> 
			<label class="radio inline">
			<input name="goods_zone" type="radio" value="<?=$k?>" <?if($k == $goods['goods_zone']) echo 'checked';?>>
			<?=$v?></label>
			<?}?>  
		  </td>
		</tr>
		<tr>
          <td align="right" valign="top"><font color="red">*</font> 销售类型：</td>
          <td>
		    <label class="radio inline">
		    <input name="sale_type" type="radio" id="sale_type" value="0" <?if($goods['sale_type']=='0') echo 'checked';?> onclick="document.getElementById('sale_date').style.display='none'"/>
            常规</label>

			<label class="radio inline">
            <input name="sale_type" type="radio" id="sale_type" value="1" <?if($goods['sale_type']=='1') echo 'checked';?> onclick="document.getElementById('sale_date').style.display='block'"/>
            团购</label>

			<label class="radio inline">
            <input name="sale_type" type="radio" id="sale_type" value="2" <?if($goods['sale_type']=='2') echo 'checked';?> onclick="document.getElementById('sale_date').style.display='block'"/>
            秒杀</label> 
			<table id="sale_date" <?if($goods['sale_type']=='0'){?>style="display:none"<?}?>>
				<tr>
				  <td align="right"> 销售起始日期：</td>
				  <td><input id="sale_start" name="sale_start" class="Wdate" type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" value="<?=$goods['sale_start']?>" style="background:none">
					团购/秒杀必填 </td>
				</tr>
				<tr>
				  <td align="right"> 销售结束日期：</td>
				  <td><input id="sale_end" name="sale_end" class="Wdate" type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" value="<?=$goods['sale_end']?>" style="background:none">
					团购/秒杀必填 </td>
				</tr> 
		    </table>
          </td>
        </tr> 
        <tr>
          <td align="right"><font color="red">*</font> 出发城市：</td>
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
          <td align="right"><font color="red">*</font> 目的城市：</td>
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
          <td align="right"><font color="red">*</font> 交通：</td>
          <td><select name="goto_transport" class="span2">
              <option value=""> 去程 >> </option>
			  <?foreach ($g_product_road as $k => $v) {?>
			  <option value="<?=$k?>" <?if($k == $goods['goto_transport']) echo 'selected';?>><?=$v?></option>
			  <?}?> 
            </select> 
            <select name="back_transport" class="span2">
              <option value=""> 返程 << </option>
			  <?foreach ($g_product_road as $k => $v) {?>
			  <option value="<?=$k?>" <?if($k == $goods['back_transport']) echo 'selected';?>><?=$v?></option>
			  <?}?> 
            </select>
          </td>
        </tr>  
        <tr>
          <td align="right">主题标签：</td>
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
			  <td width="120" align="right"><font color="red">*</font> 邮轮名称：</td>
			  <td><input name="ship_name" type="text" class="span6" id="ship_name" size="50" value="<?=$goods['ship_name']?>" required /></td>
        </tr>   
        <tr>
			  <td align="right"><font color="red">*</font>  邮轮航线：</td>
			  <td>
				<?
				foreach ($g_ship_line as $k => $v) {
				?>
				<label class="checkbox inline"><input type="checkbox" name="ship_line[]" id="ship_line" value="<?=$k?>" <?if(strpos($goods['ship_line'], '"'.$k.'"')!==false) echo 'checked';?>><?=$v?></label> 
				<?}?>  
			  </td>
        </tr>
        <tr>
			  <td align="right"><font color="red">*</font>  出发港口：</td>
			  <td>
				<?
				foreach ($g_ship_port as $k => $v) {
				?>
				<label class="radio inline"><input type="radio" name="ship_port" value="<?=$k?>" <?if($goods['ship_port']==$k) echo 'checked';?> required><?=$v?></label>
				<?}?>  
			  </td>
        </tr>
        <tr>
			  <td align="right"><font color="red">*</font>  邮轮品牌：</td>
			  <td>
				<?
				foreach ($g_ship_brand as $k => $v) {
				?>
				<label class="radio inline"><input type="radio" name="ship_brand" value="<?=$k?>" <?if($goods['ship_brand']==$k) echo 'checked';?> required><?=$v?></label> 
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
					new PCAS("src_prov","src_city","<?=$goods['src_prov']?>","<?=$goods['src_city']?>");
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
					new PCAS("dist_prov","dist_city","<?=$goods['dist_prov']?>","<?=$goods['dist_city']?>");
				</script>
			  </td>
        </tr> 
        <?}?>

        <?if(in_array($c_goods_type, array(3))){?>
        <tr>
				  <td align="right"><font color="red">*</font>所属国家：</td>
				  <td>  
					<?foreach ($visa_zone_list as $val) {?> 
					<label class="radio inline">
					<input name="visa_zone_id" type="radio" value="<?=$val['zone_id']?>" <?if($goods['visa_zone_id']==$val['zone_id']) echo 'checked';?>>
					<?=$val['zone_name']?></label>
					<?}?> 
			  </td>
        </tr> 
        <tr>
				  <td align="right" height="40"><font color="red">*</font>签证类型：</td>
				  <td>  
					<?foreach ($g_visa_type as $k => $v) {?> 
					<label class="radio inline">
					<input name="visa_type" type="radio" value="<?=$k?>" <?if($goods['visa_type']==$k) echo 'checked';?>>
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
							<td><input type="text" name="visa[SQD]" placeholder="上海" value="<?=$visa['SQD']?>"></td>
							<td>入境次数：</td>
							<td><input type="text" name="visa[RJCS]" placeholder="一次" value="<?=$visa['RJCS']?>"></td>
						</tr>
						<tr>
							<td>有效期：</td>
							<td><input type="text" name="visa[YXQ]" placeholder="3个月" value="<?=$visa['YXQ']?>"></td>
							<td>是否面试：</td>
							<td><input type="text" name="visa[SFMS]" placeholder="否" value="<?=$visa['SFMS']?>"></td>
						</tr>
						<tr>
							<td>是否需录指纹：</td>
							<td><input type="text" name="visa[SFXLZW]" placeholder="否" value="<?=$visa['SFXLZW']?>"></td>
							<td>是否销签：</td>
							<td><input type="text" name="visa[SFXQ]" placeholder="否" value="<?=$visa['SFXQ']?>"></td>
						</tr>
						<tr>
							<td>是否需担保金：</td>
							<td><input type="text" name="visa[SFXDBJ]" placeholder="否" value="<?=$visa['SFXDBJ']?>"></td>
							<td>最长停留时间：</td>
							<td><input type="text" name="visa[ZCTLSJ]" placeholder="否" value="<?=$visa['ZCTLSJ']?>"></td>
						</tr>
						<tr>
							<td>办理周期：</td>
							<td colspan="3"><input type="text" name="visa[BLZQ]" placeholder="送签后的8个工作日" value="<?=$visa['BLZQ']?>">（以领馆受理时长为准，建议提早办理）</td> 
						</tr> 
						<tr> 
							<td>受理范围：</td>
							<td colspan="3">
							<textarea name="visa[SLFW]" rows="2" class="span9" placeholder="上海市、江苏省、浙江省、安徽省、如护照签发地不在上述地区内，必须提供在上述地区居住的有效暂住证或者居住证原件。"><?=$visa['SLFW']?></textarea>
							</td>
						</tr> 
					</table> 
				  </td>
        </tr> 
        <?}?>
        <tr>
			  <td align="right"><font color="red">*</font> 游客需提前：</td>
			  <td><input type="text" class="span1 text-center" name="before_days" value="<?=$goods['before_days']?>"/>
				天预订 </td>
        </tr>
        <tr>
			  <td align="right"><font color="red">*</font> 上下架：</td>
			  <td><input type="radio" name="is_sale" value="1" <?if($goods['is_sale']=='1'){?>checked<?}?>>
					立即上架
					<input type="radio" name="is_sale" value="0"  <?if($goods['is_sale']=='0'){?>checked<?}?>>
					放入仓库 </td>
        </tr> 
	  </table>
	</div>
	<div class="tab-pane" id="tabs-3">   
	  <div class="alert">
		如需更换图片，请选择新的图片，保存发布即可。
	  </div>
      <table width="100%" class="table table-bordered">  
          <tr>
			  <td style="width:90px;text-align:right"><font color="red">*</font> 产品主图：</td>
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
          // 查询其他图片
          $sql = "SELECT * FROM `t_goods_image` WHERE site_id='$g_siteid' AND goods_id='$goods_id' ORDER BY image_id ASC";
          $images = $db->get_all($sql); 
          for($i=0; $i<5; $i++){
          ?> 
          <tr>
			  <td style="text-align:right">图片<?=$i+1?>：</td>
			  <td>
					<?if($images[$i]['image_id']!=''){?>
					<div id="goods_images_<?=$images[$i]['image_id']?>"> 
					<a href="do.php?cmd=goods_image_del&image_id=<?=$images[$i]['image_id']?>" target="frm" style="position:absolute;font-size:18px;color:red;margin-left:130px;" title="删除" onclick="return confirm('确认删除吗？')">×</a>
						<img src="http://<?=$g_site_domain?>/upfiles/<?=$g_siteid?>/<?=$images[$i]['filepath']?>"  style="width:152px"/> 
						
					</div>
					<?}else{?>
					未上传
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
          <td><input type="text" class="span1 text-center" id="line_days"  name="line_days" value="<?=$goods['line_days']?>"/>
            天
            <input type="text" class="span1 text-center" name="line_nights" value="<?=$goods['line_nights']?>"/>
            晚 </td>
        </tr>
		<tr>
		  <td align="right" valign="top">
		    <br/>
		    <font color="red">*</font> 行程描述： 
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
						<td align="right" width="10%">第 <b style="font-size:28px;color:red"><?=$i?></b> 天：</td>
						<td><input type="text" name="day_title[<?=$i?>]" value="<?=$all_titles?>" class="span6"></td>
					</tr>
					<tr>
						<td align="right" width="10%"></td>
						<td>
							交通： <input type="text" name="day_tool[<?=$i?>][traffic]" value="<?=$all_tools['traffic']?>"> 
							住宿： <input type="text" name="day_tool[<?=$i?>][house]" value="<?=$all_tools['house']?>"> 
							餐饮： <input type="text" name="day_tool[<?=$i?>][food]" value="<?=$all_tools['food']?>">
						</td>
					</tr>
					<tr>
						<td align="right">行程：</td>
						<td><textarea id="day_content_<?=$i?>" name="day_content[<?=$i?>]" style="width:90%;height:150px;"  ><?=$all_contents?></textarea></td>
					</tr>
					<tr>
						<td align="right">照片：</td>
						<td>
						<i>景点、酒店、美食的照片</i><br/> 

						<input type="hidden" name="day_file_src[<?=$i?>][1]" value="<?=$all_images[1]?>">
						<input type="hidden" name="day_file_src[<?=$i?>][2]" value="<?=$all_images[2]?>">
						<input type="hidden" name="day_file_src[<?=$i?>][3]" value="<?=$all_images[3]?>">
						<input type="hidden" name="day_file_src[<?=$i?>][4]" value="<?=$all_images[4]?>">

						<table style="background-color:#efefef">
						  <tr>
							<td><img src="<?=$all_images[1]?>" style="width:60px;height40px" onerror="this.style.display='none'">
							<br/>图1：<input type="file" name="day_file[<?=$i?>][1]"> 
							</td>
							<td><img src="<?=$all_images[2]?>" style="width:60px;height40px" onerror="this.style.display='none'">
							<br/>图2：<input type="file" name="day_file[<?=$i?>][2]"> 
							</td>
						  </tr>
						  <tr>
							<td><img src="<?=$all_images[3]?>" style="width:60px;height40px" onerror="this.style.display='none'">
							<br/>图3：<input type="file" name="day_file[<?=$i?>][3]"> 
							</td>
							<td><img src="<?=$all_images[4]?>" style="width:60px;height40px" onerror="this.style.display='none'">
							<br/>图4：<input type="file" name="day_file[<?=$i?>][4]"> 
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
            <font color="red">*</font> 费用说明：</td>
          <td>  
			<i>费用包含：</i><br/>
			<textarea name="price_note" style="height:100px;width:97%" id="price_note"  ><?=$goods['price_note']?></textarea><br/><br/>

			<i>费用不含：</i><br/>
			<textarea name="unprice_note" style="height:100px;width:97%" id="unprice_note" ><?=$goods['unprice_note']?></textarea>
			
		  </td>
        </tr> 
		<?}?>
        <tr>
          <td align="right" valign="top"><br/>
            <font color="red">*</font> 预订须知：</td>
          <td><textarea name="order_note" style="width:97%;height:200px;" id="order_note" ><?=stripslashes($goods['order_note'])?></textarea></td>
        </tr>  
      </table> 
	</div> 
	<div id="tabs-5" class="tab-pane">
		<table width="100%">
			<tr>
			  <td width="90" align="right">原 价：</td>
			  <td><input type="number" name="market_price" maxlength="6" value="<?=$goods['market_price']?>"/> 元</td>
			</tr> 
			<?if(in_array($c_goods_type, array(3))){?>
			<tr>
			  <td align="right"> 
				<font color="red">*</font> 现 价：</td>
			  <td><input type="number" step="0.01" name="real_price" maxlength="6" value="<?=$goods['real_price']?>"/> 元 </td>
			</tr>
			<tr>
			  <td align="right"> 
				<font color="red">*</font> 库存量：</td>
			  <td><input type="number" name="stock" maxlength="6" value="<?=$goods['stock']?>"/></td>
			</tr>
			<?}?>
			<?if(in_array($c_goods_type, array(3))==false){?> 
			<tr>
			  <td align="right" style="width:90px"><font color="red">*</font> 团 期：</td>
			  <td><table width="100%">
				  <tr>
					<td><label class="inline checkbox">
					  <input type="checkbox" class="J_week_all_select"/>
					  天天发团</label>
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
					  <?
					  $ref = unserialize($goods['ref_price']);
					  ?> 

					  <font color="red">*</font> 成人：
					  <input type="text" class="span1" id="ref_adult_price"  name="ref_adult_price" maxlength="6" placeholder="价格" value="<?=$ref['ref_adult_price']?>" title="成人价格"/>
					  <input type="text" class="span1" id="ref_adult_stock"  name="ref_adult_stock" maxlength="6" placeholder="库存" value="<?=$ref['ref_adult_stock']?>" title="成人库存"/>
					  &nbsp; &nbsp;

					  儿童：
					  <input type="text" class="span1" id="ref_kid_price" name="ref_kid_price" maxlength="6" placeholder="价格" value="<?=$ref['ref_kid_price']?>" title="儿童价格"/>
					  <input type="text" class="span1" id="ref_kid_stock" name="ref_kid_stock" maxlength="6" placeholder="库存" value="<?=$ref['ref_kid_stock']?>" title="儿童库存"/>
					  &nbsp; &nbsp;

					  单房差：
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
					alert('请选择日期！');
				if($("#ref_adult_price").val()=='') 
					alert('请填写（成人）价格！');

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