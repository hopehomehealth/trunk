<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<script type="text/javascript">
$(document).ready(function(){
	$('#myTab a').click(function (e) { 
		e.preventDefault();
		$(this).tab('show'); 
	})
}); 
</script>

<ul class="nav nav-tabs" id="myTab"> 
  <li class="active" style="padding-left:20px"><a href="#tabs-1">�̼Ҳ�ѯ</a></li>
  <li><a href="#tabs-2">�����̼�</a></li> 
  <a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">ˢ��</a>
</ul>

<div class="tab-content"> 
	<div class="tab-pane in active" id="tabs-1"> 
  
		<script type="text/javascript">
		function doform(shop_id, item){
			var f =  document.getElementById('shop_f'+shop_id);
			f.action = "do.php?cmd=shop_fast_edit&shop_id="+shop_id+"&item="+item;
			f.submit();
		} 
		</script>
		<table width="100%" class="table table-hover">
		  <thead>
		  <tr>   
			<td><strong>����</strong></td>  
			<td><strong>�˺�</strong></td>  
			<td><strong>��ϵ��</strong></td>
			<td><strong>�ֻ�</strong></td>  
			<td><strong>����ǰ׺</strong></td> 
			<td><strong>Ԥ��</strong></td> 
			<td><strong>Ӷ�����</strong></td> 
			<td><strong>״̬</strong></td> 
			<td align="center"><strong>����</strong></td> 
		  </tr>
		  </thead>
		  <? 
		  if(notnull($rows)){
			foreach ($rows as $val){     
		  ?>
		  <form target="frm" id="shop_f<?=$val['shop_id']?>" action="" method="post" >
		  <tr>   

			<td><?=$val['shop_name']?></td> 

			<td align="center">
			<?=$val['account']?>
			</td>  

			<td><?=$val['linker']?></td> 
			
			<td><?=$val['mobile']?></td> 
  
			<td><?=$val['shop_domain']?></td>   
 
			<td>
				<?if($val['shop_domain']!=''){?>
				<a href="http://<?=$val['shop_domain'].'.'.$g_shop_root_domain?>" target="_blank"><?=$val['shop_domain'].'.'.$g_shop_root_domain?></a>
				<?}?>
			</td>

			<td><?if($val['fee_rate']>0){?><?=$val['fee_rate']?>%<?}else{?>δ����<?}?></td> 

			<td>
				<?if($val['state']=='1'){?><img src="static/image/ok.gif" title="����"/><?}?>
				<?if($val['state']=='0'){?><img src="static/image/no.gif" title="ͣ��"/><?}?>
			</td>

			<td>
				<span onclick="dialog_edit('./?cmd=<?=base64_encode('shop_edit.php')?>&modal=true&shop_id=<?=$val['shop_id']?>')" style="cursor:pointer"><img src="static/image/edit.gif"/></span> 
				&nbsp;
				<a href="do.php?cmd=shop_del&shop_id=<?=$val['shop_id']?>" onclick="return confirm('ȷ��ɾ����')" ><img src="static/image/delete.gif"/></a> 
			</td>
		  </tr>
		  </form>
		  <?				
			}
		  }
		  ?>
		</table>  
	</div>   
	<div class="tab-pane" id="tabs-2">   
		<form target="frm" method="post" action="do.php?cmd=shop_add" enctype="multipart/form-data" >
			<table width="100%">  
			  <tr>
				<td width="100" align="right"><font color="red">*</font> �̼����ƣ�</td>
				<td><input name="shop_name" type="text" id="shop_name" class="span4" autocomplete="off" required/></td>
			  </tr>
			  <tr>
				<td align="right"><font color="red">*</font> �û�����</td>
				<td><input name="account" type="text" id="account" class="span4" autocomplete="off" required/></td>
			  </tr> 
			  <tr>
				<td align="right"><font color="red">*</font> �� �룺</td>
				<td><input name="password" type="password" id="password" class="span4" autocomplete="off" required/></td>
			  </tr> 
			  <tr>
				<td align="right">Ӷ����ʣ�</td>
				<td>
				<input name="fee_rate" type="number" id="fee_rate" class="span4" placeholder="����ƽ̨��Ӷ���������0��ʾ����Ӷ"/> <strong>%</strong>   
				</td>
			  </tr> 
			  <tr>
				<td align="right"><font color="red">*</font> �������֤��</td>
				<td><input name="cert_code" type="text" id="cert_code" class="span4" required/></td>
			  </tr>
			  <tr>
				<td align="right"><font color="red">*</font> Ӫҵ��Χ��</td>
				<td><input name="cert_scope" type="text" id="cert_scope" class="span4" required placeholder="�磺���ڡ��뾳����ҵ��"/></td>
			  </tr>
			  <tr>
				<td align="right"><font color="red">*</font> ��������ǰ׺��</td>
				<td><input name="shop_domain" type="text" id="shop_domain" class="span4" required placeholder="��ĸ������ɣ�����ʹ�ù�˾��������ĸ���磺shzql"/></td>
			  </tr>
			  <tr>
				<td align="right"><font color="red">*</font> �̼�LOGO��</td>
				<td><input name="shop_ico" type="file" id="shop_ico" required/></td>
			  </tr> 
			  <tr>
				<td align="right"><font color="red">*</font> �ͷ����ߣ�</td>
				<td><input name="hotline" type="text" id="hotline" class="span4" required/></td>
			  </tr> 
			  <tr>
				<td align="right"><font color="red">*</font> ��ϵ�ˣ�</td>
				<td><input name="linker" type="text" id="linker" class="span4" required/></td>
			  </tr>
			  <tr>
				<td align="right"><font color="red">*</font> �ֻ����룺</td>
				<td><input name="mobile" type="number" id="mobile" class="span4" required/></td>
			  </tr>
			  <tr>
				<td align="right"> QQ���룺</td>
				<td><input name="qq" type="number" id="qq" class="span4" /></td>
			  </tr>
			  <tr>
				<td align="right"> ������룺</td>
				<td><input name="fax" type="text" id="fax" class="span4" /></td>
			  </tr>
			  <tr>
				<td align="right"> �̶��绰��</td>
				<td><input name="tel" type="text" id="tel" class="span4" /></td>
			  </tr> 
			  <tr>
				<td align="right"><font color="red">*</font> ������ţ�</td>
				<td>
				<input name="order_id" type="number" id="order_id" class="span4" value="<?=$max_order_id?>" /></td>
			  </tr>
			  <tr>
				<td align="right">�̼�������</td>
				<td><textarea name="shop_note" rows="3" cols="20" class="span6"></textarea></td>
			  </tr>
			  <tr>
				<td align="right"><font color="red">*</font> �Ƿ���ˣ�</td>
				<td><label><input name="is_verify_goods" type="checkbox" id="is_verify_goods" value="1" /> ƽ̨��˲�Ʒ</label></td>
			  </tr>
			  <tr>
				<td align="right"><font color="red">*</font> �Ƿ����ã�</td>
				<td>
				<input name="state" type="checkbox" id="state" value="1" checked/> �����̼��˻�</td>
			  </tr>
			  <tr>
				<td></td>
				<td><br/><input type="submit" value="ȷ��" class="btn btn-danger" /></td>
			  </tr>   
			</table>
		</form>
	</div>
</div>
 