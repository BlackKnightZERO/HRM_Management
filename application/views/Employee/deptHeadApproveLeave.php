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
	    				    Update Info', ['class'=>'list-group-item list-group-item-action']); ?>

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
	    				  ['class'=>'list-group-item list-group-item-action active main-color-bg']); ?>

	    					<?php
	    					}
	    					?>

	    				  <?php echo anchor('UserController/employeeApplyLeave', 
	    				  '<span><i class="fas fa-coffee"></i></span> Apply for Leave  <span class="badge badge-secondary float-right m-1"> <i class="fas fa-exclamation"></i> </span>', 
	    				  ['class'=>'list-group-item list-group-item-action']); ?>


	    				  <?php echo anchor('UserController/employeeViewEmployeeList', 
	    				  '<span><i class="fas fa-list-alt"></i></span> Employee List <span class="badge badge-secondary float-right m-1">70</span>', 
	    				  ['class'=>'list-group-item list-group-item-action']); ?>

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
	    				  
	    				    <h5 class="card-header main-color-bg"><span><i class="far fa-calendar-alt"></i></span> Leave Requests <select id="leave" onchange="leaveChange(this)" style="margin-left: 10px;  background: #E6E4F7" class="float-right">
										  <option>select</option>
										  <option value="10">10</option>
										  <option value="25">25</option>
										  <option value="50">50</option>
										</select>
							</h5>
							<script type="text/javascript">
								function leaveChange() {
									    if (document.getElementById("leave").value == "10"){
									        var rowload = 10;
									        window.location.pathname="CI_HRM/index.php/UserController/headApproveLeavee/"+rowload+"";
									    }
									    if (document.getElementById("leave").value == "25"){
									       var rowload = 25;
									        window.location.pathname="CI_HRM/index.php/UserController/headApproveLeavee/"+rowload+"";
									    } 
									    if (document.getElementById("leave").value == "50"){
									       var rowload = 50;
									        window.location.pathname="CI_HRM/index.php/UserController/headApproveLeavee/"+rowload+"";
									    }      
									}
							</script>

							
	    				    <div class="card-body">
    	    				 <div class="table-responsive">
    	    				<table class="table table-hover table-bordered table-striped">
    	    				  
    	    				  <thead style="text-align: center;">
    	    				    <tr>
    	    				      <th scope="col">#</th>
    	    				      <th scope="col" style="min-width: 150px;">Name</th>
    	    				      <th scope="col" style="min-width: 120px;">Department</th>
    	    				      <th scope="col" style="min-width: 120px;">Designation</th>

    	    				      <th scope="col" style="min-width: 120px;">Leave Type</th>
    	    				      <th scope="col" style="min-width: 120px;">Leave from</th>
    	    				      <th scope="col" style="min-width: 120px;">To</th>
    	    				      <th scope="col" style="min-width: 150px;">Reason</th>
    	    				      <th scope="col">Action</th>
    	    				      <th scope="col" style="min-width: 120px;">Requested On</th>
    	    				      <th scope="col">Current Status</th>
								  

    	    				      <th scope="col" style="min-width: 120px;">Phone</th>
    	    				      <th scope="col" style="min-width: 150px;">Email</th>
    	    				      <th scope="col">Sick Leave Requested</th>
    	    				      <th scope="col">Annual Leave Requested</th>
    	    				      <th scope="col">Compensatory Leave Requested</th>
    	    				    </tr>
    	    				  </thead>
    	    				  <tbody>
									<?php if (count($leaveReqData))
		    			      		{ 
		    			    				foreach ($leaveReqData as $key => $data )
		    			    				{ ?>

		    			    					
		    			    			<tr> 
		    			    					<td> <?PHP echo $key+1; ?> </td>
		    			    					<td><?PHP echo $data->employee_name; ?></td>
		    				    				<td>
		    				    					<?PHP echo $data->employee_dept; ?>
		    				    					<?php 
								    				if( $data->employee_dept_head_sts == 1 ) 
								    					{
								    						echo '[ Head ]'; 
								    					}
								    				?>
				    							</td>
		    				    				<td><?PHP echo $data->employee_desg; ?></td>

		    				    				<td><?PHP echo $data->employee_leave_type; ?></td>
		    				    				<td><?PHP echo $data->employee_leave_start; ?></td>
		    				    				<td><?PHP echo $data->employee_leave_end; ?></td>
		    				    				<td><?PHP echo $data->employee_leave_reason; ?></td>
		    				    				<td>
		    										
		    								         <?php echo anchor("UserController/headApprovedLeave/{$data->l_id}/{$data->employee_current_status_from_dept_head}", 'Approve', ['class'=>'btn btn-success btn-sm', 'style'=>'width:90px; margin-bottom:4px;']); ?>
		    								         <?php echo anchor("UserController/headDeniedLeave/{$data->l_id}/{$data->employee_current_status_from_dept_head}", 'Deny', ['class'=>'btn btn-danger btn-sm', 'style'=>'width:90px; margin-bottom:4px;']); ?>
		    								         
		    										
		    									</td>
		    				    				<td><?PHP echo $data->employee_leave_requested_on; ?></td>
		    				    				<td>
		    				    					<?PHP 
			    				    				if($data->employee_current_status_from_dept_head == 0)
			    				    				{
			    				    					echo "pending";
			    				    				} 
			    				    				?>
		    				    					
		    				    				</td>

		    				    				


		    				    				<td><?PHP echo $data->employee_official_mobile_no; ?></td>
		    				    				<td><?PHP echo $data->employee_mail_1; ?></td>
		    				    				
		    				    				
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
										<tr/>

		    			    				<?php }
		    			    			}
		    			    			?>

    	    				  </tbody>
    	    				</table>
    	    			</div>
	    				</div>
		    				 <h5 class="card-header main-color-bg"><span><i class="far fa-calendar-alt"></i></span> Approved Leaves <select id="leave1" onchange="leaveChange1(this)" style="margin-left: 10px; background: #E6E4F7" class="float-right">
											  <option>select</option>
											  <option value="10">10</option>
											  <option value="25">25</option>
											  <option value="50">50</option>
											</select>
								</h5>

								<script type="text/javascript">
								function leaveChange1() {
									    if (document.getElementById("leave1").value == "10"){
									        var rowload = 10;
									        window.location.pathname="CI_HRM/index.php/UserController/headApproveLeavee/"+rowload+"";
									    }
									    if (document.getElementById("leave1").value == "25"){
									       var rowload = 25;
									        window.location.pathname="CI_HRM/index.php/UserController/headApproveLeavee/"+rowload+"";
									    } 
									    if (document.getElementById("leave1").value == "50"){
									       var rowload = 50;
									        window.location.pathname="CI_HRM/index.php/UserController/headApproveLeavee/"+rowload+"";
									    }      
									}
							</script>

		    				    <div class="card-body">
	    	    				 <div class="table-responsive">
	    	    				<table class="table table-hover table-bordered table-striped">
	    	    				  
	    	    				  <thead style="text-align: center;">
	    	    				    <tr>
	    	    				      <th scope="col">#</th>
	    	    				      <th scope="col" style="min-width: 150px;">Name</th>
	    	    				      <th scope="col" style="min-width: 120px;">Department</th>
	    	    				      <th scope="col" style="min-width: 120px;">Designation</th>

	    	    				      <th scope="col" style="min-width: 120px;">Leave Type</th>
	    	    				      <th scope="col" style="min-width: 120px;">Leave from</th>
	    	    				      <th scope="col" style="min-width: 120px;">To</th>
	    	    				      <th scope="col" style="min-width: 150px;">Reason</th>
	    	    				      <th scope="col">Current Status</th>
	    	    				      <th scope="col" style="min-width: 150px;">Requested on</th>
	    	    				      <th scope="col" style="min-width: 120px;">Approved On</th>
	    	    				      

	    	    				      <th scope="col" style="min-width: 120px;">Phone</th>
	    	    				      <th scope="col" style="min-width: 150px;">Email</th>
	    	    				      <th scope="col">Sick Leave Approved</th>
	    	    				      <th scope="col">Annual Leave Approved</th>
	    	    				      <th scope="col">Compensatory Leave Approved</th>
	    	    				    </tr>
	    	    				  </thead>
	    	    				  <tbody>
										<?php if (count($approveReqData))
			    			      		{ 
			    			    				foreach ($approveReqData as $key => $data )
			    			    				{ ?>

			    			    					
			    			    			<tr> 
			    			    					<td> <?PHP echo $key+1; ?> </td>
			    			    					<td><?PHP echo $data->employee_name1; ?></td>
			    				    				<td>
			    				    					<?PHP echo $data->employee_dept1; ?>
			    				    					<?php 
									    				if( $data->employee_dept_head_sts1 == 1 ) 
									    					{
									    						echo '[ Head ]'; 
									    					}
									    				?>
					    							</td>
			    				    				<td><?PHP echo $data->employee_desg1; ?></td>

			    				    				<td><?PHP echo $data->employee_leave_type1; ?></td>
			    				    				<td><?PHP echo $data->employee_leave_start1; ?></td>
			    				    				<td><?PHP echo $data->employee_leave_end1; ?></td>
			    				    				<td><?PHP echo $data->employee_leave_reason1; ?></td>
			    				    				<td>
			    				    					<?PHP 
				    				    				if($data->employee_current_status_from_dept_head1 == 1)
				    				    				{
				    				    					echo "<button class = 'btn btn-success btn-sm' style = 'width:90px; margin-bottom:4px;'>Approved</button>";
				    				    				} 
				    				    				?>
			    				    					
			    				    				</td>
			    				    				<td><?PHP echo $data->employee_leave_requested_on1; ?></td>
			    				    				<td><?PHP echo $data->employee_leave_approved_denied_on1; ?></td>
			    				    				
			    				    				

			    				    				<td><?PHP echo $data->employee_official_mobile_no1; ?></td>
			    				    				<td><?PHP echo $data->employee_mail_11; ?></td>
			    				    				
			    				    				
			    									<td>
			    									<?PHP 
			    										$countSickLeave = $this->db->from('leaves')
			    										->where('leave_type', 'Sick Leave')
			    										->where('current_status_from_dept_head', 1)
			    										->where('employee_id', $data->employee_id1)
			    										->count_all_results();
			    									?>
			    									<?php echo $countSickLeave; ?>
			    									</td>
			    									<td>
			    									<?PHP 
			    										$countAnnualLeave = $this->db->from('leaves')
			    										->where('leave_type', 'Annual Leave')
			    										->where('current_status_from_dept_head', 1)
			    										->where('employee_id', $data->employee_id1)
			    										->count_all_results();
			    									?>
			    									<?php echo $countAnnualLeave; ?>
			    									</td>
			    									<td>
			    									<?PHP 
			    										$countCompensatoryLeave = $this->db->from('leaves')
			    										->where('leave_type', 'Compensatory Leave')
			    										->where('current_status_from_dept_head', 1)
			    										->where('employee_id', $data->employee_id1)
			    										->count_all_results();
			    									?>
			    									<?php echo $countCompensatoryLeave; ?>
			    									</td>
											</tr>

			    			    				<?php }
			    			    			}
			    			    			?>

	    	    				  </tbody>
	    	    				</table>
	    	    			</div>
		    				</div>

		    				<!-- -->

		    				 <h5 class="card-header main-color-bg"><span><i class="far fa-calendar-alt"></i></span> Denied Leaves <select id="leave2" onchange="leaveChange2(this)" style="margin-left: 10px; background: #E6E4F7" class="float-right"2>
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
									        window.location.pathname="CI_HRM/index.php/UserController/headApproveLeavee/"+rowload+"";
									    }
									    if (document.getElementById("leave2").value == "25"){
									       var rowload = 25;
									        window.location.pathname="CI_HRM/index.php/UserController/headApproveLeavee/"+rowload+"";
									    } 
									    if (document.getElementById("leave2").value == "50"){
									       var rowload = 50;
									        window.location.pathname="CI_HRM/index.php/UserController/headApproveLeavee/"+rowload+"";
									    }      
									}
							</script>

		    				    <div class="card-body">
	    	    				 <div class="table-responsive">
	    	    				<table class="table table-hover table-bordered table-striped">
	    	    				  
	    	    				  <thead style="text-align: center;">
	    	    				    <tr>
	    	    				      <th scope="col">#</th>
	    	    				      <th scope="col" style="min-width: 150px;">Name</th>
	    	    				      <th scope="col" style="min-width: 120px;">Department</th>
	    	    				      <th scope="col" style="min-width: 120px;">Designation</th>

	    	    				      <th scope="col" style="min-width: 120px;">Leave Type</th>
	    	    				      <th scope="col" style="min-width: 120px;">Leave from</th>
	    	    				      <th scope="col" style="min-width: 120px;">To</th>
	    	    				      <th scope="col" style="min-width: 150px;">Reason</th>
	    	    				      <th scope="col">Current Status</th>
	    	    				      <th scope="col" style="min-width: 150px;">Requested on</th>
	    	    				      <th scope="col" style="min-width: 120px;">Denied On</th>
	    	    				      

	    	    				      <th scope="col" style="min-width: 120px;">Phone</th>
	    	    				      <th scope="col" style="min-width: 150px;">Email</th>
	    	    				      <th scope="col">Sick Leave Denied</th>
	    	    				      <th scope="col">Annual Leave Denied</th>
	    	    				      <th scope="col">Compensatory Leave Denied</th>
	    	    				    </tr>
	    	    				  </thead>
	    	    				  <tbody>
										<?php if (count($denyReqData))
			    			      		{ 
			    			    				foreach ($denyReqData as $key => $data )
			    			    				{ ?>

			    			    					
			    			    			<tr> 
			    			    					<td> <?PHP echo $key+1; ?> </td>
			    			    					<td><?PHP echo $data->employee_name2; ?></td>
			    				    				<td>
			    				    					<?PHP echo $data->employee_dept2; ?>
			    				    					<?php 
									    				if( $data->employee_dept_head_sts2 == 2 ) 
									    					{
									    						echo '[ Head ]'; 
									    					}
									    				?>
					    							</td>
			    				    				<td><?PHP echo $data->employee_desg2; ?></td>

			    				    				<td><?PHP echo $data->employee_leave_type2; ?></td>
			    				    				<td><?PHP echo $data->employee_leave_start2; ?></td>
			    				    				<td><?PHP echo $data->employee_leave_end2; ?></td>
			    				    				<td><?PHP echo $data->employee_leave_reason2; ?></td>
			    				    				<td>
			    				    					<?PHP 
				    				    				if($data->employee_current_status_from_dept_head2 == 2)
				    				    				{
				    				    					echo "<button class = 'btn btn-danger btn-sm' style = 'width:90px; margin-bottom:4px;'>Denied</button>";
				    				    				} 
				    				    				?>
			    				    					
			    				    				</td>
			    				    				<td><?PHP echo $data->employee_leave_requested_on2; ?></td>
			    				    				<td><?PHP echo $data->employee_leave_approved_denied_on2; ?></td>
			    				    				
			    				    				

			    				    				<td><?PHP echo $data->employee_official_mobile_no2; ?></td>
			    				    				<td><?PHP echo $data->employee_mail_12; ?></td>
			    				    				
			    				    				
			    									<td>
			    									<?PHP 
			    										$countSickLeave = $this->db->from('leaves')
			    										->where('leave_type', 'Sick Leave')
			    										->where('current_status_from_dept_head', 2)
			    										->where('employee_id', $data->employee_id2)
			    										->count_all_results();
			    									?>
			    									<?php echo $countSickLeave; ?>
			    									</td>
			    									<td>
			    									<?PHP 
			    										$countAnnualLeave = $this->db->from('leaves')
			    										->where('leave_type', 'Annual Leave')
			    										->where('current_status_from_dept_head', 2)
			    										->where('employee_id', $data->employee_id2)
			    										->count_all_results();
			    									?>
			    									<?php echo $countAnnualLeave; ?>
			    									</td>
			    									<td>
			    									<?PHP 
			    										$countCompensatoryLeave = $this->db->from('leaves')
			    										->where('leave_type', 'Compensatory Leave')
			    										->where('current_status_from_dept_head', 2)
			    										->where('employee_id', $data->employee_id2)
			    										->count_all_results();
			    									?>
			    									<?php echo $countCompensatoryLeave; ?>
			    									</td>
											</tr>

			    			    				<?php }
			    			    			}
			    			    		?>

	    	    				  </tbody>
	    	    				</table>
	    	    			</div>
		    				</div>
								
							<!-- -->
	    				</div>
						</div>		
				</div></div>
	    </section>


<?php include('footer.php'); ?>