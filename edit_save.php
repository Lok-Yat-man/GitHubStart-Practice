<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body>
    <?php
    ini_set('date.timezone', 'Asia/Shanghai');
    include("conn.php");
    $tableName = $_GET["tableName"];
    $primaryKeyName = $_GET["primaryKeyName"];
    $primaryKeyValue = $_GET["primaryKeyValue"];

    $que = 'update ' . $tableName . ' set ';
    $res = mysqli_query($conn, "show columns from $tableName");
    $colNum = mysqli_num_rows($res);
    for ($i = 0; $i < $colNum; $i++) {
        $colName = mysqli_fetch_array($res)[0];
        $que = $que . $colName . '="' . $_GET[$colName] . '",';
    }

    $que = substr($que, 0, strlen($que) - 1);
    $que = $que . "where $primaryKeyName = '$primaryKeyValue'";

    $res = mysqli_query($conn, $que);
    if ($res) {
        $nowtime = date("Y-m-d H:i:s");
        $logsque = "insert into logs (who,time,table_name,operation,key_value) values('" . $username . "','" . $nowtime . "','" . $tableName . "','edit','" . $primaryKeyValue . "')";
        mysqli_query($conn, $logsque);
        echo "<script>alert('edit successfully!');history.back(1);</script>";
    } else
        echo "<script>alert('edit failed!');history.back(1);</script>";
    ?>
</body>

</html>