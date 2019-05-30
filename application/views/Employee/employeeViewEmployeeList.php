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
	    				  ['class'=>'list-group-item list-group-item-action']); ?>

	    					<?php
	    					}
	    					?>

	    				  <?php echo anchor('UserController/employeeApplyLeave', 
	    				  '<span><i class="fas fa-coffee"></i></span> Apply for Leave  <span class="badge badge-secondary float-right m-1"><i class="fas fa-exclamation"></i></span>', 
	    				  ['class'=>'list-group-item list-group-item-action']); ?>


	    				  <?php echo anchor('UserController/employeeViewEmployeeList', 
	    				  '<span><i class="fas fa-list-alt"></i></span> Employee List <span class="badge badge-secondary float-right m-1">70</span>', 
	    				  ['class'=>'list-group-item list-group-item-action active main-color-bg']); ?>

	    				</div>
	    			</div>	

	    			<div class="col-md-9">
	    				<div class="card">
	    				  
	    				    <h5 class="card-header main-color-bg">Leave Requests</h5>

	    				    <div class="card-body">
	    				    	<div class="row" style="text-align: center;">
	    				    		
	    				    	</div>
	    				    	</div>
	    				  </div>
	    				</div>


	    				
	    			</div>		

	    			

	    		</div>
	    	</div>
	    </section>


<?php include('footer.php'); ?>