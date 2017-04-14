<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<ul class="nav nav-tabs">   
	<li <?if(nav_active('news_list.php')){?>class="active"<?}?> style="padding-left:20px;">
		<a href="?cmd=<?=base64_encode('news_list.php')?>">���¹���</a>
	</li>   
	<li <?if(nav_active('news_cat.php')){?>class="active"<?}?>>
		<a href="?cmd=<?=base64_encode('news_cat.php')?>">���·���</a>
	</li>   

	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">ˢ��</a>
</ul>  
 
<script type="text/javascript">
		function doform_news(thread_id, item){
			var f =  document.getElementById('f'+thread_id);
			f.action = "do.php?cmd=news_edit_fast&thread_id="+thread_id+"&item="+item;
			f.submit();
		} 
</script> 

 
 
		<form  name="q_from" method="GET" action="" class="form-inline"> 
	 
		<input name="cmd" type="hidden" value="<?=base64_encode('news_list.php')?>"/>
			<select name="cat_id">
				  <option value=""></option>
				  <?  
				  $sql = "SELECT cat_id,cat_name FROM t_article_catalog WHERE parent_id='0' and site_id='$g_siteid' order by order_id ASC";  
				  $list01 = $db->get_all($sql); 
				  if(notnull($list01)){
					  foreach ($list01 as $val){    	
				  ?>
					  <option value="<?=$val['cat_id']?>" <? if($val['cat_id']==req('cat_id')) echo 'selected';?>><?=$val['cat_name']?></option>
					  <? 
					  $sql = "SELECT cat_id,cat_name FROM t_article_catalog WHERE parent_id='".$val['cat_id']."' and site_id='$g_siteid' order by order_id ASC";  
					  $list02 = $db->get_all($sql); 
					  if(notnull($list02)){
						  foreach ($list02 as $cval){    	
					  ?>
					  &nbsp; &gt; <option value="<?=$cval['cat_id']?>" <? if($cval['cat_id']==req('cat_id')) echo 'selected';?>><?=$cval['cat_name']?></option>
					  <?				
						}
					  }
					  ?>
				  <?				
					}
				  }
				  ?>
			</select> 
			<input name="kw" type="text" id="kw" size="50" class="span6" value="<?=req('kw')?>" placeholder="�������±���ؼ���..."/> 
			&nbsp;
			<input type="image" src="static/image/find.gif" class="input_img"/>  

			
			<a href="?cmd=<?=base64_encode('news_add.php')?>" class="pull-right btn btn-small btn-danger"><em class="fa fa-plus"></em> ����������</a> 

		</form> 

		<? 
		if(notnull($query_rows)){
		?>
		<table class="table table-hover"> 
		  <tr>  
			<td><strong>�� Ŀ</strong></td>
			<td width="350"><strong>�� ��</strong></td> 
			<td></td>
			<td><strong>���</strong></td> 
			<td><strong>�Ƿ�����</strong></td>  
			<td><strong>�Ƿ��ö�</strong></td> 
			<td width="100"><strong>¼��ʱ��</strong></td>
			<td width="80" align="center"><strong>�� ��</strong></td>
		  </tr> 
		  <?  
			foreach ($query_rows as $val){    	
				$news_url = get_news_url($val['thread_id']);
		  ?>
		  <form target="frm" id="f<?=$val['thread_id']?>" method="post" action="" > 
		  <tr> 
			<td>  
			<a href="/news/<?=$val['cat_key']?>/" target="_blank"><?=$val['cat_name']?></a>
			</td>
			 
			<td><a href="<?=$news_url?>" target="_blank"><?=$val['title']?></a> </td>
			  
			<td>
			<?if($val['image']!=''){?><img src="http://<?=$g_site_domain?>/upfiles/<?=$g_siteid?>/<?=$val['image']?>" style="width:30px;height:30px;" onerror="this.src='static/image/nopic.jpg'"/><?}?></td>
			
			<td><input name="order_id" type="number" id="order_id" value="<?=$val['order_id']?>" size="1" onchange="doform_news('<?=$val['thread_id']?>', 'order_id')" style="width:50px"/>
			</td>
		 
			<td >
				<select name="is_hot" onchange="doform_news('<?=$val['thread_id']?>', 'is_hot')" style="width:80px">  
					<option value="0" <? if($val['is_hot']==0) {echo 'selected';} ?> >���Ƽ�</option> 
					<option value="1" <? if($val['is_hot']==1) {echo 'selected';} ?> >�Ƽ�^</option> 
				</select>	
			</td>

			<td >
				<select name="is_top" onchange="doform_news('<?=$val['thread_id']?>', 'is_top')" style="width:80px">  
					<option value="0" <? if($val['is_top']==0) {echo 'selected';} ?> >���ö�</option> 
					<option value="1" <? if($val['is_top']==1) {echo 'selected';} ?> >�ö�^</option> 
				</select>	
			</td>

			<td><?=date('Y-m-d',strtotime($val['addtime']))?></td>

			<td align="center">
				 
				<a href="<?=$news_url?>" target="_blank"><img src="static/image/view.gif"/></a> 
				&nbsp; 

				<span onclick="dialog_edit('./?cmd=<?=base64_encode('news_edit.php')?>&modal=true&thread_id=<?=$val['thread_id']?>')" style="cursor:pointer"><img src="static/image/edit.gif"/></span> 
				&nbsp;

				<a href="do.php?cmd=news_del&thread_id=<?=$val['thread_id']?>" onclick="return confirm('ȷ��ɾ����')"><img src="static/image/delete.gif"/></a>
			</td>
		  </tr>
		  </form>
		  <?	 
			}
		  ?>
		</table>

		<div style="text-align:right;padding-right:10px;">  
			<br/>
			����<b><?=$total_number?></b>�� &nbsp;
			<a href="./?cmd=<?=base64_encode('news_list.php')?>&cat_id=<?=req('cat_id')?>&kw=<?=req('kw')?>&p=1">��ҳ</a>
			<a href="./?cmd=<?=base64_encode('news_list.php')?>&cat_id=<?=req('cat_id')?>&kw=<?=req('kw')?>&p=<?=$prev_number?>">��һҳ</a> 
			��<?=$now_page?> / <?=$total_page?>ҳ 
			<a href="./?cmd=<?=base64_encode('news_list.php')?>&cat_id=<?=req('cat_id')?>&kw=<?=req('kw')?>&p=<?=$next_number?>">��һҳ</a>
			<a href="./?cmd=<?=base64_encode('news_list.php')?>&cat_id=<?=req('cat_id')?>&kw=<?=req('kw')?>&p=<?=$total_page?>">βҳ</a>
		</div>
		<?	 
		}
		?> 