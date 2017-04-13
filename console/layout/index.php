<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
 
if(is_file($view_file) == true){
	if(is_file($model_file) == true){
		include($model_file);
	}
} 

/// 提示数字 ///
$sql = "SELECT COUNT(*) FROM `t_goods_thread` WHERE `site_id`='".$g_siteid."' ";  
$tip_total_goods = $db->get_value($sql); 

$sql = "SELECT COUNT(*) FROM `t_user_order` WHERE `site_id`='".$g_siteid."' ";  
$tip_total_order = $db->get_value($sql);  

$sql = "SELECT COUNT(*) FROM `t_user` WHERE `site_id`='".$g_siteid."' ";  
$tip_total_user = $db->get_value($sql); 

$sql = "SELECT COUNT(*) FROM `t_guestbook` WHERE `site_id`='".$g_siteid."' ";  
$tip_total_guestbook = $db->get_value($sql); 

$sql = "SELECT COUNT(*) FROM `t_shop_join` WHERE `site_id`='".$g_siteid."' ";  
$tip_total_shop_join = $db->get_value($sql); 
  
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 

<script type="text/javascript">
window.onerror = function(){return true;} 
</script>

<meta http-equiv="Content-Type" content="text/html; charset=gbk" />

<title><?$g_console_debug==true? print $cmd : ''?> 控制面板 - <?=$g_sys_name?></title>
    
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	 
<link href="tpl/css/bootstrap/bootstrap.css" rel="stylesheet" />
<link href="tpl/css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
<link href="tpl/css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />
 
<link rel="stylesheet" type="text/css" href="tpl/css/layout.css" />
<link rel="stylesheet" type="text/css" href="tpl/css/elements.css" />
<link rel="stylesheet" type="text/css" href="tpl/css/icons.css" />
 
<link href="tpl/css/lib/font-awesome.css" type="text/css" rel="stylesheet" />
<link href="static/js/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" /> 
<link href="tpl/css/compiled/tables.css" rel="stylesheet" type="text/css" media="screen" /> 



<!-- jQuery UI start// -->
<link href="static/js/jquery-ui/css/blitzer/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" type="text/css" /> 
<script type="text/javascript" src="static/js/jquery-ui/js/jquery-ui-1.9.2.custom.min.js" charset="utf-8" ></script><script type="text/javascript" src="static/js/jquery-1.8.3.min.js" charset="utf-8" ></script>  
<!-- jQuery UI end// -->
 

<!-- kindeditor start// -->
<script type="text/javascript" charset="utf-8" src="static/js/kindeditor/kindeditor-min.js"></script>
<script type="text/javascript" charset="utf-8" src="static/js/kindeditor/lang/zh_CN.js"></script> 
<!-- kindeditor end// -->

<script type="text/javascript" src="static/js/pcasunzip.js"></script>  
<script type="text/javascript" src="static/js/pinyin.js"></script>  
<script type="text/javascript" src="static/js/lazyload/jquery.lazyload.min.js"></script> 
<script type="text/javascript" src="static/js/validform/validform.js" charset="utf-8"></script> 
<link href="static/js/validform/validform.css" rel="stylesheet" type="text/css" /> 
<link href="static/js/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />  
<script type="text/javascript" src="static/js/bootstrap/js/bootstrap.min.js" charset="utf-8"></script> 
<script src="static/js/datepicker/WdatePicker.js" type="text/javascript"></script> 
<link href="static/js/font-awesome/css/font-awesome.min.css" rel="stylesheet"> 
<link href="static/image/style.css" rel="stylesheet" type="text/css" /> 

<script type="text/javascript" src="static/js/colorbox-master/jquery.colorbox.js"></script>
<link rel="stylesheet" type="text/css" href="static/js/colorbox-master/colorbox.css" />
 
<script type="text/javascript" src="static/js/console.js"></script>  
 

