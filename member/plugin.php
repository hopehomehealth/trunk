<?
include('config.php');

$this_member = get_member();
?>
<?if(req('cmd')=='common'){?>
	document.write('<a class="member_a" href="javascript:member_dialog(\'/member/<?=url('buycart.php')?>\',850,450,\'\');">���ﳵ(<b><?=get_cart_number()?></b>)</a>'); 
	document.write(' &nbsp; ');
	<?if($_COOKIE['CLOOTA_B2B2C_USER_UUID']==''){?>
	document.write('<a class="member_a" href="javascript:member_dialog(\'/member/login\',850,450,\'\');">��¼/ע��</a>');
	<?} else {?>
	document.write('<a class="member_a" href="javascript:member_dialog(\'/member/<?=url('order.php')?>\',850,450,\'\');">��ӭ��<?=$this_member['account']?></a>'); 
	<?}?>
<?}?>

<?if(req('cmd')=='index'){?>  
	<?if($_COOKIE['CLOOTA_B2B2C_USER_UUID']==''){?>
	document.write('<li style="position:relative; z-index:999"><a href="javascript:member_dialog(\'/member/login\',850,450,\'\');" class="button_login">�� ¼</a></li>');
	document.write('<li style="position:relative; z-index:999"><a href="javascript:member_dialog(\'/member/login\',850,450,\'\');" class="button_register">���ע��</a></li>');
	<?} else {?>
	document.write('<li><a href="javascript:member_dialog(\'/member/<?=url('order.php')?>\',850,450,\'\');" class="button_register">��Ա����</a></li>'); 
	document.write('<li><a href="/member/logout" class="button_register">��ȫ�˳�</a></li>'); 
	<?}?>
<?}?> 

<?if(req('cmd')=='index_nav'){?>  
	<?if($_COOKIE['CLOOTA_B2B2C_USER_UUID']==''){?>
	document.write('<div class="fl ml10"> <a href="javascript:member_dialog(\'/member/login\',850,450,\'\');" class="button_register">ע��</a> </div>'); 
	<?} else {?>
	document.write('<div class="fl ml10"> <a href="javascript:member_dialog(\'/member/<?=url('order.php')?>\',850,450,\'\');" class="button_register">�ҵĶ���</a> </div>');  
	<?}?>
<?}?> 
 

<?if(req('cmd')=='buycart'){?>
	document.write('<a class="member_a" href="javascript:member_dialog(\'/member/<?=url('buycart.php')?>\',850,450,\'\');">���ﳵ(<b><?=get_cart_number()?></b>)</a>');
<?}?>  

<?if(req('cmd')=='buycart_number'){?>
	document.write('<?=get_cart_number()?>');
<?}?>  

<?if(req('cmd')=='member'){?>
	<?if($_COOKIE['CLOOTA_B2B2C_USER_UUID']==''){?>
	document.write('<a class="member_a" href="javascript:member_dialog(\'/member/login\',850,450,\'\');">��¼/ע��</a>');
	<?} else {?>
	document.write('<a class="member_a" href="javascript:member_dialog(\'/member/<?=url('order.php')?>\',850,450,\'\');">��Ա����</a>'); 
	<?}?>
<?}?>


<?
if(req('cmd')=='browse'){

	$goods_id = req('goods_id');

	if($goods_id!=''){ 
		//�����������
		$sql = "UPDATE t_goods_thread SET clicks=clicks+1 WHERE goods_id='$goods_id'";  
		$db->query($sql);  

		//�����ο������¼
		$sql = "INSERT INTO `t_goods_browse` (`site_id`, `goods_id`, `user_id`, `session_id`, `addtime`) VALUES ('$g_siteid', '$goods_id', '$g_userid', '".sessionid()."', '".date('Y-m-d H:i:s')."' ); ";
		$db->query($sql); 
	} 

	$news_id = req('news_id');

	if($news_id!=''){ 
		//�����������
		$sql = "UPDATE `t_article_thread` SET `clicks`=`clicks`+1 WHERE `thread_id`='$news_id'";  
		$db->query($sql);   
	}
}
?>
