<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style type="text/css">
        table{
            font-family: Arial, Helvetica, sans-serif;
            width: 400px;
            margin-top: 100px;
        }
        th{
            font-size: 25px;
            font-family: 黑体;
            background-color: rgba(0,0,255,0.7);
            padding: 20px;
            border-radius: 15px;
        }
        td{
            font-size: 18px;   
            font-weight: bold;
            color: black;
            padding: 15px;
            border: 1px thick;
            border-radius: 15px;
        }
        a{
            display: block;
            text-decoration: none;
        }
        td:hover{
            background-color: green;
        }
    </style>
</head>

<body>
    <table align="center">
        <?php
        ini_set('date.timezone', 'Asia/Shanghai');
        include("conn.php");

        $res = mysqli_query($conn, "show tables from database2020152055");
        if (!$res)
            die("no tables");

        echo '<tr><th>Tables in database2020152055:</th></tr>';
        $row = mysqli_num_rows($res);
        for ($i = 0; $i < $row; $i++) {
            $dbrow = mysqli_fetch_array($res);
            $tableName = $dbrow[0];
            $tr = '<a href="tableInfo.php?tableName=' . $tableName . '">' . $tableName . '</a>';
            echo "<tr><td>" . $tr . "</td></tr>";
        }
        ?>
    </table>
    <style>
        td {
            text-align: center;
        }
    </style>
</body>

</html>