<!DOCTYPE html>
<html>
<head>
<?include('meta.php');?>
<?seo();?>
<?load_mobile('http://'.$g_config['mobile_domain'].'/'.$this_catalog_key.'/');?>

<?include('static.php');?> 

<link rel="stylesheet" type="text/css" href="/images/list.css">
</head>

<body class="bodybox">
<?include('head.php');?>
<div class="container"> 
	<!--����Ŀ�ĵ�-->
	<ul class="breadcrumbs">
	  <li class="item"><a href="<?=$g_domain?>">��ҳ</a> </li>  
	  <li class="item current"><span>&gt;</span>������Ʒ ��<strong><?=req('keywords')?></strong>��</li>
	</ul>
	

	 
	<!-- ���� -->
	<div class="main fl"> 
		

		<!-- ɸѡ -->
		<script type="text/javascript">
		function filter(n, v){
			document.getElementById('f_'+n).value = v; 
			document.getElementById('filter_form').submit();
		}
		function filter_money(){
			document.getElementById('f_l_money').value = document.getElementById('l_m').value; 
			document.getElementById('f_h_money').value = document.getElementById('h_m').value; 
			document.getElementById('filter_form').submit();
		}
		</script>
		<form id="filter_form" method="get" action="/search">
		<input type="hidden" name="keywords" id="keywords" value="<?=req('keywords')?>"> 
		<input type="hidden" name="money" id="f_money" value="<?=req('money')?>">
		<input type="hidden" name="hot" id="f_hot" value="<?=req('hot')?>">
		<input type="hidden" name="l_money" id="f_l_money" value="<?=req('l_money')?>">
		<input type="hidden" name="h_money" id="f_h_money" value="<?=req('h_money')?>"> 
		</form>
	 

		<?
		$order_type = req('type'); 
		if($order_type=='' || $order_type=='asc') $order_type = 'desc';
		else $order_type = 'asc';
		?>
		<div class="mg-sort">
			<ul class="sort-group fl mr10">
				<li><a id="list-f-312-1" <?if(req('hot')=='yes'){?>class="select"<?}?> href="javascript:filter('hot', '<?if(req('hot')=='yes'){?><?}else{?>yes<?}?>')">�Ƽ�</a></li>
				<li><a id="list-f-312-2" <?if(req('col')=='sale'){?>class="select"<?}?> title="����������Ӹߵ�������" href="?<?=$page_args?>&ord=true&col=sale&type=<?=$order_type?>">����<i class="icon <?if(req('type')=='desc'){?>sort-up<?}else{?>sort-down<?}?>"> &nbsp;</i></a></li> 
				<li><a id="list-f-312-4" <?if(req('col')=='price'){?>class="select"<?}?> title="������۸�ӵ͵�������" href="?<?=$page_args?>&ord=true&col=price&type=<?=$order_type?>">�۸�<i class="icon <?if(req('type')=='desc'){?>sort-up<?}else{?>sort-down<?}?>"> &nbsp;</i></a> </li>
			</ul>
			<div class="price-group">
				<input type="number" min="1" maxlength="5" class="input-sm" id="l_m" value="<?=req('l_money')?>">
				-
				<input type="number" min="1" maxlength="5" class="input-sm" id="h_m" value="<?=req('h_money')?>">

				<div class="pg-btnbox"> <a
                    id="list-f-minmax" class="sort-btn" onclick="filter_money()" style="cursor:pointer">ȷ��</a></div>
			</div>
			<div class="promotion"> 
				<!--
				<label><input type="checkbox" name="" class="input-c">��ɱ</label>
				<label><input type="checkbox" name="" class="input-c">Ԥ���ػ�</label>
				<label><input type="checkbox" name="" class="input-c">����</label>
				--> 
			</div>
		</div>

		<?
	    if(notnull($query_rows)){
			foreach ($query_rows as $val){  
				$goods_image = "/upfiles/$g_siteid/".$val['goods_image'];  
				$goods_url = get_goods_url($val['cat_key'], $val['goods_id']);
		?>
		<div class="lv-list"> 
			<!-- ��Ʒ��Ϣ -->
			<div class="info"> 
				<a class="imgbox" title="" href="<?=$goods_url?>"> <img alt="<?=$val['goods_name']?>" src="<?=$goods_image?>" > </a>
				<dl class="text">
					<dt><a href="<?=$goods_url?>" target="_blank" <?if($val['is_hot']==1){?>style="color:red"<?}?>><?=$val['goods_name']?></a></dt>
				   
					<dd>
						<?=show_substr(removehtml($val['summary']),300)?>
					</dd> 
				</dl>
				<div class="lv-lineright">
					<div class="price yellow-a"><sub>&yen;</sub> <span class="num"><?=$val['min_price']?></span> <sub>��/��</sub></div>
					<a href="<?=$goods_url?>" target="_blank" class="btn  btn-sm">�鿴����</a>
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
			<i class="icon waring-sm"></i>�ܱ�Ǹ��û���ҵ�<?if($keywords!=''){?>�� <b class="yellow-a">��<?=$keywords?>��</b> <?}?>��صĲ�Ʒ��Ҫ������������Ʒ�����߻����ؼ���������
		</div>
		<?}?>
		

		<?if(notnull($query_rows)){?>
		<!--��ҳ-->
		<div class="pagination mt30"> 
			��<?=$total_page?>ҳ 
			<?
			function get_page_url($page){
		
				global $action, $this_catalog_key, $page_args;
 
				if($action == 'cat_key'){
					return "/$this_catalog_key/page-$page.html"; 
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
			<a href="<?=get_page_url($next_number)?>" class="nextpage">��һҳ</a> 

			<script type="text/javascript">
			function goPage(){
				var p_v = $("#pageNoInput").val();
				window.location.href="?p="+p_v+"<?=$page_args?>";
			}
			</script> 

			��
			<div class="pagination_gopage_wrap">
				<input id="pageNoInput" type="text" value="<?=req('p')?>" class="pagination_btn_go_input">
				ҳ
				<input type="button" value="ȷ��" class="pagination_btn_go" onclick="goPage()">
			</div>
		</div>
		<?}?>
	</div>
	
	 
	<div class="aside fr">  

		<div class="aside-box aside-hot">
			<div class="aside-title">����ϲ��</div>
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
					<div class="yellow-a"><sub>&yen;</sub> <strong><?=$val['min_price']?></strong> ��</div>
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
			<div class="aside-title"><?=$this_catalog['cat_name']?>���ι���</div>
			<ul class="order-news">
				<?
			    foreach ($goods_article as $val){  
					$news_url = get_news_url($val['thread_id']);
		        ?>
				<li>
					<a href="<?=$news_url?>" targe="_blank"><?=$val['title']?></a>

					<div class="mt10"><?=date('Y/m/d', strtotime($val['addtime']))?> <span class="gray-b">���<?=$val['clicks']?>��</span></div>
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
