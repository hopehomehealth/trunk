<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="gbk">
<title>
<? $g_page_title!='' ? print $g_page_title : $g_sitename; ?>
</title>
<meta name="keywords" content="<?=$g_page_keywords?>" />
<meta name="description" content="<?=$g_page_description?>" />
<meta name="viewport" content="width=device-width,minimum-scale=1,maximum-scale=1,initial-scale=1,user-scalable=no" />
<meta name="format-detection" content="telephone=no" />

<link type='text/css' rel='stylesheet' href='/images/swiper.css'/>
<link type='text/css' rel='stylesheet' href='/images/index_<?=$g_mobile_style?>.css'/>

<script type='text/javascript' src='/ajax/jquery-1.8.3.js'></script>
<script type='text/javascript' src='/images/swiper.min.js'></script>
<script type='text/javascript' src='/images/template.js'></script>
<link href="/ajax/flexslider-2.2.1/flexslider.css" rel="stylesheet" type="text/css" media="screen" />
<script src="/ajax/flexslider-2.2.1/jquery.flexslider.js"></script>
</head>
<body>
<div class="warp">  
	<section class="searchSec">
        	<form action="/search" id="searchform">
	            <div class="searchBox">
	                <a onclick="searchSubmit()">����</a>
	                <i class="search"></i>
	                <input class="searchIpt" placeholder="Ŀ�ĵ�" name="keywords" >
	            </div>
            </form>
	</section>
	<script type="text/javascript">
	function searchSubmit(){
		$('#searchform').submit();
	}
	</script>
	<style type="text/css">
	.flex-control-nav{display:none}
	</style>
	<div class="swiper-container topBan" id="slider">
		<div class="flexslider" style="height:200px;overflow:hidden;margin-bottom:0px">
			<ul class="slides">
				<? 
				$ad_list = get_ad('ZYX', '0', 8);
				if(notnull($ad_list)){ 
					foreach ($ad_list as $val){    	 
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
	</div>
	<div style="position:absolute;top:50px;z-index:1000000;"><a href="<?=$g_domain?>"><img src="/images/top.png" style="width:50%"></a></div>

	 
	<div class="newsfocus" id="traidershtml">
		<div class="news"> <span class="blackbold">�ո�</span><span class="bgred">�µ�</span>
			<div class="t_news">
				<ul class="news_li"> 
					<li><a href="#">186****4298 �ո�Ԥ�� ����-�ŵ���5��6���� </a></li>
					<li>100��Ʒ����ѡ��</li>
					<li>���ܽ�ӭ����������</li> 
				</ul>
				<ul class="swap">
				</ul>
			</div>
			<span class="flright">����</span> </div>
	</div>
	<div class="indexTermin mt10" id="areahtml">
		<h2 class="c_ff9"> ����Ŀ�ĵ� </h2>
		<div style="clear:both;height:135px;">
			<div class="terBox">
				<ul>
					<?
					$dist_list = index_weixin_dist();
					if(notnull($dist_list)){ 
						foreach ($dist_list as $val){
					?> 
					<a href="<?=$val['dist_url']?>">
					<li class="topical-1 topical" style="background:url(/upfiles/<?=$g_siteid?>/<?=$val['dist_image']?>) no-repeat bottom" ><strong style="color:white"><?=$val['dist_title']?></strong></li>
					</a>
					<?
						}
					}
					?>
				</ul>
			</div>
		</div>
	</div>
	<div class="newsfocus" id="traidershtml">
		<div class="news"> <span class="blackbold">����</span><span class="bgred">����</span>
			<div class="t_news">
				<ul class="news_li">
					<li><a href="/news/">�������Ů���ǹ��ڲ�����</a></li>
					<li>100��Ʒ����ѡ��</li>
					<li>���ܽ�ӭ����������</li>
				</ul>
				<ul class="swap">
				</ul>
			</div>
			<span class="flright">����</span> </div>
	</div>
	<div class="indexLineUl mt10" id="hotlinehtml">
		<h2 class="c_fd3">������·</h2>
		<ul>
			<?  
			$mobile = query_mode('mobile');
			$top01  = query_mode_goods($mobile['mode_id'], 5);

			if(notnull($top01)){ 
				foreach ($top01 as $val){
					$goods_image = "/upfiles/$g_siteid/".$val['goods_image'];
			?>
			<a href="/product/detail-<?=$val['goods_id']?>.html">
			<li>
				<div class="imgBg">
					<p><?=$val['goods_name']?></p>
					<span class="icon bg_ff9">&yen;<?=$val['min_price']?>��</span> </div>
				<img src="<?=$goods_image?>"> </li>
			</a>
			<?
				}
			}
			?>  
		</ul>
	</div>
	<ul class="botListUl">
		<li> <a href="/" class="icon1"> <span></span>
			<p>��ҳ</p>
			</a>
		<li> <a href="/search?hot=yes" class="icon2"> <span></span>
			<p>�Ƽ�</p> 
			</a> </li>
		<li> <a href="/local/" class="icon3"> <span></span>
			<p>�ŵ�</p>
			</a> </li>
		<li> <a href="/leader/" class="icon4"> <span></span>
			<p>����</p> 
			</a> </li>
		<li> <a href="/member/" class="icon5"> <span></span>
			<p>�ҵ�</p>
			</a> </li>
	</ul>
	<footer>&#169;<?=date('Y')?> <a href="<?=$g_mobile_url?>"><?=$g_profile['company']?></a> ��Ȩ����
		<p id="clicenseno"><?if($g_profile['ota_code']!=''){?>�������֤��<?=$g_profile['ota_code']?><?}?></p>
	</footer>
</div> 
</body> 
</html>