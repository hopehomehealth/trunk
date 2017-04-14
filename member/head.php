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
                <span id="topTime">2017年01月18日&nbsp;&nbsp;星期三&nbsp;&nbsp;</span>
                <span id="topAddress">
						<span>进入[<a href="" class="currentCity">北京市</a>]专版</span>&nbsp;&nbsp;
						<a href="http://www.bus365.com/city0" id="changeCity">[切换城市]</a>
					</span>
            </div>
            <div class="topAboveCont_right">
                <div class="top_phoneApp">
                    <span>手机APP</span>
                    <img src="images/appScan.jpg">
                </div>
                <div class="top_wechat">
                    <span>微信</span>
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
                <span>全部产品</span>
                <ul>
                    <li>自由行</li>
                    <li>门票</li>
                    <li>自由行</li>
                    <li>门票</li>
                </ul>
            </div>
            <div class="topCenter_c">
                <input type="text" name="请输入目的地/产品名称" placeholder="请输入目的地/产品名称">
            </div>
            <div class="topCenter_r">
                <button>搜索</button>
            </div>
        </div>
        <div class="topRight">
            <div class="hotline">
                全国客服热线<br/>
                <span>400-08-84365<br>400-99-84365</span>
            </div>
        </div>
    </div>
</div>
<!-- head  end -->

<!--  nav导航  start -->
<div id="navBox">
    <div id="nav">
        <div class="navLeft">
            <ul>
                <li class=""><a href="">首页</a></li>
                <li><a href="">汽车票</a></li>
                <li><a href="">飞机票</a></li>
                <li><a href="">火车票</a></li>
                <li style="position: relative;" class="trip_list_btn nav_hover">
                    <a href="" style="width: 100%;height: 50px;">旅游</a>
                    <ul class="trip_list hide">
                        <li><a href="/zhoubian/">周边游</a></li>
                        <li><a href="/menpiao/beijing/">门票</a></li>
                    </ul>
                </li>
                <li><a href="">酒店</a></li>
                <li><a href="">用车</a></li>
                <li><a href="<?echo $g_bus_domain;?>/phone">手机版</a></li>
            </ul>
        </div>
        <div class="navRight">
            <div class="mybus365">
                <a href="" id="mybus365_btn">我的Bus365</a>
                <ul class="before_login hide">
                    <li><a href="">我的订单</a></li>
                    <li><a href="">非会员订单</a></li>
                </ul>
                <ul class="after_login hide">
                    <li>
                        <a href="">我的订单</a>
                    </li>
                    <li>
                        <a href="">待支付订单</a>
                    </li>
                    <li>
                        <a href="">乘车待点评</a>
                    </li>
                    <li>
                        <a href="">会员信息</a>
                    </li>
                    <li>
                        <a href="">会员安全</a>
                    </li>
                    <li>
                        <a href="">常用乘车联系人管理</a>
                    </li>
                    <li>
                        <a href="">我的优惠券</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">退出登录</a>
                    </li>
                </ul>
            </div>
            <div class="loginAndReg">
                <a href="">登录</a>|<a href="">注册</a>
            </div>
        </div>
    </div>
</div>
<!--  nav导航  end -->

<script language="javascript">
    var cityObj = {"HOT":{"index":[],"\u534e\u4e1c":[{"key":"SHA","val":"上海","PY":"SHANGHAI","JP":"SH"}],"\u534e\u5317":[{"key":"PEK","val":"\u5317\u4eac","PY":"BEIJING","JP":"BJ"},{"key":"TSN","val":"\u5929\u6d25","PY":"TIANJIN","JP":"TJ"}],"\u534e\u5357":[{"key":"CAN","val":"\u5e7f\u5dde","PY":"GUANGZHOU","JP":"GZ"},{"key":"SZX","val":"\u6df1\u5733","PY":"SHENZHEN","JP":"SZ"}],"\u897f\u5357":[{"key":"CKG","val":"\u91cd\u5e86","PY":"CHONGQING","JP":"CQ"}]},"A":{"B":[{"key":"PEK","val":"\u5317\u4eac","PY":"BEIJING","JP":"BJ"}],"C":[{"key":"CKG","val":"\u91cd\u5e86","PY":"CHONGQING","JP":"CQ"}],"G":[{"key":"CAN","val":"\u5e7f\u5dde","PY":"GUANGZHOU","JP":"GZ"}]},"N":{"S":[{"key":"SHA","val":"\u4e0a\u6d77","PY":"SHANGHAI","JP":"SH"},{"key":"SZX","val":"\u6df1\u5733","PY":"SHENZHEN","JP":"SZ"}],"T":[{"key":"TSN","val":"\u5929\u6d25","PY":"TIANJIN","JP":"TJ"}]}};
    var now_city="SZX";

    seajs.use(['jquery', 'handlebars', 'header', 'livequery', 'rightSide'], function ($, hlb, header, livequery, rightSide) {
        header.init();
        rightSide.init();
    });
</script>