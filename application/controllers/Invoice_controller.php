<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Invoice_controller extends CI_Controller{
        
        // Merges the address in the $data table 
        private function fetch_address($data){
            $address = $data[__DB_CUSTOMERS_CITY__].
                        ", ul. ".
                        $data[__DB_CUSTOMERS_STREET__].
                        " ".
                        $data[__DB_CUSTOMERS_HOUSENUMBER__];
            
            if(isset($data[__DB_CUSTOMERS_APARTMENTNUMBER__]))
                $address .= "/".$data[__DB_CUSTOMERS_APARTMENTNUMBER__];
            
            return $address;
            
           // return var_export($data);
        }
        
        function __construct(){
            parent::__construct();
            $this->load->database();
        }
        
        public function show_customers(){
            $this->db->select(array(__DB_CUSTOMERS_NAME__, __DB_CUSTOMERS_COUNTRY__, __DB_CUSTOMERS_CITY__, __DB_CUSTOMERS_STREET__, __DB_CUSTOMERS_HOUSENUMBER__, __DB_CUSTOMERS_APARTMENTNUMBER__));
            $result = $this->db->get(__DB_CUSTOMERS__);
            
            $data = array();
            $data["customers"] = array();
            foreach($result->result_array() as $customer){
                $row = array("Name" => $customer[__DB_CUSTOMERS_NAME__],
                             "Address" => $this->fetch_address($customer));
                array_push($data["customers"], $row);
            }
            
            $this->load->view("Site/customer_view", $data);
        }
        
        public function index(){
            $this->show_customers();
        }
        
        
    }