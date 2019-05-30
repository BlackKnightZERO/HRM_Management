<?php

class LoginModel extends CI_Model
{
	
	public function loginPasswordValidate($email,$pass)
	{
		$result = $this->db->where(['official_email_1'=>$email])->from('employee')->get();
		if($result->num_rows()>0)
		{
			

			if(password_verify($pass, $result->row()->password))
			{
				return $result->row();
			}
			else
			{
				return false;
			} 
		}
		else
		{
			return false;
		}	
    }

    

    public function oldhashedpassword($id)
    {
    	$query = $this->db->select('password')
    	->where(['id'=>$id])->get('user');

		return $query->row()->password;	
    }

    public function updatePassword($id,$confpass)
    {
    	$hashed_conf_pass = password_hash($confpass, PASSWORD_BCRYPT);

    	$query =$this->db->set('password', $hashed_conf_pass)
    	        ->where('id', $id)
    	        ->update('user');

    	        return $query;
    	
    }

    
}


?>