<?
header("Content-type: text/html; charset=GBK");
include('config.php');
$ac = req('ac');


/// ������֤�Ķ���
$unauth_array = array(
    "customized",
    "guestbook",
);

if (in_array($ac, $unauth_array) == false) {
    include('auth.php');
}

function upload_file($fn, $upload_dir, $fname=''){
    global $g_dir;

    $img = $_FILES[$fn]['name'];

    if($img!=""){
        $img_temp = $_FILES[$fn]['tmp_name'];

        $this_file_size = filesize($img_temp)/1024;

        if($this_file_size>500){
            senderror("����ͼƬ/�������ó���500KB");
        }

        $temp_arrays = explode(".", $img);
        $img_type = $temp_arrays[sizeof($temp_arrays)-1];
        $img_type = strtolower($img_type);
        if($img_type=="jpg" || $img_type=="jpeg" || $img_type=="swf" || $img_type=="gif" || $img_type=="png"){
            if($fname==''){
                $upfile_path = date('Ymdhis').mt_rand(10000,99999).".".$img_type;
            } else {
                $upfile_path = $fname;
            }

            if(file_exists($upload_dir)==false){
                mkdir($upload_dir, 0777);
            }
            move_uploaded_file($img_temp, $upload_dir.$upfile_path);

        } else {
            senderror("ͼƬ��ʽ����ȷ��");
        }
    }
    return $upfile_path;
}


/// ���¸�������
if($ac == 'profile'){
    $username		= req('username');
    $nickname		= req('nickname');
    $mobile			= req('mobile');
    $sex			= req('sex');
    $birthday		= req('birthday');
    $idcard			= req('idcard');
    $tel			= req('tel');
    $qq				= req('qq');
    $wangwang		= req('wangwang');
    $email			= req('email');

    $sql = "UPDATE `t_user` SET `username`='$username', `nickname`='$nickname', `sex`='$sex', `birthday`='$birthday', `idcard`='$idcard', `mobile`='$mobile', `tel`='$tel', `qq`='$qq', `wangwang`='$wangwang', `email`='$email' WHERE `user_id`='$g_userid' ";
    $db->query($sql);

    gourl(url('profile.php'),'���������Ѹ��£�');
}

/// ��������
if($ac == 'passwd'){
    $oldpassword		= req('oldpassword');
    $newpassword		= req('newpassword');
    $renewpassword		= req('renewpassword');

    if(strlen($oldpassword)<5) {
        senderror('ԭ���벻��С��5���ַ���');
    }
    if(strlen($newpassword)<5) {
        senderror('�����벻��С��5���ַ���');
    }
    if($newpassword != $renewpassword) {
        senderror('������������벻һ�£�');
    }

    $sql = "SELECT user_id FROM `t_user` WHERE `user_id`='$g_userid' AND `password`=md5('$oldpassword') ";
    $exist_user = $db->get_value($sql);

    if($exist_user==''){
        senderror('ԭ�������');
    }

    $sql = "UPDATE `t_user` SET `password`=MD5('$newpassword') WHERE `user_id`='$g_userid' AND `site_id`='$g_siteid'";
    $db->query($sql);

    gourl(url('passwd.php'),'�����Ѹ��£�');
}

//----------------------------------------------/// ��������

function get_order_code(){
    global $db, $g_siteid;

    $sql = "SELECT `code` FROM `t_user_order_code` ";
    $max_order_code = $db->get_value($sql);

    $sql = "UPDATE `t_user_order_code` SET `code`=`code`+1";
    $db->query($sql);

    return $max_order_code;
}

function send_order_notice($this_order, $shop_id){
    global $db, $g_sitename, $g_domain, $g_siteid, $sms_juhe_id_notice;

    $order_code = $this_order['order_code'];

    // �̼���Ϣ
    $sql = "SELECT * FROM `t_shop` WHERE `shop_id`='$shop_id' ";
    $this_shop = $db->get_one($sql);

    // ���Ͷ���...
    $this_shop_mobile = $this_shop['mobile'];
    if($this_shop_mobile!=''){
        send_sms($sms_juhe_id_notice, $this_shop_mobile, $order_code, '', '');
    }

    // �ʼ���Ϣ
    $mail_title	= $g_sitename.'����('.$this_order['order_code'].')����';
    $mail_body	= "<h3>$mail_title</h3>�����ţ�".$this_order['order_code']."<br/> �µ����ڣ�".$this_order['addtime']."<br/> �µ��ͻ���".$this_order['linker']."<br/> �ֻ���".$this_order['mobile']."<br/> ��ַ��".$this_order['address']." <br/><br/> ���¼ $g_sitename <a href='".$g_domain."'>��������</a> <br/><br/><em>���ʼ���ϵͳ�Զ����ͣ�����ֱ�ӻظ���</em>";

    // �����ʼ�...
    $this_shop_email = $this_shop['email'];
    if($this_shop_email!=''){
        send_member_mail($mail_title, $mail_body, $this_shop_email);
    } else {
        send_member_mail($mail_title, $mail_body);
    }
}

