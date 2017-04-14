<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}  
 
if(req('goods_id')==''){
	$sql = "SELECT a.*, b.goods_name FROM `t_goods_comment` a, `t_goods_thread` b WHERE a.goods_id=b.goods_id AND a.user_id='$g_userid' AND a.site_id='$g_siteid' ORDER BY a.comment_id DESC ";  
	$comments =  $db->get_all($sql); 
?>

<section class="m-frm-top">
    <div class="num"><span><?=sizeof($comments)?></span>我的点评</div>
    <i class="line"></i> 
    <a href="./" class="m-frm-top-btn" style="width:60px"> 返 回</a>
</section>

<section class="container"> 
		<?  
		if(notnull($comments)){ 
		?>
		<section class="m-frm-list "> 
			<ul>
			<? 
			foreach ($comments as $val){  	
			?>
				<li>
				  <div class="company" style="height:auto">
						<strong><?=$val['goods_name']?></strong> 
						<br/>
						<?=$val['content']?> 
					</div> 
					<div class="info">  
						<?=$val['addtime']?> 
				    </div> 
				</li> 
			<?
				} 
			?>
			</ul> 
		</section>
		<?
		} else {
		?>
		<section class="m-frm-null" >
			<img src="/member/static/mobile/null.png">
			<p>嗨，这里没有找到与您的相关信息 :)</p>
		</section>
		<?}?>  
</section>
<?}?>
   
<?
if(req('ac')=='comment'){
?> 
	<form id="myform" method="post" action="do?ac=comment"> 
	  <table width="100%" class="table table-hover">
		<tr>
			<td width="12%" align="right"></td>
			<td><?=req('goods_name')?></td>
		</tr>
		<tr>
			<td align="right"></td>
			<td><input type="radio" name="comment_level" value="A" checked>好评 <input type="radio" name="comment_level" value="B">中评 <input type="radio" name="comment_level" value="C">差评</td>
		</tr>
		<tr>
			<td align="right">评论</td>
			<td><textarea name="content" rows="6" cols="60" class="span6"></textarea></td>
		</tr> 
		<tr>
		  <td align="right">&nbsp;</td>
		  <td>
		  <input type="hidden" name="goods_id" value="<?=req('goods_id')?>">
		  <input type="submit" value="提交" class="btn btn-warning"/></td>
		</tr> 
	  </table> 
	</form>  
<?}?> 

 