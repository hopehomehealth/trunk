<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<ul class="nav nav-tabs">   
	<li <?if(nav_active('goods_mode.php') ){?>class="active"<?}?> style="padding-left:20px;">
		<a href="?cmd=<?=base64_encode('goods_mode.php')?>">����</a>
	</li>   
 
	<li <?if(nav_active('goods_mode_join.php')){?>class="active"<?}?>>
		<a href="?cmd=<?=base64_encode('goods_mode_join.php')?>">��ʼ���...</a>
	</li>   

	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">ˢ��</a>
</ul> 

  
		<form target="frm" id="goods_mode_add_form" method="post" action="do.php?cmd=goods_mode_add" class="form-inline"> 
		  <table>
		  <tr>
			<td>
			��������
			<input name="mode_name" type="text" id="mode_name" size="20" class="span3 " required/>
			&nbsp;
			Ӣ�ı��
			<input name="mode_key" type="text" id="mode_key" pattern="[a-z]{1,50}" size="20" class="span2 " required/>
			&nbsp;
			���
			<input name="order_id" type="number" id="order_id" size="5" class="span1 " required value="<?=$max_order_id?>"/>
		 
			<input type="submit" value="ȷ��" class="btn btn-danger" /> 
			</td>
		  </tr>
		</table>
		</form>

		<script type="text/javascript">
		function doform_mode(mode_id, item){
			var f =  document.getElementById('f'+mode_id);
			f.action = "do.php?cmd=goods_mode_edit&mode_id="+mode_id+"&item="+item;
			f.submit();
		} 
		</script>
		<? 
		if(notnull($mode_rows)){
		?>
		<table width="100%" class="table" style="margin-top:20px">
		  <tbody class="mytbody">
		  <tr>  
			<td ><strong>ID</strong></td>
			<td ><strong>��������</strong></td>
			<td width="50"><strong>Ӣ�ı��</strong></td> 
			<td ><strong>���ͼ</strong></td> 
			<td width="50"><strong>����</strong></td> 
			<td width="160"><strong>����</strong></td> 
			<td>SEO����</td>
			<td width="30"><strong>����</strong></td>
		  </tr>
		  </tbody>
		  <?  
		  foreach ($mode_rows as $val){    	
			$mode_image = "/upfiles/$g_siteid/".$val['mode_image'];
		  ?>
		  <form target="frm" id="f<?=$val['mode_id']?>" action="" method="post" enctype="multipart/form-data"> 
		    <td ><strong><?=$val['mode_id']?></strong></td>
			<td><input name="mode_name" type="text" id="mode_name" value="<?=$val['mode_name']?>" style="width:150px" onchange="doform_mode('<?=$val['mode_id']?>', 'mode_name')" required/></td>
 
			<td><input name="mode_key" type="text" id="mode_key" value="<?=$val['mode_key']?>" style="width:150px" onchange="doform_mode('<?=$val['mode_id']?>', 'mode_key')" pattern="[a-z]{1,50}" required/></td>

			<td>
			  <a href="<?=$mode_image?>" target="_blank"><img src="<?=$mode_image?>" style="height:40px" onerror="this.style.display='none'"/></a> 
			 
			  <div style="margin-top:10px">
				<input type="file" name="mode_image"> <input type="button" value="����" class="btn btn-small" onclick="doform_mode('<?=$val['mode_id']?>', 'mode_image')">
			  </div>
			</td> 

			<td><input name="order_id" type="number" id="order_id" style="width:60px" value="<?=$val['order_id']?>" onchange="doform_mode('<?=$val['mode_id']?>', 'order_id')" required/></td>

			<td>  
			<span onclick="dialog_edit('./?cmd=<?=base64_encode('goods_mode_result.php')?>&modal=true&mode_id=<?=$val['mode_id']?>');" style="cursor:pointer">�鿴������Ʒ</span> 
			&nbsp;
			<a href="http://<?=$g_site_domain?>/subject/<?=$val['mode_key']?>.html" target="_blank">Ԥ��</a>  
			</td>

			<td>
			<span onclick="dialog_edit('<?=url('seo_editor.php')?>&modal=true&primary_name=mode_id&primary_value=<?=$val['mode_id']?>&table_name=t_goods_mode')" style="cursor:pointer"  <?if($val['page_title']!=''){?>class="btn btn-warning btn-small" title="������"<?}else{?>class="btn  btn-small" title="δ����"<?}?>><span>SEO����</span></span>
			</td>
			<td align="center">
			<a href="do.php?cmd=goods_mode_del&mode_id=<?=$val['mode_id']?>" onclick="return confirm('ȷ��ɾ����')"><img src="static/image/delete.gif"/></a> 
			</td>
		  </tr>
		  </form>
		  <?	 
		  }
		  ?>
		</table> 
		<?	 
		}
		?>
 