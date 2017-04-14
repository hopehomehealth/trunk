<?php
$s_search['keyWord'] = req('value');
$s_search['dataUser'] = 1;
$s_liebiao = json_decode($db->api_post($host."/travel/interface/ticket/getTicketGoodsListFromMongoByKeyWord",$s_search),true);
$s_liebiao = $s_liebiao['data']['webGoodsSet'];
if(empty($s_liebiao)){
	//exit('0');
}
echo '<ul>';
foreach($s_liebiao as $key=>$value){
	if($key<7){
		echo '<li>'.utf8_to_gbk($value['goodsName']).'</li>';
		//echo '<li>'.$value['goodsName'].'</li>';
	}
	
} 
echo '</ul>';
?>
