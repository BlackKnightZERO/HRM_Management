<?php include('header.php'); ?>


<section id="breadcrump">
	    	<div class="container-fluid">
	    		<ol class="breadcrumb">
	    			<li class="breadcrumb-item breadcrumb-item active"><a href="#">Dashboard</a></li>
	    			    <li class="breadcrumb-item">Library</li>
	    			    <li class="breadcrumb-item">Employee List</li>
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
	    				  <?php echo anchor('AdminController/adminDashboard','<span><i class="fas fa-tachometer-alt"></i></span>
	    				    Dashboard', ['class'=>'list-group-item list-group-item-action']); ?>

	    				  <?php echo anchor('AdminController/adminAddEmployee', 
	    				  '<span><i class="fas fa-user"></i></span> Add Employee', 
	    				  ['class'=>'list-group-item list-group-item-action']); ?>

	    				  <?php echo anchor('AdminController/adminLeaveRequest', 
	    				  '<span><i class="fas fa-coffee"></i></span> Leave Requests <span class="badge badge-secondary float-right m-1">'.$leaveReqPendingCountBadge.'</span>', 
	    				  ['class'=>'list-group-item list-group-item-action']); ?>

	    				  <?php echo anchor('AdminController/adminEmployeeList', 
	    				  '<span><i class="fas fa-list-alt"></i></span> Employee List <span class="badge badge-secondary float-right m-1">'.$employeeCountBadge.'</span>', 
	    				  ['class'=>'list-group-item list-group-item-action active main-color-bg']); ?>

	    				  <?php echo anchor('AdminController/adminAddDepartmentDesignation', 
	    				  '<span><i class="fas fa-layer-group"></i></span> Add New Department Designation', ['class'=>'list-group-item list-group-item-action']); ?>
	    				</div>
	    			</div>	

	    			<div class="col-md-9">

	    				<?php if($msg = $this->session->flashdata('msg')): ?>
	    					<?php echo "<div class= 'alert alert-success' role='alert'>"; ?>
	    				    <?php echo $msg; ?>
	    				    <?php echo "</div>"; ?>
	    				  <?php endif; ?>
	    				  <?php if($msgg = $this->session->flashdata('msgg')): ?>
	    					<?php echo "<div class= 'alert alert-warning' role='alert'>"; ?>
	    				    <?php echo $msgg; ?>
	    				    <?php echo "</div>"; ?>
	    				  <?php endif; ?>

	    				<div class="card">
	    				  
	    				    <h5 class="card-header main-color-bg"><i class="fas fa-list-ul"></i> All Employees</h5>

	    				 <div class="table-responsive">
	    				<table class="table table-hover table-bordered table-striped">
	    				  
	    				  <thead>
	    				    <tr style="text-align: center;">
	    				      <th scope="col">#</th>
	    				      <th scope="col">Profile</th>
	    				      <th scope="col">Name</th>	    				     
	    				      <th scope="col">Designation</th>
	    				       <th scope="col">Department</th>
	    				      <th scope="col">Phone</th>
	    				      <th scope="col">Email</th>
	    				      <th scope="col" style="min-width: 110px;">Joining</th>
	    				      
	    				      <th scope="col">Sick Leave</th>
	    				      <th scope="col">Annual Leave</th>
	    				      <th scope="col">Comp Leave</th>
	    				      <th scope="col" style="min-width: 110px;">Action</th>
	    				    </tr>
	    				  </thead>
	    				  <tbody>

			      		<?php 
			      		$track = 0;
			      		if (count($empdata))
			      		{
			    				foreach ($empdata as $key => $data )
			    				{ 
			    					?>

			    					<tr style="height: 70px; text-align: center;"> 
			    					<td> <?PHP echo $key+1; ?> </td>
			    					<td style="text-align: center;">
	    	    				  		<img src='<?php echo $data->employee_profile_pic; ?>' class="rounded-circle" alt="pic" style="width: 50px; height: 50px;">
	    	    				  	</td>
			    					<td>
			    					<?PHP echo $data->employee_name; 
			    					if($data->employee_role==1)
								    	{ echo "<p style='color: #FF4444;'> [ Admin ] </p>"; } 
								    ?>
								    </td>			    				
				    				<td><?PHP echo $data->employee_desg; ?></td>
				    				<td><?PHP echo $data->employee_dept; ?>
				    				<?php 
				    				if( $data->employee_dept_head_sts == 1 ) 
				    					{
				    						echo '<p style="color: #FF4444;">[ Head ]</p>'; 
				    					}
				    				?>
				    				</td>
				    				<td><?PHP echo $data->employee_official_mobile_no; ?></td>
				    				<td><?PHP echo $data->employee_mail_1; ?></td>
				    				<td><?PHP echo $data->employee_join_date; ?></td>
				    				
									<td>
									<?PHP 
										$countSickLeave = $this->db->from('leaves')
										->where('leave_type', 'Sick Leave')
										->where('employee_id', $data->employee_id)
										->count_all_results();
									?>
									<?php echo $countSickLeave; ?>
									</td>
									<td>
									<?PHP 
										$countAnnualLeave = $this->db->from('leaves')
										->where('leave_type', 'Annual Leave')
										->where('employee_id', $data->employee_id)
										->count_all_results();
									?>
									<?php echo $countAnnualLeave; ?>
									</td>
									<td>
									<?PHP 
										$countCompensatoryLeave = $this->db->from('leaves')
										->where('leave_type', 'Compensatory Leave')
										->where('employee_id', $data->employee_id)
										->count_all_results();
									?>
									<?php echo $countCompensatoryLeave; ?>
									</td>

									<td>
										<span data-toggle="modal" data-target="#profileModal<?php echo $track; ?>" data-whatever="@getbootstrap"><i class="fas fa-eye" style="color: #255F37;"></i></span> &nbsp;


										<!-- MODAL -->

										<div class="modal fade" id="profileModal<?php echo $track; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
										  <div class="modal-dialog" role="document">
										    <div class="modal-content">
										      <div class="modal-header">
										        <h5 class="modal-title" id="exampleModalLabel1" style="color: #6d7da5;"> Employee details </h5>
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										          <span aria-hidden="true">&times;</span>
										        </button>
										      </div>
										      <div class="modal-body">
										        <div class="row">
										        <div class="col-md-12 text-center" style="margin-bottom: 10px;"> 
										        	<img src="<?php echo $data->employee_profile_pic; ?>" class="img-fluid img-thumbnail" style="margin-bottom: 3px; max-height: 220px; max-width: 220px;">
										        	<hr>
										        	<!--<input class="btn btn-danger btn-sm" type="button" value="Reset Password" onclick="ResetPass()">-->
										        </div>


										        <div class="col-md-12"> 
										        	<div class="alert alert-success">
	    				    					
			    				    				<h6>User Name : <?php echo $data->employee_name; ?></h6>
			    				    				<h6>Department : <?php echo $data->employee_dept; ?></h6>
			    				    				<h6>Designation : <?php echo $data->employee_desg; ?></h6>
			    				    				<h6>Joining Date : <?php echo $data->employee_join_date; ?></h6>
			    				    				<h6>Date of Birth : <?php echo $data->employee_date_of_birth; ?></h6>
			    				    				<h6>Blood Group : <?php echo $data->employee_blood_grp; ?></h6>
			    				    				<h6>Official Phone : <?php echo $data->employee_official_mobile_no; ?></h6>
			    				    				<h6>Official Email : <?php echo $data->employee_mail_1; ?></h6>
			    				    				<hr style="border: 1px solid #A6BDA8;">
			    				    				<h6>Additional Phone : <?php echo $data->employee_personal_mobile_no; ?></h6>
			    				    				<h6>Additional Email : <?php echo $data->employee_official_email_2; ?></h6>
			    				    			
	    				    			

	    				    			</div>
										        </div>
										        </div>
										      </div>
										      <div class="modal-footer">
										        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										      </div>
										    </div>
										  </div>
										</div>

										<!-- MODAL -->


										<span data-toggle="modal" data-target="#<?php echo $data->employee_id; ?>" data-whatever="@getbootstrap"><i class="fas fa-user-edit" style="color: #8B75F7;"></i></span> &nbsp;


										<!-- MODAL -->

										<div class="modal fade" id="<?php echo $data->employee_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
										  <div class="modal-dialog" role="document">
										    <div class="modal-content">
										      <div class="modal-header">
										        <h5 class="modal-title" id="exampleModalLabel2" style="color: #6d7da5;"> Update Employee </h5>
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										          <span aria-hidden="true">&times;</span>
										        </button>
										      </div>
										      <div class="modal-body">
										      	<?php echo form_open('AdminController/AdminUpdateEmployee'); ?>
										      	<div class="row">
										      		
										      		<?php
										      		$dataid = array(
										      		        'empid' => $data->employee_id
										      		);

										      		echo form_hidden($dataid);
										      		?>

										        <div class="col-md-12" style="margin-top: 5px;">
										        	
			    				    	<p>Employee Name</p> 
			    				    </div>
			    				    <div class="col-md-12" style="margin-top: 5px;">
			    				    	<?php echo form_input(['name'=>'empname','class'=>'form-control',  'placeholder'=>'Name' , 'required'=>'required', 'value'=>$data->employee_name, 'style'=>'color: #BD3A3A;']); ?>
			    				    </div>
			    				    <div class="col-md-12" style="margin-top: 5px;">
			    				    	<label for="department">Department <span style="color: #BD3A3A;">( <?php echo $data->employee_dept; ?> )</span> </label>
			    				    </div>
			    				    <div class="col-md-12" style="margin-top: 5px;">
			    				    	
			    				    	    <select class="form-control" id="department" name="empdept">
			    				    	    			<option value="x" <?php echo  set_select('empdept', 'x', TRUE); ?> >Select</option>
			    				    	        		<?php if (count($deptdata))
			    				    	        		{ 
			    				    	      				foreach ($deptdata as $key2 => $data2 )
			    				    	      				{ 
			    				    	      					echo "<option value=$data2->id"; 
			    				    	      					echo set_select('empdept', $data2->id); ?> 
			    				    	      					>
			    				    	      					<?php echo $data2->department_name; ?>
			    				    	      					<?php echo "</option>";
			    				    	      				}
			    				    	      			}
			    				    	      			?>
			    				    	      
			    				    	    </select>
			    				    </div>	
			    				    <div class="col-md-12" style="margin-top: 5px;">
			    				    	<label for="designation">Designation <span style="color: #BD3A3A;">( <?php echo $data->employee_desg; ?> )</span> </label>
			    				    </div>
			    				    <div class="col-md-12" style="margin-top: 5px;">
			    				    	
			    				    	    <select class="form-control" id="designation"  name="empdesignation">
			    				    	    	<option value="y" <?php echo  set_select('empdesignation', 'y', TRUE); ?> >Select</option>
			    				    	        		<?php if (count($desigdata))
			    				    	        		{ 
			    				    	      				foreach ($desigdata as $kkey3 => $ddata3 )
			    				    	      				{ 
			    				    	      					echo "<option value=$ddata3->id"; 
			    				    	      					echo set_select('empdesignation', $ddata3->id); ?> 
			    				    	      					>
			    				    	      					<?php echo $ddata3->designation_name; ?>
			    				    	      					<?php echo "</option>";
			    				    	      				}
			    				    	      			}
			    				    	      			?>
			    				    	    </select>
			    				    </div>
			    				    <div class="col-md-12" style="margin-top: 5px;">
			    				    	<p>Phone</p> 
			    				    </div>
			    				    <div class="col-md-12" style="margin-top: 5px;">
			    				    	<?php echo form_input(['name'=>'empnumber', 'type'=>'number', 'class'=>'form-control', 'placeholder'=>'Phone' , 'required'=>'required', 'value'=>$data->employee_official_mobile_no]); ?>
			    				    </div>			
			    				    <div class="col-md-12" style="margin-top: 5px;">
			    				    	<p>Email</p> 
			    				    </div>
			    				    <div class="col-md-12" style="margin-top: 5px;">
			    				    	<?php echo form_input(['name'=>'empemail', 'type'=>'email', 'class'=>'form-control', 'placeholder'=>'Email' , 'required'=>'required', 'value'=>$data->employee_mail_1]); ?>
			    				    	
			    				    </div>	
			    				    
									<div class="col-md-12" style="margin-top: 5px;">
			    				    	<p>Joining Date</p> 
			    				    </div>
			    				    <div class="col-md-12" style="margin-top: 5px;">
			    				    	<?php echo form_input(['name'=>'empjoindate', 'type'=>'date', 'class'=>'form-control', 'placeholder'=>'Date' , 'required'=>'required', 'value'=>$data->employee_join_date]); ?>

			    				    </div>

			    				    <div class="col-md-12" style="margin-top: 5px;">
			    				    	<label for="designation">Role 
			    				    	<span style="color: #BD3A3A;">
			    				    	<?php 	
			    				    	if($data->employee_role == 0)
			    				    	{
			    				    		echo "( Employee )";
			    				    	}
			    				    	if($data->employee_role == 1)
			    				    	{
			    				    		echo "( Admin )";
			    				    	}

			    				    	?>
			    				    	</span>
			    				    	</label>
			    				    </div>
			    				    <div class="col-md-12" style="margin-top: 5px;">
			    				    	
			    				    	    <select class="form-control" id="role"  name="emprole">

			    				    	    	<option value="z" <?php echo  set_select('emprole', 'z', TRUE); ?> >Select</option>
			    				    	        		
			    				    	      		<?php echo "<option value=0"; 
    				    	      					echo set_select('emprole', '0'); ?> 
    				    	      					>
    				    	      					<?php echo "Employee"; ?>
    				    	      					<?php echo "</option>"; ?>

    				    	      					<?php echo "<option value=1"; 
    				    	      					echo set_select('emprole', '1'); ?> 
    				    	      					>
    				    	      					<?php echo "Admin"; ?>
    				    	      					<?php echo "</option>"; ?>
			    				    	      					
			    				    	    </select>
			    				    	    
			    				    </div>
			    				    		<div class="col-md-7 form-check" style="color:#BD3A3A;">

			    				    			<?php 
			    				    			if( $data->employee_dept_head_sts == 1 ) 
			    				    				{
			    				    					$data4 = array(
			    				    					        'name'          => 'head',
			    				    					        'value'         => 1,
			    				    					        'checked'       => TRUE,
			    				    					        'style'         => 'margin:15px'
			    				    					);

			    				    					echo form_checkbox($data4);
			    				    					echo 'Dept. Head';
			    				    				}
			    				    			if( $data->employee_dept_head_sts == 0 ) 
			    				    				{
			    				    					$data4 = array(
			    				    					        'name'          => 'head',
			    				    					        'value'         => 1,
			    				    					        'checked'       => FALSE,
			    				    					        'style'         => 'margin:15px'
			    				    					);

			    				    					echo form_checkbox($data4);
			    				    					echo 'Dept. Head';
			    				    				}
			    				    			?>
			    				    			       			    				    			     
			    				    	    </div>
			    				    		<div class="col-md-5 form-check" style="color:#BD3A3A;">

			    				    			<?php 
			    				    			
			    				    					$data5 = array(
			    				    					        'name'          => 'passreset',
			    				    					        'value'         => 1,
			    				    					        'checked'       => FALSE,
			    				    					        'style'         => 'margin:15px'
			    				    					);

			    				    					echo form_checkbox($data5);
			    				    					echo 'Password Reset';
			    				    				
			    				    			?>
			    				    			       			    				    			     
			    				    	    </div>

											</div>

										      </div>
										      <div class="modal-footer">
										      	<?php echo form_submit(['name'=>'submit','value'=>'Update Info','class'=>'btn btn-primary', 'style'=>'background-color: #6d7da5; border-color: #6d7da5;']);
												?>		
												<?php echo form_close(); ?>
										        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										      </div>
										    </div>
										  </div>
										</div>

										<!-- MODAL -->



										<span onclick="userDelete(<?php echo $data->employee_id?>)"><i class="fas fa-trash-alt" style="color: #F36565;"></i></span>

										<!--
								         <?php echo anchor("AdminController/adminViewEmployee/{$data->employee_id}", 'View', ['class'=>'btn btn-primary btn-sm', 'style'=>'width:90px; margin-bottom:4px;']); ?>
								         <?php echo anchor("AdminController/adminUpdateEmployee/{$data->employee_id}", 'Update', ['class'=>'btn btn-warning btn-sm', 'style'=>'width:90px; margin-bottom:4px;']); ?>
								         
										<input class="btn btn-danger btn-sm" type="button" value="Delete" style="width:90px;" onclick="myFun(<?php echo $data->employee_id?>)">

									-->
									</td>

									</tr>

			    				<?php 
			    				$track++;
			    			}
			    			}
			    			?>

	    				  </tbody>
	    				</table>

	    				</div>
	    				</div>
	    				 </div>
	    				 </div>
	    				  


	    				
	    			</div>		

	    			

	    		</div>
	    	</div>
	    </section>


<?php include('footer.php'); ?>
<script type="text/javascript">
	function userDelete(id)
	{
		//alert(id);
		var r = confirm("Are you sure you want to delete this employee?");
		if (r == true) 
		{
		 window.location.pathname="CI_HRM/index.php/AdminController/adminDeleteEmployee/"+id+"";
		} 
		else 
		{
		 	// window.location.pathname="CI_HRM/index.php/AdminController/adminEmployeeList";
		}
	}
</script>