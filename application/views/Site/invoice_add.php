<?php
    echo form_open("invoice_controller/invoice_add", array("id" => "mainForm"));
?>

<div class="row margines-top panel">
    <div class="col-md-4"></div>
    <div class="col-md-4">
    	<?php
        	require "parts/invoice_form.php";
        ?>
   </div>
   <div class="col-md-4"></div>
</div>
   
<div class="row">
   <div class="col-md-3"></div>
        <div class="col-md-6">
            <table border="1" width="100%">
            	<thead>
            		<th class="jsclass2">Nazwa</th>
            		<th class="jsclass3">J.M.</th>
            		<th class="jsclass3">Ilość</th>
            		<th class="jsclass4">Cena netto</th>
            		<th class="jsclass"><button type="button" id="addInvoice">+</button></th>
            		<th class="jsclass"><button type="button" id="removeInvoice">-</button></th>
            	</thead>
            	<tbody id="tContainer">
            		
            	</tbody>
            </table>
        </div>	
    <div class="col-md-3"></div>    
</div>
	
<?php
    echo form_submit("Submit", "Dodaj fakturę")."</br>";
    echo form_close();
?>

<div class="row">
    <div class="col-md-4"></div>
        <div class="col-md-4">
            <?php	
            	include "parts/customer_add_modal.php";
            ?>
        </div>
        <div class="col-md-4"></div>
</div>
    <!--         	<div class="col-md-"></div> -->
<script>
	var rootLocation = "<?php echo base_url(); ?>";
</script>
<script src='<?php echo base_url()."js/tableController.js"; ?>'></script>
<script src='<?php echo base_url()."js/modalController.js"; ?>'></script>
<script type="text/javascript">
	var dateId = "#<?php echo __DB_INVOICES_DATE__; ?>";
	var deadlineId = "#<?php echo __DB_INVOICES_PAYMENTDEADLINE__; ?>";
	var paymentMethod = "#<?php echo __DB_INVOICES_PAYMENTMETHOD__; ?>";
	
	Date.prototype.toDateInputValue = (function() {
	    var local = new Date(this);
	    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
	    return local.toJSON().slice(0,10);
	});

	function setPaymentMethod(){
		$(paymentMethod).val("przelew");
	}
	
	function setDate(){
		$(dateId).val(new Date().toDateInputValue());
	}

	function setDeadline(){
		$(deadlineId).val(new Date(+new Date + 12096e5).toDateInputValue());
	}
	
	$(document).ready(function(){
		setDate();
		setDeadline();
		setPaymentMethod();
	});
</script>