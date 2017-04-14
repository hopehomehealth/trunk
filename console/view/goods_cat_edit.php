<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?> 

<ul class="nav nav-tabs">   
	<li class="active" style="padding-left:20px;">
		<a href="#">更改分类信息</a>
	</li>  
	<a href="javascript:void(0)" onclick="history.back()" class="pull-right btn btn-small">返回</a>
</ul>  
 
	<form target="frm" method="post" action="do.php?cmd=goods_cat_update" enctype="multipart/form-data">
		<input type="hidden" name="cat_id" value="<?=$this_cat['cat_id']?>">
	  
		<table width="100%"> 
		    <tr>
			  <td width="100" align="right">&nbsp; <font color="red">*</font>上级分类：</td>
			  <td>
				<select name="parent_id" class="span6"> 
					<option value="0"></option>
					<?  
					$cat01 = son_cat('0');
					if(notnull($cat01)){
						foreach ($cat01 as $val01){   
							echo get_cat_select($val01, 0); 
								  
							$cat02 = son_cat($val01['cat_id']);
							if(notnull($cat02)){
								foreach ($cat02 as $val02){   
									echo get_cat_select($val02, 1); 
								}
							}
						}
					}
					?>
				</select>
			  </td>
			</tr> 
			<tr>
			  <td align="right">&nbsp; <font color="red">*</font>分类名称：</td>
			  <td>
				<input name="cat_name" type="text" id="cat_name"  class="span6" value="<?=$this_cat['cat_name']?>" required/>
			  </td>
			</tr>
			<tr>
			  <td align="right">&nbsp; <font color="red">*</font>关键词：</td>
			  <td>
				<input name="cat_key" type="text" id="cat_key"  class="span6" pattern="[a-z]{1,50}" required value="<?=$this_cat['cat_key']?>"/>
			  </td>
			</tr>
			<tr>
			  <td align="right">分类简介：</td>
			  <td><textarea name="cat_note" cols="60" rows="5"  class="span6"><?=stripslashes($this_cat['cat_note'])?></textarea> 
			  </td> 
			</tr> 
			<tr>
			  <td align="right">分类图标：</td>
			  <td>
				<?if($this_cat['cat_ico']!=''){?>
				<img src="/upfiles/<?=$g_siteid?>/<?=$this_cat['cat_ico']?>" style="height:60px;padding-bottom:10px"><br/>
				<?}?>
				<input name="cat_ico" type="file" id="cat_ico" size="50" value="<?=$this_cat['cat_ico']?>"/>
			  </td>
			</tr> 
			<tr>
			  <td align="right"><font color="red">*</font>序 号：</td>
			  <td>
				<input name="order_id" type="number" id="order_id" class="span6" value="<?=$this_cat['order_id']?>" />
			  </td>
			</tr> 
			<tr>
			  <td align="right">是否推荐：</td>
			  <td >
					<select name="is_hot" class="span6">  
					  <option value="0" <? if($this_cat['is_hot']==0) {echo 'selected';} ?> >非推荐</option> 
					  <option value="1" <? if($this_cat['is_hot']==1) {echo 'selected';} ?> >推荐^</option> 
					</select>	
			  </td> 
			</tr> 
			<tr>
			  <td align="right">SEO/标题：</td>
			  <td><input type="text" name="page_title" class="span9" value="<?=$this_cat['page_title']?>" placeholder="每个关键词使用下划线风格，如：上海旅行社_上海旅行社报价_上海旅游公司"/></td> 
			</tr>  
			<tr>
			  <td align="right">SEO/描述：</td>
			  <td><textarea name="page_description" class="span9" rows="3" ><?=$this_cat['page_description']?></textarea></td> 
			</tr>  
			<tr>
			  <td align="right">SEO/关键词：</td>
			  <td><input type="text" name="page_keywords" class="span9" value="<?=$this_cat['page_keywords']?>" placeholder="每个关键词使用小写逗号风格，如：上海旅行社,上海旅行社报价,上海旅游公司"/></td> 
			</tr>   
			<tr>
			  <td align="right"></td>
			  <td> 
			  <input type="submit" value="确定" class="btn btn-danger" />
			  &nbsp;
			  <input type="button" value="取消" class="btn " onclick="history.back()"/>
			  </td>
			</tr>
		  </table>  
	</form> 