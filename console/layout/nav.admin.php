<?php
// ��ʾ����

function get_goods_count($is_sale){
	global $db, $g_siteid;
	$sql = "SELECT COUNT(*) FROM `t_goods_thread` WHERE `site_id`='".$g_siteid."' AND `is_sale`='$is_sale'";  
	return $db->get_value($sql); 
}

function get_order_count($state){
	global $db, $g_siteid;
	$sql = "SELECT COUNT(*) FROM `t_user_order` WHERE `site_id`='".$g_siteid."' AND `state`='$state'";  
	return $db->get_value($sql);   
}
function get_order_notgo_count($verifyFlag){
    global $db, $g_siteid;
    $sql = "SELECT COUNT(*) FROM `t_user_order` WHERE `site_id`='".$g_siteid."' AND `verify_flag`='$verifyFlag'";
//    echo $sql;
    return $db->get_value($sql);
}

$sql = "SELECT COUNT(*) FROM `t_user` WHERE `site_id`='".$g_siteid."' ";  
$tip_total_user = $db->get_value($sql); 

$sql = "SELECT COUNT(*) FROM `t_guestbook` WHERE `site_id`='".$g_siteid."' ";  
$tip_total_guestbook = $db->get_value($sql); 

$sql = "SELECT COUNT(*) FROM `t_shop_join` WHERE `site_id`='".$g_siteid."' ";  
$tip_total_shop_join = $db->get_value($sql); 

