<aside class="right-side">

<section class="content-header">
                    <h1>
                        All Users
                        <small style="font-weight: normal;"><a href="<?php echo base_index_url()?>user/addUser" >Add New </a></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Users</a></li>
                        <li class="active">All Users</li>
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
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Actions</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($listing)){foreach($listing as $user){?>
                                             <tr>
                                                <td style="text-transform:capitalize;"><?php echo $user->firstname.' '.$user->lastname?></td>
                                                <td><?php echo $user->email?></td>
                                                <td style="text-transform:capitalize;"><?php echo $user->role?></td>
                                                <td style="text-transform:capitalize;">view | <a href="javascript:void(0)" class="delete_record" action="user/deleteRecord/<?php echo $user->id?>" ><?php echo "Delete";?></a></td>
                                                
                                            </tr>
											<?php }}?>
                                        </tbody>
                                        <!--<tfoot>
                                            <tr>
                                                 <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>View</th>
                                            </tr>
                                        </tfoot>--->
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
					</section>		
			</aside>				