<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<?include('setting.nav.php');?>

	   <form target="frm" method="post" action="do.php?cmd=site_pay"> 
		  <!-- Default --> 
		  <table width="100%">
			<tr>
			  <td width="15%" align="right"> </td>
			  <td><h2>线下支付/货到付款/其他线下支付方式</h2>
			  <input type="hidden" name="default[payname]" value="线下支付" />
			  </td>
			</tr>   
			<tr>
			  <td></td><td style="color:red">备注：货到付款/POS机/上门收款/银行汇款等线下方式</td>
			</tr>
			<tr>
			  <td></td><td><input type="checkbox" name="default[state]" value="Y" checked > 启用</td>
			</tr>
			<tr>
			  <td></td><td><input type="text" name="default[note]" value="货到付款/POS机/上门收款/银行汇款等线下方式" >  </td>
			</tr>
			<tr>
			  <td></td>
			  <td> 
			  <input type="hidden" name="default[pay_type]" value="offline">
			  <input type="hidden" name="default[pay_name]" value="默认"> 
			  </td>
			</tr>
	 
		  <!-- Default/END -->

		  <!-- Alipay -->  
			<tr>
			  <td align="right"> </td>
			  <td><h2>支付宝</h2>
			  <input type="hidden" name="alipay[payname]" value="支付宝" />
			  </td>
			</tr>
			<tr>
			  <td align="right">支付宝账号</td>
			  <td><input type="text" name="alipay[account]" value="<?=$pay_config['alipay']['account']?>" style="width:200px;" autocomplete="off"/>
				商户申请：<a href="https://b.alipay.com/" target="_blank">签约支付宝</a></td>
			</tr>
			<tr>
			  <td align="right">商户ID号</td>
			  <td><input type="text" name="alipay[mid]" value="<?=$pay_config['alipay']['mid']?>" style="width:200px;" autocomplete="off"/> </td>
			</tr>
			<tr>
			  <td align="right">交易密钥</td>
			  <td><input type="password" name="alipay[sec]" value="<?=$pay_config['alipay']['sec']?>" style="width:200px;" autocomplete="off"/>
			</tr>
			<tr>
			  <td align="right">交易类型</td>
			  <td>
			  即时到账
			  </td>
			</tr>  
			<tr>
			  <td></td><td><input type="checkbox" name="alipay[state]" value="Y" <?if($pay_config['alipay']['state']=='Y') echo 'checked';?>> 启用</td>
			</tr>
			<tr>
			  <td></td>
			  <td>
			  <input type="hidden" name="alipay[pay_type]" value="online">
			  <input type="hidden" name="alipay[pay_name]" value="支付宝"> 
			  </td>
			</tr> 
		  <!-- Alipay/END -->  

		  <!-- AlipayWPA -->  
			<tr>
			  <td align="right"> </td>
			  <td><h2>支付宝(手机端)</h2>
			  <input type="hidden" name="alipaywap[payname]" value="支付宝" />
			  </td>
			</tr>
			<tr>
			  <td align="right">支付宝账号</td>
			  <td><input type="text" name="alipaywap[account]" value="<?=$pay_config['alipaywap']['account']?>" style="width:200px;" autocomplete="off"/>
				商户申请：<a href="https://b.alipay.com/" target="_blank">签约支付宝</a></td>
			</tr>
			<tr>
			  <td align="right">商户ID号</td>
			  <td><input type="text" name="alipaywap[mid]" value="<?=$pay_config['alipaywap']['mid']?>" style="width:200px;" autocomplete="off"/> </td>
			</tr>
			<tr>
			  <td align="right">交易密钥</td>
			  <td><input type="password" name="alipaywap[sec]" value="<?=$pay_config['alipaywap']['sec']?>" style="width:200px;" autocomplete="off"/>
			</tr>
			<tr>
			  <td align="right">交易类型</td>
			  <td>
			  即时到账
			  </td>
			</tr>  
			<tr>
			  <td></td><td><input type="checkbox" name="alipaywap[state]" value="Y" <?if($pay_config['alipaywap']['state']=='Y') echo 'checked';?>> 启用</td>
			</tr>
			<tr>
			  <td></td>
			  <td>
			  <input type="hidden" name="alipaywap[pay_type]" value="online">
			  <input type="hidden" name="alipaywap[pay_name]" value="手机支付宝"> 
			  </td>
			</tr> 
		  <!-- AlipayWPA/END -->  


		  <!-- Tenpay -->  
			<tr>
			  <td align="right"> </td>
			  <td><h2>财付通</h2>
			  <input type="hidden" name="tenpay[payname]" value="财付通" />
			  </td>
			</tr>
			<tr>
			  <td align="right">商户ID号</td>
			  <td><input type="text" name="tenpay[mid]" value="<?=$pay_config['tenpay']['mid']?>" style="width:200px;" autocomplete="off"/>
				商户申请：<a href="http://mch.tenpay.com/market/index.html" target="_blank">签约财付通</a></td>
			</tr>
			<tr>
			  <td align="right">交易密钥</td>
			  <td><input type="password" name="tenpay[sec]" value="<?=$pay_config['tenpay']['sec']?>" style="width:200px;" autocomplete="off"/>
			</tr>
			<tr>
			  <td align="right">交易类型</td>
			  <td>
			  即时到账
			  </td>
			</tr> 
			<tr>
			  <td></td><td><input type="checkbox" name="tenpay[state]" value="Y" <?if($pay_config['tenpay']['state']=='Y') echo 'checked';?>> 启用</td>
			</tr>
			<tr>
			  <td></td>
			  <td>
			  <input type="hidden" name="tenpay[pay_type]" value="online">
			  <input type="hidden" name="tenpay[pay_name]" value="财付通"> 
			  </td>
			</tr> 
		  <!-- Tenpay/END -->   
 
		  <!-- Wxpay -->  
			<tr>
			  <td align="right"> </td>
			  <td><h2>微信支付</h2>
			  <input type="hidden" name="wxpay[payname]" value="微信支付" />
			  </td>
			</tr>
			<tr>
			  <td align="right">APPID</td>
			  <td><input type="text" name="wxpay[appid]" value="<?=$pay_config['wxpay']['appid']?>" style="width:200px;" autocomplete="off"/>
				商户申请：<a href="http://kf.qq.com/faq/120911VrYVrA150905zeYjMZ.html" target="_blank">签约微信支付(公众号)</a></td>
			</tr>
			<tr>
			  <td align="right">商户号/MCHID</td>
			  <td><input type="text" name="wxpay[mchid]" value="<?=$pay_config['wxpay']['mchid']?>" style="width:200px;" autocomplete="off"/>
			</tr>
			<tr>
			  <td align="right">商户支付密钥/KEY</td>
			  <td><input type="password" name="wxpay[key]" value="<?=$pay_config['wxpay']['key']?>" style="width:200px;" autocomplete="off"/>
			</tr>
			<tr>
			  <td align="right">公众帐号secert/APPSECRET</td>
			  <td><input type="password" name="wxpay[appsecret]" value="<?=$pay_config['wxpay']['appsecret']?>" style="width:200px;" autocomplete="off"/>
			</tr> 
			<tr>
			  <td></td><td><input type="checkbox" name="wxpay[state]" value="Y" <?if($pay_config['wxpay']['state']=='Y') echo 'checked';?>> 启用</td>
			</tr>
			<tr>
			  <td></td>
			  <td>
			  <input type="hidden" name="wxpay[pay_type]" value="online">
			  <input type="hidden" name="wxpay[pay_name]" value="微信支付"> 
			  </td>
			</tr> 
		  <!-- Wxpay/END -->   

		  <tr>
			  <td align="right"></td>
			  <td>
			  <br/><br/>
			  <input type="submit" value="确定" class="btn btn-danger" >   
			  </td>
			</tr>
			</table>
		  
		</form> 

