<?php include('header.php'); ?>

<section id="breadcrump">
	    	<div class="container-fluid">
	    		<ol class="breadcrumb">
	    			<li class="breadcrumb-item breadcrumb-item active"><a href="#">Dashboard</a></li>
	    			    <li class="breadcrumb-item">Library</li>
	    			    <li class="breadcrumb-item">Add Employee</li>
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
	    				  ['class'=>'list-group-item list-group-item-action active main-color-bg']); ?>

	    				  <?php echo anchor('AdminController/adminLeaveRequest', 
	    				  '<span><i class="fas fa-coffee"></i></span> Leave Requests <span class="badge badge-secondary float-right m-1">'.$leaveReqPendingCountBadge.'</span>', 
	    				  ['class'=>'list-group-item list-group-item-action']); ?>

	    				  <?php echo anchor('AdminController/adminEmployeeList', 
	    				  '<span><i class="fas fa-list-alt"></i></span> Employee List <span class="badge badge-secondary float-right m-1">'.$employeeCountBadge.'</span>', 
	    				  ['class'=>'list-group-item list-group-item-action']); ?>

	    				  <?php echo anchor('AdminController/adminAddDepartmentDesignation', 
	    				  '<span><i class="fas fa-layer-group"></i></span> Add New Department Designation', ['class'=>'list-group-item list-group-item-action']); ?>
	    				</div>
	    			</div>	

	    			<div class="col-md-9">
	    				<div class="card">
	    				  
	    				    <h5 class="card-header main-color-bg"><i class="fas fa-plus"></i> Add New Employee</h5>

	    				    <div class="card-body">
	    				    <?php echo form_open('AdminController/addEmployee'); ?> 
	    				    	<div class="row" style="text-align: center;">
									
			    				    <div class="col-md-3" style="margin-top: 5px;">
			    				    	<p>Employee Name</p> 
			    				    </div>
			    				    <div class="col-md-7" style="margin-top: 5px;">
			    				    	<?php echo form_input(['name'=>'empname','class'=>'form-control',  'placeholder'=>'Name' , 'required'=>'required']); ?>
			    				    </div>
			    				    <div class="col-md-3" style="margin-top: 5px;">
			    				    	<label for="department">Department</label>
			    				    </div>
			    				    <div class="col-md-7" style="margin-top: 5px;">
			    				    	
			    				    	    <select class="form-control" id="department" name="empdept">
			    				    	        		<?php if (count($deptdata))
			    				    	        		{ 
			    				    	      				foreach ($deptdata as $key => $data )
			    				    	      				{ 
			    				    	      					echo "<option value=$data->id"; 
			    				    	      					echo set_select('empdept', $data->id); ?> 
			    				    	      					>
			    				    	      					<?php echo $data->department_name; ?>
			    				    	      					<?php echo "</option>";
			    				    	      				}
			    				    	      			}
			    				    	      			?>
			    				    	      
			    				    	    </select>
			    				    </div>	
			    				    <div class="col-md-3" style="margin-top: 5px;">
			    				    	<label for="designation">Designation</label>
			    				    </div>
			    				    <div class="col-md-7" style="margin-top: 5px;">
			    				    	
			    				    	    <select class="form-control" id="designation"  name="empdesignation">
			    				    	        		<?php if (count($desigdata))
			    				    	        		{ 
			    				    	      				foreach ($desigdata as $kkey => $ddata )
			    				    	      				{ 
			    				    	      					echo "<option value=$ddata->id"; 
			    				    	      					echo set_select('empdesignation', $ddata->id); ?> 
			    				    	      					>
			    				    	      					<?php echo $ddata->designation_name; ?>
			    				    	      					<?php echo "</option>";
			    				    	      				}
			    				    	      			}
			    				    	      			?>
			    				    	    </select>
			    				    </div>
			    				    <div class="col-md-3" style="margin-top: 5px;">
			    				    	<p>Phone</p> 
			    				    </div>
			    				    <div class="col-md-7" style="margin-top: 5px;">
			    				    	<?php echo form_input(['name'=>'empnumber', 'type'=>'number', 'class'=>'form-control', 'placeholder'=>'Phone' , 'required'=>'required']); ?>
			    				    </div>			
			    				    <div class="col-md-3" style="margin-top: 5px;">
			    				    	<p>Email</p> 
			    				    </div>
			    				    <div class="col-md-7" style="margin-top: 5px;">
			    				    	<?php echo form_input(['name'=>'empemail', 'type'=>'email', 'class'=>'form-control', 'placeholder'=>'Email' , 'required'=>'required']); ?>
			    				    	
			    				    </div>	
			    				    <div class="col-md-3" style="margin-top: 5px;">
			    				    	<p>Password</p> 
			    				    </div>
			    				    <div class="col-md-7" style="margin-top: 5px;">
			    				    	<?php echo form_password(['name'=>'emppass','class'=>'form-control', 'placeholder'=>'Enter password', 'value'=>'1234', 'required'=>'required']); ?>
			    				    </div>	
									<div class="col-md-3" style="margin-top: 5px;">
			    				    	<p>Joining Date</p> 
			    				    </div>
			    				    <div class="col-md-7" style="margin-top: 5px;">
			    				    	<?php echo form_input(['name'=>'empjoindate', 'type'=>'date', 'class'=>'form-control', 'placeholder'=>'Date' , 'required'=>'required']); ?>

			    				    </div>

			    				    <div class="col-md-3" style="margin-top: 5px;">
			    				    	<label for="designation">Role</label>
			    				    </div>
			    				    <div class="col-md-4" style="margin-top: 5px;">
			    				    	
			    				    	    <select class="form-control" id="role"  name="emprole">
			    				    	        		
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
			    				    		<div class="col-md-3 form-check" style="color:#BD3A3A;">
			    				    			<?php
			    				    			$data = array(
			    				    			        'name'          => 'head',
			    				    			        'value'         => 1,
			    				    			        'checked'       => FALSE,
			    				    			        'style'         => 'margin:15px'
			    				    			);

			    				    			echo form_checkbox($data);
			    				    			echo 'Assign Dept. Head';
			    				    			?>
													
			    				    			       
			    				    			     
			    				    	    </div>



											<div class="col-md-12" style="margin-top: 15px;">
												    <?php echo form_submit(['name'=>'submit','value'=>'Add Employee','class'=>'btn btn-primary', 'style'=>'background-color: #6d7da5; border-color: #6d7da5;']);
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
	    </section>


<?php include('footer.php'); ?>