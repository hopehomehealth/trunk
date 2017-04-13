<?
if(!defined('IN_CLOOTA')) {
    exit('Access Denied');
}
?>
<!DOCTYPE html>
<html>
<head>
    <?include($g_tpl_dir.'meta.php');?>
    <title><?if($g_console_debug==true) echo $cmd?>会员中心 - <?=$g_sitename?></title>
</head>

<body class="bodybox">

<div class="container clear">

    <div class="w-main" style="z-index:900001;border:1px solid #efefef;background-color:white;">
        <?
        if(req('cmd')==''){
            $uri = "/member/frame.php?cmd=".base64_encode('order.php');
        } else {
            $uri = "/member/frame.php?".$_SERVER["QUERY_STRING"];
        }
        ?>

        <!--		<iframe width="100%" height="800" align="left" id="frameWin" frameborder="0" scrolling="no" src="--><?//=$uri?><!--"> </iframe>-->
        <iframe width="100%" height="800" align="left" id="frameWin" frameborder="0" scrolling="no" src="<?=$uri?>"> </iframe>
    </div>
</div>
<div class="clear"></div>



</body>
</html>