/// ֧�����ύ����
if($ac == 'order'){
    $goods_id		= req('goods_id');
    $departdate		= req('departdate');
    $adult_num		= req('adult_num');
    $kid_num		= req('kid_num');
    $linker			= req('linker');
    $mobile			= req('mobile');
    $address		= req('address');
    $pay_type		= req('pay_type');
    $addtime		= date('Y-m-d H:i:s');

    if($kid_num=='') $kid_num = '0';

    if($goods_id==''){
        senderror('ϵͳ��Դ����ȷ');
    }

    if($adult_num < 1){
        senderror('��ѡ������');
    }

    // ��Ʒ��ϸ
    $sql = "SELECT * FROM `t_goods_thread` WHERE `goods_id`='$goods_id' AND site_id='$g_siteid'";
    $goods = $db->get_one($sql);

    $goods_type		= $goods['goods_type'];
    $goods_name		= $goods['goods_name'];
    $is_sale		= $goods['is_sale'];
    $sale_type		= $goods['sale_type'];
    $sale_end		= $goods['sale_end'];

    if($is_sale == '0'){
        senderror('��Ʒ�Ѿ��¼�');
    }

    if($sale_type>0){
        if(date('Y-m-d H:i:s')>=$sale_end){
            senderror('��Ʒ�Ѿ�����');
        }
    }

    if($goods_type!='3'){
        $sql = "SELECT * FROM `t_goods_sku` WHERE `site_id`='$g_siteid' AND `goods_id`='$goods_id' AND `departdate`='$departdate'";
        $sku = $db->get_one($sql);

        if($sku['sku_id']==''){
            senderror('�Բ��𣬸ò�Ʒ�޷�������');
        }
    }

    $order_code		= get_order_code(); //һ����Ʒһ������

    $shop_id		= $goods['shop_id'];
    $adult_price	= $sku['adult_price'];
    $kid_price		= $sku['kid_price'];
    $goods_name		= $goods['goods_name'];
    $goods_image	= $goods['goods_image'];
    $goods_type		= $goods['goods_type'];

    if($goods_type=='3'){
        $adult_price = $goods['real_price']; //ǩ֤��һ���Լ۸�
    }

    //Ӧ�����
    $pay_price		= $adult_price*$adult_num + $kid_price*$kid_num;
    $real_price		= $pay_price;

    if($goods_type=='3'){ //ǩ֤�Ƕ������
        if($goods['stock']<$adult_num){
            senderror('��治�㣡');
        }
    } else {
        // �����
        if($sku['adult_stock']<$adult_num){
            senderror('���˿�治�㣡');
        }
        if($sku['kid_stock']<$kid_num){
            senderror('��ͯ��治�㣡');
        }
    }

    // ��Ʒ����
    $goods_snapshot = addslashes(serialize($goods));


    $sql = "INSERT INTO `t_user_order` (`site_id`, `shop_id`, `user_id`, `order_code`, `goods_id`, `goods_type`, `sku_id`, `adult_num`, `adult_price`,	`kid_num`, `kid_price`, `departdate`, `diff_num`, `diff_price`,  `goods_name` , `goods_image` , `pay_price`, `pay_type`, `real_price`, `state`, `is_read`, `addtime` , `traffic_id`, `linker`, `mobile`, `address`, `goods_snapshot`) 
	VALUES ('$g_siteid', '$shop_id', '$g_userid', '$order_code', '$goods_id', '$goods_type', '".$sku['sku_id']."', '$adult_num', '$adult_price', '$kid_num', '$kid_price', '$departdate', '$diff_num', '$diff_price', '$goods_name', '$goods_image', '$pay_price', '$pay_type', '$real_price', '1', '0', '$addtime', '$traffic_id', '$linker', '$mobile', '$address', '$goods_snapshot')";
    $db->query($sql);

    // ���¶�������(����+��ͯ����) ����ʵ�����������¼��㣩
    $db->query("UPDATE `t_goods_thread` SET sale_number=sale_number+$adult_num+$kid_num WHERE `site_id`='$g_siteid' AND `goods_id`='$goods_id'");

    // ��ѯ������Ϣ
    $sql = "SELECT * FROM `t_user_order` WHERE `order_code`='$order_code' AND site_id='$g_siteid'";
    $this_order = $db->get_one($sql);

    // ����֪ͨ
    send_order_notice($this_order, $shop_id);

    if($this_order['pay_type']!='default'){ // ��ת������֧��

        $pay_url = "pay.gateway?order_code=".$this_order['order_code']."&price=".$this_order['real_price']."&user=".$this_order['user_id']."&pay_type=".$this_order['pay_type'];

        gotop($pay_url);
    } else {
        gotop(url('order.php'));
    }
}

