<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}  
?>
  
<form method="post" action="do?ac=order" >
  <table width="100%" border="0" cellpadding="3" cellspacing="3" > 
    <tr>
      <td style="padding-left:30px"><h4>&raquo; ���ʽ</h4></td>
    </tr> 
	<?
	$default_note = $pay_config['default']['note'];
	?>
	<tr>
      <td style="padding-left:10px;">
	  <label class="checkbox">
		  <input type="radio" name="pay_type" checked="checked" value="default"/>
		  <?if($default_note!=''){?>
			  <?=$default_note?>
		  <?}else{?>
			  ����֧��
		  <?}?>
	  </label>
	  </td>
    </tr>
	<?
	$pay_state = $pay_config['tenpay']['state'];
	if($pay_state == 'Y'){
	?>
	<tr>
      <td style="padding-left:10px;">
		<label class="checkbox">
		<input type="radio" name="pay_type" value="tenpay"/> �Ƹ�ͨ 
		</label>
	  </td>
    </tr> 
	<?}?>

	<?
	$pay_state = $pay_config['alipay']['state'];
	if($pay_state == 'Y'){
	?>
    <tr>
      <td style="padding-left:10px;">
		<label class="checkbox">
	       <input type="radio" name="pay_type" value="alipay"/> ֧���� 
		</label>
	  </td>
    </tr> 
	<?}?>

	<tr>
      <td>&nbsp;</td>
    </tr>
  </table> 
  <div style="margin-top:20px; margin-left:30px;">
    <input type="hidden" name="traffic_id" value="<?=req('traffic_id')?>">
    <input type="submit" value="��һ��" class="btn btn-large btn-warning"/> 
  </div>
</form>
  