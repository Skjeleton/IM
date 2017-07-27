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
            	echo form_open("invoice_controller/invoice_add", array("id" => "mainForm"));
            	
            	require "parts/invoice_form.php";
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
		 <button type="button" onclick="phpAddCustomer()">ajax</button>
		 <p id="ajaxReturn">halo</p>
		 <script src='<?php echo base_url()."js/tableController.js"; ?>'></script>
		 <script type="text/javascript">
			var dateId = "#<?php echo __DB_INVOICES_DATE__; ?>";
			var deadlineId = "#<?php echo __DB_INVOICES_PAYMENTDEADLINE__; ?>";

			Date.prototype.toDateInputValue = (function() {
			    var local = new Date(this);
			    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
			    return local.toJSON().slice(0,10);
			});
			
			function setDate(){
				$(dateId).val(new Date().toDateInputValue());
			}

			function setDeadline(){
				$(deadlineId).val(new Date(+new Date + 12096e5).toDateInputValue());
			}
			
			$(document).ready(function(){
				setDate();
				setDeadline();
			});
		 </script>
		 <script>
			function removeCustomer(){
				$("#customerAdd").addClass("HiddenElement");
				$("#bCustomer").html("Dodaj");
				$("#bCustomer").off("click");
				$("#bCustomer").click(addCustomer);
			}
		 
			function addCustomer(){
				$("#customerAdd").removeClass("HiddenElement");
				$("#bCustomer").html("Ukryj");
				$("#bCustomer").off("click");
				$("#bCustomer").click(removeCustomer);
			}

			$(document).ready(function(){
				$("#bCustomer").click(addCustomer);
			});
		 </script>
		 <script>
			function fetchCustomerForm(){
				var data[];
				var inputs = $("#customerAdd").find("input");
				console.log(inputs);
				inputs.forEach(function(){
					var name = $(this).attrib("name");
					var value = $(this).attrib("value");
					alert(name + " " + value);
					data[name] = value;
				});
				return data;
			}
		 
			function phpAddCustomer(){
				var formData = fetchCustomerForm();
				$.ajax({
		            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
		            url         : "<?php echo base_url(); ?>index.php/customer_controller/customer_add/1",
		            data        : formData, // our data object
		            dataType    : 'json', // what type of data do we expect back from the server
		            encode          : true
		        }).done(function(data) {

	                // log data to the console so we can see
	                console.log(data); 

	                // here we will handle errors and validation messages
	            });
			}
		 </script>
	</body>
</html>