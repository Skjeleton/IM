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
            	
            	$title = __DB_TRANSACTIONS_MEASUREUNIT__;
            	echo form_label("", $title)."</br>";
            	echo form_input($title)."</br>";
            	
            	$title = __DB_TRANSACTIONS_COUNT__;
            	echo form_label("Ilość", $title)."</br>";
            	echo form_input($title)."</br>";
            	
            	$title = __DB_TRANSACTIONS_NETUNITPRICE__;
            	echo form_label("Nazwa", $title)."</br>";
            	echo form_input($title)."</br>";
            	
            	$title = __DB_TRANSACTIONS_NAME__;
            	echo form_label("Nazwa", $title)."</br>";
            	echo form_input($title)."</br>";
            	
            	echo form_submit("Submit", "Dokonaj zmian")."</br>";
            	echo form_close();
<<<<<<< HEAD

=======
                
>>>>>>> branch 'master' of https://github.com/Skjeleton/IM.git
        	?>
		</center>
		 </div>
		 <button class="add_field_button">Dodaj</button>
		 <script>
            	$(document).ready(function() {
            	    var max_fields      = 100; //maximum input boxes allowed
            	    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
            	    var add_button      = $(".add_field_button"); //Add button ID
            	   
            	    var x = 1; //initlal text box count
            	    $(add_button).click(function(e){ //on add input button click
            	        e.preventDefault();
            	        if(x < max_fields){ //max input box allowed
            	            x++; //text box increment
            	            $(wrapper).append('<div>.<?php  echo form_label("Nazwa", $title)."</br>";?>."<a href="#" class="remove_field">Remove</a></div>'); //add input box
            	        }
            	    });
            	   
            	    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            	        e.preventDefault(); $(this).parent('div').remove(); x--;
            	    })
            	});    
		 </script>
	</body>
</html>