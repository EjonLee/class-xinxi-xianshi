<html>
<head>
    <meta http-equiv="Content-Type"content="text/html; charset=UTF-8" />
    <title>班级学生信息显示</title>
</head>
<body>
<center>班级学生信息列表</center>
<table width="340" border="1" align="center" cellpadding="0" cellspacing="1">
    <tr bgcolor="#0066CC" align="center">
        <td width="70"><font color="#FFFFFF"><b>学号</b></font></td>
        <td width="100"><font color="#FFFFFF"><b>姓名</b></font></td>
        <td width="70"><font color="#FFFFFF"><b>年龄</b></font></td>
        <td width="100"><font color="#FFFFFF"><b>班级编号</b></font></td>
    </tr>


    <?php
    include("db_conn.php");

    if(isset($_GET['pagenum'])){
        $pagenum = $_GET['pagenum'];
    }else{
        $pagenum = 1;
    }

    $pagesize = 3;

    $sql = "select * from student";
    $result = mysqli_query($conn,$sql);
    $nums = mysqli_num_rows($result);
    $pagecount = ceil($nums / $pagesize);

    $sql = "SELECT * FROM student limit ".($pagenum-1)*$pagesize.",$pagesize";
    $result = mysqli_query($conn, $sql);
    $number = mysqli_num_rows($result);
    if ($number>0) {

        for ($i = 0; $i < $number; $i++) {
            $row = mysqli_fetch_array($result);
            if ($i%2 == 0)
                echo "<tr bgcolor='#DDDDDD' align='center'>";
            else
                echo "<tr align='center'>";
            echo "<td width='70'>".$row['studentId']."</td>";
            echo "<td width='100'>".$row['studentName']."</td>";
            echo "<td width='70'>".$row['age']."</td>";
            echo "<td width='100'>".$row['class']."</td>";
            echo "</tr>";
        }
    }

    ?>
    <tr><td colspan="4" align="center">
            <?php
            if($pagenum > 1)
                echo "<a href=\"2ban.php?pagenum=1\">第一页</a>|<a href=\"2ban.php?pagenum=".($pagenum-1)."\">上一页</a> ";
            else
                echo "第一页|上一页";
            if($pagenum < $pagecount)
                echo "<a href=\"2ban.php?pagenum=".($pagenum+1)."\">下一页</a>|<a href=\"2ban.php?pagenum=".($pagecount)."\">最后一页</a>";
            else
                echo "下一页|最后一页";
            ?>
        </td></tr>
</table>

</body>
</html>
