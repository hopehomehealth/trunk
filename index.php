<?

ob_start();
if (!isset($_SESSION)){
    session_start();
}
$runtime_start = microtime(true); 
include("config.php"); 

//判断cookie正确性
if(!empty($_COOKIE['5fe845d7c136951446ff6a80b8144467'])){
    $token = json_decode(json_decode($_COOKIE['5fe845d7c136951446ff6a80b8144467']),true);
    $usertoken = array("usertoken"=>$token['token2']);
    $login = $db->api_post("$host/getuserinfo",$usertoken);
    if(strpos($login, '#') !== false){
        $check = 'check';
    }
}else{
    $check = '';
}

/// 备案期间
if($g_misc['is_icp_date']=='1'){
	if(date('H')>=8 && date('H')<=17){
		header("Content-type: text/html; charset=gb2312"); 
		die('<h2 align="center">'.$_SERVER['HTTP_HOST'].' 暂时无法访问，请稍后重试！</h2>');
	}
}

/// 存在根域名，则重定向到主域名
if($g_config['root_domain']==$g_http_host && $g_config['site_domain']!=$g_config['root_domain']){  
	http301('http://'.$g_config['site_domain'].'/');
}


/// 其他域名，则重定向到主域名
if(strpos($g_config['other_domain'], $g_http_host)!==false){  
	http301('http://'.$g_config['site_domain'].'/');
}

 
/// -----------------------------------------------------// 执行无线端
if($g_config['mobile_domain'] == $g_http_host){  
	$g_tpl = $g_config['mobile_tpl_name'];

	$g_common_code	= stripslashes($g_config['mobile_common_code']); //无线端通用网页代码
}

/// 处理缓存 cache start...
$cache_dir		= 'cache/'.$g_siteid.'/';
$cache_file		= $cache_dir.md5($g_full_url).'.html';

$cache_open		= $g_misc['is_cache']; //缓存是否开启
$cache_expire	= $g_misc['cache_hours']; //缓存小时数

// DIY模式禁用缓存
if(req('diy')=='yes' || $_COOKIE['CLOOTA_B2B2C_DIY']=='Y'){ 
	$cache_open = '0';
}

if(file_exists($cache_file)==true){

	// 缓存更新 update cache...
	$cache_filetime = date('YmdH', filemtime($cache_file));
	if((date('YmdH') - $cache_filetime)>$cache_expire){
		unlink($cache_file);
	}

	// 载入缓存 load cache...
	if($cache_open == '1'){
		include($cache_file);
		exit;
	}
}


//------------------------------------------------------// load web process start...
$cmd = req('cmd'); 

/// 加载语言项
$language_file = $g_root."diy/$g_siteid/$g_tpl/LANG.php";

if(file_exists($language_file)==true){ //优先加载用户自定义文字
	$g_lng = unserialize(file_get_contents($language_file));
} else { //默认文字
	$lng_file = $g_root."themes/$g_tpl/LANG.php";
	if(file_exists($lng_file)){
		include($lng_file);
	}
} 

include("model/common.model.php");
 
if($cmd != ''){ 
	$model_file = dirname(__FILE__	).'/model/'.$cmd.'.model.php';
	if(is_file($model_file)){
		include($model_file);
	} 

	include("themes/$g_tpl/$cmd.php");

} else { 
 

	/// 进入DIY模式
	$cas = substr(md5('CLOOTA_B2B2C_DIY'.date('mdH')),0,20);

	if(req('diy')=='yes' && $cas = req('cas')){ // DIY模式
		setcookies('CLOOTA_B2B2C_DIY', 'Y');
		js("window.top.location.replace('/?DIY');");
		exit();
	}

	if(req('diy')=='no'){  //退出DIY模式
		clearcookies('CLOOTA_B2B2C_DIY');
		js("window.top.location.replace('/?UNDIY');");
		exit();
	} 

	include("model/index.model.php"); //加载模型文件

	include("themes/$g_tpl/index.php");  
}

//------------------------------------------------------// load web process end.

if($cache_open == '1'){
	/// 输出缓存
	$page_html = ob_get_contents();

	/// 生成缓存  
	if(file_exists($cache_dir)==false){ 
		mkdir($cache_dir, 0777, true);
	}
	$ymdhis = date('Y-m-d H:i:s');
	//$page_html = "<!-- Cached on $ymdhis $g_full_url -->\n".$page_html;

	$handle = fopen($cache_file,'w+');
	fwrite($handle, $page_html);
	fclose($handle);
}


$runtime_end = microtime(true); 
$runtime_total = $runtime_end - $runtime_start;  
echo "<!-- All processed in $runtime_total (s) -->";
?>
