<?php
if (!defined('init_ajax'))
{	
	header('HTTP/1.0 404 not found');
	exit;
}

$realm = (int)$_GET['id'];
$timeout = 0.5;

if (($data = $CACHE->get('realm_status_' . $realm)) === false)
{
	$sock = @fsockopen($realms_config[$realm]['address'], $realms_config[$realm]['port'], $errno, $errstr, $timeout);
    if ($sock)
    {
        $status = '1';
    } 
    else
    {
        $status = '0';
    }
    @fclose($sock);
    unset($sock);
	
	$data['status'] = $status;
	
	//load Realm Stats module
	$CORE->load_ServerModule('realm.stats');
	$stats = new server_RealmStats();
	$stats->setRealm($realm);
	$stats->prepareUptimeRow();
	
	$data['uptime'] = $stats->getUptimeRow();
	
	unset($stats);
	
	//Cache server status for 30 seconds
	$CACHE->store('realm_status_' . $realm, $data, "30");
}

header('Content-Type: application/json');
echo json_encode($data);

exit;