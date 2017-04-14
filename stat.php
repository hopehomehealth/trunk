<?  
include("config.php"); 

function get_ip_name($ip){

	if($ip=='') die('IP ERROR');
 
    $ch = curl_init();
    $url = 'http://apis.baidu.com/apistore/iplookupservice/iplookup?ip='.$ip;
    $header = array(
        'apikey: 3521a8602016da107fb0f586af624e3a',
    );
    // 添加apikey到header
    curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // 执行HTTP请求
    curl_setopt($ch , CURLOPT_URL , $url);
    $res = curl_exec($ch);

    $arr = json_decode($res, true);
	return $arr['retData']['country'].' '.$arr['retData']['province'].' '.$arr['retData']['city'];

/*
Array
(
    [ip] => 117.89.35.58
    [country] => 中国
    [province] => 江苏
    [city] => 南京
    [district] => 鼓楼
    [carrier] => 中国电信
)
*/
}

function get_naps_bot() {
	  $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
	  if (strpos($useragent, 'googlebot') !== false){
		return 'Googlebot';
	  }
	  if (strpos($useragent, 'bing') !== false){
		return 'Bing';
	  }
	  if (strpos($useragent, 'slurp') !== false){
		return 'Yahoobot';
	  }
	  if (strpos($useragent, 'baiduspider') !== false){
		return 'Baiduspider';
	  }
	  if (strpos($useragent, 'sogou') !== false){
		return 'Sogouspider';
	  }
	  if (strpos($useragent, 'soso') !== false){
		return 'Sosospider';
	  } 
	  if (strpos($useragent, 'youdaobot') !== false){
		return 'Youdaobot';
	  } 
	  if (strpos($useragent, '360') !== false){
		return '360Spider';
	  } 
	  return '';
}

function get_ip_address()
{
    static $realip;
    if (isset($_SERVER)){
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $realip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")){
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("HTTP_CLIENT_IP")) {
            $realip = getenv("HTTP_CLIENT_IP");
        } else {
            $realip = getenv("REMOTE_ADDR");
        }
    }

    return $realip;
}

$cmd = req('cmd');

if($cmd=='ui'){
	session_start();  
	$this_session_id = session_id();  
	$this_ip_address = get_ip_address(); 
	$this_search_bot = get_naps_bot();

?>

var v_referer = document.referrer; 

var v_href = window.location.href;

var v_session_id = '<?=$this_session_id?>';

var v_ip_address = '<?=$this_ip_address?>';

var v_site_id = '<?=$g_siteid?>';

var v_search_bot = '<?=$this_search_bot?>';

var v_goods_id = '<?=req('goods_id')?>';

var XMLHttpReq;
function createXMLHttpRequest() {
    try {
        XMLHttpReq = new ActiveXObject("Msxml2.XMLHTTP"); 
    }
    catch(E) {
        try {
            XMLHttpReq = new ActiveXObject("Microsoft.XMLHTTP"); 
        }
        catch(E) {
            XMLHttpReq = new XMLHttpRequest(); 
        }
    } 
}
function sendAjaxRequest(url) {
    createXMLHttpRequest();                  
    XMLHttpReq.open("post", url, true);
    XMLHttpReq.onreadystatechange = processResponse; 
    XMLHttpReq.send(null);
}
function processResponse() {
    if (XMLHttpReq.readyState == 4) {
        if (XMLHttpReq.status == 200) {
            var text = XMLHttpReq.responseText; 
            text = window.decodeURI(text);
            var cp = document.getElementById("cp");
            cp.innerHTML = "";
            var values = text.split("|");
            for (var i = 0; i < values.length; i++) {
                var temp = document.createElement("option");
                temp.text = values[i];
                temp.value = values[i];
                cp.options.add(temp);
            } 
        }
    } 
}

var v_rnd = Math.random();
v_href = v_href.replace(/&/g, '%26');

sendAjaxRequest('/stat?cmd=do&rnd='+v_rnd+'&v_referer='+v_referer+'&v_session_id='+v_session_id+'&v_ip_address='+v_ip_address+'&v_site_id='+v_site_id+'&v_goods_id='+v_goods_id+'&v_search_bot='+v_search_bot+'&v_href='+v_href);

<?
	exit;
} 

if($cmd=='do'){
	$v_referer = req('v_referer');
	$v_session_id = req('v_session_id');
	$v_ip_address = req('v_ip_address');
	$v_site_id = req('v_site_id');
	$v_search_bot = req('v_search_bot');
	$v_href = addslashes(req('v_href'));
	$v_goods_id = req('v_goods_id');
	$ymdhis = date('Y-m-d H:i:s');

	$v_ip_name = '';//get_ip_name($v_ip_address);

	$sql = "INSERT INTO `t_stat` ( `site_id` , `referer` , `session_id` , `ip_address` , `ip_name`, `href` , `bot`, `addtime` ) VALUES ( '$v_site_id', '$v_referer', '$v_session_id', '$v_ip_address', '$v_ip_name', '$v_href', '$v_search_bot', '$ymdhis' ); ";  
	$db->query($sql); 

	if($v_goods_id!=''){
		$sql = "INSERT INTO `t_goods_stat` ( `site_id` , `goods_id`, `referer` , `session_id` , `ip_address` , `ip_name`, `href` , `bot`, `addtime` ) VALUES ( '$v_site_id', '$v_goods_id', '$v_referer', '$v_session_id', '$v_ip_address', '$v_ip_name', '$v_href', '$v_search_bot', '$ymdhis' ); ";  
		$db->query($sql); 
	}

	exit;
} 
?>