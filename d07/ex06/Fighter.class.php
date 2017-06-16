<?php
class Fighter{
	public $type;
	public function __construct($str){
		$this->type = $str;
		// print($this->type." = In Fighter constructor\n");
	}
	// abstract public function __construct();
	// abstract public function fight($target);
}
?>