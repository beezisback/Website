//Top Arena Teams javascript handlers by ChoMPi

function resolveFaction(elementId, captain, realm)
{
	var $elementId = elementId;
	var $captain = captain;
	var $realm = realm;
	
	var $cont = $('#'+elementId);
	
	//prepare the ajax error handlers
	$.ajaxSetup({
		error:function(x,e){
			if(x.status==500){
				resolveFaction($elementId, $captain, $realm);
			}else if(e=='parsererror'){
				resolveFaction($elementId, $captain, $realm);
			}else if(e=='timeout'){
				resolveFaction($elementId, $captain, $realm);
			}else{
				resolveFaction($elementId, $captain, $realm);
			}
		}
	});
			
	$.post(
		"ajax_top_arena.php", 
		{ 
    		resolveFaction: true, 
    		realm: $realm,
    		guid: $captain,
		},
		function(data){
			//if error
			if (data == '0')
			{
				$cont.html('Unknown');
			}
			else
			{
				if (data == 'Horde')
				{
					$cont.html('<font color="#9d261d">Horde</font>');
				}
				else if (data == 'Alliance')
				{
					$cont.html('<font color="#1b5183">Alliance</font>');
				}
				else
				{
					$cont.html('Unknown');
				}
			}
		}
	);
}

$(document).ready(function()
{
	var $a_tooltips = 1;
	
    //Select all anchor tag with rel set to tooltip
    $('a[rel=top-arena-tooltip]').mouseover(function(e)
	{
		var $realm = $(this).attr('realm');
		var $teamid = $(this).attr('teamid');
		
		//get the element data in order to find our tooltip
		var data = $(this).data('top-arena-tooltip-id');
		
		//check if the data is not yet set
		if (typeof data == 'undefined')
		{
			data = $a_tooltips;
			
			$(this).data('top-arena-tooltip-id', data);			
			
			//Append the tooltip template and its value
        	$('body').append('<div class="top-arena-tooltip" id="top-arena-tooltip-'+data+'"><div class="tipHeader"></div><div class="tipBody">Loading...</div><div class="tipFooter"></div></div>');     

			//get the Tooltip HTML with ajax
			$.post(
				'ajax_top_arena.php', 
				{ 
    				lookupArenaTeam: true, 
    				realm: $realm,
    				arenateamid: $teamid,
				},
				function(dataResponse, textStatus)
				{
					var cont = $('#top-arena-tooltip-'+data).find('.tipBody');
					
					//check for error
					if (dataResponse == '0')
					{
						$(cont).html('Failed to load HTML data.');
					}
					else
					{
						$(cont).html(dataResponse);
					}
				}
			);
			
			$a_tooltips = $a_tooltips + 1;
		}
		
		//find our tooltip element
		var tooltip = $('#top-arena-tooltip-'+data);
		
        //Set the X and Y axis of the tooltip
        $(tooltip).css('top', e.pageY + 10 - 200);
        $(tooltip).css('left', e.pageX + 20 );
         
        //Show the tooltip with faceIn effect
        $(tooltip).fadeIn(200);
         
    }).mousemove(function(e)
	{
		var data = $(this).data('top-arena-tooltip-id');
		var tooltip = $('#top-arena-tooltip-'+data);
		
        //Keep changing the X and Y axis for the tooltip, thus, the tooltip move along with the mouse
        $(tooltip).css('top', e.pageY + 10 );
        $(tooltip).css('left', e.pageX + 20 );
         
    }).mouseout(function()
	{
		var data = $(this).data('top-arena-tooltip-id');
		var tooltip = $('#top-arena-tooltip-'+data);
	    
		//hide the tooltip
		$(tooltip).fadeOut(100);
    });
 
});