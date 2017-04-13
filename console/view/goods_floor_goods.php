<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>


<script type="text/javascript">
function checkAll(name)
{
    var el = document.getElementsByTagName('input');
    var len = el.length;
    for(var i=0; i<len; i++)
    {
        if((el[i].type=="checkbox") && (el[i].name==name))
        {
            el[i].checked = true;
        }
    }
}
function clearAll(name)
{
    var el = document.getElementsByTagName('input');
    var len = el.length;
    for(var i=0; i<len; i++)
    {
        if((el[i].type=="checkbox") && (el[i].name==name))
        {
            el[i].checked = false;
        }
    }
}
</script> 

<ul class="nav nav-tabs" id="myTab"> 
    <li class="active" style="padding-left:20px"><a href="#tabs-1">¥��(<?=req('floor_title')?>)�Ƽ���Ʒ</a></li>
	<a href="?cmd=<?=base64_encode('goods_floor.php')?>" class="pull-right btn btn-small">����</a>
</ul>

 
<table width="100%">
	<tr>
		<td valign="top">
		<h3>&raquo; ѡ���Ʒ</h3>
		<form name="q_from" method="GET" action=""  class="form-inline"> 
			<table>
			  <tr> 
				<td>
					<select name="goods_type"> 
						<?foreach ($g_product_type as $k => $v) {?> 
						<option value="<?=$k?>" <?if($k == req('goods_type')) echo 'checked selected="selected"';?>><?=$v?></option>
						<?}?>  
					</select>
					<input name="kw" type="text" id="kw" size="50" value="<?=req('kw')?>" /> 
				</td>
				<td>
					<input name="cmd" type="hidden" value="<?=base64_encode('goods_floor_goods.php')?>"/> 
					<input type="hidden" name="floor_id" value="<?=req('floor_id')?>">
					<input type="hidden" name="floor_title" value="<?=req('floor_title')?>">
					<input type="image" src="static/image/find.gif" class="input_img"/> 
				</td>
			  </tr>
			</table>
		</form>  

		<? 
		  if(notnull($query_rows)){
		?>
		<form target="frm" id="join_form" method="post" action="do.php?cmd=goods_floor_goods_join"> 
		<table class="table table-condensed"> 
		  <thead>
		  <tr>
			  <td width="20">
			  <input type="checkbox" id="checkedAll" name="checkedAll" onclick="if(this.checked==true) { checkAll('goods_box[]'); } else { clearAll('goods_box[]'); }">
			  </td> 
			  <td><b>��ƷID</b></td>
			  <td><b>��Ʒ����</b></td> 
			  <td><b>��Ʒ���</b></td>
		  </tr> 
		  </thead>
		  <?  
			foreach ($query_rows as $val){     
		  ?>  
			<tr>
			  <td><input type="checkbox" name="goods_box[]" value="<?=$val['goods_id']?>" ></td> 
			  <td><?=$val['goods_id']?></td>
			  <td><?=$val['goods_name']?></td>
			  <td><?=$val['goods_code']?></td> 
			</tr> 
		  <?
		  } 
		  ?> 
		</table>

		<table width="100%">
		  <tr>
			<td align="left"> 
			<br/>
			����<b><?=$total_number?></b>�� &nbsp;
			<a href="./?cmd=<?=base64_encode('goods_floor_goods.php')?>&goods_type=<?=req('goods_type')?>&floor_id=<?=req('floor_id')?>&floor_title=<?=req('floor_title')?>&tabs_index=0&kw=<?=req('kw')?>&p=1">��ҳ</a>
			<a href="./?cmd=<?=base64_encode('goods_floor_goods.php')?>&goods_type=<?=req('goods_type')?>&floor_id=<?=req('floor_id')?>&floor_title=<?=req('floor_title')?>&tabs_index=0&kw=<?=req('kw')?>&p=<?=$prev_number?>">��һҳ</a> 
			��<?=$now_page?> / <b><?=$total_page?></b>ҳ 
			<a href="./?cmd=<?=base64_encode('goods_floor_goods.php')?>&goods_type=<?=req('goods_type')?>&floor_id=<?=req('floor_id')?>&floor_title=<?=req('floor_title')?>&tabs_index=0&kw=<?=req('kw')?>&p=<?=$next_number?>">��һҳ</a>
			<a href="./?cmd=<?=base64_encode('goods_floor_goods.php')?>&goods_type=<?=req('goods_type')?>&floor_id=<?=req('floor_id')?>&floor_title=<?=req('floor_title')?>&tabs_index=0&kw=<?=req('kw')?>&p=<?=$total_page?>">βҳ</a>
			</td>
		  </tr>
		  <tr>
			<td align="left">
				<br/>
				<input type="hidden" name="kw" value="<?=req('kw')?>">
				<input type="hidden" name="p" value="<?=req('p')?>">
				<input type="hidden" name="floor_id" value="<?=req('floor_id')?>">
				<input type="hidden" name="floor_title" value="<?=req('floor_title')?>">
				<input type="submit" class="btn btn-danger" value="��������...">
			</td>
		  </tr>
		</table>
		</form>
		<?
		} else {
		?>
		<div class="alert alert-info">��ʾ��û�в�ѯ����ز�Ʒ!</div>
		<?}?>
		</td>
	</tr>
	<tr>
		<td valign="top">
		<script type="text/javascript">
		function doform_floor_goods(vid, item){
			var f =  document.getElementById('f'+vid);
			f.action = "do.php?cmd=goods_floor_goods_edit&item_id="+vid+"&item="+item;
			f.submit();
		} 
		</script>

		<h3><?=req('floor_title')?>/�Ѽ���Ĳ�Ʒ��<?=sizeof($joined_goods)?>��<br/></h3>
		<?  
		if(notnull($joined_goods)){
		?>
		<table width="100%" class="table table-condensed">
			<tr>
			  <td><b>��ƷID</b></td>
			  <td><b>��Ʒ����</b></td> 
			  <td><b>��Ʒ���</b></td>
			  <td><b>���</b></td>
			  <td><b>ɾ��</b></td>
			</tr>
		<?
			foreach ($joined_goods as $val){     
		?>
			<form target="frm" id="f<?=$val['item_id']?>" method="post" action="" > 
			<tr> 
				<td><?=$val['goods_id']?></td> 
				<td><?=$val['goods_name']?></td> 
				<td><?=$val['goods_code']?></td> 
				<td><input name="order_id" type="number" id="order_id" style="width:50px;" value="<?=$val['o_id']?>" size="1" onchange="doform_floor_goods('<?=$val['item_id']?>', 'order_id')" />
				</td>
				<td><a href="do.php?cmd=goods_floor_goods_del&item_id=<?=$val['item_id']?>&floor_id=<?=req('floor_id')?>&floor_title=<?=req('floor_title')?>" ><img src="static/image/delete.gif"/></a> </td>
			</tr>
			</form>
		<?
			}
		?>
		</table> 
		<div class="alert">��ʾ����ſɱ༭���Զ����棬��1,2,3...�������С�</div>
		<?
		} else {
		?>  
		<div class="alert">��ʾ��û�в�ѯ��������!</div>
		<?}?>
		</td>
	</tr>
</table> 