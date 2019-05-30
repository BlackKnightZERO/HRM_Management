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

		        'profile_pic_path'=>'http://192.168.88.237/CI_HRM/ProfilePicture/default.png'
		        
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
			employee.profile_pic_path as employee_profile_pic')
							->from('employee')
							->join('department','employee.department_id=department.id')
							->join('designation', 'employee.designation_id = designation.id')
							->where('employee.employee_role',0)
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
}
?>