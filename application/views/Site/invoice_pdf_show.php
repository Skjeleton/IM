<html>
<head>	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.css">
        <meta charset="UTF-8">
        <title><?php echo $fromController[__DB_INVOICES_INVOICENUMBER__]; ?></title>
</head>
<body>
<div class="mainContainer">
	<div class="row">
		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"><img alt="Image_failt_to_look_or_download" src="<?php echo base_url(); ?>css/abastra.jpg" width="120%" height="200px" left="0px"></img></div>
		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
    		 <div class="panel-group">
             	<div class="panel panel-default">
             		<div class="panel-heading"><h4>FAKTURA VAT</h4></div>
         			<div class="panel-body">
                 		<h4>Faktura VAT nr <?php echo $fromController[__DB_INVOICES_INVOICENUMBER__]; ?></h4>
                 		<h4>Data <?php echo $fromController[__DB_INVOICES_DATE__]; ?> </h4>
             		</div>
				</div>
			</div>
		</div>
	</div>

<!-- 	Start Buyer -->
	<div class="row">
		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
			<div class="panel-group">
             	<div class="panel panel-default">
             		<div class="panel-heading"><H4>NABYWCA:</H4></div>
             		<div class="panel-body">
             		<h4><strong><?php echo $fromController[__DB_CUSTOMERS_NAME__]; ?></strong></h4> 
             		<h4><?php echo $fromController[__DB_CUSTOMERS_STREET__]; ?></h4>
             		<h4><?php echo $fromController[__DB_CUSTOMERS_POSTALCODE__];?> <?php echo $fromController[__DB_CUSTOMERS_CITY__]; ?></h4> 
             		<h4><?php echo $fromController[__DB_CUSTOMERS_COUNTRY__]; ?></h4></br>
             		<h4><strong>NIP <?php echo $fromController[__DB_CUSTOMERS_NIP__]; ?></strong></h4>
<!--              			Content -->
             		</div>
    			</div>
			</div>
		</div>
<!-- 		End Buyer -->
<!-- 	Start Seller -->
		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
			<div class="panel-group">
             	<div class="panel panel-default">
             		<div class="panel-heading"><H4>SPRZEDAWCA:</H4></div>
             		<div class="panel-body">
             		<h4><strong>ABASTRA Sp. z.o.o</strong></h4> 
             		<h4>ul. 11Listopada 79/28</h4>
             		<h4>91-372 Łódź</h4> 
             		<h4>Polska</h4></br>
             		<h4><strong>NIP		9471974189</strong></h4>
<!--              			Content -->
             		</div>
    			</div>
			</div>
		</div>
	</div>
<!-- 		End Seller -->
<!-- 		Start articles -->


    <table class="table table-bordered">
        <thead>
            <tr>
                <th><h5>L.p</h5></th>
                <th><h5>Nazwa</h5></th>
                <th><h5>J.M</h5></th>
                <th><h5>Ilość</h5></th>
                <th><h5>Cena jed. netto</h5></th>
                <th><h5>Wartość netto</h5></th>
                <th><h5>VAT%</h5></th>
                <th><h5>Wartość VAT</h5></th>
                <th><h5>Wartość brutto</h5></th>
            </tr>
        </thead>
        <tbody>
			<?php
                foreach($fromController[__DB_TRANSACTIONS__] as $key => $transaction){
                echo "<tr>";
                    echo "<td>".($key+1)."</td>";
                    echo "<td>".$transaction[__DB_TRANSACTIONS_NAME__]."</td>";
                    echo "<td>".$transaction[__DB_TRANSACTIONS_MEASUREUNIT__]."</td>";
                    echo "<td>".$transaction[__DB_TRANSACTIONS_COUNT__]."</td>";
                    echo "<td>".$transaction[__DB_TRANSACTIONS_NETUNITPRICE__]."</td>";
                    echo "<td>".$transaction[__DB_TRANSACTIONS_NETVALUE__]."</td>";
                    echo "<td> 23%</td>";
                    echo "<td>".$transaction[__DB_TRANSACTIONS_VATVALUE__]."</td>";
                    echo "<td>".$transaction[__DB_TRANSACTIONS_GROSSVALUE__]."</td>";
     			echo "</tr>";
                }
 			?>
        </tbody>
    </table>

<!-- 		End articles -->

<!-- Panel info start -->
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">

		</div>
       	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 prawo">
            <div class="panel panel-info">
            	<table class="table table-bordered">
            		<tr>
            			<td><strong>Razem</strong></td><td><?php echo $fromController[__DB_INVOICES_NETVALUE__]?></td><td>23%</td><td><?php echo $fromController[__DB_INVOICES_VATVALUE__]?></td><td><?php echo $fromController[__DB_INVOICES_GROSSVALUE__]?></td>
            		</tr>
            		<tr>
            			<td><strong>Z czego</strong></td><td><?php echo $fromController[__DB_INVOICES_NETVALUE__]?></td><td>23%</td><td><?php echo $fromController[__DB_INVOICES_VATVALUE__]?></td><td><?php echo $fromController[__DB_INVOICES_GROSSVALUE__]?></td>
            		</tr>
            	</table>
            <div class="panel-heading">
                <div class="row">
                	<div class="col-xs-4"><strong>Do zaplaty</strong></div>
                	<div class="col-xs-4"><strong><?php echo $fromController[__DB_INVOICES_GROSSVALUE__]?></strong></div>
                </div>
            </div>
            </div>
    	</div>
    </div>

<div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<table class="table table-bordered tableDuing">
					<tr>
						<td><strong>Nazwa banku</strong></td> 
						<td>Alior Bank S.A.</td>
					</tr>
					<tr>
						<td><strong>Adres</strong></td> 
						<td>Al.Jerozolimskie 94, 00-807 Warszawa</td>
					</tr>
					<tr>
						<td><strong>BIC/SWIFT CODE</strong></td> 
						<td>ALBPPLPW</br>
						ABASTRA sp. z o.o.</td>
					</tr>
					<tr>
						<td><strong>Numer rachunku</strong></td> 
						<td>98 2490 0005 0000 4520 3585 2559</td>
					</tr>
					<tr>
						<td><strong>IBAN</strong></td> 
						<td>PL98249000050000452035852559</td>
					</tr>
				</table>
	</div>
</div>

<!-- Method payment and expirient date -->
    <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
            		<table class="table table-bordered">
            			<tr>
            				<thead>
                				<th><strong>Termin płatności</strong></th>
                				<th><strong>Forma płatności</strong></th>
                			</thead>
            			</tr>
            				<tbody>
           						 <tr>
                					<td><?php echo $fromController[__DB_INVOICES_PAYMENTDEADLINE__]; ?></td>
                					<td><?php echo $fromController[__DB_INVOICES_PAYMENTMETHOD__]; ?></td>
                				 </tr>
                			</tbody>
            		</table>
        </div>
	</div>
<!-- END Method payment and expirient date -->
</div>
</body>
</html>