<?
//-----------------------------------------------------------// ��Ʒ����
 
// ��Ӳ�Ʒ
if($cmd == 'goods_add'){     
	
	$addtime			= date('Y-m-d H:i:s');   
	$shop_id			= req('shop_id');
	$goods_cat_id 		= req('goods_cat_id');
	$goods_type			= req('goods_type'); 
	$goods_name 		= req('goods_name'); 
	$goods_code 		= req('goods_code');  
	$goods_package		= req('goods_package'); 
	$goods_zone			= req('goods_zone'); 
	$src_prov 			= req('src_prov'); 
	$src_city 			= req('src_city');
	$dist_prov 			= req('dist_prov');
	$dist_city 			= req('dist_city');
	$real_price 		= req('real_price'); 
	$market_price 		= req('market_price'); 
	$stock			 	= req('stock');
	$line_days 			= req('line_days');
	$line_nights 		= req('line_nights');
	$goto_transport 	= req('goto_transport');  
	$back_transport 	= req('back_transport');
	$before_days	 	= req('before_days');
	$line_tag			= addslashes(serialize($_POST['line_tag']));
	// VISA
	$visa_zone_id		= req('visa_zone_id');
	$visa_type			= req('visa_type');
	$visa_profile		= addslashes(serialize($_POST['visa']));
	// SHIP
	$ship_name			= req('ship_name');
	$ship_line			= addslashes(serialize($_POST['ship_line']));
	$ship_port			= req('ship_port');
	$ship_brand			= req('ship_brand');
	$summary			= addslashes($_POST['summary']); 
	$goods_content		= addslashes($_POST['goods_content']); 
	$order_note			= req('order_note');
	$price_note			= req('price_note'); 
	$unprice_note		= req('unprice_note'); 
	$is_sale 			= req('is_sale'); 
	$sale_type			= req('sale_type'); 
	$sale_start			= req('sale_start'); 
	$sale_end			= req('sale_end');  
	$goods_doc			= req('goods_doc');
	//����Ϊ�ײ�����
	$package 					= req('package');//�Ƿ�Ϊ�ײ�
	$package_id					= time();//�ײ�id  
	$package_status				= 'true';//��Ʒ����״̬
	$is_package					= 'false';//���˰�����
	$adult_num					= 'NULL';//������ ��isPackageΪtrueʱ���ֶβ���ʵ��ֵ
	$child_num					= 'NULL';//��ͯ����isPackageΪtrueʱ���ֶβ���ʵ��ֵ
	$room_max					= req('room_max');//���������ס��ÿ������������ס������
	$min 						= req('min');//��С��������
	$max 						= req('max');//��󶩹�����
	$booker_name				= 'true';//��ϵ����Ϣ�����Ƿ���� true����Ҫ��false������Ҫ
	$booker_mobile				= 'true';//�ֻ����Ƿ���� true����Ҫ��false������Ҫ
	$booker_email				= req('booker_email');//email �Ƿ���� true����Ҫ��false������Ҫ
	$traveller_name				= req('traveller_name');//�����Ƿ����  
	$traveller_en_name			= req('traveller_en_name');//Ӣ�����Ƿ����  
	$traveller_mobile			= req('traveller_mobile');//�ֻ����Ƿ����  
	$traveller_email			= req('traveller_email');//email�Ƿ����  
	$traveller_person_type  	= req('traveller_person_type');//��Ⱥ�Ƿ����  
	$traveller_credentials		= req('traveller_credentials');//֤���Ƿ����  
	$traveller_credentials_type	= req('traveller_credentials_type');//֤������  ID_CARD�����֤��HUZHAO�����գ�HUKOUBO�����ڱ���GANGAO���۰�ͨ��֤��TAIBAO��̨��ͨ��֤��HUIXIANG������֤��SHIBING��ʿ��
	$traveller_gender			= req('traveller_gender');//�Ա��Ƿ����  (֤�����ͷ����֤ʱ���ṩ�Ա�ͳ������ڣ�������ʾ)',
	$traveller_birthday			= req('traveller_birthday');//�����Ƿ����  (֤�����ͷ����֤ʱ���ṩ�Ա�ͳ������ڣ�������ʾ)',
	$emergency					= req('emergency');//�Ƿ���Ҫ������ϵ��  true����Ҫ��false������Ҫ	
	$ahead_time					= req('ahead_time');//��ǰԤ��ʱ��
	if(notnull($goods_name) == false){ 
		senderror('����д��Ʒ����');
	} 
	
	if($sale_type>0 && ($sale_start=='' || $sale_end=='')){
		senderror('�Ź������������ۿ�ʼ�ͽ���ʱ�����');
	}

	$sql = "SELECT `goods_code` FROM `t_goods_thread` WHERE `goods_code`='$goods_code' AND `site_id`='$g_siteid'";
	$exist_goods_code = $db->get_value($sql); 
	if($exist_goods_code != ''){
		senderror('��Ʒ����Ѵ���');
	}
 
	$goods_image = '/upfiles/801/'.get_ym_upfile('goods_image'); 
	
	if($goods_image==''){
		senderror('�����ϴ���Ʒ��ͼ');
	} 

	// �����µĲ�ƷID
	$sql = "SELECT MAX(`goods_id`)+1 FROM `t_goods_thread`";
	$goods_id = $db->get_value($sql); 
	if($goods_id==''){
		$goods_id = '8000000';
	}

	// ȫ�ļ���
	$ft_string = $goods_name.$dist_prov.$dist_city.$g_product_type[$goods_type];
	$ft = ft_split($ft_string);

	// �ϴ�����ͼƬ 
	for($i=1; $i<=5; $i++){
		$other_goods_image = get_ym_upfile('goods_image'.$i );  
		if($other_goods_image!=''){
			$other_goods_image = '/upfiles/801/'.$other_goods_image;
			$sql = "INSERT INTO `t_goods_image` (`site_id` , `goods_id` , `filepath` , `filetype` , `file_size`,`lv_product_id` ) VALUES ('$g_siteid', '$goods_id', '$other_goods_image', '1', '' ,'$goods_id')";
			$db->query($sql);  
		}
	}  

	if(1==1){  
		// �ϴ�����༭ͼƬ
		$file_dir = date('Ym'); 
		$upload_dir = "$g_root/upfiles/$g_siteid/$file_dir/";
		$day_file_array = array();
		for($i=1; $i<=$line_days; $i++){ 
			for($j=1; $j<=4; $j++){ 
				$day_file_name = batch_upload_image($_FILES['day_file']['name'][$i][$j], $_FILES['day_file']['tmp_name'][$i][$j], $upload_dir, $file_dir);

				if($day_file_name!=''){
					$day_file_array[$i][$j] = "/upfiles/$g_siteid/".$day_file_name;
				} else {
					$day_file_array[$i][$j] = '';
				}
			}
		} 

		$day_tmp_array = array();
		$day_tmp_array['title']		= $_POST['day_title'];
		$day_tmp_array['tool']		= $_POST['day_tool'];
		$day_tmp_array['content']	= $_POST['day_content'];
		$day_tmp_array['image']		= $day_file_array;

		$content_day = addslashes(serialize($day_tmp_array));

		/// ����༭����ת��Ϊ��ͨ�༭����

		$content_tpl = '
		<table width="100%" border="0">
		  <tr>
			<td style="background-color:#808185;width:4px;height:30px;"></td> 
			<td style="background-color:#F3F3F3;padding-left:10px;font-size:12px"> {title} &nbsp;</td>
		  </tr>
		</table>
		<table width="100%" border="0">
		  <tr> 
			<td style="font-size:12px;padding-top:10px"> {content} &nbsp;</td>
		  </tr>
		</table>
		<table class="content_image" width="100%" border="0">
			  <tr> 
				<td> <img src="{img1}" width="90%" onerror="this.style.display=\'none\'"/> </td>
				<td> <img src="{img2}" width="90%" onerror="this.style.display=\'none\'"/> </td> 
				<td> <img src="{img3}" width="90%" onerror="this.style.display=\'none\'"/> </td>
				<td> <img src="{img4}" width="90%" onerror="this.style.display=\'none\'"/> </td>
			  </tr>
		</table> 
		<p>&nbsp;</p>';
		
		$content_exchange = '';
		$content_exchange_string = '';
		for($i=1; $i<=$line_days; $i++){
			$content_exchange = str_replace('{title}', '��'.$i.'��- '.$_POST['day_title'][$i], $content_tpl);
			$content_exchange = str_replace('{content}', nl2br($_POST['day_content'][$i]), $content_exchange);
			for($j=1; $j<=4; $j++){  
				$this_day_image_file = $day_file_array[$i][$j];
				if(notnull($this_day_image_file)==false) $this_day_image_file='';
				$content_exchange = str_replace('{img'.$j.'}', $this_day_image_file, $content_exchange);
			}

			$content_exchange_string .= $content_exchange;
		}  
	}
	 
	$ref_price = array(); 
	$ref_price['ref_adult_price'] = req('ref_adult_price');
	$ref_price['ref_adult_stock'] = req('ref_adult_stock');
	$ref_price['ref_kid_price']   = req('ref_kid_price');
	$ref_price['ref_kid_stock']   = req('ref_kid_stock');
	$ref_price['ref_diff_price']  = req('ref_diff_price'); 
	$ref_price_txt = addslashes(serialize($ref_price));
	
	// ��ȡ������ؼ���
	$sql = "SELECT `cat_key` FROM `t_goods_catalog` WHERE `cat_id`='$goods_cat_id'";
	$goods_cat_key = $db->get_value($sql);
 
	$sql = "INSERT INTO `t_goods_thread` (`lv_product_id`,`goods_id`, `site_id`, `shop_id`, `cat_id`, `cat_key`, `goods_name`, `goods_code`, `goods_doc`, `goods_package`, `goods_type`, `goods_zone`, `src_prov`, `src_city`, `dist_prov`, `dist_city`, `line_days`, `line_nights`, `goto_transport`, `back_transport`, `before_days`, `order_note`, `line_tag`, `visa_zone_id`, `visa_type`, `visa_profile`, `ship_name`, `ship_line`, `ship_port`, `ship_brand`, `price_note`, `unprice_note`, `goods_image`, `summary`, `content`, `content_day`, `market_price` , `real_price`, `stock`, `ref_price`, `sale_type`, `sale_start`, `sale_end`, `is_hot` , `order_id`, `sale_number`, `is_sale`, `clicks` , `addtime`, `ft`,`data_sources`) 
	VALUES ('$goods_id','$goods_id', '$g_siteid', '$shop_id', '$goods_cat_id', '$goods_cat_key', '$goods_name', '$goods_code', '$goods_doc', '$goods_package', '$goods_type', '1', '$src_prov', '$src_city', '$dist_prov', '$dist_city', '$line_days', '$line_nights', '$goto_transport', '$back_transport', '$before_days', '$order_note', '$line_tag', '$visa_zone_id', '$visa_type', '$visa_profile', '$ship_name', '$ship_line', '$ship_port', '$ship_brand', '$price_note', '$unprice_note', '$goods_image', '$summary', '$goods_content', '$content_day', '$market_price', '$real_price', '$stock', '$ref_price_txt', '$sale_type', '$sale_start', '$sale_end', '$is_hot', '$order_id', '$sale_number', '$is_sale', '$clicks', '$addtime', '$ft','1')"; 
	$db->query($sql);

	//�ײ����

	$sql = "INSERT INTO `t_zby_package` (`goods_id`, `package_id`, `package_name`, `package_status`, `is_package`, `adult_num`, `child_num`, `room_max`, `min`, `max`, `booker_name`, `booker_mobile`, `booker_email`, `traveller_name`, `traveller_en_name`, `traveller_mobile`, `traveller_email`, `traveller_person_type`, `traveller_credentials`, `traveller_credentials_type`, `traveller_gender`, `traveller_birthday`, `emergency`) 
	VALUES ('$goods_id', '$package_id', '$goods_name', '$package_status', '$is_package', '$adult_num', '$child_num', '$room_max', '$min', '$max', '$booker_name', '$booker_mobile', '$booker_email', '$traveller_name','$traveller_en_name', '$traveller_mobile', '$traveller_email', '$traveller_person_type', '$traveller_credentials', '$traveller_credentials_type', '$traveller_gender', '$traveller_birthday', '$emergency')";
	$db->query($sql);

	
	// ����SKU
	$adult_price_array = $_POST['adult_price'];

	if(notnull($adult_price_array)){
		foreach ($adult_price_array as $key => $value) { 
			$adult_price  = $_POST['adult_price'][$key];
			$adult_stock  = $_POST['adult_stock'][$key];
			$kid_price    = $_POST['kid_price'][$key];
			$kid_stock    = $_POST['kid_stock'][$key];
			$diff_price   = $_POST['diff_price'][$key];
			$lv_market_price = $_POST['ref_diff_price'];
			$sum_stock = ($adult_stock + $kid_stock);
			if($value>0){ 
				$sql = "SELECT `sku_id` FROM `t_goods_sku` WHERE `site_id`='$g_siteid' AND `goods_id`='$goods_id' AND `departdate`='$key'";
				$last_sku_id = $db->get_value($sql);
				if($last_sku_id!=''){
					
					$sql = "UPDATE `t_goods_sku` SET `adult_price`='$value', `kid_price`='$kid_price', `diff_price`='$diff_price', `adult_stock`='$sum_stock', `kid_stock`='$kid_stock', `lv_market_price`='$lv_market_price' WHERE `site_id`='$g_siteid' AND `sku_id`='$last_sku_id'";
					$db->query($sql); 
				} else { 

					$sql = "INSERT INTO `t_goods_sku` (`service_type`,`site_id`, `goods_id`, `departdate`, `adult_price`, `kid_price`, `diff_price`, `adult_stock`, `kid_stock`, `lv_market_price`, `package_id`,`lv_stock`,`ahead_day`,`ahead_time`) VALUES ('1','$g_siteid', '$goods_id', '$key', '$value', '$kid_price', '$diff_price', '$sum_stock', '$kid_stock', '$lv_market_price','$package_id','$sum_stock','$before_days','$ahead_time')"; 
					$db->query($sql);
				}
			}
		}
	}
	
	// ���¼۸�(��ͼ�)
	if($goods_type!='3'){ //ǩ֤
		$sql = "SELECT MIN(`adult_price`) FROM `t_goods_sku` WHERE `site_id`='$g_siteid' AND `goods_id`='$goods_id' AND `departdate`>='".date('Y-m-d')."'";
		$min_price = $db->get_value($sql); 
		
		$sql = "UPDATE `t_goods_thread` SET `min_price`='$min_price' WHERE `goods_id`='$goods_id' AND `site_id`='$g_siteid'";
		$db->query($sql);
	} else { 
		$sql = "UPDATE `t_goods_thread` SET `min_price`='$real_price' WHERE `goods_id`='$goods_id' AND `site_id`='$g_siteid'";
		$db->query($sql);
	}
	 
 
	// �������  
	if(notnull($cats)){ 
		foreach ($cats as &$v) { 
			$catalogs .= $v.' ';
		}
		$catalogs = trim($catalogs);
		$sql = "UPDATE `t_goods_thread` SET catalogs='$catalogs' WHERE `goods_id`='$goods_id' AND `site_id`='$g_siteid'";
		$db->query($sql);
	}

	bingo();
}

