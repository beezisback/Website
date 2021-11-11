<?php
#- Azer CMS V1.5 Functions -#
$con = $connect("$host", "$user", "$pass")or die(mysql_error());

//Session Exists ?
if (!isset($_SESSION)) 
{
  session_start();
}

//Set Date
date_default_timezone_set('US/Pacific');
$date = date("l F d, Y @ g:i A");

//Login Session
$login = "";

if(isset($_SESSION['acms_user']))
{
  $login = $_SESSION['acms_user'];
}

//Logout
function logout()
{
  if(isset($_GET['page']))
  {
    $page = $_GET['page'];
    if($page == "logout")
    {
      session_unset();
      session_destroy();
      header("Location: ./");
    }
  }
}

//Global Site News/Pages System
function news_pages()
{
  //Check For News & Pages
  global $query, $array, $row, $connect, $db_s;
  
  $sql = $query("SELECT id, name, active FROM $db_s.styles WHERE active='1' ORDER BY id DESC LIMIT 1")or die(mysql_error());
  while($get = $array($sql))
  {
    $style = $get['name'];
  }
  
  ob_start();
  if(isset($_GET['page']))
  {
    if(file_exists('./styles/'.$style.'/pages/'.$_GET['page'].'.php'))
    {
      include('./styles/'.$style.'/pages/'.$_GET['page'].'.php');
    }
    else
    {
      include('./styles/'.$style.'/pages/not_found.php');
    }
      
  }
  else
  {
    include('./styles/'.$style.'/news.php');
  }
  $contents = ob_get_contents();
  ob_end_clean();
  return $contents; // page stored in a variable thanks to ob!
}

//Site News
class news
{
  public $news_posts = array();
  
  function news()
  {
    global $query, $array, $db_s;

    $sql = $query("SELECT id, author, title, body, date, avatar FROM $db_s.news ORDER BY id DESC LIMIT 5")or die(mysql_error());
    while($get = $array($sql))
    {
      $get = str_replace(array("\r\n", "\r", "\n"), "<br />", $get);
      $this->news_posts[] = $get;
    }
  }
}

//Site Login
function login()
{
  global $query, $array, $num, $connect, $db_s, $db_a, $cap, $date, $_CLEAN;
  
  if(isset($_POST['login']))
  {
     //Post Username Caps & Clean
    $username = $cap($_CLEAN['username']);
  
    if(empty($_POST['username']))
    {
      $username = "Anonymous";
    }
  
     //Post Clean & Encrypt Password With Salty Sha1
    $password = $_CLEAN['password'];
    $password = sha1(strtoupper($username) . ":" . strtoupper($password));
  
    $get_admin = $query("SELECT username, sha_pass_hash FROM $db_a.account WHERE username='$username' AND sha_pass_hash='$password'")or die(mysql_error());
    $got_admin = $num($get_admin);
    if($got_admin == 1)
    {
      //User Valid, Set Session
      $sql = $query("INSERT INTO $db_s.login_log (user, date, status, ip, type) VALUES ('$username', '$date', 'Successful', '$_SERVER[REMOTE_ADDR]', 'Site')")or die(mysql_error());
      $_SESSION['acms_user'] = "$username";
      header("Location: ?page=account");
    }
    else
    {
      //User InValid, Redirect
      $sql = $query("INSERT INTO $db_s.login_log (user, date, status, ip, type) VALUES ('$username', '$date', 'UnSuccessful', '$_SERVER[REMOTE_ADDR]', 'Site')")or die(mysql_error());
      header("Location: ./");
    }
  }
}

