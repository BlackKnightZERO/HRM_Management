<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends MY_Controller {

	public function index()
	{
		$this->load->view('Users/userLogin');
		//$this->load->view('Users/test');

	}

	public function userRegistration()
	{
		//$this->load->helper('url');
		$this->load->view('Users/userRegistration');
	}

	public function pageTest()
	{
		$this->load->view('Admin/adminAddDepartmentDesignation');
	}

	public function userpagetest()
	{
		$this->load->view('Users/userHome');
	}
	public function employeeHome()
	{
		$this->load->model('UserModel'); 
		$noticetabledata=$this->UserModel->employeeViewNoticeTable();

		$this->load->view('Employee/employeeHome',['noticetabledata'=>$noticetabledata]);
	}
	public function employeeApplyLeave()
	{
		if($this->session->userdata('sessionid'))
		{
			$id = $this->session->userdata('sessionid');
		}
		if($this->session->userdata('headsessionid'))
		{
			$id = $this->session->userdata('headsessionid');
		}
		$rowload = 10;
		$this->load->model('UserModel'); 
		$myLeaveData=$this->UserModel->myLeaveData($id, $rowload);
		$this->load->view('Employee/employeeApplyLeave',['myLeaveData'=>$myLeaveData]);
	}
	public function employeeApplyLeavee($rowload)
	{
		if($this->session->userdata('sessionid'))
		{
			$id = $this->session->userdata('sessionid');
		}
		if($this->session->userdata('headsessionid'))
		{
			$id = $this->session->userdata('headsessionid');
		}
		$this->load->model('UserModel'); 
		$myLeaveData=$this->UserModel->myLeaveData($id, $rowload);
		$this->load->view('Employee/employeeApplyLeave',['myLeaveData'=>$myLeaveData]);
	}

	
	public function employeeUpdateInfo()
	{
		if($this->session->userdata('sessionid'))
		{
			$id = $this->session->userdata('sessionid');
		}
		if($this->session->userdata('headsessionid'))
		{
			$id = $this->session->userdata('headsessionid');
		}
		$this->load->model('UserModel');
		$singleProfileInfo = $this->UserModel->getSingleProfileInfo($id);
		$this->load->view('Employee/employeeUpdateInfo',['singleProfileInfo'=>$singleProfileInfo]);		
	}


	public function employeeViewEmployeeList()
	{
		$this->load->view('Employee/employeeViewEmployeeList');
	}

	public function employeeAppliedForLeave()
	{
		$this->form_validation->set_rules('leavefrom', 'Leave Start Date', 'required');
		$this->form_validation->set_rules('leaveto', 'Leave End Date', 'required');
		$this->form_validation->set_rules('leavereason', 'Leave Reason', 'required');
		$this->form_validation->set_rules('leavetype', 'Leave Type', 'required');

		if($this->form_validation->run())
		{
			$start = $this->input->post('leavefrom');
			$end = $this->input->post('leaveto');
			$reason = $this->input->post('leavereason');
			$type = $this->input->post('leavetype');
			if($this->session->userdata('sessionid'))
			{
				$id = $this->session->userdata('sessionid');
			}
			if($this->session->userdata('headsessionid'))
			{
				$id = $this->session->userdata('headsessionid');
			}
			

			$this->load->model('UserModel');
			$query = $this->UserModel->applyLeaveQuery($id,$start,$end,$reason,$type);

			if($query)
			{
				$this->session->set_flashdata('msg','Successfully Applied for leave!');
				return redirect('UserController/employeeHome');
			}
			else
			{
				$this->session->set_flashdata('msgg','Faled to apply for leave!');
				return redirect('UserController/employeeHome');
			}

		}
		else
		{
				$this->session->set_flashdata('msgg','Failed ! All fields must be filled!');
				return redirect('UserController/employeeHome');
		}
	}

	public function like()
	{
		$givelikeid = $this->input->post('givelikeid');
		$noticeid = $this->input->post('noticeid');
		$likesinthispost = $this->input->post('likesinthispost');

		$this->load->model('UserModel');
		$var = $this->UserModel->userGivesLike($noticeid, $likesinthispost, $givelikeid);
		if($var==TRUE)
		{
			return redirect('UserController/employeeHome');
		}
		else
		{
			return redirect('UserController/employeeHome');
		}
	}

	public function imageUpload()
	{
		$config = 
		[
			'upload_path' => './ProfilePicture/',
			'allowed_types' => 'gif|jpg|png',
			'max_size' => 2*1024,
			'remove_spaces' => true,
		];

		$this->load->library('upload', $config);

		if($this->upload->do_upload())
		{
			$data = $this->upload->data();
			$img_path = base_url("ProfilePicture/".$data['raw_name'].$data['file_ext']);

			if($this->session->userdata('sessionid'))
					{
						$id = $this->session->userdata('sessionid');
					}
					if($this->session->userdata('headsessionid'))
					{
						$id = $this->session->userdata('headsessionid');
					}
			$this->load->model('UserModel');
			$var = $this->UserModel->profile_pic_upload($id,$img_path);

			if($var == true)
			{
				$this->session->set_flashdata('msg','Image uploaded Successfully!');
				return redirect('UserController/employeeUpdateInfo');
			}
			else
			{
				$this->session->set_flashdata('msgg','Failed to upload image!');
				return redirect('UserController/employeeUpdateInfo');
			}
		}
		else
		{
			$this->session->set_flashdata('msgg','Max file size 2MB JPG,PNG,GIF formats!');
			return redirect('UserController/employeeUpdateInfo');
		}
	}

	public function employeeUpdateAddUpdateInfo()
	{
		if($this->session->userdata('sessionid'))
		{
			$id = $this->session->userdata('sessionid');
		}
		if($this->session->userdata('headsessionid'))
		{
			$id = $this->session->userdata('headsessionid');
		}
		$this->load->model('UserModel');
		$singleProfileInfo = $this->UserModel->getSingleProfileInfo($id);
		$this->load->view('Employee/employeeUpdateAddUpdateinfo',['singleProfileInfo'=>$singleProfileInfo]);
	}

	public function employeeChangePassword()
	{
		if($this->session->userdata('sessionid'))
			{
				$id = $this->session->userdata('sessionid');
			}
			if($this->session->userdata('headsessionid'))
			{
				$id = $this->session->userdata('headsessionid');
			}
		$this->load->model('UserModel');
		$singleProfileInfo = $this->UserModel->getSingleProfileInfo($id);
		$this->load->view('Employee/employeeHomeChangePassword',['singleProfileInfo'=>$singleProfileInfo]);
	}


	public function userAddUpdateOwnInfo()
	{
	
		$this->form_validation->set_rules('empname','Name','trim|required');
		$this->form_validation->set_rules('empblood','Blood group','trim');
		$this->form_validation->set_rules('empnumber','Official Phone','trim|required');
		$this->form_validation->set_rules('empnumber2','Personal Phone','trim');
		$this->form_validation->set_rules('empemail','Official Mail','trim|required|valid_email');
		$this->form_validation->set_rules('empemail2','Additional Mail','trim|valid_email');
		$this->form_validation->set_rules('empbirthdate','Birthday','trim');

		if($this->form_validation->run())
		{
			if($this->session->userdata('sessionid'))
			{
				$id = $this->session->userdata('sessionid');
			}
			if($this->session->userdata('headsessionid'))
			{
				$id = $this->session->userdata('headsessionid');
			}


			$empname = $this->input->post('empname');
			$empblood = $this->input->post('empblood');
			
			$empnumber = $this->input->post('empnumber');
			$empnumber2 = $this->input->post('empnumber2');
			$empemail = $this->input->post('empemail');
			$empemail2 = $this->input->post('empemail2');
			$empbirthdate = $this->input->post('empbirthdate');
	


			$this->load->model('UserModel');
			$userAddUpdateOwnInfo = $this->UserModel->userAddUpdateOwnInfo($id,$empname,$empblood,$empnumber,$empnumber2,$empemail,$empemail2,$empbirthdate);
			if($userAddUpdateOwnInfo == true)
			{
				$this->session->set_flashdata('msg','Information Updated Successfully!');
				return redirect('UserController/employeeUpdateInfo');
			}
			else
			{
				$this->session->set_flashdata('msgg','Failed to update information!');
				return redirect('UserController/employeeUpdateInfo');
			}
			
		}
		else
		{
			$this->session->set_flashdata('msgg','Ooops, something went wrong!');
			return redirect('UserController/employeeUpdateInfo');
		}


		
	}



	public function userUpdateOwnPassword()
	{
		$this->form_validation->set_rules('oldpass','Old Password','trim|required');
		$this->form_validation->set_rules('newpass','New Password','trim|required|min_length[4]|max_length[20]');
		$this->form_validation->set_rules('confpass','Confirm Password','trim|required|min_length[4]|max_length[20]');

		if($this->form_validation->run())
		{
			if($this->session->userdata('sessionid'))
			{
				$id = $this->session->userdata('sessionid');
			}
			if($this->session->userdata('headsessionid'))
			{
				$id = $this->session->userdata('headsessionid');
			}
			$oldpass = $this->input->post('oldpass');
			$newpass = $this->input->post('newpass');
			$confpass = $this->input->post('confpass');
			$hashed_new_password = password_hash($confpass, PASSWORD_BCRYPT);

			if($newpass == $confpass)
			{
				$this->load->model('UserModel');
				$oldhashedpassword = $this->UserModel->oldhashedpassword($id);

				if (password_verify($oldpass, $oldhashedpassword))
				{
					$passwordChangeConfResult = $this->UserModel->userUpdateOwnPassword($id,$hashed_new_password);

					if($passwordChangeConfResult==true)
					{
						$this->session->set_flashdata('msg','Successfully changed password !');
						return redirect('UserController/employeeUpdateInfo');
					}
					else
					{
						$this->session->set_flashdata('msgg','Failed to change password !');
						return redirect('UserController/employeeChangePassword');
					}
				}
				else
				{
					$this->session->set_flashdata('msgg','Error! Old password did not match !');
					return redirect('UserController/employeeChangePassword');
				}
				
			}
			else
			{
				$this->session->set_flashdata('msgg','Error! new password field & confirmed password filed must be same !');
				return redirect('UserController/employeeChangePassword');
			}

			
		}
		else
		{
			$this->session->set_flashdata('msgg','Ooops, something went wrong, password should contain 4-20 characters!');
			return redirect('UserController/employeeChangePassword');
		}
	}

	public function headApproveLeave()
	{
		$rowload = 10;
		$id =$this->session->userdata('headsessiondeptid');
		$this->load->model('UserModel');
		$leaveReqData = $this->UserModel->headViewAllLeaveRequest($id,$rowload);
		$approveReqData = $this->UserModel->headViewAllApprovedRequest($id,$rowload);
		$denyReqData = $this->UserModel->headViewAllDeniedRequest($id,$rowload);
		$this->load->view('Employee/deptHeadApproveLeave',['leaveReqData'=>$leaveReqData, 'approveReqData'=>$approveReqData, 'denyReqData' => $denyReqData]);
		
	}
	public function headApproveLeavee($rowload)
	{
		$id =$this->session->userdata('headsessiondeptid');
		$this->load->model('UserModel');
		$leaveReqData = $this->UserModel->headViewAllLeaveRequest($id,$rowload);
		$approveReqData = $this->UserModel->headViewAllApprovedRequest($id,$rowload);
		$denyReqData = $this->UserModel->headViewAllDeniedRequest($id,$rowload);
		$this->load->view('Employee/deptHeadApproveLeave',['leaveReqData'=>$leaveReqData, 'approveReqData'=>$approveReqData, 'denyReqData' => $denyReqData]);
	}
	public function headApprovedLeave($id)
    {
    //	$leave_id =  $this->uri->segment(3);
  	//	$current_status =  $this->uri->segment(4);

  		$this->load->model('UserModel');
		$queryResult = $this->UserModel->headApprovedLeave($id);

		if($queryResult == true)
		{
			$this->session->set_flashdata('msg','Leave Request Approved!');
			return redirect('UserController/headApproveLeave');
		}
		else
		{
			$this->session->set_flashdata('msgg','Ooops, something went wrong!');
			return redirect('UserController/headApproveLeave');
		}
    }
    public function headDeniedLeave($id)
    {
    	  		$this->load->model('UserModel');
    			$queryResult = $this->UserModel->headDeniedLeave($id);

    			if($queryResult == true)
    			{
    				$this->session->set_flashdata('msgg','Leave Request Denied!');
    				return redirect('UserController/headApproveLeave');
    			}
    			else
    			{
    				$this->session->set_flashdata('msg','Ooops, something went wrong!');
    				return redirect('UserController/headApproveLeave');
    			}
    }

}
?>