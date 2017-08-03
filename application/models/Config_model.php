<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Config_model extends CI_Model{
        private function isJson($string) {
            json_decode($string);
            return (json_last_error() == JSON_ERROR_NONE);
        }
        
        function __construct(){
            parent::__construct();
        }
        
        //Getters
        public function get($id, $keys = null){
            // If user passed string instead of an array
            $singleKey = (!is_array($keys) AND !is_null($keys));
            if($keys !== null AND $singleKey) $keys = array($keys);
            
            /*
              	SELECT * 
                FROM `Configurations` 
                WHERE 
                	UserID IS NULL AND 
                    ConfigKey NOT IN ( 
                        SELECT ConfigKey 
                        FROM `Configurations` 
                        WHERE UserID = 1 
                    ) 
            UNION ALL 
            	SELECT * 
                FROM `Configurations` 
                WHERE UserID = 1
             */
       
            // Firstly get safe subquery
            $this->db->start_cache();
            $this->db->select(__DB_CONFIG_KEY__);
            $this->db->from(__DB_CONFIG__);
            $this->db->where(__DB_CONFIG_USER__, $id);
            $subQuery = $this->db->get_compiled_select();
            $this->db->stop_cache();
            $this->db->flush_cache();
           // return $subQuery;
            
            // Then get whole statement part which gets all default values, which weren't defined by user.
            $this->db->start_cache();
            $this->db->from(__DB_CONFIG__);
            $this->db->where(__DB_CONFIG_USER__." IS NULL", null, false);
            $this->db->where(__DB_CONFIG_KEY__." NOT IN (".$subQuery.")");
            $defValues = $this->db->get_compiled_select();
            $this->db->stop_cache();
            $this->db->flush_cache();
            
            // Get config values user has defined.
            $this->db->start_cache();
            $this->db->from(__DB_CONFIG__);
            $this->db->where(__DB_CONFIG_USER__, $id);
            $userValues = $this->db->get_compiled_select();
            $this->db->stop_cache();
            $this->db->flush_cache();
            
            // Creating the whole statement by union merging default values with the values defined by user.
            $allConfigStm = $defValues." UNION ALL ".$userValues;
            $allConfigStm = "(".$allConfigStm.") AS Configs";
            $this->db->from($allConfigStm, null, false);
            if($keys !== null) $this->db->where_in("Configs".".".__DB_CONFIG_KEY__, $keys);
            $answer = $this->db->get()->result_array();
            
            // Else return an array(configKey => configValue)
            $toReturn = array();
            foreach($answer as $config){
                if($this->isJson($config[__DB_CONFIG_VALUE__]))
                    $config[__DB_CONFIG_VALUE__] = json_decode($config[__DB_CONFIG_VALUE__]);
                $toReturn[$config[__DB_CONFIG_KEY__]] = $config[__DB_CONFIG_VALUE__];
            }
            
            return $toReturn;
        }
        
        //Setters and Updaters
        public function add($config){
            if($this->db->insert(__DB_CONFIG__, $config))
                return true;
            return false;
        }
        
        public function remove($config){
            if($this->db->delete(__DB_CONFIG__, array(__DB_CONFIG_USER__ => $config[__DB_CONFIG_USER__], __DB_CONFIG_KEY__ => $config[__DB_CONFIG_KEY__])));
                return true;
            return false;
        }
        
        public function update($id, $configs){
            foreach($configs as $key => $value){
                $config = array();
                $config[__DB_CONFIG_KEY__] = $key;
                $config[__DB_CONFIG_USER__] = $id;
                $config[__DB_CONFIG_VALUE__] = $value;
                $this->db->trans_start();
                $this->remove($config);
                $this->add($config);
                $this->db->trans_complete();
            }
            return true;
        }
    }