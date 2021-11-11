<?php
if (!defined('init_functions'))
{	
	header('HTTP/1.0 404 not found');
	exit;
}

class Pagination
{
	
	private $LinkAdd = '?';
	
	public function addToLink($str)
	{
		$this->LinkAdd = $str;
	}
		
	public function calculate_pages($total_rows, $rows_per_page, $page_num)
	{
		$arr = array();
		
		//If we have no rows return empty array
		if ($total_rows < 1)
		  return array('limit' => '', 'current' => '', 'info' => '', 'first' => '', 'previous' => '', 'next' => '', 'last' => '', 'pages' => '');
		
		// calculate last page
		$last_page = ceil($total_rows / $rows_per_page);
		
		// make sure we are within limits
		$page_num = (int)$page_num;
		
		if ($page_num < 1)
		{
		   $page_num = 1;
		} 
		elseif ($page_num > $last_page)
		{
		   $page_num = $last_page;
		}
		
		$upto = ($page_num - 1) * $rows_per_page;
		$arr['limit'] = $upto.',' .$rows_per_page;

		$arr['current'] = $page_num;
        
		//Info panel
		if ($last_page > 1)			
		  $arr['info'] = 'Page ('.$page_num.' of '.$last_page.')';
		else
		  $arr['info'] = false;

		//If we are at first page or second we dont need this btn (FIRST)
        if ($page_num == '1' or $page_num == '2')
		{
        	$first_page_btn_html = '';
        }
		else
		{
        	$first_page_btn_html = '<li id="first"><a href="'.$this->LinkAdd.'&p=1">First</a></li>';
        }
		$arr['first'] = $first_page_btn_html;

		//If we are at first page we dont need prev btn
		if ($page_num == '1')
		{
			$prev_page_btn_html = '';
		}
		else
		{
			$prev_page_btn_html = '<li id="prev"><a href="'.$this->LinkAdd.'&p='.($page_num - 1).'">Prev</a></li>';
		}				
		$arr['previous'] = $prev_page_btn_html;
			
		//If we are at last page we dont need NEXT btn
		if ($page_num == $last_page)
		{
			$next_page_btn_html = '';
		}
		else
		{
			$next_page_btn_html = '<li id="next"><a href="'.$this->LinkAdd.'&p='.($page_num + 1).'">Next</a></li>';
		}
		$arr['next'] = $next_page_btn_html;

		//If we are at last page or the one before we dont need this btn (LAST PAGE)
		if ($page_num == $last_page or $page_num == ($last_page - 1))
		{
			$last_page_btn_html = '';
		}
		else
		{
			$last_page_btn_html = '<li id="last"><a href="'.$this->LinkAdd.'&p='.$last_page.'">Last</a></li>';
		}
		$arr['last'] = $last_page_btn_html;
		
		//time to setup the pages in the middle
		$surrounding = $this->get_surrounding_pages($page_num, $last_page, $arr['next']);
						
		$pages_panel = '';
		
		//Loop the pages with our html
		foreach ($surrounding as $key => $value)
		{
			//If this page is active  
			if ($value == $page_num)
			  $page = '<li class="current">'.$value.'</li>';
			else
			  $page = '<li><a href="'.$this->LinkAdd.'&p='.$value.'">'.$value.'</a></li>';
			
			$pages_panel .= $page;
		}

		if ($last_page > 1)			
		  $arr['pages'] = $pages_panel;
		else
		  $arr['pages'] = false;
		
	  return $arr;
	}
	
	private function get_surrounding_pages($page_num, $last_page, $next)
	{
		$arr = array();
		$show = 4; // how many boxes
		
		// at first
		if ($page_num == 1)
		{
			// case of 1 page only
			if ($next == $page_num) return array(1);
			
			for ($i = 0; $i < $show; $i++)
			{
				if ($i == $last_page) break;
				array_push($arr, $i + 1);
			}
			
			return $arr;
		}
		
		// at last
		if ($page_num == $last_page)
		{
			$start = $last_page - $show;
			if ($start < 1) $start = 0;
			for ($i = $start; $i < $last_page; $i++)
			{
				array_push($arr, $i + 1);
			}
			return $arr;
		}
		
		// at middle
		$start = $page_num - $show;
		
		if ($start < 1) $start = 0;
		
		for ($i = $start; $i < $page_num; $i++)
		{
			array_push($arr, $i + 1);
		}
		
		for ($i = ($page_num + 1); $i < ($page_num + $show); $i++)
		{
			if ($i == ($last_page + 1)) break;
			array_push($arr, $i);
		}
		
	  return $arr;
	}
}