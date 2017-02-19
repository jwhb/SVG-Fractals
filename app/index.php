<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>SVG-Fractals</title>
	<?php 
		require_once('CarpetGenerator.php');
		require_once('CarpetUtils.php');

		$file_list = "";
		foreach(CarpetUtils::getDirectoryContentByExtension(".", "svg") as $dir){
			$file_list .= "<option>$dir</option>\n";
		}
		
	 	$canvas_size = 180;
	 	$canvas_dsize = 180;
	 	$stages = 5;
	 	$filename = 'carpet.svg';
	 	$analyze = false;
	 	$analyzetext = "";
	 	$filemod = '';
	 	
	 	
	 	if(isset($_GET['size'])){//Render size
	 		$canvas_size = $_GET['size'];
	 	}
	 	if(isset($_GET['dsize'])){//Display size (of img-tag, will scale)
	 		$canvas_dsize = $_GET['dsize'];
	 	}
	 	if(isset($_GET['stages'])){//Display size (of img-tag, will scale)
	 		$stages = $_GET['stages'];
	 	}
	 	if(isset($_GET['filename'])){//Display size (of img-tag, will scale)
	 		$filename = $_GET['filename'];
	 	}
	 	if(isset($_GET['analyze'])){//Display size (of img-tag, will scale)
	 		$analyze = $_GET['analyze'];
	 	}
	 	
	 	if($analyze == "on"){
	 		$filemod = "&amp;filename=$filename";
	 		$analyzetext = "checked";
	 	}else{
	 	}
	?>
	<link href='http://fonts.googleapis.com/css?family=Inder+Web:600' rel='stylesheet' type='text/css'>
	<style type="text/css">
		body{
			font-family: 'Inder', sans-serif;
		}
		input{
			text-align: center;
			color: #787878;
			padding: 1px 5px;
			letter-spacing: -0.02em;
			text-shadow: 0px 1px 0px #fff;
			outline: none;
			background: -webkit-gradient(linear, left top, left bottom, from(#e0e0e0), to(#ffffff));
			background: -moz-linear-gradient(top,  #e0e0e0,  #ffffff);
			-webkit-border-radius: 2px;
			-moz-border-radius: 2px;
			border-radius: 2px;
			border: 1px solid #717171;
			-webkit-box-shadow: 1px 1px 0px #efefef;
			-moz-box-shadow: 1px 1px 0px #efefef;
			box-shadow:  1px 1px 0px #efefef;
			margin: 0.1em;
		}
		input[type=submit] { font-size: 1.1em; letter-spacing: -0.05em; color: #444; }
		input:focus { -webkit-box-shadow: 0px 0px 5px #007eff; -moz-box-shadow: 0px 0px 5px #007eff; box-shadow: 0px 0px 5px #007eff; }
		#compat a:link{color: gray;}
		#compat a:active{color: gray;}
		#compat a:hover{color: gray;}
		#compat a:visited{color: gray;}
		#compat a:focus{color: gray;}		
	</style>
</head>
<body>
  <div>
	<p align="center">
		<span style="font-size: 2.5em;">SVG Fractals</span><br>
		<span style="font-size: 1.2em;">Author: Jasper Wiegratz</span>
	</p>
	<div style="margin: 0px auto;" align="center">
		<?php 			
			if($canvas_size == $canvas_dsize){ ?>
				<object
					data="carpet.svg.php?stages=<?=$stages?><?=$filemod?>"
					type="image/svg+xml"
					height="<?=$canvas_dsize?>"
					width="<?=$canvas_dsize?>"
					style="border: 2px #006400 solid;"
				></object>
			<?php }else{ ?>
				<img 
					src="carpet.svg.php?stages=<?=$stages?>&size=<?=$canvas_size?>&dsize=<?=$canvas_dsize?><?=$filemod?>" 
					height="<?=$canvas_dsize?>"
					width="<?=$canvas_dsize?>"
					style="border: 2px #006400 solid;"
				/>
			<?php } ?>
		<form method="get">
		<div><p>
		  Input File:
		  	<input type="checkbox" name="analyze" <?=$analyzetext?> />
		   	<select name="filename" size="1"><?=$file_list?></select><br>
		  Stages to add: <input type="text" name="stages" value="<?=$stages?>" size="3" /><br />
		  Render width/height: <input type="text" name="size" value="<?=$canvas_size?>" size="3" /><br />
		  Display width/height: <input type="text" name="dsize" value="<?=$canvas_dsize?>" size="3" /><br />
		  <input type="submit" />
		</p></div>
		</form>
	
	<p id="compat" style="color: gray; font-size: 0.7em; min-width: 400px; width: 30%;">
		To display the generated SVG image, you have to use at least IE9, Mozilla Firefox 4.0 or Chrome 
		4.0. The <a style="text-color: gray;" href="http://www.adobe.com/svg/viewer/install/">Adobe SVG Viewer</a>
		may help.
		
		
		<?=$file_list?>
		
	</p>
	</div>
  </div>
</body>
</html>