//Site Account Creation
function register()
{
if(isset($_POST['register']))
  {
    global $query, $array, $num, $row, $connect, $db_a, $cap, $_CLEAN, $_STRIP_1, $_STRIP_2, $_STRIP_3, $db_f, $db_s, $expansion;
    
    //Empty Field
    if(empty($_POST['username']))
    {
      return'Username Field Is Empty.';
    }
    else
    {
      //Post Username, Caps & Clean
      $username = $cap($_CLEAN['username']);
      $username_clean = $_CLEAN['username'];
      $username_clean = strtolower($username_clean);
    }
    
    //Empty Field
    if(empty($_POST['password']))
    {
      return'Password Field Is Empty.';
    }
    else
    {
      //Post Password & Clean
      $password = $_CLEAN['password'];
    }
    
    //Empty Field
    if(empty($_POST['email']))
    {
      return'Email Field Is Empty.';
    }
    else
    {
      //Post Email & Clean
      $email = $cap($_STRIP_1($_STRIP_2($_STRIP_3($_POST['email']))));
    }
    
    //Anti-Bot
    $code[1] = $_POST['code1'];
    //Anti-Bot Match
    $code[2] = $_POST['code2'];
    
    //Invalid Anti-Bot
    if($code[1] != "$code[2]")
    {
      return'Invalid Anti-Bot Code.';
    }
    else
    {
      $forum = $query("SELECT active, path FROM $db_s.forum_prop WHERE active='1' LIMIT 1")or die(mysql_error());
      $active = $num($forum);
      
      switch($active)
      {
      case 1:
        while($path = $array($forum))
        {
          $path = $path['path'];
        
        $pulldata = mysql_query("SELECT `account`.`username`, `phpbb_users`.`username`, `phpbb_users`.`username_clean` FROM `$db_a`.`account`, `$db_f`.`phpbb_users` WHERE `account`.`username` = '$username' OR `phpbb_users`.`username` = '$username' OR `phpbb_users`.`username_clean` = '$username_clean'")or die(mysql_error());
        $pull = $row($pulldata);
        if($pull[0] == "$username" || $pull[1] == "$username"  || $pull[2] == "$username_clean")
        {
          return"The username '<font color=\"#90cf5d\">{$username}</font>' is already in use.";
        }
        else
        {
          define('IN_PHPBB', true);
        
          global $phpbb_root_path, $phpEx, $user, $db, $config, $cache, $template;
        
          $phpbb_root_path = "{$path}/";  // Your path here 
          $phpEx = substr(strrchr(__FILE__, '.'), 1); 
          include($phpbb_root_path . 'common.' . $phpEx);

          // Start session management 
          $user->session_begin(); 
          $auth->acl($user->data); 
          $user->setup(); 

          require($phpbb_root_path .'includes/functions_user.php'); 

          // Do a check if username is allready there, same for email, otherwhise a nasty error will occur 
          $user_row = array(
          'username'         => $username,
          'username_clean'   => $username,
          'user_password'      => phpbb_hash($password),
          'user_pass_convert'   => 0,
          'user_email'      => strtolower($email),
          'user_email_hash'   => crc32(strtolower($email)) . strlen($email),
          'group_id'         => 2,
          'user_timezone' => '1.00', 
          'user_dst' => 0, 
          'user_lang' => 'en', 
          'user_type' => '0', 
          'user_actkey' => '', 
          'user_dateformat' => 'd M Y H:i', 
          'user_style' => 1, 
          'user_regdate' => time(),
          );
          $phpbb_user_id = user_add($user_row);
          
          if($phpbb_user_id == true)
          {
            //Encrypt Password With Salty Sha1
            $password = sha1(strtoupper($username) . ":" . strtoupper($password));
            $password = strtoupper($password);
        
            //Set Staff_Id
            $staff = rand(100000000, 900000000);
        
            //Creation Complete
            $sql = $query("INSERT INTO $db_a.account (username, sha_pass_hash, email, expansion, acp, staff_id) VALUES ('$username', '$password', '$email', '$expansion', '0', '$staff')")or die(mysql_error());
        
            //Print Success
            return'The account \'<font color="#90cf5d">'.$username.'</font>\' has been created!<br/>
            Helpful Link: <a href="?page=connect">Connection Guide</a>';
          }
        }}
      break;
      case 0:
        $get_user = $query("SELECT username FROM $db_a.account WHERE username='$username'")or die(mysql_error());
        $got_user = $num($get_user);
      
        //Username Is Taken
        if($got_user == 1)
        {
          return"The username '<font color=\"#90cf5d\">{$username}</font>' is already in use.";
        }
        else
        {
           //Encrypt Password With Salty Sha1
          $password = sha1(strtoupper($username) . ":" . strtoupper($password));
          $password = strtoupper($password);
        
          //Set Staff_Id
          $staff = rand(100000000, 900000000);
        
          //Creation Complete
          $sql = $query("INSERT INTO $db_a.account (username, sha_pass_hash, email, expansion, acp, staff_id) VALUES ('$username', '$password', '$email', '$expansion', '0', '$staff')")or die(mysql_error());
        
          //Print Success
          return'The account \'<font color="#90cf5d">'.$username.'</font>\' has been created!<br/>
          Helpful Link: <a href="?page=connect">Connection Guide</a>';
        break;
        }
      } 
    }
  }
}

