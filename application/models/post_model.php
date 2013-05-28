<?php

class Post_model extends Common_model
{
  	public function __construct()
  	{
  		parent::__construct();
  	}
	
	
  	public function getPost($options = array())
  	{
    	$options = $this->setDefault(array('sortDirection' => 'asc'), $options);
		
    	$columns = array('id', 'title', 'lead', 'body','author', 'created','status'); 
    	$uniqueFlags = array('id');
    	
    	return $this->get('post', $columns, $options, $uniqueFlags);
	}
	
	public function insertPost($title, $lead, $body, $author)
  	{
    	$values = array('title' => $title,
			'lead' => $lead,
			'body' => $body,
			'author' => $author);
		
		$this->insert('post', $values);
	}
	
	public function updatePost($title, $lead, $body, $author, $status, $id)
  	{
    	$values = array('title' => $title,
			'lead' => $lead,
			'body' => $body,
			'author' => $author,
			'status' => $status);
			
		$this->db->where('id', $id);
		$this->db->update('post', $values); 

	}
	
	public function deletePost($id)
  	{
				
		$this->db->where('id', $id);
		$this->db->delete('post'); 
		

	}
}
?>