<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Recent Restarts</title>
  <link rel="stylesheet" href="css/main.min.css">
  <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
</head>

<style>
body {
        margin: 0;
        background:#ddd;
}
h2 {
        margin:5px;
}
table {
        border-collapse:collapse;
        background:#333;
        color:#BBB;
}
th {
        border-left:1px solid #000;
        border-right:1px solid #000;
        border-bottom:1px solid #000;
        color:#fe5;
}
#border {
        border-left:1px solid #000;
        border-right:1px solid #000;
        border-bottom:1px solid #000;
}
#border td {
        border-left:1px solid #000;
        border-right:1px solid #000;   
}
</style>
<?php
$host = '185.148.145.241';
$user = 'wow';
$pass = 'Maikale1234566!';
$cdb = 'characters';
 
$connect = mysql_connect($host,$user,$pass) or die('Нет подключения к базе данных');
mysql_select_db ($cdb, $connect) or die(mysql_error());
$sql = mysql_query("SET NAMES cp1251");
$sql = mysql_query("SELECT * FROM `characters` ORDER BY `totaltime` DESC LIMIT 100", $connect) or die(mysql_error());
print "<h2 align=\"center\">Топ задротов</h2>
<table cellpadding=\"1\" cellspacing=\"1\" align=\"center\" width=\"800\"><tr>
<th width=\"30\">№</th>
<th>Имя</th>
<th width=\"30\">Лвл</th>
<th width=\"120\">Раса</th>
<th width=\"120\">Класс</th>
<th width=\"100\">Сторона</th>
<th width=\"200\">Времени в игре</th>
</tr></table>";
$id = 1;
while ($result = mysql_fetch_array($sql)){
        $name = $result['name'];
        $level = $result['level'];
        $time = $result['totaltime'];
        $sec = $time%60;
        $time = intval ($time/60);
        $min = $time%60;
        $time = intval ($time/60);
        $hours = $time%24;
        $time = intval($time/24);
        $days = $time;
       
        if ($days != 0)
                $days = $days." д";
        else
                $days = "";
        if ($hours != 0)
                $hours = $hours." ч";
        else
                $hours = "";
        if ($min != 0)
                $min = $min." м";
        else
                $min = "";
       
        if ($result['race'] == 1 || $result['race'] == 3 || $result['race'] == 4 || $result['race'] == 7 || $result['race'] == 11){
                $side = 'Альянс';
                $style_side = 'blue';
        }
        else{
                $side = 'Орда';
                $style_side = 'red';
        }
       
        switch ($result['race']){
                case 1: $race = 'Человек';break;        
                case 2: $result['gender'] == 0 ? $race = 'Орк' : $race = 'Орчиха';break;                      
                case 3: $race = 'Дворф';break;
                case 4: $result['gender'] == 0 ? $race = 'Ночной эльф' : $race = 'Ночная эльфийка';break;
                case 5: $result['gender'] == 0 ? $race = 'Отрекшийся' : $race = 'Отрекшаяся';break;
                case 6: $race = 'Таурен';break;
                case 7: $race = 'Гном';break;
                case 8: $result['gender'] == 0 ? $race = 'Тролль' : $race = 'Троллиха';break;
                case 10: $result['gender'] == 0 ? $race = 'Эльф крови' : $race = 'Эльфийка крови';break;
                case 11: $result['gender'] == 0 ? $race = 'Дреней' : $race = 'Дренейка';break;
        }
               
        if ($result['class'] == 1){
                $class = 'Воин';
                $style_class = '#C79C6E';
        }
        if ($result['class'] == 2){
                $class = 'Паладин';
                $style_class = '#F58CBA';
        }
        if ($result['class'] == 3){
                $class = 'Охотник';
                $style_class = '#ABD473';
        }
        if ($result['class'] == 4){
                $class = 'Разбойник';
                $style_class = '#FFF569';
        }
        if ($result['class'] == 5){
                $class = 'Жрец';
                $style_class = '#FFFFFF';
        }
        if ($result['class'] == 6){
                $class = 'Рыцарь смерти';
                $style_class = '#C41F3B';
        }
        if ($result['class'] == 7){
                $class = 'Шаман';
                $style_class = '#0070DE';
        }
        if ($result['class'] == 8){
                $class = 'Маг';
                $style_class = '#69CCF0';
        }
        if ($result['class'] == 9){
                $class = 'Чернокнижник';
                $style_class = '#9482C9';
        }
        if ($result['class'] == 11){
                $class = 'Друид';
                $style_class = '#FF7D0A';
        }
               
        print "<table cellpadding=\"1\" cellspacing=\"1\" align=\"center\" width=\"800\" id=\"border\"><tr>
        <td align=\"center\" width=\"30\">$id</td>
        <td align=\"center\">$name</td>
        <td align=\"center\" width=\"30\">$level</td>
        <td align=\"center\" width=\"120\">$race</td>
        <td align=\"center\" width=\"120\"><font color=\"$style_class\">$class</font></td>
        <td align=\"center\" width=\"100\"><font color=\"$style_side\">$side</font></td>
        <td align=\"center\" width=\"200\">$days $hours $min $sec с</td>
        </tr></table>";
$id++;
}
mysql_close($connect);
?>

