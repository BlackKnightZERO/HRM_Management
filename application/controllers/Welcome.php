<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function imageUpload()
	{
		$config = [
			'upload_path'=>'./ProfilePicture/',
			'allowed_types'=>'gif|jpg|png'
		];
			$this->load->library('upload',$config);
		if($this->upload->do_upload())
		{
			$uploaddata=$this->upload->data();
			$imagepath=base_url("ProfilePicture/".$uploaddata['raw_name'].$uploaddata['file_ext']);

			echo $imagepath;
		}
		else{
			echo "failed";
		}
		echo "<br/>";
		echo "End";
		
	}

	public function hidden()
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$url = $this->input->post('url');

		echo $name;
		echo $email;
		echo $url;
	}
}
