<?php
    /*
     * $fromController[__DB_CUSTOMERS_CUSTOMERID__]
     *                [__DB_CUSTOMERS_NAME__]
     *                [__DB_CUSTOMERS_COUNTRY__]
     *                [__DB_CUSTOMERS_CITY__]
     *                [__DB_CUSTOMERS_POSTALCODE__]
     *                [__DB_CUSTOMERS_STREET__]
     *                [__DB_CUSTOMERS_HOUSENUMBER__]
     *                [__DB_CUSTOMERS_APARTMENTNUMBER__]
     *                [__DB_CUSTOMERS_NIP__]
     *                [__DB_CUSTOMERS_OTHERS__]
     */
?>
<div class="row margines-top panel">
	 <div class="col-md-4"></div>
	 <div class="col-md-4">
    	<?php
            echo form_open("customer_controller/customer_edit");
            echo form_hidden(__DB_CUSTOMERS_CUSTOMERID__, $fromController[__DB_CUSTOMERS_CUSTOMERID__]);
            
            require "parts/customer_form.php";
            
            echo form_submit("Submit", "Zapisz zmiany")."</br>";
            echo form_close();
    	?>
     </div>
 </div>