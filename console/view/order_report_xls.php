<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:attachment;filename=".date('Y-m-d')."���۶������㱨��.xls");
echo "���۶������㱨�� \n";
echo "�̼�"."\t";
echo "����"."\t";
echo "����"."\t";
echo "�ͻ�"."\t";
echo "��Ʒ"."\t";
echo "��������"."\t";
echo "��������"."\t";
echo "���˼۸�"."\t";
echo "��ͯ����"."\t";
echo "��ͯ�۸�"."\t";
echo "������"."\t";
echo "�Ż�"."\t";
echo "�������"."\t";
echo "��Ӷ"."\t";
echo "������"."\t";
echo "����״̬"."\t";
echo "\n";
 
if(notnull($query_rows)){ 
	foreach ($query_rows as $val){

		// ���� 
		$shop = get_shop_detail_by_id($val['shop_id']); 

		// �ͻ� 
		$user = get_user_detail_by_id($val['user_id']);  
				 
		// ��Ʒ  
		$goods = unserialize($val['goods_snapshot']);
				
		// ʵ�ʳɽ����
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
			echo "�ѽ���"."\t";
		} else {
			echo "δ����"."\t";
		}
		echo "\n";
	}
}
?>