<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoice_controller extends CI_Controller
{

    // <PRIVATE METHODS> --------------------------------------------------------------------------------------------------------------------------------------------
    
    /*
     * Fetches desired data from $data and creates string containing customer's address
     * @param array(mixed) $data - Customer's data.
     * @return string - Customer's address
     */
    private function fetch_customer_address($data)
    {
        $address = $data[__DB_CUSTOMERS_CITY__] . ", ul. " . $data[__DB_CUSTOMERS_STREET__] . " " . $data[__DB_CUSTOMERS_HOUSENUMBER__];
        
        if (isset($data[__DB_CUSTOMERS_APARTMENTNUMBER__]))
            $address .= "/" . $data[__DB_CUSTOMERS_APARTMENTNUMBER__];
        
        return $address;
    }

    /*
     * Returns all possible invoice languages.
     * @return array(string) - All languages stored as key(language abbreviation) => value(full language name)
     */
    private function getLanguages()
    {
        $toReturn = array(
            "PL" => "Polski",
            "ENG" => "Angielski"
        );
        
        foreach ($toReturn as $key => &$val)
            $val .= " (" . $key . ")";
        
        return $toReturn;
    }

    /*
     * Returns all possible currencies.
     * @return array(string) - All currencies stored as key(currency abbreviation) => value(full currency name)
     */
    private function getCurrencies()
    {
        $toReturn = array(
            "PLN" => "Polski Złoty",
            "EUR" => "Euro",
            "GBP" => "Funt Brytyjski",
            "USD" => "Dolar Amerykański",
            "CAD" => "Dolar Kanadyjski"
        );
        
        foreach ($toReturn as $key => &$val)
            $val .= " (" . $key . ")";
        
        return $toReturn;
    }

    /*
     * Translates the decimal representation of the transaction's value to the verbal one (in Polish).
     * I have no clue how it works, but it works...
     */
    private function slownie($kw)
    {
        $t_a = array(
            '',
            'sto',
            'dwieście',
            'trzysta',
            'czterysta',
            'pięćset',
            'sześćset',
            'siedemset',
            'osiemset',
            'dziewięćset'
        );
        $t_b = array(
            '',
            'dziesięć',
            'dwadzieścia',
            'trzydzieści',
            'czterdzieści',
            'pięćdziesiąt',
            'sześćdziesiąt',
            'siedemdziesiąt',
            'osiemdziesiąt',
            'dziewięćdziesiąt'
        );
        $t_c = array(
            '',
            'jeden',
            'dwa',
            'trzy',
            'cztery',
            'pięć',
            'sześć',
            'siedem',
            'osiem',
            'dziewięć'
        );
        $t_d = array(
            'dziesięć',
            'jedenaście',
            'dwanaście',
            'trzynaście',
            'czternaście',
            'piętnaście',
            'szesnaście',
            'siednaście',
            'osiemnaście',
            'dziewiętnaście'
        );
        
        $t_kw_15 = array(
            'septyliard',
            'septyliardów',
            'septyliardy'
        );
        $t_kw_14 = array(
            'septylion',
            'septylionów',
            'septyliony'
        );
        $t_kw_13 = array(
            'sekstyliard',
            'sekstyliardów',
            'sekstyliardy'
        );
        $t_kw_12 = array(
            'sekstylion',
            'sekstylionów',
            'sepstyliony'
        );
        $t_kw_11 = array(
            'kwintyliard',
            'kwintyliardów',
            'kwintyliardy'
        );
        $t_kw_10 = array(
            'kwintylion',
            'kwintylionów',
            'kwintyliony'
        );
        $t_kw_9 = array(
            'kwadryliard',
            'kwadryliardów',
            'kwaryliardy'
        );
        $t_kw_8 = array(
            'kwadrylion',
            'kwadrylionów',
            'kwadryliony'
        );
        $t_kw_7 = array(
            'tryliard',
            'tryliardów',
            'tryliardy'
        );
        $t_kw_6 = array(
            'trylion',
            'trylionów',
            'tryliony'
        );
        $t_kw_5 = array(
            'biliard',
            'biliardów',
            'biliardy'
        );
        $t_kw_4 = array(
            'bilion',
            'bilionów',
            'bilony'
        );
        $t_kw_3 = array(
            'miliard',
            'miliardów',
            'miliardy'
        );
        $t_kw_2 = array(
            'milion',
            'milionów',
            'miliony'
        );
        $t_kw_1 = array(
            'tysiąc',
            'tysięcy',
            'tysiące'
        );
        $t_kw_0 = array(
            'złoty',
            'złotych',
            'złote'
        );
        
        if ($kw != '') {
            $kw = (substr_count($kw, ',') == 0) ? $kw . ',00' : $kw;
            $tmp = explode(",", $kw);
            $ln = strlen($tmp[0]);
            $tmp_a = ($ln % 3 == 0) ? (floor($ln / 3) * 3) : ((floor($ln / 3) + 1) * 3);
            $l_pad = "";
            for ($i = $ln; $i < $tmp_a; $i ++) {
                $l_pad .= '0';
                $kw_w = $l_pad . $tmp[0];
            }
            $kw_w = ($kw_w == '') ? $tmp[0] : $kw_w;
            $paczki = (strlen($kw_w) / 3) - 1;
            $p_tmp = $paczki;
            $kw_slow = "";
            for ($i = 0; $i <= $paczki; $i ++) {
                $t_tmp = 't_kw_' . $p_tmp;
                $p_tmp --;
                $p_kw = substr($kw_w, ($i * 3), 3);
                $kw_w_s = ($p_kw{1} != 1) ? $t_a[$p_kw{0}] . ' ' . $t_b[$p_kw{1}] . ' ' . $t_c[$p_kw{2}] : $t_a[$p_kw{0}] . ' ' . $t_d[$p_kw{2}];
                if (($p_kw{0} == 0) && ($p_kw{2} == 1) && ($p_kw{1} < 1))
                    $ka = ${$t_tmp}[0]; // możliwe że $p_kw{1}!=1
                else if (($p_kw{2} > 1 && $p_kw{2} < 5) && $p_kw{1} != 1)
                    $ka = ${$t_tmp}[2];
                else
                    $ka = ${$t_tmp}[1];
                $kw_slow .= $kw_w_s . ' ' . $ka . ' ';
            }
        }
        $text = $kw_slow . ' ' . $tmp[1] . '/100 gr.';
        return $text;
    }

    /*
     * Updates the transaction list binded to the invoice.
     * @param int $invoiceId - Id of the invoice
     * @param array(mixed) $transactions - Transaction list user wants to update to.
     */
    private function updateTransactions($invoiceId, $transactions)
    {
        $this->load->model("Transaction_model");
        
        $this->db->trans_start();
        $this->Transaction_model->removeInvoice($invoiceId);
        $this->Transaction_model->add_batch($transactions);
        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }

    // COUNTING METHODS
    private function count_netValue($count, $netValue)
    {
        return $count * $netValue;
    }

    private function count_vatValue($count, $netValue, $vat = 0.23)
    {
        return $this->count_netValue($count, $netValue) * $vat;
    }

    private function count_grossValue($count, $netValue)
    {
        return $this->count_netValue($count, $netValue) + $this->count_vatValue($count, $netValue);
    }

    private function count_fullNetValue($transactions)
    {
        $value = 0;
        foreach ($transactions as $transaction) {
            $value += $transaction[__DB_TRANSACTIONS_NETVALUE__];
        }
        return $value;
    }

    /*
     * Adds ready net, vat and gross values to the transaction array.
     * @param ref array(mixed) $transaction - Transaction to which the precalculations will be added.
     */
    private function addPrecalculations(&$transaction)
    {
        $transaction[__DB_TRANSACTIONS_NETVALUE__] = $this->count_netValue($transaction[__DB_TRANSACTIONS_COUNT__], $transaction[__DB_TRANSACTIONS_NETUNITPRICE__]);
        $transaction[__DB_TRANSACTIONS_VATVALUE__] = $this->count_vatValue($transaction[__DB_TRANSACTIONS_COUNT__], $transaction[__DB_TRANSACTIONS_NETUNITPRICE__]);
        $transaction[__DB_TRANSACTIONS_GROSSVALUE__] = $this->count_grossValue($transaction[__DB_TRANSACTIONS_COUNT__], $transaction[__DB_TRANSACTIONS_NETUNITPRICE__]);
        return true;
    }

    // --COUNTING METHODS
    
    // </PRIVATE METHODS> --------------------------------------------------------------------------------------------------------------------------------------------
    
    // <FETCH INPUT> --------------------------------------------------------------------------------------------------------------------------------------------
    
    /*
     * Collects data about invoice and transactions from the form.
     * @return array(mixed)     - Invoice's data in the array
     */
    private function fetchInput_invoice_add()
    {
        $columns = array(
            __DB_INVOICES_INVOICEID__,
            __DB_INVOICES_INVOICENUMBER__,
            __DB_INVOICES_DATE__,
            __DB_INVOICES_CUSTOMER__,
            __DB_INVOICES_PAYMENTDEADLINE__,
            __DB_INVOICES_PAYMENTMETHOD__,
            __DB_INVOICES_OTHERS__,
            __DB_INVOICES_LANGUAGE__,
            __DB_INVOICES_CURRENCY__
        );
        
        $data = array();
        $data[__DB_INVOICES__] = array();
        foreach ($columns as $column) {
            $data[__DB_INVOICES__][$column] = $this->input->post($column);
        }
        
        $columns = array(
            __DB_TRANSACTIONS_NAME__,
            __DB_TRANSACTIONS_MEASUREUNIT__,
            __DB_TRANSACTIONS_COUNT__,
            __DB_TRANSACTIONS_NETUNITPRICE__
        );
        
        $data[__DB_TRANSACTIONS__] = array();
        for ($i = 0; $this->input->post("tData_" . $i . "_0") !== null; $i ++) {
            $data[__DB_TRANSACTIONS__][$i] = array();
            
            for ($j = 0; $j < 4; $j ++) {
                $data[__DB_TRANSACTIONS__][$i][$columns[$j]] = $this->input->post("tData_" . $i . "_" . $j);
            }
            $data[__DB_TRANSACTIONS__][$i][__DB_TRANSACTIONS_TRANSACTIONID__] = $this->input->post("tData_" . $i . "_id");
            $this->addPrecalculations($data[__DB_TRANSACTIONS__][$i]);
        }
        return $data;
    }

    // </FETCH INPUT> --------------------------------------------------------------------------------------------------------------------------------------------
    
    // <GET DATA> --------------------------------------------------------------------------------------------------------------------------------------------
    /*
     * Get Data functions collects data from the models and stores it in the array.
     * There is a name of the function after "getData" which tells what is the data collected for.
     * @returns array(mixed) - Collected data.
     */
    
    
    /*
     * $fromController[0-?][__DB_INVOICES_INVOICEID__]
     *                     [__DB_INVOICES_CUSTOMER__]
     *                     [__DB_INVOICES_INVOICENUMBER__]
     *                     [__DB_INVOICES_DATE__]
     *                     [__DB_INVOICES_PAYMENTDEADLINE__]
     *                     [__DB_INVOICES_PAYMENTMETHOD__]
     *                     [__DB_INVOICES_OTHERS__]
     *                     [__DB_INVOICES_NETVALUE__]
     *                     [__DB_INVOICES_VATVALUE__]
     *                     [__DB_INVOICES_GROSSVALUE__]
     *                     [__DB_INVOICES_CURRENCY__]
     *                     [__DB_INVOICES_LANGUAGE__]
     *                     [__DB_INVOICES_STATUS__]
     *                     [__DB_CUSTOMERS_NAME__]
     */
    private function getData_invoice_show_view()
    {
        $this->load->model("Invoice_model");
        return $this->Invoice_model->get();
    }

    
    private function getData_invoice_add_view()
    {
        $this->load->model("Customer_model");
        $data = $this->Customer_model->get();
        
        $this->load->model("Invoice_model");
        $lastNo = $this->Invoice_model->getLastNumber();
        $lastNo > 9 or $lastNo = "0" . $lastNo;
        $data["LastNumber"] = date("Y") . "_" . date("m") . "_" . $lastNo;
        return $data;
    }

    // </GET DATA> --------------------------------------------------------------------------------------------------------------------------------------------
    
    // <PUBLIC METHODS - INSIDERS> --------------------------------------------------------------------------------------------------------------------------------------------
    
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper("url");
    }

    public function invoice_add()
    {
        $data = array();
        $data = $this->fetchInput_invoice_add();
        
        $data[__DB_INVOICES__][__DB_INVOICES_NETVALUE__] = $this->count_fullNetValue($data[__DB_TRANSACTIONS__]);
        $data[__DB_INVOICES__][__DB_INVOICES_VATVALUE__] = $data[__DB_INVOICES__][__DB_INVOICES_NETVALUE__] * 0.23;
        $data[__DB_INVOICES__][__DB_INVOICES_GROSSVALUE__] = $data[__DB_INVOICES__][__DB_INVOICES_VATVALUE__] + $data[__DB_INVOICES__][__DB_INVOICES_NETVALUE__];
        $this->load->model("Invoice_model");
        $this->Invoice_model->add($data[__DB_INVOICES__]);
        $invoiceId = $this->db->insert_id();
        
        foreach ($data[__DB_TRANSACTIONS__] as &$transaction) {
            $transaction[__DB_TRANSACTIONS_INVOICE__] = $invoiceId;
        }
        $this->load->model("Transaction_model");
        $this->Transaction_model->add_batch($data[__DB_TRANSACTIONS__]);
        
        redirect("invoice_controller/invoice_show_view");
    }

    public function invoice_edit()
    {
        $data = array();
        $data = $this->fetchInput_invoice_add();
        
        $data[__DB_INVOICES__][__DB_INVOICES_NETVALUE__] = $this->count_fullNetValue($data[__DB_TRANSACTIONS__]);
        $data[__DB_INVOICES__][__DB_INVOICES_VATVALUE__] = $data[__DB_INVOICES__][__DB_INVOICES_NETVALUE__] * 0.23;
        $data[__DB_INVOICES__][__DB_INVOICES_GROSSVALUE__] = $data[__DB_INVOICES__][__DB_INVOICES_VATVALUE__] + $data[__DB_INVOICES__][__DB_INVOICES_NETVALUE__];
        $this->load->model("Invoice_model");
        
        $this->Invoice_model->update($data[__DB_INVOICES__]);
        
        foreach ($data[__DB_TRANSACTIONS__] as &$transaction) {
            $transaction[__DB_TRANSACTIONS_INVOICE__] = $data[__DB_INVOICES__][__DB_INVOICES_INVOICEID__];
        }
        if (! $this->updateTransactions($data[__DB_INVOICES__][__DB_INVOICES_INVOICEID__], $data[__DB_TRANSACTIONS__]))
            redirect("invoice_controller/error404");
        
        redirect("invoice_controller/invoice_show_view");
    }
    
    public function invoice_pdf_download($invoiceId)
    {
        $this->load->model("Invoice_model");
        $data["fromController"] = $this->Invoice_model->get($invoiceId);
        
        $html = $this->load->view("Site/invoice_pdf_show", $data, true);
        // $html = $this->load->view("welcome_message", $data, true);
        
        // $this->load->view("var_dump", array($html));
        // this the the PDF filename that user will get to download
        $pdfFilePath = "/home/mpdf/faktura.pdf";
        
        // load mPDF library
        $this->load->library('m_pdf');
        
        // generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html, 0);
        
        // download it.
        $this->m_pdf->pdf->Output();
    }

    public function index()
    {
        redirect("invoice_controller/invoice_show_view");
    }
    
    // </PUBLIC METHODS - INSIDERS> --------------------------------------------------------------------------------------------------------------------------------------------
    
    // <PUBLIC METHODS - OUTSIDERS> --------------------------------------------------------------------------------------------------------------------------------------------

    
    public function invoice_show_view()
    {
        $data = array();
        $data["fromController"] = $this->getData_invoice_show_view();
        
        $this->load->view("Site/parts/header");
        $this->load->view("Site/parts/navbar");
        $this->load->view("Site/invoice_view", $data);
        $this->load->view("Site/parts/footer");
    }
    
    public function invoice_add_view()
    {
        $data = array();
        $data["fromController"] = array();
        
        $answer = $this->getData_invoice_add_view();
        
        $data["fromController"][__DB_INVOICES_INVOICENUMBER__] = $answer["LastNumber"];
        unset($answer["LastNumber"]);
        foreach ($answer as $customer) {
            $data["fromController"][__DB_CUSTOMERS__][$customer[__DB_CUSTOMERS_CUSTOMERID__]] = $customer[__DB_CUSTOMERS_NAME__] . " - " . $this->fetch_customer_address($customer);
        }
        
        $data["fromController"]["Languages"] = $this->getLanguages();
        $data["fromController"]["Currencies"] = $this->getCurrencies();
        
        $this->load->helper("form");
        $this->load->view("Site/parts/header");
        $this->load->view("Site/parts/navbar");
        $this->load->view("Site/invoice_add", $data);
        $this->load->view("Site/parts/footer");
    }
    
    public function invoice_edit_view($invoiceId, $copyMode = false)
    {
        $this->load->helper("form");
        $this->load->model("Invoice_model");
        
        $data["fromController"] = $this->Invoice_model->get($invoiceId);
        
        $this->load->model("Customer_model");
        $customers = $this->Customer_model->get();
        foreach ($customers as $customer) {
            $data["fromController"][__DB_CUSTOMERS__][$customer[__DB_CUSTOMERS_CUSTOMERID__]] = $customer[__DB_CUSTOMERS_NAME__] . " - " . $this->fetch_customer_address($customer);
        }
        
        $data["fromController"]["Languages"] = $this->getLanguages();
        $data["fromController"]["Currencies"] = $this->getCurrencies();
        
        if ($copyMode == true) {
            unset($data["fromController"][__DB_INVOICES_INVOICEID__]);
            $lastNo = $this->Invoice_model->getLastNumber();
            $lastNo > 9 or $lastNo = "0" . $lastNo;
            $data["fromController"][__DB_INVOICES_INVOICENUMBER__] = date("Y") . "_" . date("m") . "_" . $lastNo;
        }
        $this->load->view("Site/parts/header");
        $this->load->view("Site/parts/navbar");
        $this->load->view("Site/invoice_edit", $data);
        $this->load->view("Site/parts/footer");
    }
    
    public function invoice_pdf_view($invoiceId)
    {
        $this->load->helper("form");
        $data = array();
        $data["fromController"] = array();
        
        $this->load->model("Invoice_model");
        $data["fromController"] = $this->Invoice_model->get($invoiceId);
        $data["fromController"]["slownie"] = $this->slownie(str_replace(".", ",", $data["fromController"][__DB_INVOICES_GROSSVALUE__]));
        
        $this->load->view("Site/parts/header");
        $this->load->view("Site/parts/navbar");
        $this->load->view("Site/invoice_pdf_template", $data);
        $this->load->view("Site/invoice_pdf_download_footer", $data["fromController"][__DB_INVOICES_INVOICEID__] = $invoiceId);
        $this->load->view("Site/parts/footer");
    }
    
    // </PUBLIC METHODS - OUTSIDERS> --------------------------------------------------------------------------------------------------------------------------------------------
}