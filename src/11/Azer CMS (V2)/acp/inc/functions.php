<?php
if(isset($_POST['logout']))
{
  //Destroy Sessions
  session_unset();
  session_destroy();
  //Redirect
  header("Location: ./");
}

//Manage News
function news()
{
  global $connect, $db_a, $db_c, $db_s, $date;
  
  $v_id = "";
  $v_title = "";
  $v_body = "";
  
  function news_option()
  {
    global $connect, $db_a, $db_c, $db_s, $date;
    
    $get_news = mysql_query("SELECT id, title FROM $db_s.news ORDER BY id DESC");
    while($getn = mysql_fetch_array($get_news))
    {
      $g_title = $getn['title'];
      $g_id = $getn['id'];
      print'<option value="'.$g_id.'">'.$g_title.'</option>';
    }
  }

  if(isset($_POST['edit']))
  {
    $id = $_POST['option'];
    if($id >= 1)
    {
      $v_check = mysql_query("SELECT id, title, body FROM $db_s.news WHERE id='$id'");
      while($vget = mysql_fetch_array($v_check))
      {
        $v_body = $vget['body'];
        $v_title = $vget['title'];
        $v_id = $vget['id'];
      }
    }
  }

  function apply_news()
  {
    global $connect, $db_a, $db_c, $db_s, $date, $login;
    
    $date = date('M d, Y');
    
    if(isset($_POST['delete']))
    {
      $post_id = mysql_real_escape_string(stripslashes(htmlentities($_POST['postid'])));
      
      mysql_query("DELETE FROM $db_s.news WHERE id='$post_id'");
      
      header("Location: ./?page=manage_news");
    }
    else if(isset($_POST['post']))
    {
      $post_id = mysql_real_escape_string(stripslashes(htmlentities($_POST['postid'])));
      $post_title = mysql_real_escape_string(stripslashes(htmlentities($_POST['title'])));
      $post_body = mysql_real_escape_string(stripslashes(htmlentities($_POST['body'])));
      $post_avatar = mysql_real_escape_string(stripslashes(htmlentities($_POST['avatar'])));
      
      if($post_id >= 1)
      {
        mysql_query("UPDATE $db_s.news SET title='$post_title', body='$post_body', avatar='$post_avatar' WHERE id='$post_id'");
        
        header("Location: ./?page=manage_news");
      }
      else if($post_id == 0)
      {
        mysql_query("INSERT INTO $db_s.news (author, title, body, date, avatar) VALUES ('$login', '$post_title', '$post_body', '$date', '$post_avatar')");
      
        header("Location: ./?page=manage_news");
      }
    }
  }
?>
<form action="" method="post">
<input type="hidden" name="postid" value="<?php print $v_id; ?>">
<tr><td id="title">Title:</td> <td><input type="text" name="title" value="<?php print $v_title; ?>" autocomplete="off" class="news-title"></td></tr>
<tr><td id="title">Body:</td> <td><textarea name="body" class="news-body" id="news-body"><?php print $v_body; ?></textarea></td></tr>
<tr><td id="title">BBCode:</td> <td align="center">
<input type="button" value="Bold" onclick="formatText(body,'b')"> 
<input type="button" value="Italic" onclick="formatText(body,'i')"> 
<input type="button" value="Underline" onclick="formatText(body,'u')"> 
<input type="button" value="Img" onclick="formatText(body,'img')"> 
<input type="button" value="Url" onclick="formatText(body,'url')"> 
<input type="button" value="Mail" onclick="formatText(body,'mail')">
</td></tr>
<tr><td id="title">Smilies:</td> <td align="center">
<img src="./images/smilies/big_smile.png"     onclick="insertSmiley(':big_smile:')" /> 
<img src="./images/smilies/cool.png"     onclick="insertSmiley(':cool:')" /> 
<img src="./images/smilies/hmm.png"     onclick="insertSmiley(':hmm:')" /> 
<img src="./images/smilies/lol.png"     onclick="insertSmiley(':lol:')" /> 
<img src="./images/smilies/mad.png"     onclick="insertSmiley(':mad:')" /> 
<img src="./images/smilies/neutral.png"     onclick="insertSmiley(':neutral:')" /> 
<img src="./images/smilies/roll.png"     onclick="insertSmiley(':roll:')" /> 
<img src="./images/smilies/sad.png"     onclick="insertSmiley(':sad:')" /> 
<img src="./images/smilies/smile.png"     onclick="insertSmiley(':smile:')" /> 
<img src="./images/smilies/tongue.png"     onclick="insertSmiley(':tongue:')" /> 
<img src="./images/smilies/wink.png"     onclick="insertSmiley(':wink:')" /> 
<img src="./images/smilies/yikes.png"     onclick="insertSmiley(':yikes:')" />
<img src="./images/smilies/dsmile.png"     onclick="insertSmiley(':dsmile:')" />
<img src="./images/smilies/blush.png"     onclick="insertSmiley(':blush:')" />
</td></tr>
<tr>
<td id="title">Avatar:</td>
<td><table align="center" width="100%">
<tr><td style="border:none;"><img src="./images/avatars/Azer.gif" border="none"><br/><input type="radio" value="Azer" name="avatar" checked></td>
<td style="border:none;"><img src="./images/avatars/Hortus.gif" border="none"><br/><input type="radio" value="Hortus" name="avatar"></td>
<td style="border:none;"><img src="./images/avatars/Moricato.gif" border="none"><br/><input type="radio" value="Moricato" name="avatar"></td>
<td style="border:none;"><img src="./images/avatars/Mumper.gif" border="none"><br/><input type="radio" value="Mumper" name="avatar"></td>
<td style="border:none;"><img src="./images/avatars/Orlyia.gif" border="none"><br/><input type="radio" value="Orlyia" name="avatar"></td>
<td style="border:none;"><img src="./images/avatars/Vaeflare.gif" border="none"><br/><input type="radio" value="Vaeflare" name="avatar"></td>
<td style="border:none;"><img src="./images/avatars/Wrocas.gif" border="none"><br/><input type="radio" value="Wrocas" name="avatar"></td></tr>
</table></td></tr>
<tr><td id="title">Option:</td> <td align="center">
<select name="option" style="width:70%;"><option value="0">Delete / Edit: Leave Empty To Post News</option><?php news_option(); ?></select>
<input type="submit" name="delete" value="Delete"><input type="submit" name="edit" value="Edit"><input type="submit" name="post" value="Post"></td></tr>
<?php apply_news(); ?>
</form><?php
}
//End Manage News

