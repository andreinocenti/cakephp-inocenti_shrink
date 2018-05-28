<?php
namespace Shrink\Lib\ShrinkCompressor;

use Shrink\Lib\ShrinkCompressor\ShrinkCompressorInterface;
use Shrink\Lib\ShrinkBase;
use tubalmartin\CssMin\Minifier as CSSmin;

class ShrinkCompressorCssmin extends ShrinkBase implements ShrinkCompressorInterface{

	protected $settings = [
			'cssmin'=>[]
		];


	/**
	* Determine if there is support for this compressor
	* @return boolean - true if there is support
	*/
	public function isAvailable(){		
		return class_exists(CSSmin::class);
	}


	/**
	* Processes/minify/combines queued files of the requested type.
	* @param string $code - unminified code string
	* @return string - code string minified/processed as requested
	*/
	public function compress($code){
		if($this->isAvailable()){
			$compressor = new CSSmin;
			$compressor->setLineBreakPosition(1000);
			$compressor->removeImportantComments();
			$code = $compressor->run($code);
        }

		return $code;
	}
}
