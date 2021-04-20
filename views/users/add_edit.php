<aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Add New User
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                       <li><a href="#">Users</a></li>
                        <li class="active">Add Users</li>
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
									<label for="usertype">User Type</label>
                                           <select class="form-control" name="user_type" >
                                                <?php
												foreach($roles as $role){
													echo '<option value="'.$role->id.'">'.ucwords($role->role).'</option>';
												}
												?>
                                            </select>
                                  </div>
                                        <div class="form-group">
                                            <label for="exampleInputFirstName">First Name</label>
                                            <input type="text" class="form-control" id="firstname" placeholder="First Name" name="firstname" value="<?php echo @$currentuser->firstname?>">
                                        </div>
										 <div class="form-group">
                                            <label for="exampleInputLastName">Last Name</label>
                                            <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="lastname"  value="<?php echo @$currentuser->lastname?>">
                                        </div>
										
										<div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Enter email"  value="<?php echo @$currentuser->email?>">
                                        </div>
                                       
                                        <div class="form-group">
										
                                            <label for="exampleInputFile">Profile Picture</label>
                                            <input type="file" id="exampleInputFile" name="profile_pic">
                                            
                                        </div>
                                        
                                    
                                 <div class="form-group">
                                            <label for="exampleInputPassword1">Set Password</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password"   value="<?php echo @$currentuser->password?>">
                                  </div>
								   
                                 <div class="form-group">
								 <label for="Profile Status">Profile Status</label>
                                           <select class="form-control" name="profile_status" >
                                                <option value="1" >Active</option>
                                                <option value="0" >Disabled</option>
                                               
                                            </select>
                                  </div>
								   
								</div> <!------- .Box-body --------->
								 
                            </div><!-- /.box -->
							
							<div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
						</form>
                            
                            
                        </div><!--/.col (left) -->
                        
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->