<?php
    /*
     * Upon including this file it will echo all the form fields needed to successfully add or modify an invoice.
     * WARNING: It contain neither form opening nor form closing so one should include this file between them.
     * 
     */


    //Making sure that variables which the file will be refering to later are defined. Controller can pass it's own values.
    if(!isset($fromController)) $fromController = array();
    if(!isset($fromController[__DB_INVOICES_INVOICENUMBER__])) $fromController[__DB_INVOICES_INVOICENUMBER__] = "";
    if(!isset($fromController[__DB_INVOICES_DATE__])) $fromController[__DB_INVOICES_DATE__] = "";
    if(!isset($fromController[__DB_INVOICES_PAYMENTDEADLINE__])) $fromController[__DB_INVOICES_PAYMENTDEADLINE__] = "";
    if(!isset($fromController[__DB_INVOICES_CUSTOMER__])) $fromController[__DB_INVOICES_CUSTOMER__] = "";
    if(!isset($fromController[__DB_INVOICES_PAYMENTMETHOD__])) $fromController[__DB_INVOICES_PAYMENTMETHOD__] = "";
    if(!isset($fromController[__DB_INVOICES_OTHERS__])) $fromController[__DB_INVOICES_OTHERS__] = "";

    //Echo field containing invoice's number    
    $data = array(
        'name' => __DB_INVOICES_INVOICENUMBER__
    );
    echo form_label("Faktura VAT nr.", $data["name"]);
    echo form_input($data, $fromController[__DB_INVOICES_INVOICENUMBER__]);
    
    //Echo field containing invoice's date  
    $data = array(
        'id' => __DB_INVOICES_DATE__,
        'name' => __DB_INVOICES_DATE__,
        'type' => 'date',
        'class' => 'dataId'
    );
    echo form_label("Data faktury / Termin płatności");
    echo form_input($data,$fromController[__DB_INVOICES_DATE__]);
    
    //Echo field containing invoice's payment deadline  
    $data = array(
        'id' => __DB_INVOICES_PAYMENTDEADLINE__,
        'name' => __DB_INVOICES_PAYMENTDEADLINE__,
        'type' => 'date',
        'class' => 'dataId'
    );
    echo form_input($data, $fromController[__DB_INVOICES_PAYMENTDEADLINE__]);
    
    //Echo dropdown containing available customers including information which one is selected (if invoice is being edited)
    $data = array(
        'name' => __DB_INVOICES_CUSTOMER__,
        'class' => 'dropDownCustomers'
    );
    echo form_label("Klient");
    echo form_dropdown($data, $fromController[__DB_CUSTOMERS__], $fromController[__DB_INVOICES_CUSTOMER__]);
    
    //Echo button which will serve as a way to add customer through a modal.
    $data= array(
        'type' => 'button',
        'id' => 'bCustomer',
        'class' => 'btn btn-primary',
        'data-toggle' => 'modal',
        'data-target' => '#customerAddModal'
    );
    echo form_button($data, "Dodaj");
    
    //Echo field containing invoice's payment method  
    $title = __DB_INVOICES_PAYMENTMETHOD__;
    echo form_label("Forma płatności", $title);
    echo form_input($title, $fromController[$title]);
    
    //Echo field containing invoice's other informations  
    $title = __DB_INVOICES_OTHERS__;
    echo form_label("Inne",$title);
    echo form_textarea($title,$fromController[$title]);
    
    