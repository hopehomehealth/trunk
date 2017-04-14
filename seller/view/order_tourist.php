<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="static/image/style.css" rel="stylesheet" type="text/css" />
<!-- kindeditor start// -->
<script charset="utf-8" src="static/js/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="static/js/kindeditor/lang/zh_CN.js"></script>
<script charset="utf-8" src="static/js/kindeditor/plugins/code/prettify.js"></script>
<!-- kindeditor end// -->

<link href="static/js/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

</head>

<body style="padding:20px"> 
	    <?if(notnull($query_rows)){?>	 
		<table class="table table-hover"> 
		  <thead>
		  <tr> 
			<td width="100"><strong>订单号</strong></td>
			<td><strong>产品名称</strong></td>  
			<td width="120"><strong>游客姓名</strong></td> 
			<td width="120"><strong>游客身份证</strong></td> 
			<td width="80"><strong>游客年龄</strong></td>  
		  </tr> 
		  </thead>
		  <?   
		  foreach ($query_rows as $val){    	
		  ?>
		  <form target="frm" id="f<?=$val['tourist_id']?>" method="post" action="" >
		  <tr> 
			<td><?=$val['order_code']?></td> 

			<td><a href="preview.php?ac=goods&goods_id=<?=$val['goods_id']?>" target="_blank"><?=$val['goods_name']?></a></td> 

			<td> 
			<?=$val['user_name']?>
			</td> 

			<td> 
			<?=$val['user_idcard']?>
			</td> 

			<td> 
			<?=$val['user_age']?>岁
			</td>  
		  </tr>
		  </form>
		  <?	 
		  }  
		  ?>
		</table>  
		<?} else {?>
		<div >没有查询到相关信息！</div>
		<?}?>
</body>
</html>