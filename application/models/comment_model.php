<?php
class Comment_model extends Common_model
{
  	public function __construct()
  	{
  		parent::__construct();
  	}
	
	public function insertComment()
	{
		
	}
	
  	function getComment($options = array())
  	{
    	$options = $this->setDefault(array('sortDirection' => 'asc'), $options);
		
    	$columns = array('id', 'author','created_date', 'text','status', 'post'); // u config naziv polja
    	$uniqueFlags = array('id');
    	
    	return $this->get('comment', $columns, $options, $uniqueFlags);
	}

}
?>