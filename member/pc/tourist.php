<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}  
?> 

<div class="bar_title">
	<strong>�����ο�</strong>
</div> 

<script language="javascript"> 
//���ڱ������һ��
function addNewRow(){
   var tabObj=document.getElementById("myTab");//��ȡ������ݵı��
   var rowsNum = tabObj.rows.length;  //��ȡ��ǰ����
   var colsNum=tabObj.rows[rowsNum-1].cells.length;//��ȡ�е�����
   var myNewRow = tabObj.insertRow(rowsNum);//��������
   var newTdObj1=myNewRow.insertCell(0);
   newTdObj1.innerHTML="<input type='checkbox' name='chkArr' id='chkArr'"+rowsNum+" style='width:20px' />";
   var newTdObj2=myNewRow.insertCell(1);
   newTdObj2.innerHTML="<input type='text' name='name[]' id='nodecode'"+rowsNum+" style='width:150px' required />";
   var newTdObj3=myNewRow.insertCell(2);
   newTdObj3.innerHTML="<input type='text' name='idcard[]' id='nodename'"+rowsNum+" style='width:250px' required />";
   var newTdObj4=myNewRow.insertCell(3);
   newTdObj4.innerHTML="<input type='number' name='age[]' id='nodeper'"+rowsNum+" style='width:80px' />";
}

//���ڱ��ɾ��һ��
function removeRow(){
   var chkObj=document.getElementsByName("chkArr");
   var tabObj=document.getElementById("myTab");
   for(var k=0;k<chkObj.length;k++){
    if(chkObj[k].checked){
     tabObj.deleteRow(k+1);
     k=-1;
    }
   }
}
</script>

<input type="button" name="xx" onclick="addNewRow();" value="����һ��" class="btn btn-small btn-warning"/>
<input type="button" name="yy" onclick="removeRow();" value="ɾ��" class="btn btn-small"/>

<form id="myform" method="post" action="do?ac=tourist_add"> 
<table class="table table-bordered" id="myTab" style="margin-top:10px">
	<tr>
		<td width="50" align="center" >ID</td>
        <td align="center" >���� *</td>
        <td align="center" >���֤ *</td>
        <td align="center" >����</td>
	</tr>
	<?
	if(notnull($rows)){
		foreach ($rows as $val){ 
	?>
	<tr>
		<td><input type="checkbox" name="chkArr" id="chkArr" style="width:20px"></td>
		<td><input type="text" name="name[]" id="nodecode" style="width:150px"  value="<?=$val['user_name']?>" required></td>
		<td><input type="text" name="idcard[]" id="nodename" style="width:250px"  value="<?=$val['user_idcard']?>" required></td>
		<td><input type="number" name="age[]" id="nodeper" value="<?=$val['user_age']?>" style="width:80px"></td>
	</tr>
	<?
		}
	}
	?>
</table>
<input type="hidden" name="order_code" value="<?=req('order_code')?>">
<input type="hidden" name="order_id" value="<?=req('order_id')?>"> 
<input type="submit" value="����" class="btn btn-info">
</form>

<?if(req('tour_num')!=''){?>
<script type="text/javascript">
for(var i=1; i<=<?=req('tour_num')?>; i++){
	addNewRow();
}
</script>
<?}?>