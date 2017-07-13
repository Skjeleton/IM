<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/tuwstawcochcesz">
    </head>
    <body>
        <div class="row margines-top">
    		<div class="panel">
            	<?php
                    echo form_open("invoice_controller/customer_edit");
                    echo form_hidden(__DB_CUSTOMERS_CUSTOMERID__, $fromController[__DB_CUSTOMERS_CUSTOMERID__]);
                    
                    $title = __DB_CUSTOMERS_NAME__;
                    echo form_label("Nazwa", $title);
                    echo form_input($title, $fromController[$title]);
                    
                    $title = __DB_CUSTOMERS_COUNTRY__;
                    echo form_label("Państwo", $title);
                    echo form_input($title, $fromController[$title]);
                    
                    $title = __DB_CUSTOMERS_CITY__;
                    echo form_label("Miasto", $title);
                    echo form_input($title, $fromController[$title]);
                    
                    $title = __DB_CUSTOMERS_POSTALCODE__;
                    echo form_label("Kod pocztowy", $title);
                    echo form_input($title, $fromController[$title]);
                    
                    $title = __DB_CUSTOMERS_STREET__;
                    echo form_label("Ulica", $title);
                    echo form_input($title, $fromController[$title]);
                    
                    $title = __DB_CUSTOMERS_HOUSENUMBER__;
                    echo form_label("Numer domu", $title);
                    echo form_input($title, $fromController[$title]);
                    
                    $title = __DB_CUSTOMERS_APARTMENTNUMBER__;
                    echo form_label("Numer lokalu", $title);
                    echo form_input($title, $fromController[$title]);
                    
                    $title = __DB_CUSTOMERS_NIP__;
                    echo form_label("NIP", $title);
                    echo form_input($title, $fromController[$title]);
                    
                    echo form_submit("Submit", "Dokonaj zmian");
                    echo form_close();
            	?>
     		</div>	
         </div>
    </body>
</html>