// �༭��Ʒ
if($cmd == 'goods_update'){    
	$shop_id			= req('shop_id');
	$goods_cat_id 		= req('goods_cat_id');
	$goods_id 			= req('goods_id'); 
	$goods_type			= req('goods_type');
	$goods_name 		= req('goods_name'); 
	$goods_code 		= req('goods_code');
	$goods_package		= req('goods_package'); 
	$goods_zone			= req('goods_zone'); 
	$src_prov 			= req('src_prov'); 
	$src_city 			= req('src_city');
	$dist_prov 			= req('dist_prov');
	$dist_city 			= req('dist_city');
	$market_price 		= req('market_price');  
	$real_price 		= req('real_price'); 
	$stock			 	= req('stock');
	$line_days 			= req('line_days');
	$line_nights 		= req('line_nights');
	$goto_transport 	= req('goto_transport');  
	$back_transport 	= req('back_transport');
	$before_days	 	= req('before_days');
	// VISA
	$visa_zone_id		= req('visa_zone_id');
	$visa_type			= req('visa_type');
	$visa_profile		= addslashes(serialize($_POST['visa']));
	// SHIP
	$ship_name			= req('ship_name');
	$ship_line			= addslashes(serialize($_POST['ship_line']));
	$ship_port			= req('ship_port');
	$ship_brand			= req('ship_brand');
	$summary			= addslashes($_POST['summary']); 
	$goods_content		= addslashes($_POST['goods_content']); 
	$order_note			= req('order_note'); 
	$price_note			= req('price_note'); 
	$unprice_note		= req('unprice_note'); 
	$real_price 		= req('real_price'); 
	$market_price 		= req('market_price');  
	$sale_type			= req('sale_type'); 
	$sale_start			= req('sale_start'); 
	$sale_end			= req('sale_end');  
	$goods_doc			= req('goods_doc'); 
	$shop_cat_id		= req('shop_cat_id');
	$is_sale 			= req('is_sale');	
	$cats				= $_POST['cat_id'];
	//����Ϊ�ײ�����
	$package 					= req('package');//�Ƿ�Ϊ�ײ�
	$package_id					= time();//�ײ�id  
	$package_status				= 'true';//��Ʒ����״̬
	$is_package					= 'false';//���˰�����
	$adult_num					= 'NULL';//������ ��isPackageΪtrueʱ���ֶβ���ʵ��ֵ
	$child_num					= 'NULL';//��ͯ����isPackageΪtrueʱ���ֶβ���ʵ��ֵ
	$room_max					= req('room_max');//���������ס��ÿ������������ס������
	$min 						= req('min');//��С��������
	$max 						= req('max');//��󶩹�����
	$booker_name				= 'true';//��ϵ����Ϣ�����Ƿ���� true����Ҫ��false������Ҫ
	$booker_mobile				= 'true';//�ֻ����Ƿ���� true����Ҫ��false������Ҫ
	$booker_email				= req('booker_email');//email �Ƿ���� true����Ҫ��false������Ҫ
	$traveller_name				= req('traveller_name');//�����Ƿ����  
	$traveller_en_name			= req('traveller_en_name');//Ӣ�����Ƿ����  
	$traveller_mobile			= req('traveller_mobile');//�ֻ����Ƿ����  
	$traveller_email			= req('traveller_email');//email�Ƿ����  
	$traveller_person_type  	= req('traveller_person_type');//��Ⱥ�Ƿ����  
	$traveller_credentials		= req('traveller_credentials');//֤���Ƿ����  
	$traveller_credentials_type	= req('traveller_credentials_type');//֤������  ID_CARD�����֤��HUZHAO�����գ�HUKOUBO�����ڱ���GANGAO���۰�ͨ��֤��TAIBAO��̨��ͨ��֤��HUIXIANG������֤��SHIBING��ʿ��
	$traveller_gender			= req('traveller_gender');//�Ա��Ƿ����  (֤�����ͷ����֤ʱ���ṩ�Ա�ͳ������ڣ�������ʾ)',
	$traveller_birthday			= req('traveller_birthday');//�����Ƿ����  (֤�����ͷ����֤ʱ���ṩ�Ա�ͳ������ڣ�������ʾ)',
	$emergency					= req('emergency');//�Ƿ���Ҫ������ϵ��  true����Ҫ��false������Ҫ
 	$ahead_time					= req('ahead_time');//��ǰԤ��ʱ��
	if(notnull($goods_name) == false){ 
		senderror('����д��Ʒ����');
	} 

	if($sale_type>0 && ($sale_start=='' || $sale_end=='')){
		senderror('�Ź������������ۿ�ʼ�ͽ���ʱ�����');
	} 

	/// �ϴ�����ͼƬ 
	for($i=1; $i<=5; $i++){
		$other_goods_image = get_ym_upfile('goods_image'.$i ); 

		$exist_goods_image = req('exist_goods_image'.$i);
		$exist_image_id = req('exist_image_id'.$i);

		// ͼƬ���ڣ��ļ�Ҳ��Ϊ��
		if($exist_image_id!='' && $other_goods_image!=''){
			$sql = "UPDATE `t_goods_image` SET `filepath`='$other_goods_image' WHERE image_id='$exist_image_id'";
			$db->query($sql); 
			
			// ɾ����ͼƬ
			$upload_dir = "$g_root/upfiles/$g_siteid/"; 
			if(file_exists($upload_dir.$exist_goods_image)==true){
				unlink($upload_dir.$exist_goods_image);
			}
		} else { 
			if($other_goods_image!=''){
				$other_goods_image = '/upfiles/801/'.$other_goods_image;
				$sql = "INSERT INTO `t_goods_image` (`site_id` , `goods_id` , `filepath` , `filetype` , `file_size`,`lv_product_id` ) VALUES ('$g_siteid', '$goods_id', '$other_goods_image', '1', '' ,'$goods_id')";
				$db->query($sql);  
			}
		}
	}
 
	
	// ��Ʒ���� 
	$goods_image = jpgget_ym_upfile('goods_image' );  
	
	if($goods_image!=''){
		$goods_image_sql = " , `goods_image`='$goods_image' ";
	}

	// ȫ�ļ���
	$ft_string = $goods_id.$goods_name.$dist_prov.$dist_city.$g_product_type[$goods_type];
	$ft = ft_split($ft_string);

	if(1==1){  

		// �ϴ�����༭ͼƬ
		$file_dir = date('Ym');
		$upload_dir = "$g_root/upfiles/$g_siteid/$file_dir/";
		$day_file_array = array();
		for($i=1; $i<=$line_days; $i++){ 
			for($j=1; $j<=4; $j++){ 
				$day_file_name = batch_upload_image($_FILES['day_file']['name'][$i][$j], $_FILES['day_file']['tmp_name'][$i][$j], $upload_dir, $file_dir);
 
				if($day_file_name!=''){
					$day_file_array[$i][$j] = "/upfiles/$g_siteid/".$day_file_name;
				} else {
					
					$day_file_array[$i][$j] = $_POST['day_file_src'][$i][$j];
				}
			}
		} 
 
		$day_tmp_array = array();
		$day_tmp_array['title'] = $_POST['day_title'];
		$day_tmp_array['content'] = $_POST['day_content'];
		$day_tmp_array['tool'] = $_POST['day_tool'];
		$day_tmp_array['image'] = $day_file_array;

		$content_day = addslashes(serialize($day_tmp_array));
  
		/// ����༭����ת��Ϊ��ͨ�༭����
		$content_tpl = '
		<table width="100%" border="0">
		  <tr>
			<td style="background-color:#808185;width:4px;height:30px;"></td> 
			<td style="background-color:#F3F3F3;padding-left:10px;font-size:12px"> {title} &nbsp;</td>
		  </tr>
		</table>
		<table width="100%" border="0">
		  <tr> 
			<td style="font-size:12px;padding-top:10px"> {content} &nbsp;</td>
		  </tr>
		</table>
		<table class="content_image" width="100%" border="0">
		  <tr> 
			<td> <img src="{img1}" width="90%" onerror="this.style.display=\'none\'"/> </td>
			<td> <img src="{img2}" width="90%" onerror="this.style.display=\'none\'"/> </td> 
			<td> <img src="{img3}" width="90%" onerror="this.style.display=\'none\'"/> </td>
			<td> <img src="{img4}" width="90%" onerror="this.style.display=\'none\'"/> </td>
		  </tr>
		</table> 
		<p>&nbsp;</p>';
		
		$content_exchange = '';
		$content_exchange_string = '';
		for($i=1; $i<=$line_days; $i++){
			$content_exchange = str_replace('{title}', '��'.$i.'��- '.$_POST['day_title'][$i], $content_tpl);
			$content_exchange = str_replace('{content}', nl2br($_POST['day_content'][$i]), $content_exchange);
			for($j=1; $j<=4; $j++){  
				$this_day_image_file = $day_file_array[$i][$j];
				if(notnull($this_day_image_file)==false) $this_day_image_file='';
				$content_exchange = str_replace('{img'.$j.'}', $this_day_image_file, $content_exchange);
			}

			$content_exchange_string .= $content_exchange;
		}

		//$goods_content = addslashes($content_exchange_string);
	} 

	$ref_price = array(); 
	$ref_price['ref_adult_price'] = req('ref_adult_price');
	$ref_price['ref_adult_stock'] = req('ref_adult_stock');
	$ref_price['ref_kid_price']   = req('ref_kid_price');
	$ref_price['ref_kid_stock']   = req('ref_kid_stock');
	$ref_price['ref_diff_price']  = req('ref_diff_price'); 
	$ref_price_txt = addslashes(serialize($ref_price));
 

	// ��ȡ������ؼ���
	$sql = "SELECT `cat_key` FROM `t_goods_catalog` WHERE `cat_id`='$goods_cat_id'";
	$goods_cat_key = $db->get_value($sql); 
	
	$sql = "UPDATE `t_goods_thread` SET `shop_id`='$shop_id', `cat_id`='$goods_cat_id', `shop_cat_id`='$shop_cat_id', `cat_key`='$goods_cat_key', `goods_name`='$goods_name', `goods_code`='$goods_code', `goods_doc`='$goods_doc', `summary`='$summary' $goods_image_sql , `content`='$goods_content' , `content_day`='$content_day', `price_note`='$price_note', `unprice_note`='$unprice_note', `market_price`='$market_price', `real_price`='$real_price', `stock`='$stock', `ref_price`='$ref_price_txt', `stock`='$stock', `sale_type`='$sale_type', `sale_start`='$sale_start', `sale_end`='$sale_end', `ft`='$ft', `goods_package`='$goods_package', `goods_type`='$goods_type', `goods_zone`='$goods_zone', `src_prov`='$src_prov', `src_city`='$src_city', `dist_prov`='$dist_prov', `dist_city`='$dist_city', `line_days`='$line_days', `line_nights`='$line_nights', `goto_transport`='$goto_transport', `back_transport`='$back_transport', `before_days`='$before_days', `order_note`='$order_note', `line_tag`='$line_tag', `visa_zone_id`='$visa_zone_id', `visa_type`='$visa_type', `visa_profile`='$visa_profile', `ship_name`='$ship_name', `ship_line`='$ship_line', `ship_port`='$ship_port', `ship_brand`='$ship_brand', `is_sale`='$is_sale'  WHERE `site_id`='$g_siteid' AND `goods_id`='$goods_id'";
	$db->query($sql);
	//�ײ� �޸�
	$sql = "UPDATE `t_zby_package` SET `room_max`='$room_max', `min`='$min', `max`='$max', `booker_name`='$booker_name', `booker_mobile`='$booker_mobile', `booker_email`='$booker_email', `traveller_name`='$traveller_name', `traveller_en_name`='$traveller_en_name', `traveller_mobile`='$traveller_mobile', `traveller_email`='$traveller_email', `traveller_person_type`='$traveller_person_type', `traveller_credentials`='$traveller_credentials', `traveller_credentials_type`='$traveller_credentials_type', `traveller_gender`='$traveller_gender', `traveller_birthday`='$traveller_birthday', `emergency`='$emergency' WHERE `goods_id`='$goods_id'";
	$db->query($sql);

	// ����SKU
	$adult_price_array = $_POST['adult_price'];
	if(notnull($adult_price_array)){
		foreach ($adult_price_array as $key => $value) { 
			$adult_price  = $_POST['adult_price'][$key];
			$adult_stock  = $_POST['adult_stock'][$key];
			$kid_price    = $_POST['kid_price'][$key];
			$kid_stock    = $_POST['kid_stock'][$key];
			$diff_price   = $_POST['diff_price'][$key];
			$lv_market_price = $_POST['ref_diff_price'];
			$sum_stock = ($adult_stock + $kid_stock);
			if($value>0){ 
				$sql = "SELECT `sku_id` FROM `t_goods_sku` WHERE `site_id`='$g_siteid' AND `goods_id`='$goods_id' AND `departdate`='$key'";
				$last_sku_id = $db->get_value($sql);
				if($last_sku_id!=''){
					
					$sql = "UPDATE `t_goods_sku` SET `adult_price`='$value', `kid_price`='$kid_price', `diff_price`='$diff_price', `adult_stock`='$sum_stock', `kid_stock`='$kid_stock', `lv_market_price`='$lv_market_price' WHERE `site_id`='$g_siteid' AND `sku_id`='$last_sku_id'";
					$db->query($sql); 
				} else { 

					$sql = "INSERT INTO `t_goods_sku` (`site_id`, `goods_id`, `departdate`, `adult_price`, `kid_price`, `diff_price`, `adult_stock`, `kid_stock`, `lv_market_price`,`ahead_day`/*,`ahead_time`*/) VALUES ('$g_siteid', '$goods_id', '$key', '$value', '$kid_price', '$diff_price', '$sum_stock', '$kid_stock', '$lv_market_price','$before_days'/*,'$ahead_time'*/)";
					$db->query($sql);
				}
			}
		}
	}

	// ���¼۸�(��ͼ�)
	if($goods_type!='3'){ //ǩ֤
		$sql = "SELECT MIN(`adult_price`) FROM `t_goods_sku` WHERE `site_id`='$g_siteid' AND `goods_id`='$goods_id' AND `departdate`>='".date('Y-m-d')."'";
		$min_price = $db->get_value($sql); 
		
		$sql = "UPDATE `t_goods_thread` SET `min_price`='$min_price' WHERE `goods_id`='$goods_id' AND `site_id`='$g_siteid'";
		$db->query($sql);
	} else { 
		$sql = "UPDATE `t_goods_thread` SET `min_price`='$real_price' WHERE `goods_id`='$goods_id' AND `site_id`='$g_siteid'";
		$db->query($sql);
	}
  
	/// ���·���  
	if(notnull($cats)){ 
		foreach ($cats as &$v) { 
			$catalogs .= $v.' ';
		}
		$catalogs = trim($catalogs);
		$sql = "UPDATE `t_goods_thread` SET catalogs='$catalogs' WHERE `goods_id`='$goods_id' AND `site_id`='$g_siteid'";
		$db->query($sql);
	}

	bingo();
}

