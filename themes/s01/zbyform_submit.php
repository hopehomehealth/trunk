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
<title>周边游订单</title>
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
        <form name="write_form" id="write_form" method="post" action="http://<?=$getUrl?>&flag=check">
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
                                <td>
                                    <span class="caculate" onselectstart="return false">
                                        <span class="subtract">-</span>
                                        <span class="counts"><?=$post['adultNum']?></span>
                                        <input type="hidden" name="adultNum" class="Num" id="adultNum">
                                        <span class="add">+</span>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>儿童</td>
                                <td id="kidPrice">
                                    <?=$taocan['kidPrice']?>
                                </td>
                                <td>
                                    <span class="caculate" onselectstart="return false">
                                        <span class="subtract">-</span>
                                        <span class="counts"><?=$post['kidNum']?></span>
                                        <input type="hidden" name="kidNum" class="Num" id="kidNum">
                                        <span class="add">+</span>
                                    </span>
                                </td>
                            </tr>
                            </tbody>
                            <thead>
                            <tr>
                                <td>房差
                                </td>
                                <td><?=   $_GET['roomPrice']?></td>
                                <td><?=$post['roomCount']?></td>
                            </tr>
                            </thead>
                        </table>
                        
                    </div>
                </div>
            </div>
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
                                <td  onclick="changeTR()" style="cursor:pointer;" onselectstart="return false"><?=$taocan['packageName']?>&nbsp;&nbsp;<span id="change" class="subtriangle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                                <td><?=$tc['departDate']?>
                                <td>
                                    <?=$post['packageNum']?>
                                </td>
                            </tr>
                            </tbody>
                            <!-- <tr id="sample"  style="display:none"  >  
                                  <td align="left">  
                                      描述:..... 
                                  </td>  
                              </tr> -->  
                        </table>
                        <div class="spotTicket_infoHide" id="sample"  style="display:none;width:1402px;">描述:..... </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
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
                <div class="zbyOrder_main2_title">联系人信息</div>

                <div class="zbyOrder_main2_buy">
                    <div class="zbyOrder_main2_buyLeft">联系人</div>
                    <div class="zbyOrder_main2_buyRight">
                        <ul>
                            <?if($taocan['bookerName']=='true'){?>
                            <li>
                                <label><b>＊</b>姓名：</label>
                                <input type="text" name="bookerName" id="linker" value="">
                                <span class="buyer_nameTips">购买人姓名不能为空！</span>
                            </li>
                            <?}?>
                            <?if($taocan['bookerMobile']=='true'){?>
                            <li>
                                <label><b>＊</b>手机号码：</label>
                                <input type="text" name="bookerMobile" id="mobile" value="">
                                <span>此手机为接受短信所用，作为订购于取票凭证，请准确填写。</span>
                                <span class="buyer_phoneTips">购买人手机号不能为空！</span>
                            </li>
                            <?}?>
                            <?if($taocan['bookerEmail']=='true'){?>
                            <li>
                                <label><b>＊</b>邮箱：</label>
                                <input type="text" name="bookerEmail" id="email" value="">
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
                                <input type="text" name="name_<?=$i?>" autocomplete="off" id="youwan_userName_<?=$i?>">
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
                                <input type="text" name="name_<?=$i?>" autocomplete="off" id="youwan_userName_<?=$i?>">
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
                                <input type="text" name="mobile_<?=$i?>" autocomplete="off" id="youwan_userPhone_<?=$i?>">
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
                                <input type="text" name="mobile_<?=$i?>" autocomplete="off" id="youwan_userPhone_<?=$i?>">
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
                                <input type="text" name="email_<?=$i?>" id="youwan_email_<?=$i?>" value="">
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
                                <input type="text" name="email_<?=$i?>" id="youwan_email_<?=$i?>" value="">
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
                                <input type="text" name="eName_<?=$i?>" autocomplete="off" id="youwan_eName_<?=$i?>">
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
                                <input type="text" name="eName_<?=$i?>" autocomplete="off" id="youwan_eName_<?=$i?>">
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
                                <input type="text" name="credentials_<?=$i?>" autocomplete="off"  id="youwan_userIdcard_<?=$i?>">
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
                                <input type="text" name="credentials_<?=$i?>" autocomplete="off"  id="youwan_userIdcard_<?=$i?>">
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
                                <input type="date" name="birthday_<?=$i?>" autocomplete="off" id="youwan_birthday_<?=$i?>"  min="1900-09-16" max="<?echo date("Y-m-d",time());?>"><span class="youwan_birthday_<?=$i?>"></span>
                            </li>
                            <script type="text/javascript">
                            $('#youwan_birthday_<?=$i?>').blur(function(){
                                if($('#youwan_birthday_<?=$i?>').val()==''){
                                    $('.youwan_birthday_<?=$i?>').show().html('生日不能为空').css('color','red');
                                }
                            });
                            </script>
                            <?}elseif(($taocan['travellerBirthday']=='TRAV_NUM_ONE' && $i=='0')||$taocan['travellerCredentials']=='TRAV_NUM_ONE'){?>
                            <li>
                                <label><b>＊</b>生日</label>
                                <input type="date" name="birthday_<?=$i?>" autocomplete="off" id="youwan_birthday_<?=$i?>"  min="1900-09-16" max="<?echo date("Y-m-d",time());?>"><span class="youwan_idTips_<?=$i?>"></span>
                            </li>
                            <script type="text/javascript">
                            $('#youwan_birthday_<?=$i?>').blur(function(){
                                if($('#youwan_birthday_<?=$i?>').val()==''){
                                    $('.youwan_birthday_<?=$i?>').show().html('生日不能为空').css('color','red');
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
                                <input type="text" name="emergencyName" autocomplete="off">
                            </li>
                            <li>
                                <label><b>＊</b>手机号码：</label>
                                <input type="text" name="emergencyMobile" autocomplete="off">
                                <span></span>
                            </li>
                            
                        </ul>
                    </div>
                </div>
                <?}?>
            </div>
        
        </form>
            <div class="zbyOrder_main3">
                <div class="zbyOrder_main31">
                    <div class="zbyOrder_main31_left">应付总价：￥<?=$post['payPrice']?></div>

                    <button class="zbyOrder_main31_right" onclick = "check_form()">同意以下条款，去付款</button>

                </div>
                <div class="zbyOrder_main32">
                    <label><a href="<?=$g_self_domain?>/zhoubian/xy.html" target="_blank">我已同意以下条款</a></label>
                    <input type="checkbox" name="我已同意以下条款">
                    <!-- <label>同意团队境内旅游合同</label>
                    <input type="checkbox" name="同意团队境内旅游合同"> -->
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
<script type="text/javascript" src="/themes/s01/js/jquery.js"></script>
<script type="text/javascript" src="/themes/s01/js/common.js"></script>
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
            $()

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
            }
        };
    }


});

</script>
<script type="text/javascript">


//表单合发性验证
var reg1 = /^([\u4e00-\u9fa5]){2,6}$/;//匹配中文
var reg2 = /^1[34578]\d{9}$/;//匹配手机号
var reg3 = /(^\d{15}$)|(^\d{17}(\d|X)$)/;//匹配身份证
var reg4 = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;//匹配邮箱
var reg5 = /^[A-Za-z]+$/;//英文名
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
    if($('.zbyOrder_main32 input').eq(0).attr('checked')){
    // alert(buyerName_flag+'----'+buyerPhone_flag+'----'+youwanName_flag+'----'+youwanPhone_flag+'----'+youwanIdNum_flag);
        document.getElementById("write_form").submit();
    }

}


</script>
<?
if($dingdan['status'] == '1000'){
        $dingdan['msg'] = '\''.$dingdan['msg'].'\'';
        echo '<script>alert('.$dingdan['msg'].')</script>';
     }
?>
</html>