<?
include(dirname(dirname(__FILE__)).'/config.php');
$is_info = true;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>加盟流程 - <?=$g_sitename?></title>
<link href="images/style.css" rel="stylesheet" type="text/css"> 
<link type="text/css" rel="stylesheet" href="http://apps.bdimg.com/libs/fontawesome/4.4.0/css/font-awesome.min.css" />

<style>
.fl{float:left}
</style>
</head>
<body style="background-color:white"> 
<?include('head.php');?>
 
<div class="pagebody">
	<div class="four_steps"> <img src="images/four_steps.jpg" alt="" usemap="#planetmap" />
		<map name="planetmap">
			<area href="#xz" shape="circle" coords="42,42,42">
			</a>
			<area href="#bz" shape="circle" coords="289,42,42">
			</a>
			<area href="#zc" shape="circle" coords="534,42,42">
			</a>
			<area href="#que" shape="circle" coords="778,42,42">
			</a>
		</map>
	</div>
	<div class="common_step">
		<div class="allsteps">
			<hr class="" />
			<h3 id="xz">入驻须知</h3>
		</div>
		<div class="cs_content">
			<dl class="clearfix">
				<dt><span>1</span></dt>
				<dd><?=$g_sitename?>暂未授权任何机构进行代理招商服务，入驻申请流程及相关的收费说明均以官方招商页面为准。</dd>
			</dl>
			<dl class="clearfix">
				<dt><span>2</span></dt>
				<dd><?=$g_sitename?>有权根据包括但不仅限于业务范围需求、公司经营状况、服务水平等其他因素退回客户申请；同时<?=$g_sitename?>有权在申请入驻及后续经营阶段要求客户提供其他资质；<?=$g_sitename?>将结合各行业发展动态、国家相关规定及消费者购买需求，不定期更新招商标准。</dd>
			</dl>
			<dl class="clearfix">
				<dt><span>3</span></dt>
				<dd>请务必确保您申请入驻及后续经营阶段提供的相关资质的真实性（若您提供的相关资质为第三方提供，如授权书等，请务必先行核实文件的真实有效性），一旦发现虚假资质，您的公司将被列入非诚信客户名单，<?=$g_sitename?>将不再与您进行合作。</dd>
			</dl>
			<dl class="clearfix">
				<dt><span>4</span></dt>
				<dd><?=$g_sitename?>暂不接受个体工商家的入驻申请，商家须为正式注册企业。</dd>
			</dl>
			<p class="align_right">（请认真阅读入驻须知，便于您更好的入驻<?=$g_sitename?>）</p>
		</div>
	</div>
</div>
<div class="long_bg grey_bgcolor">
	<div class="common_step">
		<div class="allsteps">
			<hr class="" />
			<h3 id="bz">入驻标准</h3>
		</div>
		<div class="cs_content clearfix">
			<div class="csc_left ">
				<p class="csc_level">资质要求:</p>
				<ul class="detail_list">
					<li>旅行社经营许可证副本复印件</li>
					<li>企业营业执照副本复印件（需完成有效年检，同时营业执照中经营范围需包含所售产品）</li>
					<li>旅行社责任险</li>
					<li>企业税务登记证复印件（国税、地税均可）；</li>
					<li>组织机构代码证复印件；</li>
					<li>开户许可证复印件</li>
					<li>企业法人身份证正反复印件；</li>
					<li>联系人身份证正反复印件。</li>
					<li>企业logo，尺寸：宽：146PX、高：60 PX</li>
					<li>电子合同章、业务章</li>
				 
				</ul>
			</div>
			<div class="csc_right">
				<p class="csc_level">保证金与资费组成：</p>
				<ul class="detail_list">
					<li>
						<p class="dl_level"> 保证金：<?=$g_sitename?>经营必须交纳保证金，保证金主要用于保证商家按照<?=$g_sitename?>的规范进行经营，并且在商家有违规行为时根据《平台合作协议文本》及相关规则规定用于向<?=$g_sitename?>及消费者支付违约金。保证金1万元。 </p>
					</li>
					<li class="tec_detail">技术服务费年费：2015年政策参照商家入驻页面《<?=$g_sitename?>零售平台技术服务协议》</li>
					 
				</ul>
			</div>
		</div>
	</div>
</div>
 
