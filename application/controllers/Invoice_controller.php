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
            $this->load->helper("url");
        }
        
        /*
         * Displays the page containing customers' data
         * Passes to the view the data with customers' names and addresses.
         * @needs   ID of the customer one wants to edit (in the 3rd segment of the uri)
         * @passes  array of the customers' names and addresses
         */
        public function customers_show_view(){
            $this->load->view("Site/header");
            $this->db->select(array(__DB_CUSTOMERS_CUSTOMERID__, __DB_CUSTOMERS_NAME__, __DB_CUSTOMERS_COUNTRY__, __DB_CUSTOMERS_CITY__, __DB_CUSTOMERS_STREET__, __DB_CUSTOMERS_HOUSENUMBER__, __DB_CUSTOMERS_APARTMENTNUMBER__));
            $result = $this->db->get(__DB_CUSTOMERS__);
            
            $data = array();
            $data["fromController"] = array();
            foreach($result->result_array() as $customer){
                $row = array(__DB_CUSTOMERS_NAME__ => $customer[__DB_CUSTOMERS_NAME__],
                             "Address" => $this->fetch_address($customer),
                             __DB_CUSTOMERS_CUSTOMERID__ => $customer[__DB_CUSTOMERS_CUSTOMERID__]
                );
                array_push($data["fromController"], $row);
            }
            
            $this->load->view("Site/customer_view", $data);
        }
        
        /*
         * Displays the page containing the specific customer editing tools.
         * @needs   ID of the customer one wants to edit (in the 3rd segment of the uri) 
         * @passes  array of the customer's data
         */
        public function customer_edit_view(){
            $customerId = $this->uri->segment(3);
            $data["fromController"] = $this->db->get_where(__DB_CUSTOMERS__, array(__DB_CUSTOMERS_CUSTOMERID__), $customerId)->result_array()[0];
            
            $this->load->view("Site/header");
            $this->load->view("Site/customer_edit", $data);
        }
        
        /*
         * Edits the customer's data with given changes.
         * @needs   Post data with user's input
         */
        public function customer_show(){
            $customerId = $this->input->post(__DB_CUSTOMERS_CUSTOMERID__);
            $data = array(
                __DB_CUSTOMERS_NAME__ => $this->input->post(__DB_CUSTOMERS_NAME__),
                __DB_CUSTOMERS_COUNTRY__ => $this->input->post(__DB_CUSTOMERS_COUNTRY__),
                __DB_CUSTOMERS_CITY__ => $this->input->post(__DB_CUSTOMERS_CITY__),
                __DB_CUSTOMERS_POSTALCODE__ => $this->input->post(__DB_CUSTOMERS_POSTALCODE__),
                __DB_CUSTOMERS_STREET__ => $this->input->post(__DB_CUSTOMERS_STREET__),
                __DB_CUSTOMERS_HOUSENUMBER__ => $this->input->post(__DB_CUSTOMERS_HOUSENUMBER__),
                __DB_CUSTOMERS_APARTMENTNUMBER__ => $this->input->post(__DB_CUSTOMERS_APARTMENTNUMBER__),
                __DB_CUSTOMERS_NIP__ => $this->input->post(__DB_CUSTOMERS_NIP__) 
            );
            
            $this->load->model("Customer_model");
            $this->Customer_model->update($data, $customerId);
        }
        
        public function index(){
            $this->customers_show_view();
        }
        
        
    }