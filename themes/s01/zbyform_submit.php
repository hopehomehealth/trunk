<?
if(!defined('IN_CLOOTA')) {
    exit('Access Denied');
}
 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="gbk">
<link rel="stylesheet" type="text/css" href="/themes/s01/images/tianxie.css">
<script type="text/javascript" src="/themes/s01/js/menpiaoliebiao.js"></script>
<link rel="stylesheet" type="text/css" href="/themes/s01/images/common.css">
<link rel="stylesheet" type="text/css" href="/themes/s01/images/menpiaoliebiao.css">
<link rel="stylesheet" type="text/css" href="/themes/s01/images/list.css">
<script type="text/javascript" src="/themes/s01/js/jquery.js "></script>
<script type="text/javascript" src="/themes/s01/js/common.js"></script>
<title>�ܱ��ζ���</title>
</head>
<body><?if (notnull($orderCode)){ ?>
    <form action="<?=$g_self_domain?>/zhoubianyou/zbyonline_pay-<?=$orderCode;?>.html" method="post" id="onlineForm">
        <input type="hidden" name="payPrice" value="<?=$payPrice?>">
        <input type="hidden" name="goodsName" id="goodsName" value="<?=$goodsName?>">
        <input type="hidden" name="payTime"  value="<?=$payTime?>">
        <input type="hidden" name="departdate"  value="<?=$departdate?>">
        <input type="hidden" name="peopleNum"  value="<?=$peopleNum?>">
        <input type="hidden" name="unitPrice"  value="<?=$unitPrice?>">
        <input type="hidden" name="lvGoodsName"  value="<?=$lvGoodsName?>">
        <input type="hidden" name="orderCode"  value="<?=$orderCode?>">
    </form>
    
<?  $js = "<script>document.getElementById('onlineForm').submit();</script>";
    echo $js;}?>
<?include('static.php');?>
<?include 'head.php';?>



