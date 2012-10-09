<?php

class Generator {
	
	function __construct(){
		//TODO: extract method parameters to class variables
	}
	
	public $generation_duration = 0;
	
	public static function startTimetracking(){
	    $t_exp = explode(" ", microtime());
	    $start_time = $t_exp[1] + $t_exp[0];
	    return $start_time;
	}
	
	public static function stopTimetracking($start_time){
		$t_exp = explode(" ", microtime());
		$stop_time = $t_exp[1] + $t_exp[0];
		$time_diff = $stop_time - $start_time;
		$t_format = sprintf("%f", $time_diff);
		return $t_format;
	}
	
	public function generateCarpetSVG($stages, $canvas_width, $canvas_height){
		$c_w = $canvas_width;
		$c_h = $canvas_height;
		$svg = '';
		$squares = array();
		$i = 0;
		for($stage=1; $stage<=$stages; $stage++){
		  $stage_exp = pow(3, $stage);
		  $s_x = $c_w / $stage_exp; //square width;
		  $s_y = $c_h / $stage_exp; //square height;
		  for($supergridno = 0; $supergridno <= pow(9, $stage -1); $supergridno++){
		  	for($subgridno = 1; $subgridno <= 9; $subgridno ++){
			  if($subgridno == 5){
			  	$square['x'] = $s_x + $supergridno*($s_x*3);
			  	$square['y'] = $s_y + $supergridno*($s_y*3);
			  	$square['w'] = $s_x;
			  	$square['h'] = $s_y;
			  	$squares[$stage][$supergridno][$subgridno] = $square;
			  }		
		  	}	
		  }
		}
		foreach($squares as $gridno=>$grid){
		  foreach($grid as $squareno=>$square){
		  foreach($square as $subsquareno=>$subsquare)
			$x = $subsquare['x'];
			$y = $subsquare['y'];
			$w = $subsquare['w'];
			$h = $subsquare['h'];
			if($subsquare['h'] * $subsquare['h'] == 0){
				//invisible (height or width = 0) => don't add to .svg
				$svg .= "\n\t<!---<rect x=$x y=$y width=$w height=$h />-->";
			}else{
				//visible
				$svg .= "\n\t<rect x=\"$x\" y=\"$y\" width=\"$w\" height=\"$h\" />";
			}
		  }
		}
		print_r($squares);
		return($svg);
}
}