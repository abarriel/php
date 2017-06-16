<?php
class Matrix{
	const IDENTITY = 'IDENTITY';
	const SCALE = 'SCALE';
	const RX = 'RX';
	const RY = 'RY';
	const RZ = 'RZ';
	const TRANSLATION = 'TRANSLATION';
	const PROJECTION = 'PROJECTION';
	static $verbose = FALSE;
	public $init;
	public $matrice;

	function create_matric(array $kwargs)
	{		
		if (array_key_exists('matrice', $kwargs))
			$matrice = $kwargs['matrice'];
		else
		{
			$identity = new Vertex( array('x' => 1, 'y' =>1, 'z' => 1) );
			$this->matrice = new Vector(array('dest' => $identity));
			$matrice = $this->matrice;
		}
		$this->init =  array( "a" => array('1' => $matrice->getx(), '2'=> 0, '3'=> 0, '4'=> 0), "b" =>array('1' =>0, '2'=>  $matrice->gety(), '3'=> 0, '4'=> 0), "c" => array('1' =>0, '2'=> 0, '3'=>  $matrice->getz(), '4'=> 0),"d" => array('1' =>0, '2'=> 0, '3'=> 0, '4'=> 1)); 
		$this->matrix = $this->init;
		return ($this->matrix);
	}
	function trans(Vector $vtc)
	{
		$identy = new Vertex( array('x' => $this->matrix['a']['1'], 'y' =>$this->matrix['b']['2'], 'z' => $this->matrix['c']['3']) );
		$vtc2  = new Vector(array('dest' => $identy));
		$translated = $vtc->by($vtc2);
		$this->matrix['d'] = array('1' => ($translated->getx()), '2'=> $translated->gety(), '3'=>$translated->getz(), '4'=> '1');
		return ($this->matrix);

	}
	function __construct(array $kwargs){
		if (array_key_exists('preset', $kwargs))
		{
			$preset = $kwargs['preset'];
			$this->matrix = $this->create_matric(array());
			if ($preset == Matrix::TRANSLATION)
			{
				if(array_key_exists('vtc', $kwargs))
					$this->matrix = $this->trans($kwargs['vtc']);
			}
			if ($preset == Matrix::SCALE)
			{
				if(array_key_exists('scale', $kwargs))
				{
					$this->matrix = $this->create_matric(array ('matrice' => $this->matrice->scalarProduct($kwargs['scale'])));
				}
			}
			if ($preset == Matrix::RX)
			{
				if (array_key_exists('angle', $kwargs))
				{
					$o = $kwargs['angle'];
					$this->matrix =  array( "a" => array('1' => 1, '2'=> 0, '3'=> 0, '4'=> 0), "b" =>array('1' =>0, '2'=>  cos($o), '3'=> sin($o), '4'=> 0), "c" => array('1' =>0, '2'=> -sin($o), '3'=>  cos($o), '4'=> 0),"d" => array('1' =>0, '2'=> 0, '3'=> 0, '4'=> 1)); 
				}
			}
			if ($preset == Matrix::RY)
			{
				if (array_key_exists('angle', $kwargs))
				{
					$o = $kwargs['angle'];
					$this->matrix =  array( "a" => array('1' => cos($o), '2'=> 0, '3'=> -sin($o), '4'=> 0), "b" =>array('1' =>0, '2'=>  1, '3'=>0, '4'=> 0), "c" => array('1' =>sin($o), '2'=> 0, '3'=>  cos($o), '4'=> 0),"d" => array('1' =>0, '2'=> 0, '3'=> 0, '4'=> 1)); 
				}
			}
			if ($preset == Matrix::RZ)
			{
				if (array_key_exists('angle', $kwargs))
				{
					$o = $kwargs['angle'];
					$this->matrix =  array( "a" => array('1' => cos($o), '2'=> sin($o), '3'=> 0, '4'=> 0), "b" =>array('1' => -sin($o), '2'=>  cos($o), '3'=> 0, '4'=> 0), "c" => array('1' =>0, '2'=> 0, '3'=>  1, '4'=> 0),"d" => array('1' =>0, '2'=> 0, '3'=> 0, '4'=> 1)); 
						}
			}
			if ($preset == Matrix::PROJECTION)
				$this->projection_calc($kwargs);
			if (self::$verbose)
			echo "Matrix ".$kwargs['preset']." instance constructed"."\n";
		}
		
	}

	function projection_calc(array $kwargs)
	{
		if (array_key_exists('fov', $kwargs))
			$fov = $kwargs['fov'];
		if (array_key_exists('ratio', $kwargs))
			$ratio = $kwargs['ratio'];
		if (array_key_exists('near', $kwargs))
			$near = $kwargs['near'];
		if (array_key_exists('far', $kwargs))
			$far = $kwargs['far'];
		$top = $near * tan((M_PI / 180) * ($fov / 2));
		$right = $top * $ratio;
		$bottom = -$top;
		$left = -$right;
		$xx = (2 * $near) / ($right - $left);
		$yy = (2 * $near) / ($top - $bottom);
		$zz = -(($far + $near) / ($far  - $near));
		$zx = ($right + $left) / ($right  - $left);
		$zy = ($top + $bottom) / ($top  - $bottom);
		$oz = -(2*($far * $near) / ($far  - $near));
		$this->matrix =  array( "a" => array('1' => $xx, '2'=> 0, '3'=> 0, '4'=> 0), "b" =>array('1' => 0, '2'=>  $yy, '3'=> 0, '4'=> 0), "c" => array('1' =>$zx, '2'=> $zy, '3'=> $zz, '4'=> -1),"d" => array('1' =>0, '2'=> 0, '3'=> $oz, '4'=> 0)); 
		return ;
	}
	function __destruct(){
		if(self::$verbose)
			echo "Matrix instance destructed"."\n";
	}
	function doc(){
		print(file_get_contents('Matrix.doc.txt')."\n");
		return ;
	}