/// ����ȷ��
if($ac == 'order_success'){
    $order_code = req('order_code');
    $addtime	= date('Y-m-d H:i:s');

    // ȷ�ϻ��ţ��������
    $sql = "UPDATE `t_user_order` SET state='4' WHERE site_id='$g_siteid' AND `order_code`='$order_code'";
    $db->query($sql);

    /// ������� ///

    // �����ܶ�
    $sql = "SELECT `real_price` FROM `t_user_order` WHERE order_code='$order_code' LIMIT 0,1";
    $real_price = $db->get_value($sql);

    $score_number = round($real_price); //������������

    // ��������
    $sql = "INSERT INTO `t_user_score` (`site_id`, `user_id`, `score_number`, `score_note`, `addtime`) VALUES ('$g_siteid', '$g_userid', '$score_number', '�������ͻ��֣�".$score_number."�������ţ�".$order_code."������".$real_price."Ԫ', '$addtime')";
    $db->query($sql);

    gourl(url('order.php'));
}

/// ȡ������
if($ac == 'order_close'){
    $order_code = req('order_code');

    $db->query("UPDATE `t_user_order` SET state='5' WHERE site_id='$g_siteid' AND `order_code`='$order_code'");

    gourl(url('order.php'));
}


/// �ͻ��Ĳ�Ʒ����
if($ac == 'comment'){
    $goods_id		= req('goods_id');
    $comment_level	= req('comment_level');
    $content		= req('content');
    $addtime		= date('Y-m-d H:i:s');

    $sql = "INSERT INTO `t_goods_comment` (`subject_id` , `is_first` , `site_id` , `goods_id` , `user_id` , `comment_level` , `content` , `addtime` ) VALUES (comment_id, '1', '$g_siteid', '$goods_id' , '$g_userid', '$comment_level' , '$content', '$addtime' )";
    $db->query($sql);

    gourl(url('comment.php'));
}



/// ���ֶ���
if($ac == 'score_order'){
    $goods_id		= req('goods_id');
    $order_number	= req('order_number');
    $linker			= req('linker');
    $mobile			= req('mobile');
    $address		= req('address');
    $order_note		= req('order_note');
    $addtime		= date('Y-m-d H:i:s');


    $sql = "SELECT * FROM `t_score_goods_thread` WHERE `goods_id`='$goods_id' AND site_id='$g_siteid'";
    $goods = $db->get_one($sql);

    $goods_name		= $goods['goods_name'];
    $score_number	= $goods['score_number'];
    $is_sale		= $goods['is_sale'];

    // �¼ܼ��
    if($is_sale == '0'){
        senderror('�Բ��𣬸ò�Ʒ�Ѿ��¼ܣ�');
    }

    // �����
    if($goods['stock']<$order_number){
        senderror('�Բ��𣬲�Ʒ��治�㣡');
    }

    // ��Ʒ����
    $goods_snapshot = addslashes(serialize($goods));

    // �µ�
    $sql = "INSERT INTO `t_user_score_order` (`site_id`, `user_id`, `goods_id`, `goods_name`, `order_number`, `score_number`, `state`, `linker`, `mobile`, `address`, `order_note`, `goods_snapshot`, `addtime`) VALUES ('$g_siteid', '$g_userid', '$goods_id', '$goods_name', '$order_number', '$score_number', '1', '$linker', '$mobile', '$address', '$order_note', '$goods_snapshot', '$addtime');";
    $db->query($sql);

    // ���¿��
    $db->query("UPDATE `t_score_goods_thread` SET `stock`=`stock`-$order_number WHERE `site_id`='$g_siteid' AND `goods_id`='$goods_id'");

    // �����û�����
    $sql = "INSERT INTO `t_user_score` (`site_id`, `user_id`, `score_number`, `score_note`, `addtime`) VALUES ('$g_siteid', '$g_userid', '-$score_number', '���ֶһ���Ʒ��".$goods_name."�����ѻ���".$score_number."', '$addtime')";
    $db->query($sql);

    gotop(url('score_order.php'));
}

