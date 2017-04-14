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
<div class="container_fixed" id="page_1">
    
  <section class="home_tag plr10 zb" style="margin-top:30px;margin-bottom:80px;">
    <div class="h"> <a href="<?=$g_domain?><?=$val['cat_key']?>/"><b style="font-size:18px"><?=$val['cat_name']?></b></a> </div>
    <div class="c">
      <ul class="clearfix">
	    <? 
		if(sizeof($vcard_rows)>0){
			foreach ($vcard_rows as $val){ 
				$avatar  = "/upfiles/$g_siteid/".$val['avatar'];
				$profiles = unserialize($val['profiles']);
	    ?> 
		<div style="width:100px;float:left;" onclick="location.href='/leader/<?=$val['vcard_id']?>'"><img src="<?=$avatar?>" style="width:80px;height:80px;border-radius:50%; overflow:hidden;"><br/><?=$profiles['username']?></div>
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