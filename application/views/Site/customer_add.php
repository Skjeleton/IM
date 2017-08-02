<pre><?php var_dump($fromController); ?></pre>
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