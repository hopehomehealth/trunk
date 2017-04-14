<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<ul class="nav nav-tabs">   
	<li class="active" style="padding-left:20px;">
		<a href="#">整团订单</a>
	</li>  
	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">刷新</a>
</ul>  
  
		<form name="q_from" method="GET" action="" class="form-inline">  
			<input name="cmd" type="hidden" value="<?=base64_encode('guestbook.php')?>"/> 
			<input name="kw" type="text" id="kw" size="50" value="<?=req('kw')?>" required/> 
			&nbsp;
			<input type="image" src="static/image/find.gif" class="input_img"/>  
		</form> 

		<? 
		  if(notnull($query_rows)){ 
		?>
		<table width="100%" class="table table-hover" style="font-size:12px">
		  <tbody>
		  <tr>  
			  <td>出发城市</td>
			  <td>目的景区</td>   
			  <td>拟出发日期</td>  
			  <td>拟行程天数</td> 
			  <td>拟出游人数</td>
			  <td>拟出游预算</td>
			  <td>住宿要求</td>
			  <td>会议</td>
			  <td>其他要求</td>
			  <td>联系人</td>
			  <td>手机号</td>
			  <td width="80">发布时间</td>
			  <td>操作</td>
		  </tr> 
		  </tbody>
		  <?  
			foreach ($query_rows as $val){ 
			    $item = unserialize(stripslashes($val['content'])); 
		  ?>  
			<tr> 
			  <td><?=$item['start_city']?></td>
			  <td><?=$item['destination']?></td>
			  <td><?=$item['begin_start_date']?>~<?=$item['last_start_date']?></td>
			  <td><?=$item['duration_min']?>~<?=$item['duration_max']?>天</td>
			  <td><?=$item['tourist_num_min']?>~<?=$item['tourist_num_max']?>人</td>
			  <td><?=$item['spend_min']?>~<?=$item['spend_max']?>元/人</td>
			  <td>
				  <?
				  if($item['house_type']==1) echo '经济型';
				  if($item['house_type']==2) echo '三星级';
				  if($item['house_type']==3) echo '四星级';
				  if($item['house_type']==4) echo '五星级';
				  if($item['house_type']==5) echo '不用安排';  
				  if($item['house_type']==6) echo $item['hotelname'];
				  ?> 
			  </td>
			  <td><?if($item['meeting_type']=='0'){echo '否';}?><?if($item['meeting_type']=='1'){echo '是';}?></td>
			  <td><?=$item['other_require']?></td>
			  <td><?=$item['linker']?></td>
			  <td><?=$item['mobile']?></td>  
			  <td><?=$val['addtime']?></td>
			  <td>    
				<a href="do.php?cmd=customized_del&item_id=<?=$val['item_id']?>"  onclick="return confirm('确认删除吗？')"><img src="/static/image/delete.gif"/></a> 
			  </td>
			</tr> 
		  <?
		  } 
		  ?> 
		</table>
		<div style="text-align:right;padding-right:10px;">  
			<br/>
			共计<b><?=$total_number?></b>条 &nbsp;
			<a href="./?cmd=<?=base64_encode('customized.php')?>&kw=<?=req('kw')?>&p=1">首页</a>
			<a href="./?cmd=<?=base64_encode('customized.php')?>&kw=<?=req('kw')?>&p=<?=$prev_number?>">上一页</a> 
			第<?=$now_page?> / <b><?=$total_page?></b>页 
			<a href="./?cmd=<?=base64_encode('customized.php')?>&kw=<?=req('kw')?>&p=<?=$next_number?>">下一页</a>
			<a href="./?cmd=<?=base64_encode('customized.php')?>&kw=<?=req('kw')?>&p=<?=$total_page?>">尾页</a>
		</div>
		<?
		} else { 
		?> 
		<div class="alert">尚未发布整团询价信息！</div>
		<?}?> 
  