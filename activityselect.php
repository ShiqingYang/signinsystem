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
</head>
<body>
<div class="head">
</div>
<div class="state">
    <span style="margin-left: 50px;">当前位置 > 选择会议</span>
</div>
<div class="main_content">
    <div class="select">
    <form name="formstunum" id="formstunum" action="activitysignin.php" method="post">
        <span class="signfont">选择签到会议：</span>
        <select name = "sid" style="width: 300px; height: 30px; font-size: 14px;">
            <?php
            $sqllist="select * from sign_activitylist order by inserttime desc";
            if($query=mysql_query($sqllist)) {
                while ($result = mysql_fetch_array($query)) {
                    ?>
                    <option
                        value="<?php echo($result["sid"]); ?>"><?php echo($result["activityname"]);echo("——"); echo($result['activitytime']) ?></option>
                    <?php
                }
            }
            ?>
        </select>
        <input type="hidden" name = "ac" value="ac" >
        <input style="margin-left:20px; width: 80px; height: 30px; font-size: 14px;" type="submit" value="提交" />
    </form>
    </div>
</div>
<div class="footer">
    <p>天津师范大学 学生信息技术协会 &copy; 版权所有</p>
</div>
</body>
</html>