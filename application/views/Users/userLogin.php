<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Saka Login Form</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<style type="text/css">
    .login-form {
        width: 340px;
        margin: 50px auto;
    }
    .login-form form {
        margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
</style>
</head>
<body>
    <div class="text-center">
        <h1 style="margin-top: 50px;"><i class="fas fa-address-book"></i></h1>
        <h2> Login Panel </h2>
        <?php if($msg = $this->session->flashdata('msg')): ?>
            <?php echo "<div style='color:red'>"; ?>
            <?php echo $msg; ?>
            <?php echo "</div>"; ?>
          <?php endif; ?>
          <div id='forgpass' style="color:red"></div>
    </div>
    
<div class="login-form">

    <?php echo form_open('loginController/userLogin'); ?>
            
        <div class="form-group">
            <h3 style="text-align: center;">Email Address</h3>
            
            <?php echo form_input(['name'=>'email','class'=>'form-control', 'value'=>set_value('email'), 'required'=>'required']); ?>
        </div>
        <div><?php echo form_error('email', '<div class = "text-danger">', '</div>');?></div>
        <div class="form-group">
            <h3 style="text-align: center;">Password</h3>
           
            <?php echo form_password(['name'=>'pass','class'=>'form-control','value'=>set_value('pass'), 'required'=>'required']); ?>
        </div>
        <div><?php echo form_error('pass', '<div class = "text-danger">', '</div>');?></div>
        <div class="form-group container">
            <?php echo form_submit(['name'=>'submit','value'=>'Login','class'=>'btn btn-primary', 'style'=>'margin: 10px 0 0 40px;']);
        ?>
            
           <!-- <button class="btn btn-primary" style='margin: 10px 0 0 50px;''>Clear</button> -->
            <?php echo anchor('UserController/index', 'Clear', ['class'=>'btn btn-primary', 'style'=>'margin: 10px 0 0 50px;']); ?>
           
            <section style="margin: 20px 0 0 54px;"><a href="#" onclick="fun();">Forgot your password?</a></section>

            <script type="text/javascript">
                function fun()
                {
                    document.getElementById('forgpass').innerHTML = 'Please contact Admin !'
                }
            </script>

               
    <?php echo form_close(); ?>
</div>
</body>
</html>    


    


