<!DOCTYPE html>
<html>
<head>
<?include('meta.php');?>
<?seo();?> 
<?include('static.php');?>
<link rel="stylesheet" type="text/css" href="/images/detail.css">   
</head>

<body class="bodybox"> 
<?include('head.php');?> 
<div class="container">
	<ul class="breadcrumbs">
		<li class="item"><a href="<?=$g_domain?>">首页</a><span>&gt</span></li>
		<li class="item current"><a href="/jifen/">积分商城</a> <span>&gt;</span></li> 
		<li class="item current"><?=$c_goods['goods_name']?></li>

		
		<?
		/// 编辑的快捷方式
		$is_edit = false;
		if($_COOKIE['CLOOTA_B2B2C_ADMIN_UUID']!=''){
			$is_edit = true;
			$edit_dir = 'console';
		}
		if($_COOKIE['CLOOTA_B2B2C_SHOP_UUID']!=''){
			if($_COOKIE['CLOOTA_B2B2C_SHOP_UUID'] == $c_goods['shop_id']){
				$is_edit = true;
				$edit_dir = 'seller';
			}
		}
		?>
		<?if($is_edit == true){?>
		<a href="/<?=$edit_dir?>/?cmd=<?=base64_encode('goods_add.php')?>&cat_id=<?=$c_goods['cat_id']?>" target="_blank" style="color:#ffffff;font-size:12px;float:right;background-color:#ff3300;padding:5px;"> 新增 </a>
		<a href="/<?=$edit_dir?>/?cmd=<?=base64_encode('goods_edit.php')?>&goods_id=<?=$c_goods['goods_id']?>" target="_blank" style="color:#ffffff;font-size:12px;float:right;background-color:#ff3300;padding:5px;margin-right:5px;"> 编辑 </a>
		<?}?>

	</ul>
	<!-- 主体内容区 -->
	<div class="lv-detail wrap" style="min-height:auto;"> 
		<!-- slider and date -->
		<div class="detail-left">  
			<div class="detail-slider" style="height:370px;overflow:hidden;">
				<ul class="bigpic gallery" style="height:auto">
					<li class="gallery-item active"> <a href="javascript:void(0)"> <img src="<?=$c_goods_image?>" alt=""style="width:550px;height:auto"> </a> </li> 
				</ul> 
			</div>
			 
		</div>
		<!-- right info -->
		<div class="detail-info">
			<div class="detail-title"> 
				<?=$c_goods['goods_name']?> 
				<?if($c_goods['is_sale']=='0'){?>
				<i style="color:#999">【已下架】</i>
				<?}?>
				<?if($c_goods['is_sale']=='1'){?>
				<?if($c_goods['is_hot']=='1'){?><i class="tag-btn">热卖</i><?}else{?> <i class="tag-btn">新上线</i><?}?>
				<?}?>
			</div>
			<div class="d-con">
				<div class="d_row gray-c">
					市场价：<del>&yen;<?=$c_goods['market_price']?></del> 
					&nbsp;&nbsp;&nbsp;&nbsp;
					<span class="yellow-a">【编号：<?=$c_goods['goods_code']?>】</span>
				</div>
				<div class="d_row gray-c d_price">积分
					<span class="yellow-a"><i> </i> <em><?=$c_goods['score_number']?></em> </span> 
				</div>   
				<div>
				<?=stripslashes($c_goods['summary'])?>
				</div>
				
				<dl class="d-code" > 
					<dd> 
						<img src="<?=$g_sys_home?>/qr/?v=<?=$g_full_url?>" style="width:94px;height:94px" title="微信扫描二维码">  
					</dd>
				</dl>

			</div> 

			<span id="order_span">
				<br/><br/>
				<a href="javascript:void(0);" onclick="return order_window()" class="btn btn-lg" id="order_button">立即兑换</a> 
			</span>
			<script type="text/javascript">
			function order_window(){
				var url="";
				url = "/member/?cmd=<?=base64_encode('score_checkout.php')?>";
				url += "&goods_id=<?=$c_goods['goods_id']?>"; 
				window.top.location.href = url; 
			}
			</script>
			
		</div>
		<div class="bdsharebuttonbox" style="margin-top:30px"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a></div>
		<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"32"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
 
		<div class="clear"></div>
	</div>
	 
 
<div class="container">
	<div class="detail-main"> 
		<!-- 猜你喜欢 -->
		<div class="detail-aside wrap">
			<div class="aside-title">相关产品</div>
			<ul class="detail-asidelike">
				<?
				$guess_list = get_guess_list(6);
				if(notnull($guess_list)){ 
					foreach ($guess_list as $val){
						$goods_image = "/upfiles/$g_siteid/".$val['goods_image'];
						
				?> 
				<li> <a id="pro-like-img" target="_blank" href="/product/detail-<?=$val['goods_id']?>.html"><img src="<?=$goods_image?>" alt="<?=$val['goods_name']?>" class="imgbox"></a>
					<div class="tname"><a id="pro-like-title" target="_blank" href="/product/detail-<?=$val['goods_id']?>.html"><?=$val['goods_name']?></a></div>
					<div class="yellow-a"><sub>&yen;</sub> <span class="font14"><?=$val['real_price']?></span> 起/人</div>
				</li> 
				<?
					}
				}
				?> 
			</ul>
		</div>
		<!-- 详细内容 -->
		<div class="wrap detail-content" style="margin-top:20px">
			
		<!-- 行程推荐 -->
		<div id="itinerary" class="toscroll"> 
			<div class="detail-h2" style="border-top:0px"><i class="lv-icon ico-h21">&nbsp;</i>详细描述</div>
			<!--<div class="detail-h2"><i class="lv-icon ico-h26">&nbsp;</i>行程介绍</div> -->
			 
			<div class="detail-article no-border">
				<?=stripslashes($c_goods['content'])?> 
			</div>  
		</div> 
	</div> 
</div>

<!-- 航班弹出层 -->
<div style="_height:900px;display: none" class="mask"><!-- 弹层遮罩 IE6兼容请通过JS判断整个页面的高度并添加样式 --></div>
 


</div>
<input id="productType" type="hidden" value="2">
<input id="p_status" type="hidden" value="2">

</div>
<!--js--> 
<script>
    seajs.use(["freeproduct", 'comment', 'yoslide'], function (product, comment, yoslide) {
        $(function () {
            product.init({
                remoteGetData: function () {
                    var data = {}, newdata = {};
                    data.productId = productID;
                    newdata.data = JSON.stringify(data);
                    return newdata;
                },
                holiday: ["2015-04-05", "2015-05-01", "2015-06-20", "2015-09-27", "2015-10-01"],
                cal4proBuildLink: function (id, date, isToday, isLowest, isFestval) {
                    return "javascript:;"
                }
            });
            //110882
            comment.getData(productID, 1, 5, function (data) {comment.init(data);});
        });

        //左侧轮播
        yoslide.slide();

    });
</script>
<div class="clear"></div>
<?include('foot.php');?>
</body>
</html>
