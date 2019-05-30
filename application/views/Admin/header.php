<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php 
if($this->session->userdata('adminsessionid') == NULL) {

	return redirect('loginController/userLogin');
}
?>
<!-- <?php echo $this->session->userdata('adminsessionid');?> -->
<!DOCTYPE html>
<html>
<head>
	<title>HRM DashBoard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('Assets/css/style.css'); ?>">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

</head>
<body>
	
	<nav class="navbar navbar-expand-sm">
	      <?php echo anchor('AdminController/adminDashboard','HRM Admin', ['class'=>'navbar-brand']); ?>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation" style="color: #ffffff;">
	        <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
	      </button>

	      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
	        <ul class="navbar-nav mr-auto">
	          <li class="nav-item">
	            <a class="nav-link" href="#">Update profile</a>
	          </li>
	      </ul>
	      <ul class="navbar-nav navbar-right">
	          <li class="nav-item">
	            <a class="nav-link" href="#">
	            	
	            		<?php 
	            		if($this->session->userdata('adminsessionid'))
	            	{
	            		$i = $this->session->userdata('adminsessionid');
	            		$pic = $this->db->select('profile_pic_path')
	            						->where('id',$i)
	            						->get('employee');
	            		?>				
	            		<img src='<?php echo $pic->row()->profile_pic_path ?>' class="rounded-circle" alt="pic" style="width: 30px; height: 30px; margin-top: -5px;">
	            		<?php 
	            		echo "Welcome, ";
	            		echo $this->session->userdata('adminsessionname');
	            	} 
	            	
	            	?>

	            </a>
	          </li>
	          <li class="nav-item">
	            
	            <?php echo anchor('loginController/adminLogout', 'Logout', ['class'=>'nav-link']); ?>
	          </li>
	      </ul>
	        
	      </div>
	    </nav>

	    <header id="header">
	    	<div class="container">
	    		<div class="row">
	    			<div class="col-md-10 col-lg-10 col-sm-8 col-8">
	    				<h2><span><i class="fas fa-cogs"></i></span> Dashboard <small>employee management</small></h2>
	    			</div>
	    			<div class="col-md-2 col-lg-2 col-sm-4 col-4">
	    						<div class="search">
	    				      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
	    				    	</div>
	    			</div>
	    		</div>
	    	</div>
	    </header>