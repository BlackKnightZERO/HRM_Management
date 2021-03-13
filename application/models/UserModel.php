<?php

class UserModel extends CI_Model
{
	public function applyLeaveQuery($id,$start,$end,$reason,$type)
	{
		$data = array(
        'employee_id' => $id,
        'leave_type' => $type,
        'leave_start' => $start,
        'leave_end' => $end,
        'leave_reason' => $reason,
        'current_status_from_dept_head' => '0',
        'current_status_from_top' => '0',
        'leave_requested_on' => date("Y-m-d"),
		);

		$query = $this->db->insert('leaves', $data);
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function viewOwnLeaveList()
	{
		/* QUERY = SELECT leaves.id, employee.name, department.department_name, designation.designation_name, leaves.employee_id, leaves.leave_type, leaves.leave_start, leaves.leave_end, leaves.leave_reason, leaves.current_status_from_dept_head, leaves.current_status_from_top FROM leaves JOIN employee ON leaves.employee_id=employee.id JOIN department ON employee.department_id=department.id JOIN designation ON employee.designation_id=designation.id WHERE leaves.employee_id=3 ORDER BY leaves.id DESC*/
	}

	public function employeeViewNoticeTable()
	{

		$query = $this->db->SELECT('notice.id as nid, 
			notice.notice_title as nt,
			notice.notice_post_date ndate, 
			notice.notice_submitter_id as sid, 
			notice.notice_description as nd, 
			notice.notice_liked_id as nlk, 
			employee.name as ename, 
			employee.id as eid, 
			employee.profile_pic_path as epp')
							->from('notice')
							->join('employee','notice.notice_submitter_id = employee.id')
							->order_by('notice.id','DESC')
						  	->limit('5')
							->get();

		/*					
		 $query = $this->db->order_by('notice.id','DESC')
						  ->limit('5')
						  ->FROM('notice')
						  ->join('employee', 'notice.notice_submitter_id=employee.id')
						  ->get();
						  */
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}

	public function userGivesLike($noticeid, $likesinthispost, $givelikeid)
	{
		$explode =	explode(',',$likesinthispost);
		$explode[] = $givelikeid;

		$imp = implode(',',$explode);

		$data = array(
        'notice_liked_id' => $imp
		);

		$query = $this->db->WHERE('id',$noticeid)
						  ->update('notice', $data);

		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}


	}

	public function getSingleProfileInfo($id)
	{
		$query = $this->db->Select('employee.name as employee_name, 
			department.department_name as employee_dept,
			designation.designation_name as employee_desg, 
			employee.official_email_1 as employee_mail_1, employee.blood_group as employee_blood_grp, 
			employee.join_date as employee_join_date, 
			employee.date_of_birth as employee_date_of_birth,
			employee.official_mobile_no as employee_official_mobile_no,
			employee.profile_pic_path as employee_profile_pic,
			employee.official_email_2 as employee_mail_2,
			employee.personal_mobile_no as employee_personal_mobile_no')
						->from('employee')
						->join('department','employee.department_id=department.id')
						->join('designation', 'employee.designation_id = designation.id')
						->where('employee.id',$id)
						->get();

		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			return flase;
		}
	}

	public function profile_pic_upload($id,$img_path)
	{
		$data = array(
        'profile_pic_path' => $img_path
		);

		$query = $this->db->WHERE('id',$id)
						  ->update('employee', $data);

						  if($query)
						  {
						  	return true;
						  }
						  else
						  {
						  	return false;
						  }
	}

	public function userAddUpdateOwnInfo($id,$empname,$empblood,$empnumber,$empnumber2,$empemail,$empemail2,$empbirthdate)
	{
		$data = array(
        'name' => $empname ,
        'date_of_birth' => $empbirthdate ,
        'blood_group' => $empblood ,
        'official_mobile_no' => $empnumber ,
        'personal_mobile_no' => $empnumber2 ,
        'official_email_1' => $empemail ,
        'official_email_2' => $empemail2 ,
		);

		$query = $this->db->WHERE('id',$id)
						  ->update('employee', $data);

						  if($query)
						  {
						  	return true;
						  }
						  else
						  {
						  	return false;
						  }
	}


	public function userUpdateOwnPassword($id,$hashed_new_password)
	{
				$data = array(
		        'password' => $hashed_new_password ,
				);

				$query = $this->db->WHERE('id',$id)
								  ->update('employee', $data);

								  if($query)
								  {
								  	return true;
								  }
								  else
								  {
								  	return false;
								  }
	}

	public function oldhashedpassword($id)
    {
    	$query = $this->db->select('password')
    	->where(['id'=>$id])->get('employee');

		return $query->row()->password;	
    }

    public function headViewAllLeaveRequest($id,$rowload)
    {
    	$array = array('employee.department_id' => $id, 'leaves.current_status_from_dept_head' => 0, 'employee.employee_role' => 0);

    	$query = $this->db->SELECT('employee.id as employee_id, leaves.id as l_id,
    		employee.name as employee_name, 
    		department.department_name as employee_dept,
    		designation.designation_name as employee_desg, 
    		employee.official_email_1 as employee_mail_1, 
    		employee.official_mobile_no as employee_official_mobile_no,
    		employee.profile_pic_path as employee_profile_pic,
    		leaves.leave_start as employee_leave_start, 
    		leaves.leave_requested_on as employee_leave_requested_on,
    		leaves.leave_approved_denied_on as employee_leave_approved_denied_on,
    		leaves.leave_end as employee_leave_end, 
    		leaves.leave_reason as employee_leave_reason, 
    		leaves.leave_type as employee_leave_type, 
    		employee.dept_head as employee_dept_head_sts,
    		leaves.current_status_from_dept_head as employee_current_status_from_dept_head')
    						->from('leaves')
    						->join('employee', 'leaves.employee_id = employee.id')
    						->join('department','employee.department_id=department.id')
    						->join('designation', 'employee.designation_id = designation.id')
    						->where($array)
    						->order_by('l_id','DESC')
    						->limit($rowload)
    						->get();

    		if($query)
    		{
    			return $query->result();
    		}
    		else
    		{
    			return false;
    		}
    }

    public function headViewAllApprovedRequest($id,$rowload)
    {
    	$array = array('employee.department_id' => $id, 'leaves.current_status_from_dept_head' => 1, 'employee.employee_role' => 0);

    	$query = $this->db->SELECT('employee.id as employee_id1, leaves.id as l_id1,
    		employee.name as employee_name1, 
    		department.department_name as employee_dept1,
    		designation.designation_name as employee_desg1, 
    		employee.official_email_1 as employee_mail_11, 
    		employee.official_mobile_no as employee_official_mobile_no1,
    		employee.profile_pic_path as employee_profile_pic1,
    		leaves.leave_start as employee_leave_start1, 
    		leaves.leave_requested_on as employee_leave_requested_on1,
    		leaves.leave_approved_denied_on as employee_leave_approved_denied_on1,
    		leaves.leave_end as employee_leave_end1, 
    		leaves.leave_reason as employee_leave_reason1, 
    		leaves.leave_type as employee_leave_type1, 
    		employee.dept_head as employee_dept_head_sts1,
    		leaves.current_status_from_dept_head as employee_current_status_from_dept_head1')
    						->from('leaves')
    						->join('employee', 'leaves.employee_id = employee.id')
    						->join('department','employee.department_id=department.id')
    						->join('designation', 'employee.designation_id = designation.id')
    						->where($array)
    						->order_by('l_id1','DESC')
    						->limit($rowload)
    						->get();

    		if($query)
    		{
    			return $query->result();
    		}
    		else
    		{
    			return false;
    		}
    }

    public function headViewAllDeniedRequest($id,$rowload)
    {
    	$array = array('employee.department_id' => $id, 'leaves.current_status_from_dept_head' => 2, 'employee.employee_role' => 0);

    	$query = $this->db->SELECT('employee.id as employee_id2, leaves.id as l_id2,
    		employee.name as employee_name2, 
    		department.department_name as employee_dept2,
    		designation.designation_name as employee_desg2, 
    		employee.official_email_1 as employee_mail_12, 
    		employee.official_mobile_no as employee_official_mobile_no2,
    		employee.profile_pic_path as employee_profile_pic2,
    		leaves.leave_start as employee_leave_start2, 
    		leaves.leave_requested_on as employee_leave_requested_on2,
    		leaves.leave_approved_denied_on as employee_leave_approved_denied_on2,
    		leaves.leave_end as employee_leave_end2, 
    		leaves.leave_reason as employee_leave_reason2, 
    		leaves.leave_type as employee_leave_type2, 
    		employee.dept_head as employee_dept_head_sts2,
    		leaves.current_status_from_dept_head as employee_current_status_from_dept_head2')
    						->from('leaves')
    						->join('employee', 'leaves.employee_id = employee.id')
    						->join('department','employee.department_id=department.id')
    						->join('designation', 'employee.designation_id = designation.id')
    						->where($array)
    						->order_by('l_id2','DESC')
    						->limit($rowload)
    						->get();

    		if($query)
    		{
    			return $query->result();
    		}
    		else
    		{
    			return false;
    		}
    }

    public function headApprovedLeave($id)
    {
    			$data = array(
    	        'current_status_from_dept_head' => 1 ,
    	        'leave_approved_denied_on' => date("Y-m-d"),
    			);

    			$query = $this->db->WHERE('id',$id)
    							  ->update('leaves', $data);

    							  if($query)
    							  {
    							  	return true;
    							  }
    							  else
    							  {
    							  	return false;
    							  }
    }

    public function headDeniedLeave($id)
    {
    			$data = array(
    	        'current_status_from_dept_head' => 2 ,
    	        'leave_approved_denied_on' => date("Y-m-d"),
    			);

    			$query = $this->db->WHERE('id',$id)
    							  ->update('leaves', $data);

    							  if($query)
    							  {
    							  	return true;
    							  }
    							  else
    							  {
    							  	return false;
    							  }
    }

    public function myLeaveData($id, $rowload)
    {
    	$array = array('employee.id' => $id, 'employee.employee_role' => 0);

    	$query = $this->db->SELECT('leaves.id as l_id5,	
    		leaves.leave_start as employee_leave_start5, 
    		leaves.leave_requested_on as employee_leave_requested_on5,
    		leaves.leave_approved_denied_on as employee_leave_approved_denied_on5,
    		leaves.leave_end as employee_leave_end5, 
    		leaves.leave_reason as employee_leave_reason5, 
    		leaves.leave_type as employee_leave_type5, 
    		leaves.current_status_from_dept_head as employee_current_status_from_dept_head5')
    						->from('leaves')
    						->join('employee', 'leaves.employee_id = employee.id')
    						->where($array)
    						->order_by('l_id5','DESC')
    						->limit($rowload)
    						->get();

    		if($query)
    		{
    			return $query->result();
    		}
    		else
    		{
    			return false;
    		}
    }

    public function deptheaddenyapprovedreq($l_id1)
    {
        $data = array(
                'current_status_from_dept_head' => 2 ,
                'leave_approved_denied_on' => date("Y-m-d"),
                );

                $query = $this->db->WHERE('id',$l_id1)
                                  ->update('leaves', $data);

                  if($query)
                  {
                    return true;
                  }
                  else
                  {
                    return false;
                  }
    }


    public function deptheadpendapprovedreq($l_id1)
    {
        $data = array(
                'current_status_from_dept_head' => 0 ,
                'leave_approved_denied_on' => date("Y-m-d"),
                );

                $query = $this->db->WHERE('id',$l_id1)
                                  ->update('leaves', $data);

                  if($query)
                  {
                    return true;
                  }
                  else
                  {
                    return false;
                  }
    }
        public function deptheadapprovedeniedreq($l_id2)
            {
                $data = array(
                        'current_status_from_dept_head' => 1 ,
                        'leave_approved_denied_on' => date("Y-m-d"),
                        );

            $query = $this->db->WHERE('id',$l_id2)
                              ->update('leaves', $data);

                              if($query)
                              {
                                return true;
                              }
                              else
                              {
                                return false;
                              }
    }
    public function deptheadpenddeniedreq($l_id2)
    {
        $data = array(
                'current_status_from_dept_head' => 0 ,
                'leave_approved_denied_on' => date("Y-m-d"),
                );

            $query = $this->db->WHERE('id',$l_id2)
                              ->update('leaves', $data);

                              if($query)
                              {
                                return true;
                              }
                              else
                              {
                                return false;
                              }
    }
 public function getAllEmployeeInfo()
    {

             $query = $this->db->SELECT('employee.id as employee_id,
            employee.name as employee_name, 
            department.department_name as employee_dept,
            designation.designation_name as employee_desg, 
            employee.official_email_1 as employee_mail_1, 
            employee.employee_role as employee_role, 
            employee.blood_group as employee_blood_grp, 
            employee.join_date as employee_join_date, 
            employee.date_of_birth as employee_date_of_birth,
            employee.official_mobile_no as employee_official_mobile_no,
            employee.dept_head as employee_dept_head_sts,
            employee.profile_pic_path as employee_profile_pic,
            employee.personal_mobile_no as employee_personal_mobile_no,
            employee.official_email_2 as employee_official_email_2')
                            ->from('employee')
                            ->join('department','employee.department_id=department.id')
                            ->join('designation', 'employee.designation_id = designation.id')
                            ->order_by('employee_id','ASC')
                            ->get();


              if($query->num_rows()>0)
              {
                return $query->result();
              }
              else
              {
                return false;
              }
    }

    public function employeeCountBadge()
    {
            $employeeCountBadge = $this->db->from('employee')
                                        ->count_all_results();

            if($employeeCountBadge)    
            {
                return $employeeCountBadge;
            }                        
    }

     public function leaveReqPendingCountBadge()
    {
        $s = $this->session->userdata('headsessiondeptid');
        $array = array('employee.department_id' => $s, 'leaves.current_status_from_dept_head' => 0, 'employee.employee_role' => 0);

        $query = $this->db->SELECT('leaves.id as l_id')
                            ->from('leaves')
                            ->join('employee', 'leaves.employee_id = employee.id')
                            ->join('department','employee.department_id=department.id')
                            ->where($array)
                            ->order_by('l_id','DESC')
                            ->get();            
            if($query)
            {
                $leaveReqPendingCountBadge = $query->num_rows();
                return $leaveReqPendingCountBadge;
            }
                  
    }

    public function attendaceTodayCheck($employee_id){
        $date = date("Y-m-d", time() + 4.5 * 60 * 60);
        $data = array(
            'date' => $date,
            'employee_id' => $employee_id
        );
        $query = $this->db->SELECT('attendances.id as attendace_id, 
                                    attendances.clock_in as clock_in, 
                                    attendances.clock_out as clock_out, 
                                    attendances.date as date')
                            ->from('attendances')
                            ->where($data)
                            ->order_by('id', 'DESC')
                            ->limit('1')
                            ->get();

        if($query->num_rows()>0){
            return $query->result();
        } else {
            return false;
        }                   
    }

    public function attendaceTodayCheck2($employee_id){
        $date = date("Y-m-d", time() + 4.5 * 60 * 60);
        $data = array(
            'date' => $date,
            'employee_id' => $employee_id
        );
        $query = $this->db->SELECT('attendances.id as attendace_id, 
                                    attendances.clock_in as clock_in, 
                                    attendances.clock_out as clock_out, 
                                    attendances.date as date')
                            ->from('attendances')
                            ->where($data)
                            ->order_by('id', 'DESC')
                            ->limit('1')
                            ->get();

        return $query->result();                  
    }


	public function attendanceIn($employee_id){

		$current_time = date("h:i a", time() + 4.5 * 60 * 60);
		$begin = "10:00 am";
		$end   = "10:30 am";

		$date1 = DateTime::createFromFormat('H:i a', $current_time);
		$date2 = DateTime::createFromFormat('H:i a', $begin);
		$date3 = DateTime::createFromFormat('H:i a', $end);

		$var = 0;
		if ($date1 > $date2 && $date1 < $date3) {
			$var = 1;
		} else {
			$var = 2;
		}
		
		$data = array(
            'employee_id' => $employee_id,
            'date' =>  date("Y-m-d", time() + 4.5 * 60 * 60),
			'clock_in' => date("H:i:s", time() + 4.5 * 60 * 60),
			'status' => $var,
		);
		$query = $this->db->insert('attendances', $data);
		if($query){
			return $query;
		} else {
			return false;
		}
	}

    public function attendanceOut($employee_id){
        //generate timestamp
        $data = array(
            'employee_id' => $employee_id,
            'date' =>  date("Y-m-d", time() + 4.5 * 60 * 60),
        );

        $query = $this->db->SELECT('attendances.id as attendace_id, 
                                    attendances.clock_in as clock_in, 
                                    attendances.clock_out as clock_out, 
                                    attendances.date as date')
                            ->from('attendances')
                            ->where($data)
                            ->order_by('attendace_id', 'DESC')
                            ->limit('1')
                            ->get();

        if($query->num_rows()>0){
            $result = $query->result();
            if($result[0]->clock_out == null){
                $whereData = array(
                    'clock_out' => date("H:i:s", time() + 4.5 * 60 * 60),
                );

                $query = $this->db->WHERE('id', $result[0]->attendace_id)
                                  ->update('attendances', $whereData);

                if($query){
                    return true;
                } else {
                    return false;
                }
            }
        }                   
        
    }
	
	public function employeeAttendanceToday($employee_id){
		$array = array(
	       'employee_id' => $employee_id,
           'date' => date("Y-m-d", time() + 4.5 * 60 * 60),
		);
		$query = $this->db->SELECT('attendaces.id as attendace_id',
                                    'attendaces.clock_in as clock_in', 
                                    'attendaces.clock_out as clock_out')
                            ->from('attendaces')
                            ->join('employee', 'attendaces.employee_id = employee.id')
                            ->join('department','employee.department_id=department.id')
                            ->where($array)
                            ->order_by('attendace_id','DESC')
                            ->get();            
            if($query)
            {
                return $query->result();
            }
	}

	public function employeeAttendanceData($employee_id){
	$array = array(
           'employee_id' => $employee_id,
        );
	$query = $this->db->SELECT('attendances.id as attendance_id, 
                                attendances.clock_in as clock_in,
                                attendances.clock_out as clock_out,
                                attendances.date as date')
                            ->from('attendances')
                            ->where($array)
                            ->order_by('attendance_id','DESC')
                            ->limit('30')
                            ->get();            
            if($query)
            {
                return $query->result();
            } else {
                return false;
            }
	}

    public function allEmployeeAttendanceData(){
        $query = $this->db->SELECT('attendances.id as attendance_id, 
                                attendances.clock_in as clock_in,
                                attendances.clock_out as clock_out,
                                attendances.status as status,
                                attendances.date as date, employee.name')
                            ->from('attendances')
                            ->join('employee', 'attendances.employee_id = employee.id')
                            ->order_by('attendance_id','DESC')
                            ->get();  
        return $query->result();                    
    }

}

/*
'employee.dept_head' => 0,

SELECT employee.id, employee.name, employee.official_mobile_no, employee.official_email_1, designation.designation_name, department.department_name, leaves.id AS sl, leaves.leave_start, leaves.leave_end, leaves.leave_reason, leaves.leave_type, leaves.current_status_from_dept_head FROM leaves JOIN employee ON leaves.employee_id = employee.id JOIN department ON employee.department_id = department.id JOIN designation ON employee.designation_id = designation.id WHERE employee.department_id =5 AND employee.dept_head = 0 AND employee.employee_role = 0 ORDER BY leaves.id DESC
*/

?>

