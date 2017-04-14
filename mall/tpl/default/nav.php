


<!--rightbar-->
<div class="main_l210">  

	<div class="shop-info">
		<div class="title">商家信息</div>

		<div class="shopcont">
			<div class="shop-rank grow"> 
				<strong><?=$g_shopname?></strong> <em><?=$g_sitename?>认证商家</em>
				<div class="shop-level clrfix"><i class="ico"></i>
					<dl>
						<dt>成长卖家</dt>
						<dd>信用等级<i class="level-notice">Lv<?=$g_shop['auth_level']?></i></dd>
						<dd>
							<div class="progress"><i class="prospect" style="width:<?=$g_shop['auth_level']?>0%"></i></div>
						</dd>
					</dl>
				</div>
				<div class="notice clrfix"> <span class="direction"> 店铺评分<var><?=$g_shop['auth_score']?></var><i class="up"></i></span><em class="text">领先同业</em></div>
			</div>
		</div>

		 
		<div class="serve-tel"> <i class="tel"></i> <strong>服务热线</strong> <em> <small><?=$g_shop['hotline']?></small> </em> <span>08:00 - 23:00</span> </div>
		
		<?
		if($g_shop['im_qq']!='' || $g_shop['im_ww']!=''){
		?>
		<div class="serve-tel"> 
			<i class="online"></i> <strong>在线客服</strong> 
			<?
			$im_qq_arr = explode("\n", $g_shop['im_qq']);
			if(notnull($im_qq_arr)){
				foreach ($im_qq_arr as &$v) {
					if(trim($v)!=''){
			?>
			<span><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?=$v?>&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:<?=$v?>:51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a></span> 
			<?
					}
				}
			}
			?>

			<?
			$im_ww_arr = explode("\n", $g_shop['im_ww']);
			if(notnull($im_ww_arr)){
				foreach ($im_ww_arr as &$v) {
					if(trim($v)!=''){
			?>
			<span><a target="_blank" href="http://www.taobao.com/webww/ww.php?ver=3&touid=<?=$v?>&siteid=cntaobao&status=1&charset=utf-8"><img border="0" src="http://amos.alicdn.com/realonline.aw?v=2&uid=<?=$v?>&site=cntaobao&s=1&charset=utf-8" alt="点击这里给我发消息" /></a></span> 
			<?
					}
				}
			}
			?> 
		</div> 
		<?}?>

		<!-- 资质 -->
		<div class="business">
			<ul>
				<li>
					<label>供应商名称</label>
					<a href="<?=$g_shop_url?>"><?=$g_shopname?></a></li> 
				<li>
					<label>许可证编号</label>
					<?=$g_shop['cert_code']?></li>
				<li>
					<label>经营范围</label>
					<?=$g_shop['cert_scope']?></li>
			</ul>
		</div>
	</div>

	<!--商家产品分类-->
	<div class="pro_con">
		<p class="pro_title"><em>商家产品分类</em></p>

		<div class="pro_con_s"> 
			<!--目的地分类-->
			<div class="title">
				<dl class="clrfix">
					<dt class="icon_1 png24"></dt>
					<dd class="level_1">按目的地分类</dd>
				</dl>
			</div>
			<div class="d_item"> 
				<?
				$cat01 = get_shop_cat_list(0, 10);

				if(notnull($cat01)){  
					foreach ($cat01 as $val){     
				?>
				<!--国内游-->
				<dl class="clrfix">
					<dt class="icon_0 png24"></dt>
					<dd class="level_2"><a href="/product/?id=<?=$val['cat_id']?>" style="font-size:14px"><?=$val['cat_name']?></a></dd>
				</dl>
				<?
				$cat02 = get_shop_cat_list($val['cat_id'], 20);

				if(notnull($cat02)){  
					foreach ($cat02 as $cval){     
				?>
				<dl class="clrfix">
					<dt></dt>
					<dd class="level_3"> > <a href="/product/list-<?=$cval['cat_id']?>.html"><?=$cval['cat_name']?></a></dd>
				</dl>
				<?
					}
				}
				?> 
				<?
					}
				}
				?>  
			</div>
			<!--end 目的地分类--> 
		  
		</div>
	</div>
<!--广告位-->
</div> 