<style type="text/css">
*,body{
font-family:微软雅黑
}
</style>
<div id="headbox"style="border-bottom:1px solid #efefef">  
	<div id="ota-topnav">
		<div class="ota-container">
			<ul class="topnav-login"> 
				<script type="text/javascript" src="/ajax@login.status"></script>
			</ul>
			<ul class="topnav-list">  
				<li><a class="toplink" href="<?=$g_domain?>member/?cmd=<?=base64_encode('buycart.php')?>">我的账户</a></li>
				<li><a class="toplink" href="/news/">资讯中心</a></li> 
				<li><a class="toplink" href="/help/">用户帮助</a></li>  
				<li><a class="toplink" href="javascript:addfavorite()">加入收藏</a></li>
				<li><a class="toplink" href="/sitemap.html">网站地图</a></li>
				<?
				if(in_array($g_sys_version, array('B', 'C'))){ 
				?>
				<li><a class="toplink" href="/seller/">商家中心</a></li>
				<?
				}
				?>
				<li class="last">&nbsp; <b style="color:#ff6600">★ <?=$g_start_city?>十佳旅行社</b></li>
			</ul>
		</div>
	</div> 
 
	<div class="hd-wrap ota-container" >
		<div class="hd-logo"> <a href="<?=$g_domain?>"> <img src="/images/logo.png" alt="<?=$g_sitename?> <?=$g_page_title?>"></a>
			<h1><?=$g_sitename?></h1>
		</div> 
		
		<?
		if(in_array($g_sys_version, array('C'))){
		    $all_site = get_site();
			if(sizeof($all_site)>1){  
		?>
		<div class="hd-city">  
			<div class="city-change">
				<div class="city-site"> <i class="icon-head hdico-map"></i> <span id="citysite"><?=$g_config['city_name']?></span> </div> 
				<a id="change-city" class="change-link" href="javascript:void(0)">更改<i class="icon-head hdico-dropdown"></i></a> </div>
			<div class="city-text"><span class="city-site"></span></div>

			<div class="city-sub">
			<? 
			foreach ($all_site as $val){ 
			?>
			<a href="http://<?=$val['site_domain']?>" title="<?=$val['city_name']?>"><?=$val['city_name']?></a>
			<? 
			}
			?> 
			</div>
		</div> 
		<?
		    }
		}
		?>
 
		<div class="hd-search" id="search">
			<div class="search-classify">   
				<a class="search-classify-link" href="javascript:void(0)"> <span data-type="1" class="cat-select">全部产品</span> <i class="icon-head hdico-dropdown"></i> </a>
				<ul class="drop-down-list">
					<?  
					foreach ($g_product_type as $k => $v) { 
				    ?>
					<li data-type="<?=$k?>" <?if(req('goods_type')==$k){?>class="cat-select"<?}?> ><a href="javascript:void(<?=$k?>)"><?=$v?></a></li>
				    <?     
				    }
				    ?>  
				</ul>
			</div>
			<input type="text" placeholder="景区名称..." class="input-text" name="keywords" value="<?=req('keywords')?>"/>
			<div class="hd-sokey"> 
			<?
			// 热推关键词
			$hot_keywords = explode("\n", $g_misc['search_keywrods']);
			if(notnull($hot_keywords)){
				foreach ($hot_keywords as $v) {
			?>
			<a title="<?=$v?>" href="/search?keywords=<?=$v?>" > <?=$v?> </a>
			<?
				}
			}
			?>  
			</div>
			 
			<a id="btn-search" class="hd-sobtn" href="javascript:void(0)"><i class="icon-head hdico-search"></i></a> </div>

			<div class="ad"><?include(load_user_diy('diy.x01.html'));?></div>
	</div> 
	<!-- 导航 /--> 
</div>

<script src="/images/sea.js"></script> 
<script src="/images/base.js"></script> 
<script src="/images/config.js"></script>

<script language="javascript">
    var cityObj = {"HOT":{"index":[],"\u534e\u4e1c":[{"key":"SHA","val":"上海","PY":"SHANGHAI","JP":"SH"}],"\u534e\u5317":[{"key":"PEK","val":"\u5317\u4eac","PY":"BEIJING","JP":"BJ"},{"key":"TSN","val":"\u5929\u6d25","PY":"TIANJIN","JP":"TJ"}],"\u534e\u5357":[{"key":"CAN","val":"\u5e7f\u5dde","PY":"GUANGZHOU","JP":"GZ"},{"key":"SZX","val":"\u6df1\u5733","PY":"SHENZHEN","JP":"SZ"}],"\u897f\u5357":[{"key":"CKG","val":"\u91cd\u5e86","PY":"CHONGQING","JP":"CQ"}]},"A":{"B":[{"key":"PEK","val":"\u5317\u4eac","PY":"BEIJING","JP":"BJ"}],"C":[{"key":"CKG","val":"\u91cd\u5e86","PY":"CHONGQING","JP":"CQ"}],"G":[{"key":"CAN","val":"\u5e7f\u5dde","PY":"GUANGZHOU","JP":"GZ"}]},"N":{"S":[{"key":"SHA","val":"\u4e0a\u6d77","PY":"SHANGHAI","JP":"SH"},{"key":"SZX","val":"\u6df1\u5733","PY":"SHENZHEN","JP":"SZ"}],"T":[{"key":"TSN","val":"\u5929\u6d25","PY":"TIANJIN","JP":"TJ"}]}};
    var now_city="SZX"; 

    seajs.use(['jquery', 'handlebars', 'header', 'livequery', 'rightSide'], function ($, hlb, header, livequery, rightSide) {
        header.init();
        rightSide.init();
    });
</script>