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
	    				<div class="list-group" style="margin-bottom: 15px;">
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
	    				  ['class'=>'list-group-item list-group-item-action']); ?>

	    				  <?php echo anchor('AdminController/adminAddDepartmentDesignation', 
	    				  '<span><i class="fas fa-layer-group"></i></span> Add New Department Designation', ['class'=>'list-group-item list-group-item-action  active main-color-bg']); ?>
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
	    				  
	    				   <h5 class="card-header main-color-bg">Departments & Designations Table</h5>
							<div class="card-body">
							<div class="row">
								<div class="col-md-6">
								
								<div style="margin-top: 10px;">

	    				<!--	<h4 style="text-align: center; margin-bottom: 15px;">All Departments</h4> -->
	    				<table class="table table-hover table-bordered table-striped">
	    				  
	    				  <thead class="main-color-bg">
	    				    <tr>
	    				      <th scope="col">#</th>
	    				      <th scope="col">Departments</th>
	    				    </tr>
	    				  </thead>
	    				  <tbody>
	    				    <tr>
	    				    <?php echo form_open('AdminController/adminAddNewDepartment'); ?>
	    				      <th scope="row">
	    				      		<?php echo form_submit(['name'=>'submit','value'=>'Add','class'=>'btn btn-primary btn-sm', 'style'=>'display: block;  width:90px;']);?> <i class="fas fa-plus" style="color: #DCDCDC;"></i>
	    				      			
	    				      </th>
	    				      <td><?php echo form_input(['name'=>'dept','class'=>'form-control', 'required'=>'required']); ?></td>
	    				      <?php echo form_close(); ?>
	    				    </tr>

	    				      		<?php if (count($deptdata))
	    				      		{ 
	    				    				foreach ($deptdata as $key => $data )
	    				    				{ 
	    				    					echo "<tr>
	    				    						<td>";
	    				    						echo $key+1;
	    				    						echo "</td>
	    				    						<td>$data->department_name</td>
	    				    					</tr>";	    				    				
	    				    				}
	    				    			}
	    				    		?>
	    				  </tbody>
	    				</table>
	    				 
	    			</div>
				</div>

				<div class="col-md-6">
										

	    		<div style="margin-top: 10px;">

				<!--	<h4 style="text-align: center; margin-bottom: 15px;">All Designations</h4> -->
				<table class="table table-hover table-bordered table-striped">
				  
				  <thead class="main-color-bg">
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Designations</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
	    				    <?php echo form_open('AdminController/adminAddNewDesignation'); ?>
	    				      <th scope="row">
	    				      		<?php echo form_submit(['name'=>'submit','value'=>'Add','class'=>'btn btn-primary btn-sm', 'style'=>'display: block;  width:90px;']);?> <i class='fas fa-plus' style="color: #DCDCDC"></i>
	    				      			
	    				      </th>
	    				      <td><?php echo form_input(['name'=>'desg','class'=>'form-control', 'required'=>'required']); ?></td>
	    				      <?php echo form_close(); ?>
	    				    </tr>

	    				      		<?php if (count($desigdata))
	    				      		{ 
	    				    				foreach ($desigdata as $kkey => $ddata )
	    				    				{ 
	    				    					echo "<tr>
							    				    	<td>";
							    				    	echo $kkey+1;
							    				    	echo "</td>
							    				    	<td>$ddata->designation_name</td>
							    				    </tr>";
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

		

	</div>
	    	
	    </section>


<?php include('footer.php'); ?>
