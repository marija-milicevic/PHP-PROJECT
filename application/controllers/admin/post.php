<?php
session_start();

class Post extends CI_Controller {

	public $main_content_data = array();	
		
	public function __construct() {
		parent::__construct();
		$this->is_logeed();
		
		$this->load->model('post_model');
		$this->load->helper('ckeditor');
		
		$this->main_content_data['ckeditor'] = array(
			'id' 	=> 	'content',
			'path'	=>	'public/js/ckeditor',
 
			'config' => array(
				'width' 	=> 	"590px",
				'height' 	=> 	'200px',
			)
		);
	}

    /**
     * Display the unpublished posts
     */
    public function index() {
        $allPostsDB = $this->post_model->getPost(array(
            'sortBy' => 'created',
            'sortDirection' => 'desc',
            'status' => 0));

        $this->loadPosts($allPostsDB);
    }

    /**
     * Check if user is authorized. If it is not redirect to login page
     */
	public function is_logeed() {
		$is_logeed = $this->session->userdata('logeed');

		if(!isset($is_logeed) || $is_logeed != true){
			redirect('/login');
		}
	}
	
	public function logout() {
	   $this->session->unset_userdata('logeed');
	   $this->session->unset_userdata('username');
	   session_destroy();
	   redirect('/login', 'refresh');
	}

    /** Display post details
     * @param int $postId
     */
	public function display($postId) {
		$post = $this->post_model->getPost(array('id' => $postId));
		$this->main_content_data['post'] = $this->getPostData($post);
		
		$data['main_content'] = "/admin/postDetail";
		$this->main_content_data['title'] = "post";
		$data['data'] = $this->main_content_data;
		
		$this->load->view('templates/template',$data);
	}
	
	public function authorize()
	{
		if($this->input->post('submit') == "delete") {
			
			 $id = $this->input->post('post_id');			
			 if(!$this->post_model->deletePost($id)) 
				 $message = "Post is successufully deleted.";
			 else
			 	$message = "Error!";

				
			 $this->index($message);
   
		} else {
			
			$this->load->library('form_validation');

			$this->form_validation->set_rules('author', 'Author', 'trim|required|min_lenght[3]|max_lenght[100]');
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('lead', 'Lead', 'trim|required');
			$this->form_validation->set_rules('content', 'Content', 'trim|required');
		
			if ($this->form_validation->run() == FALSE)
			{
				$data['main_content'] = "admin/postDetail";
				$this->main_content_data['title'] = "Post";
				$data['data'] = $this->main_content_data;
		
				$this->load->view('templates/template',$data);
			}
			else
			{
				$post_title = $this->input->post('title');
				$post_lead = $this->input->post('lead');
				$post_body = $this->input->post('content');
				$post_author = $this->input->post('author');
				$post_status = 1;
		
				$id = $this->input->post('post_id');
				$this->post_model->updatePost($post_title, $post_lead, $post_body, $post_author, $post_status, $id);
				
				
				//$message = "Post is successufuly approved. ";
				$this->index();
			}
    
		}
	}
	
	
	private function loadPosts($posts)
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
		
		$data['main_content'] = "/admin/postList";
		$main_content_data['title'] = "Post";
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