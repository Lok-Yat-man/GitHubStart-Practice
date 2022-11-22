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
    <form action="edit_save.php" method="get">
        <table align="center" rules="all" cellpadding="10px">
            <?php
            ini_set('date.timezone', 'Asia/Shanghai');
            include("conn.php");

            if (!isset($_GET["tableName"])) die("loss key infomation");
            if (!isset($_GET["primaryKeyName"])) die("loss key infomation");
            if (!isset($_GET["primaryKeyValue"])) die("loss key infomation");

            $tableName = $_GET["tableName"];
            $primaryKeyName = $_GET["primaryKeyName"];
            $primaryKeyValue = $_GET["primaryKeyValue"];

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

            $res0 = "select * from $tableName where $primaryKeyName='$primaryKeyValue'";
            $res = mysqli_query($conn, $res0);
            if (!$res)
                die("NOT FOUND");
            $tuple = mysqli_fetch_assoc($res);

            echo "<tr>";
            for ($i = 0; $i < count($colNames); $i++) {
                echo '<td><input type="text" name="' . $colNames[$i] . '" style="height:30px;" value="' . $tuple[$colNames[$i]] . '"></input></td>';
            }
            echo "<td><input type ='submit' style='height:50px;' value='Submit'></td>";
            echo '</tr>';

            echo '<input type="text" name = "tableName" style = "display:none;" value = "' . $tableName . '">';
            echo '<input type="text" name = "primaryKeyName" style = "display:none;" value = "' . $primaryKeyName . '">';
            echo '<input type="text" name = "primaryKeyValue" style = "display:none;" value = "' . $primaryKeyValue . '">';
            ?>
        </table>
    </form>
</body>

</html>