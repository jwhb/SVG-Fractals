<?php

class Generator {
	public function generateCarpetSVG($stages, $canvas_width, $canvas_height){
		$c_w = $canvas_width;
		$c_h = $canvas_height;
		$svg = '';
		$squares = array();
		for($stage=1; $stage<=$stages; $stage++){
		  $stage_exp = pow(3, $stage);
		  $s_x = $c_w / $stage_exp; //square width;
		  $s_y = $c_h / $stage_exp; //square height;
		  for($gridno = 1; $gridno <= 9; $gridno ++){
		  	
				if($gridno == 5){
			  		$square['x'] = $s_x;
			  		$square['y'] = $s_y;
			  		$square['w'] = $s_x;
			  		$square['h'] = $s_y;
			  		$squares[$stage][$gridno] = $square;
				}			
		  }
		}
		foreach($squares as $gridno=>$grid){
		  foreach($grid as $squareno =>$square){
			$x = $square['x'];
			$y = $square['y'];
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
		return($svg);
}
}