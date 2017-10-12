<?php


/*Data model class for tasks.csv table.*/
class Tasks extends CSV_Model {

        public function __construct()
        {
                parent::__construct(APPPATH . '../data/tasks.csv', 'id');
        }

}



?>