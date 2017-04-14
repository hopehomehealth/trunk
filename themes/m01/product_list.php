<!DOCTYPE html>
<html>
<head>
<meta charset="gbk" />
<title><?$this_page_title==''?print 'ȫ����Ʒ':print $this_page_title;?> - <?=$g_sitename?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" /> 
<script src="/ajax/jquery-1.7.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="/images/common_<?=$g_mobile_style?>.css" />
<link rel="stylesheet" type="text/css" href="http://apps.bdimg.com/libs/fontawesome/4.4.0/css/font-awesome.min.css" />
</head> 


<header class="header"><a class="fl" href="<?=$g_domain?>"><i class="b_1"></i><i class="b_2"></i></a><a href="javascript:;"><?=$g_sitename?></a><a href="/" class="tool" style="font-size:24px"><span class="fa fa-home "></span></a></header>

<div class="m-main">
  <?if(req('keywords')!=''){?>
  <h2 align="center">�����ؼ���<b style="color:red">��<?=req('keywords')?>��</b></h2>
  <?}?>
  <?if(notnull($query_rows)){?>
  <section class="main-xl">
    <div class="change-type">
      <div class="fex">
	    <? 
		$i = 1; 
		foreach ($query_rows as $val){     
			$goods_image = "/upfiles/$g_siteid/".$val['goods_image']; 
		?>
        <div class="m-list"> <a href="<?=$g_domain?>product/detail-<?=$val['goods_id']?>.html">
          <div class="m-img"><img class="lazy img-responsive" data-original="<?=$goods_image?>" alt="<?=$val['goods_name']?>"></div>
          <div class="m-c">
            <div class="m-c-bg">
              <p <?if($val['is_hot']==1){?>style="color:red"<?}?>><code><?=$val['goods_name']?></code></p>
              <p class="m-c-txt"> <span><em class="c-1"><?=$g_product_type[$val['goods_type']]?></em></span> <strong><?=$val['min_price']?><em class="co-1">Ԫ��</em></strong> </p>
            </div>
          </div>
          </a> </div>
		<?
			$i++; 
		} 
		?>
        <div class="trip-pages"> 
          <div class="last-page"> <a href="?p=<?=$prev_number.$page_args?>" ><span class="arrow-lt"></span>��һҳ</a> </div>
          <div class="select-page">
            <div class="select-txt"><span><?=$now_page?>/<?=$total_page?></span></div>
            <select class="select-list j-page-select" >
			  <?for($m=1; $m<=$total_page; $m++){?>
              <option value="<?=$m?>" selected onclick="location.replace('?p='+this.value)" >��<?=$m?>ҳ</option>
			  <?}?> 
            </select>
          </div>
          <div class="next-page"><a href="?p=<?=$next_number.$page_args?>" >��һҳ<span class="arrow-rt"></span></a></div>
        </div>
      </div>
    </div>
  </section>
  <?} else {?>
  <div class="container_fixed" id="page_1">
	  <div class="home_banner plr10 clearfix"> 
			<h1><br/><br/>��Ǹ����Ʒ׼���У������ڴ�����<br/><br/><br/><br/></h1> 
	  </div> 
  </div> 
  <?}?>
</div> 
<ul class="botListUl">
		<li> <a href="/" class="icon1"> <span></span>
			<p>��ҳ</p>
			</a>
		<li> <a href="/search?hot=yes" class="icon2"> <span></span>
			<p>�Ƽ�</p> 
			</a> </li>
		<li> <a href="/local/" class="icon3"> <span></span>
			<p>�ŵ�</p>
			</a> </li>
		<li> <a href="/leader/" class="icon4"> <span></span>
			<p>����</p> 
			</a> </li>
		<li> <a href="/member/" class="icon5"> <span></span>
			<p>�ҵ�</p>
			</a> </li>
</ul>
<script language="javascript" src="/ajax/lazyload-1.9.1/jquery.lazyload.min.js"></script>
<script type="text/javascript" charset="utf-8">
$(function() {
	$("img.lazy").lazyload({effect: "fadeIn"});
});
</script>
</body> 
</html>