<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Invoice_model extends CI_Model{
        function __construct(){
            parent::__construct();
        }
        
        public function add($data){
            if($this->db->insert(__DB_INVOICES__, $data))
                return true;
        }
        
        public function remove($id){
            if($this->db->delete(__DB_INVOICES__, __DB_INVOICES_INVOICEID__." = ".$id))
                return true;
        }
        
        public function update($data, $id){
            $this->db->set($data);
            $this->db->where(__DB_INVOICES_INVOICEID__, $id);
            $this->db->update(__DB_INVOICES__, $data);
        }
    }