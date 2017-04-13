<? 
function gotop($url, $tip='')
{ 
	if($tip!=''){
		js("alert('$tip');window.top.location.replace('$url');"); 
	} else {
		js("window.top.location.replace('$url');"); 
	}
	exit();
}

function gourl($url, $tip='')
{ 
	if($tip!=''){
		js("alert('$tip');location.replace('$url');"); 
	} else {
		header("Location:$url");
	}
	exit();
}  

// QQ在线咨询
function get_qq_code($qq){
	return 'http://wpa.qq.com/msgrd?v=3&uin='.$qq.'&site=qq&menu=yes';
}
 
function senderror($err)
{
	echo("<script>alert('发生错误：$err');</script>");
	exit();
}

function sendwarn($txt)
{
	echo("<script>alert('$txt');</script>");
	exit();
}   

function load_page($title, $summary=''){
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
	<title><?=$title?></title> 
	<style>body,div,a{font-family:Tahoma;color:#666}</style>
</head> 
<body> 
	<div style="padding-left:210px;padding-top:110px;width:680px;">
	<h2><?=$title?></h2> 
	<p style="font-size:12px"><?=$summary?><br/><br/><br/>技术支持：<a href="http://www.cloota.com/">云驴通</a> - 专业旅游电子商务系统</p>
	</div>
</body>
</html>
<?
	exit();
}



// 重建站点缓存配置文件
function site_cache($g_root, $g_siteid, $domain=''){
	global $db;
	$sql = "SELECT * FROM `t_site_config` where site_id='$g_siteid'";  
	$rs = $db->get_all($sql);
 
	if(notnull($rs)){
		foreach( $rs as $val ) { 
			$serialize_content = serialize($val); 
	 
			$f_head = '<?'."\n".'$site_serialize = <<< END'."\n";
			$f_foot = "\n".'END;'."\n".'?>';
			$serialize_content = $f_head.$serialize_content.$f_foot;
			
			if($domain==''){
				$cache_cfg_file = $g_root.'cache/cfg/'.$val['site_domain'].'.php';
			} else {
				$cache_cfg_file = $g_root.'cache/cfg/'.$domain.'.php';
			}

			$handle = fopen(strtolower($cache_cfg_file), 'w+'); 
			fwrite($handle, $serialize_content);
			fclose($handle);
		}
	}
}

function get_member_info(){
	global $db, $g_userid;
	$sql = "SELECT * FROM t_user WHERE user_id='$g_userid' AND `state`='1' ";  
	return $db->get_one($sql); 
}


function get_shop_info(){
	global $db, $g_shopid;
	$sql = "SELECT * FROM `t_shop` WHERE `shop_id`='$g_shopid'";  
	return $db->get_one($sql); 
}

// 获取URL
function url($file){
	return './?cmd='.base64_encode($file);
}

// 是否CSS激活
function get_active($val, $args_name='', $args_val=''){
	global $cmd;
	if($cmd == $val){ 
		echo 'active'; 
	} 
}

function get_active_args($val, $args_name='', $args_val=''){
	global $cmd;
	if($cmd == $val){
		if($args_name!='' && req($args_name) == $args_val){
			echo 'active';
		} 
	}  
}

function load_mobile($url){
	global $g_config;
	if($g_config['mobile_domain']!=''){
?> 
	<meta name="mobile-agent" content="format=html5; url=<?=$url?>">
	<script>
	if(/AppleWebKit.*Mobile/i.test(navigator.userAgent) || (/MIDP|SymbianOS|NOKIA|SAMSUNG|LG|NEC|TCL|Alcatel|BIRD|DBTEL|Dopod|PHILIPS|HAIER|LENOVO|MOT-|Nokia|SonyEricsson|SIE-|Amoi|ZTE/.test(navigator.userAgent))){
		try{
			if(/Android|Windows Phone|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent)){
				window.location.href= "<?=$url?>";
			}
		}catch(e){}
	}
	</script>
<?
	}
}

function post_curl($uri, $data) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $uri);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1); // 连接超时（秒）
//    curl_setopt($ch, CURLOPT_TIMEOUT, 60); // 执行超时（秒）
    //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded', "Expect:"));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $res = curl_exec($ch);
    curl_close($ch);
    return $res;
}
function utf8_to_gbk($str){
    $str = mb_convert_encoding($str,'GBK','UTF-8');
    return $str;
}
function gbk_to_utf8($str){
    $str = mb_convert_encoding($str,'UTF-8','GBK');
    return  $str;
}
/**
 * UTF-8编码 GBK编码相互转换/（支持数组）
 *
 * @param array $str   字符串，支持数组传递
 * @param string $in_charset 原字符串编码
 * @param string $out_charset 输出的字符串编码
 * @return array
 */
function array_iconv($str, $in_charset="utf-8", $out_charset="gbk")
{
    if(is_array($str))
    {
        foreach($str as $k => $v)
        {
            $str[$k] = array_iconv($v);
        }
        return $str;
    }
    else
    {
        if(is_string($str))
        {
            // return iconv('UTF-8', 'GBK//IGNORE', $str);
            return mb_convert_encoding($str, $out_charset, $in_charset);
        }
        else
        {
            return $str;
        }
    }
}

/// 加载DIY
include($g_root."portlet/function.diy.php");

?>	
