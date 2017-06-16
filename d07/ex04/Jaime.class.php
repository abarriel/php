<?php
class Jaime extends Lannister{
	public function __construct(){
		$this->_blood = TRUE;
		return;
	}

	public function sleepWith($mate)
	{
		$this->_yes = $mate->_yes;
		if (!$mate->_blood && !$mate->_yes)
			echo "Let's do this.";
		else
		{
			if(!$mate->_yes)
			echo "Not even if I'm drunk !";
			else
			echo "With pleasure, but only in a tower in Winterfell, then.";
		}
		echo "\n";
			return ;
	}
}
?>