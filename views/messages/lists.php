<aside class="right-side">

<section class="content-header">
                    <h1>
                        All Messages
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Messages </a></li>
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
                                                <th>Serial Number</th>
                                                <th>Twilio Numner</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($messages)){$s=1;foreach($messages as $message){?>
                                             <tr>
                                               <td><?php echo $s;?></td>
                                               <td><?php echo ($message->receiver);?></td>
                                                
                                                
                                            </tr>
											<?php $s++;}}?>
                                        </tbody>
                                        
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
					</section>		
			</aside>				