$sql = "SELECT COUNT(*) FROM `t_shop` WHERE `site_id`='".$g_siteid."' ";  
$tip_total_shop = $db->get_value($sql); 
?> 
<style type="text/css">
.badge{font-family:arial;font-size:10px;padding:2px 5px 2px 5px;}
</style>
			 <li <?if($cmd==''){?>class="active"<?}?>> 
                <a href="./">
                    <i class="fa fa-home"></i>
                    <span>ϵͳ��ҳ</span>
                </a>
            </li>    
			<li <?if(in_array($cmd, array('shop_join_view.php','shop_join_list.php','shop.php','shop_add.php','shop_edit.php'))){?>class="active"<?}?>>
                <a class="dropdown-toggle">
                    <i class="fa fa-briefcase"></i>
                    <span>�̼ҹ���</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu" <?if(in_array($cmd, array('shop_join_view.php','shop_join_list.php','shop.php','shop_add.php','shop_edit.php'))){?>style="display:block"<?}?>>
                    <li><a href="?cmd=<?=base64_encode('shop_join_list.php')?>">��פ����<span class="badge badge-important pull-right"><?=$tip_total_shop_join?></span></a></li>
                    <li><a href="?cmd=<?=base64_encode('shop.php')?>">�̼ҹ���<span class="badge badge-info pull-right"><?=$tip_total_shop?></span></a></li> 
                </ul>
            </li> 
			<li <?if(in_array($cmd, array('goods_cat.php','goods_list.php','goods_mode.php'))){?>class="active"<?}?>>
                <a class="dropdown-toggle">
                    <i class="fa fa-barcode"></i>
                    <span>��Ʒ����</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu" <?if(in_array($cmd, array('goods_cat.php','goods_add.php','goods_list.php','goods_mode.php'))){?>style="display:block"<?}?>>
                    <li><a href="?cmd=<?=base64_encode('goods_cat.php')?>">��������</a></li> 
                    <li><a href="?cmd=<?=base64_encode('goods_list.php')?>&goods_type=1">��Ʒ����<span class="badge badge-warning pull-right"><?=get_goods_count(1)?></span></a></li> 
					<li><a href="?cmd=<?=base64_encode('goods_list.php')?>&is_hot=1">�Ƽ���Ʒ</a></li> 
					<li><a href="?cmd=<?=base64_encode('goods_mode.php')?>">����/���...</a></li>
                </ul>
            </li> 
			<li <?if(in_array($cmd, array('order.php','customized.php'))){?>class="active"<?}?>>
                <a class="dropdown-toggle">
                    <i class="fa fa-opencart"></i>
                    <span>��������</span> 
					<i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu" <?if(in_array($cmd, array('order.php','customized.php'))){?>style="display:block"<?}?>>
                    <li><a href="?cmd=<?=base64_encode('order.php')?>&state=1">������<span class="badge badge-warning pull-right"><?=get_order_count('1')?></span></a></li>
					<li><a href="?cmd=<?=base64_encode('order.php')?>&state=2">�Ѹ���<span class="badge badge-warning pull-right"><?=get_order_count('2')?></span></a></li>
                    <li><a href="?cmd=<?=base64_encode('order.php')?>&state=6">���δͨ��<span class="badge badge-warning pull-right"><?=get_order_notgo_count('2')?></span></a></li>
					<li><a href="?cmd=<?=base64_encode('order.php')?>&state=3">��ȷ��<span class="badge badge-warning pull-right"><?=get_order_count('3')?></span></a></li>
					<li><a href="?cmd=<?=base64_encode('order.php')?>&state=4">�����<span class="badge badge-warning pull-right"><?=get_order_count('4')?></span></a></li>
					<li><a href="?cmd=<?=base64_encode('order.php')?>&state=5">��ȡ��<span class="badge badge-warning pull-right"><?=get_order_count('5')?></span></a></li>
                    <li><a href="?cmd=<?=base64_encode('customized.php')?>">���Ŷ���</a></li>  
                </ul>
            </li> 
			<li <?if(in_array($cmd, array('user.php','tourist_list.php','comment_list.php'))){?>class="active"<?}?>>
                <a class="dropdown-toggle">
                    <i class="fa fa-user"></i>
                    <span>��Ա����</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu" <?if(in_array($cmd, array('user.php','comment_list.php','user_level.php'))){?>style="display:block"<?}?>>
                    <li><a href="?cmd=<?=base64_encode('user.php')?>">��Ա����<span class="badge badge-warning pull-right"><?=$tip_total_user?></span></a></li>
					<li><a href="?cmd=<?=base64_encode('user_level.php')?>">��Ա�ȼ�</a></li> 
					<li><a href="?cmd=<?=base64_encode('comment_list.php')?>">���۹���</a></li>
                </ul>
            </li> 
			<li <?if(in_array($cmd, array('order_bill.php','order_report.php'))){?>class="active"<?}?>>
                <a class="dropdown-toggle">
                    <i class="fa fa-money"></i>
                    <span>�������</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu" <?if(in_array($cmd, array('order_bill.php','order_report.php','order_refund.php'))){?>style="display:block"<?}?>>
                    <li><a href="?cmd=<?=base64_encode('order_bill.php')?>">֧����¼</a></li>
                    <li><a href="?cmd=<?=base64_encode('order_report.php')?>">�����˵�</a></li>
                    <li><a href="?cmd=<?=base64_encode('order_refund.php')?>">�˿����</a></li>
                </ul>
            </li>
			<li <?if(in_array($cmd, array('theme.php','site_menu.php','site_ppt.php','goods_floor.php','site_hotspot.php','diy.php','imagebox.php','link_list.php'))){?>class="active"<?}?>>
                <a class="dropdown-toggle">
                    <i class="fa fa-desktop"></i>
                    <span>ǰ̨����</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu" <?if(in_array($cmd, array('theme.php','site_ad.php','site_menu.php','site_ppt.php','goods_floor.php','site_hotspot.php','diy.php','imagebox.php','link_list.php'))){?>style="display:block"<?}?>>
                    <li><a href="?cmd=<?=base64_encode('theme.php')?>">ģ������</a></li>
					<li><a href="?cmd=<?=base64_encode('site_ad.php')?>">������</a></li>
                    <li><a href="?cmd=<?=base64_encode('site_menu.php')?>">�˵�/�ֲ�ͼ</a></li>   
					<li><a href="?cmd=<?=base64_encode('goods_floor.php')?>&goods_type=0">Ƶ��¥��</a></li>
					<li><a href="?cmd=<?=base64_encode('site_hotspot.php')?>">��������</a></li>
					<li><a href="?cmd=<?=base64_encode('diy.php')?>">���ӻ�DIY...</a></li>
					<li><a href="?cmd=<?=base64_encode('imagebox.php')?>">ͼƬ�ռ�</a></li>
					<li><a href="?cmd=<?=base64_encode('link_list.php')?>">��������</a></li>
                </ul>
            </li>
			<li <?if(in_array($cmd, array('news_list.php','page_list.php','help.php'))){?>class="active"<?}?>>
                <a class="dropdown-toggle">
                    <i class="fa fa-wechat"></i>
                    <span>΢�Ž���</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu" <?if(in_array($cmd, array('wx_vcard.php','wx_setting.php','wx_home_nav.php'))){?>style="display:block"<?}?>>
                    <li><a href="?cmd=<?=base64_encode('wx_setting.php')?>">��������</a></li>
                    <li><a href="?cmd=<?=base64_encode('wx_vcard.php')?>">΢�Ź���</a></li>
					<li><a href="?cmd=<?=base64_encode('wx_home_nav.php')?>">��������</a></li>
                </ul>
            </li>
			<li <?if(in_array($cmd, array('news_list.php','page_list.php','help.php'))){?>class="active"<?}?>>
                <a class="dropdown-toggle">
                    <i class="fa fa-gift"></i>
                    <span>�����̳�</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu" <?if(in_array($cmd, array('score_goods_cat.php','score_goods_list.php','score_order.php'))){?>style="display:block"<?}?>>
                    <li><a href="?cmd=<?=base64_encode('score_goods_cat.php')?>">��Ʒ����</a></li>
                    <li><a href="?cmd=<?=base64_encode('score_goods_list.php')?>">��Ʒ����</a></li> 
					<li><a href="?cmd=<?=base64_encode('score_order.php')?>">���ֶ���</a></li> 
                </ul>
            </li>
			<li <?if(in_array($cmd, array('news_list.php','page_list.php','help.php'))){?>class="active"<?}?>>
                <a class="dropdown-toggle">
                    <i class="fa fa-file-word-o"></i>
                    <span>���ݹ���</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu" <?if(in_array($cmd, array('news_list.php','page_list.php','help.php'))){?>style="display:block"<?}?>>
                    <li><a href="?cmd=<?=base64_encode('news_list.php')?>">���¹���</a></li>
                    <li><a href="?cmd=<?=base64_encode('page_list.php')?>">ҳ�����</a></li> 
					<li><a href="?cmd=<?=base64_encode('help.php')?>">��������</a></li> 
                </ul>
            </li>
			<li <?if(in_array($cmd, array('local_store.php'))){?>class="active"<?}?>>
                <a href="?cmd=<?=base64_encode('local_store.php')?>">
                    <i class="fa fa-map-marker"></i>
                    <span>�����ŵ�</span>
                </a>
            </li> 
			<li <?if(in_array($cmd, array('report_goods.php'))){?>class="active"<?}?>>
                <a href="?cmd=<?=base64_encode('report_goods.php')?>">
                    <i class="fa fa-area-chart"></i>
                    <span>ͳ�Ʒ���</span>
                </a>
            </li>  
			<li <?if(strpos($cmd, 'setting_')!==false){?>class="active"<?}?>>                
                <a href="?cmd=<?=base64_encode('setting_site.php')?>">
                    <i class="fa fa-cog"></i>
                    <span>ϵͳ����</span>
                </a>
            </li>  