<div id="zbyOrder_mainBox">
    <div id="zbyOrder_main">
        <div class="zbyOrder_main_title">
            <img src="/themes/s01/images/zby_fillInOrder.jpg">
        </div>
        <form name="write_form" id="write_form" method="post" action="<?=$g_self_domain?>/zhoubianyou/zbyform_submit-1.html?departDate=<?=$tc['departDate']?>&lvProductId=<?=$tc['lvProductId']?>&packageId=<?=$tc['packageId']?>&adultNum=<?=$_GET['adultNum']?>&childNum=<?=$_GET['childNum']?>&roomCount=<?=$_GET['roomCount']?>&payPrice=<?=$_GET['payPrice']?>&packageNum=<?=$_GET['packageNum']?>&goodsType=<?=$_GET['goodsType']?>&flag=check">
        <? if($is_package == 'false'){ ?>
            <div class="zbyOrder_main1">
            <br>����ʱ�䣺<?=$tc['departDate']?>
                <div class="zbyOrder_main1_title" title='<?=$taocan['goodsName']?>'>
                    <?=jiequ(52,$taocan['goodsName'])?>
                </div>
                <div class="zbyOrder_main1Cont">
                    <div class="zbyOrder_main1ContLeft">�ܱ���</div>
                    <div class="zbyOrder_main1ContRight">
                        <table>
                            <thead>
                            <tr>
                                <td>��Ʒ��Ϣ</td>
                                <td>����</td>
                                <td>����</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>����</td>
                                <td id="adultPrice">
                                    <?=$taocan['adultPrice']?>
                                </td>
                                <td><?if($taocan['travellerName']=='TRAV_NUM_ONE'||$taocan['travellerName']=='TRAV_NUM_NO'){?>
                                    <span class="caculate" onselectstart="return false">
                                        <span class="subtract">-</span>
                                        <span class="counts" id='adultNum'><?=$adultNum?></span>
                                        <span class="add">+</span>
                                    </span>
                                    <?}else{?>
                                    <span id='adultNum'><?=$adultNum?></span>
                                    <?}?>
                                </td>
                            </tr>
                            <tr>
                                <td>��ͯ</td>
                                <td id="kidPrice">
                                    <?=$taocan['kidPrice']?>
                                </td>
                                <td><?if($taocan['travellerName']=='TRAV_NUM_ONE'||$taocan['travellerName']=='TRAV_NUM_NO'){?>
                                    <span class="caculate" onselectstart="return false">
                                        <span class="subtract">-</span>
                                        <span class="counts" id='kidNum'><?=$kidNum?></span>
                                        <span class="add">+</span>
                                    </span>
                                    <?}else{?>
                                    <span id='kidNum'><?=$kidNum?></span>
                                    <?}?>
                                </td>
                            </tr>
                            </tbody>
                            <thead>
                            <tr>
                                <td title='�����ι����е�ס�ް�����������λ�ı�׼�䣬�ŷ����Ǹ���1������ռ1�Ŵ�����ġ���������������ˣ�Ϊ����ʱ����Ҫ��������һ���˴�λ�ķ��á�����ʵ�����ι������ܹ�����3�˼��ͬ��ƴ��������������û��ź󽫸���ʵ�ʷ�����������˻ء�'>����
                                </td>
                                <td id="diffPrice"><?=$diffPrice?></td>
                                <td class="fangcha"><?if($taocan['travellerName']=='TRAV_NUM_ONE'||$taocan['travellerName']=='TRAV_NUM_NO'){?>
                                <select id='diffPriceNum' onchange='get_price()'>
                                <?foreach ($fangcha as $val) {?>
                                <?if($val==$roomCount){?>
                                <option value='<?=$val?>' selected="selected"><?=$val?></option>
                                <?}else{?>
                                <option value='<?=$val?>'><?=$val?></option>
                                <?}?>
                                <?}?>
                                </select>
                                <?}else{?>
                                <span id="diffPriceNum"><?=$roomCount?></span>
                                <?}?>
                                </td>
                            </tr>
                            </thead>
                        </table>
                        
                    </div>
                </div>
            </div>
            <script type="text/javascript">

            $(document).ready(function(){
                                var adds = $('.add');
                for (var i = 0; i < adds.length; i++) {
                    adds[i].index = i;
                    adds[i].onclick = function(){
                        var count1 = $('.counts').eq(this.index).html();
                        if(count1<<?=$taocan['max']?>){
                            count1++;
                        }
                        $('.counts').eq(this.index).html(count1);
                        $('.Num').eq(this.index).val(count1);
                        var adultNum = $('#adultNum').html();//������
                        var adultPrice = $('#adultPrice').html();//���˼�
                        var roomMax = <?=$roomMax?>;//��������������ס����
                        var goodsType = <?=$_GET['goodsType']?>;//��ǰ��Ʒ��ҵ������(�����С�������)
                        var isPackage = <?=$is_package?>;
                        var diffPrice = <?=$taocan['diffPrice']?>;//�����
                        var kidNum = $('#kidNum').html();//��ͯ��
                        var kidPrice = $('#kidPrice').html();//��ͯ��
                         $.ajax({
                            type: "POST",
                            url: "<?=$g_self_domain?>/fangcha/",
                            data: {
                                "adultNum": adultNum,
                                "roomMax": roomMax,
                                "goodsType": goodsType,
                                "isPackage": isPackage,
                                "diffPrice": diffPrice
                            },
                            async: false, 
                            success: function (data) {
                                 $('.fangcha').html("");
                                $('.fangcha').html(data);
                                var diffPriceNum = $('#diffPriceNum').val();
                                var zongjia = adultPrice*adultNum + kidPrice*kidNum +diffPrice*diffPriceNum ;
                                $("#orderPrice").html(zongjia);
                            }
                        });
                    }
                }
                var subtracts = $('.subtract');
                for (var i = 0; i < subtracts.length; i++) {
                    subtracts[i].index = i;
                    subtracts[i].onclick = function(){
                        var count1 = $('.counts').eq(this.index).html();
                        if(count1!=0){
                            count1--;
                            $('.counts').eq(this.index).html(count1);
                            $('.Num').eq(this.index).val(count1);
                        var adultNum = $('#adultNum').html();//������
                        var adultPrice = $('#adultPrice').html();//���˼�
                        var roomMax = <?=$roomMax?>;//��������������ס����
                        var goodsType = <?=$_GET['goodsType']?>;//��ǰ��Ʒ��ҵ������(�����С�������)
                        var isPackage = <?=$is_package?>;
                        var diffPrice = <?=$taocan['diffPrice']?>;//�����
                        var kidNum = $('#kidNum').html();//��ͯ��
                        var kidPrice = $('#kidPrice').html();//��ͯ��
                         $.ajax({
                            type: "POST",
                            url: "<?=$g_self_domain?>/fangcha/",
                            data: {
                                "adultNum": adultNum,
                                "roomMax": roomMax,
                                "goodsType": goodsType,
                                "isPackage": isPackage,
                                "diffPrice": diffPrice
                            },
                            async: true,
                            success: function (data) {
                                 $('.fangcha').html("");
                                $('.fangcha').html(data);
                                $('.fangcha').show();
                                var diffPriceNum = $('#diffPriceNum').val();
                                
                                var zongjia = adultPrice*adultNum + kidPrice*kidNum +diffPrice*diffPriceNum ;
                                $("#orderPrice").html(zongjia);
                            }
                        });
                        }
                    };
                }


            });
               
            function get_price() {

                var adultPrice = $('#adultPrice').html();//���˼�
                var diffPrice = <?=$taocan['diffPrice']?>;//�����
                var kidNum = $('#kidNum').html();//��ͯ��
                var kidPrice = $('#kidPrice').html();//��ͯ��
                var diffPriceNum = $('#diffPriceNum').val();
                var adultNum = $('#adultNum').html();//������
                zongjia = adultPrice * adultNum + kidPrice * kidNum + diffPrice * diffPriceNum;
                $("#orderPrice").html(zongjia);
            }
           </script>
            <?}else{?>

            <div class="zbyOrder_main11">
                <div class="zbyOrder_main1_title" title='<?=$taocan['goodsName']?>'>
                    <?=jiequ(52,$taocan['goodsName'])?>
                </div>
                <div class="zbyOrder_main1Cont">
                    <div class="zbyOrder_main1ContLeft">�ܱ���</div>
                    <div class="zbyOrder_main1ContRight">
                        <table>
                            <thead>
                            <tr>
                                <td>��Ʒ��Ϣ</td>
                                <td>��������</td>
                                <td>����</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td  onclick="changeTR()" style="cursor:pointer;" onselectstart="return false"><?=$taocan['packageName']?>&nbsp;&nbsp;<span id="change" class="subtriangle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                                <td><?=$tc['departDate']?>
                                <td>
                                <?if($taocan['travellerName']=='TRAV_NUM_ONE'||$taocan['travellerName']=='TRAV_NUM_NO'){?>
                                <span class="caculate" onselectstart="return false">
                                    <span class="subtract">-</span>
                                    <span class="counts" id='packageNum'><?=$packageNum?></span>
                                    <span class="add">+</span>
                                </span>
                                <?}else{?>
                                <span id='packageNum'><?=$packageNum?></span> 
                                <?}?>
                                    
                                </td>
                            </tr>
                            </tbody>
                            <!-- <tr id="sample"  style="display:none"  >  
                                  <td align="left">  
                                      ����:..... 
                                  </td>  
                              </tr> -->  
                        </table>
                        <div class="spotTicket_infoHide" id="sample"  style="display:none;width:1402px;">����:..... </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
            $(document).ready(function(){

                var adds = $('.add');
                for (var i = 0; i < adds.length; i++) {
                    adds[i].index = i;
                    adds[i].onclick = function(){
                        var count1 = $('.counts').eq(this.index).html();
                        count1++;
                        $('.counts').eq(this.index).html(count1);
                        $('.Num').eq(this.index).val(count1);
                        var packageNum = $('#packageNum').html();
                        var onePrice = <?=$onePrice?>;
                        var zongjia = packageNum*onePrice;
                        $("#orderPrice").html(zongjia);
                    };
                }
                var subtracts = $('.subtract');
                for (var i = 0; i < subtracts.length; i++) {
                    subtracts[i].index = i;
                    subtracts[i].onclick = function(){
                        var count1 = $('.counts').eq(this.index).html();
                        if(count1!=0){
                            count1--;
                            $('.counts').eq(this.index).html(count1);
                            $('.Num').eq(this.index).val(count1);
                            var packageNum = $('#packageNum').html();
                            var onePrice = <?=$onePrice?>;
                            var zongjia = packageNum*onePrice;
                            $("#orderPrice").html(zongjia);
                        }
                    };
                }


            });

            
                function changeTR()  
                {  
                    var tr1 = document.getElementById("sample");  
                  
                    if (tr1.style.display == 'none')  
                    {  
                        tr1.style.display = 'block';
                        document.getElementById("change").className = "subtriangle uptriangle";  
                    }  
                    else  
                    {  
                        tr1.style.display = 'none';
                        document.getElementById("change").className = "subtriangle";  
                    }  
                }  
            </script>
            <? } ?>
            <div class="zbyOrder_main2">
                <div class="zbyOrder_main2_title">��ϵ����Ϣ</div>

                <div class="zbyOrder_main2_buy">
                    <div class="zbyOrder_main2_buyLeft">��ϵ��</div>
                    <div class="zbyOrder_main2_buyRight">
                        <ul>
                            <?if($taocan['bookerName']=='true'){?>
                            <li>
                                <label><b>��</b>������</label>
                                <input type="text" name="bookerName" id="linker" value="">
                                <span class="buyer_nameTips">��������������Ϊ�գ�</span>
                            </li>
                            <?}?>
                            <?if($taocan['bookerMobile']=='true'){?>
                            <li>
                                <label><b>��</b>�ֻ����룺</label>
                                <input type="text" name="bookerMobile" id="mobile" value="">
                                <span>���ֻ�Ϊ���ܶ������ã���Ϊ������ȡƱƾ֤����׼ȷ��д��</span>
                                <span class="buyer_phoneTips">�������ֻ��Ų���Ϊ�գ�</span>
                            </li>
                            <?}?>
                            <?if($taocan['bookerEmail']=='true'){?>
                            <li>
                                <label><b>��</b>���䣺</label>
                                <input type="text" name="bookerEmail" id="email" value="">
                                <span class="buyer_emailTips"></span>
                            </li>
                            <?}?>
                        </ul>
                    </div>
                </div>
                <!-- �����Ҫ��д������ -->
                <?if($num > 0){ ?>
                <? for($i=0;$i<$num;$i++){ ?>
                <div class="zbyOrder_main2_youwan">
                    <div class="zbyOrder_main2_youwanLeft">������<?=$i+1?></div>
                    <div class="zbyOrder_main2_youwanRight">
                        <ul>
                            <?if($taocan['travellerName']=='TRAV_NUM_ALL'){?>
                            <li>
                                <label><b>��</b>������</label>
                                <input type="text" name="name_<?=$i?>" autocomplete="off" id="youwan_userName_<?=$i?>">
                                <span class="youwan_nameTips_<?=$i?>"></span>
                            </li>
                            <script type="text/javascript">
                            $('#youwan_userName_<?=$i?>').blur(function(){
                                if($('#youwan_userName_<?=$i?>').val()==''){
                                    $('.youwan_nameTips_<?=$i?>').show().html('��������������Ϊ��').css('color','red');
                                    youwanName_flag_<?=$i?>=0;
                                }else{
                                    $('.youwan_nameTips_<?=$i?>').hide();
                                    youwanName_flag_<?=$i?>=1;
                                }
                            });
                            </script>
                            <?}elseif($taocan['travellerName']=='TRAV_NUM_ONE' && $i=='0'){?>
                            <li>
                                <label><b>��</b>������</label>
                                <input type="text" name="name_<?=$i?>" autocomplete="off" id="youwan_userName_<?=$i?>">
                                <span class="youwan_nameTips_<?=$i?>"></span>
                            </li>
                            <script type="text/javascript">
                            $('#youwan_userName_<?=$i?>').blur(function(){
                                if($('#youwan_userName_<?=$i?>').val()==''){
                                    $('.youwan_nameTips_<?=$i?>').show().html('��������������Ϊ��').css('color','red');
                                    youwanName_flag_<?=$i?>=0;
                                }else{
                                    $('.youwan_nameTips_<?=$i?>').hide();
                                    youwanName_flag_<?=$i?>=1;
                                }
                            });
                            </script>
                            <?}?>
                            <?if($taocan['travellerMobile']=='TRAV_NUM_ALL'){?>
                            <li>
                                <label><b>��</b>�ֻ����룺</label>
                                <input type="text" name="mobile_<?=$i?>" autocomplete="off" id="youwan_userPhone_<?=$i?>">
                                <span class="youwan_phoneTips_<?=$i?>"></span>
                            </li>
                            <script type="text/javascript">
                            $('#youwan_userPhone_<?=$i?>').blur(function(){
                                if($('#youwan_userPhone_<?=$i?>').val()==''){
                                    $('.youwan_phoneTips_<?=$i?>').show().html('�������ֻ��Ų���Ϊ��').css('color','red');
                                }else if(reg2.test($('#youwan_userPhone_<?=$i?>').val())){
                                    $('.youwan_phoneTips_<?=$i?>').show();
                                    $('.youwan_phoneTips_<?=$i?>').html('');
                                    youwanPhone_flag_<?=$i?>=1;
                                }else if(!reg2.test($('#youwan_userPhone_<?=$i?>').val())){
                                    $('.youwan_phoneTips_<?=$i?>').show();
                                    $('.youwan_phoneTips_<?=$i?>').html('��������ȷ���ֻ��ţ�').css('color','red');
                                    youwanPhone_flag_<?=$i?>=0;
                                }
                            });
                            </script>
                            <?}elseif($taocan['travellerMobile']=='TRAV_NUM_ONE' && $i=='0'){?>
                            <li>
                                <label><b>��</b>�ֻ����룺</label>
                                <input type="text" name="mobile_<?=$i?>" autocomplete="off" id="youwan_userPhone_<?=$i?>">
                                <span class="youwan_phoneTips_<?=$i?>"></span>
                            </li>
                            <script type="text/javascript">
                            $('#youwan_userPhone_<?=$i?>').blur(function(){
                                if($('#youwan_userPhone_<?=$i?>').val()==''){
                                    $('.youwan_phoneTips_<?=$i?>').show().html('�������ֻ��Ų���Ϊ��').css('color','red');
                                }else if(reg2.test($('#youwan_userPhone_<?=$i?>').val())){
                                    $('.youwan_phoneTips_<?=$i?>').show();
                                    $('.youwan_phoneTips_<?=$i?>').html('');
                                    youwanPhone_flag_<?=$i?>=1;
                                }else if(!reg2.test($('#youwan_userPhone_<?=$i?>').val())){
                                    $('.youwan_phoneTips_<?=$i?>').show();
                                    $('.youwan_phoneTips_<?=$i?>').html('��������ȷ���ֻ��ţ�').css('color','red');
                                    youwanPhone_flag_<?=$i?>=0;
                                }
                            });
                            </script>
                            <?}?>
                            <?if($taocan['travellerEmail']=='TRAV_NUM_ALL'){?>
                            <li>
                                <label><b>��</b>���䣺</label>
                                <input type="text" name="email_<?=$i?>" id="youwan_email_<?=$i?>" value="">
                                <span class="youwan_emailTips_<?=$i?>"></span>
                            </li>
                            <script type="text/javascript">
                            //����
                            $('#youwan_email_<?=$i?>').blur(function(){
                                if($('#youwan_email_<?=$i?>').val()==''){
                                    $('.youwan_emailTips_<?=$i?>').show().html('���������䲻��Ϊ��').css('color','red');
                                }else if(reg4.test($('#youwan_email_<?=$i?>').val())){
                                    $('.youwan_emailTips_<?=$i?>').show();
                                    $('.youwan_emailTips_<?=$i?>').html('');
                                    youwanEmail_flag_<?=$i?>=1;
                                }else if(!reg4.test($('#youwan_email_<?=$i?>').val())){
                                    $('.youwan_emailTips_<?=$i?>').show();
                                    $('.youwan_emailTips_<?=$i?>').html('��������ȷ�����䣡').css('color','red');
                                    youwanEmail_flag_<?=$i?>=0;
                                }
                            });
                            </script>
                            <?}elseif($taocan['travellerEmail']=='TRAV_NUM_ONE' && $i=='0'){?>
                            <li>
                                <label><b>��</b>���䣺</label>
                                <input type="text" name="email_<?=$i?>" id="youwan_email_<?=$i?>" value="">
                                <span class="youwan_emailTips_<?=$i?>"></span>
                            </li>
                            <script type="text/javascript">
                            //����
                            $('#youwan_email_<?=$i?>').blur(function(){
                                if($('#youwan_email_<?=$i?>').val()==''){
                                    $('.youwan_emailTips_<?=$i?>').show().html('���������䲻��Ϊ��').css('color','red');
                                }else if(reg4.test($('#youwan_email_<?=$i?>').val())){
                                    $('.youwan_emailTips_<?=$i?>').show();
                                    $('.youwan_emailTips_<?=$i?>').html('');
                                    youwanEmail_flag_<?=$i?>=1;
                                }else if(!reg4.test($('#youwan_email_<?=$i?>').val())){
                                    $('.youwan_emailTips_<?=$i?>').show();
                                    $('.youwan_emailTips_<?=$i?>').html('��������ȷ�����䣡').css('color','red');
                                    youwanEmail_flag_<?=$i?>=0;
                                }
                            });
                            </script>
                            <?}?>
                            <?if($taocan['travellerEnName']=='TRAV_NUM_ALL'){?>
                            <li>
                                <label><b>��</b>Ӣ����</label>
                                <input type="text" name="eName_<?=$i?>" autocomplete="off" id="youwan_eName_<?=$i?>">
                                <span class="youwan_eNameTips_<?=$i?>"></span>
                            </li>
                            <script type="text/javascript">
                            $('#youwan_eName_<?=$i?>').blur(function(){
                                if($('#youwan_eName_<?=$i?>').val()==''){
                                    $('.youwan_eNameTips_<?=$i?>').show().html('������Ӣ��������Ϊ��').css('color','red');
                                }else if(reg5.test($('#youwan_eName_<?=$i?>').val())){
                                    $('.youwan_eNameTips_<?=$i?>').show();
                                    $('.youwan_eNameTips_<?=$i?>').html('');
                                    youwaneName_flag_<?=$i?>=1;
                                }else if(!reg5.test($('#youwan_eName_<?=$i?>').val())){
                                    $('.youwan_eNameTips_<?=$i?>').show();
                                    $('.youwan_eNameTips_<?=$i?>').html('��������ȷ��Ӣ������').css('color','red');
                                    youwaneName_flag_<?=$i?>=0;
                                }
                            });
                            </script>
                            <?}elseif($taocan['travellerEnName']=='TRAV_NUM_ONE' && $i=='0'){?>
                            <li>
                                <label><b>��</b>Ӣ����</label>
                                <input type="text" name="eName_<?=$i?>" autocomplete="off" id="youwan_eName_<?=$i?>">
                                <span class="youwan_eNameTips_<?=$i?>"></span>
                            </li>
                            <script type="text/javascript">
                            $('#youwan_eName_<?=$i?>').blur(function(){
                                if($('#youwan_eName_<?=$i?>').val()==''){
                                    $('.youwan_eNameTips_<?=$i?>').show().html('������Ӣ��������Ϊ��').css('color','red');
                                }else if(reg5.test($('#youwan_eName_<?=$i?>').val())){
                                    $('.youwan_eNameTips_<?=$i?>').show();
                                    $('.youwan_eNameTips_<?=$i?>').html('');
                                    youwaneName_flag_<?=$i?>=1;
                                }else if(!reg5.test($('#youwan_eName_<?=$i?>').val())){
                                    $('.youwan_eNameTips_<?=$i?>').show();
                                    $('.youwan_eNameTips_<?=$i?>').html('��������ȷ��Ӣ������').css('color','red');
                                    youwaneName_flag_<?=$i?>=0;
                                }
                            });
                            </script>
                            <?}?>
                            
                            <li><?if($taocan['travellerPersonType']=='TRAV_NUM_ALL'){?>
                                    <label><b>��</b>��Ⱥ��</label>
                                    <select name="personType_<?=$i?>">
                                        <option value="adult">����</option>
                                        <option value="child">��ͯ</option> 
                                    </select>
                                    <?}elseif($taocan['travellerPersonType']=='TRAV_NUM_ONE' && $i=='0'){?>
                                    <label><b>��</b>��Ⱥ��</label>
                                    <select name="personType_<?=$i?>">
                                        <option value="adult">����</option>
                                        <option value="child">��ͯ</option>
                                    </select>
                                    <?}?>
                                <?if($taocan['travellerGender']=='TRAV_NUM_ALL' || $taocan['travellerCredentials']=='TRAV_NUM_ALL'){?>    
                                    <label><b>��</b>�Ա�</label>
                                    <select name="gender_<?=$i?>">
                                        <option value="male">��</option>
                                        <option value="chifemaleld">Ů</option>
                                    </select>
                                <?}elseif(($taocan['travellerGender']=='TRAV_NUM_ONE' && $i=='0')||$taocan['travellerCredentials']=='TRAV_NUM_ONE'){?>
                                    <label><b>��</b>�Ա�</label>
                                    <select name="gender_<?=$i?>">
                                        <option value="male">��</option>
                                        <option value="chifemaleld">Ů</option>
                                    </select>
                                <?}?>

                            </li>
                            <?if($taocan['travellerCredentials']=='TRAV_NUM_ALL'){?>
                            <li>
                                <label><b>��</b>֤�����ͣ�</label>
                                <select style="width: 138px;">
                                    <option>���֤</option>
                                </select>
                                <input type="text" name="credentials_<?=$i?>" autocomplete="off"  id="youwan_userIdcard_<?=$i?>">
                                <span class="youwan_idTips_<?=$i?>"></span>
                            </li>
                            <script type="text/javascript">
                            $('#youwan_userIdcard_<?=$i?>').blur(function(){
                                if($('#youwan_userIdcard_<?=$i?>').val()==''){
                                    $('.youwan_idTips_<?=$i?>').show().html('������֤���Ų���Ϊ��').css('color','red');
                                }else if(reg3.test($('#youwan_userIdcard_<?=$i?>').val())){
                                    $('.youwan_idTips_<?=$i?>').show();
                                    $('.youwan_idTips_<?=$i?>').html('');
                                    youwanIdNum_flag_<?=$i?>=1;
                                }else if(!reg3.test($('#youwan_userIdcard_<?=$i?>').val())){
                                    $('.youwan_idTips_<?=$i?>').show();
                                    $('.youwan_idTips_<?=$i?>').html('��������ȷ��֤���ţ�').css('color','red');
                                    youwanIdNum_flag_<?=$i?>=0;
                                }
                            });
                            </script>
                            <?}elseif($taocan['travellerCredentials']=='TRAV_NUM_ONE' && $i=='0'){?>
                            <li>
                                <label><b>��</b>֤�����ͣ�</label>
                                <select style="width: 138px;">
                                    <option>���֤</option>
                                </select>
                                <input type="text" name="credentials_<?=$i?>" autocomplete="off"  id="youwan_userIdcard_<?=$i?>">
                                <span class="youwan_idTips_<?=$i?>"></span>
                            </li>
                            <script type="text/javascript">
                            $('#youwan_userIdcard_<?=$i?>').blur(function(){
                                if($('#youwan_userIdcard_<?=$i?>').val()==''){
                                    $('.youwan_idTips_<?=$i?>').show().html('������֤���Ų���Ϊ��').css('color','red');
                                }else if(reg3.test($('#youwan_userIdcard_<?=$i?>').val())){
                                    $('.youwan_idTips_<?=$i?>').show();
                                    $('.youwan_idTips_<?=$i?>').html('');
                                    youwanIdNum_flag_<?=$i?>=1;
                                }else if(!reg3.test($('#youwan_userIdcard_<?=$i?>').val())){
                                    $('.youwan_idTips_<?=$i?>').show();
                                    $('.youwan_idTips_<?=$i?>').html('��������ȷ��֤���ţ�').css('color','red');
                                    youwanIdNum_flag_<?=$i?>=0;
                                }
                            });
                            </script>
                            <?}?>
                            <?if($taocan['travellerBirthday']=='TRAV_NUM_ALL' || $taocan['travellerCredentials']=='TRAV_NUM_ALL'){?>
                            <li>
                                <label><b>��</b>����</label>
                                <input type="date" name="birthday_<?=$i?>" autocomplete="off" id="youwan_birthday_<?=$i?>"  min="1900-09-16" max="<?echo date("Y-m-d",time());?>"><span class="youwan_birthday_<?=$i?>"></span>
                            </li>
                            <script type="text/javascript">
                            $('#youwan_birthday_<?=$i?>').blur(function(){
                                if($('#youwan_birthday_<?=$i?>').val()==''){
                                    $('.youwan_birthday_<?=$i?>').show().html('���ղ���Ϊ��').css('color','red');
                                }
                            });
                            </script>
                            <?}elseif(($taocan['travellerBirthday']=='TRAV_NUM_ONE' && $i=='0')||$taocan['travellerCredentials']=='TRAV_NUM_ONE'){?>
                            <li>
                                <label><b>��</b>����</label>
                                <input type="date" name="birthday_<?=$i?>" autocomplete="off" id="youwan_birthday_<?=$i?>"  min="1900-09-16" max="<?echo date("Y-m-d",time());?>"><span class="youwan_idTips_<?=$i?>"></span>
                            </li>
                            <script type="text/javascript">
                            $('#youwan_birthday_<?=$i?>').blur(function(){
                                if($('#youwan_birthday_<?=$i?>').val()==''){
                                    $('.youwan_birthday_<?=$i?>').show().html('���ղ���Ϊ��').css('color','red');
                                }
                            });
                            </script>
                            <?}?>
                        </ul>
                    </div>
                </div>
                <?}?>
                <?}?>
                <!-- �����˽��� -->
                <?if($taocan['emergency'] == 'true'){?>
                <div class="zbyOrder_main2_youwan">
                    <div class="zbyOrder_main2_youwanLeft">������ϵ��</div>
                    <div class="zbyOrder_main2_youwanRight">
                        <ul>
                           <li>
                               <label><b>��</b>������</label>
                                <input type="text" name="emergencyName" autocomplete="off">
                            </li>
                            <li>
                                <label><b>��</b>�ֻ����룺</label>
                                <input type="text" name="emergencyMobile" autocomplete="off">
                                <span></span>
                            </li>
                            
                        </ul>
                    </div>
                </div>
                <?}?>
            </div>
        <input type="hidden" id="payPricei" name="payPrice" value="">
        <input type="hidden" id="adultNumi" name="adultNum" value="">
        <input type="hidden" id="childNumi" name="childNum" value="">
        <input type="hidden" id="roomCounti" name="roomCount" value="">
        <input type="hidden" id="packageNumi" name="packageNum" value="">

        </form>
            <div class="zbyOrder_main3">
                <div class="zbyOrder_main31">
                    <div class="zbyOrder_main31_left">Ӧ���ܼۣ���<span id="orderPrice"><?=$payPrice1?></span></div>
                    
                    <button class="zbyOrder_main31_right" onclick = "check_form()">ͬ���������ȥ����</button>

                </div>
                <div class="zbyOrder_main32">
                    <label><a href="<?=$g_self_domain?>/zhoubian/xy.html" target="_blank">����ͬ����������</a></label>
                    <input type="checkbox" name="����ͬ����������">
                    <!-- <label>ͬ���ŶӾ������κ�ͬ</label>
                    <input type="checkbox" name="ͬ���ŶӾ������κ�ͬ"> -->
                </div>
                <div class="zbyOrder_main33">
                    ��ܰ��ʾ��������ϸ�Ķ�Ԥ����֪�����κ�ͬ��������ύ����Ϊ��ͬ�����¸�����������
                </div>
            </div>
    </div>
