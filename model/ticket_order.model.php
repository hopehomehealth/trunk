<?
$db->check_cookie($loginUrl,$host);
//获取参数
$lvGoodsName = urldecode($_GET['lvGoodsName']);
$ticketTypeName = urldecode($_GET['ticketTypeName']);
$isEmail = req('isEmail');
$isCredentials = req('isCredentials');
$goodsId = req('goodsId');
$lvProductId = req('lvProductId');
$lvGoodsId = req('lvGoodsId');
$ticketType = req('ticketType');

// 获取预定界面url
$urll = $db->getUrl();
$_SESSION['urll'] = $urll;

function seo()
{
    global $g_sitename, $c_goods;
    ?>
    <meta name="keywords" content="<?= $c_goods['goods_name'] ?>"/>
    <meta name="description"
          content="<?= $c_goods['goods_name'] ?> <?= str_replace("\n", "", removehtml($c_goods['summary'])) ?> "/>
    <?
}

?>