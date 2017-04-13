<!DOCTYPE html>
<html>
<head>
<?include('meta.php');?>
<title><?=$c_article['title']?>_<?=$c_cat['cat_name']?>_<?=$g_sitename?></title> 
<meta name="description" content="<?=$c_article['title']?> <?=$c_summary?> <?=$g_sitename?> " /> 
<?include('static.php');?>
<link rel="stylesheet" type="text/css" href="/images/list.css">
<script type="text/javascript" src="/member/plugin.php?cmd=browse&news_id=<?=$c_article_id?>"></script>
</head>

<body class="bodybox">
<?include('head.php');?> 
<div class="container">  
	<ul class="breadcrumbs">
		<li class="item"><a href="<?=$g_domain?>">首页</a><span>&gt;</span></li>

		<li class="item"> <a href="<?=$g_domain?>news/"> 资讯中心</a><span>&gt;</span></li> 

		<li class="item"> <a href="<?=$g_domain?>news/<?=$c_cat['cat_key']?>/"> <?=$c_cat['cat_name']?></a><span>&gt;</span></li> 

		<li class="item current"> <?=$c_article['title']?> </li>
	</ul> 
	 
	<div class="main fl"> 
		<div class="lv-list">
			
			<h1 style="text-align:center;margin-top:15px;font-size:24px"><?=$c_article['title']?></h1>

			<div style="text-align:center;padding:15px;border-bottom:1px solid #efefef"> 
				发布日期：<strong><?=date('Y-m-d', strtotime($c_article['addtime']))?></strong> &nbsp; &nbsp;
				阅读：<strong><?=$c_article['clicks']?></strong>次

				<div class="bdsharebuttonbox" style="float:right"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
				<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},"image":{"viewList":["qzone","tsina","sqq","weixin"],"viewText":"分享到：","viewSize":"16"}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
			</div>

			<?if($c_article['image']!=''){?>
			<div style="padding:20px;text-align:center;"><img alt="<?=$c_article['title']?>" width="100%"  src="/upfiles/<?=$g_siteid?>/<?=$c_article['image']?>" /> 
			</div>
			<?}?>

			<div style="font-size:14px;line-height:2.2;margin:20px"> 
				 <?
				 $htm = stripslashes($c_article['content']);
				 $htm = str_replace('font-family','~font-family',$htm);
				 echo $htm;
				 ?>
			</div>
		</div>
	</div>  
	 
<!--	<div class="aside fr" style="margin-top:12px">  -->
<!--		--><?//
//		// 相关产品
//		$rel_goods = get_rel_goods_list(5);
//		if(notnull($rel_goods)){
//		?>
<!--		<div class="aside-box aside-hot">-->
<!--			<div class="aside-title">产品推荐</div>-->
<!--			<ul class="order-news">-->
<!--				--><?//
//			    foreach ($rel_goods as $val){
//					$goods_image = "/upfiles/$g_siteid/".$val['goods_image'];
//					$goods_url = get_goods_url($val['cat_key'], $val['goods_id']);
//		        ?>
<!--				<li style="clear:both;padding-bottom:10px">-->
<!--					<img src="--><?//=$goods_image?><!--" style="width:80px;margin:0px 10px 10px 0px" align="left"> -->
<!--					<a href="--><?//=$goods_url?><!--" target="_blank">--><?//=show_substr($val['goods_name'],50)?><!--</a>-->
<!---->
<!--					<div class="mt10">--><?//=date('Y/m/d', strtotime($val['addtime']))?><!-- <span class="gray-b">浏览--><?//=$val['clicks']?><!--次</span></div> -->
<!--				</li>-->
<!--				--><?//}?><!-- -->
<!--			</ul>-->
<!--		</div>-->
<!--		<div class="clear"></div>-->
<!--		--><?//}?><!-- -->
<!--		-->
<!--		--><?//
//		// 同类资讯
//		$hot_article = get_hot_article(5);
//		if(notnull($hot_article)){
//		?>
<!--		<div class="aside-box aside-hot">-->
<!--			<div class="aside-title">资讯推荐</div>-->
<!--			<ul class="order-news">-->
<!--				--><?//
//			    foreach ($hot_article as $val){
//					$news_image = "/upfiles/$g_siteid/".$val['image'];
//					$news_url = get_news_url($val['thread_id']);
//		        ?>
<!--				<li style="clear:both;padding-bottom:10px">-->
<!--					<img src="--><?//=$news_image?><!--" style="width:80px;margin:0px 10px 10px 0px" align="left"> -->
<!--					<a href="--><?//=$new_url?><!--">--><?//=$val['title']?><!--</a>-->
<!---->
<!--					<div class="mt10">--><?//=date('Y/m/d', strtotime($val['addtime']))?><!-- <span class="gray-b">浏览--><?//=$val['clicks']?><!--次</span></div> -->
<!--				</li>-->
<!--				--><?//}?><!-- -->
<!--			</ul>-->
<!--		</div>-->
<!--		--><?//}?><!-- -->
<!--	</div>-->
<!--	<div class="clear"></div>-->
</div>
<div class="clear"></div>
<?include('foot.php');?>
</body>
</html>
