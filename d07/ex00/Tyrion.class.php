<?php 
class Tyrion extends Lannister{
	function __construct()
	{
		parent::__construct();
		echo "My name is Tyrion\n";
		return; 
	}
	function getSize(){
		echo "Short";
		return ;
	}
}
?>