<style type="text/css">
.hide_layer{display:none}
.ui-dialog-titlebar{ display:none}	
.ui-dialog{border:10px solid #efefef}
</style> 
</head>

<body>  
<div id="ie_version_alert" class="alert" style="text-align:center;display:none"><button type="button" class="close" data-dismiss="alert">&times;</button>
<em class="fa fa-exclamation-triangle" style="font-size:18px"></em> 检测到您的<strong style="color:red">浏览器版本过低</strong>，某些重要功能可能无法使用，建议使用谷歌浏览器、<strong>360浏览器（极速模式）</strong>、火狐浏览器或者IE浏览器12.0以上版本。</div>
<!--[if lt IE 11]>
<script type="text/javascript"> 
document.getElementById('ie_version_alert').style.display='';
</script>
<![endif]-->
<div class="hide_layer">
	<iframe id="frm" name="frm" src="" frameborder="0" scrolling="no" width="0" height="0"></iframe>
	<div id="notice_dialog" title=""></div>  
</div> 

<div id="edit_dialog" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true" style="z-index:90000001;width:900px"> 
	<div class="modal-header" style="border-bottom:0px;"></div>
	<div class="modal-body" style="padding:0px;">
		<iframe id="edit_frm" name="edit_frm" frameborder="0" scrolling="auto" width="100%" height="380" ></iframe>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button> 
	</div>
</div>

<div id="alert_tip" style="display:none;position:fixed;left:40%;top:30%;z-index:90000002;"> 
	<div class="alert" id="alert_tip_layer" style="width:380px">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>温馨提示</strong>  
		<p id="alert_tip_text"></p>
	</div>
</div>
 

    <!-- navbar --> 
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <button type="button" class="btn btn-navbar visible-phone" id="menu-toggler">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
			<?
		    if($g_login['logo']!=''){
				$logo = "/upfiles/$g_siteid/".$g_login['logo'];
		    ?>
		    <a href="/" target="_blank" class="brand"><img src="<?=$logo?>" style="height:28px;"></a>
		    <?}else{?>
		    <a href="/" target="_blank" class="brand"><img src="static/image/logo.png" style="height:28px;"></a>
		    <?}?>
  
            <ul class="nav pull-right">  
                <li class="hidden-phone">
					<form method="get" action=""> 
					<input name="cmd" type="hidden" value="<?=base64_encode('goods_list.php')?>" />
                    <input class="search" type="text" name="kw" value="<?=req('kw')?>"/>
					</form>
                </li>
				<?if( $cookie_user_role == 'SHOP' ){?>
				<?
				$unread_notice_count = get_notice_count();
				?>
                <li class="notification-dropdown hidden-phone">
                    <a href="#" class="trigger">
                        <i class="icon-warning-sign"></i>
                        <span class="count"><?=$unread_notice_count?></span>
                    </a>
					<?if($unread_notice_count>0){?>
                    <div class="pop-dialog">
                        <div class="pointer right">
                            <div class="arrow"></div>
                            <div class="arrow_border"></div>
                        </div> 
                        <div class="body">
                            <a href="#" class="close-icon"><i class="icon-remove-sign"></i></a>
                            <div class="notifications">  
                                <h3>目前共有 <?=$unread_notice_count?> 条未读消息</h3>
								<?
								$last_notice = get_last_notice(5);
								if(notnull($last_notice)){
									foreach ($last_notice as $val){  
								?>
                                <a href="<?=url('notice.php')?>" class="item">
                                    <i class="icon-envelope-alt"></i> <?=show_substr($val['notice'],28)?>
                                    <span class="time"><i class="icon-time"></i> 13 min.</span>
                                </a>
								<?
									}
								}
								?>  
                                <div class="footer">
                                    <a href="<?=url('notice.php')?>" class="/logout">查看全部消息</a>
                                </div>
                            </div>
                        </div> 
                    </div>
					<?}?>
                </li> 
				<?}?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle hidden-phone" data-toggle="dropdown" id="sx">
                        <?=$g_account?>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu" id="xk"> 
						<li><a href="<?=url('account.php')?>">账户管理</a></li> 
						<li><a href="/console/logout">安全退出</a></li>
                    </ul>
                </li> 
				<script type="text/javascript">
				window.onload=function()
				{
				  var se=document.getElementById('sx');
				  var xk1=document.getElementById('xk');
				  se.onmouseover=function() {xk1.style.display='block';}
				  xk1.onmouseover=function() {xk1.style.display='block';}
				  xk1.onmouseout=function() {xk1.style.display='none';}
				}</script>
                
                <li class="settings hidden-phone">
                    <a href="<?=url('setting_site.php')?>" role="button">
                        <i class="icon-cog"></i>
                    </a>
                </li> 

				<li><a href="preview.php?ac=site&type=pc" target="_blank">PC预览</a></li>
				<li><a href="#wx_content" class="wx_box">微信预览</a></li>
				 
                <li class="settings hidden-phone">
                    <a href="./logout" role="button" onclick="return confirm('确认退出系统吗？')">
                        <i class="icon-share-alt"></i>
                    </a>
                </li>
            </ul>            
        </div>
    </div> 
	<div style="display:none">
		<div id='wx_content' style="text-align:center">
			<br/> 
			打开微信扫描预览<br/>
			<img src="/qr/?v=http://<?=$g_login['mobile_domain']?>/" style="height:150px">
			<br/>
			<a href="http://<?=$g_login['mobile_domain']?>/" target="_blank">浏览器直接预览</a>
		</div>
	</div>
	<script type="text/javascript"> 
	$(".wx_box").colorbox({inline:true, width:"300px"});
	</script>
 
    <!-- end navbar -->

    <!-- sidebar -->
    <div id="sidebar-nav" style="margin-top:-30px">
        <ul id="dashboard-menu">
			<? 
			include(dirname(__FILE__).'/nav.admin.php');
			?> 
        </ul>
    </div>
    <!-- end sidebar -->


	<!-- main container -->
    <div class="content" style="margin-top:-20px"> 
        <div class="container-fluid"> 
			<?
			if(is_file($view_file) == true){ 
			?>
			<div id="pad-wrapper"> 
                <div class="table-wrapper products-table section"> 
                    <div class="row-fluid">
						<?
						include($view_file);
						?>
					</div>
                </div>  
            </div>
			<!-- scripts -->
			<script src="tpl/js/jquery-latest.js"></script>
			<script src="tpl/js/bootstrap.min.js"></script>
			<script src="tpl/js/theme.js"></script>
			<?
			} 
			else {
				include(dirname(__FILE__).'/welcome.php');
			} 
			?> 
        </div>
    </div> 

	<div style="display:none">
		<iframe id="frm" name="frm" src="" frameborder="0" scrolling="no" width="0" height="0"></iframe>
		
		<div id="notice_dialog" title=""></div>  

		<div id="edit_dialog" title="" style="background-color:white;padding:0px">
			<iframe id="edit_frm" name="edit_frm" frameborder="0" scrolling="auto" width="100%" height="600" ></iframe> 
		</div> 
	</div> 

    <!-- end main container -->

	
	
	<div style="position:fixed;right:10px;bottom:150px;"> 
		<div style="margin-bottom:10px;" title="返回顶部"><a href="javascript:void(0)" onclick="document.getElementsByTagName('body')[0].scrollTop=0;" style="color:#666"><i class="fa  fa-arrow-circle-up fa-2x"></i></a></div> 
		<div title="返回底部"><a href="javascript:void(0)" onclick="document.getElementsByTagName('body')[0].scrollTop=document.getElementsByTagName('body')[0].scrollHeight;" style="color:#666"><i class="fa  fa-arrow-circle-down fa-2x"></i></a></div> 
		
	</div>
	<div style="position:fixed;right:10px;bottom:3px;font-size:7px;font-family:arial;"> 
		<?
		$time_end = microtime_float();
		$time = round($time_end - $time_start,2);
		?>
		<em>Processed in <span <?if($time>0.5){?>style="color:red"<?}?>><?=$time?></span> (s)</em>
	</div>
</body>

</html>