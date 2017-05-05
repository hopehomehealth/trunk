<?php
function jiequ($data,$num=54,$kongNum){
    if(!empty($kongNum)) $num = $num + $kongNum/2;
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
            $kongNum = substr_count($value['goodsName']," ");
//            echo $kongNum."<hr>";
            $goodsName = str_replace(' ','&nbsp;',$value['goodsName']);
            $jiequ = jiequ($value['goodsName'],54,$kongNum);
            echo '<li title='.($goodsName).'>'.($jiequ).'</li>';
//            echo '<li title='.$goodsName.'>'.$jiequ.'</li>';
        }
    }
    echo '</ul>';
}

?>