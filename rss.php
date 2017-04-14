<? 
$db = new dbmysql();
$db->dbconn($db_host, $db_user, $db_pwd, $db_name);

$sql = "SELECT * FROM `t_goods_thread` ORDER BY RAND() LIMIT 0,20";   
$goods = $db->get_all($sql);   

$common_www_url = "http://www.yixueshuji.com/";
?>
<?='<?xml version="1.0" encoding="GBK"?>'?>
<rss version="2.0">
	<channel>
		<title>
			<![CDATA[医林书吧]]>
		</title>
		<image>
			<title>
				<![CDATA[医林书吧，中国品类最全的医学书店！]]>
			</title>
			<link><?=$common_www_url?></link>
			<url><?=$common_www_url?>/themes/bookshare/images/logo.gif</url>
		</image>
		<description>
			<![CDATA[医林书吧，中国品类最全的医学书店！]]>
		</description>
		<link><?=$common_www_url?></link>
		<language>zh-cn</language>
		<generator><?=$common_www_url?></generator>
		<ttl>5</ttl>
		<copyright>
			<![CDATA[Copyright (C) 2013 医林书吧 All Rights Reserved.]]>
		</copyright>
		<pubDate><?=date('Y-m-d H:i:s')?></pubDate>
		<category>
			<![CDATA[]]>
		</category> 

<?   
if(sizeof($goods)>0){
	foreach ($goods as $val){ 
?>
		<item>
			<title>
				<![CDATA[<?=$val['goods_name']?>]]>
			</title>
			<link><?=$common_www_url?>book/<?=$val['goods_id']?>.html</link>
			<author>医林书吧</author>
			<guid><?=$val['goods_id']?></guid>
			<category>
				<![CDATA[ &yen;<?=$val['real_price']?>.00]]>
			</category>
			<pubDate><?=$val['addtime']?></pubDate>
			<comments></comments>
			<description>
				<![CDATA[
				<?=$val['content']?> 
				]]>
			</description>
		</item> 
<?    
  
	}  
}  
?>
	</channel>
</rss>