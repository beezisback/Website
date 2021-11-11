<?php
//you looking at comments
//FOR SIMPLE BOX

//
$box_simple_short = new Template("styles/".$style."/box_simple_short.php");
$box_short = new Template("styles/".$style."/box_short.php");
$box_short->setVar("imagepath", 'styles/'.$style.'/images/');
$box_simple_short->setVar("imagepath", 'styles/'.$style.'/images/');
$box_news = new Template("styles/".$style."/news_box.php");
$box_news->setVar("imagepath", 'styles/'.$style.'/images/');
//NEWS RELATED TEMPLATE:
$tpl_news = new Template("styles/".$style."/news.php");

//viewing comments
if(isset($_GET['news']) && isset($_GET['page'])&& !isset($_GET['delete'])) 
{
   	$page = (int)$_GET['page'];
   	$news = (int)$_GET['news'];
	
	$res = $WEB_PDO->prepare("SELECT * FROM `news` WHERE `id` = :news LIMIT 1");
   	$res->bindParam(':news', $news, PDO::PARAM_INT);
	$res->execute();
  
    $cont1= '<a href="./">&laquo; Go Back</a>  ';

	$box_simple_short->setVar("content", $cont1);
    $comments_admin= $box_simple_short->toString();
	
   	$getforuminfo3 = $res->fetch(PDO::FETCH_ASSOC); 
  	
	unset($res);
	
	$bodyMessage = pun_linebreaks2($getforuminfo3['content']);
	$cont4_title.= $getforuminfo3['title'];
	$cont4.= parse_message($bodyMessage)."<strong>Posted by ".$getforuminfo3['author']." &nbsp;&nbsp; ".$getforuminfo3['datepost']."&nbsp;</strong><br><br>";
	
	//removed comments
			 
	$box_short->setVar("content_title", $cont4_title);
	$box_short->setVar("content", $cont4);
	$news_content1.= $box_short->toString();$cont4_title='';$cont4='';
}
else if(!isset($_GET['news']) && !isset($_GET['page'])&& isset($_GET['delete']))
{	
	if (isset($_GET['delete']) && isset($_GET['confirm'])) 
	{
		//delete specific news
		$delid = (int)$_GET['delete'];
		if (!$a_user['is_guest'] &&  $a_user[$db_translation['gm']]==$db_translation['az'])
		{
			$del = $WEB_PDO->prepare("DELETE FROM `news` WHERE `id` = :newsid LIMIT 1");
			$del->bindParam(':newsid', $delid, PDO::PARAM_INT);
			$del->execute() or error('Unable to delete the selected news. <br><br></strong>MySQL reported:<strong> '.$del->errorInfo().'.<br><br></strong>Suggestion:<strong> Re-importing sql database will probably fix the problem', __FILE__, __LINE__);
			unset($del);
			
			$box_simple_short->setVar('content',"News Deleted, redirecting...<meta http-equiv='refresh' content='2;url=./'>");
			$tpl_news->setVar("notices.news_notices", $box_simple_short->toString());
		}
	}
	else
	{
		$delid = (int)$_GET['delete'];
		$box_simple_short->setVar('content',"<center>Are you sure you want to delete the selected news?<br><br><a href='?delete=".$delid."&confirm=yes'>Yes</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='./'>No</a>");
		
		$tpl_news->setVar("notices.news_notices", $box_simple_short->toString());
	}
}
else //looking at main index
{
	//edit post
	if (isset($_POST['editnews']))
	{
		if (!$a_user['is_guest'] && $a_user[$db_translation['gm']]==$db_translation['az'])
		{
			$newsId = (int)$_POST['id'];
			$update = $WEB_PDO->prepare("UPDATE `news` SET `title` = :title, `content` = :content WHERE `id` = :newsid LIMIT 1");
			$update->bindParam(':title', $_POST['edittitle'], PDO::PARAM_STR);
			$update->bindParam(':content', pun_linebreaks($_POST['newsedit']), PDO::PARAM_STR);
			$update->bindParam(':newsid', $newsId, PDO::PARAM_INT);
			$update->execute() or error('Unable to edit the selected news. <br><br></strong>MySQL reported:<strong> '.$update->errorInfo().'.<br><br></strong>Suggestion:<strong> Re-importing sql database will probably fix the problem', __FILE__, __LINE__);
			unset($update);
		}
	}
	//edit post end
    
	$res = $WEB_PDO->prepare("SELECT * FROM `news` ORDER BY timepost DESC LIMIT 10");
	$res->execute() or error('Unable select news from database. <br><br></strong>MySQL reported:<strong> '.$res->errorInfo().'.<br><br></strong>Suggestion:<strong> Re-importing sql database you got in part 1 of site download will probably fix problem', __FILE__, __LINE__);
   
    while($forumselect3 = $res->fetch(PDO::FETCH_ASSOC))
    {
		$ico = $forumselect3['iconid'];
		if (!$a_user['is_guest'] && $a_user[$db_translation['gm']]==$db_translation['az'])
		{
			$admin_content = "
				  <span style='padding-right: 10px;'>
				   <a href='./?edit=".$forumselect3['id']."'>[edit]</a>&nbsp;&nbsp;
				   <a href='./?delete=".$forumselect3['id']."'>[x]</a>
				   &nbsp;&nbsp;
				  </span>"; 
		}
				  
		$content1.= '<a>'. $forumselect3['title']."</a>";
				 
		$bodyMessage = pun_linebreaks2($forumselect3['content']);
		
		if (!isset($_GET['edit']) or $_GET['edit']<>$forumselect3['id'])
		{
			$content2.= parse_message($bodyMessage);
		}
	 	else
		{
			if (!$a_user['is_guest'] && $a_user[$db_translation['gm']]==$db_translation['az'])
			{
				$content2.= '<form action="index.php" method="post"> Editing news with BB-code as format:<br/>
					<input name="edittitle" type="text" style="width:95%" value="'.pun_htmlspecialchars($forumselect3['title']).'" /><br><br><textarea name="newsedit" cols="" rows="15" style="width:95%">'.pun_htmlspecialchars($bodyMessage).'</textarea><br> <input name="id" type="hidden" value="'.(int)$_GET['edit'].'"/>
					<div id="log-b3"><input name="editnews" type="submit" value="Edit" /></div><br/><br/>
					</form>';
			}
			else
				$content2.= parse_message($bodyMessage);
			}
			
			//comments removed

			$postby = $forumselect3['author'];
			$added = $forumselect3['datepost'];
			
			//$content2.= "<strong>Posted by $forumselect3[author]&nbsp;&nbsp; $forumselect3[datepost]</strong>&nbsp;&nbsp;&nbsp;&nbsp;
			//<a href='?news=$forumselect3[id]&page=0'>$ccount comments</a>";
			
			$box_news->setVar("postby", $postby);
            $box_news->setVar("added", $added);
            $box_news->setVar("admin", $admin_content);
			$box_news->setVar("content_title", $content1);
			$box_news->setVar("content", $content2);
			$news_content1 .= $box_news->toString();
			$content1='';
			$content2='';
        }
		
		//if logged in		
		if (!$a_user['is_guest'] && $a_user[$db_translation['gm']]==$db_translation['az'])
		{
			if ($_POST['comm5'])
			{		
				$t1 = time();
				$t2 = date('F j, Y');
				$title = pun_htmlspecialchars($_POST['title']);
			 	$message = pun_linebreaks($_POST['comm4']);
				$author = $a_user[$db_translation['login']];
				
				$insert = $WEB_PDO->prepare("INSERT INTO `news` (title, content, iconid, timepost, datepost, author) VALUES (:title, :content, '0', :timepost, :datepost, :author)");
				$insert->bindParam(':title', $title, PDO::PARAM_STR);
				$insert->bindParam(':content', $message, PDO::PARAM_STR);
				$insert->bindParam(':timepost', $t1, PDO::PARAM_STR);
				$insert->bindParam(':datepost', $t2, PDO::PARAM_STR);
				$insert->bindParam(':author', $author, PDO::PARAM_STR);
				$insert->execute() or error('Unable to add news. <br><br></strong>MySQL reported:<strong> '.$insert->errorInfo().'.<br><br></strong>Suggestion:<strong> Re-importing the sql database will probably fix the problem', __FILE__, __LINE__);
				unset($insert);
				
				$box_simple_short->setVar("content", "News Posted, redirecting back to the home page.<meta http-equiv='refresh' content='1;url=./'>");
				$news_content2= $box_simple_short->toString();
			}
			else //admin area
			{
				$box_simple_short->setVar("content", 'Admin Tool: <a style="cursor:pointer" onclick="javascript:styleopen(\'adminpost\')">[Post news]</a>');
				$admin_box.= $box_simple_short->toString();
					
				$box_short->setVar("content_title", "Post News - only Admin accounts can post or edit news.");
				$box_short->setVar("content", '
					 <form action="" method="post">
					 Title: <br /><input name="title" type="text" style="width:97%" /><div class="spacer"></div>
					 News body: (BBCode and Smilies On)<br /><textarea name="comm4" style="width:518px;" rows="15"></textarea>
					 <div id="log-b3"><input name="comm5" type="submit" value="Post" /></div><br/><br/><br/>
					 </form>');
					
				$admin_box_form = $box_short->toString();
			}
		}
	}
	unset($res);
		
	$tpl_news->setVar("news_posts", $news_content1);
	$tpl_news->setVar("comments_admin", $comments_admin);
	$tpl_news->setVar("news_pagination", $news_pagination);
	if ($admin_box<>'')
	{
		$tpl_news->setVar("admin.news_admin", $admin_box);
	}
	if ($admin_box_form<>'')
	{
		$tpl_news->setVar("admin.news_admin_form", $admin_box_form);
	}
	if ($news_content2<>'')
	{
		$tpl_news->setVar("notices.news_notices", $news_content2);
	}

	//finally for all elements:
 	//news posts boxes:
	$news_content.= $tpl_news->toString();
 	//