<div class="long_bg">
	<div class="common_step">
		<div class="allsteps">
			<hr class="" />
			<h3 id="zc">政策咨询</h3>
		</div>
		<div class="cs_content clearfix"> 
			<div class="cs_detail clearfix">  
				<table width="100%" class="contact_table"> 
						<tr bgcolor="#efefef">
							<td><strong>地区</strong></td>
							<td><strong>联系人</strong></td>
							<td><strong>电话</strong></td>
							<td><strong>E-Mail</strong></td>
						</tr> 
						<tr>
							<td>上海、江苏、浙江、安徽、福建、江西、山东、辽宁、吉林、黑龙江</td>
							<td>李小姐</td>
							<td>021-12345678</td>
							<td>union1@yourdomain</td>
						</tr>
						<tr>
							<td>北京、天津、河北、山西、内蒙、河南、湖北、湖南</td>
							<td>谷小姐</td>
							<td>021-12345678</td>
							<td>union2@yourdomain</td>
						</tr>
						<tr>
							<td>广东、广西、海南、重庆、四川、贵州、云南、西藏、陕西、甘肃、青海、宁夏、新疆</td>
							<td>董小姐</td>
							<td>021-12345678</td>
							<td>union3@yourdomain</td>
						</tr> 
				</table>
			</div>
		</div>
	</div>
</div>
 
<div class="long_bg grey_bgcolor common_prob" id="que">
	<p class="cpm_icon"></p>
	<div class="common_step">
		<div class="common_problem">
			<div class="cpm_cont"> 
				<!-- Q1 -->
				<dl class="clearfix">
					<dt class="cpm_1"><span></span></dt>
					<dd class="cpm_2">
						<p class="cpm_tt">什么样的商家可以入驻<?=$g_sitename?>？</p>
						<p class="cpm_box">零售平台目前接受全国具有赴台资质的旅行社入驻</p>
					</dd>
				</dl>
				<!-- Q2 -->
				<dl class="clearfix">
					<dt class="cpm_1"><span></span></dt>
					<dd class="cpm_2">
						<p class="cpm_tt"><?=$g_sitename?>是否支持跨类目经营？</p>
						<p class="cpm_box">目前第三方零售平台只支持售卖台湾产品</p>
					</dd>
				</dl>
				<!-- Q3 -->
				<dl class="clearfix">
					<dt class="cpm_1"><span></span></dt>
					<dd class="cpm_2">
						<p class="cpm_tt">哪些情况会被<?=$g_sitename?>限制入驻？</p>
						<p class="cpm_box">出现严重违规、资质造假情况被<?=$g_sitename?>清退的，将被永久限制入驻；</p>
					</dd>
				</dl>
				<!-- Q4 -->
				<dl class="clearfix">
					<dt class="cpm_1"><span></span></dt>
					<dd class="cpm_2">
						<p class="cpm_tt">如果卖家申请未通过审核，所寄材料是否退还？</p>
						<p class="cpm_box">目前只接收线上入驻申请，需提供电子资料，不需寄送纸质资料，如果寄送则不退回</p>
					</dd>
				</dl>
				<!-- Q5 -->
				<dl class="clearfix">
					<dt class="cpm_1"><span></span></dt>
					<dd class="cpm_2">
						<p class="cpm_tt">从开始入驻，到正式开始销售，大概需要多少天？</p>
						<p class="cpm_box">赴台社线上提交入驻申请及资料，且资料完整，符合入驻标准及要求，一般3个工作日通过审核，入驻申请通过且成功缴纳相关费用后，即可开始上传产品开始销售；</p>
					</dd>
				</dl>
				<!-- Q6 -->
				<dl class="clearfix">
					<dt class="cpm_1"><span></span></dt>
					<dd class="cpm_2">
						<p class="cpm_tt">保证金是否可以降低？</p>
						<p class="cpm_box">不可以</p>
					</dd>
				</dl>
				<!-- Q7 -->
				<dl class="clearfix">
					<dt class="cpm_1"><span></span></dt>
					<dd class="cpm_2">
						<p class="cpm_tt">商家做满一年后不再继续合作，保证金多久可以退回？如果未做满一年是否会从保证金中扣取违约金？</p>
						<p class="cpm_box">商家退店完成后，保证金将于3个月后退还；提前停止合作，质保金不会扣除。</p>
					</dd>
				</dl>
				<!-- Q8 -->
				<dl class="clearfix">
					<dt class="cpm_1"><span></span></dt>
					<dd class="cpm_2">
						<p class="cpm_tt">客人如果付款，是否直接付款到商家？如何结算？</p>
						<p class="cpm_box">客人有两种付款方式，一种是线上付款，游客在确认订单后在线签约，支付款项到<?=$g_sitename?>账户； 另一种是订单可以做线下付款，即去您的旅行社门市签约、付款，客人线下付款后， 商户需在<?=$g_sitename?>商户业务管理系统后台记录收款（点击对应订单的"收款"按钮）。线上支付的订单结算采用T+1工作日内以汇款的方式支付。</p>
					</dd>
				</dl>
			</div>
		</div>
	</div>
</div>
<?include('foot.php');?>
</body>
</html>
