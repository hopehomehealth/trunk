<!DOCTYPE html>
<html>
<head>
<meta charset="gbk" />
<title>旅游产品大全 - <?=$g_sitename?></title> 
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> 
<link rel="stylesheet" type="text/css" href="/images/catalog_<?=$g_mobile_style?>.css">
</head>
<body>
<div class="home_h clearfix">
  <div class="m_logo"><a href="<?=$g_domain?>"><img src="/images/m_logo.png" height="30" width="97"></a></div>
  <div class="m_go"><a href="/member/">我的账户</a><i></i></div>
</div>
<div class="container_fixed" id="page_1">
  <div class="home_banner plr10 clearfix">
    <div id="wrapper">
      <div id="inner">
        <div><a href="<?=$g_domain?>"><img src="images/top.png"></a></div>
      </div>
    </div>
  </div> 

  <form id="search" action="/search" class="plr10" style="margin:15px 0 15px">
    <a href="#" style="display:block">
    <div class="search_input">
      <input id="to_id" type="hidden">
      <input name="keywords" style="cursor:pointer" class="destination_input" placeholder="输入关键字..." type="text">
      <span class="search_icon" onclick="document.getElementById('search').submit();"></span> </div>
    </a>
  </form> 
 
  <section class="home_tag plr10 zb">
    <div class="h"> <a href="<?=$g_domain?><?=$val['cat_key']?>/"><b style="font-size:18px"><?=$val['cat_name']?></b></a> </div>
    <div class="c">
      <ul class="clearfix">
	    <?
		$cats = query_son_catalog(0, 50 );
		if(sizeof($cats)>0){
			foreach ($cats as $cval){ 
	    ?>
        <li> <a href="#level<?=$cval['cat_id']?>" title="<?=$cval['cat_name']?>" <?if($cval['is_hot']=='1'){?>style="color:red"<?}?>><?=$cval['cat_name']?></a> </li>
		<? 
			}
		}
		?>   
      </ul>
    </div>
  </section> 
  <?
  $cats = query_son_catalog(0, 50 );
  if(sizeof($cats)>0){
	foreach ($cats as $val){ 
  ?>
  <a name="level<?=$val['cat_id']?>"></a>
  <section class="home_tag plr10 zb">
    <div class="h"> <a href="<?=$g_domain?><?=$val['cat_key']?>/"><b style="font-size:18px"> <?=$val['cat_name']?></b></a> </div>
    <div class="c">
      <ul class="clearfix">
	    <?
		$child_cats = query_son_catalog($val['cat_id'],50,false);
		if(sizeof($child_cats)>0){
			foreach ($child_cats as $cval){
				$sql = "SELECT COUNT(*) FROM `t_goods_thread` a WHERE a.`is_sale`=1 AND a.`cat_id`='".$cval['cat_id']."' ";  
				$cnt = $db->get_value($sql);  
				if($cnt>0){
		?>
        <li> <a href="<?=$g_domain?><?=$cval['cat_key']?>/" title="<?=$cval['cat_name']?>" <?if($cval['is_hot']=='1'){?>style="color:red"<?}?>><?=$cval['cat_name']?></a> </li>
		<?
				}
			}
		}
		?>   
      </ul>
    </div>
  </section>
  <?
	}
  }
  ?>
</div> 
<div class="foot"> 
  <?include('foot.php');?>
</div>
</body>
</html>