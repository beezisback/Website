<?php 
include ('include/config.php');
?>
<html>
	<head>
		<link rel="stylesheet" href="css/style.css" type="text/css">
		<title><?php echo "$title"; ?></title>
	</head>
<body>
	<div id="container">
		<div id="desc">
			<ul id="desc">
				<li class="desc">Name</li>
				<li class="desc">Banned By</li>
				<li class="desc">Ban Reason</li>
			</ul>
		</div>
		<?php
		// Includes connect file to connect to MySQL
		require_once('include/connect.php');
			// Selects Database
			mysql_select_db("$database") or die(mysql_error());
				// Querys the Database for data
				$ban_sql = mysql_query("SELECT * FROM $table ORDER BY unbandate DESC");
				
				if($ban_sql) {
				while ($row = mysql_fetch_assoc($ban_sql))
				{
			
				// Get data from database
				$guid_ban = $row['guid'];
				$bannedby = $row['bannedby'];
				$banreason = $row['banreason'];
				$active = $row['active'];
				
				echo "<div id='list'>";
				if($active == 1) {
				echo "<table width='95%'>";
				echo "<tr>";
				include ('check.php');
				echo "<td width='33%'>$bannedby</td>";
				echo "<td width='33%'>$banreason</td><br>";
				echo "</tr>";
				echo "</table>"; }
				echo "</div>";
				}	}
				
				echo "<br><br><div id='copyright'><span class='copyright'>$copyright $author</span></div>";
		?>
	</div>
</body>
</html>