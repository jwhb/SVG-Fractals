<?php

class CarpetGenerator {
	
  //Defining default parameters
	public static $def_stages = 5;
	public static $def_canvas_size = 180;
	public static $def_canvas_dsize = 180;
	
	private $stages;
	private $canvas_size;
	private $canvas_dsize;

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
	
	/**
	 * @param Array $args Should contain the keys 'canvas_size' and 'stages' (default: 5)
   *        canvas_size: Side length of the canvas (defaults to 180px)
   *        stages: Amount of refinements
	 */
	public function __construct($args) {
		require_once('CarpetUtils.php');
		
		if(isset($args['stages'])){
			$this->stages = $args['stages'];
		}else{
			$this->stages = $this->def_canvas_size;
		}
		$this->canvas_size = $args['canvas_size'];
		$this->canvas_dsize = $args['canvas_dsize'];
	}

	/**
	 * @return Array with $ret[$stage][$square]
	 */
	private function generateCarpet() {
				
		$carpet = array();
		$cs = $this->canvas_size;
		for($stage = 1; $stage <= $this->stages; $stage++){
		  //Executed per stage
		  //sq_a: square sidelength
		  $sq_a = CarpetUtils::getSquareSidelength($stage, $cs);
		  
		  $sq_per_row = pow(3, $stage-1);
		  $sq_total = $sq_per_row * $sq_per_row;
		  
		  for($x_row = 1; $x_row <= $sq_per_row; $x_row++){
		  	//Executed per x-row
		  	$x_row_coord = $sq_a;
        for($y_row = 1; $y_row <= $sq_per_row; $y_row++){
          //Executed per y-row on x-row => x/y coordinate
          $carpet[$stage][] = array(
          'x' => CarpetUtils::getSquarePosition($stage, $cs, $y_row),
          'y' => CarpetUtils::getSquarePosition($stage, $cs, $x_row),
          's' => CarpetUtils::getSquareSidelength($stage, $cs)
          );
        }
		  }
		}
		return($carpet);
	}
	
	private function generateSVG($carpet){
		$svg = '';
		$ca = $carpet;
		foreach($ca as $stageno=>$ca_stage){
		  //Executed per stage
		  $svg .= "\n<!-- Stage: $stageno -->";
		  foreach($ca_stage as $sq_array){
		  	//Executed per square in stage
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
