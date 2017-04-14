<?   
include('auth.php');
  

// 创建用户目录
$dir_user = $g_root.'upfiles/'.$g_siteid.'/';
if(!is_dir($dir_user)){
	@mkdir($dir_user,0777);
} 

if( $cookie_user_role == 'SHOP' ){
	$qer = " AND shop_id='$g_shopid' ";
} 

// 订单量
$sql = "SELECT COUNT(*) FROM `t_user_order` WHERE `site_id`='".$g_siteid."' AND DATE_FORMAT(`addtime`,'%Y-%m-%d')='".date('Y-m-d')."' $qer";  
$order_count = $db->get_value($sql); 

// 在售产品量
$sql = "SELECT COUNT(*) FROM `t_goods_thread` WHERE `site_id`='".$g_siteid."' AND is_sale='1' $qer";  
$goods_count = $db->get_value($sql); 

// 供应商数量
$sql = "SELECT COUNT(*) FROM `t_shop` WHERE `site_id`='".$g_siteid."' AND `state`='1'";  
$shop_count	= $db->get_value($sql); 

// 客户数量
$sql = "SELECT COUNT(*) FROM `t_user` WHERE `site_id`='".$g_siteid."' AND `state`='1'";  
$user_count	= $db->get_value($sql); 
 
 
function stat_order_money($date){
	global $db, $g_siteid, $qer;

	$sql = "SELECT SUM(`real_price`) FROM `t_user_order` WHERE `site_id`='".$g_siteid."' AND DATE_FORMAT(`addtime`,'%Y-%m-%d')='$date' $qer ";  
	$rs = $db->get_value($sql); 

	if($rs=='') $rs = 0;
	return $rs;
}

function stat_order_count($date){
	global $db, $g_siteid, $qer;

	$sql = "SELECT COUNT(*) FROM `t_user_order` WHERE `site_id`='".$g_siteid."' AND DATE_FORMAT(`addtime`,'%Y-%m-%d')='$date' $qer";  
	$rs = $db->get_value($sql); 

	if($rs=='') $rs = 0;
	return $rs;
}

function stat_browse($type, $day){
	global $db, $g_siteid;
	
	if($type=='uv'){
		$sql = "SELECT COUNT(*) FROM (SELECT `session_id` FROM `t_stat` WHERE `site_id`='".$g_siteid."' AND DATE_FORMAT(`addtime`,'%Y-%m-%d')='$day' AND `bot`='' GROUP BY `session_id`) TMP";  
	}
	if($type=='pv'){
		$sql = "SELECT COUNT(*) FROM `t_stat` WHERE `site_id`='".$g_siteid."' AND DATE_FORMAT(`addtime`,'%Y-%m-%d')='$day' AND `bot`=''";  
	}
	$rs = $db->get_value($sql); 

	if($rs=='') $rs = 0;

	return $rs;
}
?>

<link rel="stylesheet" href="tpl/css/compiled/index.css" type="text/css" media="screen" /> 
			 
<div id="main-stats">
                <div class="row-fluid stats-row"> 
                    <div class="span3 stat">
                        <div class="data">
                            <span class="number"><?=$order_count?></span>
                            订单
                        </div>
                        <span class="date">今日</span>
                    </div>
                    <div class="span3 stat ">
                        <div class="data">
                            <span class="number"><?=stat_browse('uv', date('Y-m-d'))?></span>
                            访客
                        </div>
                        <span class="date">今日</span>
                    </div>
					<div class="span3 stat">
                        <div class="data">
                            <span class="number"><?=$shop_count?></span>
                            商家
                        </div>
                        <span class="date">截止今天</span>
                    </div>
                    <div class="span3 stat last">
                        <div class="data">
                            <span class="number"><?=$user_count?></span>
                            客户
                        </div>
                        <span class="date">截止今天</span>
                    </div>
                </div>
</div>
		 