//Site Shoutbox
#Post Shouts
function shout()
{
  if(isset($_POST['shout']))
  {
    //Shout Is Empty
    if(empty($_POST['body']))
    {
      return'<center>Shout was empty.</center><br/><br/>';
    }
    else
    {
      global $query, $connect, $db_s, $cap, $login, $_STRIP_1, $_STRIP_2, $_STRIP_3;
      //Check If Logged In
      if(!$login)
      {
        return'<center>You Must Login To Shout.</center><br/><br/>';
      }
      else
      {
        //Set Date
        $date = date('M d, Y');
        //Post Shout, Cap & Strip
        $body = $cap($_STRIP_1($_STRIP_2($_STRIP_3($_POST['body']))));
        
        //Success, Shout Is Posted
        $sql= $query("INSERT INTO $db_s.shouts (author, body, date) VALUES ('$login', '$body', '$date')")or die(mysql_error());
        
        header("Location: ./#shoutid");
      }
    }
  }
}

//View Shouts
class shouts
{
  public $view_shouts = array();
  public $shout_url;
  
  function shouts()
  {
    global $query, $array, $assoc, $num, $connect, $db_s, $cap;
  
    //ShoutBox Table
    $table = "shouts";
    // How many adjacent pages should be shown on each side?
    $adjacents = 3;
  
    $sql = $query("SELECT COUNT(id) as num FROM $db_s.$table")or die(mysql_error());
	  $total_pages = $assoc($sql);
	  $total_pages = $total_pages['num'];
	
	  $targetpage = "./"; 	//your file name  (the name of this file)
	  $limit = 5; 								//how many items to show per page
	
	  if(isset($_GET['shout']))
	  {
	    $page = $_GET['shout'];
	  }
	  else
	  {
	    $page = 1;
	  }
	  if($page)
	  {
	    $start = ($page - 1) * $limit;
	  } 			//first item to display on this page
	  else
	  {
	    $start = 0;
	  }
	
	  /* Get data. */
	  $result = $query("SELECT id, author, body, date FROM $db_s.$table ORDER BY id DESC LIMIT $start, $limit")or die(mysql_error());
	
	  /* Setup page vars for display. */
	  if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	  $prev = $page - 1;							//previous page is page - 1
	  $next = $page + 1;							//next page is page + 1
	  $lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
    $lpm1 = $lastpage - 1;						//last page minus 1
  
	  while($get = $array($result))
	  {
	    $get = str_replace(array("\r\n", "\r", "\n"), "<br />", $get);
	    $this->view_shouts[] = $get;
    }
    $this->shout_url = '<br/><center>Page: <a href="./?shout='.$prev.'#shoutid"><u>Previous</u></a> - <a href="./?shout='.$next.'#shoutid"><u>Next</u></a></center><br/>';
  }
}

//List Realms
class realms
{
  public $view_realms = array();
  public $realm_world;
  public $total_number;
  
  function realms()
  {
    global $query, $array, $num, $db_s, $host;
     
    //Get Realms
    $sql = $query("SELECT id, name, type, char_db, port, p_limit FROM $db_s.realms")or die(mysql_error());
    while($get = $array($sql))
    {
      $limit = $get['p_limit'];
      $db_c = $get['char_db'];
      $chars = $query("SELECT online FROM $db_c.characters WHERE online='1'")or die(mysql_error());
      $char = $num($chars);
      $number = $char / $limit;
      $total_number = $number * 100;
      $this->total_number = $total_number;
      $err = array('no' => NULL, 'str' => NULL);
      $arcemu = @fsockopen($host, $get['port'], $err['no'], $err['str'], (float)1.0);
      $this->view_realms[] = $get;
		  if(!$arcemu)
		  {
        $world = "Offline";
        $this->realm_world = $world;
      }
      else
      {
        $world = "<font color=\"#90cf5d\">Online</font>";
        $this->realm_world = $world;
        fclose($arcemu);
      }
    }
  }
}

