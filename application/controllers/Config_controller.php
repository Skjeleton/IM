<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    require_once("Main_controller.php");

    class Config_controller extends Main_controller{
        private function getData_config_show_view($userId){
            $this->load->model("Config_model");
            return $this->Config_model->get($userId);
        }
        
        function __construct(){
            parent::__construct();
            $this->load->database();
            $this->load->helper("url");
        }
        
        public function config_show_view(){
            $this->load->helper("form");
            $data = array();
            $data["fromController"] = $this->getData_config_show_view($this->getUserId());
            $data["fromController"][__DB_CONFIG_USER__] = $this->getUserId();
            
            $this->load->view("Site/parts/header");
            $this->load->view("Site/parts/navbar");
            $this->load->view("Site/config_view", $data);
            $this->load->view("Site/parts/footer");
        }
        
        public function config_edit($userId){
            $this->load->model("Config_model");
            $this->Config_model->update($userId, $_POST);
            return true;
        }
        
        public function index(){
            redirect("config_controller/config_show_view");
        }
    }