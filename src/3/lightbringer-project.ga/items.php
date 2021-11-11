<style>
#item { font-size: 18px; }
.autocomplete-w1 {margin:7px 6px 6px 18px; /* IE6 fix: */ _background:none; _margin:1px 0 0 0; }
.autocomplete { background:#FFF; cursor:default; text-align:left; max-height:350px; overflow:auto; margin:-6px 6px 6px -6px; /* IE6 specific: */ _height:350px;  _margin:0; _overflow-x:hidden; }
.autocomplete .selected { background:#202020; }
.autocomplete div { padding:2px 5px; white-space:nowrap; overflow:hidden; border: 1px dashed grey; background: #181818;}
.autocomplete strong { font-weight:bold; }
.A:link { text-decoration:none;}
#disabled {
   pointer-events: none;
   cursor: default;
}
</style>
<?php
include "config.php";
mysql_select_db("realmd") or die(mysql_error());
if(isset($_POST['queryString'])) {
if($_POST['queryString']){
$lookupitems = htmlspecialchars(mysql_real_escape_string(strip_tags($_POST['queryString'])));  
$query = "SELECT * FROM vote_items WHERE name LIKE '$lookupitems%' AND `show` = 'yes' AND realm = '1' OR name LIKE '$lookupitems%' AND `show` = 'yes' AND realm = '1' ORDER BY name , entry ASC LIMIT 1";
$result = mysql_query($query) or die("There is an error in database");
while($row = mysql_fetch_array($result)){
echo '<div class="new_vote_searchdiv">';    
//echo"<d class='q".$row['Quality']."'  href='http://www.wowhead.com/?item=".$row['entry']."'onclick='return false' onClick='fill(\'".$row['name']."\');>".$row['name']."</a></td>";
echo '<a class="q'.$row['Quality'].'" style="text-decoration:none; cursor: default;" href="http://classic.cavernoftime.com/item='.$row['entry'].'" onclick="return false"><spam onClick="fill(\''.$row['name'].'\');">'.$row['name'].'</spam></a>';
echo'</div>';                               
}
}
}
?>