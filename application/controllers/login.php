<?php
class Login extends CI_Controller
{
	function index($message = '') {
		
		$data['main_content'] = "login";
		$this->main_content_data['title'] = "Login";
		$this->main_content_data['message'] = $message;
		$data['data'] = $this->main_content_data;
		
		$this->load->view('templates/template',$data);
	}
	
	function do_login() {
		
		$this->load->model('user_model');
		
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		
		$user = $this->user_model->getUser(array(
			'username' => $username,
			'password' => $password));
			
		if($user)
		{
			$session_data = array(
				'username' => $this->input->post('username'),
				'logeed' => true
			);
			
			$this->session->set_userdata($session_data);
			redirect('/admin/post');
		}
		else{
			$message = "Username or password is wrong!";
			$this->index($message);
		}
	}
}
?>