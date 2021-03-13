<?php include('header.php'); ?>
<section id="breadcrump">
	    	<div class="container-fluid">
	    		<ol class="breadcrumb">
	    			<li class="breadcrumb-item breadcrumb-item active"><a href="#">Home</a></li>
	    			    <li class="breadcrumb-item">Library</li>
	    			    <li class="breadcrumb-item">View Employee List</li>
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
	    				    Update Info', ['class'=>'list-group-item list-group-item-action']); ?>

	    				    <?php 
	    				    echo anchor('UserController/attendanceToday', '<span><i class="far fa-clock"></i></span>
	    				    Attendance', ['class'=>'list-group-item list-group-item-action']);
	    				    ?>
	    				    
	    				    <?php if($this->session->userdata('headsessionid'))
	    				    { 
	    				    	
	    				    ?>	
	    				    <?php 
	    				    echo anchor('UserController/attendanceReport', '<span><i class="fas fa-list-alt"></i></span>
	    				    Attendance Report', ['class'=>'list-group-item list-group-item-action']);
	    				    ?>
	    					<?php echo anchor('UserController/headApproveLeave', 
	    				  '<span><i class="fas fa-clipboard-check"></i></span> Approve Leave  <span class="badge badge-secondary float-right m-1">'.$leaveReqPendingCountBadge.'</span>', 
	    				  ['class'=>'list-group-item list-group-item-action']); ?>

	    					<?php
	    					}
	    					?>

	    				  <?php echo anchor('UserController/employeeApplyLeave', 
	    				  '<span><i class="fas fa-coffee"></i></span> Apply for Leave  <span class="badge badge-secondary float-right m-1"><i class="fas fa-exclamation"></i></span>', 
	    				  ['class'=>'list-group-item list-group-item-action']); ?>


	    				  <?php echo anchor('UserController/employeeViewEmployeeList', 
	    				  '<span><i class="fas fa-list-alt"></i></span> Employee List <span class="badge badge-secondary float-right m-1">'.$employeeCountBadge.'</span>', 
	    				  ['class'=>'list-group-item list-group-item-action active main-color-bg']); ?>

	    				</div>
	    			</div>	

	    			<div class="col-md-9">
	    				<div class="card">
	    				  
	    				    <h5 class="card-header main-color-bg"><i class="fas fa-list-ul"></i> Employee List</h5>

	    				   <div class="card-body">
								    	    				 <div class="table-responsive">
								    	    				<table class="table table-hover table-bordered table-striped">
								    	    				  
								    	    				  <thead style="text-align: center;">
								    	    				    <tr>
								    	    				      <th scope="col">#</th>
								    	    				      <th scope="col" style="min-width: 120px;">-</th>
								    	    				      <th scope="col" style="min-width: 120px;">Name</th>
								    	    				      <th scope="col" style="min-width: 120px;">Designation</th>
								    	    				      <th scope="col" style="min-width: 120px;">Department</th>
								    	    				       <th scope="col" style="min-width: 120px;">Blood Grp</th>	
								    	    				      <th scope="col" style="min-width: 150px;">E-Mail 1</th>
								    	    				      <th scope="col" style="min-width: 120px;">Contact 1</th>
								    	    				      <th scope="col" style="min-width: 150px;">E-Mail 2</th>
								    	    				      <th scope="col" style="min-width: 120px;">Contact 2</th>
								    	    				     							    	    				      
								    	    				    </tr>
								    	    				  </thead>
								    	    				  <tbody>
	    	    				  								<?php if (count($getAllEmployeeInfoData))
	    	    				  	    			      		{ 
    	    				  	    			    				foreach ($getAllEmployeeInfoData as $key => $data )
    	    				  	    			    				{ ?>
								    	    				  	<tr>
								    	    				  	<td><?PHP echo $key+1; ?></td>
								    	    				  	<td style="text-align: center;">
								    	    				  		<img src='<?php echo $data->employee_profile_pic; ?>' class="rounded-circle" alt="pic" style="width: 50px; height: 50px;">
								    	    				  	</td>
								    	    				  	<td>
								    	    				  		<?php 
								    	    				  		echo $data->employee_name; 
								    	    				  		if($data->employee_role==1)
								    	    				  			{ echo "<p style='color: #FF4444;'> [ Admin ] </p>"; }
								    	    				  		?>	
								    	    				  	</td>
								    	    				  	<td><?php echo $data->employee_desg; ?></td>
								    	    				  	<td>
								    	    				  		<?php 
								    	    				  		echo $data->employee_dept; 
								    	    				  		if($data->employee_dept_head_sts==1)
								    	    				  			{ echo "<p style='color: #FF4444;'> [ Head ] </p>"; }
								    	    				  		?>
								    	    				  			
								    	    				  	</td>
								    	    				  	<td><?php echo $data->employee_blood_grp; ?></td>
								    	    				  	<td><?php echo $data->employee_mail_1; ?></td>
								    	    				  	<td><?php echo $data->employee_official_mobile_no; ?></td>
								    	    				  	<td><?php echo $data->employee_official_email_2; ?></td>
								    	    				  	<td><?php echo $data->employee_personal_mobile_no; ?></td>
								    	    				  	
								    	    				  	</tr>
								    	    				  <?php }} ?>
								    	    				  </tbody>
								    	    				</table>
								    	    			</div></div>
	    				  </div>
	    				</div>


	    				
	    			</div>		

	    			

	    		</div>
	    	</div>
	    </section>


<?php include('footer.php'); ?>