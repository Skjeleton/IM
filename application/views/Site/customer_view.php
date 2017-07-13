<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
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
            <?php foreach($customers as $customer){
                echo "<tr>";    
                
                echo "<td>".$customer["Name"]."</td>";
                echo "<td>".$customer["Address"]."</td>";
                echo "<td><button>Edytuj</button>";
                
                echo "</tr>";
            
            }
            ?>
            
      	  </tbody>
    </able>
</div>
</body>
</html>
