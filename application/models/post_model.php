<?php

class Post_model extends Common_model
{
  	public function __construct()
  	{
  		parent::__construct();
  	}
	
	public function insertPost()
	{
		
	}
	
  	public function getPost($options = array())
  	{
    	$options = $this->setDefault(array('sortDirection' => 'asc'), $options);
		
    	$columns = array('id', 'title', 'lead', 'body','author', 'created','status'); // u config naziv polja
    	$uniqueFlags = array('id');
    	
    	return $this->get('post', $columns, $options, $uniqueFlags);
	}

	public function getPostViewsWithIDs($ids, $options = array())
	{
		return $this->getFromValues('post', 'id', $ids, $options);
	}
}
?>