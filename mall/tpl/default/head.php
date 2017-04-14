<div class="q_header q_header_package q_header_package_mini">
	<div class="q_header_main" >
		<div class="q_header_logo"> <a href="<?=$g_site_url?>" target="_blank" title="<?=$g_sitename?>首页" hidefocus="on"><img src="<?=$g_site_url?>images/logo.png" style="height:30px;padding-top:3px"></a> </div>
		<div class="q_header_tnav">
			<ul>
				<li class="q_header_username"><a href="<?=$g_site_url?>member/login" hidefocus="on" target="_blank">登录</a></li>
				<li class="q_header_register"><a href="<?=$g_site_url?>member/register" hidefocus="on" target="_blank">注册</a></li>
				<li class="q_header_tnav_omenu">
					<dl>
						<dt><a href="<?=$g_site_url?>member/?cmd=<?=base64_encode('order.php')?>" target="_blank" class="q_header_tnav_omenu_link" id="q_header_tnav_omenu_link"><span class="q_header_tnav_omenu_title">购物车(<script type="text/javascript" src="<?=$g_site_url?>member/plugin?cmd=buycart_number"></script>)</span></a></dt> 
					</dl>
				</li>
				<li><a href="<?=$g_site_url?>help/" target="_blank" >帮助中心</a> </li>
				<li class="last"><a href="<?=$g_site_url?>page/contact.html" target="_blank" >客服中心</a> </li>
			</ul>
		</div>
		<div class="q_header_mini_nav"> 
		<a href="<?=$g_site_url?>" class="q_header_mini_link" title="<?=$g_sitename?>首页"><?=$g_shopname?></a> 
		</div>
	</div> 
</div> 
 
 
<div class="content">
	<form method="get" action="" id="search_form" target="_blank">
	<div class="box clrfix">
		<div class="top_l_r">
			<div class="top_l"> <a href="/" ><img src="<?=$g_upfile_url?><?=$g_shop['shop_ico']?>" alt="<?=$g_shopname?>" height="60" /></a> </div>
			<div class="top_r clrfix">
				<div id="search-area" class="s_inner1" style="display: block;">
					
					<div id="dj_search" class="search_form_common">
						<div class="search_form_common_input">
							<input type="text" name="keywords" id="keywords" style="float:right; width:280px; margin-right:58px;border:5px solid #F46337;height:28px;padding-left:5px;" required placeholder="请输入目的地关键词...">
							<a id="searchBtn" class="btn_search btn_search_ben" href="javascript:search('1')" style="border:0;margin-top:4px;">搜索</a> </div>
					</div>
				</div> 
			</div>
		</div>
	</div>
	</form>
</div>
<script type="text/javascript">
function search(v){
	var search_form = document.getElementById('search_form');
	if(v=='0'){
		search_form.action = '<?=$g_site_url?>/product/';
		search_form.submit();
	}
	if(v=='1'){
		search_form.action = '/product/';
		search_form.submit();
	}
}
</script>

<div class="tts_nav">
	<div class="tts_nav_main">
		<ul class="m_nav_r">
			<li class="li_b"><a href="/aboutus.html">关于我们</a></li>
		</ul>
		<ul class="m_nav">
			<li <?if($is_index==true){?>class="on"<?}?>><a href="<?=$g_shop_url?>">首页</a></li>
			<li <?if($g_url=='/product/'){?>class="on"<?}?>><a href="<?=$g_shop_url?>product/">全部产品</a></li>
			<?
			$nav_shop_cats = get_shop_cat_nav_list(10);
			if(notnull($nav_shop_cats)){  
				foreach ($nav_shop_cats as $val){ 
			?>
			<li <?if(strpos($g_url, 'list-'.$val['cat_id'])!==false){?>class="on"<?}?>><a href="/product/list-<?=$val['cat_id']?>.html"><?=$val['cat_name']?></a></li>
			<?
				}
			}
			?> 
		</ul>
	</div>
</div>
