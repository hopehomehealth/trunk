<?
include(dirname(dirname(__FILE__)).'/config.php');
$is_index = true;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>���̼��� - <?=$g_sitename?></title>
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
				<div class="retail_sname">�������</div>
				<div class="retail_stip">��ϵ����<span class="ccc">...</span>�ύ����<span class="ccc">...</span>���ͨ��</div>
			</div>
			<div class="arrow icons_retail"></div>
			<div class="step">
				<div class="xieyi icons_retail"></div>
				<div class="retail_sname">Э��ǩ��</div>
				<div class="retail_stip">ǩ������<span class="ccc">...</span>˫��Լ��<span class="ccc">...</span>��ǩЭ��</div>
			</div>
			<div class="arrow icons_retail"></div>
			<div class="step">
				<div class="chanping icons_retail"></div>
				<div class="retail_sname">��Ʒ����</div>
				<div class="retail_stip">��Ʒ׼��<span class="ccc">...</span>�ύ���<span class="ccc">...</span>��Ʒ����</div>
			</div>
			<div class="arrow icons_retail"></div>
			<div class="joinus">
				<div class="fs14 fonts1" style="margin-bottom:15px;">��ӭ����<?=$g_sitename?>����������δ����</div>
				<div class="fc2 fs12" style="line-height:20px;">��ѯ���ߣ�<?=$g_profile['union_tel']?><br />
					��ѯ���䣺<?=$g_profile['union_email']?> </div>
				<a href="/member/?cmd=<?=base64_encode('union_join.php')?>" class="joinus_a">��������</a> </div>
		</div>
	</div> 
</div>

 
<div class="youshi">
	<div class="youshi_main">
		<div class="left">
			<div class="youshi_bar icons_retail">��פ����</div>
			<div class="youshi_square">
				<div class="mian icons_retail"></div>
				<div class="youshi_tip">���ż�+�߻ر�</div>
				<div class="youshi_tip_">ҵ����������</div>
			</div>
			<div class="youshi_square">
				<div class="service icons_retail"></div>
				<div class="youshi_tip">7*24Сʱ�����Ŷ�</div>
				<div class="youshi_tip_">Ϊ�����ߺ͹�Ӧ��<br />
					����ȫ��λ�ķ���</div>
			</div>
			<div class="youshi_square">
				<div class="data icons_retail"></div>
				<div class="youshi_tip">ǿ������ݷ�����Դ</div>
				<div class="youshi_tip_">�����̼�׼ȷ��λ����</div>
			</div>
			<div class="youshi_square">
				<div class="jiaoyi icons_retail"></div>
				<div class="youshi_tip">֧�ֶ��ֽ��׷�ʽ</div>
				<div class="youshi_tip_">�û���������</div>
			</div>
		</div>
		<div class="mid"></div>
		<div class="right">
			<div class="youshi_bar icons_retail">�ɹ�����</div>
			<div class="case">
				<table>
					<tr>
						<td rowspan="2" width="75"><div class="circle_case1 icons_retail"></div></td>
						<td class="case_title" height="65"><a href="#">������<?=$g_sitename?>����һ�ꡱ<br />
							�������������μ������޹�˾</a></td>
					</tr>
					<tr>
						<td class="case_title2">2014��Ŀ�ʼ��������<?=$g_sitename?>�ĺ���������Ļ��2014��Ľ�������������<?=$g_sitename?>��Լ�����ģ��������μ������޹�˾�����������̨����</td>
					</tr>
				</table>
			</div>
			<div class="case">
				<table>
					<tr>
						<td rowspan="2" width="75"><div class="circle_case2 icons_retail"></div></td>
						<td class="case_title" height="65"><a href="#">�����ԡ�<br />
							�������������۹��������缯�����޹�˾</a></td>
					</tr>
					<tr>
						<td class="case_title2">ִţ�� ;���� ������ʼ ������� ���´� ����˼�� ��;֮��ʢ���� ����Ҫ��ɫ���� ����<?=$g_sitename?> �������� ������������6�������</td>
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