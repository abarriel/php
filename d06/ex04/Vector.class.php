<?php 
class Vector{
	private $_x = 0;
	private $_y = 0;
	private $_z = 0;
	private $_w = 1;
	private $_dest;
	private $_orig;
	static $verbose = FALSE;

	function __construct(array $kwargs){
		if (array_key_exists('orig', $kwargs))
			$this->_orig = $kwargs['orig'];
		else
			$this->_orig = new Vertex(array( 'x' => 0, 'y' => 0, 'z' => 0, 'w' => 1));
		if (array_key_exists('dest', $kwargs))
			$this->_dest = $kwargs['dest'];
		$this->_x =  $this->_dest->getx() - $this->_orig->getx();
		$this->_y =  $this->_dest->gety() - $this->_orig->gety();
		$this->_z =  $this->_dest->getz() - $this->_orig->getz();
		$this->_w =  $this->_dest->getw() - $this->_orig->getw();
		if (self::$verbose)
			echo $this." constructed"."\n";
	}

	function __toString(){
		// $str = $this->_x;
		$str = sprintf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f", $this->_x, $this->_y, $this->_z, $this->_w);
		return $str." )";
	}

	public function magnitude(){
		$this->magnitude = sqrt(pow($this->_x,2) + pow($this->_y,2) + pow($this->_z,2));
		return $this->magnitude;
	}
	
	public function normalize(){
		if($this->magnitude != 1)
		{
		$normalized = new Vertex( array( 'x' => ($this->_x / $this->magnitude), 'y' =>($this->_y / $this->magnitude), 'z' => ($this->_z / $this->magnitude) ) );
		$normalized = new Vector( array( 'dest' => $normalized ) );
			return $normalized;
		}
			// return $this;
	}
	
	public function add(Vector $rhs)
	{
		$sx = $this->getx() + $rhs->getx();
		$sy = $this->gety() + $rhs->gety();
		$sz = $this->getz() + $rhs->getz();
		$new =  new Vertex(array( 'x' => $sx, 'y' => $sy, 'z' => $sz, 'w' => 1));
		return( new Vector(array('dest' => $new)));
	}

	public function by(Vector $rhs)
	{
		$sx = $this->getx() * $rhs->getx();
		$sy = $this->gety() * $rhs->gety();
		$sz = $this->getz() * $rhs->getz();
		$new =  new Vertex(array( 'x' => $sx, 'y' => $sy, 'z' => $sz, 'w' => 1));
		return( new Vector(array('dest' => $new)));
	}
	public function sub(Vector $rhs)
	{
		$sx = $this->getx() - $rhs->getx();
		$sy = $this->gety() - $rhs->gety();
		$sz = $this->getz() - $rhs->getz();
		$new =  new Vertex(array( 'x' => $sx, 'y' => $sy, 'z' => $sz, 'w' => 1));
		return( new Vector(array('dest' => $new)));
	}
	public function opposite()
	{
		$ox = $this->_x * -1;
		$oy = $this->_y * -1;
		$oz = $this->_z * -1;
		$new = new Vertex(array('x' => $ox , 'y' => $oy, 'z' => $oz, 'w' => 1));
		return( new Vector(array('dest' => $new)));
	}

	public function scalarProduct($k)
	{
		$ox = $this->_x * $k;
		$oy = $this->_y * $k;
		$oz = $this->_z * $k;
		$new = new Vertex(array('x' => $ox , 'y' => $oy, 'z' => $oz, 'w' => 1));
		return( new Vector(array('dest' => $new)));
	}

	public function dotProduct(Vector $rhs)
	{
		$sx = $this->getx() * $rhs->getx();
		$sy = $this->gety() * $rhs->gety();
		$sz = $this->getz() * $rhs->getz();
		$final = $sx + $sy + $sz;
		return($final);
	}

	public function crossProduct(Vector $rhs)
	{
		$sx = $this->_y * $rhs->getz() - $this->_z * $rhs->gety();
		$sy = $this->_z * $rhs->getx() - $this->_x * $rhs->getz();
		$sz = $this->_x * $rhs->gety() - $this->_y * $rhs->getx();
		$new = (new Vertex(array( 'x' => $sx, 'y' => $sy, 'z' => $sz, 'w' => 1)));
		return(new Vector(array('dest' => $new)));
	}
	public function cos(Vector $rhs)
	{
		$dot = $this->dotProduct($rhs);
		$mag1 = $this->magnitude();
		$mag2 = sqrt(pow($rhs->getx(),2) + pow($rhs->gety(),2) + pow($rhs->getz(),2));
		$cos = $dot / ($mag1 * $mag2);
		return ($cos);
	}

	function __destruct(){
		if(self::$verbose)
			echo $this." destructed"."\n";
	}
	function getx(){return $this->_x;}
	function getz(){return $this->_z;}
	function gety(){return $this->_y;}
	function getw(){return $this->_w;}
}

// $orig2 = new Vertex( array( 'x' => 23.87, 'y' => -37.95, 'z' => 78.34 ) );
// $dest2 = new Vertex( array( 'x' => -12.34, 'y' => 23.45, 'z' => -34.56 ) );
// $vtc2  = new Vector( array( 'orig' => $orig2, 'dest' => $dest2 ) );
?>