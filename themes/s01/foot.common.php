
<div style="clear:both"><br/><br/></div>

<div id="footbox">
	<div class="footer-nav"> 
	<?include(load_user_diy('diy.x07.html'));?>
	</div>

	<p>Copyright &copy;<?=date('Y')?> <a href="<?=$g_domain?>"><?=$g_sitename?></a> ��Ȩ���� 
	&nbsp; ���ξ�Ӫ���֤��ţ�<?=$g_profile['ota_code']?> 
	&nbsp; ICP�����ţ�<a href="http://www.miitbeian.gov.cn/" target="_blank"><?=$g_profile['icp_code']?></a> 
	&nbsp; <span>����֧�֣�<a href="<?=$g_sys_home?>" target="_blank" title="��Ʒ�����ε�������ϵͳ" >��¿ͨ</a></span>
	</p>

	<div class="footer-qlogo"> 
	<?include(load_user_diy('diy.x08.html'));?> 
	</div>
</div>
  
<script language="javascript"> 
    seajs.use(['banner', 'index', 'unveil'], function (banner, index) { 
        banner.init();
        index.init();
    });
</script>
 