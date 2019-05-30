<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller 
{

	public function adminDashboard()
	{
		$this->load->model('AdminModel'); 
		$noticetabledata=$this->AdminModel->adminViewNoticeTable();
		$this->load->view('Admin/adminHome',['noticetabledata'=>$noticetabledata]);
	}
	public function adminAddEmployee()
	{
		$this->load->model('AdminModel');
		$deptdata = $this->AdminModel->deptGet();
		$desigdata = $this->AdminModel->desigGet();
		//$roledata = $this->AdminModel->rolegGet();
		$this->load->view('Admin/adminAddEmployee',['deptdata'=>$deptdata,'desigdata'=>$desigdata]);
	}
	public function adminAddDepartmentDesignation()
	{
		$this->load->model('AdminModel');
		$deptdata = $this->AdminModel->deptGet();
		$desigdata = $this->AdminModel->desigGet();
		$this->load->view('Admin/adminAddDepartmentDesignation',['deptdata'=>$deptdata,'desigdata'=>$desigdata]);
	}

	public function adminLeaveRequest()
	{
		$this->load->view('Admin/adminLeaveRequest');
	}

	public function adminEmployeeList()
	{
		$this->load->model('AdminModel');
		$empdata = $this->AdminModel->employeeAllInfo();
		$this->load->view('Admin/adminViewAllEmployee',['empdata'=>$empdata]);
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

			if($head=='')
			{
				$head_status = 0;
			}
			if($head == 1)
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

	public function adminUpdateEmployee($id)
	{
		echo $id."->update";
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