</div>
<!-- </form> -->
<!-- main end -->

	<!--  foot  start -->
    <?include 'foot.php';?>
</body>
<script type="text/javascript" src="/themes/s01/js/jquery.js"></script>
<script type="text/javascript" src="/themes/s01/js/common.js"></script>
<script type="text/javascript">


//���Ϸ�����֤
var reg1 = /^([\u4e00-\u9fa5]){2,6}$/;//ƥ������
var reg2 = /^1[34578]\d{9}$/;//ƥ���ֻ���
var reg3 = /(^\d{15}$)|(^\d{17}(\d|X)$)/;//ƥ�����֤
var reg4 = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;//ƥ������
var reg5 = /^[A-Za-z]+$/;//Ӣ����
var buyerName_flag=0,
    buyerPhone_flag=0,
    buyerEmail_flag=0,
    // phoneNum_flag=0,
    // idNum_flag=0,
    // email_flag=0,
    // tiaokuan_flag=1
    youwanName_flag=0,
    youwanPhone_flag=0,
    youwaneName_flag=0,
    youwanIdNum_flag=0,
    buyerEmail_flag=0
    ;
//����
$('#email').blur(function(){
    if($('#email').val()==''){
        $('.buyer_emailTips').show().html('��ϵ�����䲻��Ϊ��').css('color','red');
    }else if(reg4.test($('#email').val())){
        $('.buyer_emailTips').show();
        $('.buyer_emailTips').html('');
        buyerEmail_flag=1;
    }else if(!reg4.test($('#email').val())){
        $('.buyer_emailTips').show();
        $('.buyer_emailTips').html('��������ȷ�����䣡').css('color','red');
        buyerEmail_flag=0;
    }
});

