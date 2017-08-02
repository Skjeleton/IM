<?php
    /*
     * $fromController[0-?][__DB_INVOICES_INVOICEID__]
     *                     [__DB_INVOICES_CUSTOMER__]
     *                     [__DB_INVOICES_INVOICENUMBER__]
     *                     [__DB_INVOICES_DATE__]
     *                     [__DB_INVOICES_PAYMENTDEADLINE__]
     *                     [__DB_INVOICES_PAYMENTMETHOD__]
     *                     [__DB_INVOICES_OTHERS__]
     *                     [__DB_INVOICES_NETVALUE__]
     *                     [__DB_INVOICES_VATVALUE__]
     *                     [__DB_INVOICES_GROSSVALUE__]
     *                     [__DB_INVOICES_CURRENCY__]
     *                     [__DB_INVOICES_LANGUAGE__]
     *                     [__DB_INVOICES_STATUS__]
     *                     [__DB_CUSTOMERS_NAME__]
     */
?>
<div class="container margines-top">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Numer faktury</th>
                <th>Data</th>
                <th>Nazwa</th>
                <th>Wartość netto</th>
                <th>Termin płatności</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach($fromController as $invoice){
                echo "<tr>";
                
                echo "<td>".$invoice[__DB_INVOICES_INVOICENUMBER__]."</td>";
                
                echo "<td>".$invoice[__DB_INVOICES_DATE__]."</td>";
                
                echo "<td>".$invoice[__DB_CUSTOMERS_NAME__]."</td>";
                
                echo "<td>".$invoice[__DB_INVOICES_NETVALUE__]."</td>";
                
                echo "<td>".$invoice[__DB_INVOICES_PAYMENTDEADLINE__]."</td>";
            
                echo "<td><a class='button' href='".base_url()."index.php/invoice_controller/invoice_edit_view/".$invoice[__DB_INVOICES_INVOICEID__]."'>Edytuj</a></td>";
           
                echo "<td><a class='button' href='".base_url()."index.php/invoice_controller/invoice_pdf_view/".$invoice[__DB_INVOICES_INVOICEID__]."'>Podgląd</a></td>";
                
                echo "<td><a class='button' target='__blank' href='".base_url()."index.php/invoice_controller/invoice_pdf_download/".$invoice[__DB_INVOICES_INVOICEID__]."'>PDF</a></td></tr>";
                
                echo "<td><a class='button' href='".base_url()."index.php/invoice_controller/invoice_edit_view/".$invoice[__DB_INVOICES_INVOICEID__]."/true'>Duplikuj</a></td></tr>";
            } 
        ?></tbody>
    </table>
</div>