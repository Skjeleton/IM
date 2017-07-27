<div id="customerAddModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?php 
                echo form_open(null);
                include "customer_form.php";
                echo form_submit("Submit", "Dodaj użytkownika");
            ?>
        </div>
    </div>
</div>