$('#linker').blur(function(){
    if($('#linker').val()==''){
        $('.buyer_nameTips').show();
        buyerName_flag=0;
    }else{
        $('.buyer_nameTips').hide();
        buyerName_flag=1;
    }
});
$('#mobile').blur(function(){
    if($('#mobile').val()==''){
        $('.buyer_phoneTips').show().html('��ϵ���ֻ��Ų���Ϊ��').css('color','red');
    }else if(reg2.test($('#mobile').val())){
        $('.buyer_phoneTips').show();
        $('.buyer_phoneTips').html('');
        buyerPhone_flag=1;
    }else if(!reg2.test($('#mobile').val())){
        $('.buyer_phoneTips').show();
        $('.buyer_phoneTips').html('��������ȷ���ֻ��ţ�').css('color','red');
        buyerPhone_flag=0;
    }
});



function check_form(){
    if($('.zbyOrder_main32 input').eq(0).attr('checked')){
        var kidNum = $('#kidNum').html();//��ͯ��
        
        var adultNum = $('#adultNum').html();//������
        var zongjia = $('#orderPrice').html();
        var packageNum = $('#packageNum').html();
        $('#payPricei').val(zongjia);
        $('#adultNumi').val(adultNum);
        $('#childNumi').val(kidNum);
        <?if($taocan['travellerName']=='TRAV_NUM_ONE'||$taocan['travellerName']=='TRAV_NUM_NO'){?>
        var diffPriceNum = $('#diffPriceNum').val();
        $('#roomCounti').val(diffPriceNum);
        <?}else{?>
        var diffPriceNum = $('#diffPriceNum').html();
        $('#roomCounti').val(diffPriceNum);
        <?}?>
        $('#packageNumi').val(packageNum);
        if(kidNum==0 && adultNum==0){
            alert('������������Ϊ0');
        }else{
           document.getElementById("write_form").submit(); 
        }
        
    }else{
        alert('�����Ķ���������');
    }

}
//��̬����

</script>
<?
if($dingdan['status'] == '1000'){
        $dingdan['msg'] = '\''.$dingdan['msg'].'\'';
        echo '<script>alert('.$dingdan['msg'].')</script>';
     }
?>
</html>