<!DOCTYPE html>
<html>
<head>
<?include('meta.php');?>
<?////seo()?>
<?include('static.php');?> 
<link rel="stylesheet" type="text/css" href="/images/visa.css">
</head>

<body class="bodybox" style="background-color:white">
<?include('head.php');?> 
<?
$ad_list = get_ad('QZ');
?>
<style type="text/css">
.flex-active{margin-top:-30px;z-index:1000000;}
</style>
<div class="flexslider" style="width:100%;height:290px;overflow:hidden;">
	<ul class="slides">
		<?  
		if(notnull($ad_list)){  
			foreach ($ad_list as $val){    	 
		?> 
		<li>
		<div style="background-image:url(/upfiles/<?=$g_siteid.'/'.$val['ad_image']?>?v=<?=date('YmdHis')?>);background-position: center;background-repeat: no-repeat; height:290px" onclick="window.open('<?=$val['ad_url']?>')"></div> 
		</li> 
		<? 
			}
		}  
		?>  
	</ul>
</div>
<script type="text/javascript">
//	$(function() {
		$(".flexslider").flexslider({
			slideshowSpeed: 4000, //չʾʱ����ms
			animationSpeed: 400, //����ʱ��ms
			touch: true //�Ƿ�֧�ִ�������
		});
//	});	
</script>

<div class="g-main visa-channel-index" style="margin-top:-40px"> 
	<div class="main-inner">  
		<div class="m-query-info">
			<div class="query-process" style="height:226px">
				<div class="box-top">
					<div class="info-satis">
						<h5>100<span>%</span></h5>
						<p>ǩ֤�ɹ���</p>
					</div>
					<div class="info-count">
						<h5><?=$count_visa_order?></h5>
						<p>����ǩ֤��</p>
					</div>
				</div>
 
				<form method="get" action="/search" id="f_1" target="_blank">
					<input type="hidden" name="goods_type" value="3">
					<div class="box-bottom">
					<label for="">ǩ֤�����ѯ</label>
					<div class="J_DepartCity search_ctrl search_ctrl_inp search_ctrl_city input-field">
						<input type="text" name="keywords" class="search_visa_in search_ctrl_inp_input" autocomplete="off" placeholder="�磺����">
						<a href="javascript:$('#f_1').submit();" class="search_submit_btn">����</a> </div>
				</div>
				</form>
				<form method="get" action="/news/" id="f_2" target="_blank">
				<input type="hidden" name="cat_key" value="shiguan">
				<div class="box-bottom">
					<label for="">�����Ϣ��ѯ</label>
					<div class="J_DepartCity search_ctrl search_ctrl_inp search_ctrl_city input-field">
						<input type="text" name="keywords" class="search_visa_in search_ctrl_inp_input" autocomplete="off" placeholder="�磺����">
						<a href="javascript:$('#f_2').submit();" class="search_submit_btn">����</a> </div>
				</div>
				</form>
			</div>
			<div class="deal-process">
				<h3>ǩ֤��������</h3>
				<img src="/images/visa_process.jpg" alt="" style="width:889px"> </div>
		</div>
		 
		<!-- floor start -->
		<div class="m-section">
			<h2 class="section-title"> <span>����<em>�ػ�</em></span> </h2>
			<div class="section-content">
				<ul class="promotion-list">
					<? 
					if(notnull($hot_visa_rows)){ 
						 foreach ($hot_visa_rows as &$val) {
							 $goods_url = get_goods_url($val['cat_key'], $val['goods_id']);
					?>
					<li class="list-item" title="<?=$val['goods_name']?>">
						<div class="country-flag"> <a target="_blank" href="<?=$goods_url?>"><img src="/static/image/flags/<?=$val['visa_zone_id']?>.jpg"></a> </div>
						<div class="visa-info"> <a target="_blank" href="<?=$goods_url?>">
							<h5><?=$val['goods_name']?></h5>
							</a>
							<p class="visa-type">ǩ֤</p>
							<p class="visa-price">&yen;<em><?=$val['real_price']?></em></p>
						</div>
					</li>
					<?
						 }
					}
					?> 
				</ul>
			</div>
		</div>
		<a name="type"></a>
		<div class="m-section J_hot_visas">
			<h2 class="section-title"> <span>ǩ֤<em>����</em></span> </h2>
			<!--
			<div class="visa-tags">
				<ul>
					<a href="/qianzheng/t1#type"><li class="cur">��������</li></a>
					<a href="/qianzheng/t2#type"><li class="">̽�׷���</li></a>
					<a href="/qianzheng/t3#type"><li class="">����칫</li></a>
				</ul>
			</div>
			-->
			<div class="section-content">
				<ul class="visa-list" style="display: block;">
					<? 
					if(notnull($visa_zone_rows)){ 
						 foreach ($visa_zone_rows as &$val) {  
					?>
					<li>
						<div class="country-flag"> <a target="_blank" href="/qianzheng/zone-<?=$val['zone_id']?>.html"><img src="/static/image/flags/<?=$val['zone_id']?>.jpg" alt=""></a><br/><?=$val['zone_name']?> </div> 
					</li>
					<?
						 }
					}
					?> 
				</ul> 
				<div style="clear:both"><br/><br/></div>
			</div>
		</div>
		<!-- floor end --> 
		
		<!-- qa start -->
		<div class="m-visa-qa" style="display:none">
			<div class="box-left"> <span class="visa-icon icon-questions"> </span>
				<div class="questions-block">
					<h3>ǩ֤���� <a href="/help/list/162" class="btn-more">����&gt;</a></h3>
					<ul>
						<li>
							<h5>Q: ʲô��ǩ֤</h5>
							<p>A: ǩ֤��һ����Ȩ���ҷ����������ù����������򱾹�����t�ĳ��뾳���...</p>
						</li>
						<li>
							<h5>Q: ǩ֤�Ƿ��ܱ�֤ͨ����</h5>
							<p>A: ���е�ǩ֤�����ܱ�֤ͨ�������Ǹ��ݿ����Լ��ṩ�Ĳ�����ʹ��ȥ�����Ƿ�...</p>
						</li>
						<li>
							<h5>Q: ����������߳�ǩ��</h5>
							<p>A: ����ǩ֤֮ǰһ��Ҫ׼������ϸ��ʵ��ǩ֤���ϣ����⣬�����ϸ������ĳ�...</p>
						</li>
					</ul>
				</div>
			</div>
			<div class="box-right"> <span class="visa-icon icon-comments"></span> <span class="visa-icon icon-circle-up"></span> <span class="visa-icon icon-circle-down"></span>
				<div class="comments-block">
					<h3>���µ���</h3>
					<ul>
						<li>
							<h5>6***9 <span class="time">2016��07��24��</span></h5>
							<p>;ţ��ǩ֤�ǳ���ݣ��۸�Ҳ...</p>
						</li>
						<li>
							<h5>6***6 <span class="time">2016��07��24��</span></h5>
							<p> �ܲ����ܺúܿ�ܷ��㡣...</p>
						</li>
						<li>
							<h5>��***�� <span class="time">2016��07��24��</span></h5>
							<p>�ܷ��㣬ȥ�ɽ�·�����ѻ�...</p>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- qa end --> 
	</div>
</div>
<div class="clear"></div>
<?include('foot.php');?>
</body>
</html>
