<?php
//enter your email address
$onebip_config['account'] = 'andra778@yahoo.com';

$onebip_config['currency'] = 'EUR'; //Currency you want people to pay you with (EUR, USD, BGN etc...)
$onebip_config['currencySymbol'] = '&euro;';
$onebip_config['country'] = 'ES'; //the country you are (US, ES, UK, GB etc...)

//choose your Onebip Button
/*
http://www.onebip.com/tools/bts/btn01.gif
http://www.onebip.com/tools/bts/btn02.gif
http://www.onebip.com/tools/bts/btn03.gif
http://www.onebip.com/tools/bts/btn04.gif
http://www.onebip.com/tools/bts/btn05.gif
http://www.onebip.com/tools/bts/btn06.gif
http://www.onebip.com/tools/bts/btn07.gif
http://www.onebip.com/tools/bts/btn08.gif
http://www.onebip.com/tools/bts/btn09.gif
http://www.onebip.com/tools/bts/btn10.gif
http://www.onebip.com/tools/bts/btn20.gif
*/
$onebip_config['btn'] = 'http://www.onebip.com/tools/bts/btn20.gif';

//please setup your api key in your onebip account and copy it to this variable
$onebip_config['apiKey'] = 'pertamax05012012';

//product keys should be unique
$onebip_config['products'] = array(
	//Unique Key,        //Points to add //Description of the product              //price must be fully digits
	'903900729' => array('points' => 1, 'descr' => 'Heaven WoW 1 Donation Point.', 'price' => '100'), //100 means 1.00, please do not use any symbols or letters
	'462663054' => array('points' => 3, 'descr' => 'Heaven WoW 3 Donation Points.', 'price' => '200'),
	'150348223' => array('points' => 8, 'descr' => 'Heaven WoW 8 Donation Points.', 'price' => '700'),
	'828223197' => array('points' => 10, 'descr' => 'Heaven WoW 10 Donation Points.', 'price' => '1000'),
	'711149445' => array('points' => 20, 'descr' => 'Heaven WoW 20 Donation Points.', 'price' => '2000'),
);

//Do not change developers porpose only!
$onebip_config['debug'] = false;
$onebip_config['debug_file'] = '';

?>