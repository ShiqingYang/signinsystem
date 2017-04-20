<?php session_start(); ?>
<?php
/**
 * Created by PhpStorm.
 * User: yangshiqing
 * Date: 2017/4/18
 * Time: 22:19
 */
include_once 'include/conn.php' ?>
<?php
date_default_timezone_set("PRC");
?>
<?php error_reporting(E_ERROR); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>会议拍卡签到系统</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/css.css">
    <script language="JavaScript" type="text/javascript" src="js/Alert.js"></script>
    <script src="js/jquery.min.js"></script>
</head>
<body>

<div class="head">
</div>
<?php
if ($_POST['sid'] == '') {
} else {
    $_SESSION['sid'] = $_POST['sid'];
}
$sid = $_SESSION['sid'];
$sqlac = "select * from sign_activitylist where sid=" . $sid;
$query = mysql_query($sqlac);
$result = mysql_fetch_array($query);
$activityname = $result['activityname'];
?>
<div class="state">
    <span style="margin-left: 50px;">当前位置 > <a href="activityselect.php">选择会议></a> <?php echo $activityname; ?>-拍卡签到</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a
        href="hasordersignin.php" target="view_frame">已订票拍卡</a>&nbsp;&nbsp;&nbsp;<a href="notordersignin.php"
                                                                                    target="view_frame">未订票拍卡</a>
    <span id="sum" style="float: right; margin-right:50px;">0</span><span style="float: right; margin-right:10px;">已签到总人数：</span>
</div>

<div class="main_content">
    <iframe src="hasordersignin.php" frameborder="0" width="1366" height="448" name="view_frame"></iframe>
</div>
<div class="footer">
    <p>天津师范大学 学生信息技术协会 &copy; 版权所有</p>
</div>
<script>
        $.ajax({
            type: "post",
            url: 'sum.php',
            dataType: "json",
            data: {},
            success: function (msg) {
                $('#sum').html(msg);
            }
        });
</script>
</body>
</html>