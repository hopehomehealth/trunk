<?   
$sql = "SELECT * FROM `t_site_connect` WHERE `site_id`='".$g_siteid."' ";  
$myconnect = $db->get_one($sql); 

if($myconnect['connect_id']!=''){
?>
<iframe id="connect_member" src="" width="0" height="0" style="display:none"></iframe>
<script language="javascript"> 
function call_do(frm_src){
	document.getElementById("connect_member").src = frm_src+'&rnd='+Math.random();
}
</script>
<table style="padding:0px;margin:0px;">
  <tr>
    <?if($myconnect['qq_appid']!=''){?>
	<td>
		<!-- QQ LOGIN START -->  
		<span id="qqLoginBtn"></span>
		<script type="text/javascript">
		QC.Login({
			   btnId:"qqLoginBtn",
			   size: "A_M"
		});
	 
		var paras = {}; 
		QC.api("get_user_info", paras) 
			.success(function(s){ 
				if(QC.Login.check()){ 
					  QC.Login.getMe(function(openId, accessToken){ 
						  var dourl = '/member/connect.php?ac=connect&nick='+s.data.nickname+'&reg_type=QQ&open_id='+openId;   
						  call_do(dourl);
					  }); 
				 }  
			}) 
			.error(function(f){ 
			}) 
			.complete(function(c){ 
			});
		</script>   
		<!-- QQ LOGIN END //-->
	</td>
	<?}?>
	<?if($myconnect['sina_appid']!=''){?>
	<?if($connect_show=="v"){echo '<tr>';}?>
	<td> 
		<!-- WEIBO LOGIN START -->  
		<wb:login-button type="3,2" onlogin="wb_login" onlogout="wb_logout">µÇÂ¼°´Å¥</wb:login-button>
		  
		<script language="javascript"> 
		function wb_login(o){ 
			var dourl = '/member/connect.php?ac=connect&nick='+o.screen_name+'&reg_type=SINA&open_id='; 
			call_do(dourl);
		}
		function wb_logout(){
			//alert('logout');
		}  
		</script>
		<!-- WEIBO LOGIN END //--> 
	</td>
	<?}?>
	<?if($myconnect['taobao_appid']!=''){?>
	<?if($connect_show=="v"){echo '<tr>';}?>
	<td>
		<!-- TAOBAO LOGIN START -->  
		<div class="top-login-btn-container"></div>
		<script language="javascript"> 
			TOP.ui("login-btn", {
			  container:".top-login-btn-container",
			  type:"3,4",
			  callback:{
				 login:function(user){ 
					 var dourl = '/member/connect.php?ac=connect&nick='+user+'&reg_type=TAOBAO&open_id='; 
					 call_do(dourl);
				 },
				 logout:function(){}
			}
			});
		</script>
		<!-- TAOBAO LOGIN END //-->
	</td>
	<?}?>
</tr>
</table>
<?}?>