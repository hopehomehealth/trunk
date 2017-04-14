<?
include(dirname(dirname(__FILE__)).'/config.php');
$is_index = true;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>招商加盟 - <?=$g_sitename?></title>
<link type="text/css" rel="stylesheet" href="images/style.css" /> 
<link type="text/css" rel="stylesheet" href="http://apps.bdimg.com/libs/fontawesome/4.4.0/css/font-awesome.min.css" />
 
</head>
<body> 
<?include('head.php');?>

<div class="main_retail">  
	<div class="ruzhu">
		<div class="liucheng"></div>
		<div class="step_all clearfix">
			<div class="step">
				<div class="shenqing icons_retail"></div>
				<div class="retail_sname">申请加入</div>
				<div class="retail_stip">联系我们<span class="ccc">...</span>提交申请<span class="ccc">...</span>审核通过</div>
			</div>
			<div class="arrow icons_retail"></div>
			<div class="step">
				<div class="xieyi icons_retail"></div>
				<div class="retail_sname">协议签订</div>
				<div class="retail_stip">签订合作<span class="ccc">...</span>双方约定<span class="ccc">...</span>互签协议</div>
			</div>
			<div class="arrow icons_retail"></div>
			<div class="step">
				<div class="chanping icons_retail"></div>
				<div class="retail_sname">产品上线</div>
				<div class="retail_stip">产品准备<span class="ccc">...</span>提交审核<span class="ccc">...</span>产品发布</div>
			</div>
			<div class="arrow icons_retail"></div>
			<div class="joinus">
				<div class="fs14 fonts1" style="margin-bottom:15px;">欢迎加盟<?=$g_sitename?>，共创美好未来！</div>
				<div class="fc2 fs12" style="line-height:20px;">咨询热线：<?=$g_profile['union_tel']?><br />
					咨询邮箱：<?=$g_profile['union_email']?> </div>
				<a href="/member/?cmd=<?=base64_encode('union_join.php')?>" class="joinus_a">加入我们</a> </div>
		</div>
	</div> 
</div>

 
<div class="youshi">
	<div class="youshi_main">
		<div class="left">
			<div class="youshi_bar icons_retail">入驻优势</div>
			<div class="youshi_square">
				<div class="mian icons_retail"></div>
				<div class="youshi_tip">低门槛+高回报</div>
				<div class="youshi_tip_">业内最优政策</div>
			</div>
			<div class="youshi_square">
				<div class="service icons_retail"></div>
				<div class="youshi_tip">7*24小时服务团队</div>
				<div class="youshi_tip_">为消费者和供应商<br />
					进行全方位的服务</div>
			</div>
			<div class="youshi_square">
				<div class="data icons_retail"></div>
				<div class="youshi_tip">强大的数据分析资源</div>
				<div class="youshi_tip_">帮助商家准确定位问题</div>
			</div>
			<div class="youshi_square">
				<div class="jiaoyi icons_retail"></div>
				<div class="youshi_tip">支持多种交易方式</div>
				<div class="youshi_tip_">用户体验至上</div>
			</div>
		</div>
		<div class="mid"></div>
		<div class="right">
			<div class="youshi_bar icons_retail">成功案例</div>
			<div class="case">
				<table>
					<tr>
						<td rowspan="2" width="75"><div class="circle_case1 icons_retail"></div></td>
						<td class="case_title" height="65"><a href="#">“我与<?=$g_sitename?>的这一年”<br />
							———河南旅游集团有限公司</a></td>
					</tr>
					<tr>
						<td class="case_title2">2014年的开始，是以与<?=$g_sitename?>的合作拉开序幕，2014年的结束，是以再与<?=$g_sitename?>续约结束的！河南旅游集团有限公司，是首批获得台。。</td>
					</tr>
				</table>
			</div>
			<div class="case">
				<table>
					<tr>
						<td rowspan="2" width="75"><div class="circle_case2 icons_retail"></div></td>
						<td class="case_title" height="65"><a href="#">“感言”<br />
							———北京神舟国际旅行社集团有限公司</a></td>
					</tr>
					<tr>
						<td class="case_title2">执牛耳 途天下 现年伊始 万象更新 天下大定 人心思安 旅途之丰盛美景 游览要物色尽收 相遇<?=$g_sitename?> 欢欣鼓舞 吾于旅游相遇6年尔。。</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
 <br/><br/>
<div class="main_hezuo" style="height: 350px;display:none">
	<div class="hezuo"></div>
	<div style="width:1200px; margin:0 auto;">
		<div class="part_con part_scroll">
			<div id="scrollBox" class="scroll_pic_box" >
				<ul class="scroll_pic clearfix">
					<li> <a> <img src="images/1.jpg"> </a> <a> <img src="images/2.png"> </a> <a> <img src="images/3.jpg"> </a> </li>
					<li> <a> <img src="images/4.jpg"> </a> <a> <img src="images/5.jpg"> </a> <a> <img src="images/6.jpg"> </a> </li>
					<li> <a> <img src="images/7.png"> </a> <a> <img src="images/8.jpg"> </a> <a> <img src="images/9.png"> </a> </li>
					<li> <a> <img src="images/10.png"> </a> <a> <img src="images/11.jpg"> </a> <a> <img src="images/12.jpg"> </a> </li>
					<li> <a> <img src="images/13.jpg"> </a> <a> <img src="images/14.jpg"> </a> <a> <img src="images/15.jpg"> </a> </li>
					<li> <a> <img src="images/16.jpg"> </a> <a> <img src="images/17.jpg"> </a> <a> <img src="images/18.jpg"> </a> </li>
					<li> <a> <img src="images/19.jpg"> </a> <a> <img src="images/20.jpg"> </a> <a> <img src="images/21.jpg"> </a> </li>
					<li> <a> <img src="images/22.jpg"> </a> <a> <img src="images/23.jpg"> </a> <a> <img src="images/24.jpg"> </a> </li>
					<li> <a> <img src="images/25.jpg"> </a> <a> <img src="images/26.png"> </a> <a> <img src="images/27.png"> </a> </li>
					<li> <a> <img src="images/28.png"> </a> <a> <img src="images/29.jpg"> </a> <a> <img src="images/30.jpg"> </a> </li>
					<li> <a> <img src="images/31.jpg"> </a> <a> <img src="images/32.jpg"> </a> <a> <img src="images/33.png"> </a> </li>
					<li> <a> <img src="images/34.jpg"> </a> </li>
				</ul>
			</div> 
		</div>
	</div>
</div>
 
<?include('foot.php');?>
</body>
</html>