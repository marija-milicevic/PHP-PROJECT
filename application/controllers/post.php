<?php

class Post extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('post_model');
	}

	public function index()
	{
		///
		/// Display the latest post from the database when page is accessed
		///
		
		$allPostsDB = $this->post_model->getPost(array(
			'sortBy' => 'created',
			'sortDirection' => 'desc'));
		
		
		$this->loadPosts($allPostsDB);
	}
	
	public function display($postId)
	{
		$post = $this->post_model->getPost(array('id' => $postId));
		//$this->loadPost($post);
	}
	
	
	public function addComment()
	{
		
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
		
		$data['main_content'] = "postList";
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
	
		///
		/// Load comment model to get post comments
		///
		
		$this->load->model('comment_model');
		$post['comments'] = array();
		
		$commentDB = $this->comment_model->getComment(array(
			'post' => $post['id'],
			'sortBy' => 'date',
			'sortDirection' => 'desc'));
		
		if ($commentDB !== FALSE)
		{
			for ($i = 0; $i < sizeof($commentDB); $i++)
			{
				$post['comments'][$i] = array();
				$post['comments'][$i]['id'] = $commentDB[$i]->id;
				$post['comments'][$i]['text'] = $commentDB[$i]->text;
				$post['comments'][$i]['date'] = $commentDB[$i]->created_date;
				$post['comments'][$i]['status'] = $commentDB[$i]->status;
				$post['comments'][$i]['author'] = $commentDB[$i]->author;
			}
			
		}
		///
		/// Load back default model
		///
		
		$this->load->model('post_model');
		
		return $post;
	}

	
}
?>