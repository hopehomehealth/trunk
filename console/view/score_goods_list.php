<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<ul class="nav nav-tabs">   
	<li <?if(nav_active('score_goods_list.php')){?>class="active"<?}?> style="padding-left:20px;">
		<a href="?cmd=<?=base64_encode('score_goods_list.php')?>">������Ʒ����</a>
	</li>  
	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">ˢ��</a>
</ul>  
  

	<table width="100%">
		<tr>
			<td style="padding-top:7px">
				<form name="q_from" method="get" action="" class="form-inline">  
					<input name="cmd" type="hidden" value="<?=base64_encode('score_goods_list.php')?>" /> 
					  
					<select name="sale_type" style="width:100px"> 
					<option value="">-- ���� --</option> 
					<?
					if(notnull($cat_list)){
					  foreach ($cat_list as $val){   
					?> 
					<option value="<?=$val['cat_id']?>" <? if(req('cat_id')==$val['cat_id']) echo 'selected';?>><?=$val['cat_name']?></option> 
					<?
					  }
					}
					?> 
					</select>

					<select name="is_sale" style="width:100px">
					<option value="">-- ״̬ --</option> 
					<option value="1" <? if(req('is_sale')=='1') echo 'selected';?>>����</option> 
					<option value="0" <? if(req('is_sale')=='0') echo 'selected';?>>ͣ��</option> 
					</select>
					 
					<input name="kw" type="text" id="kw" class="span4" value="<?=req('kw')?>" placeholder="�ؼ��ʡ�"/> 
					&nbsp;
					<input type="image" src="static/image/find.gif" class="input_img" title="����"/> 
 
				</form> 
			
			
			</td>
		</tr>
	</table>

	<script type="text/javascript">
	function doform(goods_id, item){
		var f =  document.getElementById('f'+goods_id);
		f.action = "do.php?cmd=score_goods_fast_edit&goods_id="+goods_id+"&item="+item;
		f.submit();
	} 
	</script>

	<? 
	if(notnull($query_rows)){
	?>
	<table width="100%"class="table table-hover"> 
		  <tr>   
			  <td style="width:300px">��Ʒ����</td> 
			  <td>�г���</td>  
			  <td>�һ�����</td>
			  <td>�����</td> 
			  <td>���¼�</td>
			  <td>�Ƽ�</td> 
			  <td>����</td>
		  </tr> 
		  <?  
		  foreach ($query_rows as $val){ 
				$goods_image = "/upfiles/$g_siteid/".$val['goods_image'];  
		  ?> 
		  <form target="frm" id="f<?=$val['goods_id']?>" method="post" action="" > 
			<tr <?if($val['is_sale']=='0'){?>class="error" title="���¼�"<?}?>> 
 
			  <td><input name="goods_name" type="text" id="goods_name" title="<?=$val['goods_name']?>" style="width:250px;" value="<?=$val['goods_name']?>" size="30" onchange="doform('<?=$val['goods_id']?>', 'goods_name')" /> 
			  </td> 

			  <td><input name="market_price" type="text" id="market_price" title="<?=$val['market_price']?>" style="width:100px;" value="<?=$val['market_price']?>" size="30" onchange="doform('<?=$val['goods_id']?>', 'market_price')" /> 
			  </td> 

			  <td><input name="score_number" type="text" id="score_number" title="<?=$val['score_number']?>" value="<?=$val['score_number']?>" style="width:100px;" onchange="doform('<?=$val['goods_id']?>', 'score_number')" /> 
			  </td>  
  
			  <td><input name="order_id" type="number" id="order_id" style="width:50px;" value="<?=$val['order_id']?>" size="1" onchange="doform('<?=$val['goods_id']?>', 'order_id')" />
			  </td>
			   
			  <td> 
				<select id="is_sale" name="is_sale" style="width:80px;">
					<option value="1" <?if($val['is_sale']=='1'){?>selected<?}?> onchange="doform('<?=$val['goods_id']?>', 'is_sale')">�ϼ�</option>
					<option value="0" <?if($val['is_sale']=='0'){?>selected<?}?> onchange="doform('<?=$val['goods_id']?>', 'is_sale')">�¼�</option>
				</select> 
			  </td>
			   
			  <td >
				<select name="is_hot" onchange="doform('<?=$val['goods_id']?>', 'is_hot')" style="width:80px;" >  
					<option value="0" <? if($val['is_hot']==0) {echo 'selected';} ?> >���Ƽ�</option> 
					<option value="1" <? if($val['is_hot']==1) {echo 'selected';} ?> >�Ƽ�^</option> 
				</select>	
			  </td>  
			  
			  <td>  
				<a href="?cmd=<?=base64_encode('score_goods_edit.php')?>&ac=copy&goods_id=<?=$val['goods_id']?>" style="cursor:pointer">����</a> &nbsp; 
				<a href="/jifen/detail-<?=$val['goods_id']?>.html" target="_blank"><img src="static/image/view.gif" title="Ԥ��"/></a> 
				&nbsp;
				<a href="?cmd=<?=base64_encode('score_goods_edit.php')?>&goods_id=<?=$val['goods_id']?>" style="cursor:pointer"><img src="static/image/edit.gif" title="�༭"/></a> 
				&nbsp;
				<a href="do.php?cmd=score_goods_del&goods_id=<?=$val['goods_id']?>&cat_id=<?=req('cat_id')?>&sale_type=<?=req('sale_type')?>&kw=<?=req('kw')?>&p=<?=req('p')?>" onclick="return confirm('ȷ��ɾ����')"><img src="static/image/delete.gif" title="ɾ��"/></a> 
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
			<a href="<?=get_page_args()?>&p=1">��ҳ</a>
			<a href="<?=get_page_args()?>&p=<?=$prev_number?>">��һҳ</a> 
			��<?=$now_page?> / <b><?=$total_page?></b>ҳ 
			<a href="<?=get_page_args()?>&p=<?=$next_number?>">��һҳ</a>
			<a href="<?=get_page_args()?>&p=<?=$total_page?>">βҳ</a>
			&nbsp;
			ת��
			<input type="number" class="span1 text-center" value="<?=req('p')?>" onchange="location.replace('<?=get_page_args()?>&p='+this.value)">ҳ
		</div>

	<?}else{?>
		<div class="alert"><strong>��ʾ��</strong>û���ҵ���ص���Ϣ��</div>
	<?}?>
 