<html>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/bootstrap.css">



<div class="container table-margin">
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



