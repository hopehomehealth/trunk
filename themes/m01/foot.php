<link rel="stylesheet" type="text/css" href="/images/common_<?=$g_mobile_style?>.css" /><ul class="botListUl">
		<li> <a href="/" class="icon1"> <span></span>
			<p>��ҳ</p>
			</a>
		<li> <a href="/search?hot=yes" class="icon2"> <span></span>
			<p>�Ƽ�</p> 
			</a> </li>
		<li> <a href="/local/" class="icon3"> <span></span>
			<p>�ŵ�</p>
			</a> </li>
		<li> <a href="/leader/" class="icon4"> <span></span>
			<p>����</p> 
			</a> </li>
		<li> <a href="/member/" class="icon5"> <span></span>
			<p>�ҵ�</p>
			</a> </li>
	</ul>  

  <script>function backtop(){ document.body.scrollTop = 0;}</script>

  <div class="foot_account clearfix">  
    <p class="fl">���ߣ�<a href="tel:<?=$g_profile['hot_line']?>"><strong><?=$g_profile['hot_line']?></strong></a> </p>
    <p class="fr"> <a href="/member/">�ҵ��˻�</a>&nbsp;&nbsp; | &nbsp;&nbsp;<a id="backTop" onclick="backtop()" href="javascript:void(0)">�ض���</a> </p>
  </div>
  <div class="bottom">
    <p> <a href="<?=$g_domain?>">������ҳ</a> <a href="<?=$g_domain?>page/aboutus.html">��������</a> <a href="<?=$g_domain?>page/contact.html">��ϵ����</a></p>
    <p><small style="color:#777;">&#169;<?=date('Y')?> <a href="<?=$g_mobile_url?>"><?=$g_profile['company']?></a> 
	<?if($g_profile['ota_code']!=''){?>�������֤��<?=$g_profile['ota_code']?><?}?>
	</p>  
  </div>

  <script type="text/javascript" src="/ajax/lazyload-1.9.1/jquery.lazyload.min.js" charset="utf-8"></script>
  <script type="text/javascript" charset="utf-8">
  $(function() {
     $("img.lazy").lazyload();
  });
  </script>
 
  

<?include($g_root.'common/public.php');?>