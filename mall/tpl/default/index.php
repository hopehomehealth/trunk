<!DOCTYPE HTML>
<html>
<head>
<meta charset="GBK" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
<meta http-equiv="content-type" content="text/html; charset=GBK" />
<title><?=$g_shopname?>_<?=$g_sitename?></title>
<?load_mobile($g_mobile_url.'shop'.$g_shopid.'/');?>

<link rel="canonical" href="<?=$g_full_url?>"/>  

<link rel="stylesheet" href="<?=$g_tpl_path?>images/style.css" />
<link rel="stylesheet" href="<?=$g_tpl_path?>images/list.css" />
<link rel="stylesheet" href="<?=$g_tpl_path?>images/head.css">

<script src="<?=$g_tpl_path?>images/jquery.min.js" charset="utf-8"></script>
<script src="<?=$g_tpl_path?>images/unslider.js" charset="utf-8"></script> 
 
<style type="text/css">
.banner { position: relative; overflow: auto; }
.banner li { list-style: none; }
.banner ul li { float: left; }
</style>

</head>

<body>  
<?include('head.php');?>

<div class="wrap">
 
	<div class="content mb_30" style="padding:0px;background-color:#EFEFEF;text-align:center;"> 
		<div class="banner">
			<ul>
				<?
				$ppts = get_ppt_list(8);
				if(notnull($ppts)){  
					foreach ($ppts as $val){ 
				?>
				<li><a href="<?=$val['ppt_url']?>"><img src="<?=$g_upfile_url?><?=$val['ppt_image']?>"></a></li>
				<?
					}
				} else {
				?>
				<li><img src="<?=$g_tpl_path?>images/ppt1.jpg" width="1920"></li>
				<li><img src="<?=$g_tpl_path?>images/ppt2.jpg" width="1920"></li>
				<li><img src="<?=$g_tpl_path?>images/ppt3.jpg" width="1920"></li>
				<?}?> 
			</ul>
		</div> 
	</div>

 
	<div class="box clrfix">
		<div class="list_con">
			<?
			$shop_hot_goods_list = get_shop_goods_list(2, '1'); 
			if(notnull($shop_hot_goods_list)){ 
				$i=1;
				foreach ($shop_hot_goods_list as $val){   
					$goods_image = $g_site_url."/upfiles/$g_siteid/".$val['goods_image'];
					
					$goods_url = $g_site_url.'product/detail-'.$val['goods_id'].'.html';
			?>
			<div <?if($i%2==0){?>class="list_body_r"<?}else{?>class="list_body_l"<?}?>>
				<div class="list_b_l_img" style="height:200px;overflow:hidden"><a target="_blank" href="<?=$goods_url?>"> <img src="<?=$goods_image?>" width="470"   onerror="this.src='<?=$g_site_url?>/static/image/nopic.jpg'"></a></div>
				<div class="list_b_l_re">
					<div class="list_b_l_pr_i list_b_l_pr_i_s">
						<div class="list_b_l_ic"><i class="png24"></i><?=round((($val['market_price']-$val['min_price'])/$val['min_price'])*100)?><em>%</em> </div>
						<div class="list_b_l_pr">节省<em>&yen;</em><?=$val['market_price']-$val['min_price']?></div>
					</div>
					<div class="list_t_s"> <a  target="_blank" href="<?=$goods_url?>" title="<?=$val['goods_name']?>"><?=show_substr($val['goods_name'],40)?></a> </div>
				</div>
				<div class="list_b_r_pr_btn list_btn_s clrfix">
					<div class="list_b_r_num">仅余 <em> <?=$val['stock']?></em>份 </div>
					<div class="list_b_r_btn"><a  target="_blank" href="<?=$goods_url?>">去看看<i class="png24"></i></a></div>
					<div class="list_b_r_pr">
						<p class="list_b_pr_1">&yen;
							<?=$val['min_price']?></p>
						<p class="list_b_pr_2">&yen; <em> <?=$val['market_price']?></em> </p>
					</div>
				</div>
			</div>
			<?
				$i++;
				}
			}
			?>
			  
		</div>
	</div>

	<div class="main_l210_r750">
		<?include('nav.php');?>

		<div class="main_r750" id="content"> 
	
			<div class="tj_con">
				<h3>最新产品</h3>
				<div class="e_result_ctn e_result_hot_ctn clr_after">
					<? 
					$shop_new_goods_list = get_shop_goods_list(15, '0');

					if(notnull($shop_new_goods_list)){ 
						$i=1;
						foreach ($shop_new_goods_list as $val){   
							$goods_image = $g_site_url."/upfiles/$g_siteid/".$val['goods_image'];

							$goods_url = $g_site_url.'product/detail-'.$val['goods_id'].'.html';
					?>
					<dl class="e_result_item">
						<dt> <a target='_blank' href="<?=$goods_url?>"><img width="236" height="157" src="<?=$goods_image?>" /></a> </dt>
						<dd class="title"> <a target='_blank' href="<?=$goods_url?>"><?=$val['goods_name']?></a> </dd>
						<dd class="mpr">门&nbsp;市&nbsp;价：<a target='_blank' href="<?=$goods_url?>"> <em>&yen;<?=$val['market_price']?></em></a></dd>
						<dd class="pr"> 促&nbsp;销&nbsp;价：<a target='_blank' href="<?=$goods_url?>">&yen;<b> <?=$val['real_price']?></b>起 </a> </dd>
						<dd class="date">已&nbsp;销&nbsp;售：<?=$val['sale_number']?></dd>
					</dl>
					<?
						}
					}
					?> 
				</div>
			</div>
		  
		</div>
		<div class="clr"></div>
	</div>

	<?include('foot.php');?>
</div>

<script type="text/javascript">
if(window.chrome) {
	$('.banner li').css('background-size', '100% 100%');
}

$('.banner').unslider({
	//arrows: true,
	fluid: true,
	dots: true
});
</script>
</body>
</html>
