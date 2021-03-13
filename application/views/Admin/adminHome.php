<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
	    				    Dashboard', ['class'=>'list-group-item list-group-item-action active main-color-bg']); ?>

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
	    				  
	    				    <h5 class="card-header main-color-bg">Notifications</h5>

	    				    <div class="card-body">
	    				    	<div class="row" style="text-align: center;">
	    				    		<div class="col-lg-3 col-md-3 col-sm-12 col-12">
	    				    			<div class="card card-body bg-light" style="height: 150px;">

	    				    			<?php	
	    				    			$today = date('m-d'); 
	    				    			$countBirthday = 0;
	    				    			foreach ($birthdayTodaydata as $key => $value) {
	    				    				$rest = substr($value->employee_bd, -5);
	    				    				if($rest == $today)
	    				    				{
	    				    					$countBirthday++;	
	    				    				}
	    				    			}
	    				    			?>

											<a href="" data-toggle="modal" data-target="#birthdayModal" style="text-decoration: none; color: #333333; margin-top: 8px;">
	    				    			     <h2><span><i class="fas fa-birthday-cake"></i></i></span><?php echo $countBirthday;?></h2>
	    				    			     <h5>Birthdays</a></h5>
	    				    			     </div>
	    				    		</div>

	    					 <!--MODAL -->
							 <div class="modal fade" id="birthdayModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6" aria-hidden="true">
							   <div class="modal-dialog" role="document">
							     <div class="modal-content">
							       <div class="modal-header">
							         <h5 class="modal-title" id="exampleModalLabel6" style="color: #6d7da5;">Today's Birthday <span><i class="fas fa-birthday-cake"></i></span></h5>
							         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							           <span aria-hidden="true">&times;</span>
							         </button>
							       </div>
							       <div class="modal-body">
							         <!-- Media  -->
							         
							         <?php 
							         $today = date('m-d'); 
							         foreach ($birthdayTodaydata as $key2 => $value2) 
							         {
    				    				$rest = substr($value2->employee_bd, -5);
    				    				if($rest == $today)
    				    				{
    				    					$q = $this->db->select('employee.name as en,
    				    						department.department_name as employee_dept,
												designation.designation_name as employee_desg, 
												employee.profile_pic_path as employee_profile_pic
    				    						')
    				    					->from('employee')
											->join('department','employee.department_id=department.id')
											->join('designation', 'employee.designation_id = designation.id')
											->where('employee.id', $value2->employee_id)
											->get();  
											$row2 = $q->row();

											if(isset($row2))
											{ 
											?>
									        	 <div class="media">
									           <img class="mr-3" src="<?php echo $row2->employee_profile_pic; ?>" alt="" style="height: 80px; width: 80px;">

									           <div class="media-body">
									             <h5 class="mt-0" style="text-align: left;"><?php echo $row2->en; ?> <span class="float-right"><i class="fas fa-gift" style="color: #6d7da5;"></i></span></h5>
									            
									             <h6 class="mt-0" style="text-align: left;"><?php echo $row2->employee_desg; ?></h6>
									              <h6 class="mt-0" style="text-align: left;"><?php echo $row2->employee_dept; ?></h6>
									           </div>
									           </div>
									           <hr>
							            <?php 
							       			 } } }
							       		 ?>

							         <!-- Media -->
							       </div>
							       <div class="modal-footer">
							         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							       </div>
							     </div>
							   </div>
							 </div>
							 <!--MODAL -->

	    				    		<div class="col-lg-3 col-md-3 col-sm-12 col-12">
	    				    			<div class="card card-body bg-light" style="height: 150px;">
	    				    				
	    				    				<?php 
											$countLeaveData=0;
											
	    				    				foreach ($onLeaveTodaydata as $key => $value) 
	    				    				{
	    				    					$countLeaveData++;

	    				    				}

	    				    				?>


	    				    				<a href="" data-toggle="modal" data-target="#leaveModal" style="text-decoration: none; color: #333333; margin-top: 8px;">
	    				    			     <h2><span><i class="fas fa-bell"></i></span><?php echo $countLeaveData; ?></h2>
	    				    			     <h5>On Leave Today</a> </h5>
	    				    			</div>
	    				    		</div>


	    				    		 <!--MODAL -->
							 <div class="modal fade" id="leaveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel7" aria-hidden="true">
							   <div class="modal-dialog" role="document">
							     <div class="modal-content">
							       <div class="modal-header">
							         <h5 class="modal-title" id="exampleModalLabel7" style="color: #6d7da5;">On Leave Today <span><i class="fas fa-sign-out-alt"></i></span></h5>
							         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							           <span aria-hidden="true">&times;</span>
							         </button>
							       </div>
							       <div class="modal-body">
							         <!-- Media  -->
							         	
							         	<?php 

							         	foreach ($onLeaveTodaydata as $key5 => $value5) 
							         	{

							         		$q5 = $this->db->select('employee.name as en5,
    				    						department.department_name as employee_dept5,
												designation.designation_name as employee_desg5, 
												employee.profile_pic_path as employee_profile_pic5
    				    						')
    				    					->from('employee')
											->join('department','employee.department_id=department.id')
											->join('designation', 'employee.designation_id = designation.id')
											->where('employee.id', $onLeaveTodaydata[$key5])
											->get();  


											?>

											 <div class="media">
									           <img class="mr-3" src="<?php echo $q5->row()->employee_profile_pic5; ?>" alt="" style="height: 80px; width: 80px;">

									           <div class="media-body">
									             <h5 class="mt-0" style="text-align: left;"><?php echo $q5->row()->en5; ?> <span class="float-right"><i class="fas fa-door-open"></i></span></h5>
									            
									             <h6 class="mt-0" style="text-align: left;"><?php echo $q5->row()->employee_desg5; ?></h6>
									              <h6 class="mt-0" style="text-align: left;"><?php echo $q5->row()->employee_dept5; ?></h6>
									           </div>
									           </div>
									           <hr>

											<?php } ?>

							         			
							        
							         <!-- Media -->
							       </div>
							       <div class="modal-footer">
							         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							       </div>
							     </div>
							   </div>
							 </div>
							 <!--MODAL -->

							 		<?php 
									$countAttData=0;
									if(count($attendances)>0){

									
				    				foreach($attendances as $key => $value) 
				    				{
				    					$countAttData++;

				    				}
								}
				    				?>

	    				    		<div class="col-lg-3 col-md-3 col-sm-12 col-12">
	    				    			<div class="card card-body bg-light" style="height: 150px;">
												<a href="" data-toggle="modal" data-target="#attendaceModal" style="text-decoration: none; color: #333333; margin-top: 8px;">
	    				    			     <h2><span><i class="fas fa-chart-line"></i></span><?php echo $countAttData;?></h2>
	    				    			     <h5>Attendance</a></h5>
	    				    			</div>
	    				    		</div>

	    				    		<!--MODAL -->
							 <div class="modal fade" id="attendaceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel7" aria-hidden="true">
							   <div class="modal-dialog" role="document">
							     <div class="modal-content">
							       <div class="modal-header">
							         <h5 class="modal-title" id="exampleModalLabel7" style="color: #6d7da5;">Today's Attendance <span><i class="fas fa-sign-out-alt"></i></span></h5>
							         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							           <span aria-hidden="true">&times;</span>
							         </button>
							       </div>
							       <div class="modal-body">
							       	<div class="media-body">
									 <?php 
									 if(count($attendances)>0){
							         foreach ($attendances as $key => $value) { ?>
							         
							         <h5 style="text-align: left;"><?php echo $key+1 .'. '. $value->name .' - dept : '. $value->department_name ?></h5>
							         <?php	
							         }}
							         ?>
							       </div>
							   </div>
							       <div class="modal-footer">
							         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							       </div>
							     </div>
							   </div>
							 </div>


	    				    		<div class="col-lg-3 col-md-3 col-sm-12 col-12">
	    				    			<div class="card card-body bg-light" style="height: 150px;">
	    				    				<a href="#" style="text-decoration: none; color: #333333; margin-top: 8px;">
	    				    			     <h2><span><i class="fas fa-comment"></i></span>2</h2>
	    				    			     <h5>Chat</a></h5>
	    				    			</div>
	    				    		</div>
	    				    	</div>
	    				  </div>
	    				</div>

	    				<script type="text/javascript">
	    					
	    					function postDelete(id){
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


	    				<div style="margin-top: 25px;">

	    				<h4 style="text-align: center; margin-bottom: 18px;">Notice Posts <span><i class="fas fa-sort-amount-down"></i></span> </h4>
	    				<table class="table table-hover table-bordered table-striped table-responsive">
	    				  
	    				  <thead class="main-color-bg">
	    				    <tr style="text-align: center;">
	    				      <th scope="col">#</th>
	    				      <th scope="col">Title</th>
	    				      <th scope="col">By</th>
	    				      <th scope="col">Details</th>
	    				      <th scope="col" style="min-width: 115px;">Date</th>
	    				      <th scope="col" style="min-width:75px;">Action</th>
	    				      <th scope="col" style="min-width:50px;"><i class='far fa-thumbs-up'></i></th>
	    				    </tr>
	    				  </thead>
	    				  <tbody>


	    				  	<?php 
	    				  	$count=0;
	    				  	if (count($noticetabledata)): ?>
	    				  	<?php foreach ($noticetabledata as $key => $data ): ?>
	    				    <tr>
	    				      <th scope="row"><?php echo $key+1; ?></th>
	    				      <td><?php echo $data->nt; ?></td>
	    				      <td><?php echo $data->an; ?></td>
	    				      <td><?php echo $data->nd; ?></td>
	    				      <td><?php echo $data->npd; ?></td>
	    				      <td>
	    				      	<span onclick="postEdit(<?php echo $data->nid;?>)" data-toggle="modal" data-target="#<?php echo $data->nid; ?>" data-whatever="@getbootstrap"><i class="fas fa-edit" style="color: #272657;"></i></span> &nbsp;
	    				      	<!-- modal -->
	    				      	<div class="modal fade" id="<?php echo $data->nid; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    				      	  <div class="modal-dialog" role="document">
	    				      	    <div class="modal-content">
	    				      	      <div class="modal-header">
	    				      	        <h5 class="modal-title" id="exampleModalLabel">Edit Notice</h5>
	    				      	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	    				      	          <span aria-hidden="true">&times;</span>
	    				      	        </button>
	    				      	      </div>
	    				      	      <div class="modal-body">
	    				      	        <?php echo form_open('AdminController/EditedNotice') ?>
	    				      	        <input type="hidden" name="nid" value="<?php echo $data->nid;?>" />
	    				      	          <div class="form-group">
	    				      	            <label for="recipient-name" class="col-form-label">Title</label>
	    				      	            <input type="text" name="nt" class="form-control" id="recipient-name" value="<?php echo $data->nt;?>">
	    				      	          </div>
	    				      	          <div class="form-group">
	    				      	            <label for="message-text" class="col-form-label">Description</label>
	    				      	            <textarea class="form-control" id="message-text" name="nd"><?php echo $data->nd;?></textarea>
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


	    				      	<span onclick="postDelete(<?php echo $data->nid;?>)"><i class="fas fa-trash-alt" style="color: #61282C;"></i></span>
							  </td>
							  <td>
							  	<?php
							  	
							  	$explode =	explode(',',$data->nli);

							  	?>
							  	<span data-toggle="modal" data-target="#Likes<?php echo $count; ?>"><i class="fas fa-eye" style="color: #245222;"></i></span>
							  </td>
							 <!--MODAL -->
							 <div class="modal fade" id="Likes<?php echo $count; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							   <div class="modal-dialog" role="document">
							     <div class="modal-content">
							       <div class="modal-header">
							         <h5 class="modal-title" id="exampleModalLabel" style="color: #6d7da5;">People who liked this post</h5>
							         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							           <span aria-hidden="true">&times;</span>
							         </button>
							       </div>
							       <div class="modal-body">
							         <!-- Media  -->
							         
							           	<?php 
							           	for($i=1;$i<sizeof($explode);$i++)
							           	{
							           		$query = $this->db->select('profile_pic_path, name')
							           				 ->where('id',$explode[$i])
							           				 ->get('Employee');
							           		$row = $query->row();		 
							           	?>	
							           
							        	<?php if(isset($row)){ ?>
							        	 <div class="media">
							           <img class="mr-3" src="<?php echo $row->profile_pic_path; ?>" alt="" style="height: 50px; width: 50px;">

							           <div class="media-body">
							             <h6 class="mt-0"><?php echo $row->name; ?><span class="float-right"><i class='far fa-thumbs-up'></i></span></h6>
							           </div>
							           </div>
							           <hr>
							            <?php 
							           $count++; 
							        	}} 
							        	?>
							         <!-- Media -->
							       </div>
							       <div class="modal-footer">
							         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							       </div>
							     </div>
							   </div>
							 </div>
							 <!--MODAL -->

	    				    </tr>

	    				    	<?php endforeach; ?>
	    				         <?php else: ?>
	    				          <tr>
	    				            <td>No Records Found!</td>
	    				          </tr>
	    				         <?php endif; ?>


	    				  </tbody>

	    				</table>
	    				</div>
	    			</div>		

	    			

	    		</div>
	    	</div>
	    </section>

	    <?php include('footer.php'); ?>