<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?>
 
<section class="m-frm-top">
    <div class="num"><span>����Ԥ��</span>ѡ�񸶿ʽ</div>
    <i class="line"></i> 
    <a href="javascript:history.back()" class="m-frm-top-btn" style="width:60px"> �� �� </a>
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
						  ��������/POS��/�����տ�/���л������·�ʽ
					  <?}?>
				   </label> 
				   </div> 
				<?
				$pay_state = $pay_config['wxpay']['state'];
				if($pay_state == 'Y'){
				?>
		 
				  <div class="company" style="height:auto"> 
					<label class="checkbox">
					<input type="radio" name="pay_type" value="wxpay"/> ΢��֧�� &nbsp; &nbsp; <img src="images/wxpay.jpg" height="20" align="absmiddle"/> 
					��������Ѷ΢��֧����Լ�̼ң������֧����
					</label>
				  </div> 
				<?}?>
	 
				<?
				$pay_state = $pay_config['alipaywap']['state'];
				if($pay_state == 'Y'){
				?> 
				  <div class="company" style="height:auto"> 
					<label class="checkbox">
					   <input type="radio" name="pay_type" value="alipaywap"/> ֧�����ֻ��� &nbsp; &nbsp; <img src="images/alipay.jpg" height="20" align="absmiddle"/> 
					   �����ǰ���Ͱ�<b>֧����</b>��Լ�̼ң������֧����
					</label>
				  </div> 
				<?}?>  
				</li>
				<input type="hidden" name="traffic_id" value="<?=req('traffic_id')?>"> 
				<div class="fixed-btm">
					<div class="btn-group"> <input class="btn-add" type="submit" id="next_btn" style="width:100%;border:0px;text-align:center" value="��һ��"/></div>
				</div>  
			</ul>
		</form>
	</section>
</section>
  