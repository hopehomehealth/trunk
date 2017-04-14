<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?>
<!DOCTYPE html>
<html>
<head>
<?include($g_tpl_dir.'meta.php');?>
<title><?$g_console_debug==true? print $cmd : ''?> 会员中心 - <?=$g_sitename?></title>
<?include($g_tpl_dir.'static.php');?>
<link rel="stylesheet" type="text/css" href="/member/static/pc/global.css">
<link rel="stylesheet" type="text/css" href="/member/static/pc/member.css">
</head>

<body class="bodybox">

<?include($g_tpl_dir.'head.common.php');?>

<div class="container clear">
	<div class="sidebar">
		<div class="">
			<ul class="wrap">
				<li class="sidebar-line-top" style="height:40px"> <a class="parent-link f60" href="/seller/" ><strong>供应商中心</strong></a> </li>
				<li class="sidebar-line on">
					<div class="relative"> <i class="icon"></i> <a class="parent-link f33" href="javascript:void(0);"><strong>产品管理</strong></a> <i class="arrow up"></i> </div>
					<ul class="menu"> 
						<li><a href="<?=url('shop_goods_cat.php')?>" class="<?=get_active('shop_goods_cat.php')?>">自定义分类</a></li> 
						<?foreach ($g_product_type as $k => $v) {?> 
						<li><a href="<?=url('goods_list.php')?>&goods_type=<?=$k?>" class="<?if(req('goods_type')==$k){?>active<?}?>"><?=$v?>产品 <span style="color:red">(<?=get_goods_count($k)?>)</span></a></li>  
						<?}?> 
					</ul>
				</li>
				<li class="sidebar-line on">
					<div class="relative"> <i class="icon ic1"></i> <a class="parent-link f33" href="javascript:void(0);"><strong>订单管理</strong></a> <i class="arrow"></i> </div>
					<ul class="menu"> 
						<?
						$order_1 = get_order_count('1');
						$order_2 = get_order_count('2');
						$order_3 = get_order_count('3');
						$order_4 = get_order_count('4');
						$order_5 = get_order_count('5');
						?> 
						<li><a href="<?=url('order.php')?>&state=1" class="<?=get_active_args('order.php', 'state', '1')?>"><?=$g_order_state['1']?> <?if($order_1>0){?><span style="color:red">(<?=$order_1?>)</span><?}?></a></li>
						<li><a href="<?=url('order.php')?>&state=2" class="<?=get_active_args('order.php', 'state', '2')?>"><?=$g_order_state['2']?> <?if($order_2>0){?><span style="color:red">(<?=$order_2?>)</span><?}?></a></li> 
						<li><a href="<?=url('order.php')?>&state=3" class="<?=get_active_args('order.php', 'state', '3')?>"><?=$g_order_state['3']?> <?if($order_3>0){?><span style="color:red">(<?=$order_3?>)</span><?}?></a></li> 
						<li><a href="<?=url('order.php')?>&state=4" class="<?=get_active_args('order.php', 'state', '4')?>"><?=$g_order_state['4']?> <?if($order_4>0){?><span style="color:red">(<?=$order_4?>)</span><?}?></a></li> 
						<li><a href="<?=url('order.php')?>&state=5" class="<?=get_active_args('order.php', 'state', '5')?>"><?=$g_order_state['5']?> <?if($order_5>0){?><span style="color:red">(<?=$order_5?>)</span><?}?></a></li> 
					</ul>
				</li>  
				<li class="sidebar-line on">
					<div class="relative"> <i class="icon ic3"></i> <a class="parent-link f33" href="javascript:void(0);"><strong>结算账单</strong></a> <i class="arrow"></i> </div>
					<ul class="menu">
						<?
						$settle_1 = get_settle_count('1');
						$settle_0 = get_settle_count('0'); 
						?> 
						<li><a href="<?=url('order_report.php')?>&is_settle=1" class="<?=get_active_args('order_report.php', 'is_settle', '1')?>">已结算 <?if($settle_1>0){?><span style="color:red">(<?=$settle_1?>)</span><?}?></a></li> 
						<li><a href="<?=url('order_report.php')?>&is_settle=0" class="<?=get_active_args('order_report.php', 'is_settle', '0')?>">未结算 <?if($settle_0>0){?><span style="color:red">(<?=$settle_0?>)</span><?}?></a></li> 
					</ul>
				</li>  
			  
				<li class="sidebar-line on">
					<div class="relative"> <i class="icon ic3"></i> <a class="parent-link f33" href="javascript:void(0);"><strong>系统管理</strong></a> <i class="arrow"></i> </div>
					<ul class="menu"> 
						<li><a href="<?=url('shop_setting.php')?>" class="<?=get_active('shop_setting.php')?>">基本设置</a></li> 
						<li><a href="<?=url('shop_theme.php')?>" class="<?=get_active('shop_theme.php')?>">风格模板</a></li> 
						<li><a href="<?=url('shop_ppt.php')?>" class="<?=get_active('shop_ppt.php')?>">广告管理</a></li>  
						<li><a href="<?=url('shop_page.php')?>" class="<?=get_active('shop_page.php')?>">公司介绍</a></li> 
						<li><a href="<?=url('shop_im.php')?>" class="<?=get_active('shop_im.php')?>">客服管理</a></li>
						<li><a href="<?=$g_shop_url?>" target="_blank">店铺预览</a></li>
						<li><a href="<?=url('shop_account.php')?>" class="<?=get_active('shop_account.php')?>">更改密码</a></li> 
						<li><a href="/seller/logout" onclick="return confirm('确认退出账户？');" class="">安全退出</a></li>
					</ul>
				</li>   
			  
				<li><br/></li>
			</ul>  
		</div>  
	</div>
	<div class="w-main" style="z-index:900001;border:1px solid #efefef;background-color:white;">  
		<?
		if(req('cmd')==''){
			$uri = "/seller/frame.php?cmd=".base64_encode('goods_list.php');
		} else { 
			$uri = "/seller/frame.php?".$_SERVER["QUERY_STRING"];
		}
		?> 

		<iframe width="100%" height="810" align="left" id="frameWin" frameborder="0" scrolling="no" src="<?=$uri?>"> </iframe>
	</div>
</div>
<div class="clear"></div> 

<?include($g_tpl_dir.'foot.common.php');?> 
<div style="display:none;z-index:100000000000;position:absolute;top:0px;left:0px;width:100%;height:100%;"></div>
</body>
</html>
