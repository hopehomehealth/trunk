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
			  <td><h2>����֧��/��������/��������֧����ʽ</h2>
			  <input type="hidden" name="default[payname]" value="����֧��" />
			  </td>
			</tr>   
			<tr>
			  <td></td><td style="color:red">��ע����������/POS��/�����տ�/���л������·�ʽ</td>
			</tr>
			<tr>
			  <td></td><td><input type="checkbox" name="default[state]" value="Y" checked > ����</td>
			</tr>
			<tr>
			  <td></td><td><input type="text" name="default[note]" value="��������/POS��/�����տ�/���л������·�ʽ" >  </td>
			</tr>
			<tr>
			  <td></td>
			  <td> 
			  <input type="hidden" name="default[pay_type]" value="offline">
			  <input type="hidden" name="default[pay_name]" value="Ĭ��"> 
			  </td>
			</tr>
	 
		  <!-- Default/END -->

		  <!-- Alipay -->  
			<tr>
			  <td align="right"> </td>
			  <td><h2>֧����</h2>
			  <input type="hidden" name="alipay[payname]" value="֧����" />
			  </td>
			</tr>
			<tr>
			  <td align="right">֧�����˺�</td>
			  <td><input type="text" name="alipay[account]" value="<?=$pay_config['alipay']['account']?>" style="width:200px;" autocomplete="off"/>
				�̻����룺<a href="https://b.alipay.com/" target="_blank">ǩԼ֧����</a></td>
			</tr>
			<tr>
			  <td align="right">�̻�ID��</td>
			  <td><input type="text" name="alipay[mid]" value="<?=$pay_config['alipay']['mid']?>" style="width:200px;" autocomplete="off"/> </td>
			</tr>
			<tr>
			  <td align="right">������Կ</td>
			  <td><input type="password" name="alipay[sec]" value="<?=$pay_config['alipay']['sec']?>" style="width:200px;" autocomplete="off"/>
			</tr>
			<tr>
			  <td align="right">��������</td>
			  <td>
			  ��ʱ����
			  </td>
			</tr>  
			<tr>
			  <td></td><td><input type="checkbox" name="alipay[state]" value="Y" <?if($pay_config['alipay']['state']=='Y') echo 'checked';?>> ����</td>
			</tr>
			<tr>
			  <td></td>
			  <td>
			  <input type="hidden" name="alipay[pay_type]" value="online">
			  <input type="hidden" name="alipay[pay_name]" value="֧����"> 
			  </td>
			</tr> 
		  <!-- Alipay/END -->  

		  <!-- AlipayWPA -->  
			<tr>
			  <td align="right"> </td>
			  <td><h2>֧����(�ֻ���)</h2>
			  <input type="hidden" name="alipaywap[payname]" value="֧����" />
			  </td>
			</tr>
			<tr>
			  <td align="right">֧�����˺�</td>
			  <td><input type="text" name="alipaywap[account]" value="<?=$pay_config['alipaywap']['account']?>" style="width:200px;" autocomplete="off"/>
				�̻����룺<a href="https://b.alipay.com/" target="_blank">ǩԼ֧����</a></td>
			</tr>
			<tr>
			  <td align="right">�̻�ID��</td>
			  <td><input type="text" name="alipaywap[mid]" value="<?=$pay_config['alipaywap']['mid']?>" style="width:200px;" autocomplete="off"/> </td>
			</tr>
			<tr>
			  <td align="right">������Կ</td>
			  <td><input type="password" name="alipaywap[sec]" value="<?=$pay_config['alipaywap']['sec']?>" style="width:200px;" autocomplete="off"/>
			</tr>
			<tr>
			  <td align="right">��������</td>
			  <td>
			  ��ʱ����
			  </td>
			</tr>  
			<tr>
			  <td></td><td><input type="checkbox" name="alipaywap[state]" value="Y" <?if($pay_config['alipaywap']['state']=='Y') echo 'checked';?>> ����</td>
			</tr>
			<tr>
			  <td></td>
			  <td>
			  <input type="hidden" name="alipaywap[pay_type]" value="online">
			  <input type="hidden" name="alipaywap[pay_name]" value="�ֻ�֧����"> 
			  </td>
			</tr> 
		  <!-- AlipayWPA/END -->  


		  <!-- Tenpay -->  
			<tr>
			  <td align="right"> </td>
			  <td><h2>�Ƹ�ͨ</h2>
			  <input type="hidden" name="tenpay[payname]" value="�Ƹ�ͨ" />
			  </td>
			</tr>
			<tr>
			  <td align="right">�̻�ID��</td>
			  <td><input type="text" name="tenpay[mid]" value="<?=$pay_config['tenpay']['mid']?>" style="width:200px;" autocomplete="off"/>
				�̻����룺<a href="http://mch.tenpay.com/market/index.html" target="_blank">ǩԼ�Ƹ�ͨ</a></td>
			</tr>
			<tr>
			  <td align="right">������Կ</td>
			  <td><input type="password" name="tenpay[sec]" value="<?=$pay_config['tenpay']['sec']?>" style="width:200px;" autocomplete="off"/>
			</tr>
			<tr>
			  <td align="right">��������</td>
			  <td>
			  ��ʱ����
			  </td>
			</tr> 
			<tr>
			  <td></td><td><input type="checkbox" name="tenpay[state]" value="Y" <?if($pay_config['tenpay']['state']=='Y') echo 'checked';?>> ����</td>
			</tr>
			<tr>
			  <td></td>
			  <td>
			  <input type="hidden" name="tenpay[pay_type]" value="online">
			  <input type="hidden" name="tenpay[pay_name]" value="�Ƹ�ͨ"> 
			  </td>
			</tr> 
		  <!-- Tenpay/END -->   
 
		  <!-- Wxpay -->  
			<tr>
			  <td align="right"> </td>
			  <td><h2>΢��֧��</h2>
			  <input type="hidden" name="wxpay[payname]" value="΢��֧��" />
			  </td>
			</tr>
			<tr>
			  <td align="right">APPID</td>
			  <td><input type="text" name="wxpay[appid]" value="<?=$pay_config['wxpay']['appid']?>" style="width:200px;" autocomplete="off"/>
				�̻����룺<a href="http://kf.qq.com/faq/120911VrYVrA150905zeYjMZ.html" target="_blank">ǩԼ΢��֧��(���ں�)</a></td>
			</tr>
			<tr>
			  <td align="right">�̻���/MCHID</td>
			  <td><input type="text" name="wxpay[mchid]" value="<?=$pay_config['wxpay']['mchid']?>" style="width:200px;" autocomplete="off"/>
			</tr>
			<tr>
			  <td align="right">�̻�֧����Կ/KEY</td>
			  <td><input type="password" name="wxpay[key]" value="<?=$pay_config['wxpay']['key']?>" style="width:200px;" autocomplete="off"/>
			</tr>
			<tr>
			  <td align="right">�����ʺ�secert/APPSECRET</td>
			  <td><input type="password" name="wxpay[appsecret]" value="<?=$pay_config['wxpay']['appsecret']?>" style="width:200px;" autocomplete="off"/>
			</tr> 
			<tr>
			  <td></td><td><input type="checkbox" name="wxpay[state]" value="Y" <?if($pay_config['wxpay']['state']=='Y') echo 'checked';?>> ����</td>
			</tr>
			<tr>
			  <td></td>
			  <td>
			  <input type="hidden" name="wxpay[pay_type]" value="online">
			  <input type="hidden" name="wxpay[pay_name]" value="΢��֧��"> 
			  </td>
			</tr> 
		  <!-- Wxpay/END -->   

		  <tr>
			  <td align="right"></td>
			  <td>
			  <br/><br/>
			  <input type="submit" value="ȷ��" class="btn btn-danger" >   
			  </td>
			</tr>
			</table>
		  
		</form> 

