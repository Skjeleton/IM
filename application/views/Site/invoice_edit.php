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
            	echo form_open("invoice_controller/invoice_edit/".$fromController[__DB_INVOICES_INVOICEID__]);
            	
            	echo form_hidden(__DB_INVOICES_INVOICEID__, $fromController[__DB_INVOICES_INVOICEID__]);
            	
            	$title = __DB_INVOICES_INVOICENUMBER__;
            	echo form_label("Faktura VAT nr.", $title)."</br>";
            	echo form_input($title, $fromController[__DB_INVOICES_INVOICENUMBER__])."</br>";
            	
            	$data = array(
            	    'name' => __DB_INVOICES_DATE__,
            	    'type' => 'date',
            	    'class' => 'dataId'
            	);
            	echo form_label("Data faktury / Termin płatności");
            	echo form_input($data,$fromController[__DB_INVOICES_DATE__]);
            	
            	$data = array(
            	    'name' => __DB_INVOICES_PAYMENTDEADLINE__,
            	    'type' => 'date',
            	    'class' => 'dataId'
            	);
            	echo form_input($data, $fromController[__DB_INVOICES_PAYMENTDEADLINE__]);
            	
            	$data = array(
            	    'name' => __DB_INVOICES_CUSTOMER__,
            	    'class' => 'dropDownCustomers'
            	);
            	echo form_label("Klient")."</br>";
            	echo form_dropdown($data, $fromController[__DB_CUSTOMERS__], $fromController[__DB_INVOICES_CUSTOMER__])."</br>";
            	
            	
            	
            	$title = __DB_INVOICES_PAYMENTMETHOD__;
            	echo form_label("Forma płatności", $title)."</br>";
            	echo form_input($title, $fromController[$title])."</br>";
            	
            	$title = __DB_INVOICES_OTHERS__;
            	echo form_label("Inne",$title)."</br>";
            	echo form_textarea($title,$fromController[$title])."</br>";
            ?>
            	
            <table border="1" width="100%">
            	<thead>
            		<th class="jsclass">Nazwa</th>
            		<th class="jsclass">J.M.</th>
            		<th class="jsclass">Ilość</th>
            		<th class="jsclass">Cena netto</th>
            		<th class="jsclass"><button type="button" id="addInvoice">+</button></th>
            		<th class="jsclass"><button type="button" id="removeInvoice">-</button></th>
            	</thead>
            	<tbody id="tContainer">
            		<?php
            		  foreach($fromController[__DB_TRANSACTIONS__] as $key => $transaction){
            		      echo "<tr id='row".$key."'>";
            		      for($i = 0; $i < 4 ; $i++ ){
            		          $i == 0 AND $title = __DB_TRANSACTIONS_NAME__;
            		          $i == 1 AND $title = __DB_TRANSACTIONS_MEASUREUNIT__;
            		          $i == 2 AND $title = __DB_TRANSACTIONS_COUNT__;
            		          $i == 3 AND $title = __DB_TRANSACTIONS_NETUNITPRICE__;
            		          echo "<td>";
            		          echo "<input type='text' name='tData_".$key."_".$i."' value='".$transaction[$title]."'></input></td>";
            		      }
            		      echo "<td></td>";
                          echo "<td><button type='button' id='button".$key."'>-</button></td>"; 
            		      echo form_hidden("tData_".$key."_id", $transaction[__DB_TRANSACTIONS_TRANSACTIONID__]);
            		      
            		      echo "</tr>";
            		  }
            		?>
            	</tbody>
            </table>
            
            	
            <?php	
                $data = array(
                    'name'          => 'button',
                    'id'            => 'button',
                    'value'         => 'true',
                    'type'          => 'button',
                    'content'       => 'PDF',
                    'onclick'       => 'redirectPDF()'
                );
                echo form_button($data);
            	echo form_submit("Submit", "Edytuj fakturę")."</br>";
            	echo form_close();
        	?>
        	</div>
        	<div class="col-md-4"></div>
		 </div>
		 <script src='<?php echo base_url()."js/tableController.js"; ?>'></script>
		 <script>
		 	function redirectPDF(){
		 		window.location.replace('<?php echo base_url()."index.php/invoice_controller/invoice_pdf_view/".$fromController[__DB_INVOICES_INVOICEID__]; ?>');
		 	}
		 </script>
	</body>
</html>