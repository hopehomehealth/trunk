<!DOCTYPE html>
<html>
<head>
<?include('meta.php');?>
<?seo()?>
<?include('static.php');?>
<link rel="stylesheet" type="text/css" href="/themes/s01/images/list.css">

</head>
<body class="bodybox">
<?include('head.php');?> 
<div class="container"> 
	<!--����Ŀ�ĵ�-->
	<ul class="breadcrumbs"> 

		<li class="item"><a href="<?=$g_domain?>">��ҳ</a><span>&gt;</span></li>
		<li class="item"> <a href="<?=$g_domain?>news/"> ��Ѷ����</a><?if($curr_cat['cat_key']!=''){?><span>&gt;</span><?}?></li>
		<li class="item current"><?if($curr_cat['cat_key']!=''){?><a href="/news/<?=$curr_cat['cat_key']?>/"><?=$curr_cat['cat_name']?></a><?}?></li> 
		<li style="float:right">
		<?
		$all_news_cat = get_all_catalog();
		if(notnull($all_news_cat)){ 
			foreach ($all_news_cat as $val){
				if($val['cat_key']!='help'){
		?> 
			<a href="/news/<?=$val['cat_key']?>/" ><?=$val['cat_name']?></a>
		<?
				}
			}
		}
		?>
		</li> 
	</ul>
	<!--
    <div class="box-warning bw-bold mb15">
        <i class="icon waring-sm"></i>�ܱ�Ǹ��û���ҵ� <b class="yellow-a"></b> �� <b class="yellow-a">
                    </b> ��Ʒ��Ҫ������
        <b class="yellow-a"></b> ��������Ʒ���߻���������
    </div>
	-->   
	
	<!-- ���������� -->
	<div class="main fl">  
		<?
	    if(notnull($query_rows)){
			foreach ($query_rows as $val){   
				$news_image = "/upfiles/$g_siteid/".$val['image'];
				$news_url = get_news_url($val['thread_id']);
				$summary = $val['summary'];
				if($summary==''){
					$summary = show_substr(removehtml($val['content']),270);
				}
		?>
		<div class="lv-list"> 
			<!-- ��Ʒ��Ϣ -->
			<div class="info">
				<?if($val['image']!=''){?>
				<a class="imgbox" title="<?=$val['title']?>" href="<?=$news_url?>"> <img alt="<?=$val['title']?>" src="<?=$news_image?>" ></a>
				<dl class="text">
					<dt><a href="<?=$news_url?>" target="_blank" style="font-size:18px;<?if($val['is_hot']==1){?>color:red<?}?>"><?=$val['title']?></a> <?if($val['is_top']=='1'){?><span style="color:red">[�ö�]</span><?}?></dt>  
					<dd><?=$summary?></dd>
					<dd><br/></dd>
					<dd>�������ڣ�<b><?=date('Y-m-d', strtotime($val['addtime']))?></b> &nbsp; �Ķ� <strong><?=$val['clicks']?></strong> ��</dd>
				</dl>
				<div class="lv-lineright">
					<div class="price yellow-a"></div>
					<a href="<?=$news_url?>" target="_blank" class="btn  btn-sm">�鿴����</a>
					<div class="count"> </a></div>
				</div> 
				<?}?>
				<?if($val['image']==''){?> 
				<dl class="text" style="margin-left:-150px">
					<dt><a href="<?=$news_url?>" target="_blank" style="font-size:18px;<?if($val['is_hot']==1){?>color:red<?}?>"><?=$val['title']?></a> <?if($val['is_top']=='1'){?><span style="color:red">[�ö�]</span><?}?></dt>  
					<dd><?=$summary?></dd>
					<dd><br/></dd>
					<dd>�������ڣ�<b><?=date('Y-m-d', strtotime($val['addtime']))?></b> &nbsp; �Ķ� <strong><?=$val['clicks']?></strong> ��</dd>
				</dl>
				<div class="lv-lineright">
					<div class="price yellow-a"></div>
					<a href="<?=$news_url?>" target="_blank" class="btn  btn-sm">�鿴����</a>
					<div class="count"> </a></div>
				</div> 
				<?}?>
			</div>
		</div>
		<?
			}
		} else {
		?>
		<div class="box-warning bw-bold mb15" style="margin-top:20px">
			<i class="icon waring-sm"></i>�ܱ�Ǹ��û���ҵ�<?if($keywords!=''){?>�� <b class="yellow-a">��<?=$keywords?>��</b> <?}?>��ص���Ѷ��
		</div>
		<?}?>
		    
		<!--��ҳ-->
		<div class="pagination mt30">  
		<?
		if(notnull($query_rows)){
		?>
			��<strong><?=$total_page?></strong>ҳ 
			<?
			if($total_page<6){
				for($m=1; $m<=$total_page; $m++){
					if($now_page==$m){
						echo "<a href='?p=$m' class='curr'>$m</a> "; 
					} else {
						echo "<a href='?p=$m'>$m</a> "; 
					}
				}
			} else {
				if($now_page<6){
					for($m=1; $m<6; $m++){
						if($now_page==$m){
							echo "<a href='?p=$m' class='curr'>$m</a> "; 
						} else {
							echo "<a href='?p=$m'>$m</a> "; 
						}
					}
					echo "<a href='?p=6'>6</a> "; 
					echo " <a href='javascript:void(0)'>...</a> <a href='?p=$total_page'>$total_page</a> ";
				}
				
				if($now_page>=6){
					echo "<a href='?p=1'>1</a> <a href='javascript:void(0)'>...</a> ";
					$max_page = $now_page+2;
					if($max_page>$total_page){
						$max_page = $now_page;
					}
					for($m=$now_page-2; $m<=$max_page; $m++){ 
						if($now_page==$m && $now_page<=$total_page){
							echo "<a href='?p=$m' class='curr'>$m</a> "; 
						} else {
							echo "<a href='?p=$m'>$m</a> "; 
						} 
					}
					if($max_page<$total_page){
						echo " <a href='javascript:void(0)'>...</a> <a href='?p=$total_page'>$total_page</a> ";
					}
				} 
			}
			?>  
			<a href="?p=<?=$next_number?>" class="nextpage">��һҳ</a> 

			<script type="text/javascript">
			function goPage(){
				var p_v = $("#pageNoInput").val();
				window.location.href="?p="+p_v;
			}
			</script> 

			��
			<div class="pagination_gopage_wrap">
				<input id="pageNoInput" type="number" value="<?=req('p')?>" class="pagination_btn_go_input">
				ҳ
				<input type="button" value="ȷ��" class="pagination_btn_go" onclick="goPage()">
			</div> 
			<?}?>
		</div> 
	</div>
	
	 
	<div class="aside fr"> 
		<?
		// ͬ����Ѷ
		$hot_article = get_hot_article(5);
		if(notnull($hot_article)){ 
		?>
		<div class="aside-box aside-hot">
			<div class="aside-title">��Ѷ�Ƽ�</div>
			<ul class="order-news">
				<?
			    foreach ($hot_article as $val){  
					$news_image = "/upfiles/$g_siteid/".$val['image'];  
					$news_url = get_news_url($val['thread_id']);
		        ?>
				<li style="clear:both;padding-bottom:10px">
					<img src="<?=$news_image?>" style="width:80px;margin:0px 10px 10px 0px" align="left"> 
					<a href="<?=$new_url?>"><?=$val['title']?></a>

					<div class="mt10"><?=date('Y/m/d', strtotime($val['addtime']))?> <span class="gray-b">���<?=$val['clicks']?>��</span></div> 
				</li>
				<?}?> 
			</ul>
		</div>
		<?}?> 

		<div class="aside-box aside-hot" style="margin-top:10px">
			<div class="aside-title">�����Ƽ�</div>
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
	</div>
	<div class="clear"></div>
</div>
<div class="clear"></div>
<?include('foot.php');?>
</body>
</html>
