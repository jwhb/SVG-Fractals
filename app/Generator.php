<?php

class Generator {
	public function generateCarpetSVG($stages, $canvas_width, $canvas_height){
		$c_w = $canvas_width;
		$c_h = $canvas_height;
		$svg = '';
		$squares = array();
		for($stage=1; $stage<=$stages; $stage++){
		  for($gridno =1; $gridno <= 9; $gridno ++){
		  	//coord modification
		  	$cmod = array(/* x, y */);
		  	switch($gridno){
		  		case 1:
		  			$cmod = array(0,1);
		  		case 2:
		  			$cmod = array(0,1);
		  		case 3:
		  			$cmod = array(0,1);
		  		case 4:
		  			$cmod = array(1,0);
		  		case 5:
		  			$cmod = array(1,1);
		  		case 6:
		  			$cmod = array(1,2);
		  		case 7:
		  			$cmod = array(2,0);
		  		case 8:
		  			$cmod = array(2,1);
		  		case 9:
		  			$cmod = array(2,2);
		  	}
		  	
		  	$s_x = $c_w/3^$stage; //square width;
		  	$s_y = $c_h/3^$stage; //square height;
		  	
			$square['x1'] = $s_x*$cmod[0];
			$square['y1'] = $s_y*$cmod[1];
			$square['x2'] = $square['y1'] + $s_x;
			$square['y2'] = $square['y1'] + $s_y;
			$square['w'] = $s_x;
			$square['h'] = $s_y;
			$squares[$stage][$gridno] = $square;
		  }
		}
		foreach($squares as $gridno=>$grid){
		  foreach($grid as $squareno =>$square){
			$x = $square['x1'];
			$y = $square['y1'];
			$w = $square['w'];
			$h = $square['h'];
			if($square['h'] * $square['h'] == 0){
				//invisible (height or width = 0) => don't add to .svg
				$svg .= "\n\t<!---<rect x=$x y=$y width=$w height=$h />-->";
			}else{
				//visible
				$svg .= "\n\t<rect x=\"$x\" y=\"$y\" width=\"$w\" height=\"$h\" />";
			}
		  }
		}
		print_r("Debug: " . print_r($squares, 1) . "\n");
		return($svg);
}
}