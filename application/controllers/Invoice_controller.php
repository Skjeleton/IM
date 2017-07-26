<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Invoice_controller extends CI_Controller{
       //PRIVATE METHODS --------------------------------------------------------------------------------------------------------------------------------------------
        
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
        
        //COUNTING METHODS
        private function count_netValue($count, $netValue){
            return $count * $netValue;
        }
        
        private function count_vatValue($count, $netValue, $vat = 0.23){
            return floor(($this->count_netValue($count, $netValue) * $vat) + 0.005);
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
        
        private function addPrecalculations(&$transaction){
            $transaction[__DB_TRANSACTIONS_NETVALUE__] = $this->count_netValue($transaction[__DB_TRANSACTIONS_COUNT__], $transaction[__DB_TRANSACTIONS_NETUNITPRICE__]);
            $transaction[__DB_TRANSACTIONS_VATVALUE__] = $this->count_vatValue($transaction[__DB_TRANSACTIONS_COUNT__], $transaction[__DB_TRANSACTIONS_NETUNITPRICE__]);
            $transaction[__DB_TRANSACTIONS_GROSSVALUE__] = $this->count_grossValue($transaction[__DB_TRANSACTIONS_COUNT__], $transaction[__DB_TRANSACTIONS_NETUNITPRICE__]);
            return true;
        }
        //--COUNTING METHODS
        
        //INPUTFETCH
        
        
        private function fetchInput_invoice_add(){
            $columns = array(
                __DB_INVOICES_INVOICEID__,
                __DB_INVOICES_INVOICENUMBER__,
                __DB_INVOICES_DATE__,
                __DB_INVOICES_CUSTOMER__,
                __DB_INVOICES_PAYMENTDEADLINE__,
                __DB_INVOICES_PAYMENTMETHOD__,
                __DB_INVOICES_OTHERS__
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
        //--INPUTFETCH
        
        //DATACOLLECTING
        
        
        private function getData_invoice_show_view(){
            $this->load->model("Invoice_model");
            return $this->Invoice_model->get();
        }
        
        private function getData_invoice_add_view(){
            $this->load->model("Customer_model");
            $data = $this->Customer_model->get();
            
            $this->load->model("Invoice_model");
            $data["LastNumber"] = date("Y")."_".date("m")."_".$this->Invoice_model->getLastNumber();
            return $data;
        }
        
        //--DATACOLLECTING
        
        //PUBLIC METHODS --------------------------------------------------------------------------------------------------------------------------------------------
        function __construct(){
            parent::__construct();
            $this->load->database();
            $this->load->helper("url");
        }
        
        public function invoice_show_view(){
            $data = array();
            $data["fromController"] = $this->getData_invoice_show_view();
            
            $this->load->view("Site/header");
            $this->load->view("Site/invoice_view", $data);
        }
        
        public function invoice_add_view(){
            $data = array();
            $data["fromController"] = array();
            
            $answer = $this->getData_invoice_add_view();
            
            $data["fromController"][__DB_INVOICES_INVOICENUMBER__] = $answer["LastNumber"];
            unset($answer["LastNumber"]);
            foreach($answer as $customer){
                $data["fromController"][__DB_CUSTOMERS__][$customer[__DB_CUSTOMERS_CUSTOMERID__]] = $customer[__DB_CUSTOMERS_NAME__]." - ".$this->fetch_customer_address($customer);
            }
            
            $this->load->helper("form");
            $this->load->view("Site/header");
            $this->load->view("Site/invoice_add", $data);
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
        
        public function invoice_edit_view($invoiceId){
            $this->load->helper("form");
            
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

        private function updateTransactions($invoiceId, $transactions){
            $this->load->model("Transaction_model");
            
            $this->db->trans_start();
            $this->Transaction_model->removeInvoice($invoiceId);
            $this->Transaction_model->add_batch($transactions);
            $this->db->trans_complete();
            
            return $this->db->trans_status();
        }
        
        public function invoice_edit(){
            $data = array();
            $data = $this->fetchInput_invoice_add();
            
            $data[__DB_INVOICES__][__DB_INVOICES_NETVALUE__] = $this->count_fullNetValue($data[__DB_TRANSACTIONS__]);
            $data[__DB_INVOICES__][__DB_INVOICES_VATVALUE__] = $data[__DB_INVOICES__][__DB_INVOICES_NETVALUE__] * 0.23;
            $data[__DB_INVOICES__][__DB_INVOICES_GROSSVALUE__] = $data[__DB_INVOICES__][__DB_INVOICES_VATVALUE__] + $data[__DB_INVOICES__][__DB_INVOICES_NETVALUE__];
            $this->load->model("Invoice_model");
            //$this->load->view("var_dump", $data[__DB_INVOICES__]);
            
            $this->Invoice_model->update($data[__DB_INVOICES__]);
            
            foreach($data[__DB_TRANSACTIONS__] as &$transaction){
                $transaction[__DB_TRANSACTIONS_INVOICE__] = $data[__DB_INVOICES__][__DB_INVOICES_INVOICEID__];
            }
            if(!$this->updateTransactions($data[__DB_INVOICES__][__DB_INVOICES_INVOICEID__], $data[__DB_TRANSACTIONS__]))
                redirect("invoice_controller/error404");

            redirect("invoice_controller/invoice_show_view");/**/
        }
        
        public function invoice_pdf_download($invoiceId){
            $this->load->model("Invoice_model");
            $data["fromController"] = $this->Invoice_model->get($invoiceId);
            
            $html = $this->load->view("Site/invoice_pdf_show", $data, true);
            //$html = $this->load->view("welcome_message", $data, true);

            
            //$this->load->view("var_dump", array($html));
            //this the the PDF filename that user will get to download
            $pdfFilePath = "/home/mpdf/faktura.pdf";
            
            //load mPDF library
            $this->load->library('m_pdf');
            
            //generate the PDF from the given html
            $this->m_pdf->pdf->WriteHTML($html, 0);
            
            //download it.
            $this->m_pdf->pdf->Output();
        }
        
        public function invoice_pdf_view($invoiceId){
            $this->load->helper("form");
            $data = array();
            $data["fromController"] = array();
            
            $this->load->model("Invoice_model");
            $data["fromController"] = $this->Invoice_model->get($invoiceId);
            
            //load the view and saved it into $html variable
            //$this->invoice_pdf_download();
            
            
            $this->load->view("Site/header");
            $this->load->view("Site/invoice_pdf_show", $data);
            $this->load->view("Site/invoice_pdf_download_footer", $data["fromController"][__DB_INVOICES_INVOICEID__] = $invoiceId);
        }
        
        public function index(){
            $this->invoice_show_view();
        }
        
        
    }