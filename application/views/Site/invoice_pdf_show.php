
<html>
<head>	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
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
             		<div class="panel-heading"><h4><?php lang("faktura");?></h4></div>
         			<div class="panel-body">
         				<div class="row">
             				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                     			<h4><?php lang("fakturanr");?></h4>
                     		</div>
                     		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                     			<h4><?php echo $fromController[__DB_INVOICES_INVOICENUMBER__]; ?></h4>
                     		</div>
                 		</div>
                 		<div class="row">
             				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                 				<h4><?php lang("data");?></h4>
                 			</div>
             				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
             					<h4><?php echo $fromController[__DB_INVOICES_DATE__]; ?></h4>
             				</div>
             			</div>
             				
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
             		<div class="panel-heading"><H4><?php lang("nabywca");?>:</H4></div>
             		<div class="panel-body">
             		<h4><strong><?php echo $fromController[__DB_CUSTOMERS_NAME__]; ?></strong></h4> 
             		<h4><?php echo $fromController[__DB_CUSTOMERS_STREET__]; ?></h4>
             		<h4><?php echo $fromController[__DB_CUSTOMERS_POSTALCODE__];?> <?php echo $fromController[__DB_CUSTOMERS_CITY__]; ?></h4> 
             		<h4><?php echo $fromController[__DB_CUSTOMERS_COUNTRY__]; ?></h4></br>
             		<h4><strong>NIP <?php echo $fromController[__DB_CUSTOMERS_NIP__]; ?></strong></h4>
             		<h4><?php echo $fromController[__DB_INVOICES_OTHERS__]?></h4>
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
             		<div class="panel-heading"><H4><?php lang("sprzedawca");?>:</H4></div>
             		<div class="panel-body">
             		<h4><strong>ABASTRA Sp. z. o.o</strong></h4> 
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
                <th><h5><?php lang("nazwa");?></h5></th>
                <th><h5>J.M</h5></th>
                <th><h5><?php lang("ilosc");?></h5></th>
                <th><h5><?php lang("cenna_jednostkowa_netto");?> (<?php echo $fromController[__DB_INVOICES_CURRENCY__] ?>)</h5></th>
                <th><h5><?php lang("wartosc_netto");?> (<?php echo $fromController[__DB_INVOICES_CURRENCY__] ?>)</h5></th>
                <th><h5>VAT%</h5></th>
                <th><h5><?php lang("wartosc_vat");?> (<?php echo $fromController[__DB_INVOICES_CURRENCY__] ?>)</h5></th>
                <th><h5><?php lang("wartosc_brutto");?> (<?php echo $fromController[__DB_INVOICES_CURRENCY__] ?>)</h5></th>
            </tr>
        </thead>
        <tbody>
			<?php
                foreach($fromController[__DB_TRANSACTIONS__] as $key => $transaction){
                echo "<tr>";
                    echo "<td class='CenterTextInTable'>".($key+1)."</td>";
                    echo "<td>".$transaction[__DB_TRANSACTIONS_NAME__]."</td>";
                    echo "<td class='CenterTextInTable'>".$transaction[__DB_TRANSACTIONS_MEASUREUNIT__]."</td>";
                    echo "<td class='CenterTextInTable'>".$transaction[__DB_TRANSACTIONS_COUNT__]."</td>";
                    echo "<td class='RightTextInTable'>".$transaction[__DB_TRANSACTIONS_NETUNITPRICE__]."</td>";
                    echo "<td class='RightTextInTable'>".$transaction[__DB_TRANSACTIONS_NETVALUE__]."</td>";
                    echo "<td class='CenterTextInTable'> 23%</td>";
                    echo "<td class='RightTextInTable'>".$transaction[__DB_TRANSACTIONS_VATVALUE__]."</td>";
                    echo "<td class='RightTextInTable'>".$transaction[__DB_TRANSACTIONS_GROSSVALUE__]."</td>";
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
            			<td><strong><?php lang("razem");?></strong></td><td><?php echo $fromController[__DB_INVOICES_NETVALUE__]?></td><td>23%</td><td><?php echo $fromController[__DB_INVOICES_VATVALUE__]?></td><td><?php echo $fromController[__DB_INVOICES_GROSSVALUE__]?></td>
            		</tr>
            		<tr>
            			<td><strong><?php lang("zczego");?></strong></td><td><?php echo $fromController[__DB_INVOICES_NETVALUE__]?></td><td>23%</td><td><?php echo $fromController[__DB_INVOICES_VATVALUE__]?></td><td><?php echo $fromController[__DB_INVOICES_GROSSVALUE__]?></td>
            		</tr>
            	</table>
            <div class="panel-heading">
                <div class="row">
                	<div class="col-xs-4"><strong><?php lang("dozaplaty");?></strong></div>
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
						<td><strong><?php lang("nazwabanku");?></strong></td> 
						<td>Alior Bank S.A.</td>
					</tr>
					<tr>
						<td><strong><?php lang("adres");?></strong></td> 
						<td>Al.Jerozolimskie 94, 00-807 Warszawa</td>
					</tr>
					<tr>
						<td><strong>BIC/SWIFT CODE</strong></td> 
						<td>ALBPPLPW</br>
						ABASTRA sp. z o.o.</td>
					</tr>
					<tr>
						<td><strong><?php lang("numerrachunku");?></strong></td> 
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
                				<th><strong><?php lang("termin_platnosci");?></strong></th>
                				<th><strong><?php lang("metoda_platnosci");?></strong></th>
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