<?php

class Post extends CI_Controller
{
	public $main_content_data = array();	
		
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('post_model');
		$this->load->helper('ckeditor');
		$this->load->library("pagination");	
			
		$this->main_content_data['ckeditor'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'content',
			'path'	=>	'public/js/ckeditor',
 
			'config' => array(
				'width' 	=> 	"590px",
				'height' 	=> 	'200px',	
 
			),
 
		);
	}

	public function index($message = "")
	{
		///
		/// Display the published posts from the database when page is accessed
		///
		
		$allPostsDB = $this->post_model->getPost(array(

			'sortBy' => 'created',
			'sortDirection' => 'desc',
			'status' => 1));
		
		
		$this->loadPosts($allPostsDB,$message);
	}
	
	public function display($postId)
	{
		$post = $this->post_model->getPost(array('id' => $postId));

		$this->main_content_data['post'] = $this->getPostData($post);
		
		$data['main_content'] = "postDetail";
		$this->main_content_data['title'] = "post";
		$data['data'] = $this->main_content_data;
		
		$this->load->view('templates/template',$data);
	}
	
	
	public function add()
	{
		if (!empty($_POST)){
				
			$this->load->library('form_validation');

			$this->form_validation->set_rules('author', 'Author', 'trim|required|min_lenght[3]|max_lenght[100]');
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('lead', 'Lead', 'trim|required');
			$this->form_validation->set_rules('content', 'Content', 'trim|required');
		
			if ($this->form_validation->run() == FALSE)
			{
				$data['main_content'] = "newPost";
				$this->main_content_data['title'] = "New post";
				$data['data'] = $this->main_content_data;
		
				$this->load->view('templates/template',$data);
			}
			else
			{
				$post_title = $this->input->post('title');
				$post_lead = $this->input->post('lead');
				$post_body = $this->input->post('content');
				$post_author = $this->input->post('author');
		
		
				if(!$this->post_model->insertPost($post_title, $post_lead, $post_body, $post_author))
					$message = "Post is successufuly saved and wait to be published. ";
				else
					$message = "Error...";
				$this->index($message);
			}
			
		}
		else{
			
			
			$data['main_content'] = "newPost";
			$this->main_content_data['title'] = "New post";
			$data['data'] = $this->main_content_data;
		
			$this->load->view('templates/template',$data);
			
		}
	}
	
	private function loadPosts($posts,$message)
	{
		$main_content_data = array();
		$main_content_data['posts'] = array();

		///
		/// Get data for the posts
		///
		if ($posts !== FALSE)
		{
		
			for ($i = 0; $i < sizeof($posts); $i++)
			{
				$main_content_data['posts'][$i] = $this->getPostData($posts[$i]);
			}
		
		}
		
		///
		/// Prepare and load the view
		///
		
		$data['main_content'] = "postList";
		$main_content_data['title'] = "Post";
		$main_content_data['message'] = $message;
		$data['data'] = $main_content_data;
		
		$this->load->view('templates/template',$data);
	}
	
	private function getPostData($postRow)
	{
		if ($postRow == NULL)
		{
			return NULL;
		}
		
		$post = array();
		
		$post['id'] = $postRow->id;
		$post['title'] = $postRow->title;
		$post['lead'] = $postRow->lead;
		$post['body'] = $postRow->body;
		$post['author'] = $postRow->author;
		$post['created'] = $postRow->created;
	
		return $post;
	}

	
}
?>