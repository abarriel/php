<?php 
class Color {
	public $red = 0;
	public $green = 0;
	public $blue = 0;
	static $verbose = FALSE;
	
	function __construct(array $kwargs){
		if(array_key_exists('red', $kwargs))
			$this->red = $kwargs['red'];
		if(array_key_exists('green', $kwargs))
			$this->green = $kwargs['green'];
		if(array_key_exists('blue', $kwargs))
			$this->blue = $kwargs['blue'];
		if(array_key_exists('rgb', $kwargs))
		{
			if($kwargs['rgb'] & 0xff0000)
			$this->red = $kwargs['rgb'] >> 16;
			if($kwargs['rgb'] & 0x00ff00)
			$this->green =  $kwargs['rgb'] >> 8&255; 
			if($kwargs['rgb'] & 0x0000ff)
			$this->blue =  $kwargs['rgb'] &255; 
		}
		if (self::$verbose)
			echo $this." constructed."."\n";
	}

	function doc(){
		print(file_get_contents('Color.doc.txt'));
		return ;
	}

	function __toString(){
		return(sprintf("Color( red: %3d, green: %3d, blue: %3d )",$this->red,$this->green,$this->blue));
	}

	public function add(Color $rhs)
	{
		return( new Color( array( 'red' => $this->red + $rhs->red, 'green' => $this->green + $rhs->green, 'blue' => $this->blue + $rhs->blue) ));
	}
		

	public function sub(Color $rhs)
	{
		return(new Color( array(
		 'red' => $this->red - $rhs->red, 
		 'green' => $this->green - $rhs->green,
		  'blue' => $this->blue - $rhs->blue) )
		);
	}

	public	function mult($f)
	{
		return( new Color( array( 'red' => $this->red * $f, 'green' => $this->green * $f, 'blue' => $this->blue * $f) ));
	}
	public function __destruct(){
		if (self::$verbose)
			echo $this." destructed."."\n";
	}
}
?>
