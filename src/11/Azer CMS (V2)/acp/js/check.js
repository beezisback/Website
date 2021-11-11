<!-- 
//AJAX by 4ramis 13lack
//Browser Support Code
function checkMe()
	{
	var ajaxRequest;  // The variable that makes Ajax possible!
	
	try
		{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
		}
	catch (e)
		{
		// Internet Explorer Browsers
		try
			{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
			}
		catch (e) 
			{
			try
				{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				}
			catch (e)
				{
				// Something went wrong
				alert("Your browser broke!");
				return false;
				}
			}
		}
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function()
		{
		if(ajaxRequest.readyState == 4)
			{
			document.getElementById('button').innerHTML = ajaxRequest.responseText;
			}
		}
	var validate = document.getElementById('option').value;
	//var code = document.getElementById('code').value;
	var queryString = "?option=" + validate;
	ajaxRequest.open("GET", "./core/core_includes/valid-check.php" + queryString, true);
	ajaxRequest.send(null); 
	}

//-->