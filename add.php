<?php
/**
 * Created by PhpStorm.
 * User: yangshiqing
 * Date: 2017/4/19
 * Time: 18:08
 */
include_once 'include/conn.php' ?>
<?php
$name = $_POST['name'];
$place = $_POST['place'];
$time = $_POST['time'];
$num = $_POST['num'];
$sql = "insert into sign_activitylist (activityname,activityplace,activitytime,participationnum) VALUES ('" . $name . "','" . $place . "','" . $time . "','" . $num . "')";
if ($query = mysql_query($sql)) {
    $msg = 1;
    echo $msg;
}