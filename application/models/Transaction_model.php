<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Transaction_model extends CI_Model{
        function __construct(){
            parent::__construct();
        }
        
        //Getters
        public function get($id){
            return $this->db->get_where(__DB_TRANSACTIONS__, array(__DB_TRANSACTIONS_TRANSACTIONID__ => $id))->result_array()[0];
        }
        
        //Setters
        public function add($data){
            if(isset($data[__DB_TRANSACTIONS_TRANSACTIONID__]))
                unset($data[__DB_TRANSACTIONS_TRANSACTIONID__]);
            if($this->db->insert(__DB_TRANSACTIONS__, $data))
                return true;
        }
        
        public function add_batch($data){
            foreach($data as &$transaction)
                if(isset($transaction[__DB_TRANSACTIONS_TRANSACTIONID__]))
                    unset($transaction[__DB_TRANSACTIONS_TRANSACTIONID__]);
            if($this->db->insert_batch(__DB_TRANSACTIONS__, $data))
                return true;
        }
        
        public function removeInvoice($id){
            if($this->db->delete(__DB_TRANSACTIONS__, __DB_TRANSACTIONS_INVOICE__." = ".$id))
                return true;
            return false;
        }
        
        public function remove($id){
            if($this->db->delete(__DB_TRANSACTIONS__, __DB_TRANSACTIONS_TRANSACTIONID__." = ".$id))
                return true;
            return false;
        }
        
        public function update($data, $id){
            if(isset($data[__DB_TRANSACTIONS_TRANSACTIONID__]))
                unset($data[__DB_TRANSACTIONS_TRANSACTIONID__]);
            $this->db->set($data);
            $this->db->where(__DB_TRANSACTIONS_TRANSACTIONID__, $id);
            $this->db->update(__DB_TRANSACTIONS__, $data);
            return true;
        }
        
        public function update_batch($data){
            $this->db->update_batch(__DB_TRANSACTIONS__, $data, __DB_TRANSACTIONS_TRANSACTIONID__);
            return true;
        }
    }