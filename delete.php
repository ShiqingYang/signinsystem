<?php
/**
 * Created by PhpStorm.
 * User: yangshiqing
 * Date: 2017/4/19
 * Time: 18:08
 */
include_once 'include/conn.php' ?>
<?php
$sid = $_POST['sid'];
$sql = "delete from sign_activitylist where sid='" . $sid . "'";
if ($query = mysql_query($sql)) {
    $msg = 1;
    echo $msg;
}