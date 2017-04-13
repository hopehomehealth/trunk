<?
include($g_site_root.'/member/dialog.html');
?>
<?
if($g_config['site_notice']!='' && $is_index==true){
?>
<div class="top-notice">
	<div class="ota-container" style="text-align:center;color:red;">  
		<?=$g_config['site_notice']?> 
	</div>
</div>
<?}?>
<link rel="stylesheet" type="text/css" href="/themes/s01/images/common.css">
<div id="headbox">  
	<!-- <div id="ota-topnav">
		<div class="ota-container">
			<ul class="topnav-login"> 
				<script type="text/javascript" src="/ajax@login.status"></script>
			</ul>
			<ul class="topnav-list">  
				<li><a class="toplink" href="<?=$g_domain?>member/?cmd=<?=base64_encode('buycart.php')?>">会员中心</a></li> 
				<li><a class="toplink" href="/help/">用户帮助</a></li>  
				<li><a class="toplink" href="javascript:addfavorite()">加入收藏</a></li> 
				<?
				if(in_array($g_sys_version, array('B', 'C'))){ 
				?>
				<li><a class="toplink" href="/seller/" target="_blank">商家中心</a></li>
				<li><a class="toplink" href="http://b2b.cloota.com/" target="_blank">B2B分销系统</a></li>
				<?
				}
				?>
				<li class="last">&nbsp; <b style="color:#ff6600">★ <?=$g_start_city?>十佳旅行网站</b></li>
			</ul>
		</div>
	</div> --> 
 
	<!-- <div class="hd-wrap ota-container">
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
				<a class="search-classify-link" href="javascript:void(0)"> <span data-type="0" class="cat-select">全部产品</span> <i class="icon-head hdico-dropdown"></i> </a>
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
	</div> -->
	<!--  head  start -->
	<div id="topBox">
		<div id="top">
			<div class="topLeft">
				<a href="" class="logo">
					<img src="/themes/s01/images/logo.png">
				</a>
				<a href="" class="logo_text">
					<img src="/themes/s01/images/logowww.png">
				</a>
			</div>
			<div class="topRight">
				
				<div class="topAboveCont">
					<div class="topAboveCont_right">
						<div class="top_phoneApp">
							<span>APP</span>
							<img src="/themes/s01/images/appScan.jpg">	
						</div>
						<div class="top_wechat">
							<span>微信</span>
							<img src="/themes/s01/images/wechatScan.jpg">	
						</div>
					</div>
					<div class="topAboveCont_left">
						<span id="topTime">2017年01月18日&nbsp;星期三&nbsp;</span>
						<span id="topAddress">
							<span><a href="" class="currentCity" id="moment"><span id="selCity">北京</span></a></span>&nbsp;
							<a href="/city0" id="changeCity" style="color:#1ecd9d;">[切换]</a>
						</span>
					</div>
				</div>
				
				<div class="hotline">
				&nbsp;&nbsp;&nbsp;客服热线：<span>&nbsp;400-08-84365&nbsp;400-99-84365</span>
				</div>
			</div>
		</div>
	</div>
	<!-- head  end -->

	<!--  nav导航  start -->
	<div id="navBox">
		<div id="nav">
			<div class="navLeft">
				<ul>
					<li class=""><a href="<?=$g_bus365_domain?>">首页</a></li>
					<li><a href="<?=$g_bus365_domain?>/schedule">汽车票</a></li>
					<li><a href="<?=$g_bus365_domain?>">飞机票</a></li>
					<li><a href="<?=$g_bus365_domain?>/train/toTrain_index">火车票</a></li>
					<li style="position: relative;background-image:url(/themes/s01/images/xiala.png);background-repeat:no-repeat;background-position:65px center;" class="trip_list_btn nav_hover">
						<a href="<?=$g_self_domain?>" style="width: 100%;height: 50px;">旅游</a>
						<ul class="trip_list hide">
							<li><a href="">自由行</a></li>
							<li><a href="<?=$g_self_domain?>/zhoubian/">周边游</a></li>
							<li><a href="">国内游</a></li>
							<li><a href="<?=$g_self_domain?>/menpiao/">门票</a></li>
							<li><a href="">游轮</a></li>
							<li><a href="">攻略</a></li>
						</ul>
					</li>
					<li><a href="https://www.alitrip.com/jiudian/?spm=181.7091613.191938.6.sn8JQ5">酒店</a></li>
					<li><a href="<?=$g_bus365_domain?>">用车</a></li>
					<li><a href="<?=$g_bus365_domain?>/phone">手机版</a></li>
				</ul>
			</div>
			<div class="navRight">
				<div class="mybus365" style="position: relative;background-image:url(/themes/s01/images/xiala.png);background-repeat:no-repeat;background-position:115px center;">
					<a href="" id="mybus365_btn">我的Bus365</a>
					<ul class="before_login hide">
						<li><a href="<?=$g_bus365_domain?>/index/order/orders/">我的订单</a></li>
						<li><a href="<?=$g_bus365_domain?>/noneuserorder">非会员订单</a></li>
					</ul>
					<ul class="after_login hide">
						<li>
							<a href="">我的订单</a>
						</li>
						<li>
							<a href="">待支付订单</a>
						</li>
						<li>
							<a href="">乘车待点评</a>
						</li>
						<li>
							<a href="">会员信息</a>
						</li>
						<li>
							<a href="">会员安全</a>
						</li>
						<li>
							<a href="">常用乘车联系人管理</a>
						</li>
						<li>
							<a href="">我的优惠券</a>
						</li>
						<li>
							<a href="javascript:void(0)">退出登录</a>
						</li>
					</ul>
				</div>
				<div class="loginAndReg">
					<a href="<?=$loginUrl?>">登录</a>|<a href="<?=$registerUrl?>">注册</a>
				</div>
			</div>
		</div>
	</div>
	<!--  nav导航  end -->

	<!-- 搜索区域 start -->
	<div id="searchMainBox">
		<div id="searchMain">
			<div class="searchMain1">
				<div class="searchMain1_l">
					<span>全部产品</span>
					<ul style="">
						<li style="background-color:#1fcc9e;color:white;">全部产品</li>
						<li>景点门票</li>
						<li>周边游</li>
					</ul>
				</div>
				<div class="searchMain1_c">
					<input type="text" name="请输入目的地/产品名称" placeholder="请输入目的地/产品名称">
				</div>
				<div class="searchMain1_r"></div>
			</div>
		</div>
	</div>
	<!-- 搜索区域 end -->
 
	<div id="hd-mainnav">
		<div class="ota-container">   
			<div class="nav-main-classify"> <a class="classify-link" href="javascript:void(0)"><!-- <i class="icon-head hdico-classify"> --></i>全部旅游产品分类</a>
				<ul class="classify-list">
					<?include('index.hotspot.php');?> 
				</ul>
			</div>
			
			<!-- 旅游产品分类 /-->
			
			<ul class="nav-list">
				
				<!-- 主导航 -->  
				<?
				$menu01 = get_menu('0', 10);  
				if(notnull($menu01)){ 
					$m=1;
					foreach ($menu01 as $val){  
						$menu_url = str_replace('{domain}', $g_domain, $val['url']);

						$menu02 = get_menu($val['menu_id'],20); 
				?>
				<li class="n<?=$m?>"><a href="<?=$menu_url?>" target="<?=$val['target']?>" style="<?=$val['css']?>" class="nav-link"><?=$val['title']?><?if(notnull($menu02)){?><i class="icon-head arrows"></i><?}?></a>
					<?if(notnull($menu02)){?>
					<div class="nav-sublist">
						<div class="ota-container">
							<div class="nav-subitem ">
							<?  
							foreach ($menu02 as $cval){  
									$child_menu_url = str_replace('{domain}', $g_domain, $cval['url']);
							?>
							<a href="<?=$child_menu_url?>" target="<?=$cval['target']?>" style="<?=$cval['css']?>"><?=$cval['title']?></a>
							<?  
							}
							?>
							</div>
						</div>
					</div>
					<?}?>
				</li>
				<?
					$m++;
					}
				}
				?>  
			</ul>
			<!-- 主导航 --> 
			
		</div>
	</div>
	<!-- 导航 /--> 
