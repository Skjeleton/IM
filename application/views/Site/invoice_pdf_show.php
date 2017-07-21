<html>
<head>	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.css">
        <meta charset="UTF-8">
</head>
<body>
<div class="mainContainer">
	<div class="row">
		<div class="col-lg-6"><img src="<?php echo base_url(); ?>css/abastra.jpg>"></img></div>
		<div class="col-lg-6">
    		 <div class="panel-group">
             	<div class="panel panel-default">
             		<div class="panel-heading"><h4>FAKTURA VAT</h4></div>
             		<div class="panel-body">
                 		<h4>Faktura VAT nr</h4> <div class="text-right"><?php echo $fromController[__DB_INVOICES_INVOICENUMBER__]; ?></div>
                 		<h4>Data</h4> <div class="text-right"><?php echo $fromController[__DB_INVOICES_DATE__]; ?>
                 		</div>
    				</div>
				</div>
			</div>
		</div>
	</div>
<!-- 	Start Buyer -->
	<div class="row">
		<div class="col-lg-6">
			<div class="panel-group">
             	<div class="panel panel-default">
             		<div class="panel-heading"><H4>NABYWCA</H4></div>
             		<div class="panel-body">
             		<h4><strong><?php echo $fromController[__DB_CUSTOMERS_NAME__]; ?></strong></h4> 
             		<h4><?php echo $fromController[__DB_CUSTOMERS_STREET__]; ?></h4>
             		<h4><?php echo $fromController[__DB_CUSTOMERS_POSTALCODE__]; echo $fromController[__DB_CUSTOMERS_CITY__]; ?></h4> 
             		<h4><?php echo $fromController[__DB_CUSTOMERS_COUNTRY__]; ?></h4></br>
             		<h4><strong>NIP <?php echo $fromController[__DB_CUSTOMERS_NIP__]; ?></strong></h4>
<!--              			Content -->
             		</div>
    			</div>
			</div>
		</div>
<!-- 		End Buyer -->
<!-- 	Start Seller -->
		<div class="col-lg-6">
			<div class="panel-group">
             	<div class="panel panel-default">
             		<div class="panel-heading"><H4>SPRZEDAWCA</H4></div>
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
                <th><h4>L.p</h4></th>
                <th><h4>Nazwa</h4></th>
                <th><h4>J.M</h4></th>
                <th><h4>Ilość</h4></th>
                <th><h4>Cena jed. netto</h4></th>
                <th><h4>Wartość netto</h4></th>
                <th><h4>VAT%</h4></th>
                <th><h4>Wartość VAT</h4></th>
                <th><h4>Wartość brutto</h4></th>
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
                    echo "<td>".$transaction["netValue"]."</td>";
                    echo "<td>".$transaction["vat"]."</td>";
                    echo "<td>".$transaction["vatValue"]."</td>";
                    echo "<td>".$transaction["grossValue"]."</td>";
     			echo "</tr>";
                }
 			?>
        </tbody>
    </table>

<!-- 		End articles -->

<!-- Panel info start -->
    <div class="row">
        <div class="col-xs-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4>Konto</h4>
                </div>
                    <div class="panel-body">
                        <div class="row">
                             <div class="col-md-6">
								<table>
									<tr>
										<td><strong>Nazwa banku</strong></td>
										<td><strong>Adres</strong></td>
										<td><strong>BIC/SWIFT CODE</strong></td>
										<td></td>
										<td><strong>Numer rachunku</strong></td>
										<td><strong>IBAN</strong></td>
									</tr>
									<tr>
										<td>Alior Bank S.A.</td>
										<td>Al.Jerozolimskie 94, 00-807 Warszawa</td>
										<td>ALBPPLPW</td>
										<td>ABASTRA sp. z o.o.</td>
										<td>98 2490 0005 0000 4520 3585 2559</td>
										<td>PL98249000050000452035852559</td>
									</tr>
								</table>
                            </div>
                            <div class="col-md-6">
                            </div>
                    	</div> 
                	</div>
            </div>
        </div>
        	<div class="col-xs-6">
            <div class="panel panel-info">
                <div class="panel-body">
                	<div class="row">
                    	<div class="col-xs-3"><h4>Razem</h4></div>
                    	<div class="col-xs-2"></div>
                    	<div class="col-xs-2"></div>
                    	<div class="col-xs-2"></div>
                    	<div class="col-xs-3"></div>
                	</div>
                </div>
                <div class="panel-heading">
                    <div class="row">
                    	<div class="col-xs-8"><h4 class="text-center"><strong>Do zaplaty</strong></h4></div>
                    	<div class="col-xs-4">CENA</div>
                    </div>
                </div>
            </div>
    	</div>
    </div>
<!-- Panel info end -->

<!-- Total -->
    <div class="row">
        
    </div>
    
<!-- END Total -->


<!-- Method payment and expirient date -->
    <div class="row">
        <div class="col-xs-4">
            <div class="panel panel-info">
            	<div class="panel-body">
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
        </div>
	</div>
<!-- END Method payment and expirient date -->
</div>
</body>
</html>