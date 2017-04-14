<link rel="stylesheet" href="/ajax/remodal-1.1/remodal.css">
<link rel="stylesheet" href="/ajax/remodal-1.1/remodal-default-theme.css">
<script src="/ajax/remodal-1.1/remodal.js"></script>
 
<script src="/ajax/kindeditor-4.1.11/kindeditor-all.js" type="text/javascript" charset="utf-8"></script>
<script src="/ajax/kindeditor-4.1.11/lang/zh_CN.js" type="text/javascript" charset="utf-8" ></script>

<script type="text/javascript">  
/// DIY浮动菜单
$(function(){ 
    $(window).scroll(function(){ 
	   box_top = $('#diy_layer').offset().top; 
	   yy = $(this).scrollTop();
	   xx = $(this).width();
	    
	   if ($(this).scrollTop() > 0) { 
			$('#diy_layer').css({"position":"fixed",top:"50px"}); 
	   } else {
			$('#diy_layer').css({"position":"absolute",top:"50px"});
	   }
    })
})  
</script>  

<style type="text/css"> 
*:focus {
	outline: none;
}
#diy_layer {
	position:absolute;
	width:120px; 
	z-index:9100001;
	right: -20px;
	top: 50px;
	background-color:#ff6600;
	line-height:2.5;  
	padding-top:10px;
	padding-bottom:10px;
}   
#diy_layer a{
	font-size:12px;
	font-family:微软雅黑;
	color:white;
} 