//Account Panel Info
class account
{
  public $user_get = array();
  public $admin;
  public $curip;
  public $banned;
  
  function info()
  {
    global $query, $array, $assoc, $db_a, $login;
    
    //Get Info By Query
    $account_info = $query("SELECT id, username, email, joindate, locked, last_ip, expansion, acp, vp, dp FROM $db_a.account WHERE username='$login'")or die(mysql_error());
    while($get = $array($account_info))
    {
      //Banned?
      if($get['locked'] == 0)
      {
        $this->banned = "No";
      }
      else
      {
        $this->banned = "Yes";
      }
      //User Info
      $this->user_get[] = $get;
      //User's Current IP
      $this->curip = $_SERVER['REMOTE_ADDR'];
      //User's Site Rank
      if($get['acp'] == 1)
      {
        //User Is Admin
        $this->admin = "Admin - [<a href=\"./acp\" target=\"_BLANK\">Acp</a>]";
      }
      else
      {
        //User Is User
        $this->admin = "User";
      }
    }
  }
}

//Forgot Password
function forgot()
{
  global $query, $db_a, $login, $_CLEAN, $_STRIP_1, $_STRIP_2, $_STRIP_3, $copyr, $cap, $num;
  
  if(isset($_POST['forgot']))
  {
  //Post username
  $username = $cap($_CLEAN['username']);
  //Post Email
  $email = $cap($_STRIP_1($_STRIP_2($_STRIP_3($_POST['email']))));
  
  //Validate User
  $validate = $query("SELECT username, email FROM $db_a.account WHERE username='$username' and email='$email'")or die(mysql_error());
  $valid = $num($validate);
  
  if($valid != 1)
  {
    //Account Invalid
    return'An account with the details entered, could not be found.';
  }
  else
  {
  //Generate New Password
  $password = rand(10000, 90000);
  
  //Email Subject
  $subject = "{$copyr} - Password Retrieval";
  //Email From?
  $from = "new-password@{$copyr}.com";
  //Email Body
  $body = "Hi {$username}, Your New Password Is: {$password}";
  //Email To?
  $to = "{$email}";
  
    if (mail($to, $subject, $body, $from))
    {
      //Encrypt New Password With Salty Sha1
      $password = sha1(strtoupper($username) . ":" . strtoupper($password));
      $password = strtoupper($password);
    
      //Success, Update Account
      $sql = $query("UPDATE $db_a.account SET sha_pass_hash='$password', v='0', s='0' WHERE username='$username' AND email='$email'")or die(mysql_error());
    
      return'<br/>Your Password Was Emailed To You.';
    }
    else
    {
      return'<br/>Were sorry, your password could not be emailed to you, please contact an administrator if this is your account.';
    }
  }
  }
}

//Change Password
function change_password()
{
  if(isset($_POST['change']))
  {
    //Check for empty passwords
    if(empty($_POST['opass']))
    {
      //Old Password Field Was Empty
      return'<br/><center>Old password is invalid.</center>';
    }
    else
    {
      if(empty($_POST['npass']))
      {
        //New Password Field Was Empty
        return'<br/><center>New password is invalid.</center>';
      }
      else
      {
        if(empty($_POST['cpass']))
        {
          //Confirm password Field Was Empty
          return'<br/><center>Confirm password is invalid.</center>';
        }
        else
        {
          global $query, $db_a, $login, $num, $_CLEAN;
          
          //Post Passwords
          $opass = $_CLEAN['opass'];
          $npass = $_CLEAN['npass'];
          $cpass = $_CLEAN['cpass'];
          
          //Encrypt Old Password With Salty Sha1
          $opass = sha1(strtoupper($login) . ":" . strtoupper($opass));
          $opass = strtoupper($opass);
          
          //Get Account
          $sql = $query("SELECT username, sha_pass_hash FROM $db_a.account WHERE username='$login' AND sha_pass_hash='$opass'")or die(mysql_error());
          $go = $num($sql);
          
          //Is Password Right?
          if($go != 1)
          {
            //Password Is Wrong
            return'<br/><center>Old password is wrong.</center>';
          }
          else
          {
            //Do Passwords Match?
            if($npass != "$cpass")
            {
              //Passwords Do Not Match
              return'<br/><center>New and confirmed passwords do not match.</center>';
            }
            else
            {
              //Encrypt New Password With Salty Sha1
              $npass = sha1(strtoupper($login) . ":" . strtoupper($npass));
              $npass = strtoupper($npass);
              
              //Success Update Account
              $query("UPDATE $db_a.account SET sha_pass_hash='$npass', sessionkey='', v='', s='' WHERE username='$login'")or die(mysql_error());
              
              return'<br/><center>Your password has been changed!</center>';
            }
          }
        }
      }
    }
  }
}

