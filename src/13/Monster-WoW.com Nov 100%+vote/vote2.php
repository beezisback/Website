<?
ob_start();
include("confv.php");
$sql = mysql_query("SELECT ctime FROM $dbtable WHERE ip=\"$ip\"");
if($row = mysql_fetch_array($sql)) {
$calc = $row['ctime'] + $vtime;
if ($calc > $time) { echo "������ �� ��������� ���� �� ������ �� 24 ����!"; }
else {
$sqlQ = mysql_query("UPDATE $dbtable SET ctime = \"$time\" WHERE ip=\"$ip\"");
header("location: $link");
}
}
else {
$sql = mysql_query("INSERT into `$dbtable`(`ip`,`ctime`) VALUES ('$ip','$time')");
header("location: $link");
}
?> 