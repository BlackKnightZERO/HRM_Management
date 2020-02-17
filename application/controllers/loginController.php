<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends MY_Controller {

public function userLogin()
{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('pass', 'Password', 'trim|required|min_length[4]|max_length[20]');
		if($this->form_validation->run())
		{
			$email = $this->input->post('email');
			$pass = $this->input->post('pass');
			$this->load->model('LoginModel');
			if($var = $this->LoginModel->loginPasswordValidate($email,$pass))
			{	
				$sid=$var->id;
				$sname=$var->name;
				$role=$var->employee_role;
				$dept_head=$var->dept_head;
				$dept_id = $var->department_id;

				if($role == 1)
					{
					$adminsessiondata = array(
					        'adminsessionid'  => $sid,
					        'adminsessionname' => $sname
					        
					);

					$this->session->set_userdata($adminsessiondata);
						
				 	return redirect('/AdminController/adminDashboard/');
					}
				//endif
				if($role == 0 && $dept_head == 0)
				{
					$usersessiondata = array(
					        'sessionid'  => $sid,
					        'sessionname' => $sname,
					        
					);

					$this->session->set_userdata($usersessiondata);
					return redirect('/UserController/employeeHome/');
				}
				if($role == 0 && $dept_head == 1)
				{
					$headsessiondata = array(
					        'headsessionid'  => $sid,
					        'headsessionname' => $sname,
					        'headsessiondeptid' => $dept_id,
					        
					);

					$this->session->set_userdata($headsessiondata);
					return redirect('/UserController/employeeHome/');
				}
				//endif
			}
			else
			{	
				$this->session->set_flashdata('msg','Wrong Email or Password');
				return redirect('/UserController/index/');  
			}
		}
		else 
		{
			$this->load->view('Users/userLogin');
		}		                
	}

	public function userLogout()
		{
			$this->session->unset_userdata('sessionid');
			$this->session->unset_userdata('sessionname');

			$this->session->unset_userdata('headsessionid');
			$this->session->unset_userdata('headsessionname');
			$this->session->unset_userdata('headsessiondeptid');

			$this->session->sess_destroy('sessionid');
			$this->session->sess_destroy('sessionidname');

			$this->session->sess_destroy('headsessionid');
			$this->session->sess_destroy('headsessionname');
			$this->session->sess_destroy('headsessiondeptid');

			return redirect('/UserController/index/'); /* return redirect('/UserController/userLogin/');  */
		}

		public function adminLogout()
		{
			$this->session->unset_userdata('adminsessionid');
			$this->session->unset_userdata('adminsessionname');
			$this->session->sess_destroy('adminsessionid');
			$this->session->sess_destroy('adminsessionname');
			return redirect('/UserController/index/');
		}


}
?>