//Character Unstuck & Revive
class char_opt
{
  public $view_realm = array();
  public $view_char = array();

  function char_opt()
  {
    global $query, $array, $row, $db_a, $db_s, $login;
  
    $realmid = $query("SELECT id, name, char_db FROM $db_s.realms")or die(mysql_error());
    while($realm = $array($realmid))
    {
      //Get Char Db
      $db_c = $realm['char_db'];
      //Get Realm Name & Id
      $this->view_realm[] = $realm;
    }
    //Select Account's Characters
    $sql = $query("SELECT `account`.`id`, `account`.`username`, `characters`.`guid`, `characters`.`account`, `characters`.`name` FROM $db_a.`account`, $db_c.`characters` WHERE `account`.`id` = `characters`.`account` AND `account`.`username` = '$login'")or die(mysql_error());
    while($get = $row($sql))
    {
      $this->view_char[] = $get;
    }
  }
}

function unstuck_revive()
{
  if(isset($_POST['tool']))
  {
    global $query, $array, $num, $db_a, $db_s, $login, $_STRIP_1, $_STRIP_2, $_STRIP_3;
    
    //Get Character & Realm Id
    $data = $_STRIP_1($_STRIP_2($_STRIP_3($_POST['chart'])));
    
    //Separate Ids
    $sep = explode("-", $data);
    //Character Id
    $guid = $sep[0];
    //Realm Id
    $realm = $sep[1];
    
    //Get Character Db
    $sql = $query("SELECT id, char_db FROM $db_s.realms WHERE id='$realm'")or die(mysql_error());
    while($get = $array($sql))
    {
      //Character Db
      $db_c = $get['char_db'];
      
      //Get Character's Parent Account
      $gchar = $query("SELECT account FROM $db_c.characters WHERE guid='$guid'")or die(mysql_error());
      $check = $num($gchar);
      
      //Validate Ownership
      if($check != 1)
      {
        //Character Does Not Exist.
        return'<br/><center>Invalid character.</center>';
      }
      else
      {
        while($char = $array($gchar))
        {
          //Character's Parent Account
          $char_id = $char['account'];
          
          //Validate Ownership
          $acc = $query("SELECT id, username FROM $db_a.account WHERE username='$login'")or die(mysql_error());
          while($ac = mysql_fetch_array($acc))
          {
            $account = $ac['id'];
            if($account != "$char_id")
            {
              //Character Is Not Yours
              return'<br/><center>That character does not belong to you.</center>';
            }
            else
            {
              //Position X
              $px='-14406.599609';
              //Position Y
              $py='419.352997';
              //Position Z
              $pz='22.390306';
              //Orientation
              $o='0.000000';
              //Map Id
              $m='0';
              //Zone Id
              $z='33';
              
              //Success, Update Character
              $sql = $query("UPDATE $db_c.characters SET  drunk = 0, playerFlags = playerFlags & ~ 16, position_x = '$px', position_y = '$py', position_z = '$pz', zone = '$z', map = '$m' WHERE guid='$guid' AND account='$char_id' LIMIT 1")or die(mysql_error());
              
              return'<center><br/>Your character has been unstucked and revived.</center>';
            }
          } 
        }
      }
    }
  }
}

//Online Players
class online
{
  public $show_online = array();
  public $realm_name;

