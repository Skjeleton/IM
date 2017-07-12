<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style.css">

<body>
	<div class="container">
		<div class="panel">
        	<form>
            	<label for="username">Imie</label></br>
               	<input type="text" id="Name" name="Name"></br>
               	<label for="username">Nazwisko</label></br>
               	<input type="text" id="Surname" name="Surname"></br>
				<label for="firma">Państwo</label></br>
               	<input type="text" id="Country" name="Country"></br>
				<label for="firma">Kod Pocztowy</label></br>
               	<input type="text" id="PostalCode" name="PostalCode"></br>
               	<label for="firma">Adres</label></br>
               	<input type="text" id="Street" name="Street"></br>
               	<label for="firma">Numer bloku</label></br>
               	<input type="text" id="HouseNo" name="HouseNo"></br>
               	<label for="firma">Numer drzwi</label></br>
               	<input type="text" id="ApartmentNo" name="ApartmetNo"></br>
               	<label for="firma">NIP</label></br>
               	<input type="text" id="NIP" name="NIP"></br>
                
                	<div class="lower">
            		<input type="submit" value="Dodaj"></br>
    				</div>
			</form>
		</div>
	</div>
	
	<pre><?php var_dump(get_defined_vars());?></pre>
</body>


</html>