<div id="pad-wrapper">  
				<div class="row-fluid chart">
                    <h4>
                        浏览量 
                    </h4>
                    <div class="span12">
                        <div id="statsChart3" style="padding: 0px; position: relative;">
						</div>
                    </div>
                </div>  

				<div style="clear:both"><br/><br/></div>

				<div class="row-fluid chart">
                    <h4>
                        访客量 
                    </h4>
                    <div class="span12">
                        <div id="statsChart0" style="padding: 0px; position: relative;">
						</div>
                    </div>
                </div> 

				<div style="clear:both"><br/><br/></div>

                <div class="row-fluid chart">
                    <h4>
                        交易额 
                    </h4>
                    <div class="span12">
                        <div id="statsChart1" style="padding: 0px; position: relative;">
						</div>
                    </div>
                </div> 

				<div style="clear:both"><br/><br/></div>
 
                <div class="row-fluid chart">
                    <h4>
                        订单量 
                    </h4>
                    <div class="span12">
                        <div id="statsChart2" style="padding: 0px; position: relative;">
						</div>
                    </div>
                </div>  
</div>
 
<script src="tpl/js/jquery-latest.js"></script>
<script src="tpl/js/bootstrap.min.js"></script>
<script src="tpl/js/jquery-ui-1.10.2.custom.min.js"></script>

<script src="tpl/js/jquery.knob.js"></script>
<!-- flot charts -->
<script src="tpl/js/jquery.flot.js"></script>
<script src="tpl/js/jquery.flot.stack.js"></script>
<script src="tpl/js/jquery.flot.resize.js"></script>
<script src="tpl/js/theme.js"></script>

