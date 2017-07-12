<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Invoice_controller extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->database();
        }
        
        public function show_customers(){
            $this->load->view("customer_view");
        }
        
        public function index(){
            $this->show_customers();
        }
        
        
    }