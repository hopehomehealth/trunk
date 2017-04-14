<?
include("config.php"); 

if(req('cmd')=='page'){ 
	if(req('action')=='find'){
		$sql = "SELECT `thread_id` FROM t_article_thread WHERE `title` LIKE '%".req('word')."%' AND site_id='$g_siteid'";  
		$exist_id = $db->get_value($sql); 
		
		if($exist_id!=''){
			header("Location:/article-".$exist_id.".html"); 
			exit();
		} else {
			header("Location:/article-0.html"); 
			exit();
		}
	}
}
?>