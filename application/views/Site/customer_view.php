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
                <th>Nazwa</th>
                <th>Adres</th>
                <th></th>
            </tr>
        </thead>
            <tbody>
            <?php foreach($fromController as $customer){
                echo "<tr>";    
                
                echo "<td>".$customer[__DB_CUSTOMERS_NAME__]."</td>";
                echo "<td>".$customer["Address"]."</td>";
                echo "<td><a class='button' href='".base_url()."index.php/customer_controller/customer_edit_view/".$customer[__DB_CUSTOMERS_CUSTOMERID__]."'>Edytuj</a>";
                
                echo "</tr>";
            
            }
            ?>
            
      	  </tbody>
    </table>
</div>
</body>
</html>
