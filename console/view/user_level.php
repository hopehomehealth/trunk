<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<script type="text/javascript"> 
	function doform(level_id, item){
		var f =  document.getElementById('f'+level_id);
		f.action = "do.php?cmd=user_level_fast_edit&level_id="+level_id+"&item="+item;
		f.submit();
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

<ul class="nav nav-tabs" id="myTab"> 
  <li class="active" style="padding-left:20px"><a href="#tabs-1">会员等级</a></li> 
  <li><a href="#tabs-2">新增等级</a></li>
  <a href="javascript:void(0)" onclick="location.reload();" class="pull-right btn btn-small" style="z-index:1000">刷新</a>
</ul>

<div class="tab-content"> 
	<div class="tab-pane in active" id="tabs-1">  
		<? 
		if(notnull($query_rows)){
		?>
		<table width="100%" class="table table-hover">
		   
		  <tbody class="mytbody">
		  <tr>
			  <td>会员等级</td>
			  <td>等级名称</td> 
			  <td>折扣比例</td>
			  <td>说明</td>
			  <td>升级消费总额(元)</td> 
			  <td width="50">操作</td>
		  </tr>
		  </tbody>
		  <?  
			foreach ($query_rows as $val){    	
		  ?> 
		  <form target="frm" id="f<?=$val['level_id']?>" method="post" action="" > 
			<tr> 
			  <td><?=$val['level_type']?></td> 
			  <td><input name="level_name" type="text" id="level_name" style="width:150px" value="<?=$val['level_name']?>" size="5" onchange="doform('<?=$val['level_id']?>', 'level_name')"/>
			  </td> 
			  <td><input name="level_rebate" type="number" step="0.01" max="1" id="level_rebate" style="width:80px" value="<?=$val['level_rebate']?>" size="8" onchange="doform('<?=$val['level_id']?>', 'level_rebate')"/>  
			  </td>
			  <td> 
			  <textarea name="level_note" id="level_note" rows="2"  style="width:300px"  onchange="doform('<?=$val['level_id']?>', 'level_note')"><?=$val['level_note']?></textarea>
			  </td>
			  <td><input name="level_require" type="number" step="1" id="level_require" style="width:80px" value="<?=$val['level_require']?>"   onchange="doform('<?=$val['level_id']?>', 'level_require')"/>  
			  </td>
			  <td align="center">    
				<a href="do.php?cmd=user_level_del&level_id=<?=$val['level_id']?>&level_type=<?=$val['level_type']?>" target="frm" onclick="return confirm('确认删除吗？')"><img src="static/image/delete.gif"/></a> 
			  </td>
			</tr>
		  </form> 
		  <?
		  } 
		  ?> 
		</table> 
		<?
		} else {
				
		?> 
		<div class="alert">没有查询到相关信息！</div>
		<?}?>
		<div id="" class="alert">
			<p style="font-size:14px">等级有效期与延长条件</p> 

			1. 银卡及以上等级的有效期为1年，自升级之日起计算；普卡等级为长期有效。<br/>
			2. 在等级有效期内，如达到上一等级标准，即可升级。<br/>
			3. 等级到期后，如满足以下条件即可享受会员等级有效期顺延一年<br/>
			等级有效期内：<br/>
			银卡会员：消费订单≥2单或消费金额≥&yen;1000<br/>
			金卡会员：消费订单≥4单或消费金额≥&yen;2000<br/>
			铂金卡会员：消费订单≥6单或消费金额≥&yen;3000<br/>
			若未能满足上述条件，则等级顺次下调一个等级。
		</div>
    </div>  
	<div id="tabs-2" class="tab-pane">  
		<form target="frm" method="POST" action="do.php?cmd=user_level_add" >
			<table width="100%">
				<tr>
					<td align="right" width="100"><font color="red">*</font> 等级名称：</td>
					<td><input name="level_name" type="text" id="level_name" class="span4" required placeholder="如：铂金会员"/></td>
				</tr>
				<tr>
					<td align="right" ><font color="red">*</font> 折扣比例：</td>
					<td><input name="level_rebate" type="number" max="1" step="0.01" id="level_rebate" class="span4" required  placeholder="如85折，填写：0.85"/></td>
				</tr>
				<tr>
					<td align="right" ><font color="red">*</font> 升级规则：</td>
					<td>消费总额达 <input name="level_require" type="number" step="1" id="level_require" class="input-small" required  placeholder="如85折，填写：0.85"/> 元，自动升级到该等级</td>
				</tr>
				<tr>
					<td align="right" >等级说明：</td>
					<td>
					<textarea name="level_note" id="level_note" rows="3" style="width:600px"></textarea>
					</td>
				</tr> 
				<tr>
					<td></td>
					<td><input type="submit" value="确定" class="btn btn-info"></td>
				</tr>
			</table> 
		</form>   
		
    </div>  
</div>
 