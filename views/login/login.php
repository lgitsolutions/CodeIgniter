<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $heading?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo asset_url()?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo asset_url()?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo asset_url()?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<style>
		body > .header {
			text-align: center;
			border-bottom: 2px solid #E8E8E8;
			padding: 20px 0; max-height: unset;
		}	
		.form-box {
			margin: 46px auto 0 auto;
		}
			
		</style>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">
	
	
		<div class="header">
		<a href="https://mypracticereviews.com" target="_blank"><img src="<?php echo base_url().'assets/img' ?>/logo.png" style="max-width: 90%;" /></a>		
		</div>
		

        <div class="form-box" id="login-box">
            <div class="header">Sign In</div>
            <form action="<?php echo $actionlink?>" method="post">
                <div class="body bg-gray">
				<?php if(!empty($error_msg)){?>
					 <div class="form-group" style="color:#f00">
                        <?php echo $error_msg;?>
                    </div>	
				<?php }?>
				   <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Username or Email"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>          
                    <div class="form-group">
                        <input type="checkbox" name="remember_me"/> Remember me
                    </div>
                </div>
                <div class="footer"  >                                                               
                    <button type="submit" class="btn bg-olive btn-block">Sign me in</button>  
                    
                    <p><a href="<?php echo base_index_url()?>login/recover" >I forgot my password</a></p>
                    
                    <a href="register.html" class="text-center" style="display:none">Register a new membership</a>
                </div>
            </form>

            <div class="margin text-center" style="display:none">
                <span>Sign in using social networks</span>
                <br/>
                <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

            </div>
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo asset_url()?>js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>