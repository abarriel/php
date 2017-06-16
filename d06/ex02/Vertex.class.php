<?php
require_once 'Vector.class.php';
require_once 'Color.class.php';
class Vertex{
	private $_x = 0;
	private $_y = 0;
	private $_z = 0;
	private $_w = 1;
	private $_color;
	static $verbose = FALSE;

	function __construct(array $kwargs){
		if(array_key_exists('x', $kwargs))
			$this->_x = $kwargs['x'];
		if(array_key_exists('y', $kwargs))
			$this->_y = $kwargs['y'];
		if(array_key_exists('z', $kwargs))
			$this->_z = $kwargs['z'];
		if(array_key_exists('w', $kwargs))
			$this->_w = $kwargs['w'];
		if(array_key_exists('color', $kwargs))
			$this->_color = $kwargs['color'];
		else
			$this->_color = new Color( array( 'rgb' => 0xFFFFFF ) );
		if (self::$verbose)
			echo $this." constructed"."\n";
	}

	function __destruct(){
		if(self::$verbose)
			echo $this." destructed"."\n";
	}

	function __toString(){
		$str = sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f", $this->_x, $this->_y, $this->_z, $this->_w);
		if(self::$verbose)
			$str .= sprintf(", %s", $this->_color);
		return $str." )";
	}
	function getx(){return $this->_x;}
	function getvect(){return $this;}
	function getz(){return $this->_z;}
	function gety(){return $this->_y;}
	function getw(){return $this->_w;}
	function getcolor(){return $this->_color;}
}
?>