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
    <link rel="stylesheet" href="css/css.css">
    <script language="JavaScript" type="text/javascript" src="js/Alert.js"></script>
    <script language="JavaScript" type="text/javascript" src="js/jquery.min.js"></script>
    <script language="javascript" type="text/javascript">
        function play_click(url) {
            var div = document.getElementById('div1');
            div.innerHTML = '<embed src="' + url + '" loop="0" autostart="true" hidden="true"></embed>';
            var emb = document.getElementsByTagName('EMBED')[0];
        }
    </script>
</head>
<body onload="formstunum.stuNum.focus()">
<div id="div1"></div>
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
$stunum = substr($_POST['stuNum'], 0, 10);
$time = date("Y-m-d H:i:s");
if ($stunum) {
    //echo $stunum;
    $sqlSelectStuinfo = "select * from stu_stubaseinfo where stunum='" . $stunum . "'";
    $queryStuinfo = mysql_query($sqlSelectStuinfo);
    if ($resultStuinfo = mysql_fetch_array($queryStuinfo)) {
        $collegeid = $resultStuinfo['collegeid'];
        $stuname = $resultStuinfo['name'];

        $sqlInsert = "insert into sign_record(sid,stunum,isorder) values ('" . $sid . "','" . $stunum . "',0)";
        //echo $sqlInsert;
        if ($queryInsert = mysql_query($sqlInsert)) {
            $rsInsert = mysql_fetch_array($queryInsert);
            $sqlSelectCollegename = "select collegename from stu_collegelist where collegeid=" . $collegeid;
            //echo $sqlSelectCollegename;
            if ($querySelectCollegename = mysql_query($sqlSelectCollegename)) {
                $resultSelectCollegename = mysql_fetch_array($querySelectCollegename);
                $collegename = $resultSelectCollegename['collegename'];
                //echo $collegename;
                echo "<script>play_click('audio/success.wav');</script>";
                echo "<script>Alert('签到成功!'+'<br>'+'会议：'+'" . $activityname . "'+'<br>'+'学号：'+'" . $stunum . "'+'<br>'+'姓名：'+'" . $stuname . "'+'<br>'+'学院：'+'" . $collegename . "'+'<br>'+'签到时间：'+'" . $time . "');</script>";

            }
        }
    } else {
        echo "<script>Alert('此学号不存在，请重新刷卡！');</script>";
        echo "<script>play_click('audio/fail.wav');</script>";
    }
}
?>
<div class="notorder">
    <form name="formstunum" id="formstunum" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <span class="signfont">未订票同学拍卡：&nbsp;</span>
        <input style="font-size: 25px; line-height: 30px;" name="stuNum"
               type="text" autocomplete="off">
    </form>
    <br>
    <span style="">签到人数：</span><span id="sum" style="">0</span>&nbsp;&nbsp;&nbsp;<span style="color:#ff9a1c">*请确保每人仅成功拍卡1次</span>
</div>
<script>
    $.ajax({
        type: "post",
        url: 'sumnot.php',
        dataType: "json",
        data: {},
        success: function (msg) {
            $('#sum').html(msg);
        }
    });
</script>
</body>
</html>