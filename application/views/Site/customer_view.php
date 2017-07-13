<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/tuwstawcochcesz">
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
                
                echo "<td>".$customer["Name"]."</td>";
                echo "<td>".$customer["Address"]."</td>";
                echo "<td><button>Edytuj</button>";
                
                echo "</tr>";
            
            }
            ?>
            
      	  </tbody>
    </table>
</div>
</body>
</html>
