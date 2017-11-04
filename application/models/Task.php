<?php

require '../application/core/Entity.php';
class Task extends Entity {

	protected $task;
	protected $priority;
	protected $size;
	protected $group;


	//check the task
	public function setTask($value) {

		$strsize = strlen($value);
		if(!is_string($value) || $strsize > 64) {
			return false;
		}

		for($x = 0;$x < $strsize; $x++) {
			$c = $value[$x];
			if(!(ctype_alnum($c) || ctype_space($c))) {
				return false;
			}
		}
		$this->task = $value;
		return true;
	}
	//check the priority
	public function setPriority($value) {

		if(is_int($value) && $value < 4) {
			$this->priority = $value;
			return true;
		} 

		return false;

	}
	//check the size
	public function setSize($value) {

		if(is_int($value) && $value < 4) {
			$this->size = $value;
			return true;
		} 

		return false;
		
	}
	//check the group
	public function setGroup($value) {

		if(is_int($value) && $value < 5) {
			$this->group = $value;
			return true;
		} 

		return false;
	}

}


?>