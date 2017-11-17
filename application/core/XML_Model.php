<?php


class XML_Model extends Memory_Model {

	protected $xml = null;


	function __construct($origin = null, $keyfield = 'id', $entity = null)
	{	

		parent::__construct();
		$origin  = realpath($origin);
		// guess at persistent name if not specified
			if ($origin == null)
				$this->_origin = get_class($this);
			else
				$this->_origin = $origin;

			// remember the other constructor fields
			$this->_keyfield = $keyfield;
			$this->_entity = $entity;

			// start with an empty collection
			$this->_data = array(); // an array of objects
			$this->fields = array(); // an array of strings
			// and populate the collection
			$this->load();

	}

			/**
	 * Load the collection state appropriately, depending on persistence choice.
	 * OVER-RIDE THIS METHOD in persistence choice implementations
	 */
	protected function load()
	{

		//var_dump(realpath($this->_origin));
		if (file_exists(realpath($this->_origin))) {
		    $this->xml = simplexml_load_file(realpath($this->_origin));

		    $xmlarray =$this->xml;

		    //if it is empty; 
		    if(empty($xmlarray)) {
		    	return;
		    }

		    //get all xmlonjects into $xmlcontent
		    $rootkey = key($xmlarray);
		    $xmlcontent = (object)$xmlarray->$rootkey;

		    $keyfield = array();
		    $first = true;

		    //if it is empty; 
		    if(empty($xmlcontent)) {
		    	return;
		    }

		    $dataindex = 1;
		    $first = true;
		    foreach ($xmlcontent as $oj) {
		    	if($first){
			    	foreach ($oj as $key => $value) {
			    		$keyfield[] = $key;	
			    		//var_dump((string)$value);
			    	}
			    }
		    	$first = false; 

		    	//var_dump($oj->children());
		    	$one = new stdClass();

		    	//get objects one by one
		    	foreach ($oj as $key => $value) {
		    		$one->$key = (string)$value;
		    	}
		    	$this->_data[$dataindex++] =$one; 
		    }	
		 	//var_dump($this->_data);
		} else {
		    exit('Failed to open the xml file.');
		}

		// --------------------
		// rebuild the keys table
		$this->reindex();
	}

	/**
	 * Store the collection state appropriately, depending on persistence choice.
	 * OVER-RIDE THIS METHOD in persistence choice implementations
	 */
	protected function store()
	{
		// rebuild the keys table
		$this->reindex();
		//---------------------
		if (($handle = fopen($this->_origin, "w")) !== FALSE)
		{
			fputcsv($handle, $this->_fields);
			foreach ($this->_data as $key => $record)
				fputcsv($handle, array_values((array) $record));
			fclose($handle);
		}
		// --------------------
	}


}