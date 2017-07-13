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
        <center>
        	<?php
            	echo form_open("invoice_controller/invoice_add");
            	
            	$title = __DB_INVOICES_INVOICENUMBER__;
            	echo form_label("Faktura VAT nr.", $title)."</br>";
            	echo form_input($title)."</br>";
            	
            	$title = __DB_INVOICES_DATE__;
            	echo form_label("Data faktury", $title)."</br>";
            	echo form_input($title)."</br>";
            	
            	$title = __DB_INVOICES_PAYMENTDEADLINE__;
            	echo form_label("Termin płatności", $title)."</br>";
            	echo form_input($title)."</br>";
            	
            	$title = __DB_INVOICES_PAYMENTMETHOD__;
            	echo form_label("Forma płatności", $title)."</br>";
            	echo form_input($title)."</br>";
            	
        	?>
		</center>
		 </div>
	</body>
</html>