//Manage Styles
function style()
{
  global $connect, $db_s;
  
  $access_list = mysql_query("SELECT id, name, active FROM $db_s.styles");
  $access_check = mysql_num_rows($access_list);
  
  if($access_check > 0)
  {
    print'<form action="" method="post">';
    
    while($accl = mysql_fetch_array($access_list))
    {
      print'<tr>
      <td><input type="hidden" name="daid" value="'.$accl['id'].'">'.$accl['id'].'</td>
      <td><input type="hidden" name="dglvl" value="'.$accl['name'].'">'.$accl['name'].'</td>
      <td><input type="hidden" name="drid" value="'.$accl['active'].'">'.$accl['active'].'</td>
      <td><input type="submit" name="delete" style="background:url(./images/delete.png); border:none; width:15px; height:15px; cursor:pointer;" value=""></td>
      </tr>';
    }
    print'<tr>
    <td><input type="text" name="aid"></td>
    <td><input type="text" name="glvl"></td>
    <td><input type="text" name="rid"></td>
    <td><input type="submit" name="save" style="background:url(./images/save.png); border:none; width:15px; height:15px; cursor:pointer;" value=""></td>
    </tr></form>';
  }
  else
  {
    print'<tr>
    <td>NA</td>
    <td>NA</td>
    <td>NA</td>
    <td>NA</td>
    </tr>
    <form action="" method="post">
    <tr>
    <td><input type="text" name="aid"></td>
    <td><input type="text" name="glvl"></td>
    <td><input type="text" name="rid"></td>
    <td><input type="submit" name="save" style="background:url(./images/save.png); border:none; width:15px; height:15px; cursor:pointer;" value=""></td>
    </tr></form>';
  }
  if(isset($_POST['delete']))
  {
    $aid = $_POST['daid'];
    $glvl = $_POST['dglvl'];
    $rid = $_POST['drid'];
    
    mysql_query("DELETE FROM $db_s.styles WHERE id='$aid' AND name='$glvl' AND active='$rid'");
    
    header("Location: ./?page=manage_styles");
  }
  if(isset($_POST['save']))
  {
    $aid = mysql_real_escape_string(stripslashes(htmlentities($_POST['aid'])));
    $glvl = mysql_real_escape_string(stripslashes(htmlentities($_POST['glvl'])));
    $rid = mysql_real_escape_string(stripslashes(htmlentities($_POST['rid'])));
    
    mysql_query("DELETE FROM $db_s.styles WHERE id='$aid' AND name='$glvl' AND active='$rid'");
    mysql_query("INSERT INTO $db_s.styles (id, name, active) VALUES ('$aid', '$glvl', '$rid')");
    
    header("Location: ./?page=manage_styles");
  }
}
//End Manage Styles

//Manage Forum Properties
function forum()
{
  global $connect, $db_s;
  
  $sql = mysql_query("SELECT active, path FROM $db_s.forum_prop");
  while($get = mysql_fetch_array($sql))
  {
    $a1 = "";
    $a0 = "";
    
    if($get['active'] == 1)
    {
      $a1 = 'checked="yes"';
    }
    else
    {
      $a0 = 'checked="yes"';
    }
    echo"<br/><br/>";
    echo"<table><form action=\"\" method=\"post\">";
    echo"<tr>";
    echo"<td>Bridge Status:</td>";
    echo"<td>On: <input type=\"radio\" name=\"status\" value=\"1\" {$a1}> Off: <input type=\"radio\" name=\"status\" value=\"0\" {$a0}></td>";
    echo"</tr>";
    
    echo"<tr>";
    echo"<td>Forum Path:</td>";
    echo"<td><input type=\"text\" name=\"path\" value=\"{$get['path']}\"> Example: <i>./forums</i></td>";
    echo"</tr>";
    
    echo"<tr>";
    echo"<td>Options:</td>";
    echo"<td><input type=\"submit\" name=\"save\" value=\"Save Settings\"><input type=\"submit\" name=\"cancel\" value=\"Cancel\"></td>";
    echo"</tr>";
    echo"</form></table>";
    
    echo"<br/><br/>";
    echo"<b>Note:</b> Leaving this feature on with no forums installed or location specified, will leave a nasty error on your site. Also make sure to turn the <b>Phpbb3</b> register page off, to make sure users get a forum and game account created.";
  }
  
  if(isset($_POST['cancel']))
  {
    header("Location: ?page=forum");
  }
  
  if(isset($_POST['save']))
  {
    $path = mysql_real_escape_string(stripslashes(htmlentities($_POST['path'])));
    $status = mysql_real_escape_string(stripslashes(htmlentities($_POST['status'])));
    
    $sql = mysql_query("UPDATE $db_s.forum_prop SET active='$status', path='$path'")or die(mysql_error());
    
    header("Location: ?page=forum");
  }
  
}
//End Manage Forums

//Manage Shoutbox
function shoutbox()
{
  global $connect, $db_a, $db_c, $db_s, $date;
  
  $get_shouts = mysql_query("SELECT id, author, body, date FROM $db_s.shouts ORDER BY id DESC");
  while($shout = mysql_fetch_array($get_shouts))
  {
    print'
    <tr><form action="" method="post">
    <td><input type="hidden" name="id" value="'.$shout['id'].'">'.$shout['id'].'</td>
    <td>'.$shout['author'].'</td>
    <td>'.$shout['body'].'</td>
    <td>'.$shout['date'].'</td>
    <td>
    <input type="submit" name="delete" style="background:url(./images/delete.png); border:none; width:15px; height:15px; cursor:pointer;" value="" title="Delete Single Shout">
    <input type="submit" name="truncate" style="background:url(./images/truncate.png); border:none; width:20px; height:15px; cursor:pointer;" value="" title="Delete All Shouts">
    </form></td>
    </tr>
    ';
  }
  
  if(isset($_POST['delete']))
  {
    $shout_id = mysql_real_escape_string(stripslashes(htmlentities($_POST['id'])));
    mysql_query("DELETE FROM $db_s.shouts WHERE id='$shout_id'");
    header("Location: ?page=manage_shoutbox");
  }
  
  if(isset($_POST['truncate']))
  {
    mysql_query("TRUNCATE $db_s.shouts");
    header("Location: ?page=manage_shoutbox");
  }
}
//End Manage Shoutbox