  function online()
  {
    global $con, $query, $assoc, $array, $db_s;
    
    if(isset($_GET['page']))
    {
      $page = $_GET['page'];
      
    if($page == "realm")
    {
      //Get Realm Id
      if(isset($_GET['id']))
      {
        $realm_id = $_GET['id'];
      }
      //Get Realm
      $get_realms = sprintf("SELECT id, name, char_db FROM $db_s.realms WHERE id='%s'", $realm_id, "int");
      $got_realms = $query($get_realms, $con) or die(mysql_error());
      $gr = $assoc($got_realms);
    
      //Realm Id
      $realmid = $gr['id'];
      if($realm_id != $realmid)
      {
        $this->realm_name = "<b>Invalid Realm Id.</b>";
      }
      else
      {
        //Character Db
        $realmdb = $gr['char_db'];
        //Realm Name
        $the_actual_name = $gr['name'];
        $this->realm_name = "Online Players For The <b>{$the_actual_name}</b> Realm.";
    
        if($realm_id == "$realmid")
        {
          //Get Online Characters
          $get_online_char = $query("SELECT * FROM $realmdb.characters WHERE online='1'")or die(mysql_error());
          while($g_o_c = $array($get_online_char))
          {
            $this->show_online[] = $g_o_c;
          }
        }
      }
    }
  }}
}

//Vote System
class vote
{
  public $view_sites = array();

  function vote()
  {
    if(isset($_GET['page']))
    {
      $page = $_GET['page'];
    
    if($page == "vote")
    {
      global $query, $array, $db_s;
      
      $get_site = $query("SELECT id, name, cost, url, img FROM $db_s.vote_sites")or die(mysql_error());
      while($site = $array($get_site))
      {
        $this->view_sites[] = $site;
      }
    }}
  }
}

function vote_go()
{
  global $query, $array, $num, $db_a, $db_s, $login, $date, $_CLEAN;
  
  if(isset($_POST['site']))
  {
    $sid = $_CLEAN['site'];
    $get_sites = $query("SELECT id, name, cost, url, img FROM $db_s.vote_sites WHERE id='$sid'")or die(mysql_error());
    $got_sites = $num($get_sites);
    if($got_sites == 0)
    {
      return "Invalid Site.";
    }
    else
    {
      if(!$login)
      {
        return "<br/>You must login to receive vote points.";
      }
      else
      {
        $time = "";
        $get_time = $query("SELECT site, user, date FROM $db_s.vote_log WHERE site='$sid' AND user='$login' ORDER BY id DESC LIMIT 1")or die(mysql_error());
        while($gtime = $array($get_time))
        {
          $time = $gtime['date'];
          $inputtime = DateTime::createFromFormat('l F d, Y @ g:i A',''.$time.'',new DateTimeZone("US/Pacific"));
          $diff = $inputtime->getTimestamp() - time();
        }
        if($time == "" || abs($diff) > 43200)
        {
          $get_sites = $query("SELECT id, name, cost, url, img FROM $db_s.vote_sites WHERE id='$sid'")or die(mysql_error());
          while($sites = $array($get_sites))
          {
            $get_vp = $query("SELECT vp FROM $db_a.account WHERE username='$login'")or die(mysql_error());
            while($get = $array($get_vp))
            {
              $old_vp = $get['vp'];
              $site_cost = $sites['cost'];
              $vp = $old_vp + $site_cost;
              
              $sql1 = $query("INSERT INTO $db_s.vote_log (site, type, user, cost, date) VALUES ('$sid', 'Vote', '$login', '$site_cost', '$date')")or die(mysql_error());
              $sql2 = $query("UPDATE $db_a.account SET vp='$vp' WHERE username='$login'")or die(mysql_error());
              
              header("Location: #vote");
            }
          }
        }
        else
        {
          return "<br/>You must wait 12 hours before you can vote for this site again.";
        }
      }
    }
  }
}

//Vote & V.I.P Store Functions
//Store Realm Selection
class store_realm
{
  public $view_realm = array();
  
  function store_realm()
  {
    global $db_s, $query, $array;
    
    $realms = $query("SELECT id, name FROM $db_s.realms")or die(mysql_error());
    while($realm = $array($realms))
    {
      $this->view_realm[] = $realm;
    }
  }
}

