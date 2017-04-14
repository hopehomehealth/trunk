	<? 
	$floor_top = floor_list(0, $c_goods_type); //一级楼层列表
	if(notnull($floor_top)){
		$top = 1;
		foreach ($floor_top as $topval){ 
			$floor_child  = floor_list($topval['floor_id'], $c_goods_type); //二级楼层列表 
			$floor_ad_one = floor_ad_one($topval['floor_id']); 
			$floor_goods  = floor_goods_list($topval['floor_id'], 6); //楼层下的产品列表，限制6条 
	?>
	<div class="f3 layer layer_color_lianglan an_mo">
		<div id="block" class="block clearfix"> 
			<div class="layer_header">
				<h2><i></i><?=$topval['floor_title']?></h2>
				<!--<div class="more"> <a href="javascript:void(0)">更多 &gt;</a> </div>-->
			</div> 
		</div>
	</div>

	<div style="clear:both"></div>

	<div class="f3 layer layer_color_lianglan an_mo" >
		<div id="block" class="block clearfix">
			<div id="group_1971" class="horizontal remenchengshijiudian clearfix">
				<h2><?=$topval['floor_title']?></h2>
				<ul class="clearfix mytab" style="float:right">
					<?
					if(notnull($floor_child)){
						$t = 1;
						foreach ($floor_child as $cval){
					?>
					<li <?if($t==1 && 1==2){?>class="on"<?}?>><a href="<?=$cval['floor_url']?>" rel="nofollow"><?=$cval['floor_title']?></a></li> 
					<?
						$t++;
						}
					}
					?> 
				</ul>
				<div id="tabs" class="line-con">
					<div class="layer_body_list linebox an_mo now" >
						<div id="block" class="block clearfix layer_body">
							<div class="body_left"> <a target="_blank" href="<?=$floor_ad_one['ad_url']?>" > <img  src="/upfiles/<?=$g_siteid?>/<?=$floor_ad_one['ad_image']?>" style="display: block;"></a> </div>
							<div class="body_right">
								<dl class="tab_list clearfix">
									<?
									if(notnull($floor_goods)){
										foreach ($floor_goods as $val){
											$goods_image = "/upfiles/$g_siteid/".$val['goods_image']; 
											$goods_url = get_goods_url($val['cat_key'], $val['goods_id']);
									?>
									<dd class="product_item"> 
										<!--  豪华型- -->
										<div class="product_img"> <i class="flag_discount">返现</i> <a target="_blank" href="<?=$goods_url?>"  > <img src="<?=$goods_image?>"  alt="<?=$val['goods_name']?>" style="display: block;"> </a> </div>
										<div class="product_des">
											<div class="product_title"> <a class="product_name" target="_blank" href="<?=$goods_url?>"  ><?=$val['goods_name']?></a> <span class="product_fen"><i>100</i>分/<i></i>条评论</span> </div>
											<div class="product_info clearfix"> <span class="price">&yen;<em><?=$val['min_price']?></em><i>起订</i></span> <span class="district">启东市/豪华型</span> </div>
										</div>
									</dd>
									<?
										}
									}
									?> 
								</dl>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> 
	<?
		}
	}
	?>