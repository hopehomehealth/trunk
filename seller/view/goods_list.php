<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<ul class="nav nav-tabs">   
	<?
	$m=1;
	foreach ($g_product_type as $k => $v) {
	?>
	<li <?if(nav_active('goods_list.php') && req('goods_type')==$k){?>class="active"<?}?> <?if($m==1){?>style="padding-left:20px;"<?}?>>
		<a href="?cmd=<?=base64_encode('goods_list.php')?>&goods_type=<?=$k?>"><?=$v?></a>
	</li>
	<?
		$m++;
	}
	?>
	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">ˢ��</a>
</ul>  
  

		<table width="100%">
		<tr>
			<td style="padding-top:7px">
				<form name="q_from" method="GET" action="" class="form-inline">  
					<input name="cmd" type="hidden" value="<?=base64_encode('goods_list.php')?>" /> 
					<input name="goods_type" type="hidden" value="<?=req('goods_type')?>" /> 
					    
					<select name="is_sale" style="width:100px">
					<option value="">-- ״̬ --</option> 
					<option value="-1" <? if(req('is_sale')=='-1') echo 'selected';?>>����</option> 
					<option value="1" <? if(req('is_sale')=='1') echo 'selected';?>>����</option> 
					<option value="0" <? if(req('is_sale')=='0') echo 'selected';?>>ͣ��</option> 
					</select>
					 
					<input name="kw" type="text" id="kw" size="25" value="<?=req('kw')?>" placeholder="�ؼ��ʡ�"/> 
					&nbsp;
					<input type="image" src="static/image/find.gif" class="input_img" title="����"/> 


					<span class="pull-right"> 
						<a href="?cmd=<?=base64_encode('goods_add.php')?>&goods_type=<?=req('goods_type')?>" class="btn btn-info" style="color:white"><em class="fa fa-plus"></em> �����²�Ʒ</a> 
					</span>
				</form> 
			
			
			</td>
		</tr>
		</table>

		<script type="text/javascript">
				function doform_goods(goods_id, item){
					var f =  document.getElementById('f'+goods_id);
					f.action = "do.php?cmd=goods_edit_fast&goods_id="+goods_id+"&item="+item;
					f.submit();
				} 
		</script>

		<? 
		  if(notnull($query_rows)){
		?>
		<table width="100%"class="table table-hover"> 
		  <tr>  
			  <td>��ƷID</td> 
			  <td style="width:260px">��Ʒ����</td> 
			  <td>&nbsp; ���</td> 
			 
			  <td>�����</td> 
			  <td>���¼�</td>
			  <td>�Ƽ�</td>
			 
			  <td>�����</td>
			  <td>����</td>
		  </tr> 
		  <?  
			foreach ($query_rows as $val){ 
				$goods_image = "/upfiles/$g_siteid/".$val['goods_image'];
				$stat_count  = get_goods_stat($val['goods_id']);
				$shop_detail = get_shop_detail_by_id($val['shop_id']);
				
		  ?> 
		  <form target="frm" id="f<?=$val['goods_id']?>" method="post" action="" > 
			<tr <?if($val['is_sale']=='0'){?>class="error" title="���¼�"<?}?>> 

			  <td>
				<b title="��ƷID"><?=$val['goods_id']?></b> 
			  </td> 
  
			  <td><input name="goods_name" type="text" id="goods_name" title="<?=$val['goods_name']?>" style="width:250px;" value="<?=$val['goods_name']?>" size="30" onchange="doform_goods('<?=$val['goods_id']?>', 'goods_name')" /> 
			  </td> 

			  <td style="font-size:16px">&yen;<?=$val['min_price']?>��</td>
  
			  <td><input name="order_id" type="number" id="order_id" style="width:50px;" value="<?=$val['order_id']?>" size="1" onchange="doform_goods('<?=$val['goods_id']?>', 'order_id')" />
			  </td>
			   
			  <td> 
			  <?
			  if($g_shopid!=''){
				  if($val['is_sale']=='0') echo '�¼ܣ������';
				  if($val['is_sale']=='1') echo '������';
			  }else{
			  ?>
			  <?if($val['is_sale']=='1'){?>
			  <a href="do.php?cmd=goods_sale_state&goods_id=<?=$val['goods_id']?>&is_sale=0&cat_id=<?=req('cat_id')?>&sale_type=<?=req('sale_type')?>&kw=<?=req('kw')?>&p=<?=$prev_number?>">�¼�</a>
			  <?}?>
			  <?if($val['is_sale']=='0'){?>
			  <a href="do.php?cmd=goods_sale_state&goods_id=<?=$val['goods_id']?>&is_sale=1&cat_id=<?=req('cat_id')?>&sale_type=<?=req('sale_type')?>&kw=<?=req('kw')?>&p=<?=$prev_number?>" style="color:green">�ϼ�</a>
			  <?}?> 
			  <?}?>
			  </td>
			   
			  <td >
				<select name="is_hot" onchange="doform_goods('<?=$val['goods_id']?>', 'is_hot')" style="width:80px;" >  
					<option value="0" <? if($val['is_hot']==0) {echo 'selected';} ?> >���Ƽ�</option> 
					<option value="1" <? if($val['is_hot']==1) {echo 'selected';} ?> >�Ƽ�^</option> 
				</select>	
			  </td> 
			 

			  <td><?=$stat_count?></td>
			  
			  <td>  
				<a href="?cmd=<?=base64_encode('goods_edit.php')?>&ac=copy&goods_id=<?=$val['goods_id']?>" style="cursor:pointer">����</a> &nbsp; 
				<a href="preview.php?ac=goods&goods_id=<?=$val['goods_id']?>" target="_blank"><img src="static/image/view.gif" title="Ԥ��"/></a> 
				&nbsp;
				<a href="?cmd=<?=base64_encode('goods_edit.php')?>&goods_id=<?=$val['goods_id']?>" style="cursor:pointer"><img src="static/image/edit.gif" title="�༭"/></a> 
				&nbsp;
				<a href="do.php?cmd=goods_del&goods_id=<?=$val['goods_id']?>&cat_id=<?=req('cat_id')?>&sale_type=<?=req('sale_type')?>&kw=<?=req('kw')?>&p=<?=req('p')?>" onclick="return confirm('ȷ��ɾ����')"><img src="static/image/delete.gif" title="ɾ��"/></a> 
			  </td>
			</tr>
		  </form> 
		  <?
		  } 
		  ?> 
		</table>
		<div style="text-align:right;padding-right:10px;">  
			<br/>
			����<b><?=$total_number?></b>�� &nbsp;
			<a href="<?=get_page_args()?>p=1">��ҳ</a>
			<a href="<?=get_page_args()?>p=<?=$prev_number?>">��һҳ</a> 
			��<?=$now_page?> / <b><?=$total_page?></b>ҳ 
			<a href="<?=get_page_args()?>p=<?=$next_number?>">��һҳ</a>
			<a href="<?=get_page_args()?>p=<?=$total_page?>">βҳ</a>
			&nbsp;
			ת��
			<input type="number" class="span1 text-center" value="<?=req('p')?>" onchange="location.replace('<?=get_page_args()?>p='+this.value)">ҳ
		</div>

		<?}else{?>
			<div class="alert"><strong>��ʾ��</strong>û���ҵ���صĲ�Ʒ��Ϣ��</div>
		<?}?>
 