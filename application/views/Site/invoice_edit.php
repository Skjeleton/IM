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
            	echo form_open("invoice_controller/invoice_edit");
            	
            	$title = __DB_INVOICES_INVOICENUMBER__;
            	echo form_label("Faktura VAT nr.", $title)."</br>";
            	echo form_input($title, $fromController[__DB_INVOICES__][$title])."</br>";
            	
            	$title = __DB_INVOICES_DATE__;
            	echo form_label("Data faktury", $title)."</br>";
            	echo form_input(array("name" => $title, "type" => "date"), $fromController[__DB_INVOICES__][$title])."</br>";
            	
            	$title = __DB_CUSTOMERS__;
            	echo form_label("Klient", $title)."</br>";
            	echo form_dropdown($title, $fromController[__DB_INVOICES__][$title], $fromController[__DB_INVOICES__][__DB_INVOICES_CUSTOMERID__])."</br>";
            	
            	$title = __DB_INVOICES_PAYMENTDEADLINE__;
            	echo form_label("Termin płatności", $title)."</br>";
            	echo form_input(array("name" => $title, "type" => "date"), $fromController[__DB_INVOICES__][$title])."</br>";
            	
            	$title = __DB_INVOICES_PAYMENTMETHOD__;
            	echo form_label("Forma płatności", $title)."</br>";
            	echo form_input($title, $fromController[__DB_INVOICES__][$title])."</br>";
            ?>
            	
            <table border="1" width="100%">
            	<thead>
            		<th>Nazwa</th>
            		<th>J.M.</th>
            		<th>Ilość</th>
            		<th>Cena netto</th>
            		<th><button type="button" id="addInvoice">+</button></th>
            	</thead>
            	<tbody id="tContainer">
            		<?php
            		  foreach($fromController[__DB_TRANSACTIONS__] as $key => $transaction){
            		      echo "<tr id='tRow_".$key."'>";
            		      for($i = 0; $i < 4 ; $i++ ){
            		          $i == 0 AND $title = __DB_TRANSACTIONS_NAME__;
            		          $i == 1 AND $title = __DB_TRANSACTIONS_MEASUREUNIT__;
            		          $i == 2 AND $title = __DB_TRANSACTIONS_COUNT__;
            		          $i == 3 AND $title = __DB_TRANSACTIONS_NETUNITPRICE__;
            		          echo "<td><input type='text' name='tData_".$key."_".$i."' value='".$transaction[$title]."'></input></td>";
            		      }
            		      echo "</tr>";
            		  }
            		?>
            	</tbody>
            </table>
            
            	
            <?php	
            	echo form_submit("Submit", "Dodaj fakturę")."</br>";
            	echo form_close();
        	?>
        	</div>
		 </div>
		 <script>
				var rowsNo = 0;

				function removeTableRow(rowNo){
					$("#tRow
							_"+rowNo).empty();
					$("#tRow_"+rowNo).remove();
					
				}
				 
				function addTableCell(tableRef, columnNo){
					var content = "<input type='text' name='tData_" + rowsNo + "_" + columnNo + "'></input>";
					return "<td>"+content+"</td>";
				}
		
				function addTableRow(tableRef){
					var toAppend = "";
					toAppend += "<tr id='tRow_"+rowsNo+"'>";
					for(var i = 0; i < 4 ; i++ )
						toAppend += addTableCell(tableRef, i);
					toAppend += "<td><button id='tButton_"+rowsNo+"' type='button'>-</button></td>";
					toAppend += "</tr>";
					$("#tContainer").append(toAppend);
					rowsNo++;
				}
		 
            	$(document).ready(function() {
            	    $("#addInvoice").click(function(){
                	    addTableRow($("#tContainer"));
            	    });
            	});    
		 </script>
	</body>
</html>