<!-- 筛选 -->
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
		<form id="filter_form" method="get" action="/filter">
		<input type="hidden" name="goods_type" value="<?=$c_goods_type?>">
		<input type="hidden" name="catalog" id="catalog" value="<?=$c_cat_id?>">
		<input type="hidden" name="type" id="f_type" value="<?=req('type')?>">
		<input type="hidden" name="day" id="f_day" value="<?=req('day')?>"> 
		<input type="hidden" name="tag" id="f_tag" value="<?=req('tag')?>">
		<input type="hidden" name="money" id="f_money" value="<?=req('money')?>">
		<input type="hidden" name="hot" id="f_hot" value="<?=req('hot')?>">
		<input type="hidden" name="l_money" id="f_l_money" value="<?=req('l_money')?>">
		<input type="hidden" name="h_money" id="f_h_money" value="<?=req('h_money')?>">
		<input type="hidden" name="sc" id="f_sc" value="<?=req('sc')?>">
		 
		<div class="mg-filter"> 
			<?if(notnull($filter_catalog)){?>
			<div class="filter-row" style="">
				<div class="hd">目的地</div>
				<div class="bd nowrap">
					<div class="unlimited <?if($this_catalog_key==''){?>selected<?}?>" onclick="location.href='/<?=$g_product_type_url[$c_goods_type]?>/all/'">不限</div> 
					<?
					
				    foreach ($filter_catalog as $val){   
				    ?>
				      <a <?if($c_cat_id==$val['cat_id']){?>class="selected"<?}?> href="<?=$g_domain?><?=$g_product_type_url[$c_goods_type]?>/<?=$val['cat_key']?>/" ><?=$val['cat_name']?></a>  
				    <?   
				    }
				    ?> 
				</div> 
			</div>
			<?}?>  
		 <?if($c_goods_type!='4'){?>
			<div class="filter-row" style="">
				<div class="hd">天 数</div>
				<div class="bd nowrap">
					<div class="unlimited <?if(req('day')==''){?>selected<?}?>" onclick="filter('day', '')">不限</div> 
					<?
					foreach ($g_product_day as $k => $v) {  
				    ?>
				      <a <?if(req('day')==$k){?>class="selected"<?}?> href="javascript:filter('day', '<?=$k?>')"><?=$v?><span></span></a>
				    <?    
				    }
				    ?> 
				</div> 
			</div> 
        <?}?>
			<div class="filter-row" style="">
				<div class="hd">主 题</div>
				<div class="bd nowrap">
					<div class="unlimited <?if(req('tag')==''){?>selected<?}?>" onclick="filter('tag', '')">不限</div> 
					<?
					foreach ($g_product_tag as $k => $v) {  
				    ?>
				      <a <?if(req('tag')==$k){?>class="selected"<?}?> href="javascript:filter('tag', '<?=$k?>')"><?=$v?><span></span></a>
				    <?    
				    }
				    ?> 
				</div> 
			</div>
 
			<div class="filter-row" style="">
				<div class="hd">价格/人</div>
				<div class="bd nowrap">
					<div class="unlimited <?if(req('money')==''){?>selected<?}?>" onclick="filter('money', '')">不限</div> 
				  	  <?foreach ($g_product_money as $k => $v) {?>
					  <a <?if(req('money')==$k){?>class="selected"<?}?> href="javascript:filter('money', '<?=$k?>')">
					  <?=$v?></a>  
					  <?}?> 
				</div> 
			</div> 
			    
			<div class="filter-row selected" style="display:none">
				<div class="hd">您已选择</div>
				<div class="bd filter-item"> <a id="list-f-clear" class="clear-all" href="javascript:void(0);">清空筛选条件</a> </div>
			</div> 
		</div>
		</form>