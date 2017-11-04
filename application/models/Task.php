<?php


class Task extends Entity {

	protected $task;
	protected $id;
	protected $priority;
	protected $size;
	protected $group;
	protected $deadline;
	protected $status;
	protected $flag;


	private function echoExecption($err) {
		throw new Exception($err);
	}

	public function setTask($value) {
		$err = "Rule for task should be alpha_numeric_spaces|max_length[64]";

		$strsize = strlen($value);
		if(!is_string($value) || $strsize > 64) {
			echoExecption($err);
		}

		for($x = 0;$x < $strsize; $x++) {
			$c = $value[$x];
			if(!ctype_alnum($c) || !ctype_space($c)) {
				echoExecption($err);
			}
		}
		$this->task = $value;
		return $this;
	}

	public function setPriority($value) {
		$err = "Rule for priority should be integer|less_than[4].";

		if(is_int($value) && $value < 4) {
			$this->priority = $value;
			return $this;
		} 

		echoExecption($err);

	}

	public function setSize($value) {
		$err = "Rule for size should be integer|less_than[4].";

		if(is_int($value) && $value < 4) {
			$this->size = $value;
			return $this;
		} 

		echoExecption($err);
		
	}

	public function setLabel($value) {
		$err = "Rule for label should be integer|less_than[4].";

		if(is_int($value) && $value < 5) {
			$this->label = $value;
			return $this;
		} 

		echoExecption($err);
	}

}


?>