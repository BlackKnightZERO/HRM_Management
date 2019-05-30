<?php include('header.php'); ?>
<section id="breadcrump">
	    	<div class="container-fluid">
	    		<ol class="breadcrumb">
	    			<li class="breadcrumb-item breadcrumb-item active"><a href="#">Home</a></li>
	    			    <li class="breadcrumb-item">Library</li>
	    		</ol>
	    	</div>
	    </section>

	    <section id="main">
	    	<div class="container-fluid">
	    		<div class="row">
	    			<!-- Side Bar Put Customized Side Nav here -->
	    			<!-- Side Bar Put Customized Side Nav here -->
	    			<!-- Side Bar Put Customized Side Nav here -->

	    			<div class="col-lg-3 col-md-3 col-sm-12 col-12" style="margin-bottom: 10px;">
	    				<div class="list-group">
	    				  <?php echo anchor('UserController/employeeHome','<span><i class="fas fa-home"></i></span>
	    				    Home', ['class'=>'list-group-item list-group-item-action']); ?>

	    				    <?php echo anchor('UserController/employeeUpdateInfo','<span><i class="fas fa-pen-nib"></i></span>
	    				    Update Info', ['class'=>'list-group-item list-group-item-action active main-color-bg']); ?>

	    				    <?php if($this->session->userdata('headsessionid'))
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
	    				    			$var = $query->num_rows();
	    				    		}
	    				    ?>	

	    					<?php echo anchor('UserController/headApproveLeave', 
	    				  '<span><i class="fas fa-clipboard-check"></i></span> Approve Leave  <span class="badge badge-secondary float-right m-1">'.$var.'</span>', 
	    				  ['class'=>'list-group-item list-group-item-action']); ?>

	    					<?php
	    					}
	    					?>

	    				  <?php echo anchor('UserController/employeeApplyLeave', 
	    				  '<span><i class="fas fa-coffee"></i></span> Apply for Leave  <span class="badge badge-secondary float-right m-1"><i class="fas fa-exclamation"></i></span>', 
	    				  ['class'=>'list-group-item list-group-item-action']); ?>


	    				  <?php echo anchor('UserController/employeeViewEmployeeList', 
	    				  '<span><i class="fas fa-list-alt"></i></span> Employee List <span class="badge badge-secondary float-right m-1">70</span>', 
	    				  ['class'=>'list-group-item list-group-item-action']); ?>

	    				</div>
	    			</div>	

	    			<div class="col-md-9 col-sm-12 col-12">
	    				<div class="card">
	    				  
	    				    <h5 class="card-header main-color-bg">My Profile</h5>

	    				    <div class="card-body">
	    				    	<div class="row">

	    				    		<div class="col-md-3 col-lg-3 col-sm-12 col-12">
	    				    			<div class="m-3">
	    				    			<?php if (count($singleProfileInfo))
				    				  		{ 
			    								foreach ($singleProfileInfo as $key => $data )
			    								{
				    						?>
			    				    			<img src="<?php echo $data->employee_profile_pic; ?>" class="img-fluid img-thumbnail" style="margin-bottom: 3px;">

						    				<?php
					    						}
					    					}
						    				?>
	    				    			</div>
	    				    				<div class="list-group m-3" style="margin-left: 15px;">
	    				    				  <?php echo anchor('UserController/employeeUpdateInfo','<span><i class="fas fa-id-card-alt"></i></span>
	    				    				    My Profile', ['class'=>'list-group-item list-group-item-action']); ?>

	    				    				    <?php echo anchor('UserController/employeeUpdateAddUpdateInfo','<span><i class="fas fa-undo"></i></i></span>
	    				    				    Add/Update profile', ['class'=>'list-group-item list-group-item-action active main-color-bg']); ?>

	    				    				  <?php echo anchor('UserController/employeeChangePassword', 
	    				    				  '<span><i class="fas fa-key"></i></span> Change Password', 
	    				    				  ['class'=>'list-group-item list-group-item-action']); ?>


	    				    				</div>


	    				    		</div>
	    				    		<div class="col-md-6 col-lg-6 col-sm-12 col-12 alert alert-secondary" style="margin-top: 15px;">

		    				    <?php echo form_open('UserController/userAddUpdateOwnInfo'); ?> 

		    				    <?php if (count($singleProfileInfo))
		    				  		{ 
	    								foreach ($singleProfileInfo as $key => $data )
	    								{
		    						?>
		    				    

		    				    	<div class="row" style="text-align: left;">
										
				    				    <div class="col-md-3" style="margin-top: 5px;">
				    				    	<p>Name*</p> 
				    				    </div>
				    				    <div class="col-md-7" style="margin-top: 5px;">
				    				    	<?php echo form_input(['name'=>'empname','class'=>'form-control',  'placeholder'=>'Name' , 'required'=>'required', 'value'=>$data->employee_name]); ?>
				    				    </div>
				    				    <div class="col-md-3" style="margin-top: 5px;">
				    				    	<p>Blood group</p> 
				    				    </div>
				    				    <div class="col-md-7" style="margin-top: 5px;">
				    				    	<?php echo form_input(['name'=>'empblood','class'=>'form-control',  'placeholder'=>'Group' , 'value'=>$data->employee_blood_grp]); ?>
				    				    </div>
				    				    
				    				    <div class="col-md-3" style="margin-top: 5px;">
				    				    	<p>Official Phone*</p> 
				    				    </div>
				    				    <div class="col-md-7" style="margin-top: 5px;">
				    				    	<?php echo form_input(['name'=>'empnumber', 'type'=>'number', 'class'=>'form-control', 'placeholder'=>'Phone' , 'required'=>'required', 'value'=>$data->employee_official_mobile_no]); ?>
				    				    </div>			
    			    				    <div class="col-md-3" style="margin-top: 5px;">
				    				    	<p>Personal Phone</p> 
				    				    </div>
				    				    <div class="col-md-7" style="margin-top: 5px;">
				    				    	<?php echo form_input(['name'=>'empnumber2', 'type'=>'number', 'class'=>'form-control', 'placeholder'=>'Phone', 'value'=>$data->employee_personal_mobile_no]); ?>
				    				    </div>	
				    				    <div class="col-md-3" style="margin-top: 5px;">
    			    				    	<p>Official Email*</p> 
    			    				    </div>
    			    				    <div class="col-md-7" style="margin-top: 5px;">
    			    				    	<?php echo form_input(['name'=>'empemail', 'type'=>'email', 'class'=>'form-control', 'placeholder'=>'Email' , 'required'=>'required', 'value'=>$data->employee_mail_1]); ?>
    			    				    </div>
    			    				    		
				    				    <div class="col-md-3" style="margin-top: 5px;">
    			    				    	<p>Additional Email</p> 
    			    				    </div>
    			    				    <div class="col-md-7" style="margin-top: 5px;">
    			    				    	<?php echo form_input(['name'=>'empemail2', 'type'=>'email', 'class'=>'form-control', 'placeholder'=>'Email' , 'value'=>$data->employee_mail_2]); ?>
    			    				    </div>		
				    				    	
										<div class="col-md-3" style="margin-top: 5px;">
				    				    	<p>Date of Birth</p> 
				    				    </div>
				    				    <div class="col-md-7" style="margin-top: 5px;">
				    				    	<?php echo form_input(['name'=>'empbirthdate', 'type'=>'date', 'class'=>'form-control', 'placeholder'=>'Date' , 'value'=>$data->employee_date_of_birth]); ?>

				    				    </div>

				    				    
				    				    	<?php }} ?>


												<div class="col-md-12" style="margin-top: 15px; text-align:center;">
													    <?php echo form_submit(['name'=>'submit','value'=>'Update info','class'=>'btn btn-primary', 'style'=>'background-color: #6d7da5; border-color: #6d7da5;']);
													?>		
		    				    				</div>

		    				    		</div>
		    				    		<?php echo form_close(); ?>
	    				    			
	    				    		</div>
	    				    		
	    				    	</div>
	    				    	</div>
	    				  </div>
	    				</div>


	    				
	    			</div>		

	    			

	    		</div>
	    	</div>
	    </section>


<?php include('footer.php'); ?>