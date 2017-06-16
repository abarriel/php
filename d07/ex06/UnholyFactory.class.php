<?php
class UnholyFactory{

	public $factored = array();

	public function absorb($soldiers)
	{
		foreach ($this->factored as $key => $value) {
			if($value == $soldiers)
			{
			echo "(Factory already absorbed a fighter of type ".$soldiers->type.")\n";
			return ;
			}
		}
		if (!($soldiers instanceof Fighter))
		{
			echo "(Factory can't absorb this, it's not a fighter)\n";
			return; 
		}
		array_push($this->factored, $soldiers);
		echo "(Factory absorbed a fighter of type ".$soldiers->type.")\n";
		return ;
	}

	public function fabricate($requested)
	{
		foreach ($this->factored as $key => $value) {
				 if($this->factored[$key]->type == $requested)
				 {	
					 echo "(Factory fabricates a fighter of type".$requested.")\n";
					 return ($this->factored[$key]);
				 }
		}
		echo "(Factory hasn't absorbed any fighter of type ".$requested.")\n";

	}
}
?>