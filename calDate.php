<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style type="text/css">
        h1{
            font-family: 'Arima Madurai', cursive;
            color: black;
            font-size: 4rem;
            letter-spacing: -3px;
            text-shadow: 0 1px 1px rgba(255,255,255,0.6);
            position: relative;
            z-index: 3;
			margin: 20px;
        }
        p{
            text-align: center;
            font-family: Arial;
            font-size: 20px;
            margin: 10px;
        }
    </style>
</head>

<body>
    <div style="margin-top: 100px;">
    <?php
    ini_set('date.timezone', 'Asia/Shanghai');
    $nowtime = date_create(date("Y-m-d"));
    $winterHoliday = date_create("2022-01-15");
    $diff = date_diff($winterHoliday, $nowtime, FALSE);

    echo '<h1 align="center">今日：'. date_format($nowtime, "Y/m/d"). "</h1><br>";
    echo '<p align="center">寒假日期：2022/01/15';
    echo '<p align="center">相差天数：'.$diff->format("%a days").'</p>';
    ?>
    </div>
</body>

</html>