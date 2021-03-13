<?php
class AdminModel extends CI_Model
{
	
	public function postNotice($title,$details,$posterid)
	{
		$postdate = date("Y-m-d");

		//notice_title	notice_post_date	notice_submitter_id	notice_description	notice_liked_id

		$data = array(
        'notice_title' => $title,
        'notice_post_date' => $postdate,
        'notice_submitter_id' => $posterid,
        'notice_description' => $details
		);

		$query = $this->db->insert('notice', $data);	
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}

	}

	public function adminViewNoticeTable()
	{
		// QUERY = SELECT * FROM `notice` ORDER BY notice.id DESC LIMIT 5
		// join($table, $cond[, $type = ''[, $escape = NULL]])

		$query = $this->db->SELECT('employee.name as an,notice.id as nid, notice.notice_title as nt, notice.notice_post_date as npd, notice.notice_description as nd, notice.notice_liked_id as nli')
						  ->order_by('notice.id','DESC')
						  ->limit('5')
						  ->FROM('notice')
						  ->join('employee', 'notice.notice_submitter_id=employee.id')
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

	public function deptGet()
	{
		$query = $this->db->get('department');
		if( $query->num_rows() > 0 )
		{
			return $query->result();
		}
	}
	public function desigGet()
	{
		$query = $this->db->get('designation');
		if( $query->num_rows() > 0 )
		{
			return $query->result();
		}
	}
	/*
	public function rolegGet()
	{
		$query = $this->db->select('employee_role')->get('employee');
		if( $query->num_rows() > 0 )
		{
			return $query->result();
		}
	}
	*/

	public function addNewEmployee($empname, $empdept, $empdesignation, $empnumber, $empemail, $empjoindate, $emppass, $emprole, $head_status)
	{

		$hashed_pass = password_hash($emppass, PASSWORD_BCRYPT);

				$data = array(
		        'name' => $empname,
		        'department_id' => $empdept,
		        'designation_id' => $empdesignation,
		        'official_mobile_no' => $empnumber,
		        'official_email_1' => $empemail,
		        'join_date' => $empjoindate,
		        'password' => $hashed_pass,
		        'employee_role' => $emprole,
		        'dept_head' => $head_status,

		        'profile_pic_path'=>'http://192.168.88.83/CI_HRM/ProfilePicture/default.png'
		        
				);

		$query = $this->db->insert('employee', $data);
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function AdminUpdateEmployee($id, $empname, $empdept, $empdesignation, $empnumber, $empemail, $empjoindate, $emprole,$head_status,$passreset_change_status)
	{
			
		if( $empdept == 'x' )
		{
			$q1 = $this->db->SELECT('department_id')
							  ->where('id',$id)
							  ->get('employee');
			$empdept = $q1->row()->department_id;
		}

		if( $empdesignation == 'y' )
		{
			$q2 = $this->db->SELECT('designation_id')
							  ->where('id',$id)
							  ->get('employee');
			$empdesignation = $q2->row()->designation_id;
		}

		if($passreset_change_status == 0 )
		{
			$q3 = $this->db->SELECT('password')
							  ->where('id',$id)
							  ->get('employee');
			$passreset_set = $q3->row()->password;
		}

		if($passreset_change_status == 1)
		{
			$passreset_set = password_hash(1234, PASSWORD_BCRYPT);
		}

		if( $emprole == 'z' )
		{
			$q4 = $this->db->SELECT('employee_role')
							  ->where('id',$id)
							  ->get('employee');
			$emprole = $q4->row()->employee_role;
		}

		/*    echo $id;
			echo "<br>";
			echo $empname;echo "Name<br>";
			echo $empdept;echo "empdept<br>";
			echo $empdesignation;echo "empdesignation<br>";
			echo $empnumber;echo "empnumber<br>";
			echo $empemail;echo "empemail<br>";
			echo $empjoindate;echo "empjoindate<br>";
			echo $emprole;echo "emprole<br>";
			echo $head_status;echo "head_status<br>";
			echo $passreset_set;echo "passreset_set<br>";

			exit();
		*/
		
				$data = array(
		        'name' => $empname,
		        'department_id' => $empdept,
		        'designation_id' => $empdesignation,
		        'official_mobile_no' => $empnumber,
		        'official_email_1' => $empemail,
		        'join_date' => $empjoindate,
		        'password' => $passreset_set,
		        'employee_role' => $emprole,
		        'dept_head' => $head_status,
		        
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

	public function adminAddNewDepartment($deptname)
	{
				$data = array(
		        'department_name' => $deptname
				);

				$query = $this->db->insert('department', $data);
				if($query)
				{
					return true;
				}
				else
				{
					return false;
				}
	}

	public function adminAddNewDesignation($designame)
	{
				$data = array(
		        'designation_name' => $designame
				);

				$query = $this->db->insert('designation', $data);
				if($query)
				{
					return true;
				}
				else
				{
					return false;
				}
	}

	public function employeeAllInfo()
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
							//->where('employee.employee_role',0)
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

	public function deleteEmployeeInfo($id)
	{
		$query = $this->db->delete('employee',['id'=>$id]);

		if($query)
			{
				return true;
			}
			else
			{
				return false;
			}
	}

	public function EditedNotice($noticeid, $noticetitle, $noticedescription)
	{
		$data = array(
        'notice_title' => $noticetitle,
        'notice_description' => $noticedescription
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

	public function adminDeleteNotice($id)
	{
		$query = $this->db->delete('notice',['id'=>$id]);

		if($query)
			{
				return true;
			}
			else
			{
				return false;
			}
	}

	public function birthdayToday()
	{
		$q = $this->db->select('employee.id as employee_id,employee.date_of_birth as employee_bd')
					  ->from('employee')
					  ->get();
		if($q)
		{
			return $q->result();
		}
		else
		{
			return false;
		}
	}

	public function onLeaveTodaydata()
	{

		$q = $this->db->where('leaves.current_status_from_dept_head',1)
					->order_by('leaves.id','DESC')
					->limit('25')
					->get('leaves');
		$query = $q->result();


		$array2 = array();
		foreach ($query as $key => $value) 
		{
				$array = array();				
			    $interval = new DateInterval('P1D');
			    $realEnd = new DateTime($value->leave_end); //end
			    $realEnd->add($interval);
			    $period = new DatePeriod(new DateTime($value->leave_start), $interval, $realEnd); //start

			    foreach($period as $date) 
			    { 
			        $array[] = $date->format('Y-m-d'); 
			        
			    }
			    	
					foreach ($array as $key2 => $value2) 
					{
						if( $value2 == date('Y-m-d'))
						{
							$array2[] = $value->employee_id;
						}
					}
		}

		return $array2;
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
        $array = array('leaves.current_status_from_dept_head' => 0, 'employee.employee_role' => 0);

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

    public function headViewAllLeaveRequest($rowload)
    {
    	$array = array('leaves.current_status_from_dept_head' => 0, 'employee.employee_role' => 0);

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

    public function headViewAllApprovedRequest($rowload)
    {
    	$array = array('leaves.current_status_from_dept_head' => 1, 'employee.employee_role' => 0);

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

    public function headViewAllDeniedRequest($rowload)
    {
    	$array = array('leaves.current_status_from_dept_head' => 2, 'employee.employee_role' => 0);

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


    public function singleProfileInfo($id)
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

	public function oldhashedpassword($id)
    {
    	$query = $this->db->select('password')
    	->where(['id'=>$id])->get('employee');

		return $query->row()->password;	
    }
    public function adminUpdateOwnPassword($id,$hashed_new_password)
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

	public function attendanceToday(){
		$date = date("Y-m-d", time() + 4.5 * 60 * 60);
		$query = $this->db->select('attendances.id as a_id, attendances.employee_id as a_e_id, employee.name,
			department.department_name')
							->from('attendances')
                            ->join('employee', 'attendances.employee_id = employee.id')
                            ->join('department','employee.department_id=department.id')
    						->where(['date'=>$date])
							->get();
							return $query->result();								
	}
}
?>