//Manage Vote Sites
function votesites()
{
  global $connect, $db_a, $db_c, $db_s, $date;
  
  if(isset($_POST['edit']))
  {
    $realm_id = mysql_real_escape_string(stripslashes(htmlentities($_POST['id'])));
    $get_realm = mysql_query("SELECT id, name, cost, url, img FROM $db_s.vote_sites WHERE id='$realm_id'");
  
    while($realm = mysql_fetch_array($get_realm))
    {
      print'
      <tr><form action="" method="post">
      <td><input type="hidden" name="id" value="'.$realm['id'].'">'.$realm['id'].'</td>
      <td><input type="text" name="name_post" value="'.$realm['name'].'" onfocus=\'if (this.value == "'.$realm['name'].'") this.value = "";\' onblur=\'if (!this.value){ this.value = "'.$realm['name'].'"; }\' style="width:65px;"></td>
      <td><input type="text" name="type_post" value="'.$realm['cost'].'" onfocus=\'if (this.value == "'.$realm['cost'].'") this.value = "";\' onblur=\'if (!this.value){ this.value = "'.$realm['cost'].'"; }\' style="width:35px;"></td>
      <td><input type="text" name="db_post" value="'.$realm['url'].'" onfocus=\'if (this.value == "'.$realm['url'].'") this.value = "";\' onblur=\'if (!this.value){ this.value = "'.$realm['url'].'"; }\'></td>
      <td><input type="text" name="port_post" value="'.$realm['img'].'" onfocus=\'if (this.value == "'.$realm['img'].'") this.value = "";\' onblur=\'if (!this.value){ this.value = "'.$realm['img'].'"; }\'></td>
      <td>
      <input type="submit" name="save" style="background:url(./images/save.png); border:none; width:15px; height:15px; cursor:pointer;" value="">
      </form></td>
      </tr>
      ';
    }
  }
  else
  {
    $get_realm = mysql_query("SELECT id, name, cost, url, img FROM $db_s.vote_sites");
    while($realm = mysql_fetch_array($get_realm)){
    
    print'<tr><form action="" method="post">
    <td><input type="hidden" name="id" value="'.$realm['id'].'">'.$realm['id'].'</td>
    <td>'.$realm['name'].'</td>
    <td>'.$realm['cost'].'</td>
    <td>'.$realm['url'].'</td>
    <td>'.$realm['img'].'</td>
    <td>
    <input type="submit" name="edit" style="background:url(./images/edit.png); border:none; width:15px; height:15px; cursor:pointer;" value=""> &nbsp; <input type="submit" name="delete" style="background:url(./images/delete.png); border:none; width:15px; height:15px; cursor:pointer;" value="">
    </form></td>
    </tr>';}
    print'
    <tr><form action="" method="post">
    <td>Auto</td>
    <td><input type="text" name="name_post" value="Site Name" onfocus=\'if (this.value == "Site Name") this.value = "";\' onblur=\'if (!this.value){ this.value = "Site Name"; }\' style="width:65px;"></td>
    <td><input type="text" name="type_post" value="Cost" onfocus=\'if (this.value == "Cost") this.value = "";\' onblur=\'if (!this.value){ this.value = "Cost"; }\' style="width:35px;"></td>
    <td><input type="text" name="db_post" value="Site Url" onfocus=\'if (this.value == "Site Url") this.value = "";\' onblur=\'if (!this.value){ this.value = "Site Url"; }\'></td>
    <td><input type="text" name="port_post" value="Site Image" onfocus=\'if (this.value == "Site Image") this.value = "";\' onblur=\'if (!this.value){ this.value = "Site Image"; }\'></td>
    <td>
    <input type="submit" name="add" style="background:url(./images/save.png); border:none; width:15px; height:15px; cursor:pointer;" value="">
    </form></td>
    </tr>
    ';

    if(isset($_POST['delete']))
    {
      $realm_id = mysql_real_escape_string(stripslashes(htmlentities($_POST['id'])));
      
      mysql_query("DELETE FROM $db_s.vote_sites WHERE id='$realm_id'");
      
      header("Location: ?page=manage_sites");
    }
    
    if(isset($_POST['add']))
    {
      $realm_name = mysql_real_escape_string(stripslashes(htmlentities($_POST['name_post'])));
      $realm_type = mysql_real_escape_string(stripslashes(htmlentities($_POST['type_post'])));
      $realm_db = mysql_real_escape_string(stripslashes(htmlentities($_POST['db_post'])));
      $realm_port = mysql_real_escape_string(stripslashes(htmlentities($_POST['port_post'])));
      
      mysql_query("INSERT INTO $db_s.vote_sites(name, cost, url, img) VALUES ('$realm_name', '$realm_type', '$realm_db', '$realm_port')");
      
      header("Location: ?page=manage_sites");
    }
  }
  if(isset($_POST['save']))
  {
    $realm_id = mysql_real_escape_string(stripslashes(htmlentities($_POST['id'])));
    $realm_name = mysql_real_escape_string(stripslashes(htmlentities($_POST['name_post'])));
    $realm_type = mysql_real_escape_string(stripslashes(htmlentities($_POST['type_post'])));
    $realm_db = mysql_real_escape_string(stripslashes(htmlentities($_POST['db_post'])));
    $realm_port = mysql_real_escape_string(stripslashes(htmlentities($_POST['port_post'])));
    
    mysql_query("UPDATE $db_s.vote_sites SET name='$realm_name', cost='$realm_type', url='$realm_db', img='$realm_port' WHERE id='$realm_id'");
    
    header("Location: ?page=manage_sites");
  }
}
//End Manage Vote Sites

//Manage Store
function store()
{
  global $connect, $db_a, $db_c, $db_s, $date;
  
  if(isset($_POST['edit']))
  {
    $realm_id = mysql_real_escape_string(stripslashes(htmlentities($_POST['id'])));
    $get_realm = mysql_query("SELECT id, name, item_id, amount, cost, type, realm FROM $db_s.store WHERE id='$realm_id'");
    
    while($realm = mysql_fetch_array($get_realm))
    {
      print'
      <tr><form action="?page=manage_store" method="post">
      <td><input type="hidden" name="id" value="'.$realm['id'].'">'.$realm['id'].'</td>
      <td><input type="text" name="name_post" value="'.$realm['name'].'" onfocus=\'if (this.value == "'.$realm['name'].'") this.value = "";\' onblur=\'if (!this.value){ this.value = "'.$realm['name'].'"; }\'></td>
      <td><input type="text" name="type_post" value="'.$realm['item_id'].'" onfocus=\'if (this.value == "'.$realm['item_id'].'") this.value = "";\' onblur=\'if (!this.value){ this.value = "'.$realm['item_id'].'"; }\'></td>
      <td><input type="text" name="db_post" value="'.$realm['amount'].'" onfocus=\'if (this.value == "'.$realm['amount'].'") this.value = "";\' onblur=\'if (!this.value){ this.value = "'.$realm['amount'].'"; }\' style="width:95px;"></td>
      <td><input type="text" name="port_post" value="'.$realm['cost'].'" onfocus=\'if (this.value == "'.$realm['cost'].'") this.value = "";\' onblur=\'if (!this.value){ this.value = "'.$realm['cost'].'"; }\' style="width:75px;"></td>
      <td><input type="text" name="limit_post" value="'.$realm['type'].'" onfocus=\'if (this.value == "'.$realm['type'].'") this.value = "";\' onblur=\'if (!this.value){ this.value = "'.$realm['type'].'"; }\' style="width:75px;"></td>
      <td><input type="text" name="realm_post" value="'.$realm['realm'].'" onfocus=\'if (this.value == "'.$realm['realm'].'") this.value = "";\' onblur=\'if (!this.value){ this.value = "'.$realm['realm'].'"; }\' style="width:75px;"></td>
      <td>
      <input type="submit" name="save" style="background:url(./images/save.png); border:none; width:15px; height:15px; cursor:pointer;" value="">
      </form></td>
      </tr>
      ';
    }
  }
  else
  {
    $get_realm = mysql_query("SELECT id, name, item_id, amount, cost, type, realm FROM $db_s.store");
    while($realm = mysql_fetch_array($get_realm))
    {
      print'<tr><form action="?page=manage_store" method="post">
      <td><input type="hidden" name="id" value="'.$realm['id'].'">'.$realm['id'].'</td>
      <td>'.$realm['name'].'</td>
      <td>'.$realm['item_id'].'</td>
      <td>'.$realm['amount'].'</td>
      <td>'.$realm['cost'].'</td>
      <td>'.$realm['type'].'</td>
      <td>'.$realm['realm'].'</td>
      <td>
      <input type="submit" name="edit" style="background:url(./images/edit.png); border:none; width:15px; height:15px; cursor:pointer;" value=""> &nbsp; <input type="submit" name="delete" style="background:url(./images/delete.png); border:none; width:15px; height:15px; cursor:pointer;" value="">
      </form></td>
      </tr>';
    }

    print'
    <tr><form action="?page=manage_store" method="post">
    <td>Auto</td>
    <td><input type="text" name="name_post" value="Item Name" onfocus=\'if (this.value == "Item Name") this.value = "";\' onblur=\'if (!this.value){ this.value = "Item Name"; }\'></td>
    <td><input type="text" name="type_post" value="Item Id" onfocus=\'if (this.value == "Item Id") this.value = "";\' onblur=\'if (!this.value){ this.value = "Item Id"; }\'></td>
    <td><input type="text" name="db_post" value="Item Amount" onfocus=\'if (this.value == "Item Amount") this.value = "";\' onblur=\'if (!this.value){ this.value = "Item Amount"; }\' style="width:95px;"></td>
    <td><input type="text" name="port_post" value="Item Cost" onfocus=\'if (this.value == "Item Cost") this.value = "";\' onblur=\'if (!this.value){ this.value = "Item Cost"; }\' style="width:75px;"></td>
    <td><input type="text" name="limit_post" value="Item Type" onfocus=\'if (this.value == "Item Type") this.value = "";\' onblur=\'if (!this.value){ this.value = "Item Type"; }\' style="width:75px;"></td>
    <td><input type="text" name="realm_post" value="Realm" onfocus=\'if (this.value == "Realm") this.value = "";\' onblur=\'if (!this.value){ this.value = "Realm"; }\' style="width:75px;"></td>
    <td>
    <input type="submit" name="add" style="background:url(./images/save.png); border:none; width:15px; height:15px; cursor:pointer;" value="">
    </form></td>
    </tr>
    ';

    if(isset($_POST['delete']))
    {
      $realm_id = mysql_real_escape_string(stripslashes(htmlentities($_POST['id'])));
      
      mysql_query("DELETE FROM $db_s.store WHERE id='$realm_id'");
      
      header("Location: ?page=manage_store");
    }
    
    if(isset($_POST['add']))
    {
      $realm_name = mysql_real_escape_string(stripslashes(htmlentities($_POST['name_post'])));
      $realm_type = mysql_real_escape_string(stripslashes(htmlentities($_POST['type_post'])));
      $realm_db = mysql_real_escape_string(stripslashes(htmlentities($_POST['db_post'])));
      $realm_port = mysql_real_escape_string(stripslashes(htmlentities($_POST['port_post'])));
      $realm_limit = mysql_real_escape_string(stripslashes(htmlentities($_POST['limit_post'])));
      $realm_post = mysql_real_escape_string(stripslashes(htmlentities($_POST['realm_post'])));
      
      mysql_query("INSERT INTO $db_s.store(name, item_id, amount, cost, type, realm) VALUES ('$realm_name', '$realm_type', '$realm_db', '$realm_port', '$realm_limit', '$realm_post')");
      
      header("Location: ?page=manage_store");
    }
  }

  if(isset($_POST['save']))
  {
    $realm_id = mysql_real_escape_string(stripslashes(htmlentities($_POST['id'])));
    $realm_name = mysql_real_escape_string(stripslashes(htmlentities($_POST['name_post'])));
    $realm_type = mysql_real_escape_string(stripslashes(htmlentities($_POST['type_post'])));
    $realm_db = mysql_real_escape_string(stripslashes(htmlentities($_POST['db_post'])));
    $realm_port = mysql_real_escape_string(stripslashes(htmlentities($_POST['port_post'])));
    $realm_limit = mysql_real_escape_string(stripslashes(htmlentities($_POST['limit_post'])));
    $realm_post = mysql_real_escape_string(stripslashes(htmlentities($_POST['realm_post'])));
    
    mysql_query("UPDATE $db_s.store SET name='$realm_name', item_id='$realm_type', amount='$realm_db', cost='$realm_port', type='$realm_limit', realm='$realm_post' WHERE id='$realm_id'");
    
    header("Location: ?page=manage_store");
  }
}
//End Manage Store

//Manage Accounts
//Search & Display
function accsearch()
{
  if(isset($_POST['search']))
  {
    global $connect, $db_a, $db_c, $db_s, $date;
    
    $acc_name = ucfirst(mysql_real_escape_string(stripslashes(htmlentities($_POST['acc_name']))));
    $get_account = mysql_query("SELECT id, username, email, expansion, locked, acp, staff_id, vp, dp FROM $db_a.account WHERE username='$acc_name' OR id='$acc_name' or email='$acc_name'");
    $check_ga = mysql_num_rows($get_account);
    if($check_ga >= 1)
    {
      while($acc = mysql_fetch_array($get_account))
      {
        $acp = $acc['acp']; if($acp == 1)
        {
          $acp = "Yes";
        }
        else
        {
          $acp = "No";
        }
        
        if($acc['expansion'] == 0)
        {
          $expansion = "Classic";
        }
        else if($acc['expansion'] == 1)
        {
          $expansion = "Bc";
        }
        else if($acc['expansion'] == 2)
        {
          $expansion = "Wotlk";
        }
        else
        {
          $expansion = "Cata";
        }
        
        if($acc['locked'] <= 0)
        {
          $locked = "No";
        }
        else
        {
          $locked = "Yes";
        }
        
        print'<tr><form action="?page=manage_accounts&action=edit" method="post">
        <td><input type="hidden" name="id" value="'.$acc['id'].'">'.$acc['id'].'</td>
        <td>'.$acc['username'].'</td>
        <td>'.$acc['email'].'</td>
        <td>'.$expansion.'</td>
        <td>'.$locked.'</td>
        <td>'.$acp.'</td>
        <td>'.$acc['staff_id'].'</td>
        <td>'.$acc['vp'].'</td>
        <td>'.$acc['dp'].'</td>
        <td>
        <input type="submit" name="edit" style="background:url(./images/edit.png); border:none; width:15px; height:15px; cursor:pointer;" value=""> &nbsp; <input type="submit" name="delete" style="background:url(./images/delete.png); border:none; width:15px; height:15px; cursor:pointer;" value="">
        </form></td>
        </tr>';
      }
    }
    else
    {
      print'<tr>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      </tr>';
    }
  }
}

//Edit, Delete & Save
function accedit()
{
  if(isset($_POST['edit']))
  {
    global $connect, $db_a, $db_c, $db_s, $date;
    
    $acc_id = mysql_real_escape_string(stripslashes(htmlentities($_POST['id'])));
    
    $get_account = mysql_query("SELECT id, username, email, expansion, locked, acp, staff_id, vp, dp FROM $db_a.account WHERE id='$acc_id'");
    $check_ga = mysql_num_rows($get_account);
    
    if($check_ga == 1)
    {
      while($acc = mysql_fetch_array($get_account))
      {
        if($acc['acp'] == "1")
        {
          $selected_1 = "selected=\"selected\"";
        }
        else
        {
          $selected_1 = "";
        }
        if($acc['acp'] === "")
        {
          $selected_2 = "selected=\"selected\"";
        }
        else
        {
          $selected_2 = "";
        }

        if($acc['locked'] >= "1")
        {
          $selected_3 = "selected=\"selected\"";
        }
        else
        {
          $selected_3 = "";
        }
        if($acc['locked'] === "")
        {
          $selected_4 = "selected=\"selected\"";
        }
        else
        {
          $selected_4 = "";
        }
        
        if($acc['expansion'] == "1")
        {
          $select_1 = "selected=\"selected\"";
        }
        else if($acc['expansion'] == "2")
        {
          $select_2 = "selected=\"selected\"";
        }
        else if($acc['expansion'] == "3")
        {
          $select_3 = "selected=\"selected\"";
        }
        else
        {
          $select_4 = "selected=\"selected\"";
        }
        
        print'<tr><form action="" method="post">
        <td><input type="hidden" name="id" value="'.$acc['id'].'">'.$acc['id'].'</td>
        <td>'.$acc['username'].'</td>
        <td><input type="text" name="email" value="'.$acc['email'].'"></td>
        <td><select name="expansion"><option value="3" '.$select_3.'>Cata</option><option value="2" '.$select_2.'>Wotlk</option><option value="1" '.$select_1.'>Bc</option><option value="0" '.$select_4.'>Classic</option></select></td>
        <td><select name="locked"><option value="0" '.$selected_4.'>No</option><option value="1" '.$selected_3.'>Yes</option></select></td>
        <td><select name="acp"><option value="0" '.$selected_2.'>No</option><option value="1" '.$selected_1.'>Yes</option></select></td>
        <td>'.$acc['staff_id'].'</td>
        <td><input type="text" name="vp" value="'.$acc['vp'].'" style="width:35px;"></td>
        <td><input type="text" name="dp" value="'.$acc['dp'].'" style="width:35px;"></td>
        <td>
        <input type="submit" name="save" style="background:url(./images/save.png); border:none; width:15px; height:15px; cursor:pointer;" value="">
        </form></td>
        </tr>';
      }
    }
    else
    {
      print'<tr>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      </tr>';
    }
  }
  
  if(isset($_POST['delete']))
  {
    global $connect, $db_a, $db_c, $db_s, $date;
    
    $acc_id = mysql_real_escape_string(stripslashes(htmlentities($_POST['id'])));
    
    mysql_query("DELETE FROM $db_a.account WHERE id='$acc_id'");
    
    header("Location: ?page=manage_accounts&action=search");
  
  }
  if(isset($_POST['save']))
  {
    global $connect, $db_a, $db_c, $db_s, $date;
    
    $acc_id = mysql_real_escape_string(stripslashes(htmlentities($_POST['id'])));
    $acc_email = mysql_real_escape_string(stripslashes(htmlentities($_POST['email'])));
    $acc_expan = mysql_real_escape_string(stripslashes(htmlentities($_POST['expansion'])));
    $acc_lock = mysql_real_escape_string(stripslashes(htmlentities($_POST['locked'])));
    $acc_acp = mysql_real_escape_string(stripslashes(htmlentities($_POST['acp'])));
    $vp = mysql_real_escape_string(stripslashes(htmlentities($_POST['vp'])));
    $dp = mysql_real_escape_string(stripslashes(htmlentities($_POST['dp'])));
    
    mysql_query("UPDATE $db_a.account SET email='$acc_email', expansion='$acc_expan', locked='$acc_lock', acp='$acc_acp', vp='$vp', dp='$dp' WHERE id='$acc_id'");
    $get_account = mysql_query("SELECT id, username, email, expansion, locked, acp, staff_id, vp, dp FROM $db_a.account WHERE id='$acc_id'");
    $check_ga = mysql_num_rows($get_account);
    
    if($check_ga == 1)
    {
      while($acc = mysql_fetch_array($get_account))
      {
        $acp = $acc['acp'];
        
        if($acp == 1)
        {
          $acp = "Yes";
        }
        else
        {
          $acp = "No";
        }
        
        if($acc['expansion'] == 0)
        {
          $expansion = "Classic";
        }
        else if($acc['expansion'] == 1)
        {
          $expansion = "Bc";
        }
        else if($acc['expansion'] == 2)
        {
          $expansion = "Wotlk";
        }
        else
        {
          $expansion = "Cata";
        }
        
        if($acc['locked'] <= 0)
        {
          $locked = "No";
        }
        else
        {
          $locked = "Yes";
        }
        
        print'<tr><form action="?page=manage_accounts&action=edit" method="post">
        <td><input type="hidden" name="id" value="'.$acc['id'].'">'.$acc['id'].'</td>
        <td>'.$acc['username'].'</td>
        <td>'.$acc['email'].'</td>
        <td>'.$expansion.'</td>
        <td>'.$locked.'</td>
        <td>'.$acp.'</td>
        <td>'.$acc['staff_id'].'</td>
        <td>'.$acc['vp'].'</td>
        <td>'.$acc['dp'].'</td>
        <td>
        <input type="submit" name="edit" style="background:url(./images/edit.png); border:none; width:15px; height:15px; cursor:pointer;" value=""> &nbsp; <input type="submit" name="delete" style="background:url(./images/delete.png); border:none; width:15px; height:15px; cursor:pointer;" value="">
        </form></td>
        </tr>';
      }
    }
    else
    {
      print'<tr>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      </tr>';
    }
  }
}
//End Manage Accounts

//Manage Server Access
function saccess()
{
  global $connect, $db_a, $db_c, $db_s;

  $access_list = mysql_query("SELECT id, gmlevel, RealmID FROM $db_a.account_access");
  $access_check = mysql_num_rows($access_list);
  
  if($access_check > 0)
  {
    while($accl = mysql_fetch_array($access_list))
    {
      print'<form action="" method="post"><tr>
      <td><input type="hidden" name="daid" value="'.$accl['id'].'">'.$accl['id'].'</td>
      <td><input type="hidden" name="dglvl" value="'.$accl['gmlevel'].'">'.$accl['gmlevel'].'</td>
      <td><input type="hidden" name="drid" value="'.$accl['RealmID'].'">'.$accl['RealmID'].'</td>
      <td><input type="submit" name="delete" style="background:url(./images/delete.png); border:none; width:15px; height:15px; cursor:pointer;" value=""></td>
      </tr></form>';
    }
  
    print'<form action="" method="post"><tr>
    <td><input type="text" name="aid"></td>
    <td><input type="text" name="glvl"></td>
    <td><input type="text" name="rid"></td>
    <td><input type="submit" name="save" style="background:url(./images/save.png); border:none; width:15px; height:15px; cursor:pointer;" value=""></td>
    </tr></form>';
  }
  else
  {
  print'<tr>
  <td>NA</td>
  <td>NA</td>
  <td>NA</td>
  <td>NA</td>
  </tr>
  <form action="" method="post">
  <tr>
  <td><input type="text" name="aid"></td>
  <td><input type="text" name="glvl"></td>
  <td><input type="text" name="rid"></td>
  <td><input type="submit" name="save" style="background:url(./images/save.png); border:none; width:15px; height:15px; cursor:pointer;" value=""></td>
  </tr></form>';
  }
  
  if(isset($_POST['delete']))
  {
    $aid = $_POST['daid'];
    $glvl = $_POST['dglvl'];
    $rid = $_POST['drid'];
    
    mysql_query("DELETE FROM $db_a.account_access WHERE id='$aid' AND gmlevel='$glvl' AND RealmID='$rid'");
    
    header("Location: ?page=manage_access");
  }
  
  if(isset($_POST['save']))
  {
    $aid = mysql_real_escape_string(stripslashes(htmlentities($_POST['aid'])));
    $glvl = mysql_real_escape_string(stripslashes(htmlentities($_POST['glvl'])));
    $rid = mysql_real_escape_string(stripslashes(htmlentities($_POST['rid'])));
    
    mysql_query("DELETE FROM $db_a.account_access WHERE id='$aid' AND gmlevel='$glvl' AND RealmID='$rid'");
    mysql_query("INSERT INTO $db_a.account_access (id, gmlevel, RealmID) VALUES ('$aid', '$glvl', '$rid')");
    
    header("Location: ?page=manage_access");
  }
}
//End Manage Server Access

//Manage Realms
function realmlist()
{
  global $connect, $db_a, $db_c, $db_s, $date;

  if(isset($_POST['edit']))
  {
    $realm_id = mysql_real_escape_string(stripslashes(htmlentities($_POST['id'])));
    $get_realm = mysql_query("SELECT id, name, type, char_db, port, ra_port, p_limit FROM $db_s.realms WHERE id='$realm_id'");
    while($realm = mysql_fetch_array($get_realm))
    {
    print'
    <tr><form action="" method="post">
    <td><input type="hidden" name="id" value="'.$realm['id'].'">'.$realm['id'].'</td>
    <td><input type="text" name="name_post" value="'.$realm['name'].'" onfocus=\'if (this.value == "'.$realm['name'].'") this.value = "";\' onblur=\'if (!this.value){ this.value = "'.$realm['name'].'"; }\'></td>
    <td><input type="text" name="type_post" value="'.$realm['type'].'" onfocus=\'if (this.value == "'.$realm['type'].'") this.value = "";\' onblur=\'if (!this.value){ this.value = "'.$realm['type'].'"; }\'></td>
    <td><input type="text" name="db_post" value="'.$realm['char_db'].'" onfocus=\'if (this.value == "'.$realm['char_db'].'") this.value = "";\' onblur=\'if (!this.value){ this.value = "'.$realm['char_db'].'"; }\' style="width:95px;"></td>
    <td><input type="text" name="port_post" value="'.$realm['port'].'" onfocus=\'if (this.value == "'.$realm['port'].'") this.value = "";\' onblur=\'if (!this.value){ this.value = "'.$realm['port'].'"; }\' style="width:75px;"></td>
    <td><input type="text" name="raport_post" value="'.$realm['ra_port'].'" onfocus=\'if (this.value == "'.$realm['ra_port'].'") this.value = "";\' onblur=\'if (!this.value){ this.value = "'.$realm['ra_port'].'"; }\' style="width:75px;"></td>
    <td><input type="text" name="limit_post" value="'.$realm['p_limit'].'" onfocus=\'if (this.value == "'.$realm['p_limit'].'") this.value = "";\' onblur=\'if (!this.value){ this.value = "'.$realm['p_limit'].'"; }\' style="width:75px;"></td>
    <td>
    <input type="submit" name="save" style="background:url(./images/save.png); border:none; width:15px; height:15px; cursor:pointer;" value="">
    </form></td>
    </tr>
    ';
    }
  }
  else
  {
    $get_realm = mysql_query("SELECT id, name, type, char_db, port, ra_port, p_limit FROM $db_s.realms");
    while($realm = mysql_fetch_array($get_realm))
    {
      print'<tr><form action="" method="post">
      <td><input type="hidden" name="id" value="'.$realm['id'].'">'.$realm['id'].'</td>
      <td>'.$realm['name'].'</td>
      <td>'.$realm['type'].'</td>
      <td>'.$realm['char_db'].'</td>
      <td>'.$realm['port'].'</td>
      <td>'.$realm['ra_port'].'</td>
      <td>'.$realm['p_limit'].'</td>
      <td>
      <input type="submit" name="edit" style="background:url(./images/edit.png); border:none; width:15px; height:15px; cursor:pointer;" value=""> &nbsp; <input type="submit" name="delete" style="background:url(./images/delete.png); border:none; width:15px; height:15px; cursor:pointer;" value="">
      </form></td>
      </tr>';
    }
    
    print'
    <tr><form action="" method="post">
    <td>Auto</td>
    <td><input type="text" name="name_post" value="Realm Name" onfocus=\'if (this.value == "Realm Name") this.value = "";\' onblur=\'if (!this.value){ this.value = "Realm Name"; }\'></td>
    <td><input type="text" name="type_post" value="Realm Type" onfocus=\'if (this.value == "Realm Type") this.value = "";\' onblur=\'if (!this.value){ this.value = "Realm Type"; }\'></td>
    <td><input type="text" name="db_post" value="Realm Char_Db" onfocus=\'if (this.value == "Realm Char_Db") this.value = "";\' onblur=\'if (!this.value){ this.value = "Realm Char_Db"; }\' style="width:95px;"></td>
    <td><input type="text" name="port_post" value="Realm Port" onfocus=\'if (this.value == "Realm Port") this.value = "";\' onblur=\'if (!this.value){ this.value = "Realm Port"; }\' style="width:75px;"></td>
    <td><input type="text" name="raport_post" value="Ra Port" onfocus=\'if (this.value == "Ra Port") this.value = "";\' onblur=\'if (!this.value){ this.value = "Ra Port"; }\' style="width:75px;"></td>
    <td><input type="text" name="limit_post" value="Realm Limit" onfocus=\'if (this.value == "Realm Limit") this.value = "";\' onblur=\'if (!this.value){ this.value = "Realm Limit"; }\' style="width:75px;"></td>
    <td>
    <input type="submit" name="add" style="background:url(./images/save.png); border:none; width:15px; height:15px; cursor:pointer;" value="">
    </form></td>
    </tr>
    ';

    if(isset($_POST['delete']))
    {
      $realm_id = mysql_real_escape_string(stripslashes(htmlentities($_POST['id'])));
      
      mysql_query("DELETE FROM $db_s.realms WHERE id='$realm_id'");
      
      header("Location: ?page=manage_realms");
    }
    
    if(isset($_POST['add']))
    {
      $realm_name = mysql_real_escape_string(stripslashes(htmlentities($_POST['name_post'])));
      $realm_type = mysql_real_escape_string(stripslashes(htmlentities($_POST['type_post'])));
      $realm_db = mysql_real_escape_string(stripslashes(htmlentities($_POST['db_post'])));
      $realm_port = mysql_real_escape_string(stripslashes(htmlentities($_POST['port_post'])));
      $realm_raport = mysql_real_escape_string(stripslashes(htmlentities($_POST['raport_post'])));
      $realm_limit = mysql_real_escape_string(stripslashes(htmlentities($_POST['limit_post'])));
      
      mysql_query("INSERT INTO $db_s.realms(name, type, char_db, port, ra_port, p_limit) VALUES ('$realm_name', '$realm_type', '$realm_db', '$realm_port', '$realm_raport', '$realm_limit')");
      
      header("Location: ?page=manage_realms");
    }
  }
  
  if(isset($_POST['save']))
  {
    $realm_id = mysql_real_escape_string(stripslashes(htmlentities($_POST['id'])));
    $realm_name = mysql_real_escape_string(stripslashes(htmlentities($_POST['name_post'])));
    $realm_type = mysql_real_escape_string(stripslashes(htmlentities($_POST['type_post'])));
    $realm_db = mysql_real_escape_string(stripslashes(htmlentities($_POST['db_post'])));
    $realm_port = mysql_real_escape_string(stripslashes(htmlentities($_POST['port_post'])));
    $realm_raport = mysql_real_escape_string(stripslashes(htmlentities($_POST['raport_post'])));
    $realm_limit = mysql_real_escape_string(stripslashes(htmlentities($_POST['limit_post'])));
    
    mysql_query("UPDATE $db_s.realms SET name='$realm_name', type='$realm_type', char_db='$realm_db', port='$realm_port', ra_port='$realm_raport', p_limit='$realm_limit' WHERE id='$realm_id'");
    
    header("Location: ?page=manage_realms");
  }
}
//End Manage Realms

//Manage Characters
function charealm()
{
  global $connect, $db_a, $db_c, $db_s, $date;
  
  $get_realms = mysql_query("SELECT name, char_db FROM $db_s.realms");
  while($realms = mysql_fetch_array($get_realms))
  {
    print'<option value="'.$realms['char_db'].'">'.$realms['name'].'</option>';
  }
}

//Search & Display
function charsearch()
{
  if(isset($_POST['search']))
  {
    global $connect, $db_a, $db_c, $db_s, $date;
    
    $char_name = ucfirst(mysql_real_escape_string(stripslashes(htmlentities($_POST['char_name']))));
    $realm = mysql_real_escape_string(stripslashes(htmlentities($_POST['charealm'])));
    
    $get_account = mysql_query("SELECT guid, account, name, race, class, gender, level, money, arenaPoints, totalHonorPoints FROM $realm.characters WHERE name='$char_name'");
    $check_ga = mysql_num_rows($get_account);
    
    if($check_ga == 1)
    {
      while($acc = mysql_fetch_array($get_account))
      {
        if($acc['gender'] == 0)
        {
          $gender = "Male";
        }
        else
        {
          $gender = "Female";
        }
        
        print'<tr><form action="?page=manage_characters&action=edit" method="post">
        <td><input type="hidden" name="charealm" value="'.$realm.'">'.$acc['account'].'</td>
        <td><input type="hidden" name="guid" value="'.$acc['guid'].'">'.$acc['guid'].'</td>
        <td>'.$acc['name'].'</td>
        <td>'.$acc['race'].'</td>
        <td>'.$acc['class'].'</td>
        <td>'.$gender.'</td>
        <td>'.$acc['level'].'</td>
        <td>'.$acc['money'].'</td>
        <td>'.$acc['arenaPoints'].'</td>
        <td>'.$acc['totalHonorPoints'].'</td>
        <td>
        <input type="submit" name="edit" style="background:url(./images/edit.png); border:none; width:15px; height:15px; cursor:pointer;" value=""> &nbsp; <input type="submit" name="delete" style="background:url(./images/delete.png); border:none; width:15px; height:15px; cursor:pointer;" value="">
        </form></td>
        </tr>';
      }
    }
    else
    {
      print'<tr>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      </tr>';
    }
  }
}

//Edit, Delete & Save
function charedit()
{
  if(isset($_POST['edit']))
  {
    global $connect, $db_a, $db_c, $db_s, $date;
    
    $char_id = mysql_real_escape_string(stripslashes(htmlentities($_POST['guid'])));
    $realm = mysql_real_escape_string(stripslashes(htmlentities($_POST['charealm'])));
    
    $get_account = mysql_query("SELECT guid, account, name, race, class, gender, level, money, arenaPoints, totalHonorPoints FROM $realm.characters WHERE guid='$char_id'");
    $check_ga = mysql_num_rows($get_account);
    
    if($check_ga == 1)
    {
      while($acc = mysql_fetch_array($get_account))
      {
        if($acc['gender'] == "0")
        {
          $selected_1 = "selected=\"selected\"";
        }
        else
        {
          $selected_2 = "selected=\"selected\"";
        }
        print'<tr><form action="" method="post"><input type="hidden" name="charealm" value="'.$realm.'">
        <td><input type="hidden" name="guid" value="'.$acc['guid'].'">'.$acc['guid'].'</td>
        <td><input type="text" name="account" value="'.$acc['account'].'" style="width:55px;"></td>
        <td><input type="text" name="name" value="'.$acc['name'].'"></td>
        <td><input type="text" name="race" value="'.$acc['race'].'" style="width:25px;"></td>
        <td><input type="text" name="class" value="'.$acc['class'].'" style="width:25px;"></td>
        <td><select name="gender"><option value="0" '.$selected_2.'>Male</option><option value="1" '.$selected_2.'>Female</option></select></td>
        <td><input type="text" name="level" value="'.$acc['level'].'" style="width:25px;"></td>
        <td><input type="text" name="money" value="'.$acc['money'].'" style="width:45px;"></td>
        <td><input type="text" name="ap" value="'.$acc['arenaPoints'].'" style="width:45px;"></td>
        <td><input type="text" name="honor" value="'.$acc['totalHonorPoints'].'" style="width:45px;"></td>
        <td>
        <input type="submit" name="save" style="background:url(./images/save.png); border:none; width:15px; height:15px; cursor:pointer;" value="">
        </form></td>
        </tr>';
      }
    }
    else
    {
      print'<tr>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      </tr>';
    }
  }
  
  if(isset($_POST['delete']))
  {
    global $connect, $db_a, $db_c, $db_s, $date;
    
    $realm = mysql_real_escape_string(stripslashes(htmlentities($_POST['charealm'])));
    $char_id = mysql_real_escape_string(stripslashes(htmlentities($_POST['guid'])));
    
    mysql_query("DELETE FROM $realm.characters WHERE guid='$char_id'");
    
    header("Location: ?page=manage_characters&action=search");
  }
  
  if(isset($_POST['save']))
  {
    global $connect, $db_a, $db_c, $db_s, $date;
    $realm = mysql_real_escape_string(stripslashes(htmlentities($_POST['charealm'])));
    $char_id = mysql_real_escape_string(stripslashes(htmlentities($_POST['guid'])));
    $account = mysql_real_escape_string(stripslashes(htmlentities($_POST['account'])));
    $name = mysql_real_escape_string(stripslashes(htmlentities($_POST['name'])));
    $race = mysql_real_escape_string(stripslashes(htmlentities($_POST['race'])));
    $class = mysql_real_escape_string(stripslashes(htmlentities($_POST['class'])));
    $gender = mysql_real_escape_string(stripslashes(htmlentities($_POST['gender'])));
    $level = mysql_real_escape_string(stripslashes(htmlentities($_POST['level'])));
    $money = mysql_real_escape_string(stripslashes(htmlentities($_POST['money'])));
    $ap = mysql_real_escape_string(stripslashes(htmlentities($_POST['ap'])));
    $honor = mysql_real_escape_string(stripslashes(htmlentities($_POST['honor'])));
    
    mysql_query("UPDATE $realm.characters SET account='$account', name='$name', race='$race', class='$class', gender='$gender', level='$level', money='$money', arenaPoints='$ap', totalHonorPoints='$honor' WHERE guid='$char_id'");
    $get_account = mysql_query("SELECT guid, account, name, race, class, gender, level, money, arenaPoints, totalHonorPoints FROM $realm.characters WHERE guid='$char_id'");
    $check_ga = mysql_num_rows($get_account);
    
    if($check_ga == 1)
    {
      while($acc = mysql_fetch_array($get_account))
      {
        if($acc['gender'] == 0){$gender = "Male";}else{$gender = "Female";}
        print'<tr><form action="?page=manage_characters&action=edit" method="post">
        <input type="hidden" name="charealm" value="'.$realm.'"><input type="hidden" name="acc" value="'.$acc['account'].'">
        <td>'.$acc['account'].'</td>
        <td><input type="hidden" name="guid" value="'.$acc['guid'].'">'.$acc['guid'].'</td>
        <td>'.$acc['name'].'</td>
        <td>'.$acc['race'].'</td>
        <td>'.$acc['class'].'</td>
        <td>'.$gender.'</td>
        <td>'.$acc['level'].'</td>
        <td>'.$acc['money'].'</td>
        <td>'.$acc['arenaPoints'].'</td>
        <td>'.$acc['totalHonorPoints'].'</td>
        <td>
        <input type="submit" name="edit" style="background:url(./images/edit.png); border:none; width:15px; height:15px; cursor:pointer;" value=""> &nbsp; <input type="submit" name="delete" style="background:url(./images/delete.png); border:none; width:15px; height:15px; cursor:pointer;" value="">
        </form></td>
        </tr>';
      }
    }
    else
    {
      print'<tr>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      <td>NA</td>
      </tr>';
    }
  }
}
//End Manage Characters

//Login Logs Function
function loginlogs()
{
  global $connect, $db_a, $db_c, $db_s, $date;
  
  $get_login_logs = mysql_query("SELECT id, user, date, status, ip, type FROM $db_s.login_log ORDER BY id DESC LIMIT 1000");
  while($gll = mysql_fetch_array($get_login_logs))
  {
    $status = $gll['status'];
  
    if($status != "Successful")
    {
      $display_status = "<font color=\"red\">{$status}</font>";
    }
    else
    {
      $display_status = "<font color=\"green\">{$status}</font>";
    }
  
    print'
    <tr>
    <td>'.$gll['id'].'</td>
    <td>'.$gll['user'].'</td>
    <td>'.$gll['ip'].'</td>
    <td>'.$gll['date'].'</td>
    <td>'.$display_status.'</td>
    <td>'.$gll['type'].'</td>
    </tr>
    ';
  }
}
//End Login Logs

//V.I.P Logs
function viplogs()
{
  global $connect, $db_s;
  
  $get_login_logs = mysql_query("SELECT id, type, user, email, cost, date, status FROM $db_s.vip_log ORDER BY id DESC LIMIT 1000");
  while($gll = mysql_fetch_array($get_login_logs))
  {
    $status = $gll['status'];
    if($status != "Successful")
    {
      $display_status = "<font color=\"red\">{$status}</font>";
    }
    else
    {
      $display_status = "<font color=\"green\">{$status}</font>";
    }
    
    print'
    <tr>
    <td>'.$gll['id'].'</td>
    <td>'.$gll['type'].'</td>
    <td>'.$gll['user'].'</td>
    <td>'.$gll['email'].'</td>
    <td>'.$gll['cost'].'</td>
    <td>'.$gll['date'].'</td>
    <td>'.$display_status.'</td>
    </tr>
    ';
  }
}
//End V.I.P Logs

//Store Logs
function storelogs()
{
  global $connect, $db_s;
  
  $get_login_logs = mysql_query("SELECT `id`, `type`, `character`, `item`, `cost`, `date`, `status` FROM $db_s.store_log ORDER BY id DESC LIMIT 1000");
  while($gll = mysql_fetch_array($get_login_logs))
  {
    $status = $gll['status'];
    
    if($status != "Successful")
    {
      $display_status = "<font color=\"red\">{$status}</font>";
    }
    else
    {
      $display_status = "<font color=\"green\">{$status}</font>";
    }
      
    print'
    <tr>
    <td>'.$gll['id'].'</td>
    <td>'.$gll['type'].'</td>
    <td>'.$gll['character'].'</td>
    <td>'.$gll['item'].'</td>
    <td>'.$gll['cost'].'</td>
    <td>'.$gll['date'].'</td>
    <td>'.$display_status.'</td>
    </tr>
    ';
  }
}
//End Store Logs

//Vote Logs
function votelogs()
{
  global $connect, $db_a, $db_c, $db_s, $date;
  
  $get_vote_logs = mysql_query("SELECT id, site, type, user, cost, date FROM $db_s.vote_log ORDER BY id DESC LIMIT 1000");
  while($gll = mysql_fetch_array($get_vote_logs))
  {
    print'
    <tr>
    <td>'.$gll['id'].'</td>
    <td>'.$gll['site'].'</td>
    <td>'.$gll['type'].'</td>
    <td>'.$gll['user'].'</td>
    <td>'.$gll['cost'].'</td>
    <td>'.$gll['date'].'</td>
    </tr>
    ';
  }
}
//End Vote Logs
?>