<?php
class User_model extends Common_model {

  	public function __construct() {
  		parent::__construct();
  	}
	
  	function getUser($options = array()) {
    	$columns = array('id', 'username', 'password');
    	$uniqueFlags = array('id');
    	
    	return $this->get('user', $columns, $options, $uniqueFlags);
	}

}
?>