<?    
function system_log() {
	global $db, $g_siteid;

	$account_id		= $_COOKIE['CLOOTA_B2B2C_ADMIN_UUID'];
	$user_ip		= ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
	$user_ip		= ($user_ip) ? $user_ip : $_SERVER["REMOTE_ADDR"]; 
	$user_agent		= $_SERVER['HTTP_USER_AGENT']; 
	$full_url		= "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];  // 完整网址
	$ymdhis			= date('Y-m-d H:i:s');
	$log_file		= $g_siteid.'-ID'.$account_id.'-'.date('YmdHis').".log";

	$sql = "INSERT INTO `t_system_log` (`site_id`, `account_id` , `ip` , `url` , `request` , `ua` , `addtime` ) VALUES ('$g_siteid', '$account_id', '$user_ip', '$full_url', '$log_file', '$user_agent', '$ymdhis' );  ";  
	$db->query($sql); 

	$log_dir = dirname(dirname(__FILE__)).'/logs/system/'.date('Y-m-d');

	if(is_dir($log_dir)==false){ 
		mkdir($log_dir, 0777, true);
	}

	// 写入日志
	$fp = fopen($log_dir.'/'.$log_file, "a+");
    fwrite($fp, serialize($_GET));
    fclose($fp);
}
   
// 获取URL
function url($file){
	return './?cmd='.base64_encode($file);
} 

function remove_directory($dir) {
	if ($handle = opendir("$dir")) {
		while (false !== ($item = readdir($handle))) {
			if ($item != "." && $item != "..") {
				if (is_dir("$dir/$item")) {
					remove_directory("$dir/$item");
				} else {
					unlink("$dir/$item"); 
				}
			}
		}
		closedir($handle);
		rmdir($dir); 
	}
}

function random_uuid($length=4) { 
	 $pattern='1235689';
	 for($i=0;$i<$length;$i++)
	 {
	   $key .= $pattern{mt_rand(0,6)};   
	 }
	 return $key;
} 
 
  
function gourl($url) {  
	js("window.top.location.replace('$url');"); 
	exit();
}

function gotourl($url) { 
	js("window.top.location.replace('$url');"); 
} 

function senderr($err) {
	echo("<script>alert('发生错误：$err');history.back();</script>");
	exit();
}

function senderror($html){
?>
	<script language="javascript">   
	function hide_note(){
		parent.$('#alert_tip').fadeOut("slow");; 
	}
	parent.dialog_notice();
	
	parent.$('#alert_tip_layer').addClass('alert-error');
	parent.$('#alert_tip_text').html('<?=$html?>');
	
	setInterval("hide_note()", 4000)
	</script> 
<?
	exit();
} 

function sendwarn($err) {
	echo("<script>alert('发生错误：$err');</script>");
	exit();
}
 
function sendresult($html) {
?>
	<script language="javascript">   
	function hide_note(){
		parent.$('#alert_tip').fadeOut("slow");; 
	}
	parent.dialog_notice();
	parent.$('#alert_tip_text').html('<?=$html?>');
	
	setInterval("hide_note()", 2000)
	</script> 
<?
	exit();
} 

function sendnote($html) {
?>
	<script language="javascript">  
	function hidden_notice() { 
		$( "#notice_dialog" ).dialog( "option", "hide", 'slide' );
		$( "#notice_dialog" ).dialog( "close" );
	}
	dialog_notice();
	$("#notice_dialog").html('<?=$html?>');
	setTimeout('hidden_notice()',2000);
	</script> 
<? 
} 

function unsupport() {
?>
	<p style="color:#FF3146;font-size:12px;"><img src="static/image/cry.gif" width="24" align="absmiddle"/> 对不起，您目前的版本不支持该功能，请<a href="/console/?cmd=<?=base64_encode('account.php')?>&tabs_index=1" style="color:red"><b>升级</b></a>版本！</p>
<?
}

/// 重建站点缓存配置文件
function site_cache() {
	global $g_root, $g_site_domain, $g_mobile_domain; 
	
	if($g_mobile_domain!=''){
		@unlink($g_root.'cache/cfg/'.$g_mobile_domain.'.php');
	}

	@unlink($g_root.'cache/cfg/'.$g_site_domain.'.php');
}

/// 判断是否当前导航
function nav_active($filename) { 
	if(req('cmd')==base64_encode($filename)){
		return true;
	} else {
		return false;
	} 
}

/// 两个时间相差天数
function day_diff($sd, $ed) { 
	$d1=strtotime($sd);
	$d2=strtotime($ed);
	return round(($d2-$d1)/3600/24);
}


function send_mail($to_email, $subject, $body) {  
	global $smtp_host, $smtp_user, $smtp_pwd;

	$mail = f_smtp();
 
	$mail->Subject = $subject.' '.date("Y-m-d");  
	$mail->MsgHTML($body);   
	$mail->AddAddress($to_email, '');    
	$mail->Send();
}
 

function split_str($string, $sublen, $start = 0, $code = 'UTF-8') { 
	if($code == 'UTF-8') 
	{ 
		$pa ="/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/"; 

		preg_match_all($pa, $string, $t_string); 

		if(count($t_string[0]) - $start > $sublen) 
			return join('', array_slice($t_string[0], $start, $sublen)) ; 

		return join('', array_slice($t_string[0], $start, $sublen)); 
	}  
} 

function ft_split($str) {
	$chars = array();
	$ft_chars = ''; 

	preg_match_all("/[a-zA-Z&]+/", $str, $out, PREG_SET_ORDER);
	foreach ($out as &$v) {
		$chars[] = $v[0];
	}

	preg_match_all("/[0-9]+/", $str, $out, PREG_SET_ORDER);
	foreach ($out as &$v) {
		$chars[] = $v[0];
	}

	$str_utf8 = mb_convert_encoding($str, "UTF-8", "GBK"); 
	preg_match_all("/[\x{4e00}-\x{9fa5}]/u", $str_utf8, $out, PREG_SET_ORDER);
	foreach ($out as &$v) {
		$chars[] = mb_convert_encoding($v[0], "GBK", "UTF-8");
	}


	$chars = array_unique($chars); 
	foreach ($chars as &$val) {
		$ft_chars .= $val.' ';
	}

	return $ft_chars;
}


function mail_notice($subject, $body ) { 
	$mail = f_smtp();

	$mail->Subject = $subject;  
	$mail->MsgHTML($body);   
	$mail->AddAddress('794161538@qq.com', '');  
	$mail->Send();
}
?>	