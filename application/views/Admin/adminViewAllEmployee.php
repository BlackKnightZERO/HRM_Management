<?php include('header.php'); ?>


<section id="breadcrump">
	    	<div class="container-fluid">
	    		<ol class="breadcrumb">
	    			<li class="breadcrumb-item breadcrumb-item active"><a href="#">Dashboard</a></li>
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
	    				  <?php echo anchor('AdminController/adminDashboard','<span><i class="fas fa-tachometer-alt"></i></span>
	    				    Dashboard', ['class'=>'list-group-item list-group-item-action']); ?>

	    				  <?php echo anchor('AdminController/adminAddEmployee', 
	    				  '<span><i class="fas fa-user"></i></span> Add Employee', 
	    				  ['class'=>'list-group-item list-group-item-action']); ?>

	    				  <?php echo anchor('AdminController/adminLeaveRequest', 
	    				  '<span><i class="fas fa-coffee"></i></span> Leave Requests <span class="badge badge-secondary float-right m-1">12</span>', 
	    				  ['class'=>'list-group-item list-group-item-action']); ?>

	    				  <?php echo anchor('AdminController/adminEmployeeList', 
	    				  '<span><i class="fas fa-list-alt"></i></span> Employee List <span class="badge badge-secondary float-right m-1">70</span>', 
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
	    				  
	    				    <h5 class="card-header main-color-bg text-center">View All Employees</h5>

	    				 <div class="table-responsive">
	    				<table class="table table-hover table-bordered table-striped">
	    				  
	    				  <thead>
	    				    <tr>
	    				      <th scope="col">#</th>
	    				      <th scope="col">Name</th>
	    				      <th scope="col">Department</th>
	    				      <th scope="col">Designation</th>
	    				      <th scope="col">Phone</th>
	    				      <th scope="col">Email</th>
	    				      <th scope="col">Joining</th>
	    				      <th scope="col">Birthday</th>
	    				      <th scope="col">Blood Grp</th>
	    				      <th scope="col">Sick Leave</th>
	    				      <th scope="col">Annual Leave</th>
	    				      <th scope="col">Compensatory Leave</th>
	    				      <th scope="col">Action</th>
	    				    </tr>
	    				  </thead>
	    				  <tbody>

			      		<?php if (count($empdata))
			      		{ 
			    				foreach ($empdata as $key => $data )
			    				{ ?>

			    					
			    					<tr> 
			    					<td> <?PHP echo $key+1; ?> </td>
			    					<td><?PHP echo $data->employee_name; ?></td>
				    				<td><?PHP echo $data->employee_dept; ?>
				    				<?php 
				    				if( $data->employee_dept_head_sts == 1 ) 
				    					{
				    						echo '[ Head ]'; 
				    					}
				    				?>
				    				</td>
				    				<td><?PHP echo $data->employee_desg; ?></td>
				    				<td><?PHP echo $data->employee_official_mobile_no; ?></td>
				    				<td><?PHP echo $data->employee_mail_1; ?></td>
				    				<td><?PHP echo $data->employee_join_date; ?></td>
				    				<td><?PHP echo $data->employee_date_of_birth; ?></td>
				    				<td><?PHP echo $data->employee_blood_grp;	 ?></td>
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
										
								         <?php echo anchor("AdminController/adminViewEmployee/{$data->employee_id}", 'View', ['class'=>'btn btn-primary btn-sm', 'style'=>'width:90px; margin-bottom:4px;']); ?>
								         <?php echo anchor("AdminController/adminUpdateEmployee/{$data->employee_id}", 'Update', ['class'=>'btn btn-warning btn-sm', 'style'=>'width:90px; margin-bottom:4px;']); ?>
								         
										<input class="btn btn-danger btn-sm" type="button" value="Delete" style="width:90px;" onclick="myFun(<?php echo $data->employee_id?>)">
									</td>

									</tr>

			    				<?php }
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
	function myFun(id)
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