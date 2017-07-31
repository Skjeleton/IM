 <div class="Kontener"> <?php echo form_open("invoice_controller/invoice_edit/".$fromController[__DB_INVOICES_INVOICEID__], array("id" => "mainForm")); ?>
 <div class="row margines-top panel">
     <div class="col-md-4"></div>
     <div class="col-md-4">
	<?php
    	echo form_hidden(__DB_INVOICES_INVOICEID__, $fromController[__DB_INVOICES_INVOICEID__]);
    	
    	require "parts/invoice_form.php";
    ?>
    </div>
    <div class="col-md-4"></div>
 </div>
    
    <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
    


    	
    <table border="1" class="TableStyle">
    	<thead>
    		<th class="jsclass2">Nazwa</th>
    		<th class="jsclass4">J.M.</th>
    		<th class="jsclass">Ilość</th>
    		<th class="jsclass3">Cena netto</th>
    		<th class="jsclass"><button type="button" id="addInvoice">+</button></th>
    		<th class="jsclass"><button type="button" id="removeInvoice">-</button></th>
    	</thead>
    	<tbody id="tContainer">
    		<?php
        		if(isset($fromController[__DB_TRANSACTIONS__])){
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
        		        echo "<td><button type='button' id='button".$key."' onclick='removeTransaction(".$key.")'>-</button></td>";
        		        echo form_hidden("tData_".$key."_id", $transaction[__DB_TRANSACTIONS_TRANSACTIONID__]);
        		        
        		        echo "</tr>";
        		    }
        		}   
    		?>
    	</tbody>
    </table>
   </div>
   </br>
	<div class="col-md-3"></div>
    </div>
    </br>
    <div class="col-md-4"></div>
     <div class="col-md-2">
      
                            <?php	
                                $data = array(
                                    'name'          => 'button',
                                    'id'            => 'button',
                                    'value'         => 'true',
                                    'type'          => 'button',
                                    'content'       => 'PDF',
                                    'onclick'       => 'redirectPDF()',
                                );
                                echo form_button($data); ?>
	</div>
    <div class="col-md-2">
    						<?php
                            	echo form_submit("Submit", "Edytuj fakturę")."</br>";
                            	echo form_close();
                            	
                            	include "parts/customer_add_modal.php";
                        	?>
    </div>
	<div class="col-md-4"></div>
     </div>
 <script>
	var rootLocation = "<?php echo base_url(); ?>";
 </script>
 <script src='<?php echo base_url()."js/tableController.js"; ?>'></script>
 <script src='<?php echo base_url()."js/modalController.js"; ?>'></script>
 <script>
 	function redirectPDF(){
 		window.location.replace('<?php echo base_url()."index.php/invoice_controller/invoice_pdf_view/".$fromController[__DB_INVOICES_INVOICEID__]; ?>');
 	}
 </script>
 </div>