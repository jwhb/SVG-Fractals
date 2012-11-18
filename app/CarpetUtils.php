<?php

class CarpetUtils {

	/**
	 * Removes extension from given String
	 * @param String $string
	 * @param String $ext
	 * @return String with filtered input text
	 */
	public static function filterExtension($string, $ext){
		if(substr($string, strlen($string) - strlen($ext)) == $ext){
			//Found extension, return filtered string
			return(substr($string, 0, strlen($string) - strlen($ext)));
		}else{
			//Can't find extension
			return($string);
		}
	}
	
	/**
	 * @param number $canvas_size Side length canvas
	 * @param number $sl Side length of a square
	 * @return int Stage number
	 */
	public static function getStageBySidelength($canvas_size, $sl){
		return(
			round(
			  	log((intval($canvas_size))/(intval($sl)),3)
			)
		);
	}
	
	/**
	 * @param int $stage Stage (of refinement)
	 * @param int $canvas_size Size of the (SVG) canvas
	 * @return int Side length of square of given stage
	 */
	public static function getSquareSidelength($stage, $canvas_size){
		//<size> / 3^<stage>
		//pow(number $base, number $exp ) = $base^$exp
		return($canvas_size/pow(3, $stage));
	}
	
	/**
	 * @param int $stage Stage (of refinement)
	 * @param int $canvas_size Size of the (SVG) canvas
	 * @param int $n $n-th element in one row
	 * @return int Coordinate (one dimension) of n-th square of given stage
	 */
	public static function getSquarePosition($stage, $canvas_size, $n){
		$sq_a = CarpetUtils::getSquareSidelength($stage, $canvas_size);
		return($sq_a + 3*($n-1)*$sq_a);
	}
	
	public static function getDirectoryContentByExtension($directory, $ext){
		
		$dir = dir($directory);
		$matched = array();
		
		while($file = $dir->read()) {
		  if(is_file($file)){
		  	$exp = explode(".", $file);
		  	if(count($exp) > 1 && $exp[max(array_keys($exp))] == $ext){
		  		$matched[] = $file;
		  	}
		  }
		}
		$dir->close();
		
		return($matched);
	}
	
}
