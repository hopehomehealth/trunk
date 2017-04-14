<!DOCTYPE html>
<html>
<head>
<?include('meta.php');?>
<?////seo()?>
<?include('static.php');?> 
<link rel="stylesheet" type="text/css" href="/images/visa.css">
</head>

<body class="bodybox" style="background-color:white">
<?include('head.php');?> 
<?
$ad_list = get_ad('QZ');
?>
<style type="text/css">
.flex-active{margin-top:-30px;z-index:1000000;}
</style>
<div class="flexslider" style="width:100%;height:290px;overflow:hidden;">
	<ul class="slides">
		<?  
		if(notnull($ad_list)){  
			foreach ($ad_list as $val){    	 
		?> 
		<li>
		<div style="background-image:url(/upfiles/<?=$g_siteid.'/'.$val['ad_image']?>?v=<?=date('YmdHis')?>);background-position: center;background-repeat: no-repeat; height:290px" onclick="window.open('<?=$val['ad_url']?>')"></div> 
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

<div class="g-main visa-channel-index" style="margin-top:-40px"> 
	<div class="main-inner">  
		<div class="m-query-info">
			<div class="query-process" style="height:226px">
				<div class="box-top">
					<div class="info-satis">
						<h5>100<span>%</span></h5>
						<p>签证成功率</p>
					</div>
					<div class="info-count">
						<h5><?=$count_visa_order?></h5>
						<p>办理签证数</p>
					</div>
				</div>
 
				<form method="get" action="/search" id="f_1" target="_blank">
					<input type="hidden" name="goods_type" value="3">
					<div class="box-bottom">
					<label for="">签证办理查询</label>
					<div class="J_DepartCity search_ctrl search_ctrl_inp search_ctrl_city input-field">
						<input type="text" name="keywords" class="search_visa_in search_ctrl_inp_input" autocomplete="off" placeholder="如：法国">
						<a href="javascript:$('#f_1').submit();" class="search_submit_btn">搜索</a> </div>
				</div>
				</form>
				<form method="get" action="/news/" id="f_2" target="_blank">
				<input type="hidden" name="cat_key" value="shiguan">
				<div class="box-bottom">
					<label for="">领馆信息查询</label>
					<div class="J_DepartCity search_ctrl search_ctrl_inp search_ctrl_city input-field">
						<input type="text" name="keywords" class="search_visa_in search_ctrl_inp_input" autocomplete="off" placeholder="如：美国">
						<a href="javascript:$('#f_2').submit();" class="search_submit_btn">搜索</a> </div>
				</div>
				</form>
			</div>
			<div class="deal-process">
				<h3>签证办理流程</h3>
				<img src="/images/visa_process.jpg" alt="" style="width:889px"> </div>
		</div>
		 
		<!-- floor start -->
		<div class="m-section">
			<h2 class="section-title"> <span>当月<em>特惠</em></span> </h2>
			<div class="section-content">
				<ul class="promotion-list">
					<? 
					if(notnull($hot_visa_rows)){ 
						 foreach ($hot_visa_rows as &$val) {
							 $goods_url = get_goods_url($val['cat_key'], $val['goods_id']);
					?>
					<li class="list-item" title="<?=$val['goods_name']?>">
						<div class="country-flag"> <a target="_blank" href="<?=$goods_url?>"><img src="/static/image/flags/<?=$val['visa_zone_id']?>.jpg"></a> </div>
						<div class="visa-info"> <a target="_blank" href="<?=$goods_url?>">
							<h5><?=$val['goods_name']?></h5>
							</a>
							<p class="visa-type">签证</p>
							<p class="visa-price">&yen;<em><?=$val['real_price']?></em></p>
						</div>
					</li>
					<?
						 }
					}
					?> 
				</ul>
			</div>
		</div>
		<a name="type"></a>
		<div class="m-section J_hot_visas">
			<h2 class="section-title"> <span>签证<em>分类</em></span> </h2>
			<!--
			<div class="visa-tags">
				<ul>
					<a href="/qianzheng/t1#type"><li class="cur">个人旅游</li></a>
					<a href="/qianzheng/t2#type"><li class="">探亲访友</li></a>
					<a href="/qianzheng/t3#type"><li class="">商务办公</li></a>
				</ul>
			</div>
			-->
			<div class="section-content">
				<ul class="visa-list" style="display: block;">
					<? 
					if(notnull($visa_zone_rows)){ 
						 foreach ($visa_zone_rows as &$val) {  
					?>
					<li>
						<div class="country-flag"> <a target="_blank" href="/qianzheng/zone-<?=$val['zone_id']?>.html"><img src="/static/image/flags/<?=$val['zone_id']?>.jpg" alt=""></a><br/><?=$val['zone_name']?> </div> 
					</li>
					<?
						 }
					}
					?> 
				</ul> 
				<div style="clear:both"><br/><br/></div>
			</div>
		</div>
		<!-- floor end --> 
		
		<!-- qa start -->
		<div class="m-visa-qa" style="display:none">
			<div class="box-left"> <span class="visa-icon icon-questions"> </span>
				<div class="questions-block">
					<h3>签证问题 <a href="/help/list/162" class="btn-more">更多&gt;</a></h3>
					<ul>
						<li>
							<h5>Q: 什么是签证</h5>
							<p>A: 签证是一个主权国家发给申请出入该国的外国公民或本国公民t的出入境许可...</p>
						</li>
						<li>
							<h5>Q: 签证是否能保证通过呢</h5>
							<p>A: 所有的签证都不能保证通过，都是根据客人自己提供的材料由使馆去决定是否...</p>
						</li>
						<li>
							<h5>Q: 怎样才能提高出签率</h5>
							<p>A: 申请签证之前一定要准备好详细真实的签证材料，另外，最好详细叙述你的出...</p>
						</li>
					</ul>
				</div>
			</div>
			<div class="box-right"> <span class="visa-icon icon-comments"></span> <span class="visa-icon icon-circle-up"></span> <span class="visa-icon icon-circle-down"></span>
				<div class="comments-block">
					<h3>最新点评</h3>
					<ul>
						<li>
							<h5>6***9 <span class="time">2016年07月24日</span></h5>
							<p>途牛上签证非常便捷，价格也...</p>
						</li>
						<li>
							<h5>6***6 <span class="time">2016年07月24日</span></h5>
							<p> 很不错，很好很快很方便。...</p>
						</li>
						<li>
							<h5>爬***兜 <span class="time">2016年07月24日</span></h5>
							<p>很方便，去干将路服务点把护...</p>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- qa end --> 
	</div>
</div>
<div class="clear"></div>
<?include('foot.php');?>
</body>
</html>
