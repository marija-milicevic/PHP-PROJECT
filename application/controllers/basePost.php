<?php

class BasePost extends CI_Controller {
    public $main_content_data = array();

    public function __construct() {
        parent::__construct();

        $this->load->model('post_model');
        $this->load->helper('ckeditor');
        $this->load->library("pagination");

        $this->main_content_data['ckeditor'] = array(
            'id' 	=> 	'content',
            'path'	=>	'public/js/ckeditor',

            'config' => array(
                'width' 	=> 	"590px",
                'height' 	=> 	'200px',

            )
        );
    }

    /** Get posts
     * @param int $status, 0- unpublished, 1- published
     */
    public function getPosts($status) {
        return $this->post_model->getPost(array(
                'sortBy' => 'created',
                'sortDirection' => 'desc',
                'status' => $status)
        );
    }

    public function display($postId, $viewPath) {
        $post = $this->post_model->getPost(array('id' => $postId));

        $this->main_content_data['post'] = $this->getPostData($post);
        $this->main_content_data['title'] = "post";

        $this->load->view('templates/template',array(
            'main_content' => $viewPath,
            'data' => $this->main_content_data
        ));
    }

    public function loadContentData($posts,$message = '') {
        $main_content_data = array(
            'title' => 'Post',
            'message' => $message,
            'posts' => array()
        );

        if ($posts) {
            for ($i = 0; $i < sizeof($posts); $i++) {
                $main_content_data['posts'][$i] = $this->getPostData($posts[$i]);
            }
        }

        return $main_content_data;
    }

    public function loadPostList($contentData, $viewPath) {
        $this->load->view('templates/template',array(
            'main_content' => $viewPath,
            'data' => $contentData
        ));
    }

    /**
     * @return bool
     */
    public function isValidPost() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('author', 'Author', 'trim|required|min_lenght[3]|max_lenght[100]');
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('lead', 'Lead', 'trim|required');
        $this->form_validation->set_rules('content', 'Content', 'trim|required');

        return $this->form_validation->run();
    }

    private function getPostData($postRow) {
        return isset($postRow)
            ? array(
                'id' => $postRow->id,
                'title' => $postRow->title,
                'lead' => $postRow->lead,
                'body' => $postRow->body,
                'author' => $postRow->author,
                'created' => $postRow->created
            )
            : null;
    }


}
?>