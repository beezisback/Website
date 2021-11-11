<?php
require "./include/common.php"; 
?>
<?php
$q=$_GET["q"];
if(isset($_GET['q'])){ 

						if($_GET['q']){
	                         $lookup = htmlspecialchars(mysql_real_escape_string(strip_tags($_GET['q'])));
							 $query = mysql_query("SELECT * FROM vote_items WHERE name LIKE '$lookup%' AND `show` = 'yes' AND realm = '1' OR name LIKE '$lookup%' AND `show` = 'yes' AND realm = '1' ORDER BY name LIMIT 1");
							 $num = mysql_num_rows($query);
							 
							  while ($items = mysql_fetch_assoc($query))
							  {		
							  	$vote_costs = mysql_query("SELECT * FROM vote_costs WHERE start_itemlevel <= ".$items["ItemLevel"]." AND end_itemlevel >= ".$items["ItemLevel"]." LIMIT 1") or die (mysql_error());
                                $row = mysql_fetch_assoc($vote_costs);
                                  if (!$row)
                                  $cost = '100';
							      //$donate = $row["dp"];
                                 else
								 if ($items["custom"]=="1"){          
							            $cost = $row["points"];
                                        //$donate = $row["dp"];
										echo "<br>";
										echo "<a class='q".$items['Quality']."' href='http://classic.cavernoftime.com/item=".$items['entry']."' target='_blank'><b><font size='4'>".$items['name']."</b></a></font>";									
										echo "<br>";
									//	echo " <span> | </span>";
										echo " <span> DonatePoints: <b>".$cost."</b> </span>";
										echo '<span><input type="hidden" name="itemsgrup" value="'.$items['entry'].'" id="'.$items['entry'].'" /></span>';									
										echo '</td></tr>';
										 }
								        else
							           	 {
                                        $cost = $row["points"];
								        $donate = $row["dp"];
										echo "<br>";
										echo "<a class='q".$items['Quality']."' href='http://classic.cavernoftime.com/item=".$items['entry']."' target='_blank'><b><font size='4'>".$items['name']."</b></a></font>";									
										echo "<br><span>VotePoints: <b>".$cost."</b></span>";
										echo " <span><b> | </b></span>";
										echo " <span> DonatePoints: <b>".$donate."</b> </span>";
										echo '<span><input type="hidden" name="itemsgrup" value="'.$items['entry'].'" id="'.$items['entry'].'" /></span>';									
										echo '</td></tr>';
							
						}}
									
				  //reduce points
		if ($a_user['vp']>=$cost OR $a_user['dp']>=$donate)
		{
			echo  "<br /><br /><b>Info:</b>You have enough points to get that item.";
			echo'</table><br/><br/>
							  <table border="0" width="650px" align="center" cellpadding="0" cellspacing="0">
							  <div class="new_vote_searchdiv" align="center">
							       <b>Options:</b>
								   <br />
							 <select name="character" style="width: 200px;background-color: #0F0F0F;color: #ffcf00;border: 1px solid #1e1e1e; font-size: 14px; height: 29px;"><option value="0">Select your character</option>';
							//#########################################CHAR START
								$i=0;$j=$_SESSION['realm'];
							
								    mysql_select_db("characters");
									mysql_select_db($realm[1]['db'])or error('Unable to select realm database. Probabley you misspelled database name');
									$result = mysql_query("SELECT * FROM ".$db_translation['characters']." WHERE ".$db_translation['characters_acct']."='".$a_user[$db_translation['acct']]."'") or die (mysql_error());
									
									while ($char = mysql_fetch_assoc($result))
									{
										echo "<option value='".$char[$db_translation['characters_guid']]."-1'>".$realm[1]['']."".$char[$db_translation['characters_name']]."</option>";
										
										$i++;
									}

								if ($i=='0')
									
							{
						    echo "<option value='none'>You do not have any characters</option>";
							} 
							//go back to default db selection
							$db->select_db($db_name);                            	
							echo  "</select> ";
							//#########################################CHAR END
                            echo '<br /><br /><div id="log-b3"><input style="border: 0px solid black; width:150px" class="shop_button" name="action" value="BUY ITEM" type="submit"><br /><br />';
		                    }
		                   else
		                    {
			                echo '<br /><br /><b>Info:</b>You don\'t have enough points<br /><br />';
		                    }			  
						    } 
						   else 
						    {
					        echo '<tr><td colspan="0" align="center"><center><h3>Try again!</h3></center></td></tr>';
					        }
					        } 
					       else 
					        {
					        echo '<tr><td colspan="0" align="center"></td></tr>';				
} 		
?>
