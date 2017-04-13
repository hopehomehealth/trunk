<!DOCTYPE html>
<html>
<head>
<meta charset="gbk" />
<?seo();?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> 
<link href="/images/index.css" rel="stylesheet" type="text/css">

<script src="/ajax/jquery-1.7.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://apps.bdimg.com/libs/fontawesome/4.4.0/css/font-awesome.min.css" />

</head>
<body> 

<header class="header"><a class="fl" href="<?=$g_domain?>"><i class="b_1"></i><i class="b_2"></i></a><a href="javascript:;"><?=$g_sitename?></a><a href="/" class="tool" style="font-size:24px"><span class="fa fa-home "></span></a></header>


<div class="container_fixed" id="page_1">
  <div class="home_banner plr10 clearfix" >
    <div><a href="/shop<?=$c_shopid?>/"><img src="/upfiles/<?=$g_siteid?>/<?=$c_shop['shop_ico']?>" width="100%"></a></div>
  </div>
  <!--
  <link href="/ajax/flexslider-2.2.1/flexslider.css" rel="stylesheet" type="text/css" media="screen" /> 
  <script src="/ajax/flexslider-2.2.1/jquery.flexslider.js"></script>

  <div class="flexslider" style="margin-bottom:20px">
    <ul class="slides"> 
		<? 
		$ppts = shop_ppt(1);
		if(notnull($ppts)){ 
			foreach ($ppts as $val){    	 
		?>
			<li><a href="<?=$val['ppt_url']?>"><img src="/upfiles/<?=$g_siteid.'/'.$val['ppt_image']?>" alt="<?=$val['ppt_title']?>"></a></li>
		<?
			}
		} else {
		?>
		<li> <a href="#"> <img src="/images/ppt1.jpg" alt=""> </a> </li>
		<li> <a href="#"> <img src="/images/ppt2.jpg" alt=""> </a> </li> 
		<?}?>
    </ul>
  </div> 
  <script type="text/javascript"> 
		$(window).load(function() {
		  $('.flexslider').flexslider({
			animation: "slide"
		  });
		}); 
  </script> 
  -->
 
  <section class="home_tag plr10 zb"> 
    <div class="home_subTitle"> <em>商家产品分类</em> </div>
	<?
    $cat01 = get_shop_cat_list(0, 10); 
    if(notnull($cat01)){  
		foreach ($cat01 as $val){     
    ?>
    <div class="c">
      <ul class="clearfix"> 
		  <li> <a href="?cid=<?=$val['cat_id']?>" title="<?=$val['cat_name']?>" <?if($val['cat_id']==req('cid')){?>style="color:red"<?}?>><strong><?=$val['cat_name']?></strong></a> </li>
          <?
          $cat02 = get_shop_cat_list($val['cat_id'], 20);

          if(notnull($cat02)){  
			foreach ($cat02 as $cval){     
          ?>
			<li> <a href="?cid=<?=$cval['cat_id']?>" title="<?=$cval['cat_name']?>" <?if($cval['cat_id']==req('cid')){?>style="color:red"<?}?>><?=$cval['cat_name']?></a> </li>
          <?
			}
          }
          ?>  
      </ul>
    </div>
	<?
		}
    }
    ?>   
  </section> 
   

  <section class="home_line">
    <div class="home_subTitle"> <em>产品一览</em> </div>

	<?   
	if(notnull($query_rows)){ 
		foreach ($query_rows as $val){
			$goods_image = "/upfiles/$g_siteid/".$val['goods_image'];
	?> 

    <div class="m-list plr10"> <a href="<?=$g_domain?>product/detail-<?=$val['goods_id']?>.html" >
      <div class="m-img"> <i class="img-tag gn"></i> <img class="lazy img-responsive" data-original="<?=$goods_image?>"> </div>
      <div class="m-c">
        <div class="m-c-bg">
          <p><code><?=$val['goods_name']?></code></p>
          <p class="m-c-txt"> <span> <em class="c-0">推荐</em> <i><?=$val['line_days']?>日游</i> </span> <strong><i>&yen;</i><?=$val['min_price']?><em class="co-1">起</em></strong> </p>
        </div>
      </div>
      </a> </div>
	<?
		}
	} else {
	?> 
	<p align="center">没有查询到相关产品！</p>
	<?}?>
  </section>  
  
</div> 
<div class="foot">
  <?include('foot.php');?>
</div>
</body>
</html>