.diy-btn {
  display: inline-block;
  *display: inline;
  padding: 4px 12px;
  margin-bottom: 0;
  *margin-left: .3em;
  font-size: 14px;
  line-height: 20px;
  color: #333333;
  text-align: center;
  text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
  vertical-align: middle;
  cursor: pointer;
  background-color: #f5f5f5;
  *background-color: #e6e6e6;
  background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6));
  background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6);
  background-image: -o-linear-gradient(top, #ffffff, #e6e6e6);
  background-image: linear-gradient(to bottom, #ffffff, #e6e6e6);
  background-repeat: repeat-x;
  border: 1px solid #cccccc;
  *border: 0;
  border-color: #e6e6e6 #e6e6e6 #bfbfbf;
  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
  border-bottom-color: #b3b3b3;
  -webkit-border-radius: 4px;
     -moz-border-radius: 4px;
          border-radius: 4px;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff', endColorstr='#ffe6e6e6', GradientType=0);
  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
  *zoom: 1;
  -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
     -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
          box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
}
.diy-btn-info {
  color: #ffffff;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
  background-color: #49afcd;
  *background-color: #2f96b4;
  background-image: -moz-linear-gradient(top, #5bc0de, #2f96b4);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#5bc0de), to(#2f96b4));
  background-image: -webkit-linear-gradient(top, #5bc0de, #2f96b4);
  background-image: -o-linear-gradient(top, #5bc0de, #2f96b4);
  background-image: linear-gradient(to bottom, #5bc0de, #2f96b4);
  background-repeat: repeat-x;
  border-color: #2f96b4 #2f96b4 #1f6377;
  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff5bc0de', endColorstr='#ff2f96b4', GradientType=0);
  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
}
</style> 

 
<script>
  $(document).on('opening', '.remodal', function () {
  });

  $(document).on('opened', '.remodal', function () {
  });

  $(document).on('closing', '.remodal', function (e) {
  });

  $(document).on('closed', '.remodal', function (e) {
  });

  $(document).on('confirmation', '.remodal', function () {
  });

  $(document).on('cancellation', '.remodal', function () {
  });  
</script>


<div id="diy_layer">
	<div style="padding-top:5px;line-height:1.8;padding-left:10px;">
	<a href="<?=$g_host_console?>" target="_blank" style="color:white">返回管理中心</a><br/> 
	<a href="<?=$g_host_console?>do.php?cmd=recreate_block_index&ref=<?=urlencode($g_full_url)?>"  style="color:white" onclick="return confirm('确定重建模块索引吗？请慎重！！！');">重建模块索引</a><br/> 
	<a href="<?=$g_host_console?>?cmd=<?=base64_encode('imagebox.php')?>" target="_blank" style="color:white">替换图片</a><br/> 
	<a href="/?diy=no" style="color:white">退出DIY模式</a>  
	</div>
</div>

<div id="diybox" style="z-index:900000001; display:none"> 
		<?
		$dir = $g_root.'themes/'.$g_tpl ;

		$dir_handle = opendir($dir);

		if($dir_handle)
		{
			$editer_id = '';
			while(($file=readdir($dir_handle))!==false)
			{
				if($file==='.' || $file==='..')
				{
						continue;
				}

				$tmp = realpath($dir.'/'.$file);

				if(!is_dir($tmp))
				{
					$html_flag = substr($file,0,5);

					if($html_flag=='diy.x' || $html_flag=='diy.j'){
						$filemd5 = md5($file);

						$diy_file = $dir.'/'.$file;

						$diy_file_user = $g_root."diy/$g_siteid/$g_tpl/$file";

						if(file_exists($diy_file_user)==true){
							$diy_file = $diy_file_user;
						}
		?>  
		<div class="remodal" data-remodal-id="diy_<?=$filemd5?>" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc" > 
			<form method="post" action="<?=$g_host_console?>do.php?cmd=diy_update&ref=<?=urlencode($g_full_url)?>" style="padding-bottom:20px;">
			    <input type="hidden" name="tpl_name" value="<?=$g_tpl?>">
				<table style="width:100%;font-size:12px;"> 
					<tr>
						<td >
						<b><?=$file?></b>  &nbsp; &nbsp; <b>提示：</b>小心操作，不要随意修改标签，可修改文字
						</td>
					</tr>
					<tr>
						<td>
						<?
						if($html_flag=='diy.j'){ //JS代码
						?>
						<textarea id="content<?=$filemd5?>" name="content<?=$filemd5?>" style="width:100%;height:400px;font-family:'Courier New';padding:5px;color:#009999;font-size:14px;z-index:900000001;"><?include($diy_file)?></textarea>
						<?
						} else {
							$editer_id .= ',#content'.$filemd5;
						?>
						<textarea id="content<?=$filemd5?>" name="content<?=$filemd5?>" style="width:100%;height:400px;visibility:hidden;font-family:'Courier New';font-size:14px;z-index:900000001;"><?include($diy_file)?></textarea> 
						<?}?>
						</td>
					</tr>
					<tr>
						<td align="right" style="padding-top:5px;">
							<input type="hidden" name="filename" value="<?=$file?>">
							<table width="100%">
							  <tr>
								<td><input data-remodal-action="cancel" type="button" value=" 取消 " class="diy-btn" style="width:40px"> 
								</td>
								<td width="80"> 
								&nbsp; &nbsp;
								<input type="button" value=" 恢复 " onclick="if(confirm('确认要恢复原始信息吗？')){location.replace('<?=$g_host_console?>do.php?cmd=diy_recovery&tpl_name=<?=$g_tpl?>&filename=<?=$file?>&ref=<?=urlencode($g_full_url)?>');}" class="diy-btn diy-btn-info">
								</td>
								<td width="80">&nbsp; &nbsp; <input type="submit" value=" 保存 " class="diy-btn diy-btn-info"> 
								</td>
							  </tr>
							</table> 
						</td>
					</tr>
				</table> 
			</form>
		</div>
		<?
					} 
				}
			}
			closedir($dir_handle);
		} 
		?>    

		<script type="text/javascript"> 
		<?
		$editer_id = substr($editer_id,1);
		?>
        KindEditor.ready(function(K) {
            editor = K.create('<?=$editer_id?>', {
                uploadJson : '/portlet/upload_json.php', 
                allowFileManager : false,
				items : [
						'source','fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
						'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
						'insertunorderedlist', '|', 'emoticons', 'image', 'link'],
                afterCreate : function() {
                    var self = this;
                    K.ctrl(document, 13, function() {
                        self.sync();
                    });
                    K.ctrl(self.edit.doc, 13, function() {
                        self.sync();
                    });
                },afterBlur: function(){this.sync();}
            });
            prettyPrint();
        });

		</script> 
</div>

 