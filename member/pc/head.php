<?
include($g_site_root.'/member/dialog.html'); 
?>
<?
if($g_config['site_notice']!='' && $is_index==true){
?>
<div class="top-notice">
	<div class="ota-container" style="text-align:center;color:red;">  
		<?=$g_config['site_notice']?> 
	</div>
</div>
<?}?>
<link rel="stylesheet" type="text/css" href="/themes/s01/images/common.css">
<div id="headbox">  
	<!-- <div id="ota-topnav">
		<div class="ota-container">
			<ul class="topnav-login"> 
				<script type="text/javascript" src="/ajax@login.status"></script>
			</ul>
			<ul class="topnav-list">  
				<li><a class="toplink" href="<?=$g_domain?>member/?cmd=<?=base64_encode('buycart.php')?>">��Ա����</a></li> 
				<li><a class="toplink" href="/help/">�û�����</a></li>  
				<li><a class="toplink" href="javascript:addfavorite()">�����ղ�</a></li> 
				<?
				if(in_array($g_sys_version, array('B', 'C'))){ 
				?>
				<li><a class="toplink" href="/seller/" target="_blank">�̼�����</a></li>
				<li><a class="toplink" href="http://b2b.cloota.com/" target="_blank">B2B����ϵͳ</a></li>
				<?
				}
				?>
				<li class="last">&nbsp; <b style="color:#ff6600">�� <?=$g_start_city?>ʮ��������վ</b></li>
			</ul>
		</div>
	</div> --> 
 
	<!-- <div class="hd-wrap ota-container">
		<div class="hd-logo"> <a href="<?=$g_domain?>"> <img src="/images/logo.png" alt="<?=$g_sitename?> <?=$g_page_title?>"></a>
			<h1><?=$g_sitename?></h1>
		</div> 
		
		<?
		if(in_array($g_sys_version, array('C'))){
		    $all_site = get_site();
			if(sizeof($all_site)>1){  
		?>
		<div class="hd-city">  
			<div class="city-change">
				<div class="city-site"> <i class="icon-head hdico-map"></i> <span id="citysite"><?=$g_config['city_name']?></span> </div> 
				<a id="change-city" class="change-link" href="javascript:void(0)">����<i class="icon-head hdico-dropdown"></i></a> </div>
			<div class="city-text"><span class="city-site"></span></div>

			<div class="city-sub">
			<? 
			foreach ($all_site as $val){ 
			?>
			<a href="http://<?=$val['site_domain']?>" title="<?=$val['city_name']?>"><?=$val['city_name']?></a>
			<? 
			}
			?> 
			</div>
		</div> 
		<?
		    }
		}
		?>
 
		<div class="hd-search" id="search">
			<div class="search-classify">   
				<a class="search-classify-link" href="javascript:void(0)"> <span data-type="0" class="cat-select">ȫ����Ʒ</span> <i class="icon-head hdico-dropdown"></i> </a>
				<ul class="drop-down-list">
					<?  
					foreach ($g_product_type as $k => $v) { 
				    ?>
					<li data-type="<?=$k?>" <?if(req('goods_type')==$k){?>class="cat-select"<?}?> ><a href="javascript:void(<?=$k?>)"><?=$v?></a></li>
				    <?     
				    }
				    ?>  
				</ul>
			</div>
			<input type="text" placeholder="��������..." class="input-text" name="keywords" value="<?=req('keywords')?>"/>
			<div class="hd-sokey"> 
			<?
			// ���ƹؼ���
			$hot_keywords = explode("\n", $g_misc['search_keywrods']);
			if(notnull($hot_keywords)){
				foreach ($hot_keywords as $v) {
			?>
			<a title="<?=$v?>" href="/search?keywords=<?=$v?>" > <?=$v?> </a>
			<?
				}
			}
			?>  
			</div>
			 
			<a id="btn-search" class="hd-sobtn" href="javascript:void(0)"><i class="icon-head hdico-search"></i></a> </div>

			<div class="ad"><?include(load_user_diy('diy.x01.html'));?></div>
	</div> -->
	<!--  head  start -->
	<div id="topBox">
		<div class="topAbove">
			<div class="topAboveCont">
				<div class="topAboveCont_left">
					<span id="topTime">2017��01��18��&nbsp;&nbsp;������&nbsp;&nbsp;</span>
					<span id="topAddress">
						<span>����[<a href="" class="currentCity">������</a>]ר��</span>&nbsp;&nbsp;
						<a href="http://www.bus365.com/city0" id="changeCity">[�л�����]</a>
					</span>
				</div>
				<div class="topAboveCont_right">
					<div class="top_phoneApp">
						<span>�ֻ�APP</span>
						<img src="/themes/s01/images/appScan.jpg">	
					</div>
					<div class="top_wechat">
						<span>΢��</span>
						<img src="/themes/s01/images/wechatScan.jpg">	
					</div>
				</div>
			</div>
		</div>
		<div id="top">
			<div class="topLeft">
				<a href="http://www.bus365.com" class="logo">
					<img src="/themes/s01/images/logo.png">
				</a>
				<a href="http://www.bus365.com" class="logo_text">
					<img src="/themes/s01/images/logowww.png">
				</a>
			</div>
			<div class="topCenter">
				<div class="topCenter_l">
					<span>ȫ����Ʒ</span>
					<ul>
						<li>������Ʊ</li>
						<li>�ܱ���</li>
					</ul>
				</div>
				<div class="topCenter_c">
					<input type="text" name="������Ŀ�ĵ�/��Ʒ����" placeholder="������Ŀ�ĵ�/��Ʒ����">
				</div>
				<div class="topCenter_r">
					<button>����</button>
				</div>
			</div>
			<div class="topRight">
				<div class="hotline">
					ȫ���ͷ�����<br/>
					<span>400-08-84365<br>400-99-84365</span>
				</div>
			</div>
		</div>
	</div>
	<!-- head  end -->

	<!--  nav����  start -->
	<div id="navBox">
		<div id="nav">
			<div class="navLeft">
				<ul>
					<li class=""><a href="">��ҳ</a></li>
					<li><a href="">����Ʊ</a></li>
					<li><a href="">�ɻ�Ʊ</a></li>
					<li><a href="">��Ʊ</a></li>
					<li style="position: relative;" class="trip_list_btn nav_hover">
						<a href="" style="width: 100%;height: 50px;">����</a>
						<ul class="trip_list hide">
							<li><a href="">������</a></li>
							<li><a href="/zhoubian/">�ܱ���</a></li>
							<li><a href="">������</a></li>
							<li><a href="">��Ʊ</a></li>
							<li><a href="">����</a></li>
							<li><a href="">����</a></li>
						</ul>
					</li>
					<li><a href="">�Ƶ�</a></li>
					<li><a href="">�ó�</a></li>
					<li><a href="">�ֻ���</a></li>
				</ul>
			</div>
			<div class="navRight">
				<div class="mybus365">
					<a href="" id="mybus365_btn">�ҵ�Bus365</a>
					<ul class="before_login hide">
						<li><a href="">�ҵĶ���</a></li>
						<li><a href="">�ǻ�Ա����</a></li>
					</ul>
					<ul class="after_login hide">
						<li>
							<a href="">�ҵĶ���</a>
						</li>
						<li>
							<a href="">��֧������</a>
						</li>
						<li>
							<a href="">�˳�������</a>
						</li>
						<li>
							<a href="">��Ա��Ϣ</a>
						</li>
						<li>
							<a href="">��Ա��ȫ</a>
						</li>
						<li>
							<a href="">���ó˳���ϵ�˹���</a>
						</li>
						<li>
							<a href="">�ҵ��Ż�ȯ</a>
						</li>
						<li>
							<a href="javascript:void(0)">�˳���¼</a>
						</li>
					</ul>
				</div>
				<div class="loginAndReg">
					<a href="">��¼</a>|<a href="">ע��</a>
				</div>
			</div>
		</div>
	</div>
	<!--  nav����  end -->

 
	<div id="hd-mainnav">
		<div class="ota-container">   
			<div class="nav-main-classify"> <a class="classify-link" href="javascript:void(0)"><!-- <i class="icon-head hdico-classify"> --></i>ȫ�����β�Ʒ����</a>
				<ul class="classify-list">
					<?include('index.hotspot.php');?> 
				</ul>
			</div>
			
			<!-- ���β�Ʒ���� /-->
			
			<ul class="nav-list">
				
				<!-- ������ -->  
				<?
				$menu01 = get_menu('0', 10);  
				if(notnull($menu01)){ 
					$m=1;
					foreach ($menu01 as $val){  
						$menu_url = str_replace('{domain}', $g_domain, $val['url']);

						$menu02 = get_menu($val['menu_id'],20); 
				?>
				<li class="n<?=$m?>"><a href="<?=$menu_url?>" target="<?=$val['target']?>" style="<?=$val['css']?>" class="nav-link"><?=$val['title']?><?if(notnull($menu02)){?><i class="icon-head arrows"></i><?}?></a>
					<?if(notnull($menu02)){?>
					<div class="nav-sublist">
						<div class="ota-container">
							<div class="nav-subitem ">
							<?  
							foreach ($menu02 as $cval){  
									$child_menu_url = str_replace('{domain}', $g_domain, $cval['url']);
							?>
							<a href="<?=$child_menu_url?>" target="<?=$cval['target']?>" style="<?=$cval['css']?>"><?=$cval['title']?></a>
							<?  
							}
							?>
							</div>
						</div>
					</div>
					<?}?>
				</li>
				<?
					$m++;
					}
				}
				?>  
			</ul>
			<!-- ������ --> 
			
		</div>
	</div>
	<!-- ���� /--> 
