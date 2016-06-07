<?php

class Common_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	protected function get($table, &$columns, &$options, &$uniqueFlags) {
		$options = $this->setDefault(array('sortDirection' => 'asc'), $options);
		
		// setting SQL where clause
    	foreach ($columns as $column) {
        	if(isset($options[$column])) {
        		$this->db->where($column, $options[$column]);
			}
    	}
		
		// setting SQL limit and offset clauses 
    	if (isset($options['limit']) && isset($options['offset'])) {
    		$this->db->limit($options['limit'], $options['offset']);
		} else if(isset($options['limit'])) {
    		$this->db->limit($options['limit']);
		}

		// setting SQL order_by and sort_direction clauses
    	if(isset($options['sortBy'])) {
    		$this->db->order_by($options['sortBy'], $options['sortDirection']);
		}
		
		$query = $this->db->get($table);
		
		// no results -> return FALSE
		if ($query->num_rows() == 0) {
			return FALSE;
		}
		
		// return single row
		foreach($uniqueFlags as $flag) {
			if (isset($options[$flag])) {
				return $query->row(0);
			}
		}
		
		// return set of rows
		return $query->result();
	}

	protected function insert($table, &$values) {
		$this->db->insert($table, $values);
	}
	
	protected function setDefault($defaults, $options) {
		return array_merge($defaults, $options);
	}

}