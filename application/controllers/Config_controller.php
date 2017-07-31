<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Config_controller extends CI_Controller{
        private function getUserId(){
            return 
        }
        
        private function getData_config_show_view(){
            $this->load->model("Config_model");
            $this->Config_model->get($id)
        }
        
        function __construct(){
            parent::__construct();
            $this->load->database();
            $this->load->helper("url");
        }
        
        public function config_show_view(){
            $fromController = $this->getData_config_show_view();
            
            $this->load->view("Site/parts/header");
            $this->load->view("Site/parts/navbar");
            $this->load->view("Site/config_view", $fromController);
            $this->load->view("Site/parts/footer");
        }
        
        public function index(){
            redirect("config_controller/config_show_view");
        }
    }