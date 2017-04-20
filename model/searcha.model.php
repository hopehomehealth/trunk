<?php
function jiequ($data,$num=55){
    if(mb_strwidth($data,'utf-8')>=$num){
        return mb_strimwidth($data, 0, $num-1,'...','utf-8');
    }else{
        return $data;
    }

}
$s_search['keyWord'] = req('value');
$s_liebiao = json_decode($db->api_post($host."/travel/interface/zby/getZbyGoodsListFromMongo",$s_search),true);
$s_liebiao = $s_liebiao['data']['zbyGoodsList'];
if(!empty($s_liebiao)){
    echo '<ul>';
    foreach($s_liebiao as $key=>$value){
        if($key<7){
            $goodsName = str_replace(' ','&nbsp;',$value['goodsName']) ;
            $jiequ = jiequ($value['goodsName']);
            echo '<li title='.utf8_to_gbk($goodsName).'>'.utf8_to_gbk($jiequ).'</li>';
//            echo '<li title='.$goodsName.'>'.$jiequ.'</li>';
        }

    }
    echo '</ul>';
}

?>