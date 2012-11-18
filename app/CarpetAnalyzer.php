<?php

class CarpetAnalyzer {
	
	private $filename = 'carpet.svg';
	private $canvas_size;
	
	
	public function __construct($filename){
		require_once('CarpetGenerator.php');
		require_once('CarpetUtils.php');
		
		//Putting $args into attributes
		if(isset($filename))$this->filename = $filename;
		
		//Getting default canvas size from generator
		$this->canvas_size = CarpetGenerator::$def_canvas_size;
	}	
	
	/**
	 * @return Array containing 'canvas_size' and 'stages'
	 */
	public function analyzeCarpet(){
		$filename = $this->filename;
	
		if(!file_exists($filename)) {
			exit('Couldn\'t open \"' . $filename . '\"');
		} else {
			$xml = simplexml_load_file($filename);
			return($this->analyzeXML($xml));
		}
	}
	
	private function analyzeXML(SimpleXMLElement $xml){
		$carpet_info = array('size' => $this->canvas_size, 'stages' => 0);
		
		$root_attributes = $xml->attributes();
		
		//Try to obtain canvas size from SVG, keep default size if test fails
		if(isset($root_attributes['height'])){
			$carpet_info['size'] = CarpetUtils::filterExtension($root_attributes['height'], "px");
		}
		
		$rects = $xml->rect;
		$rects_amount = $rects->count();
		$rect_stages = array();
		
		for($rect_no = 0; $rect_no < $rects_amount; $rect_no++){
			//Executed for each <rect>
			$rect = $rects[$rect_no]->attributes();
			$rect_stages[CarpetUtils::getStageBySidelength($this->canvas_size,
					$rect['height'])][$rect_no] = true;
		}
		
		$finest_stage = max(array_keys($rect_stages));		
		$carpet_info['stages'] = $finest_stage;
		
		return($carpet_info);
	}
	
}

?>