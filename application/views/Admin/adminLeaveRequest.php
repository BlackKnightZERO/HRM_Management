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
	    				  ['class'=>'list-group-item list-group-item-action active main-color-bg']); ?>

	    				  <?php echo anchor('AdminController/adminEmployeeList', 
	    				  '<span><i class="fas fa-list-alt"></i></span> Employee List <span class="badge badge-secondary float-right m-1">70</span>', 
	    				  ['class'=>'list-group-item list-group-item-action']); ?>

	    				  <?php echo anchor('AdminController/adminAddDepartmentDesignation', 
	    				  '<span><i class="fas fa-layer-group"></i></span> Add New Department Designation', ['class'=>'list-group-item list-group-item-action']); ?>
	    				</div>
	    			</div>	

	    			<div class="col-md-9">
	    				<div class="card">
	    				  
	    				    <h5 class="card-header main-color-bg">Leave Requests</h5>

	    				    <div class="card-body">
	    				    	<div class="row" style="text-align: center;">
	    				    		<div class="table-responsive">
    			    				<table class="table table-hover">
    			    				  
    			    				  <thead>
    			    				    <tr>
    			    				      <td scope="col" valign="top"><b>Sl</b></td>
    			    				      <td scope="col"valign="top"><b>Name</td>
    			    				      <td scope="col"valign="top"><b>Department</td>
    			    				      <td scope="col"valign="top"><b>Designation</td>
    			    				      <td scope="col"valign="top"><b>Start</td>
    			    				      <td scope="col"valign="top"><b>End</td>
    			    				      <td scope="col"valign="top"><b>Reason</td>
    			    				      <td scope="col"valign="top"><b>Approval Status</td>
    			    				      <td scope="col"valign="top"><b>Action</td>
    			    				    </tr>
    			    				  </thead>
    			    				  <tbody>
    			    				    <tr>
    			    				      <th scope="row">1</th>
    			    				      <td>Mark jekerberg</td>
    			    				      <td>Otto</td>
    			    				      <td>@mdo</td>
    			    				      <td>@mdo</td>
    			    				      <td>@mdo</td>
    			    				      <td>@mdo</td>
    			    				      <td>@mdo</td>
    			    				      <td>@mdo</td>
    			    				      <td></td>
    			    				    </tr>
    			    				    <tr>
    			    				      <th scope="row">2</th>
    			    				      <td>Jacob</td>
    			    				      <td>Thornton</td>
    			    				      <td>@fat</td>
    			    				    </tr>
    			    				    <tr>
    			    				      <th scope="row">3</th>
    			    				      <td colspan="2">Larry Bird</td>
    			    				      <td>@twitter</td>
    			    				    </tr>
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