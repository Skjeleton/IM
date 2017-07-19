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
                //
                
                //
                echo form_label("Ulica / Numer domu / Numer mieszkania");
                echo form_fieldset();
                $data= array(
                    'id' => '__DB_CUSTOMERS_STREET__',
                    'name' => '__DB_CUSTOMERS_STREET__',
                    'class' => 'Street'
                );
                echo form_input($data);
                $data= array(
                    'id' => '__DB_CUSTOMERS_HOUSENUMBER__',
                    'name' => '__DB_CUSTOMERS_HOUSENUMBER__',
                    'class' => 'Numbers'
                );
                echo form_input($data);
                echo "/";
                $data= array(
                    'id' => '__DB_CUSTOMERS_APARTMENTNUMBER__',
                    'name' => '__DB_CUSTOMERS_APARTMENTNUMBER__',
                    'class' => 'Numbers'
                );
                echo form_input($data);
                echo form_fieldset_close();
                
//                 Editable forms Street/HouseNumber/ApartmentNumber
                
//                 $title = __DB_CUSTOMERS_STREET__;
//                 $data= array(
//                     'title' => '__DB_CUSTOMERS_STREET__',
//                     'class' => 'Street'
//                 );
//                 echo form_label("Ulica", $title);
//                 echo form_input($data);
                
//                 $title = __DB_CUSTOMERS_HOUSENUMBER__;
//                 $data= array(
//                     'title' => '__DB_CUSTOMERS_HOUSENUMBER__',
//                     'class' => 'Numbers'
//                     );
//                 echo form_label("Numer domu", $title);
//                 echo form_input($data);
                
//                 $title = __DB_CUSTOMERS_APARTMENTNUMBER__;
//                 $data= array(
//                     'title' => '__DB_CUSTOMERS_APARTMENTNUMBER__',
//                     'class' => 'Numbers'
//                 );
//                 echo form_label("Numer lokalu", $title);
//                 echo form_input($data);
                
//                 End editable forms
                
                $title = __DB_CUSTOMERS_NIP__;
                echo form_label("NIP", $title);
                echo form_input($title);
                
//                 $title = __DB_CUSTOMERS_OTHERS__;
//                 echo form_label("Inne",$title);
//                 echo form_textarea($title);
                
                echo form_submit("Submit", "Dodaj!");
                echo form_close();
                
               
        	?>
        </div>
        <div class="col-md-3"></div>
<!--          </div> -->

    </body>
</html>