</div> 

<script src="/themes/s01/images/sea.js"></script> 
<script src="/themes/s01/images/base.js"></script> 
<script src="/themes/s01/images/config.js"></script>
<script src="/themes/s01/images/common.js"></script>
<script language="javascript">
    var cityObj = {"HOT":{"index":[],"\u534e\u4e1c":[{"key":"SHA","val":"�Ϻ�","PY":"SHANGHAI","JP":"SH"}],"\u534e\u5317":[{"key":"PEK","val":"\u5317\u4eac","PY":"BEIJING","JP":"BJ"},{"key":"TSN","val":"\u5929\u6d25","PY":"TIANJIN","JP":"TJ"}],"\u534e\u5357":[{"key":"CAN","val":"\u5e7f\u5dde","PY":"GUANGZHOU","JP":"GZ"},{"key":"SZX","val":"\u6df1\u5733","PY":"SHENZHEN","JP":"SZ"}],"\u897f\u5357":[{"key":"CKG","val":"\u91cd\u5e86","PY":"CHONGQING","JP":"CQ"}]},"A":{"B":[{"key":"PEK","val":"\u5317\u4eac","PY":"BEIJING","JP":"BJ"}],"C":[{"key":"CKG","val":"\u91cd\u5e86","PY":"CHONGQING","JP":"CQ"}],"G":[{"key":"CAN","val":"\u5e7f\u5dde","PY":"GUANGZHOU","JP":"GZ"}]},"N":{"S":[{"key":"SHA","val":"\u4e0a\u6d77","PY":"SHANGHAI","JP":"SH"},{"key":"SZX","val":"\u6df1\u5733","PY":"SHENZHEN","JP":"SZ"}],"T":[{"key":"TSN","val":"\u5929\u6d25","PY":"TIANJIN","JP":"TJ"}]}};
    var now_city="SZX"; 

    seajs.use(['jquery', 'handlebars', 'header', 'livequery', 'rightSide'], function ($, hlb, header, livequery, rightSide) {
        header.init();
        rightSide.init();
    });
</script>