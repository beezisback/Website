<?php
/* Created By Amin Mahmoudi (Amin.MasterkinG)
 * Website : Lastwow.ga
 * Email : csprobgwebsite@abv.bg
 * Project : Lastwow Admin Panel DB Editor - One File with PHP
 * Version : 4.0 - 01/12/2018
 */
define('mysql_HOST','127.0.0.1'); // Your MySQL HOST
define('mysql_PORT','3306'); // Your MySQL HOST PORT
define('mysql_USER','root'); // Your MySQL USER
define('mysql_PASS','ascent'); // Your MySQL PASS
define('mysql_WORLDB','hellw2'); // Your MySQL Game World DB
define('mysql_AUTHDB','authhell'); // Your MySQL Game Auth DB
define('mysql_CHARDB','charhell'); // Your MySQL Game Characters DB
define('mysql_schdn','information_schema'); // Your MySQL Schema Information DB
define('mkng_tdb_username','yexs'); // Username for Login
define('mkng_tdb_password','treibal2123'); // Password for Login
define('Output_TYPE','1'); // 1 = Create on DB, 2 = Print Output SQL [NOT insert to DB]
ob_start();
ob_clean();
session_start();
$db = mysqli_connect(mysql_HOST,mysql_USER,mysql_PASS,mysql_WORLDB,mysql_PORT) or die("DB Connection ERROR");
$db2 = mysqli_connect(mysql_HOST,mysql_USER,mysql_PASS,mysql_schdn,mysql_PORT) or die("MySQL Information Sechma Connection ERROR");
$db_auth = mysqli_connect(mysql_HOST,mysql_USER,mysql_PASS,mysql_AUTHDB,mysql_PORT) or die("Auth DB Connection ERROR");
$db_char = mysqli_connect(mysql_HOST,mysql_USER,mysql_PASS,mysql_CHARDB,mysql_PORT) or die("Chars DB Connection ERROR");
$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://". $_SERVER['HTTP_HOST'] . $uri_parts[0];;
$message = "";
$tab = 1;
$item_data = array();
$db_item_template = array();
$db_auth_account = array();
$db_auth_accounts_more = array();
$res1 = mysqli_query($db2,"SELECT `COLUMN_NAME`,`DATA_TYPE` FROM COLUMNS WHERE `TABLE_NAME`='item_template' AND `TABLE_SCHEMA`='".mysql_WORLDB."'");
$res_authacc = mysqli_query($db2,"SELECT `COLUMN_NAME`,`DATA_TYPE` FROM COLUMNS WHERE `TABLE_NAME`='account' AND `TABLE_SCHEMA`='".mysql_AUTHDB."'");
$res_authvp = mysqli_query($db2,"SELECT `COLUMN_NAME`,`DATA_TYPE` FROM COLUMNS WHERE `TABLE_NAME`='accounts_more' AND `TABLE_SCHEMA`='".mysql_AUTHDB."'");
function create_SELECTOPTION_html($data,$select = false){
    $output = "";
    if(!empty($data))
    {
        if(is_array($data))
        {
            $select_ARR = array();
            if(!empty($select))
            {
                $select_ARR = explode(",",$select);
            }
            foreach ($data as $key =>$val)
            {
                $output .= "<option value='$key'";
                if (in_array($key,$select_ARR))
                {
                    $output .= " selected='selected'";
                }
                $output .= ">$val</option>";
            }
        }
    }
    return $output;
}
$db_item_template2 = array();
$db_auth_account2 = array();
$db_auth_accounts_more2 = array();
while($row = mysqli_fetch_array($res1))
{
    $type = "text";
    if($row["DATA_TYPE"] == 'int' || $row["DATA_TYPE"] == 'tinyint' || $row["DATA_TYPE"] == 'mediumint' || $row["DATA_TYPE"] == 'bigint' || $row["DATA_TYPE"] == 'smallint' || $row["DATA_TYPE"] == 'float')
    {
        $type = "number";
    }
    $db_item_template2[$row["COLUMN_NAME"]] = $type;
    array_push($db_item_template,array("type"=>$type,"name"=>$row["COLUMN_NAME"]));
}
while($row = mysqli_fetch_array($res_authacc))
{
    $type = "text";
    if($row["DATA_TYPE"] == 'int' || $row["DATA_TYPE"] == 'tinyint' || $row["DATA_TYPE"] == 'mediumint' || $row["DATA_TYPE"] == 'bigint' || $row["DATA_TYPE"] == 'smallint' || $row["DATA_TYPE"] == 'float')
    {
        $type = "number";
    }
    $db_auth_account2[$row["COLUMN_NAME"]] = $type;
    array_push($db_auth_account,array("type"=>$type,"name"=>$row["COLUMN_NAME"]));
}
while($row = mysqli_fetch_array($res_authvp))
{
    $type = "text";
    if($row["DATA_TYPE"] == 'int' || $row["DATA_TYPE"] == 'tinyint' || $row["DATA_TYPE"] == 'mediumint' || $row["DATA_TYPE"] == 'bigint' || $row["DATA_TYPE"] == 'smallint' || $row["DATA_TYPE"] == 'float')
    {
        $type = "number";
    }
    $db_auth_accounts_more2[$row["COLUMN_NAME"]] = $type;
    array_push($db_auth_accounts_more,array("type"=>$type,"name"=>$row["COLUMN_NAME"]));
}
if(!empty($_SESSION["login"]))
{
    if(!empty($_GET["logout"]))
    {
        unset($_SESSION["login"]);
        header("location:".$actual_link);
    }
    if(!empty($_GET["item"]))
    {
        $tab = 2;
        if(is_numeric($_GET["item"]))
        {
            $itemid = mysqli_real_escape_string($db,$_GET["item"]);
            $item_tmp_data = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM item_template WHERE entry = '$itemid'"));
            if(!empty($item_tmp_data["entry"]))
            {
                $item_data =  $item_tmp_data;
            }
        }
    }
    if(!empty($_POST['itemSBT']) && !empty($_POST['entry']) && !empty($_POST['name']))
    {
        $tab = 2;
        $item_data =  $_POST;
        $INSERT_QUERYv = '';
        $INSERT_QUERYk = '';
        $UPDATE_QUERY = '';
        foreach($_POST as $k => $v)
        {
            if($k == 'itemSBT')
            {
                continue;
            }
            if(array_key_exists($k,$db_item_template2))
            {
                if(!is_numeric($v) && $db_item_template2[$k] == "number")
                {
                    $error1 = 1;
                    echo '<script>alert("Value of '.$k.' is not number!");</script>';
                }
                $UPDATE_QUERY .= ", $k = '".mysqli_real_escape_string($db,$v)."'";
                $INSERT_QUERYv .= ",'".mysqli_real_escape_string($db,$v)."'";
                $INSERT_QUERYk .= ",".mysqli_real_escape_string($db,$k);
            }
        }
        if(empty($error1))
        {
            $UPDATE_QUERY = trim($UPDATE_QUERY,",");
            $INSERT_QUERYv = trim($INSERT_QUERYv,",");
            $INSERT_QUERYk = trim($INSERT_QUERYk,",");
            $itemid = mysqli_real_escape_string($db,$_POST["entry"]);
            $item_tmp_data = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM item_template WHERE entry = '$itemid'"));
            if(!empty($item_tmp_data["entry"]))
            {
                $query = "UPDATE item_template SET $UPDATE_QUERY WHERE entry = '$itemid'";
            }else{
                $query = "INSERT INTO item_template ($INSERT_QUERYk) VALUES ($INSERT_QUERYv)";
            }
            if(Output_TYPE == 1)
            {
                mysqli_query($db,$query);
                if(!empty($item_tmp_data["entry"]))
                {
                    $message = "<div class='row'><div class='alert alert-info'>Item has been updated.</div></div>";
                }else{
                    $message = "<div class='row'><div class='alert alert-success'>Item has been added.</div></div>";
                }
            }else{
                if(!empty($item_tmp_data["entry"]))
                {
                    $message = "<div class='row'><div class='alert alert-info'>Item update SQL query : <BR><textarea rows='1' cols='80'>$query</textarea></div></div>";
                }else{
                    $message = "<div class='row'><div class='alert alert-success'>Item add SQL query : <BR><textarea rows='1' cols='80'>$query</textarea></div></div>";
                }

            }
        }
    }
    if(!empty($_GET["delitem"]))
    {
        if(is_numeric($_GET["delitem"]))
        {
            $itemid = mysqli_real_escape_string($db,$_GET["delitem"]);
            $query = "DELETE FROM item_template WHERE entry = '$itemid'";
            if(Output_TYPE == 1)
            {
                mysqli_query($db,$query);
                $message = "<div class='row'><div class='alert alert-danger'>Item has been removed.</div></div>";
            }else{
                $message = "<div class='row'><div class='alert alert-danger'>Item Remove SQL query : <BR><textarea rows='1' cols='80'>$query</textarea></div></div>";
            }

        }
    }
	if(!empty($_POST["acc_search"]) || !empty($_GET["acc"]))
	{
		$tab = 3;
		if(!empty($_GET["acc"]))
		{
			if(is_numeric($_GET["acc"]))
			{
				$acc_id = strtolower(mysqli_real_escape_string($db,$_GET["acc"]));
				$result = mysqli_query($db_auth,"SELECT * FROM account WHERE account_id = '$acc_id'");
				$acc_edit_data = mysqli_fetch_array($result);
				if(!empty($_POST['accSBT']) && !empty($acc_edit_data['account_id']))
				{
					$tab = 3;
					$item_data =  $_POST;
					$UPDATE_QUERY = '';
					foreach($_POST as $k => $v)
					{
						if($k == 'accSBT' || $k == 'account_id' || $k == 'username')
						{
							continue;
						}
						if($k == 'sha_pass_hash' && !empty($v))
						{
							$v = strtoupper(sha1(strtoupper($acc_edit_data['username']) . ":" . strtoupper($v)));;
						}elseif($k == 'sha_pass_hash'){
							continue;
						}
						
						if(array_key_exists($k,$db_auth_account2))
						{
							if(!is_numeric($v) && $db_auth_account2[$k] == "number")
							{
								$error1 = 1;
								echo '<script>alert("Value of '.$k.' is not number!");</script>';
							}
							$UPDATE_QUERY .= ", $k = '".mysqli_real_escape_string($db,$v)."'";
						}
					}
					if(empty($error1))
					{
						$UPDATE_QUERY = trim($UPDATE_QUERY,",");
						$query = "UPDATE account SET $UPDATE_QUERY WHERE account_id = '$acc_id'";
						if(Output_TYPE == 1)
						{
							mysqli_query($db_auth,$query);
							$message = "<div class='row'><div class='alert alert-info'>Account has been updated.</div></div>";
							$result = mysqli_query($db_auth,"SELECT * FROM account WHERE account_id = '$acc_id'");
							$acc_edit_data = mysqli_fetch_array($result);
						}else{
							$message = "<div class='row'><div class='alert alert-info'>Item update SQL query : <BR><textarea rows='1' cols='80'>$query</textarea></div></div>";
						}
					}
				}
			}
		}
	}

if(!empty($_POST["acc_vp"]) || !empty($_GET["vp"]))
	{
		$tab = 5;
		if(!empty($_GET["vp"]))
		{
			if(is_numeric($_GET["vp"]))
			{
				$acc_id = strtolower(mysqli_real_escape_string($db,$_GET["vp"]));
				$result = mysqli_query($db_auth,"SELECT * FROM accounts_more WHERE id = '$acc_id'");
				$acc_edit_data = mysqli_fetch_array($result);
				if(!empty($_POST['vpSBT']) && !empty($acc_edit_data['id']))
				{
					$tab = 5;
					$item_data =  $_POST;
					$UPDATE_QUERY = '';
					foreach($_POST as $k => $v)
					{
						if($k == 'vpSBT' || $k == 'id' || $k == 'acc_login')
						{
							continue;
						}
						if($k == 'sha_pass_hash' && !empty($v))
						{
							$v = strtoupper(sha1(strtoupper($acc_edit_data['acc_login']) . ":" . strtoupper($v)));;
						}elseif($k == 'sha_pass_hash'){
							continue;
						}
						
						if(array_key_exists($k,$db_auth_accounts_more2))
						{
							if(!is_numeric($v) && $db_auth_accounts_more2[$k] == "number")
							{
								$error1 = 1;
								echo '<script>alert("Value of '.$k.' is not number!");</script>';
							}
							$UPDATE_QUERY .= ", $k = '".mysqli_real_escape_string($db,$v)."'";
						}
					}
					if(empty($error1))
					{
						$UPDATE_QUERY = trim($UPDATE_QUERY,",");
						$query = "UPDATE accounts_more SET $UPDATE_QUERY WHERE id = '$acc_id'";
						if(Output_TYPE == 1)
						{
							mysqli_query($db_auth,$query);
							$message = "<div class='row'><div class='alert alert-info'>Account has been updated.</div></div>";
							$result = mysqli_query($db_auth,"SELECT * FROM accounts_more WHERE id = '$acc_id'");
							$acc_edit_data = mysqli_fetch_array($result);
						}else{
							$message = "<div class='row'><div class='alert alert-info'>Item update SQL query : <BR><textarea rows='1' cols='80'>$query</textarea></div></div>";
						}
					}
				}
			}
		}
	}
}else{	
	
    if(!empty($_POST['username']) && !empty($_POST['password']))
    {
        if($_POST["username"] == mkng_tdb_username && $_POST["password"] == mkng_tdb_password)
        {
            $_SESSION["login"] = 1;
            header("location:".$actual_link);
        }else{
            echo '<script>alert("Username or Password is not valid!");</script>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Lastwow Admin Panel DB Editor</title>
    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        html {position: relative;min-height: 100%;}
        header{background-color: rgba(255,255,255,0.8);padding:20px 20px 25px 20px;}
        footer {position: absolute;bottom: 0;width: 100%;height: 60px;background-color: rgba(255,255,255,0.8);padding:20px;}
        body {margin-bottom: 80px;background-image: url(https://www.mobygames.com/images/promo/original/1467345012-2727328746.jpg); background-position: center;background-repeat: no-repeat;background-size: 100% 100%;}
        .login-form{max-width: 350px; margin:80px auto;padding:25px;background-color: rgba(255,255,255,0.8);border-radius: 5px;}
        .box-form{max-width: 80%; margin:10px auto 10px auto;padding:25px;background-color: rgba(255,255,255,0.8);border-radius: 5px;}
        .input-group{margin-top:10px;}.pad10 { padding:10px;}.pad20 { padding:20px;}.mrg1{margin-top:20px;}textarea{background: transparent;border: none;width: 100%}

    </style>
</head>
<body>
<header>
    <h1 class="text-center">Lastwow Admin Panel DB Editor</h1>
</header>
<?php if(empty($_SESSION["login"])) { ?>
<div class="login-form">
    <form action="<?php echo $actual_link;?>" method="post">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Username</span>
            <input type="text" class="form-control" placeholder="Username" name="username">
        </div>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Password</span>
            <input type="password" class="form-control" placeholder="Username" name="password">
        </div>
        <div class="text-center" style="margin-top: 10px;"><input type="submit" class="btn btn-success" value="Login"></div>
    </form>
</div>
<?php }else{ ?>
<div class="box-form">
    <?php echo $message; ?>
    <div class="row">
        <ul class="nav nav-tabs">
            <li class="<?php echo ($tab == 1) ? 'active' : ''; ?>"><a data-toggle="tab" href="#itemsearch">Item Search</a></li>
            <li class="<?php echo ($tab == 2) ? 'active' : ''; ?>"><a data-toggle="tab" href="#item_manage">Item Manage</a></li>
            <li class="<?php echo ($tab == 3) ? 'active' : ''; ?>"><a data-toggle="tab" href="#account_manager">Account Manager</a></li>
            <li class="<?php echo ($tab == 4) ? 'active' : ''; ?>"><a data-toggle="tab" href="#online_users">Online Characters</a></li>
			<li class="<?php echo ($tab == 5) ? 'active' : ''; ?>"><a data-toggle="tab" href="#add_vp">Add Vote Points</a></li>
        </ul>
        <div class="tab-content">
            <div id="itemsearch" class="tab-pane fade <?php echo ($tab == 1) ? 'in active' : ''; ?>">
                <div class="row pad20">
                    <form action="<?php echo $actual_link;?>" method="post">
                        <div class="col-xs-2">
                            <input class="form-control" name="item_search" type="text" placeholder="Item Name Or Item Entry" value="<?php echo (!empty($_POST["item_search"])) ? $_POST["item_search"] : '';?>">
                        </div>
                        <div class="col-xs-2">
                            <input class="btn btn-info" type="submit" value="Search">
                        </div>
                    </form>
                </div>
                <?php
                if(!empty($_POST["item_search"]))
                {
                    $item_search = strtolower(mysqli_real_escape_string($db,$_POST["item_search"]));
                    $result = mysqli_query($db,"SELECT entry,name FROM item_template WHERE entry = '$item_search' OR LOWER(name) like '%$item_search%' LIMIT 0,40");
                    $tbl_out = "";
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $tbl_out .="<tr class='text-center'><td class='text-center'>".$row["entry"]."</td><td class='text-center'><a href='$actual_link?item=".$row["entry"]."'>".$row["name"]."</a></td></tr>";
                    }
                    if(!empty($tbl_out))
                    {
                        echo "<hr> <table class=\"table table-striped\"><thead><tr><th class='text-center'>Item Entry</th><th class='text-center'>Item Name</th></tr></thead><tbody>".$tbl_out."</tbody></table>";
                    }
                }
                ?>
            </div>
			<div id="online_users" class="tab-pane fade <?php echo ($tab == 4) ? 'in active' : ''; ?>">
                <?php
                    $result = mysqli_query($db_char,"SELECT account,name,level FROM characters WHERE online = '1'");
                    $tbl_out = "";
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $tbl_out .="<tr class='text-center'><td class='text-center'>".$row["account"]."</td><td class='text-center'>".$row["name"]."</td><td class='text-center'>".$row["level"]."</td></tr>";
                    }
                    if(!empty($tbl_out))
                    {
                        echo "<hr> <table class=\"table table-striped\"><thead><tr><th class='text-center'>Account ID</th><th class='text-center'>Character Name</th><th class='text-center'>Level</th></tr></thead><tbody>".$tbl_out."</tbody></table>";
                    }
                ?>
            </div>
			
			
			
			<div id="add_vp" class="tab-pane fade <?php echo ($tab == 5) ? 'in active' : ''; ?>">
                <div class="row pad20">
                    <form action="<?php echo $actual_link;?>" method="post">
                        <div class="col-xs-2">
                            <input class="form-control" name="acc_vp" type="text" placeholder="Vp Username" value="<?php echo (!empty($_POST["acc_vp"])) ? $_POST["acc_vp"] : '';?>">
                        </div>
                        <div class="col-xs-2">
                            <input class="btn btn-info" type="submit" value="Search">
                        </div>
                    </form>
                </div>
                <?php
                if(!empty($_POST["acc_vp"]))
                {
                    $acc_vp = strtolower(mysqli_real_escape_string($db,$_POST["acc_vp"]));
					
                    $result = mysqli_query($db_auth,"SELECT id,acc_login,vp FROM accounts_more WHERE LOWER(acc_login) = '$acc_vp' OR LOWER(acc_login) like '%$acc_vp%' LIMIT 0,40");
                    $tbl_out = "";
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $tbl_out .="<tr class='text-center'><td class='text-center'>".$row["id"]."</td><td class='text-center'><a href='$actual_link?vp=".$row["id"]."'>".$row["acc_login"]."</a></td></tr>";
                    }
                    if(!empty($tbl_out))
                    {
                        echo "<hr> <table class=\"table table-striped\"><thead><tr><th class='text-center'>Account ID</th><th class='text-center'>Username</th></tr></thead><tbody>".$tbl_out."</tbody></table>";
                    }
                }elseif(!empty($acc_edit_data["id"])) { ?>
					<form action="<?php echo $actual_link;?>?vp=<?php echo $acc_edit_data["id"];?>" method="post">
                    <div class="row">
                        <?php
                        foreach($db_auth_accounts_more as $db_item)
                        {
							if($db_item["name"] == 'sha_pass_hash')
							{
								echo '<div class="col-xs-4 mrg1"><div class="input-group"><span class="input-group-addon">'.$db_item["name"].'</span><input type="password" class="form-control" placeholder="'.$db_item["name"].'" name="'.$db_item["name"].'" value=""></div></div>';
							}else{
								echo '<div class="col-xs-4 mrg1"><div class="input-group"><span class="input-group-addon">'.$db_item["name"].'</span><input type="'.$db_item["type"].'" class="form-control" placeholder="'.$db_item["name"].'" name="'.$db_item["name"].'" value="';echo (isset($acc_edit_data[$db_item["name"]])) ? $acc_edit_data[$db_item["name"]] : ''; echo '"></div></div>';
							}
                        }
                        ?>
                    </div>
                    <hr>
                    <div class="row text-center">
                        <input type="submit" value="Save Account" class='btn btn-success' name="vpSBT">
                    </div>
                </form>
				<?php } ?>
            </div>

			
			<div id="account_manager" class="tab-pane fade <?php echo ($tab == 3) ? 'in active' : ''; ?>">
                <div class="row pad20">
                    <form action="<?php echo $actual_link;?>" method="post">
                        <div class="col-xs-2">
                            <input class="form-control" name="acc_search" type="text" placeholder="Account Username" value="<?php echo (!empty($_POST["acc_search"])) ? $_POST["acc_search"] : '';?>">
                        </div>
                        <div class="col-xs-2">
                            <input class="btn btn-info" type="submit" value="Search">
                        </div>
                    </form>
                </div>
                <?php
                if(!empty($_POST["acc_search"]))
                {
                    $acc_search = strtolower(mysqli_real_escape_string($db,$_POST["acc_search"]));
                    $result = mysqli_query($db_auth,"SELECT account_id,username FROM account WHERE LOWER(username) = '$acc_search' OR LOWER(username) like '%$acc_search%' LIMIT 0,40");
                    $tbl_out = "";
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $tbl_out .="<tr class='text-center'><td class='text-center'>".$row["account_id"]."</td><td class='text-center'><a href='$actual_link?acc=".$row["account_id"]."'>".$row["username"]."</a></td></tr>";
                    }
                    if(!empty($tbl_out))
                    {
                        echo "<hr> <table class=\"table table-striped\"><thead><tr><th class='text-center'>Account ID</th><th class='text-center'>Username</th></tr></thead><tbody>".$tbl_out."</tbody></table>";
                    }
                }elseif(!empty($acc_edit_data["account_id"])) { ?>
					<form action="<?php echo $actual_link;?>?acc=<?php echo $acc_edit_data["account_id"];?>" method="post">
                    <div class="row">
                        <?php
                        foreach($db_auth_account as $db_item)
                        {
							if($db_item["name"] == 'sha_pass_hash')
							{
								echo '<div class="col-xs-4 mrg1"><div class="input-group"><span class="input-group-addon">'.$db_item["name"].'</span><input type="password" class="form-control" placeholder="'.$db_item["name"].'" name="'.$db_item["name"].'" value=""></div></div>';
							}else{
								echo '<div class="col-xs-4 mrg1"><div class="input-group"><span class="input-group-addon">'.$db_item["name"].'</span><input type="'.$db_item["type"].'" class="form-control" placeholder="'.$db_item["name"].'" name="'.$db_item["name"].'" value="';echo (isset($acc_edit_data[$db_item["name"]])) ? $acc_edit_data[$db_item["name"]] : ''; echo '"></div></div>';
							}
                        }
                        ?>
                    </div>
                    <hr>
                    <div class="row text-center">
                        <input type="submit" value="Save Account" class='btn btn-success' name="accSBT">
                    </div>
                </form>
				<?php } ?>
            </div>
            <div id="item_manage" class="tab-pane fade <?php echo ($tab == 2) ? 'in active' : ''; ?>">
                <form action="<?php echo $actual_link;?>" method="post">
                    <div class="row">
                        <?php
                        foreach($db_item_template as $db_item)
                        {
                            if(!empty($db_item["name"]))
                            {
                                if($db_item["name"] == "class")
                                {
                                    $lastSELECT = (isset($item_data[$db_item["name"]])) ? $item_data[$db_item["name"]] : '0';
                                    echo '<div class="col-xs-4 mrg1"><div class="input-group"><span class="input-group-addon">'.$db_item["name"].'</span><select class="form-control" name="'.$db_item["name"].'" >'.create_SELECTOPTION_html(array('0'=>'Consumable','1'=>'Container','2'=>'Weapon','3'=>'Gem','4'=>'Armor','5'=>'Reagent','6'=>'Projectile','7'=>'Trade Goods','8'=>'Generic(OBSOLETE)','9'=>'Recipe','10'=>'Money(OBSOLETE)','11'=>'Quiver','12'=>'Quest','13'=>'Key','14'=>'Permanent(OBSOLETE)','15'=>'Miscellaneous','16'=>'Glyph'),$lastSELECT).'</select></div></div>';
                                }elseif($db_item["name"] == "Quality")
                                {
                                    $lastSELECT = (isset($item_data[$db_item["name"]])) ? $item_data[$db_item["name"]] : '0';
                                    echo '<div class="col-xs-4 mrg1"><div class="input-group"><span class="input-group-addon">'.$db_item["name"].'</span><select class="form-control" name="'.$db_item["name"].'" >'.create_SELECTOPTION_html(array('0'=>'Grey - Poor','1'=>'White - Common','2'=>'Green - Uncommon','3'=>'Blue - Rare','4'=>'Purple - Epic','5'=>'Orange - Legendary','6'=>'Red - Artifact','7'=>'Gold - Bind to Account'),$lastSELECT).'</select></div></div>';
                                }elseif($db_item["name"] == "Quality")
                                {
                                    $lastSELECT = (isset($item_data[$db_item["name"]])) ? $item_data[$db_item["name"]] : '0';
                                    echo '<div class="col-xs-4 mrg1"><div class="input-group"><span class="input-group-addon">'.$db_item["name"].'</span><select class="form-control" name="'.$db_item["name"].'" >'.create_SELECTOPTION_html(array('0'=>'Grey - Poor','1'=>'White - Common','2'=>'Green - Uncommon','3'=>'Blue - Rare','4'=>'Purple - Epic','5'=>'Orange - Legendary','6'=>'Red - Artifact','7'=>'Gold - Bind to Account'),$lastSELECT).'</select></div></div>';
                                }elseif($db_item["name"] == "InventoryType")
                                {
                                    $lastSELECT = (isset($item_data[$db_item["name"]])) ? $item_data[$db_item["name"]] : '0';
                                    echo '<div class="col-xs-4 mrg1"><div class="input-group"><span class="input-group-addon">'.$db_item["name"].'</span><select class="form-control" name="'.$db_item["name"].'" >'.create_SELECTOPTION_html(array('0'=>'Non equipable','1'=>'Head','2'=>'Neck','3'=>'Shoulder','4'=>'Shirt','5'=>'Chest','6'=>'Waist','7'=>'Legs','8'=>'Feet','9'=>'Wrists','10'=>'Hands','11'=>'Finger','12'=>'Trinket','13'=>'Weapon','14'=>'Shield','15'=>'Ranged (Bows)','16'=>'Back','17'=>'Two-Hand','18'=>'Bag','19'=>'Tabard','20'=>'Robe','21'=>'Main hand','22'=>'Off hand','23'=>'Holdable (Tome)','24'=>'Ammo','25'=>'Thrown','26'=>'Ranged right (Wands, Guns)','27'=>'Quiver','28'=>'Relic'),$lastSELECT).'</select></div></div>';
                                }elseif($db_item["name"] == "RequiredReputationRank")
                                {
                                    $lastSELECT = (isset($item_data[$db_item["name"]])) ? $item_data[$db_item["name"]] : '0';
                                    echo '<div class="col-xs-4 mrg1"><div class="input-group"><span class="input-group-addon">'.$db_item["name"].'</span><select class="form-control" name="'.$db_item["name"].'" >'.create_SELECTOPTION_html(array('0'=>'Hated','1'=>'Hostile','2'=>'Unfriendly','3'=>'Neutral','4'=>'Friendly','5'=>'Honored','6'=>'Revered','7'=>'Exalted'),$lastSELECT).'</select></div></div>';
                                }elseif(substr($db_item["name"],0,9) == "stat_type")
                                {
                                    $lastSELECT = (isset($item_data[$db_item["name"]])) ? $item_data[$db_item["name"]] : '0';
                                    echo '<div class="col-xs-4 mrg1"><div class="input-group"><span class="input-group-addon">'.$db_item["name"].'</span><select class="form-control" name="'.$db_item["name"].'" >'.create_SELECTOPTION_html(array('0'=>'ITEM_MOD_MANA','1'=>'ITEM_MOD_HEALTH','3'=>'ITEM_MOD_AGILITY','4'=>'ITEM_MOD_STRENGTH','5'=>'ITEM_MOD_INTELLECT','6'=>'ITEM_MOD_SPIRIT','7'=>'ITEM_MOD_STAMINA','12'=>'ITEM_MOD_DEFENSE_SKILL_RATING','13'=>'ITEM_MOD_DODGE_RATING','14'=>'ITEM_MOD_PARRY_RATING','15'=>'ITEM_MOD_BLOCK_RATING','16'=>'ITEM_MOD_HIT_MELEE_RATING','17'=>'ITEM_MOD_HIT_RANGED_RATING','18'=>'ITEM_MOD_HIT_SPELL_RATING','19'=>'ITEM_MOD_CRIT_MELEE_RATING','20'=>'ITEM_MOD_CRIT_RANGED_RATING','21'=>'ITEM_MOD_CRIT_SPELL_RATING','22'=>'ITEM_MOD_HIT_TAKEN_MELEE_RATING','23'=>'ITEM_MOD_HIT_TAKEN_RANGED_RATING','24'=>'ITEM_MOD_HIT_TAKEN_SPELL_RATING','25'=>'ITEM_MOD_CRIT_TAKEN_MELEE_RATING','26'=>'ITEM_MOD_CRIT_TAKEN_RANGED_RATING','27'=>'ITEM_MOD_CRIT_TAKEN_SPELL_RATING','28'=>'ITEM_MOD_HASTE_MELEE_RATING','29'=>'ITEM_MOD_HASTE_RANGED_RATING','30'=>'ITEM_MOD_HASTE_SPELL_RATING','31'=>'ITEM_MOD_HIT_RATING','32'=>'ITEM_MOD_CRIT_RATING','33'=>'ITEM_MOD_HIT_TAKEN_RATING','34'=>'ITEM_MOD_CRIT_TAKEN_RATING','35'=>'ITEM_MOD_RESILIENCE_RATING','36'=>'ITEM_MOD_HASTE_RATING','37'=>'ITEM_MOD_EXPERTISE_RATING','38'=>'ITEM_MOD_ATTACK_POWER','39'=>'ITEM_MOD_RANGED_ATTACK_POWER','40'=>'ITEM_MOD_FERAL_ATTACK_POWER (not used as of 3.3)','41'=>'ITEM_MOD_SPELL_HEALING_DONE','42'=>'ITEM_MOD_SPELL_DAMAGE_DONE','43'=>'ITEM_MOD_MANA_REGENERATION','44'=>'ITEM_MOD_ARMOR_PENETRATION_RATING','45'=>'ITEM_MOD_SPELL_POWER','46'=>'ITEM_MOD_ HEALTH_REGEN','47'=>'ITEM_MOD_SPELL_PENETRATION','48'=>'ITEM_MOD_BLOCK_VALUE'),$lastSELECT).'</select></div></div>';
                                }elseif(substr($db_item["name"],0,8) == "dmg_type")
                                {
                                    $lastSELECT = (isset($item_data[$db_item["name"]])) ? $item_data[$db_item["name"]] : '0';
                                    echo '<div class="col-xs-4 mrg1"><div class="input-group"><span class="input-group-addon">'.$db_item["name"].'</span><select class="form-control" name="'.$db_item["name"].'" >'.create_SELECTOPTION_html(array('0'=>'Physical','1'=>'Holy','2'=>'Fire','3'=>'Nature','4'=>'Frost','5'=>'Shadow','6'=>'Arcane'),$lastSELECT).'</select></div></div>';
                                }elseif(substr($db_item["name"],0,12) == "spelltrigger")
                                {
                                    $lastSELECT = (isset($item_data[$db_item["name"]])) ? $item_data[$db_item["name"]] : '0';
                                    echo '<div class="col-xs-4 mrg1"><div class="input-group"><span class="input-group-addon">'.$db_item["name"].'</span><select class="form-control" name="'.$db_item["name"].'" >'.create_SELECTOPTION_html(array('0'=>'Use','1'=>'On Equip','2'=>'Chance on Hit','4'=>'Soulstone','5'=>'Use with no delay','6'=>'Learn Spell ID'),$lastSELECT).'</select></div></div>';
                                }elseif($db_item["name"] == "bonding")
                                {
                                    $lastSELECT = (isset($item_data[$db_item["name"]])) ? $item_data[$db_item["name"]] : '0';
                                    echo '<div class="col-xs-4 mrg1"><div class="input-group"><span class="input-group-addon">'.$db_item["name"].'</span><select class="form-control" name="'.$db_item["name"].'" >'.create_SELECTOPTION_html(array('0'=>'No bounds','1'=>'Binds when picked up','2'=>'Binds when equipped','3'=>'Binds when used','4'=>'Quest item','5'=>'Quest Item1'),$lastSELECT).'</select></div></div>';
                                }elseif($db_item["name"] == "Material")
                                {
                                    $lastSELECT = (isset($item_data[$db_item["name"]])) ? $item_data[$db_item["name"]] : '0';
                                    echo '<div class="col-xs-4 mrg1"><div class="input-group"><span class="input-group-addon">'.$db_item["name"].'</span><select class="form-control" name="'.$db_item["name"].'" >'.create_SELECTOPTION_html(array('-1'=>'Consumables','0'=>'Not Defined','1'=>'Metal','2'=>'Wood','3'=>'Liquid','4'=>'Jewelry','5'=>'Chain','6'=>'Plate','7'=>'Cloth','8'=>'Leather'),$lastSELECT).'</select></div></div>';
                                }elseif($db_item["name"] == "sheath")
                                {
                                    $lastSELECT = (isset($item_data[$db_item["name"]])) ? $item_data[$db_item["name"]] : '0';
                                    echo '<div class="col-xs-4 mrg1"><div class="input-group"><span class="input-group-addon">'.$db_item["name"].'</span><select class="form-control" name="'.$db_item["name"].'" >'.create_SELECTOPTION_html(array('0'=>'Two Handed Weapon','1'=>'Staff','2'=>'One Handed','3'=>'Shield','4'=>'Enchanter\'s Rod','5'=>'Off hand'),$lastSELECT).'</select></div></div>';
                                }elseif($db_item["name"] == "BagFamily")
                                {
                                    $lastSELECT = (isset($item_data[$db_item["name"]])) ? $item_data[$db_item["name"]] : '0';
                                    echo '<div class="col-xs-4 mrg1"><div class="input-group"><span class="input-group-addon">'.$db_item["name"].'</span><select class="form-control" name="'.$db_item["name"].'" >'.create_SELECTOPTION_html(array('0'=>'None','1'=>'Arrows','2'=>'Bullets','4'=>'Soul Shards','8'=>'Leatherworking Supplies','16'=>'Inscription Supplies','32'=>'Herbs','64'=>'Enchanting Supplies','128'=>'Engineering Supplies','256'=>'Keys','512'=>'Gems','1024'=>'Mining Supplies','2048'=>'Soulbound Equipment','4096'=>'Vanity Pets','8192'=>'Currency Tokens','16384'=>'Quest Items'),$lastSELECT).'</select></div></div>';
                                }elseif($db_item["name"] == "TotemCategory")
                                {
                                    $lastSELECT = (isset($item_data[$db_item["name"]])) ? $item_data[$db_item["name"]] : '0';
                                    echo '<div class="col-xs-4 mrg1"><div class="input-group"><span class="input-group-addon">'.$db_item["name"].'</span><select class="form-control" name="'.$db_item["name"].'" >'.create_SELECTOPTION_html(array('0'=>'None','1'=>'Skinning Knife (OLD)','2'=>'Earth Totem','3'=>'Air Totem','4'=>'Fire Totem','5'=>'Water Totem','6'=>'Runed Copper Rod','7'=>'Runed Silver Rod','8'=>'Runed Golden Rod','9'=>'Runed Truesilver Rod','10'=>'Runed Arcanite Rod','11'=>'Mining Pick (OLD)','12'=>'Philosopher\'s Stone','13'=>'Blacksmith Hammer (OLD)','14'=>'Arclight Spanner','15'=>'Gyromatic Micro-Adjustor','21'=>'Master Totem','41'=>'Runed Fel Iron Rod','62'=>'Runed Adamantite Rod','63'=>'Runed Eternium Rod','81'=>'Hollow Quill','101'=>'Runed Azurite Rod','121'=>'Virtuoso Inking Set','141'=>'Drums','161'=>'Gnomish Army Knife','162'=>'Blacksmith Hammer','165'=>'Mining Pick','166'=>'Skinning Knife','167'=>'Hammer Pick','168'=>'Bladed Pickaxe','169'=>'Flint and Tinder','189'=>'Runed Cobalt Rod','190'=>'Runed Titanium Rod'),$lastSELECT).'</select></div></div>';
                                }elseif(substr($db_item["name"],0,11) == "socketColor")
                                {
                                    $lastSELECT = (isset($item_data[$db_item["name"]])) ? $item_data[$db_item["name"]] : '0';
                                    echo '<div class="col-xs-4 mrg1"><div class="input-group"><span class="input-group-addon">'.$db_item["name"].'</span><select class="form-control" name="'.$db_item["name"].'" >'.create_SELECTOPTION_html(array('0'=>'None','1'=>'Meta','2'=>'Red','4'=>'Yellow','8'=>'Blue'),$lastSELECT).'</select></div></div>';
                                }elseif($db_item["name"] == "socketBonus")
                                {
                                    $lastSELECT = (isset($item_data[$db_item["name"]])) ? $item_data[$db_item["name"]] : '0';
                                    echo '<div class="col-xs-4 mrg1"><div class="input-group"><span class="input-group-addon">'.$db_item["name"].'</span><select class="form-control" name="'.$db_item["name"].'" >'.create_SELECTOPTION_html(array('0'=>'None','3312'=>'+8 Strength','3313'=>'+8 Agility','3305'=>'+12 Stamina','3353'=>'+8 Intellect','2872'=>'+9 Healing','3753'=>'+9 Spell Power','3877'=>'+16 Attack Power'),$lastSELECT).'</select></div></div>';
                                }elseif($db_item["name"] == "FoodType")
                                {
                                    $lastSELECT = (isset($item_data[$db_item["name"]])) ? $item_data[$db_item["name"]] : '0';
                                    echo '<div class="col-xs-4 mrg1"><div class="input-group"><span class="input-group-addon">'.$db_item["name"].'</span><select class="form-control" name="'.$db_item["name"].'" >'.create_SELECTOPTION_html(array('0'=>'None','1'=>'Meat','2'=>'Fish','3'=>'Cheese','4'=>'Bread','5'=>'Fungus','6'=>'Fruit','7'=>'Raw Meat','8'=>'Raw Fish'),$lastSELECT).'</select></div></div>';
                                }elseif($db_item["name"] == "flagsCustom")
                                {
                                    $lastSELECT = (isset($item_data[$db_item["name"]])) ? $item_data[$db_item["name"]] : '0';
                                    echo '<div class="col-xs-4 mrg1"><div class="input-group"><span class="input-group-addon">'.$db_item["name"].'</span><select class="form-control" name="'.$db_item["name"].'" >'.create_SELECTOPTION_html(array('0'=>'None','1'=>'ITEM_FLAGS_CU_DURATION_REAL_TIME','2'=>'ITEM_FLAGS_CU_IGNORE_QUEST_STATUS','4'=>'ITEM_FLAGS_CU_FOLLOW_LOOT_RULES'),$lastSELECT).'</select></div></div>';
                                }else{
                                    echo '<div class="col-xs-4 mrg1"><div class="input-group"><span class="input-group-addon">'.$db_item["name"].'</span><input type="'.$db_item["type"].'" class="form-control" placeholder="'.$db_item["name"].'" name="'.$db_item["name"].'" value="';echo (isset($item_data[$db_item["name"]])) ? $item_data[$db_item["name"]] : ''; echo '"></div></div>';
                                }
                            }
                        }
                        ?>
                    </div>
                    <hr>
                    <div class="row text-center">
                        <input type="submit" value="Save Item" class='btn btn-success' name="itemSBT">
                        <?php if(!empty($item_data["entry"])){ echo " - <a href='$actual_link?delitem=".$item_data["entry"]."' class='btn btn-danger'>Delete This Item</a>";} ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <hr>
        <a href="<?php echo $actual_link;?>?logout=true" class="btn btn-danger">Logout</a>
    </div>
</div>
<?php } ?>

<footer class="text-center">
   <a href="http://lastwow.ga">Copyright © LastWoW™ 2018. All Rights Reserved.</a>
</footer>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>