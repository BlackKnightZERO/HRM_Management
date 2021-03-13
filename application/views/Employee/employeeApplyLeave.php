<?php include('header.php'); ?>
<section id="breadcrump">
	    	<div class="container-fluid">
	    		<ol class="breadcrumb">
	    			<li class="breadcrumb-item breadcrumb-item active"><a href="#">Home</a></li>
	    			    <li class="breadcrumb-item">Library</li>
	    			    <li class="breadcrumb-item">Apply for Leave</li>
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
	    				  ['class'=>'list-group-item list-group-item-action active main-color-bg']); ?>


	    				  <?php echo anchor('UserController/employeeViewEmployeeList', 
	    				  '<span><i class="fas fa-list-alt"></i></span> Employee List <span class="badge badge-secondary float-right m-1">'.$employeeCountBadge.'</span>', 
	    				  ['class'=>'list-group-item list-group-item-action']); ?>

	    				</div>
	    			</div>	

	    			<div class="col-md-9">
	    				<div class="card">
	    				  
	    				    <h5 class="card-header main-color-bg"><span><i class="far fa-calendar-alt"></i></span> Leave Form </h5>

	    				    <div class="card-body">
	    				    	<?php echo form_open('UserController/employeeAppliedForLeave'); ?>
	    				    	<div class="row" style="text-align: center;">
	    				    		
	    				    		<div class="col-md-4">
	    				    			<div class="form-group">
	    				    				<h5 style="margin-top: 10px; color: #293039;" >Leave from:</h5>
	    				    				    <input type="date" class="form-control" id="" style="margin-top: 5px;" required="required" name="leavefrom">
	    				    				<h5 style="margin-top: 10px; color: #293039;">To:</h5>
	    				    				    <input type="date" class="form-control" id="" style="margin-top: 5px;" required="required" name="leaveto">
	    				    			</div>
	    				    		</div>
	    				    		<div class="col-md-5">
	    				    			<h5 style="margin-top: 10px; color: #293039;">Reason:</h5>
	    				    			<textarea class="form-control" id="" rows="4" required="required" name="leavereason"></textarea>
	    				    		</div>
	    				    		<div class="col-md-3">

	    				    			<div class="form-group">
	    				    			      <h5 style="margin-top: 10px; color: #293039;">Type:</h5>
	    				    			      <select id="inputState" class="form-control" name="leavetype" required="required">
	    				    			        
	    				    			        <option>Sick Leave</option>
	    				    			        <option>Annual Leave</option>
	    				    			        <option>Compensatory Leave</option>
	    				    			        
	    				    			      </select>
	    				    			    </div>

	    				    			<?php echo form_submit(['name'=>'submit','value'=>'Apply','class'=>'btn btn-info', 'style'=>'margin-top: 10px;']);
        ?>
	    				    		</div>
	    				    		
	    				    		</div>
	    				    		<?php echo form_close(); ?>

	    				    	</div>
	    				    	<h5 class="card-header main-color-bg"><span><i class="far fa-calendar-alt"></i></span> History <select id="leave2" onchange="leaveChange2(this)" style="margin-left: 10px; background: #E6E4F7" class="float-right"2>
											  <option>select</option>
											  <option value="10">10</option>
											  <option value="25">25</option>
											  <option value="50">50</option>
											</select>
									</h5>

									<script type="text/javascript">
									function leaveChange2() {
										    if (document.getElementById("leave2").value == "10"){
										        var rowload = 10;
										        window.location.pathname="CI_HRM/index.php/UserController/employeeApplyLeavee/"+rowload+"";
										    }
										    if (document.getElementById("leave2").value == "25"){
										       var rowload = 25;
										        window.location.pathname="CI_HRM/index.php/UserController/employeeApplyLeavee/"+rowload+"";
										    } 
										    if (document.getElementById("leave2").value == "50"){
										       var rowload = 50;
										        window.location.pathname="CI_HRM/index.php/UserController/employeeApplyLeavee/"+rowload+"";
										    }      
										}
								</script>

									    				    <div class="card-body">

									    				    <p>	Leaves Taken -

									    				    <?php
									    				    if($this->session->userdata('sessionid'))
															{
																$id = $this->session->userdata('sessionid');
															}
															if($this->session->userdata('headsessionid'))
															{
																$id = $this->session->userdata('headsessionid');
															}
									    				    ?>	
									    				    <span style="color: red;">	Sick Leaves : </span> 
								    				    	<?PHP 
				    										$countSickLeave = $this->db->from('leaves')
				    										->where('leave_type', 'Sick Leave')
				    										->where('current_status_from_dept_head', 1)
				    										->where('employee_id', $id)
				    										->count_all_results();
					    									
					    									echo $countSickLeave; 
					    									?>
									    				    <span style="color: green;"> - Annual Leaves : </span> 
								    				    	<?PHP 
				    										$countAnnualLeave = $this->db->from('leaves')
				    										->where('leave_type', 'Annual Leave')
				    										->where('current_status_from_dept_head', 1)
				    										->where('employee_id', $id)
				    										->count_all_results();
				    										echo $countAnnualLeave; 
					    									?>
									    				    <span style="color: blue;"> - Compansatory Leaves : </span> 

								    				    	<?PHP 
				    										$countCompensatoryLeave = $this->db->from('leaves')
				    										->where('leave_type', 'Compensatory Leave')
				    										->where('current_status_from_dept_head', 1)
				    										->where('employee_id', $id)
				    										->count_all_results();
					    									echo $countCompensatoryLeave; 
					    									?>
									    				    </p>

								    	    				 <div class="table-responsive">
								    	    				<table class="table table-hover table-bordered table-striped">
								    	    				  
								    	    				  <thead style="text-align: center;">
								    	    				    <tr>
								    	    				      <th scope="col">#</th>
								    	    				      <th scope="col" style="min-width: 120px;">Leave from</th>
								    	    				      <th scope="col" style="min-width: 120px;">To</th>
								    	    				      <th scope="col" style="min-width: 120px;">Leave Type</th>
								    	    				      <th scope="col" style="min-width: 150px;">Reason</th>
								    	    				      <th scope="col" style="min-width: 120px;">Requested on</th>
								    	    				      <th scope="col" style="min-width: 120px;">Approved on</th>
								    	    				      <th scope="col" style="min-width: 120px;">Status</th>
								    	    				    </tr>
								    	    				  </thead>
								    	    				  <tbody>
	    	    				  								<?php if (count($myLeaveData))
	    	    				  	    			      		{ 
    	    				  	    			    				foreach ($myLeaveData as $key => $data )
    	    				  	    			    				{ ?>
								    	    				  	<tr>
								    	    				  	<td><?PHP echo $key+1; ?></td>
								    	    				  	<td><?PHP if($data->employee_leave_start5=='0000-00-00'){echo '';}else echo $data->employee_leave_start5; ?></td>
								    	    				  	<td><?PHP if($data->employee_leave_end5=='0000-00-00'){echo '';}else echo $data->employee_leave_end5; ?></td>
								    	    				  	<td><?PHP echo $data->employee_leave_type5; ?></td>
								    	    				  	<td><?PHP echo $data->employee_leave_reason5; ?></td>
								    	    				  	<td><?PHP if($data->employee_leave_requested_on5=='0000-00-00'){echo '';}else echo $data->employee_leave_requested_on5; ?></td>
								    	    				  	<td><?PHP if($data->employee_leave_approved_denied_on5=='0000-00-00'){echo '';}else echo $data->employee_leave_approved_denied_on5; ?></td>

								    	    				  	<td>
								    	    				  	<?php 
								    	    				  	if($data->employee_current_status_from_dept_head5 == 0)
								    	    				  	{
								    	    				  		echo "<button class = 'btn btn-secondary btn-sm' style = 'width:90px; margin-bottom:4px;'>Pending</button>";
								    	    				  	}
								    	    				  	else if($data->employee_current_status_from_dept_head5 == 1)
								    	    				  	{
								    	    				  		echo "<button class = 'btn btn-success btn-sm' style = 'width:90px; margin-bottom:4px;'>Approved</button>";
								    	    				  	}
								    	    				  	else if($data->employee_current_status_from_dept_head5 == 2)
								    	    				  	{
								    	    				  		echo "<button class = 'btn btn-danger btn-sm' style = 'width:90px; margin-bottom:4px;'>Denied</button>";
								    	    				  	}

								    	    				  	?>

								    	    				  	</td>
								    	    				  	
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