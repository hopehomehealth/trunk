<? 
$dir = dirname(dirname(__FILE__));

$handle = opendir($dir);
 
if($handle){

	while(($file = readdir($handle)) !== false){
			if($file==='.' || $file==='..'){
				continue;
			}

			$tmp = realpath($dir.'/'.$file);

			if(is_file($tmp)){ 
				
				$php_text = file_get_contents($tmp);
				
				if(strpos($php_text, '<!--MV-->')){
					$mv_array = explode('<!--MV-->', $php_text);

					$fp = fopen($dir.'/model/'.$file, "w+");
					fwrite($fp, $mv_array[0]);
					fclose($fp);

					$fp = fopen($dir.'/view/'.$file, "w+");
					fwrite($fp, $mv_array[1]);
					fclose($fp);

					rename($tmp, 'tmp/'.$file);
				}
			}
	}
	closedir($handle);

} 



?>