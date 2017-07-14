<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Transaction_model extends CI_Model{
        function __construct(){
            parent::__construct();
        }
        
        public function add($data){
            if($this->db->insert(__DB_TRANSACTIONS__, $data))
                return true;
        }
        
        public function remove($id){
            if($this->db->delete(__DB_TRANSACTIONS__, __DB_TRANSACTIONS_TRANSACTIONID__." = ".$id))
                return true;
        }
        
        public function update($data, $id){
            $this->db->set($data);
            $this->db->where(__DB_TRANSACTIONS_TRANSACTIONID__, $id);
            $this->db->update(__DB_TRANSACTIONS__, $data);
        }
    }