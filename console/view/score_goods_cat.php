<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?> 

<ul class="nav nav-tabs">   
	<li <?if(nav_active('score_goods_cat.php')){?>class="active"<?}?> style="padding-left:20px;">
		<a href="?cmd=<?=base64_encode('score_goods_cat.php')?>">������Ʒ����</a>
	</li>   

	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">ˢ��</a>
</ul>  

<script type="text/javascript">  
function doform(cat_id, item){ 
	var f =  document.getElementById('f'+cat_id); 
	f.action = "do.php?cmd=score_goods_cat_edit&cat_id="+cat_id+"&item="+item; 
	f.submit();
}  
</script> 
 
		 
		<form target="frm" method="post" action="do.php?cmd=score_goods_cat_add" class="form-inline">
			<table>
			  <tr>
				<td>  

				&nbsp;
				<font color="red">*</font>�������
				<input name="cat_name" type="text" id="id_cat_name" style="width:200px;" placeholder="�磺̩ɽ" required />
				 
				&nbsp;
				<font color="red">*</font>���
				<input name="order_id" type="number" id="order_id" value="<?=$max_order_id?>"  style="width:70px;"  placeholder="���֡�" required/>
			 
				&nbsp;
				<input type="submit" value="����" class="btn btn-danger"  />
				</td>
			  </tr>
			</table> 
		</form>


		<? 
		if(notnull($cat_list)){
		?>
		<table class="table table-hover" id="tree_table"> 
		  <tr>   
			<td><strong>�������</strong></td> 
			<td><strong>���</strong></td>  
			<td></td>
			<td width="100"><strong>����</strong></td> 
		  </tr> 
		  <?    
		  foreach ($cat_list as $val){   
		  ?> 
		  <form target="frm" id="f<?=$val['cat_id']?>" action="" method="post" >
			  <tbody>  
			  <tr>
				<td>  
					<input name="cat_name" type="text" id="cat_name" value="<?=$val['cat_name']?>" size="12" style="<?if($val['is_hot']=='1'){?>color:red;<?}?>width:120px" onchange="doform('<?=$val['cat_id']?>', 'cat_name')" required/>  </td> 

				<td>
					<input name="order_id" type="number" id="order_id" value="<?=$val['order_id']?>" size="5" style="width:70px" onchange="doform('<?=$val['cat_id']?>', 'order_id')" required/>
				</td>  

				<td> 
					<a href="?cmd=<?=base64_encode('score_goods_add.php')?>&cat_id=<?=$val['cat_id']?>">������Ʒ</a>    
				</td> 

				<td>
					<a href="http://<?=$g_site_domain?>/jifen/list-<?=$val['cat_id']?>-1.html" target="_blank" title="���Ԥ��"><img src="static/image/view.gif" title="ID��<?=$val['cat_id']?>"/></a> 
					&nbsp;  
					<a href="do.php?cmd=score_goods_cat_del&cat_id=<?=$val['cat_id']?>" onclick="return confirm('ȷ��ɾ����')"><img src="static/image/delete.gif"/></a>  
				</td>
			  </tr>
			  </tbody>
		  </form>
		  <? 
		  }
		  ?>
		</table>

		<?}else{?>

		<div class="alert"><strong>��ʾ��</strong>û���ҵ���صķ�����Ϣ��</div>

		<?}?>
 