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
		<input type="hidden" name="visa_zone" id="f_visa_zone" value="<?=req('visa_zone')?>">
		<input type="hidden" name="visa_type" id="f_visa_type" value="<?=req('visa_type')?>">

		<input type="hidden" name="hot" id="f_hot" value="<?=req('hot')?>">
		<input type="hidden" name="l_money" id="f_l_money" value="<?=req('l_money')?>">
		<input type="hidden" name="h_money" id="f_h_money" value="<?=req('h_money')?>">
		<input type="hidden" name="sc" id="f_sc" value="<?=req('sc')?>">
		
		
		<div class="mg-filter">
			 
			<?
			$filter_zone = get_visa_zone_list();
			if(notnull($filter_zone)){
			?>
			<div class="filter-row" style="">
				<div class="hd">地区</div>
				<div class="bd nowrap">
					<div class="unlimited <?if(req('visa_zone')==''){?>selected<?}?>" onclick="filter('visa_zone', '')">不限</div> 
					<?
					
				    foreach ($filter_zone as $val){   
				    ?>
				      <a <?if(req('visa_zone')==$val['zone_id']){?>class="selected"<?}?> href="javascript:filter('visa_zone', '<?=$val['zone_id']?>')" ><?=$val['zone_name']?></a>  
				    <?   
				    }
				    ?> 
				</div> 
			</div>
			<?}?>  
		 
			<div class="filter-row" style="">
				<div class="hd">类型</div>
				<div class="bd nowrap">
					<div class="unlimited <?if(req('visa_type')==''){?>selected<?}?>" onclick="filter('visa_type', '')">不限</div> 
					<?
					foreach ($g_visa_type as $k => $v) {  
				    ?>
				      <a <?if(req('visa_type')==$k){?>class="selected"<?}?> href="javascript:filter('visa_type', '<?=$k?>')"><?=$v?><span></span></a>
				    <?    
				    }
				    ?> 
				</div> 
			</div> 
  
			<div class="filter-row selected" style="display:none">
				<div class="hd">您已选择</div>
				<div class="bd filter-item"> <a id="list-f-clear" class="clear-all" href="javascript:void(0);">清空筛选条件</a> </div>
			</div> 
		</div>
		</form>