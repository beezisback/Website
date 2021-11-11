<?php
if (!defined('init_engine'))
{	
	header('HTTP/1.0 404 not found');
	exit;
}

class VoteSitesData
{
	public $data = array(
     1 => array('name' => 'XtremeTop100', 'url' => 'http://www.xtremetop100.com/in.php?site=1132332464', 'img' => '/template/style/images/vote/votenew.jpg'),
     2 => array('name' => 'TOPG', 'url' => 'http://topg.org/World-Of-Warcraft/in-396875', 'img' => '/template/style/images/vote/topg.gif'),
     3 => array('name' => 'Top100Arena', 'url' => 'http://www.top100arena.com/in.asp?id=84274 ', 'img' => '/template/style/images/vote/10.jpg'),
     4 => array('name' => 'OpenWoW', 'url' => 'http://www.openwow.com/vote=3186', 'img' => '/template/style/images/vote/vote_small.jpg'),
     5 => array('name' => 'GameSites200', 'url' => 'http://bgtop.net/vote/1416525999', 'img' => 'http://bgtop.net/images/bgtop8831.gif'),
   //6 => array('name' => 'WoWStatus', 'url' => 'http://www.wowstatus.net/in.php?server=776723', 'img' => '/template/style/images/vote/5.jpg'),//
	);

	public function __construct()
	{
		return true;
	}
	
	public function get($key)
	{
		if (!isset($this->data[$key]))
		{
			return false;
		}
		
		return $this->data[$key];
	}
	
	public function __destruct()
	{
		unset($this->data);
		return true;
	}
}
