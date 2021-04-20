 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
?> 
</div>
<div id="loading" style="position: fixed;width: 100%;height: 100%;background: #000;opacity: 0.1;top: 0;display:none;">
<img style="width: 50px;margin: 15% 48%;opacity: 1;background: #f00;" src="https://www.mypracticereviews.com/login/loading.gif" />
</div>
<!-- jQuery 2.0.2 -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="<?php echo asset_url()?>js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
         <script src="<?php echo asset_url()?>js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="<?php echo asset_url()?>js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo asset_url()?>js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        
		<!-- AdminLTE App -->
        <script src="<?php echo asset_url()?>js/AdminLTE/app.js" type="text/javascript"></script> 
		<script src="<?php echo asset_url()?>js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
		<!--<script src="<?php echo asset_url()?>js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>-->
        <script type="text/javascript">
        $(function() {
            $('.no-print').hide();
            /* $('#twilionumber,#receiver').keydown(function (e) {
                var key = e.charCode || e.keyCode || 0;
                $text = $(this);
                if (key !== 8 && key !== 9) {
                    if ($text.val().length === 3) {
                        $text.val('(' + $text.val() + ')-');
                    }
                    if ($text.val().length === 9) {
                        $text.val($text.val() + '-');
                    }
                }
                return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
            }); */
            
            $('#btnSendmessage').click(function(){
                $('#loading').show();
                var postData = $($("#msg_form")).serializeArray();
                var formURL = $($("#msg_form")).attr("action");
                $.ajax(
                        {
                            url: formURL,
                            type: "POST",
                            data: postData,
                            success: function (result)
                            {
                                if(result=='exist'){
                                    if(confirm('A text message has already been sent to this phone number.  Do you want to send another text to this phone number?')){
                                        $('#check_number').val(1);
                                        $('#btnSendmessage').trigger('click');
                                    }
                                }else{
                                
                                $("#response").html(result);
                                
                                $('#check_number').val(0);
                                $('form#msg_form').trigger('reset');
                                setTimeout(function(){ $("#success_message,#error_message").hide('slow'); }, 5000);
                                update_msgs();
                                }
                                $('#loading').hide();
                            },
                            error: function (result)
                            {
                            }
                        });
            });
            function update_msgs(){
                $.ajax(
                        {
                            url: '<?php echo base_index_url();?>sendsms/update_msgs',
                            type: "POST",
                            success: function (result)
                            {
                                $("#countmsgs").html(result);
                                
                            },
                            error: function (result)
                            {
                            }
                        });
            }
            var site_urls = '<?php echo base_index_url();?>';
        });
        </script>
        <script type="text/javascript"  src="<?php echo asset_url()?>js/customjs.js" ></script>
	
    </body>
</html>