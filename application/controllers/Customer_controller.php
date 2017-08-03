<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    require_once("Main_controller.php");
    
    class Customer_controller extends Main_controller{
        //<PRIVATE METHODS> --------------------------------------------------------------------------------------------------------------------------------------------
        
        /*
         * Fetches desired data from $data and creates string containing customer's address
         * @param array(mixed) $data    - Customer's data. 
         * @return string               - Customer's address
         */
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
        
        //</PRIVATE METHODS> --------------------------------------------------------------------------------------------------------------------------------------------
        
        //<FETCH INPUT> --------------------------------------------------------------------------------------------------------------------------------------------
        
        /*
         * Collects data about customer from the form.
         * @return array(mixed)     - Customer's data in the array
         */
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
        
        //</FETCH INPUT> --------------------------------------------------------------------------------------------------------------------------------------------
        
        //<GET DATA> --------------------------------------------------------------------------------------------------------------------------------------------
        /*
         * Get Data functions collects data from the models and stores it in the array.
         * There is a name of the function after "getData" which tells what is the data collected for.
         * @returns array(mixed) - Collected data.
         */
        
        
        /*
         *  $fromController[0-?][__DB_CUSTOMERS_NAME__]
         *                      [__DB_CUSTOMERS_CUSTOMERID__]
         *                      ["Address"]
         */
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
        
        private function getData_customer_add_view(){
            $this->load->model("Config_model");
            
            $toReturn = array();
            $toReturn[__DB_CONFIG__] = $this->Config_model->get($this->getUserId(), __CONFKEY_DEFAULT_COUNTRIES__);
            
            return $toReturn;
        }
        
        /*
         * $fromController[__DB_CUSTOMERS_CUSTOMERID__]
         *                [__DB_CUSTOMERS_NAME__]
         *                [__DB_CUSTOMERS_COUNTRY__]
         *                [__DB_CUSTOMERS_CITY__]
         *                [__DB_CUSTOMERS_POSTALCODE__]
         *                [__DB_CUSTOMERS_STREET__]
         *                [__DB_CUSTOMERS_HOUSENUMBER__]
         *                [__DB_CUSTOMERS_APARTMENTNUMBER__]
         *                [__DB_CUSTOMERS_NIP__]
         *                [__DB_CUSTOMERS_OTHERS__]
         */
        private function getData_customer_edit_view($id){
            $this->load->model("Customer_model");
            $this->load->model("Config_model");
            
            $toReturn = $this->Customer_model->get($id);
            
            {
                $keys = array(
                    __CONFKEY_  
                );
                $toReturn[__DB_CONFIG__] = $this->Config_model->get($id, $keys);
            }
            return  $this->Customer_model->get($id);
        }
        
        //</GET DATA> --------------------------------------------------------------------------------------------------------------------------------------------
        
        //<PUBLIC METHODS - INSIDERS> --------------------------------------------------------------------------------------------------------------------------------------------
        
        function __construct(){
            parent::__construct();
            $this->load->database();
            $this->load->helper("url");
        }
        
        /*
         * Edits the customer with POST data.
         */
        public function customer_edit(){
            $this->load->model("Customer_model");
            
            $customerId = $this->input->post(__DB_CUSTOMERS_CUSTOMERID__);
            $data = $this->fetchInput_customer_edit();
            $this->Customer_model->update($data, $customerId);
            
            redirect("customer_controller/customer_show_view");
        }
        
        /*
         * Add customer using the POST data. 
         * @param bool $ajax    - When true, the user will be added considering that the function was called by Ajax.
         */
        public function customer_add($ajax = false){
            // Adapt the input from ajax to the customer adding
            if($ajax){
                $ajaxData = $_POST['data'];
                $data = array();
                
                foreach($ajaxData as $obj){
                    reset($obj);
                    $key = key($obj);
                    $_POST[$key] = $obj[$key];
                }
            }
            
            $this->load->model("Customer_model");
            $data = $this->fetchInput_customer_edit();
            $customerId = $this->Customer_model->add($data);
            
            // Return inormation about added user...
            if($ajax) {
                $customer["id"] = $customerId;
                $customer["name"] = $_POST[__DB_CUSTOMERS_NAME__]." - ".$this->fetch_customer_address($_POST);
                log_message("debug", json_encode($customer));
                echo json_encode($customer);
                return true;
            }
            
            // ...or redirect user to the list of customers
            redirect("customer_controller/customer_show_view");
        }
        
        public function index(){
            redirect("customer_controller/customer_show_view");
        }
        
        //</PUBLIC METHODS - INSIDERS> --------------------------------------------------------------------------------------------------------------------------------------------
       
        //<PUBLIC METHODS - OUTSIDERS> --------------------------------------------------------------------------------------------------------------------------------------------
    
        /*
         * Controls the view flow when user wants to list all customers.
         */
        public function customer_show_view(){
            $data["fromController"] = $this->getData_customer_show_view();
            
            $this->load->view("Site/parts/header");
            $this->load->view("Site/parts/navbar");
            $this->load->view("Site/customer_view", $data);
            $this->load->view("Site/parts/footer");
        }
        
        /*
         * Controls the view flow when user wants to edit a customer
         */
        public function customer_edit_view($customerId){
            $this->load->helper("form");
            
            $data["fromController"] = $this->getData_customer_edit_view($customerId);
            
            $this->load->view("Site/parts/header");
            $this->load->view("Site/parts/navbar");
            $this->load->view("Site/customer_edit", $data);
            $this->load->view("Site/parts/footer");
        }
        
        /*
         * Controls the view flow when user wants to add the customer.
         */
        public function customer_add_view(){
            $this->load->helper("form");
            
            $data["fromController"] = $this->getData_customer_add_view();
            
            $this->load->view("Site/parts/header");
            $this->load->view("Site/parts/navbar");
            $this->load->view("Site/customer_add",$data);
            $this->load->view("Site/parts/footer");
        }
        
        //</PUBLIC METHODS - OUTSIDERS> --------------------------------------------------------------------------------------------------------------------------------------------
    }