if($cmd == 'goods_cat_rel'){
	$goods_id = req('goods_id');
	$cats = $_POST['cat_id'];

	/// ���·���  
	if(notnull($cats)){ 
		foreach ($cats as &$v) { 
			$catalogs .= $v.' ';
		}
		$catalogs = trim($catalogs);
		$sql = "UPDATE `t_goods_thread` SET catalogs='$catalogs' WHERE `goods_id`='$goods_id' AND `site_id`='$g_siteid'";
		$db->query($sql);
	}

	$url = "./?cmd=".base64_encode("goods_list.php");
	gourl($url);
}

if($cmd == 'goods_edit_fast'){  
	$item = req('item'); 
	$goods_id = req('goods_id');

	if($item=='goods_code'){
		$goods_code = req($item);
		$sql = "SELECT `goods_code` FROM `t_goods_thread` WHERE `goods_code`='$goods_code' AND `site_id`='$g_siteid'";
		$exist_goods_code = $db->get_value($sql); 
		if($exist_goods_code != ''){
			senderror('��Ʒ����Ѵ���');
		}
	}

	if($item == 'goods_name'){
		$ft = ft_split(req($item));

		$sql = "UPDATE `t_goods_thread` SET ".$item."='".req($item)."', `ft`='$ft' WHERE 1=1 AND `goods_id`='$goods_id'";	
	} else { 
		$sql = "UPDATE `t_goods_thread` SET ".$item."='".req($item)."' WHERE 1=1 AND `goods_id`='$goods_id'";
	}

	$db->query($sql);  

	sendresult("�ѱ������");
}

