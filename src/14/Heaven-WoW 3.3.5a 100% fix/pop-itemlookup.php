<?php
require "include/common.php";
if (!defined('AXE'))
	exit;
//if session set, then we shoudlnt be here
if (!$a_user['is_guest'] && $a_user[$db_translation['gm']]==$db_translation['az'])  
{ 
	?>
	<html><head><title>Item Look-up</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link href="styles/default/style-popup.css" rel="stylesheet" type="text/css">
    </head><body>
    
    <div align="center">
    <div class="pop-inside-box" align="left">
	<form action="" method="post">
	Item name:<br/>
	<input name="name" type="text">
	<div id="log-b3"><input name="action" type="submit" value="Search"></div>
	</form>
	<?php
	if (isset($_POST['action']))
	{
		//worl database
		try 
		{
			//Construct PDO
			$PDO = new PDO('mysql:dbname='.$item_db.'; host='.$db_host.';', $db_user, $db_pass, NULL);
			//set error handler exception
			$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);		
			//set default fetch method
			$PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			//set encoding
			$PDO->query("SET NAMES '".$db_encoding."'");
		}
		catch (PDOException $e)
		{
			echo '<strong>Database Connection to the Account Database failed:</strong> ' . $e->getMessage();
			die;
		}
		
		$name = $_POST['name'];
		
		$res = $PDO->prepare("SELECT ".$db_translation['items_entry'].", ".$db_translation['items_name1'].", ".$db_translation['items_quality']." FROM `".$db_translation['items']."` WHERE `".$db_translation['items_name1']."` = :name LIMIT 1");
		$res->bindParam(':name', $name, PDO::PARAM_STR);
		$res->execute();
		
		if ($res->rowCount() == 0)
		{
			//search similar
			$res2 = $PDO->prepare("SELECT ".$db_translation['items_entry'].", ".$db_translation['items_name1'].", ".$db_translation['items_quality']." FROM `".$db_translation['items']."` WHERE `".$db_translation['items_name1']."` LIKE CONCAT('%', :name, '%') LIMIT 50");
			$res2->bindParam(':name', $name, PDO::PARAM_STR);
			$res2->execute();
			
			print "Item not found, printing similar results <i>(50 max)</i>:<br><br>";
			
			while ($b1 = $res2->fetch(PDO::FETCH_ASSOC))
			{
				if ($b1[$db_translation['items_quality']]=='0')
					$color="gray";
				elseif ($b1[$db_translation['items_quality']]=='1')
					$color="white";
				elseif ($b1[$db_translation['items_quality']]=='2')
					$color="lime";
				elseif ($b1[$db_translation['items_quality']]=='3')
					$color="#7E90FF";
				elseif ($b1[$db_translation['items_quality']]=='4')
					$color="#D584FF";
				elseif ($b1[$db_translation['items_quality']]=='5')
					$color="orange";
				print 'ID: <strong>'.$b1[$db_translation['items_entry']].'</strong> <font color="'.$color.'">['.$b1[$db_translation['items_name1']].']</font><br>';
			}
			unset($res2);
		}
		else
		{
			$a1 = $res->fetch(PDO::FETCH_ASSOC);
			if ($a1[$db_translation['items_quality']]=='0')
				$color="gray";
			elseif ($a1[$db_translation['items_quality']]=='1')
				$color="white";
			elseif ($a1[$db_translation['items_quality']]=='2')
				$color="lime";
			elseif ($a1[$db_translation['items_quality']]=='3')
				$color="#7E90FF";
			elseif ($a1[$db_translation['items_quality']]=='4')
				$color="#D584FF";
			elseif ($a1[$db_translation['items_quality']]=='5')
				$color="orange";
			else
				$color="gray";
			
			print 'ID: <strong>'.$a1[$db_translation['items_entry']].'</strong> <font color="'.$color.'">['.$a1[$db_translation['items_name1']].']</font><br>';
		}
		unset($res);
	}
}
?>

</div>
</div>
</body></html>