<?
function randomFloat($min = 0, $max = 1) { return $min + mt_rand() / mt_getrandmax() * ($max - $min); }
?>
<!DOCTYPE html>
<html>
<head>
<title>景点门票,门票票价【Bus365门票】</title>
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
	<!--  nav导航  end -->
<?include('head.php');?>
<!-- 搜索区域 start -->
	<div id="searchMainBox">
		<div id="searchMain" style="position: relative;">
			<div class="searchMain1">
				<div class="searchMain1_l">
					<span>景点门票</span>
					<ul style="">
						<li style="background-color:#1fcc9e;color:white;">景点门票</li>
						<li>周边游</li>
					</ul>
				</div>
				<div class="searchMain1_c">
				<?if(!empty($keyWord)){?>
					<input type="text" name="请输入目的地/产品名称" value="<?=$keyWord?>">
				<?}else{?>
					<input type="text" name="请输入目的地/产品名称" placeholder="请输入目的地/产品名称">
					<?}?>
				</div>
				<div class="searchMain1_r"></div>
			</div>
			<div id="search_auto"></div>
		</div>
	</div>
	<!-- 搜索区域 end -->
<script type="text/javascript">
var currentLis = 0;
$('.searchMain1_c input').on('keyup',function(event){
    var e = event || window.event;
    if(e.keyCode==38||e.keyCode==40||e.keyCode==13){
      
    }else{currentLis = 0;
      if($(".searchMain1_l span").html()=='景点门票'){
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
      }else if($(".searchMain1_l span").html()=='周边游'){
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
        if($(".searchMain1_l span").html()=='景点门票'){
          $('.search_form').remove();
          $('body').append('<form  action="<?=$g_self_domain?>/menpiao/" method="" class="search_form"><input type="hidden" name="keyWord" class="search_cont1" value="'+$(".searchMain1_l span").html()+'"><input type="hidden" name="keyWord" class="search_cont2" value="'+$('.searchMain1_c input').val()+'"></form>');
          //$('.search_form').attr('action','');
          $('.search_form').submit();
        }else if($(".searchMain1_l span").html()=='周边游'){
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
	<!-- main内容 start -->
	<div id="spotList_mainBox">
		<div id="spotList_main">
			<div id="spotList_main_left">
				<div id="spotList_main_left1">

					 <dl>
					 	<dt>主题</dt>
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
					 	<dd class="list1_more">更多</dd>
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
								<li><a id="list-f-312-2" <?if(req('col')=='sale'){?>class="select"<?}?> title="点击按推荐排序" href="/menpiao/zhuti/?&hot=desc">推荐<i> &nbsp;</i></a></li> 
								<? if($_GET['hot']) {?>
								<li><a id="list-f-312-4"">价格<i class="icon <?if(req('sc')=='desc'){?>sort-up<?}else{?>sort-down<?}?>"> &nbsp;</i></a> </li>
								<?}else{?>
								<li><a id="list-f-312-4" <?if(req('col')=='price'){?>class="select"<?}?> title="点击进行价格排序" href="?cmd=product_ticket&action=filter&sc=<?=$order_type?><?=$scenicTheme?><?=$pageNow?>">价格<i class="icon <?if(req('sc')=='desc'){?>sort-up<?}else{?>sort-down<?}?>"> &nbsp;</i></a> </li>
								<?}?>
							</ul>
						</div>
						
						<div class="spotList_main2_title_right">
							<div class="yema">页码：<b><?=$pageNo?></b>/<?=$totalPage?></div>
							<a href="<?=$nowUrl?><?=$pagepre?>"><? if($pageNo>1){ ?><span class="leftBtn_hover"><?}else{?><span class="leftBtn"><?}?></span></a>
							<a href="<?=$nowUrl?><?=$pagenext?>"><? if($pageNo==$totalPage){ ?><span class="rightBtn_hover"><?}else{ ?><span class="rightBtn"><?}?></span></a>
						</div>
					</div>
					<!-- 如果有数据 -->
					<? if(!empty($liebiao['data']['rows'])){ ?>
					<!-- 遍历景区开始 -->
					<? foreach($liebiao['data']['rows'] as $k=>$data){ ?>
					<!-- if判断如果不是飞猪自营 -->
					<? if($data['aLiData']==''){ ?>
					<div class="spotList_main2_content">
						<div class="spotList_main2_content1">
							<div class="spotList_main2_content1_left">
								<img src="<?=($data['imgUrl'])?>" class="ticket_info_img" onerror= "javascript:this.src='/themes/s01/images/lv_list_defaultss.jpg' " onclick="window.open('<?=$g_self_domain?>/menpiao/ticket_detail-<?=$data['lvProductId']?>-<?=$data['scenicId']?>.html')" style="cursor:pointer"
>
								<div class="ticket_info">
									<div class="ticket_info_title"><a href="<?=$g_self_domain?>/menpiao/ticket_detail-<?=$data['lvProductId']?>-<?=$data['scenicId']?>.html" target="_blank"><?=jiequ(18,$data['goodsName'])?></a><span><?=($data['scenicCity'])?></span></div>
									<div class="starlab"><?=($data['scenicLevel'])?></div>
									<div class="ticket_info_address" title="<?=$data['detailAddress']?>">地址：<?=jiequ(25,$data['detailAddress'])?><a href="<?=$g_self_domain?>/menpiao/ticket_detail-<?=$data['lvProductId']?>-<?=$data['scenicId']?>.html?isMap=1">地图</a></div>
									<? if(empty($data['lvProductId'])){ ?>
									<div class="ticket_info_feature" title="<?=$data['feature']?>">特色：<?=jiequ(25,$data['feature'])?></div>
									<?}?>
								</div>
							</div>
							<div class="spotList_main2_content1_right">
								<div class="ticket_info_price"><b>&yen;<?=($data['minPrice'])?></b>起</div>
								<a href="<?=$g_self_domain?>/menpiao/ticket_detail-<?=$data['lvProductId']?>-<?=$data['scenicId']?>.html" class="toDetail" target="_blank">查看详情</a>
								<span style="color: #51d4ac;width:190px;display: inline-block;text-align: center;font-weight: bold;line-height:32px;">满意度：<?
                                    $randvalue = randomFloat(0.9,1) * 100;
                                    $randvalue = sprintf("%0.2f", $randvalue).'%';
                                    if($data['favorableRate'] == '0.0%' || $data['favorableRate'] == '0%') echo $randvalue;else echo $data['favorableRate'];
                                    ?></span>
							</div>
						</div>
						<div class="spotList_main2_content2">
							<span style="color:#fb7a03;width:410px;padding-left:20px; ">景点门票</span>
							<span style="width:50px;text-align: center;">门市价</span>
							<span style="width:65px;text-align: center;">bus365价</span>
							<span style="float: right;padding-right: 135px;">支付方式</span>
						</div>
						<!-- 判断是否超过三条开始 如果超过三条-->
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
										
										<div class="reserve" ><a href="<?=$g_self_domain?>/menpiao/ticket_order-<?=urlencode($data['goodsName'])?>-<?=urlencode($data['ticketMapList'][0]['ticketTypeName'])?>-<?=($data['ticketMapList'][0]['isEmail'])?>-<?=($data['ticketMapList'][0]['ticketType'])?>-<?=($data['goodsId'])?>-<?=($data['lvProductId'])?>-<?=($data['ticketMapList'][0]['lvGoodsId'])?>.html" target="_blank">预定</a></div>
									</div>
									
									<div class="spotTicket_infoHide">
										<dl class=""><dt>费用包含</dt><dd><?=($data['ticketMapList'][0]['costInclude'])?></dd></dl>
										<dl class=""><dt>预定时间</dt><dd><?=($data['ticketMapList'][0]['bookTime'])?></dd></dl>
										<dl class=""><dt>入园须知</dt><dd>1.入园时间：<?=($data['ticketMapList'][0]['limitTime'])?><br>2.入园地点：<?=($data['ticketMapList'][0]['visitAddress'])?><br>3.取票时间：<?=($data['ticketMapList'][0]['getTicketTime'])?><br>4.取票地点：<?=($data['ticketMapList'][0]['getTicketPlace'])?><br>5.入园方式：<?=($data['ticketMapList'][0]['ways'])?><br>6.有效期限：&nbsp;<?=($data['ticketMapList'][0]['effectiveDesc'])?>
										<br>7.通关限制：&nbsp;<?=($data['ticketMapList'][0]['passLimit'][0]['lvGoodsName'])?>在下单后<?=$data['ticketMapList'][0]['passLimit'][0]['passLimitTime']?>分钟可入园</dd></dl>
										<dl class=""><dt>重要提示</dt><dd><?=($data['ticketMapList'][0]['importentPoint'])?></dd></dl>
										<dl class=""><dt>退改说明</dt><dd><?=($data['ticketMapList'][0]['refundRuleNotice'])?></dd></dl>

										<span class="spotTicket_pickUp">收起</span>
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
										<div class="reserve" ><a href="<?=$g_self_domain?>/menpiao/ticket_order-<?=urlencode($data['goodsName'])?>-<?=urlencode($data['ticketMapList'][1]['ticketTypeName'])?>-<?=($data['ticketMapList'][1]['isEmail'])?>-<?=($data['ticketMapList'][1]['ticketType'])?>-<?=($data['goodsId'])?>-<?=($data['lvProductId'])?>-<?=($data['ticketMapList'][1]['lvGoodsId'])?>.html" target="_blank">预定</a></div>
									</div>
									<div class="spotTicket_infoHide">
										<dl class=""><dt>费用包含</dt><dd><?=($data['ticketMapList'][1]['costInclude'])?></dd></dl>
										<dl class=""><dt>预定时间</dt><dd><?=($data['ticketMapList'][1]['bookTime'])?></dd></dl>
										<dl class=""><dt>入园须知</dt><dd>1.入园时间：<?=($data['ticketMapList'][1]['limitTime'])?><br>2.入园地点：<?=($data['ticketMapList'][1]['visitAddress'])?><br>3.取票时间：<?=($data['ticketMapList'][1]['getTicketTime'])?><br>4.取票地点：<?=($data['ticketMapList'][1]['getTicketPlace'])?><br>5.入园方式：<?=($data['ticketMapList'][1]['ways'])?><br>6.有效期限：&nbsp;<?=($data['ticketMapList'][1]['effectiveDesc'])?><br>7.通关限制：&nbsp;<?=($data['ticketMapList'][1]['passLimit'][0]['lvGoodsName'])?>在下单后<?=$data['ticketMapList'][1]['passLimit'][0]['passLimitTime']?>分钟可入园</dd></dl>
										<dl class=""><dt>重要提示</dt><dd><?=($data['ticketMapList'][1]['importentPoint'])?></dd></dl>
										<dl class=""><dt>退改说明</dt><dd><?=($data['ticketMapList'][1]['refundRuleNotice'])?></dd></dl>

										<span class="spotTicket_pickUp">收起</span>
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
										<div class="reserve" ><a href="<?=$g_self_domain?>/menpiao/ticket_order-<?=urlencode($data['goodsName'])?>-<?=urlencode($data['ticketMapList'][2]['ticketTypeName'])?>-<?=($data['ticketMapList'][2]['isEmail'])?>-<?=($data['ticketMapList'][2]['ticketType'])?>-<?=($data['goodsId'])?>-<?=($data['lvProductId'])?>-<?=($data['ticketMapList'][2]['lvGoodsId'])?>.html" target="_blank">预定</a></div>
									</div>
									<div class="spotTicket_infoHide">
										<dl class=""><dt>费用包含</dt><dd><?=($data['ticketMapList'][2]['costInclude'])?></dd></dl>
										<dl class=""><dt>预定时间</dt><dd><?=($data['ticketMapList'][2]['bookTime'])?></dd></dl>
										<dl class=""><dt>入园须知</dt><dd>1.入园时间：<?=($data['ticketMapList'][2]['limitTime'])?><br>2.入园地点：<?=($data['ticketMapList'][2]['visitAddress'])?><br>3.取票时间：<?=($data['ticketMapList'][2]['getTicketTime'])?><br>4.取票地点：<?=($data['ticketMapList'][2]['getTicketPlace'])?><br>5.入园方式：<?=($data['ticketMapList'][2]['ways'])?><br>6.有效期限：&nbsp;<?=($data['ticketMapList'][2]['effectiveDesc'])?><br>7.通关限制：&nbsp;<?=($data['ticketMapList'][2]['passLimit'][0]['lvGoodsName'])?>在下单后<?=$data['ticketMapList'][2]['passLimit'][0]['passLimitTime']?>分钟可入园</dd></dl>
										<dl class=""><dt>重要提示</dt><dd><?=($data['ticketMapList'][2]['importentPoint'])?></dd></dl>
										<dl class=""><dt>退改说明</dt><dd><?=($data['ticketMapList'][2]['refundRuleNotice'])?></dd></dl>

										<span class="spotTicket_pickUp">收起</span>
									</div>
								</li>
								</ul>
								
								<ul class="lists_hide">
								<!-- 遍历大于三的需要隐藏部分 -->
								<? foreach($data['ticketMapList'] as $key=>$value){ ?>
								<? if($key>2){ ?><!-- 超过三条情况下 大于三的隐藏 开始 -->
								<li>
									<div class="spotTicket_info">
										<div class="spotTicket">
											<span class="ticketType"><?=($value['ticketTypeName'])?></span> --<?=($value['lvGoodsName'])?><?=($value['advanceBookingTime'])?>
											<span class="subtriangle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
										</div>
										
										<div class="meshiPrice">&yen;<? if($value['marketPrice'] != $value['minPrice']){ ?><?=($value['marketPrice']);?><?}else{echo $value['marketPrice']+5;}?></div>
										<div class="ourPrice">&yen;<?=($value['minPrice']);?></div>
										<div class="payType"><?=($value['paymentType']);?></div>
										<div class="reserve"><a href="<?=$g_self_domain?>/menpiao/ticket_order-<?=urlencode($data['goodsName'])?>-<?=urlencode($value['ticketTypeName'])?>-<?=($value['isEmail'])?>-<?=($value['ticketType'])?>-<?=($data['goodsId'])?>-<?=($data['lvProductId'])?>-<?=($value['lvGoodsId'])?>.html" target="_blank">预定</a></div>
									</div>
									<div class="spotTicket_infoHide">
										<dl class=""><dt>费用包含</dt><dd><?=($value['costInclude'])?></dd></dl>
										<dl class=""><dt>预定时间</dt><dd><?=($value['bookTime'])?></dd></dl>
										<dl class=""><dt>入园须知</dt><dd>1.入园时间：<?=($value['limitTime'])?><br>2.入园地点：<?=($value['visitAddress'])?><br>3.取票时间：<?=($value['getTicketTime'])?><br>4.取票地点：<?=($value['getTicketPlace'])?><br>5.入园方式：<?=($value['ways'])?><br>6.有效期限：&nbsp;<?=($value['effectiveDesc'])?><br>7.通关限制：&nbsp;<?=($value['passLimit'][$key]['lvGoodsName'])?>在下单后<?=$value['passLimit'][$key]['passLimitTime']?>分钟可入园</dd></dl>
										<dl class=""><dt>重要提示</dt><dd><?=($value['importentPoint'])?></dd></dl>
										<dl class=""><dt>退改说明</dt><dd><?=($value['refundRuleNotice'])?></dd></dl>

										<span class="spotTicket_pickUp">收起</span>
									</div>
								</li>
								<? } ?><!-- 超过三条情况下 大于三的隐藏 结束 -->
								<? } ?><!-- 遍历大于三的需要隐藏部分结束 -->
								
							
								</ul>
							<div class="toAll subtriangle">查看全部(<?=$rest?>)</div>
						</div>
						<!-- 如果数据没有超过三条 -->
						<? }else{ ?>
						<div class="spotList_main2_content3">
						
							<ul>
							<!-- 遍历没有超过三条的数据 -->
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
										<div class="reserve"><a href="<?=$g_self_domain?>/menpiao/ticket_order-<?=urlencode($data['goodsName'])?>-<?=urlencode($value['ticketTypeName'])?>-<?=($value['isEmail'])?>-<?=($value['ticketType'])?>-<?=($data['goodsId'])?>-<?=($data['lvProductId'])?>-<?=($value['lvGoodsId'])?>.html" target="_blank">预定</a></div>
										
									</div>
									<div class="spotTicket_infoHide">
										<dl class=""><dt>费用包含</dt><dd><?=($value['costInclude'])?></dd></dl>
										<dl class=""><dt>预定时间</dt><dd><?=($value['bookTime'])?></dd></dl>
										<dl class=""><dt>入园须知</dt><dd>1.入园时间：<?=($value['limitTime'])?><br>2.入园地点：<?=($value['visitAddress'])?><br>3.取票时间：<?=($value['getTicketTime'])?><br>4.取票地点：<?=($value['getTicketPlace'])?><br>5.入园方式：<?=($value['ways'])?><br>6.有效期限：&nbsp;<?=($value['effectiveDesc'])?><br>7.通关限制：&nbsp;<?=($value['passLimit'][$key]['lvGoodsName'])?>在下单后<?=$value['passLimit'][$key]['passLimitTime']?>分钟可入园</dd></dl>
										<dl class=""><dt>重要提示</dt><dd><?=($value['importentPoint'])?></dd></dl>
										<dl class=""><dt>退改说明</dt><dd><?=($value['refundRuleNotice'])?></dd></dl>

										<span class="spotTicket_pickUp">收起</span>
									</div>
								</li>
								<!-- 遍历三条数据结束 -->
							<? }?>
								</ul>
						</div>
						<!-- 没有超过三条的if判断结束 -->
						<? } ?>
					</div>
					<!-- 飞猪自营 -->
					
					<!-- if判断下的飞猪自营  开始 -->
					<? }else{ ?>
				<div class="spotList_main2_content">
					<div class="spotList_main2_content1">
							<div class="spotList_main2_content1_left">
								<img src="<?=($data['imgUrl'])?>" class="ticket_info_img" onerror= "javascript:this.src='/themes/s01/images/lv_list_default.png' " onclick="window.open('<?=$data['pcALiDetailLink']?>')" style="cursor:pointer"
>
								<div class="ticket_info">
									<div class="ticket_info_title"><a href="<?=$data['pcALiDetailLink']?>" target="_blank"><?=jiequ(18,$data['goodsName'])?></a><span><?=($data['scenicCity'])?></span></div>
									<div class="starlab"><?=($data['scenicLevel'])?></div>
									<div class="ticket_info_address" title="<?=$data['detailAddress']?>">地址：<?=jiequ(25,$data['detailAddress'])?></div>
									<? if(!empty($data['feature'])){ ?>
									<div class="ticket_info_feature" title="<?=$data['feature']?>">特色：<?=jiequ(25,$data['feature'])?></div>
									<? } ?>
								</div>
							</div>
							<div class="spotList_main2_content1_right">
								<div class="ticket_info_price"><b>&yen;<?=($data['minPrice'])?></b>起</div>
								<a href="<?=$data['pcALiDetailLink']?>" target="_blank" class="toDetail">查看详情</a>
								<p style="text-align: center;color: #1fcc9e;line-height: 28px;">*本数据由飞猪提供</p>
							</div>
						</div>
					</div>
				
				<!-- if下的飞猪自营结束 -->	
				<!-- 遍历景区结束 -->
				<!-- 若果没数据 -->
				<? } } }else{ ?>
				<div class="box-warning bw-bold mb15" style="margin-top:20px">
		            <i class="icon waring-sm"></i>很抱歉，没有找到<?if($keywords!=''){?>与 <b class="yellow-a">“<?=$keywords?>”</b> <?}?>相关的产品，要不看看其它产品，或者换个关键词搜索！
		        </div>
		        <? } ?>
		        <!-- 判断是否有数据结束 -->
					<div class="spotList_main2_title">
						<div class="spotList_main2_title_right">
							<div class="yema">页码：<b><?=$pageNo?></b>/<?=$totalPage?></div>
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
				<?//include(load_user_diy('diy.x05.html'));这里貌似是放广告的?>
				<div class="spotList_main_right1">
					<h3>猜您喜欢</h3>

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
								<div class="youLikePrice">&yen;<?=$val['min_price']?>起</div>
								<div class="youLikeTime"><?=date('m/d H:i', strtotime($val['browse_time']))?>浏览过</div>
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
					<h3><?=$c_catalog['cat_name']?>旅游攻略</h3>
					<?
				    foreach ($goods_article as $val){  
						$news_url = get_news_url($val['thread_id']);
			        ?>
					<ul>
					
						<li><a href="<?=$news_url?>" targe="_blank"><?=$val['title']?></a></li>
						<li><?=date('Y/m/d', strtotime($val['addtime']))?> 浏览<?=$val['clicks']?>次</li>
					
					</ul>
					<?}?>
				</div>
				<?}?>
				
			</div>
		</div>
	</div>
	<!-- main内容 end -->


	<!--  foot  start -->
<?include('foot.php');?>
</body>

</html>