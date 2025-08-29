 <!-- Library Bundle Script -->
    <script src="<?php echo base_url()?>public/assets/js/core/libs.min.js"></script>
    
    <!-- External Library Bundle Script -->
    <script src="<?php echo base_url()?>public/assets/js/core/external.min.js"></script>
    
    <!-- Widgetchart Script -->
    <script src="<?php echo base_url()?>public/assets/js/charts/widgetcharts.js"></script>
    
    <!-- mapchart Script -->
    <script src="<?php echo base_url()?>public/assets/js/charts/vectore-chart.js"></script>
    <script src="<?php echo base_url()?>public/assets/js/charts/dashboard.js" ></script>
    
    <!-- fslightbox Script -->
    <script src="<?php echo base_url()?>public/assets/js/plugins/fslightbox.js"></script>
    
    <!-- Settings Script -->
    <script src="<?php echo base_url()?>public/assets/js/plugins/setting.js"></script>
    
    <!-- Slider-tab Script -->
    <script src="<?php echo base_url()?>public/assets/js/plugins/slider-tabs.js"></script>
    
    <!-- Form Wizard Script -->
    <script src="<?php echo base_url()?>public/assets/js/plugins/form-wizard.js"></script>
    
    <!-- AOS Animation Plugin-->
    <script src="<?php echo base_url()?>public/assets/vendor/aos/dist/aos.js"></script>
    
    <!-- App Script -->
    <script src="<?php echo base_url()?>public/assets/js/hope-ui.js" defer></script>
    <!-- Bootstrap 3.3.6 -->
   <!--<script src="<?php echo base_url()?>public/bootstrap/js/bootstrap.min.js"></script>-->
    
    
	<script type="text/javascript" src="<?php echo base_url();?>public/assets/select2/js/select2.full.min.js"></script>

   <script src="<?php echo base_url();?>public/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    
<script>

$(function(){
$(".select2").select2();
});
function goBack() {
  window.history.back();
}
function goBack() {
  window.history.back();
}
$('.datepicker1').datepicker({
	format: "dd-mm-yyyy",
	todayHighlight:"true",
	//endDate:"today",
	toggleActive:"true",
        autoclose:true,
});

$('#reset').click(function() {
      location.reload(); 
});


</script>


  </body>
</html>
