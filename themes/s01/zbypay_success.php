<?
if(!defined('IN_CLOOTA')) {
    exit('Access Denied');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="/themes/s01/images/pay_success.css">
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
                    <span>�ö�����������У������ĵȴ���</span>
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
                        <li><a href="">
                                <img src="/themes/s01/images/zby_cnxh.jpg">
                                <p>����+����+����˫��6��������</p>
                                <p>
                                    <span class="cnxh_infoLeft">�����ʣ�<b>100%</b></span>
                                    <span class="cnxh_infoRight"><b>&yen;666</b>��/��</span>
                                </p>
                            </a></li>

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