</div>

<script src="/themes/s01/images/sea.js"></script>
<script src="/themes/s01/images/base.js"></script>
<script src="/themes/s01/images/config.js"></script>
<script src="/themes/s01/images/common.js" charset="gbk"></script>
<script language="javascript">
    var cityObj = {"HOT":{"index":[],"\u534e\u4e1c":[{"key":"SHA","val":"上海","PY":"SHANGHAI","JP":"SH"}],"\u534e\u5317":[{"key":"PEK","val":"\u5317\u4eac","PY":"BEIJING","JP":"BJ"},{"key":"TSN","val":"\u5929\u6d25","PY":"TIANJIN","JP":"TJ"}],"\u534e\u5357":[{"key":"CAN","val":"\u5e7f\u5dde","PY":"GUANGZHOU","JP":"GZ"},{"key":"SZX","val":"\u6df1\u5733","PY":"SHENZHEN","JP":"SZ"}],"\u897f\u5357":[{"key":"CKG","val":"\u91cd\u5e86","PY":"CHONGQING","JP":"CQ"}]},"A":{"B":[{"key":"PEK","val":"\u5317\u4eac","PY":"BEIJING","JP":"BJ"}],"C":[{"key":"CKG","val":"\u91cd\u5e86","PY":"CHONGQING","JP":"CQ"}],"G":[{"key":"CAN","val":"\u5e7f\u5dde","PY":"GUANGZHOU","JP":"GZ"}]},"N":{"S":[{"key":"SHA","val":"\u4e0a\u6d77","PY":"SHANGHAI","JP":"SH"},{"key":"SZX","val":"\u6df1\u5733","PY":"SHENZHEN","JP":"SZ"}],"T":[{"key":"TSN","val":"\u5929\u6d25","PY":"TIANJIN","JP":"TJ"}]}};
    var now_city="SZX"; 

    seajs.use(['jquery', 'handlebars', 'header', 'livequery', 'rightSide'], function ($, hlb, header, livequery, rightSide) {
        header.init();
        rightSide.init();
    });
</script>