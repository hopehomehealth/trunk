<?
$db->check_cookie($loginUrl,$host);
//��ȡ����
$lvGoodsName = urldecode($_GET['lvGoodsName']);
$ticketTypeName = urldecode($_GET['ticketTypeName']);
$isEmail = req('isEmail');
$isCredentials = req('isCredentials');
$goodsId = req('goodsId');
$lvProductId = req('lvProductId');
$lvGoodsId = req('lvGoodsId');
$ticketType = req('ticketType');

// ��ȡԤ������url
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