<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Invoice_controller extends CI_Controller{
       //PRIVATE METHODS --------------------------------------------------------------------------------------------------------------------------------------------
        
        // Merges the address in the $data table 
        private function fetch_customer_address($data){
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
        
        private function count_netValue($count, $netValue){
            return $count * $netValue;
        }
        
        private function count_vatValue($count, $netValue, $vat = 0.23){
            return $this->count_netValue($count, $netValue) * $vat;
        }
        
        private function count_grossValue($count, $netValue){
            return $this->count_netValue($count, $netValue) + $this->count_vatValue($count, $netValue);
        }
        
        private function count_fullNetValue($transactions){
            $value = 0;
            foreach($transactions as $transaction){
                $value += $transaction[__DB_TRANSACTIONS_NETVALUE__];
            }
            return $value;
        }
        
        //PUBLIC METHODS --------------------------------------------------------------------------------------------------------------------------------------------
        function __construct(){
            parent::__construct();
            $this->load->database();
            $this->load->helper("url");
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
        
        public function customer_show_view(){
            $data["fromController"] = $this->getData_customer_show_view();
            
            $this->load->view("Site/header");
            $this->load->view("Site/customer_view", $data);
        }

        private function getData_customer_edit_view($id){
            $this->load->model("Customer_model");
            return  $this->Customer_model->get($id);
        }
        
        public function customer_edit_view(){
            $this->load->helper("form");
            $customerId = $this->uri->segment(3);
            
            $data = array();
            $data["fromController"] = $this->getData_customer_edit_view($customerId);
            
            $this->load->view("Site/header");
            $this->load->view("Site/customer_edit", $data);
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
                __DB_CUSTOMERS_OTHERS__
            );
            
            $data = array();
            foreach($columns as $column){
                $data[$column] = $this->input->post($column);
            }

            return $data;
        }
        
        public function customer_edit(){
            $this->load->model("Customer_model");
            
            $customerId = $this->input->post(__DB_CUSTOMERS_CUSTOMERID__);
            $data = $this->fetchInput_customer_edit();
            $this->Customer_model->update($data, $customerId);
            
            redirect("invoice_controller/customer_show_view");
        }
        
        public function customer_add_view(){
            $this->load->helper("form");
            $this->load->view("Site/header");
            $this->load->view("Site/customer_add");
        }
 
        public function customer_add(){
            $this->load->model("Customer_model");
            $data = $this->fetchInput_customer_edit();
            $this->Customer_model->add($data);
            
            redirect("invoice_controller/customer_show_view");
        }
        
        private function getData_invoice_show_view(){
            $this->load->model("Invoice_model");
            return $this->Invoice_model->get();
        }
        
        
        public function invoice_show_view(){
            $data = array();
            $data["fromController"] = $this->getData_invoice_show_view();
            
            $this->load->view("Site/header");
            $this->load->view("Site/invoice_view", $data);
        }
        
        
        public function getData_invoice_add_view(){
            $this->load->model("Customer_model");
            return $this->Customer_model->get();
        }
        
        public function invoice_add_view(){
            $data = array();
            $data["fromController"] = array();
            
            $answer = $this->getData_invoice_add_view();
            foreach($answer as $customer){
                $data["fromController"][$customer[__DB_CUSTOMERS_CUSTOMERID__]] = $customer[__DB_CUSTOMERS_NAME__]." - ".$this->fetch_customer_address($customer);
            }
            
            $this->load->helper("form");
            $this->load->view("Site/header");
            $this->load->view("Site/invoice_add", $data);
        }
        
        private function addPrecalculations(&$transaction){
            $transaction[__DB_TRANSACTIONS_NETVALUE__] = $this->count_netValue($transaction[__DB_TRANSACTIONS_COUNT__], $transaction[__DB_TRANSACTIONS_NETUNITPRICE__]);
            $transaction[__DB_TRANSACTIONS_VATVALUE__] = $this->count_vatValue($transaction[__DB_TRANSACTIONS_COUNT__], $transaction[__DB_TRANSACTIONS_NETUNITPRICE__]);
            $transaction[__DB_TRANSACTIONS_GROSSVALUE__] = $this->count_grossValue($transaction[__DB_TRANSACTIONS_COUNT__], $transaction[__DB_TRANSACTIONS_NETUNITPRICE__]);
            return true;
        }
        
        private function fetchInput_invoice_add(){
            $columns = array(
                __DB_INVOICES_INVOICENUMBER__,
                __DB_INVOICES_DATE__,
                __DB_INVOICES_CUSTOMER__,
                __DB_INVOICES_PAYMENTDEADLINE__,
                __DB_INVOICES_PAYMENTMETHOD__
            );
            
            $data = array();
            $data[__DB_INVOICES__] = array();
            foreach($columns as $column){
                $data[__DB_INVOICES__][$column] = $this->input->post($column);
            }
            
            $columns = array(
                __DB_TRANSACTIONS_NAME__,
                __DB_TRANSACTIONS_MEASUREUNIT__,
                __DB_TRANSACTIONS_COUNT__,
                __DB_TRANSACTIONS_NETUNITPRICE__
            );
            
            $data[__DB_TRANSACTIONS__] = array();
            for( $i = 0 ; $this->input->post("tData_".$i."_0") !== null ; $i++ ){
                $data[__DB_TRANSACTIONS__][$i] = array();
                
                for($j = 0 ; $j < 4 ; $j++){
                    $data[__DB_TRANSACTIONS__][$i][ $columns[$j] ] = $this->input->post("tData_".$i."_".$j);
                }
                $data[__DB_TRANSACTIONS__][$i][__DB_TRANSACTIONS_TRANSACTIONID__] = $this->input->post("tData_".$i."_id");
                $this->addPrecalculations($data[__DB_TRANSACTIONS__][$i]);
            }
            return $data;
        }
        
        public function invoice_add(){
            $data = array();
            $data = $this->fetchInput_invoice_add();
            
            $data[__DB_INVOICES__][__DB_INVOICES_NETVALUE__] = $this->count_fullNetValue($data[__DB_TRANSACTIONS__]);
            $data[__DB_INVOICES__][__DB_INVOICES_VATVALUE__] = $data[__DB_INVOICES__][__DB_INVOICES_NETVALUE__] * 0.23;
            $data[__DB_INVOICES__][__DB_INVOICES_GROSSVALUE__] = $data[__DB_INVOICES__][__DB_INVOICES_VATVALUE__] + $data[__DB_INVOICES__][__DB_INVOICES_NETVALUE__];
            $this->load->model("Invoice_model");
            $this->Invoice_model->add($data[__DB_INVOICES__]);
            $invoiceId = $this->db->insert_id();
            
            foreach($data[__DB_TRANSACTIONS__] as &$transaction){
                $transaction[__DB_TRANSACTIONS_INVOICE__] = $invoiceId;
            }
            $this->load->model("Transaction_model");
            $this->Transaction_model->add_batch($data[__DB_TRANSACTIONS__]);
            
            redirect("invoice_controller/invoice_show_view");
        }
        
        public function invoice_edit_view(){
            $this->load->helper("form");
            
            $invoiceId = $this->uri->segment(3);
            
            $this->load->model("Invoice_model");
            $data["fromController"] = $this->Invoice_model->get($invoiceId);
            
            $this->load->model("Customer_model");
            $customers = $this->Customer_model->get();
            foreach($customers as $customer){
                $data["fromController"][__DB_CUSTOMERS__][$customer[__DB_CUSTOMERS_CUSTOMERID__]] = $customer[__DB_CUSTOMERS_NAME__]." - ".$this->fetch_customer_address($customer);
            }
            
            $this->load->view("Site/header");
            $this->load->view("Site/invoice_edit", $data);
        }

        public function invoice_edit(){
            $data = array();
            $data = $this->fetchInput_invoice_add();
            
            $data[__DB_INVOICES__][__DB_INVOICES_NETVALUE__] = $this->count_fullNetValue($data[__DB_TRANSACTIONS__]);
            $data[__DB_INVOICES__][__DB_INVOICES_VATVALUE__] = $data[__DB_INVOICES__][__DB_INVOICES_NETVALUE__] * 0.23;
            $data[__DB_INVOICES__][__DB_INVOICES_GROSSVALUE__] = $data[__DB_INVOICES__][__DB_INVOICES_VATVALUE__] + $data[__DB_INVOICES__][__DB_INVOICES_NETVALUE__];
            $this->load->model("Invoice_model");
            $this->Invoice_model->update($data[__DB_INVOICES__]);
            
            $this->load->model("Transaction_model");
            $this->Transaction_model->update_batch($data[__DB_TRANSACTIONS__]);

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
            foreach($transactions as $transaction){
                $transaction["netValue"] = $transaction[__DB_TRANSACTIONS_COUNT__] * $transaction[__DB_TRANSACTIONS_NETUNITPRICE__];
                $transaction["vatValue"] = $this->count_vat($transaction["netValue"]);
                $transaction["grossValue"] = $transaction["netValue"] + $transaction["vatValue"];
            }
            $data["fromController"][__DB_TRANSACTIONS__] = $transactions;
            
            $this->db->select(array(__DB_CUSTOMERS_CUSTOMERID__, __DB_CUSTOMERS_NAME__, __DB_CUSTOMERS_COUNTRY__, __DB_CUSTOMERS_CITY__, __DB_CUSTOMERS_STREET__, __DB_CUSTOMERS_HOUSENUMBER__, __DB_CUSTOMERS_APARTMENTNUMBER__));
            $data["fromController"][__DB_CUSTOMERS__] = $this->db->get_where(__DB_CUSTOMERS__,  $data["fromController"][__DB_INVOICES__][__DB_INVOICES_CUSTOMERID__])->result_array()[0];
            
            
            $data["fromController"][__DB_INVOICES__]["netValue"] = $this->count_whole_net_value($transactions);
            $data["fromController"][__DB_INVOICES__]["vatValue"] = $this->count_vat($data["fromController"][__DB_INVOICES__]["netValue"]);
            $data["fromController"][__DB_INVOICES__]["grossValue"] = $this->count_whole_gross_value($transactions);
            
            $this->load->view("Site/header");
            $this->load->view("Site/invoice_pdf_show", $data);
        }
        
        public function test(){
            $data["fromController"] = $this->get_customer(3);
            $this->load->view("var_dump", $data);
        }
        
        public function index(){
            $this->customer_show_view();
        }
        
        
    }