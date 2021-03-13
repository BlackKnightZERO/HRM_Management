<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AttendaceController extends MY_Controller {
	
	public function index()
	{
		$this->load->view('Employee/attendance');
	}

	public function setAttendanceSession(){
		$attendanceSessionData = array(
			'employee_id'  => '',
			'clock_in' => '',
			'clock_out' => '',
					        
		);

		$this->session->set_userdata($attendanceSessionData);
		
	}

	public function attendanceToday(){
		$this->load->model('UserModel');
		$employee_id = $this->session->userdata('sessionid');
		$attendaceTodayCheck=$this->UserModel->attendaceTodayCheck($employee_id);

		var_dump($attendaceTodayCheck);
		exit();
	}
}

?>