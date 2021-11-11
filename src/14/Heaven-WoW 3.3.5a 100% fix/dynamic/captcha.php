<?php
	session_start();
	// Creation du random code
	$rand = md5(rand());
	$rand = substr($rand, 0, 6);
	$_SESSION['Heaven_WoW'] = $rand;
	// Creation de l'image
	// $image = imagecreatefrompng("default.png");
		$image = imagecreate(60,20);	
		$back_color = imagecolorallocate($image,0,0,0);
		$text_color = imagecolorallocate($image,67,170,170);
	// $text_color = imagecolorallocate($image, 0, 0, 0);
	imagestring($image, 4, 3, 3, $rand, $text_color);
	// Afficher l'image
	header("Content-type:image/png");
	imagejpeg($image);
?>