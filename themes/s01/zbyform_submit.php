<?
if(!defined('IN_CLOOTA')) {
    exit('Access Denied');
}
 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="gbk">
<link rel="shortcut icon" type="image/png" href="http://www.bus365.com/public/images/bus365.png"> 
<link rel="stylesheet" type="text/css" href="/themes/s01/images/tianxie.css">
<script type="text/javascript" src="/themes/s01/js/menpiaoliebiao.js"></script>
<link rel="stylesheet" type="text/css" href="/themes/s01/images/common.css">
<link rel="stylesheet" type="text/css" href="/themes/s01/images/menpiaoliebiao.css">
<link rel="stylesheet" type="text/css" href="/themes/s01/images/list.css">
<script type="text/javascript" src="/themes/s01/js/jquery.js "></script>
<script type="text/javascript" src="/themes/s01/js/common.js"></script>
<script type="text/javascript" src="/themes/s01/js/date.js"></script>

<title>周边游订单</title>
</head>
<body><?if (notnull($orderCode)){ ?>
    <form action="<?=$g_self_domain?>/zhoubianyou/zbyonline_pay-1.html" method="post" id="onlineForm">
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
        <form name="write_form" id="write_form" method="post" action="<?=$g_self_domain?>/zhoubianyou/zbyform_submit-2-check.html?<?=$url_form?>">
        <? if($is_package == 'false'){ ?>
            <div class="zbyOrder_main1">
            <br>游玩时间：<?=$tc['departDate']?>
                <div class="zbyOrder_main1_title" title='<?=$taocan['goodsName']?>'>
                    <?=jiequ(52,$taocan['goodsName'])?>
                </div>
                <div class="zbyOrder_main1Cont">
                    <div class="zbyOrder_main1ContLeft">周边游</div>
                    <div class="zbyOrder_main1ContRight">
                        <table>
                            <thead>
                            <tr>
                                <td>产品信息</td>
                                <td>单价</td>
                                <td>人数</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>成人</td>
                                <td id="adultPrice">
                                    <?=$taocan['adultPrice']?>
                                </td>
                                <td><?if($jiahao==1){?>
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
                                <td>儿童</td>
                                <td id="kidPrice">
                                    <?=$taocan['kidPrice']?>
                                </td>
                                <td><?if($jiahao==1){?>
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
                                <td title='因旅游过程中的住宿安排是两个床位的标准间，团费中是根据1名成人占1张床计算的。如出游人数（成人）为单数时，需要补足另外一个人床位的费用。如在实际旅游过程中能够安排3人间或同性拼房，所付房差费用回团后将根据实际发生情况减免退回。'>房差
                                </td>
                                <td id="diffPrice"><?=$diffPrice?></td>
                                <td class="fangcha"><?if($jiahao==1){?>
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
                        var adultNum = $('#adultNum').html();
                        var kidNum = $('#kidNum').html();
                        var zongshu = Number(adultNum) + Number(kidNum);
                        if(zongshu<<?=$taocan['max']?>){
                            count1++;
                        }else{
                            alert('亲,您已超过最大订购数量:<?=$taocan['max']?>');
                        }
                         $('.counts').eq(this.index).html(count1);
                        $('.Num').eq(this.index).val(count1);
                        adultNum = $('#adultNum').html();
                        kidNum = $('#kidNum').html();
                        var adultPrice = $('#adultPrice').html();//成人价
                        var roomMax = <?=$roomMax?>;//房间的最大允许入住数量
                        var goodsType = <?=$goodsType?>;//当前产品的业务类型(自由行、跟团游)
                        var isPackage = <?=$is_package?>;
                        var diffPrice = <?=$taocan['diffPrice']?>;//房差价
                        
                        var kidPrice = $('#kidPrice').html();//儿童价
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
                        var adultNum = $('#adultNum').html();//成人数
                        var adultPrice = $('#adultPrice').html();//成人价
                        var roomMax = <?=$roomMax?>;//房间的最大允许入住数量
                        var goodsType = <?=$goodsType?>;//当前产品的业务类型(自由行、跟团游)
                        var isPackage = <?=$is_package?>;
                        var diffPrice = <?=$taocan['diffPrice']?>;//房差价
                        var kidNum = $('#kidNum').html();//儿童数
                        var kidPrice = $('#kidPrice').html();//儿童价
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

                var adultPrice = $('#adultPrice').html();//成人价
                var diffPrice = <?=$taocan['diffPrice']?>;//房差价
                var kidNum = $('#kidNum').html();//儿童数
                var kidPrice = $('#kidPrice').html();//儿童价
                var diffPriceNum = $('#diffPriceNum').val();
                var adultNum = $('#adultNum').html();//成人数
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
                    <div class="zbyOrder_main1ContLeft">周边游</div>
                    <div class="zbyOrder_main1ContRight">
                        <table>
                            <thead>
                            <tr>
                                <td>产品信息</td>
                                <td>出游日期</td>
                                <td>份数</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td style="cursor:pointer;" onselectstart="return false"><?=$taocan['packageName']?>&nbsp;&nbsp;</td>
                                <td><?=$tc['departDate']?>
                                <td>
                                <?if($jiahao==1){?>
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
                        var packageNum = $('#packageNum').html();
                        if(packageNum==''){
                            packageNum = $('#packageNum').val();
                        }
                        var adultNum = Number(packageNum)*<?=$taocan['adultNum']?>;
                        if(adultNum><?=$taocan['max']?>){
                            alert('亲,您已超过最大订购数量:'+ packageNum);
                        }else{
                           count1++; 
                        }
                        
                        $('.counts').eq(this.index).html(count1);
                        $('.Num').eq(this.index).val(count1);
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
                        if(count1!=1){
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

             
            </script>
            <? } ?>
            <div class="zbyOrder_main2">
                <div class="zbyOrder_main2_title">联系人信息</div>

                <div class="zbyOrder_main2_buy">
                    <div class="zbyOrder_main2_buyLeft">联系人</div>
                    <div class="zbyOrder_main2_buyRight">
                        <ul>
                            <?if($taocan['bookerName']=='true'){?>
                            <li>
                                <label><b>＊</b>姓名：</label>
                                <input type="text" class="saveHistory" name="bookerName" id="linker" value="<?php if(isset($_POST['bookerName'])){echo $_POST['bookerName'];}?>">
                                <span class="buyer_nameTips">联系人姓名不能为空！</span>
                            </li>
                            <?}?>
                            <?if($taocan['bookerMobile']=='true'){?>
                            <li>
                                <label><b>＊</b>手机号码：</label>
                                <input type="text" name="bookerMobile" class="saveHistory" id="mobile" value="<?php if(isset($_POST['bookerMobile'])){echo $_POST['bookerMobile'];}?>">
                                <span>此手机用于接收订购与取票凭证的短信，请准确填写。</span>
                                <span class="buyer_phoneTips">联系人手机号不能为空！</span>
                            </li>
                            <?}?>
                            <?if($taocan['bookerEmail']=='true'){?>
                            <li>
                                <label><b>＊</b>邮箱：</label>
                                <input type="text" name="bookerEmail" id="email" value="<?php if(isset($_POST['bookerEmail'])){echo $_POST['bookerEmail'];}?>">
                                <span class="buyer_emailTips"></span>
                            </li>
                            <?}?>
                        </ul>
                    </div>
                </div>
                <!-- 如果需要填写游玩人 -->
                <?if($num > 0){ ?>
                <? for($i=0;$i<$num;$i++){ ?>
                <div class="zbyOrder_main2_youwan">
                    <div class="zbyOrder_main2_youwanLeft">游玩人<?=$i+1?></div>
                    <div class="zbyOrder_main2_youwanRight">
                        <ul>
                            <?if($taocan['travellerName']=='TRAV_NUM_ALL'){?>
                            <li>
                                <label><b>＊</b>姓名：</label>
                                <input type="text" name="name_<?=$i?>" id="youwan_userName_<?=$i?>" value="<?php if(isset($_POST["name_$i"])){echo $_POST["name_$i"];}?>">
                                <span class="youwan_nameTips_<?=$i?>"></span>
                            </li>
                            <script type="text/javascript">
                            $('#youwan_userName_<?=$i?>').blur(function(){
                                if($('#youwan_userName_<?=$i?>').val()==''){
                                    $('.youwan_nameTips_<?=$i?>').show().html('游玩人姓名不能为空').css('color','red');
                                    youwanName_flag_<?=$i?>=0;
                                }else{
                                    $('.youwan_nameTips_<?=$i?>').hide();
                                    youwanName_flag_<?=$i?>=1;
                                }
                            });
                            </script>
                            <?}elseif($taocan['travellerName']=='TRAV_NUM_ONE' && $i=='0'){?>
                            <li>
                                <label><b>＊</b>姓名：</label>
                                <input type="text" name="name_<?=$i?>" id="youwan_userName_<?=$i?>" value="<?php if(isset($_POST['name_'.$i])){echo $_POST['name_'.$i];}?>">
                                <span class="youwan_nameTips_<?=$i?>"></span>
                            </li>
                            <script type="text/javascript">
                            $('#youwan_userName_<?=$i?>').blur(function(){
                                if($('#youwan_userName_<?=$i?>').val()==''){
                                    $('.youwan_nameTips_<?=$i?>').show().html('游玩人姓名不能为空').css('color','red');
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
                                <label><b>＊</b>手机号码：</label>
                                <input type="text" name="mobile_<?=$i?>" value="<?php if(isset($_POST['mobile_'.$i])){echo $_POST['mobile_'.$i];}?>" id="youwan_userPhone_<?=$i?>">
                                <span class="youwan_phoneTips_<?=$i?>"></span>
                            </li>
                            <script type="text/javascript">
                            $('#youwan_userPhone_<?=$i?>').blur(function(){
                                if($('#youwan_userPhone_<?=$i?>').val()==''){
                                    $('.youwan_phoneTips_<?=$i?>').show().html('游玩人手机号不能为空').css('color','red');
                                }else if(reg2.test($('#youwan_userPhone_<?=$i?>').val())){
                                    $('.youwan_phoneTips_<?=$i?>').show();
                                    $('.youwan_phoneTips_<?=$i?>').html('');
                                    youwanPhone_flag_<?=$i?>=1;
                                }else if(!reg2.test($('#youwan_userPhone_<?=$i?>').val())){
                                    $('.youwan_phoneTips_<?=$i?>').show();
                                    $('.youwan_phoneTips_<?=$i?>').html('请输入正确的手机号！').css('color','red');
                                    youwanPhone_flag_<?=$i?>=0;
                                }
                            });
                            </script>
                            <?}elseif($taocan['travellerMobile']=='TRAV_NUM_ONE' && $i=='0'){?>
                            <li>
                                <label><b>＊</b>手机号码：</label>
                                <input type="text" name="mobile_<?=$i?>" value="<?php if(isset($_POST['mobile_'.$i])){echo $_POST['mobile_'.$i];}?>" id="youwan_userPhone_<?=$i?>">
                                <span class="youwan_phoneTips_<?=$i?>"></span>
                            </li>
                            <script type="text/javascript">
                            $('#youwan_userPhone_<?=$i?>').blur(function(){
                                if($('#youwan_userPhone_<?=$i?>').val()==''){
                                    $('.youwan_phoneTips_<?=$i?>').show().html('游玩人手机号不能为空').css('color','red');
                                }else if(reg2.test($('#youwan_userPhone_<?=$i?>').val())){
                                    $('.youwan_phoneTips_<?=$i?>').show();
                                    $('.youwan_phoneTips_<?=$i?>').html('');
                                    youwanPhone_flag_<?=$i?>=1;
                                }else if(!reg2.test($('#youwan_userPhone_<?=$i?>').val())){
                                    $('.youwan_phoneTips_<?=$i?>').show();
                                    $('.youwan_phoneTips_<?=$i?>').html('请输入正确的手机号！').css('color','red');
                                    youwanPhone_flag_<?=$i?>=0;
                                }
                            });
                            </script>
                            <?}?>
                            <?if($taocan['travellerEmail']=='TRAV_NUM_ALL'){?>
                            <li>
                                <label><b>＊</b>邮箱：</label>
                                <input type="text" name="email_<?=$i?>" id="youwan_email_<?=$i?>" value="<?php if(isset($_POST['email_'.$i])){echo $_POST['email_'.$i];}?>">
                                <span class="youwan_emailTips_<?=$i?>"></span>
                            </li>
                            <script type="text/javascript">
                            //邮箱
                            $('#youwan_email_<?=$i?>').blur(function(){
                                if($('#youwan_email_<?=$i?>').val()==''){
                                    $('.youwan_emailTips_<?=$i?>').show().html('游玩人邮箱不能为空').css('color','red');
                                }else if(reg4.test($('#youwan_email_<?=$i?>').val())){
                                    $('.youwan_emailTips_<?=$i?>').show();
                                    $('.youwan_emailTips_<?=$i?>').html('');
                                    youwanEmail_flag_<?=$i?>=1;
                                }else if(!reg4.test($('#youwan_email_<?=$i?>').val())){
                                    $('.youwan_emailTips_<?=$i?>').show();
                                    $('.youwan_emailTips_<?=$i?>').html('请输入正确的邮箱！').css('color','red');
                                    youwanEmail_flag_<?=$i?>=0;
                                }
                            });
                            </script>
                            <?}elseif($taocan['travellerEmail']=='TRAV_NUM_ONE' && $i=='0'){?>
                            <li>
                                <label><b>＊</b>邮箱：</label>
                                <input type="text" name="email_<?=$i?>" id="youwan_email_<?=$i?>" value="<?php if(isset($_POST['email_'.$i])){echo $_POST['email_'.$i];}?>">
                                <span class="youwan_emailTips_<?=$i?>"></span>
                            </li>
                            <script type="text/javascript">
                            //邮箱
                            $('#youwan_email_<?=$i?>').blur(function(){
                                if($('#youwan_email_<?=$i?>').val()==''){
                                    $('.youwan_emailTips_<?=$i?>').show().html('游玩人邮箱不能为空').css('color','red');
                                }else if(reg4.test($('#youwan_email_<?=$i?>').val())){
                                    $('.youwan_emailTips_<?=$i?>').show();
                                    $('.youwan_emailTips_<?=$i?>').html('');
                                    youwanEmail_flag_<?=$i?>=1;
                                }else if(!reg4.test($('#youwan_email_<?=$i?>').val())){
                                    $('.youwan_emailTips_<?=$i?>').show();
                                    $('.youwan_emailTips_<?=$i?>').html('请输入正确的邮箱！').css('color','red');
                                    youwanEmail_flag_<?=$i?>=0;
                                }
                            });
                            </script>
                            <?}?>
                            <?if($taocan['travellerEnName']=='TRAV_NUM_ALL'){?>
                            <li>
                                <label><b>＊</b>英文名</label>
                                <input type="text" name="eName_<?=$i?>" id="youwan_eName_<?=$i?>" value="<?php if(isset($_POST['eName_'.$i])){echo $_POST['eName_'.$i];}?>">
                                <span class="youwan_eNameTips_<?=$i?>"></span>
                            </li>
                            <script type="text/javascript">
                            $('#youwan_eName_<?=$i?>').blur(function(){
                                if($('#youwan_eName_<?=$i?>').val()==''){
                                    $('.youwan_eNameTips_<?=$i?>').show().html('游玩人英文名不能为空').css('color','red');
                                }else if(reg5.test($('#youwan_eName_<?=$i?>').val())){
                                    $('.youwan_eNameTips_<?=$i?>').show();
                                    $('.youwan_eNameTips_<?=$i?>').html('');
                                    youwaneName_flag_<?=$i?>=1;
                                }else if(!reg5.test($('#youwan_eName_<?=$i?>').val())){
                                    $('.youwan_eNameTips_<?=$i?>').show();
                                    $('.youwan_eNameTips_<?=$i?>').html('请输入正确的英文名！').css('color','red');
                                    youwaneName_flag_<?=$i?>=0;
                                }
                            });
                            </script>
                            <?}elseif($taocan['travellerEnName']=='TRAV_NUM_ONE' && $i=='0'){?>
                            <li>
                                <label><b>＊</b>英文名</label>
                                <input type="text" name="eName_<?=$i?>" value="<?php if(isset($_POST['eName_'.$i])){echo $_POST['eName_'.$i];}?>" id="youwan_eName_<?=$i?>">
                                <span class="youwan_eNameTips_<?=$i?>"></span>
                            </li>
                            <script type="text/javascript">
                            $('#youwan_eName_<?=$i?>').blur(function(){
                                if($('#youwan_eName_<?=$i?>').val()==''){
                                    $('.youwan_eNameTips_<?=$i?>').show().html('游玩人英文名不能为空').css('color','red');
                                }else if(reg5.test($('#youwan_eName_<?=$i?>').val())){
                                    $('.youwan_eNameTips_<?=$i?>').show();
                                    $('.youwan_eNameTips_<?=$i?>').html('');
                                    youwaneName_flag_<?=$i?>=1;
                                }else if(!reg5.test($('#youwan_eName_<?=$i?>').val())){
                                    $('.youwan_eNameTips_<?=$i?>').show();
                                    $('.youwan_eNameTips_<?=$i?>').html('请输入正确的英文名！').css('color','red');
                                    youwaneName_flag_<?=$i?>=0;
                                }
                            });
                            </script>
                            <?}?>
                            
                            <li><?if($taocan['travellerPersonType']=='TRAV_NUM_ALL'){?>
                                    <label><b>＊</b>人群：</label>
                                    <select name="personType_<?=$i?>">
                                        <option value="adult">成人</option>
                                        <option value="child">儿童</option> 
                                    </select>
                                    <?}elseif($taocan['travellerPersonType']=='TRAV_NUM_ONE' && $i=='0'){?>
                                    <label><b>＊</b>人群：</label>
                                    <select name="personType_<?=$i?>">
                                        <option value="adult">成人</option>
                                        <option value="child">儿童</option>
                                    </select>
                                    <?}?>
                                <?if($taocan['travellerGender']=='TRAV_NUM_ALL' || $taocan['travellerCredentials']=='TRAV_NUM_ALL'){?>    
                                    <label><b>＊</b>性别：</label>
                                    <select name="gender_<?=$i?>">
                                        <option value="male">男</option>
                                        <option value="chifemaleld">女</option>
                                    </select>
                                <?}elseif(($taocan['travellerGender']=='TRAV_NUM_ONE' && $i=='0')||$taocan['travellerCredentials']=='TRAV_NUM_ONE'){?>
                                    <label><b>＊</b>性别：</label>
                                    <select name="gender_<?=$i?>">
                                        <option value="male">男</option>
                                        <option value="chifemaleld">女</option>
                                    </select>
                                <?}?>

                            </li>
                            <?if($taocan['travellerCredentials']=='TRAV_NUM_ALL'){?>
                            <li>
                                <label><b>＊</b>证件类型：</label>
                                <select style="width: 138px;">
                                    <option>身份证</option>
                                </select>
                                <input type="text" name="credentials_<?=$i?>" value="<?php if(isset($_POST['credentials_'.$i])){echo $_POST['credentials_'.$i];}?>"  id="youwan_userIdcard_<?=$i?>">
                                <span class="youwan_idTips_<?=$i?>"></span>
                            </li>
                            <script type="text/javascript">
                            $('#youwan_userIdcard_<?=$i?>').blur(function(){
                                if($('#youwan_userIdcard_<?=$i?>').val()==''){
                                    $('.youwan_idTips_<?=$i?>').show().html('游玩人证件号不能为空').css('color','red');
                                }else if(reg3.test($('#youwan_userIdcard_<?=$i?>').val())){
                                    $('.youwan_idTips_<?=$i?>').show();
                                    $('.youwan_idTips_<?=$i?>').html('');
                                    youwanIdNum_flag_<?=$i?>=1;
                                }else if(!reg3.test($('#youwan_userIdcard_<?=$i?>').val())){
                                    $('.youwan_idTips_<?=$i?>').show();
                                    $('.youwan_idTips_<?=$i?>').html('请输入正确的证件号！').css('color','red');
                                    youwanIdNum_flag_<?=$i?>=0;
                                }
                            });
                            </script>
                            <?}elseif($taocan['travellerCredentials']=='TRAV_NUM_ONE' && $i=='0'){?>
                            <li>
                                <label><b>＊</b>证件类型：</label>
                                <select style="width: 138px;">
                                    <option>身份证</option>
                                </select>
                                <input type="text" name="credentials_<?=$i?>" value="<?php if(isset($_POST['credentials_'.$i])){echo $_POST['credentials_'.$i];}?>"  id="youwan_userIdcard_<?=$i?>">
                                <span class="youwan_idTips_<?=$i?>"></span>
                            </li>
                            <script type="text/javascript">
                            $('#youwan_userIdcard_<?=$i?>').blur(function(){
                                if($('#youwan_userIdcard_<?=$i?>').val()==''){
                                    $('.youwan_idTips_<?=$i?>').show().html('游玩人证件号不能为空').css('color','red');
                                }else if(reg3.test($('#youwan_userIdcard_<?=$i?>').val())){
                                    $('.youwan_idTips_<?=$i?>').show();
                                    $('.youwan_idTips_<?=$i?>').html('');
                                    youwanIdNum_flag_<?=$i?>=1;
                                }else if(!reg3.test($('#youwan_userIdcard_<?=$i?>').val())){
                                    $('.youwan_idTips_<?=$i?>').show();
                                    $('.youwan_idTips_<?=$i?>').html('请输入正确的证件号！').css('color','red');
                                    youwanIdNum_flag_<?=$i?>=0;
                                }
                            });
                            </script>
                            <?}?>
                            <?if($taocan['travellerBirthday']=='TRAV_NUM_ALL' || $taocan['travellerCredentials']=='TRAV_NUM_ALL'){?>
                            <li>
                                <label><b>＊</b>生日</label>
                                <input type="text" class="hhm-dateInputer" name="birthday_<?=$i?>" value="<?php if(isset($_POST['birthday_'.$i])){echo $_POST['birthday_'.$i];}?>" id="youwan_birthday_<?=$i?>"><?if($i==0){?><span>日期格式如下:1980-05-21</span><?}?><span class="youwan_birthday_<?=$i?>"></span>
                            </li>
                            <script type="text/javascript">
                            <?if($_GET['flag']=='check'){?>
                                var youwanBirthday__flag=1;
                            <?}else{?>
                            var youwanBirthday__flag=0;
                            <?}?>
                            $('#youwan_birthday_<?=$i?>').blur(function(){
                                
                                if($('#youwan_birthday_<?=$i?>').val()==''){
                                    $('.youwan_birthday_<?=$i?>').show().html('生日不能为空').css('color','red');
                                    youwanBirthday__flag=0;
                                }else if(reg6.test($('#youwan_birthday_<?=$i?>').val())){
                                    $('.youwan_birthday_<?=$i?>').show();
                                    $('.youwan_birthday_<?=$i?>').html('');
                                   youwanBirthday__flag=1;
                                }else if(!reg6.test($('#youwan_birthday_<?=$i?>').val())){
                                    $('.youwan_birthday_<?=$i?>').show();
                                    $('.youwan_birthday_<?=$i?>').html('请输入正确的生日！').css('color','red');
                                    youwanBirthday__flag=0;
                                }
                            });
                            </script>
                            <?}elseif(($taocan['travellerBirthday']=='TRAV_NUM_ONE' && $i=='0')||$taocan['travellerCredentials']=='TRAV_NUM_ONE'){?>
                            <li>
                                <label><b>＊</b>生日</label>
                                <input type="text" class="hhm-dateInputer" name="birthday_<?=$i?>" value="<?php if(isset($_POST['birthday_'.$i])){echo $_POST['birthday_'.$i];}?>" id="youwan_birthday_<?=$i?>"><?if($i==0){?><span>日期格式如下:1980-05-21</span><?}?><span class="youwan_birthday_<?=$i?>"></span>
                            </li>
                            <script type="text/javascript">

                            <?if($_GET['flag']=='check'){?>
                                var youwanBirthday__flag=1;
                            <?}else{?>
                            var youwanBirthday__flag=0;
                            <?}?>
                            $('#youwan_birthday_<?=$i?>').blur(function(){
                                
                                if($('#youwan_birthday_<?=$i?>').val()==''){
                                    $('.youwan_birthday_<?=$i?>').show().html('生日不能为空').css('color','red');
                                    youwanBirthday__flag=0;
                                }else if(reg6.test($('#youwan_birthday_<?=$i?>').val())){
                                    $('.youwan_birthday_<?=$i?>').show();
                                    $('.youwan_birthday_<?=$i?>').html('');
                                   youwanBirthday__flag=1;
                                }else if(!reg6.test($('#youwan_birthday_<?=$i?>').val())){
                                    $('.youwan_birthday_<?=$i?>').show();
                                    $('.youwan_birthday_<?=$i?>').html('请输入正确的生日！').css('color','red');
                                   youwanBirthday__flag=0;
                                }
                            });
                            </script>
                            <?}?>
                        </ul>
                    </div>
                </div>
                <?}?>
                <?}?>
                <!-- 游玩人结束 -->
                <?if($taocan['emergency'] == 'true'){?>
                <div class="zbyOrder_main2_youwan">
                    <div class="zbyOrder_main2_youwanLeft">紧急联系人</div>
                    <div class="zbyOrder_main2_youwanRight">
                        <ul>
                           <li>
                               <label><b>＊</b>姓名：</label>
                                <input type="text" name="emergencyName" value="<?php if(isset($_POST['emergencyName'])){echo $_POST['emergencyName'];}?>">
                            </li>
                            <li>
                                <label><b>＊</b>手机号码：</label>
                                <input type="text" name="emergencyMobile" value="<?php if(isset($_POST['emergencyMobile'])){echo $_POST['emergencyMobile'];}?>">
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
                    <div class="zbyOrder_main31_left">应付总价：￥<span id="orderPrice"><?=$payPrice1?></span></div>
                    
                    <button class="zbyOrder_main31_right" onclick = "check_form()">去付款</button>

                </div>
                <div class="zbyOrder_main32">
                    <label><a href="<?=$g_self_domain?>/zhoubian/xy.html" target="_blank"><u>我已同意条款</u></a></label>
                    <input type="checkbox" name="我已同意以下条款" id="tiaokuan" onclick="hasChecked(this)">
                </div>
                <div class="zbyOrder_main33">
                    温馨提示：请您仔细阅读预订须知及旅游合同条款，订单提交后，视为您同意以下各项条款内容
                </div>
            </div>
    </div>
</div>
<!-- </form> -->
<!-- main end -->

    <!--  foot  start -->
    <?include 'foot.php';?>
</body>

<script type="text/javascript">
function hasChecked(obj){
                if($(obj).attr("hasCheck") == "0"){
                    $(obj).attr("hasCheck","1");
                    
                }else if($(obj).attr("hasCheck") == "1"){
                    $(obj).attr("hasCheck","0");
                    
                }else{
                    
                    $(obj).attr("hasCheck","1");
                }
            }   

//表单合发性验证
var reg1 = /^([\u4e00-\u9fa5]){2,6}$/;//匹配中文
var reg2 = /^1[34578]\d{9}$/;//匹配手机号
var reg3 = /(^\d{15}$)|(^\d{17}(\d|X)$)/;//匹配身份证
var reg4 = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;//匹配邮箱
var reg5 = /^[A-Za-z]+$/;//英文名
var reg6 = /^((((19|20)\d{2})-(0?(1|[3-9])|1[012])-(0?[1-9]|[12]\d|30))|(((19|20)\d{2})-(0?[13578]|1[02])-31)|(((19|20)\d{2})-0?2-(0?[1-9]|1\d|2[0-8]))|((((19|20)([13579][26]|[2468][048]|0[48]))|(2000))-0?2-29))$/;
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
//邮箱
$('#email').blur(function(){
    if($('#email').val()==''){
        $('.buyer_emailTips').show().html('联系人邮箱不能为空').css('color','red');
    }else if(reg4.test($('#email').val())){
        $('.buyer_emailTips').show();
        $('.buyer_emailTips').html('');
        buyerEmail_flag=1;
    }else if(!reg4.test($('#email').val())){
        $('.buyer_emailTips').show();
        $('.buyer_emailTips').html('请输入正确的邮箱！').css('color','red');
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
        $('.buyer_phoneTips').show().html('联系人手机号不能为空').css('color','red');
    }else if(reg2.test($('#mobile').val())){
        $('.buyer_phoneTips').show();
        $('.buyer_phoneTips').html('');
        buyerPhone_flag=1;
    }else if(!reg2.test($('#mobile').val())){
        $('.buyer_phoneTips').show();
        $('.buyer_phoneTips').html('请输入正确的手机号！').css('color','red');
        buyerPhone_flag=0;
    }
});



function check_form(){

    if($('#tiaokuan').attr('hasCheck')=='1'){
        var kidNum = $('#kidNum').html();//儿童数
        if(kidNum==''){
            kidNum = $('#kidNum').val();//儿童数
        }
        var adultNum = $('#adultNum').html();//成人数
        if(adultNum==''){
            adultNum = $('#adultNum').val();//成人数
        }
        var zongjia = $('#orderPrice').html();
        var packageNum = $('#packageNum').html();
        $('#payPricei').val(zongjia);
        $('#adultNumi').val(adultNum);
        $('#childNumi').val(kidNum);
        <?if($jiahao==1){?>
        var diffPriceNum = $('#diffPriceNum').val();
        $('#roomCounti').val(diffPriceNum);
        <?}else{?>
        var diffPriceNum = $('#diffPriceNum').html();
        $('#roomCounti').val(diffPriceNum);
        <?}?>
        $('#packageNumi').val(packageNum);
        <?if ($is_package == 'false'){?>
        var zongshu = Number(adultNum) + Number(kidNum);
        if(zongshu><?=$taocan['max']?>){
            alert('游玩人总数超过最大订购量:<?=$taocan['max']?>');
            exit();
        }
        <?if($taocan['travellerBirthday']=='TRAV_NUM_ALL' || $taocan['travellerCredentials']=='TRAV_NUM_ALL' || ($taocan['travellerBirthday']=='TRAV_NUM_ONE' && $i=='0')||$taocan['travellerCredentials']=='TRAV_NUM_ONE'){?>
        
        if(youwanBirthday__flag==0){
            alert('出生日期输入错误');exit();
        }
        <?}?>
        if(kidNum==0 && adultNum==0){
            alert('游玩人数不能为0');
        }else{
           document.getElementById("write_form").submit(); 
        }
        <?}else{?>
            document.getElementById("write_form").submit(); 
        <?}?>
    }else{
        alert('请先阅读旅游条款并同意条款'); 
    }
}
//动态创建

</script>
<?
if($dingdan['status'] == '1000'){
    if(empty($dingdan['msg'])){
        $dingdan['msg'] = '操作有误';
    }else{
        $dingdan['msg'] = '\''.$dingdan['msg'].'\'';
       
    }
    echo '<script>alert('.$dingdan['msg'].')</script>';
    
}
?>
</html>