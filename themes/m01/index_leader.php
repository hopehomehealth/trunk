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
<link type='text/css' rel='stylesheet' href='/ajax/font-awesome-4.5/css/font-awesome.css'/>
</head>
<body>
<div class="warp">  
	<div style="text-align:center"><a href="<?=$g_domain?>"><img src="/images/top.png" style="width:50%"></a></div>
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
	<div style="border-bottom:1px solid #efefef;background-color:#fff">
		<div style="padding:10px">
			<div style="float:left;width:30%;text-align:center;">
				<img src="/upfiles/<?=$g_siteid?>/<?=$vcard['avatar']?>" style="width:100px; height:100px; border-radius:50%; overflow:hidden;">
				<br/>
				���ι���
			</div>
			<div style="float:right;width:68%"> 
				<strong><?=$vcard_detail['username']?></strong> <em class="fa fa-star" style="color:#ff6600"></em><br/>
				<?=$vcard_detail['store']?><br/>
				<a href="tel:<?=$vcard_detail['mobile']?>"><?=$vcard_detail['mobile']?> <em class="fa fa-mobile"></em></a><br/>
				<a href="http://map.baidu.com/mobile/webapp/search/search/qt=s&wd=<?=$vcard_detail['address']?>"><?=$vcard_detail['address']?> <img src="/images/du.jpg" style="width:20px;" align="absmiddle"></a> 
				<div style="margin-top:10px">
				<table style="width:100%">
				  <tr>
					<td><a href="tel:<?=$vcard_detail['mobile']?>"><em class="fa fa-phone fa-2x" style="color:#ff6600"></em></a></td>
					<td><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?=$vcard_detail['qq']?>&site=qq&menu=yes"><i class="fa fa-qq fa-2x" style="color:#ff6600"></i></a></td>
					<td><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?=$vcard_detail['qq']?>&site=qq&menu=yes"><i class="fa fa-wechat fa-2x" style="color:#ff6600"></i></a></td>
					<td><em class="fa fa-qrcode fa-2x" style="color:#ff6600"></em></td>
				  </tr>
				</table> 
				</div>
			</div> 
			<div style="clear:both"></div>
		</div>
	</div>
 
	 
	<div class="slider">
		<ul class="topListUl mt10">
			<?
			$ico_list = index_weixin_nav();
			if(notnull($ico_list)){ 
				foreach ($ico_list as $val){
			?>
			<li> <a href="<?=$val['nav_url']?>">
				<div class="iconImg"><img src="/images/<?=$val['nav_ico']?>"></div>
				<p><?=$val['nav_title']?></p>
				</a> </li>
			<?
				}
			}
			?> 
		</ul>
	</div>
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
		<li> <a href="/hot/" class="icon2"> <span></span>
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