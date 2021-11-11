<html>
	<head>
		<link rel="stylesheet" href="css/style.css" type="text/css">
	</head>
<body>
<?php
include ('include/config.php');
	// Includes connect file to connect to MySQL
	require_once('include/connect.php');
		// Selects Database
		mysql_select_db("$database") or die(mysql_error());
			// Querys the Database for data
			$name_sql = mysql_query("SELECT * FROM $char_table ORDER BY name DESC");
			while ($row = mysql_fetch_assoc($name_sql))
			{
			// Get data from database
			$guid_char = $row['guid'];
			$name = $row['name'];
			
			if($guid_char == $guid_ban) {
			echo "<td width='33%'>$name</td>"; }
			}
?>
</body>
</html>