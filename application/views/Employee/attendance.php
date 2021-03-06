<?php include('header.php'); ?>
<section id="breadcrump">
	    	<div class="container-fluid">
	    		<ol class="breadcrumb">
	    			<li class="breadcrumb-item breadcrumb-item active"><a href="#">Home</a></li>
	    			    <li class="breadcrumb-item">Library</li>
	    			    <li class="breadcrumb-item">Attendance</li>
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
	    				    Attendance', ['class'=>'list-group-item list-group-item-action active main-color-bg']);
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
	    				  ['class'=>'list-group-item list-group-item-action']); ?>


	    				  <?php echo anchor('UserController/employeeViewEmployeeList', 
	    				  '<span><i class="fas fa-list-alt"></i></span> Employee List <span class="badge badge-secondary float-right m-1">'.$employeeCountBadge.'</span>', 
	    				  ['class'=>'list-group-item list-group-item-action']); ?>

	    				</div>
	    			</div>	

	    			<div class="col-md-9">
	    				<div class="card">
	    				  
	    				    <h5 class="card-header main-color-bg"><span><i class="far fa-clock"></i></span> Attendance </h5>
	    				    <div class="card-body">
	    				    	<?php
	    				    	if($attendanceStatus == 1){
	    				    		echo anchor('UserController/clockIn','Clock In', ["class" => "btn btn-sm btn-success"]) .'&nbsp; &nbsp;'.
	    				    		anchor('UserController/clockOut','Clock Out', [ "class" => "btn btn-sm btn-success disabled"]);
	    				    	} else if ($attendanceStatus == 2){
	    				    		echo anchor('UserController/clockIn','Clock In', ["class" => "btn btn-sm btn-success disabled"]) .'&nbsp; &nbsp;'.
	    				    		anchor('UserController/clockOut','Clock Out', ["class" => "btn btn-sm btn-success"]);
	    				    	} else if ($attendanceStatus == 3){
	    				    		echo anchor('UserController/clockIn','Clock In', ["class" => "btn btn-sm btn-success disabled"]) .'&nbsp; &nbsp;'.
	    				    		anchor('UserController/clockOut','Clock Out', ["class" => "btn btn-sm btn-success disabled"]);
	    				    	} else {
	    				    		echo '';
	    				    	}
	    				    	?>
	    				    	<br>
	    				    	<br>
	    				    	<h5>Clocked In: 
	    				    	<?php if(isset($clock_in_out)){
	    				    		if(count($clock_in_out)>0){ echo $clock_in_out[0]->clock_in ; }
	    				    	} ?>	
	    				    	</h5>
	    				    	<h5>Clocked Out: 
	    				    	<?php if(isset($clock_in_out)){
	    				    		if(count($clock_in_out)>0){ echo $clock_in_out[0]->clock_out ; }
	    				    	}  ?>	
	    				    	</h5>
	    				    </div>		    				    
	    				</div>
	    				<br>
	    				<div class="card">
	    				  
	    				    <h5 class="card-header main-color-bg"><span><i class="far fa-calendar-alt"></i></span> Last 30 Attendances </h5>
	    				    <div class="card-body">
	    				    	<table class="table table-bordered table-hover">
	    				    		<tr>
	    				    			<th>
	    				    				Date
	    				    			</th>
	    				    			<th>
	    				    				Attendance
	    				    			</th>
	    				    		</tr>
	    				    		<?php if (count($attendances) > 0){ ?>
	    				    		<?php foreach ($attendances as $key => $value) {
	    				    			?>
	    				    		<tr>
	    				    			<td>
	    				    				<b><?php echo $value->date; ?></b></td>
	    				    			<td>In: <b><?php echo $value->clock_in; ?></b> | Out: <b><?php echo $value->clock_out; ?></b></td>
	    				    		</tr>	
	    				    		<?php	
	    				    		}
	    				    		?>
	    				    		<?php	
	    				    		} else {
	    				    		?>
	    				    		<tr>
	    				    			<td>No Data Found</td>
	    				    			<td>No Data Found</td>
	    				    		</tr>
	    				    		<?php
	    				    		}
	    				    		?>
	    				    	</table>

	    				    </div>		    				    
	    				</div>
	    			</div>
				</div>		
	    	</div>
	    </section>


<?php include('footer.php'); ?>