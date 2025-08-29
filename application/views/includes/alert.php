
<div id="successMessage" class="col-md-12" style="z-index:50;">
   <?php if($this->session->flashdata('success')){ ?>
        <div class="col-md-8 col-sm-offset-4 text-center alert alert-success" id="successdiv">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php $this->session->unset_userdata('success'); }
    else if($this->session->flashdata('error')){  ?>
        <div class="col-md-8 col-sm-offset-4 text-center alert alert-danger" id="errordiv" >
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php $this->session->unset_userdata('error'); }
    else if($this->session->flashdata('warning')){  ?>
        <div class="col-md-8 col-sm-offset-4 text-center alert alert-warning" id="warningdiv">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Warning!</strong> <?php echo $this->session->flashdata('warning'); ?>
        </div>
    <?php $this->session->unset_userdata('warning'); }
    else if($this->session->flashdata('info')){  ?>
        <div class="col-md-8 col-sm-offset-4 text-center alert alert-info" id="infodiv">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Info!</strong> <?php echo $this->session->flashdata('info'); ?>
        </div>
<?php  $this->session->unset_userdata('info'); } ?>
</div>

<script type="text/javascript">
$(function() {
    $("#successMessage").fadeTo(2000, 500).slideUp(500, function(){
    $("#successMessage").alert('close');
});
});
</script>
