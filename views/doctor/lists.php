<aside class="right-side">

<section class="content-header">
                    <h1>
                        All Doctors
                        <small style="font-weight: normal;"><a href="<?php echo base_index_url()?>doctor/addNew" >Add New </a></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Doctors </a></li>
                        <li class="active">Lists</li>
                    </ol>
                </section>
                <!-- Content Header (Page header) -->
				<!-- Main content -->
                <section class="content">
				<div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Doctor</th>
                                                <th>Twilio Numner</th>
                                                <th>Actions</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($doctors)){foreach($doctors as $doctor){?>
                                             <tr>
                                                <td><?php echo $doctor->firstname.' '.$doctor->lastname?></td>
                                                <td><?php echo ($doctor->twilio_number);?></td>
                                                <td style="text-transform:capitalize;"><a href="<?php echo base_index_url()?>doctor/edit/<?php echo $doctor->id?>" >Edit </a> | <a href="javascript:void(0)" class="delete_record" action="<?php echo base_index_url()?>doctor/deleteRecord/<?php echo $doctor->id?>" ><?php echo "Delete";?></a></td>
                                                
                                            </tr>
											<?php }}?>
                                        </tbody>
                                        
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
					</section>		
			</aside>				