<!DOCTYPE html>
<html>
<head>
<?include('meta.php');?>
<?////seo()?>
<?include('static.php');?>

<link rel="stylesheet" type="text/css" href="/images/list.css">
<link rel="stylesheet" type="text/css" href="/images/channel.css">
</head>

<body class="index1200" style="background-color:white">
<?include('head.php');?>
<div class="container">
	<ul class="breadcrumbs">
		<li class="item"><a href="<?=$g_domain?>">首页</a> </li>
		<li class="item current"><span>&gt;</span><?=$g_product_type[$c_goods_type]?></li>
	</ul>


	<div class="flexslider" style="width:100%;;;">
		<ul class="slides"> 
			<?
			$ad_list = get_ad($g_product_ad[$c_goods_type], '0', 8);
			if(notnull($ad_list)){  
			?>
			<li>
				<ul class="tour-mainlist">
					<?    
					$n=1;
					foreach ($ad_list as $val){    	 
					?>
					<li <?if($n % 2 == 0 && $n<=4){?>class="half"<?}?> <?if($n % 2 != 0 && $n>=4){?>class="half"<?}?>>
						<a target="_blank" href="<?=$val['ad_url']?>">
							<img src="/upfiles/<?=$g_siteid.'/'.$val['ad_image']?>">
							<span class="li-txt">
								<em><?=$val['ad_title']?></em> 
							</span>
						</a>
					</li>
					<?
						$n++; 
					}
					?> 
				</ul> 
			</li>  
			<?}?>
			<?
			$ad_list = get_ad($g_product_ad[$c_goods_type], '8', 8);
			if(notnull($ad_list)){  
			?>
			<li>
				<ul class="tour-mainlist">
					<?      
					$n=1;
					foreach ($ad_list as $val){    	 
					?>
					<li <?if($n % 2 == 0 && $n<=4){?>class="half"<?}?> <?if($n % 2 != 0 && $n>=4){?>class="half"<?}?>>
						<a target="_blank" href="<?=$val['ad_url']?>">
							<img src="/upfiles/<?=$g_siteid.'/'.$val['ad_image']?>">
							<span class="li-txt">
								<em><?=$val['ad_title']?></em> 
							</span>
						</a>
					</li>
					<?
						$n++; 
					}
					?> 
				</ul> 
			</li>  
			<?}?>
			<?
			$ad_list = get_ad($g_product_ad[$c_goods_type], '16', 8);
			if(notnull($ad_list)){  
			?>
			<li>
				<ul class="tour-mainlist">
					<?    
					$n=1;
					foreach ($ad_list as $val){    	 
					?>
					<li <?if($n % 2 == 0 && $n<=4){?>class="half"<?}?> <?if($n % 2 != 0 && $n>=4){?>class="half"<?}?>>
						<a target="_blank" href="<?=$val['ad_url']?>">
							<img src="/upfiles/<?=$g_siteid.'/'.$val['ad_image']?>">
							<span class="li-txt">
								<em><?=$val['ad_title']?></em> 
							</span>
						</a>
					</li>
					<?
						$n++; 
					}
					?> 
				</ul> 
			</li>  
			<?}?>
		</ul>
	</div>
	<script type="text/javascript">
//		$(function() {
			$(".flexslider").flexslider({
				slideshowSpeed: 4000, //展示时间间隔ms
				animationSpeed: 400, //滚动时间ms
				touch: true //是否支持触屏滑动
			});
//		});	
	</script> 
</div>



<div class="bodybg"> 

	<?include('block_floor.php');?> 
	
</div>
<div class="clear"></div>
<?include('foot.php');?>
</body>
</html>
