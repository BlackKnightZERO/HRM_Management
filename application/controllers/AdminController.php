<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller 
{

	public function adminDashboard()
	{		  	
		$this->load->model('AdminModel'); 
		$noticetabledata=$this->AdminModel->adminViewNoticeTable();
		$birthdayTodaydata=$this->AdminModel->birthdayToday();
		$onLeaveTodaydata=$this->AdminModel->onLeaveTodaydata();
		$employeeCountBadge=$this->AdminModel->employeeCountBadge();
		$leaveReqPendingCountBadge=$this->AdminModel->leaveReqPendingCountBadge();
		$attendances=$this->AdminModel->attendanceToday();
		$this->load->view('Admin/adminHome',['noticetabledata'=>$noticetabledata, 'birthdayTodaydata'=>$birthdayTodaydata, 'onLeaveTodaydata' => $onLeaveTodaydata,'employeeCountBadge'=>$employeeCountBadge ,'leaveReqPendingCountBadge'=>$leaveReqPendingCountBadge, 'attendances'=>$attendances]);
	}

	public function adminUpdateInfo()
	{
		if($this->session->userdata('adminsessionid'))
		{
			$id = $this->session->userdata('adminsessionid');
		}

		$this->load->model('AdminModel');
		$employeeCountBadge=$this->AdminModel->employeeCountBadge();
		$leaveReqPendingCountBadge=$this->AdminModel->leaveReqPendingCountBadge();
		$singleProfileInfo=$this->AdminModel->singleProfileInfo($id);

		$this->load->view('Admin/adminUpdateInfo',['singleProfileInfo'=>$singleProfileInfo,'employeeCountBadge'=>$employeeCountBadge ,'leaveReqPendingCountBadge'=>$leaveReqPendingCountBadge]);
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

			if($this->session->userdata('adminsessionid'))
					{
						$id = $this->session->userdata('adminsessionid');
					}
					
			$this->load->model('AdminModel');
			$var = $this->AdminModel->profile_pic_upload($id,$img_path);

			if($var == true)
			{
				$this->session->set_flashdata('msg','Image uploaded Successfully!');
				return redirect('AdminController/adminUpdateInfo');
			}
			else
			{
				$this->session->set_flashdata('msgg','Failed to upload image!');
				return redirect('AdminController/adminUpdateInfo');
			}
		}
		else
		{
			$this->session->set_flashdata('msgg','Max file size 2MB JPG,PNG,GIF formats!');
			return redirect('AdminController/adminUpdateInfo');
		}
	}

	public function adminUpdateAddUpdateInfo()
	{
		if($this->session->userdata('adminsessionid'))
		{
			$id = $this->session->userdata('adminsessionid');
		}

		$this->load->model('AdminModel');
		$employeeCountBadge=$this->AdminModel->employeeCountBadge();
		$leaveReqPendingCountBadge=$this->AdminModel->leaveReqPendingCountBadge();
		$singleProfileInfo=$this->AdminModel->singleProfileInfo($id);

		$this->load->view('Admin/adminUpdateAddUpdateInfo',['singleProfileInfo'=>$singleProfileInfo,'employeeCountBadge'=>$employeeCountBadge ,'leaveReqPendingCountBadge'=>$leaveReqPendingCountBadge]);
	}

	public function adminAddUpdateOwnInfo()
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
			if($this->session->userdata('adminsessionid'))
			{
				$id = $this->session->userdata('adminsessionid');
			}


			$empname = $this->input->post('empname');
			$empblood = $this->input->post('empblood');		
			$empnumber = $this->input->post('empnumber');
			$empnumber2 = $this->input->post('empnumber2');
			$empemail = $this->input->post('empemail');
			$empemail2 = $this->input->post('empemail2');
			$empbirthdate = $this->input->post('empbirthdate');

			$this->load->model('AdminModel');
			$userAddUpdateOwnInfo = $this->AdminModel->userAddUpdateOwnInfo($id,$empname,$empblood,$empnumber,$empnumber2,$empemail,$empemail2,$empbirthdate);
			if($userAddUpdateOwnInfo == true)
			{
				$this->session->set_flashdata('msg','Information Updated Successfully!');
				return redirect('AdminController/adminUpdateInfo');
			}
			else
			{
				$this->session->set_flashdata('msgg','Failed to update information!');
				return redirect('AdminController/adminUpdateInfo');
			}
			
		}
		else
		{
			$this->session->set_flashdata('msgg','Ooops, something went wrong!');
			return redirect('AdminController/adminUpdateInfo');
		}


		
	}

	public function adminChangePassword()
	{
		if($this->session->userdata('adminsessionid'))
			{
				$id = $this->session->userdata('adminsessionid');
			}

		$this->load->model('AdminModel');
		$employeeCountBadge=$this->AdminModel->employeeCountBadge();
		$leaveReqPendingCountBadge=$this->AdminModel->leaveReqPendingCountBadge();
		$singleProfileInfo=$this->AdminModel->singleProfileInfo($id);
			
		$this->load->view('Admin/adminHomeChangePassword',['singleProfileInfo'=>$singleProfileInfo, 'employeeCountBadge' => $employeeCountBadge, 'leaveReqPendingCountBadge'=> $leaveReqPendingCountBadge]);
	}

	public function adminUpdateOwnPassword()
	{
		$this->form_validation->set_rules('oldpass','Old Password','trim|required');
		$this->form_validation->set_rules('newpass','New Password','trim|required|min_length[4]|max_length[20]');
		$this->form_validation->set_rules('confpass','Confirm Password','trim|required|min_length[4]|max_length[20]|matches[newpass]');

		if($this->form_validation->run())
		{
			if($this->session->userdata('adminsessionid'))
			{
				$id = $this->session->userdata('adminsessionid');
			}
			
			$oldpass = $this->input->post('oldpass');
			$newpass = $this->input->post('newpass');
			$confpass = $this->input->post('confpass');
			$hashed_new_password = password_hash($confpass, PASSWORD_BCRYPT);

			if($newpass == $confpass)
			{
				$this->load->model('AdminModel');
				$oldhashedpassword = $this->AdminModel->oldhashedpassword($id);

				if (password_verify($oldpass, $oldhashedpassword))
				{
					$passwordChangeConfResult = $this->AdminModel->adminUpdateOwnPassword($id,$hashed_new_password);

					if($passwordChangeConfResult==true)
					{
						$this->session->set_flashdata('msg','Successfully changed password !');
						return redirect('AdminController/adminUpdateInfo');
					}
					else
					{
						$this->session->set_flashdata('msgg','Failed to change password !');
						return redirect('AdminController/adminChangePassword');
					}
				}
				else
				{
					$this->session->set_flashdata('msgg','Error! Old password did not match !');
					return redirect('AdminController/adminChangePassword');
				}
				
			}
			else
			{
				$this->session->set_flashdata('msgg','Error! new password field & confirmed password filed must be same !');
				return redirect('AdminController/adminChangePassword');
			}

			
		}
		else
		{
			$this->session->set_flashdata('msgg','Ooops, something went wrong, password should contain 4-20 characters!');
			return redirect('AdminController/adminChangePassword');
		}
	}



	public function adminAddEmployee()
	{
		$this->load->model('AdminModel');
		$deptdata = $this->AdminModel->deptGet();
		$desigdata = $this->AdminModel->desigGet();
		$employeeCountBadge=$this->AdminModel->employeeCountBadge();
		$leaveReqPendingCountBadge=$this->AdminModel->leaveReqPendingCountBadge();
		//$roledata = $this->AdminModel->rolegGet();
		$this->load->view('Admin/adminAddEmployee',['deptdata'=>$deptdata,'desigdata'=>$desigdata, 'employeeCountBadge'=>$employeeCountBadge ,'leaveReqPendingCountBadge'=>$leaveReqPendingCountBadge]);
	}
	public function adminAddDepartmentDesignation()
	{
		$this->load->model('AdminModel');
		$deptdata = $this->AdminModel->deptGet();
		$desigdata = $this->AdminModel->desigGet();
		$employeeCountBadge=$this->AdminModel->employeeCountBadge();
		$leaveReqPendingCountBadge=$this->AdminModel->leaveReqPendingCountBadge();
		$this->load->view('Admin/adminAddDepartmentDesignation',['deptdata'=>$deptdata,'desigdata'=>$desigdata, 'employeeCountBadge'=>$employeeCountBadge ,'leaveReqPendingCountBadge'=>$leaveReqPendingCountBadge]);
	}

	/*
	public function adminLeaveRequest()
	{
		$this->load->model('AdminModel');
		$employeeCountBadge=$this->AdminModel->employeeCountBadge();
		$leaveReqPendingCountBadge=$this->AdminModel->leaveReqPendingCountBadge();
		$this->load->view('Admin/adminLeaveRequest', ['employeeCountBadge'=>$employeeCountBadge ,'leaveReqPendingCountBadge'=>$leaveReqPendingCountBadge]);
	}
	*/

	public function adminLeaveRequest()
	{
		$rowload = 10;
		$this->load->model('AdminModel');
		$employeeCountBadge=$this->AdminModel->employeeCountBadge();
		$leaveReqPendingCountBadge=$this->AdminModel->leaveReqPendingCountBadge();

		$leaveReqData = $this->AdminModel->headViewAllLeaveRequest($rowload);
		$approveReqData = $this->AdminModel->headViewAllApprovedRequest($rowload);
		$denyReqData = $this->AdminModel->headViewAllDeniedRequest($rowload);
		
		$this->load->view('Admin/adminLeaveRequest',['leaveReqData'=>$leaveReqData, 'approveReqData'=>$approveReqData, 'denyReqData' => $denyReqData, 'employeeCountBadge' => $employeeCountBadge, 'leaveReqPendingCountBadge'=> $leaveReqPendingCountBadge]);
		
	}
	public function adminLeaveRequestt($rowload)
	{
		$this->load->model('AdminModel');
		$employeeCountBadge=$this->AdminModel->employeeCountBadge();
		$leaveReqPendingCountBadge=$this->AdminModel->leaveReqPendingCountBadge();

		$leaveReqData = $this->AdminModel->headViewAllLeaveRequest($rowload);
		$approveReqData = $this->AdminModel->headViewAllApprovedRequest($rowload);
		$denyReqData = $this->AdminModel->headViewAllDeniedRequest($rowload);
		
		$this->load->view('Admin/adminLeaveRequest',['leaveReqData'=>$leaveReqData, 'approveReqData'=>$approveReqData, 'denyReqData' => $denyReqData, 'employeeCountBadge' => $employeeCountBadge, 'leaveReqPendingCountBadge'=> $leaveReqPendingCountBadge]);
	}

	public function adminEmployeeList()
	{
		$this->load->model('AdminModel');
		$empdata = $this->AdminModel->employeeAllInfo();
		$deptdata = $this->AdminModel->deptGet();
		$desigdata = $this->AdminModel->desigGet();
		$employeeCountBadge=$this->AdminModel->employeeCountBadge();
		$leaveReqPendingCountBadge=$this->AdminModel->leaveReqPendingCountBadge();
		$this->load->view('Admin/adminViewAllEmployee',['empdata'=>$empdata,'deptdata'=>$deptdata,'desigdata'=>$desigdata, 'employeeCountBadge'=>$employeeCountBadge ,'leaveReqPendingCountBadge'=>$leaveReqPendingCountBadge]);
	}
	public function adminPostNotice()
	{
		$this->form_validation->set_rules('noticetitle','Notice Title','trim|required');
		$this->form_validation->set_rules('noticedescription','Notice Details','trim|required');

		if($this->form_validation->run())
			{
				$title=$this->input->post('noticetitle');
				$details=$this->input->post('noticedescription');
				$posterid=$this->session->userdata('adminsessionid');

				$this->load->model('AdminModel');
				if( $result =  $this->AdminModel->postNotice($title,$details,$posterid))
				{
					$this->session->set_flashdata('msg','Notice Posted Successfully');
					return redirect('AdminController/adminDashboard');
				}
				else
				{
					$this->session->set_flashdata('msgg','Something went wrong posting notice!');
					return redirect('AdminController/adminDashboard');
					
				}
			}
			else
			{
				$this->session->set_flashdata('msgg','Form Validation Failed!');
				return redirect('AdminController/adminDashboard');
				
			}
	}

	public function addEmployee()
	{

		$this->form_validation->set_rules('empname','Employee Name', 'trim|required');
		$this->form_validation->set_rules('empdept','Employee Department', 'required');
		$this->form_validation->set_rules('empdesignation','Employee Designation', 'required');
		$this->form_validation->set_rules('empnumber','Employee Phone', 'trim|required');
		$this->form_validation->set_rules('empemail','Employee Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('empjoindate','Employee Joining Date', 'required');
		$this->form_validation->set_rules('emppass','Employee Password', 'trim|required|min_length[4]|max_length[20]');
		$this->form_validation->set_rules('emprole','Employee Role', 'required');

		if($this->form_validation->run())
		{
			$empname = $this->input->post('empname');
			$empdept = $this->input->post('empdept');
			$empdesignation = $this->input->post('empdesignation');
			$empnumber = $this->input->post('empnumber');
			$empemail = $this->input->post('empemail');
			$empjoindate = $this->input->post('empjoindate');
			$emppass = $this->input->post('emppass');
			$emprole = $this->input->post('emprole');
			$head = $this->input->post('head');

			if( $head == 0 )
			{
				$head_status = 0;
			}
			if( $head == 1 )
			{
				$head_status = 1;
			}

			$this->load->model('AdminModel');
			if( $this->AdminModel->addNewEmployee($empname, $empdept, $empdesignation, $empnumber, $empemail, $empjoindate, $emppass, $emprole,$head_status))
			{
				$this->session->set_flashdata('msg','New Employee Added Successfully!');
				return redirect('AdminController/adminDashboard');
			}
			else
			{
				$this->session->set_flashdata('msgg',' Failed To Add New Employee!');
				return redirect('AdminController/adminDashboard');
			}
		}
		else
		{
			$this->session->set_flashdata('msgg','Form Validation Failed!');
			return redirect('AdminController/adminDashboard');
		}
	}

	public function adminAddNewDepartment()
	{
		$this->form_validation->set_rules('dept','Department Name', 'trim|required');

		if($this->form_validation->run())
		{
			$deptname = $this->input->post('dept');
			$this->load->model('AdminModel');
			if( $this->AdminModel->adminAddNewDepartment($deptname))
			{
				$this->session->set_flashdata('msg','New Department Added Successfully!');
				return redirect('AdminController/adminAddDepartmentDesignation');
			}
			else
			{
				$this->session->set_flashdata('msgg','Failed to add New Department!');
				return redirect('AdminController/adminAddDepartmentDesignation');	
			}
		}
		else
		{
			$this->session->set_flashdata('msgg','Failed to add New Department!');
			return redirect('AdminController/adminAddDepartmentDesignation');
		}
	}

	public function adminAddNewDesignation()
	{
		$this->form_validation->set_rules('desg','Designation Name', 'trim|required');

		if($this->form_validation->run())
		{
			$designame = $this->input->post('desg');
			$this->load->model('AdminModel');
			if( $this->AdminModel->adminAddNewDesignation($designame))
			{
				$this->session->set_flashdata('msg','New Designation Added Successfully!');
				return redirect('AdminController/adminAddDepartmentDesignation');
			}
			else
			{
				$this->session->set_flashdata('msgg','Failed to add New Designation!');
				return redirect('AdminController/adminAddDepartmentDesignation');	
			}
		}
		else
		{
			$this->session->set_flashdata('msgg','Failed to add New Designation!');
			return redirect('AdminController/adminAddDepartmentDesignation');
		}
	}

	public function adminViewEmployee($id)
	{
		echo $id."->view";
	}

	public function AdminUpdateEmployee()
	{
        			
		$this->form_validation->set_rules('empid','Employee ID', 'required');
		$this->form_validation->set_rules('empname','Employee Name', 'trim|required');
	//	$this->form_validation->set_rules('empdept','Employee Department', 'required');
	//	$this->form_validation->set_rules('empdesignation','Employee Designation', 'required');
		$this->form_validation->set_rules('empnumber','Employee Phone', 'trim|required');
		$this->form_validation->set_rules('empemail','Employee Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('empjoindate','Employee Joining Date', 'required');
		$this->form_validation->set_rules('emprole','Employee Role', 'required');

		if($this->form_validation->run())
		{
			$id = $this->input->post('empid');
			$empname = $this->input->post('empname');
			$empdept = $this->input->post('empdept');
			$empdesignation = $this->input->post('empdesignation');
			$empnumber = $this->input->post('empnumber');
			$empemail = $this->input->post('empemail');
			$empjoindate = $this->input->post('empjoindate');
			$emprole = $this->input->post('emprole');
			$head = $this->input->post('head');
			$passreset = $this->input->post('passreset');
			
			if($head == 0)
			{
				$head_status = 0;
			}
			if($head == 1)
			{
				$head_status = 1;
			}

			if($passreset==0)
			{
				$passreset_change_status = 0;
			}
			if($passreset==1)
			{
				$passreset_change_status = 1;
			}

			$this->load->model('AdminModel');
			if( $this->AdminModel->AdminUpdateEmployee($id, $empname, $empdept, $empdesignation, $empnumber, $empemail, $empjoindate, $emprole,$head_status,$passreset_change_status))
			{
				$this->session->set_flashdata('msg','Updated Successfully!');
				return redirect('AdminController/adminEmployeeList');
			}
			else
			{
				$this->session->set_flashdata('msgg',' Failed to update info!');
				return redirect('AdminController/adminEmployeeList');
			}
		}
		else
		{
			echo form_error('empid', '<div class = "text-danger">', '</div>');
			echo form_error('empname', '<div class = "text-danger">', '</div>');
			echo form_error('empdept', '<div class = "text-danger">', '</div>');
			echo form_error('empdesignation', '<div class = "text-danger">', '</div>');
			echo form_error('empnumber', '<div class = "text-danger">', '</div>');
			echo form_error('empemail', '<div class = "text-danger">', '</div>');
			echo form_error('empjoindate', '<div class = "text-danger">', '</div>');
			echo form_error('emprole', '<div class = "text-danger">', '</div>');
			exit();
			$this->session->set_flashdata('msgg','Validation Failed!');
			return redirect('AdminController/adminEmployeeList');
		}
	}
	public function adminDeleteEmployee($id)
	{
		//echo $id."->dlt";
		
		$this->load->model('AdminModel');
		$query = $this->AdminModel->deleteEmployeeInfo($id);
		if($query)
		{
				$this->session->set_flashdata('msg','Employee Deleted Successfully!');
		}
		else
		{
				$this->session->set_flashdata('msgg','Failed To Delete Employee!');
		}
		return redirect('AdminController/adminEmployeeList');
		
	}
	public function EditedNotice()
	{
		$this->form_validation->set_rules('nid', 'NoticeID', 'required');
		$this->form_validation->set_rules('nt','Title', 'required');
		$this->form_validation->set_rules('nd','Description', 'required');

		if($this->form_validation->run())
		{
			$noticeid = $this->input->post('nid');
			$noticetitle = $this->input->post('nt');
			$noticedescription = $this->input->post('nd');

			$this->load->model('AdminModel');
			$query = $this->AdminModel->EditedNotice($noticeid, $noticetitle, $noticedescription);
			if($query)
			{
					$this->session->set_flashdata('msg','Notice Updated Successfully!');
			}
			else
			{
					$this->session->set_flashdata('msgg','Failed To Update Notice!');
			}
			return redirect('AdminController/adminDashboard');
		}
	}

	public function adminDeleteNotice($id)
	{
		$this->load->model('AdminModel');
		$query = $this->AdminModel->adminDeleteNotice($id);
		if($query)
		{
				$this->session->set_flashdata('msg','Notice Deleted Successfully!');
		}
		else
		{
				$this->session->set_flashdata('msgg','Failed To Delete Notice!');
		}
		return redirect('AdminController/adminDashboard');
	}

}



/*
Annual leave - 20days - (5days)
Sick leave - 14days 
conmpensatory - have to take within 7 days 
*/