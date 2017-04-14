<!DOCTYPE html>
<html>
<head>
<meta charset="gbk" />
<title><?$this_page_title==''?print '全部产品':print $this_page_title;?> - <?=$g_sitename?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" /> 
<script src="/ajax/jquery-1.7.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="/images/common_<?=$g_mobile_style?>.css" />
<link rel="stylesheet" type="text/css" href="http://apps.bdimg.com/libs/fontawesome/4.4.0/css/font-awesome.min.css" />

</head> 
<header class="header"><a class="fl" href="<?=$g_domain?>"><i class="b_1"></i><i class="b_2"></i></a><a href="/news/gonglue/">旅游资讯</a><a href="/" class="tool" style="font-size:24px"><span class="fa fa-home "></span></a></header>

<div class="m-main">
  <?if(req('keywords')!=''){?>
  <h2 align="center">搜索关键词<b style="color:red">“<?=req('keywords')?>”</b></h2>
  <?}?>
  <?if(notnull($query_rows)){?>
  <section class="main-xl">
    <div class="change-type">
      <div class="fex">
	    <? 
		$i = 1; 
		foreach ($query_rows as $val){     
			$news_image = "/upfiles/$g_siteid/".$val['image']; 
		?>
        <div class="m-list"> <a href="/news/detail-<?=$val['thread_id']?>.html">
          <div class="m-img"><img class="lazy img-responsive" data-original="<?=$news_image?>" alt="<?=$val['title']?>"></div>
          <div class="m-c">
            <div class="m-c-bg">
              <p <?if($val['is_hot']==1){?>style="color:red"<?}?>><b><?=$val['title']?></b></p>
              <p class="m-c-txt"><?=show_substr($val['summary'],60)?></p>
            </div>
          </div>
          </a> </div>
		<?
			$i++; 
		} 
		?>
        <div class="trip-pages"> 
          <div class="last-page"> <a href="?p=<?=$prev_number.$page_args?>" ><span class="arrow-lt"></span>上一页</a> </div>
          <div class="select-page">
            <div class="select-txt"><span><?=$now_page?>/<?=$total_page?></span></div>
            <select class="select-list j-page-select" >
			  <?for($m=1; $m<=$total_page; $m++){?>
              <option value="<?=$m?>" selected onclick="location.replace('?p='+this.value)" >第<?=$m?>页</option>
			  <?}?> 
            </select>
          </div>
          <div class="next-page"><a href="?p=<?=$next_number.$page_args?>" >下一页<span class="arrow-rt"></span></a></div>
        </div>
      </div>
    </div>
  </section>
  <?} else {?>
  <div class="container_fixed" id="page_1">
	  <div class="home_banner plr10 clearfix"> 
			<h1><br/><br/>抱歉！产品准备中，敬请期待……<br/><br/><br/><br/></h1> 
	  </div> 
  </div> 
  <?}?>
</div> 
<ul class="botListUl">
		<li> <a href="/" class="icon1"> <span></span>
			<p>首页</p>
			</a>
		<li> <a href="/search?hot=yes" class="icon2"> <span></span>
			<p>推荐</p> 
			</a> </li>
		<li> <a href="/local/" class="icon3"> <span></span>
			<p>门店</p>
			</a> </li>
		<li> <a href="/leader/" class="icon4"> <span></span>
			<p>顾问</p> 
			</a> </li>
		<li> <a href="/member/" class="icon5"> <span></span>
			<p>我的</p>
			</a> </li>
	</ul>
<div class="foot"> 
  <?include('foot.php');?>
</div>
</body> 
</html>