/// �ͻ�����
if($ac == 'guestbook'){
    $hash = req('hash');

    if($hash != md5('GUESTBOOK'.date('YmdH'))){
        senderror('�Բ��𣬷Ƿ�������');
    }

    $ref_url		= req('url');
    $username		= req('username');
    $email			= req('email');
    $address		= req('address');
    $tel			= req('tel');
    $qq				= req('qq');
    $content		= req('content');
    $addtime		= date('Y-m-d H:i:s');

    if($username=='' || $tel=='' || $content==''){
        senderror('������д��ϵ��ʽ���������ݣ�');
    }

    $sql = "INSERT INTO `t_guestbook` (`site_id`, `user_id`, `username`, `email`, `tel`, `qq`, `address`, `content`, `addtime`) VALUES ('$g_siteid', '$g_userid', '$username', '$email', '$tel', '$qq', '$address', '$content', '$addtime' )";
    $db->query($sql);

    if($ref_url=='') $ref_url='/';

    js("alert('��л�������ԣ����ǻᾡ��������ϵ��');window.top.location.replace('$ref_url');");
    exit;
}

/// ���Ŷ���
if($ac == 'customized'){
    $hash = req('hash');

    if($hash != md5('CUSTOMIZED'.date('YmdH'))){
        senderror('�Բ��𣬷Ƿ�������');
    }

    session_start();
    $rand_code = $_SESSION['rand_code'];

    if(req('rand_code')!=$rand_code){
        senderror('�Բ�����֤�����');
    }

    $ref_url			= req('url');
    $linker				= req('linker');
    $mobile				= req('mobile');
    $email				= req('email');
    $destination		= req('destination');
    $tourist_num_max	= req('tourist_num_max');
    $tourist_num_min	= req('tourist_num_min');
    $content			= addslashes(serialize($_POST));
    $addtime			= date('Y-m-d H:i:s');

    if($linker=='' || $mobile=='' || $email==''){
        senderror('�ף����������Ϣ��������');
    }

    $sql = "INSERT INTO `t_customized` (`site_id` , `linker` , `mobile` , `content` , `email`, `addtime` ) VALUES ('$g_siteid', '$linker', '$mobile', '$content', '$email', '$addtime' )";
    $db->query($sql);

    send_member_mail($g_sitename.'����(����)����', "��ϵ�ˣ� $linker  <br/><br/> �ֻ���$mobile <br/><br/> Ŀ�ľ�����$destination <br/><br/> ����������$tourist_num_min - $tourist_num_max �� <br/><br/>�����������ڣ�$addtime <br/><br/> <a href='".$g_domain."console/?cmd=".base64_encode('customized.php')."'>��������</a>");

    if($ref_url=='') $ref_url='/';

    js("alert('���Ķ�����������л��ע��');window.top.location.replace('$ref_url');");

    exit;
}

/// ���ο�����Ϣ
if($ac == 'tourist_add'){
    $order_code = req('order_code');

    // ��������
    $sql = "SELECT `shop_id` FROM `t_user_order` WHERE `order_code`='$order_code' LIMIT 0,1";
    $shop_id = $db->get_value($sql);

    $db->query("DELETE FROM `t_user_order_tourist` WHERE `user_id`='$g_userid' AND `order_code`='$order_code'");

    $names = sizeof($_POST['name']);
    for ($i=0; $i<$names; $i++) {
        if($_POST['name'][$i]!=''){
            $sql = "INSERT INTO `t_user_order_tourist` (`site_id`, `shop_id`, `user_id`, `order_code`, `order_id`, `user_name`, `user_idcard`, `user_age`) VALUES ('$g_siteid', '$shop_id', '$g_userid', '$order_code', '$order_id', '".$_POST['name'][$i]."', '".$_POST['idcard'][$i]."', '".$_POST['age'][$i]."');";
            $db->query($sql);
        }
    }

    gotop(url('order.php').'&order_code='.$order_code);
}


