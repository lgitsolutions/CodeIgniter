<?php
$currentuser = $currentuser[0];
?>
<aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?=$heading;?> 
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
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
                                    <h3 class="box-title">Basic Information</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                   <div class="box-body">
									    <div class="form-group">
                                            <input type="hidden" readonly="readonly" class="form-control" id="sender" placeholder="Sender" name="sender" value="<?=$currentuser->twilio_number?>">
                                        </div>
										<?php if($currentuser->show_name_field == 1){?>
                                        <div class="form-group">
                                            <label for="exampleInputFirstName">Name</label>
                                            <input type="text"  class="form-control" id="name" placeholder="Name" name="name" >
                                        </div>
										<?php }?>
                                        <div class="form-group">
                                            <label for="exampleInputFirstName">Patients Cell Phone</label>
                                            <input type="tel"  class="form-control" id="receiver" placeholder="Phone Number" name="receiver"  maxlength="14" >
                                        </div>
                                        <div class="form-group" style="display:none">
                                            <label for="exampleInputFirstName">Default Message</label>
                                            <textarea class="form-control" name="default_msg" ><?=$currentuser->msg_default?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFirstName">Do you want to send message again to this number, If already sent.</label>
                                            <select name="check_number"  class="form-control" >
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                        
                                
								   
								</div> <!------- .Box-body --------->
								 
                            </div><!-- /.box -->
							
							<div class="box-footer">
                            <input type="hidden" value="<?=$schoolInfo[0]->id?>" name="school_id" />
                            <input type="hidden" value="<?=$editId?>" name="editId" />
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
						</form>
                            
                            
                        </div><!--/.col (left) -->
                        
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->