<?

ob_start();
if (!isset($_SESSION)){
    session_start();
}
$runtime_start = microtime(true); 
include("config.php"); 

//�ж�cookie��ȷ��
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

/// �����ڼ�
if($g_misc['is_icp_date']=='1'){
	if(date('H')>=8 && date('H')<=17){
		header("Content-type: text/html; charset=gb2312"); 
		die('<h2 align="center">'.$_SERVER['HTTP_HOST'].' ��ʱ�޷����ʣ����Ժ����ԣ�</h2>');
	}
}

/// ���ڸ����������ض���������
if($g_config['root_domain']==$g_http_host && $g_config['site_domain']!=$g_config['root_domain']){  
	http301('http://'.$g_config['site_domain'].'/');
}


/// �������������ض���������
if(strpos($g_config['other_domain'], $g_http_host)!==false){  
	http301('http://'.$g_config['site_domain'].'/');
}

 
/// -----------------------------------------------------// ִ�����߶�
if($g_config['mobile_domain'] == $g_http_host){  
	$g_tpl = $g_config['mobile_tpl_name'];

	$g_common_code	= stripslashes($g_config['mobile_common_code']); //���߶�ͨ����ҳ����
}

/// ������ cache start...
$cache_dir		= 'cache/'.$g_siteid.'/';
$cache_file		= $cache_dir.md5($g_full_url).'.html';

$cache_open		= $g_misc['is_cache']; //�����Ƿ���
$cache_expire	= $g_misc['cache_hours']; //����Сʱ��

// DIYģʽ���û���
if(req('diy')=='yes' || $_COOKIE['CLOOTA_B2B2C_DIY']=='Y'){ 
	$cache_open = '0';
}

if(file_exists($cache_file)==true){

	// ������� update cache...
	$cache_filetime = date('YmdH', filemtime($cache_file));
	if((date('YmdH') - $cache_filetime)>$cache_expire){
		unlink($cache_file);
	}

	// ���뻺�� load cache...
	if($cache_open == '1'){
		include($cache_file);
		exit;
	}
}


//------------------------------------------------------// load web process start...
$cmd = req('cmd'); 

/// ����������
$language_file = $g_root."diy/$g_siteid/$g_tpl/LANG.php";

if(file_exists($language_file)==true){ //���ȼ����û��Զ�������
	$g_lng = unserialize(file_get_contents($language_file));
} else { //Ĭ������
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
 

	/// ����DIYģʽ
	$cas = substr(md5('CLOOTA_B2B2C_DIY'.date('mdH')),0,20);

	if(req('diy')=='yes' && $cas = req('cas')){ // DIYģʽ
		setcookies('CLOOTA_B2B2C_DIY', 'Y');
		js("window.top.location.replace('/?DIY');");
		exit();
	}

	if(req('diy')=='no'){  //�˳�DIYģʽ
		clearcookies('CLOOTA_B2B2C_DIY');
		js("window.top.location.replace('/?UNDIY');");
		exit();
	} 

	include("model/index.model.php"); //����ģ���ļ�

	include("themes/$g_tpl/index.php");  
}

//------------------------------------------------------// load web process end.

if($cache_open == '1'){
	/// �������
	$page_html = ob_get_contents();

	/// ���ɻ���  
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
