<?
include('config.php');

$this_member = get_member();
?>
<?if(req('cmd')=='common'){?>
	document.write('<a class="member_a" href="javascript:member_dialog(\'/member/<?=url('buycart.php')?>\',850,450,\'\');">购物车(<b><?=get_cart_number()?></b>)</a>'); 
	document.write(' &nbsp; ');
	<?if($_COOKIE['CLOOTA_B2B2C_USER_UUID']==''){?>
	document.write('<a class="member_a" href="javascript:member_dialog(\'/member/login\',850,450,\'\');">登录/注册</a>');
	<?} else {?>
	document.write('<a class="member_a" href="javascript:member_dialog(\'/member/<?=url('order.php')?>\',850,450,\'\');">欢迎：<?=$this_member['account']?></a>'); 
	<?}?>
<?}?>

<?if(req('cmd')=='index'){?>  
	<?if($_COOKIE['CLOOTA_B2B2C_USER_UUID']==''){?>
	document.write('<li style="position:relative; z-index:999"><a href="javascript:member_dialog(\'/member/login\',850,450,\'\');" class="button_login">登 录</a></li>');
	document.write('<li style="position:relative; z-index:999"><a href="javascript:member_dialog(\'/member/login\',850,450,\'\');" class="button_register">免费注册</a></li>');
	<?} else {?>
	document.write('<li><a href="javascript:member_dialog(\'/member/<?=url('order.php')?>\',850,450,\'\');" class="button_register">会员中心</a></li>'); 
	document.write('<li><a href="/member/logout" class="button_register">安全退出</a></li>'); 
	<?}?>
<?}?> 

<?if(req('cmd')=='index_nav'){?>  
	<?if($_COOKIE['CLOOTA_B2B2C_USER_UUID']==''){?>
	document.write('<div class="fl ml10"> <a href="javascript:member_dialog(\'/member/login\',850,450,\'\');" class="button_register">注册</a> </div>'); 
	<?} else {?>
	document.write('<div class="fl ml10"> <a href="javascript:member_dialog(\'/member/<?=url('order.php')?>\',850,450,\'\');" class="button_register">我的订单</a> </div>');  
	<?}?>
<?}?> 
 

<?if(req('cmd')=='buycart'){?>
	document.write('<a class="member_a" href="javascript:member_dialog(\'/member/<?=url('buycart.php')?>\',850,450,\'\');">购物车(<b><?=get_cart_number()?></b>)</a>');
<?}?>  

<?if(req('cmd')=='buycart_number'){?>
	document.write('<?=get_cart_number()?>');
<?}?>  

<?if(req('cmd')=='member'){?>
	<?if($_COOKIE['CLOOTA_B2B2C_USER_UUID']==''){?>
	document.write('<a class="member_a" href="javascript:member_dialog(\'/member/login\',850,450,\'\');">登录/注册</a>');
	<?} else {?>
	document.write('<a class="member_a" href="javascript:member_dialog(\'/member/<?=url('order.php')?>\',850,450,\'\');">会员中心</a>'); 
	<?}?>
<?}?>


<?
if(req('cmd')=='browse'){

	$goods_id = req('goods_id');

	if($goods_id!=''){ 
		//更新浏览次数
		$sql = "UPDATE t_goods_thread SET clicks=clicks+1 WHERE goods_id='$goods_id'";  
		$db->query($sql);  

		//插入游客浏览记录
		$sql = "INSERT INTO `t_goods_browse` (`site_id`, `goods_id`, `user_id`, `session_id`, `addtime`) VALUES ('$g_siteid', '$goods_id', '$g_userid', '".sessionid()."', '".date('Y-m-d H:i:s')."' ); ";
		$db->query($sql); 
	} 

	$news_id = req('news_id');

	if($news_id!=''){ 
		//更新浏览次数
		$sql = "UPDATE `t_article_thread` SET `clicks`=`clicks`+1 WHERE `thread_id`='$news_id'";  
		$db->query($sql);   
	}
}
?>
