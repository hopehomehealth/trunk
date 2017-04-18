<? 
// level 1 //
$hotspot1 = get_hotspot('0');
if(notnull($hotspot1)){
	$hs = 1;
	foreach ($hotspot1 as $val1){   
		$hotspot2 = get_hotspot($val1['hotspot_id']);

		$child_number = sizeof($hotspot2);
		$hs_ico = $val1['ico'];
		$hs_ad1 = $val1['ad1'];
		$hs_ad2 = $val1['ad2'];
		$hs_ad1_link = $val1['ad1_link'];
		$hs_ad2_link = $val1['ad2_link'];
?>
<li <?if($hs==9){?>class="last"<?}?>>
	<div class="list-link">
		<i class="icon-menu im-def"><img src="<?if($hs_ico!=''){?>/upfiles/<?=$g_siteid?>/<?=$hs_ico?><?}else{?>/themes/s01/images/hs<?=$hs?>.png<?}?>" style="height:26px;width:26px;"></i><a href="<?=$val1['url']?>" style="color:#000"><?=$val1['title']?></a>
		<div class="vice-link">		
			<?
			$hotspot_recommend = get_hotspot_recommend($val1['hotspot_id']);
			if(notnull($hotspot_recommend)){
				foreach ($hotspot_recommend as $hot){  
			?>
			<a id="index-nav-def" href="<?=$hot['url']?>" target="_blank"><?=$hot['title']?></a> 
			<?
				}
			}
			?>
		</div>
	</div>

	<?if($child_number<=5){?>
	<div class="sublist"> 
		<dl class="sub-classify">
			<? 
			if(notnull($hotspot2)){
				foreach ($hotspot2 as $val2){ 
					$hotspot3 = get_hotspot($val2['hotspot_id']);
			?>
			<dt>
				<strong><a href="<?=$val2['url']?>"><?=$val2['title']?></a></strong> 
			</dt>
			<dd>
				<? 
				if(notnull($hotspot3)){
					foreach ($hotspot3 as $val3){
				?>
				<a id="index-nav-more" href="<?=$val3['url']?>" target="_blank" title="<?=$val3['title']?>" class=""><?=$val3['title']?></a>
				<?
					}
				}
				?> 
			</dd>
			<?
				}
			}
			?> 
		</dl>
		<div class="dl-ad">
			<a href="javascript:void();"><img src="<?if($hs_ad1!=''){?>/upfiles/<?=$g_siteid?>/<?=$hs_ad1?><?}else{?>/themes/s01/images/hotspot_ad1.jpg<?}?>" style="width:256px;height:133px;"/></a> 
		</div>
		<div class="subad">
			<a href="<?=$hs_ad2_link?>"><img src="<?if($hs_ad2!=''){?>/upfiles/<?=$g_siteid?>/<?=$hs_ad2?><?}else{?>/themes/s01/images/hotspot_ad2.png<?}?>" style="width:328px;height:462px;"/></a> 
		</div>
	</div>
	<?}else{?>
	<div class="sublist">
		<dl class="sub-classify-half">
			<? 
			if(notnull($hotspot2)){
				$c = 1;
				foreach ($hotspot2 as $val2){ 
					$hotspot3 = get_hotspot($val2['hotspot_id']);
			?>
			<?if($c==11){?>
			</dl>
			<dl class="sub-classify-half">
			<?}?>
			<dt>
				<strong><a href="<?=$val2['url']?>" style="color:#000"><?=$val2['title']?></a></strong> 
			</dt>
			<dd>
				<? 
				if(notnull($hotspot3)){
					foreach ($hotspot3 as $val3){
				?>
				<a id="index-nav-more" href="<?=$val3['url']?>" target="_blank" title="<?=$val3['title']?>" class=""><?=$val3['title']?></a>
				<?
					}
				}
				?> 
			</dd>
			<?
					$c++;
				}
			}
			?>  
		</dl>
		<div class="dl-ad fullrow">
			<img src="<?if($hs_ad1!=''){?>/upfiles/<?=$g_siteid?>/<?=$hs_ad1?><?}else{?>/images/hotspot_ad1.jpg<?}?>" style="width:256px;height:133px;"/>
		</div>
	</div>
	<?}?>
</li>
<? 
	    $hs++;
	}
}
?>  