if($cmd == 'goods_sale_state'){   
	$goods_id = req('goods_id'); 
	$is_sale = req('is_sale'); 

	$db->query("UPDATE `t_goods_thread` SET is_sale='$is_sale' WHERE site_id='$g_siteid' AND goods_id='$goods_id'"); 
 
	bingo();
}

if($cmd == 'goods_del'){   
	$goods_id = req('goods_id'); 

	$upload_dir = "$g_root/upfiles/$g_siteid/";

	// ɾ����ͼ
	$sql = "SELECT `goods_name` FROM `t_goods_thread` WHERE site_id='$g_siteid' AND goods_id='$goods_id'";
	$goods_name = $db->get_value($sql);  

	if(file_exists($upload_dir.$goods_name)==true){
		unlink($upload_dir.$goods_name);
	}

	// ɾ������ͼƬ�ļ�
	$sql = "SELECT * FROM `t_goods_image` WHERE site_id='$g_siteid' AND goods_id='$goods_id'";
	$images = $db->get_all($sql);    

	if(notnull($images)){
		foreach ($images as $val){  
			if(file_exists($upload_dir.$val['filepath'])==true){
				unlink($upload_dir.$val['filepath']);
			}
		}
	}

	$db->query("DELETE FROM `t_goods_thread` WHERE site_id='$g_siteid' AND goods_id='$goods_id'");   
	$db->query("DELETE FROM `t_zby_package` WHERE goods_id='$goods_id'");   
	$db->query("DELETE FROM `t_goods_image` WHERE site_id='$g_siteid' AND goods_id='$goods_id'"); 

	bingo();
} 


if($cmd == 'goods_image_del'){   
	$image_id = req('image_id'); 

	$sql = "SELECT `filepath` FROM `t_goods_image` WHERE `site_id`='$g_siteid' AND `image_id`='$image_id'";
	$filepath = $db->get_value($sql);   

	$upload_dir = "$g_root/upfiles/$g_siteid/";
	if(file_exists($upload_dir.$filepath)==true){
		unlink($upload_dir.$filepath);
	}

	$db->query("DELETE FROM `t_goods_image` WHERE site_id='$g_siteid' AND `image_id`='$image_id' "); 

	js("parent.document.getElementById('goods_images_".$image_id."').style.display = 'none';");
}

?>