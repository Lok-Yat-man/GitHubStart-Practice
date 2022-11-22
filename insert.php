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

    $res = mysqli_query($conn, "show columns from $tableName");
    $colNum = mysqli_num_rows($res);
    $colNames = array();
    $que = "insert into $tableName (";
    for ($i = 0; $i < $colNum; $i++) {
        $colName = mysqli_fetch_array($res)[0];
        array_push($colNames, $colName);
        $que .= $colName . ',';
    }
    $que = substr($que, 0, strlen($que) - 1);
    $que .= ") values (";
    for ($i = 0; $i < count($colNames); $i++) {
        $colName = $colNames[$i];
        $que .= "'" . $_GET[$colName] . "',";
    }
    $que = substr($que, 0, strlen($que) - 1);   // 去掉,号
    $que = $que . ")";
    //echo $que;

    $res = mysqli_query($conn, $que);
    if ($res) {
        $nowtime = date("Y-m-d H:i:s");
        $logsque = "insert into logs (who,time,table_name,operation,key_value) values('" . $username . "','" . $nowtime . "','" . $tableName . "','insert','" . $_GET[$colNames[0]] . "')";
        mysqli_query($conn, $logsque);  
        echo "<script>alert('insert successfully!');history.back();location.reload();</script>";
    } else
        echo "<script>alert('insert failed!');history.back(1);</script>";
    ?>
</body>

</html>