<?php

/**
 * @author Jasper Wiegratz
 */
class NewGenerator {
	
	private $stages = 5;
	private $canvas_size = 180;

	/**
	 * @param Array $args Should contain the keys 'canvas_size' and 'stages' (default: 5)
	 */
	public function __construct($args) {
		if(isset($args['stages'])) $this->stages = $args['stages'];
		$this->canvas_size = $args['canvas_size'];
	}

	private function generateCarpet() {
		$carpet = array();
		for($stage = 1; $stage <= $this->stages; $stage++){
		  //per stage
		  $sq_per_row = pow(3, $stage-1);
		  $sq_total = $sq_per_row * $sq_per_row;
		  echo("\n$stage----");
		  for($x_row = 1; $x_row <= $sq_per_row; $x_row++){
		  	echo("\n  $x_row--");
			for($y_row = 1; $y_row <= $sq_per_row; $y_row++){
				echo("\n    $y_row");
			}
		  }
		}
		return($carpet);
	}
	
	private function generateSVG($carpet){
		$svg = '';
		$ca = $carpet;
		foreach($ca as $ca_stage){
		  //per stage
		  foreach($ca_stage as $sq_array){
		  	//per square in stage
		  	//sq: square
		  	(float) $x = $sq_array['x']; //first x-coordinate of square
		  	(float) $y = $sq_array['y']; //first y-coordinate of square
		  	(float) $s = $sq_array['s']; //square size
		  	$svg .= "\n<rect x=\"$x\" y=\"$y\" width=\"$s\" height=\"$s\" />";
		  }	
		}
		
		return $svg;
	}
	
	/**
	 * @return String Generated squares as SVG markup
	 */
	public function generateCarpetSVG() {
		$carpet = $this->generateCarpet();
		$svg = $this->generateSVG($carpet);
		return($svg);
	}

}

?>