//Store Character Selection
class store_char
{
  public $view_char = array();
  public $char_view_db;
  public $char_view_id;

  function store_char()
  {
    global $query, $array, $db_s, $row, $db_a, $login;
    
    if(isset($_POST['select']))
    {
      $id = $_POST['realm'];
      $this->char_view_id = $id;
      
      $char_db = $query("SELECT char_db FROM $db_s.realms WHERE id='$id'")or die(mysql_error());
      while($db_c = $array($char_db))
      {
        $db_c = $db_c['char_db'];
        $this->char_view_db = $db_c;
        
        $chars = $query("SELECT `account`.`id`, `account`.`username`, `characters`.`guid`, `characters`.`account`, `characters`.`name` FROM $db_a.`account`, $db_c.`characters` WHERE `account`.`id` = `characters`.`account` AND `account`.`username` = '$login'")or die(mysql_error());
        while($char = $row($chars))
        {
          $this->view_char[] = $char;
        }
      }
    }
  }
}

//Vote Items
class store_vitems
{
  public $view_vitem = array();
  public $view_vamount;

  function store_vitems()
  {
    if(isset($_POST['select']))
    {
      global $query, $array, $db_s;
    
      $id = $_POST['realm'];
    
      $items = $query("SELECT id, name, item_id, amount, cost, type, realm FROM $db_s.store WHERE type='vote' AND realm='$id' ORDER BY id")or die(mysql_error());
      while($item = $array($items))
      {
        $this->view_vitem[] = $item;
      }
    }
  }
}

//V.I.P Items
class store_ditems
{
  public $view_ditem = array();
  public $view_damount;

  function store_ditems()
  {
    if(isset($_POST['select']))
    {
      global $query, $array, $db_s;
    
      $id = $_POST['realm'];
    
      $items = $query("SELECT id, name, item_id, amount, cost, type, realm FROM $db_s.store WHERE type='vip' AND realm='$id' ORDER BY id")or die(mysql_error());
      while($item = $array($items))
      {
        $this->view_ditem[] = $item;
      }
    }
  }
}

