<?php include('header.php'); ?>


<section id="breadcrump">
	    	<div class="container-fluid">
	    		<ol class="breadcrumb">
	    			<li class="breadcrumb-item breadcrumb-item active"><a href="#">Dashboard</a></li>
	    			    <li class="breadcrumb-item">Library</li>
	    			    <li class="breadcrumb-item">New Dept & Desg</li>
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
	    				  '<span><i class="fas fa-coffee"></i></span> Leave Requests <span class="badge badge-secondary float-right m-1">'.$leaveReqPendingCountBadge.'</span>', 
	    				  ['class'=>'list-group-item list-group-item-action']); ?>

	    				  <?php echo anchor('AdminController/adminEmployeeList', 
	    				  '<span><i class="fas fa-list-alt"></i></span> Employee List <span class="badge badge-secondary float-right m-1">'.$employeeCountBadge.'</span>', 
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
	    				  
	    				<!--   <h5 class="card-header main-color-bg">Departments & Designations Table</h5> -->
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
	    				      		<?php echo form_submit(['name'=>'submit','value'=>'Add','class'=>'btn btn-primary btn-sm', 'style'=>'display: block;  width:90px;']);?> <!-- <i class="fas fa-plus" style="color: #DCDCDC;"></i>-->
	    				      			
	    				      </th>
	    				      <td><?php echo form_input(['name'=>'dept','class'=>'form-control', 'required'=>'required']); ?></td>
	    				      <?php echo form_close(); ?>
	    				    </tr>

	    				      		<?php if (count($deptdata))
	    				      		{ 
	    				    				foreach ($deptdata as $key => $data )
	    				    				{ 
	    				    					?>
	    				    					<tr style='height: 50px;' >
	    				    						<td>
	    				    						<?php echo $key+1; ?>
	    				    						</td>
	    				    						<td>
	    				    						<?php echo $data->department_name; ?>
	    				    						<!--
	    				    						<span class="float-right">
	    				    							<i class='fas fa-edit' style='color: #404087;' data-toggle="modal" data-target="#Department<?php echo $data->id; ?>" data-whatever="@getbootstrap"></i>
	    				    							&nbsp;
	    				    							<i class="fas fa-trash-alt" style="color: #F36565;" onclick="deptDelete(<?php echo $data->id;?>)"></i>
	    				    						</span>
	    				    					-->
	    				    						</td>
	    				    					</tr>
	    				    					


	    				    					<!-- modal -->
	    				      	<div class="modal fade" id="Department<?php echo $data->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    				      	  <div class="modal-dialog" role="document">
	    				      	    <div class="modal-content">
	    				      	      <div class="modal-header">
	    				      	        <h5 class="modal-title" id="exampleModalLabel">Edit Department</h5>
	    				      	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	    				      	          <span aria-hidden="true">&times;</span>
	    				      	        </button>
	    				      	      </div>
	    				      	      <div class="modal-body">
	    				      	        <?php echo form_open('AdminController/EditedNotice') ?>
	    				      	        <input type="hidden" name="nid" value="<?php echo $data->id;?>" />
	    				      	          <div class="form-group">
	    				      	            <label for="recipient-name" class="col-form-label">Name</label>
	    				      	            <input type="text" name="nt" class="form-control" id="recipient-name" value="<?php echo $data->department_name;?>">
	    				      	          </div>
	    				      	        
	    				      	      </div>
	    				      	      <div class="modal-footer">
	    				      	      	<?php echo form_submit(['name'=>'submit','value'=>'Post','class'=>'btn btn-info', 'style'=>'margin:8px; background-color: #6d7da5; border-color: #6d7da5;']); ?>
	    				      	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	    				      	        <?php echo form_close(); ?>
	    				      	      </div>
	    				      	    </div>
	    				      	  </div>
	    				      	</div>
	    				      	<!-- modal -->
	    				      				<?php	

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
	    				      		<?php echo form_submit(['name'=>'submit','value'=>'Add','class'=>'btn btn-primary btn-sm', 'style'=>'display: block;  width:90px;']);?> <!--<i class='fas fa-plus' style="color: #DCDCDC"></i>-->
	    				      			
	    				      </th>
	    				      <td><?php echo form_input(['name'=>'desg','class'=>'form-control', 'required'=>'required']); ?></td>
	    				      <?php echo form_close(); ?>
	    				    </tr>

	    				      		<?php if (count($desigdata))
	    				      		{ 
	    				    				foreach ($desigdata as $kkey => $ddata )
	    				    				{ 
	    				    					?>
	    				    					<tr>
	    				    						<td style='height: 50px;'>
	    				    						<?php echo $kkey+1; ?>
	    				    						</td>
	    				    						<td>
	    				    						<?php echo $ddata->designation_name; ?>
	    				    						<!--
	    				    						<span class="float-right">
	    				    							<i class='fas fa-edit' style='color: #404087;' data-toggle="modal" data-target="#Designations<?php echo $ddata->id; ?>" data-whatever="@getbootstrap"></i>
	    				    							&nbsp;
	    				    							<i class="fas fa-trash-alt" style="color: #F36565;" onclick="desgDelete(<?php echo $ddata->id;?>)"></i>
	    				    						</span>
	    				    					-->
	    				    						</td>
	    				    					</tr>

	    				    					<!-- modal -->
	    				      	<div class="modal fade" id="Designations<?php echo $ddata->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    				      	  <div class="modal-dialog" role="document">
	    				      	    <div class="modal-content">
	    				      	      <div class="modal-header">
	    				      	        <h5 class="modal-title" id="exampleModalLabel">Edit Designation</h5>
	    				      	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	    				      	          <span aria-hidden="true">&times;</span>
	    				      	        </button>
	    				      	      </div>
	    				      	      <div class="modal-body">
	    				      	        <?php echo form_open('AdminController/EditedNotice') ?>
	    				      	        
	    				      	        <input type="hidden" name="nid" value="<?php echo $ddata->id;?>" />
	    				      	          <div class="form-group">
	    				      	            <label for="recipient-name" class="col-form-label">Name</label>
	    				      	            <input type="text" name="nt" class="form-control" id="recipient-name" value="<?php echo $ddata->designation_name;?>">
	    				      	          </div>
	    				      	        
	    				      	      </div>
	    				      	      <div class="modal-footer">
	    				      	      	<?php echo form_submit(['name'=>'submit','value'=>'Post','class'=>'btn btn-info', 'style'=>'margin:8px; background-color: #6d7da5; border-color: #6d7da5;']); ?>
	    				      	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	    				      	        <?php echo form_close(); ?>
	    				      	      </div>
	    				      	    </div>
	    				      	  </div>
	    				      	</div>
	    				      	<!-- modal -->
	    				    					
							    				    <?php
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

	   				 <script type="text/javascript">
	    					
	    					function deptDelete(id){
	    						var r = confirm("Are you sure you want to delete this notice?");
    								if (r == true) 
    								{
    								 window.location.pathname="CI_HRM/index.php/AdminController/adminDeleteNotice/"+id+"";
    								} 
    								else 
    								{
    								 	// window.location.pathname="CI_HRM/index.php/AdminController/adminDashboard";
    								}
	    					}
	    					function desgDelete(id){
	    						var r = confirm("Are you sure you want to delete this notice?");
    								if (r == true) 
    								{
    								 window.location.pathname="CI_HRM/index.php/AdminController/adminDeleteNotice/"+id+"";
    								} 
    								else 
    								{
    								 	// window.location.pathname="CI_HRM/index.php/AdminController/adminDashboard";
    								}
	    					}
	    					
	    				</script> 


<?php include('footer.php'); ?>
