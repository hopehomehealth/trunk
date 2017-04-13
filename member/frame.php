<?
include(dirname(__FILE__).'/config.php'); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="GBK" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title><?if($g_console_debug==true) echo $cmd?>会员中心 - <?=$g_sitename?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body style="margin:0px;padding:0px;" onload="autoFrame()"> 
    <div class="container-fluid" style="padding-top:10px;">
      <div class="row-fluid"> 
        <div class="span12">
            <?
			$view_file = dirname(__FILE__).'/pc/'.$cmd;

			if(is_file($view_file)){
				include($view_file);
			} else {
				include(dirname(__FILE__).'/pc/order.php'); 
			}
			?>
        </div> 
      </div> 
    </div>   
	<script type="text/javascript"> 
	function autoFrame(){  
		if(document.body.scrollHeight>810){
			var newHeight = document.body.scrollHeight + 20 + "px";
			window.parent.document.getElementById("frameWin").style.height = newHeight;  
		}
	} 
	</script> 
  </body>
</html>
