<?php
#- Azer CMS V1.5 Template System -#
#------------ Credits ------------#
# ------------------------------- #
#   Original Template System By   #
#               Azer              #
# ------------------------------- #
#   Edited & Working System By:   #
#            wilson212            #
# ------------------------------- #
#------------ Credits ------------#
//Function To Set Value
class template_system
{
  protected $values = array();
  protected $logged = array();
  public $l_delim = '{';
  public $r_delim = '}';

  public function set($key, $value)
  {
    $this->values[$key] = $value;
  }

  //Function To Get Style
  public function style()
  {
    global $query, $assoc, $row, $connect, $db_s;
    
    // Get our contents from DB
    $sql = $query("SELECT id, name, active FROM $db_s.styles WHERE active='1' ORDER BY id DESC LIMIT 1")or die(mysql_error());
    $get = $assoc($sql);
    
    // See the file exists
    $style = $get['name'];
    if(file_exists("./styles/{$get['name']}/"))
    {
      // File contents
      $this->source = file_get_contents("./styles/{$get['name']}/index.php")or die("Style Error: Index.php does not exist.");
      
      //var_dump($this->values); die();
      
      // Loop through each variable
      foreach ($this->values as $key => $value)
      {
        // If $value is an array, we need to process it as so
			if(is_array($value))
			{
				// Create our array block regex
				$regex = $this->l_delim . $key . $this->r_delim . "(.*)". $this->l_delim . '/' . $key . $this->r_delim;
				
				// Check for array blocks, if so then parse_pair
				while(preg_match("~" . $regex . "~iUs", $this->source, $match))
				{
					// Parse pair: Source, Match to be replaced, With what are we replacing?
					$replacement = $this->parse_pair($match[1], $key, $value);
					$this->source = str_replace($match[0], $replacement, $this->source);
				}
				
				// Create our array regex
				$key = $key .".";
				$regex = $this->l_delim . $key . "(.*)".$this->r_delim;

				// now see if there are any arrays
				while(preg_match("~" . $regex . "~iUs", $this->source, $match))
				{
					$replacement = $this->parse_array($match[1], $value);
					
					// Check for a false reading
					if($replacement === FALSE)
					{
						$replacement = "<<!". $key . $match[1] ."!>>";
					}
					$this->source = str_replace($match[0], $replacement, $this->source);
				}
			}
			
			// Parse single
			else
			{
				$match = $this->l_delim . $key . $this->r_delim;
				if(strpos($this->source, $match) !== FALSE)
				{
					$this->source = str_replace($match, $value, $this->source);
				}
			}
      }
       
      return aly(horde(logged(bbcode($this->source))));
    }
    else
    {
      die("The selected style does not exists @ ./styles/{$get['name']}/");
    }
     
  }
  
  // Main function for parsing blocks
  function parse_pair( $match, $key, $value )
  {
    // Init the emtpy main block replacment
		$str = '';
		$key_finder = $key .".";
		
		// Process the block loop here, We need to process each array $val
		foreach($value as $k => $v)
		{
			// Setup a few variables to tell what loop number we are on
			$block = str_replace("{#}", ++$k, $match);
			$v['#'] = ++$k;
			
			// Now we have an individiual block match foreach $val, now
			// lets loop through this block and replace psuedo blocks
			while(preg_match("~".$this->l_delim . $key_finder . "(.*)". $this->r_delim ."~iUs", $block, $replace))
			{
				// Assign the matches as $main
				$key = trim($replace[1]);
				
				// Parse as an array just in case it is. If not, it will return the value
				// of the non array anyways, so its a win win situation
				$main = $this->parse_array($key, $v);
				
				/*
					If we got a false return, the variable does not exists at all!
					We need to at least replace with something so we dont get an 
					infininte loop. So we add <<! $main !>> to be replaced later
				*/
				if($main === false) 
				{ 
					$block = str_replace($replace[0], "<<!".$key."!>>", $block); 
				}
				else
				{
					$block = str_replace($replace[0], $main, $block);
				}
			}
			
			$str .= $block;
		}
		return $str;
  }
  
  // Main function for parsing arrays
  function parse_array($key, $array)
  {
    // Have the default return as $key
		$replacement = false;
		
		// Check to see if this is even an array first
		// If not then we dont need to process anything
		if(!is_array($array))
		{
			return $array;
		}

		// Check if this is a multi-dimensional array
		// the period represents the levels of the array
		if(strpos($key, '.') !== false)
		{
      // we need to make it into a real array. only way to do that
      // right is to make it a string, then eval the string as php code
			$args = explode('.', $key);
			$s_key = '';
			
			// For each element or "level". add the brackets
			foreach($args as $arg)
			{
				if(!is_numeric($arg))
				{
					$s_key .= '[\''. $arg .'\']'; // you need to enclose strings
				}
				else
				{
					$s_key .= '['. $arg .']'; // dont need to enclose numbers
				}
			}
			
			// Check if variable exists in $val. always do that first because eval can do some wierd things hehe
			$isset = eval('if(isset($array'. $s_key .')) return 1; return 0;');
			if($isset == 1)
			{
				$replacement = eval('return $array'. $s_key .';');
			}
			else
			{
				$last = array_reverse($args);
				// Another error if you wish as the array element doesnt exist
			}
		}
		
		// Just a simple 1 stack array 
		else
		{	
			// Check if variable exists in $array
			if(isset($array[$key]))
			{
				$replacement = $array[$key];
			}
			else
			{
				// Do as you wish... this block is incase the variable is not at all available
			}
		}
		
		// You ethier have a FALSE ( look at the first line in function ),
		// or you have the value so return it :)
		return $replacement;
  }
}
?>