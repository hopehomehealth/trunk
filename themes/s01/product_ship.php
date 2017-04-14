<!DOCTYPE html>
<html>
<head>
<?include('meta.php');?>
<?////seo()?>
<?include('static.php');?>
<link rel="stylesheet" type="text/css" href="/images/channel.css">
</head>

<body class="index1200" style="background-color:white">
<?include('head.php');?> 


<?
$ad_list = get_ad('YL');
?>
<div class="flexslider" style="width:100%;height:380px;overflow:hidden;">
	<ul class="slides">
		<?  
		if(notnull($ad_list)){  
			foreach ($ad_list as $val){    	 
		?> 
		<li>
		<div style="background-image:url(/upfiles/<?=$g_siteid.'/'.$val['ad_image']?>);background-position: center;background-repeat: no-repeat; height:380px" onclick="window.open('<?=$val['ad_url']?>')"></div> 
		</li> 
		<? 
			}
		}  
		?>  
	</ul>
</div>
<script type="text/javascript">
//	$(function() {
		$(".flexslider").flexslider({
			slideshowSpeed: 4000, //展示时间间隔ms
			animationSpeed: 400, //滚动时间ms
			touch: true //是否支持触屏滑动
		});
//	});	
</script>
 
<div class="bodybg">  
	<?include('block_floor.php');?> 
	
</div>
<div class="clear"></div>
<?include('foot.php');?>
</body>
</html>
