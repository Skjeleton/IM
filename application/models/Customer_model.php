<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Customer_model extends CI_Model{
        function __construct(){
            parent::construct();
        }
        
        public function add($data){
            if($this->db->insert(__DB_CUSTOMERS__, $data))
                return true;
        }
        
        public function remove($id){
            if($this->db->delete(__DB_CUSTOMERS__, __DB_CUSTOMERS_CUSTOMERID__." = ".$id))
                return true;
        }
        
        public function update($data, $id){
            $this->db->set($data);
            $this->db->where(__DB_CUSTOMERS_CUSTOMERID__, $id);
            $this->db->update(__DB_CUSTOMERS__, $data);
        }
    }