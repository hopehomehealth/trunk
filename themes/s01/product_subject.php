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

<div style="background-image:url(/upfiles/<?=$g_siteid?>/<?=$c_goods_mode['mode_image']?>);background-position: center;height:470px;"></div>

<div class="container">   
	<div class="event_floor" id="floor_gg">
    <div class="event_floor_item">
         
        <ul class="temp-item block grid_item_box">
                <?
                if(notnull($query_rows)){
					foreach ($query_rows as $val){
						$goods_image = "/upfiles/$g_siteid/".$val['goods_image']; 
						$goods_url = get_goods_url($val['cat_key'], $val['goods_id']);
                ?>
                <li class="cell_item"> 
                    <div class="cell_top_part">
                        <div class="picture_box">
                            <a class="product_link" href="<?=$goods_url?>" target="_blank"><img class="cut_pic" data-src="<?=$goods_image?>" alt="<?=$val['goods_name']?>" src="<?=$goods_image?>" style="display: inline;"></a> 
                        </div>
                        <div class="cell_top_part_discount">
                            <span><?=round($val['min_price']/$val['market_price'],2)*100?>折</span>
                        </div>
                        <div class="salepoints">
                            <div class="salepoint"><?=$g_start_city?>出发</div> 
                        </div>
                    </div>
                    <div class="cell_bottom_part">
                        <a class="title_text product_link" href="<?=$goods_url?>" target="_blank" title="<?=$val['goods_name']?>">
                            <div class="point_tag_1"><?=$g_product_type[$val['goods_type']]?></div>
                            <?=$val['goods_name']?>
                        </a>
                        <div class="salepoints"><?=show_substr(removehtml($val['summary']),120)?></div>
                       
                        <div class="btn_panel">
                            <div class="price_box">
                                <div class="new_price">
                                    <div class="rmb_tag">￥</div>
                                    <div class="price_value"><?=$val['min_price']?></div>
                                    <div class="price_tailtext">起</div>
                                </div>
                                <div class="old_price">
                                    <span style="display:none;">￥<?=$val['min_price']?></span>
                                </div>
                            </div>
                            <a class="order_btn product_link" href="<?=$goods_url?>" target="_blank">立即抢购</a>
                        </div>
                    </div>
                </li>
				<?
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
