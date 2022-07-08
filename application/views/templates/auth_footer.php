   <!-- Bootstrap core JavaScript-->
   <script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
   <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

   <!-- Core plugin JavaScript-->
   <script src="<?php echo base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

   <!-- Custom scripts for all pages-->
   <script src="<?php echo base_url() ?>assets/js/sb-admin-2.min.js"></script>

   <!-- js datepicker -->
   <script src="<?php echo base_url() ?>/assets/vendor/datepicker/js/bootstrap-datepicker.min.js"></script>

   <!-- js bootstrap -->
   <!-- <script src="<?php echo base_url() ?>/assets/js/bootstrap.js"></script> -->

   <!-- js jquery -->
   <script src="<?php echo base_url() ?>/assets/js/jquery-3.3.1.js"></script>
   <script src="<?php echo base_url() ?>/assets/js/jquery-ui.js"></script>


   <script type="text/javascript">
      $(function() {
         $(".datepicker").datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
         });
      });
   </script>

   <script>
      $(function() {
         $("#kampus").autocomplete({
            source: "<?= base_url('auth/getDataAutoComplete') ?>",
            select: function(event, data) {
               $('#kampus_id').val(data.item.kampus_id);
            }
         });
      });
   </script>

   </body>

   </html>