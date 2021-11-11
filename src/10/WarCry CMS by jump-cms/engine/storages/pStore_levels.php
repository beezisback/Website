<?php
if (!defined('init_engine'))
{	
	header('HTTP/1.0 404 not found');
	exit;
}

class LevelsData
{
	private $data = array(
		1 => array(
			'level' 		=> 60,
			'money' 		=> 20000000, //2k gold
			'bags' 			=> 4,
			'bagsId' 		=> 14155, //Mooncloth Bag
			'price' 		=> 30,
			'priceCurrency' => CURRENCY_SILVER
		),
		2 => array(
			'level' 		=> 70,
			'money' 		=> 30000000, //3k gold
			'bags' 			=> 4,
			'bagsId' 		=> 14156, //Bottomless Bag
			'price' 		=> 60,
			'priceCurrency' => CURRENCY_SILVER
	),
	3 => array(
			'level' 		=> 85,
			'money' 		=> 50000000, //5k gold
			'bags' 			=> 4,
			'bagsId' 		=> 21876, //Primal Mooncloth Bag
			'price' 		=> 80,
			'priceCurrency' => CURRENCY_SILVER
		),
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

