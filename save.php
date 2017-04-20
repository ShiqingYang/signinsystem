<?php include_once 'include/conn.php' ?>
<?php
$field=$_POST['id'];
$val=$_POST['value'];
$val = htmlspecialchars($val, ENT_QUOTES);
$sid=$_POST['sid'];
$time=date("Y-m-d H:i:s");
if(empty($val)){
    echo "不能为空";
}else{
	$query=mysql_query("update sign_activitylist set $field='$val' where sid=".$sid);
	if($query){
	   echo $val;
	}else{
	   echo "数据出错";	
	}
}
?>