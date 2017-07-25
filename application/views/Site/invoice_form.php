<?php
    /*echo form_open("invoice_controller/invoice_add", array("id" => "mainForm"));
    
    $title = __DB_INVOICES_INVOICENUMBER__;
    echo form_label("Faktura VAT nr.", $title)."</br>";
    echo form_input($title, $fromController["LastNumber"])."</br>";
    
    
    echo form_fieldset();
    
    echo form_label("Data");
    $data = array(
        "name" => __DB_INVOICES_DATE__,
        "id" => __DB_INVOICES_DATE__,
        "type" => "date",
        "class" => "dataId"
    );
    echo form_input($data);
    
    $data = array(
        "name" => __DB_INVOICES_PAYMENTDEADLINE__,
        "id" => __DB_INVOICES_PAYMENTDEADLINE__,
        "type" => "date",
        "class" => "dataId",
    );
    echo form_input($data);
    echo form_fieldset_close();
    
    $data = array(
        'name' => __DB_INVOICES_CUSTOMER__,
        'class' => 'dropDownCustomers'
    );
    echo form_label("Klient");
    echo form_dropdown($data, $fromController[__DB_CUSTOMERS__]);
    
    echo form_label("Forma płatności", $title)."</br>";
    $data = array(
        "name"=> __DB_INVOICES_PAYMENTMETHOD__,
        "value" => "przelew"
    );
    echo form_input($data)."</br>";
    
    $data = array(
        'title' => __DB_INVOICES_OTHERS__,
        'class' => 'TextArea'
    );
    echo form_label("Inne")."</br>";
    echo form_textarea($data)."</br>";
*/
    echo form_open("invoice_controller/invoice_edit/".$fromController[__DB_INVOICES_INVOICEID__], array("id" => "mainForm"));
    
    echo form_hidden(__DB_INVOICES_INVOICEID__, $fromController[__DB_INVOICES_INVOICEID__]);
    
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
    
    foreach($fromController[__DB_TRANSACTIONS__] as $key => $transaction){
        echo "<tr id='row".$key."'>";
        for($i = 0; $i < 4 ; $i++ ){
            $i == 0 AND $title = __DB_TRANSACTIONS_NAME__;
            $i == 1 AND $title = __DB_TRANSACTIONS_MEASUREUNIT__;
            $i == 2 AND $title = __DB_TRANSACTIONS_COUNT__;
            $i == 3 AND $title = __DB_TRANSACTIONS_NETUNITPRICE__;
            echo "<td>";
            echo "<input type='text' name='tData_".$key."_".$i."' value='".$transaction[$title]."'></input></td>";
        }
        echo "<td></td>";
        echo "<td><button type='button' id='button".$key."' onclick='removeTransaction(".$key.")'>-</button></td>";
        echo form_hidden("tData_".$key."_id", $transaction[__DB_TRANSACTIONS_TRANSACTIONID__]);
        
        echo "</tr>";
    }