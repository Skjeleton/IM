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
                echo form_open("invoice_controller/customer_add");
                
                $title = __DB_CUSTOMERS_NAME__;
                echo form_label("Nazwa", $title)."</br>";
                echo form_input($title)."</br>";
                
                $title = __DB_CUSTOMERS_COUNTRY__;
                echo form_label("Państwo", $title)."</br>";
                echo form_input($title)."</br>";
                
                $title = __DB_CUSTOMERS_CITY__;
                echo form_label("Miasto", $title)."</br>";
                echo form_input($title)."</br>";
                
                $title = __DB_CUSTOMERS_POSTALCODE__;
                echo form_label("Kod pocztowy", $title)."</br>";
                echo form_input($title)."</br>";
                
                $title = __DB_CUSTOMERS_STREET__;
                echo form_label("Ulica", $title)."</br>";
                echo form_input($title)."</br>";
                
                $title = __DB_CUSTOMERS_HOUSENUMBER__;
                echo form_label("Numer domu", $title)."</br>";
                echo form_input($title)."</br>";
                
                $title = __DB_CUSTOMERS_APARTMENTNUMBER__;
                echo form_label("Numer lokalu", $title)."</br>";
                echo form_input($title)."</br>";
                
                $title = __DB_CUSTOMERS_NIP__;
                echo form_label("NIP", $title)."</br>";
                echo form_input($title)."</br>";
                
                $title = __DB_CUSTOMERS_OTHERS__;
                echo form_label("Inne",$title)."</br>";
                echo form_textarea($title)."</br>";
                
                echo form_submit("Submit", "Dodaj!")."</br>";
                echo form_close();
                
               
        	?>
        </div>
        <div class="col-md-3"></div>
<!--          </div> -->
         </center>
    </body>
</html>