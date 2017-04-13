<!-- 通用代码 //-->
<style type="text/css">.unshow{display:none}</style>

<div class="unshow">
<script type="text/javascript">document.write(unescape("%3Cscript src='/stat?cmd=ui&goods_id=<?=$c_goods_id?>&rnd="+Math.random()+"' type='text/javascript'%3E%3C/script%3E"));</script>
<?=$g_common_code?>
</div>


<?
// 在线支付完成后弹出窗口
if(req('callback') == 'pay'){ 
?>
<script language="javascript">location.replace('/member/?cmd=<?=base64_encode('bill.php')?>');</script>
<?
}
?> 

<?
// 登录弹出窗口
if(req('callback') == 'login'){ 
?>
<script language="javascript">location.replace('/member/login');</script>
<?
}
?> 

<?
// 购物车弹出窗口
if(req('callback') == 'buycart'){ 
?>
<script language="javascript">location.replace('/member/?cmd=<?=base64_encode('buycart.php')?>');</script>
<?
}
?> 

<div id="ie6_note" style="text-align:center;color:red"></div>
<script language="javascript">
var ie6=!-[1,]&&!window.XMLHttpRequest;
if(ie6){
	var ie_note = '你还在使用IE6浏览器？基于安全考虑并为了获得更佳的展示效果，建议更换浏览器：IE8.0/Firefox/Chrome/Safari';
	document.getElementById('ie6_note').innerHTML = ie_note;
}
</script> 

<noscript><iframe src="*.html"></iframe></noscript>

<?
if($_COOKIE['CLOOTA_B2B2C_DIY'] == 'Y'){
	include($g_root.'portlet/diy.php');
}
?>  

<?
if($g_is_demo_site==true && $is_index==true){
?>
<style type="text/css">  
.demo-mask-wrap{height:140px;width:100%;position:fixed;_position:absolute;bottom:0;left:0;z-index:990;}
.demo-mask-wrap .mask{background:#000;height:100%;width:100%;position:absolute;top:0;left:0;opacity:.75;filter:alpha(opacity=75);}
.demo-mask{height:100%;position:relative;z-index:995; width:1200px; margin:0 auto; position:relative;}
.demo-mask .demo-mask-body{ position:absolute; left:0; bottom:0;}
.demo-mask .demo-mask-qr{ position:absolute; left:920px; top:10px;}
.demo-mask .demo-mask-close{display:inline-block;height:33px;width:33px;position:absolute;right:10px;top:10px; cursor:pointer;-moz-transition: all 0.8s ease-in-out;-webkit-transition: all 0.8s ease-in-out;-o-transition: all 0.8s ease-in-out; -ms-transition: all 0.8s ease-in-out; transition: all 0.8s ease-in-out;}
.demo-mask .demo-mask-close:hover{-moz-transform: rotate(180deg); -webkit-transform: rotate(180deg); -o-transform: rotate(180deg); -ms-transform: rotate(180deg);transform: rotate(180deg);}
</style>
<script type="text/javascript">
function mask_colse(){
	document.getElementById('demo-mask-wrap').style.display='none';
}
</script>
<div id="demo-mask-wrap" class="demo-mask-wrap">
	<div class="mask"></div>	
	<div class="demo-mask" style="z-index:10000">
		<img src="/common/static/mask.png" class="demo-mask-body">
		<img src="/common/static/mask-qr.jpg" class="demo-mask-qr">
		<i class="demo-mask-close" onclick="mask_colse()"><img src="/common/static/mask-close.png"></i>
	</div>	
</div>
<?}?>