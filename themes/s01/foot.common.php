
<div style="clear:both"><br/><br/></div>

<div id="footbox">
	<div class="footer-nav"> 
	<?include(load_user_diy('diy.x07.html'));?>
	</div>

	<p>Copyright &copy;<?=date('Y')?> <a href="<?=$g_domain?>"><?=$g_sitename?></a> 版权所有 
	&nbsp; 旅游经营许可证编号：<?=$g_profile['ota_code']?> 
	&nbsp; ICP备案号：<a href="http://www.miitbeian.gov.cn/" target="_blank"><?=$g_profile['icp_code']?></a> 
	&nbsp; <span>技术支持：<a href="<?=$g_sys_home?>" target="_blank" title="高品质旅游电子商务系统" >云驴通</a></span>
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
 