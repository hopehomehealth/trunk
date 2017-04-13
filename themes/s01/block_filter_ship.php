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
		<input type="hidden" name="ship_line" id="f_ship_line" value="<?=req('ship_line')?>">
		<input type="hidden" name="ship_port" id="f_ship_port" value="<?=req('ship_port')?>">

		<input type="hidden" name="hot" id="f_hot" value="<?=req('hot')?>">
		<input type="hidden" name="l_money" id="f_l_money" value="<?=req('l_money')?>">
		<input type="hidden" name="h_money" id="f_h_money" value="<?=req('h_money')?>">
		<input type="hidden" name="sc" id="f_sc" value="<?=req('sc')?>">
		
		
		<div class="mg-filter">
			   
			<div class="filter-row" style="">
				<div class="hd">邮轮航线</div>
				<div class="bd nowrap">
					<div class="unlimited <?if(req('ship_line')==''){?>selected<?}?>" onclick="filter('ship_line', '')">不限</div> 
					<?
					foreach ($g_ship_line as $k => $v) {  
				    ?>
				      <a <?if(req('ship_line')==$k){?>class="selected"<?}?> href="javascript:filter('ship_line', '<?=$k?>')"><?=$v?><span></span></a>
				    <?    
				    }
				    ?> 
				</div> 
			</div> 
		 
			<div class="filter-row" style="">
				<div class="hd">登船港口</div>
				<div class="bd nowrap">
					<div class="unlimited <?if(req('ship_port')==''){?>selected<?}?>" onclick="filter('ship_port', '')">不限</div> 
					<?
					foreach ($g_ship_port as $k => $v) {  
				    ?>
				      <a <?if(req('ship_port')==$k){?>class="selected"<?}?> href="javascript:filter('ship_port', '<?=$k?>')"><?=$v?><span></span></a>
				    <?    
				    }
				    ?> 
				</div> 
			</div> 

			<div class="filter-row" style="">
				<div class="hd">行程天数</div>
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
  
			<div class="filter-row selected" style="display:none">
				<div class="hd">您已选择</div>
				<div class="bd filter-item"> <a id="list-f-clear" class="clear-all" href="javascript:void(0);">清空筛选条件</a> </div>
			</div> 
		</div>
		</form>