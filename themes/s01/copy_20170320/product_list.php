<!DOCTYPE html>
<html>
<head>
<?include('meta.php');?>
<?seo();?>
<?load_mobile('http://'.$g_config['mobile_domain'].'/'.$c_catalog_key.'/');?>

<?include('static.php');?> 

<link rel="stylesheet" type="text/css" href="/themes/s01/images/list.css">
</head>

<body class="bodybox">
<?include('head.php');?>
<div class="container"> 
	<!--更改目的地-->
	<ul class="breadcrumbs">
	  <li class="item"><a href="<?=$g_domain?>">首页</a> </li> 
	  <?
	  if($c_goods_type=='1'){
	  ?>
	  <li class="item"><span>&gt</span><a href="/gentuan/all/">跟团游</a></li>
	  <?}?>
	  <?
	  if($c_goods_type=='2'){
	  ?>
	  <li class="item"><span>&gt</span><a href="/ziyouxing/all/">自由行</a></li>
	  <?}?>
	  <?
	  if($c_goods_type=='3'){
	  ?>
	  <li class="item"><span>&gt</span><a href="/qianzheng/">签证</a></li>
	  <?}?>
	  <?
	  if($c_goods_type=='6'){
	  ?>
	  <li class="item"><span>&gt</span><a href="/youlun/">邮轮</a></li>
	  <?}?>
	  <? 
	  if($c_goods_type=='1' || $c_goods_type=='2'){
		  if(notnull($c_breadcrumb)){
			 $n = 0;
			 foreach ($c_breadcrumb as &$v) {
				 if(notnull($v)){
	  ?>
		  <li class="item"><span>&gt;</span><a href="<?=$g_domain?><?=$g_product_type_url[$c_goods_type]?>/<?=$v['cat_key']?>/" class="check_more">
		  <?=$v['cat_name']?>
		  </a></li>
	  <?			$n++;
				 }
			 }  
		  }  
	  }
      ?> 
	  <?if($n==0){?>
		  <?if(req('action')=='subject'){?>
		  <li class="item current"><span>&gt;</span><?=$this_page_title?></li>
		  <?}else{?>
		  <li class="item current"><span>&gt;</span>全部产品</li>
		  <?}?>
	  <?}?> 
	</ul>
	
	<?
	$ad_list = get_ad(req('goods_zone'), '0', 8);
	if(notnull($ad_list)){  
	?> 	 
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
	<?}?>  
 
	<?if($c_catalog['cat_name']!=''){?>
	<div class="mg-citypath"> 
		<div class="fl"><a href="<?=$g_full_url?>"><?=$c_catalog['cat_name']?><span>&nbsp;&nbsp;</span> </a></div>
		
		<!--
		<div class="more-city"> 
			<span class="change-city">更改<i class="icon arr-down-gray">&nbsp;</i></span>
			<dl class="city-open">
				<dt>海南</dt>
				<dd> <a href='javascript:void(0);' title='三亚'
                           class='selected'>三亚</a> <a href='javascript:void(0);' title='海口'
                           class=''>海口</a> <a href='javascript:void(0);' title='琼海'
                           class=''>琼海</a> <a href='javascript:void(0);' title='博鳌'
                           class=''>博鳌</a> </dd>
				<dt>国内</dt>
				<dd><a title="丽江" href="javascript:void(0);">丽江</a><a  title="大理" href="javascript:void(0);">大理</a><a  title="香格里拉" href="javascript:void(0);">香格里拉</a><a  title="泸沽湖" href="javascript:void(0);">泸沽湖</a></dd>
				<dt>出境</dt>
				<dd><a title="美洲" href="javascript:void(0);">美洲</a><a  title="澳洲" href="javascript:void(0);">澳洲</a><a  title="新西兰" href="javascript:void(0);">新西兰</a></dd>
			</dl>
		</div>
		-->
	</div>
	<?}?>
	 
	<!-- 主体 -->
	<div class="main fl"> 
		
		<?if(in_array($c_goods_type, array(1,2,4,5)) && 1==2){?>
		<ul class="filter-nav">
			<?  
            foreach ($g_product_type as $k => $v) { 
				if(in_array($k, array(1,2,4,5))){
            ?>
            <li><a href="javascript:filter('type', '<?=$k?>')" data-id="recommend" <?if($c_goods_type==$k){?>class="selected"<?}?>><?=$v?></a></li>
			<?
				}
			}
			?> 
		</ul> 
		<?}?>

		<?
		if($c_goods_type=='3'){
			include('block_filter_visa.php');
		}
		elseif($c_goods_type=='6'){
			include('block_filter_ship.php');
		} else {
			include('block_filter_line.php');
		}
		?>
	 

		<?
		$order_type = req('sc'); 
		if($order_type=='' || $order_type=='asc') $order_type = 'desc';
		else $order_type = 'asc';
		?>
		<div class="mg-sort">
			<ul class="sort-group fl mr10">
				<li><a id="list-f-312-1" <?if(req('hot')=='yes'){?>class="select"<?}?> href="javascript:filter('hot', '<?if(req('hot')=='yes'){?><?}else{?>yes<?}?>')">推荐</a></li>
				<li><a id="list-f-312-2" <?if(req('col')=='sale'){?>class="select"<?}?> title="点击按销量从高到低排序" href="?<?=$page_args?>&ord=true&col=sale&sc=<?=$order_type?>">销量<i class="icon <?if(req('sc')=='desc'){?>sort-up<?}else{?>sort-down<?}?>"> &nbsp;</i></a></li> 
				<li><a id="list-f-312-4" <?if(req('col')=='price'){?>class="select"<?}?> title="点击按价格从低到高排序" href="?<?=$page_args?>&ord=true&col=price&sc=<?=$order_type?>">价格<i class="icon <?if(req('sc')=='desc'){?>sort-up<?}else{?>sort-down<?}?>"> &nbsp;</i></a> </li>
			</ul>
			<div class="price-group">
				<input type="number" min="1" maxlength="5" class="input-sm" id="l_m" value="<?=req('l_money')?>">
				-
				<input type="number" min="1" maxlength="5" class="input-sm" id="h_m" value="<?=req('h_money')?>">

				<div class="pg-btnbox"> <a
                    id="list-f-minmax" class="sort-btn" onclick="filter_money()" style="cursor:pointer">确定</a></div>
			</div>
			<div class="promotion"> 
				<!--
				<label><input type="checkbox" name="" class="input-c">秒杀</label>
				<label><input type="checkbox" name="" class="input-c">预付特惠</label>
				<label><input type="checkbox" name="" class="input-c">返现</label>
				--> 
			</div>
		</div>

		<?
	    if(notnull($query_rows)){
			foreach ($query_rows as $val){  
				$goods_image = "/upfiles/$g_siteid/".$val['goods_image'];  
				$sku_list	 = get_sku_list($val['goods_id'], 5);
				$goods_url	 = get_goods_url($val['cat_key'], $val['goods_id']);
		?>
		<div class="lv-list"> 
			<!-- 产品信息 -->
			<div class="info"> 
				<a class="imgbox" title="" href="<?=$goods_url?>"> <img alt="<?=$val['goods_name']?>" src="<?=$goods_image?>" onerror= "javascript:this.src='/themes/s01/images/lv_list_default.png' "> </a>
				<dl class="text">
					<dt style="width:550px"><a href="<?=$goods_url?>" target="_blank" <?if($val['is_hot']==1){?>style="color:red;font-weight:bold;"<?}?>><?=$val['goods_name']?></a></dt>
					
					<?if(in_array($val['goods_type'],array(1,2,6))){?>
					<dd style="margin-top:10px">
						<table cellspacing='0' cellpadding='0' border='0'>
							<tr>
								<td><div class='row'>共有 <?=$val['clicks']?> 人关注</div></td>
							</tr>
						</table>
					</dd>
					 
					<dd>
					<?if($g_profile['start_region']!=''){?>
					出发城市：<span class="mr30"><?=$g_profile['start_region']?></span>
					<?}?>
					</dd>
					<dd>
					<?if($val['line_days']>0){?>
					行程天数：<?=$val['line_days']?>天<?=$val['line_nights']?>晚
					<?}?>
					</dd>
					<?
					if(notnull($sku_list)){
					?>
					<dd><span class="ff-toh">出行日期：
						<?foreach ($sku_list as $cval){ 
						?>
						<?=$cval['departdate']?>
						<?
						}
						?>
					</dd>
					<?
					}
					?>
					<?}else{?>
					<dd style="margin-top:20px"><?=show_substr(removehtml($val['summary']),180)?></dd>
					<?}?>
				</dl>
				<div class="lv-lineright">
					<div class="price yellow-a"><sub>&yen;</sub> <span class="num"><?=$val['min_price']?></span> <sub>起/人</sub></div>
					<a href="<?=$goods_url?>" target="_blank" class="btn  btn-sm">查看详情</a>
					<div class="count"> </a></div>
				</div>
				<div class="ui-tag <?if($val['goods_type']==2){?>tag-e<?}?> <?if($val['goods_type']>2){?>tag-c<?}?>"><?=$g_product_type[$val['goods_type']]?><i>&nbsp;</i></div>
			</div>
		</div>
		<?
			}
		} else {
		?>
		<div class="box-warning bw-bold mb15" style="margin-top:20px">
			<i class="icon waring-sm"></i>很抱歉，没有找到<?if($keywords!=''){?>与 <b class="yellow-a">“<?=$keywords?>”</b> <?}?>相关的产品，要不看看其它产品，或者换个关键词搜索！
		</div>
		<?}?>
		

		<?if(notnull($query_rows)){?>
		<!--分页-->
		<div class="pagination mt30" style="margin:40px 0 80px 0;"> 
			共<?=$total_page?>页 
			<?
			function get_page_url($page){
		
				global $action, $c_catalog_key, $page_args;
 
				if($action == 'cat_key'){
					return "/$c_catalog_key/page-$page.html"; 
				} else {
					return "?p=$page$page_args"; 
				}
			}
			if($total_page<6){
				for($m=1; $m<=$total_page; $m++){
					if($now_page==$m){
						echo "<a href='".get_page_url($m)."' class='curr'>$m</a> "; 
					} else {
						echo "<a href='".get_page_url($m)."'>$m</a> "; 
					}
				}
			} else {
				if($now_page<6){
					for($m=1; $m<6; $m++){
						if($now_page==$m){
							echo "<a href='".get_page_url($m)."' class='curr'>$m</a> "; 
						} else {
							echo "<a href='".get_page_url($m)."'>$m</a> "; 
						}
					}
					echo "<a href='".get_page_url(6)."'>6</a> "; 
					echo " <a href='#'>...</a> <a href='".get_page_url($total_page)."'>$total_page</a> ";
				}
				
				if($now_page>=6){
					echo "<a href='".get_page_url(1)."'>1</a> <a href='#'>...</a> ";
					$max_page = $now_page+2;
					if($max_page>$total_page){
						$max_page = $now_page;
					}
					for($m=$now_page-2; $m<=$max_page; $m++){ 
						if($now_page==$m && $now_page<=$total_page){
							echo "<a href='".get_page_url($m)."' class='curr'>$m</a> "; 
						} else {
							echo "<a href='".get_page_url($m)."'>$m</a> "; 
						} 
					}
					if($max_page<$total_page){
						echo " <a href='#'>...</a> <a href='".get_page_url($total_page)."'>$total_page</a> ";
					}
				} 
			}
			?>  
			<a href="<?=get_page_url($next_number)?>" class="nextpage">下一页</a> 

			<script type="text/javascript">
			function goPage(){
				var p_v = $("#pageNoInput").val();
				window.location.href="?p="+p_v+"<?=$page_args?>";
			}
			</script> 

			到
			<div class="pagination_gopage_wrap">
				<input id="pageNoInput" type="text" value="<?=req('p')?>" class="pagination_btn_go_input">
				页
				<input type="button" value="确定" class="pagination_btn_go" onclick="goPage()">
			</div>
		</div>
		<?}?>
	</div>
	
	 
	<div class="aside fr"> 
		
		<!-- 热卖 -->
		<div class="mb15">
		<? 
			$ad_list = get_ad('p_r', '0', 3);
			if(notnull($ad_list)){  
			?> 
				<?foreach ($ad_list as $cval){?>
				<a href="<?=$cval['ad_url']?>" target="_blank" title="<?=$val['ad_title']?>"> <img src="/upfiles/<?=$g_siteid.'/'.$cval['ad_image']?>" alt="<?=$val['ad_title']?>"> </a><br/>
				<?}?>  
			<?}?>
			<?//include(load_user_diy('diy.x05.html'));?>
		</div>

		<div class="aside-box aside-hot">
			<div class="aside-title">猜您喜欢</div>
			<ul>
				<? 
				$guess_list = get_guess_list(10);
				if(notnull($guess_list)){
					$n = 1;
					foreach ($guess_list as $val){  
						$goods_image = $g_domain."upfiles/$g_siteid/".$val['goods_image'];
				?> 
				<li> <i class="lv-icon ico-snum"><?=$n?></i> <a href="/product/detail-<?=$val['goods_id']?>.html" target="_blank" title="<?=$val['goods_name']?>"> 
					<?=$val['goods_name']?> </a>
					<div class="yellow-a"><sub>&yen;</sub> <strong><?=$val['min_price']?></strong> 起
					<span style="float:right"><?=date('m/d H:i', strtotime($val['browse_time']))?>浏览过</span>
					</div>
				</li>
				<?
					$n++;
					}
				}
				?> 
			</ul>
		</div> 
		
		<?
		$goods_article = list_goods_article(5);
		if(notnull($goods_article)){ 
		?>
		<div class="aside-box aside-hot">
			<div class="aside-title"><?=$c_catalog['cat_name']?>旅游攻略</div>
			<ul class="order-news">
				<?
			    foreach ($goods_article as $val){  
					$news_url = get_news_url($val['thread_id']);
		        ?>
				<li>
					<a href="<?=$news_url?>" targe="_blank"><?=$val['title']?></a>

					<div class="mt10"><?=date('Y/m/d', strtotime($val['addtime']))?> <span class="gray-b">浏览<?=$val['clicks']?>次</span></div>
				</li>
				<?}?> 
			</ul>
		</div>
		<?}?>  
	</div>
	<div class="clear"></div>
</div>
<div class="clear"></div>
<?include('foot.php');?>
</body>
</html>
