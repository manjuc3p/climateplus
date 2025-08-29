			
	<div id="pwdModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog">
	  <div class="modal-content">
	      <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	          <h2 class="text-center">What's My Password?</h2>
	      </div>
	      <div class="modal-body">
	            <div class="panel panel-default">
                    <div class="panel-body">
                        <fieldset>	                          
	                          <p>If you have forgotten your password you can reset it here.</p>
	                            
                            	<form name="addform1" id="addform1" method="post" action="<?php echo base_url().'index.php/'; ?>Login/reset_password">
                            		<div class="form-group">
                                    	<input class="form-control input-lg" placeholder="E-mail Address" id="email" name="email" type="email" required >
                                    </div>
                                    <div class="">
							          <div class="col-md-12 center">
							          	<input class="btn btn-primary " value="Send My Password" name="submit" type="submit">
							          	<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
									  </div>	
							       </div>	
                            	</form>		
                            		                                    
                        </fieldset>
                      </div>
                  </div>
            </div>
        </div>
    </div>
  </div>

 	
<script>      
  $('#addform1').validate({

    rules: {       
        email: {
            required: true,
        },
        },
    messages: {              
           email: {
                required: "Please enter email id",
                 },
        },
    highlight: function (element) {
        var id_attr = "#" + $(element).attr("id") + "1";
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        $(id_attr).removeClass('glyphicon glyphicon-ok').addClass('glyphicon glyphicon-remove');
    },
    unhighlight: function (element) {
        var id_attr = "#" + $(element).attr("id") + "1";
        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        $(id_attr).removeClass('glyphicon glyphicon-remove').addClass('glyphicon glyphicon-ok');
    },
    errorElement: 'span',
    errorClass: 'help-block',
    errorPlacement: function (error, element) {
        if (element.length) {
            error.insertAfter(element);
        } else {
            error.insertAfter(element);
        }
    }
});
    </script>