<aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?=$heading;?> 
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                       <li><a href="#">online</a></li>
                        <li class="active"><?=$heading;?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <?php echo ($msg)?$msg:'';?>
                            <form role="form" action="<?php echo $actionlink?>" method="post" enctype="multipart/form-data"> 
							<div class="box box-primary">
                                <div class="box-header">
                                <?php $doctorInfo = $doctorInfo[0];?>
                                    <h3 class="box-title">Basic Information</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                   <div class="box-body">
									
                                        <div class="form-group">
                                            <label for="exampleInputFirstName">Practice Name </label>
                                            <input type="text" class="form-control" id="doctorfirstname" placeholder="First Name" name="doctorfirstname" value="<?=($doctorInfo->firstname)?$doctorInfo->firstname:'';?>"  required="required">
                                        </div>
                                         <div class="form-group" style="display:none">
                                            <label for="exampleInputFirstName">Feedback URL</label>
                                            <input type="hidden" class="form-control" id="feedbackurl" placeholder="Feedback URL" name="feedbackurl" value=""  >
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFirstName">Twilio Number</label>
                                            <input type="text" class="form-control" id="twilionumber" placeholder="Twilio Number" name="twilionumber" value="<?=($doctorInfo->twilio_number)?$doctorInfo->twilio_number:'';?>"  required="required" maxlength="14">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFirstName">Email</label>
                                            <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?=($doctorInfo->email)?$doctorInfo->email:'';?>"  required="required">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFirstName">Login Password</label>
                                            <input type="text" class="form-control" id="password" placeholder="Password" name="password" value="<?=($doctorInfo->password)?$doctorInfo->password:'';?>"  required="required">
                                        </div>
                                        <?php 
                                        if($currentuser[0]->userrole==1){
                                        ?>
                                        <div class="form-group">
                                            <label for="exampleInputFirstName">Default Message</label>
                                            <textarea class="form-control" style="height: 76px;" name="default_msg"  ><?=($doctorInfo->msg_default)?$doctorInfo->msg_default:'';?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFirstName">Allow Messages Unlimited</label>
                                            <input type="checkbox" class="form-control" name="unlimited_msgs" <?=($doctorInfo->unlimited_msgs==1)?'checked="checked"':'';?> />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFirstName">Total Messages</label>
                                            <input type="number" class="form-control" id="total_messages" placeholder="Total Messages" name="total_messages" value="<?=($doctorInfo->total_messages)?$doctorInfo->total_messages:'';?>"  required="required">
                                        </div>
										<?php }?>
                                        <div class="form-group">
                                            <label for="exampleInputFirstName">Show Name Field</label>
                                            <input type="checkbox" class="form-control" name="show_field" <?=($doctorInfo->show_name_field==1)?'checked="checked"':'';?> />
                                        </div>
                                        
                                
								   
								</div> <!------- .Box-body --------->
								 
                            </div><!-- /.box -->
							
							<div class="box-footer">
                                <input type="hidden" value="<?=$doctorInfo->id?>" name="doctorInfo_id" />
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
						</form>
                            
                            
                        </div><!--/.col (left) -->
                        
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->