<?php
$currentuser = $currentuser[0];
?><aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Quick Edit Of Your Profile
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Your Profile</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <form role="form" action="<?php echo $actionlink?>" method="post" enctype="multipart/form-data"> 
							<div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Basic Information</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                               
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputFirstName">Practice Name</label>
                                            <input type="text" class="form-control" id="firstname"  required="required" placeholder="First Name" name="firstname" value="<?php echo @$currentuser->firstname?>">
                                        </div>
										<div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control" required="required" name="email" id="exampleInputEmail1" placeholder="Enter email"  value="<?php echo @$currentuser->email?>">
                                        </div>
                                        <div class="form-group"  style="display:none">
                                            <label for="exampleInputEmail1">Feedback URL</label>
                                            <input type="text" class="form-control" name="feedbackurl" id="feedbackurl" placeholder="feedbackurl"  value="<?php echo @$currentuser->feedbackurl?>">
                                        </div>
                                        
                                        <div class="row" >                            
                                            <div class="col-sm-12 form-group">
                                                <label for="email"> Message*:</label>
                                                <textarea class="form-control" style="height: 76px;" <?php if($currentuser->userrole!=1){ echo 'readonly'; } ?> id="default_msg" name="default_msg" ><?=$currentuser->msg_default?></textarea>
												<?php if($currentuser->userrole!=1){ echo '<a href="https://www.mypracticereviews.com/request-change-to-message/" target="_blank"> Request Change to Message </a>'; } ?>
                                            </div>
                                        </div> 
                                      
										<div class="form-group">
                                            <label for="exampleInputFirstName">Show Name Field</label>
                                            <input type="checkbox" class="form-control" name="show_field" <?=($currentuser->show_name_field==1)?'checked="checked"':'';?> />
                                        </div>										
                                                                
                                    </div><!-- /.box-body -->

                                   
                                
                            </div><!-- /.box -->

                            <!-- Form Element sizes -->
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Update Password</h3>
                                </div>
								<div class="box-body">
                                 <div class="form-group">
                                            
                                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password"   value="<?php echo @$currentuser->password?>">
                                  </div>
								   <!--<div class="form-group">
                                            <label for="exampleInputPassword1">New Password</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1" name="confirmpassword" placeholder="Password">
                                    </div>-->
								</div> <!------- .Box-body --------->
								 
                            </div><!-- /.box -->
							
							
							<div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
						</form>
                            
                            
                        </div><!--/.col (left) -->
                        
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->