<?php 
class NightsWatch
{
	private $_people;
	public function __construct() {
		$this->_people = array();
	}
	public function recruit($p) {
		if (isset(class_implements($p)['IFighter']))
			$this->_people[] = $p;
	}
	public function fight() {
		foreach ($this->_people as $p) {
				$p->fight();
		}
	}
}
?>