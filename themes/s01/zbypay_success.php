<?
if(!defined('IN_CLOOTA')) {
    exit('Access Denied');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="/themes/s01/images/pay_success.css">
<link rel="shortcut icon" type="image/png" href="http://www.bus365.com/public/images/bus365.png">
<title>�����ɹ�</title>
</head>
<body>
<!--  head  start -->
<?include('static.php');?>
<?include 'head.php';?>

<!-- head  end -->

<!--  nav����  start -->

<!--  nav����  end -->

<!-- Ԥ�������ɹ� start-->
<form name="order_form" method="post" action="/zhoubianyou/zbyorder_detail-<?=$pay_success_data['orderCode'];?>.html">
    <div id="zby_orderSuccess_mainBox">
        <div id="zby_orderSuccess_main">
            <div class="zby_orderSuccess_main_title">
                <img src="/themes/s01/images/zby_yudingSuccess.jpg">
            </div>

            <div class="zby_orderSuccess_main1">
                <div class="zby_orderSuccess_main1_cont">
                    <span>��ϲ��������֧���ɹ������ǽ������������ȷ�϶��š�</span>
                    <p><b>����ȷ�Ϻţ�</b><a><?echo $pay_success_data['orderCode'];?></a></p>
                    <p><b>��Ʒ���ƣ�</b><?echo $pay_success_data['goodsName'];?></p>
                    <p><b>�������ڣ�</b><?echo $pay_success_data['playDate'];?></p>
                    <input value="�鿴��������" type="submit" >
                    <!--                <a href="/member/?cmd=--><?//=base64_encode('pay_detail.php')?><!--"><button>�鿴��������</button></a>-->
                </div>
            </div>
            <div class="zby_orderSuccess_main2">
                <div class="zby_orderSuccess_main2_title">����ϲ��</div>

                <div class="zby_orderSuccess_main2_cont">
                    <ul>
                        <?
                        $guess_list = get_guess_list(10);
                        //                var_dump($guess_list);
                        if (notnull($guess_list)) {
                        foreach ($guess_list as $val) {
                        if(notnull($val['goods_id'])) {
                        $goods_image = $val['goods_image'];
                        //                            $goodsImage = $g_domain . "upfiles/$g_siteid/" . $val['goods_image'];
                        if ($val['goods_type'] == '4') {
                            $href = "/menpiao/ticket_detail-" . $val['goods_id'] . "-" . $val['lv_scenic_id'] . ".html";
                        } else {
                            $href = "/product/detail-" . $val['goods_id'] . "-" . $val['lv_scenic_id'] . ".html";
                        }
                        ?>
                        <li><a href="">
                                <a href="<?= $href?>" target="_blank"><img src="<?= $val['goods_image']?>"></a>
                                <p><a href="<?= $href?>" target="_blank"><?= zwjiequ($val['goods_name'],30)?></a></p>
                                <p>
                                    <span class="cnxh_infoLeft">�����ʣ�<b>100%</b></span>
                                    <span class="cnxh_infoRight"><b>&yen;<?= $val['min_price']?></b>��/��</span>
                                </p>
                            </a></li>
                            <?
                        }
                        }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Ԥ�������ɹ� end-->

<!--  foot  start -->
<?include 'foot.php';?>
<!--  foot  end -->
</body>
<script type="text/javascript">
    $(function() {

    }
</script>

</html>