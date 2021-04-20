<?php
$currentuser = $currentuser[0];

?>
<style>
.col-md-offset-0 {
    padding-top: 8px;
}
input[type="button"] {
    background: #2692FF;
    color: #fff;
    border: none;
}
.col-md-12.col-md-offset-0 {
    padding-top: 8px;
    background: #2D688C;
    text-align: right;
}
iframe { width:100%;}
.headerif {height: 80px;border:none;}
@media only screen and (max-width: 1000px)
{
	
	.col-md-4.col-md-offset-1 {
		text-align: center;
	}
	.col-md-offset-0, .col-md-12.col-md-offset-0 { text-align: center; }
	
}

@media only screen and (max-width: 700px)
{
  .headerif {height: 110px;border:none;}
}

</style>
<script type="text/javascript">
  function resizeIframe(obj){
     obj.style.height = 0;
     obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }
</script>
<div class="col-md-12 col-md-offset-0">
	<a href="<?php echo base_index_url()?>home" target="_blank"><input type="button" value="Edit Profile" /></a>
	<a href="<?php echo base_url(); ?>index.php/home/logout"><input type="button" value="Logout" /></a>
</div>
<div class="container" style="width: 100%;background: #2D688C;padding: 14px 0;    margin: 0;overflow: hidden;">
	<div class="row">	
		<div class="col-md-7 col-md-offset-1">
			<a href="https://www.mypracticereviews.com" class="logo" target="_blank">
			<img src="<?=base_url('assets/');?>/img/logompr.png" alt="Logo" style="max-width:90%;"> </a>
		</div>		
		<div class="col-md-4 col-md-offset-0">                   
			<a href="tel:+18005922392" style="color: #fff;font-size: 25px;"><span class="et_pb_call_button et_pb_buttons">Phone: 1-800-592-2392</span></a>
		</div>
	</div>	
</div>
			
<div class="container contain">
            <div class="row">
				
                <div class="col-md-6 col-md-offset-3">
					<!-- Latest compiled and minified CSS -->
					<link rel="stylesheet" href="bootstrap.css">
					<h2>Request Google Review From Patient</h2>
					<h4>Enter patients <?php if($currentuser->show_name_field == 1){?>first name and <?php } ?> cell phone number and press Send.</h4><br>							
                    <form role="form" method="post" id="msg_form" action="<?php echo $actionlink?>">
					<?php if($currentuser->show_name_field == 1){?>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="name"> Name*:</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" maxlength="50" required="required">
                            </div>
                            
                        </div>
					<?php }?>
                        <div class="row">                            
                            <div class="col-sm-12 form-group">
                                <label for="email"> Patients Cell Phone*:</label><br/>
                                <input type="text" readonly="readonly" value="+1" class="form-control" style="float:left;width:8%;border-right:none;border-radius:4px 0 0 4px;">
                                <input type="tel" class="form-control" id="receiver" name="receiver" required="required"  maxlength="10"  style="float:left;width:92%;border-left:none;border-radius:0 4px 4px 0;">
                                 <input type="hidden" readonly="readonly" class="form-control" id="sender" placeholder="Sender" name="sender" value="<?=$currentuser->twilio_number?>"  >
                                 <input type="hidden" class="form-control" id="check_number" name="check_number" value="0"  >
                            </div>
                        </div>    
                        <div class="row" style="display:none">                            
                            <div class="col-sm-12 form-group">
                                <label for="email"> Message*:</label>
                                <textarea class="form-control" id="default_msg" name="default_msg" ><?=$currentuser->msg_default?></textarea>
                            </div>
                        </div>   
                        <?php if(($currentuser->unlimited_msgs == 1) || ($currentuser->total_messages > $totalmessages[0]->msg_count)){?>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                            <button type="button" class="btn btn-lg btn-success btn-block" id="btnSendmessage">Send</button>
                                <br/>
                                <span id="countmsgs" class="countmsg"><?php echo $countmsg;?></span>
                            </div>
                        </div> 
                        <?php }else{
                        ?>                        
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                
                                <span class="countmsg"><?php echo $countmsg;?></span>
                            </div>
                        </div>
                    <?php }?>
                    </form>
                    <div id="response" ></div>
                </div>
            </div>
        </div>