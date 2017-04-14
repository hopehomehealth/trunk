
<!DOCTYPE html>
<html>
<head>
<meta charset="gbk" />
<?seo();?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" /> 

<link rel="stylesheet" type="text/css" href="/images/common_<?=$g_mobile_style?>.css" />
<link rel="stylesheet" type="text/css" href="/images/detail_<?=$g_mobile_style?>.css" />  
<script type="text/javascript" src="/ajax/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/member/plugin.php?cmd=browse&goods_id=<?=$c_goods_id?>"></script>
<link rel="stylesheet" type="text/css" href="http://apps.bdimg.com/libs/fontawesome/4.4.0/css/font-awesome.min.css" />

<script type="text/javascript">
function is_weixn(){
    var ua = navigator.userAgent.toLowerCase();
    if(ua.match(/MicroMessenger/i)=="micromessenger") {
        return true;
    } else {
        return false;
    }
}
</script>
</head> 
<div id="page_2">
  <header class="header"><a class="fl" href="javascript:void(0)"><i class="b_1"></i><i class="b_2"></i></a><a href="javascript:;"></a></header>
  <div class="m-main"></div>
</div>
<div id="page_1">
  <header class="header"><a class="fl" href="javascript:history.back()"><i class="b_1"></i><i class="b_2"></i></a><a href="tel:<?=$g_profile['hot_line']?>">Ԥ������ <?=$g_profile['hot_line']?></a><a href="/" class="tool" style="font-size:24px"><span class="fa fa-home "></span></a></header>
  <div class="m-main">
    <section class="main-line pb66px">
      <div class="line-img mt10">
        <div class="line-s-m"> <img src="<?=$c_goods_image?>">
          <div class="img-bg"></div>
          <div class="img-t"><span class="fl"><em><?=$c_goods['clicks']?></em>�˹�ע <!--&nbsp;&nbsp;&nbsp;&nbsp;����ɽ�<em><?=$stat_order_total?></em>��--></span><a id="add_fav" class="book_a fr" href="#order" ><b>&yen;<?=$c_goods['min_price']?></b></a></div>
        </div>
      </div>
      <h1 class="line-tit plr10"><em class="c-0" style="font-size:14px;"><?=$g_product_type[$c_goods['goods_type']]?></em> <?=$c_goods['goods_name']?><i class="icon-alipay"></i> </h1>
	  
      <div class="plr10 line-txt">
        <div class="line-basic-info clearfix">
          <div class="bi_1">
            <div class="bis">
              <p>��Ʒ���</p>
              <p><?=$c_goods['goods_code']?></p>
            </div>
            <div class="bis">
              <p>��������</p>
              <p> <?=$c_goods['src_prov']?> <?=$c_goods['src_city']?> </p>
            </div>
            <div class="bis">
              <p>Ŀ�ĵ�</p>
              <p><?=$c_goods['dist_prov']?> <?=$c_goods['dist_city']?></p>
            </div>
          </div>
		  
          <div class="bi_2"> 
			<span>�����̣�</span> 
			<a href="/shop<?=$c_shop['shop_id']?>/"><?=$c_shop_name?></a>
			
			<span style="float:right"><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?=$g_profile['qq']?>&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:<?=$g_profile['qq']?>:51" alt="QQ��ѯ" title="QQ��ѯ"/></a></span>
		  </div>
        </div>

		<a name="order"></a>
		
        <div class="line-block">
          <div class="select_2">
            <ul>
              <li class="line-i-w"><a href="javascript:void(0)" class="left"><i class="link-img c1"></i><span class="name">��Ʒ����</span>  <i style="float:right">��ǰ<em><?=$c_goods['before_days']?>��</em>����</i> </a>
			  
			  </li>
              <div class="line-i-c adaptive-div" style="height: auto;"> 
                <div class="line-i-c-h" style="overflow:hidden">  
				<div class="tour_vdate" id="td_tour_vdate"> 
					<div class="tour_vcount"> 
						<div class="m20">
						  <div class="vcount"> 
							<div class="mt10">
							  
							  <select name="departdate" id="departdate" style="width:100%;height:28px;"> 
								<? 
								foreach ($adult_price as $key => $value) { 
									$this_week = date('w',strtotime($key));
									if($value!=''){
								?>
								<option value="<?=$key?>"><?=date('m��d',strtotime($key))?> <?=$value?>Ԫ/�� <?if($kid_price[$key]!=''){?><?=$kid_price[$key]?>Ԫ/��ͯ<?}?> <?if($diff_price[$key]!=''){?>(������<?=$diff_price[$key]?>/��)<?}?></option>
								<?  
									}
								}
								?> 
							  </select> 
							 
							  <div style="margin-top:10px;margin-bottom:10px;"> 
								<select name="adult_num" id="adult_num" style="float:left;width:50%;height:28px;" onChange="count_price()">
									<option value="0">ѡ���������</option>
									<?for($i=1;$i<=50;$i++){?>
									<option value="<?=$i?>"><?=$i?></option>
									<?}?> 
								</select>
								  
								<select name="kid_num" id="kid_num" style="float:right;width:48%;height:28px;" onChange="count_price()"> 
									<option value="0">ѡ���ͯ����</option>
									<?for($i=1;$i<=50;$i++){?>
									<option value="<?=$i?>"><?=$i?></option>
									<?}?>  
								</select>
							  </div>

							  <script type="text/javascript"> 
								  function order_window(){
									  <?if($g_userid==''){?>
									  alert('�Բ�������δ��¼��');
									  location.href='/member/login?ref=<?=urlencode($g_full_url)?>';
									  return false;
									  <?}?>

									  <?if($c_goods['is_sale']=='0'){?>
									  alert('�ò�Ʒ���¼ܣ����ܶ�����');
									  return false;
									  <?}?>

									  if($('#departdate').val()=='') {
										  alert('�ף���û��ѡ��������ڣ�');
										  return false;
									  }

									  if($('#adult_num').val()=='0') {
										  alert('�ף���û��ѡ��������');
										  return false;
									  }

									  var url="";
									  url = "/member/<?=url('checkout.php')?>";
									  url += "&goods_id=<?=$c_goods['goods_id']?>";
									  url += "&goods_type=<?=$c_goods['goods_type']?>";
									  url += "&adult_num="+$('#adult_num').val();
									  url += "&kid_num="+$('#kid_num').val();
									  url += "&departdate="+$('#departdate').val(); 
									  location.href = url;
									  return true;
								  }   
							  </script>  
								
							  <div style="clear:both;margin-top:10px;">
								  <br/>
								  <a class="btn btn_1" style="width:100%" onclick="return order_window();" href="javascript:void(0);">��������</a>
							  </div>   
							</div> 

							<div class="mt10"> 
							  <div id="traveller_num">
								<div id="c_rooms"> 
								  <div style="font-size:12px;color:#999">��ͯ�۱�׼�����0.8~1.2�ף���������ռ����ֻ������λ�ѣ����������������</div> 

								  <div class="alert" style="font-size:12px">����Ԥ����ֱ������ǩ�����κ�ͬ����ͬ���Զ����������ĵ������䣬���Ӻ�ͬ��ֽ�ʺ�ͬ����ͬ�ȷ���Ч����</div>

								  <div class="clear"></div>
								  </div>
								</div>
							  </div>
							</div>
						  </div>
						  <?if($g_misc['taobao_order_url']!=''){?> 
						  <div class="vresult" id="taobao_note"> 
							<div class="mt10" style="padding:10px">  
							  <div class="mt10"><a href="<?=$g_misc['taobao_order_url']?>" class="btn btn-warning"><img src="/images/m_taobao.png"></a></div>
							  <p>ʹ���Ա�Ԥ���������б��ϣ����θ����ġ�</p>
							</div>
						  </div>
						  <script type="text/javascript">
						  var wx = is_weixn();
						  if(wx == true){
							  $('#taobao_note').css('display', 'none');
						  }
						  </script>
						  <?}?>
						</div> 
					</div>
                </div>
               
              </div>
            </ul>
          </div>
        </div>

		<div class="line-block">
          <div class="select_2">
            <ul>
              <li class="line-i-w"><a href="javascript:void(0)" class="left"><i class="link-img c1"></i><span class="name">�г̰���</span> <span style="float:right"><b><?=$c_goods['line_days']?></b>��<b><?=$c_goods['line_nights']?></b>��</span></a></li>
              <div class="line-i-c adaptive-div" style="height: auto;"> 
                <div class="line-i-c-h" style="overflow:hidden">
					<div id="content_desc">
					  <style type="text/css">
					  .content_image{
						margin-bottom:10px;
					  } 
					  .content_image img{
						width:100%; 
					  }
					  </style> 
					  <? 
					  $goods_content = stripslashes($c_goods['content']); 
					  $goods_content = str_replace('<img', '<img onerror="this.style.display=\'none\'" ', $goods_content);
					  echo $goods_content;
					  ?>  

					  <? 
					  if(notnull($all_titles)){
						foreach ($all_titles as $key => $v) { 
					  ?>
						<table width="100%" border="0">
						  <tr>
							<td style="background-color:#808185;width:4px;height:30px;"></td> 
							<td style="background-color:#F3F3F3;padding-left:10px;font-size:12px"> ��<?=$key?>��- <?=$v?> &nbsp;</td>
						  </tr>
						</table>
						<table width="100%" border="0">
						  <tr> 
							<td style="font-size:12px;padding-top:10px"><?=nl2br($all_contents[$key])?></td>
						  </tr>
						</table>
						<table class="content_image" width="100%" border="0">
						  <tr> 
						    <?for($g=1; $g<=4; $g++){
								$img = $all_images[$key][$g];
								if($img!=''){
							?>
							<td> <img src="<?=$img?>" width="90%" onerror="this.style.display='none'"/> </td> 
							<?
								}
							}
							?>
						  </tr>
						</table> 
						<p>ס�ޣ�<?=$all_tools[$key]['house']?> �òͣ�<?=$all_tools[$key]['food']?> ��ͨ��<?=$all_tools[$key]['traffic']?></p>
						<p>&nbsp;</p>
						<?
						   }
					    }
					    ?>
						 
					</div>
                </div>
                
              </div>
            </ul>
          </div>
        </div> 

		<div class="line-block">
          <div class="select_2">
            <ul>
              <li class="line-i-w"><a href="javascript:void(0)" class="left"><i class="link-img c1"></i><span class="name">���ð���</span> </a></li>
              <div class="line-i-c adaptive-div" style="height: auto;"> 
                <div class="line-i-c-h" style="overflow:hidden">
					<?=nl2br(stripslashes($c_goods['price_note']))?>
                </div> 
              </div>
            </ul>
          </div>
        </div>

		<div class="line-block">
          <div class="select_2">
            <ul>
              <li class="line-i-w"><a href="javascript:void(0)" class="left"><i class="link-img c1"></i><span class="name">���ò���</span> </a></li>
              <div class="line-i-c adaptive-div" style="height: auto;"> 
                <div class="line-i-c-h" style="overflow:hidden">
					<?=nl2br(stripslashes($c_goods['unprice_note']))?>
                </div> 
              </div>
            </ul>
          </div>
        </div>
 

		<div class="line-block">
          <div class="select_2">
            <ul>
              <li class="line-i-w"><a href="javascript:void(0)" class="left"><i class="link-img c1"></i><span class="name">Ԥ��ָ��</span> </a></li>
              <div class="line-i-c adaptive-div" style="height: auto;"> 
                <div class="line-i-c-h" style="overflow:hidden">
					<p>
					1��������д��ɲ��ύ�ɹ��������Լ�ʱ��������֧����
					�����������κ���������Ҳ����ͨ����վ�ṩ����ϵ��ʽ������ϵ���ǡ�
					<br/><br/>
					2����Ʒ��֧������֧�������ṩ�����������С����ÿ���֧�������Ƹ�ͨ�ȶ�����������������֧����
					����֧���ɹ���<a href="<?=$g_domain?>">�Ϸ�������</a>��ͬ�漴�ᷢ�������Ļ�Ա���ģ���������ʱ���ģ�����Ҫ���Ӳ���������ǼӸǺ�ͬ�£�������ϵ���ǣ����ǻ�Ϊ���ṩ��Ӧ�ķ���
					<br/><br/>
					3��<a href="<?=$g_domain?>"><?=$g_sitename?></a>�̼һ����������ڳ���ǰ�����������������⣬��֤���Ŀ��ĳ��Ρ�
					<br/><br/>
					4�����ι���д�μǣ��л�����ȫ����������ȯ��
					</p>
                </div>
                 
              </div>
            </ul>
          </div>
        </div>


		<div class="line-block">
          <div class="select_2">
            <ul>
              <li class="line-i-w"><a href="javascript:void(0)" class="left"><i class="link-img c1"></i><span class="name">�ο͵���</span> </a></li>
              <div class="line-i-c adaptive-div" style="height: auto;"> 
                <div class="line-i-c-h" style="overflow:hidden">  
					  <?  
					  if(notnull($comment_list)){ 
						foreach ($comment_list as $val){ 
							if($val['nickname']!='')		$nick = $val['nickname'];
							elseif($val['username']!='')	$nick = $val['username'];
							elseif($val['account']!='')		$nick = $val['account']; 
					  ?>
					  <div class="mytour_together_list">
						<div class="fl m10" style="width:85px;">
						  <div class="ac mt10"><a href="#/user/view/id-20520" target="_blank"><img style="height:65px; width:65px;" src="/images/no_avatar.png" class="img-circle"></a></div> 
						</div>
						<div class="fr ltl_d">
						  <div class="ptb10">
							<div class="fl d550 f14"><a class="ffc1" href="#" target="_blank"><?=$nick?></a></div>
							<div class="fl ml20"> <span class="ml10 fc12 f14"> <?=date('Y/m/d',strtotime($val['addtime']))?> </span> </div>
							<div class="clear"></div>
						  </div> 
						  <div id="tour_qa_a_2023" class="d750 mt20 oh mytour_together_text tour_qa_a_text" rel="2023"><?=$val['content']?></div>
						  <div class="mt5" id="more_2023"></div>
						  <div class="h20"></div>
						</div>
						<div class="clear"></div>
					  </div>
					  <?
							}
						} else {
					  ?> 
						<p>�ò�Ʒ���޵�����������������ɻ����������ȯ��
						<br/><br/>
						<a href="javascript:member_dialog('/member/comment.php?goods_id=<?=$c_goods['goods_id']?>&goods_name=<?=addslashes($c_goods['goods_name'])?>',850,450,'');" class="btn btn-small btn-info">��Ҫ����</a></p>
					  <?}?> 
                </div> 
              </div>
            </ul>
          </div>
        </div>


		<div class="line-block">
          <div class="select_2">
            <ul>
              <li class="line-i-w"><a href="javascript:void(0)" class="left"><i class="link-img c1"></i><span class="name">������Ʒ�Ƽ�</span> </a></li>
              <div class="line-i-c adaptive-div" style="height: auto;"> 
                <div class="line-i-c-h" style="overflow:hidden">
					<?  
					$hot_goods_list = get_hot_goods_list($this_first_catalog_id, 4);
					if(notnull($hot_goods_list)){ 
						foreach ($hot_goods_list as $val){  
							$goods_image = "/upfiles/$g_siteid/".$val['goods_image'];
							
					?>  
					<div style="float:left;width:49%;">
						<a href="<?=$g_domain?>product/detail-<?=$val['goods_id']?>.html"><img src="<?=$goods_image?>" style="width:96%" alt="<?=$val['goods_name']?>" onerror="this.src='/images/scene_no_thumb.gif'" /></a>
					</div> 
					<div style="float:right;width:49%;">
						<a href="<?=$g_domain?>product/detail-<?=$val['goods_id']?>.html" class="ffc0"><?=$val['goods_name']?></a>
						<p><span class="f14">&yen;<?=$val['min_price']?></span> ��</p>
					</div>
					<div style="clear:both"></div>
					<? 
						}
					}
					?> 
                </div> 
              </div>
            </ul>
          </div>
        </div>
 
        <div class="line-block line-i-w" id="feature" >
          <p><i class="i1"></i><span>�οͱ���</span><em>��ŵ��Ʒ��ʵ������Ԥ���б���</em></p>
          <p><i class="i2"></i><span>��ʱȷ��</span><em>����Ʒ����ȷ�Ͽ�ֱ��Ԥ��</em></p>
          <p><i class="i3"></i><span>Ʒ�ʷ���</span><em>��ŵ�������꣬�����Է���Ŀ</em></p>
        </div>
      </div>
    </section>
  </div>
</div>
 
<div class="price-line clearfix" id="price-line">
  <div class="plr10"> 
    <p> <strong id="new_price"><i>&yen;</i><?=$c_goods['min_price']?><i>��</i></strong> <?if($c_goods['market_price']>0){?><del id="pre_price">&yen;<?=$c_goods['market_price']?></del><?}?> <a class="btn btn-inline btn_1" href="#order">Ԥ��</a> </p>
  </div>
</div>
 
</body>
</html>