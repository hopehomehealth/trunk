<!DOCTYPE html>
<html>
<head>
<?include('meta.php');?>
<?seo();?>
<?load_mobile('http://'.$g_config['mobile_domain'].'/'.$this_catalog_key.'/');?>

<?include('static.php');?> 

<link rel="stylesheet" type="text/css" href="/images/list.css">
<link rel="stylesheet" type="text/css" href="/images/group.css">
</head>

<body class="bodybox">
<?include('head.php');?>
<div class="container" style="margin-top:30px">  
	<div class="recommend_floor">
		<ul class="recommemd_item_box">  
			<div class="temp-item block" type="interface" contenttype="3" shownum="3" data-item-id="2" data-item-title="产品列表">
					<?
					if(notnull($query_rows)){
						foreach ($query_rows as $val){
							$goods_image = "/upfiles/$g_siteid/".$val['goods_image']; 
							$goods_url = get_goods_url($val['cat_key'], $val['goods_id']);
					?>
					<li class="cell_item" >
						
						<div class="cell_top_part">
							<div class="picture_box">
								<a class="product_link" href="<?=$goods_url?>" target="_blank"><img class="cut_pic" data-src="<?=$goods_image?>" alt="<?=$val['goods_name']?>" data-width="800" data-height="400" src="<?=$goods_image?>" style="display: inline;"></a> 
							</div>
							<div class="salepoints">
								<div class="salepoint"><?=$g_start_city?>出发</div> 
							</div>
							<a class="title_text product_link" href="<?=$goods_url?>" target="_blank">
								<div class="point_tag_1"><?=$g_product_type[$val['goods_type']]?></div>
								<?=$val['goods_name']?>
							</a>
							<div class="mask_shadow"></div>
							<div class="price_panel">
								<div class="new_price_box">
									<div class="rmb_tag">￥</div>
									<div class="price_value"><?=$val['min_price']?></div>
									<div class="price_tailtext">起</div>
								</div>
								<div class="old_price_box">
									<div class="price_value" style="display:none;">￥<?=$val['market_price']?></div>
									<?if($val['market_price']>0){?>
									<div class="discount_box">
										<span class="discount_val"><?=round($val['min_price']/$val['market_price'],2)*100?>折</span>
									</div>
									<?}?>
								</div>
							</div>
							<div class="mask_shadow"></div>
						</div>
						<div class="cell_bottom_part">
							<div class="salepoints">
								<?=show_substr(removehtml($val['summary']),60)?>&nbsp;&nbsp;
							</div>
							<div class="clock">
								<div class="clock_icon"></div>
								<div class="clock_text counterText">距结束:</div>
								<div class="clock_time counter" id="times<?=$val['goods_id']?>"></div>
							</div>
							<a class="btn_panel product_link" href="<?=$goods_url?>" target="_blank">
								<div class="order_btn" id="buy_btn<?=$val['sku_id']?>">立即抢购</div>
							</a>
						</div>

						<script type="text/javascript">
						function fresh<?=$val['goods_id']?>()
						{
							var endtime = new Date("<?=date('Y/m/d,H:i:s', strtotime($val['sale_end']))?>");
							var nowtime = new Date();
							var leftsecond=parseInt((endtime.getTime()-nowtime.getTime())/1000);
							d=parseInt(leftsecond/3600/24);
							h=parseInt((leftsecond/3600)%24);
							m=parseInt((leftsecond/60)%60);
							s=parseInt(leftsecond%60);
							   
							document.getElementById("times<?=$val['goods_id']?>").innerHTML=d+"天"+h+"小时"+m+"分钟"+s+"秒";
							if(leftsecond<=0){
								document.getElementById("times<?=$val['goods_id']?>").innerHTML="抢购已结束";
								//document.getElementById("buy_btn<?=$val['goods_id']?>").disabled = true;
								clearInterval(sh<?=$val['goods_id']?>);
							}
						}
						fresh<?=$val['goods_id']?>()
						var sh<?=$val['goods_id']?>;
						sh<?=$val['goods_id']?> = setInterval(fresh<?=$val['goods_id']?>,1000);
						</script>
					</li>
					<?
						}
					}
					?> 
					<div style="clear:both"><br/></div>
			</div>
		</ul>
	</div>
     
	<div class="clear"></div>
</div>
<div class="clear"></div>
<?include('foot.php');?>
</body>
</html>
