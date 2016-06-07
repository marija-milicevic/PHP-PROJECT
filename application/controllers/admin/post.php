<?php
session_start();

class Post extends BasePost {

    /**
     * Display the unpublished posts
     */
    public function index() {
        $posts = $this->getPosts(0);
        $contentData = $this->loadContentData($posts);
        $this->loadPostList($contentData, '/admin/postList');
    }

    /**
     * Check if user is authorized. If it is not redirect to login page
     */
	public function is_logged() {
		$is_logged = $this->session->userdata('logged');

		if(!isset($is_logged) || $is_logged != true){
			redirect('/login');
		}
	}
	
	public function logout() {
	   $this->session->unset_userdata('logged');
	   $this->session->unset_userdata('username');
	   session_destroy();
	   redirect('/login', 'refresh');
	}

    /** Display post details
     * @param int $postId
     */
	public function display($postId) {
        parent::display($postId, '/admin/postDetail');
	}
	
	public function authorize()
	{
        try {
            if($this->input->post('submit') == "delete") {
                $this->deletePost($this->input->post('post_id'));
                $this->index("Post is successfully deleted.");
            } else {
                $this->approvePost();
            }
        } catch (Exception $e) {
            $this->index($e->getMessage());
        }
	}

    private function deletePost($id) {
        if(!$this->post_model->deletePost($id)) {
            throw new Exception('Post is not successfully deleted. Please, try later.');
        }
    }

    private function approvePost() {

        if (!$this->isValidPost()) {
            $this->main_content_data['title'] = "Post";

            $this->load->view('templates/template',array(
                'main_content' => "admin/postDetail",
                'data' => $this->main_content_data
            ));
        } else {
            $post_title = $this->input->post('title');
            $post_lead = $this->input->post('lead');
            $post_body = $this->input->post('content');
            $post_author = $this->input->post('author');
            $post_status = 1;

            $id = $this->input->post('post_id');
            $this->post_model->updatePost($post_title, $post_lead, $post_body, $post_author, $post_status, $id);

            $this->index("Post is successfully approved.");
        }
    }
	
}
?>