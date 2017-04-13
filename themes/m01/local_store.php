<!DOCTYPE html>
<html>
<head>
<meta charset="gbk" />
<?seo();?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> 
<link rel="stylesheet" type="text/css" href="/images/catalog_<?=$g_mobile_style?>.css">
</head>
<body>
<div class="home_h clearfix">
  <div class="m_logo"><a href="<?=$g_domain?>"><img src="/images/m_logo.png" height="30" width="97"></a></div>
  <div class="m_go"><a href="/member/">我的账户</a><i></i></div>
</div>
<div class="container_fixed" style="margin-bottom:100px;"> 
  <section class="home_tag plr10 zb">
    <div class="h"> <a href="<?=$g_domain?><?=$val['cat_key']?>/"><b style="font-size:18px"><?=$val['cat_name']?></b></a> </div>
    <div class="c">
      <ul class="clearfix">
	    <? 
		if(sizeof($local_store_rows)>0){
			foreach ($local_store_rows as $val){ 
				$store_image = "/upfiles/$g_siteid/".$val['store_image'];
				$profile     = unserialize($val['profile']);
	    ?>
		<table style="width:100%;border-bottom:1px solid #fff;">
			<tr> 
				<td colspan="2"><h3><?=$val['store_name']?></h3></td>
			</tr> 
			<tr>
				<td style="width:60px"><strong>电话：</strong></td>
				<td style="text-align:left"><?=$profile['tel']?></td>
			</tr>
			<tr>
				<td><strong>地址：</strong></td>
				<td style="text-align:left"><?=$profile['address']?></td>
			</tr> 
		</table> 
		<? 
			}
		}
		?>   
      </ul>
    </div>
  </section>  
</div> 
<div class="foot"> 
  <?include('foot.php');?>
</div>
</body>
</html>