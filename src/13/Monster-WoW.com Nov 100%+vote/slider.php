<?php
if (!defined('AXE'))
	exit;

$sl = new Template("styles/".$style."/nostyle_box.php");
		  
$content='
<table width="100%" border="0" cellpadding="0">
  <tr><td>
<div class="slider box-shadow">
<ul id="slideshow">
<li><img src="res/slider/slide-1.jpg" alt=""/></li>
<li><img src="res/slider/slide-2.jpg" alt=""/></li>
<li><img src="res/slider/slide-3.jpg" alt=""/></li>
<li><img src="res/slider/slide-4.jpg" alt=""/></li>
<li><img src="res/slider/slide-5.jpg" alt=""/></li>
</ul>
</div>

  </td></tr>
</table>



<div class="quick-menu-container box-shadow">

	<ul class="clearfix">

		<li id="vote">

			<a href="quest.php?name=votesites"></a>

		</li>

		<li id="shop">

			<a href="quest_ac.php?name=Vote_Shop"></a>

		</li>

		<li id="forum">

			<a href="#"></a>

		</li>

	</ul>

</div>

</div>



';

$sl->setVar("content", $content);
$sl->setVar("imagepath", 'styles/'.$style.'/images_new/');
$slider=$sl->toString();

?>