<?
function randomFloat($min = 0, $max = 1) { return $min + mt_rand() / mt_getrandmax() * ($max - $min); }
?>
<!DOCTYPE html>
<html>
<head>
<title>������Ʊ,��ƱƱ�ۡ�Bus365��Ʊ��</title>
    <?include('meta.php');?>
    <?seo();?>
    <?load_mobile('http://'.$g_config['mobile_domain'].'/'.$c_catalog_key.'/');?>
    <?include('static.php');?>
<script type="text/javascript" src="/themes/s01/js/menpiaoliebiao.js"></script>
<link rel="stylesheet" type="text/css" href="/themes/s01/images/common.css">
<link rel="stylesheet" type="text/css" href="/themes/s01/images/menpiaoliebiao.css">
<link rel="stylesheet" type="text/css" href="/themes/s01/images/list.css">
<script type="text/javascript" src="/themes/s01/js/jquery.js "></script>
<script type="text/javascript" src="/themes/s01/js/common.js"></script>

<style type="text/css">
	#partner_box{width: 100%;height: 200px;background-color: white;}
	#partner{width: 1190px;height:200px;margin: 0 auto;padding:15px 0;}
	.partner_top{width: 1190px;line-height: 37px;height: 37px;}
	.partner_title{float: left;color:#1fcc9e;font-size:24px;width: 120px;padding-left:40px;background: url("/themes/s01/images/partner_logo.jpg") no-repeat left center;}
	.partner_border{float: left;width:1030px;height: 1px;background-color:#dedede;margin-top:18px;}

	/* #search_auto{position: absolute;z-index:999;top: 51px;left: 396px;width:400px;overflow: hidden;background-color: white;}
	#search_auto ul{width: 398px;overflow: hidden;border:solid 1px #ddd;}
	#search_auto ul li{width: 378px;height: 32px;line-height: 32px;padding:0 10px;cursor: pointer;}
	#search_auto ul li:hover{background-color: #efefef;color: #fa9520;} */
</style>
</head>
<body onselectstart="return false">
	<!--  nav����  end -->
<?include('head.php');?>
<!-- �������� start -->
	<div id="searchMainBox">
		<div id="searchMain" style="position: relative;">
			<div class="searchMain1">
				<div class="searchMain1_l">
					<span>������Ʊ</span>
					<ul style="">
						<li style="background-color:#1fcc9e;color:white;">������Ʊ</li>
						<li>�ܱ���</li>
					</ul>
				</div>
				<div class="searchMain1_c">
				<?if(!empty($keyWord)){?>
					<input type="text" name="������Ŀ�ĵ�/��Ʒ����" value="<?=$keyWord?>">
				<?}else{?>
					<input type="text" name="������Ŀ�ĵ�/��Ʒ����" placeholder="������Ŀ�ĵ�/��Ʒ����">
					<?}?>
				</div>
				<div class="searchMain1_r"></div>
			</div>
			<div id="search_auto"></div>
		</div>
	</div>
	<!-- �������� end -->
<script type="text/javascript">
var currentLis = 0;
$('.searchMain1_c input').on('keyup',function(event){
    var e = event || window.event;
    if(e.keyCode==38||e.keyCode==40||e.keyCode==13){
      
    }else{currentLis = 0;
      if($(".searchMain1_l span").html()=='������Ʊ'){
        $.post('<?=$g_self_domain?>/search/',{'value':$(this).val()},function(data){
          // if(data=='0') $('#search_auto').html('').css('display','none');
          // else $('#search_auto').html(data).css('display','block');
          if(data=='0'){
            $('#search_auto').html('').css('display','none');
          }else{
            $('#search_auto').html(data).css('display','block');
            $('#search_auto ul li').click(function(){
              $('.searchMain1_c input').val($(this).html());
              $('.search_form').remove();
            $('body').append('<form  action="<?=$g_self_domain?>/menpiao/" method="" class="search_form"><input type="hidden" name="keyWord" class="search_cont1" value="' + $(".searchMain1_l span").html() + '"><input type="hidden" name="keyWord" class="search_cont2" value="' + $('.searchMain1_c input').val() + '"></form>');
            //$('.search_form').attr('action','');
            $('.search_form').submit();
              $('#search_auto').html('').css('display','none');
            });
          }
        });
      }else if($(".searchMain1_l span").html()=='�ܱ���'){
        $.post('<?=$g_self_domain?>/searcha/',{'value':$(this).val()},function(data){
          // if(data=='0') $('#search_auto').html('').css('display','none');
          // else $('#search_auto').html(data).css('display','block');
          if(data=='0'){
            $('#search_auto').html('').css('display','none');
          }else{
            $('#search_auto').html(data).css('display','block');
            $('#search_auto ul li').click(function(){
              $('.searchMain1_c input').val($(this).html());
              $('.search_form').remove();
            $('body').append('<form  action="<?=$g_self_domain?>/zhoubian/  " method="" class="search_form"><input type="hidden" name="keyWord" class="search_cont1" value="' + $(".searchMain1_l span").html() + '"><input type="hidden" name="keyWord" class="search_cont2" value="' + $('.searchMain1_c input').val() + '"></form>');
            //$('.search_form').attr('action','http://traveld.bus365.cn/zhoubian/');
            $('.search_form').submit();
              $('#search_auto').html('').css('display','none');
            });
          }
        });
      }
    }	

	});

$('.searchMain1_c input').on('keydown',function(event) {
    //event.preventDefault();
    var e = event || window.event;
    var lis = $('#search_auto ul li').length;
    //alert(lis);
    if(e.keyCode==38){//up
        if(lis>1||lis==1&&currentLis>1){
          currentLis--;
          //$('#search_auto ul li').eq(currentLis-1).addClass('searchLi_hover').siblings('li').removeClass('searchLi_hover');
          $('.searchMain1_c input').val($('#search_auto ul li').eq(currentLis-1).html());
        }else if(currentLis==1){
           return;
        }
    }
    else if(e.keyCode==40){//down
        if(lis>1||lis==1&&currentLis<lis){
          currentLis++;
          //$('#search_auto ul li').eq(currentLis-1).addClass('searchLi_hover').siblings('li').removeClass('searchLi_hover');
          $('.searchMain1_c input').val($('#search_auto ul li').eq(currentLis-1).html());
        }
    }
    else if(e.keyCode==13){//enter
      if($(".searchMain1_l span").html()!='' && $('.searchMain1_c input').val()!=''){
        //alert(2);
        if($(".searchMain1_l span").html()=='������Ʊ'){
          $('.search_form').remove();
          $('body').append('<form  action="<?=$g_self_domain?>/menpiao/" method="" class="search_form"><input type="hidden" name="keyWord" class="search_cont1" value="'+$(".searchMain1_l span").html()+'"><input type="hidden" name="keyWord" class="search_cont2" value="'+$('.searchMain1_c input').val()+'"></form>');
          //$('.search_form').attr('action','');
          $('.search_form').submit();
        }else if($(".searchMain1_l span").html()=='�ܱ���'){
          $('.search_form').remove();
          $('body').append('<form  action="<?=$g_self_domain?>/zhoubian/  " method="" class="search_form"><input type="hidden" name="keyWord" class="search_cont1" value="'+$(".searchMain1_l span").html()+'"><input type="hidden" name="keyWord" class="search_cont2" value="'+$('.searchMain1_c input').val()+'"></form>');
          //$('.search_form').attr('action','http://traveld.bus365.cn/zhoubian/');
          $('.search_form').submit();
        }
        
      };
    }
    $('#search_auto ul li').eq(currentLis-1).addClass('searchLi_hover').siblings('li').removeClass('searchLi_hover');
});








	$('.searchMain1_c input').blur(function(){
		//if($('#search_auto').html()==''){
			setTimeout(function(){
				//$('.searchMain1_c input').val($('#search_auto ul li').eq(0).html());
				$('#search_auto').html('').css('display','none');
			},200)
		//}
	});

</script>							
	<!-- main���� start -->
	<div id="spotList_mainBox">
		<div id="spotList_main">
			<div id="spotList_main_left">
				<div id="spotList_main_left1">

					 <dl>
					 	<dt>����</dt>
					 	<dd class="list1">
					 		<ul>
					 			<?foreach($zhuti['data'] as $key=>$data){ $data = ($data); ?>
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
							<a href="<?=$nowUrl?><?=$pagepre?>"><? if($pageNo>1){ ?><span class="leftBtn_hover"><?}else{?><span class="leftBtn"><?}?></span></a>
							<a href="<?=$nowUrl?><?=$pagenext?>"><? if($pageNo==$totalPage){ ?><span class="rightBtn_hover"><?}else{ ?><span class="rightBtn"><?}?></span></a>
						</div>
					</div>
					<!-- ��������� -->
					<? if(!empty($liebiao['data']['rows'])){ ?>
					<!-- ����������ʼ -->
					<? foreach($liebiao['data']['rows'] as $k=>$data){ ?>
					<!-- if�ж�������Ƿ�����Ӫ -->
					<? if($data['aLiData']==''){ ?>
					<div class="spotList_main2_content">
						<div class="spotList_main2_content1">
							<div class="spotList_main2_content1_left">
								<img src="<?=($data['imgUrl'])?>" class="ticket_info_img" onerror= "javascript:this.src='/themes/s01/images/lv_list_defaultss.jpg' " onclick="window.open('<?=$g_self_domain?>/menpiao/ticket_detail-<?=$data['lvProductId']?>-<?=$data['scenicId']?>.html')" style="cursor:pointer"
>
								<div class="ticket_info">
									<div class="ticket_info_title"><a href="<?=$g_self_domain?>/menpiao/ticket_detail-<?=$data['lvProductId']?>-<?=$data['scenicId']?>.html" target="_blank"><?=jiequ(18,$data['goodsName'])?></a><span><?=($data['scenicCity'])?></span></div>
									<div class="starlab"><?=($data['scenicLevel'])?></div>
									<div class="ticket_info_address" title="<?=$data['detailAddress']?>">��ַ��<?=jiequ(25,$data['detailAddress'])?><a href="<?=$g_self_domain?>/menpiao/ticket_detail-<?=$data['lvProductId']?>-<?=$data['scenicId']?>.html?isMap=1">��ͼ</a></div>
									<? if(empty($data['lvProductId'])){ ?>
									<div class="ticket_info_feature" title="<?=$data['feature']?>">��ɫ��<?=jiequ(25,$data['feature'])?></div>
									<?}?>
								</div>
							</div>
							<div class="spotList_main2_content1_right">
								<div class="ticket_info_price"><b>&yen;<?=($data['minPrice'])?></b>��</div>
								<a href="<?=$g_self_domain?>/menpiao/ticket_detail-<?=$data['lvProductId']?>-<?=$data['scenicId']?>.html" class="toDetail" target="_blank">�鿴����</a>
								<span style="color: #51d4ac;width:190px;display: inline-block;text-align: center;font-weight: bold;line-height:32px;">����ȣ�<?
                                    $randvalue = randomFloat(0.9,1) * 100;
                                    $randvalue = sprintf("%0.2f", $randvalue).'%';
                                    if($data['favorableRate'] == '0.0%' || $data['favorableRate'] == '0%') echo $randvalue;else echo $data['favorableRate'];
                                    ?></span>
							</div>
						</div>
						<div class="spotList_main2_content2">
							<span style="color:#fb7a03;width:410px;padding-left:20px; ">������Ʊ</span>
							<span style="width:50px;text-align: center;">���м�</span>
							<span style="width:65px;text-align: center;">bus365��</span>
							<span style="float: right;padding-right: 135px;">֧����ʽ</span>
						</div>
						<!-- �ж��Ƿ񳬹�������ʼ �����������-->
						<? if (count($data['ticketMapList'])>3){ $rest = count($data['ticketMapList'])-3; ?>
						<div class="spotList_main2_content3">
							<ul>
								<li>
									<div class="spotTicket_info">
										<div class="spotTicket">
											<span class="ticketType"><?=($data['ticketMapList'][0]['ticketTypeName'])?></span> --<?=($data['ticketMapList'][0]['lvGoodsName'])?><?=($data['ticketMapList'][0]['advanceBookingTime'])?>
											<span class="subtriangle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
										</div>
										
										<div class="meshiPrice">&yen;<? if($data['ticketMapList'][0]['marketPrice'] != $data['ticketMapList'][0]['marketPrice']){ ?><?=($data['ticketMapList'][0]['marketPrice']);?><?}else{ echo $data['ticketMapList'][0]['marketPrice']+5;}?></div>
										<div class="ourPrice">&yen;<?=($data['ticketMapList'][0]['minPrice']);?></div>
										<div class="payType"><?=($data['ticketMapList'][0]['paymentType']);?></div>
										
										<div class="reserve" ><a href="<?=$g_self_domain?>/menpiao/ticket_order-<?=urlencode($data['goodsName'])?>-<?=urlencode($data['ticketMapList'][0]['ticketTypeName'])?>-<?=($data['ticketMapList'][0]['isEmail'])?>-<?=($data['ticketMapList'][0]['ticketType'])?>-<?=($data['goodsId'])?>-<?=($data['lvProductId'])?>-<?=($data['ticketMapList'][0]['lvGoodsId'])?>.html" target="_blank">Ԥ��</a></div>
									</div>
									
									<div class="spotTicket_infoHide">
										<dl class=""><dt>���ð���</dt><dd><?=($data['ticketMapList'][0]['costInclude'])?></dd></dl>
										<dl class=""><dt>Ԥ��ʱ��</dt><dd><?=($data['ticketMapList'][0]['bookTime'])?></dd></dl>
										<dl class=""><dt>��԰��֪</dt><dd>1.��԰ʱ�䣺<?=($data['ticketMapList'][0]['limitTime'])?><br>2.��԰�ص㣺<?=($data['ticketMapList'][0]['visitAddress'])?><br>3.ȡƱʱ�䣺<?=($data['ticketMapList'][0]['getTicketTime'])?><br>4.ȡƱ�ص㣺<?=($data['ticketMapList'][0]['getTicketPlace'])?><br>5.��԰��ʽ��<?=($data['ticketMapList'][0]['ways'])?><br>6.��Ч���ޣ�&nbsp;<?=($data['ticketMapList'][0]['effectiveDesc'])?>
										<br>7.ͨ�����ƣ�&nbsp;<?=($data['ticketMapList'][0]['passLimit'][0]['lvGoodsName'])?>���µ���<?=$data['ticketMapList'][0]['passLimit'][0]['passLimitTime']?>���ӿ���԰</dd></dl>
										<dl class=""><dt>��Ҫ��ʾ</dt><dd><?=($data['ticketMapList'][0]['importentPoint'])?></dd></dl>
										<dl class=""><dt>�˸�˵��</dt><dd><?=($data['ticketMapList'][0]['refundRuleNotice'])?></dd></dl>

										<span class="spotTicket_pickUp">����</span>
									</div>
								</li>
								<li>
									<div class="spotTicket_info">
										<div class="spotTicket">
											<span class="ticketType"><?=($data['ticketMapList'][1]['ticketTypeName'])?></span> --<?=($data['ticketMapList'][1]['lvGoodsName'])?><?=($data[1]['advanceBookingTime'])?>
											<span class="subtriangle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
										</div>
										
										<div class="meshiPrice">&yen;<? if($data['ticketMapList'][1]['marketPrice'] != $data['ticketMapList'][1]['minPrice']){ ?><?=($data['ticketMapList'][1]['marketPrice']);?><?}else{ echo $data['ticketMapList'][1]['marketPrice']+5;}?></div>
										<div class="ourPrice">&yen;<?=($data['ticketMapList'][1]['minPrice']);?></div>
										<div class="payType"><?=($data['ticketMapList'][1]['paymentType']);?></div>
										<div class="reserve" ><a href="<?=$g_self_domain?>/menpiao/ticket_order-<?=urlencode($data['goodsName'])?>-<?=urlencode($data['ticketMapList'][1]['ticketTypeName'])?>-<?=($data['ticketMapList'][1]['isEmail'])?>-<?=($data['ticketMapList'][1]['ticketType'])?>-<?=($data['goodsId'])?>-<?=($data['lvProductId'])?>-<?=($data['ticketMapList'][1]['lvGoodsId'])?>.html" target="_blank">Ԥ��</a></div>
									</div>
									<div class="spotTicket_infoHide">
										<dl class=""><dt>���ð���</dt><dd><?=($data['ticketMapList'][1]['costInclude'])?></dd></dl>
										<dl class=""><dt>Ԥ��ʱ��</dt><dd><?=($data['ticketMapList'][1]['bookTime'])?></dd></dl>
										<dl class=""><dt>��԰��֪</dt><dd>1.��԰ʱ�䣺<?=($data['ticketMapList'][1]['limitTime'])?><br>2.��԰�ص㣺<?=($data['ticketMapList'][1]['visitAddress'])?><br>3.ȡƱʱ�䣺<?=($data['ticketMapList'][1]['getTicketTime'])?><br>4.ȡƱ�ص㣺<?=($data['ticketMapList'][1]['getTicketPlace'])?><br>5.��԰��ʽ��<?=($data['ticketMapList'][1]['ways'])?><br>6.��Ч���ޣ�&nbsp;<?=($data['ticketMapList'][1]['effectiveDesc'])?><br>7.ͨ�����ƣ�&nbsp;<?=($data['ticketMapList'][1]['passLimit'][0]['lvGoodsName'])?>���µ���<?=$data['ticketMapList'][1]['passLimit'][0]['passLimitTime']?>���ӿ���԰</dd></dl>
										<dl class=""><dt>��Ҫ��ʾ</dt><dd><?=($data['ticketMapList'][1]['importentPoint'])?></dd></dl>
										<dl class=""><dt>�˸�˵��</dt><dd><?=($data['ticketMapList'][1]['refundRuleNotice'])?></dd></dl>

										<span class="spotTicket_pickUp">����</span>
									</div>
								</li>
								<li>
									<div class="spotTicket_info">
										<div class="spotTicket">
											<span class="ticketType"><?=($data['ticketMapList'][2]['ticketTypeName'])?></span> --<?=($data['ticketMapList'][2]['lvGoodsName'])?><?=($data['ticketMapList'][2]['advanceBookingTime'])?>
											<span class="subtriangle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
										</div>
										
										<div class="meshiPrice">&yen;<? if($data['ticketMapList'][2]['marketPrice'] != $data['ticketMapList'][2]['minPrice']){ ?><?=($data['ticketMapList'][2]['marketPrice']);?><?}else{echo $data['ticketMapList'][2]['marketPrice']+5;}?></div>
										<div class="ourPrice">&yen;<?=($data['ticketMapList'][2]['minPrice']);?></div>
										<div class="payType"><?=($data['ticketMapList'][2]['paymentType']);?></div>
										<div class="reserve" ><a href="<?=$g_self_domain?>/menpiao/ticket_order-<?=urlencode($data['goodsName'])?>-<?=urlencode($data['ticketMapList'][2]['ticketTypeName'])?>-<?=($data['ticketMapList'][2]['isEmail'])?>-<?=($data['ticketMapList'][2]['ticketType'])?>-<?=($data['goodsId'])?>-<?=($data['lvProductId'])?>-<?=($data['ticketMapList'][2]['lvGoodsId'])?>.html" target="_blank">Ԥ��</a></div>
									</div>
									<div class="spotTicket_infoHide">
										<dl class=""><dt>���ð���</dt><dd><?=($data['ticketMapList'][2]['costInclude'])?></dd></dl>
										<dl class=""><dt>Ԥ��ʱ��</dt><dd><?=($data['ticketMapList'][2]['bookTime'])?></dd></dl>
										<dl class=""><dt>��԰��֪</dt><dd>1.��԰ʱ�䣺<?=($data['ticketMapList'][2]['limitTime'])?><br>2.��԰�ص㣺<?=($data['ticketMapList'][2]['visitAddress'])?><br>3.ȡƱʱ�䣺<?=($data['ticketMapList'][2]['getTicketTime'])?><br>4.ȡƱ�ص㣺<?=($data['ticketMapList'][2]['getTicketPlace'])?><br>5.��԰��ʽ��<?=($data['ticketMapList'][2]['ways'])?><br>6.��Ч���ޣ�&nbsp;<?=($data['ticketMapList'][2]['effectiveDesc'])?><br>7.ͨ�����ƣ�&nbsp;<?=($data['ticketMapList'][2]['passLimit'][0]['lvGoodsName'])?>���µ���<?=$data['ticketMapList'][2]['passLimit'][0]['passLimitTime']?>���ӿ���԰</dd></dl>
										<dl class=""><dt>��Ҫ��ʾ</dt><dd><?=($data['ticketMapList'][2]['importentPoint'])?></dd></dl>
										<dl class=""><dt>�˸�˵��</dt><dd><?=($data['ticketMapList'][2]['refundRuleNotice'])?></dd></dl>

										<span class="spotTicket_pickUp">����</span>
									</div>
								</li>
								</ul>
								
								<ul class="lists_hide">
								<!-- ��������������Ҫ���ز��� -->
								<? foreach($data['ticketMapList'] as $key=>$value){ ?>
								<? if($key>2){ ?><!-- ������������� ������������ ��ʼ -->
								<li>
									<div class="spotTicket_info">
										<div class="spotTicket">
											<span class="ticketType"><?=($value['ticketTypeName'])?></span> --<?=($value['lvGoodsName'])?><?=($value['advanceBookingTime'])?>
											<span class="subtriangle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
										</div>
										
										<div class="meshiPrice">&yen;<? if($value['marketPrice'] != $value['minPrice']){ ?><?=($value['marketPrice']);?><?}else{echo $value['marketPrice']+5;}?></div>
										<div class="ourPrice">&yen;<?=($value['minPrice']);?></div>
										<div class="payType"><?=($value['paymentType']);?></div>
										<div class="reserve"><a href="<?=$g_self_domain?>/menpiao/ticket_order-<?=urlencode($data['goodsName'])?>-<?=urlencode($value['ticketTypeName'])?>-<?=($value['isEmail'])?>-<?=($value['ticketType'])?>-<?=($data['goodsId'])?>-<?=($data['lvProductId'])?>-<?=($value['lvGoodsId'])?>.html" target="_blank">Ԥ��</a></div>
									</div>
									<div class="spotTicket_infoHide">
										<dl class=""><dt>���ð���</dt><dd><?=($value['costInclude'])?></dd></dl>
										<dl class=""><dt>Ԥ��ʱ��</dt><dd><?=($value['bookTime'])?></dd></dl>
										<dl class=""><dt>��԰��֪</dt><dd>1.��԰ʱ�䣺<?=($value['limitTime'])?><br>2.��԰�ص㣺<?=($value['visitAddress'])?><br>3.ȡƱʱ�䣺<?=($value['getTicketTime'])?><br>4.ȡƱ�ص㣺<?=($value['getTicketPlace'])?><br>5.��԰��ʽ��<?=($value['ways'])?><br>6.��Ч���ޣ�&nbsp;<?=($value['effectiveDesc'])?><br>7.ͨ�����ƣ�&nbsp;<?=($value['passLimit'][$key]['lvGoodsName'])?>���µ���<?=$value['passLimit'][$key]['passLimitTime']?>���ӿ���԰</dd></dl>
										<dl class=""><dt>��Ҫ��ʾ</dt><dd><?=($value['importentPoint'])?></dd></dl>
										<dl class=""><dt>�˸�˵��</dt><dd><?=($value['refundRuleNotice'])?></dd></dl>

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
											<span class="ticketType"><?=($value['ticketTypeName'])?></span> --<?=($value['lvGoodsName'])?><?=($value['advanceBookingTime'])?>
											<span class="subtriangle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
										</div>
										
										<div class="meshiPrice">&yen;<? if($value['marketPrice'] != $value['minPrice']){ ?><?=($value['marketPrice']);?><?}else{echo $value['marketPrice']+5;}?></div>
										<div class="ourPrice">&yen;<?=($value['minPrice']);?></div>
										<div class="payType"><?=($value['paymentType']);?></div>
										<div class="reserve"><a href="<?=$g_self_domain?>/menpiao/ticket_order-<?=urlencode($data['goodsName'])?>-<?=urlencode($value['ticketTypeName'])?>-<?=($value['isEmail'])?>-<?=($value['ticketType'])?>-<?=($data['goodsId'])?>-<?=($data['lvProductId'])?>-<?=($value['lvGoodsId'])?>.html" target="_blank">Ԥ��</a></div>
										
									</div>
									<div class="spotTicket_infoHide">
										<dl class=""><dt>���ð���</dt><dd><?=($value['costInclude'])?></dd></dl>
										<dl class=""><dt>Ԥ��ʱ��</dt><dd><?=($value['bookTime'])?></dd></dl>
										<dl class=""><dt>��԰��֪</dt><dd>1.��԰ʱ�䣺<?=($value['limitTime'])?><br>2.��԰�ص㣺<?=($value['visitAddress'])?><br>3.ȡƱʱ�䣺<?=($value['getTicketTime'])?><br>4.ȡƱ�ص㣺<?=($value['getTicketPlace'])?><br>5.��԰��ʽ��<?=($value['ways'])?><br>6.��Ч���ޣ�&nbsp;<?=($value['effectiveDesc'])?><br>7.ͨ�����ƣ�&nbsp;<?=($value['passLimit'][$key]['lvGoodsName'])?>���µ���<?=$value['passLimit'][$key]['passLimitTime']?>���ӿ���԰</dd></dl>
										<dl class=""><dt>��Ҫ��ʾ</dt><dd><?=($value['importentPoint'])?></dd></dl>
										<dl class=""><dt>�˸�˵��</dt><dd><?=($value['refundRuleNotice'])?></dd></dl>

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
								<img src="<?=($data['imgUrl'])?>" class="ticket_info_img" onerror= "javascript:this.src='/themes/s01/images/lv_list_default.png' " onclick="window.open('<?=$data['pcALiDetailLink']?>')" style="cursor:pointer"
>
								<div class="ticket_info">
									<div class="ticket_info_title"><a href="<?=$data['pcALiDetailLink']?>" target="_blank"><?=jiequ(18,$data['goodsName'])?></a><span><?=($data['scenicCity'])?></span></div>
									<div class="starlab"><?=($data['scenicLevel'])?></div>
									<div class="ticket_info_address" title="<?=$data['detailAddress']?>">��ַ��<?=jiequ(25,$data['detailAddress'])?></div>
									<? if(!empty($data['feature'])){ ?>
									<div class="ticket_info_feature" title="<?=$data['feature']?>">��ɫ��<?=jiequ(25,$data['feature'])?></div>
									<? } ?>
								</div>
							</div>
							<div class="spotList_main2_content1_right">
								<div class="ticket_info_price"><b>&yen;<?=($data['minPrice'])?></b>��</div>
								<a href="<?=$data['pcALiDetailLink']?>" target="_blank" class="toDetail">�鿴����</a>
								<p style="text-align: center;color: #1fcc9e;line-height: 28px;">*�������ɷ����ṩ</p>
							</div>
						</div>
					</div>
				
				<!-- if�µķ�����Ӫ���� -->	
				<!-- ������������ -->
				<!-- ����û���� -->
				<? } } }else{ ?>
				<div class="box-warning bw-bold mb15" style="margin-top:20px">
		            <i class="icon waring-sm"></i>�ܱ�Ǹ��û���ҵ�<?if($keywords!=''){?>�� <b class="yellow-a">��<?=$keywords?>��</b> <?}?>��صĲ�Ʒ��Ҫ������������Ʒ�����߻����ؼ���������
		        </div>
		        <? } ?>
		        <!-- �ж��Ƿ������ݽ��� -->
					<div class="spotList_main2_title">
						<div class="spotList_main2_title_right">
							<div class="yema">ҳ�룺<b><?=$pageNo?></b>/<?=$totalPage?></div>
							<a href="<?=$nowUrl?><?=$pagepre?>"><? if($pageNo>1){ ?><span class="leftBtn_hover"><?}else{?><span class="leftBtn"><?}?></span></a>
							<a href="<?=$nowUrl?><?=$pagenext?>"><? if($pageNo==$totalPage){ ?><span class="rightBtn_hover"><?}else{ ?><span class="rightBtn"><?}?></span></a>
						</div>
					</div>
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
                            //                var_dump($val['goods_type']);
                            if ($val['goods_type'] == '4'){
                                $href = "/menpiao/ticket_detail-".$val['goods_id']."-".$val['lv_scenic_id'].".html";
                            }else {
                                $href = "/product/detail-".$val['goods_id'].".html";

                            }
					?> 
						<dl>
					
						<dt><?=$n?></dt>
						<dd>
							<div class="youLikeTitle"><a href="<?echo $href;?>" target="_blank" title="<?=$val['goods_name']?>">
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