<script type="text/javascript">
	
		///--------------------------------------------------// 交易额 
        $(function () { 
            // jQuery Flot Chart  
			var JYE = [<?for($i=1; $i<=14; $i++){?>[<?=$i?>, <?=stat_order_money(date('Y-m-d',strtotime("-".(14-$i)." day")))?>]<?if($i!=14){?>,<?}?><?}?>]; 

            var plot = $.plot($("#statsChart1"),
                [  
                 { data: JYE, label: "成交额(元)" }], {
                    series: {
                        lines: { show: true,
                                lineWidth: 1,
                                fill: true, 
                                fillColor: { colors: [ { opacity: 0.1 }, { opacity: 0.13 } ] }
                             },
                        points: { show: true, 
                                 lineWidth: 2,
                                 radius: 3
                             },
                        shadowSize: 0,
                        stack: true
                    },
                    grid: { hoverable: true, 
                           clickable: true, 
                           tickColor: "#f9f9f9",
                           borderWidth: 0
                        },
                    legend: {
                            // show: false
                            labelBoxBorderColor: "#fff"
                        },  
                    colors: ["#30a0eb"],
                    xaxis: { 
						ticks: [<?for($i=1; $i<=14; $i++){?>[<?=$i?>, "<?=date('m-d',strtotime("-".(14-$i)." day"))?>"]<?if($i!=14){?>,<?}?><?}?>],
                        font: {
                            size: 12,
                            family: "Open Sans, Arial",
                            variant: "small-caps",
                            color: "#697695"
                        }
                    },
                    yaxis: {
                        ticks:3, 
                        tickDecimals: 0,
                        font: {size:12, color: "#9da3a9"}
                    }
                 });

            function showTooltip(x, y, contents) {
                $('<div id="tooltip">' + contents + '</div>').css( {
                    position: 'absolute',
                    display: 'none',
                    top: y - 30,
                    left: x - 50,
                    color: "#fff",
                    padding: '2px 5px',
                    'border-radius': '6px',
                    'background-color': '#000',
                    opacity: 0.80
                }).appendTo("body").fadeIn(200);
            }

            var previousPoint = null;
            $("#statsChart1").bind("plothover", function (event, pos, item) {
                if (item) {
                    if (previousPoint != item.dataIndex) {
                        previousPoint = item.dataIndex;

                        $("#tooltip").remove();
                        var x = item.datapoint[0].toFixed(0),
                            y = item.datapoint[1].toFixed(0);

                        var month = item.series.xaxis.ticks[item.dataIndex].label;

                        showTooltip(item.pageX, item.pageY,
                                    item.series.label + " of " + month + ": " + y);
                    }
                }
                else {
                    $("#tooltip").remove();
                    previousPoint = null;
                }
            });
        });

		///--------------------------------------------------// 订单量
		$(function () { 
            // jQuery Flot Chart 
			var DDL = [<?for($i=1; $i<=14; $i++){?>[<?=$i?>, <?=stat_order_count(date('Y-m-d',strtotime("-".(14-$i)." day")))?>]<?if($i!=14){?>,<?}?><?}?>]; 

            var plot = $.plot($("#statsChart2"),
                [ { data: DDL, label: "订单量"} ], {
                    series: {
                        lines: { show: true,
                                lineWidth: 1,
                                fill: true, 
                                fillColor: { colors: [ { opacity: 0.1 }, { opacity: 0.13 } ] }
                             },
                        points: { show: true, 
                                 lineWidth: 2,
                                 radius: 3
                             },
                        shadowSize: 0,
                        stack: true
                    },
                    grid: { hoverable: true, 
                           clickable: true, 
                           tickColor: "#f9f9f9",
                           borderWidth: 0
                        },
                    legend: {
                            // show: false
                            labelBoxBorderColor: "#fff"
                        },  
                    colors: ["#a7b5c5" ],
                    xaxis: { 
						ticks: [<?for($i=1; $i<=14; $i++){?>[<?=$i?>, "<?=date('m-d',strtotime("-".(14-$i)." day"))?>"]<?if($i!=14){?>,<?}?><?}?>],
                        font: {
                            size: 12,
                            family: "Open Sans, Arial",
                            variant: "small-caps",
                            color: "#697695"
                        }
                    },
                    yaxis: {
                        ticks:3, 
                        tickDecimals: 0,
                        font: {size:12, color: "#9da3a9"}
                    }
                 });

            function showTooltip(x, y, contents) {
                $('<div id="tooltip">' + contents + '</div>').css( {
                    position: 'absolute',
                    display: 'none',
                    top: y - 30,
                    left: x - 50,
                    color: "#fff",
                    padding: '2px 5px',
                    'border-radius': '6px',
                    'background-color': '#000',
                    opacity: 0.80
                }).appendTo("body").fadeIn(200);
            }

            var previousPoint = null;
            $("#statsChart2").bind("plothover", function (event, pos, item) {
                if (item) {
                    if (previousPoint != item.dataIndex) {
                        previousPoint = item.dataIndex;

                        $("#tooltip").remove();
                        var x = item.datapoint[0].toFixed(0),
                            y = item.datapoint[1].toFixed(0);

                        var month = item.series.xaxis.ticks[item.dataIndex].label;

                        showTooltip(item.pageX, item.pageY,
                                    item.series.label + " of " + month + ": " + y);
                    }
                }
                else {
                    $("#tooltip").remove();
                    previousPoint = null;
                }
            });
        });


		///--------------------------------------------------// 访客量
		$(function () { 
            // jQuery Flot Chart 
			var FKL = [<?for($i=1; $i<=14; $i++){?>[<?=$i?>, <?=stat_browse('uv', date('Y-m-d',strtotime("-".(14-$i)." day")))?>]<?if($i!=14){?>,<?}?><?}?>]; 

            var plot = $.plot($("#statsChart0"),
                [ { data: FKL, label: "访客量"} ], {
                    series: {
                        lines: { show: true,
                                lineWidth: 1,
                                fill: true, 
                                fillColor: { colors: [ { opacity: 0.1 }, { opacity: 0.13 } ] }
                             },
                        points: { show: true, 
                                 lineWidth: 2,
                                 radius: 3
                             },
                        shadowSize: 0,
                        stack: true
                    },
                    grid: { hoverable: true, 
                           clickable: true, 
                           tickColor: "#f9f9f9",
                           borderWidth: 0
                        },
                    legend: {
                            // show: false
                            labelBoxBorderColor: "#fff"
                        },  
                    colors: ["#a7b5c5" ],
                    xaxis: { 
						ticks: [<?for($i=1; $i<=14; $i++){?>[<?=$i?>, "<?=date('m-d',strtotime("-".(14-$i)." day"))?>"]<?if($i!=14){?>,<?}?><?}?>],
                        font: {
                            size: 12,
                            family: "Open Sans, Arial",
                            variant: "small-caps",
                            color: "#697695"
                        }
                    },
                    yaxis: {
                        ticks:3, 
                        tickDecimals: 0,
                        font: {size:12, color: "#9da3a9"}
                    }
                 });

            function showTooltip(x, y, contents) {
                $('<div id="tooltip">' + contents + '</div>').css( {
                    position: 'absolute',
                    display: 'none',
                    top: y - 30,
                    left: x - 50,
                    color: "#fff",
                    padding: '2px 5px',
                    'border-radius': '6px',
                    'background-color': '#000',
                    opacity: 0.80
                }).appendTo("body").fadeIn(200);
            }

            var previousPoint = null;
            $("#statsChart0").bind("plothover", function (event, pos, item) {
                if (item) {
                    if (previousPoint != item.dataIndex) {
                        previousPoint = item.dataIndex;

                        $("#tooltip").remove();
                        var x = item.datapoint[0].toFixed(0),
                            y = item.datapoint[1].toFixed(0);

                        var month = item.series.xaxis.ticks[item.dataIndex].label;

                        showTooltip(item.pageX, item.pageY,
                                    item.series.label + " of " + month + ": " + y);
                    }
                }
                else {
                    $("#tooltip").remove();
                    previousPoint = null;
                }
            });
        });


		///--------------------------------------------------// 浏览量
		$(function () { 
            // jQuery Flot Chart 
			var LLL = [<?for($i=1; $i<=14; $i++){?>[<?=$i?>, <?=stat_browse('pv', date('Y-m-d',strtotime("-".(14-$i)." day")))?>]<?if($i!=14){?>,<?}?><?}?>]; 

            var plot = $.plot($("#statsChart3"),
                [ { data: LLL, label: "浏览量"} ], {
                    series: {
                        lines: { show: true,
                                lineWidth: 1,
                                fill: true, 
                                fillColor: { colors: [ { opacity: 0.1 }, { opacity: 0.13 } ] }
                             },
                        points: { show: true, 
                                 lineWidth: 2,
                                 radius: 3
                             },
                        shadowSize: 0,
                        stack: true
                    },
                    grid: { hoverable: true, 
                           clickable: true, 
                           tickColor: "#f9f9f9",
                           borderWidth: 0
                        },
                    legend: {
                            // show: false
                            labelBoxBorderColor: "#fff"
                        },  
                    colors: ["#a7b5c5" ],
                    xaxis: { 
						ticks: [<?for($i=1; $i<=14; $i++){?>[<?=$i?>, "<?=date('m-d',strtotime("-".(14-$i)." day"))?>"]<?if($i!=14){?>,<?}?><?}?>],
                        font: {
                            size: 12,
                            family: "Open Sans, Arial",
                            variant: "small-caps",
                            color: "#697695"
                        }
                    },
                    yaxis: {
                        ticks:3, 
                        tickDecimals: 0,
                        font: {size:12, color: "#9da3a9"}
                    }
                 });

            function showTooltip(x, y, contents) {
                $('<div id="tooltip">' + contents + '</div>').css( {
                    position: 'absolute',
                    display: 'none',
                    top: y - 30,
                    left: x - 50,
                    color: "#fff",
                    padding: '2px 5px',
                    'border-radius': '6px',
                    'background-color': '#000',
                    opacity: 0.80
                }).appendTo("body").fadeIn(200);
            }

            var previousPoint = null;
            $("#statsChart3").bind("plothover", function (event, pos, item) {
                if (item) {
                    if (previousPoint != item.dataIndex) {
                        previousPoint = item.dataIndex;

                        $("#tooltip").remove();
                        var x = item.datapoint[0].toFixed(0),
                            y = item.datapoint[1].toFixed(0);

                        var month = item.series.xaxis.ticks[item.dataIndex].label;

                        showTooltip(item.pageX, item.pageY,
                                    item.series.label + " of " + month + ": " + y);
                    }
                }
                else {
                    $("#tooltip").remove();
                    previousPoint = null;
                }
            });
        });
</script>
