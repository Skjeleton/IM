<?php
    /*
     *  $fromController[0-?][__DB_CUSTOMERS_NAME__]
     *                      [__DB_CUSTOMERS_CUSTOMERID__]
     *                      ["Address"]
     */
?>


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
                
                echo "<td>".$customer[__DB_CUSTOMERS_NAME__]."</td>";
                echo "<td>".$customer["Address"]."</td>";
                echo "<td><a class='button' href='".base_url()."index.php/customer_controller/customer_edit_view/".$customer[__DB_CUSTOMERS_CUSTOMERID__]."'>Edytuj</a>";
                
                echo "</tr>";
            
            }
            ?>
            
      	  </tbody>
    </table>
</div>