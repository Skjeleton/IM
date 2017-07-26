<?php 
    /*
     * Upon including this file it will echo all the form fields needed to successfully add or modify a user.
     * WARNING: It contain neither form opening nor form closing so one should include this file between them.
     */


    //Making sure that variables which the file will be refering to later are defined. Controller can pass it's own values.
    if(!isset($fromController)) $fromController = array();
    if(!isset($fromController[__DB_CUSTOMERS_NAME__])) $fromController[__DB_CUSTOMERS_NAME__] = "";
    if(!isset($fromController[__DB_CUSTOMERS_COUNTRY__])) $fromController[__DB_CUSTOMERS_COUNTRY__] = "";
    if(!isset($fromController[__DB_CUSTOMERS_CITY__])) $fromController[__DB_CUSTOMERS_CITY__] = "";
    if(!isset($fromController[__DB_CUSTOMERS_STREET__])) $fromController[__DB_CUSTOMERS_STREET__] = "";
    if(!isset($fromController[__DB_CUSTOMERS_HOUSENUMBER__])) $fromController[__DB_CUSTOMERS_HOUSENUMBER__] = "";
    if(!isset($fromController[__DB_CUSTOMERS_APARTMENTNUMBER__])) $fromController[__DB_CUSTOMERS_APARTMENTNUMBER__] = "";
    if(!isset($fromController[__DB_CUSTOMERS_POSTALCODE__])) $fromController[__DB_CUSTOMERS_POSTALCODE__] = "";
    if(!isset($fromController[__DB_CUSTOMERS_NIP__])) $fromController[__DB_CUSTOMERS_NIP__] = "";
    if(!isset($fromController[__DB_CUSTOMERS_OTHERS__])) $fromController[__DB_CUSTOMERS_OTHERS__] = "";
    
    //Echo field containing customer's name
    $data = array(
        'name' => __DB_CUSTOMERS_NAME__
    );
    echo form_label("Nazwa", $data['name'])."</br>";
    echo form_input($data, $fromController[$data["name"]])."</br>";
    
    //Echo field containing customer's country
    $data= array(
        'name' => __DB_CUSTOMERS_COUNTRY__,
        'class' => 'AdresStyle'
    );
    echo form_label("Państwo", $data["name"]);
    echo form_input($data, $fromController[$data["name"]]);
    
    //Echo field containing customer's city
    $data= array(
        'name' => __DB_CUSTOMERS_CITY__,
        'class' => 'AdresStyle'
    );
    echo form_label("Miasto", $data["name"]);
    echo form_input($data, $fromController[$data["name"]]);
    
    //Echo field containing customer's street
    $data= array(
        'name' => __DB_CUSTOMERS_STREET__,
        'class' => 'Street'
    );
    echo form_label("Ulica");
    echo form_input($data, $fromController[$data["name"]]);
    
    //Echo field containing customer's house number
    $data= array(
        'name' => __DB_CUSTOMERS_HOUSENUMBER__,
        'class' => 'Numbers'
    );
    echo form_label("Numer domu / lokalu", $data["name"]);
    echo form_input($data, $fromController[$data["name"]])."/";
    
    //Echo field containing customer's apartment number
    $data= array(
        'name' => __DB_CUSTOMERS_APARTMENTNUMBER__,
        'class' => 'Numbers'
    );
    echo form_input($data, $fromController[$data["name"]]);
    
    //Echo field containing customer's postal code
    $data= array(
        'name' => __DB_CUSTOMERS_POSTALCODE__,
        'class' => 'PostalCodeStyle'
    );
    echo form_label("Kod pocztowy", $data["name"]);
    echo form_input($data, $fromController[$data["name"]]);
    
    //Echo field containing customer's nip
    $data= array(
        'name' => __DB_CUSTOMERS_NIP__
    );
    echo form_label("NIP", $data["name"]);
    echo form_input($data, $fromController[$data["name"]]);
    
    //Echo field containing customer's other informations
    $data = array(
        'name' => __DB_CUSTOMERS_OTHERS__,
        'class' => 'TextArea'
    );
    echo form_label("Inne", $data["name"]);
    echo form_textarea($data,$fromController[__DB_CUSTOMERS_OTHERS__])."</br>";

    