	public function mult(Matrix $rhs)
	{

		$a = $this->matrix['a']['1'] * $rhs->matrix['a']['1'] +  $this->matrix['b']['1'] * $rhs->matrix['a']['2'] +  $this->matrix['c']['1'] * $rhs->matrix['a']['3'] ;
		$b = $this->matrix['a']['1'] * $rhs->matrix['b']['1'] +  $this->matrix['b']['1'] * $rhs->matrix['b']['2'] +  $this->matrix['c']['1'] * $rhs->matrix['b']['3'] ;
		$c = $this->matrix['a']['1'] * $rhs->matrix['c']['1'] +  $this->matrix['b']['1'] * $rhs->matrix['c']['2'] +  $this->matrix['c']['1'] * $rhs->matrix['c']['3'] ;

		$d = $this->matrix['a']['2'] * $rhs->matrix['a']['1'] +  $this->matrix['b']['2'] * $rhs->matrix['a']['2'] +  $this->matrix['c']['2'] * $rhs->matrix['a']['3'] ;
		$e = $this->matrix['a']['2'] * $rhs->matrix['b']['1'] +  $this->matrix['b']['2'] * $rhs->matrix['b']['2'] +  $this->matrix['c']['2'] * $rhs->matrix['b']['3'] ;
		$f = $this->matrix['a']['2'] * $rhs->matrix['c']['1'] +  $this->matrix['b']['2'] * $rhs->matrix['c']['2'] +  $this->matrix['c']['2'] * $rhs->matrix['c']['3'] ;

		$g = $this->matrix['a']['3'] * $rhs->matrix['a']['1'] +  $this->matrix['b']['3'] * $rhs->matrix['a']['2'] +  $this->matrix['c']['3'] * $rhs->matrix['a']['3'] ;
		$h = $this->matrix['a']['3'] * $rhs->matrix['b']['1'] +  $this->matrix['b']['3'] * $rhs->matrix['b']['2'] +  $this->matrix['c']['3'] * $rhs->matrix['b']['3'] ;
		$i = $this->matrix['a']['3'] * $rhs->matrix['c']['1'] +  $this->matrix['b']['3'] * $rhs->matrix['c']['2'] +  $this->matrix['c']['3'] * $rhs->matrix['c']['3'] ;

		$this->matrix =  array( "a" => array('1' => $a, '2'=> $d, '3'=> $g, '4'=> 0), "b" =>array('1' => $b, '2'=>  $e, '3'=> $h, '4'=> 0), "c" => array('1' => $c, '2'=> $f, '3'=>  $i, '4'=> 0),"d" => $this->matrix['d']); 
		return ($this);
	}

	public function transformVertex(Vertex $vtx)
	{
		$x = $this->matrix['a']['1'] + $this->matrix['b']['1'] + $this->matrix['c']['1'] + $this->matrix['d']['1'];
		$y = $this->matrix['a']['2'] + $this->matrix['b']['2'] + $this->matrix['c']['2'] + $this->matrix['d']['2'];
		$z = $this->matrix['a']['3'] + $this->matrix['b']['3'] + $this->matrix['c']['3'] + $this->matrix['d']['3'];
		$w = $this->matrix['a']['4'] + $this->matrix['b']['4'] + $this->matrix['c']['4'] + $this->matrix['d']['4'];
		$vtx = new Vertex( array('x' => $x, 'y' => $y, 'z' => $z, 'w' => $w) );
		return($vtx);
	}

	function __toString(){
		$str = sprintf("M | vtcX | vtcY | vtcZ | vtxO\n-----------------------------\n");
		$str .= sprintf("x | %.2f | %.2f | %.2f | %.2f\n",$this->matrix['a']['1'],$this->matrix['b']['1'],$this->matrix['c']['1'],$this->matrix['d']['1']);
		$str .= sprintf("y | %.2f | %.2f | %.2f | %.2f\n",$this->matrix['a']['2'],$this->matrix['b']['2'],$this->matrix['c']['2'],$this->matrix['d']['2']);
		$str .= sprintf("z | %.2f | %.2f | %.2f | %.2f\n",$this->matrix['a']['3'],$this->matrix['b']['3'],$this->matrix['c']['3'],$this->matrix['d']['3']);
		$str .= sprintf("w | %.2f | %.2f | %.2f | %.2f\n",$this->matrix['a']['4'],$this->matrix['b']['4'],$this->matrix['c']['4'],$this->matrix['d']['4']);
		return $str;
	}

}
?>