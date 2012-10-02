<?php
	require_once("Generator.php");
	header("Content-type: image/svg+xml");
	echo('<?xml version="1.0" encoding="iso-8859-1"?>');
?>

<svg width="600px" height="600px" xmlns="http://www.w3.org/2000/svg">
  <?php if(!isset($_GET['stages'])){?>
	<text x="3" y="18">Not enough parameters given!</text><?php
  }else{
  	$svg_gen = new Generator();
  	echo $svg_gen->generateCarpetSVG($_GET['stages'], 600, 600);
  }
  ?>

</svg>