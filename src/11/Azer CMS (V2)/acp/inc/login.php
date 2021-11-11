<?php
//Login Function
function login()
{
  if(isset($_POST['login']))
  {
    global $connect, $db_a, $db_c, $db_s, $date, $query, $num, $_CLEAN;
    
    //Post Username, Strip It, And UpperCase It
    $username = ucfirst($_CLEAN['username']);
    
    if(empty($_POST['username']))
    {
      $username = "Anonymous";
    }
    
    //Post Password, Strip It
    $password = $_CLEAN['password'];
    
    //Post Staff-Id, Strip It
    $sid = $_CLEAN['sid'];
    
    //Encrypt Password With Sha1 Salty Hash
    $password = sha1(strtoupper($username) . ":" . strtoupper($password));
    
    //Validate User
    $get_admin = $query("SELECT username, sha_pass_hash, acp, staff_id FROM $db_a.account WHERE username='$username' AND sha_pass_hash='$password' AND acp='1' AND staff_id='$sid'")or die(mysql_error());
    $got_admin = $num($get_admin);
    
    if($got_admin == 1)
    {
      //User Valid, Set Session
      $sql = $query("INSERT INTO $db_s.login_log (user, date, status, ip, type) VALUES ('$username', '$date', 'Successful', '$_SERVER[REMOTE_ADDR]', 'Acp')")or die(mysql_error());
      
      //Set Session
      $_SESSION['acp'] = "$username";
      
      //Redirect
      header("Location: ./");
    }
    else
    {
      //User InValid, Redirect
      $sql = $query("INSERT INTO $db_s.login_log (user, date, status, ip, type) VALUES ('$username', '$date', 'UnSuccessful', '$_SERVER[REMOTE_ADDR]', 'Acp')")or die(mysql_error());
      
      //Redirect
      header("Location: ./");
    }
  }
}
//End Login
?>