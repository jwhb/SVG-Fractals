<?php
	require_once("CarpetGenerator.php");
	$start_time = CarpetGenerator::startTimetracking();
	header("Content-type: image/svg+xml");
	echo('<?xml version="1.0" encoding="iso-8859-1"?>');
	
	$canvas_size = 180;
	$canvas_size = 180;
	$stages = 5;
	
	if(isset($_GET['size'])){
		$canvas_size = $_GET['size'];
	}
	if(isset($_GET['dsize'])){
		$canvas_dsize = $_GET['dsize'];
	}
	if(isset($_GET['stages'])){
		$stages = $_GET['stages'];
	}
	if(isset($_GET['filename'])){
		$filename = $_GET['filename'];
		require_once("CarpetAnalyzer.php");
		$ca = new CarpetAnalyzer($filename);
		$ca_res = $ca->analyzeCarpet();
		
		//Add $_GET['stages'] to existing ones
		$stages = $ca_res['stages'] + $_GET['stages'];
	}else{
		$filename = false;
	}
?>

<svg width="<?=$canvas_size?>px" height="<?=$canvas_size?>px" xmlns="http://www.w3.org/2000/svg">
  <?php if(!isset($_GET['stages'])){?>
	<text x="3" y="18">Not enough parameters given!</text><?php
  }else{
  	$svg_gen = new CarpetGenerator(array(
  		'stages' => $stages, 
  		'canvas_size' => $canvas_size, 
  		'canvas_dsize' => $canvas_dsize, 
  	));
  	echo $svg_gen->generateCarpetSVG();
  }
  ?>

</svg>