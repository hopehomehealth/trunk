<?
include(dirname(__FILE__).'/config.php'); 


$cmd		= base64_decode(req('cmd')); 

$model_file = dirname(__FILE__).'/model/'.$cmd;

$view_file	= dirname(__FILE__).'/view/'.$cmd;

// 加载公共模型
include(dirname(__FILE__).'/model/common.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="GBK" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title><?if($g_console_debug==true) echo $cmd?>供应商中心 - <?=$g_sitename?></title>  

	<script type="text/javascript" src="static/js/jquery-1.8.3.min.js" charset="utf-8" ></script>

	<!-- jQuery UI start// -->
	<link href="static/js/jquery-ui/css/blitzer/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" type="text/css" /> 
	<script type="text/javascript" src="static/js/jquery-ui/js/jquery-ui-1.9.2.custom.min.js" charset="utf-8" ></script>  
	<!-- jQuery UI end// -->
	 

	<!-- kindeditor start// -->
	<script type="text/javascript" charset="utf-8" src="static/js/kindeditor/kindeditor-min.js"></script>
	<script type="text/javascript" charset="utf-8" src="static/js/kindeditor/lang/zh_CN.js"></script> 
	<!-- kindeditor end// -->

	<script type="text/javascript" src="static/js/pcasunzip.js"></script>  
	<script type="text/javascript" src="static/js/pinyin.js"></script>  
	<script type="text/javascript" src="static/js/lazyload/jquery.lazyload.min.js"></script> 
	<script type="text/javascript" src="static/js/validform/validform.js" charset="utf-8"></script> 
	<link href="static/js/validform/validform.css" rel="stylesheet" type="text/css" /> 
	<link href="static/js/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />  
	<script type="text/javascript" src="static/js/bootstrap/js/bootstrap.min.js" charset="utf-8"></script> 
	<script src="static/js/datepicker/WdatePicker.js" type="text/javascript"></script> 
	<link href="static/js/font-awesome/css/font-awesome.min.css" rel="stylesheet"> 
	<link href="static/image/style.css" rel="stylesheet" type="text/css" /> 
	<script type="text/javascript" src="static/js/console.js"></script>  

	<script type="text/javascript" src="static/js/ludo-jquery-treetable/jquery.treetable.js"></script> 
	<link rel="stylesheet" href="static/js/ludo-jquery-treetable/css/jquery.treetable.css" />
	<link rel="stylesheet" href="static/js/ludo-jquery-treetable/css/jquery.treetable.theme.default.css" />

	<script type="text/javascript" src="static/js/colorbox/jquery.colorbox.js"></script>
	<link rel="stylesheet" type="text/css" href="static/js/colorbox/colorbox.css" />
	 
	<style type="text/css">
	.ui-dialog-titlebar{ display:none}	
	.ui-dialog{border:10px solid #efefef}
	</style> 
  </head>

  <body style="margin:0px;padding:0px;" onload="autoFrame()"> 
    <div style="display:none">
		<iframe id="frm" name="frm" src="" frameborder="0" scrolling="no" width="0" height="0"></iframe>
	</div>
    <div class="container-fluid" style="padding-top:10px;">
      <div class="row-fluid"> 
        <div class="span12">
            <?
			$view_file = dirname(__FILE__).'/view/'.$cmd;

			if(is_file($view_file)){
				if(is_file($model_file) == true){
					include($model_file);
				}
				include($view_file);
			} else {
				include(dirname(__FILE__).'/view/goods_list.php'); 
			}
			?>
        </div> 
      </div> 
    </div>   
	<script type="text/javascript"> 
	function autoFrame(){  
		if(document.body.scrollHeight>810){
			var newHeight = document.body.scrollHeight + 80 + "px"; 
			window.parent.document.getElementById("frameWin").style.height = newHeight;  
		}
	} 
	</script> 
  </body>
</html>
