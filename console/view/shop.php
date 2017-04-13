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
  <li class="active" style="padding-left:20px"><a href="#tabs-1">商家查询</a></li>
  <li><a href="#tabs-2">新增商家</a></li> 
  <a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">刷新</a>
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
			<td><strong>名称</strong></td>  
			<td><strong>账号</strong></td>  
			<td><strong>联系人</strong></td>
			<td><strong>手机</strong></td>  
			<td><strong>域名前缀</strong></td> 
			<td><strong>预览</strong></td> 
			<td><strong>佣金比率</strong></td> 
			<td><strong>状态</strong></td> 
			<td align="center"><strong>操作</strong></td> 
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

			<td><?if($val['fee_rate']>0){?><?=$val['fee_rate']?>%<?}else{?>未设置<?}?></td> 

			<td>
				<?if($val['state']=='1'){?><img src="static/image/ok.gif" title="启用"/><?}?>
				<?if($val['state']=='0'){?><img src="static/image/no.gif" title="停用"/><?}?>
			</td>

			<td>
				<span onclick="dialog_edit('./?cmd=<?=base64_encode('shop_edit.php')?>&modal=true&shop_id=<?=$val['shop_id']?>')" style="cursor:pointer"><img src="static/image/edit.gif"/></span> 
				&nbsp;
				<a href="do.php?cmd=shop_del&shop_id=<?=$val['shop_id']?>" onclick="return confirm('确认删除吗？')" ><img src="static/image/delete.gif"/></a> 
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
				<td width="100" align="right"><font color="red">*</font> 商家名称：</td>
				<td><input name="shop_name" type="text" id="shop_name" class="span4" autocomplete="off" required/></td>
			  </tr>
			  <tr>
				<td align="right"><font color="red">*</font> 用户名：</td>
				<td><input name="account" type="text" id="account" class="span4" autocomplete="off" required/></td>
			  </tr> 
			  <tr>
				<td align="right"><font color="red">*</font> 密 码：</td>
				<td><input name="password" type="password" id="password" class="span4" autocomplete="off" required/></td>
			  </tr> 
			  <tr>
				<td align="right">佣金比率：</td>
				<td>
				<input name="fee_rate" type="number" id="fee_rate" class="span4" placeholder="返给平台的佣金比例，填0表示不返佣"/> <strong>%</strong>   
				</td>
			  </tr> 
			  <tr>
				<td align="right"><font color="red">*</font> 旅游许可证：</td>
				<td><input name="cert_code" type="text" id="cert_code" class="span4" required/></td>
			  </tr>
			  <tr>
				<td align="right"><font color="red">*</font> 营业范围：</td>
				<td><input name="cert_scope" type="text" id="cert_scope" class="span4" required placeholder="如：国内、入境旅游业务"/></td>
			  </tr>
			  <tr>
				<td align="right"><font color="red">*</font> 二级域名前缀：</td>
				<td><input name="shop_domain" type="text" id="shop_domain" class="span4" required placeholder="字母数字组成，建议使用公司名称首字母，如：shzql"/></td>
			  </tr>
			  <tr>
				<td align="right"><font color="red">*</font> 商家LOGO：</td>
				<td><input name="shop_ico" type="file" id="shop_ico" required/></td>
			  </tr> 
			  <tr>
				<td align="right"><font color="red">*</font> 客服热线：</td>
				<td><input name="hotline" type="text" id="hotline" class="span4" required/></td>
			  </tr> 
			  <tr>
				<td align="right"><font color="red">*</font> 联系人：</td>
				<td><input name="linker" type="text" id="linker" class="span4" required/></td>
			  </tr>
			  <tr>
				<td align="right"><font color="red">*</font> 手机号码：</td>
				<td><input name="mobile" type="number" id="mobile" class="span4" required/></td>
			  </tr>
			  <tr>
				<td align="right"> QQ号码：</td>
				<td><input name="qq" type="number" id="qq" class="span4" /></td>
			  </tr>
			  <tr>
				<td align="right"> 传真号码：</td>
				<td><input name="fax" type="text" id="fax" class="span4" /></td>
			  </tr>
			  <tr>
				<td align="right"> 固定电话：</td>
				<td><input name="tel" type="text" id="tel" class="span4" /></td>
			  </tr> 
			  <tr>
				<td align="right"><font color="red">*</font> 排列序号：</td>
				<td>
				<input name="order_id" type="number" id="order_id" class="span4" value="<?=$max_order_id?>" /></td>
			  </tr>
			  <tr>
				<td align="right">商家描述：</td>
				<td><textarea name="shop_note" rows="3" cols="20" class="span6"></textarea></td>
			  </tr>
			  <tr>
				<td align="right"><font color="red">*</font> 是否审核：</td>
				<td><label><input name="is_verify_goods" type="checkbox" id="is_verify_goods" value="1" /> 平台审核产品</label></td>
			  </tr>
			  <tr>
				<td align="right"><font color="red">*</font> 是否启用：</td>
				<td>
				<input name="state" type="checkbox" id="state" value="1" checked/> 启用商家账户</td>
			  </tr>
			  <tr>
				<td></td>
				<td><br/><input type="submit" value="确定" class="btn btn-danger" /></td>
			  </tr>   
			</table>
		</form>
	</div>
</div>
 