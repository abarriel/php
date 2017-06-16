<?php
abstract class House{
	abstract public function getHouseName();
	abstract public function getHouseMotto();
	abstract public function getHouseSeat();
	
	public function introduce(){
		echo "House ";
		echo static::getHouseName()." of ";
		echo static::getHouseSeat()." : \"";
		echo static::getHouseMotto()."\" \n";
	}
}
?>