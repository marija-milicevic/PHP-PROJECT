<?php

class Post_model extends Common_model
{
  	public function __construct()
  	{
  		parent::__construct();
  	}
	
	public function insertFilmView($filmID, $viewDate, $viewDescription)
	{
		$values = array('FILM_ID' => $filmID,
			'VIEW_DATE' => $viewDate,
			'VIEW_LIKES' => '0',
			'VIEW_DESCRIPTION' => $viewDescription);
		
		$this->db->trans_begin();
		
		$this->insert('VIEW', $values);
		$viewDB = $this->getFilmView(array('sortBy' => 'VIEW_ID', 'sortDirection' => 'desc', 'limit' => '1'));
		
		$newFilmView = array();
		
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			$newFilmView = NULL;
		}
		else
		{
			$this->db->trans_commit();
			
			$newFilmView['id'] = $viewDB[0]->VIEW_ID;
			$newFilmView['date'] = $viewDB[0]->VIEW_DATE;
			$newFilmView['description'] = $viewDB[0]->VIEW_DESCRIPTION;
			$newFilmView['likes'] = $viewDB[0]->VIEW_LIKES;
		}
		
		return $newFilmView;
	}
	
  	public function getPost($options = array())
  	{
    	$options = $this->setDefault(array('sortDirection' => 'asc'), $options);
		
    	$columns = array('id', 'title', 'body','author', 'created','status'); // u config naziv polja
    	$uniqueFlags = array('id');
    	
    	return $this->get('post', $columns, $options, $uniqueFlags);
	}

	public function getFilmViewsWithIDs($ids, $options = array())
	{
		return $this->getFromValues('VIEW', 'VIEW_ID', $ids, $options);
	}
}
?>