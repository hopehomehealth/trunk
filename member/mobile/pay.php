<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?>
 
<section class="m-frm-top">
    <div class="num"><span>在线预订</span>选择付款方式</div>
    <i class="line"></i> 
    <a href="javascript:history.back()" class="m-frm-top-btn" style="width:60px"> 返 回 </a>
</section>
<section class="container">  
	<form method="post" action="do?ac=order">
		<section class="m-frm-list"> 
			<ul> 
				<li style="padding-bottom:20px;">
				<?
				$default_note = $pay_config['default']['note'];
				?> 
				   <div class="company" style="height:auto"> 
				   <label class="checkbox">
					  <input type="radio" name="pay_type" checked="checked" value="default"/>
					  <?if($default_note!=''){?>
						  <?=$default_note?>
					  <?}else{?>
						  货到付款/POS机/上门收款/银行汇款等线下方式
					  <?}?>
				   </label> 
				   </div> 
				<?
				$pay_state = $pay_config['wxpay']['state'];
				if($pay_state == 'Y'){
				?>
		 
				  <div class="company" style="height:auto"> 
					<label class="checkbox">
					<input type="radio" name="pay_type" value="wxpay"/> 微信支付 &nbsp; &nbsp; <img src="images/wxpay.jpg" height="20" align="absmiddle"/> 
					我们是腾讯微信支付特约商家，请放心支付！
					</label>
				  </div> 
				<?}?>
	 
				<?
				$pay_state = $pay_config['alipaywap']['state'];
				if($pay_state == 'Y'){
				?> 
				  <div class="company" style="height:auto"> 
					<label class="checkbox">
					   <input type="radio" name="pay_type" value="alipaywap"/> 支付宝手机端 &nbsp; &nbsp; <img src="images/alipay.jpg" height="20" align="absmiddle"/> 
					   我们是阿里巴巴<b>支付宝</b>特约商家，请放心支付！
					</label>
				  </div> 
				<?}?>  
				</li>
				<input type="hidden" name="traffic_id" value="<?=req('traffic_id')?>"> 
				<div class="fixed-btm">
					<div class="btn-group"> <input class="btn-add" type="submit" id="next_btn" style="width:100%;border:0px;text-align:center" value="下一步"/></div>
				</div>  
			</ul>
		</form>
	</section>
</section>
  