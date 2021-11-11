<?php
/***********************************************************************
	Copyright (C) AXE
************************************************************************/
// Make sure no one attempts to run this script "directly"
if (!defined('AXE'))
	exit;

//Setup the new Database Object PDO
//web database
try 
{
	//Construct PDO
	$WEB_PDO = new PDO('mysql:dbname='.$db_name.'; host='.$db_host.';', $db_user, $db_pass, NULL);
	//set error handler exception
	$WEB_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);		
	//set default fetch method
	$WEB_PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	//set encoding
	$WEB_PDO->query("SET NAMES '".$db_encoding."'");
}
catch (PDOException $e)
{
	echo '<strong>Database Connection to the Web Database failed:</strong> ' . $e->getMessage();
	die;
}
//acc database
try 
{
	//Construct PDO
	$ACC_PDO = new PDO('mysql:dbname='.$acc_db.'; host='.$db_host.';', $db_user, $db_pass, NULL);
	//set error handler exception
	$ACC_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);		
	//set default fetch method
	$ACC_PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	//set encoding
	$ACC_PDO->query("SET NAMES '".$db_encoding."'");
}
catch (PDOException $e)
{
	echo '<strong>Database Connection to the Account Database failed:</strong> ' . $e->getMessage();
	die;
}

//An function to return PDO connection to a Realm Database
function newRealmPDO($realmid)
{
  global $realm, $db_host, $db_user, $db_pass, $db_encoding;
  	
	//if the realms config is array and the realm is set
	if (is_array($realm) and isset($realm[$realmid]))
	{
		//make the connection
		$config = $realm[$realmid];
		
		try 
		{
			//Construct PDO
			$obj = new PDO('mysql:dbname='.$config['db'].'; host='.$db_host.';', $db_user, $db_pass, NULL);
			//set error handler exception
			$obj->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);		
			//set default fetch method
			$obj->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			//set encoding
			$obj->query("SET NAMES '".$db_encoding."'");
		}
		catch (PDOException $e)
		{
			echo '<strong>Database Connection to the Realm Database failed:</strong> ' . $e->getMessage();
			die;
		}
		
		return $obj;
	}
	else
	{
		return false;
	}
}
