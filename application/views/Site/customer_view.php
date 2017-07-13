<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
   



</head>

<body>

<div class="kupa">
</div>
<div class="container">
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
</table></div>
</body>
</html>
