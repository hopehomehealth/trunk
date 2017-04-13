<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?>
 

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
 
	if(myform.cat_id.value==''){
		alert('对不起，请选择商品分类！');
		return false;
	}
	if(myform.goods_name.value==''){
		alert('对不起，请输入商品名称！');
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

<form id="goods_form" name="goods_form" action="do.php?cmd=score_goods_edit" method="post" enctype="multipart/form-data" target="frm" onsubmit="return form_check()"> 
<input type="hidden" name="goods_id" value="<?=req('goods_id')?>">

<ul class="nav nav-tabs" id="myTab"> 
  <li class="active" style="padding-left:20px"><a href="#tabs-1">编辑积分商品</a></li>  
</ul>

<div class="tab-content"> 
	<div class="tab-pane in active" id="tabs-1">    
		<table width="100%">  
			<tr>
			  <td align="right"><font color="red">*</font> 商品分类：</td>
			  <td>
			  <select name="cat_id">
			    <option value=""></option>
				<?
				if(notnull($cat_list)){
					foreach ($cat_list as $val){ 
				?>
				<option value="<?=$val['cat_id']?>" <?if($val['cat_id']==$goods['cat_id']){?>selected<?}?>><?=$val['cat_name']?></option>
				<?
					}
				}
				?> 
			  </select>
			  </td>
			</tr>
			<tr>
			  <td align="right"><font color="red">*</font> 商品名称：</td>
			  <td><input name="goods_name" type="text" class="span6" id="goods_name" value="<?=$goods['goods_name']?>" required/></td>
			</tr>
			<tr>
			  <td align="right"><font color="red">*</font> 商品性质：</td>
			  <td><input type="radio" name="goods_prop" value="1" <?if($goods['goods_prop']=='1'){?>checked<?}?> required>
				实体商品
				<input type="radio" name="goods_prop" value="2" <?if($goods['goods_prop']=='2'){?>checked<?}?> required>
				虚拟商品 </td>
			</tr>  
			<tr>
			  <td align="right"> 商品编码：</td>
			  <td><input name="goods_code" type="text" class="span3" id="goods_code" value="<?=$goods['goods_code']?>" /></td>
			</tr>     
			<tr>
			  <td align="right"><font color="red">*</font>  市场价：</td>
			  <td><input name="market_price" type="text" class="span3" id="market_price" value="<?=$goods['market_price']?>" required/></td>
			</tr> 
			<tr>
			  <td align="right"><font color="red">*</font>  兑换积分：</td>
			  <td><input name="score_number" type="number" class="span3" id="score_number" value="<?=$goods['score_number']?>" required/></td>
			</tr> 
			<tr>
			  <td align="right"><font color="red">*</font>  库存量：</td>
			  <td><input name="stock" type="number" class="span3" id="stock" value="<?=$goods['stock']?>" required/></td>
			</tr>
			<tr>
			  <td width="100" align="right" ><font color="red">*</font> 商品主图：</td>
			  <td>
			  <?
			  if($goods['goods_image']!=""){
				  $goods_image = "/upfiles/$g_siteid/".$goods['goods_image'];
			  ?>
			  <img src="<?=$goods_image?>" style="width:152px;" class="thumbnail"/><br/>
			  <?
			  }
			  ?>

			  <input name="goods_image" type="file" id="goods_image" size="60" class="btn" /></td>
			</tr>   
			<tr>
			  <td align="right">商品特色：</td>
			  <td><br/><textarea name="summary" cols="70" rows="3" id="summary" style="width:97%;height:100px;visibility:hidden;"><?=stripslashes($goods['summary'])?></textarea><br/>
			  </td>
			</tr> 
			<tr>
			  <td align="right" valign="top"><font color="red">*</font> 商品描述：</td>
			  <td><textarea id="goods_content" name="goods_content" style="width:97%;height:400px;visibility:hidden;"><?=stripslashes($goods['content'])?></textarea><br/></td>
			</tr> 
			 
			<tr>
			  <td align="right"><font color="red">*</font> 上下架：</td>
			  <td><input type="radio" name="is_sale" value="1" <?if($goods['is_sale']=='1'){?>checked<?}?> required>
				立即上架
				<input type="radio" name="is_sale" value="0" <?if($goods['is_sale']=='0'){?>checked<?}?> required>
				放入仓库 </td>
			</tr> 

			<tr>
			  <td></td>
			  <td><br/><input type="submit" value=" 保存编辑 " class="btn btn-warning"/></td>
			</tr> 

			
		</table>
	</div>  
</div> 
</form>