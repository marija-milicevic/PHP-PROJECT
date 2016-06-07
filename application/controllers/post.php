<?php

class Post extends BasePost
{


    /** Display published posts
     * @param string $message
     */
    public function index($message = "") {
        $posts = $this->getPosts(1);
        $contentData = $this->loadContentData($posts, $message);
        $this->loadPostList($contentData, 'postList');
    }

    public function display($postId) {
        parent::display($postId, 'postDetail');
    }

    public function add()
    {
        if (!empty($_POST)) {

            if (!$this->isValidPost()) {
                $this->loadForm();
            } else {
                $post_title = $this->input->post('title');
                $post_lead = $this->input->post('lead');
                $post_body = $this->input->post('content');
                $post_author = $this->input->post('author');

                if (!$this->post_model->insertPost($post_title, $post_lead, $post_body, $post_author)) {
                    $message = "Post is successfully saved and wait to be published. ";
                } else {
                    $message = "Error...";
                }

                $this->index($message);
            }

        } else {
            $this->loadForm();
        }
    }

    private function loadForm() {
        $this->main_content_data['title'] = "New post";

        $this->load->view('templates/template', array(
            'main_content' => 'newPost',
            'data' => $this->main_content_data
        ));
    }

}