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