



 
                



		 <script type="text/javascript" src="<?php echo base_url('theme/js/bootstrap-datetimepicker.js');?>" charset="UTF-8"></script>
		 <script type="text/javascript">
 
			$('.form_date').datetimepicker({
				format: "dd-mm-yyyy",
		        language:  'En',
		        weekStart: 1,
		        todayBtn:  1,
				autoclose: 1,
				todayHighlight: 1,
				startView: 2,
				minView: 2,
				forceParse: 0,
				todayBtn: true,
				 
				
		    });
			
		</script>
        <!-- jQuery CDN -->
         <script src="https://code.jquery.com/jquery-1.12.0.min"></script>
         <!-- Bootstrap Js CDN -->
         <script src="<?php echo base_url('theme/js/bootstrap.min.js') ;?>"></script>
        

         <script type="text/javascript">
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                 });
             });
         </script>
    </body>
</html>
