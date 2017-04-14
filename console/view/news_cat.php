<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<ul class="nav nav-tabs">   
	<li <?if(nav_active('news_list.php')){?>class="active"<?}?> style="padding-left:20px;">
		<a href="?cmd=<?=base64_encode('news_list.php')?>">���¹���</a>
	</li>   
	<li <?if(nav_active('news_cat.php')){?>class="active"<?}?>>
		<a href="?cmd=<?=base64_encode('news_cat.php')?>">���·���</a>
	</li>   
	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">ˢ��</a>
</ul> 
  

		<form target="frm" method="post" action="do.php?cmd=news_cat_add" class="form-inline">
		  
				<font color="red">*</font> �����
				<input name="cat_name" type="text" id="cat_name" size="10"  class="span2" placeholder="�磺��ɽ"  required/>
				&nbsp;
				�ؼ���
				<input name="cat_key" type="text" id="cat_key" size="6" placeholder="������ƴ��..." class="span2" required/>
				&nbsp;
				���
				<input name="order_id" type="number" id="order_id" size="3" value="<?=$max_order_id?>" title="ǰ̨����������" class="span1"/>
				<font color="red">*</font> ����
				<select name="cat_type" style="width:100px">
					<option value="0">�����б�</option>
					<option value="1">ͼƬ�б�</option>
					<option value="2">ͼ�Ļ���</option>
				</select>
				&nbsp;
				<input type="submit" value="ȷ��" class="btn btn-danger" /> 
				 
		</form>
		<script type="text/javascript">
		function doform_news_cat(cat_id, item){
			var f =  document.getElementById('f'+cat_id);
			f.action = "do.php?cmd=news_cat_edit&cat_id="+cat_id+"&item="+item;
			f.submit();
		} 
		</script>
		<table width="100%" class="table table-hover"> 
		  <tr>   
			<td><strong>�������</strong></td> 
			<td><strong>���ؼ���</strong></td>  
			<td><strong>���</strong></td> 
			<td></td> 
			<td><strong>SEO����</strong></td>
			<td align="center"> <strong>����</strong></td> 
		  </tr> 
		  <? 
		  if(notnull($list01)){
			foreach ($list01 as $val){    
				get_item($val, 1);
				
				$list02 = get_cat($val['cat_id']);
				if(notnull($list02)){
					foreach ($list02 as $cval){    
						get_item($cval, 2);		
					}
				}
			}
		  }
		  ?>
		</table>

		<?
		function get_item($val, $level){
			global $g_site_domain, $list01;

			$cat_url = "/news/".$val['cat_key']."/";
		?>
		<form target="frm" id="f<?=$val['cat_id']?>" action="" method="post" >
		  <tr> 
			<td valign="top">    
				<input name="cat_name" type="text" id="cat_name" value="<?=$val['cat_name']?>" onchange="doform_news_cat('<?=$val['cat_id']?>', 'cat_name')"/> 	 
			</td> 

			<td valign="top">     
				<input name="cat_key" type="text" id="cat_key" value="<?=$val['cat_key']?>" onchange="doform_news_cat('<?=$val['cat_id']?>', 'cat_key')" <?if($val['cat_key']=='notice' || $val['cat_key']=='gonglue'){?>disabled<?}?>/> 	 
			</td> 

			<td valign="top"><input name="order_id" type="number" id="order_id" class="input-small" value="<?=$val['order_id']?>" size="5" onchange="doform_news_cat('<?=$val['cat_id']?>', 'order_id')"/></td>
			
			<td align="center" valign="top" class="text-center">  
				<i class="fa fa-search"></i> <a href="?cmd=<?=base64_encode('news_list.php')?>&cat_id=<?=$val['cat_id']?>" >��ѯ���� (<b style="color:red"><?=get_article_number($val['cat_id'])?></b>)</a>  
			</td>

			<td>
				<button onclick="dialog_edit('<?=url('seo_editor.php')?>&modal=true&primary_name=cat_id&primary_value=<?=$val['cat_id']?>&table_name=t_article_catalog')" style="cursor:pointer" <?if($val['page_title']!=''){?>class="btn btn-warning btn-mini" title="������"<?}else{?>class="btn btn-mini" title="δ����"<?}?>>SEO����</button>
			</td>

			<td align="center" valign="top" class="text-center">   
				<a href="<?=$cat_url?>" target="_blank"><img src="static/image/view.gif"/></a> &nbsp;

				<a href="do.php?cmd=news_cat_del&cat_id=<?=$val['cat_id']?>" onclick="return confirm('ȷ��ɾ����')"><img src="static/image/delete.gif"/></a> 
			</td>
		  </tr>
		  </form>
		  <?}?>
 