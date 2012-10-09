<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>SVG-Fractals (Author: Jasper Wiegratz)</title>
	<?php 
		require_once('Generator.php');
	 	$start_time = Generator::startTimetracking();
	 	
	 	if(isset($_GET['size'])){
	 		$canvas_size = $_GET['size'];
	 	}else{
	 		$canvas_size = 180;
	 	}
	?>
</head>
<body>
	<p align="center">
		<span style="font-size: 2.5em;">SVG Fractals</span><br>
		<span style="font-size: 1.2em;">Author: Jasper Wiegratz</span>
	</p>
	<div style="margin: 0px auto;" align="center">
		<?php 
			$url_mod = "";
			if($canvas_size != 180)$url_mod .= "&width=$canvas_size";
		?>
		<object data="carpet.svg.php?stages=3" type="image/svg+xml" 
		height="<?=$canvas_size?>" width="<?=$canvas_size?>" style="border: 1px red solid;"></object>
	</div>
	<p><?php echo("<i>Executed in " . Generator::stopTimetracking($start_time) . " seconds.</i>");?></p>
	<p>To display the generated SVG image, you have to use at least IE9, Mozilla Firefox 4.0 or Chrome 
	4.0. The <a href="http://www.adobe.com/svg/viewer/install/">Adobe SVG Viewer</a> may help</p>
	
</body>
</html>