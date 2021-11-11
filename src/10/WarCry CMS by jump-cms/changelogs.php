<table width="300" height="10" border="1">
<tr><td><a href="changelogs.php">Новини</a> | <a href="addnews.php">Добави новина</a> | <a href="newsadmin.php">АДМИН Панел</a></td></tr></table>
<form action="" method="post">
revision: <input type="text" name="revision" />
<br />
changelogs: <select name="changelog" size="1">
<option value="1">Website</option>
<option value="2">WoW Core</option>
</select> 
<br />
text: <input type="text" name="text">
<br />
author: <input type="text" name="author">
<br />
<input type="submit" name="submit" value="Добави" />
</form>
<?php
if (isset($_POST["submit"])) {
//настройки за база данни
$dbhost = "127.0.0.1";
$dbuser = "root";
$dbpass = "ascent";
$dbname = "warcry";
$conn = mysql_connect($dbhost, $dbuser, $dbpass)or die(mysql_error());
mysql_select_db($dbname, $conn)or die(mysql_error());
if (!empty($_POST["revision"])) $revision = htmlspecialchars($_POST["revision"]);
else $errMsg = "Не сте въвели име на новината!<br />";
if (!empty($_POST["changelog"])) $changelog = htmlspecialchars($_POST["changelog"]);
else $errMsg = "Не сте въвели новината!<br />";
if (!empty($_POST["text"])) $text = htmlspecialchars($_POST["text"]);
else $errMsg = "Не сте въвели новината!<br />";
if (!empty($_POST["author"])) $author = htmlspecialchars($_POST["author"]);
else $errMsg = "Не сте въвели новината!<br />";
if (empty($errMsg)) {
$insert = mysql_query("INSERT INTO changelogs(revision, changelog, text, author) VALUES('$revision', '$changelog', '$text', '$author')")or die(mysql_error());
echo 'Новината е добавена успешно! <a href="index.php">Новини</a>';
} else echo $errMsg;
mysql_close();
}
?> 