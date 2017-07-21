<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Invoice_model extends CI_Model{
        function __construct(){
            parent::__construct();
        }
        
        //Getters
        public function getLastNumber(){
            $match = "";
            $match .= date("Y")."_";
            $match .= date("m")."_";
            $this->db->select("MAX(CAST(SUBSTRING_INDEX(".__DB_INVOICES_INVOICENUMBER__.", '_', -1)AS UNSIGNED)) as max");
            $this->db->from(__DB_INVOICES__);
            $this->db->like(__DB_INVOICES_INVOICENUMBER__, $match, "AFTER");
            return $this->db->get()->result_array()[0]["max"]+1;
        }
        
        public function get($id = null){
            $toReturn = array();
            if($id === null){
                $columns = implode(",", array(
                    __DB_INVOICES__.".*",
                    __DB_CUSTOMERS_NAME__
                ));
                $this->db->select($columns);
               // return $id;
            }
            
            $this->db->from(__DB_INVOICES__);
            $this->db->join(__DB_CUSTOMERS__, __DB_INVOICES__.".".__DB_INVOICES_CUSTOMER__." = ".__DB_CUSTOMERS__.".".__DB_CUSTOMERS_CUSTOMERID__);
            
            $toReturn = $this->db->get()->result_array();
            if($id !== null){
                $toReturn = $toReturn[0];
                $toReturn[__DB_TRANSACTIONS__] = $this->db->get_where(__DB_TRANSACTIONS__, __DB_TRANSACTIONS_INVOICE__."=".$id)->result_array(); 
            }
            return $toReturn;
        }
        
        //Setters
        public function add($data){
            if(array_key_exists(__DB_INVOICES_INVOICEID__, $data))
                unset($data[__DB_INVOICES_INVOICEID__]);
            if($this->db->insert(__DB_INVOICES__, $data))
                return true;
        }
        
        public function remove($id){
            if($this->db->delete(__DB_INVOICES__, array(__DB_INVOICES_INVOICEID__ => $id)))
                return true;
        }
        
        public function update($data){
            $id = $data[__DB_INVOICES_INVOICEID__];
            unset($data[__DB_INVOICES_INVOICEID__]);
            $this->db->update(__DB_INVOICES__, $data, array(__DB_INVOICES_INVOICEID__ => $id));
            return true;
        }
    }