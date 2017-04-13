<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>


<ul class="nav nav-tabs">   
	<li class="active" style="padding-left:20px;">
		<a href="#">客户留言</a>
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
		<table width="99%" class="table table-hover">
		  <tbody class="mytbody">
		  <tr> 
			  <td>姓名</td>
			  <td>手机</td> 
			  <td>QQ</td> 
			  <td>电子邮件</td>
			  <td>内容</td>
			  <td>时间</td>
			  <td>操作</td>
		  </tr> 
		  </tbody>
		  <?  
			foreach ($query_rows as $val){    	
		  ?> 
		  <form target="frm" id="f<?=$val['guestbook_id']?>" method="post" action="" > 
			<tr>
			  <td><?=$val['username']?></td>
			  <td><?=$val['tel']?></td>
			  <td><?=$val['qq']?></td>
			  <td><?=$val['email']?></td> 
			  <td><?=$val['content']?></td>
			  <td><?=$val['addtime']?></td>
			  <td>    
				<a href="do.php?cmd=guestbook_del&guestbook_id=<?=$val['guestbook_id']?>" onclick="return confirm('确认删除吗？')"><img src="static/image/delete.gif"/></a> 
			  </td>
			</tr>
		  </form> 
		  <?
		  } 
		  ?> 
		</table>
		<div style="text-align:right;padding-right:10px;">  
			<br/>
			共计<b><?=$total_number?></b>条 &nbsp;
			<a href="./?cmd=<?=base64_encode('guestbook.php')?>&kw=<?=req('kw')?>&p=1">首页</a>
			<a href="./?cmd=<?=base64_encode('guestbook.php')?>&kw=<?=req('kw')?>&p=<?=$prev_number?>">上一页</a> 
			第<?=$now_page?> / <b><?=$total_page?></b>页 
			<a href="./?cmd=<?=base64_encode('guestbook.php')?>&kw=<?=req('kw')?>&p=<?=$next_number?>">下一页</a>
			<a href="./?cmd=<?=base64_encode('guestbook.php')?>&kw=<?=req('kw')?>&p=<?=$total_page?>">尾页</a>
		</div>
		<?
		} else { 
		?> 
		<p>没有查询到访客留言！</p>
		<?}?> 
 