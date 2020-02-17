<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include('header.php'); ?>

<section id="breadcrump">
	    	<div class="container-fluid">
	    		<ol class="breadcrumb">
	    			<li class="breadcrumb-item breadcrumb-item active"><a href="#">Dashboard</a></li>
	    			    <li class="breadcrumb-item">Library</li>
	    			    <li class="breadcrumb-item">Update Password</li>
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
	    				  ['class'=>'list-group-item list-group-item-action']); ?>

	    				  <?php echo anchor('AdminController/adminAddDepartmentDesignation', 
	    				  '<span><i class="fas fa-layer-group"></i></span> Add New Department Designation', ['class'=>'list-group-item list-group-item-action']); ?>
	    				</div>
						<?php echo form_open('AdminController/adminPostNotice'); ?>
	    				<div class="card cardd">
						
	    					<h5 class="card-header main-color-bg">Post Notice</h5>
	    				  <div class="card-body">
	    				    <!-- <p class="card-text">post a notice</p> -->

	    				    <div class="form-group row">
	    				          <div class="col-sm-12 col-12">
	    				            <input type="text" class="form-control-plaintext" id="" 
	    				            name="noticetitle" placeholder="Title" required="required">
	    				          </div>
	    				        </div>

	    				    <textarea class="form-control" aria-label="With textarea" placeholder="Details" required="required" name="noticedescription" rows="3"></textarea> 
	    				 <!--   <textarea class="form-control" id="" rows="3"></textarea> -->
	    				  </div>
	    				  <!-- <input class="btn btn-primary" type="submit" value="Submit" style="margin:10px; background-color: #6d7da5; border-color: #6d7da5;"> -->
	    				  <?php echo form_submit(['name'=>'submit','value'=>'Post','class'=>'btn btn-primary', 'style'=>'margin:8px; background-color: #6d7da5; border-color: #6d7da5;']);
        					?>
							
	    				</div>
	    				<?php echo form_close(); ?>
	    			</div>	

	    			<div class="col-lg-9 col-md-9 col-sm-12 col-12">

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
	    				  
	    				    <h5 class="card-header main-color-bg">Admin Profile</h5>

	    				    <div class="card-body">
	    				    	<div class="row">

	    				    		<div class="col-md-3 col-lg-3 col-sm-12 col-12">
	    				    			<div class="m-3">
	    				    			<?php if (count($singleProfileInfo))
				    				  		{ 
			    								foreach ($singleProfileInfo as $key => $data )
			    								{
				    						?>
			    				    			<img src="<?php echo $data->employee_profile_pic; ?>" class="img-fluid img-thumbnail" style="margin-bottom: 3px;">

						    				<?php
					    						}
					    					}
						    				?>
	    				    			</div>
	    				    				<div class="list-group m-3" style="margin-left: 15px;">
	    				    				  <?php echo anchor('AdminController/adminUpdateInfo','<span><i class="fas fa-id-card-alt"></i></span>
	    				    				    My Profile', ['class'=>'list-group-item list-group-item-action']); ?>

	    				    				    <?php echo anchor('AdminController/adminUpdateAddUpdateInfo','<span><i class="fas fa-undo"></i></i></span>
	    				    				    Add/Update profile', ['class'=>'list-group-item list-group-item-action ']); ?>

	    				    				  <?php echo anchor('AdminController/adminChangePassword', 
	    				    				  '<span><i class="fas fa-key"></i></span> Change Password', 
	    				    				  ['class'=>'list-group-item list-group-item-action active main-color-bg']); ?>


	    				    				</div>


	    				    		</div>
	    				    		<div class="col-md-6 col-lg-6 col-sm-12 col-12 alert alert-secondary" style="margin-top: 17px;">

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

		    				    <?php echo form_open('AdminController/adminUpdateOwnPassword'); ?> 

		    				    	<div class="row" style="text-align: left;">
										
				    				    <div class="col-md-3" style="margin-top: 5px;">
				    				    	<p>Old Password</p> 
				    				    </div>
				    				    <div class="col-md-7" style="margin-top: 5px;">
				    				    	<?php echo form_password(['name'=>'oldpass','class'=>'form-control', 'required'=>'required']); ?>
				    				    </div>
				    				    <div class="col-md-3" style="margin-top: 5px;">
				    				    	<p>New Password</p> 
				    				    </div>
				    				    <div class="col-md-7" style="margin-top: 5px;">
				    				    	<?php echo form_password(['name'=>'newpass','class'=>'form-control', 'id'=>'newpass', 'required'=>'required', 'onkeyup'=>'checkPass()']); ?>
				    				    </div>
				    				    <div class="col-md-3" style="margin-top: 5px;">
				    				    	<p>Confirm Password</p> 
				    				    </div>
				    				    <div class="col-md-7" style="margin-top: 5px;">
				    				    	<?php echo form_password(['name'=>'confpass','class'=>'form-control', 'id'=>'confpass', 'required'=>'required', 'onkeyup'=>'checkPass()']); ?>
				    				    </div>

				    				    
				    				    


												<div class="col-md-12" style="margin-top: 15px; text-align:center;">
													    <?php echo form_submit(['name'=>'submit','value'=>'Update password','class'=>'btn btn-primary', 'style'=>'background-color: #6d7da5; border-color: #6d7da5;']);
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

	    			

	    		</div>
	    	</div>
	    </section>

	  
	    <script type="text/javascript">

	    	function checkPass() {
	    	  var x = document.getElementById("newpass");
	    	  var y = document.getElementById("confpass");

	    	  if(x.value == y.value && x.value!='' && y.value!='')
	    	  {
	    	  	alert('Password Matched!');
	    	  } 
	    	  
	    	}

	    	
	    </script>

<?php include('footer.php'); ?>