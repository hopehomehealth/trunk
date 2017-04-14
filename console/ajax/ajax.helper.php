<? 
if($_COOKIE['CLOOTA_B2B2C_ADMIN_UUID'] != '' && $_GET['action']=='goods_detail_edit'){  
?>   
document.write('<a href="/console/?cmd=<?=$_GET['cmd']?>&goods_id=<?=$_GET['goods_id']?>" target="_blank" style="background-color:#CCFFFF;font-size:12px;padding:5px;color:red">快速编辑</a>'); 
<? 
}
?>


<? 
if($_COOKIE['CLOOTA_B2B2C_ADMIN_UUID'] != '' && $_GET['action']=='goods_catalog_edit'){  
?>   
document.write('<a href="/console/?cmd=<?=$_GET['cmd']?>&cat_id=<?=$_GET['cat_id']?>" target="_blank" style="background-color:#CCFFFF;font-size:12px;padding:5px;color:red">编辑分类</a>'); 
<? 
}
?>

<? 
if($_COOKIE['CLOOTA_B2B2C_ADMIN_UUID'] != '' && $_GET['action']=='goods_detail_add'){  
?>   
document.write('<a href="/console/?cmd=<?=$_GET['cmd']?>&cat_id=<?=$_GET['cat_id']?>" target="_blank" style="background-color:#CCFFFF;font-size:12px;padding:5px;color:red">新增产品</a>'); 
<? 
}
?>