<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/tuwstawcochcesz">
</head>
<body>

<div class="row margin-topes">
<center>	
		<div class="panel">
        	<form metod="post">

              		<label for="username">Imie</label></br>
                   		<input type="text" id="<?php echo __DB_CUSTOMERS_NAME__ ?>" name="<?php echo __DB_CUSTOMERS_NAME__ ?>"></br>
    				<label for="country">Państwo</label></br>
                   		<input type="text" id="<?php echo __DB_CUSTOMERS_COUNTRY__ ?>" name="<?php echo __DB_CUSTOMERS_COUNTRY__ ?>"></br>
    				<label for="postalcode">Kod Pocztowy</label></br>
                   		<input type="text" id="<?php echo __DB_CUSTOMERS_POSTALCODE__ ?>" name="<?php echo __DB_CUSTOMERS_POSTALCODE__ ?>"></br>
                   	<label for="adress">Adres</label></br>
                   		<input type="text" id="<?php echo __DB_CUSTOMERS_STREET__ ?>" name="<?php echo __DB_CUSTOMERS_STREET__ ?>"></br>
                   	<label for="houseno">Numer bloku</label></br>
                   		<input type="text" id="<?php echo __DB_CUSTOMERS_HOUSENUMBER__ ?>" name="<?php echo __DB_CUSTOMERS_HOUSENUMBER__ ?>"></br>
                   	<label for="apartmenno">Numer drzwi</label></br>
                   		<input type="text" id="<?php echo __DB_CUSTOMERS_APARTMENTNUMBER__ ?>" name="<?php echo __DB_CUSTOMERS_APARTMENTNUMBER__ ?>"></br>
                   	<label for="nip">NIP</label></br>
                   		<input type="text" id="<?php echo __DB_CUSTOMERS_NIP__ ?>" name="<?php echo __DB_CUSTOMERS_NIP__ ?>"></br>
 </center> 




</body>
</html>