/// �̼����뵥
if($ac == 'union_join'){
    $company_name		= req('company_name');
    $leader_name		= req('leader_name');
    $leader_card		= req('leader_card');
    $linker				= req('linker');
    $sex				= req('sex');
    $mobile				= req('mobile');
    $tel				= req('tel');
    $qq					= req('qq');
    $email				= req('email');
    $trip_code			= req('trip_code');

    $upload_dir			= "$g_root/upfiles/$g_siteid/";
    $leader_card_file	= upload_file('leader_card_file', $upload_dir);
    $license_file		= upload_file('license_file', $upload_dir);
    $cert_file			= upload_file('cert_file', $upload_dir);
    $tax_file			= upload_file('tax_file', $upload_dir);
    $trip_file			= upload_file('trip_file', $upload_dir);

    $profiles = array();

    $profiles['company_name']		= $company_name;
    $profiles['leader_name']		= $leader_name;
    $profiles['leader_card']		= $leader_card;
    $profiles['linker']				= $linker;
    $profiles['sex']				= $sex;
    $profiles['mobile']				= $mobile;
    $profiles['tel']				= $tel;
    $profiles['qq']					= $qq;
    $profiles['email']				= $email;
    $profiles['trip_code']			= $trip_code;
    $profiles['leader_card_file']	= $leader_card_file;
    $profiles['license_file']		= $license_file;
    $profiles['cert_file']			= $cert_file;
    $profiles['tax_file']			= $tax_file;
    $profiles['trip_file']			= $trip_file;

    $profiles_json					= addslashes(serialize($profiles));
    $addtime						= date('Y-m-d H:i:s');

    $sql = "DELETE FROM `t_shop_join` WHERE `user_id`='$g_userid' ";
    $db->query($sql);

    $sql = "INSERT INTO `t_shop_join` (`site_id`, `user_id`, `profiles`, `state`, `addtime`) VALUES ('$g_siteid', '$g_userid', '$profiles_json', '0', '$addtime')";
    $db->query($sql);


    gotop(url('union_join.php'), '�����Ѿ��ύ�����ǽ����촦��');
}

