<link rel="stylesheet" type="text/css" href="/images/common_<?=$g_mobile_style?>.css" /><ul class="botListUl">
		<li> <a href="/" class="icon1"> <span></span>
			<p>首页</p>
			</a>
		<li> <a href="/search?hot=yes" class="icon2"> <span></span>
			<p>推荐</p> 
			</a> </li>
		<li> <a href="/local/" class="icon3"> <span></span>
			<p>门店</p>
			</a> </li>
		<li> <a href="/leader/" class="icon4"> <span></span>
			<p>顾问</p> 
			</a> </li>
		<li> <a href="/member/" class="icon5"> <span></span>
			<p>我的</p>
			</a> </li>
	</ul>  

  <script>function backtop(){ document.body.scrollTop = 0;}</script>

  <div class="foot_account clearfix">  
    <p class="fl">热线：<a href="tel:<?=$g_profile['hot_line']?>"><strong><?=$g_profile['hot_line']?></strong></a> </p>
    <p class="fr"> <a href="/member/">我的账户</a>&nbsp;&nbsp; | &nbsp;&nbsp;<a id="backTop" onclick="backtop()" href="javascript:void(0)">回顶部</a> </p>
  </div>
  <div class="bottom">
    <p> <a href="<?=$g_domain?>">返回首页</a> <a href="<?=$g_domain?>page/aboutus.html">关于我们</a> <a href="<?=$g_domain?>page/contact.html">联系我们</a></p>
    <p><small style="color:#777;">&#169;<?=date('Y')?> <a href="<?=$g_mobile_url?>"><?=$g_profile['company']?></a> 
	<?if($g_profile['ota_code']!=''){?>旅游许可证：<?=$g_profile['ota_code']?><?}?>
	</p>  
  </div>

  <script type="text/javascript" src="/ajax/lazyload-1.9.1/jquery.lazyload.min.js" charset="utf-8"></script>
  <script type="text/javascript" charset="utf-8">
  $(function() {
     $("img.lazy").lazyload();
  });
  </script>
 
  

<?include($g_root.'common/public.php');?>