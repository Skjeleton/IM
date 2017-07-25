<?php
    $fromController = $fromController ?: array();
    if(!isset($fromController[__DB_INVOICES_INVOICENUMBER__])) $fromController[__DB_INVOICES_INVOICENUMBER__] = "";
    if(!isset($fromController[__DB_INVOICES_DATE__])) $fromController[__DB_INVOICES_DATE__] = "";
    if(!isset($fromController[__DB_INVOICES_PAYMENTDEADLINE__])) $fromController[__DB_INVOICES_PAYMENTDEADLINE__] = "";
    if(!isset($fromController[__DB_INVOICES_CUSTOMER__])) $fromController[__DB_INVOICES_CUSTOMER__] = "";
    if(!isset($fromController[__DB_INVOICES_PAYMENTMETHOD__])) $fromController[__DB_INVOICES_PAYMENTMETHOD__] = "";
    if(!isset($fromController[__DB_INVOICES_OTHERS__])) $fromController[__DB_INVOICES_OTHERS__] = "";

    
    $title = __DB_INVOICES_INVOICENUMBER__;
    echo form_label("Faktura VAT nr.", $title)."</br>";
    echo form_input($title, $fromController[__DB_INVOICES_INVOICENUMBER__])."</br>";
    
    $data = array(
        'name' => __DB_INVOICES_DATE__,
        'type' => 'date',
        'class' => 'dataId'
    );
    echo form_label("Data faktury / Termin płatności");
    echo form_input($data,$fromController[__DB_INVOICES_DATE__]);
    
    $data = array(
        'name' => __DB_INVOICES_PAYMENTDEADLINE__,
        'type' => 'date',
        'class' => 'dataId'
    );
    echo form_input($data, $fromController[__DB_INVOICES_PAYMENTDEADLINE__]);
    
    $data = array(
        'name' => __DB_INVOICES_CUSTOMER__,
        'class' => 'dropDownCustomers'
    );
    echo form_label("Klient")."</br>";
    echo form_dropdown($data, $fromController[__DB_CUSTOMERS__], $fromController[__DB_INVOICES_CUSTOMER__])."</br>";
    
    
    
    $title = __DB_INVOICES_PAYMENTMETHOD__;
    echo form_label("Forma płatności", $title)."</br>";
    echo form_input($title, $fromController[$title])."</br>";
    
    $title = __DB_INVOICES_OTHERS__;
    echo form_label("Inne",$title)."</br>";
    echo form_textarea($title,$fromController[$title])."</br>";