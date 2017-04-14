<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:attachment;filename=".date('Y-m-d')."销售订单结算报表.xls");
echo "销售订单结算报表 \n";
echo "商家"."\t";
echo "订单"."\t";
echo "日期"."\t";
echo "客户"."\t";
echo "产品"."\t";
echo "出发日期"."\t";
echo "成人数量"."\t";
echo "成人价格"."\t";
echo "儿童数量"."\t";
echo "儿童价格"."\t";
echo "单房差"."\t";
echo "优惠"."\t";
echo "订单金额"."\t";
echo "返佣"."\t";
echo "结算金额"."\t";
echo "结算状态"."\t";
echo "\n";
 
if(notnull($query_rows)){ 
	foreach ($query_rows as $val){

		// 店铺 
		$shop = get_shop_detail_by_id($val['shop_id']); 

		// 客户 
		$user = get_user_detail_by_id($val['user_id']);  
				 
		// 产品  
		$goods = unserialize($val['goods_snapshot']);
				
		// 实际成交金额
		$total_real_price = $val['real_price']; 

		echo $shop['shop_name']."\t";
		echo $val['order_code']."\t";
		echo date('Y-m-d', strtotime($val['addtime']))."\t";
		echo $user['account']."\t";
		echo $val['goods_name'].' '.$val['goods_code']."\t";
		echo $val['departdate']."\t";
		echo $val['adult_num']."\t";
		echo $val['adult_price']."\t";
		echo $val['kid_num']."\t";
		echo $val['kid_price']."\t";
		echo $val['diff_price']*$val['diff_num']."\t";
		echo $val['subtract_price']."\t";
		echo $total_real_price."\t";
		echo $val['settle_money']."\t";
		echo $total_real_price - $val['settle_money']."\t";
		if($val['is_settle']=='1'){
			echo "已结算"."\t";
		} else {
			echo "未结算"."\t";
		}
		echo "\n";
	}
}
?>