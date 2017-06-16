<?php
class Camera
{
	private $width;
	private $height;
	private $vertex;
	private $ratio;
	private $far;
	private $near;
	private $fov;
	static $verbose = FALSE;
	private $tT;
	private $proj;
	private $by;
	private $tR;
	private $r;

	function get_tt()
	{
	$vtc = new Vector( array( 'dest' => $this->vertex ) );
	$vtc = $vtc->opposite();
	$this->tT  = new Matrix( array( 'preset' => Matrix::TRANSLATION, 'vtc' => $vtc ) );
	}

	function get_tr()
	{
		$tmpc1 = $this->r->matrix['c']['1'];
		$tmpa3 = $this->r->matrix['b']['1'];
		$tmpa4 = $this->r->matrix['c']['2'];
		$this->r->matrix['c']['1'] = $this->r->matrix['a']['3']; 
		$this->r->matrix['a']['3'] = $tmpc1;
		$this->r->matrix['b']['1'] = $this->r->matrix['a']['2']; 
		$this->r->matrix['a']['2'] = $tmpa3; 
		$this->r->matrix['c']['2'] = $this->r->matrix['b']['3']; 
		$this->r->matrix['b']['3'] = $tmpa4; 
		// $this->r->matrix['a']['3'] = 0; 
	}

	function get_mul(){
		$this->by = $this->r->mult($this->tT);
	}

	function get_final(){

	$this->proj = new Matrix( array( 'preset' => Matrix::PROJECTION,
						'fov' => $this->fov,
						'ratio' => $this->width/$this->height,
						'near' => $this->near,
						'far' => $this->far) );

	}

	function __construct(array $kwargs){
		if (array_key_exists('origin', $kwargs))
			$this->vertex = $kwargs['origin'];
		if (array_key_exists('orientation', $kwargs))
			$this->r = $kwargs['orientation'];	
		if (array_key_exists('width', $kwargs))
			$this->width = $kwargs['width'];
		if (array_key_exists('height', $kwargs))
			$this->height = $kwargs['height'];
		if (array_key_exists('ratio', $kwargs))
			$this->ratio = $kwargs['ratio'];
		if (array_key_exists('fov', $kwargs))
			$this->fov = $kwargs['fov'];
		if (array_key_exists('near', $kwargs))
			$this->near = $kwargs['near'];
		if (array_key_exists('far', $kwargs))
			$this->far = $kwargs['far'];
		$this->get_tt();
		$this->get_tr();
		$this->get_final();
		if (self::$verbose)
		{
			echo "Camera(\n+ Origine: ".$this->vertex."\n+ tT:\n";
			echo $this->tT."\n+ tR:\n".$this->r;
			echo "\n+ tR->mult( tT ):\n".$this->r->mult($this->tT);
			echo "\n+ Proj:\n".$this->proj."\n)\n";
		}
	}
	function __toString()
	{
		$str = sprinf("ok");
		return $str;
	}
	function __destruct(){
		if(self::$verbose)
			echo "Camera instance destructed"."\n";
	}
	function doc(){
		print(file_get_contents('Camera.doc.txt')."\n");
		return ;
	}
}
?>