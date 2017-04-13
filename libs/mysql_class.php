<?php  
class dbmysql {
	var $querynum = 0;
	var $link;
	var $key = "backurlbackurlba";
	function dbconn( $con_db_host, $con_db_id, $con_db_pass, $con_db_name='', $db_charset='GBK', $pconnect=1 ) {
		if($pconnect) {
			if(!$this->link = @mysql_pconnect($con_db_host,$con_db_id,$con_db_pass)) {
				$this->halt('Can not connect to MySQL server');
			}
		} else {
			if(!$this->link = @mysql_connect($con_db_host,$con_db_id,$con_db_pass, 1)) {
				$this->halt('Can not connect to MySQL server');
			}
		}
		if($this->version() > '4.1') {
			if($db_charset!='latin1') {
				@mysql_query("SET character_set_connection=$db_charset, character_set_results=$db_charset, character_set_client=binary", $this->link);
			}

			if($this->version() > '5.0.1') {
				@mysql_query("SET sql_mode=''", $this->link);
			}
		}

		if($con_db_name) {
			@mysql_select_db($con_db_name, $this->link);
		}

	}

	function select_db($dbname) {
		return mysql_select_db($dbname, $this->link);
	}

	function fetch_array($query, $result_type = MYSQL_ASSOC) {
		return mysql_fetch_array($query,$result_type);
	}
	
	function get_all($sql)
    {
        $rt = $this->query($sql);
        if ($rt !== false){
            while ($rs = mysql_fetch_assoc($rt)){
                $arr[] = $rs;
            }
            return $arr;
        }else{
            return false;
        }
    }
	
	
	function update($table, $bind=array(),$where = '')
	{
	    $set = array();
	    foreach ($bind as $col => $val) {
	        $set[] = "$col = '$val'";
	        unset($set[$col]);
	    }
	    $sql = "UPDATE "
             . $table
             . ' SET ' . implode(',', $set)
             . (($where) ? " WHERE $where" : '');
        $this->query($sql);
	}
	
	
	function insert($table, $bind=array())
	{
	    $set = array();
	    foreach ($bind as $col => $val) {
	        $set[] = "`$col`";
	        $vals[] = "'$val'";
	    }
	   $sql = "INSERT INTO "
             . $table
             . ' (' . implode(', ', $set).') '
             . 'VALUES (' . implode(', ', $vals).')';
        $this->query($sql);
        return $this->insert_id();
	}
	
	function get_value($sql,$type = MYSQL_NUM,$var=0){
		$query = $this->query($sql);
		$rt =& mysql_fetch_array($query,$type);
		if (isset($rt[$var])) {
			return $rt[$var];
		}
		return false;
	}
	
 
	function get_one($sql, $type=MYSQL_ASSOC)//MYSQL_ASSOC??MYSQL_NUM??MYSQL_BOTH
	{
		$query = $this->query($sql, $type);
		$rs = & mysql_fetch_array($query, $type);
		return $rs ;
	}
	


	function query($sql, $type = '', $debug = false) {
	   if($debug == true){
			echo '<script>alert("'.addslashes($sql).'")</script>';
	   }
	   $func = $type == 'UNBUFFERED' && @function_exists('mysql_unbuffered_query') ?
			'mysql_unbuffered_query' : 'mysql_query';
		if(!($query = $func($sql, $this->link)) && $type != 'SILENT') {
			$this->halt('MySQL Query Error', $sql);
			//return false;
		}
		$this->querynum++;
		return $query;
	}
	
	function counter($table_name,$where_str="", $field_name="*")
	{
	    $where_str = trim($where_str);
	    if(strtolower(substr($where_str,0,5))!='where' && $where_str) $where_str = "WHERE ".$where_str;
	    $query = " SELECT COUNT($field_name) FROM $table_name $where_str ";
	    $result = $this->query($query);
	    $fetch_row = mysql_fetch_row($result);
	    return $fetch_row[0];
	}

	function affected_rows() {
		return mysql_affected_rows($this->link);
	}
	function list_fields($con_db_name,$table) {
		$fields=mysql_list_fields($con_db_name,$table,$this->link);
	    $columns=$this->num_fields($fields);
	    for ($i = 0; $i < $columns; $i++) {
	        $tables[]=mysql_field_name($fields, $i);
	    }
	    return $tables;
	}

	function error() {
		return (($this->link) ? mysql_error($this->link) : mysql_error());
	}

	function errno() {
		return intval(($this->link) ? mysql_errno($this->link) : mysql_errno());
	}

	function result($query, $row) {
		$query = @mysql_result($query, $row);
		return $query;
	}

	function num_rows($query) {
		$query = mysql_num_rows($query);
		return $query;
	}

	function num_fields($query) {
		return mysql_num_fields($query);
	}

	function free_result($query) {
		return mysql_free_result($query);
	}

	function insert_id() {
		return ($id = mysql_insert_id($this->link)) >= 0 ? $id : $this->result($this->query("SELECT last_insert_id()"), 0);
	}

	function fetch_row($query) {
		$query = mysql_fetch_row($query);
		return $query;
	}

	function fetch_fields($query) {
		return mysql_fetch_field($query);
	}

	function version() {
		return mysql_get_server_info($this->link);
	}

	function close() {
		return mysql_close($this->link);
	}

