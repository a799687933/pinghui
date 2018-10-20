<?php  
$con = mysql_connect("localhost","root","Aj101001");
mysql_select_db("hejiang", $con);
mysql_query("UPDATE hjmall_order SET is_pay = '1'
WHERE id = '".$_GET['order_id']."'");
?>

