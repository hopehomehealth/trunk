<!DOCTYPE HTML>
<html>
<head>
<meta charset="GBK" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta http-equiv="content-type" content="text/html; charset=GBK" />
<title>产品中心_<?=$g_shopname?>_<?=$g_sitename?></title>
<link rel="canonical" href="<?=$g_full_url?>"/> 
<link rel="stylesheet" href="<?=$g_tpl_path?>images/style.css" />
<link rel="stylesheet" href="<?=$g_tpl_path?>images/list.css" />
<link rel="stylesheet" href="<?=$g_tpl_path?>images/head.css">
</head>
<body>
<?include('head.php');?>

<div class="wrap">
	<!--导航--> 
	
	<!--面包屑导航-->
	
	
	<div class="box clrfix">
		<div class="main_l210_r750">
			<br/>
			<?include('nav.php');?>
			
			<!--leftbar-->
			<div class="main_r750"> 
				<div  style="margin-top:0px">
					<div > 
						<a href="<?=$g_shop_url?>">首页</a> 

						<span class="jt">></span> 
						<a href="<?=$g_shop_url?>product/">
						<b>产品中心</b>
						</a> 

						<?if($now_cat['cat_id']!=''){?>
						<span class="jt">></span> 
						<a href="<?=$g_shop_url?>product/list-<?=$now_cat['cat_id']?>.html">
						<b><?=$now_cat['cat_name']?></b>
						</a>
						<?}?>			
					</div>
					<hr size="1">
				</div> 

				<script type="text/javascript">
				function set_filter(vid, val){
					document.getElementById(vid).value = val;

					if(vid=='v_order_new') {
						document.getElementById('v_order_price').value = '';
						document.getElementById('v_order_sale').value = '';
					}
					if(vid=='v_order_price') {
						document.getElementById('v_order_new').value = '';
						document.getElementById('v_order_sale').value = '';
					}
					if(vid=='v_order_sale') {
						document.getElementById('v_order_price').value = '';
						document.getElementById('v_order_new').value = '';
					}
					document.getElementById('filter_form').submit();
				}
				</script> 

				<form id="filter_form" method="get" action="/product/"> 
				<input id="id" type="hidden" name="id" value="<?=req('id')?>">
				<input id="p" type="hidden" name="p" value="<?=req('p')?>">
				<input id="keywords" type="hidden" name="keywords" value="<?=req('keywords')?>">
				<input id="v_line_nature" type="hidden" name="v_line_nature" value="<?=req('v_line_nature')?>">
				<input id="v_money" type="hidden" name="v_money" value="<?=req('v_money')?>">
				<input id="v_line_day" type="hidden" name="v_line_day" value="<?=req('v_line_day')?>">
				<input id="v_cat_id" type="hidden" name="v_cat_id" value="<?=req('v_cat_id')?>">
				<input id="v_order_new" type="hidden" name="v_order_new" value="<?=req('v_order_new')?>">
				<input id="v_order_price" type="hidden" name="v_order_price" value="<?=req('v_order_price')?>">
				<input id="v_order_sale" type="hidden" name="v_order_sale" value="<?=req('v_order_sale')?>"> 

				<!--b_filter-->
				<div class="b_filter">
					<div class="e_filter_list" id="filters"> 
						
						<!-- 产品类型 --> 
						<dl class="e_filter_item" item="type">
							<dt class="e_filter_title">产品类型</dt>
							<dd class="e_filter_elements">
								<div class="e_filter_element_all"> <a <?if(req('v_line_nature')==''){?>class="active"<?}?> rel="nofollow" href="javascript:set_filter('v_line_nature', '')">不限</a> </div>
								<div class="e_filter_element_list">
									<ul class="clrfix">
										<? 
										foreach ($g_product_type as $k => $v) {
										?>
										<li> <a <?if(req('v_line_nature')==$k){?>class="active"<?}?> rel="nofollow" href="javascript:set_filter('v_line_nature', '<?=$k?>')"><?=$v?></a> </li>
										<?}?> 
									</ul>
								</div>
							</dd>
						</dl>
						<!--出行月份-->
						<dl class="e_filter_item" item="date">
							<dt class="e_filter_title">价格范围</dt>
							<dd class="e_filter_elements" item="list">
							 
								<div class="e_filter_element_all"> <a <?if(req('v_money')==''){?>class="active"<?}?> rel="nofollow" href="javascript:set_filter('v_money', '')">不限</a> </div>
								<div class="e_filter_element_list">
									<ul class="clrfix">
										<?
										foreach ($g_product_money as $k => $v) {
										?>
										<li> <a <?if(req('v_money')==$k){?>class="active"<?}?> rel="nofollow" href="javascript:set_filter('v_money', '<?=$k?>')"><?=$v?></a> </li>
										<?}?>  
									</ul>
								</div>
							</dd>
						</dl>
						<!-- 行程天数-->
						<dl class="e_filter_item" item="plan">
							<dt class="e_filter_title">行程天数</dt>
							<dd class="e_filter_elements">
								<div class="e_filter_element_all"> <a <?if(req('v_line_day')==''){?>class="active"<?}?> rel="nofollow" href="javascript:set_filter('v_line_day', '')">不限</a> </div>
								<div class="e_filter_element_list">
									<ul class="clrfix">
										<?
										foreach ($g_product_day as $k => $v) {
										?>
										<li> <a <?if(req('v_line_day')==$k){?>class="active"<?}?> rel="nofollow" href="javascript:set_filter('v_line_day', '<?=$k?>')"><?=$v?></a> </li>
										<?}?>  
									</ul>
								</div>
							</dd>
						</dl>
					 
						<!-- 目的地 -->
						<dl class="e_filter_item e_filter_item_last" item="target">
							<dt class="e_filter_title">目&nbsp;的&nbsp;地</dt>
							<dd class="e_filter_elements" item="list">
								 
								<div class="e_filter_element_all"> <a <?if(req('v_cat_id')==''){?>class="active"<?}?> href="javascript:set_filter('v_cat_id', '')">不限</a> </div>
								<div class="e_filter_element_list" style="height: auto">
									<ul class="clrfix">
										<?
										$shop_cats = get_shop_cat_cond_list();
										if(notnull($shop_cats)){  
											foreach ($shop_cats as $val){ 
										?>
										<li> <a <?if(req('v_cat_id')==$val['cat_id']){?>class="active"<?}?> href="javascript:set_filter('v_cat_id', '<?=$val['cat_id']?>')"><?=$val['cat_name']?></a> </li>
										<?
											}
										}
										?>
									</ul>
								</div>
							</dd>
						</dl>
					</div>
				</div>
				
				<!--排序-->
				<div class="b_sorter"> <b class="e_sorter_arr"></b>
					<div class="e_sorter_inner clr_after">
						<ul class="e_sorter">
							<?if(req('v_order_new')=='desc'){?>
							<li class="e_sorter_item e_sorter_item__status_asc <?if(req('v_order_new')!=''){?>active<?}?>"> <span> <a href="javascript:set_filter('v_order_new', 'asc')">更新时间</a> </span> </li>
							<?}else{?>
							<li class="e_sorter_item e_sorter_item__status_desc <?if(req('v_order_new')!=''){?>active<?}?>"> <span> <a href="javascript:set_filter('v_order_new', 'desc')">更新时间</a> </span> </li>
							<?}?>
							
							<?if(req('v_order_price')=='asc'){?>
							<li class="e_sorter_item e_sorter_item__normal_desc <?if(req('v_order_price')!=''){?>active<?}?>"> <span> <a href="javascript:set_filter('v_order_price', 'desc')">价格</a> </span> </li>
							<?}else{?>
							<li class="e_sorter_item e_sorter_item__normal_asc <?if(req('v_order_price')!=''){?>active<?}?>"> <span> <a href="javascript:set_filter('v_order_price', 'asc')">价格</a> </span> </li>
							<?}?>
							
							<?if(req('v_order_sale')=='desc'){?>
							<li class="e_sorter_item e_sorter_item__normal_asc <?if(req('v_order_sale')!=''){?>active<?}?>"> <span> <a href="javascript:set_filter('v_order_sale', 'asc')">销量</a> </span> </li>
							<?}else{?>
							<li class="e_sorter_item e_sorter_item__normal_desc <?if(req('v_order_sale')!=''){?>active<?}?>"> <span> <a href="javascript:set_filter('v_order_sale', 'desc')">销量</a> </span> </li>
							<?}?>
						</ul> 
						
						<!-- 自定义价格 -->
						<ul class="e_filter_ext">
							<li>
								<div class="e_filter_ext_item" id="price-filter">  
										<div class="e_filter_customtitle">自定义价格：</div>
										<div class="e_filter_custom">
											<input id="v_start_price" name="v_start_price" type="number" value="<?=req('v_start_price')?>" class="textbox" onchange="set_filter('v_start_price', this.value)" style="width:60px"/>
											-
											<input id="v_end_price" name="v_end_price" type="number" value="<?=req('v_end_price')?>" class="textbox" onchange="set_filter('v_end_price', this.value)" style="width:60px"/> 
										</div> 
								</div>
							</li>
						</ul>
					</div>
				</div> 

				<!--筛选列表结果-->
				<div class="e_result_ctn e_result_hot_ctn clr_after">
					<? 
					if(notnull($query_rows)){  
						foreach ($query_rows as $val){   
							$goods_image = $g_site_url."/upfiles/$g_siteid/".$val['goods_image'];

							$goods_url = $g_site_url.'product/detail-'.$val['goods_id'].'.html';
					?>
					<dl class="e_result_item">
						<dt><a target='_blank' href="<?=$goods_url?>"><img width="236" height="157" src="<?=$goods_image?>" /></a></dt>
						<dd class="title"> <a target='_blank' href="<?=$goods_url?>">
							<?=$val['goods_name']?>
							</a></dd>
						<dd class="mpr">市&nbsp;场&nbsp;价：<a target='_blank' href="<?=$goods_url?>"> <em>&yen;<?=$val['market_price']?></em></a></dd>
						<dd class="pr"> 促&nbsp;销&nbsp;价：<a target='_blank' href="<?=$goods_url?>">&yen;<b> <?=$val['real_price']?></b>起 </a> </dd>
						<dd class="date">已&nbsp;销&nbsp;售：<?=$val['sale_number']?></dd>
					</dl>
					<?
						}
					}
					?>
				</div>
				<!--翻页-->
				<div class="pager"> 
				<a class="prev" href="javascript:set_filter('p', '<?=$prev_number?>')">上一页</a> 
				
				<?for($i=1; $i<=$total_page; $i++){?>
				<?if($now_page==$i){?>
				<span class="current"><?=$i?></span> 
				<?}else{?>
				<a href="javascript:set_filter('p', '<?=$i?>')"><?=$i?></a> 
				<?}?>
				<?}?> 

				<a class="next" href="javascript:set_filter('p', '<?=$next_number?>')">下一页</a> 
				</div>
				<!--内链框--> 
				</form>
			</div> 
		</div>
	</div>

	<?include('foot.php');?>
</div> 
</body>
</html>
