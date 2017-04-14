<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="gbk">
    <title>��������</title>
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/common.css">
    <link rel="stylesheet" type="text/css" href="/themes/s01/images/zhoubianyoudianping.css">
</head>
<body>
<!--  head  start -->
<?include 'head.php';?>
<!--  nav����  end -->
<div id="myOrder_mainBox">
    <div id="myOrder_main">
        <div class="currentPos">��ǰλ�ã�<a href="">�й���·��Ʊ��</a> &gt; <a href="<?=$g_bus365_domain?>/index/order/orders/">�ҵĶ���</a> &gt; ������</div>

        <div class="myOrder_mainContent">
            <div class="myOrder_mainLeft">
                <div class="myOrder_mainLeftTitle">�ҵ�BUS365</div>
                <dl>
                    <dt>��������</dt>
                    <a href="<?=$g_bus365_domain?>/index/order/orders/"><dd class="myOrder_hover1">�ҵĶ��� <span>&gt;</span></dd></a>
                </dl>
                <dl>
                    <dt>��Ա����</dt>
                    <a href="<?=$g_bus365_domain?>/user/touserinfo/0"><dd>��Ա��Ϣ<span>&gt;</span></dd></a>
                    <a href="<?=$g_bus365_domain?>/user/touserprivate/0"><dd>��Ա��ȫ<span>&gt;</span></dd></a>
                    <a href="<?=$g_bus365_domain?>/passenger/getPiList/0?page=1&size=5"><dd>���ó˳���ϵ�˹���<span>&gt;</span></dd></a>
                    <a href="<?=$g_bus365_domain?>/coupon0"><dd>�ҵ��Ż�ȯ<span>&gt;</span></dd></a>
                </dl>
            </div>

            <div class="orderDetail_noEvaluate_main">
                <div class="orderDetail_noEvaluate_main1">
                    <span>�����ţ�<?echo $orderCode;?></span>
                </div>
                <div class="orderDetail_noEvaluate_main2">
                    <ul>
                        <li>����<span class="haoping"></span></li>
                        <li>����<span class="zhongping"></span></li>
                        <li>����<span class="chaping"></span></li>
                        <input type="hidden" id="commentLevel" value="<?echo $comment_detail_data[0]['commentLevel'];?>">
                    </ul>
                </div>
                <div class="dianpingneirong">
                    <?
                      foreach($comment_detail_data as $key => $value ){
                          echo $value['content']."<br>";
                      }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<!--  foot  start -->
<?include 'foot.php';?>
<!--  foot  end -->
</body>
<script type="text/javascript">
       var commentLevel = $("#commentLevel").val();
  window.onload=function(){
        //����
        if (commentLevel == '1') {
            $('.haoping').css("backgroundPosition","0px 0px");
            $('.zhongping').css("backgroundPosition","-32px 0px");
            $('.chaping').css("backgroundPosition","-64px 0px");
        }
        //����
        if (commentLevel == '2') {
            $('.haoping').css("backgroundPosition","0px 0px");
            $('.zhongping').css("backgroundPosition","-32px -32px");
            $('.chaping').css("backgroundPosition","-64px 0px");
        }
        //����
        if (commentLevel == '3') {
            $('.haoping').css("backgroundPosition","0px 0px");
            $('.zhongping').css("backgroundPosition","-32px 0px");
            $('.chaping').css("backgroundPosition","-64px -32px");
        }
    }
</script>

</html>