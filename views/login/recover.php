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

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Please enter your email Id</div>
            <form action="<?php echo $actionlink?>" method="post">
                <div class="body bg-gray">
				<?php if(!empty($error_msg)){?>
					 <div class="form-group" style="color:#f00">
                        <?php echo $error_msg;?>
                    </div>	
				<?php }?>
				   <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email address"/>
                    </div>
                   
                </div>
                <div class="footer"  >                                                               
                    <button type="submit" class="btn bg-olive btn-block">Recover</button>  
                    
                    
                </div>
            </form>
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo asset_url()?>js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>