<!--
<?php

echo form_open_multipart('Welcome/imageUpload');

echo form_upload(['name'=>'userfile']);

echo form_submit(['type'=>'submit', 'class'=>'btn btn-default', 'value'=>'submit']);

echo form_close();

if(isset($upload_error))
{
	echo $upload_error;
}

?>


<?php
	echo form_open('Welcome/hidden');
	$var = 'John Doe';
	$data = array(
        'name'  => $var,
        'email' => 'john@example.com',
        'url'   => 'http://example.com'
	);
	echo form_hidden($data);

	echo form_submit(['name'=>'submit','value'=>'Login','class'=>'btn btn-primary', 'style'=>'margin: 10px 0 0 40px;']);

	echo form_close();
?>

-->
<!--
<?php
$query = $this->db->SELECT('notice.id as nid, notice.notice_title,notice.notice_post_date,notice.notice_submitter_id as sid, notice.notice_description, notice.notice_liked_id, employee.name, employee.id as eid, employee.profile_pic_path')
->from('notice')
->join('employee','notice.notice_submitter_id = employee.id')
->get();

if($query->num_rows()>0)
{
	
	$var = $query->result();
	echo "<br/>";
	print_r($var);
	echo "<br/>";
	echo "<br/>";
	print_r($var[2]);
	echo "<br/>";
	echo "<br/>";
	print_r($var[2]->nid);
	echo "<br/>";
	echo "<br/>";
	print_r($var[2]->eid);
	echo "<br/>";
	echo "<br/>";
	print_r($var[2]->sid);
	echo "<br/>";

}
else
{
	echo "no";
}
?>
-->


<?php 
	
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

						$noticetabledata=$query->reset();


	if (count($noticetabledata)): 	
		foreach ($noticetabledata as $key => $data ):


?>

<?php
//copied code

echo "<p style='background:orange';>";
	    				    			echo "Exploded Result";
	    				    			echo $kkey;
	    				    			echo "<-key & result->";
	    				    			echo $result;
	    				    			echo "</p>";
	    				    			echo "<br/>";
	    				    			if( $result == ' ')
	    				    			{
	    				    				echo "<p style='background:red;'>Empty string check</p>";
	    				    			}
	    				    			else if( $result == $this->session->userdata('sessionid'))
	    				    			{	
	    				    				echo "<p style='background:green;'>";
				    						echo "likedid->";
				    						echo $result;
				    						echo "userid->";
				    						echo $this->session->userdata('sessionid');
				    						echo "</p>";
				    						echo "<br/>";

	    				    			}


	    				    			else if( $result != $this->session->userdata('sessionid'))
	    				    			{
	    				    				echo "<p style='background:blue;>";
	    				    				echo "give like->";
	    				    				echo $result;
	    				    				echo "userid->"; 				    				
				    						echo $this->session->userdata('sessionid');
				    						echo "</p>";
				    						echo "<br/>";
	    				    				echo form_open('UserController/like'); 
	    				    				echo "<p style='text-align: left;'>"; ?>

	    				    				<?php
	    				    				$var = 'John Doe';
	    				    					$data = array(
	    				    				        'givelikeid'  => $this->session->userdata('sessionid'),
	    				    				        'noticeid' => $data->nid,
	    				    				        'likesinthispost' => $data->nlk
	    				    					);
	    				    					echo form_hidden($data);

	    				    				echo form_submit(['name'=>'submit','value'=>'like','class'=>'btn btn-primary btn-sm', 'style'=>'width: 55px; text-align: left;']); 

	    				    				echo "<span><i class='far fa-thumbs-up' id='' style='margin-left: -20px; color: #ffffff;'></i></span>
	    				    				</p>";?>
	    				    				<?php echo form_close(); ?>
	    				    				<?php echo
	    				    				"</div>
	    				    		  			</div>
	    				    					</div>"; ?>
	    				    					<?php 
	    				    			}


?>