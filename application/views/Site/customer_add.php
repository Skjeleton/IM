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
        <div class="row margines-top">
    		<div class="panel">
            	<?php
                    echo form_open("invoice_controller/customer_add");
                    
                    $title = __DB_CUSTOMERS_NAME__;
                    echo form_label("Nazwa", $title);
                    echo form_input($title);
                    
                    $title = __DB_CUSTOMERS_COUNTRY__;
                    echo form_label("Państwo", $title);
                    echo form_input($title);
                    
                    $title = __DB_CUSTOMERS_CITY__;
                    echo form_label("Miasto", $title);
                    echo form_input($title);
                    
                    $title = __DB_CUSTOMERS_POSTALCODE__;
                    echo form_label("Kod pocztowy", $title);
                    echo form_input($title);
                    
                    $title = __DB_CUSTOMERS_STREET__;
                    echo form_label("Ulica", $title);
                    echo form_input($title);
                    
                    $title = __DB_CUSTOMERS_HOUSENUMBER__;
                    echo form_label("Numer domu", $title);
                    echo form_input($title);
                    
                    $title = __DB_CUSTOMERS_APARTMENTNUMBER__;
                    echo form_label("Numer lokalu", $title);
                    echo form_input($title);
                    
                    $title = __DB_CUSTOMERS_NIP__;
                    echo form_label("NIP", $title);
                    echo form_input($title);
                    
                    echo form_submit("Submit", "Dodaj!");
                    echo form_close();
                    
                   
            	?>
     		</div>	
         </div>
    </body>
</html>