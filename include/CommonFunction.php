<?php 

function getClassNameByStuNum($stunum) { 
	$sql = "select * from db_class where classId in (select classId from db_student where stunum = '".$stunum."')";
	if($query = mysql_query($sql)){
		$result = mysql_fetch_array($query);
		if(!empty($result['className'])){
			$className = $result['className'];
		}
	}
	return $className; 
}



?>