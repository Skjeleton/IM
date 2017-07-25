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
                
                $title = __DB_CUSTOMERS_NAME__;
                echo form_label("Nazwa", $title);
                echo form_input($title);

                $data= array(
                    'name' => __DB_CUSTOMERS_COUNTRY__,
                    'class' => 'AdresStyle',
                    'value' => 'Polska'
                );
                echo form_label("Państwo Miasto");
                echo form_input($data);
                $data= array(
                    'name' => __DB_CUSTOMERS_CITY__,
                    'class' => 'AdresStyle'
                );
                $title = __DB_CUSTOMERS_CITY__;
                echo form_input($data);
                
                echo form_label("Ulica / Numer domu / Numer mieszkania / Kod pocztowy");
                echo form_fieldset();
                $data= array(
                    'name' => __DB_CUSTOMERS_STREET__,
                    'class' => 'Street'
                );
                echo form_input($data);
                
                $data= array(
                    'name' => __DB_CUSTOMERS_HOUSENUMBER__,
                    'class' => 'Numbers'
                );
                echo form_input($data);
                
                echo "/";
                
                $data= array(
                    'name' => __DB_CUSTOMERS_APARTMENTNUMBER__,
                    'class' => 'Numbers'
                );
                echo form_input($data);
                
                $data= array(
                    'name' => __DB_CUSTOMERS_POSTALCODE__,
                    'class' => 'PostalCodeStyle'
                );
                echo form_input($data);
                
                
                echo form_fieldset_close();
                
                $title = __DB_CUSTOMERS_NIP__;
                echo form_label("NIP", $title);
                echo form_input($title);
                
                $data = array(
                    'name' => __DB_CUSTOMERS_OTHERS__,
                    'class' => 'TextArea'
                );
                echo form_label("Inne")."</br>";
                echo form_textarea($data);
                
                echo form_submit("Submit", "Dodaj!");
                echo form_close();
                
               
        	?>
        </div>
        <div class="col-md-3"></div>
<!--          </div> -->

    </body>
</html>