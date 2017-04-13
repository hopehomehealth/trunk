
<!DOCTYPE html>
<html>
<head>
    <?include('meta.php');?>
    <?seo();?>
    <?load_mobile('http://'.$g_config['mobile_domain'].'/'.$c_catalog_key.'/');?>
    <?include('static.php');?>
    <title>��Ʊ�б�</title>
<script type="text/javascript" src="/themes/s01/js/menpiaoliebiao.js"></script>
<link rel="stylesheet" type="text/css" href="/themes/s01/images/common.css">
<link rel="stylesheet" type="text/css" href="/themes/s01/images/menpiaoliebiao.css">
<link rel="stylesheet" type="text/css" href="/themes/s01/images/list.css">
<script type="text/javascript" src="/themes/s01/js/jquery.js "></script>
<script type="text/javascript" src="/themes/s01/js/common.js"></script>
</head>
<body>
	<!--  nav����  end -->
<?include('head.php');?>
										
	<!-- main���� start -->
	<div id="spotList_mainBox">
		<div id="spotList_main">
			<div id="spotList_main_left">
				<div id="spotList_main_left1">

					 <dl>
					 	<dt>����</dt>
					 	<dd class="list1">
					 		<ul>
					 			<?foreach($zhuti['data'] as $key=>$data){ $data = utf8_to_gbk($data); ?>
								<?if($_GET['scenicTheme']!=$data){?>
					 			<li>
					 			
					 			<a href="/menpiao/zhuti/?&scenicTheme=<?=$data?>"><span><?=$data?></span></a>
					 			
					 			</li>
					 			<?}else{?>
					 			<li>
					 			
					 			<a href="/menpiao/zhuti/?&scenicTheme=<?=$data?>"><span class='list_hover'><?=$data?></span></a>
					 			
					 			</li>
					 			<? } } ?>
					 		</ul>
					 	</dd>
					 	<dd class="list1_more">����</dd>
					 </dl>
				</div>

				<div id="spotList_main_left2">
					<div class="spotList_main2_title">
							<?
							$order_type = req('sc'); 
							if($order_type==''){
								$order_type = 'desc';
							}elseif($order_type=='asc'){
								$order_type = 'desc'.$scenicTheme;
							}else{
								$order_type = 'asc'.$scenicTheme;
							}
							?>
						<div class="spotList_main2_title_left">
							<ul class="sort-group fl mr10">
								<li><a id="list-f-312-2" <?if(req('col')=='sale'){?>class="select"<?}?> title="������Ƽ�����" href="/menpiao/zhuti/?&hot=desc">�Ƽ�<i> &nbsp;</i></a></li> 
								<? if($_GET['hot']) {?>
								<li><a id="list-f-312-4"">�۸�<i class="icon <?if(req('sc')=='desc'){?>sort-up<?}else{?>sort-down<?}?>"> &nbsp;</i></a> </li>
								<?}else{?>
								<li><a id="list-f-312-4" <?if(req('col')=='price'){?>class="select"<?}?> title="������м۸�����" href="?cmd=product_ticket&action=filter&sc=<?=$order_type?><?=$scenicTheme?><?=$pageNow?>">�۸�<i class="icon <?if(req('sc')=='desc'){?>sort-up<?}else{?>sort-down<?}?>"> &nbsp;</i></a> </li>
								<?}?>
							</ul>
						</div>
						
						<div class="spotList_main2_title_right">
							<div class="yema">ҳ�룺<b><?=$pageNo?></b>/<?=$totalPage?></div>
							<a href="<?=$nowUrl?><?=$pagepre?>"><span class="leftBtn"></span></a>
							<a href="<?=$nowUrl?><?=$pagenext?>"><span class="rightBtn"></span></a>
						</div>
					</div>
					<!-- ����������ʼ -->
					<? foreach($liebiao['data']['rows'] as $k=>$data){ ?>
					<!-- if�ж�������Ƿ�����Ӫ -->
					<? if($data['aLiData']==''){ ?>
					<div class="spotList_main2_content">
						<div class="spotList_main2_content1">
							<div class="spotList_main2_content1_left">
								<img src="<?=utf8_to_gbk($data['imgUrl'])?>" class="ticket_info_img" onerror= "javascript:this.src='/themes/s01/images/lv_list_default.png' "
>
								<div class="ticket_info">
									<div class="ticket_info_title"><?=utf8_to_gbk($data['goodsName'])?><span><?=utf8_to_gbk($data['scenicCity'])?></span></div>
									<div class="starlab"><?=utf8_to_gbk($data['scenicLevel'])?></div>
									<div class="ticket_info_address">��ַ��<?=utf8_to_gbk($data['detailAddress'])?><a>��ͼ</a></div>
									<div class="ticket_info_feature">��ɫ��<?=utf8_to_gbk($data['feature'])?></div>
								</div>
							</div>
							<div class="spotList_main2_content1_right">
								<div class="ticket_info_price"><b>&yen;<?=utf8_to_gbk($data['minPrice'])?></b>��</div>
								<a href="<?=$g_self_domain?>/menpiao/ticket_detail-<?=$data['lvProductId']?>-<?=$data['scenicId']?>.html" class="toDetail" >�鿴����</a>
								<span style="color: #51d4ac;width:190px;display: inline-block;text-align: center;font-weight: bold;">����ȣ�<?=$data['favorableRate']?></span>
							</div>
						</div>
						<div class="spotList_main2_content2">
							<span style="color:#fb7a03;width:410px;padding-left:20px; ">������Ʊ</span>
							<span style="width:50px;text-align: center;">���м�</span>
							<span style="width:50px;text-align: center;">���Ǽ�</span>
							<span style="float: right;padding-right: 100px;">֧����ʽ</span>
						</div>
						<!-- �ж��Ƿ񳬹�������ʼ �����������-->
						<? if (count($data['ticketMapList'])>3){ $rest = count($data['ticketMapList'])-3; ?>
						<div class="spotList_main2_content3">
							<ul>
								<li>
									<div class="spotTicket_info">
										<div class="spotTicket">
											<span class="ticketType"><?=utf8_to_gbk($data['ticketMapList'][0]['ticketTypeName'])?></span> --<?=utf8_to_gbk($data['ticketMapList'][0]['lvGoodsName'])?><?=utf8_to_gbk($data['ticketMapList'][0]['advanceBookingTime'])?>
											<span class="subtriangle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
										</div>
										
										<div class="meshiPrice">&yen;<?=utf8_to_gbk($data['ticketMapList'][0]['marketPrice']);?></div>
										<div class="ourPrice">&yen;<?=utf8_to_gbk($data['ticketMapList'][0]['minPrice']);?></div>
										<div class="payType"><?=utf8_to_gbk($data['ticketMapList'][0]['paymentType']);?></div>
										
										<div class="reserve" ><a href="<?=$g_self_domain?>/menpiao/ticket_order-<?=$db->base64url_encode($data['ticketMapList'][0]['lvGoodsName'])?>-<?=utf8_to_gbk($data['ticketMapList'][0]['ticketType'])?>-<?=utf8_to_gbk($data['ticketMapList'][0]['isEmail'])?>-<?=utf8_to_gbk($data['ticketMapList'][0]['isCredentials'])?>-<?=utf8_to_gbk($data['goodsId'])?>-<?=utf8_to_gbk($data['lvProductId'])?>-<?=utf8_to_gbk($data['ticketMapList'][0]['lvGoodsId'])?>.html">Ԥ��</a></div>
									</div>
									
									<div class="spotTicket_infoHide">
										<dl class=""><dt>���ð���</dt><dd><?=utf8_to_gbk($data['ticketMapList'][0]['costInclude'])?></dd></dl>
										<dl class=""><dt>Ԥ��ʱ��</dt><dd><?=utf8_to_gbk($data['ticketMapList'][0]['bookTime'])?></dd></dl>
										<dl class=""><dt>��԰��֪</dt><dd>1.��԰ʱ�䣺<?=utf8_to_gbk($data['ticketMapList'][0]['limitTime'])?><br>2.��԰�ص㣺<?=utf8_to_gbk($data['ticketMapList'][0]['visitAddress'])?><br>3.ȡƱʱ�䣺<?=utf8_to_gbk($data['ticketMapList'][0]['getTicketTime'])?><br>4.ȡƱ�ص㣺<?=utf8_to_gbk($data['ticketMapList'][0]['getTicketPlace'])?><br>5.��԰��ʽ��<?=utf8_to_gbk($data['ticketMapList'][0]['ways'])?><br>6.��Ч���ޣ�&nbsp;<?=utf8_to_gbk($data['ticketMapList'][0]['effectiveDesc'])?>
										<br>7.ͨ�����ƣ�&nbsp;<?=utf8_to_gbk($data['ticketMapList'][0]['passLimit'][0]['lvGoodsName'])?>���µ���<?=$data['ticketMapList'][0]['passLimit'][0]['passLimitTime']?>���ӿ���԰</dd></dl>
										<dl class=""><dt>��Ҫ��ʾ</dt><dd><?=utf8_to_gbk($data['ticketMapList'][0]['importentPoint'])?></dd></dl>
										<dl class=""><dt>�˸�˵��</dt><dd><?=utf8_to_gbk($data['ticketMapList'][0]['refundRuleNotice'])?></dd></dl>

										<span class="spotTicket_pickUp">����</span>
									</div>
								</li>
								<li>
									<div class="spotTicket_info">
										<div class="spotTicket">
											<span class="ticketType"><?=utf8_to_gbk($data['ticketMapList'][1]['ticketTypeName'])?></span> --<?=utf8_to_gbk($data['ticketMapList'][1]['lvGoodsName'])?><?=utf8_to_gbk($data[1]['advanceBookingTime'])?>
											<span class="subtriangle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
										</div>
										
										<div class="meshiPrice">&yen;<?=utf8_to_gbk($data['ticketMapList'][1]['marketPrice']);?></div>
										<div class="ourPrice">&yen;<?=utf8_to_gbk($data['ticketMapList'][1]['minPrice']);?></div>
										<div class="payType"><?=utf8_to_gbk($data['ticketMapList'][1]['paymentType']);?></div>
										<div class="reserve" ><a href="<?=$g_self_domain?>/menpiao/ticket_order-<?=$db->base64url_encode($data['ticketMapList'][1]['lvGoodsName'])?>-<?=utf8_to_gbk($data['ticketMapList'][1]['ticketType'])?>-<?=utf8_to_gbk($data['ticketMapList'][1]['isEmail'])?>-<?=utf8_to_gbk($data['ticketMapList'][1]['isCredentials'])?>-<?=utf8_to_gbk($data['goodsId'])?>-<?=utf8_to_gbk($data['lvProductId'])?>-<?=utf8_to_gbk($data['ticketMapList'][1]['lvGoodsId'])?>.html">Ԥ��</a></div>
									</div>
									<div class="spotTicket_infoHide">
										<dl class=""><dt>���ð���</dt><dd><?=utf8_to_gbk($data['ticketMapList'][1]['costInclude'])?></dd></dl>
										<dl class=""><dt>Ԥ��ʱ��</dt><dd><?=utf8_to_gbk($data['ticketMapList'][1]['bookTime'])?></dd></dl>
										<dl class=""><dt>��԰��֪</dt><dd>1.��԰ʱ�䣺<?=utf8_to_gbk($data['ticketMapList'][1]['limitTime'])?><br>2.��԰�ص㣺<?=utf8_to_gbk($data['ticketMapList'][1]['visitAddress'])?><br>3.ȡƱʱ�䣺<?=utf8_to_gbk($data['ticketMapList'][1]['getTicketTime'])?><br>4.ȡƱ�ص㣺<?=utf8_to_gbk($data['ticketMapList'][1]['getTicketPlace'])?><br>5.��԰��ʽ��<?=utf8_to_gbk($data['ticketMapList'][1]['ways'])?><br>6.��Ч���ޣ�&nbsp;<?=utf8_to_gbk($data['ticketMapList'][1]['effectiveDesc'])?><br>7.ͨ�����ƣ�&nbsp;<?=utf8_to_gbk($data['ticketMapList'][1]['passLimit'][0]['lvGoodsName'])?>���µ���<?=$data['ticketMapList'][1]['passLimit'][0]['passLimitTime']?>���ӿ���԰</dd></dl>
										<dl class=""><dt>��Ҫ��ʾ</dt><dd><?=utf8_to_gbk($data['ticketMapList'][1]['importentPoint'])?></dd></dl>
										<dl class=""><dt>�˸�˵��</dt><dd><?=utf8_to_gbk($data['ticketMapList'][1]['refundRuleNotice'])?></dd></dl>

										<span class="spotTicket_pickUp">����</span>
									</div>
								</li>
								<li>
									<div class="spotTicket_info">
										<div class="spotTicket">
											<span class="ticketType"><?=utf8_to_gbk($data['ticketMapList'][2]['ticketTypeName'])?></span> --<?=utf8_to_gbk($data['ticketMapList'][2]['lvGoodsName'])?><?=utf8_to_gbk($data['ticketMapList'][2]['advanceBookingTime'])?>
											<span class="subtriangle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
										</div>
										
										<div class="meshiPrice">&yen;<?=utf8_to_gbk($data['ticketMapList'][2]['marketPrice']);?></div>
										<div class="ourPrice">&yen;<?=utf8_to_gbk($data['ticketMapList'][2]['minPrice']);?></div>
										<div class="payType"><?=utf8_to_gbk($data['ticketMapList'][2]['paymentType']);?></div>
										<div class="reserve" ><a href="<?=$g_self_domain?>/menpiao/ticket_order-<?=$db->base64url_encode($data['ticketMapList'][2]['lvGoodsName'])?>-<?=utf8_to_gbk($data['ticketMapList'][2]['ticketType'])?>-<?=utf8_to_gbk($data['ticketMapList'][2]['isEmail'])?>-<?=utf8_to_gbk($data['ticketMapList'][2]['isCredentials'])?>-<?=utf8_to_gbk($data['goodsId'])?>-<?=utf8_to_gbk($data['lvProductId'])?>-<?=utf8_to_gbk($data['ticketMapList'][2]['lvGoodsId'])?>.html">Ԥ��</a></div>
									</div>
									<div class="spotTicket_infoHide">
										<dl class=""><dt>���ð���</dt><dd><?=utf8_to_gbk($data['ticketMapList'][2]['costInclude'])?></dd></dl>
										<dl class=""><dt>Ԥ��ʱ��</dt><dd><?=utf8_to_gbk($data['ticketMapList'][2]['bookTime'])?></dd></dl>
										<dl class=""><dt>��԰��֪</dt><dd>1.��԰ʱ�䣺<?=utf8_to_gbk($data['ticketMapList'][2]['limitTime'])?><br>2.��԰�ص㣺<?=utf8_to_gbk($data['ticketMapList'][2]['visitAddress'])?><br>3.ȡƱʱ�䣺<?=utf8_to_gbk($data['ticketMapList'][2]['getTicketTime'])?><br>4.ȡƱ�ص㣺<?=utf8_to_gbk($data['ticketMapList'][2]['getTicketPlace'])?><br>5.��԰��ʽ��<?=utf8_to_gbk($data['ticketMapList'][2]['ways'])?><br>6.��Ч���ޣ�&nbsp;<?=utf8_to_gbk($data['ticketMapList'][2]['effectiveDesc'])?><br>7.ͨ�����ƣ�&nbsp;<?=utf8_to_gbk($data['ticketMapList'][2]['passLimit'][0]['lvGoodsName'])?>���µ���<?=$data['ticketMapList'][2]['passLimit'][0]['passLimitTime']?>���ӿ���԰</dd></dl>
										<dl class=""><dt>��Ҫ��ʾ</dt><dd><?=utf8_to_gbk($data['ticketMapList'][2]['importentPoint'])?></dd></dl>
										<dl class=""><dt>�˸�˵��</dt><dd><?=utf8_to_gbk($data['ticketMapList'][2]['refundRuleNotice'])?></dd></dl>

										<span class="spotTicket_pickUp">����</span>
									</div>
								</li>
								</ul>
								
								<ul class="lists_hide">
								<!-- ��������������Ҫ���ز��� -->
								<? foreach($data['ticketMapList'] as $key=>$value){ ?>
								<? if($key>3){ ?><!-- ������������� ������������ ��ʼ -->
								<li>
									<div class="spotTicket_info">
										<div class="spotTicket">
											<span class="ticketType"><?=utf8_to_gbk($value['ticketTypeName'])?></span> --<?=utf8_to_gbk($value['lvGoodsName'])?><?=utf8_to_gbk($value['advanceBookingTime'])?>
											<span class="subtriangle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
										</div>
										
										<div class="meshiPrice">&yen;<?=utf8_to_gbk($value['marketPrice']);?></div>
										<div class="ourPrice">&yen;<?=utf8_to_gbk($value['minPrice']);?></div>
										<div class="payType"><?=utf8_to_gbk($value['paymentType']);?></div>
										<div class="reserve"><a href="<?=$g_self_domain?>/menpiao/ticket_order-<?=$db->base64url_encode($value['lvGoodsName'])?>-<?=utf8_to_gbk($value['ticketType'])?>-<?=utf8_to_gbk($value['isEmail'])?>-<?=utf8_to_gbk($value['isCredentials'])?>-<?=utf8_to_gbk($data['goodsId'])?>-<?=utf8_to_gbk($data['lvProductId'])?>-<?=utf8_to_gbk($value['lvGoodsId'])?>.html">Ԥ��</a></div>
									</div>
									<div class="spotTicket_infoHide">
										<dl class=""><dt>���ð���</dt><dd><?=utf8_to_gbk($value['costInclude'])?></dd></dl>
										<dl class=""><dt>Ԥ��ʱ��</dt><dd><?=utf8_to_gbk($value['bookTime'])?></dd></dl>
										<dl class=""><dt>��԰��֪</dt><dd>1.��԰ʱ�䣺<?=utf8_to_gbk($value['limitTime'])?><br>2.��԰�ص㣺<?=utf8_to_gbk($value['visitAddress'])?><br>3.ȡƱʱ�䣺<?=utf8_to_gbk($value['getTicketTime'])?><br>4.ȡƱ�ص㣺<?=utf8_to_gbk($value['getTicketPlace'])?><br>5.��԰��ʽ��<?=utf8_to_gbk($value['ways'])?><br>6.��Ч���ޣ�&nbsp;<?=utf8_to_gbk($value['effectiveDesc'])?><br>7.ͨ�����ƣ�&nbsp;<?=utf8_to_gbk($value['passLimit'][$key]['lvGoodsName'])?>���µ���<?=$value['passLimit'][$key]['passLimitTime']?>���ӿ���԰</dd></dl>
										<dl class=""><dt>��Ҫ��ʾ</dt><dd><?=utf8_to_gbk($value['importentPoint'])?></dd></dl>
										<dl class=""><dt>�˸�˵��</dt><dd><?=utf8_to_gbk($value['refundRuleNotice'])?></dd></dl>

										<span class="spotTicket_pickUp">����</span>
									</div>
								</li>
								<? } ?><!-- ������������� ������������ ���� -->
								<? } ?><!-- ��������������Ҫ���ز��ֽ��� -->
								
							
								</ul>
							<div class="toAll subtriangle">�鿴ȫ��(<?=$rest?>)</div>
						</div>
						<!-- �������û�г������� -->
						<? }else{ ?>
						<div class="spotList_main2_content3">
						
							<ul>
							<!-- ����û�г������������� -->
							<? foreach($data['ticketMapList'] as $key=>$value){ ?>
								
								<li>
									<div class="spotTicket_info">
										<div class="spotTicket">
											<span class="ticketType"><?=utf8_to_gbk($value['ticketTypeName'])?></span> --<?=utf8_to_gbk($value['lvGoodsName'])?><?=utf8_to_gbk($value['advanceBookingTime'])?>
											<span class="subtriangle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
										</div>
										
										<div class="meshiPrice">&yen;<?=utf8_to_gbk($value['marketPrice']);?></div>
										<div class="ourPrice">&yen;<?=utf8_to_gbk($value['minPrice']);?></div>
										<div class="payType"><?=utf8_to_gbk($value['paymentType']);?></div>
										<div class="reserve"><a href="<?=$g_self_domain?>/menpiao/ticket_order-<?=$db->base64url_encode($value['lvGoodsName'])?>-<?=utf8_to_gbk($value['ticketType'])?>-<?=utf8_to_gbk($value['isEmail'])?>-<?=utf8_to_gbk($value['isCredentials'])?>-<?=utf8_to_gbk($data['goodsId'])?>-<?=utf8_to_gbk($data['lvProductId'])?>-<?=utf8_to_gbk($value['lvGoodsId'])?>.html">Ԥ��</a></div>
										
									</div>
									<div class="spotTicket_infoHide">
										<dl class=""><dt>���ð���</dt><dd><?=utf8_to_gbk($value['costInclude'])?></dd></dl>
										<dl class=""><dt>Ԥ��ʱ��</dt><dd><?=utf8_to_gbk($value['bookTime'])?></dd></dl>
										<dl class=""><dt>��԰��֪</dt><dd>1.��԰ʱ�䣺<?=utf8_to_gbk($value['limitTime'])?><br>2.��԰�ص㣺<?=utf8_to_gbk($value['visitAddress'])?><br>3.ȡƱʱ�䣺<?=utf8_to_gbk($value['getTicketTime'])?><br>4.ȡƱ�ص㣺<?=utf8_to_gbk($value['getTicketPlace'])?><br>5.��԰��ʽ��<?=utf8_to_gbk($value['ways'])?><br>6.��Ч���ޣ�&nbsp;<?=utf8_to_gbk($value['effectiveDesc'])?><br>7.ͨ�����ƣ�&nbsp;<?=utf8_to_gbk($value['passLimit'][$key]['lvGoodsName'])?>���µ���<?=$value['passLimit'][$key]['passLimitTime']?>���ӿ���԰</dd></dl>
										<dl class=""><dt>��Ҫ��ʾ</dt><dd><?=utf8_to_gbk($value['importentPoint'])?></dd></dl>
										<dl class=""><dt>�˸�˵��</dt><dd><?=utf8_to_gbk($value['refundRuleNotice'])?></dd></dl>

										<span class="spotTicket_pickUp">����</span>
									</div>
								</li>
								<!-- �����������ݽ��� -->
							<? }?>
								</ul>
						</div>
						<!-- û�г���������if�жϽ��� -->
						<? } ?>
					</div>
					<!-- ������Ӫ -->
					
					<!-- if�ж��µķ�����Ӫ  ��ʼ -->
					<? }else{ ?>
				<div class="spotList_main2_content">
					<div class="spotList_main2_content1">
							<div class="spotList_main2_content1_left">
								<img src="<?=utf8_to_gbk($data['imgUrl'])?>" class="ticket_info_img" onerror= "javascript:this.src='/themes/s01/images/lv_list_default.png' "
>
								<div class="ticket_info">
									<div class="ticket_info_title"><?=utf8_to_gbk($data['goodsName'])?><span><?=utf8_to_gbk($data['scenicCity'])?></span></div>
									<div class="starlab"><?=utf8_to_gbk($data['scenicLevel'])?></div>
									<div class="ticket_info_address">��ַ��<?=utf8_to_gbk($data['detailAddress'])?></div>
									<div class="ticket_info_feature">��ɫ��<?=utf8_to_gbk($data['feature'])?></div>
								</div>
							</div>
							<div class="spotList_main2_content1_right">
								<div class="ticket_info_price"></div>
								<a href="<?=$data['aLiDetailLink']?>" class="toDetail">�鿴����</a>
								<p style="text-align: center;color: #1fcc9e;line-height: 28px;">*�������з����ṩ</p>
							</div>
						</div>
					</div>
				
				<!-- if�µķ�����Ӫ���� -->	
				<!-- ������������ -->
				<? } } ?>
				</div>
			</div>
			
			<div id="spotList_main_right">
				<? 
				$ad_list = get_ad('p_r', '0', 3);
				if(notnull($ad_list)){  
				?> 
					<?foreach ($ad_list as $cval){?>
					<a href="<?=$cval['ad_url']?>" target="_blank" title="<?=$val['ad_title']?>"> <img src="/upfiles/<?=$g_siteid.'/'.$cval['ad_image']?>" alt="<?=$val['ad_title']?>"> </a><br/>
					<?}?>  
				<?}?>
				<?//include(load_user_diy('diy.x05.html'));����ò���ǷŹ���?>
				<div class="spotList_main_right1">
					<h3>����ϲ��</h3>

					<? 
					$guess_list = get_guess_list(3);
					if(notnull($guess_list)){
						$n = 1;
						foreach ($guess_list as $val){  
							$goods_image = $g_domain."upfiles/$g_siteid/".$val['goods_image'];
					?> 
						<dl>
					
						<dt><?=$n?></dt>
						<dd>
							<div class="youLikeTitle"><a href="/product/detail-<?=$val['goods_id']?>.html" target="_blank" title="<?=$val['goods_name']?>"> 
					<?=$val['goods_name']?> </a></div>
							<div class="youLikeOther">
								<div class="youLikePrice">&yen;<?=$val['min_price']?>��</div>
								<div class="youLikeTime"><?=date('m/d H:i', strtotime($val['browse_time']))?>�����</div>
							</div>
						</dd>
						</dl>
					<?
					$n++;
					}
				}
				?> 
					
					
				</div>
				<?
				$goods_article = list_goods_article(5);
				if(notnull($goods_article)){ 
				?>
				<div class="spotList_main_right2">
					<h3><?=$c_catalog['cat_name']?>���ι���</h3>
					<?
				    foreach ($goods_article as $val){  
						$news_url = get_news_url($val['thread_id']);
			        ?>
					<ul>
					
						<li><a href="<?=$news_url?>" targe="_blank"><?=$val['title']?></a></li>
						<li><?=date('Y/m/d', strtotime($val['addtime']))?> ���<?=$val['clicks']?>��</li>
					
					</ul>
					<?}?>
				</div>
				<?}?>
				
			</div>
		</div>
	</div>
	<!-- main���� end -->


	<!--  foot  start -->
<?include('foot.php');?>
</body>

</html>