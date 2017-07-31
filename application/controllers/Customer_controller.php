<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Customer_controller extends CI_Controller{
        private function fetch_customer_address($data){
            $address = $data[__DB_CUSTOMERS_CITY__].
            ", ul. ".
            $data[__DB_CUSTOMERS_STREET__].
            " ".
            $data[__DB_CUSTOMERS_HOUSENUMBER__];
            
            if(isset($data[__DB_CUSTOMERS_APARTMENTNUMBER__]))
                $address .= "/".$data[__DB_CUSTOMERS_APARTMENTNUMBER__];
                
                return $address;
        }
        
        private function fetchInput_customer_edit(){
            $columns = array(
                __DB_CUSTOMERS_NAME__,
                __DB_CUSTOMERS_COUNTRY__,
                __DB_CUSTOMERS_CITY__,
                __DB_CUSTOMERS_POSTALCODE__,
                __DB_CUSTOMERS_STREET__,
                __DB_CUSTOMERS_HOUSENUMBER__,
                __DB_CUSTOMERS_APARTMENTNUMBER__,
                __DB_CUSTOMERS_NIP__,
                __DB_CUSTOMERS_OTHERS__
            );
            
            $data = array();
            foreach($columns as $column){
                $data[$column] = $this->input->post($column);
            }
            
            if($data[__DB_CUSTOMERS_APARTMENTNUMBER__] === NULL OR $data[__DB_CUSTOMERS_APARTMENTNUMBER__] === 0 OR $data[__DB_CUSTOMERS_APARTMENTNUMBER__] == "")
                $data[__DB_CUSTOMERS_APARTMENTNUMBER__] = NULL;
                
            
                if($data[__DB_CUSTOMERS_NIP__] === NULL OR $data[__DB_CUSTOMERS_NIP__] === 0 OR $data[__DB_CUSTOMERS_APARTMENTNUMBER__] == "")
                $data[__DB_CUSTOMERS_NIP__] = NULL;
                
                if($data[__DB_CUSTOMERS_OTHERS__] === NULL OR $data[__DB_CUSTOMERS_OTHERS__] === 0 OR $data[__DB_CUSTOMERS_APARTMENTNUMBER__] == "")
                $data[__DB_CUSTOMERS_OTHERS__] = NULL;
                    
                
            return $data;
        }
        
        private function getData_customer_show_view(){
            $toReturn = array();
            
            $this->load->model("Customer_model");
            
            $customers = $this->Customer_model->get();
            foreach($customers as $customer){
                $row = array(
                    __DB_CUSTOMERS_NAME__       => $customer[__DB_CUSTOMERS_NAME__],
                    __DB_CUSTOMERS_CUSTOMERID__ => $customer[__DB_CUSTOMERS_CUSTOMERID__],
                    "Address"                   => $this->fetch_customer_address($customer)
                );
                array_push($toReturn, $row);
            }
            return $toReturn;
        }
        
        private function getData_customer_edit_view($id){
            $this->load->model("Customer_model");
            return  $this->Customer_model->get($id);
        }
        
        function __construct(){
            parent::__construct();
            $this->load->database();
            $this->load->helper("url");
        }
        
        public function customer_show_view(){
            $data["fromController"] = $this->getData_customer_show_view();
            
            $this->load->view("Site/parts/header");
            $this->load->view("Site/parts/navbar");
            $this->load->view("Site/customer_view", $data);
            $this->load->view("Site/parts/footer");
        }
            
        public function customer_edit_view(){
            $this->load->helper("form");
            $customerId = $this->uri->segment(3);
            
            $data = array();
            $data["fromController"] = $this->getData_customer_edit_view($customerId);
            
            $this->load->view("Site/parts/header");
            $this->load->view("Site/parts/navbar");
            $this->load->view("Site/customer_edit", $data);
            $this->load->view("Site/parts/footer");
        }
        
        public function customer_edit(){
            $this->load->model("Customer_model");
            
            $customerId = $this->input->post(__DB_CUSTOMERS_CUSTOMERID__);
            $data = $this->fetchInput_customer_edit();
            $this->Customer_model->update($data, $customerId);
            
            redirect("customer_controller/customer_show_view");
        }
        
        public function customer_add_view(){
            $this->load->helper("form");
            $this->load->view("Site/parts/header");
            $this->load->view("Site/parts/navbar");
            $this->load->view("Site/customer_add");
            $this->load->view("Site/parts/footer");
        }
        
        public function customer_add($ajax = false){
            if($ajax){
                $ajaxData = $_POST['data'];
                $data = array();
                
                foreach($ajaxData as $obj){
                    reset($obj);
                    $key = key($obj);
                    $_POST[$key] = $obj[$key];
                }
                //echo "<pre>".var_export($_POST, true)."</pre>";
            }
            
            $this->load->model("Customer_model");
            $data = $this->fetchInput_customer_edit();
            $customerId = $this->Customer_model->add($data);
            
            if($ajax) {
                $customer["id"] = $customerId;
                $customer["name"] = $_POST[__DB_CUSTOMERS_NAME__]." - ".$this->fetch_customer_address($_POST);
                log_message("debug", json_encode($customer));
                echo json_encode($customer);
                return true;
            }
            
            redirect("customer_controller/customer_show_view");
        }
        
    }