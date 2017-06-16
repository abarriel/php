<?php
class Tyrion extends Lannister{
	
 	// protected static $_blood = TRUE;
	public function __construct(){
		$this->_blood = TRUE;
		$this->_yes = FALSE;
		return;
	}
	public function sleepWith($mate)
	{
		$this->_yes = $mate->_yes;
		if (!$mate->_blood && !$mate->_yes)
			echo "Let's do this.";
		else
		{
			if($mate->_yes)
			echo "Not even if I'm drunk !";
			else
			echo "With pleasure, but only in a tower in Winterfell, then.";
		}
		echo "\n";
			return ;
	}
}
?>