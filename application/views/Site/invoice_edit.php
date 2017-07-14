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
		 <div class="col-md-5"></div>
		 <div class="col-md-2">
        	<?php
                echo form_open("invoice_controller/customer_edit");
                echo form_hidden(__DB_CUSTOMERS_CUSTOMERID__, $fromController[__DB_CUSTOMERS_CUSTOMERID__]);
                
                $title = __DB_INVOICES_INVOICENUMBER___;
                echo form_label("Faktura VAT nr", $title)."</br>";
                echo form_input($title, $fromController[$title])."</br>";
                
                $title = __DB_INVOICES_DATE__;
                echo form_label("Data faktury", $title)."</br>";
                echo form_input($title, $fromController[$title])."</br>";
                
                $title = __DB_CUSTOMERS____;
                echo form_label("Klient", $title)."</br>";
                echo form_input($title, $fromController[$title])."</br>";
                
                $title = __DB_INVOICES_PAYMENTDEADLINE____;
                echo form_label("Termin płatności", $title)."</br>";
                echo form_input($title, $fromController[$title])."</br>";
                
                $title = __DB_INVOICES_PAYMENTDEADLINE__;
                echo form_label("Forma płatności", $title)."</br>";
                echo form_input($title, $fromController[$title])."</br>";
               ?> 
               
               <table border="1">
            	<thead>
            		<th>Nazwa</th>
            		<th>J.M.</th>
            		<th>Ilość</th>
            		<th>Cena netto</th>
            		<th><button type="button" id="addInvoice">+</button></th>
            	</thead>
            	<tbody id="tContainer">
            		
            	</tbody>
            </table>
            <?php 
                echo form_submit("Submit", "Dokonaj zmian")."</br>";
                echo form_close();
            ?>
        	</div>
        	<div class="col-md-5"></div>
		 </div>        	
         </div>
         
         		 <script>
				var rowsNo = 0;
		 
				function addTableCell(tableRef, columnNo){
					var content = "<input type='text' name='tData_" + rowsNo + "_" + columnNo + "'></input>";
					tableRef.append("<td>"+content+"</td>");
				}
		
				function addTableRow(tableRef){
					tableRef.append("<tr>");
					for(var i = 0; i < 4 ; i++ )
						addTableCell(tableRef, i);
					tableRef.append("</tr>");
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