<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Customer_model extends CI_Model{
        function __construct(){
            parent::__construct();
        }
        
        //Getters
        public function get($id = null){
            $this->db->select("*");
            $this->db->from(__DB_CUSTOMERS__);
            if($id !== null) $this->db->where(array(__DB_CUSTOMERS_CUSTOMERID__  => $id));
            $answer = $this->db->get()->result_array();
            
            if($id === null) return $answer;
            return $answer[0];
            
        }
        
        //Setters and Updaters
        public function add($data){
            if(array_key_exists(__DB_CUSTOMERS_CUSTOMERID__, $data))
                unset($data[__DB_CUSTOMERS_CUSTOMERID__]);
            
            if($this->db->insert(__DB_CUSTOMERS__, $data))
                return $this->db->insert_id();
            return false;
        }
        
        public function remove($id){
            if($this->db->delete(__DB_CUSTOMERS__, __DB_CUSTOMERS_CUSTOMERID__." = ".$id))
                return true;
        }
        
        public function update($data, $id){
            $this->db->set($data);
            $this->db->where(__DB_CUSTOMERS_CUSTOMERID__, $id);
            $this->db->update(__DB_CUSTOMERS__, $data);
            return true;
        }
    }