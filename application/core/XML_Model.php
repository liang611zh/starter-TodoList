<?php


class XML_Model extends Memory_Model {

	protected $xml = null;


	function __construct($origin = null, $keyfield = 'id', $entity = null)
	{	

		parent::__construct();

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

		var_dump(realpath($this->_origin));
		if (file_exists(realpath($this->_origin))) {
		    $this->xml = simplexml_load_file(realpath($this->_origin));

		    $xmlarray =$this->xml;

		    //if it is empty; 
		    if(count($xmlarray) == 0) {
		    	return;
		    }


		    $rootkey = key($xmlarray);

		    

		    $xmlcontent = (object)$xmlarray->$rootkey;

		    //var_dump($xmlcontent);

		    $keyfield = array();
		    $first = true;

		    //if it is empty; 
		    if(count($xmlcontent) == 0) {
		    	return;
		    }


		    foreach ((array)$xmlcontent as $key => $value) {
		    		$keyfield[] = $key;
		    	
		    }

		    //construct the key fields array
		    $this->_fields = $keyfield;

		    foreach ($xmlcontent as $key => $value) {
		    	if ($first)
				{
					// populate field names from first row
					
					

				}
		    	
		    }


		 
		   var_dump($xmlcontent);
		} else {
		    exit('Failed to open xml database.');
		}
		



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