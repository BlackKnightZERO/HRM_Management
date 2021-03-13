<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
	    				    Home', ['class'=>'list-group-item list-group-item-action active main-color-bg']); ?>

	    				    <?php echo anchor('UserController/employeeUpdateInfo','<span><i class="fas fa-pen-nib"></i></span>
	    				    Update Info', ['class'=>'list-group-item list-group-item-action']); ?>

	    				    <?php 
	    				    echo anchor('UserController/attendanceToday', '<span><i class="far fa-clock"></i></span>
	    				    Attendance', ['class'=>'list-group-item list-group-item-action']);
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
	    				  
	    				    <h5 class="card-header main-color-bg"> Admin Posts</h5>

	    				    <div class="card-body">
	    				    	<div class="row" style="text-align: center;">
	    				    		
	    				    		<?php if (count($noticetabledata))
	    				    		{ 
	    				  				foreach ($noticetabledata as $key => $data )
	    				  				{ 
	    				  					$checkvar = 0;
	    				  					echo "<hr/>";
	    				  					echo "<br/>";
	    				  			     // echo "<div style='background: orange'>postnumber->$key</div>";
	    				  			     echo "<div class='media container-fluid'>
		    				    		  <img src='";?><?php echo $data->epp; ?>
		    				    		  <?php echo "' class='mr-3' alt='...' style='width: 60px; height: 65px;'>
		    				    		  <div class='media-body'>
			    				    		    <h5 class='mt-0' style='text-align: left;'>"; ?>
			    				    		    <?php echo $data->nt; ?>
			    				    		    <?php echo "</h5>

			    				    		    <h6 class='mt-0' style='text-align: left; color: #686868;'>"; ?>
			    				    		    <?php echo $data->ename; ?>
			    				    		    <?php echo "(";?>
			    				    		    <?php echo $data->ndate; ?>
			    				    		    <?php echo ")";?>
			    				    			<?php echo "</h6>"; ?>
			    				    		 	<?php echo "<p style='text-align: left;'>"; ?>
			    				    		 	<?php echo $data->nd; ?>
	    				    		 	
	    				    		    <?php echo "</p><div>"; ?>

	    				    		<?php 
	    				    		$queryResult = $data->nlk;
	    				    	//	echo "<br>";
	    				    	//	echo "<div style='background: blue'>all->likes->$queryResult</div>";
	    				    	//	echo "<br>"; 
	    				    		$explodedResult = explode(',',$queryResult); 

	    				    		if ($queryResult == NULL)
	    				    		{
	    				    		//	echo "$queryResult = NULL";
	    				    			echo form_open('UserController/like'); 
	    				    			echo "<p style='text-align: left;'>"; ?>

	    				    			<?php
	    				    				if($this->session->userdata('sessionid'))
	    				    				{
	    				    					$id = $this->session->userdata('sessionid');
	    				    				}
	    				    				if($this->session->userdata('headsessionid'))
	    				    				{
	    				    					$id = $this->session->userdata('headsessionid');
	    				    				}
	    				    				$dataa = array(
	    				    			        'givelikeid'  => $id,
	    				    			        'noticeid' => $data->nid,
	    				    			        'likesinthispost' => $data->nlk
	    				    				);
	    				    				echo form_hidden($dataa);

	    				    			echo form_submit(['name'=>'submit','value'=>'Like','class'=>'btn btn-primary btn-sm', 'style'=>'width: 63px; text-align: left; background-color: #6d7da5; border-color: #6d7da5;']); 

	    				    			echo "<span><i class='far fa-thumbs-up' id='' style='margin-left: -28px; color: #ffffff;'></i></span>
	    				    			</p>";
	    				    			 echo form_close();
	    				    			  echo "</div></div></div>";

	    				    		} 
	    				    		else
	    				    		{

			    				    		foreach($explodedResult as $kkey=> $result)
			    				    		{
			    				    			if($this->session->userdata('sessionid'))
			    				    			{
			    				    				$id = $this->session->userdata('sessionid');
			    				    			}
			    				    			if($this->session->userdata('headsessionid'))
			    				    			{
			    				    				$id = $this->session->userdata('headsessionid');
			    				    			}
			    				    			if( $result == $id && $result != NULL && $kkey>0 )
			    				    			{
			    				    				$checkvar = 1;
			    				    				break;
			    				    			}
			    				    			if( $result != $id && $result != NULL && $kkey>0)
			    				    			{
			    				    				$checkvar = 0;
			    				    			}
			    				    		}

    				    			if( $checkvar == 1 )
    				    			{	
    				    				/*echo "<p style='background:green;'>";
			    						echo "likedid->";
			    						echo $result;
			    						echo "userid->";
			    						echo $this->session->userdata('sessionid');
			    						echo "LIKED BTN DEACTIVATE";
			    						echo "</p>";
			    						echo "<br/>";*/
			    					//	echo "$result =this->session->userdata('sessionid') && $result != NULL && $kkey>0 checkvar->$checkvar";
			    						echo "<p style='text-align: left;'>";
			    						echo "<button type='button' class='btn btn-primary btn-sm' style='width: 73px; text-align: left; background-color: #6d7da5; border-color: #899E9A;'>Liked</button><span><i class='fas fa-thumbs-up' id='' style='margin-left: -25px; color: #ffffff;'></i></span>
			    							</p>";
			    							echo "</div></div></div>";

    				    			}


    				    			else if( $checkvar == 0 )
    				    			{
    				    				
    				    			//	echo "$result !this->session->userdata('sessionid') && $result != NULL && $kkey>0";
    				    				echo form_open('UserController/like'); 
    				    				echo "<p style='text-align: left;'>"; ?>

    				    				<?php
    				    					if($this->session->userdata('sessionid'))
    				    					{
    				    						$id = $this->session->userdata('sessionid');
    				    					}
    				    					if($this->session->userdata('headsessionid'))
    				    					{
    				    						$id = $this->session->userdata('headsessionid');
    				    					}
    				    					$dataa = array(
    				    				        'givelikeid'  => $id,
    				    				        'noticeid' => $data->nid,
    				    				        'likesinthispost' => $data->nlk
    				    					);
    				    					echo form_hidden($dataa);

    				    				echo form_submit(['name'=>'submit','value'=>'Like','class'=>'btn btn-primary btn-sm', 'style'=>'width: 63px; text-align: left; background-color: #6d7da5; border-color: #6d7da5;']); 

    				    				echo "<span><i class='far fa-thumbs-up' id='' style='margin-left: -28px; color: #ffffff;'></i></span>
    				    				</p>";?>
    				    				<?php echo form_close(); ?>
    				    				<?php echo
    				    				"</div>
    				    		  			</div>
    				    					</div>"; ?>
    				    					<?php 
    				    			}
	    				    		}	
	    				    		
	    				    		?>

									<?php }} ?>
	    				         
	    				    	</div>
	    				    	</div>
	    				  </div>
	    				</div>


	    				
	    			</div>		

	    			

	    		</div>
	    	</div>
	    </section>

	    <script type="text/javascript">
	    	$('#b1').click(function()
	    	{
	    		document.getElementById('b1').value='liked';
	    		document.getElementById('b1').style='text-align:left; width:65px';
	    		document.getElementById('i1').className='fas fa-thumbs-up';
	    	})
	    	$('#b2').click(function()
	    	{
	    		document.getElementById('b2').value='liked';
	    		document.getElementById('b2').style='text-align:left; width:65px';
	    		document.getElementById('i2').className='fas fa-thumbs-up';
	    	})
	    </script>


<?php include('footer.php'); ?>