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

    $que = "delete from $tableName where $primaryKeyName = '$primaryKeyValue'";
    $res = mysqli_query($conn, $que);
    if ($res){
        $nowtime = date("Y-m-d H:i:s");
        $logsque = "insert into logs (who,time,table_name,operation,key_value) values('" . $username . "','" . $nowtime . "','" . $tableName . "','delete','" . $primaryKeyValue . "')";
        mysqli_query($conn, $logsque);  
        echo "<script>alert('delete successfully!');history.back(1);</script>";}
    else
        echo "<script>alert('delete failed!');history.back(1);</script>";
    ?>
</body>

</html>