<?php
	require_once("CarpetGenerator.php");
	$start_time = CarpetGenerator::startTimetracking();
	header("Content-type: image/svg+xml");
	echo('<?xml version="1.0" encoding="iso-8859-1"?>');
	
	
	if(isset($_GET['size'])){
		$canvas_size = $_GET['size'];
	}else{
		$canvas_size = 180;
	}
	if(isset($_GET['dsize'])){
		$canvas_dsize = $_GET['dsize'];
	}else{
		$canvas_dsize = 180;
	}
?>

<svg width="<?=$canvas_size?>px" height="<?=$canvas_size?>px" xmlns="http://www.w3.org/2000/svg">
  <?php if(!isset($_GET['stages'])){?>
	<text x="3" y="18">Not enough parameters given!</text><?php
  }else{
  	$svg_gen = new CarpetGenerator(array(
  		'stages' => $_GET['stages'], 
  		'canvas_size' => $canvas_size, 
  		'canvas_dsize' => $canvas_dsize, 
  	));
  	echo $svg_gen->generateCarpetSVG();
  }
  ?>

</svg>