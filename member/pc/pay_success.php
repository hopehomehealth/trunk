<?
if(!defined('IN_CLOOTA')) {
    exit('Access Denied');
}
?>

<link rel="stylesheet" type="text/css" href="/themes/s01/images/pay_success.css">

<!--  head  start -->
<?include 'head.php';?>

<!-- head  end -->

<!--  nav����  start -->

<!--  nav����  end -->

<!-- Ԥ�������ɹ� start-->
<?
$post['token'] = '{"clienttoken":"7A4D2543F258FD7062F842ADD950496ADEADB75BEE76FFBD2B153AD5F2BFEE823863DA9C55A8BF58DEB73C9CCABC30326EC113721043ABA98B3EE1771A41993AA089FAEC25AFEE98F057BAFED0D7B2F1","clienttype":"1","devicetoken":"1","ordertoken":"1","wxcityid":"1"}';
$post['orderCode'] = req('orderCode');
$pay_detail = post_curl($host."/travel/interface/zby/getZbyOrderDetail",$post);
$pay_detail = json_decode($pay_detail,true);
$pay_detail = array_iconv($pay_detail);
//var_dump($pay_detail);
//if ($pay_detail['status'] != '0000'){
//    exit('֧��ʧ��');
//}
$pay_data = $pay_detail['data'];
$playDate = $pay_data['playDate'];
$orderCode = $pay_data['orderCode'];
$goodsName = $pay_data['goodsName'];


?>
<!--<form method="post" action="do.php?ac=do_success" >-->
<form name="order_form" method="post" action="/member/?cmd=<?=base64_encode('pay_detail.php')?>&orderCode=<?=$orderCode;?>">
<!--    <input type="hidden" name="orderCode" value="--><?//echo $orderCode;?><!--">-->
<div id="zby_orderSuccess_mainBox">
    <div id="zby_orderSuccess_main">
        <div class="zby_orderSuccess_main_title">
            <img src="/themes/s01/images/zby_yudingSuccess.jpg">
        </div>

        <div class="zby_orderSuccess_main1">
            <div class="zby_orderSuccess_main1_cont">
                <span>��ϲ��������Ԥ���ɹ������ǽ������������ȷ�϶��š�</span>
                <p>��԰��ʽ������ƾ����������NEW���͵���������ţ���������Ʊ��������Ʊ��԰��</p>
                <p>����ȷ�Ϻţ�<a><?echo $orderCode;?></a></p>
                <p>Ʊ�����ƣ�<?echo $goodsName;?></p>
                <p>��԰���ڣ�<?echo $playDate;?></p>
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
                    <li><a href="">
                            <img src="/themes/s01/images/zby_cnxh.jpg">
                            <p>����+����+����˫��6��������</p>
                            <p>
                                <span class="cnxh_infoLeft">�����ʣ�<b>100%</b></span>
                                <span class="cnxh_infoRight"><b>&yen;666</b>��/��</span>
                            </p>
                        </a></li>
                    <li><a href="">
                            <img src="/themes/s01/images/zby_cnxh.jpg">
                            <p>����+����+����˫��6��������</p>
                            <p>
                                <span class="cnxh_infoLeft">�����ʣ�<b>100%</b></span>
                                <span class="cnxh_infoRight"><b>&yen;666</b>��/��</span>
                            </p>
                        </a></li>
                    <li><a href="">
                            <img src="/themes/s01/images/zby_cnxh.jpg">
                            <p>����+����+����˫��6��������</p>
                            <p>
                                <span class="cnxh_infoLeft">�����ʣ�<b>100%</b></span>
                                <span class="cnxh_infoRight"><b>&yen;666</b>��/��</span>
                            </p>
                        </a></li>
                    <li><a href="">
                            <img src="/themes/s01/images/zby_cnxh.jpg">
                            <p>����+����+����˫��6��������</p>
                            <p>
                                <span class="cnxh_infoLeft">�����ʣ�<b>100%</b></span>
                                <span class="cnxh_infoRight"><b>&yen;666</b>��/��</span>
                            </p>
                        </a></li>
                    <li><a href="">
                            <img src="/themes/s01/images/zby_cnxh.jpg">
                            <p>����+����+����˫��6��������</p>
                            <p>
                                <span class="cnxh_infoLeft">�����ʣ�<b>100%</b></span>
                                <span class="cnxh_infoRight"><b>&yen;666</b>��/��</span>
                            </p>
                        </a></li>
                    <li><a href="">
                            <img src="/themes/s01/images/zby_cnxh.jpg">
                            <p>����+����+����˫��6��������</p>
                            <p>
                                <span class="cnxh_infoLeft">�����ʣ�<b>100%</b></span>
                                <span class="cnxh_infoRight"><b>&yen;666</b>��/��</span>
                            </p>
                        </a></li>
                    <li><a href="">
                            <img src="/themes/s01/images/zby_cnxh.jpg">
                            <p>����+����+����˫��6��������</p>
                            <p>
                                <span class="cnxh_infoLeft">�����ʣ�<b>100%</b></span>
                                <span class="cnxh_infoRight"><b>&yen;666</b>��/��</span>
                            </p>
                        </a></li>
                    <li><a href="">
                            <img src="/themes/s01/images/zby_cnxh.jpg">
                            <p>����+����+����˫��6��������</p>
                            <p>
                                <span class="cnxh_infoLeft">�����ʣ�<b>100%</b></span>
                                <span class="cnxh_infoRight"><b>&yen;666</b>��/��</span>
                            </p>
                        </a></li>
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