if($ac == 'check'){
   var_dump($_REQUEST);



    //    $post['goodsId'] = req('goodsId');
//    $post['departdate'] = req('departdate');
//    $post['adultNum'] = req('adultNum');
//    $post['kidNum'] = req('kidNum');
//    $post['payPrice'] = req('payPrice');
//    $post['linker'] = req('linker');
//    $post['linker'] = iconv('GBK', 'UTF-8', $post['linker']); //���ַ����ı����GB2312ת��UTF-8
//    $post['mobile'] = req('mobile');
//    $post['userName'] = req('userName');
//    $post['userPhone'] = req('userPhone');
//    $post['userIdcard'] = req('userIdcard');
    //$post['touristList']='[{"userIdcard":'.$userIdcard.',"userName":'.$userName.',"userPhone":'.$userPhone.'},{"userIdcard":"211481198401154411","userName":"laozhao","userPhone":"18242984568"}]';


    gotop(url('zhifu.php'));



//        $post['goodsId'] = '8000000';
//    $post['userId'] = req('userId');
//    $post['userId'] = '93';
//        $post['departdate'] = '2017-03-15';
//        $post['adultNum'] = '1';
//        $post['kidNum'] = '1';
//    $post['payPrice'] = '11';
//        $post['linker'] = 'laowang';
//        $post['mobile'] = '18518988355';
//    $post['token'] = '{"clienttoken":"7A4D2543F258FD7062F842ADD950496ADEADB75BEE76FFBD2B153AD5F2BFEE823863DA9C55A8BF58DEB73C9CCABC30326EC113721043ABA98B3EE1771A41993AA089FAEC25AFEE98F057BAFED0D7B2F1","clienttype":"1","devicetoken":"1","ordertoken":"1","wxcityid":"1"}';
//
//    $post['touristList']='[{"userIdcard":"211481198401154411","userName":"wangge","userPhone":"18841184568"},{"userIdcard":"211481198401154411","userName":"laozhao","userPhone":"18242984568"}]';
//
//
//    //У�鶩��
//    var_dump($post);die;
//    $post = array_iconv($post,'gbk','utf-8');
//    $data = post_curl($host."/travel/interface/order/saveZbyOrder",$post);
//    $data = json_decode($data,true);
////    if ($data['status'] != '0000'){
////        exit('�¶���ʧ��');
////    }
//    $arr = array();
////    var_dump($data);
//    $data = array_iconv($data,'UTF-8','GBK');
//    foreach($data as $key => $value){
////        if (empty($value)) continue;
//        if (is_array($value)) {
//            $arr['payPrice'] = $value['payPrice'];
//            $arr['orderCode'] = $value['orderCode'];
//            $arr['goodsName'] = $value['goodsName'];
//        }else{
//            if ($key == 'msg') $arr['msg'] = $value;
//            else  $arr['status'] = $value;
//        }
//    }
//
//    $trans['token'] = '{"clienttoken":"7A4D2543F258FD7062F842ADD950496ADEADB75BEE76FFBD2B153AD5F2BFEE823863DA9C55A8BF58DEB73C9CCABC30326EC113721043ABA98B3EE1771A41993AA089FAEC25AFEE98F057BAFED0D7B2F1","clienttype":"1","devicetoken":"1","ordertoken":"1","wxcityid":"1"}';
//    $brr = post_curl($host."/travel/interface/pay/getPayWays",$trans);
//    $brr = json_decode($brr,true);
////    if ($brr['status'] != '0000'){
////        exit('��ȡ����ʧ��');
////    }
////    var_dump($brr);
//    $zhifu = $brr['data'];
//    if (notnull($zhifu)) {
//
//        foreach ($zhifu as $key => $value) {
//            if ($value['bankcode'] == 'alipayweb') {
//                $arr['alipaywebid'] = $value['id'];
//                $arr['alipaywebbc'] = $value['bankcode'];
//
//            }
//            if ($value['bankcode'] == 'wxqrcode') {
//                $arr['wxqrcodeid'] = $value['id'];
//                $arr['wxqrcodebc'] = $value['bankcode'];
//            }
//        }
//
//    }
//
//
//    gotop(url('zhifu.php')."&payPrice=".$arr['payPrice']."&orderCode=".$arr['orderCode']."&goodsName=".$arr['goodsName']."&alipaywebid=".$arr['alipaywebid']."&wxqrcodeid=".$arr['wxqrcodeid']."&alipaywebbc=".$arr['alipaywebbc']."&wxqrcodebc=".$arr['wxqrcodebc']);

}


if($ac == 'do_pay') {
    $post['totalprice'] = req('totalprice');
    $post['orderno'] = req('orderno');
    $post['topayinfoid'] = req('topayinfoid');
    $post['successpage'] = $g_domain_return.'/member/?cmd=cGF5X3N1Y2Nlc3MucGhw';

    $post['token'] = '{"clienttoken":"7A4D2543F258FD7062F842ADD950496ADEADB75BEE76FFBD2B153AD5F2BFEE823863DA9C55A8BF58DEB73C9CCABC30326EC113721043ABA98B3EE1771A41993AA089FAEC25AFEE98F057BAFED0D7B2F1","clienttype":"1","devicetoken":"1","ordertoken":"1","wxcityid":"1"}';
//    var_dump($_REQUEST);die;

//    $post['orderno'] = '9908000339';
//    $post['totalprice'] = '11';
//    $post['topayinfoid'] = '65';
//    $aaa = urlencode($post['orderno']);
    $aaa = $post['orderno'];
    $post['successpage'] = 'http://www.echinabus.cn/member/?cmd=cGF5X3N1Y2Nlc3MucGhw&orderCode='.$aaa;
    $url = $host.'/travel/interface/pay/createpayparam';
    $result = post_curl($url, $post);
    $result = json_decode($result, true);
    if ($result['status'] != '0000'){
        exit('��ȡ֧������ʧ��');
    }
    $form = iconv('utf-8','GBK',$result['data']);
//    var_dump($form);
    echo $form;
    if($post['topayinfoid'] == 65){
       $js = '<script>document.getElementById("form_payment_alipay").submit();</script>';
       echo $js;
    }
}

/**
 * �ɹ���ص���ַ
 *
 * �ص���ַ    http://www.echinabus.cn/member/pay_success/orderCode/****
 */


?>