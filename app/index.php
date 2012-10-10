<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>SVG-Fractals (Author: Jasper Wiegratz)</title>
	<?php 
		require_once('CarpetGenerator.php');
	 	$start_time = CarpetGenerator::startTimetracking();
	 	
	 	$canvas_size = 180;
	 	$canvas_dsize = 180;
	 	$stages = 5;
	 	
	 	if(isset($_GET['size'])){//Render size
	 		$canvas_size = $_GET['size'];
	 	}
	 	if(isset($_GET['dsize'])){//Display size (of img-tag, will scale)
	 		$canvas_dsize = $_GET['dsize'];
	 	}
	 	if(isset($_GET['stages'])){//Display size (of img-tag, will scale)
	 		$stages = $_GET['stages'];
	 	}
	?>
</head>
<body><div>
	<p align="center">
		<span style="font-size: 2.5em;">SVG Fractals</span><br>
		<span style="font-size: 1.2em;">Author: Jasper Wiegratz</span>
	</p>
	<div style="margin: 0px auto;" align="center">
		<?php 
			$url_mod = "";
			if($canvas_size != 180)$url_mod .= "&width=$canvas_size";
			
			if($canvas_size == $canvas_dsize){ ?>
				<object data="carpet.svg.php?stages=<?=$stages?>" type="image/svg+xml" 
				height="<?=$canvas_dsize?>" width="<?=$canvas_dsize?>" style="border: 1px red solid;"></object>
			<?php }else{ ?>
				<img src="carpet.svg.php?stages=<?=$stages?>" height="<?=$canvas_dsize?>"
				width="<?=$canvas_dsize?>" style="border: 1px red solid;"/>
			<?php } ?>
		<form method="get">
		<div>
		  <p>Stages: <input type="text" name="stages" value="<?=$stages?>" size="5" /><br />
		  Render width/height: <input type="text" name="size" value="<?=$canvas_size?>" size="5" /><br />
		  Display width/height: <input type="text" name="dsize" value="<?=$canvas_dsize?>" size="5" /><br />
		  <input type="submit" />
		  </p>
		</div>
		</form>
	
	<p>To display the generated SVG image, you have to use at least IE9, Mozilla Firefox 4.0 or Chrome 
	4.0. The <a href="http://www.adobe.com/svg/viewer/install/">Adobe SVG Viewer</a> may help.</p>
	</div>
</div>
</body>
</html>