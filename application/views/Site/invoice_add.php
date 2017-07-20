<html>
	<head>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.css">
        <meta charset="UTF-8">
	</head>
	
	<body>
		 <div class="row margines-top panel">
		 <div class="col-md-4"></div>
		 <div class="col-md-4">
        	<?php
            	echo form_open("invoice_controller/invoice_add");
            	
            	$title = __DB_INVOICES_INVOICENUMBER__;
            	echo form_label("Faktura VAT nr.", $title)."</br>";
            	echo form_input($title, $fromController["LastNumber"])."</br>";
            	
            	
            	echo form_fieldset();

            	echo form_label("Data");
            	$data = array(
            	    "name" => __DB_INVOICES_DATE__,
            	    "type" => "date",
            	    "class" => "dataId"
            	);
            	echo form_input($data);
            	
            	$data = array(
            	    "name" => __DB_INVOICES_PAYMENTDEADLINE__,
            	    "type" => "date",
            	    "class" => "dataId",
            	);
            	echo form_input($data);
            	echo form_fieldset_close();
            	
                $data = array(
            	    'name' => __DB_INVOICES_CUSTOMER__,
            	    'class' => 'dropDownCustomers'
            	    );
            	echo form_label("Klient");
            	echo form_dropdown($data, $fromController);
            	
            	$title = __DB_INVOICES_PAYMENTMETHOD__;
            	echo form_label("Forma płatności", $title)."</br>";
            	echo form_input($title)."</br>";
            	
            	$data = array(
            	    'title' => __DB_INVOICES_OTHERS__,
            	    'class' => 'TextArea'
            	);
            	echo form_label("Inne")."</br>";
            	echo form_textarea($data)."</br>";
            	
            ?>
            	
            <table border="1px" width="100%">
            	<thead>
            		<th class="jsclass">Nazwa</th>
            		<th class="jsclass">J.M.</th>
            		<th class="jsclass">Ilość</th>
            		<th class="jsclass">Cena netto</th>
            		<th class="jsclass"><button type="button" id="addInvoice">+</button></th>
            		<th class="jsclass"><button type="button" id="removeInvoice">-</button></th>
            	</thead>
            	<tbody id="tContainer">
            		
            	</tbody>
            </table>
            	
            <?php	
            	echo form_submit("Submit", "Dodaj fakturę")."</br>";
            	echo form_close();
        	?>
        	</div>
<!--         	<div class="col-md-"></div> -->
		 </div>
		 <script src='<?php echo base_url()."js/tableController.js"; ?>'></script>
	</body>
</html>