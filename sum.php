<?php session_start(); ?>
<?php
/**
 * Created by PhpStorm.
 * User: yangshiqing
 * Date: 2017/4/19
 * Time: 18:08
 */
include_once 'include/conn.php' ?>
<?php
$sid = $_SESSION['sid'];
$sql = "SELECT COUNT(*) sum from sign_record where sid=" . $sid;
if ($query = mysql_query($sql)) {
    $result = mysql_fetch_array($query);
    $msg = $result['sum'];
    echo $msg;
}