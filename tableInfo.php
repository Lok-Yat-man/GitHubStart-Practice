<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style type="text/css">
        table{
            font-family: Arial, Helvetica, sans-serif;
            margin-top: 100px;
        }
        th{
            font-size: 20px;
            font-family: 黑体;
            background-color: rgba(0,0,255,0.7);
        }
        td{
            text-align: center;
        }
    </style>
</head>

<body>
    <form action="insert.php" method="get">
        <table align="center" rules="all" cellpadding="10px">
            <?php
            ini_set('date.timezone', 'Asia/Shanghai');
            include("conn.php");
            $tableName = $_GET["tableName"];

            echo '<h1 align="center">'. $tableName .'</h1>';
            //显示表头
            $colNames = array();
            $res = mysqli_query($conn, "show columns from $tableName");
            $colNum = mysqli_num_rows($res);
            echo "<tr>";
            for ($i = 0; $i < $colNum; $i++) {
                $attribute = mysqli_fetch_array($res);
                echo "<th>" . $attribute[0] . "</th>";
                array_push($colNames, $attribute[0]);
            }
            echo "<th>Operation</th>";
            echo "</tr>";

            //显示数据
            $res = mysqli_query($conn, "select * from $tableName");
            $rows = mysqli_num_rows($res);
            for ($i = 0; $i < $rows; $i++) {
                echo "<tr>";
                $tuple = mysqli_fetch_array($res);
                for ($j = 0; $j < count($colNames); $j++) {
                    echo "<td>" . $tuple[$colNames[$j]] . "</td>";
                }
                echo '<td><a style="text-decoration:none;" href="edit.php?tableName=' . $tableName . '&primaryKeyName=' . $colNames[0] . '&primaryKeyValue=' . $tuple[0] . '"><font color="blue">修改</font></a><br>';
                echo '<a style="text-decoration:none;" href="delete.php?tableName=' . $tableName . '&primaryKeyName=' . $colNames[0] . '&primaryKeyValue=' .  $tuple[0] . '"><font color="red">删除</font></a></td>';
                echo '</tr>';
            }

            //显示插入数据按键
            echo '<tr>';
            for ($i = 0; $i < count($colNames); $i++) {
                echo '<td><input type="text" style="height:30px;" name="' . $colNames[$i] . '"></td>';
            }
            echo '<td><input type="submit" style="height:50px;" value="Insert"></td>';
            echo '<input type="text" name="tableName" style="display:none;" value="' . $tableName . '">';
            echo '</tr>';
            ?>
        </table>
    </form>
</body>

</html>