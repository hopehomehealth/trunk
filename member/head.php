<?
include($g_site_root.'/member/dialog.html');
?>
<!--<meta charset="UTF-8">-->
<link rel="stylesheet" type="text/css" href="/themes/s01/images/common.css">
<script type="text/javascript" src="/themes/s01/js/jquery.js"></script>
<script type="text/javascript" src="/themes/s01/js/common.js"></script>
<?
if($g_config['site_notice']!='' && $is_index==true){
?>
<div class="top-notice">
    <div class="ota-container" style="text-align:center;color:red;">
        <?=$g_config['site_notice']?>
    </div>
</div>
<?}?>

<!--  head  start -->
<div id="topBox">
    <div class="topAbove">
        <div class="topAboveCont">
            <div class="topAboveCont_left">
                <span id="topTime">2017��01��18��&nbsp;&nbsp;������&nbsp;&nbsp;</span>
                <span id="topAddress">
						<span>����[<a href="" class="currentCity">������</a>]ר��</span>&nbsp;&nbsp;
						<a href="http://www.bus365.com/city0" id="changeCity">[�л�����]</a>
					</span>
            </div>
            <div class="topAboveCont_right">
                <div class="top_phoneApp">
                    <span>�ֻ�APP</span>
                    <img src="images/appScan.jpg">
                </div>
                <div class="top_wechat">
                    <span>΢��</span>
                    <img src="images/wechatScan.jpg">
                </div>
            </div>
        </div>
    </div>
    <div id="top">
        <div class="topLeft">
            <a href="http://www.bus365.com" class="logo">
                <img src="/themes/s01/images/logo.png">
            </a>
            <a href="http://www.bus365.com" class="logo_text">
                <img src="/themes/s01/images/logowww.png">
            </a>
        </div>
        <div class="topCenter">
            <div class="topCenter_l">
                <span>ȫ����Ʒ</span>
                <ul>
                    <li>������</li>
                    <li>��Ʊ</li>
                    <li>������</li>
                    <li>��Ʊ</li>
                </ul>
            </div>
            <div class="topCenter_c">
                <input type="text" name="������Ŀ�ĵ�/��Ʒ����" placeholder="������Ŀ�ĵ�/��Ʒ����">
            </div>
            <div class="topCenter_r">
                <button>����</button>
            </div>
        </div>
        <div class="topRight">
            <div class="hotline">
                ȫ���ͷ�����<br/>
                <span>400-08-84365<br>400-99-84365</span>
            </div>
        </div>
    </div>
</div>
<!-- head  end -->

<!--  nav����  start -->
<div id="navBox">
    <div id="nav">
        <div class="navLeft">
            <ul>
                <li class=""><a href="">��ҳ</a></li>
                <li><a href="">����Ʊ</a></li>
                <li><a href="">�ɻ�Ʊ</a></li>
                <li><a href="">��Ʊ</a></li>
                <li style="position: relative;" class="trip_list_btn nav_hover">
                    <a href="" style="width: 100%;height: 50px;">����</a>
                    <ul class="trip_list hide">
                        <li><a href="/zhoubian/">�ܱ���</a></li>
                        <li><a href="/menpiao/beijing/">��Ʊ</a></li>
                    </ul>
                </li>
                <li><a href="">�Ƶ�</a></li>
                <li><a href="">�ó�</a></li>
                <li><a href="<?echo $g_bus_domain;?>/phone">�ֻ���</a></li>
            </ul>
        </div>
        <div class="navRight">
            <div class="mybus365">
                <a href="" id="mybus365_btn">�ҵ�Bus365</a>
                <ul class="before_login hide">
                    <li><a href="">�ҵĶ���</a></li>
                    <li><a href="">�ǻ�Ա����</a></li>
                </ul>
                <ul class="after_login hide">
                    <li>
                        <a href="">�ҵĶ���</a>
                    </li>
                    <li>
                        <a href="">��֧������</a>
                    </li>
                    <li>
                        <a href="">�˳�������</a>
                    </li>
                    <li>
                        <a href="">��Ա��Ϣ</a>
                    </li>
                    <li>
                        <a href="">��Ա��ȫ</a>
                    </li>
                    <li>
                        <a href="">���ó˳���ϵ�˹���</a>
                    </li>
                    <li>
                        <a href="">�ҵ��Ż�ȯ</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">�˳���¼</a>
                    </li>
                </ul>
            </div>
            <div class="loginAndReg">
                <a href="">��¼</a>|<a href="">ע��</a>
            </div>
        </div>
    </div>
</div>
<!--  nav����  end -->

<script language="javascript">
    var cityObj = {"HOT":{"index":[],"\u534e\u4e1c":[{"key":"SHA","val":"�Ϻ�","PY":"SHANGHAI","JP":"SH"}],"\u534e\u5317":[{"key":"PEK","val":"\u5317\u4eac","PY":"BEIJING","JP":"BJ"},{"key":"TSN","val":"\u5929\u6d25","PY":"TIANJIN","JP":"TJ"}],"\u534e\u5357":[{"key":"CAN","val":"\u5e7f\u5dde","PY":"GUANGZHOU","JP":"GZ"},{"key":"SZX","val":"\u6df1\u5733","PY":"SHENZHEN","JP":"SZ"}],"\u897f\u5357":[{"key":"CKG","val":"\u91cd\u5e86","PY":"CHONGQING","JP":"CQ"}]},"A":{"B":[{"key":"PEK","val":"\u5317\u4eac","PY":"BEIJING","JP":"BJ"}],"C":[{"key":"CKG","val":"\u91cd\u5e86","PY":"CHONGQING","JP":"CQ"}],"G":[{"key":"CAN","val":"\u5e7f\u5dde","PY":"GUANGZHOU","JP":"GZ"}]},"N":{"S":[{"key":"SHA","val":"\u4e0a\u6d77","PY":"SHANGHAI","JP":"SH"},{"key":"SZX","val":"\u6df1\u5733","PY":"SHENZHEN","JP":"SZ"}],"T":[{"key":"TSN","val":"\u5929\u6d25","PY":"TIANJIN","JP":"TJ"}]}};
    var now_city="SZX";

    seajs.use(['jquery', 'handlebars', 'header', 'livequery', 'rightSide'], function ($, hlb, header, livequery, rightSide) {
        header.init();
        rightSide.init();
    });
</script>