<html>
	<head>
	    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.css">
	</head>
    <body>
        <div class="row margines-top panel">
        <div class="col-md-4"></div>
		<div class="col-md-4">
        	<?php
                echo form_open("customer_controller/customer_add");
                
                require "parts/customer_form.php";
                
                echo form_submit("Submit", "Dodaj!");
                echo form_close();
                
               
        	?>
        </div>
        <div class="col-md-3"></div>
<!--          </div> -->

    </body>
</html>