//Store Purchase
function store_purchase()
{
  if(isset($_POST['buy']))
  {
    if(empty($_POST['char']))
    {
      //Character Was Invalid
      return"Invalid Character.";
    }
    else
    {
      if(empty($_POST['item']))
      {
        //Item Was Invalid
        return"Invalid Item.";
      }
      else
      {
        global $query, $array, $num, $assoc, $_STRIP_1, $_STRIP_2, $_STRIP_3, $db_a, $db_s, $login, $host, $rauser, $rapass, $con, $date;
    
        //Clean Data
        $character = $_STRIP_1($_STRIP_2($_STRIP_3($_POST['char'])));
        $item = $_STRIP_1($_STRIP_2($_STRIP_3($_POST['item'])));
    
        //Explode To Separate Data
        $sep_c = explode("-", $character);
        $sep_i = explode("-", $item);
    
        //Character Database
        $db_c = $sep_c[0];
        //Character Guid
        $guid = $sep_c[1];
        //Character's Parent Realm
        $realm = $sep_c[2];
        //Purchase Type
        $type = $sep_i[0];
        //Item Purchased
        $item = $sep_i[1];
        //Item Cost
        $cost = $sep_i[2];
        //Item Amount
        $amount = $sep_i[3];
        
        $split_items = explode(",", $item);
        foreach($split_items as $spl_id)
        {
          $item_check = $query("SELECT item_id, cost, type FROM $db_s.store WHERE item_id='$spl_id' AND cost='$cost' AND type='$type'");
          $icheck = $num($item_check);
          
          if($icheck == 0)
          {
            return"Invalid Purchase.";
            $item = "";
          }
          else
          {
            $item = "{$spl_id}[:{$amount}]";
          }
        }
        
        //Get Realm's Ra_Port
        $raport = $query("SELECT id, ra_port FROM $db_s.realms WHERE id='$realm'")or die(mysql_error());
        while($rap = $array($raport))
        {
          $ra = $rap['ra_port'];
        }
        
        //Get Account Data
        $accounts = $query("SELECT username, email, vp, dp FROM $db_a.account WHERE username='$login'")or die(mysql_error());
        while($account = $array($accounts))
        {
          //Account Email For Logs
          $email = $account['email'];
          //Old Vote Points
          $ovp = $account['vp'];
          //Old V.I.P Points
          $odp = $account['dp'];
      
          //Get Character Guid For Matching
          $chara = $query("SELECT name FROM $db_c.characters WHERE guid='$guid'")or die(mysql_error());
          $vchar = $num($chara);
      
          while($chars = $array($chara))
          {
            //Character name
            $char = $chars['name'];
          }
      
          if($vchar != 1)
          {
            //Character Is Invalid
            return'Invalid Character.';
          }
          else
          {
            if($type == "vip")
            {
              if($odp < "$cost")
              {
                //User Doesn't Have Enough V.I.P Points
                return'You do not have enough V.I.P points.';
              }
              else
              {
                //Subtract New V.I.P Points From Old V.I.P Points
                $dp = $odp - $cost;
                //V.I.P Mail Subject
                $subject = "V.I.P Items";
                //V.I.P Mail Body
                $text = "Thank you for donating, here is your reward!";
            
                //Update Account's V.I.P Points
                $go = ("UPDATE $db_a.account SET dp='$dp' WHERE username='$login'");
                $greater = 1;
              }
            }
            else if($type == "vote")
            {
              if($ovp < "$cost")
              {
            //User Doesn't Have Enough Vote Points
            return'You do not have enough vote points.';
              }
              else
              {
                //Subtract New Vote Points From Old Vote Points
                $vp = $ovp - $cost;
                //Vote Mail Subject
                $subject = "Vote Items";
                //Vote Mail Body
                $text = "Thank you for voting, here is your reward!";
            
                //Update Account's Vote Points
                $go = ("UPDATE $db_a.account SET vp='$vp' WHERE username='$login'");
                $greater = 1;
              }
            }
            if($item == "")
            {
              //Item Is Invalid
              return'Invalid Item.';
            }
            else
            {
              if($greater == 1)
              {
                //Purchase Was UnSuccessful
                $status = "UnSuccessful";
            
                //Connect To Server Via Telnet Using Ra_Mail
                $telnet = fsockopen($host, $ra, $error, $error_str, 3);
                if($telnet)
                {

                  sleep(3);
                  fputs($telnet, ''.$rauser."\n");
                  sleep(3);
                  fputs($telnet, ''.$rapass."\n");
                  sleep(3);
            
		              //User's Account Name
                  $playername = $login;
            
                  //Send Items
                  fputs($telnet, ".send items $char \"{$subject}\" \"{$text}\" {$item} \n");
                  
                  sleep(3);
                  fclose($telnet);
              
                  //Item Was Sent, Purchase Was Successful
                  $exe = $query($go, $con)or die(mysql_error());
                  $status = "Successful";
                  
                }
                else
                {
                  //Telnet Connection Was Not Made
                  return"<br/>A Telnet connection issue occured: <i>".$error_str."</i><br>";
                }
                //Log Purchase
                $query("INSERT INTO $db_s.store_log (`type`, `character`, `item`, `cost`, `date`, `status`) VALUES ('$type', '$char', '$item', '$cost', '$date', '$status')") or die("Error: ".mysql_error());
                return'Item was sent via in-game mail.';
              }
              else
              {
              }
            }
          }
        }
      }
    }
  }
}

//Arena Ladder
class top
{
  public $top = array();
  public $top_race;
  
  function top()
  {
    global $query, $array, $db_s;
    
    if(isset($_GET['page']) == "realm" && isset($_GET['id']) == true)
    {
      $id = "";
      if(isset($_GET['id']))
      {
        $id = $_GET['id'];
      }
      $sql = $query("SELECT id, char_db FROM $db_s.realms WHERE id='$id'")or die(mysql_error());
      while($get = $array($sql))
      {
        $db_c = $get['char_db'];
      }
      $sql = $query("SELECT name, race, class, gender, totalKills, todayKills FROM $db_c.characters ORDER BY totalKills DESC LIMIT 0, 10")or die(mysql_error());
		  while($get = $array($sql))
		  {
		    $this->top[] = $get; 
		  }
    }
  }
}
?>