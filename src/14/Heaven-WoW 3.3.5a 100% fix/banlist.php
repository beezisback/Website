<?php

/**
 * TrinityCore Banlist
 * - Shows a list of all banned accounts
 *
 * @package TrinityCore Banlist
 * @author Filipper
 * @link http://iblizz.net/
 */

date_default_timezone_set('Europe/Berlin');

$host = 'localhost';    // hostname of mysql-server
$user = 'root';            // mysql-username
$pass = 'ascent';                // mysql-password
$data = 'characters';        // mysql-logon-database (default: logon)

function convert_date($timestamp)
{
    return date('d.m.Y H:i', $timestamp);
}

mysql_connect($host, $user, $pass);
mysql_select_db($data);

$result = mysql_query(
    'SELECT * FROM `character_banned` ORDER BY `bandate` DESC'
);

$i = 0;
while($data = mysql_fetch_assoc($result))
{
    $i++;
    $bans[$i] = $data;
    
    $bans[$i]['bandate'] = convert_date($data['bandate']);
    $bans[$i]['banreason'] = htmlspecialchars($data['banreason']);
    
    if($data['unbandate'] < $data['bandate'])
    {
        $bans[$i]['unbandate'] = 'Never';
    }
    else
    {
        $bans[$i]['unbandate'] = convert_date($data['unbandate']);
    }
    
    $name_result = mysql_query(
        "SELECT `bannedby` FROM `character_banned` WHERE `bannedby` = '" . $data['bannedby'] . "' LIMIT 1"
    );
    $name_data = mysql_fetch_assoc($name_result);
    
    if(!empty($name_data))
    {
        $bans[$i]['bannedby'] = $name_data['bannedby'];
    }
    else
    {
        $bans[$i]['bannedby'] = 'Unknown';
    }
    
    $acc_result = mysql_query(
        "SELECT `bannedby`, `last_ip` FROM `character_banned` WHERE `guid` = '" . $data['bannedby'] . "' LIMIT 1"
    );
    $acc_data = mysql_fetch_assoc($acc_result);
    
    if(!empty($acc_data))
    {
        $bans[$i]['character_banned'] = $acc_data['guid'];
       
    }
    
    $bans[$i]['active'] = ($data['active'] == '1') ? 'Active' : 'Inactive';
}


// output

if(!empty($bans))
{
    echo '<table rules = "all" style = "border: 1px solid #000;">';
    echo '<thead>
      
        <th><b>Ban-Date</b></th>
        <th><b>Unban-Date</b></th>
        <th><b>Banned by</b></th>
        <th><b>Reason</b></th>
        <th><b>Active / Inactive</b></th>
    </thead>
    <tbody>';
        
    foreach($bans as $ban)
    {
        echo '<tr>
            
            <td>' . $ban['bandate'] . '</td>
            <td>' . $ban['unbandate'] . '</td>
            <td>' . $ban['bannedby'] . '</td>
            <td>' . $ban['banreason'] . '</td>
            <td>' . $ban['active'] . '</td>
        </tr>';
    }

    echo '</tbody>
    </table>';
}
else
{
    echo '<p style="font-weight: bold;">There are no bans in database!</p>';
}

/**
 * End of file
 */
 ?>
 
