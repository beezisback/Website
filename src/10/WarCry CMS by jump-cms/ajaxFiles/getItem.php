<?PHP
if (!defined('init_ajax'))
{	
	header('HTTP/1.0 404 not found');
	exit;
}

$RealmId = $CURUSER->GetRealm();
$entry = ((isset($_GET['entry'])) ? (int)$_GET['entry'] : false);

function PullData($entry)
{
	global $CORE;
	
	$response = $CORE->getRemotePage(array(
		'host'	=> 'cata.cavernoftime.com',
		'port'	=> 80,
		'page'	=> '/item=' . $entry . '&power=true'
	));
	
	return $response['body'];
}

// Locales
$locale = array(
	'quality' => array(
		'Poor', 'Common', 'Uncommon', 'Rare', 'Epic', 'Legendary', 'Artifact', 'Heirloom',
	),
	'bonding'       => array(
		"Binds to account",                         "Binds when picked up",                                 "Binds when equipped",
		"Binds when used",                          "Quest Item",                                           "Quest Item"
	),
	"bagFamily"     => array(
		"Bag",                  "Quiver",           "Ammo Pouch",           "Soul Bag",                     "Leatherworking Bag",
		"Inscription Bag",      "Herb Bag",         "Enchanting Bag",       "Engineering Bag",              null, /*Key*/
		"Gem Bag",              "Mining Bag"
	),
	'inventoryType' => array(
		null,                   "Head",             "Neck",                 "Shoulder",                     "Shirt",
		"Chest",                "Waist",            "Legs",                 "Feet",                         "Wrist",
		"Hands",                "Finger",           "Trinket",              "One-Hand",                     "Off Hand", /*Shield*/
		"Ranged",               "Back",             "Two-Hand",             "Bag",                          "Tabard",
		null, /*Robe*/          "Main Hand",        "Off Hand",             "Held In Off-Hand",             "Projectile",
		"Thrown",               null, /*Ranged2*/   "Quiver",               "Relic"
	),
	'classes' => array(
		 2 => array(
			"Weapons", 
			array(
				"Axe",                  "Axe",              "Bow",                  "Gun",                          "Mace",
				"Mace",                 "Polearm",          "Sword",                "Sword",                        null,
				"Staff",                null,               null,                   "Fist Weapon",                  "Miscellaneous",
				"Dagger",               "Thrown",           null,                   "Crossbow",                     "Wand",
				"Fishing Pole"
			),
		),
		4 => array(
			"Armor", 
			array(
				 1 => "Cloth Armor",                 2 => "Leather Armor",           3 => "Mail Armor",              4 => "Plate Armor",             6 => "Shields",                 7 => "Librams",
				 8 => "Idols",                       9 => "Totems",                 10 => "Sigils",                 -6 => "Cloaks",                 -5 => "Off-hand Frills",        -8 => "Shirts",
				-7 => "Tabards",                    -3 => "Amulets",                -2 => "Rings",                  -4 => "Trinkets",                0 => "Miscellaneous (Armor)",
			)
		),
		1 => array("Containers", array(
			 0 => "Bags",                        3 => "Enchanting Bags",         4 => "Engineering Bags",        5 => "Gem Bags",                2 => "Herb Bags",               8 => "Inscription Bags",
			 7 => "Leatherworking Bags",         6 => "Mining Bags",             1 => "Soul Bags"
		)),
		0 => array("Consumables", array(
			-3 => "Item Enhancements (Temporary)",                               6 => "Item Enhancements (Permanent)",                           2 => array("Elixirs", array(1 => "Battle Elixirs", 2 => "Guardian Elixirs")),
			 1 => "Potions",                     4 => "Scrolls",                 7 => "Bandages",                0 => "Consumables",             3 => "Flasks",                  5 => "Food & Drinks",
			 8 => "Other (Consumables)"
		)),
		16 => array("Glyphs", array(
			 1 => "Warrior Glyphs",              2 => "Paladin Glyphs",          3 => "Hunter Glyphs",           4 => "Rogue Glyphs",            5 => "Priest Glyphs",           6 => "Death Knight Glyphs",
			 7 => "Shaman Glyphs",               8 => "Mage Glyphs",             9 => "Warlock Glyphs",         11 => "Druid Glyphs"
		)),
		 7 => array("Trade Goods", array(
			14 => "Armor Enchantments",          5 => "Cloth",                   3 => "Devices",                10 => "Elemental",              12 => "Enchanting",              2 => "Explosives",
			 9 => "Herbs",                       4 => "Jewelcrafting",           6 => "Leather",                13 => "Materials",               8 => "Meat",                    7 => "Metal & Stone",
			 1 => "Parts",                      15 => "Weapon Enchantments",    11 => "Other (Trade Goods)"
		 )),
		6 => array("Projectiles", array(                  2 => "Arrows",                  3 => "Bullets"     )),
		11 => array("Quivers",     array(                  2 => "Quivers",                 3 => "Ammo Pouches")),
		9 => array("Recipes", array(
			 0 => "Books",                       6 => "Alchemy Recipes",         4 => "Blacksmithing Plans",     5 => "Cooking Recipes",         8 => "Enchanting Formulae",     3 => "Engineering Schematics",
			 7 => "First Aid Books",             9 => "Fishing Books",          11 => "Inscription Techniques", 10 => "Jewelcrafting Designs",   1 => "Leatherworking Patterns",12 => "Mining Guides",
			 2 => "Tailoring Patterns"
		)),
		 3 => array("Gems", array(
			 6 => "Meta Gems",                   0 => "Red Gems",                1 => "Blue Gems",               2 => "Yellow Gems",             3 => "Purple Gems",             4 => "Green Gems",
			 5 => "Orange Gems",                 8 => "Prismatic Gems",          7 => "Simple Gems"
		)),
		15 => array("Miscellaneous", array(
			-2 => "Armor Tokens",                3 => "Holiday",                 0 => "Junk",                    1 => "Reagents",                5 => "Mounts",                 -7 => "Flying Mounts",
			 2 => "Small Pets",                  4 => "Other (Miscellaneous)"
		)),
		10 => "Currency",
		12 => "Quest",
		13 => "Keys",
	),
);

