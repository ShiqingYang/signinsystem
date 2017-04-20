<?php
/**
 * Created by PhpStorm.
 * User: yangshiqing
 * Date: 2017/4/18
 * Time: 22:18
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/footable.core.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>

    <script src="js/Alert.js"></script>
    <script type="text/javascript" src="js/jquery.jeditable.mini.js"></script>
    <script src="js/footable.all.min.js"></script>


</head>
<body>
<div class="head">
</div>
<div class="state">
    <span style="margin-left: 50px;">当前位置 > 会议管理</span>
</div>
<div class="main_content">
    <div class="edittb">
    <form name="form" id="form" action="save.php" method="post">
        <table width="1000" class="footable table table-stripped" data-page-size="5" data-filter=#filter>
            <thead>
            <tr>
                <td>编号</td>
                <td>活动主题</td>
                <td>活动地点</td>
                <td>活动时间</td>
                <td>参加人数（*数字）</td>
                <td>操作</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>+</td>
                <td><input id="insertname" type="text"></td>
                <td><input id="insertplace" type="text"></td>
                <td><input id="inserttime" type="text"></td>
                <td><input id="insertnum" type="text"></td>
                <td><input class="addbtn" type="button" value="添加"></td>
            </tr>
            <?php
            //查询活动列表
            $sqllist = "select * from sign_activitylist order by inserttime desc";
            if ($query = mysql_query($sqllist)) {
                while ($result = mysql_fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?php echo $result['sid'] ?></td>
                        <td id="activityname"><?php echo $result['activityname'] ?></td>
                        <td id="activityplace"><?php echo $result['activityplace'] ?></td>
                        <td id="activitytime"><?php echo $result['activitytime'] ?></td>
                        <td id="participationnum"><?php echo $result['participationnum'] ?></td>
                        <td><input class="editbtn" type="button" value="编辑"><input class="deletebtn" type="button" value="删除"></td>
                    </tr>
                    <?php
                }
            }
            ?>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="5">
                    <ul class="pagination pull-right"></ul>
                </td>
            </tr>
            </tfoot>
        </table>
    </form>
    </div>

</div>
<div class="footer">
    <p>天津师范大学 学生信息技术协会 &copy; 版权所有</p>
</div>
<script>
    $(function () {
        $('.addbtn').click(function () {
            var name = $('#insertname').val();
            var place=$('#insertplace').val();
            var time=$('#inserttime').val();
            var num=$('#insertnum').val();
            $.ajax({
                type: "post",
                url: 'add.php',
                dataType: "json",
                data: {"name":name,"place":place,"time":time,"num":num},
                success: function(msg){
                    Alert('会议添加成功！');
                    window.location.reload();
                }
            });
        });
        $('.editbtn').click(function () {
            //alert($(this).parent().parent().find("td").eq(0).text());
            $(this).parent().parent().find("td").addClass('edit');
            $(this).parent().removeClass('edit');
            $(this).parent().parent().find("td").eq(0).removeClass('edit');
            $('.edit').editable('save.php', {
                submitdata: {sid: $(this).parent().parent().find("td").eq(0).text()},
                width: 140,
                height: 25,
                onblur: "ignore",
                cancel: '取消',
                submit: '确定',
                indicator: "<img src='css/loader.gif'>",
                tooltip: '单击可以编辑...',
                callback: function (value, settings) {
                    $("#modifiedtime").html("刚刚");
                }

            });
        });
        $('.deletebtn').click(function () {
            if(confirm('确认删除吗？')){
            $.ajax({
                type: "post",
                url: 'delete.php',
                dataType: "json",
                data: {sid: $(this).parent().parent().find("td").eq(0).text()},
                success: function(msg){

                    window.location.reload();
                }
            });
            }
        });
        $('.footable').footable();
    });
</script>
</body>
</html>