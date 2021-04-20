<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$currentuser = $currentuser[0];

?>
<aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo asset_url()?>img/favicon.png" class="img-circle" alt="User Image" width="80"  />
										
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo $currentuser->firstname?></p>

                            <!--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
                        </div>
                    </div>
                    <!-- search form 
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="<?php echo base_index_url()?>home">
                                <i class="fa fa-dashboard"></i> <span>Profile</span>
                            </a>
                        </li>
                        <?php 
                            if($currentuser->userrole==1){
                        ?>
						<li class="treeview active">
                            <a href="#">
                                <i class="glyphicon glyphicon-user"></i> <span>Doctors</span> 
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_index_url()?>doctor/lists"><i class="fa fa-angle-double-right"></i> All Doctors</a></li>
                                <li><a href="<?php echo base_index_url()?>doctor/addNew"><i class="fa fa-angle-double-right"></i> Add Doctor</a></li>
                                
                            </ul>
                        </li>
                        <?php }?>
                        <?php 
                            if($currentuser->userrole==2){
                        ?>
						<li class="treeview">
                            <a href="#">
                                <i class="glyphicon glyphicon-user"></i> <span>Send SMS</span> 
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_index_url()?>sendsms/createin"><i class="fa fa-angle-double-right"></i> Send SMS</a></li>
                                
                            </ul>
                        </li>
                         
                        <li class="active">
                            <a href="<?php echo base_index_url()?>sendsms/create" target="_blank">
                                <i class="fa fa-dashboard"></i> <span>Visit Site</span>
                            </a>
                        </li>
                        <?php }?>
                           
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
