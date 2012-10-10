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

	/**
	 * @param int $stage Stage (of refinement)
	 * @param int $canvas_size Size of the (SVG) canvas
	 * @return int Side length of square of given stage
	 */
	private function getSquareSidelength($stage, $canvas_size){
		//<size> / 3^<stage></stage>
		return($canvas_size/pow(3, $stage));
	}
	
	/**
	 * @param int $stage Stage (of refinement)
	 * @param int $canvas_size Size of the (SVG) canvas
	 * @param int $n $n-th element in one row
	 * @return int Coordinate (one dimension) of n-th square of given stage
	 */
	private function getSquarePosition($stage, $canvas_size, $n){
		$sq_a = $this->getSquareSidelength($stage, $canvas_size);
		return($sq_a + 3*($n-1)*$sq_a);
	}
	
	private function generateCarpet() {
				
		$carpet = array();
		$cs = $this->canvas_size;
		for($stage = 1; $stage <= $this->stages; $stage++){
		  //per stage
		  //sq_a: square sidelength
		  $sq_a = $this->getSquareSidelength($stage, $cs);
		  
		  $sq_per_row = pow(3, $stage-1);
		  $sq_total = $sq_per_row * $sq_per_row;
		  for($x_row = 1; $x_row <= $sq_per_row; $x_row++){
		  	//per x-row
		  	$x_row_coord = $sq_a;
			for($y_row = 1; $y_row <= $sq_per_row; $y_row++){
				//per y-row on x-row => x/y coordinate
				$carpet[$stage][] = array(
					'x' => $this->getSquarePosition($stage, $cs, $x_row),
					'y' => $this->getSquarePosition($stage, $cs, $y_row),
					's' => $this->getSquareSidelength($stage, $cs)
				);
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
		return($svg);
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