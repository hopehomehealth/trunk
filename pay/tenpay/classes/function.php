<?php

// ��ע��������Ƿ�ͨfopen����
function  log_result($word) {
	global $pay_log_dir;

    $fp = fopen($pay_log_dir."tenpay.log", "a");
    flock($fp, LOCK_EX) ;
    fwrite($fp,"ִ�����ڣ�".strftime("%Y%m%d%H%M%S",time())."\n".$word."\n\n");
    flock($fp, LOCK_UN);
    fclose($fp);
}



?>