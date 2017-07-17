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
        
        private function fetch_user_input(){
            $nip = $this->input->post(__DB_CUSTOMERS_NIP__) OR $nip = null;
            
            $data = array(
                __DB_CUSTOMERS_NAME__ => $this->input->post(__DB_CUSTOMERS_NAME__),
                __DB_CUSTOMERS_COUNTRY__ => $this->input->post(__DB_CUSTOMERS_COUNTRY__),
                __DB_CUSTOMERS_CITY__ => $this->input->post(__DB_CUSTOMERS_CITY__),
                __DB_CUSTOMERS_POSTALCODE__ => $this->input->post(__DB_CUSTOMERS_POSTALCODE__),
                __DB_CUSTOMERS_STREET__ => $this->input->post(__DB_CUSTOMERS_STREET__),
                __DB_CUSTOMERS_HOUSENUMBER__ => $this->input->post(__DB_CUSTOMERS_HOUSENUMBER__),
                __DB_CUSTOMERS_APARTMENTNUMBER__ => $this->input->post(__DB_CUSTOMERS_APARTMENTNUMBER__),
                __DB_CUSTOMERS_NIP__ => $nip
            );
            
            return $data;
        }
        
        private function count_vat($value, $vat = 0.23){
            return $value * $vat;
        }
        
        private function value_with_vat($value, $vat = 0.23){
            $fullValue = $value + $this->count_vat($value, $vat) + 0.005;
            $fullValue = floor($fullValue * 100) / 100;
            return $fullValue;
        }
        
        private function count_whole_net_value($transactions){
            $netValue= 0;
            foreach($transactions as $transaction){
                $netValue += $transaction[__DB_TRANSACTIONS_COUNT__] * $transaction[__DB_TRANSACTIONS_NETUNITPRICE__];
            }
            return $netValue;
        }
        
        private function count_whole_gross_value($transactions){
            return $this->value_with_vat($this->count_whole_net_value($transactions));
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
        public function customer_show_view(){
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
            
            $this->load->view("Site/header");
            $this->load->view("Site/customer_view", $data);
        }
        
        /*
         * Displays the page containing the specific customer editing tools.
         * @needs   ID of the customer one wants to edit (in the 3rd segment of the uri) 
         * @passes  array of the customer's data
         */
        public function customer_edit_view(){
            $this->load->helper("form");
            $customerId = $this->uri->segment(3);
            $data["fromController"] = $this->db->get_where(__DB_CUSTOMERS__, array(__DB_CUSTOMERS_CUSTOMERID__ => $customerId ))->result_array()[0];
            
            $this->load->view("Site/header");
            $this->load->view("Site/customer_edit", $data);
        }
        
        /*
         * Edits the customer's data with given changes.
         * @needs   Post data with user's input
         * @passes  Array of specific customer's data
         */
        public function customer_edit(){
            $customerId = $this->input->post(__DB_CUSTOMERS_CUSTOMERID__);
            
            $data = $this->fetch_user_input();
            
            $this->load->model("Customer_model");
            $this->Customer_model->update($data, $customerId);
            
            redirect("invoice_controller/customer_show_view");
        }
        
        /*
         * Displays the page containing the user adding form
         */
        public function customer_add_view(){
            $this->load->helper("form");
            $this->load->view("Site/header");
            $this->load->view("Site/customer_add");
        }
        
        /*
         * Not-display function that adds the customer from user's post input
         * @needs   Post with information about customer
         */
        public function customer_add(){
            $data = $this->fetch_user_input();
            
            $this->load->model("Customer_model");
            $this->Customer_model->add($data);
            
            redirect("invoice_controller/customer_show_view");
        }
        
        public function invoice_show_view(){
            $this->db->select(array(__DB_INVOICES_INVOICEID__, __DB_INVOICES_INVOICENUMBER__, __DB_INVOICES_DATE__, __DB_INVOICES_PAYMENTDEADLINE__, __DB_CUSTOMERS_NAME__));
            $this->db->from(__DB_INVOICES__);
            $this->db->join(__DB_CUSTOMERS__, __DB_INVOICES__.".".__DB_INVOICES_CUSTOMERID__." = ".__DB_CUSTOMERS__.".".__DB_CUSTOMERS_CUSTOMERID__);
            $data["fromController"] = $this->db->get()->result_array();
            
            foreach($data["fromController"] as $key => &$invoice){
                $this->db->select(array(__DB_TRANSACTIONS_NETUNITPRICE__, __DB_TRANSACTIONS_COUNT__));
                $this->db->from(__DB_TRANSACTIONS__);
                $this->db->where(__DB_TRANSACTIONS_INVOICEID__." = ".$invoice[__DB_INVOICES_INVOICEID__]);
                
                $transactions = $this->db->get()->result_array();
                $invoice["GrossValue"]= $this->count_whole_gross_value($transactions);
            }
            
            $this->load->view("Site/header");
            $this->load->view("Site/invoice_view", $data);
        }
        
        public function invoice_add_view(){
            $this->db->select(array(__DB_CUSTOMERS_CUSTOMERID__, __DB_CUSTOMERS_NAME__, __DB_CUSTOMERS_COUNTRY__, __DB_CUSTOMERS_CITY__, __DB_CUSTOMERS_STREET__, __DB_CUSTOMERS_HOUSENUMBER__, __DB_CUSTOMERS_APARTMENTNUMBER__));
            $result = $this->db->get(__DB_CUSTOMERS__);
            
            $data = array();
            $data["fromController"] = array();
            foreach($result->result_array() as $customer){
                $data["fromController"][$customer[__DB_CUSTOMERS_CUSTOMERID__]] = $customer[__DB_CUSTOMERS_NAME__]." - ".$this->fetch_address($customer);
            }
            
            
            $this->load->helper("form");
            $this->load->view("Site/header");
            $this->load->view("Site/invoice_add", $data);
        }
        
        public function invoice_add(){
            $data = array();
            $data[__DB_INVOICES__] = array();
            $data[__DB_INVOICES__][__DB_INVOICES_INVOICENUMBER__] = $this->input->post(__DB_INVOICES_INVOICENUMBER__);
            $data[__DB_INVOICES__][__DB_INVOICES_DATE__] = $this->input->post(__DB_INVOICES_DATE__);
            $data[__DB_INVOICES__][__DB_INVOICES_CUSTOMERID__] = $this->input->post(__DB_CUSTOMERS__);
            $data[__DB_INVOICES__][__DB_INVOICES_PAYMENTDEADLINE__] = $this->input->post(__DB_INVOICES_PAYMENTDEADLINE__);
            $data[__DB_INVOICES__][__DB_INVOICES_PAYMENTMETHOD__] = $this->input->post(__DB_INVOICES_PAYMENTMETHOD__);
            
            $this->load->model("Invoice_model");
            $this->Invoice_model->add($data[__DB_INVOICES__]);
            $invoiceId = $this->db->insert_id();
            
            $data[__DB_TRANSACTIONS__] = array();
            for( $i = 0 ; $this->input->post("tData_".$i."_0") !== null ; $i++ ){
                $data[__DB_TRANSACTIONS__][$i] = array();
                
                for($j = 0 ; $j < 4 ; $j++){
                    $title = "sf";
                    $j == 0 AND $title = __DB_TRANSACTIONS_NAME__;
                    $j == 1 AND $title = __DB_TRANSACTIONS_MEASUREUNIT__;
                    $j == 2 AND $title = __DB_TRANSACTIONS_COUNT__;
                    $j == 3 AND $title = __DB_TRANSACTIONS_NETUNITPRICE__;
                    $data[__DB_TRANSACTIONS__][$i][$title] = $this->input->post("tData_".$i."_".$j);
                }
                $data[__DB_TRANSACTIONS__][$i][__DB_TRANSACTIONS_INVOICEID__] = $invoiceId;
            }
            
            
            $this->load->model("Transaction_model");
            foreach($data[__DB_TRANSACTIONS__] as $transaction){
                $this->Transaction_model->add($transaction);
            }
            
            redirect("invoice_controller/invoice_show_view");
        }
        
        public function invoice_edit_view(){
            $this->load->helper("form");
            $data = array();
            $data["fromController"] = array();
            $data["fromController"][__DB_INVOICES__] = array();
            $data["fromController"][__DB_INVOICES__][__DB_CUSTOMERS__] = array();
            
            $invoiceId = $this->uri->segment(3);
            $this->db->select(array(__DB_INVOICES_INVOICEID__, __DB_INVOICES_CUSTOMERID__,__DB_INVOICES_INVOICENUMBER__,  __DB_INVOICES_DATE__, __DB_INVOICES_CUSTOMERID__,__DB_INVOICES_PAYMENTDEADLINE__, __DB_INVOICES_PAYMENTMETHOD__));
            $this->db->where(__DB_INVOICES_INVOICEID__." = ".$invoiceId);
            $data["fromController"][__DB_INVOICES__] = $this->db->get(__DB_INVOICES__)->result_array()[0];
            
            $this->db->select(array(__DB_TRANSACTIONS_TRANSACTIONID__, __DB_TRANSACTIONS_NAME__, __DB_TRANSACTIONS_MEASUREUNIT__, __DB_TRANSACTIONS_NETUNITPRICE__, __DB_TRANSACTIONS_COUNT__));
            $this->db->from(__DB_TRANSACTIONS__);
            $this->db->where(__DB_TRANSACTIONS_INVOICEID__." = ".$invoiceId);
            
            $transactions = $this->db->get()->result_array();
            $data["fromController"][__DB_TRANSACTIONS__] = $transactions;
            
            $this->db->select(array(__DB_CUSTOMERS_CUSTOMERID__, __DB_CUSTOMERS_NAME__, __DB_CUSTOMERS_COUNTRY__, __DB_CUSTOMERS_CITY__, __DB_CUSTOMERS_STREET__, __DB_CUSTOMERS_HOUSENUMBER__, __DB_CUSTOMERS_APARTMENTNUMBER__));
            $customersRaw = $this->db->get(__DB_CUSTOMERS__);
            foreach($customersRaw->result_array() as $customer){
                $data["fromController"][__DB_INVOICES__][__DB_CUSTOMERS__][$customer[__DB_CUSTOMERS_CUSTOMERID__]] = $customer[__DB_CUSTOMERS_NAME__]." - ".$this->fetch_address($customer);
            }
            
            $this->load->view("Site/header");
            $this->load->view("Site/invoice_edit", $data);
        }
        
        public function invoice_edit(){
            $data = array();
            $data[__DB_INVOICES__] = array();
            $data[__DB_INVOICES__][__DB_INVOICES_INVOICEID__] = $this->uri->segment(3);
            $data[__DB_INVOICES__][__DB_INVOICES_INVOICENUMBER__] = $this->input->post(__DB_INVOICES_INVOICENUMBER__);
            $data[__DB_INVOICES__][__DB_INVOICES_DATE__] = $this->input->post(__DB_INVOICES_DATE__);
            $data[__DB_INVOICES__][__DB_INVOICES_CUSTOMERID__] = $this->input->post(__DB_CUSTOMERS__);
            $data[__DB_INVOICES__][__DB_INVOICES_PAYMENTDEADLINE__] = $this->input->post(__DB_INVOICES_PAYMENTDEADLINE__);
            $data[__DB_INVOICES__][__DB_INVOICES_PAYMENTMETHOD__] = $this->input->post(__DB_INVOICES_PAYMENTMETHOD__);
            
            $this->load->model("Invoice_model");
            $this->Invoice_model->update($data[__DB_INVOICES__], $data[__DB_INVOICES__][__DB_INVOICES_INVOICEID__]);
            $invoiceId = $this->db->insert_id();
            
            $data[__DB_TRANSACTIONS__] = array();
            for( $i = 0 ; $this->input->post("tData_".$i."_0") !== null ; $i++ ){
                $data[__DB_TRANSACTIONS__][$i] = array();
                
                for($j = 0 ; $j < 4 ; $j++){
                    $title = "";
                    $j == 0 AND $title = __DB_TRANSACTIONS_NAME__;
                    $j == 1 AND $title = __DB_TRANSACTIONS_MEASUREUNIT__;
                    $j == 2 AND $title = __DB_TRANSACTIONS_COUNT__;
                    $j == 3 AND $title = __DB_TRANSACTIONS_NETUNITPRICE__;
                    $data[__DB_TRANSACTIONS__][$i][$title] = $this->input->post("tData_".$i."_".$j);
                }
                $data[__DB_TRANSACTIONS__][$i][__DB_TRANSACTIONS_TRANSACTIONID__] = $this->input->post("tData_".$i."_0_id");
                $data[__DB_TRANSACTIONS__][$i][__DB_TRANSACTIONS_INVOICEID__] = $data[__DB_INVOICES__][__DB_INVOICES_INVOICEID__];
            }
            
            
            $this->load->model("Transaction_model");
            foreach($data[__DB_TRANSACTIONS__] as $key => $transaction){
                $this->Transaction_model->update($transaction, $transaction[__DB_TRANSACTIONS_TRANSACTIONID__]);
            }
            
            //$this->load->view("var_dump", $data);
            redirect("invoice_controller/invoice_show_view");
        }
        
        public function invoice_pdf_view(){
            $this->load->helper("form");
            $data = array();
            $data["fromController"] = array();
            $data["fromController"][__DB_INVOICES__] = array();
            $data["fromController"][__DB_INVOICES__][__DB_CUSTOMERS__] = array();
            
            $invoiceId = $this->uri->segment(3);
            $this->db->select(array(__DB_INVOICES_INVOICEID__, __DB_INVOICES_CUSTOMERID__,__DB_INVOICES_INVOICENUMBER__,  __DB_INVOICES_DATE__, __DB_INVOICES_CUSTOMERID__,__DB_INVOICES_PAYMENTDEADLINE__, __DB_INVOICES_PAYMENTMETHOD__));
            $this->db->where(__DB_INVOICES_INVOICEID__." = ".$invoiceId);
            $data["fromController"][__DB_INVOICES__] = $this->db->get(__DB_INVOICES__)->result_array()[0];
            
            $this->db->select(array(__DB_TRANSACTIONS_TRANSACTIONID__, __DB_TRANSACTIONS_NAME__, __DB_TRANSACTIONS_MEASUREUNIT__, __DB_TRANSACTIONS_NETUNITPRICE__, __DB_TRANSACTIONS_COUNT__));
            $this->db->from(__DB_TRANSACTIONS__);
            $this->db->where(__DB_TRANSACTIONS_INVOICEID__." = ".$invoiceId);
            
            $transactions = $this->db->get()->result_array();
            $data["fromController"][__DB_TRANSACTIONS__] = $transactions;
            
            $this->db->select(array(__DB_CUSTOMERS_CUSTOMERID__, __DB_CUSTOMERS_NAME__, __DB_CUSTOMERS_COUNTRY__, __DB_CUSTOMERS_CITY__, __DB_CUSTOMERS_STREET__, __DB_CUSTOMERS_HOUSENUMBER__, __DB_CUSTOMERS_APARTMENTNUMBER__));
            $customersRaw = $this->db->get(__DB_CUSTOMERS__);
            foreach($customersRaw->result_array() as $customer){
                $data["fromController"][__DB_INVOICES__][__DB_CUSTOMERS__][$customer[__DB_CUSTOMERS_CUSTOMERID__]] = $customer[__DB_CUSTOMERS_NAME__]." - ".$this->fetch_address($customer);
            }
            
            $this->load->view("Site/header");
            $this->load->view("Site/invoice_pdf_show", $data);
            
        }
        
        public function index(){
            $this->customer_show_view();
        }
        
        
    }