if (!($data = $CACHE->get('world/items/item_store_data_' . $RealmId . '_' . $entry)))
{
    $data = PullData($entry);
	
	// remove the javascript function and leave the json data only
	$data = substr($data, strpos($data, "{"));
	$data = substr($data, 0, strrpos($data, '}') + 1);
	
	// fix the json formatting
	$data = str_replace("'", "\"", $data);
	$data = str_replace("name_enus", "\"name_enus\"", $data);
	$data = str_replace("quality", "\"quality\"", $data);
	$data = str_replace("icon", "\"icon\"", $data);
	$data = str_replace("tooltip_enus", "\"tooltip_enus\"", $data);
	
	$data = json_decode($data, true);
	
	// Get some more item data
	$res = $DB->prepare("SELECT * FROM `data_cata_15595_itemtemplate` WHERE `entry` = :id LIMIT 1;");
	$res->bindParam(':id', $entry, PDO::PARAM_INT);
	$res->execute();
	
	if ($res->rowCount() > 0)
	{
		//Fetch the item data
		$extraData = $res->fetch();
		
		// Int values
		$data['classInt'] = $extraData['class'];
		$data['subclassInt'] = $extraData['subclass'];
		$data['inventoryTypeInt'] = $extraData['InventoryType'];
		$data['itemLevel'] = $extraData['ItemLevel'];
		$data['quality_enus'] = $locale['quality'][$data['quality']];
		
		// Get the bonding string
		$data['bonding'] = $locale['bonding'][$extraData['bonding']];
		
		// Get the inventory type
		$invType = $locale['inventoryType'][$extraData['InventoryType']];
		
		if ($invType != null)
			$data['inventoryType'] = $invType;
		
		// Get the classes
		$class = $locale['classes'][$extraData['class']];
		
		// Check if the class has subclass
		if (is_array($class))
		{
			$data['class'] = $class[0];
			$data['subclass'] = $class[1][$extraData['subclass']];
		}
		else
		{
			$data['class'] = $class;
		}
	}
	unset($res);

    //Cache server status for 30 seconds
    $CACHE->store('world/items/item_store_data_' . $RealmId . '_' . $entry, $data, strtotime('+1 month', 0));
}

header('Content-Type: application/json');
//header('Content-Type: text/plain');
echo json_encode($data);
