<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Config_model extends CI_Model{
        function __construct(){
            parent::__construct();
        }
        
        //Getters
        public function get($id, $keys = null){
            if($keys !== null AND !is_array($keys)) $keys = array($keys);
            $this->db->from(__DB_CONFIG__);
            $this->db->where(__DB_CONFIG_USER__, $id);
            if($keys === null) $this->db->where_in(__DB_CONFIG_KEY__, $keys);
            
            $toReturn = array();
            foreach($this->db->get()->result_array() as $key => $value)
                $toReturn[$value[__DB_CONFIG_KEY__]] = $value[__DB_CONFIG_VALUE__];
            return $toReturn;
        }
        
        //Setters and Updaters
        public function add($data){
            if($this->db->insert(__DB_CONFIG__, $data))
                return true;
            return false;
        }
        
        public function remove($id, $keys = null){
            if($keys !== null AND !is_array($keys)) $keys = array($keys);
            $this->db->from(__DB_CONFIG__);
            $this->db->where(__DB_CONFIG_USER__, $id);
            if($keys === null) $this->db->where_in(__DB_CONFIG_KEY__, $keys);
            
            if($this->db->delete(__DB_CONFIG__));
                return true;
            return false;
        }
        
        public function update($data, $id, $key){
            $this->db->set($data);
            $this->db->where(__DB_CONFIG_USER__, $id);
            $this->db->where(__DB_CONFIG_KEY__, $key);
            
            $this->db->update(__DB_CONFIG__, $data);
            return true;
        }
    }