	function halt($message = '',$sql) {
		global $g_console_debug;

		$ymdhis		= date("Y-m-d H:i:s"); 
		$sqlerror	= mysql_error();
		$sqlerrno	= mysql_errno();
		$sqlerror	= str_replace($dbhost,'dbhost',$sqlerror); 

		$err_string .= "【".$ymdhis."】\r\n";
		$err_string .= "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."\r\n";
		$err_string .= "$sql\r\n";  
		$err_string .= "$sqlerror ( $sqlerrno )\r\n\r\n"; 
	
		$logs_dir = dirname(dirname(__FILE__));
		$fp = fopen($logs_dir.'/logs/mysql.'.date('Y-m-d').".log","a");
        fwrite($fp, $err_string);
        fclose($fp);

		if($g_console_debug == true) {
			echo '<script>alert("数据库操作错误！");</script>';
			echo $err_string;
			exit;
		}
	}

	function check_cookie($loginUrl,$host){
		$back_url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		if(empty($_COOKIE['5fe845d7c136951446ff6a80b8144467'])){
			header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"'); 
			$encrypted = $this->encrypt($back_url);
			setcookie( MD5("backurl"),  $encrypted,  time() + 3600,  "/",'bus365.com');
			Header("Location: $loginUrl");
		}
		$token = json_decode(json_decode($_COOKIE['5fe845d7c136951446ff6a80b8144467']),true);
		$usertoken = array("usertoken"=>$token['token2']);
		$login = $this->api_post("$host/auth/getuserinfo",$usertoken);
		if(strpos($login, '#') === false){
			header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
			$encrypted = $this->encrypt($back_url);
			setcookie( MD5("backurl"),  $encrypted,  time() + 3600,  "/",'bus365.com');
			Header("Location: $loginUrl");
		}


		//echo 123;die;
	}


    public function __set($key, $value){
        $this->$key = $value;
    }

    public function __get($key) {
        return $this->$key;
    }

    public function encrypt($input) {
        $size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
        $input = $this->pkcs5_pad($input, $size);
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_ECB, '');
        $iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        mcrypt_generic_init($td, $this->key, $iv);
        $data = mcrypt_generic($td, $input);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $data = $this->base64url_encode($data);
        return $data;
    }

    private function pkcs5_pad ($text, $blocksize) {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    function strToHex($string)   
    {   
        $hex="";   
        for   ($i=0;$i<strlen($string);$i++)   
        $hex.=dechex(ord($string[$i]));   
        $hex=strtoupper($hex);   
        return   $hex;   
    }   
    function hexToStr($hex)   
    {   
        $string="";   
        for   ($i=0;$i<strlen($hex)-1;$i+=2)   
        $string.=chr(hexdec($hex[$i].$hex[$i+1]));   
        return   $string;   
    }

    public function decrypt($sStr) {
        $decrypted= mcrypt_decrypt(
            MCRYPT_RIJNDAEL_128,
            //$sKey,
            $this->key,
            //base64_decode($sStr),
            $this->base64url_decode($sStr),
            //$sStr,
            MCRYPT_MODE_ECB
        );
        $dec_s = strlen($decrypted);
        $padding = ord($decrypted[$dec_s-1]);
        $decrypted = substr($decrypted, 0, -$padding);
        return $decrypted;
    }
    
    function base64url_encode($data) { 
      return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
    } 
    
    function base64url_decode($data) { 
      return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
    }
   
	function api_post($url = '', $post_data = array()) {
        if (empty($url)) {
            return false;
        }
        if(empty($post_data)){
        	$postUrl = $url;
        	$post_data = '';
        	$curlPost = $post_data;
        	$ch = curl_init();

	        curl_setopt($ch, CURLOPT_URL,$postUrl);
	        curl_setopt($ch, CURLOPT_HEADER, 0);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	        curl_setopt($ch, CURLOPT_POST, 1);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
	        $data = curl_exec($ch);
	        curl_close($ch);
	        
	        return $data;
        }
        $o = "";
        foreach ( $post_data as $k => $v ) 
        { 
        	if(!empty($v)){
        		$o.= "$k=" . urlencode( $v ). "&" ;
        	}
            
        }
        $post_data = substr($o,0,-1);

        $postUrl = $url;
        $curlPost = $post_data;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$postUrl);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch);
        curl_close($ch);
        
        return $data;
    }
    

	
	function setUrl($page)
	{
		if (strstr($this->url , '?')) {
			return $this->url . '&page=' . $page;
		} else {
			return $this->url . '?page=' . $page;
		}
	}
	
	function first()
	{
		return $this->setUrl(1);
	}
	
	function last()
	{
		return $this->setUrl($this->pageTotal);
	}
	
	function prev()
	{
		$page = (($this->page - 1) < 1) ? 1 : $this->page - 1;
		
		return $this->setUrl($page);
	}
	
	function next()
	{
		$page = ($this->page + 1) > $this->pageTotal ? $this->pageTotal : $this->page + 1;
		return $this->setUrl($page);
	}
	
	 function getUrl()
	{
		
		$path = $_SERVER['SCRIPT_NAME'];
		
		$host = $_SERVER['SERVER_NAME'];
		
		$port = $_SERVER['SERVER_PORT'];
		
		$scheme = $_SERVER['REQUEST_SCHEME'];
		
		$queryString = $_SERVER['QUERY_STRING'];
		
		//var_dump($queryString);
		if (strlen($queryString)) {
			parse_str($queryString , $array);
			//var_dump($array);
			unset($array['page']);
			//var_dump($array);
			$path = $path . '?' . http_build_query($array);
			
			//var_dump($path);
		}
		$url = $path;
		
		return $url;
	}
    //转成gbk
    function to_gbk($str){
        return mb_convert_encoding($str, 'gbk', 'utf-8');
    }
    //转成utf8
    function to_utf8($str){
        return mb_convert_encoding($str, 'utf-8', 'gbk');
    }
}