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
	  <li class="item current"><span>&gt;</span>�����̳�</li> 
	</ul>
	  
	<!-- ���� -->
	<div class="main fr">  
		<div class="mg-filter" style="margin-bottom:0px"> 
			<?
			if(notnull($cat_list)){
			?>
			<div class="filter-row" style="">
				<div class="hd">����</div>
				<div class="bd nowrap">
					<div class="unlimited <?if($this_catalog_key==''){?>selected<?}?>" onclick="location.href='/jifen/'">����</div> 
					<?
					
				    foreach ($cat_list as $val){   
				    ?>
				      <a <?if($c_cat_id==$val['cat_id']){?>class="selected"<?}?> href="<?=$g_domain?>jifen/list-<?=$val['cat_id']?>-1.html" ><?=$val['cat_name']?></a>  
				    <?   
				    }
				    ?> 
				</div> 
			</div>
			<?}?>   
		</div> 

		<?
	    if(notnull($query_rows)){
			$r=1;
			foreach ($query_rows as $val){  
				$goods_image = "/upfiles/$g_siteid/".$val['goods_image'];

				$comment_sql = "select count(*) from t_goods_comment where is_first=1 and goods_id=".$val['goods_id'];
				$comment_count = $db->get_value($comment_sql);
 
	  
				$adult_price = unserialize(stripslashes($val['adult_price']));
			 
				$k = 0;
				$this_start_date = '';
				$this_end_date = '';
				if(notnull($adult_price)){
					foreach ($adult_price as $key => $value) {
						if($k==0) $this_start_date = date('Y-m-d',strtotime($key)); 
						if($k+1==sizeof($adult_price)) $this_end_date = date('Y-m-d',strtotime($key));
						$k++;
					} 
				}

				$goods_url = '/jifen/detail-'.$val['goods_id'].'.html';
		?>
		<div class="jf-list" <?if($r % 3!=0){?>style="margin-right:13px"<?}?>> 
			<!-- ��Ʒ��Ϣ -->
			<div class="jf-box"> 
				<a href="<?=$goods_url?>">
					<div class="jf-imgbox">
						<img alt="<?=$val['goods_name']?>" src="<?=$goods_image?>" >
					</div>
				</a> 

				<div class="text-align:center;padding:10px">
					<div style="margin:10px 0px 10px 0px;font-size:18px;height:20px;overflow:hidden;" title="<?=$val['goods_name']?>" ><?=$val['goods_name']?></div>
					<div class="price yellow-a">
					<sub>�г��� &yen;</sub> <span class="num" style="font-size:18px"><?=$val['market_price']?></span> 
					<a href="<?=$goods_url?>" target="_blank" class="btn btn-sm" style="float:right"><?=$val['score_number']?>����</a>
					<div style="clear:both"></div>
					</div> 
				</div> 
			</div>
		</div>
		<?
			$r++;
			} 
		} else {
		?>
		<div class="box-warning bw-bold mb15" style="margin-top:20px">
			<i class="icon waring-sm"></i>�ܱ�Ǹ��û���ҵ�<?if($keywords!=''){?>�� <b class="yellow-a">��<?=$keywords?>��</b> <?}?>��صĲ�Ʒ��Ҫ������������Ʒ�����߻����ؼ���������
		</div>
		<?}?>
		<div style="clear:both"></div>
		

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
	
	 
	<div class="aside fl"> 
		
		<!-- ���� -->
		<div class="mb15">
			<div class="aside-box aside-hot"> 
			<?
			if($_COOKIE['CLOOTA_B2B2C_USER_UUID'] == ''){ 
			?>
				<a href="<?=$goods_url?>" target="_blank" class="btn btn-sm">��¼</a>

				<a href="<?=$goods_url?>" target="_blank" class="btn btn-sm">����ע��</a>
				<br/><br/>
				<div style="border-top:1px dashed #ccc"><br/></div> 

				��¼�󣬿ɲ鿴���Ļ������û��ֶһ���Ʒ 
			<?}else{?> 
				�鿴<a href="/member/<?=url('score.php')?>">�ҵĻ���</a>��<strong style="color:#ff9900"><?=$c_total_score_number?></strong>
				<br/>
				�û��ֶһ���Ʒ���鿴�ҵ�<a href="/member/<?=url('score_order.php')?>">���ֶ���</a>
			<?}?>
			</div>
		</div>

		<div class="aside-box aside-hot">
			<div class="aside-title">���Ŷһ�����<hr size="1" color="#efefef"></div>
			<ul>
				<? 
				$top10_list = get_top10_goods();
				if(notnull($top10_list)){
					$n = 1;
					foreach ($top10_list as $val){  
						$goods_image = $g_domain."upfiles/$g_siteid/".$val['goods_image'];
				?> 
				<li> <i class="lv-icon ico-snum"><?=$n?></i> <a href="<?=$g_domain?>jifen/detail-<?=$val['goods_id']?>.html" target="_blank" title="<?=$val['goods_name']?>"> 
					<?=$val['goods_name']?> </a>
					<div class="yellow-a">�г��ۣ�<s>&yen;<?=$val['market_price']?></s> <span style="float:right"><strong><?=$val['score_number']?></strong> ����</span></div>
				</li>
				<?
					$n++;
					}
				}
				?> 
			</ul>
		</div>
		 
		<!-- ����ָ�� -->
		<?if($c_cat_id>0){?>
		<div class="aside-box aside-guide">
			<div class="imgbox"><a href="javascript:void(0)" target="_blank"><img src="/images/dist.jpg" alt="<?=$this_catalog['cat_name']?>����ָ��" ><span class="g-tit"><?=$this_catalog['cat_name']?>����ָ��</span></a></div>
			<div class="text"><?=$this_catalog['cat_note']?></div> 
		</div>
		<?}?>
		  
	</div>
	<div class="clear"></div>
</div>
<div class="clear"></div>
<?include('foot.php');?>
</body>
</html>
