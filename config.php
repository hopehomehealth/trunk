<?php 
date_default_timezone_set('Asia/Shanghai');  

define('IN_CLOOTA', true);
/// վ���·��
$g_site_root = dirname(__FILE__); 
$g_root		 = $g_site_root.'/';


include($g_site_root.'/config/cfg.php');
include($g_site_root.'/libs/mysql_class.php');
include($g_site_root.'/libs/pinyin.php');
include($g_site_root.'/function.php'); 


/// ��ǰ����
$g_http_host	= $_SERVER['HTTP_HOST']; 
$g_domain		= "http://".$g_http_host."/";
$g_now_domain	= "http://".$g_http_host."/";


/// ���ӵ����ݿ�
$db = new dbmysql();
$db->dbconn($db_host, $db_user, $db_pwd, $db_name);


/// ��ȡ�����ļ�
$cfg_cache_file = $g_site_root.'/cache/cfg/'.$_SERVER['HTTP_HOST'].'.php';

// Ԥ�������ļ�����
if(file_exists($cfg_cache_file)==true){
	include($cfg_cache_file);
	$g_config = unserialize($site_serialize);
} else { 
	$config_sql = "SELECT * FROM `t_site_config` WHERE (`site_domain`='$g_http_host' OR `root_domain`='$g_http_host'  OR `mobile_domain`='$g_http_host' OR `other_domain` LIKE '%$g_http_host%' ) LIMIT 0,1";  
	$g_config = $db->get_one($config_sql); 	 
}  


// վ�㲻����
if($g_config['site_id']==''){
	@header("http/1.1 404 not found");  
	@header("status: 404 not found");
	die('<h1>SITE NOT FOUND</h1>');
} 


// վ��״̬
if($g_config['state']!='1'){
	load_page("�Բ���ϵͳ��������ʱ�رգ����Ժ����ԣ�");
}

// �������������ļ�
if(file_exists($cfg_cache_file) == false){ 
	site_cache($g_root, $g_config['site_id'], $g_http_host);
} 


/// ȫ�ֲ�������  

$g_siteid				= $g_config['site_id']; 

$g_master				= $g_config['is_master']; //�Ƿ���վ 1:0

$g_profile				= unserialize($g_config['profile']); // վ������

$g_misc					= unserialize($g_config['misc']);  // վ����������

$g_tpl					= $g_config['tpl_name']; 

$g_tpl_dir				= $g_site_root.'/themes/'.$g_tpl.'/'; 
 
$g_url					= $_SERVER['REQUEST_URI'];

$g_full_url				= "http://$g_http_host".$_SERVER['REQUEST_URI'];  // ������ַ

$g_www_url				= "http://".$g_config['site_domain']."/"; 
 
$g_mobile_url			= "http://".$g_config['mobile_domain']."/"; 

$g_sitename				= $g_config['site_name'];  //վ������

$g_common_code			= stripslashes($g_config['common_code']);  //PC��ͨ����ҳ����

$g_page_title			= $g_config['page_title'];  //��ҳ����

$g_page_keywords		= $g_config['page_keywords']; //��ҳ�ؼ��� 

$g_page_description		= $g_config['page_description']; //��ҳ����
	 
$g_userid				= $_COOKIE['CLOOTA_B2B2C_USER_UUID'];  //�ÿ�����ʡ��

$g_shopid				= $_COOKIE['CLOOTA_B2B2C_SHOP_UUID'];  //�ÿ�����ʡ��

$g_style				= $g_config['style_name'];

$g_mobile_style			= $g_config['mobile_style_name'];

if($g_userid>0){
	$g_user = get_member_info();
}
if($g_shopid>0){  
	$g_shop = get_shop_info();
} 

$g_start_city			= $g_profile['start_region']; //�磺�Ϸ�

$g_start_city_code		= $g_profile['start_region_code']; //�磺hefei 

$g_domain_return = 'http://192.168.0.253';

// վ��ͨ��JS����
$g_common_js = <<<END
<script language="javascript" src="/ajax/lazyload-1.9.1/jquery.lazyload.min.js"></script>
<script language="javascript" src="/static/js/cloota.js"></script>

END;


/**
 * 
 * ģ���д�淶��
 * 1�������ļ�������ʹ��load_user_diy�������磺include(load_user_diy('static.php'));
 * 2���ɱ༭��HTMLҳ��������������ļ��������ļ�����Ϊ��diy.x����.html
 * 3���ɱ༭��JSҳ��������������ļ��������ļ�����Ϊ��diy.j����.html
 **/

?>
