<?php
if (!defined('init_engine'))
{	
	header('HTTP/1.0 404 not found');
	exit;
}

class multipleErrors
{
	private $multipleErrors;
	public $currentMultipleError = NULL;
	private $errorKeys = array();
	public $success = array();
	
	public function __construct($key)
	{
		$this->multipleErrors[$key] = NULL;
		$this->currentMultipleError = $key;
		$this->errorKeys[] = $key;
	}
	
	public function NewInstance($key)
	{
		$this->multipleErrors[$key] = NULL;
		$this->currentMultipleError = $key;
		$this->errorKeys[] = $key;
	}
	
	/**
	** onSuccess set's up the success parameters
	**
	** Parameters:
	** ----------------------------------------------------------
	** $message 		- The message witch will be returned on success trigger
	** $redirect 		- URL to redirect to on success trigger
	** $key (optional) 	- Set's up the parameters for the given key
	**
	**/
	public function onSuccess($message, $redirect, $key = false)
	{
		if (!$key)
		{
			$this->success[$this->currentMultipleError]['message'] = $message;
			$this->success[$this->currentMultipleError]['redirect'] = $redirect;
		}
		else
		{
			$this->success[$key]['message'] = $message;
			$this->success[$key]['redirect'] = $redirect;
		}
	}
	
	public function Add($text, $key = false)
	{
		if (!$key)
		{
			$this->multipleErrors[$this->currentMultipleError][] = $text;
		}
		else
		{
			$this->multipleErrors[$key][] = $text;
		}
	}
	
	public function multipleError_saveFormData($data, $key = false)
	{
		if (!$key)
		{
			$_SESSION['multipleErrors'.$this->currentMultipleError.'FormData'] = $data;
		}
		else
		{
			$_SESSION['multipleErrors'.$key.'FormData'] = $data;
		}
	}

	public function multipleError_accessFormData($key)
	{
		if (isset($_SESSION['multipleErrors'.$key.'FormData']) and !empty($_SESSION['multipleErrors'.$key.'FormData']))
		{
			$data = $_SESSION['multipleErrors'.$key.'FormData'];
			
			unset($_SESSION['multipleErrors'.$key.'FormData']);
			
			return $data;
		}
		
		return false;
	}
	
	public function Check($redirect = false, $key = false)
	{
	  global $config, $_POST;
	  
		if (!$key)
		{
			$key = $this->currentMultipleError;
		}
		
		//check if we got any errors
		if (isset($this->multipleErrors[$key]) and is_array($this->multipleErrors[$key]))
		{
			//if no redirect is passed just print
			if (!$redirect)
			{
				foreach($this->multipleErrors[$key] as $val)
				{
					echo $val, '<br>';
				}
			}
			else
			{
				//save the captured errors to our session
				$_SESSION['multipleErrors'.$key] = $this->multipleErrors[$key];
				
				//save the form data if we got some
				if (isset($_POST) and !empty($_POST))
				{
					$this->multipleError_saveFormData($_POST, $key);
				}
				
				//call the shutdown
				Shutdown::Execute();
				
				//redirect
				header("Location: ".$config['BaseURL'].$redirect);
			}
			
			exit;
		}
	}
	
	/**
	**  Prints the error(s) passed instantly
	**
	**  Parameters:
	**  --------------------------------------------------
	**  $message 	- The error that will be printed, string or array
	**  $print 		- If set to false the errors will be returned as string
	**
	**/
	public function iPrint($message = false, $print = true, $autoWidth = false)
	{
		if ($message)
		{
			$errors = '';
			if (is_array($message))
			{
				//handle array
				foreach($message as $val)
				{
					$errors .= $val . '<br>';
				}	
				$message = $errors;			
			}
			
			$errors = '<div class="container_3 red" align="left" '.($autoWidth ? 'style="width: auto;"' : '').'><span class="error_icons atention"></span><p>'.$message.'</p></div>';			
			
			if ($print)
			{
				echo $errors;
			}
			else
			{
				return $errors;
			}
		}
		else
		{
			return false;
		}
	}
	
	public function DoPrint($key = false, $autoWidth = false)
	{
		if (!$key)
		{
			$key = $this->currentMultipleError;
		}
		
		//if we got errors, print em
		if (isset($_SESSION['multipleErrors'.$key]))
		{
			$errors = '';
			foreach($_SESSION['multipleErrors'.$key] as $val)
			{
				$errors .= '<div class="container_3 red wide fading-notification" align="left" '.($autoWidth ? 'style="width: auto;"' : '').'><span class="error_icons atention"></span><p>'.$val.'</p></div>';
			}
			
			//unset the session data
			unset($_SESSION['multipleErrors'.$key]);
						
			return $errors;
		}
	  
	  return false;
	}

	public function PrintAlertBox($key = false)
	{
		if (!$key)
		{
			$key = $this->currentMultipleError;
		}
		
		//if we got errors, print em
		if (isset($_SESSION['multipleErrors'.$key]))
		{
			$errors = '<script>
			$(function()
			{
				$.fn.WarcryAlertBox(\'open\', \'<p>';
				
			foreach($_SESSION['multipleErrors'.$key] as $val)
			{
				$errors .= $val.'<br />';
			}
			
			$errors .= '</p>\');
			});
			</script>';
			
			//unset the session data
			unset($_SESSION['multipleErrors'.$key]);
						
			return $errors;
		}
	  
	  return false;
	}
	
	/**
	** triggerSuccess, parameters must be setup by onSuccess() function
	**
	** Parameters:
	** ------------------------------------------------------------------------------------------------------------
	** $key (optional) 	- The key for witch the success should be triggerd, if none specifed current will be used
	**
	** Returns:
	** ------------------------------------------------------------------------------------------------------------
	** success 	- Returns nothing
	** error	- Returns echos error string and returns false
	**
	**/
	public function triggerSuccess($key = false)
	{
	  global $config;
	  
		if (!$key)
		{
			$key = $this->currentMultipleError;
		}
		
		if (isset($this->success[$key]))
		{
			//save the success message
			$_SESSION['multipleErrors'.$key.'_success'] = $this->success[$key]['message'];
			//call the shutdown
			Shutdown::Execute();
			//redirect
			header("Location: ".$config['BaseURL'] . $this->success[$key]['redirect']);
			exit;
		}
		else
		{
			echo '<br> triggerError() has no record with key: '. $key . '.<br>';
			return false;
		}
	}
	
	public function registerSuccess($message, $key = false)
	{
		if (!$key)
		{
			$key = $this->currentMultipleError;
		}
		
		$_SESSION['multipleErrors'.$key.'_success'] = $message;
	}
	
	public function successPrint($key = false)
	{
		if (!$key)
		{
			$key = $this->currentMultipleError;
		}
		
		//if we got errors, print em
		if (isset($_SESSION['multipleErrors'.$key.'_success']))
		{
			$message = $_SESSION['multipleErrors'.$key.'_success'];
			
			$message = '<div class="container_3 green wide fading-notification" align="left"><span class="error_icons success"></span><p>'.$message.'</p></div>';
			
			//unset the session data
			unset($_SESSION['multipleErrors'.$key.'_success']);
						
			return $message;
		}
	  
	  return false;
	}
}