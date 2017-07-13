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
<div class="container margines-top">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Numer faktury</th>
                <th>Data</th>
                <th>Nazwa</th>
                <th>Wartość brutto</th>
                <th>Termin płatności</th>
                <th></th>
            </tr>
        </thead>
            <tbody>
            <?php foreach($fromController as $invoices){
                echo "<tr>";
                
                echo "<td>".$invoices[__DB_INVOICES_INVOICENUMBER__]."</td>";
                
                echo "<td>".$invoice[__DB_INVOICES_DATE__]."</td>";
                
                echo "<td>".$invoice[__DB_CUSTOMERS_NAME__]."</td>";
                
                echo "<td>".$invoice["GrossValue"]."</td>";
                
                echo "<td>".$invoice[__DB_INVOICES_PAYMENTDEADLINE__]."</td>";
            
                echo "<td><a class='button' href='".base_url()."wpisz sciezke do invoice_edit".$Invoices[__DB_INVOICES_INVOICEID__]."'>Edytuj</a>";
      	     
                
      	     </tbody>
    </table>
</div>
    
    
	</body>
</html>