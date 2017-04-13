<?
$db->check_cookie($loginUrl, $host);

$orderno = $_SESSION['orderCode'];
$lvGoodsName = $_SESSION['lvGoodsName'];
$ways = $_SESSION['ways'];


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